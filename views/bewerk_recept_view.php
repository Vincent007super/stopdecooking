<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bewerk Recept</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Bewerk Recept</h1>

    <?php if (isset($recept) && $recept): ?>
        <form method="POST" action="bewerk_recept.php">
            <input type="hidden" name="id" value="<?= htmlspecialchars($recept['ReceptID'] ?? '') ?>">

            <div class="form-group">
                <label for="title">Titel:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($recept['Title'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="difficulty">Moeilijkheid:</label>
                <select class="form-control" id="difficulty" name="difficulty" required>
                    <option value="Makkelijk" <?= (isset($recept['Difficulty']) && $recept['Difficulty'] == 'Makkelijk') ? 'selected' : '' ?>>Makkelijk</option>
                    <option value="Gemiddeld" <?= (isset($recept['Difficulty']) && $recept['Difficulty'] == 'Gemiddeld') ? 'selected' : '' ?>>Gemiddeld</option>
                    <option value="Moeilijk" <?= (isset($recept['Difficulty']) && $recept['Difficulty'] == 'Moeilijk') ? 'selected' : '' ?>>Moeilijk</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tijd">Tijd (minuten):</label>
                <input type="text" class="form-control" id="tijd" name="tijd" value="<?= htmlspecialchars($recept['Tijd'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="instructions">Instructies:</label>
                <textarea class="form-control" id="instructions" name="instructions" required><?= htmlspecialchars($recept['Instructions'] ?? '') ?></textarea>
            </div>

            <button type="submit" class="btn btn-success btn-block">Bijwerken</button>
        </form>
    <?php else: ?>
        <div class="alert alert-danger mt-4">Dit recept bestaat niet of is niet gevonden.</div>
    <?php endif; ?>
</div>

<!-- Bootstrap JS en dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>