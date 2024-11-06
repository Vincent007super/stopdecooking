<?php
session_start();
require 'config.php'; // Laad de databaseconfiguratie

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Haal de invoer op
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Geen hashing

    try {
        // Voeg gebruiker toe aan de database
        $stmt = $pdo->prepare("INSERT INTO Users (Username, email, password, UserType) VALUES (:username, :email, :password, 0)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password); // Opslaan in platte tekst

        if ($stmt->execute()) {
            echo "<div class='alert alert-success' role='alert'>Account succesvol aangemaakt.</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Er is een fout opgetreden bij het aanmaken van het account.</div>";
        }
    } catch (PDOException $e) {
        // Foutafhandeling
        echo "<div class='alert alert-danger' role='alert'>Fout: " . $e->getMessage() . "</div>";
    }
}

// Inclusie van de weergave voor het aanmaken van een account
include 'views/account_view.php';
