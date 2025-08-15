<?php
require_once 'db_connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticket_id = isset($_POST['ticket_id']) ? $_POST['ticket_id'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $replied_by = isset($_POST['replied_by']) ? $_POST['replied_by'] : '';

    if (empty($ticket_id) || empty($description) || empty($replied_by)) {
        die("All fields are required.");
    }

    try {
        $sql = "INSERT INTO reply 
                (ticket_id, description, replied_by, date) 
                VALUES (?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error in preparing statement: " . $conn->error);
        }

        $stmt->bind_param("sss", 
            $ticket_id, 
            $description,
            $replied_by
        );

        if ($stmt->execute()) {
            header("Location: ../reply.html?registration=success");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();

    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }

    $conn->close();

} else {
    header("Location: reply.html");
    exit();
}
?>