<?php
require './config/db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['_method'] === 'delete') {
    $post_id = $_POST['id'];
    $user_id = $_SESSION['user_id'] ?? null;

    if ($user_id) {
        // Check if the post belongs to the logged-in user
        $stmt = $pdo->prepare('SELECT * FROM posts WHERE id = ? AND user_id = ?');
        $stmt->execute([$post_id, $user_id]);
        $post = $stmt->fetch();

        if ($post) {
            // If post exists and belongs to the user, delete it
            $stmt = $pdo->prepare('DELETE FROM posts WHERE id = ?');
            $stmt->execute([$post_id]);
        }
    }
    header('Location: index.php');
    exit();
}



try {
    $stmt = $pdo->query('SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC');
    $posts = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log("Error fetching posts: ");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Page</title>
    <link rel="stylesheet" href="./styles/home.css">
</head>

<body>
    <!-- Navbar -->
    <?php include './templates/navbar.php'; ?>
    <!-- Blog Container -->
    <div class="container">
        <h2>Recent Posts</h2>

        <?php if (!empty($posts)) : ?>
            <?php foreach ($posts as $post) : ?>
                <div>
                    <h3>
                        <a href="/view_post.php?id=<?= $post['id'] ?>">
                            <?= ($post['title']); ?>
                        </a>
                    </h3>
                    <small>Published on <?= $post['created_at'] ?> by <?= $post['username'] ?></small>
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']) : ?>
                        <form action="index.php" method="POST">
                            <input type="hidden" name="_method" value="delete">
                            <input type="hidden" name="id" value="<?= $post['id'] ?>">
                            <input class="btn" type="submit" value="Delete" name="submit" onclick="return confirm('Are you sure you want to delete this post?');">
                        </form>
                    <?php endif; ?>
                </div>

            <?php endforeach; ?>
        <?php else : ?>
            <p>NO posts to display</p>
        <?php endif; ?>
    </div>

</body>

</html>