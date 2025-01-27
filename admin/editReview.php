<?php
include '../config/db.php';
include '../helpers/auth.php';
include '../includes/header.php';

//czy admin
if (!isAuthenticated() || $_SESSION['role'] !== 'Admin') {
    header('Location: ../login.php');
    exit;
}

$reviewId = $_GET['id'] ?? null;
if (!$reviewId || !is_numeric($reviewId)) {
    echo "Nieprawidłowe ID recenzji.";
    exit;
}

$conn = connectToDatabase();

// Pobranie recenzji
$stmt = $conn->prepare("SELECT * FROM Reviews WHERE IdReview = :id");
$stmt->bindParam(':id', $reviewId, PDO::PARAM_INT);
$stmt->execute();
$review = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$review) {
    echo "Recenzja o podanym ID nie istnieje.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = $_POST['rating'];
    $reviewText = trim($_POST['review']);

    $errors = [];

    if (empty($reviewText)) {
        $errors[] = "Treść recenzji jest wymagana.";
    }

    if (empty($errors)) {
        $stmtUpdate = $conn->prepare("UPDATE Reviews SET Review = :review, Rating = :rating WHERE IdReview = :id");
        $stmtUpdate->bindParam(':review', $reviewText);
        $stmtUpdate->bindParam(':rating', $rating);
        $stmtUpdate->bindParam(':id', $reviewId, PDO::PARAM_INT);

        if ($stmtUpdate->execute()) {
            $successMessage = "Recenzja została zaktualizowana pomyślnie!";
            header("Location: manageReviews.php");
            exit;
        } else {
            $errors[] = "Wystąpił problem z aktualizacją recenzji.";
        }
    }
}
?>

<div class="container">
    <h1>Edytuj recenzję</h1>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!empty($successMessage)): ?>
        <div class="success">
            <p><?php echo htmlspecialchars($successMessage); ?></p>
        </div>
    <?php endif; ?>

    <form method="POST" action="editReview.php?id=<?php echo htmlspecialchars($reviewId); ?>">
        <label for="rating">Ocena:</label>
        <input type="number" name="rating" id="rating" value="<?php echo htmlspecialchars($review['Rating']); ?>" min="1" max="10" required>

        <label for="review">Recenzja:</label>
        <textarea name="review" id="review" required><?php echo htmlspecialchars($review['Review']); ?></textarea>

        <button type="submit">Zapisz zmiany</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
