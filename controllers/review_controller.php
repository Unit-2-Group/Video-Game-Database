<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}

include '../models/review_model.php';

// Handle adding a review
if (isset($_POST['add_review'])) {
    $game_id = $_POST['game_id'] ?? null;
    $user_id = $_SESSION['user_id'];
    $rating = $_POST['rating'] ?? null;
    $review_text = trim($_POST['review_text'] ?? '');

    if ($user_id) {
        if (addReview($game_id, $user_id, $rating, $review_text)) {
            header("Location: ../views/reviews_view.php?game_id=" . $game_id); // Redirect to the reviews page for the game
            exit();
        } else {
            echo "Error: Unable to add review.";
        }
    } else {
        echo "You must be logged in to submit a review.";
    }
}