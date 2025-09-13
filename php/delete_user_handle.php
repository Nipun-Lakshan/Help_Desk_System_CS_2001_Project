<?php
/*
 * User Deletion Handler
 * =====================
 *
 * Processes both user search requests and user record deletions.
 * Handles form submissions from the admin user management interface.
 */

// Include required authentication and database connection files.
include __DIR__ . "/auth_check_admin.php";
include __DIR__ . "/db_connection.php";

// Initialize response variables.
$search_result = "";
$user = null;
$message = "";

// Process POST requests containing username.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $username = trim($_POST['username']);
    
    /*
     * Handle Search Request.
     * Determines if this is a search (not a delete) by checking for absence of additional fields.
     */
    if (!isset($_POST['user_type'])) {

        // Prepare and execute database search query.
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Set appropriate search result message.
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $search_result = "User Data Exists";
        } else {
            $search_result = "User Data Doesn't Exist";
        }
        
        $stmt->close();
        
        // Store search results in session for display.
        $_SESSION['search_result'] = $search_result;
        $_SESSION['user_data'] = $user;
        $_SESSION['submitted_username'] = $username;
        
        // Redirect back to delete form with search results.
        header("Location: ../delete_user.php");
        exit();

    }

    /*
     * Handle Delete Request.
     * Processes user record deletion when additional fields are present.
     */
    else {
        // Verify user exists before attempting deletion.
        $check_stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $check_stmt->bind_param("s", $username);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
            
        if ($check_result->num_rows > 0) {
            // Delete user record.
            $delete_stmt = $conn->prepare("DELETE FROM users WHERE username = ?");
            $delete_stmt->bind_param("s", $username);

            if ($delete_stmt->execute()) {
                $message = "User record deleted successfully!";
                // Clear search session data after successful deletion.
                $_SESSION['submitted_username'] ="";
                $_SESSION['search_result'] = "";
            } else {
                $message = "Error deleting record: " . $conn->error;
            }
                
            $delete_stmt->close();
        } else {
            $message = "User not found with username: " . $username;
        }
            
        $check_stmt->close();
        
        // Store operation message in session for user feedback.
        $_SESSION['delete_message'] = $message;

        // Redirect back to delete form.
        header("Location: ../check_delete_user.php");
        exit();
    }

}

// Close database connection.
$conn->close();
?>