<?php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $student_reg_num = sanitizeInput($_POST['student_reg_num']);
    $student_index_num = sanitizeInput($_POST['student_index_num']);
    $student_name = sanitizeInput($_POST['student_name']);
    $student_password = sanitizeInput($_POST['password']);
    
    // Basic validation
    if (empty($reg_num) || empty($index_num) || empty($name) || empty($password)) {
        die("All fields are required.");
    }
    
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Prepare SQL statement to prevent SQL injection
    $sql = "INSERT INTO users (student_reg_num, student_index_num, student_name, student_password) 
            VALUES (?, ?, ?, ?)";
    
    $params = array($student_reg_nu, $student_index_num, $student_name, $hashed_password);
    $stmt = sqlsrv_prepare($conn, $sql, $params);
    
    if (sqlsrv_execute($stmt)) {
        // Registration successful
        header("Location: login.html?registration=success");
        exit();
    } else {
        // Registration failed
        echo "Error: " . print_r(sqlsrv_errors(), true);
    }
    
    // Close the statement and connection
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
} else {
    // Not a POST request
    header("Location: register.html");
    exit();
}
?>