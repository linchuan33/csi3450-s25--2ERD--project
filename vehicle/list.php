<?php
$pageTitle = "Vehicle List";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$vehicles = [
    ['VEHICLE_ID' => 1, 'TYPE' => 'sedan', 'MAKE' => 'Toyota', 'MODEL' => 'Camry', 'YEAR' => 2022, 'ODOMETER_READING' => 15000],
    ['VEHICLE_ID' => 2, 'TYPE' => 'minivan', 'MAKE' => 'Honda', 'MODEL' => 'Odyssey', 'YEAR' => 2021, 'ODOMETER_READING' => 22500],
    ['VEHICLE_ID' => 3, 'TYPE' => 'station wagon', 'MAKE' => 'Subaru', 'MODEL' => 'Outback', 'YEAR' => 2023, 'ODOMETER_READING' => 8700]
];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Vehicle List</h2>
    <a href="create.php" class="btn btn-success">Add New Vehicle</a>
</div>

<div class="table-container">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Make/Model</th>
                <th>Year</th>
                <th>Odometer</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vehicles as $vehicle): ?>
            <tr>
                <td><?php echo $vehicle['VEHICLE_ID']; ?></td>
                <td><?php echo $vehicle['TYPE']; ?></td>
                <td><?php echo $vehicle['MAKE'] . ' ' . $vehicle['MODEL']; ?></td>
                <td><?php echo $vehicle['YEAR']; ?></td>
                <td><?php echo $vehicle['ODOMETER_READING']; ?></td>
                <td>
                    <a href="view.php?id=<?php echo $vehicle['                     <a href="view.php?id=<?php echo $vehicle['VEHICLE_ID']; ?>" class="btn btn-sm btn-info btn-action">View</a>
                    <a href="edit.php?id=<?php echo $vehicle['VEHICLE_ID']; ?>" class="btn btn-sm btn-warning btn-action">Edit</a>
                    <a href="delete.php?id=<?php echo $vehicle['VEHICLE_ID']; ?>" class="btn btn-sm btn-danger btn-action" onclick="return confirmDelete('vehicle', <?php echo $vehicle['VEHICLE_ID']; ?>)">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once '../includes/footer.php'; ?>
 