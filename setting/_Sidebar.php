<?php
// Determine role title
$roleTitle = '';
switch ($_SESSION['role_id']) {
    case 1:
        $roleTitle = 'Student';
        break;
    case 2:
        $roleTitle = 'Instructor';
        break;
    case 3:
        $roleTitle = 'Administrator';
        break;
    default:
        $roleTitle = 'User'; // Default title if role_id is not recognized
        break;
}
?>

<!-- Sidebar wrapper start -->
<nav id="sidebar" class="sidebar-wrapper">

    <!-- App brand starts -->
    <div class="app-brand p-4">
        <a href="index.html">
            <h2 class="text-white"><span><?php echo htmlspecialchars($roleTitle); ?></span></h2>
        </a>
    </div>
    <!-- App brand ends -->



    <!-- Sidebar menu starts -->
    <div class="sidebarMenuScroll">
        <ul class="sidebar-menu">
            <li class="active current-page">
                <?php 
                if ($_SESSION['role_id'] == 3) { 
                    ?>
                    <a href="../Administrator/admin_dashboard.php">
                        <i class="bi bi-pie-chart"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                    <?php 
                } elseif ($_SESSION['role_id'] == 2) { 
                    ?>
                    <a href="../Instructor/instructor_dashboard.php">
                        <i class="bi bi-pie-chart"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                    <?php 
                } elseif ($_SESSION['role_id'] == 1) { 
                    ?>
                    <a href="../Student/student_dashboard.php">
                        <i class="bi bi-pie-chart"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                    <?php 
                } else { 
                    header("Location: logout.php");
                    exit; 
                }
                ?>
            </li>
            
    <?php 
        if ($_SESSION['role_id'] == 3) { 
            ?>
            <li>
                <a href="user.php">
                    <i class="bi bi-bar-chart-line"></i>
                    <span class="menu-text">Users</span>
                </a>
            </li>
            <li>
                <a href="../Administrator/courses.php">
                    <i class="bi bi-ui-checks-grid"></i>
                    <span class="menu-text">Courses</span>
                </a>
            </li>
            <li>
                <a href="../Administrator/courses_assign.php">
                    <i class="bi bi-arrow-up-square"></i>
                    <span class="menu-text">Courses Assign</span>
                </a>
            </li>
            <li>
                <a href="../Administrator/students_record.php">
                    <i class="bi bi-person-badge"></i>
                    <span class="menu-text">Student Record</span>
                </a>
            </li>
    <?php } ?>
    <?php 
    if ($_SESSION['role_id'] == 2) { 
    ?>
        <li>
            <a href="../Instructor/deadline_materials_lecture.php">
                <i class="bi bi-book"></i>
                <span class="menu-text">Deadline Lecture Materials</span>
            </a>
        </li>
        <li>
            <a href="../Instructor/deadline_materials_assignment.php">
                <i class="bi bi-pencil-square"></i>
                <span class="menu-text">Deadline Assignment Materials</span>
            </a>
        </li>
        <li>
            <a href="../Instructor/deadline_materials_quiz.php">
                <i class="bi bi-question-circle"></i>
                <span class="menu-text">Quiz Materials</span>
            </a>
        </li>
        <li>
            <a href="../Instructor/course_materials.php">
                <i class="bi bi-arrow-up-square"></i>
                <span class="menu-text">Course Materials</span>
            </a>
        </li>
        <li>
            <a href="../Instructor/students_record.php">
                <i class="bi bi-person-badge"></i>
                <span class="menu-text">Student Record</span>
            </a>
        </li>
        <li>
            <a href="../Instructor/show_submitted_assignments.php">
                <i class="bi bi-shield-fill-check"></i>
                <span class="menu-text">Show Submitted Assignments</span>
            </a>
        </li>
    <?php } ?>

    <?php 
        if ($_SESSION['role_id'] == 1) { 
            ?>
            <li>
                <a href="../Student/course_registration.php">
                    <i class="bi bi-slash-square"></i>
                    <span class="menu-text">Course Registration</span>
                </a>
            </li>
            <li>
                <a href="../Student/show_deadline_materials_lecture.php">
                    <i class="bi bi-book"></i>
                    <span class="menu-text">Show Deadline Lecture Materials</span>
                </a>
            </li>
            <li>
                <a href="../Student/show_deadline_materials_assignment.php">
                    <i class="bi bi-pencil-square"></i>
                    <span class="menu-text">Show Deadline Assignment Materials</span>
                </a>
            </li>
            <li>
                <a href="../Student/show_deadline_materials_quiz.php">
                    <i class="bi bi-question-circle"></i>
                    <span class="menu-text">Show Deadline Quiz Materials</span>
                </a>
            </li>
            <li>
                <a href="../Student/show_course_materials.php">
                    <i class="bi bi-arrow-down-square-fill"></i>
                    <span class="menu-text">Show Course Materials</span>
                </a>
            </li>
            <li>
                <a href="../Student/submit_assignment.php">
                    <i class="bi bi-smartwatch"></i>
                    <span class="menu-text">Submit Assignment/Quiz</span>
                </a>
            </li>
            <li>
                <a href="../Student/show_submitted_assignment.php">
                    <i class="bi bi-smartwatch"></i>
                    <span class="menu-text">Show Assignment/Quiz Marks</span>
                </a>
            </li>
    <?php } ?>
        </ul>
    </div>

    <!-- Sidebar menu ends -->

</nav>
<!-- Sidebar wrapper end -->