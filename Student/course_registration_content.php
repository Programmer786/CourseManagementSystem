<!-- Row start -->
<div class="row">
    <div class="col-xxl-12">
        <div class="card mb-4">
            <div class="card-body">
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createCourseRegistrationModal">Course Registration</button>
                <div class="table-responsive">
                    <table id="example" class="table align-middle table-hover m-0 display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">Course Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                    <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                        <td>
                                            <!-- <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editCourseRegistrationModal" onclick="setEditModalData(<?php echo htmlspecialchars(json_encode($row)); ?>)"><i class="bi bi-pencil"></i></button> -->
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCourseRegistrationModal" onclick="setDeleteModalData(<?php echo $row['id']; ?>)"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                            ?>
                                <tr>
                                    <td colspan="3">No Course Registration found.</td>
                                </tr>
                            <?php
                            }
                            $stmt->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row end -->

<!-- Course Registration Modal -->
<div class="modal fade" id="createCourseRegistrationModal" tabindex="-1" aria-labelledby="createCourseRegistrationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Enlarged the modal for better visibility -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCourseRegistrationModalLabel">Create Course Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createCourseRegistrationForm" action="Controller/create_course_registration.php" method="POST">
                    <input type="hidden" name="action" value="create">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="createCourseId" class="form-label">Select Course</label>
                                <select class="form-control" id="createCourseId" name="course_id" required onchange="fetchCourseDetails(this.value)">
                                    <option value="" selected disabled>Please Select Course</option>
                                    <?php
                                        $course_sql = "SELECT id, name FROM courses";
                                        $course_stmt = $conn->prepare($course_sql);
                                        // $course_stmt->bind_param("s", $user['student_semester']); // Bind as string
                                        $course_stmt->execute();
                                        $course_result = $course_stmt->get_result();
                                        while ($course = $course_result->fetch_assoc()) {
                                            echo "<option value=\"" . htmlspecialchars($course['id']) . "\">" . htmlspecialchars($course['name']) . "</option>";
                                        }
                                        $course_stmt->close();
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Custom designed card for displaying course details -->
                            <div id="courseDetails" class="card shadow-sm border-light mb-3" style="display: none;"> <!-- Initially hidden -->
                                <div class="card-header text-white bg-info">
                                    <h6 class="mb-0">Course Information</h6>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li><strong>Course Code:</strong> <span id="courseCode">N/A</span></li>
                                        <li><strong>Course Name:</strong> <span id="courseName">N/A</span></li>
                                        <li><strong>Program:</strong> <span id="courseProgram">N/A</span></li>
                                        <li><strong>Semester:</strong> <span id="courseSemester">N/A</span></li>
                                        <li><strong>Credit Hours:</strong> <span id="courseCreditHours">N/A</span></li>
                                        <li><strong>Description:</strong> <span id="courseDescription">N/A</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">Create Course Registration</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Edit Course Registration Modal -->
<div class="modal fade" id="editCourseRegistrationModal" tabindex="-1" aria-labelledby="editCourseRegistrationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCourseRegistrationModalLabel">Edit Course Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCourseRegistrationForm" action="Controller/edit_course_registration.php" method="POST">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="editCourseRegistrationId">
                    <div class="mb-3">
                        <label for="editCourseId" class="form-label">Course</label>
                        <select class="form-control" id="editCourseId" name="course_id" required>
                            <?php
                            $course_sql = "SELECT id, name FROM courses";
                            $course_result = $conn->query($course_sql);
                            while ($course = $course_result->fetch_assoc()) {
                                echo "<option value=\"" . htmlspecialchars($course['id']) . "\">" . htmlspecialchars($course['name']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Course Registration Modal -->
<div class="modal fade" id="deleteCourseRegistrationModal" tabindex="-1" aria-labelledby="deleteCourseRegistrationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCourseRegistrationModalLabel">Delete Course Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Course Registration?</p>
            </div>
            <div class="modal-footer">
                <form id="deleteCourseRegistrationForm" action="Controller/delete_course_registration.php" method="POST">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" id="deleteCourseRegistrationId">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function fetchCourseDetails(courseId) {
        if (courseId) {
            // Perform an AJAX request to get the course details based on the selected course ID
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'Controller/fetch_course_details.php?course_id=' + courseId, true);

            xhr.onload = function() {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);

                    // Show the course details card
                    document.getElementById('courseDetails').style.display = 'block';

                    // Populate the course details
                    document.getElementById('courseCode').innerText = response.code || 'N/A';
                    document.getElementById('courseName').innerText = response.name || 'N/A';
                    document.getElementById('courseProgram').innerText = response.program || 'N/A';
                    document.getElementById('courseSemester').innerText = response.semester || 'N/A';
                    document.getElementById('courseCreditHours').innerText = response.credit_hour || 'N/A';
                    document.getElementById('courseDescription').innerText = response.description || 'N/A';
                }
            };

            xhr.send();
        }
    }

    function setEditModalData(course_registration) {
        document.getElementById('editCourseRegistrationId').value = course_registration.id;
        document.getElementById('editCourseId').value = course_registration.course_id;
    }

    function setDeleteModalData(id) {
        document.getElementById('deleteCourseRegistrationId').value = id;
    }
</script>

<?php
$conn->close();
?>
