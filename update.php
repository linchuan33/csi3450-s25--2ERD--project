<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record - Tiny College DB</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>Update Record</h1>

<nav>
    <a href="index.html">Home</a>
    <a href="search.php">Search Tables</a>
    <a href="add.php">Add Record</a>
    <a href="update.php">Update Record</a>
    <a href="reports.php">Monthly Reports</a>
</nav>

<!-- First form: choose table -->
<form method="post" action="">
    <label for="table">Table (required):</label>
    <input type="text" name="table" id="table" required>
    <input type="submit" value="Select Table">
</form>

<p>
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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['table']) && empty($_POST['primary_value'])) {
    $server = "127.0.0.1";
    $userName = "root";
    $pass = "";
    $db = "tiny_college_vmdb";

    $table = trim($_POST['table']);

    $con = mysqli_connect($server, $userName, $pass, $db);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
    }

    // Get columns
    $columns_result = mysqli_query($con, "SHOW COLUMNS FROM `$table`");
    if (!$columns_result) {
        echo "Table not found or error: " . mysqli_error($con);
        exit;
    }

    // Fetch first column as primary key
    $first_col = mysqli_fetch_assoc($columns_result);
    $primary_key = $first_col['Field'];

    // Reset pointer to first column for loop
    mysqli_data_seek($columns_result, 0);

    echo "<h2>Update Record in $table</h2>";
    echo "<form method='post' action=''>";
    echo "<input type='hidden' name='table' value='" . htmlspecialchars($table) . "'>";
    echo "<input type='hidden' name='primary_key' value='" . htmlspecialchars($primary_key) . "'>";

    echo "<label for='primary_value'>Primary Key Value ($primary_key):</label>";
    echo "<input type='text' name='primary_value' id='primary_value' required><br>";

    echo "<p>Enter new values for the columns you want to change<br>(leave blank to keep the current value):</p>";

    while ($col = mysqli_fetch_assoc($columns_result)) {
        $col_name = $col['Field'];
        $col_type = $col['Type'];

        // Skip primary key field
        if ($col_name === $primary_key) continue;

        echo "<label for='$col_name'>$col_name ($col_type):</label>";
        echo "<input type='text' name='fields[$col_name]' id='$col_name'><br>";
    }

    echo "<input type='submit' value='Update'>";
    echo "</form>";

    mysqli_close($con);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['primary_value']) && isset($_POST['primary_key'])) {
    $server = "127.0.0.1";
    $userName = "root";
    $pass = "";
    $db = "tiny_college_vmdb";

    $con = mysqli_connect($server, $userName, $pass, $db);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
    }

    $table = mysqli_real_escape_string($con, $_POST['table']);
    $primary_key = mysqli_real_escape_string($con, $_POST['primary_key']);
    $primary_value = mysqli_real_escape_string($con, $_POST['primary_value']);
    $fields = $_POST['fields'];

    $set_clauses = [];
    foreach ($fields as $col => $val) {
        if ($val !== '') {
            $safe_col = mysqli_real_escape_string($con, $col);
            $safe_val = mysqli_real_escape_string($con, $val);
            $set_clauses[] = "`$safe_col` = '$safe_val'";
        }
    }

    if (!empty($set_clauses)) {
        $set_sql = implode(", ", $set_clauses);
        $query = "UPDATE `$table` SET $set_sql WHERE `$primary_key` = '$primary_value'";

        if (mysqli_query($con, $query)) {
            echo "<p>Record updated successfully in table <strong>$table</strong>.</p>";
        } else {
            echo "<p>Update failed: " . mysqli_error($con) . "</p>";
        }
    } else {
        echo "<p>No changes entered.</p>";
    }

    mysqli_close($con);
}
?>
</body>
</html>
