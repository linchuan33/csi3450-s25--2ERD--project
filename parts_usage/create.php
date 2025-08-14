<?php
$pageTitle = "Add Parts Usage Form";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

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
    <h2>Add Parts Usage Form</h2>
    <a href="list.php" class="btn btn-secondary">Back to List</a>
</div>

<div class="form-container">
    <form action="create_process.php" method="post" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="maintenance_log_id" class="form-label required">Maintenance Log</label>
            <select class="form-select" id="maintenance_log_id" name="maintenance_log_id" required>
                <option value="">Select Maintenance Log</option>
                <?php foreach ($maintenanceLogs as $log): ?>
                <option value="<?php echo $log['LOG_ID']; ?>"><?php echo $log['LOG_ID'] . ' - ' . $log['VEHICLE_INFO'] . ' - ' . $log['MAINTENANCE_DESCRIPTION']; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Please select a maintenance log.</div>
        </div>
        
        <div class="mb-3">
            <label for="mechanic_id" class="form-label required">Mechanic</label>
            <select class="form-select" id="mechanic_id" name="mechanic_id" required>
                <option value="">Select Mechanic</option>
                <?php foreach ($mechanics as $mechanic): ?>
                <option value="<?php echo $mechanic['MECHANIC_ID']; ?>"><?php echo $mechanic['MECHANIC_NAME']; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Please select a mechanic.</div>
        </div>
        
        <div class="mb-3">
            <label for="usage_date" class="form-label required">Usage Date</label>
            <input type="date" class="form-control" id="usage_date" name="usage_date" value="<?php echo date('Y-m-d'); ?>" required>
            <div class="invalid-feedback">Please select the usage date.</div>
        </div>
        
        <h4 class="mt-4 mb-3">Parts Used</h4>
        
        <div id="parts-container">
            <div class="row mb-3 part-row">
                <div class="col-md-6">
                    <label for="part_id_1" class="form-label required">Part</label>
                    <select class="form-select part-select" id="part_id_1" name="part_id[]" required>
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
                    <label for="quantity_1" class="form-label required">Quantity</label>
                    <input type="number" class="form-control quantity-input" id="quantity_1" name="quantity[]" min="1" value="1" required>
                    <div class="invalid-feedback">Please enter a valid quantity.</div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-part" disabled>Remove</button>
                </div>
            </div>
        </div>
        
        <div class="mb-4">
            <button type="button" class="btn btn-secondary" id="add-part">Add Another Part</button>
        </div>
        
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
        </div>
        
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="mechanic_signature" name="mechanic_signature" required>
            <label class="form-check-label required" for="mechanic_signature">Mechanic has signed the form</label>
            <div class="invalid-feedback">Mechanic signature is required.</div>
        </div>
        
        <button type="submit" class="btn btn-primary">Save Parts Usage Form</button>
        <a href="list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let partCount = 1;
    
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
                <label for="quantity_${partCount}" class="form                 <label for="quantity_${partCount}" class="form-label required">Quantity</label>
                <input type="number" class="form-control quantity-input" id="quantity_${partCount}" name="quantity[]" min="1" value="1" required>
                <div class="invalid-feedback">Please enter a valid quantity.</div>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-part">Remove</button>
            </div>
        `;
        
        document.getElementById('parts-container').appendChild(partRow);
        
        // Enable all remove buttons if there's more than one part
        if (document.querySelectorAll('.part-row').length > 1) {
            document.querySelectorAll('.remove-part').forEach(button => {
                button.disabled = false;
            });
        }
        
        // Add event listener to the new remove button
        partRow.querySelector('.remove-part').addEventListener('click', function() {
            partRow.remove();
            
            // If only one part remains, disable its remove button
            if (document.querySelectorAll('.part-row').length === 1) {
                document.querySelector('.remove-part').disabled = true;
            }
        });
    });
});
</script>

<?php include_once '../includes/footer.php'; ?>
