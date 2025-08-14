<?php
$pageTitle = "View Vehicle";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$vehicle = [
    'VEHICLE_ID' => 1,
    'TYPE' => 'sedan',
    'MAKE' => 'Toyota',
    'MODEL' => 'Camry',
    'YEAR' => 2022,
    'ODOMETER_READING' => 15000,
    'STATUS' => 'Available'
];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Vehicle Details</h2>
    <div>
        <a href="edit.php?id=<?php echo $vehicle['VEHICLE_ID']; ?>" class="btn btn-warning">Edit</a>
        <a href="list.php" class="btn btn-secondary">Back to List</a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Vehicle ID: <?php echo $vehicle['VEHICLE_ID']; ?>
    </div>
    <div class="card-body">
        <h5 class="card-title"><?php echo $vehicle['YEAR'] . ' ' . $vehicle['MAKE'] . ' ' . $vehicle['MODEL']; ?></h5>
        <p class="card-text"><strong>Type:</strong> <?php echo ucfirst($vehicle['TYPE']); ?></p>
        <p class="card-text"><strong>Odometer Reading:</strong> <?php echo number_format($vehicle['ODOMETER_READING']); ?> miles</p>
        <p class="card-text"><strong>Status:</strong> <?php echo $vehicle['STATUS']; ?></p>
    </div>
</div>

<div class="mt-4">
    <h3>Recent Maintenance</h3>
    <p>No recent maintenance records found.</p>
</div>

<?php include_once '../includes/footer.php'; ?>