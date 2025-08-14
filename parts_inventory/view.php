<?php
$pageTitle = "View Part";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$part = [
    'PART_ID' => 101,
    'PART_NAME' => 'Oil Filter',
    'DESCRIPTION' => 'Standard oil filter for sedan and compact vehicles',
    'QUANTITY_ON_HAND' => 25,
    'MINIMUM_QUANTITY' => 10,
    'UNIT_PRICE' => 8.99,
    'SUPPLIER' => 'AutoParts Inc.',
    'LAST_ORDERED' => '2025-06-15',
    'LAST_RECEIVED' => '2025-06-20'
];

$usageHistory = [
    ['DATE' => '2025-07-15', 'QUANTITY' => 1, 'VEHICLE' => 'Toyota Camry', 'MECHANIC' => 'Mike Johnson'],
    ['DATE' => '2025-07-02', 'QUANTITY' => 1, 'VEHICLE' => 'Honda Odyssey', 'MECHANIC' => 'Sarah Williams'],
    ['DATE' => '2025-06-25', 'QUANTITY' => 1, 'VEHICLE' => 'Subaru Outback', 'MECHANIC' => 'David Brown']
];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Part Details</h2>
    <div>
        <a href="edit.php?id=<?php echo $part['PART_ID']; ?>" class="btn btn-warning">Edit</a>
        <a href="list.php" class="btn btn-secondary">Back to List</a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        Part ID: <?php echo $part['PART_ID']; ?>
    </div>
    <div class="card-body">
        <h5 class="card-title"><?php echo $part['PART_NAME']; ?></h5>
        <p class="card-text"><strong>Description:</strong> <?php echo $part['DESCRIPTION']; ?></p>
        <p class="card-text"><strong>Quantity On Hand:</strong> <?php echo $part['QUANTITY_ON_HAND']; ?></p>
        <p class="card-text"><strong>Minimum Quantity:</strong> <?php echo $part['MINIMUM_QUANTITY']; ?></p>
        <p class="card-text"><strong>Unit Price:</strong> $<?php echo number_format($part['UNIT_PRICE'], 2); ?></p>
        <p class="card-text"><strong>Supplier:</strong> <?php echo $part['SUPPLIER']; ?></p>
        <p class="card-text"><strong>Last Ordered:</strong> <?php echo $part['LAST_ORDERED']; ?></p>
        <p class="card-text"><strong>Last Received:</strong> <?php echo $part['LAST_RECEIVED']; ?></p>
        
        <p class="card-text">
            <strong>Status:</strong>
            <?php if ($part['QUANTITY_ON_HAND'] <= $part['MINIMUM_QUANTITY']): ?>
            <span class="badge bg-danger">Reorder</span>
            <?php else: ?>
            <span class="badge bg-success">In Stock</span>
            <?php endif; ?>
        </p>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        Usage History
    </div>
    <div class="card-body">
        <?php if (count($usageHistory) > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Quantity</th>
                    <th>Vehicle</th>
                    <th>Mechanic</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usageHistory as $usage): ?>
                <tr>
                    <td><?php echo $usage['DATE']; ?></td>
                    <td><?php echo $usage['QUANTITY']; ?></td>
                    <td><?php echo $usage['VEHICLE']; ?></td>
                    <td><?php echo $usage['MECHANIC']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>No usage history found for this part.</p>
        <?php endif; ?>
    </div>
</div>

<?php include_once '../includes/footer.php'; ?>