<?php
include 'config/db.php';
include 'helpers/auth.php';
include 'includes/header.php';
include 'helpers/validation.php';

if (!isAuthenticated()) {
    header('Location: generalLogin.php');
    exit;
}

$reviewId = $_GET['id'] ?? null;

if ($reviewId) {
    //pobieranie recenzji
    $conn = connectToDatabase();
    $stmt = $conn->prepare("SELECT * FROM Reviews WHERE IdReview = :id AND IdUser = :userId");
    $stmt->bindParam(':id', $reviewId);
    $stmt->bindParam(':userId', $_SESSION['user_id']);
    $stmt->execute();

    $review = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$review) {
        echo "Recenzja nie istnieje lub nie masz do niej dostępu.";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //aktualizacja recenzji
        $newContent = $_POST['content'];
        $newRating = $_POST['rating'];

        //wywołanie funkcji walidującej dane wprowadzane do formularza
        $errors = validateReviewForm($_POST);

        if(empty($errors)){
            $stmt = $conn->prepare("UPDATE Reviews SET Content = :content, Rating = :rating WHERE IdReview = :id");
            $stmt->bindParam(':content', $newContent);
            $stmt->bindParam(':rating', $newRating);
            $stmt->bindParam(':id', $reviewId);
            $stmt->execute();
    
            header("Location: userProfile.php");
            exit;
        }
    }
} else {
    echo "Nieprawidłowe żądanie.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edytuj Recenzję</title>
</head>
<body>
    <div class="container">
        <h1>Edytuj swoją recenzję</h1>

        <!-- komunikaty walidacji -->
        <div class="error">
            <?php if (!empty($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <form method="POST" id="reviewForm">
            <label for="content">Tekst recenzji:</label>
            <textarea name="content" id="content" rows="5" ><?php echo htmlspecialchars($review['Content']); ?></textarea><br>

            <label for="rating">Ocena (1-5):</label>
            <input type="number" name="rating" id="rating" min="1" max="5" value="<?php echo $review['Rating']; ?>" ><br>

            <button type="submit">Zapisz zmiany</button>
        </form>
    </div>
</body>
</html>
<?php include 'includes/footer.php'; ?>

<!-- podpięcie skryptu JS do walidacji po stronie klienta -->
<script src="js/script.js"></script>