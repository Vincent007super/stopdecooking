<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biologische Recepten</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="media/styles/site.css">
    <link rel="stylesheet" href="media/styles/index.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" defer></script>
    <!--For icons-->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <style>
        /* Extra CSS voor de sticky sidebar en scheiding */
    </style>
</head>

<body class="bg-light">

    <div id="header_pos">
        <a href="index.php" id="home">
            <img src="media/images/home_icon.png" alt="home button" id="img1">
        </a>
        <div id="filler"></div>
        <div id="account">
            
        </div>
    </div>

    <div class="container mt-5">
        <h1 class="mb-4 text-center text-success">Biologische Recepten</h1>

        <div class="row">
            <div class="col-md-3 filter-container">
                <div class="filters mb-4 p-3 bg-white shadow rounded">
                    <h5 class="text-success">Filter op soort gerecht:</h5>
                    <form method="GET" action="">
                        <div class="mb-2">
                            <input type="checkbox" name="category[]" id="category_all" value="all"
                                class="form-check-input" <?= in_array('all', (array) ($selectedCategories)) ? 'checked' : '' ?>>
                            <label for="category_all" class="form-check-label">Alle Categorieën</label>
                        </div>
                        <?php foreach ($categories as $cat): ?>
                            <div class="mb-2">
                                <input type="checkbox" name="category[]" id="category_<?= htmlspecialchars($cat) ?>"
                                    value="<?= htmlspecialchars($cat) ?>" class="form-check-input" <?= in_array($cat, (array) ($selectedCategories)) ? 'checked' : '' ?>>
                                <label for="category_<?= htmlspecialchars($cat) ?>"
                                    class="form-check-label"><?= htmlspecialchars($cat) ?></label>
                            </div>
                        <?php endforeach; ?>
                        <button type="submit" class="btn btn-success mt-3 w-100">Filter</button>
                    </form>
                </div>
            </div>

            <div class="col-md-9 recipe-container">
                <h3 class="mb-4 text-success">Gezonde Recepten</h3>
                <div class="row">
                    <?php if (empty($result)): ?>
                        <div class="col-12">
                            <div class="alert alert-warning text-center">Geen recepten gevonden voor deze categorieën.</div>
                        </div>
                    <?php else: ?>
                        <?php foreach ($result as $recept): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 border-0 shadow rounded-3">
                                    <img src="<?= htmlspecialchars($recept['Afbeelding']) ?>" alt="Recept afbeelding"
                                        class="card-img-top rounded-top">
                                    <div class="card-body">
                                        <h5 class="card-title text-success"><?= htmlspecialchars($recept['Title']) ?></h5>
                                        <p class="card-text"><small class="text-muted"><?= htmlspecialchars($recept['Tijd']) ?>
                                                minuten | Moeilijkheid: <?= htmlspecialchars($recept['Difficulty']) ?></small>
                                        </p>
                                    </div>
                                    <div class="card-footer bg-transparent border-top-0">
                                        <a href="recept.php?id=<?= htmlspecialchars($recept['ReceptID']) ?>"
                                            class="btn btn-success w-100">Bekijk Recept</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>