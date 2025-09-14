<?php 
/*
 * View Replies Page - Staff Interface
 * ===================================
 *
 * This page displays all ticket replies in the system for staff review.
 * Staff members can view replies they have created or those related to their department.
 * Requires user authentication for access.
 */

// Include user authentication check to secure the page.
include __DIR__ . "/php/auth_check_users.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Desk - View Replies</title>

    <!-- Stylesheet for consistent styling -->
    <link href="css/reply_view_style.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation Bar -->
    <nav id="navbar">
        <div class="nav-container">
            <div class="logo">Help Desk - Staff</div>

            <!-- Navigation Links -->
            <ul class="nav-links">
                <li><a href="index.html">Home</a></li>
                <li><a href="staff_dashboard.php">Dashboard</a></li>
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
            <h1 class="login-title">Reply Information View</h1>

            <!-- Container for replies table -->
            <div class="tickets-table-container">
                <?php
                // Include script to fetch and display replies from database.
                // This file handles department-specific filtering for staff.
                include 'php/fetch_replies_staff.php';
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