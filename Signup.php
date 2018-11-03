<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Search Form</title>
</head>

<body>
<form method="post">
    <p>
        <label for="User">User:</label><br>
        <input type="text" id="User" name="User"/><br>
        <label for="Pass">Pass:</label><br>
        <input type="text" id="Pass" name="Pass"/><br>
        <label for="Name">Name:</label><br>
        <input type="text" id="Name" name="Name"/><br>
        <label for="Cell">Cellphone #:</label><br>
        <input type="text" id="Cell" name="Cell"/><br>
        <label for="Email">Email:</label><br>
        <input type="text" id="Email" name="Email"><br>
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
$host = "localhost";
$user = "root";
$password = "";
$dbName = "Project";
if (!empty($_POST['User'])) {
    $User = $_POST["User"];
    $Pass = $_POST["Pass"];
    $Cell = $_POST["Cell"];
    $Email = $_POST["Email"];
    $Name = $_POST["Name"];
    $Address = $_POST["Address"];

    $connect = mysqli_connect($host, $user, $password, $dbName)
    or die("Connection Failed");


    $query = "insert into guest values('$User','$Pass','$Name','$Cell','$Email','$Address')";
    $result = mysqli_query($connect, $query);
    if ($result) {
        echo "Entry Successful";

    } else
        echo "failed" . mysqli_error($connect);
}
