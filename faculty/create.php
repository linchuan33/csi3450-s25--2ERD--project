<?php
$pageTitle = "Faculty List";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$faculty = [
    ['FACULTY_ID' => 1, 'FACULTY_LNAME' => 'Smith', 'FACULTY_FNAME' => 'John', 'DEPARTMENT_CODE' => 'CS'],
    ['FACULTY_ID' => 2, 'FACULTY_LNAME' => 'Johnson', 'FACULTY_FNAME' => 'Mary', 'DEPARTMENT_CODE' => 'ENG'],
    ['FACULTY_ID' => 3, 'FACULTY_LNAME' => 'Williams', 'FACULTY_FNAME' => 'Robert', 'DEPARTMENT_CODE' => 'MATH']
];
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
            <?php foreach ($faculty as $member): ?>
            <tr>
                <td><?php echo $member['FACULTY_ID']; ?></td>
                <td><?php echo $member['FACULTY_LNAME']; ?></td>
                <td><?php echo $member['FACULTY_FNAME']; ?></td>
                <td><?php echo $member['DEPARTMENT_CODE']; ?></td>
                <td>
                    <a href="view.php?id=<?php echo $member['FACULTY_ID']; ?>"