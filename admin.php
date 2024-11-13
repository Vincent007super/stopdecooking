<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['usertype'] != 1) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ontvang de invoer van het formulier
    $title = $_POST['title'] ?? '';
    $difficulty = $_POST['difficulty'] ?? '';
    $tijd = $_POST['tijd'] ?? '';
    $instructions = $_POST['instructions'] ?? '';
    $categories = isset($_POST['categories']) ? $_POST['categories'] : [];

    try {
        $stmt = $pdo->prepare("INSERT INTO Recipes (Title, Difficulty, Tijd, Instructions) VALUES (:title, :difficulty, :tijd, :instructions)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':difficulty', $difficulty);
        $stmt->bindParam(':tijd', $tijd);
        $stmt->bindParam(':instructions', $instructions);

        if ($stmt->execute()) {
            // Verkrijg het laatst toegevoegde recept ID
            $recipeId = $pdo->lastInsertId();

            // Controleer of er een afbeelding is geüpload
            if (isset($_FILES['afbeelding']) && $_FILES['afbeelding']['error'] == 0) {
                $targetDir = "media/uploads/";
                $fileInfo = pathinfo($_FILES["afbeelding"]["name"]);
                $fileExtension = $fileInfo['extension'];
                $targetFileName = $recipeId . "." . $fileExtension;
                $targetFilePath = $targetDir - $targetFileName;

                // Verplaats het geüploade bestand naar de juiste locatie
                if (move_uploaded_file($_FILES["afbeelding"]["tmp_name"], $targetFilePath)) {

                    $stmt = $pdo->prepare("UPDATE Recipes SET Afbeelding = :afbeelding WHERE ReceptID = :ReceptID");
                    $stmt->bindParam(':afbeelding', $targetFileName);
                    $stmt->bindParam(':ReceptID', $recipeId);
                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success' role='alert'>Afbeelding succesvol geüpload en database bijgewerkt.</div>";
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>Fout bij het bijwerken van de database.</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Afbeelding kon niet worden geüpload.</div>";
                }
            }


            // Voeg de geselecteerde categorieën toe aan de categorieën tabel
            foreach ($categories as $category) {
                $stmt = $pdo->prepare("INSERT INTO RecipeCategories (recipe_id, category) VALUES (:ReceptID, :category)");
                $stmt->bindParam(':ReceptID', $recipeId);
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

include 'views/admin_view.php';
