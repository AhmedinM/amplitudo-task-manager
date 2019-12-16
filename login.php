<?php

session_start();

$oldEmail = null;
if(isset($_SESSION["old"])){
    $oldEmail = $_SESSION["old"];
    unset($_SESSION["old"]);
}

$emailErr = null;
if(isset($_SESSION["emailError"])){
    $emailErr = $_SESSION["emailError"];
    unset($_SESSION["emailError"]);
}

$passwordErr = null;
if(isset($_SESSION["passwordError"])){
    $passwordErr = $_SESSION["passwordError"];
    unset($_SESSION["passwordError"]);
}

?>

<html>
    <head>
        <title>Log In</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="container d-flex justify-content-center">
            <form action="login_validation.php" method="post">
                <div class="row mt-3">
                    <label class="col-12 font-weight-bold text-primary" for="emailInput">E-Mail:</label> <br>
                    <input class="col-7 ml-3 border-primary" type="email" name="email" id="emailInput"
                    <?php if($oldEmail!==null){
                        echo "value=\"".$oldEmail."\"";
                    }?>>
                    <?php if($emailErr!==null){
                        echo "<span class=\"col-12 text-danger\">".$emailErr."</span>";
                    }?>
                </div>
                <div class="row mt-2">
                    <label class="col-12 font-weight-bold text-primary" for="passwordInput">Password:</label> <br>
                    <input class="col-7 ml-3 border-primary" type="password" name="password" id="passwordInput">

                    <?php if($passwordErr!==null){
                        echo "<span class=\"col-12 text-danger\">".$passwordErr."</span>";
                    }?>
                </div>
                <div class="row">
                    <button class="col-7 mt-5 ml-3 btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </body>
</html>