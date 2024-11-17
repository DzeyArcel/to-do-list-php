<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    $task = trim($_POST['task']); 
    if (!empty($task)) {
        $stmt = $conn->prepare("INSERT INTO `list` (task, created_at) VALUES (:task, NOW())");
        $stmt->bindParam(':task', $task, PDO::PARAM_STR);
        $stmt->execute();
    }
}
header("Location: index.php");
exit;
?>
