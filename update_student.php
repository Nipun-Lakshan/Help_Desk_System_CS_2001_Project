<?php
/*
 * Student Update Form.
 * ====================
 *
 * This page displays a form for updating student details.
 * It retrieves student data from session and provides editable fields for admin.
 */

// Include admin authentication check.
include __DIR__ . "/php/auth_check_admin.php";

// Check if student data is available in session.
if (!isset($_SESSION['student_data']) || empty($_SESSION['student_data'])) {
    // Redirect back to search page if no student data.
    header("Location: check_update_student.php");
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
    <title>Help Desk - Update a Student</title>

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
          <h2 class="login-title">Update Student Details</h2>

            <!-- Update Form -->
            <form class="login-form" action="php/update_handle.php" method="POST">

              <!-- Student ID Field (Read-only) -->
              <div class="form-group">
              <label for="reg_number">Student ID</label>
              <input
                type="text"
                id="id"
                name="id"
                value="<?php echo htmlspecialchars($student_data['id']); ?>"
                readonly
                required
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
                required
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
                required
              />
            </div>

          <!-- Name with Initials Field (Editable) -->
          <div class="form-group">
            <label for="name_with_initials">Student Name with Initials</label>
            <input
              type="text"
              id="name_with_initials"
              name="name_with_initials"
              value="<?php echo htmlspecialchars($student_data['name_with_initials']); ?>"
              placeholder="A. B. C. Sunil"
              pattern="[a-zA-Z .]{1,100}"
              maxlength="100"
              required
            />
          </div>

            <!-- Town Field (Editable) -->
            <div class="form-group">
              <label for="town">Town</label>
              <input
                id="town"
                name="town"
                value="<?php echo htmlspecialchars($student_data['town']); ?>"
                placeholder="Mount Lavinia"
                pattern="^([A-Z][a-z]+)(\s[A-Z][a-z]+)?$"
                maxlength="100"
                required
              />
            </div>

            <!-- Contact Number Field (Editable) -->
            <div class="form-group">
              <label for="contact_number">Contact Number</label>
              <input
                type="tel"
                id="contact_number"
                name="contact_number"
                value="<?php echo htmlspecialchars($student_data['contact_number']); ?>"
                placeholder="0712345678"
                pattern="^(070|071|072|074|075|076|077|078)\d{7}$"
                maxlength="10"
                minlength="10"
                required
              />
            </div>

            <!-- Password Field (Editable) -->
            <div class="form-group">
              <label for="password">Password</label>
              <input
                type="text"
                id="password"
                name="password"
                value="<?php echo htmlspecialchars($student_data['password']); ?>"
                placeholder="2023@12345"
                maxlength="10"
                minlength="10"
                pattern="^\d{4}@\d{5}$"
                required
              />
            </div>

            <!-- Created Date Field (Read-only) -->
            <div class="form-group">
              <label for="password">Created Date</label>
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
              <label for="password">Updated Date</label>
              <input
                type="text"
                id="updated_date"
                name="updated_date"
                value="<?php echo htmlspecialchars($student_data['updated_date']); ?>"
                readonly
              />
            </div>

            <!-- Submit Button -->
            <button type="submit" class="login-submit-btn">Update</button>
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
