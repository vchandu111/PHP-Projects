<?php
require './config/db.php';
$post_id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM posts where id=?');
$stmt->execute([$post_id]);
$post = $stmt->fetch();




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/view_post.css">
</head>

<body>
    <?php include 'templates/navbar.php' ?>
    <div class="post-container">
        <h2 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h2>
        <div class="post-content"><?php echo nl2br(htmlspecialchars($post['content'])); ?></div>
        <p class="back-link"><a href="index.php">← Back to Home</a></p>
    </div>
</body>

</html>