<?php
include 'config/db.php';
include 'includes/header.php'; 
$conn = connectToDatabase();

//pobranie filmow do czołówki
$stmt = $conn->query("SELECT m.IdMovie, m.Title, m.ReleaseYear, AVG(r.Rating) AS AverageRating
                      FROM Movies m
                      LEFT JOIN Reviews r ON m.IdMovie = r.IdMovie
                      GROUP BY m.IdMovie
                      ORDER BY m.ReleaseYear DESC
                      LIMIT 6"); //limit ogranicza liczbę wyświetlanych kafelków
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="hero-section" style="background-image: url('images/movie-reviews-background.jpg');">
    <div class="hero-overlay">
        <div class="container">
            <h1>Witaj w Movie Reviews!</h1>

            <div class="movies-list">
                <h2>Najczęściej recenzowane filmy</h2>

                <div class="movie-cards">
                    <?php foreach ($movies as $movie): ?>
                        <div class="movie-card">
                            <h3><?php echo htmlspecialchars($movie['Title']); ?></h3>
                            <p>Rok wydania: <?php echo htmlspecialchars($movie['ReleaseYear']); ?></p>
                            <p>Średnia ocena: <?php echo round($movie['AverageRating'], 1); ?>/5</p>
                            <a href="movie.php?id=<?php echo $movie['IdMovie']; ?>" class="btn">Zobacz więcej</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
