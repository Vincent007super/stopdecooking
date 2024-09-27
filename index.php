<?php
$servername = "localhost";
$username = "ontkoking12345";
$password = "15g4Ywx&6";
$dbname = "Ontkoking123"; // Voeg de naam van je database toe

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully<br>";
}

// Voer de SQL-query uit
$sql = "SELECT * FROM Users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Resultaten van elke rij ophalen en weergeven
    while($row = $result->fetch_assoc()) {
        echo "User ID: " . $row["User_ID"] . " - Username: " . $row["Username"] . " - Email: " . $row["email"] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ontkokeringen</title>
    <link rel="stylesheet" href="media/styles/style.css">
    <link rel="stylesheet" href="media/styles/site.css">
</head>

<body>
    <div class="wrapper1">
        <h2></h2>
        <div class="wrapper2">
            <!--Hierin dynamishc tiles inladen-->
        </div>
    </div>
    <div class="wrapper1">
        <h2></h2>
        <div class="wrapper2">
            <!--Hierin dynamishc tiles inladen-->
        </div>
    </div>
</body>

</html>