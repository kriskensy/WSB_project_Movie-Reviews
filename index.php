<?php
include 'config/db.php';
include 'helpers/auth.php';
include 'includes/header.php';

$conn = connectToDatabase();

// Pobranie filmów do czołówki
$stmt = $conn->query("SELECT m.IdMovie, m.Title, m.ReleaseYear, m.AverageRating, COUNT(r.IdReview) AS ReviewCount
                      FROM Movies m
                      LEFT JOIN Reviews r ON m.IdMovie = r.IdMovie
                      GROUP BY m.IdMovie
                      ORDER BY ReviewCount DESC, m.ReleaseYear DESC
                      LIMIT 6");
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.pkgd.min.js"></script>

<div class="hero-section" style="background-image: url('images/movie-reviews-background.jpg');">
    <div class="hero-overlay">
        <div class="carousel-container">
            <h1>Witaj w Movie Reviews!</h1>
            <h2>Najczęściej recenzowane filmy</h2>
            <div class="carousel" data-flickity='{"wrapAround": true, "autoPlay": 5000}'>
                <?php foreach ($movies as $movie): ?>
                    <div class="carousel-cell">
                        <h3><?php echo htmlspecialchars($movie['Title']); ?></h3>
                        <p>Rok wydania: <?php echo htmlspecialchars($movie['ReleaseYear']); ?></p>
                        <p>Średnia ocena: <?php echo round($movie['AverageRating'], 1); ?>/5</p>
                        <a href="generalMovie.php?id=<?php echo $movie['IdMovie']; ?>" class="btn">Zobacz więcej</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
