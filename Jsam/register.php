<?php
session_start();

  include("connection.php");
  include("functions.php");

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    //something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {
      //if the conditions are true then it will save to database
      $user_id = random_num(20);
      $query = "insert into users (user_id,user_name,password,firstName,lastName) values ('$user_id','$user_name','$password','$firstName','$lastName')";

      mysqli_query($con, $query);
      //redirect to login/index page
      header("Location: login.php");
      die;
    }else
    {
      echo "Please enter some valid information!";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up MSHS LRC</title>
    <link rel="icon" type="image/x-icon" href="./image/MSHS.png">
    <link rel="stylesheet" href="./cssFiles/style.css">
</head>

<body>
    <div class="upper-left-content">
        <a href="https://www.facebook.com/profile.php?id=100089546186427" target="_blank">
            <img src='image/RC.png' alt="Logo" width="200">
        </a>
        <span>
            MABAYUAN SENIOR HIGH SCHOOL
            <br>
            LEARNING RESOURCE CENTER
        </span>
        <a href="https://www.facebook.com/groups/mabayuanseniorhigh/" target="_blank">
            <img src='image/MSHS.png' alt="Logo" width="200">
        </a>
    </div>
    <div class="container">
        <h2>Register</h2>
        <form method="post">
            <input type="text" name="user_name" placeholder="Username" required>
            <input type="text" name="firstName" placeholder="First Name" required>
            <input type="text" name="lastName" placeholder="Last Name" required>
            <!-- <input type="text" name="email" placeholder="Email" required> -->
            <input type="password" name="password" placeholder="Password" required>
            <!-- <input type="password" name="pwdrepeat" placeholder="Repeat Password" required> -->
            <button type="submit" name="submit">Register</button>
        </form>
        <div class="login-link">
            Already have an account? <a href="login.php">Login</a>
        </div>
    </div>
    <section>
        <div class="wave wave1"></div>
        <div class="wave wave2"></div>
        <div class="wave wave3"></div>
        <div class="wave wave4"></div>
    </section>
</body>

</html>