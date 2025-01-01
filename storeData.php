<?php
function storeData($tasks) {
    $filepath = 'data.json';
    
    // Check if the file exists and is writable
    if (!file_exists($filepath)) {
        file_put_contents($filepath, json_encode([], JSON_PRETTY_PRINT));
    }

    $existingData = json_decode(file_get_contents($filepath), true) ?? [];

    // Add the new tasks to the existing data
    foreach($tasks as $task) {
        $newTask = [
            "task" => $task['task'],
            "id" => uniqid(),
        ];

        // Add the new task to the existing tasks array
        $existingData[] = $newTask;
    }

    // Save the updated tasks back to the file
    file_put_contents($filepath, json_encode($existingData, JSON_PRETTY_PRINT));
}
?>
