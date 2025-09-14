<?php
/*
 * Update Ticket Page for Students
 * ===============================
 *
 * This page allows students to search for and update their existing tickets.
 * It includes authentication checks and displays search results/update messages.
 */

// Include authentication script to verify student login.
include __DIR__ . "/php/auth_check_students.php";

// Retrieve search results and ticket data from session
$search_result = isset($_SESSION['search_result']) ? $_SESSION['search_result'] : "";
$ticket_data = isset($_SESSION['ticket_data']) ? $_SESSION['ticket_data'] : null;
$update_message = isset($_SESSION['update_message']) ? $_SESSION['update_message'] : "";

// Get the submitted ticket id to preserve it in the form
$submitted_ticket_id = isset($_POST['ticket_id']) ? $_POST['ticket_id'] : (isset($_SESSION['submitted_ticket_id']) ? $_SESSION['submitted_ticket_id'] : "");

// Clear the session variables after use.
unset($_SESSION['search_result']);
unset($_SESSION['ticket_data']);
unset($_SESSION['update_message']);
unset($_SESSION['submitted_ticket_id']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Update a Ticket</title>

    <!-- Stylesheet -->
    <link href="css/update_style.css" rel="stylesheet" />
  </head>

  <body>    
    <!-- Navigation Bar -->
    <nav id="nav">
      <div class="nav-container">
        <!-- Logo/Brand -->
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

          <!-- Display update message if available -->
          <?php if (!empty($update_message)): ?>
            <div>
              <?php echo htmlspecialchars($update_message); ?>
            </div>
          <?php endif; ?>

          <!-- Page Header -->
          <h2 class="login-title">Update a Ticket</h2>

          <!-- Search Form -->
          <form class="login-form" action="php/update_ticket_handle.php" method="POST">
            <!-- Ticket ID Input Field -->
            <div class="form-group">
              <label for="ticket_id">Ticket ID</label>
              <input
                type="text"
                id="ticket_id"
                name="ticket_id"
                placeholder="50"
                pattern="^[1-9]\d*$"
                value="<?php echo htmlspecialchars($submitted_ticket_id); ?>"
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

            <!-- Submit Button -->
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