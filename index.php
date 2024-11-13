<?php

session_start(); // Start de sessie om toegang te krijgen tot $_SESSION
require 'config.php'; // Laad de databaseconfiguratie

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Stuur de gebruiker naar de inlogpagina als ze niet zijn ingelogd
    exit;
}

$userID = $_SESSION['user_id']; // Haal het gebruikers-ID op

// Functie om te controleren of een recept favoriet is voor deze gebruiker
function isFavourite($pdo, $userID, $receptID) {
    $stmt = $pdo->prepare("SELECT * FROM Favourites WHERE user_id = :userID AND recipe_id = :receptID");
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':receptID', $receptID);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}

// Verwerken van het toevoegen/verwijderen van favorieten
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_favourite'])) {
    $receptID = $_POST['recept_id'];

    if (isFavourite($pdo, $userID, $receptID)) {
        $stmt = $pdo->prepare("DELETE FROM Favourites WHERE user_id = :userID AND recipe_id = :receptID");
    } else {
        $stmt = $pdo->prepare("INSERT INTO Favourites (user_id, recipe_id) VALUES (:userID, :receptID)");
    }

    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':receptID', $receptID);
    $stmt->execute();

    header("Location: index.php");
    exit;
}

// Haal de beschikbare categorieën op
$categoryQuery = "SELECT DISTINCT category FROM RecipeCategories";
$stmt = $pdo->prepare($categoryQuery);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Haal de geselecteerde categorieën op uit de URL (indien aanwezig)
$selectedCategories = isset($_GET['category']) ? $_GET['category'] : [];

// SQL-query om alle recepten op te halen met een filteroptie voor categorieën
$sql = "SELECT Recipes.* 
        FROM Recipes 
        JOIN RecipeCategories ON Recipes.ReceptID = RecipeCategories.recipe_id";

if (!empty($selectedCategories) && !in_array('all', $selectedCategories)) {
    $placeholders = implode(',', array_fill(0, count($selectedCategories), '?'));
    $sql .= " WHERE RecipeCategories.category IN ($placeholders)";
}

// Voeg een DISTINCT toe om dubbele rijen te vermijden
$sql .= " GROUP BY Recipes.ReceptID";
$stmt = $pdo->prepare($sql);

if (!empty($selectedCategories) && !in_array('all', $selectedCategories)) {
    $stmt->execute($selectedCategories);
} else {
    $stmt->execute();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Laad de view voor index
require 'views/index_view.php';
?>