    <?php

    session_start();
    require 'config.php';

    // Controleer of de gebruiker is ingelogd
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    $userID = $_SESSION['user_id'];

    // Functie om te controleren of een recept favoriet is voor deze gebruiker
    function isFavourite($pdo, $userID, $RecipeID) {
        $stmt = $pdo->prepare("SELECT * FROM Favourites WHERE User_ID = :userID AND Recipe_ID = :RecipeID");
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':RecipeID', $RecipeID);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_favourite']) && isset($_POST['recept_id'])) {
        $Recipe_ID = $_POST['recept_id']; // Nu met de juiste naam

        echo "Recipe ID: " . htmlspecialchars($Recipe_ID); // Debug output

        if (isFavourite($pdo, $userID, $Recipe_ID)) {
            // Verwijder favoriet
            echo "Verwijderen van favoriet"; // Debug output
            $stmt = $pdo->prepare("DELETE FROM Favourites WHERE User_ID = :userID AND Recipe_ID = :RecipeID");
        } else {
            // Voeg favoriet toe
            echo "Toevoegen van favoriet"; // Debug output
            $stmt = $pdo->prepare("INSERT INTO Favourites (User_ID, Recipe_ID) VALUES (:userID, :RecipeID)");
        }

        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':RecipeID', $Recipe_ID);

        if ($stmt->execute()) {
            echo "Favoriet succesvol gewijzigd."; // Succesbericht
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "Er is een fout opgetreden bij het wijzigen van de favoriet: " . htmlspecialchars($errorInfo[2]); // Foutmelding
        }

        header("Location: favourites.php");
        exit;
    }

    // Haal de favorieten van de gebruiker op
    $stmt = $pdo->prepare("SELECT Recipes.* FROM Recipes 
                            JOIN Favourites ON Recipes.ReceptID = Favourites.Recipe_ID 
                            WHERE Favourites.User_ID = :userID");
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();
    $favorites = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Laad de view voor favorieten
    require 'views/favourites_view.php';
    ?>
