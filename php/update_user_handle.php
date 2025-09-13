<?php
/*
 * User Update Handler
 * ===================
 *
 * Processes both user search requests and user record updates.
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
     * Determines if this is a search (not an update) by checking for absence of update fields.
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
        
        // Redirect back to update form with search results.
        header("Location: ../update_user.php");
        exit();

    }
    
    /*
     * Handle Update Request.
     * Processes user record updates when additional fields are present.
     */
    else {
        // Sanitize and trim input data.
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $user_type = trim($_POST['user_type']);
        
        // Verify user exists before attempting update.
        $check_stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $check_stmt->bind_param("s", $username);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
            
        if ($check_result->num_rows > 0) {
            /*
             * Execute Update Query.
             * Updates user record with new values.
             */
            $update_stmt = $conn->prepare("UPDATE users SET password = ?, user_type = ? WHERE username = ?");
            $update_stmt->bind_param("sss", $password, $user_type, $username);

            if ($update_stmt->execute()) {
                $message = "User record updated successfully!";
            } else {
                $message = "Error updating record: " . $conn->error;
            }
                
            $update_stmt->close();
        } else {
            $message = "User not found with username: " . $username;
        }
            
        $check_stmt->close();
        
        // Store operation message in session for user feedback.
        $_SESSION['update_message'] = $message;

        // Redirect back to update form.
        header("Location: ../check_update_user.php");
        exit();
    }

}

// Close database connection.
$conn->close();
?>