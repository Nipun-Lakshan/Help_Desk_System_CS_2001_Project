<?php 
// Include admin authentication check to secure the page.
include __DIR__ . "/php/auth_check_admin.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Admin Dashboard</title>

    <!-- Stylesheet -->
    <link href="css/admin_dashboard_style.css" rel="stylesheet" />
  </head>

  <body>
    <!-- Navigation Bar -->
    <nav id="navbar">
      <div class="nav-container">
        <div class="logo">Help Desk - Admin</div>

        <ul class="nav-links">
          <li><a href="index.html">Home</a></li>
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
          <h2 class="login-title">Admin Dashboard</h2>

          <form class="login-form">
            <!-- Student Management Section -->
            <div class="form-group">
              <label for="students">For Students</label>
              <a href="/helpdesksystem/register.php" class="login-submit-btn">
                Register a Student
              </a>
            </div>

            <div class="form-group">
              <a href="/helpdesksystem/view_students.php" class="login-submit-btn">
                View all Students
              </a>
            </div>

            <div class="form-group">
              <a href="/helpdesksystem/check_update_student.php" class="login-submit-btn">
                Update a Student
              </a>
            </div>

            <div class="form-group">
              <a href="/helpdesksystem/check_delete_student.php" class="login-submit-btn">
                Delete a Student
              </a>
            </div>

            <!-- User Management Section -->
            <div class="form-group">
              <label for="Users">For Users</label>
              <a href="/helpdesksystem/add_user.php" class="login-submit-btn">
                Register a User
              </a>
            </div>

            <div class="form-group">
              <a href="/helpdesksystem/view_user.php" class="login-submit-btn">
                View all Users
              </a>
            </div>

            <div class="form-group">
              <a href="/helpdesksystem/check_update_user.php" class="login-submit-btn">
                Update a User
              </a>
            </div>

            <div class="form-group">
              <a href="/helpdesksystem/check_delete_user.php" class="login-submit-btn">
                Delete a User
              </a>
            </div>

            <!-- Ticket & Reply Management Section -->
            <div class="form-group">
              <label for="tickets">For Tickets & Replies</label>
              <a href="/helpdesksystem/view_tickets.php" class="login-submit-btn">
                View all Tickets
              </a>
            </div>

            <div class="form-group">
              <a href="/helpdesksystem/check_delete_ticket.php" class="login-submit-btn">
                Delete a Ticket & Replies
              </a>
            </div>

            <div class="form-group">
              <a href="/helpdesksystem/view_replies.php" class="login-submit-btn">
                View all Replies
              </a>
            </div>

            <!-- Reports Section -->
            <div class="form-group">
              <label for="report">Summary of System</label>
            <a href="/helpdesksystem/view_report.php" class="login-submit-btn">Report</a>
            </div>
          </form>
        </div>
      </div>
    </section>

    <!-- Footer -->
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