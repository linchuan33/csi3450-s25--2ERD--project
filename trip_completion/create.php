<?php
$pageTitle = "Add Trip Completion Form";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$faculty = [
    ['FACULTY_ID' => 1, 'FACULTY_NAME' => 'John Smith'],
    ['FACULTY_ID' => 2, 'FACULTY_NAME' => 'Mary Johnson'],
    ['FACULTY_ID' => 3, 'FACULTY_NAME' => 'Robert Williams']
];

$vehicles = [
    ['VEHICLE_ID' => 1, 'VEHICLE_INFO' => 'Toyota Camry (sedan)', 'CURRENT_ODOMETER' => 15000],
    ['VEHICLE_ID' => 2, 'VEHICLE_INFO' => 'Honda Odyssey (minivan)', 'CURRENT_ODOMETER' => 22500],
    ['VEHICLE_ID' => 3, 'VEHICLE_INFO' => 'Subaru Outback (station wagon)', 'CURRENT_ODOMETER' => 8700]
];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add Trip Completion Form</h2>
    <a href="list.php" class="btn btn-secondary">Back to List</a>
</div>

<div class="form-container">
    <form action="create_process.php" method="post" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="faculty_id" class="form-label required">Faculty</label>
            <select class="form-select" id="faculty_id" name="faculty_id" required>
                <option value="">Select Faculty</option>
                <?php foreach ($faculty as $member): ?>
                <option value="<?php echo $member['FACULTY_ID']; ?>"><?php echo $member['FACULTY_NAME']; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Please select a faculty member.</div>
        </div>
        
        <div class="mb-3">
            <label for="vehicle_id" class="form-label required">Vehicle</label>
            <select class="form-select" id="vehicle_id" name="vehicle_id" required>
                <option value="">Select Vehicle</option>
                <?php foreach ($vehicles as $vehicle): ?>
                <option value="<?php echo $vehicle['VEHICLE_ID']; ?>" data-odometer="<?php echo $vehicle['CURRENT_ODOMETER']; ?>"><?php echo $vehicle['VEHICLE_INFO']; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Please select a vehicle.</div>
        </div>
        
        <div class="mb-3">
            <label for="start_odometer" class="form-label required">Start Odometer Reading</label>
            <input type="number" class="form-control" id="start_odometer" name="start_odometer" min="0" required>
            <div class="invalid-feedback">Please enter the starting odometer reading.</div>
        </div>
        
        <div class="mb-3">
            <label for="end_odometer" class="form-label required">End Odometer Reading</label>
            <input type="number" class="form-control" id="end_odometer" name="end_odometer" min="0" required>
            <div class="invalid-feedback">Please enter the ending odometer reading.</div>
        </div>
        
        <div class="mb-3">
            <label for="completion_date" class="form-label required">Completion Date</label>
            <input type="date" class="form-control" id="completion_date" name="completion_date" required>
            <div class="invalid-feedback">Please select the completion date.</div>
        </div>
        
        <div class="mb-3">
            <label for="maintenance_complaints" class="form-label">Maintenance Complaints</label>
            <textarea class="form-control" id="maintenance_complaints" name="maintenance_complaints" rows="3"></textarea>
        </div>
        
        <div class="mb-3">
            <label for="fuel_purchased" class="form-label">Fuel Purchased (gallons)</label>
            <input type="number" class="form-control" id="fuel_purchased" name="fuel_purchased" min="0" step="0.1">
        </div>
        
        <div class="mb-3">
            <label for="fuel_cost" class="form-label">Fuel Cost ($)</label>
            <input type="number" class="form-control" id="fuel_cost" name="fuel_cost" min="0" step="0.01">
        </div>
        
        <div class="mb-3">
            <label for="credit_card_number" class="form-label">Credit Card Number (Last 4 digits)</label>
            <input type="text" class="form-control" id="credit_card_number" name="credit_card_number" maxlength="4" pattern="[0-9]{4}">
            <div class="invalid-feedback">Please enter the last 4 digits of the credit card.</div>
        </div>
        
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="receipt_attached" name="receipt_attached">
            <label class="form-check-label" for="receipt_attached">Fuel receipt attached</label>
        </div>
        
        <button type="submit" class="btn btn-primary">Save Form</button>
        <a href="list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
document.getElementById('vehicle_id').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var startOdometer = selectedOption.getAttribute('data-odometer');
    if (startOdometer) {
        document.getElementById('start_odometer').value = startOdometer;
    }
});
</script>

<?php include_once '../includes/footer.php'; ?>