<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}

error_log('Session started. Session ID: ' . session_id());
error_log('User ID: ' . ($_SESSION['user_id'] ?? 'Not set'));

include '../models/game_model.php';
include '../models/review_model.php';

if (!isset($_GET['game_id'])) {
    echo "Error: No game selected.";
    exit();
}

$game_id = $_GET['game_id'];
$game = getGame($game_id);

if (!$game) {
    echo "Error: Game not found.";
    exit();
}

$reviews = getReviews($game_id);
$user_id = $_SESSION['user_id'] ?? null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reviews for <?= htmlspecialchars($game['name']) ?></title>
    <link rel="stylesheet" href="../maincss.css">
</head>
<body>
    <div class="container">
        <h1>Reviews for <?= htmlspecialchars($game['name']) ?></h1>

        <?php if ($user_id): ?>
            <h2>Submit a Review</h2>
            <form action="../controllers/review_controller.php" method="post">
                <input type="hidden" name="game_id" value="<?= htmlspecialchars($game_id) ?>">
                <label for="rating">Rating (1-5):</label>
                <input type="number" id="rating" name="rating" min="1" max="5" required><br>
                <label for="review_text">Review:</label>
                <textarea id="review_text" name="review_text" rows="4" cols="50" required></textarea><br>
                <button type="submit" name="add_review">Submit Review</button>
            </form>
        <?php else: ?>
            <p><a href="../views/login_view.php">Log in</a> to submit a review.</p>
        <?php endif; ?>

        <h2>All Reviews</h2>
        <?php if (!empty($reviews)): ?>
            <ul>
                <?php foreach ($reviews as $review): ?>
                    <li>
                        <strong><?= htmlspecialchars($review['username']) ?></strong>
                        (Rating: <?= htmlspecialchars($review['rating']) ?>)<br>
                        <?= nl2br(htmlspecialchars($review['review_text'])) ?><br>
                        <small>Reviewed on <?= htmlspecialchars($review['review_date']) ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No reviews yet. Be the first to review this game!</p>
        <?php endif; ?>

        <p><a href="../index.php">Back to Game Database</a></p>
    </div>
</body>
</html>