<?php
$pageTitle = "View Trip Completion Form";
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
    'FUEL_COST' => 43.75,
    'CREDIT_CARD_NUMBER' => '1234',
    'RECEIPT_ATTACHED' => true,
    'CREATED_AT' => '2025-08-17 18:30:45'
];

$milesDriven = $form['END_ODOMETER'] - $form['START_ODOMETER'];
$mileageRate = 0.58; // Example rate per mile
$tripFee = $milesDriven * $mileageRate;
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Trip Completion Form Details</h2>
    <div>
        <a href="edit.php?id=<?php echo $form['FORM_ID']; ?>" class="btn btn-warning">Edit</a>
        <a href="list.php" class="btn btn-secondary">Back to List</a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        Form ID: <?php echo $form['FORM_ID']; ?>
    </div>
    <div class="card-body">
        <h5 class="card-title">Trip by <?php echo $form['FACULTY_NAME']; ?></h5>
        <p class="card-text"><strong>Vehicle:</strong> <?php echo $form['VEHICLE_INFO']; ?></p>
        <p class="card-text"><strong>Completion Date:</strong> <?php echo $form['COMPLETION_DATE']; ?></p>
        <p class="card-text"><strong>Odometer Readings:</strong> Start: <?php echo number_format($form['START_ODOMETER']); ?> miles, End: <?php echo number_format($form['END_ODOMETER']); ?> miles</p>
        <p class="card-text"><strong>Miles Driven:</strong> <?php echo number_format($milesDriven); ?> miles</p>
        <p class="card-text"><strong>Trip Fee:</strong> $<?php echo number_format($tripFee, 2); ?> (<?php echo number_format($mileageRate, 2); ?> per mile)</p>
        <p class="card-text"><strong>Maintenance Complaints:</strong> <?php echo $form['MAINTENANCE_COMPLAINTS'] ?: 'None'; ?></p>
        
        <?php if ($form['FUEL_PURCHASED'] > 0): ?>
        <h6 class="mt-3">Fuel Information</h6>
        <p class="card-text"><strong>Fuel Purchased:</strong> <?php echo $form['FUEL_PURCHASED']; ?> gallons</p>
        <p class="card-text"><strong>Fuel Cost:</strong> $<?php echo number_format($form['FUEL_COST'], 2); ?></p>
        <p class="card-text"><strong>Credit Card (Last 4):</strong> <?php echo $form['CREDIT_CARD_NUMBER']; ?></p>
        <p class="card-text"><strong>Receipt Attached:</strong> <?php echo $form['RECEIPT_ATTACHED'] ? 'Yes' : 'No'; ?></p>
        <?php endif; ?>
        
        <p class="card-text mt-3"><strong>Created At:</strong> <?php echo $form['CREATED_AT']; ?></p>
    </div>
</div>

<?php include_once '../includes/footer.php'; ?>