<?php
/*
 * User Update Portal - Admin Interface
 * ====================================
 *
 * This page allows administrators to search for and update user records.
 * It retrieves search results and messages from session variables and displays
 * them appropriately. Includes authentication check for admin privileges.
 */

// Verify admin authentication before proceeding.
include __DIR__ . "/php/auth_check_admin.php";

// Retrieve session data for form population and messaging.
$search_result = isset($_SESSION['search_result']) ? $_SESSION['search_result'] : "";
$user_data = isset($_SESSION['user_data']) ? $_SESSION['user_data'] : null;
$update_message = isset($_SESSION['update_message']) ? $_SESSION['update_message'] : "";

// Get the submitted username to preserve it in the form.
$submitted_username = isset($_POST['username']) ? $_POST['username'] : (isset($_SESSION['submitted_username']) ? $_SESSION['submitted_username'] : "");

// Clear session variables to prevent data persistence.
unset($_SESSION['search_result']);
unset($_SESSION['user_data']);
unset($_SESSION['update_message']);
unset($_SESSION['submitted_username']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Update a User</title>

    <!-- Main Stylesheet -->
    <link href="css/update_style.css" rel="stylesheet" />
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
    <section id="home" class="hero">
      <div class="login-form-container">
        <div class="login-card">

          <!-- Status Message Display -->
          <?php if (!empty($update_message)): ?>
            <div>
              <?php echo htmlspecialchars($update_message); ?>
            </div>
          <?php endif; ?>

          <!-- Page Header -->
          <h2 class="login-title">Update a User</h2>

          <!-- Search Form -->
          <form class="login-form" action="php/update_user_handle.php" method="POST">

            <!-- Username Input Field -->
            <div class="form-group">
              <label for="username">Username</label>
              <input
                type="text"
                id="username"
                name="username"
                placeholder="kamal"
                pattern="^[a-z]{1,50}$"
                minlength="1"
                maxlength="50"
                value="<?php echo htmlspecialchars($submitted_username); ?>"
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

            <!-- Form Submission Button -->
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