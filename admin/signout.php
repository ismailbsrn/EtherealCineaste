<?php
session_start();

$_SESSION = array();

session_destroy();

if (isset($_COOKIE['admin_login'])) {
    setcookie('admin_login', '', time() - 3600, '/');
}

header("Location: login.php");
exit();
?>