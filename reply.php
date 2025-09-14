<?php
/*
 * Reply to Ticket Page
 * ====================
 *
 * This page allows staff users to reply to existing tickets in the Help Desk system.
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
    <title>Help Desk - Reply a Ticket</title>

    <!-- Stylesheet -->
    <link href="css/reply_style.css" rel="stylesheet" />
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
    <section id="home" class="hero">
      <div class="login-form-container">
        <div class="login-card">

          <!-- Page Title -->
          <h2 class="login-title">Reply a Ticket</h2>

           <!-- Reply Form -->
          <form class="login-form" action="php/reply_handle.php" method="POST">

            <!-- Ticket ID Input Field -->
            <div class="form-group">
              <label for="ticket_id">Ticket ID</label>
              <input
                type="text"
                id="ticket_id"
                name="ticket_id"
                placeholder="50"
                pattern="^\d+$"
                required
              />
            </div>

            <!-- Description Textarea Field -->
            <div class="form-group textarea">
              <label for="description">Description</label>
              <textarea
                id="description"
                name="description"
                placeholder="Enter your answer"
                required
              ></textarea>
            </div>

            <!-- Replied By Field (Read-only with session username) -->
            <div class="form-group">
              <label for="replied_by">Your Username</label>
              <input
                type="text"
                id="replied_by"
                name="replied_by"
                value="<?php echo $_SESSION['username']?>"
                readonly
              />
            </div>

            <!-- Submit Button -->
            <button type="submit" class="login-submit-btn">Submit</button>

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
