<?php

require_once "task.php";
require_once "../user.php";

class TasksRepository{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getTasksForProject($projectId){
        $sql = "SELECT *, tasks.id as task_id, users.id as `user_id`, tasks.created_at as task_created_at, tasks.updated_at as task_updated_at, users.created_at as user_created_at, users.updated_at as user_updated_at FROM tasks LEFT JOIN users ON users.id = tasks.user_id WHERE project_id = ".$projectId;
        $result = $this->db->query($sql);
        if($result === FALSE) {
            die($this->db->error);
        }
        $tasks = [];
        while($row = $result->fetch_assoc()) {
            $task = new Task();
            $task->id = intval($row["task_id"]);
            $task->name = $row["title"];
            $task->description = $row["description"];
            $task->projectId = intval($row["project_id"]);
            $task->userId = intval($row["user_id"]);
            $task->createdAt = $row["task_created_at"];
            $task->updatedAt = $row["task_updated_at"];
            $task->user = new User();
            $task->user->id = $row['user_id'];
            $task->user->firstName = $row['first_name'];
            $task->user->lastName = $row['last_name'];
            $task->user->email = $row['email'];
            $task->user->birthDate = $row['birth_date'];
            $task->user->gender = $row['gender'];
            $task->user->createdAt = $row['user_created_at'];
            $task->user->updatedAt = $row['user_updated_at'];
            $tasks[] = $task;
        }
        return $tasks;
    }

    public function add($task){
        $sql = "INSERT INTO tasks VALUES(NULL,'{$task->name}','{$task->description}',$task->projectId,$task->userId,'{$task->createdAt}','{$task->updatedAt}')";
        $result= $this->db->query($sql);
        if($result===false){
            die($this->db->error);
        }
    }
}