<?php
/*
 * Ticket Information View Page - Admin Interface
 * ==============================================
 *
 * This page displays a table of all support tickets in the system.
 * It includes authentication check for admin privileges.
 */

// Verify admin authentication before proceeding.
include __DIR__ . "/php/auth_check_admin.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Desk - View Tickets</title>

    <!-- Main Stylesheet -->
    <link href="css/ticket_view_style.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation Bar -->
    <nav id="navbar">
        <div class="nav-container">

            <!-- Brand Logo -->
            <div class="logo">Help Desk - Admin</div>

            <!-- Navigation Links -->
            <ul class="nav-links">
                <li><a href="index.html">Home</a></li>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
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
            <h1 class="login-title">Ticket Information View</h1>

            <!-- Tickets Table Container -->
            <div class="tickets-table-container">
                <?php include 'php/fetch_tickets.php'; ?>
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