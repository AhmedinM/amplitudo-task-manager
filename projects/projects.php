<?php
require_once "../database.php";
require_once "projects_repository.php";
$projectsRepository = new ProjectRepository($dbConnection);
$projects = $projectsRepository->getAll();
?>

<html>
    <head>
        <title>Projects</title>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



        <!-- Bootstrap CSS -->    
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css"/>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Projects</h1>
                </div>
            </div>    
            <div class="row mt-2">
                <div class="col-12">
                    <a class="btn btn-primary" href="create_project.php">New project</a>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">                
                    <table class="table table-striped table-hover table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th></th>
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
                                        <a class="btn btn-sm btn-success" href="edit_project.php?project_id=<?=$project->id?>">
                                           <i class="fa fa-pencil"></i> edit
                                        </a>
                                        <a class="btn btn-sm btn-primary" href="project_details.php?id=<?=$project->id?>">
                                           <i class="fa fa-eye"></i> open
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>