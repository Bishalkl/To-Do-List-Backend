<?php
function storeData($tasks) {
    $filepath = 'data.json';

    // Check if the file exists; if not, create it with an empty array
    if(!file_exists($filepath)) {
        file_put_contents($filepath, json_encode([], JSON_PRETTY_PRINT));
    }


    // Ensure the file is writable
    if(!is_writable($filepath)) {
        throw new Exception("Error: File $filepath is not writable.");
    }

    // Write the tasks to the file
    file_put_contents($filepath, json_encode($tasks , JSON_PRETTY_PRINT));
}
?>
