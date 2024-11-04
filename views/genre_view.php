<?php
// Start Session Management
if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}

include '../models/genre_model.php';

// Fetch all genres to display
$genres = getAllGenres();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genre Management</title>
    <link rel="stylesheet" href="../genrecss.css">
</head>
<body>
    <div class="main-container">
        <header>
            <h1>Genre Management</h1>
        </header>
        <main>
            <!-- Form to Add Genre -->
            <div class="add-genre-form">
                <form action="../controllers/genre_controller.php" method="post">
                    <input type="text" name="genre_name" placeholder="Enter new genre" required>
                    <button type="submit" name="add_genre">Add Genre</button>
                </form>
            </div>

            <!-- Genre Grid -->
            <div class="genre-grid">
                <?php foreach ($genres as $genre): ?>
                    <div class="genre-item">
                        <span><?= htmlspecialchars($genre['name']); ?></span>
                        <form action="../controllers/genre_controller.php" method="post" style="display:inline;">
                            <input type="hidden" name="genre_id" value="<?= htmlspecialchars($genre['id']); ?>">
                            <button type="submit" name="remove_genre">Remove</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>
    <div style="text-align: center; margin-top: 20px;">
        <a href="../index.php" style="color: #4a90e2; font-weight: bold;">Back to Game Database</a>
    </div>
</body>
</html>