<?php
/*
 * Update Ticket Form - Student Interface
 * ======================================
 *
 * This page displays a form for students to update their existing tickets.
 * It retrieves ticket data from session and provides a form for editing the description.
 * Includes security checks and proper session management.
 */

// Include student authentication script to verify user is logged in as student.
include __DIR__ . "/php/auth_check_students.php";

// Check if ticket data is available in session (passed from search results).
if (!isset($_SESSION['ticket_data']) || empty($_SESSION['ticket_data'])) {
    // Redirect back to search page if no ticket data is found in session.
    header("Location: check_update_ticket.php");
    exit();
}

// Retrieve ticket data from session for display in the form.
$ticket_data = $_SESSION['ticket_data'];

// Clear the ticket data from session after retrieving it for security.
unset($_SESSION['ticket_data']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Update a Ticket</title>

    <!-- Link to external CSS stylesheet for consistent styling -->
    <link href="css/reply_style.css" rel="stylesheet" />
  </head>

  <body>
    <!-- Navigation Bar -->
    <nav id="navbar">
      <div class="nav-container">

        <!-- Application Logo/Brand -->
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

          <!-- Page Header -->
          <h2 class="login-title">Update a Ticket</h2>

          <!-- Update Ticket Form -->
          <form class="login-form" action="php/update_ticket_handle.php" method="POST">

            <!-- Ticket ID Field (Read-only) -->
            <div class="form-group">
              <label for="ticket_id">Ticket ID</label>
              <input
                type="text"
                id="ticket_id"
                name="ticket_id"
                value="<?php echo htmlspecialchars($ticket_data['ticket_id']); ?>"
                readonly
                required
              />
            </div>
            
            <!-- Student Registration Number Field (Read-only) -->
            <div class="form-group">
              <label for="student_registration_number">Student Registration Number</label>
                <input
                  type="text"
                  id="student_registration_number"
                  name="student_registration_number"
                  value="<?php echo htmlspecialchars($ticket_data['student_reg_number']); ?>"
                  readonly
                  required
                />
            </div>

            <!-- Description Field (Editable) -->
            <div class="form-group textarea">
              <label for="description">Description</label>
              <textarea
                id="description"
                name="description"
                placeholder="Enter your answer"
              ><?php echo htmlspecialchars($ticket_data['description']); ?></textarea>
            </div>

            <!-- Department Field (Read-only) -->
            <div class="form-group">
              <label for="department">Department</label>
              <input
                type="text"
                id="department"
                name="department"
                value="<?php echo htmlspecialchars($ticket_data['department']); ?>"
                readonly
                required
              />
            </div>

            <!-- Created Date Field (Read-only) -->
            <div class="form-group">
              <label for="created_date">Created Date</label>
              <input
                type="text"
                id="created_date"
                name="created_date"
                value="<?php echo htmlspecialchars($ticket_data['date']); ?>"
                readonly
                required
              />
            </div>

            <!-- Updated Date Field (Read-only) -->
            <div class="form-group">
            <label for="updated_date">Updated Date</label>
              <input
                type="text"
                id="updated_date"
                name="updated_date"
                value="<?php echo htmlspecialchars($ticket_data['date']); ?>"
                readonly
                required
              />
            </div>

            <!-- Status Field (Read-only) -->
            <div class="form-group">
              <label for="status">Status</label>
              <input
                type="text"
                id="status"
                name="status"
                value="<?php echo htmlspecialchars($ticket_data['status']); ?>"
                readonly
                required
              />
            </div>

            <!-- Submit Button -->
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
