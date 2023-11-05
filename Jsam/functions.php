<?php

//check if the user login
function check_login($con)
{
    //Check inside the session if there's a user_id
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id = '$id' limit 1";

        //read from the database or read the result since we have query now
        $result = mysqli_query($con, $query);
        //check if result is positive
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    //if the code above not work, then it will redirect to login
    header("Location: index.php");
    die;
}

function random_num($length)
{
    $text = "";
    if($length < 5)
    {
        $length = 5;
    }

    $len = rand(4, $length);

    for ($i=0; $i < $len; $i++){
        #code ...
        $text .= rand(0,9);
    }

    return $text;

}

