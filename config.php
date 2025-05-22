<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$dbname = "blog";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Security function
function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>