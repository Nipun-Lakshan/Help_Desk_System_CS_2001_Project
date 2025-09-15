<?php
/*
 * View Replies Page - Student Interface
 * =====================================
 *
 * This page displays all replies received by the student for their tickets.
 * It includes authentication checks and fetches reply data from the database.
 */

// Include student authentication script to verify user is logged in as student.
include __DIR__ . "/php/auth_check_students.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Desk - View Replies</title>

    <!-- External CSS stylesheet for reply viewing interface -->
    <link href="css/reply_view_style.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation Bar -->
    <nav id="navbar">
        <div class="nav-container">

            <!-- Application Logo/Brand -->
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

    <!-- Main Content Section -->
    <section class="hero">
        <div class="tickets-container">

            <!-- Page Header -->
            <h1 class="login-title">Reply Information View</h1>

            <!-- Replies Table Container -->
            <div class="tickets-table-container">
                <?php
                /*
                 * Include reply fetching script.
                 * This file handles database operations to retrieve replies for the current student
                 * and displays them in a formatted table.
                 */
                include 'php/fetch_replies_students.php';
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