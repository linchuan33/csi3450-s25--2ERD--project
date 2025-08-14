<?php
$pageTitle = "Delete Trip Completion Form";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$form = [
    'FORM_ID' => 1,
    'FACULTY_ID' => 1,
    'FACULTY_NAME' => 'John Smith',
    'VEHICLE_ID' => 1,
    'VEHICLE_INFO' => 'Toyota Camry (sedan)',
    'START_ODOMETER' => 15000,
    'END_ODOMETER' => 15350,
    'COMPLETION_DATE' => '2025-08-17',
    'MAINTENANCE_COMPLAINTS' => 'None',
    'FUEL_PURCHASED' => 12.5,
    'FUEL_COST' => 43.75
];

$milesDriven = $form['END_ODOMETER'] - $form['START_ODOMETER'];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Confirm Delete</h2>
    <a href="list.php" class="btn btn-secondary">Back to List</a>
</div>

<div class="alert alert-danger">
    <h4>Are you sure you want to delete this trip completion form?</h4>
    <p>This action cannot be undone.</p>
</div>

<div class="card mb-4">
    <div class="card-header">
        Form ID: <?php echo $form['FORM_ID']; ?>
    </div>
    <div class="card-body">
        <h5 class="card-title">Trip by <?php echo $form['FACULTY_NAME']; ?></h5>
        <p class="card-text"><strong>Vehicle:</strong> <?php echo $form['VEHICLE_INFO']; ?></p>
        <p class="card-text"><strong>Completion Date:</strong> <?php echo $form['COMPLETION_DATE']; ?></p>
        <p class="card-text"><strong>Miles Driven:</strong> <?php echo number_format($milesDriven); ?> miles</p>
    </div>
</div>

<form action="delete_process.php" method="post">
    <input type="hidden" name="form_id" value="<?php echo $form['FORM_ID']; ?>">
    <button type="submit" class="btn btn-danger">Confirm Delete</button>
    <a href="list.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include_once '../includes/footer.php'; ?>