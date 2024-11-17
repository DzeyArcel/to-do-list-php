<?php
require 'db.php';


if (isset($_GET['delete'])) {
    $taskId = $_GET['delete']; 

  
    $stmt = $conn->prepare("DELETE FROM `list` WHERE id = :id");
    $stmt->bindParam(':id', $taskId, PDO::PARAM_INT);
    $stmt->execute();
}


header("Location: index.php");
exit;
?>
