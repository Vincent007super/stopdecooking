<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Account Informatie</title>
    <style>
        body {
            background-color: #f8f9fa; /* Achtergrondkleur consistent met Bootstrap */
        }
        .container {
            margin-top: 20px;
        }
        h2 {
            color: #333; /* Koptekst kleur */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Ontkoken</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="favourites.php">Favorieten</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="logout.php">Uitloggen</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Account Information Section -->
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white text-center">
            <h3>Account Informatie</h3>
        </div>
        <div class="card-body">
            <h5 class="card-title">Ingelogd als:</h5>
            <p class="card-text">
                <?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'Onbekend'; ?>
            </p>

            <h5 class="card-title">Gebruikersnaam:</h5>
            <p class="card-text">
                <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Onbekend'; ?>
            </p>
        </div>
        <div class="card-footer text-center">
            <form action="logout.php" method="post">
                <button type="submit" class="btn btn-danger btn-lg w-100">Uitloggen</button>
            </form>
        </div>
    </div>
</div>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
