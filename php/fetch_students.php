<?php
require_once 'db_connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $sql = "SELECT * FROM student ORDER BY id ASC";
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
                    <th>Student ID</th>
                    <th>Registration Number</th>
                    <th>Index Number</th>
                    <th>Name with Initials</th>
                    <th>Town</th>
                    <th>Contact Number</th>
                    <th>Password</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($ticket = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($ticket['id']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['reg_number']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['index_number']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['name_with_initials']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['town']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['contact_number']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['password']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['created_date']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['updated_date']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-tickets">No Students found in the system.</p>
    <?php endif;
    
    $stmt->close();
    $conn->close();
    
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>