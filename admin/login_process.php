<?php
session_start();

// Replace these database connection details with your actual credentials
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

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM admins WHERE username='$username'";
$result = mysqli_query($connection, $query);

if ($row = mysqli_fetch_assoc($result)) {
    if ($password == $row['password']) {
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['admin_name'] = $row['name'];
        $_SESSION['admin_surname'] = $row['surname'];
        $_SESSION['root'] = $row['root'];

        // Set cookie if "Remember Me" is checked
        if (isset($_POST['rememberMe']) && $_POST['rememberMe'] == 'on') {
            $cookie_name = 'admin_login';
            $cookie_value = base64_encode($row['id'] . '|' . $row['username']);
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 30 days
        }

        header("Location: index.php"); // Redirect to the admin dashboard
    } else {
        echo "Invalid password!";
    }
} else {
    echo "Admin not found!";
}

// Close the database connection
mysqli_close($connection);
?>
