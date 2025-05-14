<?php
$servername = "localhost";
$loginEmail = "loginEmail";
$loginPassword = "loginPassword";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $loginEmail, $loginPassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>