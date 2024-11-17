<?php
// Database connection settings
$host = 'localhost';
$dbname = 'todolistproject';
$username = 'root'; // Adjust if your username is different
$password = ''; // Replace with your actual database password if set

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
