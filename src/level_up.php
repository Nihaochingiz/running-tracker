<?php
require_once 'config.php';
require_once 'functions.php';

$level = $_GET['level'] ?? 1;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Повышение уровня!</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container level-up">
        <h1>Поздравляем!</h1>
        <p>Вы достигли уровня <?= $level ?>!</p>
        <p>Продолжайте в том же духе!</p>
        <a href="index.php" class="button">Вернуться к трекеру</a>
    </div>
</body>
</html>
