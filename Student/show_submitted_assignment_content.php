<!-- Row start -->
<div class="row">
    <div class="col-xxl-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table align-middle table-hover m-0 display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">Course Name</th>
                                <th scope="col">Title</th>
                                <th scope="col">Type</th>
                                <th scope="col">From Date</th>
                                <th scope="col">To Date</th>
                                <th scope="col">Total Marks</th>
                                <th scope="col">Obtained Marks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                                        <td><?php echo htmlspecialchars($row['type']); ?></td>
                                        <td><?php echo htmlspecialchars($row['from_date']); ?></td>
                                        <td><?php echo htmlspecialchars($row['to_date']); ?></td>
                                        <td><?php echo htmlspecialchars($row['total_marks']); ?></td>
                                        <td><?php echo htmlspecialchars($row['obtained_marks']); ?></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="7">No assignments or quizzes found.</td>
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


<!-- Row end -->

<?php
$conn->close();
?>

