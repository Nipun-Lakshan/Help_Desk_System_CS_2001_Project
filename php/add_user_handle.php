<?php
/*
 * User Registration Handler
 * ========================
 *
 * Processes form submissions from the admin user registration interface.
 * Inserts new user records into the database with proper validation.
 */

require_once 'db_connection.php';

// Enable error reporting for development environment.
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Process POST requests.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data.
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    try {
        // Prepare SQL insert statement with timestamp fields.
        $sql = "INSERT INTO users (username, user_type, password, created_at, updated_at) VALUES (?, ?, ?, NOW(), NoW())";

        $stmt = $conn->prepare($sql);

        // Check if statement preparation was successful.
        if (!$stmt) {
            die("Error in preparing statement: " . $conn->error);
        }

        // Bind parameters to the prepared statement.
        $stmt->bind_param("sss", 
            $username, 
            $user_type,
            $password
        );

        // Execute the statement and handle result.
        if ($stmt->execute()) {
            // Redirect to success page on successful insertion.
            header("Location: ../add_user.php?registration=success");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement.
        $stmt->close();

    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }

    // Close database connection.
    $conn->close();

} else {
    // Redirect if accessed without POST method.
    header("Location: ../add_user.php?status=registration_failed");
    exit();
}
?>