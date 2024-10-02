<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Recepten Beheer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="media/styles/admin.css"> <!-- Voeg je eigen stylesheet toe indien nodig -->
</head>
<body>

<div class="container mt-5">
    <h1>Voeg een nieuw recept toe</h1>

    <!-- Knop naar de verwijderpagina -->
    <div class="mb-4">
        <a href="admin_delete.php" class="btn btn-danger">Verwijder Recepten</a>
    </div>

    <form method="POST" action="admin.php" enctype="multipart/form-data">
        <!-- Titel veld -->
        <div class="mb-3">
            <label for="title" class="form-label">Titel</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <!-- Moeilijkheid veld -->
        <div class="mb-3">
            <label for="difficulty" class="form-label">Moeilijkheid</label>
            <input type="number" class="form-control" id="difficulty" name="difficulty" min="1" max="5" required>
        </div>

        <!-- Tijd veld -->
        <div class="mb-3">
            <label for="tijd" class="form-label">Tijd (in minuten)</label>
            <input type="number" class="form-control" id="tijd" name="tijd" required>
        </div>

        <!-- Afbeelding upload (optioneel) -->
        <div class="mb-3">
            <label for="afbeelding" class="form-label">Afbeelding (optioneel)</label>
            <input type="file" class="form-control" id="afbeelding" name="afbeelding">
        </div>

        <!-- Instructies veld -->
        <div class="mb-3">
            <label for="instructions" class="form-label">Instructies</label>
            <textarea class="form-control" id="instructions" name="instructions" rows="4" required></textarea>
        </div>

        <!-- Meerdere categorieën selecteren met checkboxes -->
        <div class="mb-3">
            <label class="form-label">Selecteer Categorieën</label>
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Vegan" id="vegan" name="categories[]">
                    <label class="form-check-label" for="vegan">Vegan</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Vegetarisch" id="vegetarisch" name="categories[]">
                    <label class="form-check-label" for="vegetarisch">Vegetarisch</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Keto" id="keto" name="categories[]">
                    <label class="form-check-label" for="keto">Keto</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Glutenvrij" id="glutenvrij" name="categories[]">
                    <label class="form-check-label" for="glutenvrij">Glutenvrij</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Gezond" id="gezond" name="categories[]">
                    <label class="form-check-label" for="gezond">Gezond</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Snel" id="snel" name="categories[]">
                    <label class="form-check-label" for="snel">Snel</label>
                </div>
                <!-- Voeg meer categorieën toe indien gewenst -->
            </div>
        </div>

        <!-- Verstuur knop -->
        <button type="submit" class="btn btn-success">Recept toevoegen</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>
