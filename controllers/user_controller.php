<?php
include '../models/user_model.php';

// Initialize error messages
$registrationError = '';
$loginError = '';

// Function to render views
function renderView($view, $data = []) {
    // Extract the data array into variables
    extract($data);
    
    // Include the view file
    include $view;
}

// Handle registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check for existing username or email (implement this in your user model if needed)
    // Example:
    // if (usernameExists($username) || emailExists($email)) {
    //     $registrationError = "Username or email already taken.";
    // } else {
    if (addUser($username, $email, $password)) {
        // Redirect or display a success message
        echo "User registered successfully!";
        // Optionally redirect to a login page or home page
        // header('Location: login_view.php');
        // exit();
    } else {
        $registrationError = "Error registering user.";
    }
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['login_username'];
    $password = $_POST['login_password'];

    if (loginUser($username, $password)) {
        // Store username in session
        session_start(); // Start session if not already started
        $_SESSION['username'] = $username; // Store username in session
        
        // Redirect to a welcome page
        header('Location: ../index.php');
        exit();
    } else {
        $loginError = "Invalid username or password.";
    }
}

// Handle logout
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    logoutUser(); // Call the logout function from the model
    // Redirect to the home page or login page
    header('Location: ../index.php'); // Change to your desired redirect page
    exit(); // Make sure to exit after redirecting
}


// Determine which view to render based on the request
if (isset($_GET['view'])) {
    if ($_GET['view'] === 'login') {
        renderView('../views/login_view.php', ['loginError' => $loginError]);
    } elseif ($_GET['view'] === 'registration') {
        renderView('../views/registration_view.php', ['registrationError' => $registrationError]);
    }
} else {
    // Default view (could be a landing page or home)
    renderView('../index.php');
}

?>
