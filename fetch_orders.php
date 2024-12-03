<?php
// Enable error reporting to help debug any issues
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection
$servername = "localhost"; 
$username = "root";        
$password = "";            
$database = "kojafi";   

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Optional: Uncomment the line below to confirm successful connection
    // echo "Connected successfully!"; 
}

// SQL query to fetch all orders
$sql = "SELECT * FROM orders ORDER BY OID DESC"; // Orders by the most recent
$result = $conn->query($sql);

// Check if there are any orders
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row['OID']."</td>
                <td>".$row['Name']."</td>
                <td>".$row['Contact']."</td>
                <td>".$row['Address']."</td>
                <td>".$row['Payment']."</td>
                <td>".$row['Orders']."</td>
                <td>".$row['Request']."</td>
                <td>
                    <button>Process Order</button> <!-- Optional button to update order status -->
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='8'>No orders found</td></tr>";
}

// Close connection
$conn->close();
?>
