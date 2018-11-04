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
    /**
     * Created by PhpStorm.
     * User: ccerr
     * Date: 2018-11-03
     * Time: 8:59 PM
     */

    if (!isset($_SESSION['Admin'])) {
        header('Location:restricted.php');
    }

    $host = "localhost";
    $user = "root";
    $password = "";
    $dbName = "proj_db";
    $connect = mysqli_connect($host, $user, $password, $dbName) or die("Connection Failed");

    $category = '';
    $category2 = '';


    //Save category

    if (isset($_POST['SAVE'])) {
        $category = $_POST['category2'];
        $Category = mysqli_real_escape_string($connect, $Category);

        if (!empty($category)) {
            $query = "Insert Into incidentcategory Values('','$category')";
            $result = mysqli_query($connect, $query) or die("query is failed" . mysqli_error($connect));
            if (mysqli_affected_rows($connect) > 0) {
                echo "Data entered into table";
            } else {
                echo "Data not entered";
            }
        } else {
            echo "Input empty. Data not entered";
        }

        $category2 = '';
    }

    // Update & Edit Category

    if (isset($_POST['UPDATE'])) {

        $category = $_POST['category'];
        $Category = mysqli_real_escape_string($connect, $Category);

        $category2 = $_POST['category2'];
        $category2 = mysqli_real_escape_string($connect, $category2);

        if (!empty($category) && !empty($category2)) {
            $query = "Update incidentcategory Set incident_name ='$category2' where incident_name = '$category'";
            $result = mysqli_query($connect, $query) or die("query is failed" . mysqli_error($connect));
            if (mysqli_affected_rows($connect) > 0) {
                echo "Data updated";

            } else {
                echo "Data not updated";
            }

            $category = '';
            $category2 = '';
        }
    }

    // Delete Category

    if (isset($_POST['DELETE'])) {
        $category = $_POST['category'];
        $Category = mysqli_real_escape_string($connect, $Category);

        if (!empty($category)) {
            $query = "Delete from incidentcategory where incident_name = '$category'";
            $result = mysqli_query($connect, $query) or die("query is failed" . mysqli_error($connect));
            if (mysqli_affected_rows($connect) > 0) {
                echo "Record Deleted";
            } else {
                echo "Nothing changed";
            }
        } else {
            echo "Data not changed";
        }
        $category = '';
        $category2 = '';
    }

    $query = "SELECT * FROM incidentcategory ORDER BY incident_id ASC ";
    $result = mysqli_query($connect, $query);

    echo "<table border='1' >";
    echo "<tr><th>Incident ID</th><th>Incident Name</th></tr>";

    while (($row = mysqli_fetch_row($result)) == true) {
        echo "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
    }

    echo "</table>";


    ?>
</p>

<form method="post">
    <p> Enter Category Name:<input type="text" placeholder="Enter Category" name="category"
                                   value="<?php echo $category ?>"/></p>

    <p> Enter New Category:<input type="text" placeholder="Enter New Category" name="category2"
                                  value="<?php echo $category2 ?>"/></p>

    <input type="submit" value="Update" name="UPDATE"/>
    <input type="submit" value="Delete" name="DELETE"/>
    <input type="submit" value="Save" name="SAVE"/>


</form>

</body>
</html>