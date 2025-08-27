<?php
require_once 'db_connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_reg_number = isset($_POST['student_reg_number']) ? $_POST['student_reg_number'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $department = isset($_POST['department']) ? $_POST['department'] : '';

    if (empty($student_reg_number) || empty($description) || empty($department)) {
        die("All fields are required.");
    }

    try {
        $sql = "INSERT INTO tickets 
                (student_reg_number, description, department, date) 
                VALUES (?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error in preparing statement: " . $conn->error);
        }

        $stmt->bind_param("sss", 
            $student_reg_number, 
            $description,
            $department
        );

        if ($stmt->execute()) {
            header("Location: ../create_ticket.php?registration=success");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();

    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }

    $conn->close();

} else {
    header("Location: create_ticket.php");
    exit();
}
?>