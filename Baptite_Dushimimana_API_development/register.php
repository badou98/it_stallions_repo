<!-- views/login.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .banner {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        .container {
            width: 300px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"] {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        .create-account {
            text-align: center;
            margin-top: 10px;
        }
        .create-account a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="banner">
        <h1>CARGO MANAGEMENT SYSTEM</h1>
    </div>
    <div class="container">
        <h2>Login</h2>
        <form action="register.php?action=register" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <button type="submit" name="register">Create</button>
        </form>
       
      
    </div>
</body>
</html>



<?php
include_once "conn.php";

if(isset($_POST['register'])){ // Assuming your submit button name is 'register'
    $user = $_POST["username"];
    $pass = $_POST['password'];

    // Hash the password before storing it in the database
    $hash = md5($pass);

    // Prepare and execute the INSERT query to add the new user to the database
    $insert = $pdo->prepare("INSERT INTO manager (UserName, Password) VALUES (?, ?)");
    $success = $insert->execute([$user, $hash]);

    if($success){
        echo "<script>alert('Registered successfully')</script>";
        // Redirect to a success page or login page after successful registration
        echo "<script>window.location.href = 'login.php';</script>";
    } else {
        echo "<script>alert('Registration failed')</script>";
        echo "<script>history.back()</script>";
    }
}
?>
