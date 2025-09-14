<?php
/*
 * Student Dashboard Page
 * ======================
 *
 * This page provides the main interface for students to access various
 * Help Desk system functionalities including ticket creation and management.
 * Requires student authentication for access.
 */

// Include student authentication check to secure the page.
include __DIR__ . "/php/auth_check_students.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Student Dashboard</title>

    <!-- Stylesheet -->
    <link href="css/student_dashboard_style.css" rel="stylesheet" />
  </head>

  <body>
    <!-- Navigation Bar -->
    <nav id="navbar">
      <div class="nav-container">
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
    <section id="home" class="hero">
      <div class="login-form-container">
        <div class="login-card">

          <!-- Dashboard Title -->
          <h2 class="login-title">Student Dashboard</h2>

          <!-- Dashboard Navigation Form -->
          <form class="login-form">

            <!-- Create Ticket Button -->
            <div class="form-group">
              <a href="/helpdesksystem/create_ticket.php" class="login-submit-btn">
                Create a Ticket
              </a>
            </div>

            <!-- View Tickets Button -->
            <div class="form-group">
              <a href="/helpdesksystem/view_tickets_student.php" class="login-submit-btn">
                View all Tickets
              </a>
            </div>

            <!-- Update Ticket Button -->
            <div class="form-group">
              <a href="/helpdesksystem/check_update_ticket.php" class="login-submit-btn">
                Update a Ticket
              </a>
            </div>

            <!-- View Replies Button -->
            <div class="form-group">
              <a href="/helpdesksystem/view_replies_student.php" class="login-submit-btn">
                View all Replies
              </a>
            </div>

          </form>
        </div>
      </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
      <div class="container">
        <div class="footer-content">
          <div class="footer-left">
            <p>
              &copy; 2025 Faculty of Science, University of Colombo. All rights
              reserved.
            </p>
          </div>
        </div>
      </div>
    </footer>
  </body>
</html>
