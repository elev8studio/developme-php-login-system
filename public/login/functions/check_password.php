<?php

function check_password($password) {
    $error = false; // set error status to false by default (no errors)
    $error_messages = []; //create empty array for error messages

    $uppercase = preg_match('/[A-Z]/', $password); // expression to test if password has uppercase characters, return boolean true if password includes uppercase letters
    $lowercase = preg_match('/[a-z]/', $password); // expression to test if password has lowercase characters, return boolean true if password includes lowercase letters
    $numbers = preg_match('/[0-9]/', $password); // expression to test if password has numbers, return boolean true if password includes numbers
    $special_characters = preg_match('/[^a-zA-Z0-9]/', $password); // expression to test if password has special characters, return boolean true if password includes special characters

    if (!$uppercase) {
        $error = true; // error exists, true
        $error_messages[] = 'Password requires uppercase letters.'.'<br>';
    }

    if (!$lowercase) {
        $error = true; // error exists, true
        $error_messages[] = 'Password requires lowercase letters.'.'<br>';
    }

    if (!$numbers) {
        $error = true; // error exists, true
        $error_messages[] = 'Password requires numbers.'.'<br>';
    }

    if (!$special_characters) {
        $error = true; // error exists, true
        $error_messages[] = 'Password requires symbols.'.'<br>';
    }

    if (strlen($password) < 8) {
        $error = true; // error exists, true
        $error_messages[] = 'Password must be at least 8 characters.'.'<br>';
    }

    // return a mutli-dimensional array with error status and nested array of error messages
    return [
        'problem' => $error, // true or false
        'messages' => $error_messages // nested array of error messages
    ];
}

?>
