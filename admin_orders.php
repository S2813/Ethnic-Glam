<?php
// Include the database connection file
include 'db.php';

// Query to get the orders along with the username who placed the order
$query = "SELECT u.username, o.order_date, o.id as order_id 
          FROM orders o 
          JOIN users u ON o.user_id = u.id";  // Join orders with users by user_id

// Execute the query
$result = $conn->query($query);

// Check if there are results
if ($result->num_rows > 0) {
    echo '<div class="container mt-5">';
    echo '<h2 class="text-center text-primary">Order List</h2>';
    echo '<table class="table table-hover table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Order ID</th>
                    <th>Username</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>';
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr class='table-info'>
                <td>" . $row['order_id'] . "</td>
                <td>" . $row['username'] . "</td>
                <td>" . $row['order_date'] . "</td>
              </tr>";
    }
    
    echo "</tbody></table></div>";
} else {
    echo "<div class='alert alert-warning text-center'>No orders found.</div>";
}
?>



