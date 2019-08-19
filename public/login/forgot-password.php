<?php

include('functions/database_connection.php');

$error = false; // create error status, default is false
$error_messages = [];
$success = false;
$success_messages = [];

// run this code if the form is submitted
if ($_POST) {

    // define email and password values
    $email = $_POST['inputEmail'];

    // validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $error_messages[] = 'Invalid email.';
    } else {
        $query = sprintf("SELECT * FROM `users` WHERE `email` = '%s';", mysqli_real_escape_string($db_connection, $email));

        $result = mysqli_query($db_connection, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {

            // store result data in array
            $database_entry = mysqli_fetch_assoc($result);
                // create reset code - should be unique and hard to guess
                $reset_code = hash('sha256', rand(10000000,10000000000).'jqMf2lXn'.uniqid().$email);
                // check activation code
                // DEBUG: echo $reset_code;

                /* RESET ATTEMPTS table
                CREATE TABLE `reset_attempts` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `email` varchar(255) NOT NULL,
                  `reset_code` varchar(255) NOT NULL,
                  `user_id` int(11) NOT NULL,
                  `created_at` TIMESTAMP DEFAULT NOW(),
                  `status` varchar(20) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
                */

                // store user id linked to email address
                $user_id = $database_entry['id'];

                // build an INSERT query, to insert the reset password attempt into the database table
                // distrust user input, clean it up before use
                $insert_reset = sprintf("INSERT INTO `reset_attempts` (`email`, `reset_code`, `user_id`, `status`)
                    VALUES ('%s', '%s', %s, '%s');",
                    mysqli_real_escape_string($db_connection, $email),
                    mysqli_real_escape_string($db_connection, $reset_code),
                    mysqli_real_escape_string($db_connection, $user_id),
                    mysqli_real_escape_string($db_connection, 'pending'));

                // run the INSERT query (true if query ran, false if query broken)
                // testing the query is a good safeguard to protect against broken code
                $insert_reset_result = mysqli_query($db_connection, $insert_reset);

                // check if the query ran, if true run this code...
                if ($result) {
                    // query ran okay
                    // query has updated 1 or more rows of data
                    if (mysqli_affected_rows($db_connection) === 1) {
                        // we'll send the user an email with a link like: reset.php?code={unique activation code}
                        $headers = "From: Elev8 <jonathan@elev8now.co.uk>\r\n";
                        $headers .= "Reply-To: Help <jonathan@elev8now.co.uk>\r\n";
                        $headers .= "MIME-Version: 1.0\r\n";
                        $headers .= "Content-Type: text/html;\r\n";

                        $subject = "Reset your password!";

                        $template = file_get_contents('email-templates/reset-password.html');

                        $message = str_replace('{{code}}', $reset_code, $template);

                        if (mail($email, $subject, $message, $headers)) {
                            $success = true;
                            $success_messages[] = 'If you have a registered account, you will receive an email with a link to reset your password.';
                        }

                    } else {
                        $error = true;
                        $error_messages[] = "We seem to have encountered a problem. Please refresh the page and try again, or contact our support team.";
                    }
                }
            }
        }
    }
}

include('views/forgot-password.view.php')
?>
