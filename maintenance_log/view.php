<?php
$pageTitle = "View Maintenance Log";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$log = [
    'LOG_ID' => 1,
    'VEHICLE_ID' => 1,
    'VEHICLE_INFO' => 'Toyota Camry (sedan)',
    'MAINTENANCE_DESCRIPTION' => 'Oil change and tire rotation',
    'INITIAL_LOG_ENTRY_DATE' => '2025-07-15',
    'COMPLETION_DATE' => '2025-07-16',
    'MECHANIC_ID' => 1,
    'MECHANIC_NAME' => 'Mike Johnson',
    'INSPECTION_MECHANIC_ID' => 2,
    'INSPECTION_MECHANIC_NAME' => 'Sarah Williams',
    'STATUS' => 'Completed',
    'CREATED_AT' => '2025-07-15 09:30:22'
];

$maintenanceItems = [
    ['ITEM_ID' => 1, 'DESCRIPTION' => 'Changed oil and filter', 'MECHANIC_NAME' => 'Mike Johnson'],
    ['ITEM_ID' => 2, 'DESCRIPTION' => 'Rotated tires', 'MECHANIC_NAME' => 'Mike Johnson'],
    ['ITEM_ID' => 3, 'DESCRIPTION' => 'Checked and topped off all fluids', 'MECHANIC_NAME' => 'Mike Johnson']
];

$partsUsed = [
    ['PART_ID' => 101, 'PART_NAME' => 'Oil Filter', 'QUANTITY' => 1],
    ['PART_ID' => 102, 'PART_NAME' => 'Motor Oil (quarts)', 'QUANTITY' => 5]
];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Maintenance Log Details</h2>
    <div>
        <a href="edit.php?id=<?php echo $log['LOG_ID']; ?>" class="btn btn-warning">Edit</a>
        <a href="list.php" class="btn btn-secondary">Back to List</a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        Maintenance Log ID: <?php echo $log['LOG_ID']; ?>
    </div>
    <div class="card-body">
        <h5 class="card-title">Maintenance for <?php echo $log['VEHICLE_INFO']; ?></h5>
        <p class="card-text"><strong>Description:</strong> <?php echo $log['MAINTENANCE_DESCRIPTION']; ?></p>
        <p class="card-text"><strong>Initial Log Entry Date:</strong> <?php echo $log['INITIAL_LOG_ENTRY_DATE']; ?></p>
        <p class="card-text"><strong>Assigned Mechanic:</strong> <?php echo $log['MECHANIC_NAME']; ?></p>
        <p class="card-text"><strong>Status:</strong> 
            <span class="badge <?php echo $log['STATUS'] == 'Completed' ? 'bg-success' : 'bg-warning'; ?>">
                <?php echo $log['STATUS']; ?>
            </span>
        </p>
        
        <?php if ($log['STATUS'] == 'Completed'): ?>
        <p class="card-text"><strong>Completion Date:</strong> <?php echo $log['COMPLETION_DATE']; ?></p>
        <p class="card-text"><strong>Inspection Mechanic:</strong> <?php echo $log['INSPECTION_MECHANIC_NAME']; ?></p>
        <?php endif; ?>
        
        <p class="card-text"><strong>Created At:</strong> <?php echo $log['CREATED_AT']; ?></p>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        Maintenance Items
    </div>
    <div class="card-body">
        <?php if (count($maintenanceItems) > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Item ID</th>
                    <th>Description</th>
                    <th>Performed By</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($maintenanceItems as $item): ?>
                <tr>
                    <td><?php echo $item['ITEM_ID']; ?></td>
                    <td><?php echo $item['DESCRIPTION']; ?></td>
                    <td><?php echo $item['MECHANIC_NAME']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>No maintenance items recorded.</p>
        <?php endif; ?>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        Parts Used
    </div>
    <div class="card-body">
        <?php if (count($partsUsed) > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Part ID</th>
                    <th>Part Name</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($partsUsed as $part): ?>
                <tr>
                    <td><?php echo $part['PART_ID']; ?></td>
                    <td><?php echo $part['PART_NAME']; ?></td>
                    <td><?php echo $part['QUANTITY']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>No parts used for this maintenance.</p>
        <?php endif; ?>
    </div>
</div>

<?php include_once '../includes/footer.php'; ?>