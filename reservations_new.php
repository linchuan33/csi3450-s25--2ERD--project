<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reservations</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Add Reservation</h1>
    <nav>
        <a href="index.html">Home</a>
        <a href="search.php">Search Tables</a>
        <a href="add.php">Add Record</a>
        <a href="update.php">Update Record</a>
        <a href="reports.php">Monthly Reports</a>
    </nav>
    <form method="post">
        <label for="reservation_id">Reservation ID:</label>
        <input type="text" name="reservation_id" id="reservation_id" required><br><br>

        <label for="department_code">Department Code:</label>
        <input type="text" name="department_code" id="department_code" required><br><br>

        <label for="faculty_id">Faculty ID:</label>
        <input type="text" name="faculty_id" id="faculty_id" required><br><br>

        <label for="vehicle_type">Vehicle Type:</label>
        <input type="text" name="vehicle_type" id="vehicle_type" required><br><br>

        <label for="expected_departure">Expected Departure:</label>
        <input type="date" name="expected_departure" id="expected_departure" required><br><br>

        <label for="expected_return">Expected Return:</label>
        <input type="date" name="expected_return" id="expected_return" required><br><br>

        <label for="destination">Destination:</label>
        <input type="text" name="destination" id="destination" required><br><br>

        <button type="submit" name="add_reservation">Add Reservation</button>
    </form>

    <?php
        $server = "127.0.0.1";
        $userName = "root";
        $pass = "";
        $db = "tiny_college_vmdb";

        $con = mysqli_connect($server, $userName, $pass, $db);

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        if (isset($_POST['add_reservation'])) {
            $reservation_id = $_POST['reservation_id'];
            $department_code = $_POST['department_code'];
            $faculty_id = $_POST['faculty_id'];
            $vehicle_type = $_POST['vehicle_type'];
            $expected_departure = $_POST['expected_departure'];
            $expected_return = $_POST['expected_return'];
            $destination = $_POST['destination'];

            $sql = "INSERT INTO RESERVATION (RESERVATION_ID, DEPARTMENT_CODE, FACULTY_ID, VEHICLE_TYPE, EXPECTED_DEPARTURE, EXPECTED_RETURN, DESTINATION) 
                    VALUES ('$reservation_id', '$department_code', '$faculty_id', '$vehicle_type', '$expected_departure', '$expected_return', '$destination')";

            if (mysqli_query($con, $sql)) {
                echo "<p>Reservation added successfully.</p>";
            } else {
                echo "<p>Error: " . mysqli_error($con) . "</p>";
            }
        }

        mysqli_close($con);
    ?>
</body>
</html>