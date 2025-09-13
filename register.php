<?php
// Include admin authentication check to secure the page.
include __DIR__ . "/php/auth_check_admin.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Register a Student</title>

    <!-- Stylesheet -->
    <link href="css/register_style.css" rel="stylesheet" />
  </head>

  <body>
    <!-- Navigation Bar -->
    <nav id="navbar">
      <div class="nav-container">
        <div class="logo">Help Desk - Admin</div>

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
          <h2 class="login-title">Register a Student</h2>

          <!-- Registration Form -->
          <form class="login-form" action="php/register_handle.php" method="POST">

            <!-- Student Registration Number Field -->
            <div class="form-group">
              <label for="reg_number">Student Registration Number</label>
              <input
                type="text"
                id="reg_number"
                name="reg_number"
                placeholder="2023s12345"
                maxlength="10"
                minlength="10"
                pattern="^\d{4}s\d{5}$"
                required
              />
            </div>

            <!-- Student Index Number Field -->
            <div class="form-group">
              <label for="index_number">Student Index Number</label>
              <input
                type="text"
                id="index_number"
                name="index_number"
                placeholder="s17618"
                pattern="^s\d{5}$"
                maxlength="6"
                minlength="6"
                required
              />
            </div>

            <!-- Student's Name Field -->
            <div class="form-group">
              <label for="name_with_initials">Student Name with Initials</label>
              <input
                type="text"
                id="name_with_initials"
                name="name_with_initials"
                placeholder="A. B. C. Sunil"
                pattern="[a-zA-Z .]{1,100}"
                maxlength="100"
                required
              />
            </div>

            <!-- Town Field -->
            <div class="form-group">
              <label for="town">Town</label>
              <input
                id="town"
                name="town"
                placeholder="Mount Lavinia"
                pattern="^([A-Z][a-z]+)(\s[A-Z][a-z]+)?$"
                maxlength="100"
                required
              ></input>
            </div>

            <!-- Contact Number Field -->
            <div class="form-group">
              <label for="contact_number">Contact Number</label>
              <input
                type="tel"
                id="contact_number"
                name="contact_number"
                placeholder="0712345678"
                pattern="^(070|071|072|074|075|076|077|078)\d{7}$"
                maxlength="10"
                minlength="10"
                required
              />
            </div>

            <!-- Password Field -->
            <div class="form-group">
              <label for="password">Password</label>
              <input
                type="password"
                id="password"
                name="password"
                placeholder="2023@12345"
                maxlength="10"
                minlength="10"
                pattern="^\d{4}@\d{5}$"
                required
              />
            </div>

            <!-- Submit Button -->
            <button type="submit" class="login-submit-btn">Save</button>
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