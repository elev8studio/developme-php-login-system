<?php

/* 
CREATE TABLE `login_attempts` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`email` varchar(255) NOT NULL,
	`ip_address` varchar(64) NOT NULL,
	`user_agent` varchar(255) NOT NULL,
	`created_at` TIMESTAMP DEFAULT NOW(),
	`status` varchar(20) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
*/

function login_attempt($email) {
    include('database_connection.php');

    $ip_address = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $login_query = sprintf("INSERT INTO `login_attempts` (`email`, `ip_address`, `user_agent`, `status`)
        VALUES ('%s', '$ip_address', '$user_agent', '%s');",
        mysqli_real_escape_string($db_connection, $email),
        mysqli_real_escape_string($db_connection, 'failed'));

    $login_query_result = mysqli_query($db_connection, $login_query);

    if ($login_query_result) {

        if (mysqli_affected_rows($db_connection) === 1) {
            // login attempt added to database
            // DEBUG: echo 'login attempt added';
            // store login attempt id in variable
            $attempt_id = mysqli_insert_id($db_connection);
            // echo out login attempt id
            // DEBUG: echo 'New record ID is '.$attempt_id;
            // have the function return the login attempt id
            return $attempt_id;
        } else {
            // query failed, broken
            // DEBUG: echo 'query failed';
        }
    }
}

?>
