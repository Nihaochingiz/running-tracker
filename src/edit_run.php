<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$run = getRunById($pdo, $id);

if (!$run) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $distance = $_POST['distance'];
    $time = $_POST['time'];
    $notes = $_POST['notes'] ?? '';
    
    updateRun($pdo, $id, $date, $distance, $time, $notes);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать пробежку</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Редактировать пробежку</h1>
        
        <form action="edit_run.php?id=<?= $id ?>" method="post">
            <label for="date">Дата:</label>
            <input type="date" id="date" name="date" value="<?= $run['run_date'] ?>" required>
            
            <label for="distance">Дистанция (км):</label>
            <input type="number" id="distance" name="distance" step="0.01" min="0" value="<?= $run['distance_km'] ?>" required>
            
            <label for="time">Время (минуты):</label>
            <input type="number" id="time" name="time" min="0" value="<?= $run['time_minutes'] ?>" required>
            
            <label for="notes">Заметки:</label>
            <textarea id="notes" name="notes"><?= $run['notes'] ?></textarea>
            
            <button type="submit">Сохранить</button>
            <a href="index.php" class="button">Отмена</a>
        </form>
    </div>
</body>
</html>
