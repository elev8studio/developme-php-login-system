<?php
// start session
session_start();

include('functions/database_connection.php');
include('functions/login_attempt.php');

if (isset($_SESSION['logged_in'])) {
    if (true === $_SESSION['logged_in']) {
        header('Location: http://jonathan.box/login/index.php');
        exit;
    }
}

$error = false; // create error status, default is false
$error_messages = []; // create empty error messages array
$email = ''; // define email variable in global scrope, to allow refilling of email on form submission failure
$password = ''; // define password variable in global scrope, to allow refilling of password on form submission failure
$success = false; // create success status, default is false
$success_messages = []; // create empty success messages array

// run this code if the login form is submitted
if ($_POST) {

    // define email and password values
    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];

    $login_id = login_attempt($email);

    if (!($email === '') or ($password === '')) {
        // validate email address
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $error_messages[] = 'Your email or password is incorrect. Please try again.';
        } else {
            // build query to check if customer email address exists in database
            $query = sprintf("SELECT * FROM `users` WHERE `email` = '%s';", mysqli_real_escape_string($db_connection, $email));
            // did the query run or not? store the result as boolean (true if query ran okay)
            $result = mysqli_query($db_connection, $query);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    // query found a matching email address in database
                    // now turn that database entry into an associative array
                    // this gives us access to all the other data for that person's account
                    $database_entry = mysqli_fetch_assoc($result);

                    // check account is active
                    if ($database_entry['activation_state'] !== 'active') {
                        $error = true;
                        // DEBUG: echo 'account not active';
                        $error_messages[] = "Your account has not been activated. Click here to resend activation email.";
                        // NOTE: regenerate activation code, update users database, and resnd activation email
                    } elseif (password_verify($password, $database_entry['password'] )) {
                        // ^^ verify password
                        // ^^ all user input matches database, proceed to login
                        // update status of login attempt to succeeded
                        $login_successful = sprintf("UPDATE `login_attempts` SET `status` = '%s' WHERE `id` = %s;",
                        mysqli_real_escape_string($db_connection, 'successful'),
                        mysqli_real_escape_string($db_connection, $login_id));

                        $login_successful_result = mysqli_query($db_connection, $login_successful);

                        if ($login_successful_result) {
                            if (mysqli_affected_rows($db_connection) === 1) {
                                // DEBUG: echo 'login status updated';
                            } else {
                                // DEBUG: echo 'login query broken';
                            }
                        }

                        // use session
                        $_SESSION['logged_in'] = true;
                        // create session id and store in array
                        $_SESSION['id'] = $database_entry['id'];
                        // when logged in, forward to index.html
                        header('Location: http://jonathan.box/login/index.php');
                        exit;
                    } else {
                        // matching password not found
                        $error = true;
                        $error_messages[] = 'Your email or password is incorrect. Please try again.';
                    }

                } else {
                    // email NOT found in database
                    $error = true;
                    $error_messages[] = "Your email or password is incorrect. Please try again.";
                }
            } else {
                $error = true;
                $error_messages[] = "Uh oh, something's gone wrong. Please refresh the page and try again.";
            }
        }
    // send email to user after login attempt
    }
}

include('views/login.view.php')
?>
