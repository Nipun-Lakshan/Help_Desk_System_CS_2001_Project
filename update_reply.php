<?php
/*
 * Update Reply Form Page - Staff Interface
 * ========================================
 *
 * This page displays the form for staff members to update their existing replies.
 * Requires user authentication and valid reply data from session.
 */

// Include user authentication check to secure the page.
include __DIR__ . "/php/auth_check_users.php";

// Check if reply data is available in session.
if (!isset($_SESSION['reply_data']) || empty($_SESSION['reply_data'])) {
    // Redirect back to search page if no reply data is found
    header("Location: check_update_reply.php");
    exit();
}

// Retrieve reply data from session.
$reply_data = $_SESSION['reply_data'];

// Clear the reply data from session after retrieving to prevent data persistence.
unset($_SESSION['reply_data']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Update Reply</title>

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
          <h2 class="login-title">Update a Reply</h2>

          <!-- Update Reply Form -->
          <form class="login-form" action="php/update_reply_handle.php" method="POST">
          
          <!-- Reply ID Field (Read-only) -->
          <div class="form-group">
              <label for="reply_id">Reply ID</label>
              <input
                type="text"
                id="reply_id"
                name="reply_id"
                value="<?php echo htmlspecialchars($reply_data['reply_id']); ?>"
                readonly
                required
              />
            </div>

            <!-- Ticket ID Field (Read-only) -->
            <div class="form-group">
              <label for="ticket_id">Ticket ID</label>
              <input
                type="text"
                id="ticket_id"
                name="ticket_id"
                value="<?php echo htmlspecialchars($reply_data['ticket_id']); ?>"
                readonly
                required
              />
            </div>

            <!-- Description Textarea Field (Editable) -->
            <div class="form-group textarea">
              <label for="description">Description</label>
              <textarea
                id="description"
                name="description"
                placeholder="Enter your answer"
              ><?php echo htmlspecialchars($reply_data['description']); ?></textarea>
            </div>

          <!-- Replied By Field (Read-only) -->
          <div class="form-group">
              <label for="replied_by">Your Username</label>
              <input
                type="text"
                id="replied_by"
                name="replied_by"
                value="<?php echo htmlspecialchars($reply_data['replied_by']); ?>"
                readonly
              />
            </div>

            <!-- Update Submit Button -->
            <button type="submit" class="login-submit-btn">Update</button>

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
