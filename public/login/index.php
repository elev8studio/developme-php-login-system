<?php
session_start(); // start session

include('functions/database_connection.php');

$logged_in = false;
$welcome_message = 'Welcome ';

if (isset($_SESSION['logged_in'])) {
    if (true === $_SESSION['logged_in']) {
        $id = $_SESSION['id'];
        $query = sprintf("SELECT `name` FROM `users` WHERE `id` = %s;", mysqli_real_escape_string($db_connection, $id));
        $result = mysqli_query($db_connection, $query);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // query found matching id

                // turn that database entry into an associative array
                $database_entry = mysqli_fetch_assoc($result);
                // store email as variable from database entry array
                $name = $database_entry['name'];
                // append email to welcome message
                $welcome_message .= $name;
                $logged_in = true;
            }
        }
    }
}

include('views/index.view.php');
?>
