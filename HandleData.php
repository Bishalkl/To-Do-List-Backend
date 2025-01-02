<?php
// first request method
// for add task
// for edit task
// for delete task

require_once 'storeData.php';

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $datafile = 'data.json';
    $tasks = [];

    // Fetch existing tasks
    if(file_exists($datafile)) {
        $jsonData = file_get_contents($datafile);
        $tasks = json_decode($jsonData, true) ?? [];
    }

    // Getting the action from the form (edit or delete)
    $action = $_POST["action"] ?? '';


    
    // Handle Add Task
    if($action === "add") {
        $task = htmlspecialchars($_POST["task"]);

        $newTask = [
            "id" => uniqid(),
            "task" => $task,
        ];


        // Add the new task to the array
        $tasks[] = $newTask;

    }


    
    // Handle Edit Task
    if($action === "edit") {
        $id = $_POST["id"];
        $newTask = htmlspecialchars($_POST["task"]);

        // Find and updata the task
        foreach($tasks as &$task) {
            if($task['id'] === $id) {
                $task['task'] = $newTask;
                break;
            }
        }
    }



    // Handle Delete Task
    if($action === "delete") {
        $id = $_POST["id"];


        // Filter out the task to delete
        $tasks = array_filter($tasks, function($task) use ($id) {
            return $task['id'] !== $id;
        });

        // Re-index the array after filtering
        $tasks = array_values($tasks);

    }

    // Save updated tasks
    storeData($tasks);
    header("Location: index.php");
    exit();

}  