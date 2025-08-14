<?php
include_once '../includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $facultyId = $_POST['faculty_id'];
    
    $query = "DELETE FROM faculty WHERE FACULTY_ID = ?";
    executeQuery($query, [$facultyId]);
    
    header("Location: list.php");
    exit;
} else {
    header("Location: list.php");
    exit;
}
?>