<?php
// Database connection function
function connectDatabase() {
    $host = 'localhost';
    $username = 'root'; // Replace with your MySQL username
    $password = '';     // Replace with your MySQL password
    $dbname = 'dct-ccs-finals';

    // Create a connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die('Database connection failed: ' . $conn->connect_error);
    }
    return $conn;
}

// Login function
function loginUser($email, $password) {
    $conn = connectDatabase();

    // Sanitize input
    $email = $conn->real_escape_string($email);
    $password = md5($password); // Assuming passwords are hashed with MD5 in the database

    // Query to check credentials
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Successful login
        session_start();
        $user = $result->fetch_assoc();
        $_SESSION['user'] = $user['name'];
        $conn->close();
        return true;
    } else {
        // Failed login
        $conn->close();
        return false;
    }
}
?>
