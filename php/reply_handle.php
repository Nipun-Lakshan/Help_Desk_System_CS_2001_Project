<?php
/*
 * Reply Handler Script
 * ====================
 *
 * This script processes ticket replies submitted by staff members.
 * It validates the ticket exists, checks department authorization,
 * inserts the reply and updates the ticket status to 'completed'.
 * Uses database transactions for data integrity.
 */

// Start session and include database connection.
session_start();
require_once 'db_connection.php';

// Enable error reporting for debugging (should be disabled in production).
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the request method is POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve and sanitize form data.
    $ticket_id = isset($_POST['ticket_id']) ? $_POST['ticket_id'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $replied_by = isset($_POST['replied_by']) ? $_POST['replied_by'] : '';

    try {
        /*
         * Step 1: Validate Ticket Existence and Department Authorization.
         */
        $sql_1 = "SELECT * FROM tickets WHERE ticket_id = ?";
        $stmt_1 = $conn->prepare($sql_1);
        $stmt_1->bind_param("s", $ticket_id); 
        $stmt_1->execute();
        $result = $stmt_1->get_result();
        $row = $result->fetch_assoc();

        // Check if ticket exists.
        if (!$row) {
            header("Location: ../reply.php?error=ticket_not_found");
            exit();
        }

        // Check if staff member's department matches ticket department.
        if ($row['department'] != $_SESSION['department']) {
            header("Location: ../reply.php?error=unauthorized_attempt");
            exit();
        }

        $stmt_1->close();

        /*
         * Step 2: Begin Database Transaction for Data Integrity
         */
        $conn->begin_transaction();
        
        /*
         * Step 3: Insert the Reply into Database
         */
        $sql = "INSERT INTO reply 
                (ticket_id, description, replied_by, date) 
                VALUES (?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql);

        // Check if statement preparation was successful.
        if (!$stmt) {
            die("Error in preparing statement: " . $conn->error);
        }

        // Bind parameters and execute.
        $stmt->bind_param("sss", 
            $ticket_id, 
            $description,
            $replied_by
        );

        if (!$stmt->execute()) {
            throw new Exception("Error inserting reply: " . $stmt->error);
        }
        $stmt->close();
        
        /*
         * Step 4: Update Ticket Status to 'completed'
         */
        $update_sql = "UPDATE tickets SET status = 'completed' WHERE ticket_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        
        // Check if update statement preparation was successful.
        if (!$update_stmt) {
            throw new Exception("Error in preparing update statement: " . $conn->error);
        }
        
        $update_stmt->bind_param("s", $ticket_id);
        
        if (!$update_stmt->execute()) {
            throw new Exception("Error updating ticket status: " . $update_stmt->error);
        }

        $update_stmt->close();
        
        /*
         * Step 5: Commit Transaction if All Operations Succeeded
         */
        $conn->commit();
        
        // Redirect with success message.
        header("Location: ../reply.php?reply=success");
        exit();

    } catch (Exception $e) {
        /*
         * Step 6: Rollback Transaction on Error
         */
        $conn->rollback();
        die("Error: " . $e->getMessage());
    }

    // Close database connection.
    $conn->close();

} else {
    /*
     * Redirect if accessed directly without POST request
     */
    header("Location: reply.php");
    exit();
}
?>