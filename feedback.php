<?php
$host = "localhost";
$user = "root";  
$pass = "";  
$database = "medicine_login";

$conn = new mysqli($host, $user, $pass, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$feedback = $_POST['feedback'];

$sql = "INSERT INTO feedback1 (name, email, feedback) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sss", $name, $email, $feedback);
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
