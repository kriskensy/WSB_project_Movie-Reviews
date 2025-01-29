<?php
include 'config/db.php';
include 'helpers/auth.php';
include 'includes/header.php';

//pobranie ID filmu
$movieId = $_GET['id'] ?? null;

if (!$movieId) {
    echo "Nieprawidłowe żądanie.";
    exit;
}

$conn = connectToDatabase();

//pobranie filmu z gatunkiem
$stmt = $conn->prepare("
    SELECT m.Title, m.Description, m.ReleaseYear, g.Name AS Genre
    FROM Movies m
    LEFT JOIN Genres g ON m.IdGenre = g.IdGenre
    WHERE m.IdMovie = :id
");
$stmt->bindParam(':id', $movieId);
$stmt->execute();
$movie = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$movie) {
    echo "Film nie istnieje.";
    exit;
}

//średnia ocena filmu
$ratingStmt = $conn->prepare("SELECT AVG(Rating) AS AvgRating FROM Reviews WHERE IdMovie = :id");
$ratingStmt->bindParam(':id', $movieId);
$ratingStmt->execute();
$avgRating = $ratingStmt->fetch(PDO::FETCH_ASSOC)['AvgRating'] ?? 0;
?>


<div class="movie-details-container" style="background: url('images/movie-reviews-background.jpg') no-repeat center center/cover;">
    <div class="movie-card">
        <h1><?php echo htmlspecialchars($movie['Title']); ?></h1>
        <p><strong>Opis:</strong> <?php echo htmlspecialchars($movie['Description']); ?></p>
        <p><strong>Gatunek:</strong> <?php echo htmlspecialchars($movie['Genre'] ?? 'Nieznany'); ?></p>
        <p><strong>Rok produkcji:</strong> <?php echo htmlspecialchars($movie['ReleaseYear']); ?></p>
        <p><strong>Średnia ocena:</strong> <?php echo number_format($avgRating, 1); ?>/5</p>
        <a href="userReviewAdd.php?id=<?php echo $movieId; ?>" class="btn">Dodaj recenzję</a>
</div>

</div>

<?php include 'includes/footer.php'; ?>
