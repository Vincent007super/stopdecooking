<?php
session_start(); // Start de sessie
require 'config.php'; // Laad de databaseconfiguratie

//// Controleer of de gebruiker ingelogd is als admin
// if (!isset($_SESSION['UserType']) || $_SESSION['UserType'] != 1) {
//     header('Location: login.php'); // Verander dit naar de juiste loginpagina
//     exit(); // Zorg ervoor dat de scriptuitvoering stopt na de redirect
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ontvang de invoer van het formulier
    $title = $_POST['title'] ?? '';
    $difficulty = $_POST['difficulty'] ?? '';
    $tijd = $_POST['tijd'] ?? '';
    $instructions = $_POST['instructions'] ?? '';
    $categories = isset($_POST['categories']) ? $_POST['categories'] : [];

    try {
        // Voeg het recept toe aan de database zonder afbeelding
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
                $fileExtension = $fileInfo['extension']; // Haal de extensie op
                $targetFileName = $recipeId . "." . $fileExtension; // Stel de bestandsnaam in op het ID met extensie
                $targetFilePath = $targetDir . $targetFileName;

                // Verplaats het geüploade bestand naar de juiste locatie
                if (move_uploaded_file($_FILES["afbeelding"]["tmp_name"], $targetFilePath)) {
                    // Update de extensie in de database in plaats van de volledige bestandsnaam
                    $stmt = $pdo->prepare("UPDATE Recipes SET Afbeelding = :afbeelding WHERE ReceptID = :ReceptID");
                    $stmt->bindParam(':afbeelding', $fileExtension);  // Sla alleen de extensie op
                    $stmt->bindParam(':ReceptID', $recipeId);  // Bind het recept-ID
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

include 'views/admin_view.php'; // Laad de admin view

?>
