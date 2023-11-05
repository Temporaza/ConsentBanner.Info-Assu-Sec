<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["book_id"]) && isset($_POST["quantity"])) {
    $book_id = mysqli_real_escape_string($con, $_POST["book_id"]);
    $quantity = intval($_POST["quantity"]); // Quantity of books to borrow
    $borrower_name = mysqli_real_escape_string($con, $_POST["borrower_name"]);
    $borrower_id = mysqli_real_escape_string($con, $_POST["borrower_id"]);
    $grade_level = mysqli_real_escape_string($con, $_POST["grade_level"]);
    $course = mysqli_real_escape_string($con, $_POST["course"]);
    $date_borrowed = mysqli_real_escape_string($con, $_POST["date_borrowed"]);
    $date_return = mysqli_real_escape_string($con, $_POST["date_return"]);

    // Fetch book information from the books table
    $sql_book = "SELECT title, quantity FROM books WHERE book_id = $book_id";
    $result_book = mysqli_query($con, $sql_book);
    $book_data = mysqli_fetch_assoc($result_book);

    if (!$book_data) {
        die("Book not found");
    }

    $available_quantity = $book_data["quantity"];

    if ($quantity > $available_quantity) {
        die("Requested quantity exceeds available quantity");
    }

    // Calculate the new quantity after borrowing
    $new_quantity = $available_quantity - $quantity;
    

    // Update the book quantity in the database
    $sql_update = "UPDATE books SET quantity = $new_quantity WHERE book_id = $book_id";
    if (mysqli_query($con, $sql_update)) {
        // Insert borrowing entry into the borrow_log table
        $sql_insert = "INSERT INTO borrow_log (book_id, quantity_borrowed, borrower_name, borrower_id, grade_level, course, date_borrowed, date_return) 
                       VALUES ($book_id, $quantity, '$borrower_name', '$borrower_id', '$grade_level', '$course', '$date_borrowed', '$date_return')";
        if (mysqli_query($con, $sql_insert)) {
            session_start();
            $_SESSION["borrow"] = "Book(s) borrowed successfully";
            header("Location: borrow.php");
            exit;
        } else {
            die("Something went wrong: " . mysqli_error($con));
        }
    } else {
        die("Something went wrong: " . mysqli_error($con));
    }
} else {
    die("Invalid request");
}
?>