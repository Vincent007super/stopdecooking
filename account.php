<?php
global $conn;
session_start();
include 'config.php'; // De databaseverbinding

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Geen hashing

    // Voeg gebruiker toe aan de database
    $stmt = $conn->prepare("INSERT INTO Users (Username, email, password, UserType) VALUES (:username, :email, :password, 0)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password); // Opslaan in platte tekst

    if ($stmt->execute()) {
        echo "Account succesvol aangemaakt.";
    } else {
        echo "Er is een fout opgetreden bij het aanmaken van het account.";
    }
}

// Inclusie van de weergave voor het aanmaken van een account
include 'views/account_view.php';
?>
