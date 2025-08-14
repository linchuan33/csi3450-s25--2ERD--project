<?php
$pageTitle = "Trip Completion Forms";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$tripForms = [
    ['FORM_ID' => 1, 'FACULTY_ID' => 1, 'FACULTY_NAME' => 'John Smith', 'VEHICLE_ID' => 1, 'VEHICLE_INFO' => 'Toyota Camry (sedan)', 'START_ODOMETER' => 15000, 'END_ODOMETER' => 15350, 'COMPLETION_DATE' => '2025-08-17', 'FUEL_PURCHASED' => 12.5],
    [' ['FORM_ID' => 2, 'FACULTY_ID' => 2, 'FACULTY_NAME' => 'Mary Johnson', 'VEHICLE_ID' => 3, 'VEHICLE_INFO' => 'Subaru Outback (station wagon)', 'START_ODOMETER' => 8700, 'END_ODOMETER' => 9200, 'COMPLETION_DATE' => '2025-08-22', 'FUEL_PURCHASED' => 15.2],
    ['FORM_ID' => 3, 'FACULTY_ID' => 3, 'FACULTY_NAME' => 'Robert Williams', 'VEHICLE_ID' => 2, 'VEHICLE_INFO' => 'Honda Odyssey (minivan)', 'START_ODOMETER' => 22500, 'END_ODOMETER' => 23100, 'COMPLETION_DATE' => '2025-09-03', 'FUEL_PURCHASED' => 18.7]
];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Trip Completion Forms</h2>
    <a href="create.php" class="btn btn-success">Add New Form</a>
</div>

<div class="table-container">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Faculty</th>
                <th>Vehicle</th>
                <th>Completion Date</th>
                <th>Miles Driven</th>
                <th>Fuel Purchased</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tripForms as $form): ?>
            <tr>
                <td><?php echo $form['FORM_ID']; ?></td>
                <td><?php echo $form['FACULTY_NAME']; ?></td>
                <td><?php echo $form['VEHICLE_INFO']; ?></td>
                <td><?php echo $form['COMPLETION_DATE']; ?></td>
                <td><?php echo $form['END_ODOMETER'] - $form['START_ODOMETER']; ?> miles</td>
                <td><?php echo $form['FUEL_PURCHASED']; ?> gallons</td>
                <td>
                    <a href="view.php?id=<?php echo $form['FORM_ID']; ?>" class="btn btn-sm btn-info btn-action">View</a>
                    <a href="edit.php?id=<?php echo $form['FORM_ID']; ?>" class="btn btn-sm btn-warning btn-action">Edit</a>
                    <a href="delete.php?id=<?php echo $form['FORM_ID']; ?>" class="btn btn-sm btn-danger btn-action" onclick="return confirmDelete('trip form', <?php echo $form['FORM_ID']; ?>)">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once '../includes/footer.php'; ?>
