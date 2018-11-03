<?php session_start(); ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Administrator Console</title>
    </head>

    <body>
    Logged in as: <?php echo $_SESSION['Username']; ?> | <a href="logout.php">Log out</a>

    </body>
    </html>


<?php
if (!isset($_SESSION['Username'])){
    header('Location:login.php');
}