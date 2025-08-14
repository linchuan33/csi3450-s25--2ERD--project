<?php
$pageTitle = "View Faculty";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$query = "SELECT * FROM faculty WHERE FACULTY_ID = ?";
$stmt = executeQuery($query, [$id]);
$faculty = $stmt->fetch();

if (!$faculty) {
    header("Location: list.php");
    exit;
}

$deptQuery = "SELECT DEPARTMENT_NAME FROM department WHERE DEPARTMENT_CODE = ?";
$deptStmt = executeQuery($deptQuery, [$faculty['DEPARTMENT_CODE']]);
$department = $deptStmt->fetch();
$departmentName = $department ? $department['DEPARTMENT_NAME'] : $faculty['DEPARTMENT_CODE'];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Faculty Details</h2>
    <div>
        <a href="edit.php?id=<?php echo $faculty['FACULTY_ID']; ?>" class="btn btn-warning">Edit</a>
        <a href="list.php" class="btn btn-secondary">Back to List</a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Faculty ID: <?php echo $faculty['FACULTY_ID']; ?>
    </div>
    <div class="card-body">
        <h5 class="card-title"><?php echo $faculty['FACULTY_FNAME'] . ' ' . $faculty['FACULTY_LNAME']; ?></h5>
        <p class="card-text"><strong>Email:</strong> <?php echo $faculty['FACULTY_EMAIL']; ?></p>
        <p class="card-text"><strong>Department:</strong> <?php echo $departmentName; ?> (<?php echo $faculty['DEPARTMENT_CODE']; ?>)</p>
    </div>
</div>

<div class="mt-4">
    <h3>Recent Reservations</h3>
    <p>No recent reservations found.</p>
</div>

<?php include_once '../includes/footer.php'; ?>