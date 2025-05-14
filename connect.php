<?php
$email = $_POST['email'];
$password = $_POST['password'];

// Baguhin ang credentials base sa iyong setup
$servername = "localhost";
$username = "root";  // default XAMPP username
$password_db = "";   // default XAMPP password (walang password)
$dbname = "test";

// Gumawa ng connection
$conn = new mysqli($servername, $username, $password_db, $dbname);

if($conn->connect_error){
    die('Connection Failed: '.$conn->connect_error);
} else {
    // Gumamit ng prepared statement para maiwasan ang SQL injection
    $stmt = $conn->prepare("INSERT INTO login(email, password) VALUES(?,?)");
    $stmt->bind_param("ss", $email, password_hash($password, PASSWORD_DEFAULT));
    
    if($stmt->execute()) {
        header("Location: admin.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>