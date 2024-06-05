<?php
    require './config/db.php';

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $username = $_POST['username'];
        $password = password_hash($_POST["password"],PASSWORD_BCRYPT) ;

        $stmt = $pdo->prepare('INSERT INTO users (username,password) VALUES (?,?) ');
        $stmt->execute([$username,$password]);
        header("Location: login.php");
    }



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="./styles/register.css">
</head>

<body>
    <?php include 'templates/navbar.php'; ?>

    <div class="form-container">
        <h2>Register</h2>
        <form method="post" class="form">
            <div class="form-group">
                <label>Username: <input type="text" name="username" required></label>
            </div>
            <div class="form-group">
                <label>Password: <input type="password" name="password" required></label>
            </div>
            <button type="submit">Register</button>
            <p>Already a member? <a href="login.php">Login here</a></p>

        </form>
    </div>

</body>

</html>