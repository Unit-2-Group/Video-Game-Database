<?php

include_once __DIR__ . '/../models/genre_model.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Handle add or remove actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_genre'])) {
        $name = $_POST['genre_name'];
        addGenre($name);
        header("Location: ../views/genre_view.php");
        exit();
    }

    if (isset($_POST['remove_genre'])) {
        $id = $_POST['genre_id'];
        removeGenre($id);
        header("Location: ../views/genre_view.php");
        exit();
    }
}
?>
