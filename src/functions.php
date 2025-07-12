<?php
function getAllRuns($pdo) {
    $stmt = $pdo->query("SELECT * FROM runs ORDER BY run_date DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getRunById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM runs WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addRun($pdo, $date, $distance, $time, $notes) {
    $stmt = $pdo->prepare("INSERT INTO runs (run_date, distance_km, time_minutes, notes) VALUES (?, ?, ?, ?)");
    $stmt->execute([$date, $distance, $time, $notes]);
    
    // Добавляем опыт и обновляем статистику
    $expGained = 20;
    updateUserStats($pdo, $distance, $expGained);
    
    return $pdo->lastInsertId();
}

function updateRun($pdo, $id, $date, $distance, $time, $notes) {
    // Сначала получаем старые данные пробежки
    $oldRun = getRunById($pdo, $id);
    
    $stmt = $pdo->prepare("UPDATE runs SET run_date = ?, distance_km = ?, time_minutes = ?, notes = ? WHERE id = ?");
    $stmt->execute([$date, $distance, $time, $notes, $id]);
    
    // Обновляем статистику с учетом изменений
    $distanceDiff = $distance - $oldRun['distance_km'];
    updateUserStats($pdo, $distanceDiff, 0); // Опыт не меняем при редактировании
}

function deleteRun($pdo, $id) {
    // Сначала получаем данные пробежки
    $run = getRunById($pdo, $id);
    
    $stmt = $pdo->prepare("DELETE FROM runs WHERE id = ?");
    $stmt->execute([$id]);
    
    // Обновляем статистику (уменьшаем)
    updateUserStats($pdo, -$run['distance_km'], -20);
}

function getUserStats($pdo) {
    $stmt = $pdo->query("SELECT * FROM user_stats WHERE user_id = 1");
    $stats = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$stats) {
        // Создаем запись, если ее нет
        $pdo->query("INSERT INTO user_stats (user_id) VALUES (1)");
        return [
            'level' => 1,
            'experience' => 0,
            'total_distance' => 0,
            'total_runs' => 0
        ];
    }
    
    return $stats;
}

function updateUserStats($pdo, $distance, $exp) {
    // Получаем текущую статистику
    $stats = getUserStats($pdo);
    
    // Обновляем опыт и проверяем уровень
    $newExp = $stats['experience'] + $exp;
    $newLevel = $stats['level'];
    $levelUp = false;
    
    while ($newExp >= $newLevel * 100) {
        $newExp -= $newLevel * 100;
        $newLevel++;
        $levelUp = true;
    }
    
    // Обновляем статистику
    $stmt = $pdo->prepare("UPDATE user_stats SET 
        level = ?, 
        experience = ?, 
        total_distance = total_distance + ?, 
        total_runs = total_runs + ? 
        WHERE user_id = 1");
    
    $runIncrement = ($exp > 0) ? 1 : (($exp < 0) ? -1 : 0);
    $stmt->execute([$newLevel, $newExp, $distance, $runIncrement]);
    
    return $levelUp;
}
?>
