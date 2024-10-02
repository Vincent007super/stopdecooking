<?php
$host = "localhost"; // je database host
$dbname = "Ontkoking123"; // naam van je database
$username = "ont_100162"; // je database gebruikersnaam
$password = "QK1HETX@g"; // je database wachtwoord

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage()); // Laat de verbinding falen en geef een foutmelding
}