<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign up as Guest</title>
</head>

<body>
<a href="login.php">Return to login screen</a>
<form method="post">
    <p>
        <label for="User">Username:</label><br>
        <input type="text" id="User" name="User"/><br>
        <label for="Pass">Password:</label><br>
        <input type="text" id="Pass" name="Pass"/><br>
        <label for="Email">Email:</label><br>
        <input type="text" id="Email" name="Email"><br>
        <label for="Name">Name:</label><br>
        <input type="text" id="Name" name="Name"/><br>
        <label for="Cell">Cellphone #:</label><br>
        <input type="text" id="Cell" name="Cell"/><br>
        <label for="Address">Address:</label><br>
        <input type="text" id="Address" name="Address"><br>
    </p>

    <input type="submit" value="Signup" name="Signup"/>

</form>

</body>

</html>


<?php
/**
 * Created by PhpStorm.
 * User: Jared
 * Date: 2018-11-01
 * Time: 2:23 PM
 */

if (isset($_SESSION['Username'])) {
    header('Location:restricted.php');
}
$host = "localhost";
$user = "root";
$password = "";
$dbName = "proj_db";
$connect = mysqli_connect($host, $user, $password, $dbName) or die("Connection Failed");


//Allows a guest to sign up and add the account to the DB

if (!empty($_POST['User'])) {

    $User = $_POST["User"];
    $User = mysqli_real_escape_string($connect, $User);

    $Pass = $_POST["Pass"];
    $Pass = mysqli_real_escape_string($connect, $Pass);

    $Cell = $_POST["Cell"];
    $Cell = mysqli_real_escape_string($connect, $Cell);

    $Email = $_POST["Email"];
    $Email = mysqli_real_escape_string($connect, $Email);

    $Name = $_POST["Name"];
    $Name = mysqli_real_escape_string($connect, $Name);

    $Address = $_POST["Address"];
    $Address = mysqli_real_escape_string($connect, $Address);

    //$query = "insert into guest values('$User','$Pass','$Name','$Cell','$Email','$Address')";
    $query = "INSERT INTO user_info values (null ,'$Name','$Email','$User','$Pass','$Cell','$Address','0')";
    $result = mysqli_query($connect, $query);
    if ($result) {
        header('Location:login.php?signup=1');
    } else echo "Account Creation Failed" . mysqli_error($connect);
}