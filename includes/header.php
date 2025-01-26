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
    <nav>
        <ul>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li>Witaj, <?= htmlspecialchars($_SESSION['username']) ?>!</li>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'): ?>
                    <li><a href="admin_panel.php">Panel Administratora</a></li>
                <?php endif; ?>
                <li><a href="profile.php">Mój profil</a></li>
                <li><a href="logout.php">Wyloguj</a></li>
            <?php else: ?>
                <li><a href="login.php">Zaloguj</a></li>
                <li><a href="register.php">Zarejestruj się</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
