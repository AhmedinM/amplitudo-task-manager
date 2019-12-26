<?php

function userProject($projectId,$arr){
    $projectId = intval($projectId);

    for($i=0;$i<count($arr);$i++){
        $a = intval($arr[$i]);
        //require_once "database.php";

        $host = "127.0.0.1";
$username = "root";
$password = "";
$databaseName = "kurs";

$dbConnection = new mysqli($host, $username, $password, $databaseName);

        //
        $sql = "INSERT INTO user_project (`user_id`, `project_id`)VALUES($a,$projectId)";
        $result = $dbConnection->query($sql);
        if($result===false){
            die($dbConnection->error);
        }
    }
    //return;
}