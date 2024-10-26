<?php 
include 'controllers/favorite_controller.php';
include 'models/game_model.php';
$favorites getFavorites();
 namespace tekalign\project {
    // Start Session Management
    session_start();
 }
 ?>
<!DOCTYPE html>
<html>
    <head>
   <title>Video Game Library</title>
   <link rel="stylesheet" href="maincss.css">
    </head>
    <body>
<header>
<h1>Video Game Library</h1>
</header>
<main>
    <h2>Add a new game</h2>
<form action = "controllers/game_controller.php" method = "post">
    <label for= "name">Game Name:</label>
    <input type="text" id="name" name="name" required> <br>
    <label for= "genre_id"> Genre id:</label>
    <input type="number" id="genre_id" name="genre_id" required> <br>
    <label for= "release_date">Release Date:</label>
    <input type="date" id="release_date" name="release_date" required> <br>
    <button type="submit" name="add_game">Add game</button>
</form>

<h2>All games</h2>
<ul>
    <?php foreach($games as $game) : ?>
        <li>
            <?= htmlspecialchars($game['name']) ?> - Released: <?= htmlspecialchars($game['release_date']) ?>
            <?php if (in_array($game['id'], $favorites ) ):  ?>
                <a href = "controllers/favorite_controller.php?action=remove&game_id=<?=$game['id']?>"> Remove From Favorites</a>
            <?php else: ?>
                <a href = "controllers/favorite_controller.php?action=add&game_id=<?=$game['id']?>"> Add to Favorites</a>
            <?php endif; ?>

            <form action = "controllers/game_controller.php" method = "post" style="display:inline;">
                <input type="hidden" id="game_id" value="<?=$game['id']?>" > <br>
                <button type="submit" name="delete_game">Delete game</button>
            </form>   
        </li>
    <?php endforeach; ?>
</ul>

<h2>Your Favorites</h2>
<ul>
     <?php foreach($favorites as $fav_id) : ?>
        <?php foreach($games as $game) : ?>
            <?php if($game['id'] == $fav_id): ?>
                <li><?=htmlspecialchars($game['name'])?></li>
            <?php endif; ?>
        <?php endforeach; ?>
     <?php endforeach; ?>
</ul>
</main>
    </body>
</html>