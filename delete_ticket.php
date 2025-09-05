<?php 
include __DIR__ . "/php/auth_check_admin.php";

// Check if student data is available in session
if (!isset($_SESSION['user_data']) || empty($_SESSION['user_data'])) {
    // Redirect back to search page if no student data
    header("Location: check_delete_ticket.php");
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
    <title>Help Desk - Delete a Ticket</title>
    <link href="css/create_ticket_style.css" rel="stylesheet" />
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
          <h2 class="login-title">Delete a Ticket</h2>
          <form
            class="login-form"
            action="php/delete_ticket_handle.php"
            method="POST"
          >
           <div class="form-group">
              <label for="ticket_id"
                >Ticket ID</label
              >
              <input
                type="text"
                id="ticket_id"
                name="username"
                value="<?php echo htmlspecialchars($user_data['ticket_id']); ?>"
                readonly
              />
            </div>
            <div class="form-group">
              <label for="student_reg_number"
                >Student Registration's Number</label
              >
              <input
                type="text"
                id="student_reg_number"
                name="student_reg_number"
                value="<?php echo htmlspecialchars($user_data['student_reg_number']); ?>"
                readonly
              />
            </div>
            <div class="form-group textarea">
              <label for="description">Description</label>
              <textarea
                id="description"
                name="description"
                readonly
                required
              ><?php echo htmlspecialchars($user_data['description']); ?></textarea>
            </div>
             <div class="form-group">
              <label for="department"
                >Department</label
              >
              <input
                type="text"
                id="department"
                name="department"
                value="<?php echo htmlspecialchars($user_data['department']); ?>"
                readonly
              />
            </div>
             <div class="form-group">
              <label for="date"
                >Date & Time</label
              >
              <input
                type="text"
                id="date"
                name="date"
                value="<?php echo htmlspecialchars($user_data['date']); ?>"
                readonly
              />
            </div>
    <div class="form-group">
              <label for="status"
                >Status</label
              >
              <input
                type="text"
                id="status"
                name="status"
                value="<?php echo htmlspecialchars($user_data['status']); ?>"
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
