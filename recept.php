<?php
require 'config.php'; // Databaseconfiguratie

// Controleer of er een id is opgegeven in de URL
if (isset($_GET['id'])) {
    $recept_id = $_GET['id'];

    // Query om het specifieke recept en de categorie op te halen
    $sql = "SELECT Recipes.*, RecipeCategories.category 
            FROM Recipes 
            LEFT JOIN RecipeCategories ON Recipes.ReceptID = RecipeCategories.recipe_id 
            WHERE Recipes.ReceptID = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $recept_id, PDO::PARAM_INT);
    $stmt->execute();
    $recept = $stmt->fetch(PDO::FETCH_ASSOC);

    // Controleer of het recept is gevonden
    if ($recept) {
        require 'views/recept_view.php';
    } else {
        echo "Recept niet gevonden.";
    }
} else {
    echo "Geen recept ID opgegeven.";
}
