<?php
// Include database connection file.
require_once 'db_connection.php';

// Enable error reporting for debugging.
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form was submitted via POST method.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve and sanitize form data.
    $reg_number = isset($_POST['reg_number']) ? $_POST['reg_number'] : '';
    $index_number = isset($_POST['index_number']) ? $_POST['index_number'] : '';
    $name_with_initials = isset($_POST['name_with_initials']) ? $_POST['name_with_initials'] : '';
    $town = isset($_POST['town']) ? $_POST['town'] : '';
    $contact_number = isset($_POST['contact_number']) ? $_POST['contact_number'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    try {
        // SQL query to insert new student record.
        $sql = "INSERT INTO student 
                (reg_number, index_number, name_with_initials, password, contact_number, town, created_date, updated_date) 
                VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";

        // Prepare the SQL statement.
        $stmt = $conn->prepare($sql);
        
        // Check if statement preparation was successful.
        if (!$stmt) {
            die("Error in preparing statement: " . $conn->error);
        }

        // Bind parameters to the prepared statement.
        $stmt->bind_param("ssssss", 
            $reg_number, 
            $index_number, 
            $name_with_initials, 
            $password,
            $contact_number,
            $town
        );

        // Execute the statement and check for success.
        if ($stmt->execute()) {
            // Redirect to registration page with success message.
            header("Location: ../register.php?registration=success");
            exit();
        } else {
            // Display error if execution fails.
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement.
        $stmt->close();

    } catch (Exception $e) {
        // Handle any exceptions that occur during database operations.
        die("Error: " . $e->getMessage());
    }

    // Close database connection
    $conn->close();

} else {
    // Redirect if accessed without POST method.
    header("Location: register.php?status=failed");
    exit();
}
?>