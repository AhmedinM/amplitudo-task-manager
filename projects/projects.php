<?php
require_once "../database.php";
require_once "projects_repository.php";

session_start();
if(!isset($_SESSION["loged"]) || $_SESSION["loged"]!==true){
    header("Location: ../login.php");
    exit;
}

$projectsRepository = new ProjectRepository($dbConnection);
$projects = $projectsRepository->getAll();

?>

<html>
    <head>
        <title>Projects</title>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        

        <!-- Bootstrap CSS -->    
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css"/>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Projects</h1>
                </div>
            </div>    
            <div class="row mt-2">
                <div class="col-12">
                    <a class="btn btn-primary" id="launch2">New project</a> <!--href="create_project.php"-->
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">                
                    <table class="table table-striped table-hover table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($projects as $project): ?>
                                <tr>
                                    <td><?=$project->id?></td>
                                    <td><?=$project->name?></td>
                                    <td><?=$project->description?></td>
                                    <td><?=$project->createdAt?></td>
                                    <td><?=$project->updatedAt?></td>
                                    <td>
                                        <a class="btn btn-sm btn-success" href="edit_project.php?project_id=<?=$project->id?>">
                                           <i class="fa fa-pencil"></i> edit
                                        </a>
                                        <a class="btn btn-sm btn-primary" href="project_details.php?id=<?=$project->id?>">
                                           <i class="fa fa-eye"></i> open
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

         <!-- Modal -->
         <!--class="modal fade"--><div class="modal fade" id="createProjectForm" tabindex="-1" role="dialog" aria-labelledby="createProjectFormLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createProjectForm">New project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="nameInput">Name</label>
                                        <input type="text" class="form-control" id="nameInput"/>
                                        <div id="nameErrorPlaceholder" class="text-danger"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="descriptionInput">Description</label>
                                        <textarea rows="6" class="form-control" id="descriptionInput"></textarea>
                                        <div id="desErrorPlaceholder" class="text-danger"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="usersCon">
                                <span class="ml-3">Odaberi ko ce raditi na projektu</span>
                                <br><br>
                                <ul class="col-12" id="cont">

                                </ul>
                            </div>
                                
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="saveButton" type="button" class="btn btn-primary">
                            <i class="fa fa-save"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
         <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script>
            //function getAll(){
                $(document).ready(function() {
                    $("#launch2").click(function() {
                        $("#createProjectForm").modal('show');
                    });
                    xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("cont").innerHTML = this.responseText;
                            }
                        };
                        xmlhttp.open("GET","../users/get_users.php",true);
                        xmlhttp.send();
                    });
            $(document).ready(function() {
                var saveButton = $("#saveButton");
                var nameInput = $("#nameInput");
                var descriptionInput = $("#descriptionInput");
                saveButton.click(function() {
                    var arr = document.querySelector('.messageCheckbox:checked');
                    //var arr = $('.messageCheckbox:checked').val();
                    //var arr = $('.messageCheckbox').is(':checked')
                    var arr = [];
                    var i = 0;
                    $.each($("input[name='user']:checked"),function(){
                        arr.push($(this).val());
                        i++;
                    });
                    //console.log(arr[0]);
                    let data = {
                        name: nameInput.val(),
                        description: descriptionInput.val(),
                        users: arr
                    };
                    $.post("store_project.php", data, function(response) {
                        console.log(response);
                        //let i = 2;
                        window.location = "project_details.php?id=" + response.id;
                    }).fail(function(res) {
                        console.log(res);
                        if(res.status == 422) {
                            if(res.responseJSON.name) {
                                $("#nameErrorPlaceholder").text(res.responseJSON.name[0]);
                            }
                            if(res.responseJSON.description) {
                                $("#desErrorPlaceholder").text(res.responseJSON.description[0]);
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>