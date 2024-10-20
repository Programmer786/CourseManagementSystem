<!-- Assignments Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Assignment Submissions</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table align-middle table-hover m-0 display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Assignment Title</th>
                        <th>Student</th>
                        <th>File</th>
                        <th>Submitted At</th>
                        <th>Total Marks</th>
                        <th>Obtained Marks</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result_submissions->num_rows > 0) {
                        while ($row = $result_submissions->fetch_assoc()) {
                            $file_path = '../assets/uploads/' . $row['file_path'];
                    ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['assignment_title']); ?></td>
                                <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                                <td>
                                    <?php if ($row['file_path'] && file_exists($file_path)) { ?>
                                        <a href="<?php echo htmlspecialchars($file_path); ?>" class="btn btn-sm btn-secondary" download>
                                            Download
                                        </a>
                                    <?php } else {
                                        echo 'File not available';
                                    } ?>
                                </td>
                                <td><?php echo htmlspecialchars($row['submitted_at']); ?></td>
                                <td><?php echo htmlspecialchars($row['total_marks']); ?></td>
                                <td><?php echo htmlspecialchars($row['obtained_marks']); ?></td>
                                <td>
                                    <?php if ($row['is_get_marks'] == 0) { ?>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#giveMarksModal" onclick="setGiveMarksModalData(<?php echo htmlspecialchars(json_encode($row)); ?>)">Give Marks</button>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="8">No assignments submitted.</td>
                        </tr>
                    <?php
                    }
                    $stmt_submissions->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Give Marks Modal -->
<div class="modal fade" id="giveMarksModal" tabindex="-1" aria-labelledby="giveMarksModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="giveMarksModalLabel">Give Marks</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="assignmentMarksForm" action="Controller/give_marks.php" method="POST">
                    <input type="hidden" name="action" value="give_marks">
                    <input type="hidden" name="assignment_id" id="assignmentId">
                    
                    <div class="mb-3">
                        <label for="totalMarks" class="form-label">Total Marks</label>
                        <input type="number" class="form-control" id="totalMarks" name="total_marks" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="obtainedMarks" class="form-label">Obtained Marks</label>
                        <input type="number" class="form-control" id="obtainedMarks" name="obtained_marks" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit Marks</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

function setGiveMarksModalData(assignment) {
    document.getElementById('assignmentId').value = assignment.id;
    document.getElementById('totalMarks').value = assignment.total_marks;
    document.getElementById('obtainedMarks').value = assignment.obtained_marks;
}

</script>

<?php
$conn->close();
?>
