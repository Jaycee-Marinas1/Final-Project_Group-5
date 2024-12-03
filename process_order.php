<?php
// Database connection configuration
$servername = "localhost"; 
$username = "root";        
$password = "";            
$database = "kojafi";      

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$payment = $_POST['payment'];
$message = $_POST['message'];

// Process orders
$orders = [];
if (isset($_POST['orders'])) {
    foreach ($_POST['orders'] as $product => $details) {
        if (isset($details['name'])) {
            $product_name = $details['name'];
            $quantity = isset($details['quantity']) ? intval($details['quantity']) : 1;
            $orders[] = $product_name . " (Quantity: $quantity)";
        }
    }
}

// Combine orders into a single string
$orders_str = implode(", ", $orders);

// Prepare SQL statement to insert data into the 'orders' table using prepared statements
$stmt = $conn->prepare("INSERT INTO orders (Name, Contact, Address, Payment, Orders, Request) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $name, $contact, $address, $payment, $orders_str, $message);

// Execute the statement
if ($stmt->execute()) {

    $orderID = $stmt->insert_id;


    echo "<script>
            alert('Order placed successfully! Your Order ID is: $orderID');
            window.location.href = 'services.html';
          </script>";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
