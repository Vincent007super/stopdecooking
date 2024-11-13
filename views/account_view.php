<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Aanmaken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./media/styles/login.css">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow-lg rounded-4" style="max-width: 400px; width: 100%;">
        <h1 class="text-center mb-4 text-success">Account Aanmaken</h1>
        <form method="POST" action="account.php">
            <div class="mb-3">
                <label for="username" class="form-label">Gebruikersnaam</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Voer je gebruikersnaam in" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email adres</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Voer je email in" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Wachtwoord</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Voer je wachtwoord in" required>
            </div>
            <div class="mb-4">
                <label for="confirm_password" class="form-label">Bevestig Wachtwoord</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Bevestig je wachtwoord" required>
            </div>

            <!-- Weergeven van foutmeldingen -->
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger">
                    <?= $error_message ?>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-success w-100">Account Aanmaken</button>
        </form>
        <p class="mt-3 text-center">Heb je al een account? <a href="login.php" class="text-success">Log hier in</a>.</p>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>