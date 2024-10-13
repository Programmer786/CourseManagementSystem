<!-- Start DataTables Code .css -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

<style>
    /* Custom button styles */
    .dt-buttons .dt-button {
        margin: 0 5px;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: bold;
        color: #fff;
        background-color: #007bff;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }
    .dt-buttons .dt-button:hover {
        background-color: #0056b3;
    }
    .dt-buttons .dt-button.print {
        background-color: #28a745;
    }
    .dt-buttons .dt-button.print:hover {
        background-color: #218838;
    }
    .dt-buttons .dt-button.excel {
        background-color: #007bff;
    }
    .dt-buttons .dt-button.excel:hover {
        background-color: #0056b3;
    }
</style>
<!-- End Data Table Code .css -->

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

    $title = "Lecture Materials";

    // Fetch course_registration
    $user_id = $_SESSION['user_id']; // Assuming you have the user ID in session

    // Get the current date in the format 'YYYY-MM-DD'
    $current_date = date('Y-m-d');

    $sql = "SELECT course_registration.*, courses.name AS course_name, courses.description AS course_description, 
            deadline_materials.title, deadline_materials.type, deadline_materials.content, deadline_materials.file_path, 
            deadline_materials.from_date, deadline_materials.to_date
            FROM course_registration 
            JOIN courses ON course_registration.course_id = courses.id
            JOIN deadline_materials ON course_registration.course_id = deadline_materials.course_id
            WHERE course_registration.user_id = ? AND deadline_materials.to_date >= ? AND deadline_materials.type = 'lecture'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $user_id, $current_date); // 'i' for integer, 's' for string
    $stmt->execute();
    $result = $stmt->get_result();   

    $content = "../Student/show_deadline_materials_lecture_content.php";
    include '../setting/_Layout.php';
?>

<!-- Start: the below for datatable -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Export to Excel',
                    className: 'btn btn-excel'
                },
                {
                    extend: 'print',
                    text: 'Print',
                    className: 'btn btn-print'
                }
            ],
            scrollX: true,
            pageLength: 100,
            lengthMenu: [ [100, 200, 300, 400, 500], [100, 200, 300, 400, 500] ]
        });
    });
</script>
<!-- End: the below for datatable -->