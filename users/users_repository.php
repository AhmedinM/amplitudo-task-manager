<?php

//require_once "task.php";
require_once "user.php";

class UsersRepository{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getAll(){
        $sql = "SELECT * FROM users";
        $result = $this->db->query($sql);
        $users = [];
        while($row = $result->fetch_assoc()){
            $users[] = new User(
                intval($row["id"]),
                $row["first_name"],
                $row["last_name"],
                $row["email"],
                $row["birth_date"],
                $row["gender"],
                $row["created_at"],
                $row["updated_at"]
            );
        }
        return $users;
    }
}