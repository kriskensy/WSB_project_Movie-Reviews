<?php
include 'includes/header.php';
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = connectToDatabase();

    $stmt = $conn->prepare('SELECT u.IdUser, u.Username, u.Password, r.Rolename FROM Users u 
                            JOIN Roles r ON u.IdRole = r.IdRole WHERE u.Username = :username');
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $user['Password'])) {
            $_SESSION['user_id'] = $user['IdUser'];
            $_SESSION['username'] = $user['Username'];
            $_SESSION['role'] = $user['Rolename'];
            $_SESSION['email'] = $user['Email']; 

            if ($user['Rolename'] === 'Admin') {
                header('Location: dashboard.php');
            } else {
                header('Location: index.php');
            }
            exit;
        } else {
            $error = 'Nieprawidłowe hasło.';
        }
    } else {
        $error = 'Nie znaleziono użytkownika o podanej nazwie.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
</head>
<body>
<h1>Logowanie</h1>
<?php if (isset($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<form method="POST" action="login.php">
    <label for="username">Nazwa użytkownika:</label>
    <input type="text" name="username" id="username" required>
    <label for="password">Hasło:</label>
    <input type="password" name="password" id="password" required>
    <button type="submit">Zaloguj</button>
</form>
</body>
</html>
<?php
include('includes/footer.php');
?>
