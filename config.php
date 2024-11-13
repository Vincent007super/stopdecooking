<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$host = "localhost"; // je database host
$dbname = "Ontkoking123"; // naam van je database
$username = "ont_100162"; // je database gebruikersnaam
$password = "QK1HETX@g"; // je database wachtwoord

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit; // Stop de uitvoering als de verbinding mislukt.
}