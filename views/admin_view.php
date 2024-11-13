<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Recepten Beheer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="media/styles/admin.css">
</head>
<body>

<div class="container mt-5">
    <h1>Voeg een nieuw recept toe</h1>

    <div class="mb-4">
        <a href="admin_delete.php" class="btn btn-danger">Beheer Recepten</a>
    </div>

    <form method="POST" action="admin.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Titel</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="difficulty">Moeilijkheid:</label>
            <select class="form-control" id="difficulty" name="difficulty" required>
                <option value="Makkelijk">Makkelijk</option>
                <option value="Gemiddeld">Gemiddeld</option>
                <option value="Moeilijk">Moeilijk</option>
            </select>
            <br>
        </div>

        <div class="mb-3">
            <label for="tijd" class="form-label">Tijd (in minuten)</label>
            <input type="number" class="form-control" id="tijd" name="tijd" required>
        </div>

        <div class="mb-3">
            <label for="afbeelding" class="form-label">Afbeelding (optioneel)</label>
            <input type="file" class="form-control" id="afbeelding" name="afbeelding" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="instructions" class="form-label">Instructies</label>
            <textarea class="form-control" id="instructions" name="instructions" rows="4" required></textarea>
        </div>

        <!-- Meerdere categorieën selecteren met checkboxes -->
        <div class="mb-3">
            <label class="form-label">Selecteer Categorieën</label>
            <div>
                <?php
                $categories = ["Vegetarisch", "Soep", "Kipgerechten", "Visgerechten", "Veganistisch", "Vleesgerechten", "Bijgerechten", "Salades", "Pasta", "Desserts", "Mexicaans", "Gezond", "Eieren", "Keto"];
                foreach ($categories as $category) {
                    echo "
                    <div class='form-check'>
                        <input class='form-check-input' type='checkbox' value='$category' id='$category' name='categories[]'>
                        <label class='form-check-label' for='$category'>$category</label>
                    </div>";
                }
                ?>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Recept toevoegen</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>