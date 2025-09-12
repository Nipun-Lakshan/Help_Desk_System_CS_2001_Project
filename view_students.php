<?php 
// Include admin authentication check to secure the page.
include __DIR__ . "/php/auth_check_admin.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Desk - View Students</title>

    <!-- Stylesheet -->
    <link href="css/view_student_style.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation Bar -->
    <nav id="navbar">
        <div class="nav-container">
            <div class="logo">Help Desk - Admin</div>

            <ul class="nav-links">
                <li><a href="index.html">Home</a></li>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="faq.html">FAQs</a></li>
                <li>
                    <button class="btn-login" onclick="window.location.href='php/logout.php'">
                        Logout
                    </button>
                </li>
            </ul>
        </div>
    </nav>
    
    <!-- Main Content Section -->
    <section class="hero">
        <div class="tickets-container">
            <!-- Page Title -->
            <h1 class="login-title">Student Information View</h1>
            
            <!-- Table Container for Student Data -->
            <div class="tickets-table-container">
                <?php include 'php/fetch_students.php'; ?>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-left">
                    <p>&copy; 2025 Faculty of Science, University of Colombo. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>