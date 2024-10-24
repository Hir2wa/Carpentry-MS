<?php
// Database configuration
$host = 'localhost'; // Your database host
$dbname = 'CMS'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Validate form data
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Insert into database
    $sql = "INSERT INTO contact_form (name, email, subject, message) VALUES (:name, :email, :subject, :message)";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':subject' => $subject,
            ':message' => $message
        ]);
        echo "Message received successfully.";
    } catch (PDOException $e) {
        echo "Error inserting data: " . $e->getMessage();
        exit;
    }
} else {
    echo "Invalid request.";
}
?>
