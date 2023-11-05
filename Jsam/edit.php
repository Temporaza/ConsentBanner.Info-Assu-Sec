<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="./image/MSHS.png">
</head>

<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>Edit Book</h1>
            <div>
                <a href="inventory.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <?php
            if (isset($_GET["book_id"])){
                $book_id = $_GET["book_id"];
                include("connection.php");
                $sql = "SELECT * FROM books WHERE book_id= $book_id";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($result);

                ?>
        <form action="process.php" method="post">
            <div class="form-element my-4">
                <input type="text" class="form-control" name="title" value="<?php echo $row["title"]; ?>"
                    placeholder="Book Title:">
            </div>
            <div class="form-element my-4">
                <input type="text" class="form-control" value="<?php echo $row["author"]; ?>" name="author"
                    placeholder="Author Name:">
            </div>
            <div class="form-element my-4">
                <select name="type" class="form-control">
                    <option value="">Select Book Type</option>
                    <option value="Adventure" <?php if($row['type'] == "Adventure"){echo "selected";} ?>>Adventure
                    </option>
                    <option value="Fantasy" <?php if($row['type'] == "Fantasy"){echo "selected";} ?>>Fantasy</option>
                    <option value="SciFi" <?php if($row['type'] == "SciFi"){echo "selected";} ?>>SciFi</option>
                    <option value="Horror" <?php if($row['type'] == "Horror"){echo "selected";} ?>>Horror</option>
                </select>
            </div>
            <div class="form-element my-4">
                <input type="text" value="<?php echo $row["description"]; ?>" class="form-control" name="description"
                    placeholder="Book Description:">
            </div>
            <div class="form-element my-4">
                <input type="number" value="<?php echo $row["quantity"]; ?>" class="form-control" name="quantity"
                    placeholder="Book Quantity:">
            </div>
            <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
            <div class="form-element">
                <input type="submit" class="btn btn-success" name="edit" value="Edit Book">
            </div>
        </form>
        <?php
        }
        ?>

    </div>
</body>

</html>