<?php
/*
 * Ticket Data Retrieval Script
 * ============================
 *
 * This script connects to the database and retrieves all ticket records
 * from the tickets table and displaying them in an HTML table format.
 * Includes comprehensive error handling and security measures.
 */

// Include database connection file.
require_once 'db_connection.php';

// Set error reporting for development environment.
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    /*
     * SQL Query to retrieve all ticket records.
     * Ordered by date in descending order for most recent first display.
     */
    $sql = "SELECT * FROM tickets ORDER BY date DESC";

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
        <!-- Ticket Data Table -->
        <table class="tickets-table">
            <thead>
                <tr>
                    <th>Ticket ID</th>
                    <th>Student Reg Number</th>
                    <th>Description</th>
                    <th>Department</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through each ticket record and display in table rows.
                while ($ticket = $result->fetch_assoc()): 
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($ticket['ticket_id']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['student_reg_number']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['description']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['department']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['date']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['updated_date']); ?></td>
                    <td><?php echo strtolower($ticket['status']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <!-- Display message when no tickets are found -->
        <p class="no-tickets">No tickets found in the system.</p>
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