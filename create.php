<?php 
include 'config.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = clean_input($_POST['title']);
    $content = clean_input($_POST['content']);
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO posts (title, content, user_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $content, $user_id);
    $stmt->execute();
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST">
        <h2>Create New Post</h2>
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="content" placeholder="Content" required></textarea>
        <button type="submit">Publish</button>
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>