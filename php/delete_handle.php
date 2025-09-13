<?php
/*
 * Student Deletion Handler
 * ========================
 *
 * Processes both student search requests and student record deletions.
 * Handles form submissions from the admin student management interface.
 */

// Include required authentication and database connection files.
include __DIR__ . "/auth_check_admin.php";
include __DIR__ . "/db_connection.php";

// Initialize response variables.
$search_result = "";
$student = null;
$message = "";

// Process POST requests containing registration number.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reg_number'])) {
    $reg_number = trim($_POST['reg_number']);
    
    /*
     * Handle Search Request.
     * Determines if this is a search by checking for absence of additional fields.
     */
    if (!isset($_POST['name_with_initials'])) {
        
        // Prepare and execute database search query.
        $stmt = $conn->prepare("SELECT * FROM student WHERE reg_number = ?");
        $stmt->bind_param("s", $reg_number);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Set appropriate search result message.
        if ($result->num_rows > 0) {
            $student = $result->fetch_assoc();
            $search_result = "Student Data Exists";
        } else {
            $search_result = "Student Data Doesn't Exist";
        }
        
        $stmt->close();
        
        // Store search results in session for display.
        $_SESSION['search_result'] = $search_result;
        $_SESSION['student_data'] = $student;
        $_SESSION['submitted_reg_number'] = $reg_number;
        
        // Redirect back to delete form with search results.
        header("Location: ../delete_student.php");
        exit();

    }
    
    /**
     * Handle Delete Request.
     * Processes student record deletion when additional fields are present.
     */
    else {

        // Verify student exists before attempting deletion.
        $check_stmt = $conn->prepare("SELECT * FROM student WHERE reg_number = ?");
        $check_stmt->bind_param("s", $reg_number);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
            
        if ($check_result->num_rows > 0) {
            // Delete student record.
            $delete_stmt = $conn->prepare("DELETE FROM student WHERE reg_number = ?");  
            $delete_stmt->bind_param("s", $reg_number);

            if ($delete_stmt->execute()) {
                    $message = "Student record deleted successfully!";
                    // Clear search session data after successful deletion.
                    $_SESSION['search_result'] = "";
                    $_SESSION['submitted_reg_number'] = "";
            } else {
                $message = "Error deleting record: " . $conn->error;
            }

            $delete_stmt->close();

        } else {
            $message = "Student not found with registration number: " . $reg_number;
        }
        
        // Store operation message in session for user feedback.
        $check_stmt->close();
        
        // Store message in session to display on the form.
        $_SESSION['delete_message'] = $message;

        // Redirect back to delete form.
        header("Location: ../delete_student.php");
        exit();
    }

}

// Close database connection.
$conn->close();
?>