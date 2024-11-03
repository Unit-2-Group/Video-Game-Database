<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../maincss.css"> <!-- Link to your CSS file -->
    <title>User Registration</title>
</head>
<body>
    <h2>Register</h2>
    <?php if (!empty($registrationError)): ?>
        <div style="color: red;"><?= htmlspecialchars($registrationError) ?></div>
    <?php endif; ?>
    <form action="../controllers/user_controller.php?view=registration" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="register">Register</button>
    </form>
    <p>Already have an account? <a href="../controllers/user_controller.php?view=login">Login here</a>.</p>
    <a href="../index.php">Home</a>
</body>
</html>
