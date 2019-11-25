<?php

require_once "../database.php";
require_once "projects_repository.php";
require_once "project.php";

$projectsRepository = new ProjectsRepository($dbConnection);
$project = $projectsRepository->find($_GET["project_id"]);

// find() can return NULL meaning that project with specified ID ($_GET[project_id])
// does not exists in database.
if(is_null($project)) {
    http_response_code(404);
    echo "Project Not Found";
    exit;
}

?>

<html>
    <head>
        <title>Edit Project</title>
    </head>
    <body>
        <div>
        <form action="update_project.php?project_id=<?= $project->id ?>" method="POST">
            <div>
                <label for="nameInput">Name</label> <br>
                <input type="text" id="nameInput" name="name" value="<?= $project->name ?>"/>
            </div>
            <div>
                <label for="descriptionInput">Description</label> <br>
                <textarea name="description" id="descriptionInput" cols="30" rows="10"><?= $project->description ?></textarea>
            </div>
            <br>
            <div>
                <a href="projects.php">Cancel</a>
                <button>Save</button>
            </div>
        </form>
        </div>
    </body>
</html>
