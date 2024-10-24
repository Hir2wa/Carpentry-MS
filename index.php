<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpentry Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header Section -->
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
            <li><a href="user_orders.php">Pending Order</a></li>
            <li><a href="logout.php">logout</a></li>

        </ul>
    </nav>

    <!-- Introduction Section -->
   <!-- Introduction Section -->
<section id="introduction">
    <div class="container">
        <h2>Introduction</h2>
        <p>Welcome to MasterCraft Woodworks, your premier destination for exceptional carpentry and custom woodwork solutions. With years of experience and a passion for precision, we specialize in creating beautifully crafted furniture, cabinetry, and home renovations that reflect your unique style and vision. Our skilled artisans bring creativity, attention to detail, and a commitment to excellence to every project, ensuring that each piece is not just a product but a work of art. Whether you're looking to transform your living space, enhance your outdoor area, or add bespoke elements to your home, MasterCraft Woodworks is here to turn your dreams into reality. Experience the perfect blend of functionality and aesthetic appeal with our tailored carpentry services, where quality craftsmanship meets unparalleled customer service.</p>
    </div>
</section>


   <!-- Services Overview Section -->
<section id="services-overview">
    <div class="container">
        <h2>Comprehensive Carpentry Solutions</h2>
        <p>At MasterCraft Woodworks, we provide an extensive array of carpentry services designed to meet all your needs. Whether you're looking for bespoke furniture, elegant cabinetry, or full-scale home renovations, our expert team is here to deliver. Each service is tailored to your specific requirements, ensuring a perfect blend of functionality and aesthetic appeal.</p>
        <a href="services.html" class="btn">Discover Our Services</a>
    </div>
</section>

   

   <!-- Team Introduction Section -->
<section id="team">
    <div class="container">
        <h2>Our Expert Craftsmen</h2>
        <p>At MasterCraft Woodworks, our team is the heart of what we do. Each member of our team is a master of their craft, bringing a unique set of skills and a dedication to excellence. From custom furniture to intricate cabinetry, our experienced artisans work collaboratively to ensure every project is executed with precision and care. We pride ourselves on our ability to transform your vision into reality, with a commitment to quality that is unmatched in the industry.</p>
        <a href="team.html" class="btn">Get to Know Us</a>
    </div>
</section>

  

   
    <footer>
        <div class="container">
            <p>&copy; 2024 MasterCraft Woodworks. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

