<?php
if($_SERVER['REQUEST_METHOD'] !== "POST")
    die("Method Not Allowed");
session_start();
require_once "../database.php";
require_once "project.php";
require_once "projects_repository.php";
require_once "../user_project.php";
$errors = [];
$isValid = true;
if(!isset($_POST["name"])) {
    $isValid = false;
    $errors["name"][] = "Field name is required";
}
if(isset($_POST["name"])) {
    $name = $_POST["name"];
    if(strlen($name) < 8){
        $isValid = false;
        $errors["name"][] = "Field name must contain at least 8 characters";
    }
}
if(!isset($_POST["description"])) {
    $isValid = false;
    $errors["description"][] = "Field description is required";
}
if(isset($_POST["description"])) {
    $description = $_POST["description"];
    if(strlen($description) < 20) {
        $isValid = false;
        $errors["description"][] = "Field description must containt at least 20 characters";
    }
}
$users;
if(isset($_POST["users"])){
    for($i=0;$i<count($_POST["users"]);$i++){
        $users[$i] = $_POST["users"][$i];
    }
}
if(!$isValid) {
    /*$_SESSION["old"] = $_POST;
    $_SESSION["errors"] = $errors;
    header("Location: create_project.php");*/
    http_response_code(422);
    header("Content-Type: application/json");
    echo json_encode($errors);
    exit;
}
$projectsRepository = new ProjectRepository($dbConnection);
// 2019-11-25 17:34:14
// yyyy-MM-dd HH:mm:ss
$project = new Project(
    NULL,
    $_POST["name"],
    $_POST["description"],
    date('Y-m-d H:i:s'),
    date('Y-m-d H:i:s')
);
$projectsRepository->add($project);
//die($project->id);
//$project->id = 1;
//header("Location: projects.php");
userProject($project->id,$users);
http_response_code(201);
header("Content-Type: application/json");
echo json_encode(["id" => $project->id]);