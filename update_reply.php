<?php 
include __DIR__ . "/php/auth_check_users.php";

// Check if student data is available in session
if (!isset($_SESSION['user_data']) || empty($_SESSION['user_data'])) {
    // Redirect back to search page if no student data
    header("Location: check_update_reply.php");
    exit();
}

// Retrieve student data from session
$user_data = $_SESSION['user_data'];

// Clear the student data from session after retrieving it
unset($_SESSION['user_data']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Update Reply</title>
    <link href="css/reply_style.css" rel="stylesheet" />
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
          <h2 class="login-title">Update a Reply</h2>
          <form
            class="login-form"
            action="php/update_reply_handle.php"
            method="POST"
          >
          <div class="form-group">
              <label for="reply_id"
                >Reply ID</label
              >
              <input
                type="text"
                id="username"
                name="username"
                value="<?php echo htmlspecialchars($user_data['reply_id']); ?>"
                readonly
                required
              />
            </div>
            <div class="form-group">
              <label for="ticket_id"
                >Ticket ID</label
              >
              <input
                type="text"
                id="ticket_id"
                name="ticket_id"
                value="<?php echo htmlspecialchars($user_data['ticket_id']); ?>"
                readonly
                required
              />
            </div>
            <div class="form-group textarea">
              <label for="description">Description</label>
              <textarea
                id="description"
                name="description"
                placeholder="Enter your answer"
              ><?php echo htmlspecialchars($user_data['description']); ?></textarea>
            </div>
          <div class="form-group">
              <label for="replied_by"
                >Your Username</label
              >
              <input
                type="text"
                id="replied_by"
                name="replied_by"
                value="<?php echo htmlspecialchars($user_data['replied_by']); ?>"
                readonly
              />
            </div>
            <button type="submit" class="login-submit-btn">Update</button>
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
