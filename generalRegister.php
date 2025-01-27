<?php
include 'config/db.php';
include 'helpers/auth.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $conn = connectToDatabase();

    try {
        $stmt = $conn->prepare('INSERT INTO Users (Username, Password, Email, IdRole) VALUES (:username, :password, :email, 1)');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        header('Location: generalLogin.php');
        exit;
    } catch (PDOException $e) {
        $error = 'Rejestracja nie powiodła się: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
</head>
<body>
<h1>Rejestracja</h1>
<?php if (isset($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<form method="POST" action="generalRegister.php">
    <label for="username">Nazwa użytkownika:</label>
    <input type="text" name="username" id="username" required>
    <label for="email">E-mail:</label>
    <input type="email" name="email" id="email" required>
    <label for="password">Hasło:</label>
    <input type="password" name="password" id="password" required>
    <button type="submit">Zarejestruj się</button>
</form>
</body>
</html>
<?php include 'includes/footer.php'; ?>