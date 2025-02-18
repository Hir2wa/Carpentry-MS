<?php
session_start();  // Ensure session is started

if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$loggedInEmail = $_SESSION['email']; // Retrieve logged-in user's email
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Order - Carrefour Mall</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Custom styles for order page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        #page {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
        }
        .btn-primary:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin-top: 20px;
            text-align: center;
            font-size: 16px;
        }
        button[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <img src="images/logo.jfif" alt="Carpentry Management System Logo" class="logo">
            <div class="header-content">
                <h1>MasterCraft Woodworks</h1>
            </div>
        </div>
    </header>
    
    <!-- Navigation Section -->
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="services.html">Services</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="team.html">Team</a></li>
            <li><a href="pricing.html">Pricing</a></li>
            <li><a href="testimonials.html">Testimonials</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="gallery.html">Gallery</a></li>
            <li><a href="order.php">Custom Order</a></li>
        </ul>
    </nav>
    <div id="page">
        <h2>Order Summary</h2>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Size</th>
                    <th>Description</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="order-items">
                <!-- Order items will be injected here by JavaScript -->
            </tbody>
        </table>
        <p>Total: $<span id="order-total-display">0.00</span></p>
        <form action="myorder.php" method="POST" onsubmit="return updateOrderForm()">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($loggedInEmail); ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="location">Your Location:</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <input type="hidden" id="order-items-hidden" name="items">
            <input type="hidden" id="order-total-hidden" name="total">
            <button type="submit" class="btn-primary">Place Order</button>
        </form>
    </div>
    <script>
        function loadOrder() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            if (cart.length === 0) {
                console.log('Cart is empty');
                return;
            }

            let orderItemsTable = document.getElementById('order-items');
            let total = 0;

            cart.forEach((item, index) => {
                let itemTotal = item.price * item.quantity;
                total += itemTotal;
                let row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.name}</td>
                    <td>$${item.price.toFixed(2)}</td>
                    <td>${item.quantity}</td>
                    <td>${item.size || 'N/A'}</td>
                    <td>${item.description || 'N/A'}</td>
                    <td>$${itemTotal.toFixed(2)}</td>
                `;
                orderItemsTable.appendChild(row);
            });

            document.getElementById('order-total-display').textContent = total.toFixed(2);
        }

        function updateOrderForm() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let items = [];
            let total = 0;

            cart.forEach(item => {
                let itemTotal = item.price * item.quantity;
                items.push({
                    name: item.name,
                    price: item.price,
                    quantity: item.quantity,
                    size: item.size || 'N/A',
                    description: item.description || 'N/A',
                    total: itemTotal
                });
                total += itemTotal;
            });

            let itemsJson = JSON.stringify(items);
            document.getElementById('order-items-hidden').value = itemsJson;
            document.getElementById('order-total-hidden').value = total.toFixed(2);

            console.log('Order Items JSON:', itemsJson);
            console.log('Order Total:', total.toFixed(2));

            return true;  // Ensure the form submits
        }

        document.addEventListener('DOMContentLoaded', loadOrder);
    </script>
</body>
</html>
