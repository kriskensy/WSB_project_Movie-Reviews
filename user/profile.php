<?php
include 'config/db.php';
include 'helpers/auth.php';

if (!isAuthenticated()) {
    header('Location: login.php');
    exit;
}

//wyświetlanie profilu użytkownika
echo "<h1>Mój profil</h1>";
echo "<p>Witaj, " . htmlspecialchars($_SESSION['username']) . "!</p>";
?>
