<?php
$pageTitle = "Parts Inventory";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$parts = [
    ['PART_ID' => 101, 'PART_NAME' => 'Oil Filter', 'QUANTITY_ON_HAND' => 25, 'MINIMUM_QUANTITY' => 10, 'UNIT_PRICE' => 8.99],
    ['PART_ID' => 102, 'PART_NAME' => 'Motor Oil (quarts)', 'QUANTITY_ON_HAND' => 48, 'MINIMUM_QUANTITY' => 20, 'UNIT_PRICE' => 5.49],
    ['PART_ID' => 103, 'PART_NAME' => 'Air Filter', 'QUANTITY_ON_HAND' => 15, 'MINIMUM_QUANTITY' => 8, 'UNIT_PRICE' => 12.99],
    ['PART_ID' => 104, 'PART_NAME' => 'Brake Pads (set)', 'QUANTITY_ON_HAND' => 6, 'MINIMUM_QUANTITY' => 5, 'UNIT_PRICE' => 35.99],
    ['PART_ID' => 105, 'PART_NAME' => 'Wiper Blades (pair)', 'QUANTITY_ON_HAND' => 3, 'MINIMUM_QUANTITY' => 5, 'UNIT_PRICE' => 22.50]
];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Parts Inventory</h2>
    <a href="create.php" class="btn btn-success">Add New Part</a>
</div>

<div class="table-container">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Part Name</th>
                <th>Quantity On Hand</th>
                <th>Minimum Quantity</th>
                <th>Unit Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($parts as $part): ?>
            <tr>
                <td><?php echo $part['PART_ID']; ?></td>
                <td><?php echo $part['PART_NAME']; ?></td>
                <td><?php echo $part['QUANTITY_ON_HAND']; ?></td>
                <td><?php echo $part['MINIMUM_QUANTITY']; ?></td>
                <td>$<?php echo number_format($part['UNIT_PRICE'], 2); ?></td>
                <td>
                    <?php if ($part['QUANTITY_ON_HAND'] <= $part['MINIMUM_QUANTITY']): ?>
                    <span class="badge bg-danger">Reorder</span>
                    <?php else: ?>
                    <span class="badge bg-success">In Stock</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="view.php?id=<?php echo $part['PART_ID']; ?>" class="btn btn-sm btn-info btn-action">View</a>
                    <a href="edit.php?id=<?php echo $part['PART_ID']; ?>" class="btn btn-sm btn-warning btn-action">Edit</a>
                    <a href="delete.php?id=<?php echo $part['PART_ID']; ?>" class="btn btn-sm btn-danger btn-action" onclick="return confirmDelete('part', <?php echo $part['PART_ID']; ?>)">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="alert alert-warning mt-4">
    <h4>Parts Requiring Reorder</h4>
    <ul>
        <?php 
        $reorderNeeded = false;
        foreach ($parts as $part): 
            if ($part['QUANTITY_ON_HAND'] <= $part['MINIMUM_QUANTITY']):
                $reorderNeeded = true;
        ?>
        <li><?php echo $part['PART_NAME']; ?> (<?php echo $part['QUANTITY_ON_HAND']; ?> on hand, minimum: <?php echo $part['MINIMUM_QUANTITY']; ?>)</li>
        <?php 
            endif;
        endforeach; 
        
        if (!$reorderNeeded):
        ?>
        <li>No parts currently need reordering.</li>
        <?php endif; ?>
    </ul>
</div>

<?php include_once '../includes/footer.php'; ?>