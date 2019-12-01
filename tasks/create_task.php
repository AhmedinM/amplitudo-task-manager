<?php

require_once "../database.php";

session_start();

$errors = [];
$old = [];
if(isset($_SESSION["errors"])) {
    $errors = $_SESSION["errors"];
    $old = $_SESSION["old"];
    unset($_SESSION["errors"]);
    unset($_SESSION["old"]);
}

$sql1 = "SELECT * FROM projects";
$sql2 = "SELECT * FROM users";
$arr1 = [];
$arr2 = [];

$result1 = $dbConnection->query($sql1);
if($result1===false){
    $arr1[] = "Database error";
}else{
    while($row1 = $result1->fetch_assoc()){
        $arr1[] = $row1;
    }
}

$result2 = $dbConnection->query($sql2);
if($result2===false){
    $arr2[] = "Database error";
}else{
    while($row2 = $result2->fetch_assoc()){
        $arr2[] = $row2;
    }
}

?>

<html>
    <head>
        <title>New Task</title>
    </head>
    <body>
        <div>
            <form action="store_task.php" method="POST">
                <div>
                    <label for="titleInput">Title</label> <br>
                    <input type="text" id="titleInput" name="title" value="<?= isset($old["title"]) ? $old["title"] : '' ?>"/>
                    <?php if(array_key_exists("title", $errors)): ?>
                        <div style="color:red;">
                            <?php foreach($errors["title"] as $errorMessage): ?>
                                <span><?= $errorMessage ?></span> <br>
                            <?php endforeach; ?>
                        </div>
                    <?php endif ?>
                </div>
                <div>
                    <label for="descriptionInput">Description</label> <br>
                    <textarea name="description" id="descriptionInput" cols="30" rows="10"><?= isset($old["description"]) ? $old["description"] : '' ?></textarea>
                    <?php if(array_key_exists("description", $errors)): ?>
                        <div style="color:red;">
                            <?php foreach($errors["description"] as $errorMessage): ?>
                                <span><?= $errorMessage ?></span> <br>
                            <?php endforeach; ?>
                        </div>
                    <?php endif ?>
                </div>
                <div>
                    <label for="projectInput">Project</label> <br>
                    <select name="project" id="projectInput">
                        <?php
                            if($arr1[0] === "Database error"){
                                echo "<option value=\"0\">".$arr1[0]."</option>";
                            }else{
                                foreach($arr1 as $arr){
                                    echo "<option value=\"".$arr["id"]."\">".$arr["name"]."</option>";
                                }
                            }
                        ?>
                    </select>
                    <?php if(array_key_exists("project", $errors)): ?>
                        <div style="color:red;">
                            <?php foreach($errors["project"] as $errorMessage): ?>
                                <span><?= $errorMessage ?></span> <br>
                            <?php endforeach; ?>
                        </div>
                    <?php endif ?>
                </div>
                <div>
                    <label for="userInut">User</label> <br>
                    <select name="user" id="userInput">
                        <?php
                            if($arr2[0] === "Database error"){
                                echo "<option value=\"0\">".$arr2[0]."</option>";
                            }else{
                                foreach($arr2 as $arr){
                                    echo "<option value=\"".$arr["id"]."\">".$arr["first_name"]." ".$arr["last_name"]."</option>";
                                }
                            }
                        ?>
                    </select>
                    <?php if(array_key_exists("user", $errors)): ?>
                        <div style="color:red;">
                            <?php foreach($errors["user"] as $errorMessage): ?>
                                <span><?= $errorMessage ?></span> <br>
                            <?php endforeach; ?>
                        </div>
                    <?php endif ?>
                </div>
                <br>
                <div>
                    <a href="../projects/projects.php">Cancel</a>
                    <button>Save</button>
                </div>
            </form>
        </div>
    </body>
</html>