<?php

require_once "../database.php";
require_once "projects_repository.php";

$projectsRepository = new ProjectsRepository($dbConnection);
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
            <table border="1">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Created At</td>
                        <td>Updated At</td>
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
                                <a href="edit_project.php?project_id=<?=$project->id?>">edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>