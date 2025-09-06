<?php 

include __DIR__ . "/php/auth_check_users.php";

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Staff</title>
    <link href="css/staff_dashboard_style.css" rel="stylesheet" />
  </head>
  <body>
    <nav id="navbar">
      <div class="nav-container">
        <div class="logo">Help Desk - Staff</div>
        <ul class="nav-links">
          <li><a href="index.html">Home</a></li>
          <li><button class="btn-login" onclick="window.location.href='php/logout.php'">Logout</button></li>
        </ul>
      </div>
    </nav>
    <section id="home" class="hero">
      <div class="login-form-container">
        <div class="login-card">
          <h2 class="login-title">Staff Dashboard</h2>
          <form class="login-form">
            <div class="form-group">
              <a href="/helpdesksystem/reply.php" class="login-submit-btn">Reply a Ticket</a>
            </div>
            <div class="form-group">
             <a href="/helpdesksystem/view_replies_staff.php" class="login-submit-btn">View all Replies</a>
            </div>
            <div class="form-group">
             <a href="/helpdesksystem/view_tickets_staff.php" class="login-submit-btn">View all Tickets</a>
            </div>
            <div class="form-group">
             <a href="/helpdesksystem/check_update_reply.php" class="login-submit-btn">Update a Reply</a>
            </div>
          </form>
        </div>
      </div>
    </section>
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
