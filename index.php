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
    <h2>To-Do List</h2>
    <div>
      <form action="HandleData.php" method="POST">
        <input type="hidden" name="action" value="add">
        <input type="text" id="todoInput" placeholder="Add a new task" name="task" required>
        <button type="submit">Add</button>
      </form>
    </div>
    <ul id="todoList">
      <?php
        // Load the file from JSON
        $datafile = 'data.json';
        if(file_exists($datafile)) {
          $jsonData = file_get_contents($datafile);
          $tasks = json_decode($jsonData, true);
        }

        // Check the data
        if($tasks) {
          foreach($tasks as $index => $task) {
            echo '<li id="task-' . htmlspecialchars($task['id']) . '">';
            echo '<h3>' . htmlspecialchars($task['task']) . '</h3>';


            // Edit Button: Open edit form for this task
            echo '<button class="edit-btn" onclick="editTask(\'' . htmlspecialchars($task['id']) . '\', \'' . htmlspecialchars($task['task']) . '\')">Edit</button>';


            // Form for deleting the task
            echo '<form action="HandleData.php" method="POST" class="task-actions">';
            echo '<input type="hidden" name="action" value="delete">';
            echo '<input type="hidden" name="id" value="' . htmlspecialchars($task['id']) . '">';
            echo '<button type="submit" class="delete-btn">Delete</button>';
            echo '</form>';

            echo '</li>';
          };
        } else {
          echo "Please add a task.";
        }
      ?>
    </ul>
  </div>
  <script src="/script.js"></script>
</body>