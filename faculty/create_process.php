<?php
include_once '../includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['faculty_fname'];
    $lastName = $_POST['faculty_lname'];
    $email = $_POST['faculty_email'];
    $departmentCode = $_POST['department_code'];
    
    $query = "INSERT INTO faculty (FACULTY_FNAME, FACULTY_LNAME, FACULTY_EMAIL, DEPARTMENT_CODE) VALUES (?, ?, ?, ?)";
    executeQuery($query, [$firstName, $lastName, $email, $departmentCode]);
    
    header("Location: list.php");
    exit;
} else {
    header("Location: create.php");
    exit;
}
?>