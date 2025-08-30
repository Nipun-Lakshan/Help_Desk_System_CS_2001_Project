<?php // Opening PHP tag to start a PHP script.

/**
 * Session Management and Admin Validation Script.
 * This script handles session expiration, security regeneration and admin verification.
 */

// --------------------------
// ----Session Management----
// --------------------------

// Start or resume an existing session to access session variables.
session_start();

// Define session timeout period.
$session_expire_time = 1800; // Session will expire within 30 minutes.

// Define the session id regeneration time.
$session_regenerate_time = 900; // Session ID will regenerate after every 15 minutes.

// Check if session has expired due to inactivity.
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $session_expire_time)) {

    // Session expired - clear all session variables but keep session structure.
    session_unset();

    // Destroy the session completely including session cookie.
    session_destroy();

    // Include and display a 401 (Unauthorized User) or Access Denied error page.
    // "/" is needed when starting the string for path with _DIR_.
    include __DIR__ . "/../401.html";
    
    // Stop script execution after displaying error page.
    exit();

}

// Update the last activity timestamp to current time to keep session alive.
$_SESSION['LAST_ACTIVITY'] = time();

// Check if session creation time is not set.
if (!isset($_SESSION['CREATED'])) {

    // Set session creation time to current timestamp.
    $_SESSION['CREATED'] = time();

// To improve security, the session ID will be changed after 05 Seconds.
} elseif (time() - $_SESSION['CREATED'] > $session_regenerate_time) {

    // Regenerate session ID.
    session_regenerate_id(true);

    // Update session creation time after regeneration.
    $_SESSION['CREATED'] = time();

}

// --------------------------
// -----Admin Validation-----
// --------------------------

// Set error reporting to display all errors for debugging.
error_reporting(E_ALL);

// Configure PHP to display errors on screen.
ini_set('display_errors', 1);

// Replace the entire admin validation section with:
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != 0 || $_SESSION['user_type'] != 'admin') {
    include __DIR__ . "/../401.html";
    exit();
}
?>