<?php

require_once "database.php";

session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = $_POST["email"];
    $password= $_POST["password"];

    $_SESSION["old"] = $email;

    if(!isset($email) || $email===""){
        $_SESSION["emailError"] = "Unesite email.";
        header("Location: login.php");
        exit;
    }
    if(!isset($password) || $password===""){
        $_SESSION["passwordError"] = "Unesite lozinku.";
        header("Location: login.php");
        exit;
    }

    $sql = "SELECT * FROM `users` WHERE `email` = '$email'";

    $result = $dbConnection->query($sql);
    if($result===false){
        die($dbConnection->error);
    }
    $row = $result->fetch_assoc();
    if(count($row)<=0){
        $_SESSION["emailError"] = "Unijeli ste pogresan email.";
        header("Location: login.php");
        exit;
    }else{
        if(md5($password)===$row["password"]){
            $_SESSION["loged"] = true;
            unset($_SESSION["old"]);
            unset($_SESSION["emailError"]);
            unset($_SESSION["passwordError"]);

            header("Location: projects/projects.php");
            exit;
        }else{
            $_SESSION["passwordError"] = "Unijeli ste pogresnu lozinku.";
            header("Location: login.php");
            exit;
        }
    }
}