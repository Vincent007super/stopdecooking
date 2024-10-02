<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Account Aanmaken</title>
</head>
<body>
<h1>Aanmaken van een Admin Account</h1>
<form method="POST" action="create_admin.php">
    <div>
        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="email">E-mailadres:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Maak Admin Account Aan</button>
</form>
</body>
</html>
