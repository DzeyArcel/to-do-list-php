<?php
session_start();
require 'db.php';


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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        .task-form {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .task-form input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .task-form button {
            padding: 10px 15px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .task-form button:hover {
            background-color: #218838;
        }

        .task-list {
            list-style: none;
            padding: 0;
        }

        .task-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f9f9f9;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .task-list li span {
            flex: 1;
        }

        .task-list .delete-btn {
            color: #dc3545;
            text-decoration: none;
            margin-right: 10px;
        }

        .task-list .delete-btn:hover {
            text-decoration: underline;
        }

        .task-list .edit-form {
            display: flex;
            gap: 5px;
        }

        .task-list .edit-form input {
            flex: 1;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .task-list .edit-form button {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .task-list .edit-form button:hover {
            background-color: #0056b3;
        }
    </style>
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
