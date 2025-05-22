<?php 
include 'config.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Verify post ownership
if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $_GET['id'], $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();

    if (!$post) {
        header("Location: index.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = clean_input($_POST['title']);
    $content = clean_input($_POST['content']);
    $id = clean_input($_POST['id']);

    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ssii", $title, $content, $id, $_SESSION['user_id']);
    $stmt->execute();
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST">
        <h2>Edit Post</h2>
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
        <input type="text" name="title" value="<?php echo $post['title']; ?>" required>
        <textarea name="content" required><?php echo $post['content']; ?></textarea>
        <button type="submit">Update</button>
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>