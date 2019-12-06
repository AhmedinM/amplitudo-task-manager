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
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



        <!-- Bootstrap CSS -->    
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css"/>
    </head>
    <body>
        <div class="container">
            <div>
                <div class="row">
                    <div class="col-12">
                        <h1><?=$project->name?></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p><?=$project->description?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h3>Tasks</h3>
                    </div>
                </div>
                
                <div class="row mt-3">
                <div class="col-12">                
                    <table class="table table-striped table-hover table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>User</th>
                                <th>Created At</th>
                                <th>Is Completed</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($tasks as $task): ?>
                                <tr>
                                    <td><?=$task->id?></td>
                                    <td><?=$task->name?></td>
                                    <td><?=$task->user->firstName." ".$task->user->lastName?></td>
                                    <td><?=$task->createdAt?></td>
                                    <td>
                                        <?php if($task->isCompleted==1){
                                            echo "<span class=\"badge badge-success\">Completed</span>";
                                        }else{
                                            echo "<span class=\"badge badge-danger\">In Progress</span>";
                                        }
                                        ?>
                                    </td>
                                    <?php if($task->isCompleted==0){
                                    echo "<td><a href=\"../tasks/update_task.php?task_id=".$task->id."&&project_id=".$projectId."\" class=\"btn btn-primary\">Mark As Completed</a></td>";
                                    }else{
                                        echo "<td></td>";
                                    } ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            <a class="btn btn-sm btn-primary" href="../tasks/create_task.php">
                <i class="fa fa-pencil"></i> New Task
            </a>
        </div>
    </body>
</html>