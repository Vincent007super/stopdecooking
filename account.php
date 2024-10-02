<?php
global $conn;

// Database verbinding includen
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Input van het formulier ophalen en filteren
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Check of het e-mailadres al bestaat in de database
    try {
        $stmt = $conn->prepare("SELECT * FROM Users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Dit e-mailadres is al geregistreerd.";
        } else {
            // Wachtwoord hashen
            $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

            // Voeg nieuwe gebruiker toe aan de database
            $stmt = $conn->prepare("INSERT INTO Users (Username, email, password, UserType, Punten) VALUES (:username, :email, :password, 'user', 0)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $passwordHashed);

            // Voer de query uit en controleer of het lukt
            if ($stmt->execute()) {
                echo "Account succesvol aangemaakt!";
                header("Location: login.php"); // Verwijs naar de loginpagina
                exit;
            } else {
                echo "Er is een fout opgetreden bij het aanmaken van je account.";
            }
        }
    } catch(PDOException $e) {
        // Toon de foutmelding
        echo "Error: " . $e->getMessage();
    }
}

include 'views/account_view.php';
?>
