<?php
if(isset($_GET['book_id'])) {
    $deletedId = $_GET['book_id'];
    include("connection.php");

    // Delete the selected row
    $deleteSql = "DELETE FROM books WHERE book_id = $deletedId";
    if (mysqli_query($con, $deleteSql)) {
        // Update the remaining rows' IDs
        $updateSql = "SET @count = 0";
        $con->query($updateSql);

        $updateSql = "UPDATE books SET book_id = @count:= @count + 1";
        $con->query($updateSql);

        session_start();
        $_SESSION["delete"] = "Book deleted successfully.";
    } else {
        session_start();
        $_SESSION["delete"] = "Error deleting book: " . mysqli_error($con);
    }

    header("Location: inventory.php");
    exit();
}
?>