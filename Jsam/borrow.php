<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow MSHS LRC</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="./image/MSHS.png">

    <script>
    function updateMinReturnDateTime(borrowDateTime) {
        // Get the "Date and Time of Return" input element
        var datetimeReturnInput = document.getElementById("datetime_return");

        // Set the minimum allowed datetime for "Date and Time of Return"
        datetimeReturnInput.min = borrowDateTime;

        // Clear the value of "Date and Time of Return" if it's earlier than the selected "Date and Time of Borrowing"
        if (datetimeReturnInput.value < borrowDateTime) {
            datetimeReturnInput.value = borrowDateTime;
        }
    }
    </script>

</head>

<body>
    <?php include("sidebar.php"); ?>
    <header>
        <?php include("dashboard.php"); ?>
    </header>

    <div class="container mt-5">
        <h1>Borrow Book</h1>
        <?php
        if (isset($_SESSION["borrow"])) {
            echo '<div class="alert alert-success">' . $_SESSION["borrow"] . '</div>';
            unset($_SESSION["borrow"]);
        }
        ?>
        <form action="process_borrow.php" method="POST">
            <div class="mb-3">
                <label for="book" class="form-label">Select Book:</label>
                <select class="form-select" id="book" name="book_id" required>
                    <option value="" selected disabled>Select a book</option>
                    <!-- Populate the options with book data from your inventory -->
                    <!-- Example: -->
                    <?php
            include("connection.php");

            $sql = "SELECT book_id, title, quantity FROM books WHERE quantity > 0";
            $result = mysqli_query($con, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row["book_id"] . '">' . $row["title"] . ' (Available: ' . $row["quantity"] . ')</option>';
            }
            ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity to Borrow:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
            </div>
            <!-- Include other borrower information inputs here -->
            <div class="mb-3">
                <label for="borrower_name" class="form-label">Student Name:</label>
                <input type="text" class="form-control" id="borrower_name" name="borrower_name" required>
            </div>
            <div class="mb-3">
                <label for="borrower_id" class="form-label">Student ID:</label>
                <input type="text" class="form-control" id="borrower_id" name="borrower_id" required>
            </div>
            <div class="mb-3">
                <label for="grade_level" class="form-label">Grade Level:</label>
                <input type="text" class="form-control" id="grade_level" name="grade_level" required>
            </div>
            <div class="mb-3">
                <label for="course" class="form-label">Course/Strand:</label>
                <input type="text" class="form-control" id="course" name="course" required>
            </div>
            <div class="mb-3">
                <label for="datetime_borrowed" class="form-label">Date and Time of Borrowing:</label>
                <input type="datetime-local" class="form-control" id="datetime_borrowed" name="date_borrowed" required
                    onchange="updateMinReturnDateTime(this.value)">
            </div>
            <div class="mb-3">
                <label for="datetime_return" class="form-label">Date and Time of Return:</label>
                <input type="datetime-local" class="form-control" id="datetime_return" name="date_return" required>
            </div>
            <button type="submit" class="btn btn-primary">Borrow</button>
        </form>
    </div>

</body>

</html>