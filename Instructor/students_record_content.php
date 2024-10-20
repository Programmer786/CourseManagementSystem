<!-- Row start -->
<form method="POST" action="students_record.php">
    <div class="row">
        <div class="col-xxl-12">
            <div class="card mb-4">
                <div class="card-body mb-3">
                    <div class="col-md-4">
                        <label for="createCourseId" class="form-label">Search Class By Course</label>
                        <select class="form-control" id="createCourseId" name="course_id" required>
                            <?php
                            while ($course = $course_result->fetch_assoc()) {
                                echo "<option value=\"" . htmlspecialchars($course['course_id']) . "\">" . htmlspecialchars($course['course_name']) . "(" . htmlspecialchars($course['course_semester']). ")" . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Row end -->

<!-- Row start for displaying registered users -->
<div class="row">
    <div class="col-xxl-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table align-middle table-hover m-0 display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">Roll No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Session</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                                        <td><?php echo htmlspecialchars($row['student_semester']); ?></td>
                                        <td><?php echo htmlspecialchars($row['student_session']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="7">No users found.</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row end for displaying registered users -->


<?php
$conn->close();
?>