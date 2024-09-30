<?php
session_start();
require '../../Database/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $id = $_POST['id'];
    $code = $_POST['code'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $program = $_POST['program'];
    $semester = $_POST['semester'];
    $credit_hour = $_POST['credit_hour'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE courses SET code=?, name=?, type=?, program=?, semester=?, credit_hour=?, description=? WHERE id=?");
    $stmt->bind_param("sssssisi", $code, $name, $type, $program, $semester, $credit_hour, $description, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: ../courses.php");
    exit;
}
?>
