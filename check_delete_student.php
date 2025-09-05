<?php 

include __DIR__ . "/php/auth_check_admin.php";

// Retrieve search results and student data from session
$search_result = isset($_SESSION['search_result']) ? $_SESSION['search_result'] : "";
$student_data = isset($_SESSION['student_data']) ? $_SESSION['student_data'] : null;
$delete_message = isset($_SESSION['delete_message']) ? $_SESSION['delete_message'] : "";
$submitted_reg_number = isset($_SESSION['submitted_reg_number']) ? $_SESSION['submitted_reg_number'] : "";

// Clear the session variables after use
unset($_SESSION['search_result']);
unset($_SESSION['student_data']);
unset($_SESSION['delete_message']);
unset($_SESSION['submitted_reg_number']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Delete</title>
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
            <!-- -------------------------------------------------------------------------------------- -->
          <?php if (!empty($delete_message)): ?>
            <div class="message <?php echo strpos($delete_message, 'successfully') !== false ? 'success' : 'error'; ?>">
              <?php echo htmlspecialchars($delete_message); ?>
            </div>
          <?php endif; ?>
            <!-- -------------------------------------------------------------------------------------- -->
          <h2 class="login-title">Delete a Student</h2>
          <form class="login-form" action="php/delete_handle.php" method="POST">
            <div class="form-group">
              <label for="reg_number_search">Student Registration Number</label>
              <input
                type="text"
                id="reg_number_search"
                name="reg_number"
                placeholder="Enter the student registration number"
                value="<?php echo htmlspecialchars($submitted_reg_number); ?>""
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