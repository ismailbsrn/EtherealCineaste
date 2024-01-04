<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Clear any cookies related to the login (change 'admin_login' to your cookie name)
if (isset($_COOKIE['admin_login'])) {
    setcookie('admin_login', '', time() - 3600, '/');
}

// Redirect to the login page (change 'login.php' to your actual login page)
header("Location: login.php");
exit();
?>
