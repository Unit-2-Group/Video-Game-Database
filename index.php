<?php 
    // Start Session Management
    session_start();

    include 'controllers/favorite_controller.php';
    include 'models/game_model.php';
    include 'models/genre_model.php';


    $favorites = getFavorites();
    $games = getAllGames();
    $genres = getAllGenres();
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
        <h2>Add a new game</h2>
        <form action="controllers/game_controller.php" method="post">
            <label for="name">Game Name:</label>
            <input type="text" id="name" name="name" required><br>
            <label for="genre_id">Game Genre:</label>
            <select id="genre_id" name="genre_id" required>
                <option value="">Select a genre</option>
                <?php foreach ($genres as $genre): ?>
                    <option value="<?= htmlspecialchars($genre['id']) ?>"><?= htmlspecialchars($genre['name']) ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <label for="release_date">Release Date:</label>
            <input type="date" id="release_date" name="release_date" required><br>
            <button type="submit" name="add_game">Add Game</button>
        </form>
        <h2>All Games</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>Game Name</th>
                        <th>Release Date</th>
                        <th>Genre</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                    $genreLookup = [];
                    foreach ($genres as $genre) {
                        $genreLookup[$genre['id']] = $genre['name']; 
                    }

                    foreach ($games as $game): ?>
                        <tr>
                            <td><?= htmlspecialchars($game['name']) ?></td>
                            <td><?= htmlspecialchars($game['release_date']) ?></td>
                            <td>
                                <?= isset($genreLookup[$game['genre_id']]) ? htmlspecialchars($genreLookup[$game['genre_id']]) : 'Unknown Genre' ?>
                            </td>
                            <td>
                                <?php if (in_array($game['id'], $favorites)): ?>
                                    <a href="controllers/favorite_controller.php?action=remove&game_id=<?= $game['id'] ?>">Remove From Favorites</a>
                                <?php else: ?>
                                    <a href="controllers/favorite_controller.php?action=add&game_id=<?= $game['id'] ?>">Add to Favorites</a>
                                <?php endif; ?>

                                <form action="controllers/game_controller.php" method="post" style="display:inline;">
                                    <input type="hidden" name="game_id" value="<?= $game['id'] ?>">
                                    <button type="submit" name="delete_game">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <h2>Your Favorites</h2>
        <ul>
            <?php foreach($favorites as $fav_id): ?>
                    <?php foreach($games as $game): ?>
                        <?php if($game['id'] == $fav_id): ?>
                            <li><?= htmlspecialchars($game['name']) ?></li>
                     <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <!-- </ul>
        <h2>Your Genres</h2>
        <ul>
            <?php foreach($genres as $fav_id): ?>
                <?php foreach($genres as $genre): ?>
                    <?php if($genre['id'] == $fav_id): ?>
                        <li><?= htmlspecialchars($genre['name']) ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </ul> -->

    </body>
</html>