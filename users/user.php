<?php

class User{
    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $birthDate;
    public $gender;
    public $createdAt;
    public $updatedAt;

    public function __construct($id, $firstName, $lastName, $email, $birthDate, $gender, $created_at, $updated_at){
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->birthDate = $birthDate;
        $this->gender = $gender;
        $this->createdAt = $created_at;
        $this->updatedAt = $updated_at;
    }
}