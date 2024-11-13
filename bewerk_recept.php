<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['receptid'])) {
    $recipeId = $_GET['receptid'];

    // Haal het bestaande recept op met de juiste kolomnaam
    $stmt = $pdo->prepare("SELECT * FROM Recipes WHERE ReceptID = :id");
    $stmt->bindParam(':id', $recipeId);
    $stmt->execute();
    $recept = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$recept) {
        die("Recept niet gevonden!");
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ontvang bijgewerkte gegevens van het formulier
    $recipeId = $_POST['id'];
    $title = $_POST['title'];
    $difficulty = $_POST['difficulty'];
    $tijd = $_POST['tijd'];
    $instructions = $_POST['instructions'];

    try {
        // Update het recept in de database met de juiste kolomnaam
        $stmt = $pdo->prepare("UPDATE Recipes SET Title = :title, Difficulty = :difficulty, Tijd = :tijd, Instructions = :instructions WHERE ReceptID = :id");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':difficulty', $difficulty);
        $stmt->bindParam(':tijd', $tijd);
        $stmt->bindParam(':instructions', $instructions);
        $stmt->bindParam(':id', $recipeId);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Recept succesvol bijgewerkt!</div>";
        } else {
            throw new Exception("Fout bij het bijwerken van het recept.");
        }
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>" . $e->getMessage() . "</div>";
    }
}

include 'views/bewerk_recept_view.php';