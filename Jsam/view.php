<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <style>
    .book-details {
        background: #77B3F7;
        padding: 50px;
        border-radius: 100px;
    }
    </style>
</head>

<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>Book Details</h1>
            <div>
                <a href="inventory.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <div class="book-details my-4">
            <?php
                if(isset($_GET["book_id"])){
                    $book_id = $_GET["book_id"];
                    include("connection.php");
                    $sql = "SELECT * FROM books WHERE book_id=$book_id";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result);
                ?>
            <h2>Title</h2>
            <p><?php echo $row["title"]; ?></p>

            <h2>Description</h2>
            <p><?php echo $row["description"]; ?></p>

            <h2>Type</h2>
            <p><?php echo $row["type"]; ?></p>

            <h2>Author</h2>
            <p><?php echo $row["author"]; ?></p>

            <h2>Image</h2>
            <p><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row["image"]) . '" alt="' . $row["title"] . '"width="100">'; ?>
            </p>
            <?php
                }
            ?>
        </div>
    </div>
</body>

</html>