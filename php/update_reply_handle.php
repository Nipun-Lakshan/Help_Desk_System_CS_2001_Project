<?php
include __DIR__ . "/auth_check_users.php";
include __DIR__ . "/db_connection.php";

$search_result = "";
$user = null;
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $username = trim($_POST['username']);
    
    // Check if this is a search request (not an update)
    if (!isset($_POST['description'])) {
        // Search for user in database
        $stmt = $conn->prepare("SELECT * FROM reply WHERE reply_id = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $search_result = "Reply Exists";
        } else {
            $search_result = "Reply Doesn't Exist";
        }
        
        $stmt->close();
        
        // Store search result in session to display on the form
        $_SESSION['search_result'] = $search_result;
        $_SESSION['user_data'] = $user;
        $_SESSION['submitted_username'] = $username;
        
        // Redirect back to update form
        header("Location: ../update_reply.php");
        exit();
    } 
    // Handle update request
    else {
        $description = trim($_POST['description']);

        $check_stmt = $conn->prepare("SELECT * FROM reply WHERE reply_id = ?");
        $check_stmt->bind_param("s", $username);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
        
        if ($check_result->num_rows > 0) {
            $update_stmt = $conn->prepare("UPDATE reply SET description = ? WHERE reply_id = ?");
            $update_stmt->bind_param("ss", $description, $username);

            if ($update_stmt->execute()) {
                $message = "Reply has been updated successfully!";
                $_SESSION['submitted_username'] = "";
                $_SESSION['search_result'] = "";
            } else {
                $message = "Error updating record: " . $conn->error;
            }
            
            $update_stmt->close();
        } else {
            $message = "Reply not found with reply id: " . $username;
        }
        
        $check_stmt->close();
        
        // Store message in session to display on the form
        $_SESSION['update_message'] = $message;
        header("Location: ../check_update_reply.php");
        exit();
    }
}

$conn->close();
?>