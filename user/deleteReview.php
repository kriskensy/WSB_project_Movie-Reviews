<?php
include '../includes/header.php';
include '../config/db.php';
include '../helpers/auth.php';

if (!isAuthenticated()) {
    header('Location: login.php');
    exit;
}

$reviewId = $_GET['id'] ?? null;

if ($reviewId) {
    // Usuń recenzję z bazy
    $conn = connectToDatabase();
    $stmt = $conn->prepare("DELETE FROM Reviews WHERE IdReview = :id AND IdUser = :userId");
    $stmt->bindParam(':id', $reviewId);
    $stmt->bindParam(':userId', $_SESSION['user_id']);
    $stmt->execute();

    header("Location: profile.php");
    exit;
} else {
    echo "Nieprawidłowe żądanie.";
    exit;
}
?>
<h1>Recenzja została usunięta.</h1>

<?php include '../includes/footer.php'; ?>