<?php
/*
 * Delete Ticket Admin Interface
 * =============================
 *
 * This page allows administrators to search for and delete tickets and their replies.
 * It handles session - based data for search results and deletion messages.
 */

// Include admin authentication check.
include __DIR__ . "/php/auth_check_admin.php";

// Retrieve search results and user data from session.
$search_result = isset($_SESSION['search_result']) ? $_SESSION['search_result'] : "";
$ticket_data = isset($_SESSION['ticket_data']) ? $_SESSION['ticket_data'] : null;
$delete_message = isset($_SESSION['delete_message']) ? $_SESSION['delete_message'] : "";

// Get the submitted ticket ID to preserve it in the form after submission.
$submitted_ticket_id = isset($_POST['ticket_id']) ? $_POST['ticket_id'] : (isset($_SESSION['submitted_ticket_id']) ? $_SESSION['submitted_ticket_id'] : "");

// Clear the session variables after use to prevent data persistence.
unset($_SESSION['search_result']);
unset($_SESSION['ticket_data']);
unset($_SESSION['delete_message']);
unset($_SESSION['submitted_ticket_id']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Delete a Ticket & Replies</title>

    <!-- Main Stylesheet -->
    <link href="css/check_delete_ticket_style.css" rel="stylesheet" />
  </head>

  <body>
    <!-- Navigation Bar -->
    <nav id="navbar">
      <div class="nav-container">
        <div class="logo">Help Desk - Admin</div>

        <!-- Navigation Links -->
        <ul class="nav-links">
          <li><a href="index.html">Home</a></li>
          <li><a href="admin_dashboard.php">Dashboard</a></li>
          <li><a href="faq.html">FAQs</a></li>
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

          <!-- Display deletion message if available -->
          <?php if (!empty($delete_message)): ?>
            <div>
              <?php echo htmlspecialchars($delete_message); ?>
            </div>
          <?php endif; ?>

          <!-- Main Title -->
          <h2 class="login-title">Delete a Ticket & Replies</h2>

          <form class="login-form" action="php/delete_ticket_handle.php" method="POST">

            <!-- Ticket ID Input Field -->
            <div class="form-group">
              <label for="ticket_id">Ticket ID</label>
              <input
                type="text"
                id="ticket_id"
                name="ticket_id"
                placeholder="50"
                pattern="^[0-9]+$"
                value="<?php echo htmlspecialchars($submitted_ticket_id); ?>"
                required
              />
            </div>

            <!-- Search Result Display Field (Read-only) -->
            <div class="form-group">
              <label for="search_result">Search Result</label>
              <input
                type="text"
                id="search_result"
                name="search_result"
                value="<?php echo htmlspecialchars($search_result); ?>"
                readonly
              />
            </div>

            <!-- Search Submit Button -->
            <button type="submit" class="login-submit-btn">Search</button>
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