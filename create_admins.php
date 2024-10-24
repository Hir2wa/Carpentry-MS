<?php
// Database configuration
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'CMS';

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert an admin user (hashed password for security)
$username = 'Alain';
$password = password_hash('Alain123', PASSWORD_BCRYPT);

$sql = "INSERT INTO admin (username, password) VALUES ('$username', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Admin user created successfully.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
