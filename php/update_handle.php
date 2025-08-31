<?php
// update_handle.php
include __DIR__ . "/auth_check_admin.php";
include __DIR__ . "/db_connection.php";

// Initialize variables
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
        header("Location: ../update_student.php");
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
                $update_stmt = $conn->prepare("UPDATE student SET name_with_initials = ?, 
                                              town = ?, contact_number = ?, password = ? WHERE reg_number = ?");
                
                $update_stmt->bind_param("sssss", $name_with_initials, $town, 
                                        $contact_number, $password, $reg_number);
                
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
        }
        
        // Store message in session to display on the form
        $_SESSION['update_message'] = $message;
        header("Location: ../update_student.php");
        exit();
    }
}

$conn->close();
?>