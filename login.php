<?php
session_start();  // Ensure session is started

$servername = "localhost";
$username = "root"; // Update with your MySQL username
$password = ""; // Update with your MySQL password
$dbname = "CMS"; // Update with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        
        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, log user in
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $email;  // Store email in session
            header("Location: index.php"); // Redirect to homepage or order page
            exit();
        } else {
            // Incorrect password
            header("Location: login.php?error=Incorrect password");
            exit();
        }
    } else {
        // User does not exist, redirect to registration page
        header("Location: register.php?error=Account does not exist. Please register.");
        exit();
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
