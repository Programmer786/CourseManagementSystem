<style>
    .table-responsive {
    overflow-x: auto;
}

.table {
    white-space: nowrap;
}

.card {
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

</style>
<!-- Row starts -->
<div class="row">
    <div class="col-xxl-3 col-sm-6 col-12">
        <div class="card mb-4">
            <div class="card-body d-flex align-items-center p-0">
                <div class="p-4">
                    <i class="bi bi-bookmark-check fs-1 lh-1 text-primary"></i>
                </div>
                <div class="py-4">
                    <h5 class="text-secondary fw-light m-0">Assigned Courses</h5>
                    <h1 class="m-0"><?php echo htmlspecialchars($total_courses); ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-6 col-12">
        <div class="card mb-4">
            <div class="card-body d-flex align-items-center p-0">
                <div class="p-4">
                    <i class="bi bi-person-check fs-1 lh-1 text-primary"></i>
                </div>
                <div class="py-4">
                    <h5 class="text-secondary fw-light m-0">Total Students</h5>
                    <h1 class="m-0"><?php echo htmlspecialchars($total_students); ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-6 col-12">
        <div class="card mb-4">
            <div class="card-body d-flex align-items-center p-0">
                <div class="p-4">
                    <i class="bi bi-file-earmark-text fs-1 lh-1 text-primary"></i>
                </div>
                <div class="py-4">
                    <h5 class="text-secondary fw-light m-0">Total Assignments</h5>
                    <h1 class="m-0"><?php echo htmlspecialchars($total_assignments); ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-6 col-12">
        <div class="card mb-4">
            <div class="card-body d-flex align-items-center p-0">
                <div class="p-4">
                    <i class="bi bi-question-circle fs-1 lh-1 text-primary"></i>
                </div>
                <div class="py-4">
                    <h5 class="text-secondary fw-light m-0">Total Quizzes</h5>
                    <h1 class="m-0"><?php echo htmlspecialchars($total_quizzes); ?></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row ends -->

<!-- Table for displaying all assigned courses -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Courses Assigned to You</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Course ID</th>
                                <th scope="col">Course Code</th>
                                <th scope="col">Course Name</th>
                                <th scope="col">Program</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Credit Hours</th>
                                <th scope="col">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($course_details_result->num_rows > 0) { 
                                while ($row = $course_details_result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['code']); ?></td>
                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['program']); ?></td>
                                        <td><?php echo htmlspecialchars($row['semester']); ?></td>
                                        <td><?php echo htmlspecialchars($row['credit_hour']); ?></td>
                                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                                    </tr>
                                <?php } 
                            } else { ?>
                                <tr>
                                    <td colspan="7" class="text-center">No courses assigned to you yet.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
