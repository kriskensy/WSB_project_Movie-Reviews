<?php
function validateMovieForm($data) {
    $errors = [];

    //pobieranie danych
    $title = trim($_POST['title']);
    $directorId = $_POST['director'];
    $genreId = $_POST['genre'];
    $releaseYear = trim($_POST['releaseYear']);
    $description = trim($_POST['description']);

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
    } //dopuszczamy datę z przyszłości bo często filmy w takoch serwisach mają oceny jeszcze przed ukończeniem produkcji

    if (empty($description)) {
        $errors[] = "Opis filmu jest wymagany.";
    }

    return $errors;
}
?>
