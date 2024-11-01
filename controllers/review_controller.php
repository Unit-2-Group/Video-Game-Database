<?php

include '../models/review_model.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_review'])) {
        $game_id = $_POST['game_id'];
        $user_id = $_SESSION['user_id'];
        $rating = $_POST['rating'];
        $review_text = $_POST['review_text'];

        if (addReview($game_id, $user_id, $rating, $review_text)) {
            header("Location: ../views/game_reviews.php?game_id=" . $game_id);
            exit();
        }
    }
}