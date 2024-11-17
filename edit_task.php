<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['task'])) {
    $taskId = $_POST['id']; 
    $task = trim($_POST['task']); 
    
    if (!empty($task)) {
       
        $stmt = $conn->prepare("UPDATE `list` SET task = :task WHERE id = :id");
        $stmt->bindParam(':task', $task, PDO::PARAM_STR);
        $stmt->bindParam(':id', $taskId, PDO::PARAM_INT);
        $stmt->execute();
    }
   
    header("Location: index.php");
    exit;
} else {
   
    header("Location: index.php");
    exit;
}
?>
