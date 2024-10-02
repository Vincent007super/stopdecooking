<?php
global $conn;

session_start();
include 'config.php'; // de databaseverbinding

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Zoek de gebruiker op basis van het ingevoerde e-mail adres
    $stmt = $conn->prepare("SELECT * FROM Users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Controleer of de gebruiker bestaat en het wachtwoord correct is
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['User_ID']; // Inlogsessie starten
        header("Location: dashboard.php"); // Na succesvolle login doorsturen
        exit;
    } else {
        echo "Ongeldige inloggegevens";
    }
}

include 'views/login_view.php';