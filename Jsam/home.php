<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home MSHS LRC</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="./image/MSHS.png">
    <!-- <link rel="stylesheey" href="./cssFiles/home.css"> -->
</head>

<body>
    <?php include("sidebar.php"); ?>
    <header>
        <?php include("dashboard.php"); ?>
    </header>

    <div class="container mt-5">
        <h1>Borrowed Books</h1>
        <?php
        if (isset($_SESSION["return"])) {
            echo '<div class="alert alert-success">' . $_SESSION["return"] . '</div>';
            unset($_SESSION["return"]);
        }
        ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Quantity Borrowed</th>
                    <th>Borrower's Name</th>
                    <th>Grade Level</th>
                    <th>Course</th>
                    <th>Date Borrowed</th>
                    <th>Date Return</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("connection.php");

                $sql = "SELECT bl.*, b.title 
                        FROM borrow_log bl 
                        JOIN books b ON bl.book_id = b.book_id";
                $result = mysqli_query($con, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row["title"] . '</td>';
                    echo '<td>' . $row["quantity_borrowed"] . '</td>';
                    echo '<td>' . $row["borrower_name"] . '</td>';
                    echo '<td>' . $row["grade_level"] . '</td>';
                    echo '<td>' . $row["course"] . '</td>';
                   // Format and display the date and time of borrowing
                //    var_dump($row["date_borrowed"]);
                    $dateBorrowedFormatted = ($row["date_borrowed"] != "0000-00-00 00:00:00")
                    ? date("Y-m-d H:i:s", strtotime($row["date_borrowed"]))
                    : "-";
                    echo '<td>' . $dateBorrowedFormatted . '</td>';
                    // Format and display the date and time of returning
                    // var_dump($row["date_borrowed"]);
                    $dateReturnFormatted = ($row["date_return"] != "0000-00-00 00:00:00")
                        ? date("Y-m-d H:i:s", strtotime($row["date_return"]))
                        : "-";
                    echo '<td>' . $dateReturnFormatted . '</td>';
                    
                    echo '<td><a href="return_book.php?borrow_id=' . $row["borrow_id"] . '" class="btn btn-primary">Return</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>