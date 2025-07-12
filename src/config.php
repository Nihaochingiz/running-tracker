<?php
$host = 'db'; // имя сервиса в docker-compose
$dbname = 'running_db';
$username = 'running_user';
$password = 'mysecretpassword';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Проверяем, есть ли таблицы, если нет - создаем
    $tables = $pdo->query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'")->fetchAll();
    if (count($tables) === 0) {
        $initSql = file_get_contents('/docker-entrypoint-initdb.d/init.sql');
        $pdo->exec($initSql);
    }
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>
