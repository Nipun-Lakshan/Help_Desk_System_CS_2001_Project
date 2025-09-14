<?php
/*
 * Fetch Tickets for Students
 * ==========================
 *
 * This script retrieves all tickets submitted by the currently logged-in student
 * from the database and displays them in a table format.
 * It uses prepared statements to prevent SQL injection attacks.
 */

// Include database connection.
require_once 'db_connection.php';

// Enable error reporting for debugging (should be disabled in production).
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Prepare SQL query to fetch tickets for the current student ordered by date. (newest first)
    $sql = "SELECT * FROM tickets WHERE student_reg_number = ? ORDER BY date DESC";
    $stmt = $conn->prepare($sql);

    // Bind the student registration number parameter to the prepared statement.
    $stmt->bind_param("s", $_SESSION['reg_number']);

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
    
    // Check if there are any tickets returned.
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
                // Loop through each ticket and display its details.
                while ($ticket = $result->fetch_assoc()): 
                ?>
                <tr>
                    <!-- Display ticket information with proper HTML escaping -->
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
    <?php else:
        // Display message if no tickets are found.
        ?>
        <p class="no-tickets">No tickets Found.</p>
    <?php endif;
    
    // Close the statement and database connection.
    $stmt->close();
    $conn->close();
    
} catch (Exception $e) {
    // Handle any exceptions that occur during database operations.
    die("Error: " . $e->getMessage());
}
?>