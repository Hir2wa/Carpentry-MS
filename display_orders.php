<?php
// Database configuration
$host = 'localhost'; // Your database host (usually 'localhost')
$user = 'root'; // Your database username
$pass = ''; // Your database password
$dbname = 'CMS'; // Your database name

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT * FROM orders"; // Replace 'orders' with your table name
$result = $conn->query($sql);

// Begin HTML output with CSS
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #28a745;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .order-items {
            max-width: 600px;
            margin: 0 auto;
        }
        .order-items div {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 4px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Order Summary</h1>';

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Location</th><th>Order Items</th><th>Order Total</th><th>Status</th><th>Created At</th></tr></thead>";
    echo "<tbody>";
    while($row = $result->fetch_assoc()) {
        // Decode order items if they are stored as JSON
        $order_items = json_decode($row['order_items'], true);
        $order_items_display = '';
        if (is_array($order_items)) {
            foreach ($order_items as $item) {
                $order_items_display .= "<div>";
                $order_items_display .= "Name: " . htmlspecialchars($item['name']) . "<br>";
                $order_items_display .= "Price: $" . htmlspecialchars($item['price']) . "<br>";
                $order_items_display .= "Quantity: " . htmlspecialchars($item['quantity']) . "<br>";
                $order_items_display .= "Size: " . htmlspecialchars($item['size']) . "<br>";
                $order_items_display .= "Description: " . htmlspecialchars($item['description']) . "<br>";
                $order_items_display .= "Total: $" . htmlspecialchars($item['total']) . "<br>";
                $order_items_display .= "</div>";
            }
        }

        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
        echo "<td>" . htmlspecialchars($row['location']) . "</td>";
        echo "<td class='order-items'>" . $order_items_display . "</td>";
        echo "<td>" . htmlspecialchars($row['order_total']) . "</td>";
        echo "<td>" . htmlspecialchars($row['status']) . "</td>"; // Display order status
        echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>No records found.</p>";
}

$conn->close();

echo '</body>
</html>';
?>
