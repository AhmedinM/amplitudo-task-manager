<?php

require_once "../database.php";
require_once "user.php";
require_once "users_repository.php";

$usersRepository = new UsersRepository($dbConnection);

$usersArray = $usersRepository->getAll();

echo "<div class='ml-3'>";
for($i=0;$i<count($usersArray);$i++){
    echo "<span><input name='user' type='checkbox' value='".$usersArray[$i]->id."'> <label>".$usersArray[$i]->firstName."</label></span><br>";
}
echo "</div>";

/*http_response_code(201);
header("Content-Type: application/json");
echo json_encode($usersArray);*/