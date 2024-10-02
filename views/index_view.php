<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recepten Layout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="media/styles/index.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" defer ></script>
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4 text-center">Recepten</h1>

    <div class="filters mb-4">
        <form method="GET" action="">
            <div class="form-group">
                <label for="category" class="form-label">Filter op soort gerecht:</label>
                <select name="category" id="category" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Selecteer een categorie --</option>
                    <option value="all" <?= ($category === 'all') ? 'selected' : '' ?>>Alle categorieën</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= htmlspecialchars($cat) ?>" <?= ($cat == $category) ? 'selected' : '' ?>><?= htmlspecialchars($cat) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>
    </div>

    <h3 class="mb-4">Gezonde recepten</h3>
    <div class="row">
        <?php foreach ($result as $recept): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?= htmlspecialchars($recept['Afbeelding']) ?>" alt="Recept afbeelding" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($recept['Title']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars(substr($recept['Instructions'], 0, 100)) ?>...</p> <!-- Toon een samenvatting -->
                        <p class="card-text"><small class="text-muted"><?= htmlspecialchars($recept['Tijd']) ?> minuten | Moeilijkheid: <?= htmlspecialchars($recept['Difficulty']) ?></small></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
