<?php
include '../config/db.php';       
include '../helpers/auth.php';//autoryzacja
include '../includes/header.php';

//czy user zalogowany
if (!isAuthenticated()) {
    header('Location: ../login.php');
    exit;
}

$username = htmlspecialchars($_SESSION['username']);

echo "<div class='profile-container'>";
echo "<h1>Mój profil</h1>";
echo "<p>Witaj, " . $username . "!</p>";

//pobranie recenzji
$conn = connectToDatabase();
$stmt = $conn->prepare("SELECT r.IdReview, m.Title, r.Rating, r.Content, r.Date
                        FROM Reviews r
                        JOIN Movies m ON r.IdMovie = m.IdMovie
                        WHERE r.IdUser = :idUser");
$stmt->execute(['idUser' => $_SESSION['user_id']]);
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Twoje recenzje</h2>

<?php if (empty($reviews)): ?>
    <p class="no-reviews">Nie dodałeś jeszcze żadnej recenzji. <a href="../movie.php?id=<?php echo $_GET['id']; ?>" class="add-review-link">Dodaj recenzję</a></p>
<?php else: ?>
    <ul class="reviews-list">
        <?php foreach ($reviews as $review): ?>
            <li>
                <strong>Film:</strong> <?php echo htmlspecialchars($review['Title']); ?><br>
                <strong>Ocena:</strong> <span class="rating"><?php echo htmlspecialchars($review['Rating']); ?>/5</span><br>
                <strong>Recenzja:</strong> <?php echo nl2br(htmlspecialchars($review['Content'])); ?><br>
                <a href="editReview.php?id=<?php echo $review['IdReview']; ?>">Edytuj</a> |
                <a href="deleteReview.php?id=<?php echo $review['IdReview']; ?>" class="delete" onclick="return confirm('Czy na pewno chcesz usunąć tę recenzję?')">Usuń</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

</div>

<?php include '../includes/footer.php'; ?>