<?php
// Dane połączenia z bazą danych
$host = "localhost";
$dbname = "movie_reviews_db"; // Nazwa bazy danych
$user = "root";     // Użytkownik MySQL
$password = "";     // Hasło MySQL (puste dla XAMPP)

// Połączenie z bazą danych za pomocą PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Błąd połączenia z bazą danych: " . $e->getMessage());
}
?>