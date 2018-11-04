<?php session_start(); ?>
    <html>
    <head>

    </head>
    <body>
    Logged in as: <?php echo $_SESSION['Username']; ?> | <a href="logout.php">Log out</a> | <a href="adminconsole.php">Admin
        Console</a> <br>

    <p>
        <?php
        $host = "localhost";
        $user = "root";
        $password = "";
        $dbName = "proj_db";
        $connect = mysqli_connect($host, $user, $password, $dbName) or die("Connection Failed");

        $query = "Select * from incidentreports ORDER BY incident_id asc ";
        $result = mysqli_query($connect, $query) or die ("Query failed" . mysqli_error($connect));

        echo "<table border='1' >";
        echo "<tr><th>Incident ID</th><th>Date</th><th>Urgency</th><th>Location</th><th>Description</th><th>User Record</th>
<th>Category</th></tr>";

        while (($row = mysqli_fetch_row($result)) == true) {
            echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td>
<td>$row[6]</td></tr>";
        }

        echo "</table>"
        ?>
    </p>

    <input type="button" onclick="window.location.reload()" value="Reload"/>
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
