<?php
session_start();
require 'db.php';

// Fetch tasks from the database
$stmt = $conn->prepare("SELECT * FROM `list` ORDER BY created_at DESC");
$stmt->execute();
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>To-Do List</h1>

       
        <form method="POST" action="add_task.php" class="task-form">
            <input type="text" name="task" placeholder="Enter a new task" required>
            <button type="submit">Add Task</button>
        </form>

        
        <h2>Tasks</h2>
        <ul class="task-list">
            <?php foreach ($tasks as $task): ?>
                <li>
                    <span><?php echo htmlspecialchars($task['task']); ?></span>
                    <a href="delete_task.php?delete=<?php echo $task['id']; ?>" class="delete-btn">Delete</a>
                    <form method="POST" action="edit_task.php" class="edit-form">
                        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                        <input type="text" name="task" value="<?php echo htmlspecialchars($task['task']); ?>" required>
                        <button type="submit">Edit</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
