<?php
include 'config/db.php';
include 'helpers/auth.php';
include 'includes/header.php';

//czy admin
if (!isAuthenticated() || $_SESSION['role'] !== 'Admin') {
    header('Location: generalLogin.php');
    exit;
}

//pobranie filmów
$conn = connectToDatabase();
$stmt = $conn->prepare("SELECT m.IdMovie, m.Title, m.ReleaseYear, m.Description, 
                               d.Name AS Director, g.Name AS Genre 
                        FROM Movies m
                        JOIN Directors d ON m.IdDirector = d.IdDirector
                        JOIN Genres g ON m.IdGenre = g.IdGenre
                        ORDER BY m.IdMovie DESC");
$stmt->execute();
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h1>Zarządzaj filmami</h1>
    <a href="adminMovieAdd.php" class="btn btn-success">Dodaj nowy film</a>

    <?php if (empty($movies)): ?>
        <p>Brak filmów w bazie danych.</p>
    <?php else: ?>
        <table class="movie-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tytuł</th>
                    <th>Rok wydania</th>
                    <th>Reżyser</th>
                    <th>Gatunek</th>
                    <th>Opis</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($movies as $movie): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($movie['IdMovie']); ?></td>
                        <td><?php echo htmlspecialchars($movie['Title']); ?></td>
                        <td><?php echo htmlspecialchars($movie['ReleaseYear']); ?></td>
                        <td><?php echo htmlspecialchars($movie['Director']); ?></td>
                        <td><?php echo htmlspecialchars($movie['Genre']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($movie['Description'])); ?></td>
                        <td>
                            <a href="adminMovieEdit.php?id=<?php echo $movie['IdMovie']; ?>" class="btn btn-warning">Edytuj</a>
                            <a href="adminMovieDelete.php?id=<?php echo $movie['IdMovie']; ?>" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć ten film?')">Usuń</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>


<?php include 'includes/footer.php'; ?>
