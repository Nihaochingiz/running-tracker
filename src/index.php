<?php
require_once 'config.php';
require_once 'functions.php';

// Получаем все пробежки
$runs = getAllRuns($pdo);
$stats = getUserStats($pdo);
$nextLevelExp = $stats['level'] * 100;
$progress = ($stats['experience'] / $nextLevelExp) * 100;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Трекер пробежек</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Трекер пробежек</h1>
        
        <div class="stats">
            <h2>Ваша статистика</h2>
            <p>Уровень: <?= $stats['level'] ?></p>
            <p>Опыт: <?= $stats['experience'] ?>/<?= $nextLevelExp ?></p>
            <div class="progress-bar">
                <div class="progress" style="width: <?= $progress ?>%"></div>
            </div>
            <p>Всего пробежал: <?= $stats['total_distance'] ?> км</p>
            <p>Количество пробежек: <?= $stats['total_runs'] ?></p>
        </div>

        <h2>Добавить пробежку</h2>
        <form action="add_run.php" method="post">
            <label for="date">Дата:</label>
            <input type="date" id="date" name="date" required>
            
            <label for="distance">Дистанция (км):</label>
            <input type="number" id="distance" name="distance" step="0.01" min="0" required>
            
            <label for="time">Время (минуты):</label>
            <input type="number" id="time" name="time" min="0" required>
            
            <label for="notes">Заметки:</label>
            <textarea id="notes" name="notes"></textarea>
            
            <button type="submit">Добавить</button>
        </form>

        <h2>История пробежек</h2>
        <table>
            <thead>
                <tr>
                    <th>Дата</th>
                    <th>Дистанция (км)</th>
                    <th>Время (мин)</th>
                    <th>Средний темп</th>
                    <th>Заметки</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($runs as $run): ?>
                <tr>
                    <td><?= $run['run_date'] ?></td>
                    <td><?= $run['distance_km'] ?></td>
                    <td><?= $run['time_minutes'] ?></td>
                    <td><?= round($run['time_minutes'] / $run['distance_km'], 2) ?> мин/км</td>
                    <td><?= $run['notes'] ?></td>
                    <td>
                        <a href="edit_run.php?id=<?= $run['id'] ?>">Редактировать</a>
                        <a href="delete_run.php?id=<?= $run['id'] ?>" onclick="return confirm('Удалить эту пробежку?')">Удалить</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="script.js"></script>
</body>
</html>
