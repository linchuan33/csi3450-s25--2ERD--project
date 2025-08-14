<?php
$pageTitle = "Maintenance Logs";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$maintenanceLogs = [
    ['LOG_ID' => 1, 'VEHICLE_ID' => 1, 'VEHICLE_INFO' => 'Toyota Camry (sedan)', 'MAINTENANCE_DESCRIPTION' => 'Oil change and tire rotation', 'INITIAL_LOG_ENTRY_DATE' => '2025-07-15', 'COMPLETION_DATE' => '2025-07-16', 'MECHANIC_NAME' => 'Mike Johnson', 'STATUS' => 'Completed'],
    ['LOG_ID' => 2, 'VEHICLE_ID' => 3, 'VEHICLE_INFO' => 'Subaru Outback (station wagon)', 'MAINTENANCE_DESCRIPTION' => 'Brake pad replacement', 'INITIAL_LOG_ENTRY_DATE' => '2025-08-05', 'COMPLETION_DATE' => '2025-08-06', 'MECHANIC_NAME' => 'Sarah Williams', 'STATUS' => 'Completed'],
    ['LOG_ID' => 3, 'VEHICLE_ID' => 2, 'VEHICLE_INFO' => 'Honda Odyssey (minivan)', 'MAINTENANCE_DESCRIPTION' => 'Check engine light diagnosis', 'INITIAL_LOG_ENTRY_DATE' => '2025-08-20', 'COMPLETION_DATE' => null, 'MECHANIC_NAME' => null, 'STATUS' => 'In Progress']
];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Maintenance Logs</h2>
    <a href="create.php" class="btn btn-success">Add New Maintenance Log</a>
</div>

<div class="table-container">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Vehicle</th>
                <th>Description</th>
                <th>Entry Date</th>
                <th>Completion Date</th>
                <th>Mechanic</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($maintenanceLogs as $log): ?>
            <tr>
                <td><?php echo $log['LOG_ID']; ?></td>
                <td><?php echo $log['VEHICLE_INFO']; ?></td>
                <td><?php echo $log['MAINTENANCE_DESCRIPTION']; ?></td>
                <td><?php echo $log['INITIAL_LOG_ENTRY_DATE']; ?></td>
                <td><?php echo $log['COMPLETION_DATE'] ?? 'Not completed'; ?></td>
                <td><?php echo $log['MECHANIC_NAME'] ?? 'Not assigned'; ?></td>
                <td>
                    <span class="badge <?php echo $log['STATUS'] == 'Completed' ? 'bg-success' : 'bg-warning'; ?>">
                        <?php echo $log['STATUS']; ?>
                    </span>
                </td>
                <td>
                    <a href="view.php?id=<?php echo $log['LOG_ID']; ?>" class="btn btn-sm btn-info btn-action">View</a>
                    <a href="edit.php?id=<?php echo $log['LOG_ID']; ?>" class="btn btn-sm btn-warning btn-action">Edit</a>
                    <a href="delete.php?id=<?php echo $log['LOG_ID']; ?>" class="btn btn-sm btn-danger btn-action" onclick="return confirmDelete('maintenance log', <?php echo $log['LOG_ID']; ?>)">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once '../includes/footer.php'; ?>