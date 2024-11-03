<?php
include '../models/user_model.php';

// Initialize error messages
$registrationError = '';
$loginError = '';

// Function to render views
function renderView($view, $data = []) {
    extract($data);
    
    include $view;
}

// Handle registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (addUser($username, $email, $password)) {
        // Redirect or display a success message
        echo "<h1>User registered successfully!<h1>";
    } else {
        $registrationError = "Error registering user.";
    }
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['login_username'];
    $password = $_POST['login_password'];

    if ($user = loginUser($username, $password)) {
        // Store username in session
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); 
        }
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $username; 

        error_log('User logged in. User ID: ' . $user['id'], 3, "/debug.txt");
        
        // Redirect to a welcome page
        header('Location: ../index.php');
        exit();
    } else {
        $loginError = "Invalid username or password.";
    }
}

// Handle logout
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    logoutUser(); 
    // Redirect to the home page or login page
    header('Location: ../index.php'); 
    exit(); 
}


// Determine which view to render based on the request
if (isset($_GET['view'])) {
    if ($_GET['view'] === 'login') {
        renderView('../views/login_view.php', ['loginError' => $loginError]);
    } elseif ($_GET['view'] === 'registration') {
        renderView('../views/registration_view.php', ['registrationError' => $registrationError]);
    }
} else {
    // Default view
    renderView('../index.php');
}



?>
