<?php
$mysqli = new mysqli('localhost', 'root', '', 'dct-ccs-finals');

// Authenticate user
function authenticate($username, $password) {
    global $mysqli;
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

// Session guard
function guard() {
    if (!isset($_SESSION['user'])) {
        header('Location: index.php');
        exit;
    }
}
?>
