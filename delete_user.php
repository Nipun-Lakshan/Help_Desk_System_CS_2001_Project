<?php
/*
 * User Deletion Confirmation Page - Admin Interface
 * =================================================
 *
 * This page displays user details for confirmation before deletion.
 * It retrieves user data from session and provides a confirmation interface.
 */

// Verify admin authentication before proceeding.
include __DIR__ . "/php/auth_check_admin.php";

// Check if user data is available in session.
if (!isset($_SESSION['user_data']) || empty($_SESSION['user_data'])) {
    // Redirect back to search page if no user data.
    header("Location: check_delete_user.php");
    exit();
}

// Retrieve user data from session.
$user_data = $_SESSION['user_data'];

// Clear the user data from session after retrieving it.
unset($_SESSION['user_data']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Delete a User</title>

    <!-- Main Stylesheet -->
    <link href="css/register_style.css" rel="stylesheet" />
  </head>

  <body>
    <!-- Main Stylesheet -->
    <nav id="navbar">
      <div class="nav-container">
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
          <h2 class="login-title">User Details</h2>

            <!-- Delete Confirmation Form -->
            <form class="login-form" action="php/delete_user_handle.php" method="POST">
            
            <!-- User ID Field (Read-only) -->
            <div class="form-group">
              <label for="id">User ID</label>
              <input
                type="text"
                id="id"
                name="id"
                value="<?php echo htmlspecialchars($user_data['user_id']); ?>"
                readonly
                required
              />
            </div>

            <!-- Username Field (Read-only) -->
            <div class="form-group">
              <label for="username">Username</label>
              <input
                type="text"
                id="username"
                name="username"
                value="<?php echo htmlspecialchars($user_data['username']); ?>"
                readonly
                required
              />
            </div>

            <!-- User Type Field (Read-only) -->
            <div class="form-group">
              <label for="user_type">User Type</label>
              <input
              type="text"
              id="user_type"
              name="user_type"
              value="<?php echo htmlspecialchars($user_data['user_type']); ?>"
              readonly
              >
            </div>

            <!-- Password Field (Read-only) -->
            <div class="form-group">
              <label for="password">Password</label>
              <input
                type="text"
                id="password"
                name="password"
                value="<?php echo htmlspecialchars($user_data['password']); ?>"
                readonly
              />
            </div>

            <!-- Created Date Field (Read-only) -->
            <div class="form-group">
              <label for="created_at">Created Date</label>
              <input
                type="text"
                id="created_at"
                name="created_at"
                value="<?php echo htmlspecialchars($user_data['created_at']); ?>"
                readonly
                required
              />
            </div>

            <!-- Updated Date Field (Read-only) -->
            <div class="form-group">
              <label for="updated_at">Updated Date</label>
              <input
                type="text"
                id="updated_at"
                name="updated_at"
                value="<?php echo htmlspecialchars($user_data['updated_at']); ?>"
                readonly
                required
              />
            </div>

            <!-- Delete Confirmation Button -->
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