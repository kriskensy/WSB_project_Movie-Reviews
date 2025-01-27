<?php
include 'includes/header.php';
include 'config/db.php';

// Pobranie ID filmu
$movieId = $_GET['id'] ?? null;

if (!$movieId) {
    echo "Nieprawidłowe żądanie.";
    exit;
}

$conn = connectToDatabase();

// Pobranie danych filmu wraz z gatunkiem
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
?>

<div class="movie-details-container" style="background: url('images/movie-reviews-background.jpg') no-repeat center center/cover;">
    <div class="movie-card">
        <h1><?php echo htmlspecialchars($movie['Title']); ?></h1>
        <p><strong>Opis:</strong> <?php echo htmlspecialchars($movie['Description']); ?></p>
        <p><strong>Gatunek:</strong> <?php echo htmlspecialchars($movie['Genre'] ?? 'Nieznany'); ?></p>
        <p><strong>Rok produkcji:</strong> <?php echo htmlspecialchars($movie['ReleaseYear']); ?></p>
        <a href="addReview.php?id=<?php echo $movieId; ?>" class="btn">Dodaj recenzję</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
