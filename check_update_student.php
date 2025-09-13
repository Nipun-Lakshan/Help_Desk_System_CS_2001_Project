<?php 
/*
 * Admin Student Update Portal.
 * ============================
 *
 * This page allows administrators to search for and update student records.
 * It utilizes session - based flash messages for user feedback.
 */

// Verify admin authentication before proceeding.
include __DIR__ . "/php/auth_check_admin.php";

// Retrieve session data for form and messaging.
$search_result = isset($_SESSION['search_result']) ? $_SESSION['search_result'] : "";
$student_data = isset($_SESSION['student_data']) ? $_SESSION['student_data'] : null;
$update_message = isset($_SESSION['update_message']) ? $_SESSION['update_message'] : "";
$submitted_reg_number = isset($_SESSION['submitted_reg_number']) ? $_SESSION['submitted_reg_number'] : "";

// Clear session variables to prevent data persistence.
unset($_SESSION['search_result']);
unset($_SESSION['student_data']);
unset($_SESSION['update_message']);
unset($_SESSION['submitted_reg_number']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Update a Student</title>

    <!-- Main Stylesheet -->
    <link href="css/update_style.css" rel="stylesheet" />
  </head>

  <body>
    <!-- Navigation Bar -->
    <nav id="navbar">
      <div class="nav-container">
        <!-- Brand Logo -->
        <div class="logo">Help Desk - Admin</div>

        <!-- Navigation Menu -->
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
          <h2 class="login-title">Update a Student</h2>

          <!-- Search Form -->
          <form class="login-form" action="php/update_handle.php" method="POST">

            <!-- Registration Number Input -->
            <div class="form-group">
              <label for="reg_number_search">Student Registration Number</label>
              <input
                type="text"
                id="reg_number_search"
                name="reg_number"
                placeholder="2023s12345"
                maxlength="10"
                minlength="10"
                pattern="^\d{4}s\d{5}$"
                value="<?php echo htmlspecialchars($submitted_reg_number); ?>"
                required
              />
            </div>

            <!-- Search Result Display (Read-only) -->
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

<!--

One-Time Message Display: Updated Message
=========================================

The script runs the front section on every page load. It checks for temporary session data,
copies it to local variables and instantly clears the session. The HTML then displays the data
from these local variables. This ensures a clean session and prevents duplicate messages.

-->