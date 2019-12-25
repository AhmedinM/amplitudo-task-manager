<?php
//repozitorijum - skup klasa za izvlacenje podataka
//session_start();

require_once "project.php";
class ProjectRepository{
    private $db;    //ne treba da pravi konekciju sa bazom
    public function __construct($db){
        $this->db = $db;
    }
    public function getAll(){
        $sql = "SELECT * FROM projects";
        $result = $this->db->query($sql);
        $projects = [];
        while($row = $result->fetch_assoc()){
            $projects[] = new Project(
                intval($row["id"]),
                $row["name"],
                $row["description"],
                $row["created_at"],
                $row["updated_at"]
            );
        }
        return $projects;
    }
    public function add($project){
        $sql = "INSERT INTO projects VALUES(NULL,'{$project->name}','{$project->description}','{$project->createdAt}','{$project->updatedAt}')";  //datum takodje u stringu
        $result = $this->db->query($sql);
        if($result === FALSE) {
            echo "error: " . $this->db->error;
            exit;
        }
        $project->id = $this->db->insert_id;
        //$_SESSION["projectId"] = $this->db->insert_id;
    }
    public function update($project){
        $project->updated_at = date('Y-m-d H:i:s');
        $sql = "UPDATE projects SET "
                ."`name` = '{$project->name}', `description` = '{$project->description}', "//mora space na kraju linije
                ."`updated_at` = '{$project->updated_at}' "
                ."WHERE id = {$project->id}";
        $result = $this->db->query($sql);
        if($result===false){
            //die($this->db->error);
        }
    }
    public function find($id){
        $sql = "SELECT * FROM projects WHERE id = $id";
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();
        return new Project(
            intval($row["id"]),
            $row["name"],
            $row["description"],
            $row["created_at"],
            $row["updated_at"]
        );
    }
}