<?php
include 'includes/header.php';
// Połączenie z db
include 'config/db.php';
$conn = connectToDatabase();

// Pobieranie najnowszych filmów
$stmt = $conn->prepare("SELECT * FROM Movies ORDER BY Year DESC LIMIT 10");
$stmt->execute();
$latestMovies = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Pobieranie popularnych gatunków
$stmt = $conn->prepare("SELECT Genres.Name, COUNT(*) as count FROM Movies INNER JOIN Genres ON Movies.IdGenre = Genres.IdGenre GROUP BY Genres.Name ORDER BY count DESC LIMIT 5");
$stmt->execute();
$popularGenres = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



</head>
<body>

    <main>
        <section class="featured-movies">
            </section>

        <section class="latest-movies">
            <h2>Najnowsze filmy</h2>
            <?php foreach ($latestMovies as $movie): ?>
                <div class="movie-item">
                    <img src="..." alt="<?= $movie['Title'] ?>">
                    <h3><?= $movie['Title'] ?> (<?= $movie['Year'] ?>)</h3>
                    <p><?= $movie['Description'] ?></p>
                    </div>
            <?php endforeach; ?>
        </section>

        <section class="popular-genres">
            <h2>Popularne gatunki</h2>
            <ul>
                <?php foreach ($popularGenres as $genre): ?>
                    <li><?= $genre['Name'] ?></li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>

</body>
</html>

<?php include 'includes/footer.php'; ?>