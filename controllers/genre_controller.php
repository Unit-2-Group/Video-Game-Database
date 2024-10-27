<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Handle add or remove actions
if (isset($_GET['action']) && isset($_GET['genre_id'])) {
    $genre_id = intval($_GET['genre_id']);
    if ($_GET['action'] == 'add') {
        addGenre($genre_id);
    } elseif ($_GET['action'] == 'remove') {
        removeGenre($genre_id);
    }
    header("Location: ../index.php");
    exit();
}

// Get the list of favorite genre IDs
$genres = getGenres();

?>
