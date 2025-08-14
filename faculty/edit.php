<?php
$pageTitle = "Edit Faculty";
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

$deptQuery = "SELECT * FROM department";
$deptStmt = executeQuery($deptQuery);
$departments = $deptStmt->fetchAll();
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Faculty</h2>
    <a href="list.php" class="btn btn-secondary">Back to List</a>
</div>

<div class="form-container">
    <form action="edit_process.php" method="post" class="needs-validation" novalidate>
        <input type="hidden" name="faculty_id" value="<?php echo $faculty['FACULTY_ID']; ?>">
        
        <div class="mb-3">
            <label for="faculty_fname" class="form-label required">First Name</label>
            <input type="text" class="form-control" id="faculty_fname" name="faculty_fname" value="<?php echo $faculty['FACULTY_FNAME']; ?>" required>
            <div class="invalid-feedback">Please enter a first name.</div>
        </div>
        
        <div class="mb-3">
            <label for="faculty_lname" class="form-label required">Last Name</label>
            <input type="text" class="form-control" id="faculty_lname" name="faculty_lname" value="<?php echo $faculty['FACULTY_LNAME']; ?>" required>
            <div class="invalid-feedback">Please enter a last name.</div>
        </div>
        
        <div class="mb-3">
            <label for="faculty_email" class="form-label required">Email</label>
            <input type="email" class="form-control" id="faculty_email" name="faculty_email" value="<?php echo $faculty['FACULTY_EMAIL']; ?>" required>
            <div class="invalid-feedback">Please enter a valid email address.</div>
        </div>
        
        <div class="mb-3">
            <label for="department_code" class="form-label required">Department</label>
            <select class="form-select" id="department_code" name="department_code" required>
                <option value="">Select Department</option>
                <?php foreach ($departments as $dept): ?>
                <option value="<?php echo $dept['DEPARTMENT_CODE']; ?>" <?php if ($dept['DEPARTMENT_CODE'] == $faculty['DEPARTMENT_CODE']) echo 'selected'; ?>><?php echo $dept['DEPARTMENT_NAME']; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Please select a department.</div>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Faculty</button>
        <a href="list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include_once '../includes/footer.php'; ?>