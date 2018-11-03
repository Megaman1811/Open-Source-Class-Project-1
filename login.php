<?php session_start(); ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Log in</title>
    </head>

    <body>
    <?php if (isset($_GET['logout']) == 1) echo "You have logged out"; ?>
    <?php if (isset($_GET['signup']) == 1) echo "You have successfully logged in. Please Log in with your new account"; ?>
    <form method="post">
        <p>
            <input type="radio" name="Job" id="Employee" value="Employee" checked="checked">
            <label for="Employee">Employee</label>
            <input type="radio" name="Job" id="Guest" value="Guest">
            <label for="Guest">Guest</label>
        </p>
        <p>
            <label for="Login">Username:</label>
            <br>
            <input type="text" id="Login" name="User"/>
            <br>
            <label for="Password">Password:</label>
            <br>
            <input type="text" id="Password" name="Pass"/>
        </p>
        <input type="submit" value="Login" name="Login"/>
        <input type="button" onclick="location.href='Signup.php';" value="Guest Signup"/>

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
$dbName = "proj_db";

if (!empty($_POST['User'])) {
    if ($_POST['Job'] == "Employee") {
        $connect = mysqli_connect($host, $user, $password, $dbName) or die("Connection Failed");
        $Login = $_POST["User"];
        $Login = mysqli_real_escape_string($connect, $Login);
        $Pass = $_POST["Pass"];
        $Pass = mysqli_real_escape_string($connect, $Pass);
       //$connect = mysqli_connect($host, $user, $password, $dbName) or die("Connection Failed");
        if (isset($_POST['Login'])) {
            $Query = "Select emp_id, admin, name from user_info WHERE emp_id ='$Login' AND password = '$Pass'";
            $result = mysqli_query($connect, $Query);
            $row = mysqli_fetch_row($result);
            if (mysqli_num_rows($result) == 1 && $row[0]) {
                $_SESSION['Login'] = $Login;
                if ($row[1] == 1) {
                    $_SESSION['Admin'] = true;
                    $_SESSION['Username'] = $row[2];
                    $_SESSION['Employee'] = false;
                    header('Location:adminconsole.php');
                    exit;

                } else {
                    $_SESSION['Employee'] = true;
                    $_SESSION['Username'] = $row[2];
                    header("Location:Incident.php");
                    exit;
                }

            } else Echo "Login Failed";
        }
    }

    if ($_POST['Job'] == "Guest") {
        $connect = mysqli_connect($host, $user, $password, $dbName) or die("Connection Failed");
        $Login = $_POST["User"];
        $Login = mysqli_real_escape_string($connect, $Login);
        $Pass = $_POST["Pass"];
        $Pass = mysqli_real_escape_string($connect, $Pass);

        if (isset($_POST['Login'])) {
            $Query = "Select email, name from user_info WHERE email ='$Login' AND password = '$Pass'";
            $result = mysqli_query($connect, $Query);
            $row = mysqli_fetch_row($result);
            if (mysqli_num_rows($result) == 1) {
                $_SESSION['Login'] = $Login;
                $_SESSION['Username'] = $row[1];
                $_SESSION['Guest'] = true;
                $_SESSION['Employee'] = false;
                header("Location:Incident.php");
                exit;
            } else Echo "Login Failed";
        }
    }
}