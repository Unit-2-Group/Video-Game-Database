<?php

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = null;
}

include '../models/game_model.php';
include '../models/review_model.php';

$game_id = $_GET['game_id'];
$game = getGame($game_id);
$reviews = getReviews($game_id);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Game Reviews</title>
        <link rel="stylesheet" href="../maincss.css">
    </head>
    <body>
        <h1>Reviews for <?= htmlspecialchars($game['name']) ?></h1>

        <h2>Submit a Review</h2>

        <form action="../controllers/review_controller.php" method="post">
            <input type="hidden" name="game_id" value="<?= $game_id ?>">
            <input type="hidden" name="user_id" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>">
            <label for="rating">Rating (1-5):</label>
            <input type="number" id="rating" name="rating" min="1" max="5" required><br>
            <label for="review_text">Review:</label>
            <textarea id="review_text" name="review_text" rows="4" cols="50" required></textarea><br>
            <button type="submit" name="add_review">Submit Review</button>
        </form>

        <h2>All Reviews</h2>
        <ul>
            <?php foreach ($reviews as $review): ?>
                <li>
                    <strong><?= htmlspecialchars($review['username']) ?></strong>
                    (Rating: <?= htmlspecialchars($review['rating']) ?>)<br>
                    <?= htmlspecialchars($review['review_text']) ?><br>
                    <small>Reviewed on <?= htmlspecialchars($review['review_date']) ?></small>
                </li>
            <?php endforeach; ?>
        </ul>

        <p><a href="../index.php">Back to Game Database</a></p>
    </body>
</html>