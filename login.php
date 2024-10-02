<?php
session_start();
include 'config.php'; // de databaseverbinding

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Zoek de gebruiker op basis van het ingevoerde e-mailadres
    $stmt = $conn->prepare("SELECT * FROM Users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Controleer of de gebruiker bestaat en het wachtwoord correct is
    if ($user && $password === $user['password']) { // Controleer op platte tekst
        $_SESSION['user_id'] = $user['User_ID']; // Inlogsessie starten
        $_SESSION['usertype'] = $user['UserType']; // Gebruikerstype opslaan

        // Stuur de gebruiker door op basis van het type
        if ($user['UserType'] == 1) {
            header("Location: admin.php"); // Admin pagina
        } else {
            header("Location: index.php"); // Normale gebruiker pagina
        }
        exit;
    } else {
        echo "Ongeldige inloggegevens";
    }
}

include 'views/login_view.php';
?>
