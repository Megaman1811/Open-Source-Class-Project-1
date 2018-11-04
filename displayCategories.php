<?php session_start(); ?>
<html>
<head>

</head>
<body>
Logged in as: <?php echo $_SESSION['Username']; ?> | <a href="logout.php">Log out</a><br>
</body>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: ccerr
 * Date: 2018-11-03
 * Time: 8:59 PM
 */

if (!isset($_SESSION['Admin'])) {
    header('Location:restricted.php');
}
