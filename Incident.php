<?php session_start(); ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Incident</title>
    </head>
    <body>
    Logged in as: <?php echo $_SESSION['Username']; ?> | <a href="logout.php">Log out</a>

    <form method="post">
        <label for="Record">User Record</label>
        <br>
        <input type="text" id="Record" name="UserRec">
        <br>
        <label for="ID">ID</label>
        <br>
        <input type="text" id="ID" name="ID"/>
        <br>

        <label for="Urgency">Urgency</label>
        <br>

        <input type="text" id="Urgency" name="Urgency"/>
        <br>
        <label for="Location">Location</label>
        <br>
        <input type="text" id="Location" name="Location"/>
        <br>
        <label for="Description">Description</label>
        <br>
        <input type="text" id="Description" name="Des">
        <br>
        <label for="Category">Category</label><br>
        <input type="text" id="Category" name="Category">
        <br>

        <input type="submit" value="Submit" name="Submit"/>


    </form>

    </body>
    </html>


<?php
/**
 * Created by PhpStorm.
 * User: Jared
 * Date: 2018-11-01
 * Time: 2:47 PM
 */

if (!isset($_SESSION['Username'])){
    header('Location:login.php');
}

$host = "localhost";
$user = "root";
$password = "";
$dbName = "proj_db";

$connect = mysqli_connect($host, $user, $password, $dbName)
or die("Connection Failed");


if (!empty($_POST['Category'])) {
    $Category = $_POST["Category"];

    $query = "SELECT incident_name from incidentcategory where incident_name = '$Category'";
    $result = mysqli_query($connect, $query);


    if ($result) {
        $ID = $_POST["ID"];
        $Urgency = $_POST["Urgency"];
        $Location = $_POST["Location"];
        $Description = $_POST["Des"];
        $UserRec = $_POST["UserRec"];
        $Category = $_POST["Category"];
        $Date = date("Y-m-d H:i:s", time());


        $query = "insert into incidentreports values('$ID','$Date','$Urgency','$Location','$Description', '$UserRec','$Category')";
        $result1 = mysqli_query($connect, $query);
        if (!$result1) {
            die('Invalid query: ' . mysqli_error($connect));
        }


    }


}

