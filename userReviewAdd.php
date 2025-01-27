<?php
include 'config/db.php';
include 'helpers/auth.php';
include 'includes/header.php';

if (!isAuthenticated()) {
    header('Location: generalLogin.php');
    exit;
}

//pobranie id filmu
$movieId = $_GET['id'] ?? null;
if (!$movieId) {
    echo "Nieprawidłowe żądanie.";
    exit;
}

$conn = connectToDatabase();

//sprawdzenie czy user już dodał recenzję
$stmt = $conn->prepare("SELECT * FROM Reviews WHERE IdUser = :userId AND IdMovie = :movieId");
$stmt->bindParam(':userId', $_SESSION['user_id']);
$stmt->bindParam(':movieId', $movieId);
$stmt->execute();
$existingReview = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];
    $rating = $_POST['rating'];

    if ($existingReview) {
        $stmt = $conn->prepare("UPDATE Reviews SET Content = :content, Rating = :rating WHERE IdReview = :reviewId");
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':reviewId', $existingReview['IdReview']);
        $stmt->execute();
    } else {
        $stmt = $conn->prepare("INSERT INTO Reviews (IdUser, IdMovie, Content, Rating, Date) VALUES (:userId, :movieId, :content, :rating, CURRENT_TIMESTAMP)"); //current ustawia automatycznie aktualną datę
        $stmt->bindParam(':userId', $_SESSION['user_id']);
        $stmt->bindParam(':movieId', $movieId);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':rating', $rating);
        $stmt->execute();
    }

    //obliczanie średniej ocen
    $stmt = $conn->prepare("SELECT AVG(Rating) AS averageRating FROM Reviews WHERE IdMovie = :movieId");
    $stmt->bindParam(':movieId', $movieId);
    $stmt->execute();
    $averageRating = $stmt->fetch(PDO::FETCH_ASSOC)['averageRating'];

    //aktualizacja średniej ocen (bez aktualizacji daty)
    $stmt = $conn->prepare("UPDATE Movies SET AverageRating = :averageRating WHERE IdMovie = :movieId");
    $stmt->bindParam(':averageRating', $averageRating);
    $stmt->bindParam(':movieId', $movieId);
    $stmt->execute();

    header("Location: userProfile.php");
    exit;
}

//pobranie filmu
$stmt = $conn->prepare("SELECT * FROM Movies WHERE IdMovie = :id");
$stmt->bindParam(':id', $movieId);
$stmt->execute();
$movie = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$movie) {
    echo "Film nie istnieje.";
    exit;
}

?>

<h1>Dodaj recenzję dla filmu: <?php echo htmlspecialchars($movie['Title']); ?></h1>

<?php if ($existingReview): ?>
    <p>Masz już dodaną recenzję dla tego filmu. Możesz ją edytować.</p>
<?php endif; ?>

<form method="POST">
    <label for="content">Tekst recenzji:</label>
    <textarea name="content" id="content" rows="5" required><?php echo $existingReview['Content'] ?? ''; ?></textarea><br>

    <label for="rating">Ocena (1-5):</label>
    <input type="number" name="rating" id="rating" min="1" max="5" required value="<?php echo $existingReview['Rating'] ?? ''; ?>"><br>

    <button type="submit"><?php echo $existingReview ? 'Edytuj recenzję' : 'Dodaj recenzję'; ?></button>
</form>

<?php include 'includes/footer.php'; ?>
