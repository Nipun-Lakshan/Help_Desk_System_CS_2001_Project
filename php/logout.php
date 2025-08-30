<?php
session_start();       // Start session
session_unset();       // Remove all session variables
session_destroy();     // Destroy the session

// Redirect to index page
header("Location: ../index.html");
exit();
?>
