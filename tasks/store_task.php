<?php

if($_SERVER['REQUEST_METHOD'] !== "POST")
    die("Method Not Allowed");

session_start();

require_once "../database.php";
require_once "task.php";
require_once "tasks_repository.php";
require_once "../user.php";

$errors = [];
$isValid = true;
if(!isset($_POST["title"])) {
    $isValid = false;
    $errors["title"][] = "Field title is required";
}
if(isset($_POST["title"])) {
    $title = $_POST["title"];
    if(strlen($title) < 8) {
        $isValid = false;
        $errors["title"][] = "Field title must contain at least 8 characters";
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
if(!isset($_POST["project"])) {
    $isValid = false;
    $errors["project"][] = "Field project is required";
}

if(isset($_POST["project"])) {
    $project = $_POST["project"];
    if($project == "0") {
        $isValid = false;
        $errors["project"][] = "Field project must containt a project";
    }
}
if(!isset($_POST["user"])) {
    $isValid = false;
    $errors["user"][] = "Field user is required";
}

if(isset($_POST["user"])) {
    $user = $_POST["user"];
    if($user == "0") {
        $isValid = false;
        $errors["user"][] = "Field user must containt an user";
    }
}

if(!$isValid) {
    $_SESSION["old"] = $_POST;
    $_SESSION["errors"] = $errors;
    header("Location: create_task.php");
    exit;
}

$taskRepository = new TasksRepository($dbConnection);

$task = new Task();
$task->id = NULL;
$task->name = $_POST["title"];
$task->description = $_POST["description"];
$task->projectId = intval($_POST["project"]);
$task->userId = intval($_POST["user"]);
$task->createdAt = date('Y-m-d H:i:s');
$task->updatedAt = date('Y-m-d H:i:s');

$taskRepository->add($task);

$_SESSION["newTask"] = "New task is created successfulfy.";

header("Location: ../projects/projects.php");