<?php
// Start a new session or resume an existing one. This must be at the very top of your script.
session_start();

// Unset all session variables. This clears the data stored in the current session.
session_unset();

// Destroy the session. This removes the session file from the server.
session_destroy();

// Redirect the user to the homepage after a successful logout.
// The '?status=logged_out' query parameter can be used by the front-end to display a message.
header("Location: ../index.html?status=logged_out");

// Terminate the script to ensure the redirect happens immediately and no further code is executed.
exit();
?>