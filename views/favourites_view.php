<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn Favorieten</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="media/styles/site.css">
    <link rel="stylesheet" href="media/styles/index.css">

    <!-- FontAwesome voor icoontjes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-light">

<!-- Header met account dropdown -->
<div class="d-flex justify-content-between align-items-center p-3 bg-white shadow-sm">
    <a href="index.php">
        <img src="media/images/home_icon.png" alt="Home" id="img1" style="width: 40px;">
    </a>

    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user-circle fa-2x"></i>
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="account_info.php">Mijn Account</a></li>
            <li><a class="dropdown-item" href="favourites.php">Mijn Favorieten</a></li>
            <li><a class="dropdown-item" href="logout.php">Uitloggen</a></li>
        </ul>
    </div>
</div>

<div class="container mt-5">
    <h1 class="mb-4 text-center text-success">Mijn Favorieten</h1>

    <div class="row">
        <?php if (empty($favorites)): ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    Geen favorieten gevonden.
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($favorites as $recept): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm rounded-3">
                        <img src="<?= htmlspecialchars($recept['Afbeelding']) ?>" alt="Recept afbeelding"
                             class="card-img-top rounded-top">
                        <div class="card-body">
                            <h5 class="card-title text-success"><?= htmlspecialchars($recept['Title']) ?></h5>
                            <p class="card-text">
                                <small class="text-muted">
                                    <?= htmlspecialchars($recept['Tijd']) ?> minuten |
                                    Moeilijkheid: <?= htmlspecialchars($recept['Difficulty']) ?>
                                </small>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between">
                            <a href="recept.php?id=<?= htmlspecialchars($recept['ReceptID']) ?>"
                               class="btn btn-success w-75 me-2">Bekijk Recept</a>

                            <form method="POST" action="favourites.php" class="d-inline">
                                <input type="hidden" name="recept_id" value="<?= $recept['ReceptID'] ?>">
                                <input type="hidden" name="toggle_favourite" value="1">
                                <button type="submit" class="favourite-btn">
                                    <i class="fa-solid fa-heart <?= isFavourite($pdo, $userID, $recept['ReceptID']) ? 'text-danger' : 'text-secondary' ?>"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" defer></script>

</body>
</html>
