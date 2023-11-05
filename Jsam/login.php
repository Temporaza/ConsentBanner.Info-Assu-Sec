<?php
session_start();

include("connection.php");
include("functions.php");

$error_message = ""; // Initialize the error message variable

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        // if the conditions are true then it will READ from the database
        $query = "select * from users where user_name = '$user_name' limit 1";
        $result = mysqli_query($con, $query);

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['password'] === $password) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: home.php");
                    die;
                } else {
                    $error_message = "Wrong username or password!";
                }
            } else {
                $error_message = "Wrong username or password!";
            }
        }
    } else {
        $error_message = "Wrong username or password!";
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login MSHS LRC</title>
    <link rel="icon" type="image/x-icon" href="./image/MSHS.png">
    <link rel="stylesheet" href="./cssFiles/indexStyle.css">

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
        <h2>Login</h2>
        <form method="post">
            <input type="text" name="user_name" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <?php if (!empty($error_message)) { ?>
        <div class="error-message" id="error-message">
            <?php echo $error_message; ?>
        </div>
        <script>
        // Show the error message
        document.getElementById("error-message").style.display = "block";
        </script>
        <?php } ?>
        <div class="register-link">
            Don't have an account? <a href="register.php">Register</a>
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