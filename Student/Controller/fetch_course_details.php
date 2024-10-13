<?php
require '../../Database/config.php';

if (isset($_GET['course_id'])) {
    $course_id = (int)$_GET['course_id'];

    // Fetch course details
    $sql = "SELECT * FROM courses WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $course = $result->fetch_assoc();
        // Return the course details as JSON
        echo json_encode($course);
    } else {
        // If no course is found, return an error message
        echo json_encode(['error' => 'Course not found']);
    }

    $stmt->close();
}

$conn->close();
?>
