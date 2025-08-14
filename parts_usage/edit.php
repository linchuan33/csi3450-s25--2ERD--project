<?php
$pageTitle = "Edit Parts Usage Form";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$form = [
    'FORM_ID' => 1,
    'MAINTENANCE_LOG_ID' => 1,
    'MECHANIC_ID' => 1,
    'USAGE_DATE' => '2025-07-15',
    'NOTES' => 'Regular maintenance',
    'MECHANIC_SIGNATURE' => true
];

$partsUsed = [
    ['PART_ID' => 101, 'QUANTITY' => 1],
    ['PART_ID' => 102, 'QUANTITY' => 5]
];

$maintenanceLogs = [
    ['LOG_ID' => 1, 'VEHICLE_INFO' => 'Toyota Camry (sedan)', 'MAINTENANCE_DESCRIPTION' => 'Oil change and tire rotation'],
    ['LOG_ID' => 2, 'VEHICLE_INFO' => 'Subaru Outback (station wagon)', 'MAINTENANCE_DESCRIPTION' => 'Brake pad replacement'],
    ['LOG_ID' => 3, 'VEHICLE_INFO' => 'Honda Odyssey (minivan)', 'MAINTENANCE_DESCRIPTION' => 'Check engine light diagnosis']
];

$mechanics = [
    ['MECHANIC_ID' => 1, 'MECHANIC_NAME' => 'Mike Johnson'],
    ['MECHANIC_ID' => 2, 'MECHANIC_NAME' => 'Sarah Williams'],
    ['MECHANIC_ID' => 3, 'MECHANIC_NAME' => 'David Brown']
];

$parts = [
    ['PART_ID' => 101, 'PART_NAME' => 'Oil Filter', 'QUANTITY_ON_HAND' => 25],
    ['PART_ID' => 102, 'PART_NAME' => 'Motor Oil (quarts)', 'QUANTITY_ON_HAND' => 48],
    ['PART_ID' => 103, 'PART_NAME' => 'Air Filter', 'QUANTITY_ON_HAND' => 15],
    ['PART_ID' => 104, 'PART_NAME' => 'Brake Pads (set)', 'QUANTITY_ON_HAND' => 6],
    ['PART_ID' => 105, 'PART_NAME' => 'Wiper Blades (pair)', 'QUANTITY_ON_HAND' => 3]
];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Parts Usage Form</h2>
    <a href="list.php" class="btn btn-secondary">Back to List</a>
</div>

