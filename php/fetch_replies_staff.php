<?php
require_once 'db_connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $sql = "SELECT r.*, t.student_reg_number, t.description AS ticket_description 
        FROM reply r
        JOIN tickets t ON r.ticket_id = t.ticket_id
        WHERE r.replied_by = ?
        ORDER BY r.date DESC";
        
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION['username']);
    
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
                    <th>Reply ID</th>
                    <th>Ticket Description</th>
                    <th>Student Reg Number</th>
                    <th>Reply</th>
                    <th>Replied By</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($reply = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($reply['reply_id']); ?></td>
                    <td><?php echo htmlspecialchars($reply['ticket_description']); ?></td>
                    <td><?php echo htmlspecialchars($reply['student_reg_number']); ?></td>
                    <td><?php echo htmlspecialchars($reply['description']); ?></td>
                    <td><?php echo htmlspecialchars($reply['replied_by']); ?></td>
                    <td><?php echo htmlspecialchars($reply['date']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-tickets">No replies found.</p>
    <?php endif;
    
    $stmt->close();
    $conn->close();
    
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>