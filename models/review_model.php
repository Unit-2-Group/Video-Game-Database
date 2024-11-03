<?php 

include_once __DIR__ . '/../config/config.php';

function getReviews($game_id) {
    $conn = db_connect();
    $sql = "SELECT r.id, r.rating, r.review_text, r.review_date, u.username 
            FROM reviews r JOIN users u ON r.user_id = u.id
            WHERE r.game_id = ?
            ORDER BY r.review_date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $game_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $reviews = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
    print_r($reviews);
    return $reviews;
}

function addReview($game_id, $user_id, $rating, $review_text) {
    $conn = db_connect();
    $sql = "INSERT INTO reviews (game_id, user_id, rating, review_text, review_date) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiis", $game_id, $user_id, $rating, $review_text);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    return true;
}