<?php
/*
 * Update Reply Search Page - Staff Interface
 * ==========================================
 *
 * This page allows staff members to search for replies they can update.
 * It handles session - based data for search results and update messages.
 * Requires user authentication for access.
 */

// Include user authentication check to secure the page.
include __DIR__ . "/php/auth_check_users.php";

// Retrieve search results and user data from session.
$search_result = isset($_SESSION['search_result']) ? $_SESSION['search_result'] : "";
$reply_data = isset($_SESSION['reply_data']) ? $_SESSION['reply_data'] : null;
$update_message = isset($_SESSION['update_message']) ? $_SESSION['update_message'] : "";

// Get the submitted reply ID to preserve it in the form after submission.
$submitted_reply_id = isset($_POST['reply_id']) ? $_POST['reply_id'] : (isset($_SESSION['submitted_reply_id']) ? $_SESSION['submitted_reply_id'] : "");

// Clear the session variables after use to prevent data persistence.
unset($_SESSION['search_result']);
unset($_SESSION['reply_data']);
unset($_SESSION['update_message']);
unset($_SESSION['submitted_reply_id']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Update a Reply</title>

    <!-- Stylesheet -->
    <link href="css/check_update_reply_style.css" rel="stylesheet" />
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

          <!-- Display update message if available -->
          <?php if (!empty($update_message)): ?>
            <div>
              <?php echo htmlspecialchars($update_message); ?>
            </div>
          <?php endif; ?>

          <!-- Page Title -->
          <h2 class="login-title">Update a Reply</h2>

          <!-- Search Form -->
          <form class="login-form" action="php/update_reply_handle.php" method="POST">

            <!-- Reply ID Input Field -->
            <div class="form-group">
              <label for="reply_id">Reply ID</label>
              <input
                type="text"
                id="reply_id"
                name="reply_id"
                placeholder="50"
                pattern="^[1-9]\d*$";
                value="<?php echo htmlspecialchars($submitted_reply_id); ?>"
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