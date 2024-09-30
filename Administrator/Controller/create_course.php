<?php
session_start();
require '../../Database/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $program = $_POST['program'];
    $semester = $_POST['semester'];
    $credit_hour = $_POST['credit_hour'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO courses (code, name, type, program, semester, credit_hour, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssis", $code, $name, $type, $program, $semester, $credit_hour, $description);
    $stmt->execute();
    $stmt->close();

    header("Location: ../courses.php");
    exit;
}
?>
