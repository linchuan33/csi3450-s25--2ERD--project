<?php
$pageTitle = "Delete Part";
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
    'SUPPLIER' => 'AutoParts Inc.'
];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Confirm Delete</h2>
    <a href="list.php" class="btn btn-secondary">Back to List</a>
</div>

<div class="alert alert-danger">
    <h4>Are you sure you want to delete this part?</h4>
    <p>This action cannot be undone.</p>
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
    </div>
</div>

<form action="delete_process.php" method="post">
    <input type="hidden" name="part_id" value="<?php echo $part['PART_ID']; ?>">
    <button type="submit" class="btn btn-danger">Confirm Delete</button>
    <a href="list.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include_once '../includes/footer.php'; ?>