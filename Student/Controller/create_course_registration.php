<?php
session_start();
require '../../Database/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'create') {
    $user_id = $_SESSION['user_id'];
    $course_id = $_POST['course_id'];

    // Check if the combination of course_id and user_id already exists
    $check_stmt = $conn->prepare("SELECT id FROM course_registration WHERE course_id = ? AND user_id = ?");
    $check_stmt->bind_param("ii", $course_id, $user_id);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // Combination already exists
        $_SESSION['message'] = "Course Registration already exists";
        $_SESSION['message_class'] = "alert-danger";
        header("Location: ../course_registration.php");
        exit();
    } else {
        // Combination does not exist, proceed with the insert
        $stmt = $conn->prepare("INSERT INTO course_registration (course_id, user_id, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("ii", $course_id, $user_id);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Course Registration created successfully";
            $_SESSION['message_class'] = "alert-success";
            header("Location: ../course_registration.php");
            exit();
        } else {
            $_SESSION['message'] = "Error creating Course Registration";
            $_SESSION['message_class'] = "alert-danger";
            header("Location: ../course_registration.php");
            exit();
        }

        $stmt->close();
    }

    $check_stmt->close();
}
$conn->close();
?>
