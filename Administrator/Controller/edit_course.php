<?php
session_start();
require '../../Database/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE courses SET name=?, description=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $description, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: ../courses.php");
    exit;
}
?>
