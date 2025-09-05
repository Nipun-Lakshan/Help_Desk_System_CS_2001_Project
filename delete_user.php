<?php 
include __DIR__ . "/php/auth_check_admin.php";

// Check if user data is available in session
if (!isset($_SESSION['user_data']) || empty($_SESSION['user_data'])) {
    // Redirect back to search page if no user data
    header("Location: check_delete_user.php");
    exit();
}

// Retrieve user data from session
$user_data = $_SESSION['user_data'];

// Clear the user data from session after retrieving it
unset($_SESSION['user_data']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Delete User</title>
    <link href="css/register_style.css" rel="stylesheet" />
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
          <h2 class="login-title">User Details</h2>
            <form class="login-form" action="php/delete_user_handle.php" method="POST">
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
            <div class="form-group">
              <label for="user_type">User Type</label>
              <input type="text" id="user_type" name="user_type" value="<?php echo htmlspecialchars($user_data['user_type']); ?>" readonly>
            </div>
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
            <button type="submit" class="login-submit-btn">Delete</button>
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