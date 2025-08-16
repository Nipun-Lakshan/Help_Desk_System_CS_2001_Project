<?php
require_once 'db_connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticket_id = isset($_POST['ticket_id']) ? $_POST['ticket_id'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $replied_by = isset($_POST['replied_by']) ? $_POST['replied_by'] : '';

    if (empty($ticket_id) || empty($description) || empty($replied_by)) {
        die("All fields are required.");
    }

    try {
        // Start transaction
        $conn->begin_transaction();
        
        // 1. Insert the reply
        $sql = "INSERT INTO reply 
                (ticket_id, description, replied_by, date) 
                VALUES (?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error in preparing statement: " . $conn->error);
        }

        $stmt->bind_param("sss", 
            $ticket_id, 
            $description,
            $replied_by
        );

        if (!$stmt->execute()) {
            throw new Exception("Error inserting reply: " . $stmt->error);
        }
        $stmt->close();
        
        // 2. Update the ticket status to 'completed'
        $update_sql = "UPDATE tickets SET status = 'completed' WHERE ticket_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        
        if (!$update_stmt) {
            throw new Exception("Error in preparing update statement: " . $conn->error);
        }
        
        $update_stmt->bind_param("s", $ticket_id);
        
        if (!$update_stmt->execute()) {
            throw new Exception("Error updating ticket status: " . $update_stmt->error);
        }
        $update_stmt->close();
        
        // Commit transaction if both queries succeeded
        $conn->commit();
        
        header("Location: ../reply.html?registration=success");
        exit();

    } catch (Exception $e) {
        // Roll back transaction if any error occurs
        $conn->rollback();
        die("Error: " . $e->getMessage());
    }

    $conn->close();

} else {
    header("Location: reply.html");
    exit();
}
?>