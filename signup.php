<?php
    $alert = false;
    $error = false;
    if($_SERVER['REQUEST_METHOD']=='POST'){
        include 'partials/db_connect.php';
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $exists=false;
        $existSql = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
        $result = mysqli_query($conn , $existSql);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0)
        {
            $error = "Account already exist please try with different username/password";
        }
        else{
            if(($password == $cpassword) && $exists==false){
                $sql = "INSERT INTO `users`(`username`,`password`,`dt`) VALUES ('$username','$password',current_timestamp())";
                $result = mysqli_query($conn,$sql);
                if($result){
                    $alert = true;
                }
            }
            else{
                $error = "Password do not match";
            }
        }   
    }
 ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Sign up</title>
</head>

<body>
    <?php require 'partials/_nav.php'; ?> 
    <?php
    if($alert){
    echo'
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your account is now created and you can login
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
    }

    if($error){
        echo'
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '.$error.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
        }
    ?>
    <div class="container">
        <h1 class="text-center">Sign up to our eSecure</h1>
        <form action="/loginsystem/signup.php" method='POST'>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp"
                    placeholder="Username">

            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="cpassword">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Password">
                <small id="emailHelp" class="form-text text-muted">Make sure to enter same password!</small>
            </div>
            <button type="submit" class="btn btn-primary">Signup</button>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>