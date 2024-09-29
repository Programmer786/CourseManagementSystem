<?php
session_start();
require '../../Database/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO courses (name, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $description);
    $stmt->execute();
    $stmt->close();

    header("Location: ../courses.php");
    exit;
}
?>