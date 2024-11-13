<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($recept['Title'] ?? 'Recept') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../media/styles/index.css">

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

<!-- Main Content Wrapper -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <!-- Recipe Card -->
            <div class="card shadow-lg border-0 rounded-3">
                <div class="image-container">
                    <!-- Afbeelding van het recept -->
                    <img src="<?= htmlspecialchars('media/uploads/' . $recept['ReceptID'] . '.' . $recept['Afbeelding']) ?>"
                         alt="<?= htmlspecialchars($recept['Title'] ?? 'Recept') ?>"
                         class="card-img-top recipe-image rounded-top">
                </div>

                <!-- Recept Informatie -->
                <div class="card-body">
                    <h2 class="card-title text-success"><?= htmlspecialchars($recept['Title'] ?? 'Onbekende titel') ?></h2>
                    <p class="card-text">
                        <strong>Categorie:</strong> <?= htmlspecialchars($recept['category'] ?? 'Geen categorie beschikbaar') ?>
                    </p>
                    <p class="card-text">
                        <strong>Tijd:</strong> <?= htmlspecialchars($recept['Tijd'] ?? 'Onbekend') ?> minuten
                    </p>
                    <p class="card-text">
                        <strong>Moeilijkheid:</strong> <?= htmlspecialchars($recept['Difficulty'] ?? 'Onbekend') ?>
                    </p>

                    <!-- Instructies -->
                    <h4 class="text-success mt-4">Instructies</h4>
                    <p><?= nl2br(htmlspecialchars($recept['Instructions'] ?? 'Geen instructies beschikbaar')) ?></p>
                </div>

                <!-- Footer Section -->
                <div class="card-footer text-center bg-transparent border-top-0">
                    <a href="index.php" class="btn btn-success btn-lg w-100">Terug naar overzicht</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Message -->
<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success text-center mt-3" role="alert">
        Recept succesvol toegevoegd!
    </div>
<?php endif; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" defer></script>

</body>
</html>