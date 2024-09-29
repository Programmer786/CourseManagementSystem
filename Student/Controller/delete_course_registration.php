<?php
session_start();
require '../../Database/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'delete') {
    $course_registration_id = $_POST['id'];

    // Delete the course registration
    $stmt = $conn->prepare("DELETE FROM course_registration WHERE id = ?");
    $stmt->bind_param("i", $course_registration_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Course Registration deleted successfully";
        $_SESSION['message_class'] = "alert-success";
        header("Location: ../course_registration.php");
        exit();
    } else {
        $_SESSION['message'] = "Error deleting Course Registration";
        $_SESSION['message_class'] = "alert-danger";
        header("Location: ../course_registration.php");
        exit();
    }

    $stmt->close();
}
$conn->close();
?>
