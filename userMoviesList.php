<?php
include 'config/db.php';
include 'helpers/auth.php';
include 'includes/header.php';

//lista filmów
$conn = connectToDatabase();
$stmt = $conn->prepare("SELECT m.IdMovie, m.Title, m.ReleaseYear, m.Description, 
                               d.Name AS Director, g.Name AS Genre , m.AverageRating
                        FROM Movies m
                        JOIN Directors d ON m.IdDirector = d.IdDirector
                        JOIN Genres g ON m.IdGenre = g.IdGenre
                        ORDER BY m.IdMovie DESC");
$stmt->execute();
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h1>Lista filmów</h1>

    <div class="toolbar">
        <input type="text" id="searchBox" placeholder="Szukaj..." />
        <button onclick="filterMovies()">🔍</button>
        <select id="sortSelect" onchange="sortMovies()">
            <option value="Title">Sortuj według tytułu</option>
            <option value="ReleaseYear">Sortuj według roku wydania</option>
            <option value="AverageRating">Sortuj według oceny</option>
            <option value="Genre">Sortuj według gatunku</option>
        </select>
    </div>

    <?php if (empty($movies)): ?>
        <p>Brak filmów w bazie danych.</p>
    <?php else: ?>
        <table class="movie-table" id="movieTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tytuł</th>
                    <th>Rok wydania</th>
                    <th>Reżyser</th>
                    <th>Gatunek</th>
                    <th>Opis</th>
                    <th>Średnia Ocena</th>
                    <th>Akcja</th>
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
                            <?php if ($movie['AverageRating'] !== null): ?>
                                <?php echo number_format($movie['AverageRating'], 2); ?>
                            <?php else: ?>
                                Brak ocen
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="generalMovie.php?id=<?php echo $movie['IdMovie']; ?>" class="btn btn-details">Pokaż szczegóły</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script src="js/functions.js"></script>

<?php include 'includes/footer.php'; ?>
