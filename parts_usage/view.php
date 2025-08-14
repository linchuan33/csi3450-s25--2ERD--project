<?php
$pageTitle = "View Parts Usage Form";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$form = [
    'FORM_ID' => 1,
    'MAINTENANCE_LOG_ID' => 1,
    'VEHICLE_INFO' => 'Toyota Camry (sedan)',
    'MAINTENANCE_DESCRIPTION' => 'Oil change and tire rotation',
    'MECHANIC_ID' => 1,
    'MECHANIC_NAME' => 'Mike Johnson',
    'USAGE_DATE' => '2025-07-15',
    'NOTES' => 'Regular maintenance',
    'MECHANIC_SIGNATURE' => true,
    'CREATED_AT' => '2025-07-15 10:30:45'
];

$partsUsed = [
    ['PART_ID' => 101, 'PART_NAME' => 'Oil Filter', 'QUANTITY' => 1, 'UNIT_PRICE' => 8.99],
    ['PART_ID' => 102, 'PART_NAME' => 'Motor Oil (quarts)', 'QUANTITY' => 5, 'UNIT_PRICE' => 5.49]
];

$totalCost = 0;
foreach ($partsUsed as $part) {
    $totalCost += $part['QUANTITY'] * $part['UNIT_PRICE'];
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Parts Usage Form Details</h2>
    <div>
        <a href="edit.php?id=<?php echo $form['FORM_ID']; ?>" class="btn btn-warning">Edit</a>
        <a href="list.php" class="btn btn-secondary">Back to List</a>
    </div>
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
        <p class="card-text"><strong>Notes:</strong> <?php echo $form['NOTES'] ?: 'None'; ?></p>
        <p class="card-text"><strong>Mechanic Signature:</strong> <?php echo $form['MECHANIC_SIGNATURE'] ? 'Yes' : 'No'; ?></p>
        <p class="card-text"><strong>Created At:</strong> <?php echo $form['CREATED_AT']; ?></p>
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
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($partsUsed as $part): ?>
                <tr>
                    <td><?php echo $part['PART_ID']; ?></td>
                    <td><?php echo $part['PART_NAME']; ?></td>
                    <td><?php echo $part['QUANTITY']; ?></td>
                    <td>$<?php echo number_format($part['UNIT_PRICE'], 2); ?></td>
                    <td>$<?php echo number_format($part['QUANTITY'] * $part['UNIT_PRICE'], 2); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-end">Total Cost:</th>
                    <th>$<?php echo number_format($totalCost, 2); ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?php include_once '../includes/footer.php'; ?>