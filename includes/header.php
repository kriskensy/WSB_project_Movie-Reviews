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
        <div class="center-button">
            <a href="index.php" class="btn btn-home">Strona główna</a>
        </div>
        <div class="right-buttons">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span class="welcome">Witaj, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'): ?>
                    <a href="admin/dashboard.php" class="btn">Panel Administratora</a>
                <?php endif; ?>
                <a href="user/profile.php" class="btn">Mój profil</a>
                <a href="../logout.php" class="btn">Wyloguj</a>
            <?php else: ?>
                <a href="login.php" class="btn">Zaloguj</a>
                <a href="register.php" class="btn">Zarejestruj się</a>
            <?php endif; ?>
        </div>
    </nav>
</header>