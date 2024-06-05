<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/nav.css">
</head>

<body>
    <nav>
        <div class="navbar">
            <a href="index.php" class="left">Home</a>
            <?php if (isset($_SESSION['user_id'])) : ?>

                <div class="right">
                    <a href="create_post.php">Create Post</a>
                    <a href="logout.php" class="button">Logout</a>
                </div>

            <?php else : ?>
                <div class="right">
                    <a href="register.php">Register</a>
                    <a href="login.php">Login</a>
                </div>
            <?php endif; ?>
        </div>
    </nav>
</body>

</html>