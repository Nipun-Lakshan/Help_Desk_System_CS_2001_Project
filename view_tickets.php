<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Desk - View Tickets</title>
    <link href="css/ticket_view_style.css" rel="stylesheet">
</head>
<body>
    <nav id="navbar">
        <div class="nav-container">
            <div class="logo">Help Desk - Admin</div>
            <ul class="nav-links">
                <li><a href="index.html">Home</a></li>
            </ul>
        </div>
    </nav>
    
    <section class="hero">
        <div class="tickets-container">
            <h1 class="login-title">Ticket View</h1>
            
            <div class="tickets-table-container">
                <?php include 'php/fetch_tickets.php'; ?>
            </div>
        </div>
    </section>
    
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