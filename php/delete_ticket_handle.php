<?php
include __DIR__ . "/auth_check_admin.php";
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
            $search_result = "Ticket Exists";
        } else {
            $search_result = "Ticket Doesn't Exist";
        }
        
        $stmt->close();
        
        // Store search result in session to display on the form
        $_SESSION['search_result'] = $search_result;
        $_SESSION['user_data'] = $user;
        $_SESSION['submitted_username'] = $username;
        
        // Redirect back to update form
        header("Location: ../delete_ticket.php");
        exit();
    } 
    // Handle update request
    else {
            $check_stmt = $conn->prepare("SELECT * FROM tickets WHERE ticket_id = ?");
            $check_stmt->bind_param("s", $username);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();
            
            if ($check_result->num_rows > 0) {
                    $delete_stmt = $conn->prepare("DELETE FROM tickets WHERE ticket_id = ?");
                    $delete_stmt->bind_param("s", $username);

                if ($delete_stmt->execute()) {
                    $message = "Tickets and Its Replies deleted successfully!";
                    $_SESSION['submitted_username'] ="";
                    $_SESSION['search_result'] = "";
                } else {
                    $message = "Error deleting record: " . $conn->error;
                }
                
                $delete_stmt->close();
            } else {
                $message = "Ticket not found with username: " . $username;
            }
            
            $check_stmt->close();
        }
        
        // Store message in session to display on the form
        $_SESSION['delete_message'] = $message;
        header("Location: ../check_delete_ticket.php");
        exit();
    }

$conn->close();
?>