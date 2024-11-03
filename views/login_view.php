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
    <title>Login</title>
    <link rel="stylesheet" href="../maincss.css"> 
</head>
<body>
    <h2>Login</h2>
    <?php if (!empty($loginError)): ?>
        <div style="color: red;"><?= htmlspecialchars($loginError) ?></div>
    <?php endif; ?>
    <form action="../controllers/user_controller.php?view=login" method="post">
        <input type="text" name="login_username" placeholder="Username" required>
        <input type="password" name="login_password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
    <p>Don't have an account? <a href="../controllers/user_controller.php?view=registration">Sign up here</a></p></body>
    <a href="../index.php">Home</a>

</html>

