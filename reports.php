<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tiny College - Monthly Reports</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>Monthly Reports</h1>
<nav>
    <a href="index.html">Home</a>
    <a href="search.php">Search Tables</a>
    <a href="add.php">Add Record</a>
    <a href="update.php">Update Record</a>
    <a href="reports.php">Monthly Reports</a>
</nav>

<form method="post" action="">
    <label for="month">Select Month:</label>
    <input type="month" id="month" name="month" required>

    <label for="report_type">Select Report:</label>
    <select id="report_type" name="report_type" required>
        <option value="mileage_by_vehicle">1) Mileage by Vehicle</option>
        <option value="mileage_by_department">2) Mileage by Department</option>
        <option value="mileage_by_faculty">3) Mileage by Faculty</option>
        <option value="revenue_by_vehicle">4) Fee Revenue by Vehicle</option>
        <option value="revenue_by_department">5) Fee Revenue by Department</option>
        <option value="parts_usage">6) Parts Usage</option>
        <option value="maintenance_summary">7) Vehicle Maintenance Summary</option>
    </select>

    <input type="submit" value="Generate Report">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $server = "127.0.0.1";
    $userName = "root";
    $pass = "";
    $db = "tiny_college_vmdb";

    $con = mysqli_connect($server, $userName, $pass, $db);
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $report_type = $_POST['report_type'];
    $month_input = $_POST['month'];
    $month = date("m", strtotime($month_input));
    $year = date("Y", strtotime($month_input));

    // Prepare base date filter
    // there is probably a better way to do this?
    $start_date = "$year-$month-01";
    $end_date = date("Y-m-t", strtotime($start_date));
    $query = "";

    switch ($report_type) {
        case "mileage_by_vehicle":
            $query = "
                SELECT V.VEHICLE_ID, V.VEHICLE_MAKEMODEL, SUM(TC.ODOMETER_END - TC.ODOMETER_START) AS TOTAL_MILES
                FROM TRIP_COMPLETION TC
                JOIN CHECKOUT C ON TC.CHECKOUT_ID = C.CHECKOUT_ID
                JOIN VEHICLE V ON C.VEHICLE_ID = V.VEHICLE_ID
                WHERE TC.RETURN_DATE BETWEEN '$start_date' AND '$end_date'
                GROUP BY V.VEHICLE_ID, V.VEHICLE_MAKEMODEL
                ORDER BY TOTAL_MILES DESC
            ";
            break;

        case "mileage_by_department":
            $query = "
                SELECT D.DEPARTMENT_NAME, SUM(TC.ODOMETER_END - TC.ODOMETER_START) AS TOTAL_MILES
                FROM TRIP_COMPLETION TC
                JOIN CHECKOUT C ON TC.CHECKOUT_ID = C.CHECKOUT_ID
                JOIN RESERVATION R ON C.RESERVATION_ID = R.RESERVATION_ID
                JOIN DEPARTMENT D ON R.DEPARTMENT_CODE = D.DEPARTMENT_CODE
                WHERE TC.RETURN_DATE BETWEEN '$start_date' AND '$end_date'
                GROUP BY D.DEPARTMENT_NAME
                ORDER BY TOTAL_MILES DESC
            ";
            break;

        case "mileage_by_faculty":
            $query = "
                SELECT F.FACULTY_LNAME, F.FACULTY_FNAME, SUM(TC.ODOMETER_END - TC.ODOMETER_START) AS TOTAL_MILES
                FROM TRIP_COMPLETION TC
                JOIN FACULTY F ON TC.FACULTY_ID = F.FACULTY_ID
                WHERE TC.RETURN_DATE BETWEEN '$start_date' AND '$end_date'
                GROUP BY F.FACULTY_ID
                ORDER BY TOTAL_MILES DESC
            ";
            break;

        case "revenue_by_vehicle":
            $query = "
                SELECT V.VEHICLE_ID, V.VEHICLE_MAKEMODEL, SUM(TC.MILEAGE_BILL) AS TOTAL_REVENUE
                FROM TRIP_COMPLETION TC
                JOIN CHECKOUT C ON TC.CHECKOUT_ID = C.CHECKOUT_ID
                JOIN VEHICLE V ON C.VEHICLE_ID = V.VEHICLE_ID
                WHERE TC.RETURN_DATE BETWEEN '$start_date' AND '$end_date'
                GROUP BY V.VEHICLE_ID
                ORDER BY TOTAL_REVENUE DESC
            ";
            break;

        case "revenue_by_department":
            $query = "
                SELECT D.DEPARTMENT_NAME, SUM(TC.MILEAGE_BILL) AS TOTAL_REVENUE
                FROM TRIP_COMPLETION TC
                JOIN CHECKOUT C ON TC.CHECKOUT_ID = C.CHECKOUT_ID
                JOIN RESERVATION R ON C.RESERVATION_ID = R.RESERVATION_ID
                JOIN DEPARTMENT D ON R.DEPARTMENT_CODE = D.DEPARTMENT_CODE
                WHERE TC.RETURN_DATE BETWEEN '$start_date' AND '$end_date'
                GROUP BY D.DEPARTMENT_NAME
                ORDER BY TOTAL_REVENUE DESC
            ";
            break;

        case "parts_usage":
            $query = "
                SELECT PT.PART_NAME, COUNT(*) AS TIMES_USED
                FROM MAINTENANCE_ITEM MI
                JOIN MAINTENANCE_LOG ML ON MI.LOG_ID = ML.LOG_ID
                JOIN PART_TYPE PT ON MI.PART_ID = PT.PART_ID
                WHERE ML.LOG_START_DATE BETWEEN '$start_date' AND '$end_date'
                GROUP BY PT.PART_NAME
                ORDER BY TIMES_USED DESC
            ";
            break;

        case "maintenance_summary":
            $query = "
                SELECT V.VEHICLE_ID, V.VEHICLE_MAKEMODEL, COUNT(*) AS MAINTENANCE_COUNT
                FROM MAINTENANCE_LOG ML
                JOIN VEHICLE V ON ML.VEHICLE_ID = V.VEHICLE_ID
                WHERE ML.LOG_START_DATE BETWEEN '$start_date' AND '$end_date'
                GROUP BY V.VEHICLE_ID
                ORDER BY MAINTENANCE_COUNT DESC
            ";
            break;
    }

    if ($query) {
        $result = mysqli_query($con, $query);
        if ($result) {
            echo "<h2>Report Results</h2>";
            echo "<table border='1'><tr>";
            while ($field = mysqli_fetch_field($result)) {
                echo "<th>" . htmlspecialchars($field->name) . "</th>";
            }
            echo "</tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $cell) {
                    echo "<td>" . htmlspecialchars($cell) . "</td>";
                }
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>Query Error: " . mysqli_error($con) . "</p>";
        }
    }

    mysqli_close($con);
}
?>

</body>
</html>
