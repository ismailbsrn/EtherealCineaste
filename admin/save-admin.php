<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'ethereal_cineaste';

$connection = mysqli_connect($host, $user, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$adminName = $_POST['admin_name'];
$adminSurname = $_POST['admin_surname'];
$username = $_POST['username'];
$password = $_POST['password'];
$passwordCheck = $_POST['password_check'];
$deleteAuthority = $_POST['delete_authority'];

$hashedPassword = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

$query = "INSERT INTO admins (name, surname, username, password, delete_authority) VALUES ('$adminName', '$adminSurname', '$username', '$hashedPassword', '$deleteAuthority')";

$result = mysqli_query($connection, $query);

if ($result) {
    echo "Admin successfully added!";
} else {
    echo "Error: " . mysqli_error($connection);
}

mysqli_close($connection);
?>