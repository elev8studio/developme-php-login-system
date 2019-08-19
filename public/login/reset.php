<?php

include('functions/database_connection.php');
include('functions/check_password.php');

$error = false; // create error status, default is false
$error_messages = []; // create empty error messages array
$expired = false;
$success = false; // create success status, default is false
$success_messages = [];

// check the activation code exists in the URL with $_GET['code']
if (isset($_GET['code'])) {
    // store reset code as variable
    $reset_code = $_GET['code'];

    // check if activation code has expired
    // build query to get database entry from matching row in `reset_attempts` table
    $query = sprintf("SELECT * FROM `reset_attempts` WHERE `reset_code` = '%s';", mysqli_real_escape_string($db_connection, $reset_code));
    // store the query result in a boolean variable
    $result = mysqli_query($db_connection, $query);

    // if query ran
    if ($result) {
        // and if match found in database
        if (mysqli_num_rows($result) > 0) {

            // turn that database entry into an associative array
            // this gives us access to all row data including reset status, which we'll need later
            $database_entry = mysqli_fetch_assoc($result);
            // get textual date and time of reset request
            $request_made = strtotime($database_entry['created_at']);
            // get time now
            $now = time();

            // work out difference
            $diff = $now - $request_made;
            // set expiry time
            $expiry_time = 14400; // 4 hours

            if ($diff > $expiry_time) {
                // code has expired
                $error = true;
                $expired = true;
                $error_messages[] = "For your security, this link has expired. Please request a new password reset.";
                // store reset row id
                $reset_id = $database_entry['id'];
                // update status in `reset_attempts` database
                $status_expired_query = sprintf("UPDATE `reset_attempts` SET `status` = '%s' WHERE `user_id` = %s;",
                mysqli_real_escape_string($db_connection, 'expired'),
                mysqli_real_escape_string($db_connection, $reset_id));

                $status_expired_result = mysqli_query($db_connection, $status_expired_query);

                if ($status_expired_result) {
                    if (mysqli_affected_rows($db_connection) === 1) {
                        // DEBUG: echo "succcess - password reset code was used";
                    } else {
                        // DEBUG: echo "error - status query broken";
                    }
                }
            }
        } else {
            // DEBUG: echo 'expiry check failed';
        }
    }
}

if ($_POST) {
    // store passwords as variables
    $new_password = $_POST['newPassword'];
    $confirm_password = $_POST['confirmPassword'];

    // check if passwords match
    if ($new_password !== $confirm_password) {
        // if true, error message
        $error = true;
        $error_messages[] = 'Please check your password.';
    } else {
        // validate password, call check_password function and pass $password as argument
        // functions returns an array
        $check_password = check_password($new_password);
        // read the problem key in $check_password array, if true (there is a problem!)...
        if ($check_password['problem'] === true) {
            $error = true; // set error status to true
            // merge error messages from $check_password array into $error_messages array
            $error_messages = array_merge($error_messages, $check_password['messages']);
        } else {
            // if passwords match and pass strength test
            // create a hashed password to make it uber secure
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            // store user id
            $user_id = $database_entry['user_id'];
            // update password in `users` database
            $password_query = sprintf("UPDATE `users` SET `password` = '%s' WHERE `id` = %s;",
            mysqli_real_escape_string($db_connection,$hashed_password),
            mysqli_real_escape_string($db_connection, $user_id));

            $password_result = mysqli_query($db_connection, $password_query);

            if ($password_result) {
                if (mysqli_affected_rows($db_connection) === 1) {
                    // DEBUG: echo "succcess - password updated in database";
                } else {
                    // DEBUG: echo "error - password query broken";
                }
            }

            // update status in `reset_attempts` database
            $status_used_query = sprintf("UPDATE `reset_attempts` SET `status` = '%s' WHERE `user_id` = %s;",
            mysqli_real_escape_string($db_connection, 'used'),
            mysqli_real_escape_string($db_connection, $user_id));

            $status_used_result = mysqli_query($db_connection, $status_used_query);

            if ($status_used_result) {
                if (mysqli_affected_rows($db_connection) === 1) {
                    $success = true;
                    $success_messages[] = 'Your password has been reset.';
                    // DEBUG: echo "succcess - password reset code was used";
                    // redirect user to login page
                    // header('Location: http://jonathan.box/login/login.php');
                    // exit;
                } else {
                    // DEBUG: echo "error - status query broken";
                }
            }
        }
    }
}
include('views/reset.view.php');

?>
