<?php
require_once 'db_connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reg_number = isset($_POST['reg_number']) ? $_POST['reg_number'] : '';
    $index_number = isset($_POST['index_number']) ? $_POST['index_number'] : '';
    $name_with_initials = isset($_POST['name_with_initials']) ? $_POST['name_with_initials'] : '';
    $town = isset($_POST['town']) ? $_POST['town'] : '';
    $contact_number = isset($_POST['contact_number']) ? $_POST['contact_number'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($reg_number) || empty($index_number) || empty($name_with_initials) || 
        empty($town) || empty($contact_number) || empty($password)) {
        die("All fields are required.");
    }

    try {
        $sql = "INSERT INTO student 
                (reg_number, index_number, name_with_initials, password, contact_number, town, created_date) 
                VALUES (?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error in preparing statement: " . $conn->error);
        }

        $stmt->bind_param("ssssss", 
            $reg_number, 
            $index_number, 
            $name_with_initials, 
            $password,
            $contact_number,
            $town
        );

        if ($stmt->execute()) {
            header("Location: ../register.php?registration=success");
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
    header("Location: register.php");
    exit();
}
?>