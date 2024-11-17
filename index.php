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
            font-family: 'Pacifico', cursive;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: linear-gradient(to top, #96fbc4 0%, #f9f586 100%);
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
           
            background: rgba(255, 255, 255, 0.2); 
            backdrop-filter: blur(50px); 
            padding: 30px 50px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            color: #fff;
            text-align: center;
        }

        h1 {
            font-size: 4.5rem; 
            font-weight: bold;
            background: linear-gradient(to right, #ff6f61, #ffb86c, #ffff7e, #69ff94, #a6e9ff, #ff92df);
            background-clip: text; 
            -webkit-background-clip: text; 
            color: transparent; 
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); 
            animation: rainbowMove 3s infinite linear;
            -webkit-text-stroke: 2px black;
         
        }

        @keyframes rainbowMove {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }

        h2 {
            font-size: 30px;
            font-weight: bold;
            background: linear-gradient(to right, #ff6f61, #ffb86c, #ffff7e, #69ff94, #a6e9ff, #ff92df);
            background-clip: text; 
            -webkit-background-clip: text; 
            color: transparent; 
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); 
            -webkit-text-stroke: 2px black;
            animation: rainbow 3s infinite linear;
        

        }

        @keyframes rainbow {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }

        .task-form {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            justify-content: center;
        }

        .task-form input {
            flex: 1;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }

        .task-form button {
            font-family: 'Pacifico', cursive;
            padding: 15px 25px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .task-form button:hover {
            background-color: #0056b3;
        }

        .task-list {
            list-style: none;
            padding: 0;
           
        }

        .task-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fafafa;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .task-list li span {
            flex: 1;
            font-size: 18px;
            color: #555;
        }

        .task-list .delete-btn {
            color: #e74c3c;
            font-weight: bold;
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            margin: 3px;
        }

        .task-list .delete-btn:hover {
            background-color: #f2d7d5;
            color: #c0392b;
        }

        .task-list .edit-form {
            display: flex;
            gap: 8px;
        }

        .task-list .edit-form input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .task-list .edit-form button {
            font-family: 'Pacifico', cursive;
            padding: 8px 16px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            margin: 3px;
        }

        .task-list .edit-form button:hover {
            background-color: #218838;
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
                    
                    <form method="POST" action="edit_task.php" class="edit-form">
                        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                        <input type="text" name="task" value="<?php echo htmlspecialchars($task['task']); ?>" required>
                        <button type="submit">Edit</button>
                        <a href="delete_task.php?delete=<?php echo $task['id']; ?>" class="delete-btn">Delete</a>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
