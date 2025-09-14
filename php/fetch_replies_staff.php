<?php
/**
 * Fetch Replies for Staff Script
 * ==============================
 *
 * This script retrieves ticket replies specifically for the currently logged-in staff member.
 * It displays only the replies created by the staff member, providing a personalized view.
 * Includes joined ticket information for context.
 */

// Include database connection.
require_once 'db_connection.php';

// Enable error reporting for debugging (should be disabled in production).
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    /*
     * SQL Query to fetch replies created by the current staff member.
     * Joins with tickets table to get additional context information.
     * Ordered by date descending to show most recent replies first.
     */
    $sql = "SELECT 
            reply.*, 
            tickets.student_reg_number, 
            tickets.description AS ticket_description 
            FROM reply
            JOIN tickets ON reply.ticket_id = tickets.ticket_id
            WHERE reply.replied_by = ?
            ORDER BY reply.date DESC";

    // Prepare the SQL statement.
    $stmt = $conn->prepare($sql);

    // Bind the session username as parameter for security.
    $stmt->bind_param("s", $_SESSION['username']);
    
    // Check if statement preparation was successful.
    if (!$stmt) {
        die("Error in preparing statement: " . $conn->error);
    }
    
    // Execute the prepared statement.
    if (!$stmt->execute()) {
        die("Error executing query: " . $stmt->error);
    }
    
    // Get the result set from the executed statement.
    $result = $stmt->get_result();
    
    // Check if there are any replies for this staff member.
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
        <!-- Display message when no replies are found for this staff member -->
        <p class="no-tickets">No replies found.</p>
    <?php endif;
    
    // Close the statement and database connection.
    $stmt->close();
    $conn->close();
    
} catch (Exception $e) {
    // Handle any exceptions that occur during database operations.
    die("Error: " . $e->getMessage());
}
?>