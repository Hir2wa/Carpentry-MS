<?php
// Include the FPDF library
require('fpdf186/fpdf.php');

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

// Fetch data from the database
$sql = "SELECT id, name, order_items, order_total FROM orders";
$result = $conn->query($sql);

// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage();

// Set font for the PDF
$pdf->SetFont('Arial', 'B', 12);

// Add a title to the PDF
$pdf->Cell(0, 10, 'Order Summary', 0, 1, 'C');
$pdf->Ln(10);

// Table header
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 10, 'Order Number', 1);
$pdf->Cell(50, 10, 'Customer Name', 1);
$pdf->Cell(70, 10, 'Item Order', 1);
$pdf->Cell(40, 10, 'Amount Paid', 1);
$pdf->Ln();

// Table rows
$pdf->SetFont('Arial', '', 10);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $order_items = json_decode($row['order_items'], true);
        $order_items_display = '';
        if (is_array($order_items)) {
            foreach ($order_items as $item) {
                $order_items_display .= $item['name'] . " (x" . $item['quantity'] . "), ";
            }
            $order_items_display = rtrim($order_items_display, ', ');
        }

        $pdf->Cell(30, 10, $row['id'], 1);
        $pdf->Cell(50, 10, $row['name'], 1);
        $pdf->Cell(70, 10, $order_items_display, 1);
        $pdf->Cell(40, 10, '$' . number_format($row['order_total'], 2), 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No records found', 1, 1, 'C');
}

// Output the PDF
$pdf->Output('D', 'orders_summary.pdf');
?>
