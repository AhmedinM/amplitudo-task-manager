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

$project->name = $_POST["name"];
$project->description = $_POST["description"];

$projectsRepository->update($project);

header("Location: projects.php");