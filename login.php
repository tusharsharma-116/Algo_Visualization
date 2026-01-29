
<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "medicine_login";

$con = new mysqli($server, $username, $password, $database);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT COUNT(*) AS count FROM `users` WHERE `username` = ? AND `password` = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['count'] > 0) {
    header("Location: index.php");
    exit();
} else {
    echo "Invalid username or password";
}

$stmt->close();
$con->close();
?>
