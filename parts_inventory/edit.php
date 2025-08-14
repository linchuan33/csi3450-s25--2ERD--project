<?php
$pageTitle = "Edit Part";
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
    <h2>Edit Part</h2>
    <a href="list.php" class="btn btn-secondary">Back to List</a>
</div>

<div class="form-container">
    <form action="edit_process.php" method="post" class="needs-validation" novalidate>
        <input type="hidden" name="part_id" value="<?php echo $part['PART_ID']; ?>">
        
        <div class="mb-3">
            <label for="part_name" class="form-label required">Part Name</label>
            <input type="text" class="form-control" id="part_name" name="part_name" value="<?php echo $part['PART_NAME']; ?>" required>
            <div class="invalid-feedback">Please enter a part name.</div>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?php echo $part['DESCRIPTION']; ?></textarea>
        </div>
        
        <div class="mb-3">
            <label for="quantity_on_hand" class="form-label required">Quantity On Hand</label>
            <input type="number" class="form-control" id="quantity_on_hand" name="quantity_on_     <input type="number" class="form-control" id="quantity_on_hand" name="quantity_on_hand" min="0" value="<?php echo $part['QUANTITY_ON_HAND']; ?>" required>
            <div class="invalid-feedback">Please enter the quantity on hand.</div>
        </div>
        
        <div class="mb-3">
            <label for="minimum_quantity" class="form-label required">Minimum Quantity</label>
            <input type="number" class="form-control" id="minimum_quantity" name="minimum_quantity" min="0" value="<?php echo $part['MINIMUM_QUANTITY']; ?>" required>
            <div class="invalid-feedback">Please enter the minimum quantity.</div>
        </div>
        
        <div class="mb-3">
            <label for="unit_price" class="form-label required">Unit Price ($)</label>
            <input type="number" class="form-control" id="unit_price" name="unit_price" min="0" step="0.01" value="<?php echo $part['UNIT_PRICE']; ?>" required>
            <div class="invalid-feedback">Please enter the unit price.</div>
        </div>
        
        <div class="mb-3">
            <label for="supplier" class="form-label">Supplier</label>
            <input type="text" class="form-control" id="supplier" name="supplier" value="<?php echo $part['SUPPLIER']; ?>">
        </div>
        
        <button type="submit" class="btn btn-primary">Update Part</button>
        <a href="list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include_once '../includes/footer.php'; ?>
