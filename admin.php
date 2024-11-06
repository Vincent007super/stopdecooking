<?php
session_start(); // Start de sessie
require 'config.php'; // Laad de databaseconfiguratie

//// Controleer of de gebruiker ingelogd is als admin
//if (!isset($_SESSION['UserType']) || $_SESSION['UserType'] != 1) {
//    header('Location: login.php'); // Verander dit naar de juiste loginpagina
//    exit(); // Zorg ervoor dat de scriptuitvoering stopt na de redirect
//}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ontvang de invoer van het formulier
    $title = $_POST['title'] ?? '';
    $difficulty = $_POST['difficulty'] ?? '';
    $tijd = $_POST['tijd'] ?? '';
    $instructions = $_POST['instructions'] ?? '';
    $categories = isset($_POST['categories']) ? $_POST['categories'] : [];

    // Afbeelding uploaden (optioneel)
    $targetFile = null; // Initialiseert de targetFile variabele
    if (isset($_FILES['afbeelding']) && $_FILES['afbeelding']['error'] == 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["afbeelding"]["name"]);
        if (!move_uploaded_file($_FILES["afbeelding"]["tmp_name"], $targetFile)) {
            $targetFile = null; // Zet naar null als upload mislukt
        }
    }

    try {
        // Voeg het recept toe aan de database
        $stmt = $pdo->prepare("INSERT INTO Recipes (Title, Difficulty, Tijd, Instructions, Afbeelding) VALUES (:title, :difficulty, :tijd, :instructions, :afbeelding)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':difficulty', $difficulty);
        $stmt->bindParam(':tijd', $tijd);
        $stmt->bindParam(':instructions', $instructions);
        $stmt->bindParam(':afbeelding', $targetFile);

        if ($stmt->execute()) {
            // Verkrijg het laatste toegevoegde recept ID
            $recipeId = $pdo->lastInsertId();

            // Voeg de geselecteerde categorieën toe aan de categorieën tabel
            foreach ($categories as $category) {
                $stmt = $pdo->prepare("INSERT INTO RecipeCategories (recipe_id, category) VALUES (:recipe_id, :category)");
                $stmt->bindParam(':recipe_id', $recipeId);
                $stmt->bindParam(':category', $category);
                $stmt->execute();
            }

            echo "<div class='alert alert-success' role='alert'>Recept succesvol toegevoegd!</div>";
        } else {
            throw new Exception("Fout bij het toevoegen van recept.");
        }
    } catch (PDOException $e) {
        // Foutafhandeling
        echo "<div class='alert alert-danger' role='alert'>Er is een fout opgetreden: " . $e->getMessage() . "</div>";
    } catch (Exception $e) {
        echo "<div class='alert alert-danger' role='alert'>" . $e->getMessage() . "</div>";
    }
}

include 'views/admin_view.php'; // Laad de admin view
?>
