<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function addFavorite($game_id) {
    if (!in_array($game_id, $_SESSION['favorites'])) {
        $_SESSION['favorites'][] = $game_id;
    }
}

function removeFavorite($game_id) {
    if (($key = array_search($game_id, $_SESSION['favorites'])) !== false) {
        unset($_SESSION['favorites'][$key]);
    }
}

function getFavorites() {
    return $_SESSION['favorites'];
}

// Handle add or remove actions
if (isset($_GET['action']) && isset($_GET['game_id'])) {
    $game_id = intval($_GET['game_id']);
    if ($_GET['action'] == 'add') {
        addFavorite($game_id);
    } elseif ($_GET['action'] == 'remove') {
        removeFavorite($game_id);
    }
    header("Location: ../index.php");
    exit();
}
