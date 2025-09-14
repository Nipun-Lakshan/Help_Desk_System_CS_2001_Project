<?php
/*
 * Student Ticket View Page
 * ========================
 *
 * This page allows students to view their submitted help desk tickets.
 * It includes authentication checks to ensure only logged - in students can access it.
 */

// Include authentication script to check if user is logged in as a student.
include __DIR__ . "/php/auth_check_students.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Desk - View Tickets</title>

    <!-- Stylesheet -->
    <link href="css/reply_view_style.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation Bar -->
    <nav id="navbar">
        <div class="nav-container">
            <!-- Logo/Brand -->
            <div class="logo">Help Desk - Student</div>

            <!-- Navigation Links -->
            <ul class="nav-links">
                <li><a href="index.html">Home</a></li>
                <li><a href="student_dashboard.php">Dashboard</a></li>
                <li><a href="faq.html">FAQs</a></li>

                <!-- Logout Button -->
                <li>
                    <button class="btn-login" onclick="window.location.href='php/logout.php'">
                        Logout
                    </button>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Section -->
    <section class="hero">
        <div class="tickets-container">

            <!-- Page Header -->
            <h1 class="login-title">Ticket Information View</h1>

            <!-- Loading Tickets -->
            <div class="tickets-table-container">
                <?php 
                // Include script to fetch and display tickets for the current student.
                include 'php/fetch_tickets_students.php'; 
                ?>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-left">
                    <p>
                        &copy; 2025 Faculty of Science, University of Colombo. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>