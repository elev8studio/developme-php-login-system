<?php

include 'functions/check_password.php';
include 'functions/database_connection.php';

$error = false; // create error status, default is false
$error_messages = [];// create empty error messages array
$success = false; // create success status, default is false
$success_messages = []; // create empty success messages array
$name = ''; // refill form with name on failed check
$email = ''; // refill form with email on failed check
$password = ''; // refill form with password on failed check

// run this code if the form is submitted
if ($_POST) {
    // define email and password values
    $name = $_POST['inputName'];
    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];

    // validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $error_messages[] = 'Invalid email.';
    } else {
        // create email query to check if customer already exists in database
        $email_query = sprintf("SELECT `email` FROM `users` WHERE `email` = '%s';", mysqli_real_escape_string($db_connection, $email));
        // run query and store result in a variable
        $email_query_result = mysqli_query($db_connection, $email_query);
        // if query ran okay...
        if ($email_query_result) {
            if (mysqli_num_rows($email_query_result) > 0) {
                $error = true;
                $error_messages[] = "It looks like you've already registered. Please check your email to activate your account.";
            }
        }
    }

    // validate password, call check_password function and pass $password as argument
    // functions returns an array
    $check_password = check_password($password);

    // read the problem key in $check_password array, if true (there is a problem!)...
    if ($check_password['problem'] === true) {
        $error = true; // set error status to true
        // merge error messages from $check_password array into $error_messages array
        $error_messages = array_merge($error_messages, $check_password['messages']);
    }

    // all user input has passed validation checks, now add stuff to database
    if ($error === false) {
        // we'll send the user an email with a link like: activate.php?code={unique activation code}
        // code should be unique (different for each person) and hard to guess
        $activation_code = hash('sha256', rand(10000000, 10000000000) . 'h5nC7vtU' . uniqid() . $email);

        // check activation code using
        // DEBUG: echo $activation_code;

        // create a hashed password to make it uber secure
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        /*
        CREATE TABLE `users` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(255) NOT NULL,
          `email` varchar(255) NOT NULL,
          `password` varchar(255) NOT NULL,
          `activation_code` varchar(64) NOT NULL,
          `activation_state` varchar(20) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        */

        // build an INSERT query, to insert the user data into our database
        // distrust user input, clean it up before use
        $query = sprintf(
            "INSERT INTO `users` (`name`, `email`, `password`, `activation_code`, `activation_state`)
            VALUES ('%s', '%s', '%s', '%s', '%s');",
            mysqli_real_escape_string($db_connection, $name),
            mysqli_real_escape_string($db_connection, $email),
            mysqli_real_escape_string($db_connection, $hashed_password),
            mysqli_real_escape_string($db_connection, $activation_code),
            mysqli_real_escape_string($db_connection, 'pending')
        );

        // run the $query and store the output in boolean variable (true if query ran, false if query broken)
        // testing the query is a good safeguard to protect against broken code
        $result = mysqli_query($db_connection, $query);

        // check if the query ran, if true run this code...
        if ($result) {
            // query ran okay
            // query has updated 1 or more rows of data
            if (mysqli_affected_rows($db_connection) === 1) {
                // send email with activation link
                $headers = "From: Elev8 <jonathan@elev8now.co.uk>\r\n";
                $headers .= "Reply-To: Help <jonathan@elev8now.co.uk>\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html;\r\n";

                $subject = 'Activate your account!';

                $template = file_get_contents('email-templates/activate-account.html');

                $message = str_replace('{{name}}', $activation_code, $template);
                $message = str_replace('{{code}}', $activation_code, $template);

                if (mail($email, $subject, $message, $headers)) {
                    $success = true;
                    $success_messages[] = 'Please check your email to activate your account.';
                }
            } else {
                $error = true;
                $error_messages[] = 'We seem to have encountered a problem. Please refresh the page and try again, or contact our support team.';
            }
        } else {
            $error = true;
            $error_messages[] = 'We seem to have encountered a problem. Please refresh the page and try again, or contact our support team.';
        }

        /*
        run this code to find out the `id` of the new row in the database
        if (mysqli_affected_rows($db_connection) > 0){
            // DEBUG: echo 'New record ID is '.mysqli_insert_id($db_connection);
        }
        */
    }
}

include 'views/register.view.php';
