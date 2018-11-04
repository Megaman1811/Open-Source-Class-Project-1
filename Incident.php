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


//Displays Categories Dynamically in a Select

if (!empty($_POST['Category'])) {
    $Category = $_POST["Category"];

    $query = "SELECT incident_id, incident_name from incidentcategory where incident_name = '$Category'";
    $result = mysqli_query($connect, $query);


    //Takes user info and submits it to the Reports Table

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
Logged in as: <?php echo $_SESSION['Username'];
//This gets the username from the session cookie?> | <a href="logout.php">Log out</a> |
<a href="homepage.php">Homepage</a>
<?php if (isset($_SESSION['Admin'])) {
    echo "| <a href=\"adminconsole.php\">Admin Console</a>";
} //Checks if Admin. if you are, adds link to console?> <br>

<form method="post">
    <p>
        <label for="Category">Category</label><br>
        <select id="Category" name="Category">
            <?php

            $selectQuery = "SELECT incident_name FROM incidentcategory ORDER BY incident_id ASC ";

            $selectResult = mysqli_query($connect, $selectQuery) or die("query is failed" . mysqli_error($connect));

            while (($row = mysqli_fetch_row($selectResult)) == true) {
                echo "<option value='$row[0]'>$row[0]</option>";
            };

            ?>
        </select>
        <br>
        <label for="Description">Description</label>
        <br>
        <input type="text" id="Description" name="Des">
        <br>
        <label for="Location">Location</label>
        <br>
        <input type="text" id="Location" name="Location"/>
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
    </p>
    <p>
        <input type="submit" value="Submit" onclick="location.href='homepage.php?added=1';" name="Submit"/>
    </p>

</form>

</body>
</html>
