<?php
session_start();
require '../../Database/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $program = $_POST['program'];
    $semester = $_POST['semester'];
    $session = $_POST['session'];  // Capture session input
    $credit_hour = (int)$_POST['credit_hour'];
    $description = $_POST['description'];

    // Check if session is being passed correctly
    error_log("Session value: " . $session);  // Log for debugging

    $stmt = $conn->prepare("INSERT INTO courses (code, name, type, program, semester, session, credit_hour, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssis", $code, $name, $type, $program, $semester, $session, $credit_hour, $description);
    $stmt->execute();
    $stmt->close();

    header("Location: ../courses.php");
    exit;
}
?>
