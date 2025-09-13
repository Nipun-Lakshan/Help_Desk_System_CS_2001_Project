<?php
/*
 * User Data Retrieval Script
 * ==========================
 *
 * This script connects to the database and retrieves all user records
 * from the users table, displaying them in an HTML table format.
 * Includes comprehensive error handling and security measures.
 */

// Include database connection file.
require_once 'db_connection.php';

// Set error reporting for development environment.
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    /*
     * SQL Query to retrieve all user records.
     * Ordered by user_id in ascending order for consistent display.
     */
    $sql = "SELECT * FROM users ORDER BY user_id ASC";

    // Prepare the SQL statement to prevent SQL injection.
    $stmt = $conn->prepare($sql);
    
    // Check if statement preparation was successful.
    if (!$stmt) {
        die("Error in preparing statement: " . $conn->error);
    }
    
    // Execute the prepared statement.
    if (!$stmt->execute()) {
        die("Error executing query: " . $stmt->error);
    }
    
    // Get result set from the executed statement.
    $result = $stmt->get_result();
    
    // Check if records were found.
    if ($result->num_rows > 0): ?>
        <!-- User Data Table -->
        <table class="tickets-table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Department</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through each user record and display in table rows.
                while ($user = $result->fetch_assoc()): 
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['password']); ?></td>
                    <td><?php echo htmlspecialchars($user['user_type']); ?></td>
                    <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                    <td><?php echo htmlspecialchars($user['updated_at']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <!-- Display message when no users are found -->
        <p class="no-tickets">No Users found in the system.</p>
    <?php endif;
    
    // Close the prepared statement.
    $stmt->close();

    // Close the database connection.
    $conn->close();
    
} catch (Exception $e) {
    /*
     * Global exception handler.
     * Catches any unhandled exceptions and displays error message.
     */
    die("Error: " . $e->getMessage());
}
?>