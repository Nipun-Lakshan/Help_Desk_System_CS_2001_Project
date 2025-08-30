<?php 

include __DIR__ . "/php/auth_check_admin.php";

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Add User</title>
    <link href="css/add_user_style.css" rel="stylesheet" />
  </head>
  <body>
    <nav id="navbar">
      <div class="nav-container">
        <div class="logo">Help Desk</div>
        <ul class="nav-links">
          <li><a href="index.html">Home</a></li>
          <li><button class="btn-login" onclick="window.location.href='php/logout.php'">Logout</button></li>
        </ul>
      </div>
    </nav>
    <section id="home" class="hero">
      <div class="login-form-container">
        <div class="login-card">
          <h2 class="login-title">Add User</h2>
          <form
            class="login-form"
            action="php/add_user_handle.php"
            method="POST"
          >
            <div class="form-group">
              <label for="username">Username</label>
              <input
                type="text"
                id="username"
                name="username"
                placeholder="Enter the username"
                required
              />
            </div>
            <div class="form-group">
              <label for="user_type">User's Department</label>
              <input
                type="text"
                id="user_type"
                name="user_type"
                placeholder="Enter the user's department"
                required
              />
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter the password"
                required
              />
            </div>
            <button type="submit" class="login-submit-btn">Save</button>
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
