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

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



        <!-- Bootstrap CSS -->    
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css"/>
    </head>
    <body>
        <div class="container">
            <div class="row mt-3">
                <div class="col-12 offset-md-3 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Create New Project</h5>
                        </div>
                        <div class="card-body">
                            <form action="store_project.php" method="POST">
                                <div class="form-group">
                                    <label for="nameInput">Name</label>
                                    <input type="text" id="nameInput" name="name" class="form-control" value="<?= isset($old["name"]) ? $old["name"] : '' ?>"/>
                                    <?php if(array_key_exists("name", $errors)): ?>
                                        <div style="color:red;">
                                            <?php foreach($errors["name"] as $errorMessage): ?>
                                                <span><?= $errorMessage ?></span> <br>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                                <div class="form-group">
                                    <label for="descriptionInput">Description</label> <br>
                                    <textarea class="form-control" name="description" rows="5" id="descriptionInput"><?= isset($old["description"]) ? $old["description"] : '' ?></textarea>
                                    <?php if(array_key_exists("description", $errors)): ?>
                                        <div style="color:red;">
                                            <?php foreach($errors["description"] as $errorMessage): ?>
                                                <span><?= $errorMessage ?></span> <br>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                                <div class="form-group mt-2">
                                    <a class="btn btn-outline-secondary" href="projects.php">Cancel</a>
                                    <button class="btn btn-primary">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>