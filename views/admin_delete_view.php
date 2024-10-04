<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Recept Verwijderen</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Verwijder Recept</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Recept ID</th>
            <th>Titel</th>
            <th>Acties</th>
        </tr>
        </thead>
        <tbody>
        <?php
        global$conn;
        // Verkrijg alle recepten
        $stmt = $conn->prepare("SELECT ReceptID, Title FROM Recipes");
        $stmt->execute();
        $recepten = $stmt->fetchAll();

        foreach ($recepten as $recept) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($recept['ReceptID']) . "</td>";
            echo "<td>" . htmlspecialchars($recept['Title']) . "</td>";
            echo "<td><a href='admin_delete.php?receptid=" . htmlspecialchars($recept['ReceptID']) . "' class='btn btn-danger' onclick='return confirm(\"Weet je zeker dat je dit recept wilt verwijderen?\");'>Verwijderen</a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
