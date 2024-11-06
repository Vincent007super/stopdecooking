<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./media/styles/login.css"> <!-- Zelfde CSS als login -->
    <title>Account Aanmaken</title>
</head>
<body>
<div class="container">
    <h1>Account Aanmaken</h1>
    <form method="POST" action="account.php">
        <div class="input-container">
            <label for="username"></label>
            <input type="text" id="username" name="username" placeholder="Gebruikersnaam*" required>
        </div>
        <div class="input-container">
            <label for="email"></label>
            <input type="email" id="email" name="email" placeholder="E-mailadres*" required>
        </div>
        <div class="input-container">
            <label for="password"></label>
            <input type="password" id="password" name="password" placeholder="Wachtwoord*" required>
        </div>
        <button type="submit">Account Aanmaken</button>
        <p>Heb je al een account? <a href="login.php">Log hier in</a>.</p>
    </form>
</div>
</body>
</html>
