<?php
include 'includes/header.php';

//pobranie id filmu
$movieId = $_GET['id'] ?? null;

if (!$movieId) {
    echo "Nieprawidłowe żądanie.";
    exit;
}

$conn = connectToDatabase();
$stmt = $conn->prepare("SELECT * FROM Movies WHERE IdMovie = :id");
$stmt->bindParam(':id', $movieId);
$stmt->execute();
$movie = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$movie) {
    echo "Film nie istnieje.";
    exit;
}

echo "<h1>" . htmlspecialchars($movie['Title']) . "</h1>";
echo "<p>" . htmlspecialchars($movie['Description']) . "</p>";
echo "<p>Gatunek: " . htmlspecialchars($movie['Genre']) . "</p>";
echo "<p>Rok produkcji: " . htmlspecialchars($movie['Year']) . "</p>";

//dodanie recenzji
echo "<p><a href='addReview.php?id=" . $movie['IdMovie'] . "'>Dodaj recenzję</a></p>";

include 'includes/footer.php'; ?>
