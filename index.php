<?php
global $conn;
require 'config.php'; // Laad de databaseconfiguratie

// Haal de beschikbare categorieën op
$categoryQuery = "SELECT DISTINCT Category FROM Recipe_Categories";
$stmt = $conn->prepare($categoryQuery);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Haal de geselecteerde categorieën op uit de URL (indien aanwezig)
$selectedCategories = isset($_GET['category']) ? $_GET['category'] : [];

// SQL-query om alle recepten op te halen met een filteroptie voor categorieën
$sql = "SELECT Recipes.* 
        FROM Recipes 
        JOIN Recipe_Categories ON Recipes.ReceptID = Recipe_Categories.ReceptID";

// Controleer of er geselecteerde categorieën zijn en bouw de WHERE-clausule
if (!empty($selectedCategories)) {
    $placeholders = implode(',', array_fill(0, count($selectedCategories), '?'));
    $sql .= " WHERE Recipe_Categories.Category IN ($placeholders)";
}

// Bereid de query voor
$stmt = $conn->prepare($sql);

// Bind de geselecteerde categorieën aan de query
if (!empty($selectedCategories)) {
    $stmt->execute($selectedCategories);
} else {
    $stmt->execute();
}

// Haal alle resultaten op als associatieve array
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Stuur de recepten door naar de view (index_view.php)
require 'views/index_view.php';
