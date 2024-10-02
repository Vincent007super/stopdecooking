<?php
global $conn;
require 'config.php'; // Laad de databaseconfiguratie

// Haal unieke categorieën op
$categorySql = "SELECT DISTINCT Category FROM `Recipes`";
$categoryStmt = $conn->prepare($categorySql);
$categoryStmt->execute();
$categories = $categoryStmt->fetchAll(PDO::FETCH_COLUMN);

// SQL-query om alle recepten op te halen met een filteroptie
$category = isset($_GET['category']) ? $_GET['category'] : '';
$sql = "SELECT * FROM `Recipes`" . ($category && $category !== 'all' ? " WHERE Category = :category" : "");
$stmt = $conn->prepare($sql);
if ($category && $category !== 'all') {
    $stmt->bindParam(':category', $category);
}
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Haal alle recepten op als associatieve array

require 'views/index_view.php'; // Stuur de recepten door naar de view
