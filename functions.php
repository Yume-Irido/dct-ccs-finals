<?php
// Database connection function
function connectDatabase()
{
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
function loginUser($email, $password)
{
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

function handleLogin()
{
    // Initialize message variable
    $message = '';

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        // Sanitize and validate the email
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password']; // Password will be checked securely

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "<span><li>Invalid email format</li></span>";
        } else {
            // Check if email and password are non-empty
            if (empty($email) || empty($password)) {
                $message = "<span><li>Email is required.</li><li>Password is required.</li></span>";
            } else {
                // Call the login function to check credentials (assumed it uses password_hash and password_verify)
                if (loginUser($email, $password)) {
                    // Store user login state in session
                    $_SESSION['user'] = $email; // Or store user ID if needed
                    header("Location: admin/dashboard.php"); // Redirect to a dashboard or another page
                    exit();
                } else {
                    $message = "<span><li>Invalid email</li><li>Invalid password</li></span>";
                }
            }
        }
    }
     return $message; // Return any error or success message
}
?>