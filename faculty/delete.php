<?php
$pageTitle = "Delete Faculty";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$faculty = [
    'FACULTY_ID' => 1,
    'FACULTY_LNAME' => 'Smith',
    'FACULTY_FNAME' => 'John',
    'FACULTY_EMAIL' => 'jsmith@tinycollege.edu',
    'DEPARTMENT_CODE' => 'CS',
    'DEPARTMENT_NAME' => 'Computer Science'
];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Confirm Delete</h2>
    <a href="list.php" class="btn btn-secondary">Back to List</a>
</div>

<div class="alert alert-danger">
    <h4>Are you sure you want to delete this faculty member?</h4>
    <p>This action cannot be undone.</p>
</div>

<div class="card mb-4">
    <div class="card-header">
        Faculty ID: <?php echo $faculty['FACULTY_ID']; ?>
    </div>
    <div class="card-body">
        <h5 class="card-title"><?php echo $faculty['FACULTY_FNAME'] . ' ' . $faculty['FACULTY_LNAME']; ?></h5>
        <p class="card-text"><strong>Email:</strong> <?php echo $faculty['FACULTY_EMAIL']; ?></p>
        <p class="card-text"><strong>Department:</strong> <?php echo $faculty['DEPARTMENT_NAME']; ?> (<?php echo $faculty['DEPARTMENT_CODE']; ?>)</p>
    </div>
</div>

<form action="delete_process.php" method="post">
    <input type="hidden" name="faculty_id" value="<?php echo $faculty['FACULTY_ID']; ?>">
    <button type="submit" class="btn btn-danger">Confirm Delete</button>
    <a href="list.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include_once '../includes/footer.php'; ?>