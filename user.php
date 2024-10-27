<?php
// Database connection function
function db_connect() {
    $host = 'localhost'; // Database host
    $user = 'root'; // Database username
    $pass = ''; // Database password
    $db = 'videogame_db'; // Database name

    $conn = new mysqli($host, $user, $pass, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

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
    $user = $result->fetch_assoc();
    
    if ($user && password_verify($password, $user['password_hash'])) {
        // Start a session and save user info
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $stmt->close();
        $conn->close();
        return true; // Login successful
    }

    $stmt->close();
    $conn->close();
    return false; // Login failed
}

// Handle registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (addUser($username, $email, $password)) {
        echo "User registered successfully!";
    } else {
        echo "Error registering user.";
    }
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['login_username'];
    $password = $_POST['login_password'];

    if (loginUser($username, $password)) {
        echo "Login successful! Welcome, " . htmlspecialchars($username) . "!";
    } else {
        echo "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration and Login</title>
</head>
<body>
    <h2>Register</h2>
    <form action="" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="register">Register</button>
    </form>

    <h2>Login</h2>
    <form action="" method="post">
        <input type="text" name="login_username" placeholder="Username" required>
        <input type="password" name="login_password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>
