<?php
require_once 'config.php';
require_once 'functions.php';

if (isset($_GET['id'])) {
    deleteRun($pdo, $_GET['id']);
}

header("Location: index.php");
exit;
?>
