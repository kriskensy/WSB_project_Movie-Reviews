<?php
include '../config/db.php';
include '../helpers/auth.php';
include '../includes/header.php';

//czy admin
if (!isAuthenticated() || $_SESSION['role'] !== 'Admin') {
    header('Location: ../login.php');
    exit;
}

$conn = connectToDatabase();

// Pobranie recenzji
$stmt = $conn->query("SELECT r.IdReview, r.Content AS ReviewContent, r.Rating, m.Title AS MovieTitle, u.Username 
                      FROM Reviews r 
                      JOIN Movies m ON r.IdMovie = m.IdMovie
                      JOIN Users u ON r.IdUser = u.IdUser");
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Usuwanie recenzji
if (isset($_GET['delete'])) {
    $reviewId = $_GET['delete'];
    $stmtDelete = $conn->prepare("DELETE FROM Reviews WHERE IdReview = :id");
    $stmtDelete->bindParam(':id', $reviewId);
    if ($stmtDelete->execute()) {
        header("Location: manageReviews.php");
        exit;
    }
    $errorMessage = "Wystąpił problem z usunięciem recenzji.";
}
?>

<div class="container">
    <h1>Zarządzanie recenzjami</h1>

    <?php if (!empty($errorMessage)): ?>
        <div class="error-message">
            <p><?php echo htmlspecialchars($errorMessage); ?></p>
        </div>
    <?php endif; ?>

    <table class="reviews-table">
        <thead>
            <tr>
                <th>Film</th>
                <th>Użytkownik</th>
                <th>Ocena</th>
                <th>Recenzja</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reviews as $review): ?>
                <tr>
                    <td><?php echo htmlspecialchars($review['MovieTitle']); ?></td>
                    <td><?php echo htmlspecialchars($review['Username']); ?></td>
                    <td><?php echo htmlspecialchars($review['Rating']); ?></td>
                    <td><?php echo htmlspecialchars($review['ReviewContent']); ?></td>
                    <td>
                        <a href="editReview.php?id=<?php echo htmlspecialchars($review['IdReview']); ?>" class="btn btn-warning">Edytuj</a>
                        <a href="?delete=<?php echo htmlspecialchars($review['IdReview']); ?>" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć tę recenzję?')">Usuń</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
