<!-- Row start -->
<div class="row">
    <div class="col-xxl-12">
        <div class="card mb-4">
            <div class="card-body">
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createCourseRegistrationModal">Create Course Registration</button>
                <div class="table-responsive">
                    <table class="table align-middle table-hover m-0">
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

<!-- Create Course Registration Modal -->
<div class="modal fade" id="createCourseRegistrationModal" tabindex="-1" aria-labelledby="createCourseRegistrationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCourseRegistrationModalLabel">Create Course Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createCourseRegistrationForm" action="Controller/create_course_registration.php" method="POST">
                    <input type="hidden" name="action" value="create">
                    <div class="mb-3">
                        <label for="createCourseId" class="form-label">Course </label>
                        <select class="form-control" id="createCourseId" name="course_id" required>
                        <?php
                            $course_sql = "SELECT id, name FROM courses WHERE semester = ?";
                            $course_stmt = $conn->prepare($course_sql);
                            $course_stmt->bind_param("s", $user['student_semester']); // Bind as string
                            $course_stmt->execute();
                            $course_result = $course_stmt->get_result();
                            while ($course = $course_result->fetch_assoc()) {
                                echo "<option value=\"" . htmlspecialchars($course['id']) . "\">" . htmlspecialchars($course['name']) . "</option>";
                            }
                            $course_stmt->close();
                        ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Course Registration</button>
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
