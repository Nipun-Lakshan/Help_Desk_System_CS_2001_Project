<?php
include __DIR__ . "/auth_check_students.php";
include __DIR__ . "/db_connection.php";

$search_result = "";
$user = null;
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $username = trim($_POST['username']);
    
    // Check if this is a search request (not an update)
    if (!isset($_POST['description'])) {
        // Search for user in database
        $stmt = $conn->prepare("SELECT * FROM tickets WHERE ticket_id = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Check for unauthorized access first, and if ticket is not completed.
            if ($user['student_reg_number'] != $_SESSION['reg_number']) {
                $search_result = "Search failed: unauthorized attempt.";
            } elseif ($user['status'] == 'completed') {
                $search_result = "Ticket closed. No further updates.";
            } else {
                $search_result = "Ticket Exists and can be edited.";
            }

            $_SESSION['user_data'] = $user;
            
            // Redirect to update page only if the user is authorized and the ticket can be edited.
            if ($search_result == "Ticket Exists and can be edited.") {
                 header("Location: ../update_ticket.php");
                 exit();
            }
        } else {
            $search_result = "Ticket Doesn't Exist";
        }
        
        $stmt->close();
        
        // Redirect back to search form to show the message
        $_SESSION['search_result'] = $search_result;
        $_SESSION['submitted_username'] = $username;
        
        header("Location: ../check_update_ticket.php");
        exit();
        
    } 
    // Handle update request
    else {
        $description = trim($_POST['description']);
        $submitted_username = trim($_POST['username']); // Use a different variable name to avoid confusion

        $check_stmt = $conn->prepare("SELECT * FROM tickets WHERE ticket_id = ?");
        $check_stmt->bind_param("s", $submitted_username);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
        
        if ($check_result->num_rows > 0) {
            $user = $check_result->fetch_assoc();
            
            // Check for both unauthorized access AND completed status
            if ($user['student_reg_number'] != $_SESSION['reg_number']) {
                 $message = "Unauthorized Attempt: Ticket exists, but you can't update it.";
            } elseif ($user['status'] == 'completed') {
                // The ticket is completed, so it cannot be updated.
                $message = "Ticket closed. No further updates.";
            } else {
                // The ticket is not completed, so it can be updated.
                $update_stmt = $conn->prepare("UPDATE tickets SET description = ? WHERE ticket_id = ?");
                $update_stmt->bind_param("ss", $description, $submitted_username);

                if ($update_stmt->execute()) {
                    $message = "Ticket has been updated successfully!";
                } else {
                    $message = "Error updating record: " . $conn->error;
                }
                
                $update_stmt->close();
            }
        } else {
            // Ticket not found
            $message = "Ticket not found.";
        }
        
        $check_stmt->close();
        
        // Store message in session to display on the form
        $_SESSION['update_message'] = $message;
        header("Location: ../check_update_ticket.php");
        exit();
    }
}

$conn->close();
?>