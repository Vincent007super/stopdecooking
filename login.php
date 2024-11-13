<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Zoek de gebruiker op basis van het ingevoerde e-mailadres
    $stmt = $pdo->prepare("SELECT * FROM Users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Controleer of de gebruiker bestaat en het wachtwoord correct is
    if ($user && $password === $user['password']) {

        // Sessie-variabelen instellen
        $_SESSION['user_id'] = $user['User_ID'];
        $_SESSION['username'] = $user['Username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['usertype'] = $user['UserType'];

        // Stuur de gebruiker door op basis van het type
        if ($user['UserType'] == 1) {
            header("Location: admin.php");
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        echo "Ongeldige inloggegevens";
    }
}

include 'views/login_view.php';