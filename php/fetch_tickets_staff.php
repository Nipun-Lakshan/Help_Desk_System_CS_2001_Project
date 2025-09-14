<?php
/*
 * Fetch Tickets for Staff Script
 * ==============================
 *
 * This script retrieves tickets specifically assigned to the staff member's department.
 * It displays tickets filtered by the department of the currently logged-in staff member.
 * Tickets are ordered by date descending to show most recent tickets first.
 */

// Include database connection.
require_once 'db_connection.php';

// Enable error reporting for debugging (should be disabled in production).
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    /*
     * SQL Query to fetch tickets for the staff member's department
     * Filters tickets by the department stored in the session
     * Ordered by date descending to show newest tickets first
     */
    $sql = "SELECT * FROM tickets WHERE department=? ORDER BY date DESC";

    // Prepare the SQL statement.
    $stmt = $conn->prepare($sql);

    // Bind the session department as parameter for security and filtering.
    $stmt->bind_param("s", $_SESSION['department']);

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
    
    // Check if there are any tickets for this department.
    if ($result->num_rows > 0): ?>

        <!-- Tickets Table -->
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
                // Loop through each ticket and display in table rows.
                while ($ticket = $result->fetch_assoc()): 
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($ticket['ticket_id']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['student_reg_number']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['description']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['department']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['date']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['updated_date']); ?></td>
                    <td><?php echo strtolower($ticket['status']);?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    <?php else: ?>
        <!-- Display message when no tickets are found for this department -->
        <p class="no-tickets">No tickets found.</p>
    <?php endif;
    
    // Close the statement and database connection.
    $stmt->close();
    $conn->close();
    
} catch (Exception $e) {
    // Handle any exceptions that occur during database operations.
    die("Error: " . $e->getMessage());
}
?>