<?php
$pageTitle = "Reservation List";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$reservations = [
    ['RESERVATION_ID' => 1, 'FACULTY_ID' => 1, 'FACULTY_NAME' => 'John Smith', 'VEHICLE_ID' => 1, 'VEHICLE_INFO' => 'Toyota Camry (sedan)', 'EXPECTED_DEPARTURE_DATE' => '2025-08-15', 'EXPECTED_RETURN_DATE' => '2025-08-17', 'DESTINATION' => 'Detroit, MI', 'STATUS' => 'Pending'],
    ['RESERVATION_ID' => 2, 'FACULTY_ID' => 2, 'FACULTY_NAME' => 'Mary Johnson', 'VEHICLE_ID' => 3, 'VEHICLE_INFO' => 'Subaru Outback (station wagon)', 'EXPECTED_DEPARTURE_DATE' => '2025-08-20', 'EXPECTED_RETURN_DATE' => '2025-08-22', 'DESTINATION' => 'Chicago, IL', 'STATUS' => 'Approved'],
    ['RESERVATION_ID' => 3, 'FACULTY_ID' => 3, 'FACULTY_NAME' => 'Robert Williams', 'VEHICLE_ID' => 2, 'VEHICLE_INFO' => 'Honda Odyssey (minivan)', 'EXPECTED_DEPARTURE_DATE' => '2025-09-01', 'EXPECTED_RETURN_DATE' => '2025-09-03', 'DESTINATION' => 'Columbus, OH', 'STATUS' => 'Completed']
];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Reservation List</h2>
    <a href="create.php" class="btn btn-success">Add New Reservation</a>
</div>

<div class="table-container">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Faculty</th>
                <th>Vehicle</th>
                <th>Departure Date</th>
                <th>Return Date</th>
                <th>Destination</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $reservation): ?>
            <tr>
                <td><?php echo $reservation['RESERVATION_ID']; ?></td>
                <td><?php echo $reservation['FACULTY_NAME']; ?></td>
                <td><?php echo $reservation['VEHICLE_INFO']; ?></td>
                <td><?php echo $reservation['EXPECTED_DEPARTURE_DATE']; ?></td>
                <td><?php echo $reservation['EXPECTED_RETURN_DATE']; ?></td>
                <td><?php echo $reservation['DESTINATION']; ?></td>
                <td>
                    <span class="badge <?php 
                        if ($reservation['STATUS'] == 'Pending') echo 'bg-warning';
                        else if ($reservation['STATUS'] == 'Approved') echo 'bg-success';
                        else if ($reservation['STATUS'] == 'Completed') echo 'bg-info';
                        else echo 'bg-secondary';
                    ?>"><?php echo $reservation['STATUS']; ?></span>
                </td>
                <td>
                    <a href="view.php?id=<?php echo $reservation['RESERVATION_ID']; ?>" class="btn btn-sm btn-info btn-action">View</a>
                    <a href="edit.php?id=<?php echo $reservation['RESERVATION_ID']; ?>" class="btn btn-sm btn-warning btn-action">Edit</a>
                    <a href="delete.php?id=<?php echo $reservation['RESERVATION_ID']; ?>" class="btn btn-sm btn-danger btn-action" onclick="return confirmDelete('reservation', <?php echo $reservation['RESERVATION_ID']; ?>)">Delete</a>
                </td>
                        </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once '../includes/footer.php'; ?>

            