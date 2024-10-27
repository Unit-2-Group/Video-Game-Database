<?php

include_once __DIR__ . '/../config/config.php';

function getAllGames() {
    $conn = db_connect();
    $sql = "SELECT * FROM games";
    $result = $conn->query($sql);
    $games = [];
    while ($row = $result->fetch_assoc()) {
        $games[] = $row;
    }
    return $games;
}

function addGame($name, $genre_id, $release_date) {
    $conn = db_connect();
    $sql = "INSERT INTO games (name, genre_id, release_date) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sis", $name, $genre_id, $release_date);
    return $stmt->execute();
}

function deleteGame($id) {
    $conn = db_connect();
    $sql = "DELETE FROM games WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

function getGame($id) {
    $conn = db_connect();
    $sql = "SELECT * FROM games WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $game = $result->fetch_assoc();
    $conn->close();
    $stmt->close();
    return $game ? $game : null;
}
