<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Billing System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form id="login-form" action="php/login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <button type="submit" name="submit">Login</button>
        </form>
        <p id="error-message" class="error"></p>
    </div>
    <script src="script.js"></script>
</body>
</html>
