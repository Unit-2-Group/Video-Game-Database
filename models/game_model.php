<?php
include '../models/game_model.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_game'])) {
        $name = $_POST['name'];
        $genre_id = $_POST['genre_id'];
        $release_date = $_POST['release_date'];
        addGame($name, $genre_id, $release_date);
    }
    header("Location: ../index.php");
    exit();
}
?>