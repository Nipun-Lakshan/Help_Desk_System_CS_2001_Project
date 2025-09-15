<?php
/*
 * Ticket Update Handler - Student Interface
 * =========================================
 *
 * Processes both ticket search requests and ticket updates.
 * Handles form submissions from the student ticket management interface.
 * Includes security checks to prevent unauthorized access and updates to completed tickets.
 */

// Include required authentication and database connection files
include __DIR__ . "/auth_check_students.php";  // Verifies student is logged in
include __DIR__ . "/db_connection.php";        // Establishes database connection

// Initialize response variables
$search_result = "";  // Stores search result message
$ticket = null;       // Stores ticket data if found
$message = "";        // Stores operation result message

// Check if request is POST and contains ticket_id (both search and update operations)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ticket_id'])) {
    $ticket_id = trim($_POST['ticket_id']);  // Sanitize ticket ID input
    
    // SEARCH REQUEST HANDLING
    // Check if this is a search request (identified by absence of description field)
    if (!isset($_POST['description'])) {
        
        // Prepare SQL query to search for ticket by ID
        $stmt = $conn->prepare("SELECT * FROM tickets WHERE ticket_id = ?");
        $stmt->bind_param("s", $ticket_id);  // Bind parameter to prevent SQL injection
        $stmt->execute();
        $result = $stmt->get_result();  // Get query results
        
        if ($result->num_rows > 0) {
            // Ticket found in database
            $ticket = $result->fetch_assoc();  // Get ticket data as associative array
            
            // SECURITY CHECKS:
            // 1. Check if student owns the ticket (prevents unauthorized access)
            if ($ticket['student_reg_number'] != $_SESSION['reg_number']) {
                $search_result = "Search failed: unauthorized attempt.";
            } 
            // 2. Check if ticket is already completed (prevents updates to closed tickets)
            elseif ($ticket['status'] == 'completed') {
                $search_result = "Ticket closed. No further updates.";
            } 
            // 3. Ticket exists and can be edited
            else {
                $search_result = "Ticket Exists and can be edited.";
            }

            // Store ticket data in session for potential update operation
            $_SESSION['ticket_data'] = $ticket;
            
            // Redirect to update page only if authorized and ticket is editable
            if ($search_result == "Ticket Exists and can be edited.") {
                header("Location: ../update_ticket.php");
                exit();
            }
        } else {
            // Ticket not found in database
            $search_result = "Ticket Doesn't Exist";
        }
        
        $stmt->close();  // Close prepared statement
        
        // Store search results in session for display on search page
        $_SESSION['search_result'] = $search_result;
        $_SESSION['submitted_ticket_id'] = $ticket_id;  // Preserve entered ticket ID
        
        // Redirect back to search form to show results
        header("Location: ../check_update_ticket.php");
        exit();
        
    }
    // UPDATE REQUEST HANDLING
    // This executes when description field is present (update form submission)
    else {
        // Sanitize input data from update form
        $description = trim($_POST['description']);
        $ticket_id = trim($_POST['ticket_id']);

        // Verify ticket exists and check permissions before updating
        $check_stmt = $conn->prepare("SELECT * FROM tickets WHERE ticket_id = ?");
        $check_stmt->bind_param("s", $ticket_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
        
        if ($check_result->num_rows > 0) {
            // Ticket found - proceed with security checks
            $ticket = $check_result->fetch_assoc();
            
            // SECURITY CHECKS (repeated for update request):
            // 1. Check if student owns the ticket
            if ($ticket['student_reg_number'] != $_SESSION['reg_number']) {
                $message = "Unauthorized Attempt: Ticket exists, but you can't update it.";
            }
            // 2. Check if ticket is completed (should not be updated)
            elseif ($ticket['status'] == 'completed') {
                $message = "Ticket closed. No further updates.";
            }
            // 3. All checks passed - proceed with update
            else {
                // Prepare update query to modify ticket description
                $update_stmt = $conn->prepare("UPDATE tickets SET description = ? WHERE ticket_id = ?");
                $update_stmt->bind_param("ss", $description, $ticket_id);

                // Execute update and check result
                if ($update_stmt->execute()) {
                    $message = "Ticket has been updated successfully!";
                } else {
                    $message = "Error updating record: " . $conn->error;
                }
                
                $update_stmt->close();  // Close update statement
            }
        } else {
            // Ticket not found in database during update attempt
            $message = "Ticket not found.";
        }
        
        $check_stmt->close();  // Close verification statement
        
        // Store operation message in session for user feedback
        $_SESSION['update_message'] = $message;
        
        // Redirect back to search/update form to show result message
        header("Location: ../check_update_ticket.php");
        exit();
    }
}

// Close database connection when done
$conn->close();
?>