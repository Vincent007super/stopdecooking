<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./media/styles/login.css">
    <title>Login</title>
</head>
<body>
<div class="container">
    <h1>Login</h1>
    <form method="POST" action="login.php">
        <div class="input-container">
            <label for="email"></label><input type="email" id="email" name="email" placeholder="Email address*" required>
        </div>
        <div class="input-container">
            <label for="password"></label><input type="password" id="password" name="password" placeholder="Password*" required>
        </div>
        <button type="submit">Continue</button>
        <p>Nog geen account? <a href="account.php">Maak er een aan</a>.</p>

    </form>
</div>
</body>
</html>
