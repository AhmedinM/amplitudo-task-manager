<?php

session_start();

$errors = [];
$old = [];
if(isset($_SESSION["errors"])) {
    $errors = $_SESSION["errors"];
    $old = $_SESSION["old"];
    unset($_SESSION["errors"]);
    unset($_SESSION["old"]);
}

?>

<html>
    <head>
        <title>New project</title>
    </head>
    <body>
        <div>
            <form action="store_project.php" method="POST">
                <div>
                    <label for="nameInput">Name</label> <br>
                    <input type="text" id="nameInput" name="name" value="<?= isset($old["name"]) ? $old["name"] : '' ?>"/>
                    <?php if(array_key_exists("name", $errors)): ?>
                        <div style="color:red;">
                            <?php foreach($errors["name"] as $errorMessage): ?>
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
                <br>
                <div>
                    <a href="projects.php">Cancel</a>
                    <button>Save</button>
                </div>
            </form>
        </div>
    </body>
</html>