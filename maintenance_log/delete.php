<?php
$pageTitle = "Add Maintenance Log";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$vehicles = [
    ['VEHICLE_ID' => 1, 'VEHICLE_INFO' => 'Toyota Camry (sedan)'],
    ['VEHICLE_ID' => 2, 'VEHICLE_INFO' => 'Honda Odyssey (minivan)'],
    ['VEHICLE_ID' => 3, 'VEHICLE_INFO' => 'Subaru Outback (station wagon)']
];

$mechanics = [
    ['MECHANIC_ID' => 1, 'MECHANIC_NAME' => 'Mike Johnson', 'INSPECTION_AUTHORIZED' => true],
    ['MECHANIC_ID' => 2, 'MECHANIC_NAME' => 'Sarah Williams', 'INSPECTION_AUTHORIZED' => true],
    ['MECHANIC_ID' => 3, 'MECHANIC_NAME' => 'David Brown', 'INSPECTION_AUTHORIZED' => false]
];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add Maintenance Log</h2>
    <a href="list.php" class="btn btn-secondary">Back to List</a>
</div>

<div class="form-container">
    <form action="create_process.php" method="post" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="vehicle_id" class="form-label required">Vehicle</label>
            <select class="form-select" id="vehicle_id" name="vehicle_id" required>
                <option value="">Select Vehicle</option>
                <?php foreach ($vehicles as $vehicle): ?>
                <option value="<?php echo $vehicle['VEHICLE_ID']; ?>"><?php echo $vehicle['VEHICLE_INFO']; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Please select a vehicle.</div>
        </div>
        
        <div class="mb-3">
            <label for="maintenance_description" class="form-label required">Maintenance Description</label>
            <textarea class="form-control" id="maintenance_description" name="maintenance_description" rows="3" required></textarea>
            <div class="invalid-feedback">Please enter a maintenance description.</div>
        </div>
        
        <div class="mb-3">
            <label for="initial_log_entry_date" class="form-label required">Initial Log Entry Date</label>
            <input type="date" class="form-control" id="initial_log_entry_date" name="initial_log_entry_date" value="<?php echo date('Y-m-d'); ?>" required>
            <div class="invalid-feedback">Please select the initial log entry date.</div>
        </div>
        
        <div class="mb-3">
            <label for="mechanic_id" class="form-label">Assigned Mechanic</label>
            <select class="form-select" id="mechanic_id" name="mechanic_id">
                <option value="">Select Mechanic</option>
                <?php foreach ($mechanics as $mechanic): ?>
                <option value="<?php echo $mechanic['MECHANIC_ID']; ?>" data-inspection="<?php echo $mechanic['INSPECTION_AUTHORIZED'] ? '1' : '0'; ?>">
                    <?php echo $mechanic['MECHANIC_NAME']; ?>
                    <?php if ($mechanic['INSPECTION_AUTHORIZED']): ?> (Inspection Authorized)<?php endif; ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_completed" name="is_completed">
            <label class="form-check-label" for="is_completed">Maintenance is completed</label>
        </div>
        
        <div id="completion_fields" style="display: none;">
            <div class="mb-3">
                <label for="completion_date" class="form-label">Completion Date</label>
                <input type="date" class="form-control" id="completion_date" name="completion_date">
            </div>
            
            <div class="mb-3">
                <label for="inspection_mechanic_id" class="form-label">Inspection Mechanic</label>
                <select class="form-select" id="inspection_mechanic_id" name="inspection_mech                 <select class="form-select" id="inspection_mechanic_id" name="inspection_mechanic_id">
                    <option value="">Select Inspection Mechanic</option>
                    <?php foreach ($mechanics as $mechanic): ?>
                        <?php if ($mechanic['INSPECTION_AUTHORIZED']): ?>
                        <option value="<?php echo $mechanic['MECHANIC_ID']; ?>">
                            <?php echo $mechanic['MECHANIC_NAME']; ?> (Inspection Authorized)
                        </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <div class="form-text">Only mechanics with inspection authorization can perform final inspection.</div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Save Maintenance Log</button>
        <a href="list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
document.getElementById('is_completed').addEventListener('change', function() {
    var completionFields = document.getElementById('completion_fields');
    if (this.checked) {
        completionFields.style.display = 'block';
    } else {
        completionFields.style.display = 'none';
    }
});
</script>

<?php include_once '../includes/footer.php'; ?>

        