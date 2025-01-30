<?php
include 'config/db.php';
include 'helpers/auth.php';
include 'includes/header.php';
include 'helpers/validation.php';

//czy admin
if (!isAuthenticated() || $_SESSION['role'] !== 'Admin') {
    header('Location: generallogin.php');
    exit;
}

$reviewId = $_GET['id'] ?? null;
if (!$reviewId || !is_numeric($reviewId)) {
    echo "Nieprawidłowe ID recenzji.";
    exit;
}

$conn = connectToDatabase();

//pobranie recenzji
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
    $contentText = trim($_POST['content']);

    $errors = validateReviewForm($_POST);

    if (empty($errors)) {
        $stmtUpdate = $conn->prepare("UPDATE Reviews SET Content = :content, Rating = :rating WHERE IdReview = :id");
        $stmtUpdate->bindParam(':content', $contentText);
        $stmtUpdate->bindParam(':rating', $rating);
        $stmtUpdate->bindParam(':id', $reviewId, PDO::PARAM_INT);

        if ($stmtUpdate->execute()) {
            $successMessage = "Recenzja została zaktualizowana pomyślnie!";
            header("Location: adminReviewsManage.php");
            exit;
        } else {
            $errors[] = "Wystąpił problem z aktualizacją recenzji.";
        }
    }
}
?>

<div class="container">
    <h1>Edytuj recenzję</h1>

    <!-- komunikaty walidacji -->
    <div class="error" id="error-messages">
        <?php if (!empty($errors)): ?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <?php if (!empty($successMessage)): ?>
        <div class="success">
            <p><?php echo htmlspecialchars($successMessage); ?></p>
        </div>
    <?php endif; ?>

    <form  id="reviewForm"  method="POST" action="adminReviewEdit.php?id=<?php echo htmlspecialchars($reviewId); ?>">
        <label for="rating">Ocena:</label>
        <input type="number" name="rating" id="rating" value="<?php echo htmlspecialchars($review['Rating']); ?>" min="1" max="5" >

        <label for="content">Recenzja:</label>
        <textarea name="content" id="content" ><?php echo htmlspecialchars($review['Content']); ?></textarea>

        <button type="submit">Zapisz zmiany</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>

<!-- podpięcie skryptu JS do walidacji po stronie klienta -->
<script src="js/script.js"></script>
