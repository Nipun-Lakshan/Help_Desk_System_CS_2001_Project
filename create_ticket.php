<?php 
include __DIR__ . "/php/auth_check_students.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Help Desk - Create a Ticket</title>
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
          <h2 class="login-title">Create a Ticket</h2>
          <form
            class="login-form"
            action="php/create_ticket_handle.php"
            method="POST"
          >
            <div class="form-group">
              <label for="student_reg_number"
                >Student Registration's Number</label
              >
              <input
                type="text"
                id="student_reg_number"
                name="student_reg_number"
                value="<?php echo $_SESSION['reg_number']?>"
                readonly
              />
            </div>
            <div class="form-group textarea">
              <label for="description">Description</label>
              <textarea
                id="description"
                name="description"
                placeholder="Enter your question"
                required
              ></textarea>
            </div>
            <div class="form-group">
              <label for="department">Department</label>
              <select id="department" name="department" required>
                <option value="">-- Select a department --</option>
                <option value="Department of Chemistry">Department of Chemistry</option>
                <option value="Department of Mathematics">Department of Mathematics</option>
                <option value="Department of Nuclear Science">Department of Nuclear Science</option>
                <option value="Department of Physics">Department of Physics</option>
                <option value="Department of Plant Sciences">Department of Plant Sciences</option>
                <option value="Department of Statistics">Department of Statistics</option>
                <option value="Department of Zoology and Environment Sciences">Department of Zoology and Environment Sciences</option>
                <option value="IT Services Centre (ITSC)">IT Services Centre (ITSC)</option>
                <option value="Career Guidance Unit (CGU)">Career Guidance Unit (CGU)</option>
                <option value="Science Library">Science Library</option>
                <option value="Dean's Office">Dean's Office</option>
              </select>
            </div>
            <button type="submit" class="login-submit-btn">Create</button>
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
