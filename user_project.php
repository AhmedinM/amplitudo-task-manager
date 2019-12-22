<?php

require_once "database.php";

function userProject($projectId,$arr){
    $projectId = intval($projectId);

    for($i=0;$i<count($arr);$i++){
        $a = intval($arr[$i]);

        $sql = "INSERT INTO user_project (`user_id`, `project_id`)VALUES($projectId, $a)";
        $result = $this->dbConnection->query($sql);
        if($result===false){
            die($this->dbConnection->error);
        }
    }
    return;
}