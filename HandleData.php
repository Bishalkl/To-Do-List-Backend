<?php
// first request method
// for add task
// for edit task
// for delete task

if($_SERVER["REQUEST_METHOD"] === "POST") {

    // Getting the action from the form (edit or delete)
    $action = $_POST["action"];


    
    // Handle Add Task
    if($action === "add") {
        $task = htmlspecialchars($_POST["task"]);

        $newTask = [
            "id" => uniqid(),
            "task" => $task,
        ];

        // Fetch existing tasks from data.json
        $tasks = [];
        $datafile = 'data.json';
        if(file_exists($datafile)) {
            $jsonData = file_get_contents($datafile);
            $tasks = json_decode($jsonData, true);
        }

        // Add the new task to the array
        $tasks[] = $newTask;

        // Store data in JSON file
        storeData($tasks);

        // Redirect back to index.php
        header("Location: index.php");
        exit();

    }


    
    // Handle Edit Task
    if($action === "edit") {
        $id = $_POST["id"];
        $newTask = htmlspecialchars($_POST["task"]);

        // Fetch existing tasks from data.json
        $tasks = [];
        $datafile = 'data.json';
        if(file_exists($datafile)) {
            $jsonData = file_get_contents($datafile);
            $tasks = json_decode($jsonData, true);
        }

        // Find and updata the task
        foreach($tasks as &$task) {
            if($task['id'] === $id) {
                $task['task'] = $newTask;
                break;
            }
        }

        // Store the updated tasks back into data.json
        storeData($tasks);

        // Redirect back to index.php
        header("Location: index.php");
        exit();
    }



    // Handle Delete Task
    if("action" === "delete") {
        $id = $_POST["id"];

        // Fetch exisiting tasks from data.json
        $tasks = [];
        $datafile = 'data.json';
        if(file_exists($datafile)) {
            $jsonData = file_get_contents($datafile);
            $tasks = json_decode($jsonData, true);
        }

        // Filter out the task to delete
        $tasks = array_filter($tasks, function($task) use ($id) {
            return $task['id'] !== $id;
        });

        // Re-index the array after filtering
        $tasks = array_values($tasks);

        // Store the updated tasks back into data.json
        storeData($tasks);

        // Redirect back to index.php
        header("Location: index.php");
        exit();
    }


} 