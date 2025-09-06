<?php
require_once 'db_connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $sql = "SELECT * FROM tickets WHERE department=? ORDER BY date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION['department']);

    if (!$stmt) {
        die("Error in preparing statement: " . $conn->error);
    }
    
    if (!$stmt->execute()) {
        die("Error executing query: " . $stmt->error);
    }
    
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0): ?>
        <table class="tickets-table">
            <thead>
                <tr>
                    <th>Ticket ID</th>
                    <th>Student Reg Number</th>
                    <th>Description</th>
                    <th>Department</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($ticket = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($ticket['ticket_id']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['student_reg_number']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['description']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['department']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['date']); ?></td>
                    <td>
                        <?php 
                        echo strtolower($ticket['status']);?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-tickets">No tickets.</p>
    <?php endif;
    
    $stmt->close();
    $conn->close();
    
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>