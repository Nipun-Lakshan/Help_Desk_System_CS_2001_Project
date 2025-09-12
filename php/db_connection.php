<?php // This line starts a PHP Script Block.

// Defines the server/host name where MySQL database is running.
// "localhost" means the database is on the same server as the PHP script.
$servername = "localhost"; // IP Address: 127.0.0.1

// Defines the username for MySQL database authentication.
// 'root' is the default administrative username in MySQL.
$username = "root";

// Defines the password for MySQL database authentication.
// Empty string means no password is set.
$password = "";

// Defines the name of the specific database to connect to.
// "helpdesk" is the database that will be used for queries.
$dbname = "helpdesk";

// Creates a new MySQLi (MySQL Improved) connection object.
// The mysqli constructor takes four parameters: servername, username, password, and database name.
// This establishes the actual connection to the MySQL database.
$conn = new mysqli($servername, $username, $password, $dbname);

// Checks if the connection was successful.
// The connect_error property contains error message if connection failed or null if successful.
if ($conn->connect_error) {

    // Terminates the script and displays an error message if connection failed.
    // The "connect_error" property provides details about what went wrong.
    // "die" uses as exit(). "." is used as a string concatenation.
    die("Connection failed: " . $conn->connect_error);
    header("Location: ../500.html");
    exit();

}

// If connection is successful, the script continues execution.
// The $conn object can now be used to perform database operations.

// This lines end a PHP Script Block.?>