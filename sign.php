<?php
$host = "localhost";
$user = "root";  
$pass = "";  
$database="medicine_login";
$conn = new mysqli($host, $user, $pass,$database);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password =  $_POST['password'];

$sql = "INSERT INTO users (name, email, username, password) VALUES (?, ?, ?,?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", $name, $email, $username,$password);
        if ($stmt->execute()) {
            header("Location: index.php");
            exit(); 
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error in preparing statement: " . $conn->error;
    }
    
    $conn->close();
?>
