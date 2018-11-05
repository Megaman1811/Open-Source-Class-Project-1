<?php session_start(); ?>
    <html>
    <head>

    </head>
    <body>
    Logged in as: <?php echo $_SESSION['Username'];
    //This gets the username from the session cookie?> | <a href="logout.php">Log out</a> |
    <a href="homepage.php">Homepage</a>
    <?php if (isset($_SESSION['Admin'])) {
        echo "| <a href=\"adminconsole.php\">Admin Console</a>";
    } //Checks if Admin. if you are, adds link to console?> <br>
    <p>
        <?php
        $host = "localhost";
        $user = "root";
        $password = "";
        $dbName = "proj_db";
        $connect = mysqli_connect($host, $user, $password, $dbName) or die("Connection Failed");

        $ID = '';
        $Date = '';
        $Urgency = '';
        $Location = '';
        $Description = '';
        $UserRec = '';
        $Category = '';

        //Saves a new Ticket

        if (isset($_POST['SAVE'])) {
            $ID = $_POST['ID'];
            $ID = mysqli_real_escape_string($connect, $ID);


            $Date = date("Y-m-d H:i:s", time());
            $Date = mysqli_real_escape_string($connect, $Date);


            $Urgency = $_POST['Urgency'];

            $Location = $_POST['Location'];
            $Location = mysqli_real_escape_string($connect, $Location);

            $Description = $_POST['Description'];
            $Description = mysqli_real_escape_string($connect, $Description);

            $UserRec = $_POST['UserRec'];
            $UserRec = mysqli_real_escape_string($connect, $UserRec);

            $Category = $_POST['Category'];
            $Category = mysqli_real_escape_string($connect, $Category);


            if (!empty($ID)) {
                $query = "Insert Into incidentreports  Values('$ID','$Date','$Urgency','$Location','$Description','$UserRec','$Category')";
                $result = mysqli_query($connect, $query) or die("query is failed" . mysqli_error($connect));
                if (mysqli_affected_rows($connect) > 0) {
                    echo "Data entered into table";
                } else {
                    echo "Data not entered";
                }
            } else {
                echo "Input empty. Data not entered";
            }
            $ID = '';
            $Urgency = '';
            $Location = '';
            $Description = '';
            $UserRec = '';
            $Category = '';
        }

        //Finds a ticket from the DB

        if (isset($_POST['FIND'])) {
            $ID = $_POST['ID'];
            $ID = mysqli_real_escape_string($connect, $ID);


            $Date = date("Y-m-d H:i:s", time());
            $Date = mysqli_real_escape_string($connect, $Date);


            $Urgency = $_POST['Urgency'];

            $Location = $_POST['Location'];
            $Location = mysqli_real_escape_string($connect, $Location);

            $Description = $_POST['Description'];
            $Description = mysqli_real_escape_string($connect, $Description);

            $UserRec = $_POST['UserRec'];
            $UserRec = mysqli_real_escape_string($connect, $UserRec);

            $Category = $_POST['Category'];
            $Category = mysqli_real_escape_string($connect, $Category);

            $query = "Select * from incidentreports where incident_id = '$ID'";
            $result = mysqli_query($connect, $query) or die ("query is failed" . mysqli_error($connect));
            if (($row = mysqli_fetch_row($result)) == true) {
                $ID = $row[0];
                $Date = $row[1];
                $Urgency = $row[2];
                $Location = $row[3];
                $Description = $row[4];
                $UserRec = $row[5];
                $Category = $row[6];


            } else echo "record not found";
        }

        //Deletes a Ticket from the DB

        if (isset($_POST['DELETE'])) {
            $ID = $_POST['ID'];
            $ID = mysqli_real_escape_string($connect, $ID);


            $Date = date("Y-m-d H:i:s", time());
            $Date = mysqli_real_escape_string($connect, $Date);


            $Urgency = $_POST['Urgency'];

            $Location = $_POST['Location'];
            $Location = mysqli_real_escape_string($connect, $Location);

            $Description = $_POST['Description'];
            $Description = mysqli_real_escape_string($connect, $Description);

            $UserRec = $_POST['UserRec'];
            $UserRec = mysqli_real_escape_string($connect, $UserRec);

            $Category = $_POST['Category'];
            $Category = mysqli_real_escape_string($connect, $Category);

            if (!empty($ID)) {
                $query = "Delete from incidentreports where incident_id = '$ID'";
                $result = mysqli_query($connect, $query) or die("query is failed" . mysqli_error($connect));
                if (mysqli_affected_rows($connect) > 0) {
                    echo "Record Deleted";
                } else {
                    echo "Nothing changed";
                }
            } else {
                echo "Data not changed";
            }
            $ID = '';
            $Date = '';
            $Urgency = '';
            $Location = '';
            $Description = '';
            $UserRec = '';
            $Category = '';
        }

        //Updates Tickets
        if (isset($_POST['UPDATE'])) {
            $ID = $_POST['ID'];
            $ID = mysqli_real_escape_string($connect, $ID);


            $Date = date("Y-m-d H:i:s", time());
            $Date = mysqli_real_escape_string($connect, $Date);


            $Urgency = $_POST['Urgency'];

            $Location = $_POST['Location'];
            $Location = mysqli_real_escape_string($connect, $Location);

            $Description = $_POST['Description'];
            $Description = mysqli_real_escape_string($connect, $Description);

            $UserRec = $_POST['UserRec'];
            $UserRec = mysqli_real_escape_string($connect, $UserRec);

            $Category = $_POST['Category'];
            $Category = mysqli_real_escape_string($connect, $Category);


            $query = "SELECT incident_id from incidentreports where incident_id = '$ID'";
            $result = mysqli_query($connect, $query);
            $row = mysqli_fetch_row($result);


            if ($row[0] == $ID) {
                $query = "Update incidentreports Set incident_id =$ID , date = '$Date' ,  urgency = '$Urgency' ,
            location = '$Location' , description = '$Description' , user_record = '$UserRec' ,
             category = '$Category' where incident_id= $ID";
                $result = mysqli_query($connect, $query) or die("query is failed" . mysqli_error($connect));
            } else {
                $query = "Update incidentreports Set incident_id =$ID , date = '$Date' ,  urgency = '$Urgency' ,
            location = '$Location' , description = '$Description' , user_record = '$UserRec' ,
             category = '$Category' where incident_id= $ID";
                $result = mysqli_query($connect, $query) or die("query is failed" . mysqli_error($connect));
            }

            if (mysqli_affected_rows($connect) > 0) {
                echo "Data updated";

            } else {
                echo "Data not updated";
            }
        }


        //Makes the main Ticket table


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


        <form method="post">
    <p> Enter ID:<input type="text" name="ID" value="<?php echo $ID ?>"/></p>
    <p> Enter Urgency:<select id="Urgency" name="Urgency">
            <option value="low"<?php if ($Urgency == "low"){echo "selected";} ?>>Low</option>
            <option value="medium"<?php if ($Urgency == "medium"){echo "selected";} ?>>Medium</option>
            <option value="high" <?php if ($Urgency == "high"){echo "selected";} ?>>High</option>
            <option value="very high" <?php if ($Urgency == "very high"){echo "selected";} ?>>Very High</option>
        </select>
    </p>
    <p> Enter Location:<input type="text" name="Location" value="<?php echo $Location ?>"/></p>
    <p> Enter Description:<input type="text" name="Description" value="<?php echo $Description ?>"/></p>
    <p> Enter UserRec:<input type="text" name="UserRec" value="<?php echo $UserRec ?>"/></p>
    <p> Enter Category:<input type="text" name="Category" value="<?php echo $Category ?>"/></p>

    <input type="submit" value="Update" name="UPDATE"/>
    <input type="submit" value="Delete" name="DELETE"/>
    <input type="submit" value="Save" name="SAVE"/>
    <input type="submit" value="Find" name="FIND"/>

    </form>

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