<div class="form-container">
    <form action="edit_process.php" method="post" class="needs-validation" novalidate>
        <input type="hidden" name="form_id" value="<?php echo $form['FORM_ID']; ?>">
        
        <div class="mb-3">
            <label for="maintenance_log_id" class="form-label required">Maintenance Log</label>
            <select class="form-select" id="maintenance_log_id" name="maintenance_log_id" required>
                <option value="">Select Maintenance Log</option>
                <?php foreach ($maintenanceLogs as $log): ?>
                <option value="<?php echo $log['LOG_ID']; ?>" <?php if ($log['LOG_ID'] == $form['MAINTENANCE_LOG_ID']) echo 'selected'; ?>>
                    <?php echo $log['LOG_ID'] . ' - ' . $log['VEHICLE_INFO'] . ' - ' . $log['MAINTENANCE_DESCRIPTION']; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Please select a maintenance log.</div>
        </div>
        
        <div class="mb-3">
            <label for="mechanic_id" class="form-label required">Mechanic</label>
            <select class="form-select" id="mechanic_id" name="mechanic_id" required>
                <option value="">Select Mechanic</option>
                <?php foreach ($mechanics as $mechanic): ?>
                <option value="<?php echo $mechanic['MECHANIC_ID']; ?>" <?php if ($mechanic['MECHANIC_ID'] == $form['MECHANIC_ID']) echo 'selected'; ?>>
                    <?php echo $mechanic['MECHANIC_NAME']; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Please select a mechanic.</div>
        </div>
        
        <div class="mb-3">
            <label for="usage_date" class="form-label required">Usage Date</label>
            <input type="date" class="form-control" id="usage_date" name="usage_date" value="<?php echo $form['USAGE_DATE']; ?>" required>
            <div class="invalid-feedback">Please select the usage date.</div>
        </div>
        
        <h4 class="mt-4 mb-3">Parts Used</h4>
        
        <div id="parts-container">
            <?php foreach ($partsUsed as $index => $part): ?>
            <div class="row mb-3 part-row">
                <div class="col-md-6">
                    <label for="part_id_<?php echo $index + 1; ?>" class="form-label required">Part</label>
                    <select class="form-select part-select" id="part_id_<?php echo $index + 1; ?>" name="part_id[]" required>
                        <option value="">Select Part</option>
                        <?php foreach ($parts as $p): ?>
                        <option value="<?php echo $p['PART_ID']; ?>" data-quantity="<?php echo $p['QUANTITY_ON_HAND']; ?>" <?php if ($p['PART_ID'] == $part['PART_ID']) echo 'selected'; ?>>
                            <?php echo $p['PART_NAME']; ?> (<?php echo $p['QUANTITY_ON_HAND']; ?> available)
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Please select a part.</div>
                </div>
                <div class="col-md-4">
                    <label for="quantity_<?php echo $index + 1; ?>" class="form-label required">Quantity</label>
                    <input type="number" class="form-control quantity-input" id="quantity_<?php echo $index + 1; ?>" name="quantity[]" min="1" value="<?php echo $part['QUANTITY']; ?>" required>
                    <div class="invalid-feedback">Please enter a valid quantity.</div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-part" <?php if ($index === 0 && count($partsUsed) === 1) echo 'disabled'; ?>>Remove</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="mb-4">
            <button type="button" class="btn btn-secondary" id="add-part">Add Another Part</button>
        </div>
        
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control" id="notes" name="notes" rows="3"><?php echo $form['NOTES']; ?></textarea>
        </div>
        
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="mechanic_signature" name="mechanic_signature" <?php if ($form['MECHANIC_SIGNATURE']) echo 'checked'; ?> required>
            <label class="form-check-label required" for="mechanic_signature">Mechanic has signed the form</label>
            <div class="invalid-feedback">Mechanic signature is required.</div>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Parts Usage Form</button>
        <a href="list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let partCount = <?php echo count($partsUsed); ?>;
    
    // Add another part
    document.getElementById('add-part').addEventListener('click', function() {
        partCount++;
        
        const partRow = document.createElement('div');
        partRow.className = 'row mb-3 part-row';
        partRow.innerHTML = `
            <div class="col-md-6">
                <label for="part_id_${partCount}" class="form-label required">Part</label>
                <select class="form-select part-select" id="part_id_${partCount}" name="part_id[]" required>
                    <option value="">Select Part</option>
                    <?php foreach ($parts as $part): ?>
                    <option value="<?php echo $part['PART_ID']; ?>" data-quantity="<?php echo $part['QUANTITY_ON_HAND']; ?>">
                        <?php echo $part['PART_NAME']; ?> (<?php echo $part['QUANTITY_ON_HAND']; ?> available)
                    </option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">Please select a part.</div>
            </div>
            <div class="col-md-4">
                <label for="quantity_${partCount}" class="form-label required">Quantity</label>
                <input type="number" class="form-control quantity-input" id="quantity_${partCount}" name="quantity[]" min="1" value="1" required>
                <div class="invalid-feedback">Please enter a valid quantity.</div>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-part">Remove</button>
            </div>
        `;
        
        document.getElementById('parts-container').appendChild(partRow);
        
        if (document.querySelectorAll('.part-row').length > 1) {
            document.querySelectorAll('.remove-part').forEach(button => button.disabled = false);
        }
        
        partRow.querySelector('.remove-part').addEventListener('click', function() {
            partRow.remove();
            if (document.querySelectorAll('.part-row').length === 1) {
                document.querySelector('.remove-part').disabled = true;
            }
        });
    });
    
    document.querySelectorAll('.remove-part').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.part-row').remove();
            if (document.querySelectorAll('.part-row').length === 1) {
                document.querySelector('.remove-part').disabled = true;
            }
        });
    });
});
</script>

<?php include_once '../includes/footer.php'; ?>
