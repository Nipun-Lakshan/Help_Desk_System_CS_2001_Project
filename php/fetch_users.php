<?php
require_once 'db_connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $sql = "SELECT * FROM users ORDER BY user_id ASC";
    $stmt = $conn->prepare($sql);
    
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
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Department</th>
                    <th>Created Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($ticket = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($ticket['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['username']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['password']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['user_type']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['created_at']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-tickets">No Users found in the system.</p>
    <?php endif;
    
    $stmt->close();
    $conn->close();
    
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>