<?php
$servername = "localhost";
$username = "root";
$password = "welcome1"; // Replace with your actual database password if different
$dbname = "wags_and_whiskers"; // Make sure this is the correct database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

