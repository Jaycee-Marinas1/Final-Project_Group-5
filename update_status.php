<?php
// Database connection
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "kojafi"; // replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update order status
if (isset($_POST['order_id']) && isset($_POST['order_status'])) {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    // Update the status in the database
    $sql = "UPDATE orders SET order_status='$order_status' WHERE OID='$order_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Order status updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();

// Redirect back to the admin page
header("Location: admin.php");
exit();
?>
