<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Initialize genres array if it doesn't exist
if (!isset($_SESSION['genres'])) {
    $_SESSION['genres'] = [];
}



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
?>
