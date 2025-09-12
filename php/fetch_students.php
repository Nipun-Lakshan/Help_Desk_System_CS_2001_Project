<?php
/**
 * Student Data Retrieval Script.
 *
 * This script connects to the database and retrieves all student records.
 * From the student table, displaying them in an HTML table format.
 * Includes comprehensive error handling and security measures.
 */

// Include database connection file.
require_once 'db_connection.php';

// Set error reporting for development environment.
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    /**
     * SQL Query to retrieve all student records.
     * Ordered by ID in ascending order for consistent display.
     */
    $sql = "SELECT * FROM student ORDER BY id ASC";

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
        <!-- Student Data Table -->
        <table class="tickets-table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Registration Number</th>
                    <th>Index Number</th>
                    <th>Name with Initials</th>
                    <th>Town</th>
                    <th>Contact Number</th>
                    <th>Password</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through each student record and display in table rows
                while ($ticket = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($ticket['id']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['reg_number']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['index_number']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['name_with_initials']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['town']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['contact_number']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['password']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['created_date']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['updated_date']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <!-- Display message when no students are found -->
        <p class="no-tickets">No Students found in the system.</p>
    <?php endif;
    
    // Close the prepared statement.
    $stmt->close();

    // Close the database connection
    $conn->close();
    
} catch (Exception $e) {
    /**
     * Global exception handler.
     * Catches any unhandled exceptions and displays error message.
     */
    die("Error: " . $e->getMessage());
}
?>