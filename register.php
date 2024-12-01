<?php
// Include database connection file
include 'database_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security

    // SQL query to insert data into users table
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $name, $email, $password);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            echo "Account created successfully!";
        } else {
            echo "Error: Could not execute the query. " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Error: Could not prepare the query. " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>



