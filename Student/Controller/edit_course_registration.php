<?php
session_start();
require '../../Database/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'update') {
    $course_registration_id = $_POST['id'];
    $course_id = $_POST['course_id'];
    $user_id = $_SESSION['user_id'];

    // Update the course registration
    $stmt = $conn->prepare("UPDATE course_registration SET course_id = ?, user_id = ? WHERE id = ?");
    $stmt->bind_param("iii", $course_id, $user_id, $course_registration_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Course Registration updated successfully";
        $_SESSION['message_class'] = "alert-success";
        header("Location: ../course_registration.php");
        exit();
    } else {
        $_SESSION['message'] = "Error updating Course Registration";
        $_SESSION['message_class'] = "alert-danger";
        header("Location: ../course_registration.php");
        exit();
    }

    $stmt->close();
}
$conn->close();
?>
