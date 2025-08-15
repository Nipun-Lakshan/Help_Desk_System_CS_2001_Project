<?php
require_once 'db_connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($username) || empty($user_type) || empty($password)) {
        die("All fields are required.");
    }

    try {
        $sql = "INSERT INTO users 
                (username, user_type, password, created_at) 
                VALUES (?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error in preparing statement: " . $conn->error);
        }

        $stmt->bind_param("sss", 
            $username, 
            $user_type,
            $password
        );

        if ($stmt->execute()) {
            header("Location: ../add_user.html?registration=success");
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
    header("Location: register.html");
    exit();
}
?>