<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="./image/MSHS.png">
    <style>
    .error-message {
        color: red;
        font-weight: bold;
        margin-top: 10px;
    }
    </style>
</head>

<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>Add New Book</h1>
            <div>
                <a href="inventory.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <form action="process.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="form-element my-4">
                <input type="text" class="form-control" name="title" placeholder="Book Title:" required>
            </div>
            <div class="form-element my-4">
                <input type="text" class="form-control" name="author" placeholder="Author Name:" required>
            </div>
            <div class="form-element my-4">
                <select name="type" class="form-control" required>
                    <option value="">Select Book Type</option>
                    <option value="Adventure">Adventure</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="SciFi">SciFi</option>
                    <option value="Horror">Horror</option>
                </select>
            </div>
            <div class="form-element my-4">
                <input type="text" class="form-control" name="description" placeholder="Book Description:" required>
            </div>
            <div class="form-element my-4">
                <input type="number" class="form-control" name="quantity" placeholder="Book Quantity:" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Book Image:</label>
                <input type="file" class="form-control" id="image" name="image">
                <div class="error-message" id="image-error"></div>
            </div>
            <div class="form-elemento">
                <input type="submit" class="btn btn-success" name="create" value="Add Book">
            </div>
        </form>
    </div>

    <script>
    function validateForm() {
        var title = document.forms["add-book-form"]["title"].value;
        var author = document.forms["add-book-form"]["author"].value;
        var type = document.forms["add-book-form"]["type"].value;
        var description = document.forms["add-book-form"]["description"].value;
        var quantity = document.forms["add-book-form"]["quantity"].value;

        if (title === "" || author === "" || type === "" || description === "" || quantity === "") {
            alert("All fields are required");
            return false;
        }
    }

    const imageInput = document.getElementById("image");
    const imageError = document.getElementById("image-error");

    imageInput.addEventListener("change", () => {
        const allowedExtensions = ["jpg", "jpeg", "png"];
        const fileExtension = imageInput.value.split(".").pop().toLowerCase();

        if (!allowedExtensions.includes(fileExtension)) {
            imageError.textContent = "Only JPG, JPEG, and PNG images are allowed.";
            imageInput.value = ""; // Clear the file input
        } else {
            imageError.textContent = "";
        }
    });
    </script>
</body>

</html>