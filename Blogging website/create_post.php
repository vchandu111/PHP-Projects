<?php
require './config/db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare('INSERT INTO posts (user_id,title,content) VALUES (?,?,?)');
    $stmt->execute([$user_id, $title, $content]);
    header("location: index.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="./styles/create_post.css">
</head>

<body>
    <?php include 'templates/navbar.php'; ?>

    <h2>Create Post</h2>
    <form method="post">
        <label>Title: <input type="text" name="title" required></label><br>
        <label>Content: <textarea name="content" required></textarea></label><br>
        <button type="submit">Create</button>
    </form>

</body>

</html>