<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory MSHS LRC</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./cssFiles/inventory.css">
    <link rel="icon" type="image/x-icon" href="./image/MSHS.png">

</head>

<body>
    <header>
        <?php
        include ("dashboard.php");
        ?>
    </header>
    <div>
        <?php include("sidebar.php"); ?>
    </div>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>Book List</h1>
            <div>
                <a href="create.php" class="btn btn-primary btn-sm btn-custom">Add New Book</a>
            </div>
        </header>
        <!-- Create Success Pop -->
        <?php
            if(isset($_SESSION["create"])){
        ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION["create"];
            unset($_SESSION["create"]);
            ?>
        </div>
        <?php
        }
        ?>
        <!-- Edit Success Pop -->
        <?php
            if(isset($_SESSION["edit"])){
        ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION["edit"];
            unset($_SESSION["edit"]);
            ?>
        </div>
        <?php
            }
        ?>

        <!-- Delete Success Pop -->
        <?php
            if(isset($_SESSION["delete"])){
        ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION["delete"];
            unset($_SESSION["delete"]);
            ?>
        </div>
        <?php
            }
        ?>
        <!-- end of success pop -->

        <div class="mb-3">
            <form method="GET" action="inventory.php">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchInput" name="search"
                        placeholder="Search by title, author, or type">

                    <button type="submit" class="btn btn-primary btn-sm btn-custom">Search</button>
                </div>
            </form>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <!-- tbody will show the created data in the create -->
            <tbody>
                <?php
                include("connection.php");

                //pagination variables
                $recordsPerPage = 10;
                $currentPage = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
                $offset = ($currentPage - 1) * $recordsPerPage;
                //pagination variables end. Start at LIMIT

                // Get the search term if provided
                $searchTerm = isset($_GET["search"]) ? mysqli_real_escape_string($con, $_GET["search"]) : "";

                // $sql = "SELECT * FROM books LIMIT $offset, $recordsPerPage";
                $sql = "SELECT * FROM books";
                if (!empty($searchTerm)) {
                    $sql .= " WHERE title LIKE '%$searchTerm%' OR author LIKE '%$searchTerm%' OR type LIKE '%$searchTerm%'";
                }
                $sql .= " LIMIT $offset, $recordsPerPage";

                $result = mysqli_query($con,$sql);
                
                // print every created data using while loop
                while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?php echo $row["book_id"]; ?></td>
                    <td><?php echo $row["title"]; ?></td>
                    <td><?php echo $row["author"]; ?></td>
                    <td><?php echo $row["type"]; ?></td>
                    <td><?php echo $row["quantity"]; ?></td>
                    <td>
                        <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row["image"]) . '" alt="' . $row["title"] . '"width="50">'; ?>
                    </td>
                    <td>
                        <!-- click the books base in the id -->
                        <a href="view.php?book_id=<?php echo $row["book_id"]; ?>"
                            class="btn btn-info btn-sm btn-custom">Read More</a>
                        <a href="edit.php?book_id=<?php echo $row["book_id"]; ?>"
                            class="btn btn-warning btn-sm btn-custom">Edit</a>
                        <a href="delete.php?book_id=<?php echo $row["book_id"]; ?>"
                            class="btn btn-danger btn-sm btn-custom" onclick="return confirmDelete();">Delete</a>
                    </td>
                </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
        <!-- Display pagination links -->
        <div class="pagination">
            <?php
            for ($i = 1; $i <= ceil(mysqli_num_rows(mysqli_query($con, "SELECT * FROM books")) / $recordsPerPage); $i++) {
                echo '<a href="inventory.php?page=' . $i . '" ' . ($i == $currentPage ? 'class="active"' : '') . '>' . $i . '</a>';
            }
            ?>
        </div>

    </div>
    <script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this book?");
    }
    </script>
</body>

</html>