<?php
include 'config/db.php';
include 'helpers/auth.php';
include 'includes/header.php';

//czy admin
if (!isAuthenticated() || $_SESSION['role'] !== 'Admin') {
    header('Location: generalLogin.php');
    exit;
}

$conn = connectToDatabase();

//liczba userów
$userCount = $conn->query("SELECT COUNT(*) FROM Users")->fetchColumn();

//liczba filmów
$movieCount = $conn->query("SELECT COUNT(*) FROM Movies")->fetchColumn();

//liczba recenzji
$reviewCount = $conn->query("SELECT COUNT(*) FROM Reviews")->fetchColumn();
?>

<div class="container">
    <h1>Panel Administratora</h1>
    <p>Witaj, <?php echo htmlspecialchars($_SESSION['username']); ?>! Co chciałbyś zrobić?</p>

    <div class="dashboard-stats">
        <div class="stat">
            <h2>Filmy</h2>
            <p><?php echo $movieCount; ?></p>
            <a href="adminMoviesManage.php" class="btn btn-primary">Zarządzaj filmami</a>
        </div>
        <div class="stat">
            <h2>Recenzje</h2>
            <p><?php echo $reviewCount; ?></p>
            <a href="adminReviewsManage.php" class="btn btn-primary">Zarządzaj recenzjami</a>
        </div>
        <div class="stat">
            <h2>Użytkownicy</h2>
            <p><?php echo $userCount; ?></p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
