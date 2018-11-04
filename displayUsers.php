<?php session_start(); ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Display Users</title>
    </head>
    <body>
    Logged in as: <?php echo $_SESSION['Username']; ?> | <a href="logout.php">Log out</a><br>
    <?php if (isset($_GET['employeeCreated']) == 1) echo "Employee Created"; ?>

    </body>


    </html>
<?php
/**
 * Created by PhpStorm.
 * User: ccerr
 * Date: 2018-11-03
 * Time: 8:58 PM
 */