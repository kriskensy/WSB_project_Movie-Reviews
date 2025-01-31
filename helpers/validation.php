<?php
function validateMovieForm($data) {
    $errors = [];

    //pobieranie danych
    $title = trim($data['title']);
    $directorId = $data['director'];
    $genreId = $data['genre'];
    $releaseYear = trim($data['releaseYear']);
    $description = trim($data['description']);

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

function validateReviewForm($data) {
    $errors = [];

    $content = trim($data['content']);
    $rating = $data['rating'];

    //walidacja treści recenzji
    if (empty($content)) {
        $errors[] = "Treść recenzji nie może być pusta.";
    }

    if (strlen($content) > 2000) {
        $errors[] = "Treść recenzji nie może przekraczać 2000 znaków.";
    }

    //walidacja oceny
    if (empty($rating)) {
        $errors[] = "Ocena jest wymagana.";
    }

    if (!is_numeric($rating) || $rating < 1 || $rating > 5) {
        $errors[] = "Ocena musi być liczbą w zakresie od 1 do 5.";
    }
    return $errors;
}
?>
