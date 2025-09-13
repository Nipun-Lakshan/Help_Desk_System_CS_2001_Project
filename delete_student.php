<?php
/*
 * Student Deletion Confirmation Page
 * ==================================
 *
 * This page displays student details for confirmation before deletion.
 * It retrieves student data from session and provides a confirmation interface.
 */

// Include admin authentication check.
include __DIR__ . "/php/auth_check_admin.php";

// Check if student data is available in session.
if (!isset($_SESSION['student_data']) || empty($_SESSION['student_data'])) {
    // Redirect back to search page if no student data.
    header("Location: check_delete_student.php");
    exit();
}

// Retrieve student data from session.
$student_data = $_SESSION['student_data'];

// Clear the student data from session after retrieving it.
unset($_SESSION['student_data']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Delete a Student</title>

    <!-- Stylesheet Import -->
    <link href="css/register_style.css" rel="stylesheet" />
  </head>

  <body>
    <!-- Navigation Bar -->
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
          <h2 class="login-title">Student Details</h2>

            <!-- Delete Confirmation Form -->
            <form class="login-form" action="php/delete_handle.php" method="POST">

            <!-- Student ID Field (Read-only) -->
            <div class="form-group">
              <label for="id">Student ID</label>
              <input
                type="text"
                id="id"
                name="id"
                value="<?php echo htmlspecialchars($student_data['id']); ?>"
                readonly
              />
            </div>

            <!-- Registration Number Field (Read-only) -->
            <div class="form-group">
              <label for="reg_number">Student Registration Number</label>
              <input
                type="text"
                id="reg_number"
                name="reg_number"
                value="<?php echo htmlspecialchars($student_data['reg_number']); ?>"
                readonly
              />
            </div>

            <!-- Index Number Field (Read-only) -->
            <div class="form-group">
              <label for="index_number">Student Index Number</label>
              <input
                type="text"
                id="index_number"
                name="index_number"
                value="<?php echo htmlspecialchars($student_data['index_number']); ?>"
                readonly
              />
            </div>

            <!-- Name with Initials Field (Read-only) -->
            <div class="form-group">
              <label for="name_with_initials">Student Name with Initials</label>
              <input
                type="text"
                id="name_with_initials"
                name="name_with_initials"
                value="<?php echo htmlspecialchars($student_data['name_with_initials']); ?>"
                readonly
              />
            </div>

            <!-- Town Field (Read-only) -->
            <div class="form-group">
              <label for="town">Town</label>
              <input
                type="text"
                id="town"
                name="town"
                value="<?php echo htmlspecialchars($student_data['town']); ?>"
                readonly
              />
            </div>

            <!-- Contact Number Field (Read-only) -->
            <div class="form-group">
              <label for="contact_number">Contact Number</label>
              <input
                type="tel"
                id="contact_number"
                name="contact_number"
                value="<?php echo htmlspecialchars($student_data['contact_number']); ?>"
                readonly
              />
            </div>

            <!-- Password Field (Read-only) -->
            <div class="form-group">
              <label for="password">Password</label>
              <input
                type="text"
                id="password"
                name="password"
                value="<?php echo htmlspecialchars($student_data['password']); ?>"
                readonly
              />
            </div>

            <!-- Created Date Field (Read-only) -->
            <div class="form-group">
              <label for="created_date">Created Date</label>
              <input
                type="text"
                id="created_date"
                name="created_date"
                value="<?php echo htmlspecialchars($student_data['created_date']); ?>"
                readonly
              />
            </div>

            <!-- Updated Date Field (Read-only) -->
            <div class="form-group">
              <label for="updated_date">Updated Date</label>
              <input
                type="text"
                id="updated_date"
                name="updated_date"
                value="<?php echo htmlspecialchars($student_data['updated_date']); ?>"
                readonly
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