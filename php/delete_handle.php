<?php
include __DIR__ . "/auth_check_admin.php";
include __DIR__ . "/db_connection.php";

$search_result = "";
$student = null;
$message = "";

// Handle search request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reg_number'])) {
    $reg_number = trim($_POST['reg_number']);
    
    // Check if this is a search request (not an update)
    if (!isset($_POST['name_with_initials'])) {
        // Search for student in database
        $stmt = $conn->prepare("SELECT * FROM student WHERE reg_number = ?");
        $stmt->bind_param("s", $reg_number);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $student = $result->fetch_assoc();
            $search_result = "Student Data Exists";
        } else {
            $search_result = "Student Data Doesn't Exist";
        }
        
        $stmt->close();
        
        // Store search result in session to display on the form
        $_SESSION['search_result'] = $search_result;
        $_SESSION['student_data'] = $student;
        $_SESSION['submitted_reg_number'] = $reg_number;
        
        // Redirect back to update form
        header("Location: ../delete_student.php");
        exit();
    } 
    // Handle update request
    else {
        $name_with_initials = trim($_POST['name_with_initials']);
        $town = trim($_POST['town']);
        $contact_number = trim($_POST['contact_number']);
        $password = trim($_POST['password']);
        
        // Validate input
        if (empty($name_with_initials) || 
            empty($town) || empty($contact_number) || empty($password)) {
            $message = "All fields are required.";
        } else {
            // Check if student exists
            $check_stmt = $conn->prepare("SELECT * FROM student WHERE reg_number = ?");
            $check_stmt->bind_param("s", $reg_number);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();
            
            if ($check_result->num_rows > 0) {
                // Update student record
                $delete_stmt = $conn->prepare("DELETE FROM student WHERE reg_number=?");
                
                $delete_stmt->bind_param("s", $reg_number);
                
                if ($delete_stmt->execute()) {
                    $message = "Student record deleted successfully!";
                    $_SESSION['search_result'] = "";
                    $_SESSION['submitted_reg_number'] = "";
                } else {
                    $message = "Error deleting record: " . $conn->error;
                }
                
                $delete_stmt->close();
            } else {
                $message = "Student not found with registration number: " . $reg_number;
            }
            
            $check_stmt->close();
        }
        
        // Store message in session to display on the form
        $_SESSION['delete_message'] = $message;
        header("Location: ../delete_student.php");
        exit();
    }
}

$conn->close();
?>