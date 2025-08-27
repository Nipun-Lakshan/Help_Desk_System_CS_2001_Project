<?php // Opening PHP tag to start a PHP script.

/**
 * Session Management and Student Validation Script.
 * This script handles session expiration, security regeneration and student verification.
 */

// --------------------------
// ----Session Management----
// --------------------------

// Start or resume an existing session to access session variables.
session_start();

// Define session timeout period.
$session_expire_time = 10; // Session will expire within 10 seconds.

// Define the session id regeneration time.
$session_regenerate_time = 5; // Session ID will regenerate after every 05 seconds. (Should be less than the session timeout period)

// Check if session has expired due to inactivity.
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $session_expire_time)) {

    // Session expired - clear all session variables but keep session structure.
    session_unset();

    // Destroy the session completely including session cookie.
    session_destroy();

    // Include and display a 401 (Unauthorized User) or Access Denied error page.
    // "/" is needed when starting the string for path with _DIR_.
    include __DIR__ . "/../401.html";
    
    // Stop script execution after displaying error page.
    exit();

}

// Update the last activity timestamp to current time to keep session alive.
$_SESSION['LAST_ACTIVITY'] = time();

// Check if session creation time is not set.
if (!isset($_SESSION['CREATED'])) {

    // Set session creation time to current timestamp.
    $_SESSION['CREATED'] = time();

// To improve security, the session ID will be changed after 05 seconds.
} elseif (time() - $_SESSION['CREATED'] > $session_regenerate_time) {

    // Regenerate session ID.
    session_regenerate_id(true);

    // Update session creation time after regeneration.
    $_SESSION['CREATED'] = time();

}

// --------------------------
// ----Student Validation----
// --------------------------

// Include the database connection file to establish DB connection.
require_once 'db_connection.php';

// Set error reporting to display all errors for debugging.
error_reporting(E_ALL);

// Configure PHP to display errors on screen.
ini_set('display_errors', 1);

// Check if student_id is set in the session. (User is logged in as student)
if(isset($_SESSION['user_id'])){
    
    // Store the student ID from session into a variable.
    $user_id = $_SESSION['user_id'];

    // SQL query to select registration number for the given student ID
    $sql = "SELECT reg_number FROM student WHERE id = ? LIMIT 1";

    // Prepare the SQL statement to prevent SQL injection.
    $stmt = $conn->prepare($sql);

    // Check if statement preparation was successful.
    if ($stmt) {

        // Bind the student_id parameter to the prepared statement. (String type)
        $stmt->bind_param("s", $user_id);
        
        // Execute the prepared statement.
        if ($stmt->execute()) {
            
            // Get the result set from the executed statement.
            $result = $stmt->get_result();
            
            // Check if a student record was found.
            if (!$obj = $result->fetch_object()) {

                // If no student found, show 401 error page.
                include __DIR__ . "/../401.html";

                // Stop script execution after displaying error page.
                exit();

            }

            // Free the result set memory.
            $result->free_result();

        } else {

            // If execution failed, show 500 server error page.
            include __DIR__ . "/../500.html";

            // Stop script execution after displaying error page.
            exit();
        }
        
        // Close the prepared statement.
        $stmt->close();        

    } else {

        // If statement preparation failed, show 500 server error page.
        include __DIR__ . "/../500.html";

        // Stop script execution after displaying error page.
        exit();
    }

}else {

    // If student_id is not in session (User not logged in), show 401 error page.
    include __DIR__ . "/../401.html";

    // Stop script execution after displaying error page.
    exit();
    
}