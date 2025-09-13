<?php
/*
 * Student Update Handler
 * ======================
 *
 * Processes both student search requests and student record updates.
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
     * Determines if this is a search (not an update) by checking for absence of update fields.
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
        
        // Redirect back to update form with search results
        header("Location: ../update_student.php");
        exit();
    } 
    
    /**
     * Handle Update Request.
     * Processes student record updates when additional fields are present.
     */
    else {

        // Sanitize and trim input data.
        $name_with_initials = trim($_POST['name_with_initials']);
        $town = trim($_POST['town']);
        $contact_number = trim($_POST['contact_number']);
        $password = trim($_POST['password']);
        
        // Check if student exists
        $check_stmt = $conn->prepare("SELECT * FROM student WHERE reg_number = ?");
        $check_stmt->bind_param("s", $reg_number);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
            
        if ($check_result->num_rows > 0) {
            // Update student record with new values.
            $update_stmt = $conn->prepare("UPDATE student SET name_with_initials = ?, town = ?, contact_number = ?, password = ? WHERE reg_number = ?");
            $update_stmt->bind_param("sssss", $name_with_initials, $town, $contact_number, $password, $reg_number);
            if ($update_stmt->execute()) {
                $message = "Student record updated successfully!";
            } else {
                $message = "Error updating record: " . $conn->error;
            }
                
            $update_stmt->close();
        } else {
            $message = "Student not found with registration number: " . $reg_number;
        }
            
        $check_stmt->close();
        
        // Store operation message in session for user feedback.
        $_SESSION['update_message'] = $message;

        // Redirect back to update form.
        header("Location: ../update_student.php");
        exit();
    }
}

// Close database connection.
$conn->close();
?>