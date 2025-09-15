<?php
/*
 * Fetch Replies for Students
 * ==========================
 *
 * This script retrieves and displays all replies for tickets belonging to the currently logged-in student.
 * It joins the reply and tickets tables to provide comprehensive reply information.
 */

// Include database connection file.
require_once 'db_connection.php';

// Enable error reporting for debugging (should be disabled in production).
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    /*
     * SQL Query to fetch replies with ticket information
     * - Joins reply table with tickets table
     * - Filters by current student's registration number
     * - Orders by reply date (newest first)
     */
    $sql = "SELECT 
                reply.*, 
                tickets.student_reg_number, 
                tickets.description AS ticket_description 
            FROM reply
            JOIN tickets ON reply.ticket_id = tickets.ticket_id
            WHERE tickets.student_reg_number = ?
            ORDER BY reply.date DESC;";
    
    // Prepare SQL statement to prevent SQL injection.
    $stmt = $conn->prepare($sql);

    // Check if statement preparation was successful
    if (!$stmt) {
        die("Error in preparing statement: " . $conn->error);
    }

    // Bind the student registration number parameter from session.
    $stmt->bind_param("s", $_SESSION['reg_number']);
    
    // Execute the prepared statement.
    if (!$stmt->execute()) {
        die("Error executing query: " . $stmt->error);
    }
    
    // Get the result set from the executed statement.
    $result = $stmt->get_result();
    
    // Check if any replies were found.
    if ($result->num_rows > 0): ?>

        <!-- Replies Table -->
        <table class="tickets-table">
            <thead>
                <tr>
                    <th>Reply ID</th>
                    <th>Ticket ID</th>
                    <th>Ticket Description</th>
                    <th>Student Reg Number</th>
                    <th>Reply</th>
                    <th>Replied By</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Loop through each reply and display in table rows
                while ($reply = $result->fetch_assoc()): 
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($reply['reply_id']); ?></td>
                    <td><?php echo htmlspecialchars($reply['ticket_id']); ?></td>
                    <td><?php echo htmlspecialchars($reply['ticket_description']); ?></td>
                    <td><?php echo htmlspecialchars($reply['student_reg_number']); ?></td>
                    <td><?php echo htmlspecialchars($reply['description']); ?></td>
                    <td><?php echo htmlspecialchars($reply['replied_by']); ?></td>
                    <td><?php echo htmlspecialchars($reply['date']); ?></td>
                    <td><?php echo htmlspecialchars($reply['updated_date']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    <?php else: ?>
        <!-- Display message when no replies are found -->
        <p class="no-tickets">No replies found.</p>
    <?php endif;
    
    // Close the prepared statement.
    $stmt->close();

    // Close the database connection.
    $conn->close();
    
} catch (Exception $e) {
    // Handle any exceptions that occur during database operations.
    die("Error: " . $e->getMessage());
}
?>