<?php
session_start();
require 'Database/config.php';

// Fetch roles from the database
$roles_result = $conn->query("SELECT * FROM roles");
$roles = [];
while ($row = $roles_result->fetch_assoc()) {
    $roles[] = $row;
}

$message = '';
$message_class = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role_id = $_POST['role_id'];
    $department = $_POST['department'];
    $instructor_education = $_POST['instructor_education'];
    $student_semester = $_POST['student_semester'];

    // Validate inputs
    if (empty($username) || empty($email) || empty($password) || empty($role_id)) {
        $message = 'All fields are required.';
        $message_class = 'alert-danger';
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = 'Email is already registered.';
            $message_class = 'alert-danger';
        } else {
            $stmt->close();

            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (username, email, department, instructor_education, student_semester, password, role_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssi", $username, $email, $department, $instructor_education, $student_semester, $password, $role_id);
            if ($stmt->execute()) {
                $message = 'Registration successful!';
                $message_class = 'alert-success';
            } else {
                $message = 'Registration failed. Please try again.';
                $message_class = 'alert-danger';
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Templates - Dashboard Templates - Venus Admin Template</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
    <meta name="author" content="Bootstrap Gallery" />
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    <meta property="og:url" content="https://www.bootstrap.gallery">
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">
    <link rel="shortcut icon" href="assets/images/favicon.svg" />

    <!-- *************
        ************ CSS Files *************
    ************* -->
    <link rel="stylesheet" href="assets/fonts/bootstrap/bootstrap-icons.css" />
    <link rel="stylesheet" href="assets/css/main.min.css" />
</head>
<body class="bg-white">
    <!-- Container start -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-5 col-sm-6 col-12">
                <form action="register.php" method="POST" class="my-5">
                    <div class="border border-light rounded-2 p-4 mt-5">
                        <div class="login-form">
                            <h2 class="fw-semibold mb-4" style="text-align: center;">Create your account</h2>
                            <?php if ($message): ?>
                                <div class="alert <?php echo $message_class; ?>"><?php echo $message; ?></div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Enter your username" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter your email" required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" placeholder="Enter password" required/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select class="form-select" id="role_id" name="role_id" required>
                                    <option value="" disabled selected>Select a role</option>
                                    <?php foreach ($roles as $role): ?>
                                        <option value="<?php echo $role['id']; ?>"><?php echo htmlspecialchars($role['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                            <label class="form-label">Department</label>
                            <input type="text" class="form-control" name="department" placeholder="Like Computer Science" value="Computer Science" required/>
                            </div>
                            <div class="mb-3">
                            <label class="form-label">Highest Education</label>
                            <input type="text" class="form-control" name="instructor_education" placeholder="Education For Instructor Only" value=""/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Current Semester (Student Only)</label>
                                <select class="form-control" id="editSemester" name="student_semester" required>
                                    <option class="bg-warning" value="" selected>None</option>
                                    <option value="Semester 1">Semester 1</option>
                                    <option value="Semester 2">Semester 2</option>
                                    <option value="Semester 3">Semester 3</option>
                                    <option value="Semester 4">Semester 4</option>
                                    <option value="Semester 5">Semester 5</option>
                                    <option value="Semester 6">Semester 6</option>
                                    <option value="Semester 7">Semester 7</option>
                                    <option value="Semester 8">Semester 8</option>
                                </select>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check m-0">
                                    <input class="form-check-input" type="checkbox" value="1" id="termsConditions" required />
                                    <label class="form-check-label" for="termsConditions">I agree to the terms and conditions</label>
                                </div>
                            </div>
                            <div class="d-grid py-3 mt-2">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    Signup
                                </button>
                            </div>
                            <div class="text-center pt-4">
                                <span>Already have an account?</span>
                                <a href="index.php" class="text-blue text-decoration-underline ms-2">Login</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Container end -->
</body>
</html>
