<?php 
include __DIR__ . "/php/auth_check_admin.php";

// Check if student data is available in session
if (!isset($_SESSION['student_data']) || empty($_SESSION['student_data'])) {
    // Redirect back to search page if no student data
    header("Location: check_update_student.php");
    exit();
}

// Retrieve student data from session
$student_data = $_SESSION['student_data'];

// Clear the student data from session after retrieving it
unset($_SESSION['student_data']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Update User</title>
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
          <h2 class="login-title">Student Details</h2>
            <form class="login-form" action="php/update_handle.php" method="POST">
            <div class="form-group">
              <label for="reg_number">Student Registration Number</label>
              <input
                type="text"
                id="reg_number"
                name="reg_number"
                value="<?php echo htmlspecialchars($student_data['reg_number']); ?>"
                readonly
                required
              />
            </div>
            <div class="form-group">
              <label for="index_number">Student Index Number</label>
              <input
                type="text"
                id="index_number"
                name="index_number"
                value="<?php echo htmlspecialchars($student_data['index_number']); ?>"
                readonly
                required
              />
            </div>
          <div class="form-group">
              <label for="name_with_initials">Student Name with Initials</label>
              <input
                type="text"
                id="name_with_initials"
                name="name_with_initials"
                value="<?php echo htmlspecialchars($student_data['name_with_initials']); ?>"
                placeholder="Enter the student name with initials"
                required
              />
            </div>
            <div class="form-group">
              <label for="town">Town</label>
              <input
                id="town"
                name="town"
                value="<?php echo htmlspecialchars($student_data['town']); ?>"
                placeholder="Enter student town"
                required
              />
            </div>
            <div class="form-group">
              <label for="contact_number">Contact Number</label>
              <input
                type="tel"
                id="contact_number"
                name="contact_number"
                value="<?php echo htmlspecialchars($student_data['contact_number']); ?>"
                placeholder="Enter student contact number"
                required
              />
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input
                type="text"
                id="password"
                name="password"
                value="<?php echo htmlspecialchars($student_data['password']); ?>"
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
