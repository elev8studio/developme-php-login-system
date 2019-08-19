<?php
include('functions/database_connection.php');
$error = false;
$error_messages = [];
$success = false;
$success_messages = [];

// check the activation code exists in the URL with $_GET['code']
if (isset($_GET['code'])) {
    // echo 'activation code found in url';
    // set activation code as variable
    $activation_code = $_GET['code'];
    // distrust user input, clean activation code
    $clean_activation_code = mysqli_real_escape_string($db_connection, $activation_code);
    // query the database to find the record with the cleaned activation code
    $query = "SELECT * FROM `users` WHERE `activation_code` = '$clean_activation_code';";
    // did the query run or not? store the result as boolean (true if query ran okay)
    $result = mysqli_query($db_connection, $query);

    if (mysqli_num_rows($result) > 0) {
        // query found matching activation code in database
        // echo 'records found in database';

        // turn that database entry into an associative array
        // this gives us access to all the other data for that person's account e.g. activation state
        $database_entry = mysqli_fetch_assoc($result);

        // check the activation state of database entry
        if ($database_entry['activation_state'] === 'pending') {

            // found matching activation code, and account not activated yet - `activation_state` === 'pending'
            // echo 'activation code found and activation state IS pending';

            // UPDATE that record - `activation_state` = 'active'
            $activate_query = "UPDATE `users` SET `activation_state` = 'active' WHERE `activation_code` = '$clean_activation_code';";

            $activate_query_result = mysqli_query($db_connection, $activate_query);

            /*
            NOTE: View the difference between these 2 functions:
            var_dump((mysqli_affected_rows($db_connection));
            var_dump((mysqli_num_rows($activate_query_result));
            */

            if (mysqli_affected_rows($db_connection) === 1) {
                // query ran okay and updated the activation state of entry
                // echo 'query ran okay and updated the activation state of entry';
                $success = true;
                $success_messages[] = "Your account is now activated. You may now login.";
            } else {
                // account not activated
                $error = true;
                $error_messages[] = "We had a problem activating your account. Please click the activation link again.";
            }

        } else {
            // found matching activation code, but account already activated - `activation_state` !== 'pending'
            // echo 'account is already active';
            $error = true;
            $error_messages[] = "You've already activated your account. <a href='login.php'>Login here</a>.";
        }

    } else {
        // no matching account found
        // echo 'no matching account found in database';
        $error = true;
        $error_messages[] = "Something has gone wrong. Please retry clicking your activation link.";
    }

} else {
    // echo 'no activation code found in url';
    $error = true;
    $error_messages[] = "Something has gone wrong. Please retry clicking your activation link.";
}

include('views/activate.view.php')
?>