<?php
// $server = "localhost";
// $username = "root";
// $password = "";
// $database = "medicine_login";

// $con = new mysqli($server, $username, $password, $database);

// if ($con->connect_error) {
//     die("Connection failed: " . $con->connect_error);
// }

// $symptoms = $_POST['symptoms'];

// $symptomsArray = array_map('trim', explode(' , ' , $symptoms));
// $placeholders = implode( ' , ' , array_fill(0, count($symptomsArray), '?'));
// if (empty($symptomsArray) || $symptomsArray[0] == '') {
//     die("Error: No symptoms provided.");
// }

// $sql = "SELECT DISTINCT M.*
//         FROM Symptom_Medicine_Map SMM
//         JOIN Medicines M ON SMM.medicine_id = M.medicine_id
//         JOIN Symptoms S ON SMM.symptom_id = S.symptom_id
//         WHERE S.symptom_name IN ($symptoms)";
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

// Get Symptoms from Form
$symptoms = trim($_POST['symptoms']);
$symptomsArray = array_map('trim', explode(',', $symptoms));

if (empty($symptomsArray) || $symptomsArray[0] == '') {
    die("Error: No symptoms provided.");
}

// Create a Dynamic Placeholder String
$placeholders = implode(',', array_fill(0, count($symptomsArray), '?'));

// Prepare SQL Query with Placeholders
$sql = "SELECT DISTINCT M.*
        FROM Symptom_Medicine_Map SMM
        JOIN Medicines M ON SMM.medicine_id = M.medicine_id
        JOIN Symptoms S ON SMM.symptom_id = S.symptom_id
        WHERE S.symptom_name IN ($placeholders)";

$stmt = $con->prepare($sql);

// Bind Parameters Dynamically
$types = str_repeat('s', count($symptomsArray)); // 's' for string
$stmt->bind_param($types, ...$symptomsArray);
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
    echo "No matching medicines found.";
}

// Close Connections
$stmt->close();
$con->close();
?>

