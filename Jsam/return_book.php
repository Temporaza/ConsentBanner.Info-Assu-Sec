<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["borrow_id"])) {
    $borrow_id = mysqli_real_escape_string($con, $_GET["borrow_id"]);

    // Fetch borrowing entry from the borrow_log table
    $sql_borrow = "SELECT bl.*, b.title 
                   FROM borrow_log bl 
                   JOIN books b ON bl.book_id = b.book_id
                   WHERE borrow_id = $borrow_id";
    $result_borrow = mysqli_query($con, $sql_borrow);
    $borrow_data = mysqli_fetch_assoc($result_borrow);

    if (!$borrow_data) {
        die("Borrowing entry not found");
    }

    $book_id = $borrow_data["book_id"];
    $borrowed_quantity = $borrow_data["quantity_borrowed"];

    // Fetch book information from the books table
    $sql_book = "SELECT title, quantity FROM books WHERE book_id = $book_id";
    $result_book = mysqli_query($con, $sql_book);
    $book_data = mysqli_fetch_assoc($result_book);

    if (!$book_data) {
        die("Book not found");
    }

    $available_quantity = $book_data["quantity"];

    // Calculate the new quantity after returning
    $new_quantity = $available_quantity + $borrowed_quantity;

    // Update the book quantity in the database
    $sql_update = "UPDATE books SET quantity = $new_quantity WHERE book_id = $book_id";
    if (mysqli_query($con, $sql_update)) {
        // Delete the borrowing entry from the borrow_log table
        $sql_delete = "DELETE FROM borrow_log WHERE borrow_id = $borrow_id";
        if (mysqli_query($con, $sql_delete)) {
            session_start();
            $_SESSION["return"] = "Book returned successfully";
            header("Location: home.php");
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