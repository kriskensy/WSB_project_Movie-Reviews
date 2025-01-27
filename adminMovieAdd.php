<?php
include 'config/db.php';
include 'helpers/auth.php';
include 'includes/header.php';

//czy admin
if (!isAuthenticated() || $_SESSION['role'] !== 'Admin') {
    header('Location: generalLogin.php');
    exit;
}

//formularz dodawania
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $directorId = $_POST['director'];
    $genreId = $_POST['genre'];
    $releaseYear = trim($_POST['releaseYear']);
    $description = trim($_POST['description']);

    $errors = [];

    //walidacja
    if (empty($title)) {
        $errors[] = "Tytuł filmu jest wymagany.";
    }
    if (empty($directorId)) {
        $errors[] = "Reżyser jest wymagany.";
    }
    if (empty($genreId)) {
        $errors[] = "Gatunek jest wymagany.";
    }
    if (empty($releaseYear) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $releaseYear)) {
        $errors[] = "Rok produkcji musi być poprawną datą.";
    }
    if (empty($description)) {
        $errors[] = "Opis filmu jest wymagany.";
    }

    //tablica z erroami bez błędów dodaje do bazy
    if (empty($errors)) {
        $conn = connectToDatabase();

        // Dodanie filmu
        $stmtMovie = $conn->prepare("INSERT INTO Movies (Title, IdDirector, IdGenre, ReleaseYear, Description) 
                                    VALUES (:title, :directorId, :genreId, :releaseYear, :description)");
        $stmtMovie->bindParam(':title', $title);
        $stmtMovie->bindParam(':directorId', $directorId);
        $stmtMovie->bindParam(':genreId', $genreId);
        $stmtMovie->bindParam(':releaseYear', $releaseYear);
        $stmtMovie->bindParam(':description', $description);

        if ($stmtMovie->execute()) {
            $successMessage = "Film został dodany pomyślnie!";
            header("Location: adminMoviesManage.php");
            exit;
        } else {
            $errors[] = "Wystąpił problem z dodaniem filmu. Spróbuj ponownie.";
        }
    }
}

//pobranie reżyserów i gatunków
$conn = connectToDatabase();
$directors = $conn->query("SELECT IdDirector, Name FROM Directors")->fetchAll(PDO::FETCH_ASSOC);
$genres = $conn->query("SELECT IdGenre, Name FROM Genres")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h1>Dodaj nowy film</h1>

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

    <form method="POST" action="adminMovieAdd.php">
        <label for="title">Tytuł filmu:</label>
        <input type="text" name="title" id="title" required>

        <label for="director">Reżyser:</label>
        <select name="director" id="director" required>
            <option value="">Wybierz reżysera</option>
            <?php foreach ($directors as $director): ?>
                <option value="<?php echo htmlspecialchars($director['IdDirector']); ?>">
                    <?php echo htmlspecialchars($director['Name']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="genre">Gatunek:</label>
        <select name="genre" id="genre" required>
            <option value="">Wybierz gatunek</option>
            <?php foreach ($genres as $genre): ?>
                <option value="<?php echo htmlspecialchars($genre['IdGenre']); ?>">
                    <?php echo htmlspecialchars($genre['Name']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="releaseYear">Rok produkcji:</label>
        <input type="date" name="releaseYear" id="releaseYear" required max="<?php echo date('Y'); ?>">

        <label for="description">Opis filmu:</label>
        <textarea name="description" id="description" required></textarea>

        <button type="submit">Dodaj film</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
