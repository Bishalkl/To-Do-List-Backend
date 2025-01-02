function editTask(taskId, taskContent) {
    // Create a prompt to edit the task content
    const newTaskContent = prompt("Edit your task:", taskContent);
  
    // Validate the input
    if (newTaskContent !== null && newTaskContent.trim() !== "") {
      // Prepare the form for submission
      const form = document.createElement("form");
      form.action = "HandleData.php";
      form.method = "POST";
  
      const actionInput = document.createElement("input");
      actionInput.type = "hidden";
      actionInput.name = "action";
      actionInput.value = "edit";
  
      const idInput = document.createElement("input");
      idInput.type = "hidden";
      idInput.name = "id";
      idInput.value = taskId;
  
      const taskInput = document.createElement("input");
      taskInput.type = "hidden";
      taskInput.name = "task";
      taskInput.value = newTaskContent;
  
      form.appendChild(actionInput);
      form.appendChild(idInput);
      form.appendChild(taskInput);
  
      // Append the form to the body temporarily and submit it
      document.body.appendChild(form);
      form.submit();
    } else {
      alert("Task content cannot be empty.");
    }
  }
  