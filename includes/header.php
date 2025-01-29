<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Movie Reviews</title>
</head>
<body>
<header>
    <nav class="navbar">
    <a href="index.php" class="logo">
            <img src="images/movie-reviews-logo.svg" alt="Logo" class="logo">
            <h1 class="logo">Movie Reviews</h1>
        </a>
        <div class="center-button">
            <a href="index.php" class="btn btn-home">Strona główna</a>
            <a href="generalSearch.php" class="btn btn-home">Szukaj</a>
        </div>
        <div class="right-buttons">
            <?php if (isset($_SESSION['user_id'])): ?>

                <span class="welcome">Witaj, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
                
                <?php if ($_SESSION['role'] !== 'Admin'): ?>
                    <a href="userMoviesList.php" class="btn btn-primary">Lista filmów</a>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'): ?>
                    <a href="adminDashboard.php" class="btn">Panel Administratora</a>
                <?php endif; ?>

                <?php if ($_SESSION['role'] !== 'Admin'): ?>
                    <a href="userProfile.php" class="btn">Mój profil</a>
                <?php endif; ?>
                
                <a href="generalLogout.php" class="btn">Wyloguj</a>
            <?php else: ?>
                <a href="generalLogin.php" class="btn">Zaloguj</a>
                <a href="generalRegister.php" class="btn">Zarejestruj się</a>
            <?php endif; ?>
        </div>
    </nav>
</header>