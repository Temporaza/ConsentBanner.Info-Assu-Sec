<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

    // Add cache control headers. Users can't go back after login
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");

if (!$user_data) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>
    <link rel="stylesheet" href="./cssFiles/dashboard.css">
    <script>
    // Prevent going back to the previous page
    window.history.pushState(null, '', window.location.href);
    window.addEventListener('popstate', function(event) {
        window.history.pushState(null, '', window.location.href);
    });
    </script>
</head>

<body>
    <header>
        <h1> Hello, <?php echo $user_data['lastName']; ?></h1>
        <a class="logoutButton" id="logout-link" href="logout.php">Logout</a>
    </header>
    <script>
    // Attach an event listener to the logout link
    document.getElementById("logout-link").addEventListener("click", function(event) {
        // Display a confirmation dialog
        var confirmLogout = confirm("Are you sure you want to logout?");
        if (!confirmLogout) {
            event.preventDefault(); // Prevent the default link behavior
        }
    });
    </script>

</body>

</html>