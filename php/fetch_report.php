<?php
/*
 * Fetch Report Data Script
 * ========================
 *
 * This script retrieves system summary statistics from the database including:
 * - Total number of students
 * - Total number of users
 * - Total number of tickets
 * - Number of pending tickets
 * - Number of completed tickets
 *
 * The data is displayed in a formatted table for administrative review.
 */

// Include database connection file.
require_once 'db_connection.php';

// Enable error reporting for debugging (should be disabled in production).
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
     /*
     * SQL Query to fetch system summary statistics.
     * Uses multiple subqueries to get counts from different tables.
     */
    $sql = "SELECT 
    (SELECT COUNT(*) FROM student) AS total_students,
    (SELECT COUNT(*) FROM users) AS total_users,
    (SELECT COUNT(*) FROM tickets) AS total_tickets,
    (SELECT COUNT(*) FROM tickets WHERE status = 'pending') AS pending_tickets,
    (SELECT COUNT(*) FROM tickets WHERE status = 'completed') AS completed_tickets";
    
    // Execute the query.
    $result = $conn->query($sql);
    
    // Check if query execution was successful.
    if (!$result) {
        die("Error in query: " . $conn->error);
    }
    
    // Check if data was returned.
    if ($result->num_rows > 0):

         // Fetch the first row of results
        $row = $result->fetch_assoc();
?>
        <!-- Summary Statistics Table -->
        <table class="tickets-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Count</th>
                </tr>
            </thead>
            <tbody>

                <!-- Total Students Row -->
                <tr>
                    <td>Total Number of Students in the System</td>
                    <td><?php echo htmlspecialchars($row['total_students']); ?></td>
                </tr>

                <!-- Total Users Row -->
                <tr>
                    <td>Total Number of Users in the System</td>
                    <td><?php echo htmlspecialchars($row['total_users']); ?></td>
                </tr>

                <!-- Total Tickets Row -->
                <tr>
                    <td>Total Number of Tickets in the System</td>
                    <td><?php echo htmlspecialchars($row['total_tickets']); ?></td>
                </tr>

                <!-- Pending Tickets Row -->
                <tr>
                    <td>Number of Pending Tickets</td>
                    <td><?php echo htmlspecialchars($row['pending_tickets']); ?></td>
                </tr>

                <!-- Completed Tickets Row -->
                <tr>
                    <td>Number of Completed Tickets</td>
                    <td><?php echo htmlspecialchars($row['completed_tickets']); ?></td>
                </tr>
            </tbody>
        </table>

    
    <?php else: ?>
        <!-- Display message when no data is found -->
        <p class="no-tickets">No data found.</p>
    <?php endif;
    
    // Close database connection
    $conn->close();
    
} catch (Exception $e) {
    // Handle any exceptions that occur during database operations.
    die("Error: " . $e->getMessage());
}
?>