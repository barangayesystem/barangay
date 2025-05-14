<?php
$servername = "localhost";
$username = "root";  // or your actual username
$password = "";      // or your actual password
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

// Test date functions
echo "<br>Server time: " . date('Y-m-d H:i:s');
echo "<br>PHP timezone: " . date_default_timezone_get();

$conn->close();
?>