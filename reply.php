<?php 
include __DIR__ . "/php/auth_check_users.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Reply a Ticket</title>
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
          <h2 class="login-title">Reply a Ticket</h2>
          <form
            class="login-form"
            action="php/reply_handle.php"
            method="POST"
          >
            <div class="form-group">
              <label for="ticket_id"
                >Ticket ID</label
              >
              <input
                type="text"
                id="ticket_id"
                name="ticket_id"
                placeholder="Enter the ticket id"
                required
              />
            </div>
            <div class="form-group textarea">
              <label for="description">Description</label>
              <textarea
                id="description"
                name="description"
                placeholder="Enter your answer"
                required
              ></textarea>
            </div>
          <div class="form-group">
              <label for="replied_by"
                >Your Username</label
              >
              <input
                type="text"
                id="replied_by"
                name="replied_by"
                value="<?php echo $_SESSION['username']?>"
                readonly
              />
            </div>
            <button type="submit" class="login-submit-btn">Submit</button>
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
