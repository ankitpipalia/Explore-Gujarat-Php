<?php
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken"; 
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);


// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
}


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
{
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

        // Set these parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: login.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>

    <!-- title for website -->
    <title>Explore Gujarat</title>

    <!-- css stylesheets -->
    <link rel="stylesheet" href="css/regi.css">
    <link rel="stylesheet" media="screen and (max-width: 1216px)" href="css/phone.css">

    <!-- website logo -->
    <link rel="icon" href="img/logo.png">

    <!-- link for google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Poppins:wght@200&display=swap"
        rel="stylesheet">

    <!-- link for fontawesome -->
    <script src="https://kit.fontawesome.com/deb091a632.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- registration -->
    <section id="registration">
        <!-- Registration Form -->
        <form action="#" id="reg-form" method="post">
            <!-- form header -->
            <h1 class="text-primary center">Register Now!</h1>
            <!-- form body -->
            <div class="form-group">
                <i class="fa fa-envelope"></i>
                <input type="email" name="username" id="email" placeholder="Enter your Email" class="text-para" autocomplete="off">
            </div>
            <div class="form-group">
                <i class="fa fa-unlock-alt"></i>
                <input type="password" name="password" id="password" placeholder="Enter your Password" class="text-para">
            </div>
            <div class="form-group">
              <i class="fa fa-unlock-alt"></i>
              <input type="password" name="confirm_password" id="password" placeholder="Confirm Password" class="text-para">
          </div>
            <!-- submit button -->
            <button type="submit" class="btn text-para">Register</button>
            <div class="resetlink">
                <a href="login.php">Existing User !</a>
            </div>
        </form>
        
    </section>
</body>
</html>
