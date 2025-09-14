<?php
/*
 * Create Ticket Handler Script
 * ============================
 *
 * This script processes the creation of new help desk tickets submitted by students.
 * It validates and inserts ticket data into the database.
 */

// Include database connection.
require_once 'db_connection.php';

// Enable error reporting for debugging (should be disabled in production).
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the request method is POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve and sanitize form data.
    $student_reg_number = isset($_POST['student_reg_number']) ? $_POST['student_reg_number'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $department = isset($_POST['department']) ? $_POST['department'] : '';

    try {
        /*
         * SQL Query to insert new ticket into database.
         * Includes current timestamp for the ticket creation date.
         */
        $sql = "INSERT INTO tickets 
                (student_reg_number, description, department, date) 
                VALUES (?, ?, ?, NOW())";

        // Prepare the SQL statement.
        $stmt = $conn->prepare($sql);

        // Check if statement preparation was successful.
        if (!$stmt) {
            die("Error in preparing statement: " . $conn->error);
        }

        // Bind parameters to prevent SQL injection.
        $stmt->bind_param("sss", 
            $student_reg_number, 
            $description,
            $department
        );
        
        // Execute the statement and handle result.
        if ($stmt->execute()) {
            // Redirect with success message.
            header("Location: ../create_ticket.php?ticket=created");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement.
        $stmt->close();

    } catch (Exception $e) {
        // Handle any exceptions that occur during database operations.
        die("Error: " . $e->getMessage());
    }

    // Close database connection.
    $conn->close();

} else {
    /*
     * Redirect if accessed directly without POST request.
     */
    header("Location: create_ticket.php?error=submission_failed");
    exit();
}
?>