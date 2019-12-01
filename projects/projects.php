<?php

require_once "../database.php";
require_once "projects_repository.php";

session_start();
$newTask = NULL;
if(isset($_SESSION["newTask"])){
    $newTask = $_SESSION["newTask"];
    unset($_SESSION["newTask"]);
}

$projectsRepository = new ProjectRepository($dbConnection);
$projects = $projectsRepository->getAll();

?>

<html>
    <head>
        <title>Projects</title>
    </head>
    <body>
        <h1>Projects</h1>
        <div>
            <a href="create_project.php">New project</a>
        </div>
        <br>
        <div>
            <?php
                if($newTask!==NULL){
                    echo "<span style=\"color: green\">".$newTask."</span><br/><br/>";
                }
            ?>
            <table border="1">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Created At</td>
                        <td>Updated At</td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($projects as $project): ?>
                        <tr>
                            <td><?=$project->id?></td>
                            <td><?=$project->name?></td>
                            <td><?=$project->description?></td>
                            <td><?=$project->createdAt?></td>
                            <td><?=$project->updatedAt?></td>
                            <td>
                                <a href="edit_project.php?project_id=<?=$project->id?>">Edit</a>
                                <a href="project_details.php?id=<?=$project->id?>">Open</a>
                            </td>
                            <td>
                                <a href="delete_project.php?project_id=<?=$project->id?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>