<?php 
include 'config.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog Posts</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <a href="logout.php">Logout</a>
    </header>

    <a href="create.php">Create New Post</a>

    <?php
    $stmt = $conn->prepare("SELECT * FROM posts ORDER BY created_at DESC");
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()):
    ?>
        <div class="post">
            <h2><?php echo $row['title']; ?></h2>
            <p><?php echo nl2br($row['content']); ?></p>
            <small>Posted on: <?php echo $row['created_at']; ?></small>
            <div class="actions">
                <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>" 
                   onclick="return confirm('Delete this post?')">Delete</a>
            </div>
        </div>
    <?php endwhile; ?>
</body>
</html>