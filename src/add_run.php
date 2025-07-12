<?php
require_once 'config.php';
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $distance = $_POST['distance'];
    $time = $_POST['time'];
    $notes = $_POST['notes'] ?? '';
    
    $id = addRun($pdo, $date, $distance, $time, $notes);
    
    // Проверяем, повысился ли уровень
    $stats = getUserStats($pdo);
    $nextLevelExp = ($stats['level'] - 1) * 100;
    if ($stats['experience'] < $nextLevelExp + 20) {
        // Уровень повысился
        header("Location: level_up.php?level=" . $stats['level']);
        exit;
    }
    
    header("Location: index.php");
    exit;
}
?>
