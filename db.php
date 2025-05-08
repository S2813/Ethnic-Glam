<?php
// Database connection parameters
$servername = "localhost";  // Usually 'localhost'
$username = "root";         // Your database username (usually 'root' for local servers)
$password = "";             // Your database password (leave empty for local XAMPP/WAMP)
$dbname = "ethnicshop_db";        // The database name you created in phpMyAdmin

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>