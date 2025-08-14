<?php
$pageTitle = "Add Part";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add New Part</h2>
    <a href="list.php" class="btn btn-secondary">Back to List</a>
</div>

<div class="form-container">
    <form action="create_process.php" method="post" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="part_name" class="form-label required">Part Name</label>
            <input type="text" class="form-control" id="part_name" name="part_name" required>
            <div class="invalid-feedback">Please enter a part name.</div>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        
        <div class="mb-3">
            <label for="quantity_on_hand" class="form-label required">Quantity On Hand</label>
            <input type="number" class="form-control" id="quantity_on_hand" name="quantity_on_hand" min="0" required>
            <div class="invalid-feedback">Please enter the quantity on hand.</div>
        </div>
        
        <div class="mb-3">
            <label for="minimum_quantity" class="form-label required">Minimum Quantity</label>
            <input type="number" class="form-control" id="minimum_quantity" name="minimum_quantity" min="0" required>
            <div class="invalid-feedback">Please enter the minimum quantity.</div>
        </div>
        
        <div class="mb-3">
            <label for="unit_price" class="form-label required">Unit Price ($)</label>
            <input type="number" class="form-control" id="unit_price" name="unit_price" min="0" step="0.01" required>
            <div class="invalid-feedback">Please enter the unit price.</div>
        </div>
        
        <div class="mb-3">
            <label for="supplier" class="form-label">Supplier</label>
            <input type="text" class="form-control" id="supplier" name="supplier">
        </div>
        
        <button type="submit" class="btn btn-primary">Save Part</button>
        <a href="list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include_once '../includes/footer.php'; ?>