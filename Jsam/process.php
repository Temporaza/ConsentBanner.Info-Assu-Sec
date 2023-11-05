<?php
    include("connection.php");
    if (isset($_POST["create"])){
        $title = mysqli_real_escape_string($con, $_POST["title"]);
        $author = mysqli_real_escape_string($con, $_POST["author"]);
        $type = mysqli_real_escape_string($con, $_POST["type"]);
        $description = mysqli_real_escape_string($con, $_POST["description"]);
        $quantity = mysqli_real_escape_string($con, $_POST["quantity"]);

         // Validate and handle Image Upload
        $allowedExtensions = array('jpg', 'jpeg', 'png');
        $fileExtension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

        if (!in_array($fileExtension, $allowedExtensions)) {
            die("Only JPG, JPEG, and PNG images are allowed.");
        }

        // Handle Image Upload
        $image = file_get_contents($_FILES["image"]["tmp_name"]);
        $image = mysqli_real_escape_string($con, $image); // Escape binary data

        //insert the data to mysql
        $sql = "INSERT INTO books (title, author, type, description, quantity, image) VALUES ('$title', '$author', '$type', '$description', '$quantity', '$image')";
        
        //execute the command
        if (mysqli_query($con, $sql)){
            session_start();
            $_SESSION["create"] = "Book Added Successfully";
            header("Location: inventory.php");
        }else {
            die ("Something went wrong".mysqli_error($con));
        }
    }

    if (isset($_POST["edit"])){
        $title = mysqli_real_escape_string($con, $_POST["title"]);
        $author = mysqli_real_escape_string($con, $_POST["author"]);
        $type = mysqli_real_escape_string($con, $_POST["type"]);
        $description = mysqli_real_escape_string($con, $_POST["description"]);
        $book_id = mysqli_real_escape_string($con, $_POST["book_id"]);
        $quantity = mysqli_real_escape_string($con, $_POST["quantity"]);
        //update the data to mysql
        $sql = "UPDATE books SET title = '$title', author = '$author', type = '$type', description = '$description', quantity = '$quantity' WHERE book_id=$book_id";
        
        //execute the command
        if (mysqli_query($con, $sql)){
            session_start();
            $_SESSION["update"] = "Book Updated Successfully";
            header("Location: inventory.php");
        }else {
            die ("Something went wrong".mysqli_error($con));
        }
    }
?>