<?php
// Database configuration
$serverName = "localhost";
$connectionOptions = array(
    "Database" => "helpdesk",
    "Uid" => "root",
    "PWD" => ""
);

// Establish the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die("Connection failed: " . print_r(sqlsrv_errors(), true));
}

// Function to sanitize input data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>