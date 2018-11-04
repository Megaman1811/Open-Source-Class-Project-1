<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Administrator Console</title>
</head>
<body>
Logged in as: <?php echo $_SESSION['Username']; ?> | <a href="logout.php">Log out</a><br>
<form method="post">

    <p>
        <input type="button" onclick="location.href='makeEmployee.php';" value="Create Employee"/>
        <input type="button" onclick="location.href='displayUsers.php';" value="View All Users"/>
        <input type="button" onclick="location.href='displayTickets.php';" value="View All Tickets"/>
        <input type="button" onclick="location.href='displayCategories.php';" value="View Ticket Categories"/>
    </p>

</form>
</body>
</html>


<?php
if (!isset($_SESSION['Admin'])) {
    header('Location:restricted.php');
}


?>

