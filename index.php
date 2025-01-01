<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To-Do List</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="todo-container">
    <h1>To-Do List</h1>
    <div class="input-group">
      <!-- Form sending data to HandleData.php to add a new task -->
      <form action="HandleData.php" method="POST">
        <input type="hidden" name="action" value="add">
        <input type="text" id="task-input" placeholder="Add a new task" name="task" required>
        <button type="submit" id="add-task-btn" >Add</button>
      </form>
    </div>
    <div id="task-list">
      <?php
      // Load and decode the JSON data
      $datafile = 'data.json';
      if (file_exists($datafile)) {
        $jsonData = file_get_contents($datafile);
        $tasks = json_decode($jsonData, true);

        // Check if the data was properly decoded
        if ($tasks) {
          foreach ($tasks as $index => $task) {
            echo '<div class="task">';
            echo '<h3>' . htmlspecialchars($task['task']) . '</h3>'; // Display task title

            // Edit and Delete Buttons
            echo '<form action="HandleData.php" method="POST" class="task-actions">';
            echo '<input type="hidden" name="action" value="edit">';
            echo '<input type="hidden" name="id" value="' . htmlspecialchars($task['id']) . '">';
            echo '<button type="submit" class="edit-btn">Edit</button>';
            echo '</form>';

            echo '<form action="HandleData.php" method="POST" class="task-actions">';
            echo '<input type="hidden" name="action" value="delete">';
            echo '<input type="hidden" name="id" value="' . htmlspecialchars($task['id']) . '">';
            echo '<button type="submit" class="delete-btn">Delete</button>';
            echo '</form>';

            echo '</div>';
          }
        } else {
          echo '<p>No tasks found.</p>';
        }
      } else {
        echo '<p>Error: data.json file not found.</p>';
      }
      ?>
    </div>
  </div>
  
  <script src="/script.js"></script>
</body>
</html>
