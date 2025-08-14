<?php
$pageTitle = "Edit Vehicle";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$vehicle = [
    'VEHICLE_ID' => 1,
    'TYPE' => 'sedan',
    'MAKE' => 'Toyota',
    'MODEL' => 'Camry',
    'YEAR' => 2022,
    'ODOMETER_READING' => 15000
];

$vehicleTypes = ['sedan', 'station wagon', 'panel truck', 'minivan', 'minibus'];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Vehicle</h2>
    <a href="list.php" class="btn btn-secondary">Back to List</a>
</div>

<div class="form-container">
    <form action="edit_process.php" method="post" class="needs-validation" novalidate>
        <input type="hidden" name="vehicle_id" value="<?php echo $vehicle['VEHICLE_ID']; ?>">
        
        <div class="mb-3">
            <label for="type" class="form-label required">Vehicle Type</label>
            <select class="form-select" id="type" name="type" required>
                <option value="">Select Type</option>
                <?php foreach ($vehicleTypes as $type): ?>
                <option value="<?php echo $type; ?>" <?php if ($type == $vehicle['TYPE']) echo 'selected'; ?>><?php echo ucfirst($type); ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Please select a vehicle type.</div>
        </div>
        
        <div class="mb-3">
            <label for="make" class="form-label required">Make</label>
            <input type="text" class="form-control" id="make" name="make" value="<?php echo $vehicle['MAKE']; ?>" required>
            <div class="invalid-feedback">Please enter the vehicle make.</div>
        </div>
        
        <div class="mb-3">
            <label for="model" class="form-label required">Model</label>
            <input type="text" class="form-control" id="model" name="model" value="<?php echo $vehicle['MODEL']; ?>" required>
            <div class="invalid-feedback">Please enter the vehicle model.</div>
        </div>
        
        <div class="mb-3">
            <label for="year" class="form-label required">Year</label>
            <input type="number" class="form-control" id="year" name="year" min="2000" max="2025" value="<?php echo $vehicle['YEAR']; ?>" required>
            <div class="invalid-feedback">Please enter a valid year (2000-2025).</div>
        </div>
        
        <div class="mb-3">
            <label for="odometer_reading" class="form-label required">Odometer Reading</label>
            <input type="number" class="form-control" id="odometer_reading" name="odometer_reading" min="0" value="<?php echo $vehicle['ODOMETER_READING']; ?>" required>
            <div class="invalid-feedback">Please enter the current odometer reading.</div>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Vehicle</button>
        <a href="list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include_once '../includes/footer.php'; ?>