<?php
session_start();
require_once 'db_connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check admin login
    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['user_id'] = 0;
        $_SESSION['username'] = 'admin';
        $_SESSION['user_type'] = 'admin';
        header('Location: ../admin_dashboard.html?login=success');
        exit();
    }

    // Check staff users
    $user_query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($user_query);
    if (!$stmt) {
        $_SESSION['login_error'] = "Database error. Please try again.";
        header('Location: ../login.html');
        exit();
    }
    $stmt->bind_param("ss", $username, $password);
    if (!$stmt->execute()) {
        $_SESSION['login_error'] = "Database error. Please try again.";
        header('Location: ../login.html');
        exit();
    }
    $user_result = $stmt->get_result();

    if ($user_result->num_rows === 1) {
        $user = $user_result->fetch_assoc();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_type'] = $user['user_type'];
        header('Location: ../staff_dashboard.html?login=success');
        exit();
    }

    // Check students
    $student_query = "SELECT * FROM student WHERE reg_number = ? AND password = ?";
    $stmt = $conn->prepare($student_query);
    if (!$stmt) {
        $_SESSION['login_error'] = "Database error. Please try again.";
        header('Location: ../login.html');
        exit();
    }
    $stmt->bind_param("ss", $username, $password);
    if (!$stmt->execute()) {
        $_SESSION['login_error'] = "Database error. Please try again.";
        header('Location: ../login.html');
        exit();
    }
    $student_result = $stmt->get_result();

    if ($student_result->num_rows === 1) {
        $student = $student_result->fetch_assoc();
        $_SESSION['student_id'] = $student['id'];
        $_SESSION['reg_number'] = $student['reg_number'];
        $_SESSION['name'] = $student['name_with_initials'];
        $_SESSION['user_type'] = 'student';
        header('Location: ../student_dashboard.html?login=success');
        exit();
    }

    // If we get here, login failed
    $_SESSION['login_error'] = "Invalid username or password";
    header('Location: ../login.html');
    exit();
} else {
    header('Location: ../login.html');
    exit();
}
?>