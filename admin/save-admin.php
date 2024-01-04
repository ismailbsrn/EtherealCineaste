<?php
// Database connection details
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'ethereal_cineaste';

// Create a connection to the database
$connection = mysqli_connect($host, $user, $password, $database);

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch form data
$adminName = $_POST['admin_name'];
$adminSurname = $_POST['admin_surname'];
$username = $_POST['username'];
$password = $_POST['password'];
$passwordCheck = $_POST['password_check'];
$deleteAuthority = $_POST['delete_authority'];

// Hash the password before storing it in the database
$hashedPassword = password_hash($password, PASSWORD_DEFAULT, ['cost' => 29]);

// Insert the new admin into the database
$query = "INSERT INTO admins (name, surname, username, password, delete_authority) VALUES ('$adminName', '$adminSurname', '$username', '$hashedPassword', '$deleteAuthority')";

$result = mysqli_query($connection, $query);

if ($result) {
    echo "Admin successfully added!";
} else {
    echo "Error: " . mysqli_error($connection);
}


// Close the database connection
mysqli_close($connection);
?>