<?php
include 'config.php';

$title = $_POST['title'];
$content = $_POST['content'];

$sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
mysqli_query($conn, $sql);

header("Location: index.php"); // Redirect back
?>