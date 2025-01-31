<?php
include 'config/db.php';
include 'helpers/auth.php';
include 'includes/header.php';
include 'helpers/validation.php';

//czy admin
if (!isAuthenticated() || $_SESSION['role'] !== 'Admin') {
    header('Location: generalLogin.php');
    exit;
}

//id filmu
$movieId = $_GET['id'] ?? null;

if (!$movieId || !is_numeric($movieId)) {
    echo "Nieprawidłowe ID filmu.";
    exit;
}

$conn = connectToDatabase();

//film do edycji
$stmt = $conn->prepare("SELECT * FROM Movies WHERE IdMovie = :id");
$stmt->bindParam(':id', $movieId, PDO::PARAM_INT);
$stmt->execute();
$movie = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$movie) {
    echo "Film o podanym ID nie istnieje.";
    exit;
}

//pobranie reżyserów
$directorsStmt = $conn->prepare("SELECT IdDirector, Name FROM Directors");
$directorsStmt->execute();
$directors = $directorsStmt->fetchAll(PDO::FETCH_ASSOC);

//pobranie gatunków
$genresStmt = $conn->prepare("SELECT IdGenre, Name FROM Genres");
$genresStmt->execute();
$genres = $genresStmt->fetchAll(PDO::FETCH_ASSOC);

//pobranie reżysera i gatunku dla filmu
$directorNameStmt = $conn->prepare("SELECT Name FROM Directors WHERE IdDirector = :id");
$directorNameStmt->bindParam(':id', $movie['Director'], PDO::PARAM_INT);
$directorNameStmt->execute();
$directorName = $directorNameStmt->fetchColumn();

$genreNameStmt = $conn->prepare("SELECT Name FROM Genres WHERE IdGenre = :id");
$genreNameStmt->bindParam(':id', $movie['Genre'], PDO::PARAM_INT);
$genreNameStmt->execute();
$genreName = $genreNameStmt->fetchColumn();

//formularz edycji
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $director = trim($_POST['director']);
    $genre = trim($_POST['genre']);
    $releaseYear = trim($_POST['releaseYear']);
    $description = trim($_POST['description']);

    //wywołanie funkcji walidującej dane wprowadzane do formularza
    $errors = validateMovieForm($_POST);
    
    //tablica z erroami beż błędów dodaje do bazy
    if (empty($errors)) {
        $stmt = $conn->prepare("UPDATE Movies 
                                SET Title = :title, IdDirector = :director, IdGenre = :genre, ReleaseYear = :releaseYear, Description = :description
                                WHERE IdMovie = :id");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':director', $director);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':releaseYear', $releaseYear);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $movieId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $successMessage = "Film został zaktualizowany pomyślnie!";
            //aktualizacja
            $stmt = $conn->prepare("SELECT * FROM Movies WHERE IdMovie = :id");
            $stmt->bindParam(':id', $movieId, PDO::PARAM_INT);
            $stmt->execute();
            $movie = $stmt->fetch(PDO::FETCH_ASSOC);
            
            header("Location: adminMoviesManage.php");
            exit;
        } else {
            $errors[] = "Wystąpił problem z aktualizacją filmu. Spróbuj ponownie.";
        }
    }
}
?>

<div class="container">
    <h1>Edytuj film</h1>

    <div class="error">
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

    <form method="POST" action="adminMovieEdit.php?id=<?php echo htmlspecialchars($movieId); ?>">
        <label for="title">Tytuł filmu:</label>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($movie['Title']); ?>" >

        <label for="director">Reżyser:</label>
        <select name="director" id="director" >
            <option value="">Wybierz reżysera</option>
            <?php foreach ($directors as $directorOption): ?>
                <option value="<?php echo $directorOption['IdDirector']; ?>" 
                    <?php echo $movie['Director'] == $directorOption['IdDirector'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($directorOption['Name']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="genre">Gatunek:</label>
        <select name="genre" id="genre" >
            <option value="">Wybierz gatunek</option>
            <?php foreach ($genres as $genreOption): ?>
                <option value="<?php echo $genreOption['IdGenre']; ?>" 
                    <?php echo $movie['Genre'] == $genreOption['IdGenre'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($genreOption['Name']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="releaseYear">Rok produkcji:</label>
        <input type="date" name="releaseYear" id="releaseYear" value="<?php echo htmlspecialchars($movie['ReleaseYear']); ?>" max="<?php echo date('Y'); ?>" >

        <label for="description">Opis filmu:</label>
        <input type="text" name="description" id="description" value="<?php echo htmlspecialchars($movie['Description']); ?>" >

        <button type="submit">Zapisz zmiany</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>

<!-- podpięcie skryptu JS do walidacji po stronie klienta -->
<script src="js/script.js"></script>
