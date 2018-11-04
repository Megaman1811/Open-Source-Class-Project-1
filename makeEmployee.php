<?php session_start(); ?>
    <html>
    <head>
        <title>Make Employee</title>

    </head>
    <body>
    Logged in as: <?php echo $_SESSION['Username']; ?> | <a href="logout.php">Log out</a> | <a href="adminconsole.php">Admin Console</a> <br>

    <form method="post">
        <p>
            <label for="name">Name:</label>
            <br>
            <input type="text" id="name" name="name"/>
            <br>
            <label for="email">Email:</label>
            <br>
            <input type="email" id="email" name="email"/>
            <br>
            <label for="password">Password:</label>
            <br>
            <input type="text" id="password" name="password"/>
            <br>
            <label for="cell">Cellphone #:</label>
            <br>
            <input type="tel" id="cell" name="cell">
            <br>
            <label for="address">Address:</label>
            <br>
            <input type="text" id="address" name="address"/>
            <br>
            <label for="admin">Admin:</label>
            <br>
            <select id="admin" name="admin">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
            <br>
        </p>
        <p>
            <input type="submit" value="Submit" name="Submit">
        </p>
    </form>


    </body>
    </html>

<?php
/**
 * Created by PhpStorm.
 * User: ccerr
 * Date: 2018-11-03
 * Time: 8:58 PM
 */

if (!isset($_SESSION['Admin'])) {
    header('Location:restricted.php');
}

$host = "localhost";
$user = "root";
$password = "";
$dbName = "proj_db";

$connect = mysqli_connect($host, $user, $password, $dbName)
or die("Connection Failed");

if (!empty($_POST['name'])) {

    $Name = $_POST['name'];
    $Email = $_POST['email'];
    $UserPass = $_POST['password'];
    $Cell = $_POST['cell'];
    $Address = $_POST['address'];
    $Admin = $_POST['admin'];


    $query = "INSERT INTO user_info VALUES('','$Name','$Email',null ,'$UserPass','$Cell','$Address','$Admin')";
    $result = mysqli_query($connect, $query);

    if ($result) {
        header('Location:displayUsers.php?employeeCreated=1');
    } else echo "Insert Failed";


}