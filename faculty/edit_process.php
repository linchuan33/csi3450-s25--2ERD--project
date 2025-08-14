<?php
include_once '../includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $facultyId = $_POST['faculty_id'];
    $firstName = $_POST['faculty_fname'];
    $lastName = $_POST['faculty_lname'];
    $email = $_POST['faculty_email'];
    $departmentCode = $_POST['department_code'];
    
    $query = "UPDATE faculty SET FACULTY_FNAME = ?, FACULTY_LNAME = ?, FACULTY_EMAIL = ?, DEPARTMENT_CODE = ? WHERE FACULTY_ID = ?";
    executeQuery($query, [$firstName, $lastName, $email, $departmentCode, $facultyId]);
    
    header("Location: list.php");
    exit;
} else {
    header("Location: list.php");
    exit;
}
?>