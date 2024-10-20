<?php
    session_start();
    require '../Database/config.php';

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit;
    }

    // Fetch user data
    $user = getUserData($_SESSION['user_id']);

    $title = "Student Record";

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit;
    }

    // Fetch user data with roles
    $user_id = $_SESSION['user_id']; // Assuming you have the user ID in session

    // Start: Fetch courses assigned to the instructor
    $sql = "SELECT course_instructor_assigned.*, courses.name AS course_name, courses.semester AS course_semester, courses.id AS course_id , courses.program AS course_program 
            FROM course_instructor_assigned 
            JOIN courses ON course_instructor_assigned.course_id = courses.id
            WHERE course_instructor_assigned.instructor_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $course_result = $stmt->get_result(); 
    $stmt->close();
    // End: Fetch courses assigned to the instructor

    $course_id = isset($_POST['course_id']) ? $_POST['course_id'] : null;

    $result = null;
    if ($course_id) {
        // Fetch registered users for the selected course
        $sql = "SELECT course_registration.*, users.*, courses.program AS course_program
                FROM course_registration
                JOIN users ON course_registration.user_id = users.id
                JOIN courses ON course_registration.course_id = courses.id
                WHERE course_registration.course_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    }

    $content = "../Instructor/students_record_content.php";
    include '../setting/_Layout.php';

?>