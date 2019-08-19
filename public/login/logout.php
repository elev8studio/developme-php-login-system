<?php
session_start();
if (isset($_SESSION['logged_in'])) {
    if (true === $_SESSION['logged_in']) {
        // logout
        $_SESSION['logged_in'] = false;
        header('Location: http://jonathan.box/login/index.php');
        exit;
    }
}
?>
