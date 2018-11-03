<?php
/**
 * Created by PhpStorm.
 * User: Jared
 * Date: 2018-11-01
 * Time: 2:47 PM
 */

session_start();


if (!isset($_SESSION['Username'])) {
    header('Location:restricted.php');
}

$host = "localhost";
$user = "root";
$password = "";
$dbName = "proj_db";

$connect = mysqli_connect($host, $user, $password, $dbName)
or die("Connection Failed");


if (!empty($_POST['Category'])) {
    $Category = $_POST["Category"];

    $query = "SELECT incident_id, incident_name from incidentcategory where incident_name = '$Category'";
    $result = mysqli_query($connect, $query);


    if ($result) {
        $Urgency = $_POST["Urgency"];

        $Location = $_POST["Location"];
        $Location = mysqli_real_escape_string($connect, $Location);

        $Description = $_POST["Des"];
        $Description = mysqli_real_escape_string($connect, $Description);

        $UserRec = $_SESSION['Email'];
        $UserRec = mysqli_real_escape_string($connect, $UserRec);

        $Category = $_POST["Category"];

        $Date = date("Y-m-d H:i:s", time());
        $Date = mysqli_real_escape_string($connect, $Date);


        $query = "insert into incidentreports values('','$Date','$Urgency','$Location','$Description','$UserRec','$Category')";
        $result1 = mysqli_query($connect, $query);
        $Write = fopen('LOG.txt', 'a');
        fwrite($Write, $_SESSION['Username'] . " " . $Date . "\n");
        fclose($Write);
        if (!$result1) {
            die('Invalid query: ' . mysqli_error($connect));
        }


    }


}


?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Incident</title>
    </head>
    <body>
    Logged in as: <?php echo $_SESSION['Username']; ?> | <a href="logout.php">Log out</a>

    <form method="post">
        <label for="Description">Description</label>
        <br>
        <input type="text" id="Description" name="Des">
        <br>

        <label for="Category">Category</label><br>
        <select id="Category" name="Category">
            <?php

            $selectQuery = "SELECT incident_name FROM incidentcategory";

            $selectResult = mysqli_query($connect, $selectQuery) or die("query is failed" . mysqli_error($con));

            while (($row = mysqli_fetch_row($selectResult)) == true) {
                echo "<option value='$row[0]'>$row[0]</option>";
            };

            ?>
        </select>
        <br>
        <label for="Urgency">Urgency</label>
        <br>
        <select id="Urgency" name="Urgency">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
            <option value="very high">Very High</option>
        </select>
        <br>
        <label for="Location">Location</label>
        <br>
        <input type="text" id="Location" name="Location"/>
        <br>
        <input type="submit" value="Submit" name="Submit"/>


    </form>

    </body>
    </html>
