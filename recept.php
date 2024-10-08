<?php
global $conn;
require 'config.php'; // Databaseconfiguratie

// Controleer of er een id is opgegeven in de URL
if (isset($_GET['id'])) {
    $recept_id = $_GET['id'];

    // Query om het specifieke recept op te halen
    $sql = "SELECT * FROM `Recipes` WHERE ReceptID = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $recept_id, PDO::PARAM_INT);
    $stmt->execute();
    $recept = $stmt->fetch(PDO::FETCH_ASSOC);

    // Controleer of het recept is gevonden
    if ($recept) {
        // Laad de view met de details van het recept
        require 'views/recept_view.php';
    } else {
        echo "Recept niet gevonden.";
    }
} else {
    echo "Geen recept ID opgegeven.";
}
