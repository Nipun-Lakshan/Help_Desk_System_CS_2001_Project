<?php // This line starts a PHP Script Block.

/**
 * User Authentication Script.
 * Handles login for admin, staff and students by validating credentials.
 * Against hard-coded values (admin) and database tables (staff/students).
 */

// Start a new or resume an existing session to store user data across pages.
session_start();

// Include the database connection script to establish a connection to MySQL.
require_once 'db_connection.php';

// Set error reporting to display all errors and warnings for debugging.
error_reporting(E_ALL);

// Ensure errors are displayed in the browser (should be turned off in production)
ini_set('display_errors', 1);

/**
 * Check if the request method is POST. (form submission)
 * This ensures the script only processes data from login form submissions.
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize input by removing whitespace from the beginning and end of the username.
    $username = trim($_POST['username']);

    // Sanitize input by removing whitespace from the beginning and end of the password.
    $password = trim($_POST['password']);

    // -------------------------
    // --- ADMIN LOGIN CHECK ---
    // -------------------------

    /**
     * Check for hard - coded admin credentials.
     * This provides a backdoor admin login without database dependency.
     */

    // Check Admin Login Authentication
    if ($username === 'admin' && $password === 'admin') { 
        // "===" - To check values and types are equal.
        // "==" - To check values are equal.

        // Set session variables for admin user.
        $_SESSION['user_id'] = 0; // Special ID for admin.
        $_SESSION['username'] = 'admin';  // Store admin username.
        $_SESSION['user_type'] = 'admin'; // Set user type as admin.

        // Redirect to admin dashboard with success parameter.
        header('Location: ../admin_dashboard.php?login=success');

        // Terminate script execution after redirect
        exit();
    }

    // ------------------------------
    // --- STAFF USER LOGIN CHECK ---
    // ------------------------------

    /**
     * Prepare SQL query to check staff credentials in users table.
     * Using prepared statement to prevent SQL injection attacks.
     */

    // Check Users Login Authentication.
    $user_query = "SELECT * FROM users WHERE username = ? AND password = ?";
    // Prepare the SQL statement using the database connection.
    // "?" works as a placeholder.

    // $stmt works as a object.
    $stmt = $conn->prepare($user_query);

    // Check if statement preparation failed.
    if (!$stmt) {

         // Store error message in session for display on login page.
        $_SESSION['login_error'] = "Database error. Please try again.";

        // Redirect back to login page.
        header('Location: ../login.html');

        // Terminate script execution
        exit();

    }

    // Bind parameters to the prepared statement. (ss = two strings)
    $stmt->bind_param("ss", $username, $password);

    // Execute the prepared statement and check if execution failed
    if (!$stmt->execute()) {

        // Store error message in session.
        $_SESSION['login_error'] = "Database error. Please try again.";

        // Redirect back to login page.
        header('Location: ../login.html');

        // Terminate script execution.
        exit();

    }

    // Get the result set from the executed statement.
    $user_result = $stmt->get_result();

    /**
     * Check if exactly one user was found with matching credentials.
     * num_rows indicates how many rows were returned by the query.
     */
    if ($user_result->num_rows === 1) {

        // Fetch the user data as an associative array.
        $user = $user_result->fetch_assoc();

        // Store user ID in session for future reference.
        $_SESSION['user_id'] = $user['user_id'];

        // Store username in session.
        $_SESSION['username'] = $user['username'];

        // Store user type in session
        $_SESSION['user_type'] = 'user'; 

        // Store User's Department
        $_SESSION['department'] = $user['user_type'];

        // Redirect to staff dashboard with success parameter
        header('Location: ../staff_dashboard.php?login=success');

        // Terminate script execution
        exit();

    }

    // ---------------------------
    // --- STUDENT LOGIN CHECK ---
    // ---------------------------

    /**
     * Prepare SQL query to check student credentials in student table.
     * Using registration number as username for students.
     */

    // Check Student Login Authentication.
    $student_query = "SELECT * FROM student WHERE reg_number = ? AND password = ?";

    // Prepare the SQL statement for student login.
    // $stmt works as a object.
    $stmt = $conn->prepare($student_query);

    // Check if statement preparation failed.
    if (!$stmt) {        

        // Store error message in session.
        $_SESSION['login_error'] = "Database error. Please try again.";

        // Redirect back to login page.
        header('Location: ../login.html');

        // Terminate script execution.
        exit();

    }

    // Bind parameters to the prepared statement (ss = two strings).
    $stmt->bind_param("ss", $username, $password);

    // Execute the prepared statement and check if execution failed.
    if (!$stmt->execute()) {

        // Store error message in session.
        $_SESSION['login_error'] = "Database error. Please try again.";

        // Redirect back to login page.
        header('Location: ../login.html');

        // Terminate script execution
        exit();

    }

    // Get the result set from the executed statement
    $student_result = $stmt->get_result();

    /**
     * Check if exactly one student was found with matching credentials.
     * num_rows indicates how many rows were returned by the query.
     */
    if ($student_result->num_rows === 1) {

        // Fetch the student data as an associative array.
        $student = $student_result->fetch_assoc();

        // Store student ID in session.
        $_SESSION['user_id'] = $student['id'];

        // Store registration number in session.
        $_SESSION['reg_number'] = $student['reg_number'];

        // Store student's name in session.
        $_SESSION['name'] = $student['name_with_initials'];

        // Set user type as student.
        $_SESSION['user_type'] = 'student';

        // Redirect to student dashboard with success parameter.
        header('Location: ../student_dashboard.php?login=success');

        // Terminate script execution.
        exit();

    }

    // ------------------------------
    // --- LOGIN FAILURE HANDLING ---
    // ------------------------------

    /**
     * If script reaches this point, no credentials matched.
     * Set generic error message for security.
     */
    $_SESSION['login_error'] = "Invalid username or password";

    // Redirect back to login page.
    header('Location: ../login.html');

    // Terminate script execution.
    exit();

} else {

    /**
     * If request method is not POST, redirect to login page.
     * Prevents direct access to this script URL.
     */
    header('Location: ../login.html');

    // Terminate script execution
    exit();

}

// This line ends a PHP Script Block.?>