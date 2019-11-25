<?php

require_once "project.php";

class ProjectsRepository 
{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() { 
        $sql = "SELECT * FROM projects";
        $result = $this->db->query($sql);
        
        $projects = [];
        while($row = $result->fetch_assoc()) {
            $projects[] = new Project(
                intval($row['id']),
                $row['name'],
                $row['description'],
                $row['created_at'],
                $row['updated_at'],
            );
        }
        
        return $projects;
    }

    public function find($id) {
        $sql = "SELECT * FROM projects WHERE id = $id";
        $result = $this->db->query($sql);

        if($result === FALSE) {
            die($this->db->error);
        }

        // No one guarantees that this function will recieve
        // valid ID, so we check if fetch_assoc() has any row to return.
        $row = $result->fetch_assoc();
        if(is_null($row))
            return null;

        return new Project(
            intval($row['id']),
            $row['name'],
            $row['description'],
            $row['created_at'],
            $row['updated_at'],
        );
    }

    public function add($project) {
        $sql = "INSERT INTO projects "
             . "VALUES(NULL, '{$project->name}', '{$project->description}', '{$project->createdAt}', '{$project->updatedAt}')";

        $result = $this->db->query($sql);
        if($result === FALSE) {
            die($this->db->error);
        }

        $project->id = $this->db->insert_id;
    }

    /**
     * UPDATE projects SET
     *  `name` = 'Novi Projekat Updated',
     *  `description` = "Novi opis projekta"
     * WHERE id <= 2;
     * 
     */
    public function update($project) {
        $project->updated_at = date('Y-m-d H:i:s');

        $sql = "UPDATE projects SET "
             . "`name` = '{$project->name}', "
             . "description = '{$project->description}', "
             . "updated_at = '{$project->updated_at}' "
             . "WHERE id = {$project->id}";

        $result = $this->db->query($sql);
        if($result === FALSE)
            die($this->db->error);
    }
}