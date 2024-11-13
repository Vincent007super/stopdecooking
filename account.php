<?php
session_start();
require 'config.php'; // Laad de databaseconfiguratie

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Haal de invoer op
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Controleer of alle velden zijn ingevuld
    if (empty($username)) {
        $error_message = "Gebruikersnaam is verplicht.";
    } elseif ($password !== $confirm_password) {
        // Validatie van wachtwoorden
        $error_message = "De wachtwoorden komen niet overeen. Probeer het opnieuw.";
    } else {
        try {
            // Voeg gebruiker toe aan de database
            $stmt = $pdo->prepare("INSERT INTO Users (Username, email, password, UserType) VALUES (:username, :email, :password, 0)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password); // Opslaan in platte tekst

            if ($stmt->execute()) {
                // Als het account succesvol is aangemaakt, voeg een success-bericht toe
                echo "<div class='alert alert-success' role='alert'>Account succesvol aangemaakt. Je wordt doorgestuurd naar de loginpagina...</div>";
                // JavaScript voor automatische doorverwijzing na 2 seconden
                echo "<script>
                        setTimeout(function() {
                            window.location.href = 'login.php';
                        }, 2000);
                      </script>";
            } else {
                echo "<div class='alert alert-danger' role='alert'>Er is een fout opgetreden bij het aanmaken van het account.</div>";
            }
        } catch (PDOException $e) {
            // Foutafhandeling
            echo "<div class='alert alert-danger' role='alert'>Fout: " . $e->getMessage() . "</div>";
        }
    }
}
include 'views/account_view.php';
