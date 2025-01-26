<?php
function connectToDatabase() {
    $host = "localhost";
    $dbname = "movie_reviews_db";
    $user = "root";
    $password = "";

    //połączenie z db przy pomocy PDO
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Błąd połączenia z bazą danych: " . $e->getMessage());
    }
}
?>