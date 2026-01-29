<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "medicine_login";

$con = new mysqli($server, $username, $password, $database);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$medicines = [];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['symptoms'])) {
    $symptoms = trim($_POST['symptoms']);
    $symptomsArray = array_map('trim', explode(',', $symptoms));

    if (!empty($symptomsArray) && $symptomsArray[0] !== '') {
        $placeholders = implode(',', array_fill(0, count($symptomsArray), '?'));
        $sql = "SELECT DISTINCT M.* FROM Symptom_Medicine_Map SMM
                JOIN Medicines M ON SMM.medicine_id = M.medicine_id
                JOIN Symptoms S ON SMM.symptom_id = S.symptom_id
                WHERE S.symptom_name IN ($placeholders)";

        $stmt = $con->prepare($sql);
        $stmt->bind_param(str_repeat("s", count($symptomsArray)), ...$symptomsArray);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $medicines[] = $row;
        }

        $stmt->close();
    }
}

$medicineDetails = null;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['medicine_name'])) {
    $name = trim($_POST['medicine_name']);

    if (!empty($name)) {
        $sql = "SELECT * FROM Medicines WHERE medicine_name = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $medicineDetails = $result->fetch_assoc();
        }

        $stmt->close();
    }
}
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Suggestor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header" id="home">
        <div class="navbar">
            <a href="#home">Home</a>
            <a href="#about">About The Medicine</a>
            <a href="#health">Health Care Tips</a>
            <a href="#find">Find Best Doctors</a>
            <a href="#consult">Consult with Doctor</a>
            <a href="#buy">Buy Medicine</a>
            <a href="#men">About</a>
        </div>

        <div class="container">
            <div class="c2">
            <h2>Enter Your Symptoms</h2>
            <form method="POST">
                <input type="text" name="symptoms" id="symptoms" placeholder="E.g., Fever, Headache">
                <button type="submit">Suggest Medicine</button>
            </form>
            </div>
    
        <?php if (!empty($medicines)): ?>
            <div class="results">
                <h3>Suggested Medicines:</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Medicine Name</th>
                            <th>Description</th>
                            <th>Side Effects</th>
                            <th>Usage Instructions</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($medicines as $medicine): ?>
                            <tr>
                                <td><?= htmlspecialchars($medicine['medicine_name']) ?></td>
                                <td><?= htmlspecialchars($medicine['description']) ?></td>
                                <td><?= htmlspecialchars($medicine['side_effects']) ?></td>
                                <td><?= htmlspecialchars($medicine['usage_instructions']) ?></td>
                                <td>$<?= htmlspecialchars($medicine['price']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php elseif (empty($medicines)&& isset($_POST['symptoms'])): ?>
            <div class="results">
            <h3>Medicine Not Found</h3>
            </div>
        <?php endif; ?>
        </div>

       
    </header>

    <hr class="hr">

    <main class="main">
        <div class="container1">
            <section class="section1" id="about">
                <h1>About the Medicine</h1>
                <form method="POST">
                    <input type="text" name="medicine_name" id="medicine_name" placeholder="E.g., paracetamol">
                    <button type="submit">Search Medicine</button>
                </form>
            </section>

            <?php if ($medicineDetails): ?>
                <div class="medicine-info">
                    <h2>Medicine Details:</h2>
                    <p><strong class="res">Name:</strong> <?= htmlspecialchars($medicineDetails['medicine_name']) ?></p>
                    <p><strong class="res">Description:</strong> <?= htmlspecialchars($medicineDetails['description']) ?></p>
                    <p><strong class="res">Side Effects:</strong> <?= htmlspecialchars($medicineDetails['side_effects']) ?></p>
                    <p><strong class="res">Usage Instructions:</strong> <?= htmlspecialchars($medicineDetails['usage_instructions']) ?></p>
                    <p><strong class="res">Price:</strong> $<?= htmlspecialchars($medicineDetails['price']) ?></p>
                </div>
            <?php elseif(!$medicineDetails && isset($_POST['medicine_name'])):?>
                <div class="medicine_info">
                    <h2>Medicine Not Found</h2>
                </div>
            <?php endif; ?>
        </div>
        <hr class="hr">

<section class="section2" id="health">
    <div class="container2">
        <h1>Health & Care Tips</h1>
        <p class="tip" id="healthTip">Click the button to get a health tip!</p>
        <button onclick="generateTip()">Get a Tip</button>
    </div>

</section>
<hr class="hr">


<section class="section3" id="find">
    <div class="container3">
        <h2>Find Best Doctors Near You</h2>
        <input type="text" id="city" placeholder="Enter your location">
        <button onclick="findDoctors()">Search</button>
    </div>
    <h3 class="h3">World Best Doctors</h3>
    <div class="doctors-container">
        <div class="doctor-box">
            <h3>Dr. William A. Abdu</h3>
            <p>Spinal Surgery</p>
        </div>
        <div class="doctor-box">
            <h3>Dr. Devi Shetty</h3>
            <p>Cardiac Surgery</p>
        </div>
        <div class="doctor-box">
            <h3>Dr. Sanjay Gupta</h3>
            <p>Neurosurgery</p>
        </div>

    </div>
    <a class="show-more" href="https://medflick.com/blog/best-doctor-in-the-world" target="_blank">Show More</a>

</section>
<hr class="hr">


<section class="consult" id="consult">
    <h2>Consult a Doctor</h2>
    <div class="doctor-container1">
        <div class="doctor1 h">
            <p><strong>Dr. John Doe</strong></p>
            <p>General Physician</p>
            <p>Contact: +1234567890</p>
        </div>
        <div class="doctor1 h">
            <p><strong>Dr. Jane Smith</strong></p>
            <p>Cardiologist</p>
            <p>Contact: +0987654321</p>
        </div>
        <div class="doctor1 h">
            <p><strong>Dr. Alice Brown</strong></p>
            <p>Neurologist</p>
            <p>Contact: +1122334455</p>
        </div>
        <div class="doctor1 h">
            <p><strong>Dr. Mark Wilson</strong></p>
            <p>Orthopedic</p>
            <p>Contact: +5566778899</p>
        </div>
        <div class="doctor1 h">
            <p><strong>Dr. Emily Davis</strong></p>
            <p>Dermatologist</p>
            <p>Contact: +6677889900</p>
        </div>
        <div class="doctor1 h">
            <p><strong>Dr. Robert White</strong></p>
            <p>Pediatrician</p>
            <p>Contact: +3344556677</p>
        </div>
    </div>
    <button class="btn" onclick="gotox()" target>Show More
        Options</button>

</section>
<hr class="hr">


<section class="buy" id="buy">
    <h1>Buy Medicine</h1>
    <div class="medicine-container3">
        <div class="medicine-card" onclick="goToShop()">
            <img src="Medicine1.png" alt="Medicine 1">
            <h3>Paracetamol</h3>
            <p>$5.00</p>
        </div>
        <div class="medicine-card" onclick="goToShop()">
            <img src="medicine2.png" alt="Medicine 2">
            <h3>Ibuprofen</h3>
            <p>$8.00</p>
        </div>
        <div class="medicine-card" onclick="goToShop()">
            <img src="medicine3.png" alt="Medicine 3">
            <h3>Cough Syrup</h3>
            <p>$12.00</p>
        </div>
    </div>
    <button class="show-more1" onclick="goToShop()">Show More</button>

</section>
<hr class="hr">
</main>
<footer class="men" id="men">
<h1>Contact us</h1>
<div class="box">
    <div class="cont1">
        <h3><i class="fa-solid fa-phone"></i>Phone:8824780800</h3>
        <h3><i class="fa-solid fa-envelope"></i>Gmail:tashikmiddha@gmail.com</h3>
          <br>
    </div>
    <div class="cont2">
    <h3>Feedback Form</h3>
                 <form action="feedback.php" method="POST">
                    <input type="text" name="name" id="name" placeholder="Enter Your Name">
                    <input type="email" name="email" id="email" placeholder="Enter Your Email">
                    <textarea name="feedback" id="feedback"  placeholder="Enter Your Feedback"></textarea>
                    <button type="submit">Submit</button>
                 </form>
    </div>
</div>
<div class="copy">
    <h2>Made by Tashik Middha |<i class="fa-solid fa-copyright"></i> All Rights Reserved</h2>
</div>

</footer>

    <script>
        const tips = [
            "Drink plenty of water to stay hydrated.",
            "Get at least 7-8 hours of sleep every night.",
            "Exercise regularly to keep your body fit.",
            "Eat a balanced diet rich in fruits and vegetables.",
            "Reduce stress through meditation or deep breathing.",
            "Limit sugar and processed food intake.",
            "Wash your hands frequently to prevent infections.",
            "Maintain good posture to avoid back pain.",
            "Take breaks from screens to reduce eye strain.",
            "Stay active and avoid prolonged sitting."
        ];

        function generateTip() {
            const randomIndex = Math.floor(Math.random() * tips.length);
            document.getElementById("healthTip").textContent = tips[randomIndex];
        }

        function findDoctors() {
            let city = document.getElementById("city").value;
            if (city) {
                let query = `https://www.google.com/maps/search/best+doctors+in+${encodeURIComponent(city)}/`;
                window.open(query, '_blank');
            } else {
                alert("Please enter a city name");
            }
        }

        function goToShop() {
            window.open("https://www.netmeds.com/", "_blank");
        }
        function gotox(){
            window.open("https://www.apollo247.com/specialties","_blank");
        }
    </script>
    <script src="https://kit.fontawesome.com/e616eb472b.js" crossorigin="anonymous"></script>

</body>
</html>
