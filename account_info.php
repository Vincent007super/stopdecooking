<?php
session_start();
require 'config.php'; // Laad de databaseconfiguratie

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Haal de gebruikersinformatie op, inclusief de e-mail
$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT Username, email FROM Users WHERE User_ID = :user_id");
$stmt->bindParam(':user_id', $userId);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Controleer of de gebruiker bestaat
if (!$user) {
    echo "Gebruiker niet gevonden.";
    exit;
}

// Inclusie van de weergave voor accountinformatie
include 'views/account_info_view.php';
?>
