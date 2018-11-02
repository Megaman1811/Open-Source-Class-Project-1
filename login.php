<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Form</title>
</head>
<body>
<form method="post">
    <input type="radio" name="Job1" value="Employee"> Employee
    <input type="radio" name="Job2" value="Guest"> Guest
    <br>

    EMP:
    <br>
    <input type ="text"  name ="User"/>
    <br>
    Pass:
    <br>

    <input type ="text"  name ="Pass"/>
    <br>
    Email:
    <br>
    <input type ="text"  name ="Email"/>
    <br>
    <input type ="submit" value="Login" name ="Login"/>
    <input type ="submit" value="Signup" name ="Signup"/>



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
$host = "localhost";
$user = "root";
$password = "";
$dbName = "Project";
if (!empty($_POST['User'])) {
    if (isset($_POST['Job1'])) {
        $EMP = $_POST["User"];
        $Pass = $_POST["Pass"];
        $Email = $_POST["Email"];

        $connect = mysqli_connect($host, $user, $password, $dbName)
        or die("Connection Failed");

        $Query = "Select * from user_info where emp-id = '$EMP' AND password = '$Pass' AND email = '$Email' ";
        $result = mysqli_query($connect, $Query);
        if ($result) {
            echo "Login Complete!";

        }
        else{
            echo "Login Failed";
        }


    }
}
if (isset($_POST['User'])) {
    if (isset($_POST['Job2'])) {
        if (isset($_POST['Signup'])) {
            header('location: Signup.php');
        }

    }


}