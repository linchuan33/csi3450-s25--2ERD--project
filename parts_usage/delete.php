<?php
$pageTitle = "Delete Parts Usage Form";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$form = [
    'FORM_ID' => 1,
    'MAINTENANCE_LOG_ID' => 1,
    'VEHICLE_INFO' => 'Toyota Camry (sedan)',
    'MAINTENANCE_DESCRIPTION' => 'Oil change and tire rotation',
    'MECHANIC_NAME' => 'Mike Johnson',
    'USAGE_DATE' => '2025-07-15'
];

$partsUsed = [
    ['PART_ID' => 101, 'PART_NAME' => 'Oil Filter', 'QUANTITY' => 1],
    ['PART_ID' => 102, 'PART_NAME' => 'Motor Oil (quarts)', 'QUANTITY' => 5]
];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Confirm Delete</h2>
    <a href="list.php" class="btn btn-secondary">Back to List</a>
</div>

<div class="alert alert-danger">
    <h4>Are you sure you want to delete this parts usage form?</h4>
    <p>This action cannot be undone.</p>
</div>

<div class="card mb-4">
    <div class="card-header">
        Parts Usage Form ID: <?php echo $form['FORM_ID']; ?>
    </div>
    <div class="card-body">
        <h5 class="card-title">Parts Used for <?php echo $form['VEHICLE_INFO']; ?></h5>
        <p class="card-text"><strong>Maintenance Log ID:</strong> <?php echo $form['MAINTENANCE_LOG_ID']; ?></p>
        <p class="card-text"><strong>Maintenance Description:</strong> <?php echo $form['MAINTENANCE_DESCRIPTION']; ?></p>
        <p class="card-text"><strong>Mechanic:</strong> <?php echo $form['MECHANIC_NAME']; ?></p>
        <p class="card-text"><strong>Usage Date:</strong> <?php echo $form['USAGE_DATE']; ?></p>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        Parts Used
    </div>
    <div class="card-body">
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
    </div>
</div>

<form action="delete_process.php" method="post">
    <input type="hidden" name="form_id" value="<?php echo $form['FORM_ID']; ?>">
    <button type="submit" class="btn btn-danger">Confirm Delete</button>
    <a href="list.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include_once '../includes/footer.php'; ?>