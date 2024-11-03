<?php

include_once __DIR__ . '/../config/config.php';

// Function to create a new user
function addUser($username, $email, $password) {
    $conn = db_connect();
    $password_hash = password_hash($password, PASSWORD_DEFAULT); // Hash the password
    $sql = "INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password_hash);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}

// Function to authenticate user
function loginUser($username, $password) {
    $conn = db_connect();
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result-> fetch_assoc();
    
        if (password_verify($password, $user['password_hash'])) {
            // Start a session and save user info
            if (session_status() == PHP_SESSION_NONE) {
                session_start(); 
            }
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            return $user; // Login successful
        }
    }

    $stmt->close();
    $conn->close();
    return false; // Login failed
}

// Function to log out the user
function logoutUser() {
    session_start(); // Start the session
    unset($_SESSION['username']); 
    unset($_SESSION['$user_id']);
    session_destroy(); //Destroy the session
}
?>