<?php
// $server = "localhost";
// $username = "root";
// $password = "";
// $database = "medicine_login";

// $con = new mysqli($server, $username, $password, $database);

// if ($con->connect_error) {
//     die("Connection failed: " . $con->connect_error);
// }

// $name = $_POST['medicine_name'];
// $sql = "SELECT * FROM Medicines WHERE medicine_name=($name)";
// $result=$con->query($sql);
// if ($result->num_rows > 0)  
//     { 
//         while($row = $result->fetch_assoc()) 
//         { 
//             echo "Name= ".$row['medicine_name'] ." "."description= ".$row['description']." "."side-effects= ".$row['side_effects']." "."usage_instructions= ".$row['usage_instructions']." "."price= ".$row['price'];
//             echo"<br>"; 
//         }  
//     }  
//     else { 
//         echo "0 results"; 
//     } 

// $conn->close();
?>
<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "medicine_login";

// Establish Connection
$con = new mysqli($server, $username, $password, $database);

// Check Connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Get Medicine Name from Form
$name = trim($_POST['medicine_name']);

if (empty($name)) {
    die("Error: No medicine name provided.");
}

// Prepare SQL Query
$sql = "SELECT * FROM Medicines WHERE medicine_name = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param("s", $name);  // 's' indicates string type
$stmt->execute();
$result = $stmt->get_result();

// Check and Display Results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<strong>Name:</strong> " . htmlspecialchars($row['medicine_name']) . "<br>";
        echo "<strong>Description:</strong> " . htmlspecialchars($row['description']) . "<br>";
        echo "<strong>Side Effects:</strong> " . htmlspecialchars($row['side_effects']) . "<br>";
        echo "<strong>Usage Instructions:</strong> " . htmlspecialchars($row['usage_instructions']) . "<br>";
        echo "<strong>Price:</strong> $" . htmlspecialchars($row['price']) . "<br><br>";
    }
} else {
    echo "No medicine found.";
}

// Close Connections
$stmt->close();
$con->close();
?>
