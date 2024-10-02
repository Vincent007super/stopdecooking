<?php
$host = "localhost"; // je database host
$dbname = "Ontkoking123"; // naam van je database
$username = "ont_100162"; // je database gebruikersnaam
$password = "QK1HETX@g"; // je database wachtwoord

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; // Test om te zien of de verbinding werkt
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
