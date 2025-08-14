<?php
$pageTitle = "Edit Reservation";
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$reservation = [
    'RESERVATION_ID' => 1,
    'FACULTY_ID' => 1,
    'VEHICLE_ID' => 1,
    'EXPECTED_DEPARTURE_DATE' => '2025-08-15',
    'EXPECTED_RETURN_DATE' => '2025-08-17',
    'DESTINATION' => 'Detroit, MI',
    'STATUS' => 'Pending'
];

$faculty = [
    ['FACULTY_ID' => 1, 'FACULTY_NAME' => 'John Smith'],
    ['FACULTY_ID' => 2, 'FACULTY_NAME' => 'Mary Johnson'],
    ['FACULTY_ID' => 3, 'FACULTY_NAME' => 'Robert Williams']
];

$vehicles = [
    ['VEHICLE_ID' => 1, 'VEHICLE_INFO' => 'Toyota Camry (sedan)'],
    ['VEHICLE_ID' => 2, 'VEHICLE_INFO' => 'Honda Odyssey (minivan)'],
    ['VEHICLE_ID' => 3, 'VEHICLE_INFO' => 'Subaru Outback (station wagon)']
];

$statuses = ['Pending', 'Approved', 'Completed', 'Cancelled'];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Reservation</h2>
    <a href="list.php" class="btn btn-secondary">Back to List</a>
</div>

<div class="form-container">
    <form action="edit_process.php" method="post" class="needs-validation" novalidate>
        <input type="hidden" name="reservation_id" value="<?php echo $reservation['RESERVATION_ID']; ?>">
        
        <div class="mb-3">
            <label for="faculty_id" class="form-label required">Faculty</label>
            <select class="form-select" id="faculty_id" name="faculty_id" required>
                <option value="">Select Faculty</option>
                <?php foreach ($faculty as $member): ?>
                <option value="<?php echo $member['FACULTY_ID']; ?>" <?php if ($member['FACULTY_ID'] == $reservation['FACULTY_ID']) echo 'selected'; ?>><?php echo $member['FACULTY_NAME']; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Please select a faculty member.</div>
        </div>
        
        <div class="mb-3">
            <label for="vehicle_id" class="form-label required">Vehicle</label>
            <select class="form-select" id="vehicle_id" name="vehicle_id" required>
                <option value="">Select Vehicle</option>
                <?php foreach ($vehicles as $vehicle): ?>
                <option value="<?php echo $vehicle['VEHICLE_ID']; ?>" <?php if ($vehicle['VEHICLE_ID'] == $reservation['VEHICLE_ID']) echo 'selected'; ?>><?php echo $vehicle['VEHICLE_INFO']; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Please select a vehicle.</div>
        </div>
        
        <div class="mb-3">
            <label for="expected_departure_date" class="form-label required">Expected Departure Date</label>
            <input type="date" class="form-control" id="expected_departure_date" name="expected_departure_date" value="<?php echo $reservation['EXPECTED_DEPARTURE_DATE']; ?>" required>
            <div class="invalid-feedback">Please select an expected departure date.</div>
        </div>
        
        <div class="mb-3">
            <label for="expected_return_date" class="form-label required">Expected Return Date</label>
            <input type="date" class="form-control" id="expected_return_date" name="expected_return_date" value="<?php echo $reservation['EXPECTED_RETURN_DATE']; ?>" required>
            <div class="invalid-feedback">Please select an expected return date.</div>
        </div>
        
        <div class="mb-3">
            <label for="destination" class="form-label required">Destination</label>
            <input type="text" class="form-control" id="destination" name="destination" value="<?php echo $reservation['DESTINATION']; ?>" required>
            <div class="invalid-feedback">Please enter a destination.</div>
        </div>
        
        <div class="mb-3">
            <label for="status" class="form-label required">Status</label>
            <select class="form-select" id="status" name="status" required>
                <?php foreach ($statuses as $status): ?>
                <option value="<?php echo $status; ?>" <?php if ($status == $reservation['STATUS']) echo 'selected'; ?>><?php echo $status; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Please select a status.</div>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Reservation</button>
        <a href="list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include_once '../includes/footer.php'; ?>