<?php 
include __DIR__ . "/php/auth_check_admin.php";

// Retrieve search results and user data from session
$search_result = isset($_SESSION['search_result']) ? $_SESSION['search_result'] : "";
$user_data = isset($_SESSION['user_data']) ? $_SESSION['user_data'] : null;
$delete_message = isset($_SESSION['delete_message']) ? $_SESSION['delete_message'] : "";

// Get the submitted username to preserve it in the form
$submitted_username = isset($_POST['username']) ? $_POST['username'] : (isset($_SESSION['submitted_username']) ? $_SESSION['submitted_username'] : "");

// Clear the session variables after use
unset($_SESSION['search_result']);
unset($_SESSION['user_data']);
unset($_SESSION['delete_message']);
unset($_SESSION['submitted_username']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Delete a Ticket</title>
    <link href="css/update_style.css" rel="stylesheet" />
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

            <!------------------------------------------------------------------------------------------------------------>
          <?php if (!empty($delete_message)): ?>
            <div class="message <?php echo strpos($delete_message, 'successfully') !== false ? 'success' : 'error'; ?>">
              <?php echo htmlspecialchars($delete_message); ?>
            </div>
          <?php endif; ?>
          <!------------------------------------------------------------------------------------------------------------>

          <h2 class="login-title">Delete a Ticket</h2>
          <form class="login-form" action="php/delete_ticket_handle.php" method="POST">
            <div class="form-group">
              <label for="username">Ticket ID</label>
              <input
                type="text"
                id="username"
                name="username"
                placeholder="Enter the username"
                value="<?php echo htmlspecialchars($submitted_username); ?>"
                required
              />
            </div>
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
            <button type="submit" class="login-submit-btn">Search</button>
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