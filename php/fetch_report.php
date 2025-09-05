<?php
require_once 'db_connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $sql = "SELECT 
    (SELECT COUNT(*) FROM student) AS total_students,
    (SELECT COUNT(*) FROM users) AS total_users,
    (SELECT COUNT(*) FROM tickets) AS total_tickets,
    (SELECT COUNT(*) FROM tickets WHERE status = 'pending') AS pending_tickets,
    (SELECT COUNT(*) FROM tickets WHERE status = 'completed') AS completed_tickets";
    
    $result = $conn->query($sql);
    
    if (!$result) {
        die("Error in query: " . $conn->error);
    }
    
    if ($result->num_rows > 0): 
        $row = $result->fetch_assoc();
        ?>
        <table class="tickets-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Count</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total Number of Students in the System</td>
                    <td><?php echo htmlspecialchars($row['total_students']); ?></td>
                </tr>
                <tr>
                    <td>Total Number of Users in the System</td>
                    <td><?php echo htmlspecialchars($row['total_users']); ?></td>
                </tr>
                <tr>
                    <td>Total Number of Tickets in the System</td>
                    <td><?php echo htmlspecialchars($row['total_tickets']); ?></td>
                </tr>
                <tr>
                    <td>Number of Pending Tickets</td>
                    <td><?php echo htmlspecialchars($row['pending_tickets']); ?></td>
                </tr>
                <tr>
                    <td>Number of Completed Tickets</td>
                    <td><?php echo htmlspecialchars($row['completed_tickets']); ?></td>
                </tr>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-tickets">No data found.</p>
    <?php endif;
    
    $conn->close();
    
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>