<?php

include_once __DIR__ . '/../config/config.php';

// Initialize genres array if it doesn't exist
if (!isset($_SESSION['genres'])) {
    $_SESSION['genres'] = [];
}

// Function to get all genres
function getALLGenres() {
    $conn = db_connect();
    $sql = "SELECT * FROM genres";
    $result = $conn->query($sql);
    $genres = [];
    while ($row = $result->fetch_assoc()) {
        $genres[] = $row;
    }
    return $genres;
}

// Function to add a genre
function addGenre($name) {
    $conn = db_connect();
    $sql = "INSERT INTO genres (name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

// Function to remove a genre
function removeGenre($id) {
    $conn = db_connect();
    $sql = "DELETE FROM genres WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>

