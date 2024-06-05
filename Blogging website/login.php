<?php
//username, password
// username - username and password
// username and user_id - sessions

require 'config/db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username=? ');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
            // Debug message, in production you would usually redirect without a message
            echo "Session variables are set successfully.";
        }
        header("Location:index.php");
        exit();
    } else {
        $error = "Invalida username or password";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="./styles/login.css">
</head>

<body>
    <?php include 'templates/navbar.php'; ?>

    <div class="login-container">
        <h2>Login</h2>
        <form method="post" class="login-form">
            <div class="form-group">
                <label>Username: <input type="text" name="username" required></label>
            </div>
            <div class="form-group">
                <label>Password: <input type="password" name="password" required></label>
            </div>
            <button type="submit">Login</button>
        </form>
        <?php if (isset($error)) echo "<p >$error</p>" ?>
        <p>Not a member? <a href="register.php">Register here</a></p>
    </div>

</body>

</html>