<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="style/login.css">
    <title>Sign-in Sign-up</title>
</head>

<body>
    <div class="container">
        <div class="signin-sign-up">
            <form action="index.php?action=index" method="POST" class="sign-in-form">
                <h2 class="title">Sign in</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" name="tel" placeholder="Telephone">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="pass" placeholder="Pin">
                </div>
                <a href="#" class="forgot-password">Forgot pin</a>
                <input type="submit" name="login" value="Login" class="btn">
             
            </form>
          
        </div>
    </div>
    <script src="app.js"></script>
</body>
</html>

<?php

if(isset($_POST['login'])){


    include_once "conn.php";

    $telephone = $_POST['tel'];
    $pin = $_POST['pass'];

    $stmt = $pdo->prepare("SELECT * FROM registration WHERE telephone = ? AND pin = ?");
    $stmt->execute([$telephone,$pin]);

    if($stmt->rowCount()>0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user_id'] = $row['user_id'];
        echo "<script>window.open('dashboard.php','_self');</script>";
    }
    else{

        echo "<script>alert('Invalid credential!')</script>";
    }


}


?>