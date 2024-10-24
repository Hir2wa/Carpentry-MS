<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "CMS";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['name'];
    $email = $_SESSION['email'];  // Use the logged-in user's email
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $order_items = $_POST['items'];
    $order_total = $_POST['total'];
    $status = 'Pending'; // Default status

    // Insert order data
    $stmt = $conn->prepare("INSERT INTO orders (email, name, phone, location, order_items, order_total, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $email, $name, $phone, $location, $order_items, $order_total, $status);

    if ($stmt->execute()) {
        echo "Order placed successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
