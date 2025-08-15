<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TFBS DB Search</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>Search Tables</h1>
<nav>
    <a href="index.html">Home</a>
    <a href="search.php">Search Tables</a>
    <a href="add.php">Add Record</a>
    <a href="update.php">Update Record</a>
    <a href="reports.php">Monthly Reports</a>
</nav>

<form id="searchForm" method="post" action="">
    <label for="table">Table (required):</label>
    <input type="text" name="table" id="table" required><br>

    <label for="search_filter">Search Filter (WHERE, e.g. "id=1"):</label>
    <input type="text" name="search_filter" id="search_filter"><br>

    <input type="submit" value="Search">
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

// Create connection
$con = mysqli_connect($server, $userName, $pass, $db);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit;
}

// Handle deletion
if (isset($_POST['delete']) && isset($_POST['delete_id']) && isset($_POST['table'])) {
    $delete_id = mysqli_real_escape_string($con, $_POST['delete_id']); 
    $table_to_delete = mysqli_real_escape_string($con, $_POST['table']);

    // Try to get the primary key dynamically (first column)
    $pk_result = mysqli_query($con, "SHOW COLUMNS FROM `$table_to_delete`");
    if ($pk_result) {
        $first_col = mysqli_fetch_assoc($pk_result);
        $primary_key = $first_col['Field'];
        $delete_query = "DELETE FROM `$table_to_delete` WHERE `$primary_key`='$delete_id'";
        mysqli_query($con, $delete_query);
    }
}

// Handle search/display
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['delete'])) {
    $table = trim($_POST['table']);
    $search_filter = trim($_POST['search_filter']);

    // Redirect if table is reservation
    if ($table === 'reservation') {
        header("Location: reservations_view.php");
        exit;
    }

    if ($search_filter == "") {
        $query = "SELECT * FROM `$table`";
    } else {
        $query = "SELECT * FROM `$table` WHERE $search_filter";
    }

    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<table border='1'>";
        
        // Table header
        echo "<tr>";
        $fields = mysqli_fetch_fields($result);
        foreach ($fields as $field) {
            echo "<th>" . htmlspecialchars($field->name) . "</th>";
        }
        echo "<th>Actions</th>"; // extra column for Delete button
        echo "</tr>";

        // Table rows
        $primary_key = $fields[0]->name; // use first column as primary key
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
            }
            // Add Delete button form
            echo "<td>
                    <form method='post' style='margin:0;'>
                        <input type='hidden' name='delete_id' value='" . htmlspecialchars($row[$primary_key]) . "'>
                        <input type='hidden' name='table' value='" . htmlspecialchars($table) . "'>
                        <input type='submit' name='delete' value='Delete' onclick='return confirm(\"Are you sure you want to delete this record?\")'>
                    </form>
                  </td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Query failed: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>

</body>
</html>
