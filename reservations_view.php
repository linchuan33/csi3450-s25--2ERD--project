<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reservations</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Reservation Search</h1>
    <nav>
        <a href="index.html">Home</a>
        <a href="search.php">Search Tables</a>
        <a href="add.php">Add Record</a>
        <a href="update.php">Update Record</a>
        <a href="reports.php">Monthly Reports</a>
    </nav>

    <form method="post">
        <label for="search_filter">Enter WHERE condition (optional):</label>
        <input type="text" name="search_filter" id="search_filter" placeholder="e.g. FACULTY_ID = 1">
        <button type="submit" name="view_reservations">View Reservations</button>
    </form>

<?php

$server = "127.0.0.1";
$userName = "root";
$pass = "";
$db = "tiny_college_vmdb";
$con = mysqli_connect($server, $userName, $pass, $db);

if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Delete reservation (working?)
if (isset($_POST['delete'], $_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $stmt_del = $con->prepare("DELETE FROM RESERVATION WHERE RESERVATION_ID = ?");
    $stmt_del->bind_param("i", $delete_id);
    if ($stmt_del->execute()) {
        echo "<p style='color:green;'>Reservation deleted successfully.</p>";
    } else {
        echo "<p style='color:red;'>Failed to delete reservation.</p>";
    }
}

// Checkout
if (isset($_POST['checkout'], $_POST['checkout_id'], $_POST['vehicle_id'], $_POST['form_signed'])) {
    $checkout_id = intval($_POST['checkout_id']);
    $vehicle_id = intval($_POST['vehicle_id']);

    if ($checkout_id > 0 && $vehicle_id > 0) {
        // Get FACULTY_ID
        $stmt_faculty = $con->prepare("SELECT FACULTY_ID FROM RESERVATION WHERE RESERVATION_ID = ?");
        $stmt_faculty->bind_param("i", $checkout_id);
        $stmt_faculty->execute();
        $res = $stmt_faculty->get_result();

        if ($res->num_rows === 0) {
            echo "<p style='color:red;'>Invalid reservation ID.</p>";
        } else {
            $faculty = $res->fetch_assoc()['FACULTY_ID'];
            $checkout_date = date('Y-m-d');

            // Prevent checking out an already checked out item (shouldn't be possible with current UI)
            $stmt_check = $con->prepare("SELECT COUNT(*) AS count FROM CHECKOUT WHERE RESERVATION_ID = ?");
            $stmt_check->bind_param("i", $checkout_id);
            $stmt_check->execute();
            $count = $stmt_check->get_result()->fetch_assoc()['count'];

            if ($count > 0) {
                echo "<p style='color:red;'>This reservation has already been checked out.</p>";
            } else {
                $stmt_insert = $con->prepare(
                    "INSERT INTO CHECKOUT (RESERVATION_ID, VEHICLE_ID, FACULTY_ID, CHECKOUT_DATE) 
                     VALUES (?, ?, ?, ?)"
                );
                $stmt_insert->bind_param("iiis", $checkout_id, $vehicle_id, $faculty, $checkout_date);

                if ($stmt_insert->execute()) {
                    echo "<p style='color:blue;'>Reservation checked out successfully.</p>";
                } else {
                    echo "<p style='color:red;'>Error checking out reservation: " . $stmt_insert->error . "</p>";
                }
            }
        }
    } else {
        echo "<p style='color:red;'>Invalid reservation or vehicle ID.</p>";
    }
}

// Get reservations
$search_filter = isset($_POST["search_filter"]) ? trim($_POST["search_filter"]) : '';
$query = "SELECT r.*, c.VEHICLE_ID AS checked_out_vehicle, c.RESERVATION_ID AS checked_out_id 
          FROM RESERVATION r 
          LEFT JOIN CHECKOUT c ON r.RESERVATION_ID = c.RESERVATION_ID";

if ($search_filter != '') {
    $query .= " WHERE " . $search_filter;
}
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    echo "<h2>Reservation Table</h2>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr>
            <th>RESERVATION_ID</th>
            <th>DEPARTMENT_CODE</th>
            <th>FACULTY_ID</th>
            <th>VEHICLE_TYPE</th>
            <th>EXPECTED_DEPARTURE</th>
            <th>EXPECTED_RETURN</th>
            <th>DESTINATION</th>
            <th>Status / Actions</th>
          </tr>";

    $today = strtotime(date("Y-m-d"));

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['RESERVATION_ID']}</td>";
        echo "<td>{$row['DEPARTMENT_CODE']}</td>";
        echo "<td>{$row['FACULTY_ID']}</td>";
        echo "<td>{$row['VEHICLE_TYPE']}</td>";
        echo "<td>{$row['EXPECTED_DEPARTURE']}</td>";
        echo "<td>{$row['EXPECTED_RETURN']}</td>";
        echo "<td>{$row['DESTINATION']}</td>";

        $departure = strtotime($row['EXPECTED_DEPARTURE']);
        $checked_out = !is_null($row['checked_out_id']);

        echo "<td>";
        if ($checked_out) {
            echo "Checked Out";
        } elseif ($departure >= $today) {
            // Delete form
            echo "<form method='post' style='display:inline;' 
                    onsubmit='return confirm(\"Are you sure you want to delete this reservation?\");'>
                <input type='hidden' name='search_filter' value='" . htmlspecialchars($search_filter, ENT_QUOTES) . "'>
                <input type='hidden' name='delete_id' value='{$row['RESERVATION_ID']}'>
                <button type='submit' name='delete' style='color:red;'>Delete</button>
            </form>";

            // View Vehicles form
            echo "<form method='post' style='display:inline; margin-left:10px;'>
                <input type='hidden' name='view_vehicles' value='1'>
                <input type='hidden' name='vehicle_type' value='{$row['VEHICLE_TYPE']}'>
                <input type='hidden' name='reservation_id' value='{$row['RESERVATION_ID']}'>
                <button type='submit'>View Vehicles</button>
            </form>";

        } else {
            echo "Past Reservation";
        }
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No reservations found.</p>";
}

// Show vehicles of target vehicle type that are NOT in maintenance (that are available)
if (isset($_POST['view_vehicles'], $_POST['vehicle_type'], $_POST['reservation_id'])) {
    $vehicle_type = mysqli_real_escape_string($con, $_POST['vehicle_type']);
    $reservation_id = intval($_POST['reservation_id']);

    $vehicle_query = "SELECT * FROM VEHICLE WHERE VEHICLE_TYPE = '$vehicle_type' AND VEHICLE_STATUS = 'AVAILABLE'";
    $vehicle_result = mysqli_query($con, $vehicle_query);

    if ($vehicle_result && mysqli_num_rows($vehicle_result) > 0) {
        echo "<h2>Available Vehicles of type $vehicle_type</h2>";
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr><th>VEHICLE_ID</th><th>MAKE/Model</th><th>Assign to Reservation</th></tr>";
        while ($v = mysqli_fetch_assoc($vehicle_result)) {
            echo "<tr>";
            echo "<td>{$v['VEHICLE_ID']}</td>";
            echo "<td>{$v['VEHICLE_MAKEMODEL']}</td>";
            echo "<td>
                <form method='post'>
                    <input type='hidden' name='checkout_id' value='$reservation_id'>
                    <input type='hidden' name='vehicle_id' value='{$v['VEHICLE_ID']}'>
                    <label>
                        <input type='checkbox' name='form_signed'> Checkout Form Signed?
                    </label>
                    <button type='submit' name='checkout'>Checkout</button>
                </form>
              </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No vehicles available for this type.</p>";
    }
}

mysqli_close($con);
?>

</body>
</html>