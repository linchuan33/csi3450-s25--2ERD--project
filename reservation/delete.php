<?php
$pageTitle = "Delete Reservation";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$reservation = [
    'RESERVATION_ID' => 1,
    'FACULTY_ID' => 1,
    'FACULTY_NAME' => 'John Smith',
    'VEHICLE_ID' => 1,
    'VEHICLE_INFO' => 'Toyota Camry (sedan)',
    'EXPECTED_DEPARTURE_DATE' => '2025-08-15',
    'EXPECTED_RETURN_DATE' => '2025-08-17',
    'DESTINATION' => 'Detroit, MI',
    'STATUS' => 'Pending',
    'CREATED_AT' => '2025-08-01 10:15:22'
];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Confirm Delete</h2>
    <a href="list.php" class="btn btn-secondary">Back to List</a>
</div>

<div class="alert alert-danger">
    <h4>Are you sure you want to delete this reservation?</h4>
    <p>This action cannot be undone.</p>
</div>

<div class="card mb-4">
    <div class="card-header">
        Reservation ID: <?php echo $reservation['RESERVATION_ID']; ?>
    </div>
    <div class="card-body">
        <h5 class="card-title">Reservation for <?php echo $reservation['FACULTY_NAME']; ?></h5>
        <p class="card-text"><strong>Vehicle:</strong> <?php echo $reservation['VEHICLE_INFO']; ?></p>
        <p class="card-text"><strong>Departure Date:</strong> <?php echo $reservation['EXPECTED_DEPARTURE_DATE']; ?></p>
        <p class="card-text"><strong>Return Date:</strong> <?php echo $reservation['EXPECTED_RETURN_DATE']; ?></p>
        <p class="card-text"><strong>Destination:</strong> <?php echo $reservation['DESTINATION']; ?></p>
        <p class="card-text"><strong>Status:</strong> <?php echo $reservation['STATUS']; ?></p>
    </div>
</div>

<form action="delete_process.php" method="post">
    <input type="hidden" name="reservation_id" value="<?php echo $reservation['RESERVATION_ID']; ?>">
    <button type="submit" class="btn btn-danger">Confirm Delete</button>
    <a href="list.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include_once '../includes/footer.php'; ?>