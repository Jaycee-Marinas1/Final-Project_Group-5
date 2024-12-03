<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Order Management</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="admin-container">
        <h1>Admin Order Management</h1>

        <!-- Table displaying orders -->
        <table border="1">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Payment</th>
                    <th>Order Items</th>
                    <th>Special Request</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection configuration
                $servername = "localhost"; 
                $username = "root";        
                $password = "";            
                $database = "kojafi";  

                // Create connection
                $conn = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
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
                                    <form method='POST' action='update_status.php'>
                                        <input type='hidden' name='order_id' value='".$row['OID']."'>
                                        <select name='order_status'>
                                            <option value='Pending'".($row['order_status'] == 'Pending' ? ' selected' : '').">Pending</option>
                                            <option value='Processing'".($row['order_status'] == 'Processing' ? ' selected' : '').">Processing</option>
                                            <option value='Completed'".($row['order_status'] == 'Completed' ? ' selected' : '').">Completed</option>
                                        </select>
                                        <button type='submit'>Update</button>
                                    </form>
                                </td>
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
            </tbody>
        </table>
    </div>
</body>
</html>
