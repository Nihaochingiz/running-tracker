<?php
require_once 'auth.php';
if (!isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$stats = getUserStats($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Мой профиль</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Мой профиль</h1>
        
        <div class="profile-info">
            <p><strong>Имя:</strong> <?= htmlspecialchars($_SESSION['user_name']) ?></p>
            <p><strong>Логин:</strong> <?= htmlspecialchars($_SESSION['user_login']) ?></p>
            <p><strong>Уровень:</strong> <?= $stats['level'] ?></p>
        </div>
        
        <a href="index.php" class="btn">На главную</a>
    </div>
</body>
</html>