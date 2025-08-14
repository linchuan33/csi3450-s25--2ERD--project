<?php
$pageTitle = "Faculty List";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$query = "SELECT * FROM faculty";
$stmt = executeQuery($query);
$faculty = $stmt->fetchAll();
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Faculty List</h2>
    <a href="create.php" class="btn btn-success">Add New Faculty</a>
</div>

<div class="table-container">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($faculty) > 0): ?>
                <?php foreach ($faculty as $member): ?>
                <tr>
                    <td><?php echo $member['FACULTY_ID']; ?></td>
                    <td><?php echo $member['FACULTY_LNAME']; ?></td>
                    <td><?php echo $member['FACULTY_FNAME']; ?></td>
                    <td><?php echo $member['DEPARTMENT_CODE']; ?></td>
                    <td>
                        <a href="view.php?id=<?php echo $member['FACULTY_ID']; ?>" class="btn btn-sm btn-info btn-action">View</a>
                        <a href="edit.php?id=<?php echo $member['FACULTY_ID']; ?>" class="btn btn-sm btn-warning btn-action">Edit</a>
                        <a href="delete.php?id=<?php echo $member['FACULTY_ID']; ?>" class="btn btn-sm btn-danger btn-action" onclick="return confirmDelete('faculty', <?php echo $member['FACULTY_ID']; ?>)">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No faculty members found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include_once '../includes/footer.php'; ?>