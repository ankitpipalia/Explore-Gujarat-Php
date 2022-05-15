<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['username']))
{
    header("location: index.php");
    exit;
}
require_once "config.php";

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location: index.php");
                            
                        }
                    }

                }

    }
}    


}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- title for website -->
    <title>Explore Gujarat</title>

   
    <!-- website logo -->
    <link rel="icon" href="img/logo.png">

    <!-- link for google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Poppins:wght@200&display=swap"
        rel="stylesheet">

    <!-- link for fontawesome -->
    <script src="https://kit.fontawesome.com/deb091a632.js" crossorigin="anonymous"></script>

     <!-- css stylesheets -->
     <link rel="stylesheet" href="css/regi.css">
    <link rel="stylesheet" media="screen and (max-width: 1216px)" href="css/phone.css">

</head>
<body>
    <!-- registration -->
    <section id="registration">
        <!-- Registration Form -->
        <form action="#" id="reg-form" method="post">
            <!-- form header -->
            <h1 class="text-primary center">  Login  </h1>
            <!-- form body -->
            <div class="form-group">
                <i class="fa fa-envelope"></i>
                <input type="email" name="username" id="email" placeholder="Enter your Email" class="text-para" autocomplete="off">
            </div>
            <div class="form-group">
                <i class="fa fa-unlock-alt"></i>
                <input type="password" name="password" id="password" placeholder="Enter your Password" class="text-para">
            </div>
            </div>
            <!-- submit button -->
            <button type="submit" class="btn text-para">Submit</button>
            <div class="resetlink">
                <a href="/signup.php">New User !</a>
            </div>
        </form>
    </section>
</body>
</html>
