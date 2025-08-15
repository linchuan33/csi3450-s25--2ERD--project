<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Record - Tiny College DB</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>Add Record</h1>

<nav>
    <a href="index.html">Home</a>
    <a href="search.php">Search Tables</a>
    <a href="add.php">Add Record</a>
    <a href="update.php">Update Record</a>
    <a href="reports.php">Monthly Reports</a>
</nav>

<form method="post" action="">
    <label for="table">Table (required):</label>
    <input type="text" name="table" id="table" required><br>
    <input type="submit" value="Select Table">
</form>

<p>
    <!-- Table names as clickable spans -->
    <span class="table-name" onclick="setTable('checkout')">checkout</span> |
    <span class="table-name" onclick="setTable('department')">department</span> |
    <span class="table-name" onclick="setTable('faculty')">faculty</span> |
    <span class="table-name" onclick="setTable('maintenance_item')">maintenance_item</span> |
    <span class="table-name" onclick="setTable('maintenance_log')">maintenance_log</span> |
    <span class="table-name" onclick="setTable('mechanic')">mechanic</span> |
    <span class="table-name" onclick="setTable('part_type')">part_type</span> |
    <span class="table-name" onclick="setTable('reservation')">reservation</span> |
    <span class="table-name" onclick="setTable('trip_completion')">trip_completion</span> |
    <span class="table-name" onclick="setTable('vehicle')">vehicle</span> |
    <span class="table-name" onclick="setTable('vehicle_type')">vehicle_type</span>
</p>

<script>
    function setTable(name) {
        document.getElementById('table').value = name;
    }
</script>

<?php
$server = "127.0.0.1";
$userName = "root";
$pass = "";
$db = "tiny_college_vmdb";
$con = mysqli_connect($server, $userName, $pass, $db);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // If we are adding a row
    if (isset($_POST['insert']) && !empty($_POST['table'])) {
        $table = strtoupper(trim($_POST['table']));

        $fields = [];
        $values = [];
        foreach ($_POST as $key => $value) {
            // Syntax fixed? Check again here, something was causing errors
            if ($key !== 'table' && $key !== 'insert') {
                $fields[] = "`" . mysqli_real_escape_string($con, $key) . "`";
                $values[] = "'" . mysqli_real_escape_string($con, $value) . "'";
            }
        }

        if (!empty($fields)) {
            $query = "INSERT INTO `$table` (" . implode(",", $fields) . ") VALUES (" . implode(",", $values) . ")";
            if (mysqli_query($con, $query)) {
                echo "<p style='color:green;'>Record added successfully to $table!</p>";
            } else {
                echo "<p style='color:red;'>Error: " . mysqli_error($con) . "</p>";
            }
        }
    }
    // If we are selecting a table to display fields
    elseif (!empty($_POST['table'])) {
        $table = strtoupper(trim($_POST['table']));

        if ($table === 'RESERVATION') {
            header("Location: reservations_new.php");
            exit;
        }

        $columns_result = mysqli_query($con, "SHOW COLUMNS FROM `$table`");
        if (!$columns_result) {
            echo "Table not found or error: " . mysqli_error($con);
            exit;
        }

        echo "<h2>Add Record to $table</h2>";
        echo "<form method='post' action='add.php'>";
        echo "<input type='hidden' name='table' value='" . htmlspecialchars($table) . "'>";

        while ($col = mysqli_fetch_assoc($columns_result)) {
            $col_name = $col['Field'];
            $col_type = $col['Type'];

            echo "<label for='$col_name'>$col_name:</label>";
            echo "<input type='text' placeholder='$col_name ($col_type)' name='$col_name' id='$col_name'><br>";
        }

        echo "<input type='submit' name='insert' value='Insert'>";
        echo "</form>";
    }
}

mysqli_close($con);
?>


</body>
</html>
