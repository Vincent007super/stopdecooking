<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./media/styles/login.css">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow-lg rounded-4" style="max-width: 400px; width: 100%;">
        <h1 class="text-center mb-4 text-success">Login</h1>
        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="email" class="form-label">Email adres</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Voer je email in" required>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Wachtwoord</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Voer je wachtwoord in" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Inloggen</button>
        </form>
        <p class="mt-3 text-center">Nog geen account? <a href="account.php" class="text-success">Maak er een aan</a>.</p>
    </div>
</div>

<!-- Bootstrap JS voor interactiviteit -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>