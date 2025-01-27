<?php
include 'config/db.php';
include 'helpers/auth.php';
include 'includes/header.php';

//czy admin
if (!isAuthenticated() || $_SESSION['role'] !== 'Admin') {
    header('Location: generalLogin.php');
    exit;
}

//pobranie id filmu
$movieId = $_GET['id'] ?? null;

//jesli id to usunięcie
if ($movieId) {
    $conn = connectToDatabase();

    //pobranie info
    $stmt = $conn->prepare("SELECT Title FROM Movies WHERE IdMovie = :id");
    $stmt->bindParam(':id', $movieId);
    $stmt->execute();
    $movie = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($movie) {
        //sam delete
        $deleteStmt = $conn->prepare("DELETE FROM Movies WHERE IdMovie = :id");
        $deleteStmt->bindParam(':id', $movieId);
        $deleteStmt->execute();
        $message = "Film \"" . htmlspecialchars($movie['Title']) . "\" został pomyślnie usunięty.";

        header("Location: adminMoviesManage.php");
        exit;
    } else {
        $message = "Nie znaleziono filmu o podanym ID.";
    }
} else {
    $message = "Nie podano ID filmu.";
}
?>

<div class="container">
    <h1>Usuwanie filmu</h1>
    <p><?= $message ?></p>
    <a href="adminMoviesManage.php" class="btn">Wróć do zarządzania filmami</a>
</div>

<?php include 'includes/footer.php'; ?>