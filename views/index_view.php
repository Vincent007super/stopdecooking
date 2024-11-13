<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biologische Recepten</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" defer></script>
    <link rel="stylesheet" href="media/styles/site.css">
    <link rel="stylesheet" href="media/styles/index.css">
    <!-- For icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" id="home" href="index.php">
            <i class="fas fa-home"></i>
            Ontkoken
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Account
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="account_info.php">Account Info</a></li>
                        <li><a class="dropdown-item" href="favourites.php">Favorieten</a></li>
                        <li><a class="dropdown-item" href="logout.php">Uitloggen</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h1 class="text-center">Biologische Recepten</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="filters">
                <h5>Filter op soort gerecht:</h5>
                <form method="GET" action="">
                    <div class="mb-2">
                        <input type="checkbox" name="category[]" id="category_all" value="all"
                            <?= empty($selectedCategories) ? 'checked' : '' ?>>
                        <label for="category_all">Alle Categorieën</label>
                    </div>
                    <?php foreach ($categories as $cat): ?>
                        <div class="mb-2">
                            <input type="checkbox" name="category[]" id="category_<?= htmlspecialchars($cat) ?>"
                                   value="<?= htmlspecialchars($cat) ?>" class="form-check-input"
                                <?= in_array($cat, (array) $selectedCategories) ? 'checked' : '' ?>>
                            <label for="category_<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></label>
                        </div>
                    <?php endforeach; ?>
                    <button type="submit" class="btn btn-success w-100 mt-3">Filter</button>
                </form>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">
                <?php if (empty($result)): ?>
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            Geen recepten gevonden voor deze categorieën.
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($result as $recept): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="media/uploads/<?= htmlspecialchars($recept['ReceptID']) . '.' . htmlspecialchars($recept['Afbeelding']) ?>"
                                     alt="Recept afbeelding" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($recept['Title']) ?></h5>
                                    <p class="card-text">
                                        <small class="text-muted"><?= htmlspecialchars($recept['Tijd']) ?> minuten |
                                            Moeilijkheid: <?= htmlspecialchars($recept['Difficulty']) ?></small>
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <a href="recept.php?id=<?= htmlspecialchars($recept['ReceptID']) ?>"
                                       class="btn btn-success">Bekijk Recept</a>
                                    <form method="POST" action="favourites.php" class="d-inline">
                                        <input type="hidden" name="recept_id" value="<?= $recept['ReceptID'] ?>">
                                        <input type="hidden" name="toggle_favourite" value="1">
                                        <button type="submit" class="favourite-btn">
                                            <?php if (isFavourite($pdo, $userID, $recept['ReceptID'])): ?>
                                                <i class="fa-solid fa-heart"></i>
                                            <?php else: ?>
                                                <i class="fa-regular fa-heart"></i>
                                            <?php endif; ?>
                                        </button>
                                    </form>
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