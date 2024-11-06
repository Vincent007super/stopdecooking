<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($recept['Title'] ?? 'Recept') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../media/styles/index.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-3">
        <img src="<?= htmlspecialchars($recept['Afbeelding'] ?? '') ?>" alt="<?= htmlspecialchars($recept['Title'] ?? 'Recept') ?>" class="card-img-top">
        <div class="card-body">
            <h2 class="card-title text-success"><?= htmlspecialchars($recept['Title'] ?? 'Onbekende titel') ?></h2>
            <p class="card-text">Categorie: <?= htmlspecialchars($recept['category'] ?? 'Geen categorie beschikbaar') ?></p>
            <p class="card-text">Tijd: <?= htmlspecialchars($recept['Tijd'] ?? 'Onbekend') ?> minuten</p>
            <p class="card-text">Moeilijkheid: <?= htmlspecialchars($recept['Difficulty'] ?? 'Onbekend') ?></p>
            <h4 class="text-success">Instructies</h4>
            <p><?= nl2br(htmlspecialchars($recept['Instructions'] ?? 'Geen instructies beschikbaar')) ?></p>
        </div>
        <div class="card-footer">
            <a href="index.php" class="btn btn-success">Terug naar overzicht</a>
        </div>
    </div>
</div>

<?php if (isset($_GET['success'])): ?>
    <p style="color:green;">Recept succesvol toegevoegd!</p>
<?php endif; ?>

</body>
</html>
