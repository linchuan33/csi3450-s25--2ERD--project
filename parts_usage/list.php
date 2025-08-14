<?php
$pageTitle = "Parts Usage Forms";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$usageForms = [
    ['FORM_ID' => 1, 'MAINTENANCE_LOG_ID' => 1, 'VEHICLE_INFO' => 'Toyota Camry (sedan)', 'MECHANIC_NAME' => 'Mike Johnson', 'USAGE_DATE' => '2025-07-15', 'TOTAL_PARTS' => 2],
    ['FORM_ID' => 2, 'MAINTENANCE_LOG_ID' => 2, 'VEHICLE_INFO' => 'Subaru Outback (station wagon)', 'MECHANIC_NAME' => 'Sarah Williams', 'USAGE_DATE' => '2025-08-05', 'TOTAL_PARTS' => 3],
    ['FORM_ID' => 3, 'MAINTENANCE_LOG_ID' => 3, 'VEHICLE_INFO' => 'Honda Odyssey (minivan)', 'MECHANIC_NAME' => 'David Brown', 'USAGE_DATE' => '2025-08-20', 'TOTAL_PARTS' => 1]
];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Parts Usage Forms</h2>
    <a href="create.php" class="btn btn-success">Add New Usage Form</a>
</div>

<div class="table-container">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Maintenance Log</th>
                <th>Vehicle</th>
                <th>Mechanic</th>
                <th>Date</th>
                <th>Total Parts</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usageForms as $form): ?>
            <tr>
                <td><?php echo $form['FORM_ID']; ?></td>
                <td><?php echo $form['MAINTENANCE_LOG_ID']; ?></td>
                <td><?php echo $form['VEHICLE_INFO']; ?></td>
                <td><?php echo $form['MECHANIC_NAME']; ?></td>
                <td><?php echo $form['USAGE_DATE']; ?></td>
                <td><?php echo $form['TOTAL_PARTS']; ?></td>
                <td>
                    <a href="view.php?id=<?php echo $form['FORM_ID']; ?>" class="btn btn-sm btn-info btn-action">View</a>
                    <a href="edit.php?id=<?php echo $form['FORM_ID']; ?>" class="btn btn-sm btn-warning btn-action">Edit</a>
                    <a href="delete.php?id=<?php echo $form['FORM_ID']; ?>" class="btn btn-sm btn-danger btn-action" onclick="return confirmDelete('parts usage form', <?php echo $form['FORM_ID']; ?>)">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once '../includes/footer.php'; ?>
