<?php 
/*
 * Staff Dashboard Page
 * ====================
 *
 * This page provides the main interface for staff members to access various.
 * Help Desk system functionalities including ticket management and replies.
 * Requires user authentication for access.
 */

// Include user authentication check to secure the page.
include __DIR__ . "/php/auth_check_users.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Staff Dashboard</title>

    <!-- Stylesheet -->
    <link href="css/staff_dashboard_style.css" rel="stylesheet" />
  </head>  

  <body>
    <!-- Navigation Bar -->
    <nav id="navbar">
      <div class="nav-container">
        <div class="logo">Help Desk - Staff</div>
        <ul class="nav-links">

          <!-- Navigation Links -->
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
    <section id="home" class="hero">
      <div class="login-form-container">
        <div class="login-card">

          <!-- Dashboard Title -->
          <h2 class="login-title">Staff Dashboard</h2>

          <!-- Dashboard Navigation Form -->
          <form class="login-form">

            <!-- Reply Ticket Button -->
            <div class="form-group">
              <a href="/helpdesksystem/reply.php" class="login-submit-btn">
                Reply a Ticket
              </a>
            </div>

            <!-- View Replies Button -->
            <div class="form-group">
              <a href="/helpdesksystem/view_replies_staff.php" class="login-submit-btn">
                View all Replies
              </a>
            </div>

            <!-- View Tickets Button -->
            <div class="form-group">
             <a href="/helpdesksystem/view_tickets_staff.php" class="login-submit-btn">
              View all Tickets
            </a>
            </div>

            <!-- Update Reply Button -->
            <div class="form-group">
             <a href="/helpdesksystem/check_update_reply.php" class="login-submit-btn">
              Update a Reply
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
