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
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="index.php">Recepten</a>
                    <a class="dropdown-item" href="favourites.php">Favorieten</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Uitloggen</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2>Account Informatie</h2>
    <p><strong>Ingelogd als:</strong> <?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'Onbekend'; ?></p>
    <p><strong>Gebruikersnaam:</strong> <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Onbekend'; ?></p>

    <form action="logout.php" method="post" class="mt-4">
        <button type="submit" class="btn btn-danger">Uitloggen</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
