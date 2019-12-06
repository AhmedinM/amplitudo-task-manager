<?php

require_once "../database.php";
require_once "tasks_repository.php";
require_once "task.php";

$tasksRepository = new TasksRepository($dbConnection);
$task = $tasksRepository->find($_GET["task_id"]);
$projectId = $_GET["project_id"];

// find() can return NULL meaning that project with specified ID ($_GET[project_id])
// does not exists in database.
echo $task->id;
if(is_null($task)) {
    http_response_code(404);
    echo "Task Not Found";
    exit;
}

$task->isCompleted = 1;

$tasksRepository->update($task);

header("Location: ../projects/project_details.php?id=$projectId");