<?php
$servername = "localhost";  // Change if using a different server
$username = "root";         // Default username for XAMPP
$password = "";             // Default is empty in XAMPP
$dbname = "form_db";        // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
