<?php
global $conn;
require 'config.php'; // Laad de databaseconfiguratie

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['usertype'] != 1) {
    header("Location: login.php");
    exit;
}

// Foutmeldingen weergeven voor debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verwijder recept en categorieën als het ID is opgegeven
if (isset($_GET['receptid'])) {
    $receptid = $_GET['receptid'];

    // Verwijder de categorieën van het recept
    $categoryStmt = $conn->prepare("DELETE FROM Recipe_Categories WHERE ReceptID = :receptid");
    $categoryStmt->bindParam(':receptid', $receptid);
    $categoryStmt->execute();

    // Verwijder het recept
    $stmt = $conn->prepare("DELETE FROM Recipes WHERE ReceptID = :receptid");
    $stmt->bindParam(':receptid', $receptid);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success' role='alert'>Recept succesvol verwijderd!</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Er is een fout opgetreden bij het verwijderen van het recept.</div>";
    }
}

include 'views/admin_delete_view.php';
