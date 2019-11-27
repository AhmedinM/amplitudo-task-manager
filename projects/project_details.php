<?php

require_once "../database.php";
require_once "project.php";
require_once "projects_repository.php";
require_once "../tasks/tasks_repository.php";

//tasks/tasks.php?page=2&per_page=20
//$page = $_GET['page'];
//$per_page = $_GET['per_page'];
//$offset = ($page - 1)*$per_page;
//$sql = "SELECT * FROM tasks LIMIT $per_page OFFSET $offset";

if(!isset($_GET["id"])){
    http_response_code(400);
    echo "Bad Request";
    exit;
}

$projectId = $dbConnection->real_escape_string($_GET["id"]);  //provjerava SQL i preuredjuje ga; mysql_real_escape_string
$projectsRepository = new ProjectRepository($dbConnection);
$project = $projectsRepository->find($projectId);

if(is_null($project)){
    http_response_code(404);    //404 NOT FOUND
    echo "Project Not Found";
    exit;
}

$tasksRepository = new TasksRepository($dbConnection);
$tasks = $tasksRepository->getTasksForProject($projectId);

?>

<html>
    <head>
        <title>Projekat</title>
    </head>
    <body>
        <div>
            <h1><?=$project->name?></h1>
            <p><?=$project->description?></p>
            <h3>Tasks</h3>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>User</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($tasks as $task): ?>
                        <tr>
                            <td><?=$task->id?></td>
                            <td><?=$task->name?></td>
                            <td><?=$task->user->firstName." ".$task->user->lastName?></td>
                            <td><?=$task->createdAt?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </ul>
        </div>
    </body>
</html>