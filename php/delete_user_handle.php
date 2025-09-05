<?php
include __DIR__ . "/auth_check_admin.php";
include __DIR__ . "/db_connection.php";

$search_result = "";
$user = null;
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $username = trim($_POST['username']);
    
    // Check if this is a search request (not an update)
    if (!isset($_POST['user_type'])) {
        // Search for user in database
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $search_result = "User Data Exists";
        } else {
            $search_result = "User Data Doesn't Exist";
        }
        
        $stmt->close();
        
        // Store search result in session to display on the form
        $_SESSION['search_result'] = $search_result;
        $_SESSION['user_data'] = $user;
        $_SESSION['submitted_username'] = $username;
        
        // Redirect back to update form
        header("Location: ../delete_user.php");
        exit();
    } 
    // Handle update request
    else {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $user_type = trim($_POST['user_type']);
        
        // Validate input
        if (empty($username) || empty($user_type)) {
            $message = "Username and user type are required.";
        } else {
            // Check if user exists
            $check_stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
            $check_stmt->bind_param("s", $username);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();
            
            if ($check_result->num_rows > 0) {
                    $delete_stmt = $conn->prepare("DELETE FROM users WHERE username = ?");
                    $delete_stmt->bind_param("s", $username);

                if ($delete_stmt->execute()) {
                    $message = "User record deleted successfully!";
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
        }
        
        // Store message in session to display on the form
        $_SESSION['delete_message'] = $message;
        header("Location: ../check_delete_user.php");
        exit();
    }
}

$conn->close();
?>