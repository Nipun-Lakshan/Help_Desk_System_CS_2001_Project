<?php
/*
 * Update Reply Handler Script
 * ===========================
 *
 * This script handles both search and update operations for staff replies.
 * For search requests: Validates reply existence and staff authorization.
 * For update requests: Updates reply description if staff is authorized.
 */

// Start session and include required files.
session_start();
include __DIR__ . "/auth_check_users.php";
include __DIR__ . "/db_connection.php";

// Initialize variables.
$search_result = "";
$reply = null;
$message = "";

// Check if the request method is POST and reply_id is set.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reply_id'])) {
    $reply_id = trim($_POST['reply_id']);
    
    // Handle search request (when description is not set).
    if (!isset($_POST['description'])) {
        
        // Prepare SQL statement to search for reply.
        $stmt = $conn->prepare("SELECT * FROM reply WHERE reply_id = ?");
        $stmt->bind_param("s", $reply_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Check if reply exists.
        if ($result->num_rows > 0) {
            $reply = $result->fetch_assoc();

            // Verify staff authorization.
            if($reply['replied_by'] != $_SESSION['username']){
                $search_result = "Search Failed: Unauthorized Attempt!";

                // Store search result in session to display on the form
                $_SESSION['search_result'] = $search_result;
                $_SESSION['reply_data'] = $reply;
                $_SESSION['submitted_reply_id'] = $reply_id;

                header("Location: ../check_update_reply.php");
                exit();
            }
            else{
                $search_result = "Reply Exists";
                
                // Store search result in session to display on the form.
                $_SESSION['search_result'] = $search_result;
                $_SESSION['reply_data'] = $reply;
                $_SESSION['submitted_reply_id'] = $reply_id;

                header("Location: ../update_reply.php");
                exit();
            }  
        } else {
            $search_result = "Reply Doesn't Exist";
            
            // Store search result in session to display on the form.
            $_SESSION['search_result'] = $search_result;
            $_SESSION['reply_data'] = $reply;
            $_SESSION['submitted_reply_id'] = $reply_id;

            header("Location: ../check_update_reply.php");
            exit();
        }
        
        $stmt->close();

    }
    // Handle update request (when description is set).
    else {
        // Verify staff authorization for update.
        if($_POST['replied_by'] != $_SESSION['username']){
            $search_result = "Update Failed: Unauthorized Attempt!";
            header("Location: ../check_update_reply.php");
            exit();
        }
        else{
            $description = trim($_POST['description']);

            // Verify reply still exists before updating
            $check_stmt = $conn->prepare("SELECT * FROM reply WHERE reply_id = ?");
            $check_stmt->bind_param("s", $reply_id);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();
        
            if ($check_result->num_rows > 0) {
                // Prepare update statement.
                $update_stmt = $conn->prepare("UPDATE reply SET description = ? WHERE reply_id = ?");
                $update_stmt->bind_param("ss", $description, $reply_id);

            // Execute update operation.
            if ($update_stmt->execute()) {
                $message = "Reply has been updated successfully!";
                $_SESSION['submitted_reply_id'] = "";
                $_SESSION['search_result'] = "";
            } else {
                $message = "Error updating record: " . $conn->error;
            }
            
            $update_stmt->close();
            } else {
            $message = "Reply not found with reply id: " . $reply_id;
            }
        
            $check_stmt->close();
        }
        
        
        // Store message in session to display on the form.
        $_SESSION['update_message'] = $message;
        header("Location: ../check_update_reply.php");
        exit();
    }
}

// Close database connection.
$conn->close();
?>