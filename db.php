<?php
// Set database connection parameters
$servername = "localhost";
$username = "root";
$password = "Piriyah@110599";  // Leave empty if no password is set
$dbname = "Lab_5b";  // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
