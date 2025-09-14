<?php
/*
 * Delete Ticket Confirmation Page
 * ===============================
 *
 * This page displays ticket details for confirmation before deletion.
 * Only accessible to administrators with valid session data.
 */

// Include admin authentication check.
include __DIR__ . "/php/auth_check_admin.php";

// Check if ticket data is available in session.
if (!isset($_SESSION['ticket_data']) || empty($_SESSION['ticket_data'])) {
    // Redirect back to search page if no ticket data is found.
    header("Location: check_delete_ticket.php");
    exit();
}

// Retrieve ticket data from session.
$ticket_data = $_SESSION['ticket_data'];

// Clear the ticket data from session after retrieving to prevent data persistence.
unset($_SESSION['ticket_data']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Delete a Ticket & Replies</title>

    <!-- Main Stylesheet -->
    <link href="css/create_ticket_style.css" rel="stylesheet" />
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
          <h2 class="login-title">Ticket Details</h2>

          <!-- Ticket Deletion Confirmation Form -->
          <form class="login-form" action="php/delete_ticket_handle.php" method="POST">

          <!-- Ticket ID Field -->
          <div class="form-group">
              <label for="ticket_id">Ticket ID</label>
              <input
                type="text"
                id="ticket_id"
                name="ticket_id"
                value="<?php echo htmlspecialchars($ticket_data['ticket_id']); ?>"
                readonly
              />
            </div>

            <!-- Student Registration Number Field -->
            <div class="form-group">
              <label for="student_reg_number">Student Registration's Number</labels>
              <input
                type="text"
                id="student_reg_number"
                name="student_reg_number"
                value="<?php echo htmlspecialchars($ticket_data['student_reg_number']); ?>"
                readonly
              />
            </div>

            <!-- Description Field -->
            <div class="form-group textarea">
              <label for="description">Description</label>
              <textarea
                id="description"
                name="description"
                readonly
                required
              ><?php echo htmlspecialchars($ticket_data['description']); ?></textarea>
            </div>

            <!-- Department Field -->
            <div class="form-group">
              <label for="department">Department</label>
              <input
                type="text"
                id="department"
                name="department"
                value="<?php echo htmlspecialchars($ticket_data['department']); ?>"
                readonly
              />
            </div>

            <!-- Creation Date Field -->
            <div class="form-group">
              <label for="date">Created Date </label>
              <input
                type="text"
                id="date"
                name="date"
                value="<?php echo htmlspecialchars($ticket_data['date']); ?>"
                readonly
              />
            </div>

            <!-- Updated Date Field -->
            <div class="form-group">
              <label for="updated_date">Updated Date </label>
              <input
                type="text"
                id="updated_date"
                name="updated_date"
                value="<?php echo htmlspecialchars($ticket_data['updated_date']); ?>"
                readonly
              />
            </div>

            <!-- Status Field -->
            <div class="form-group">
              <label for="status">Status</label>
              <input
                type="text"
                id="status"
                name="status"
                value="<?php echo htmlspecialchars($ticket_data['status']); ?>"
                readonly
              />
            </div>

            <!-- Date Confirmation Button -->
            <button type="submit" class="login-submit-btn">Delete</button>
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
