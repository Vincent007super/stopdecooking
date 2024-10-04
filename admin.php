<?php
global $conn;
require 'config.php'; // Laad de databaseconfiguratie

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['usertype'] != 1) {
    // Als de gebruiker niet ingelogd is of geen admin is, doorsturen naar de loginpagina
    header("Location: login.php");
    exit;
}

// Foutmeldingen weergeven voor debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verkrijg de gegevens van het formulier
    $title = $_POST['title'];
    $difficulty = $_POST['difficulty'];
    $tijd = $_POST['tijd'];
    $instructions = $_POST['instructions'];
    $categories = isset($_POST['categories']) ? $_POST['categories'] : []; // Meerdere categorieën ontvangen als array

    // Afbeelding uploaden
    $afbeeldingPad = null; // Standaard naar null

    if (isset($_FILES['afbeelding']) && $_FILES['afbeelding']['error'] === UPLOAD_ERR_OK) {
        $afbeelding = $_FILES['afbeelding'];
        $afbeeldingNaam = uniqid('', true) . "-" . basename($afbeelding['name']); // Unieke naam voor afbeelding
        $afbeeldingPad = 'uploads/' . $afbeeldingNaam; // Pad om de afbeelding op te slaan

        // Beweeg de afbeelding naar de uploads map
        if (!move_uploaded_file($afbeelding['tmp_name'], $afbeeldingPad)) {
            echo "<div class='alert alert-danger' role='alert'>Afbeelding kon niet worden geüpload.</div>";
            exit; // Stop de uitvoering als de upload mislukt
        }
    }

    // Voeg het recept toe aan de database
    $stmt = $conn->prepare("INSERT INTO Recipes (Title, Difficulty, Tijd, Instructions, Afbeelding) VALUES (:title, :difficulty, :tijd, :instructions, :afbeelding)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':difficulty', $difficulty);
    $stmt->bindParam(':tijd', $tijd);
    $stmt->bindParam(':instructions', $instructions);
    $stmt->bindParam(':afbeelding', $afbeeldingPad); // Hier kan het null zijn

    if ($stmt->execute()) {
        $receptid = $conn->lastInsertId(); // Verkrijg het ID van het laatste ingevoegde recept

        // Controleer of er categorieën zijn geselecteerd
        if (!empty($categories)) {
            // Voeg de geselecteerde categorieën toe
            foreach ($categories as $category) {
                $categoryStmt = $conn->prepare("INSERT INTO Recipe_Categories (ReceptID, Category) VALUES (:receptid, :category)");
                $categoryStmt->bindParam(':receptid', $receptid);
                $categoryStmt->bindParam(':category', $category);
                if (!$categoryStmt->execute()) {
                    echo "<div class='alert alert-danger' role='alert'>Fout bij het toevoegen van de categorie: " . htmlspecialchars($category) . "</div>";
                }
            }
        }
        echo "<div class='alert alert-success' role='alert'>Recept toegevoegd!</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Er is een fout opgetreden bij het toevoegen van het recept: " . htmlspecialchars($stmt->errorInfo()[2]) . "</div>";
    }
}

include 'views/admin_view.php';
