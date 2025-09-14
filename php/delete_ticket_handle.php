<?php
/*
 * Delete Ticket Handler
 * =====================
 *
 * This script handles the search and deletion of tickets and their associated replies.
 * It processes both search requests and deletion operations.
 */

// Include required files.
include __DIR__ . "/auth_check_admin.php";
include __DIR__ . "/db_connection.php";

// Initialize variables.
$search_result = "";
$ticket = null;
$message = "";

// Check if the request method is POST and ticket_id is set.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ticket_id'])) {
    $ticket_id = trim($_POST['ticket_id']);
    
    // Handle search request (when description is not set)
    if (!isset($_POST['description'])) {
        
        // Prepare SQL statement to search for ticket.
        $stmt = $conn->prepare("SELECT * FROM tickets WHERE ticket_id = ?");
        $stmt->bind_param("s", $ticket_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Check if ticket exists.
        if ($result->num_rows > 0) {
            $ticket = $result->fetch_assoc();
            $search_result = "Ticket Exists";
        } else {
            $search_result = "Ticket Doesn't Exist";
        }
        
        $stmt->close();
        
        // Store search results in session for display on the form.
        $_SESSION['search_result'] = $search_result;
        $_SESSION['ticket_data'] = $ticket;
        $_SESSION['submitted_ticket_id'] = $ticket_id;
        
        // Redirect back to delete form.
        header("Location: ../delete_ticket.php");
        exit();

    }
    
    // Handle delete request (when description is set).
    else {

        // First verify the ticket still exists before attempting deletion.
        $check_stmt = $conn->prepare("SELECT * FROM tickets WHERE ticket_id = ?");
        $check_stmt->bind_param("s", $ticket_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
            
        if ($check_result->num_rows > 0) {
            // Prepare delete statement.
            $delete_stmt = $conn->prepare("DELETE FROM tickets WHERE ticket_id = ?");
            $delete_stmt->bind_param("s", $ticket_id);

            // Execute deletion and handle result.
            if ($delete_stmt->execute()) {
                $message = "Tickets and Its Replies deleted successfully!";

                // Clear session variables after successful deletion.
                $_SESSION['submitted_ticket_id'] ="";
                $_SESSION['search_result'] = "";
            } else {
                $message = "Error deleting record: " . $conn->error;
            }
                
            $delete_stmt->close();
            } else {
                $message = "Ticket not found with ticket id: " . $ticket_id;
            }
            
            $check_stmt->close();
        }
        
        // Store operation message in session for display.
        $_SESSION['delete_message'] = $message;

        // Redirect back to the delete ticket interface.
        header("Location: ../check_delete_ticket.php");
        exit();
    }

// Close database connection.
$conn->close();
?>