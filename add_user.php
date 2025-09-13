<?php
/*
 * User Registration Page - Admin Interface
 * ========================================
 *
 * This page allows administrators to register new users.
 * It includes authentication check for admin privileges.
 */

// Verify admin authentication before proceeding.
include __DIR__ . "/php/auth_check_admin.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Register a User</title>

    <!-- Main Stylesheet -->
    <link href="css/add_user_style.css" rel="stylesheet" />
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

          <!-- Page Header -->
          <h2 class="login-title">Add a User</h2>

          <!-- Registration Form -->
          <form class="login-form" action="php/add_user_handle.php" method="POST">

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
                required
              />
            </div>

            <!-- Department Input Field -->
            <div class="form-group">
              <label for="user_type">User's Department</label>
              <input
                type="text"
                id="user_type"
                name="user_type"
                placeholder="Department of Chemistry"
                pattern="^[a-zA-Z\s]{1,100}$"
                minlength="1"
                maxlength="100"
                required
              />
            </div>

            <!-- Password Input Field -->
            <div class="form-group">
              <label for="password">Password</label>
              <input
                type="password"
                id="password"
                name="password"
                placeholder="kamal@1973"
                pattern="^[a-z]{1,95}@\d{4}$"
                minlength="1"
                maxlength="50"
                required
              />
            </div>

            <!-- Form Submission Button -->
            <button type="submit" class="login-submit-btn">Save</button>
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
