<?php
// Database details
$host = 'localhost';        // Host name
$dbname = 'Route Rlanner';  // Database name
$user = 'root';             // Database username
$pass = '';                 // Database password

// Try to connect to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $e) {
    // Show error message if connection fails
    die("Connection failed: " . $e->getMessage());
}
?>
