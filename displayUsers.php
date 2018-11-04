<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Display Users</title>
</head>
<body>
Logged in as: <?php echo $_SESSION['Username'];
//This gets the username from the session cookie?> | <a href="logout.php">Log out</a> |
<a href="homepage.php">Homepage</a>
<?php if (isset($_SESSION['Admin'])) {
    echo "| <a href=\"adminconsole.php\">Admin Console</a>";
} //Checks if Admin. if you are, adds link to console?> <br>

<?php
/**
 * Created by PhpStorm.
 * User: ccerr
 * Date: 2018-11-03
 * Time: 8:58 PM
 */

if (!isset($_SESSION['Admin'])) {   //Redirects you to restricted page if you are not Admin
    header('Location:restricted.php');
}

if (!isset($_SESSION['Admin'])) {
    header('Location:restricted.php');
}

$host = "localhost";
$user = "root";
$password = "";
$dbName = "proj_db";
$connect = mysqli_connect($host, $user, $password, $dbName) or die("Connection Failed");


$ID = '';
$Name = '';
$Email = '';
$User = '';
$Pass = '';
$Cell = '';
$Address = '';
$Admin = '';


//Save

if (isset($_POST['SAVE'])) {
    $ID = $_POST['ID'];
    $ID = mysqli_real_escape_string($connect, $ID);

    $User = $_POST['User'];
    $User = mysqli_real_escape_string($connect, $User);

    $Name = $_POST['Name'];
    $Name = mysqli_real_escape_string($connect, $Name);

    $Email = $_POST['Email'];
    $Email = mysqli_real_escape_string($connect, $Email);

    $Pass = $_POST['Pass'];
    $Pass = mysqli_real_escape_string($connect, $Pass);

    $Cell = $_POST['Cell'];
    $Cell = mysqli_real_escape_string($connect, $Cell);

    $Address = $_POST['Address'];
    $Address = mysqli_real_escape_string($connect, $Address);

    $Admin = $_POST['Admin'];
    $Admin = mysqli_real_escape_string($connect, $Admin);


    if (!empty($Name)) {
        $query = "Insert Into user_info Values('$ID','$Name','$Email','$User','$Pass','$Cell','$Address','$Admin')";
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
    $Name = '';
    $Email = '';
    $User = '';
    $Pass = '';
    $Cell = '';
    $Address = '';
    $Admin = '';
}

// Update & Edit

if (isset($_POST['UPDATE'])) {
    $ID = $_POST['ID'];
    $ID = mysqli_real_escape_string($connect, $ID);

    $User = $_POST['User'];
    $User = mysqli_real_escape_string($connect, $User);

    $Name = $_POST['Name'];
    $Name = mysqli_real_escape_string($connect, $Name);

    $Email = $_POST['Email'];
    $Email = mysqli_real_escape_string($connect, $Email);

    $Pass = $_POST['Pass'];
    $Pass = mysqli_real_escape_string($connect, $Pass);

    $Cell = $_POST['Cell'];
    $Cell = mysqli_real_escape_string($connect, $Cell);

    $Address = $_POST['Address'];
    $Address = mysqli_real_escape_string($connect, $Address);

    $Admin = $_POST['Admin'];
    $Admin = mysqli_real_escape_string($connect, $Admin);


    $query = "SELECT email from user_info where username = '$User' || emp_id = '$ID'";
        $result = mysqli_query($connect, $query);
        $row = mysqli_fetch_row($result);


        if ($row[0] == $Email) {
            $query = "Update user_info Set emp_id ='$ID' , name = '$Name' ,  username = '$User' ,
            password = '$Pass' , cellphone = '$Cell' , address = '$Address' ,
             Admin = $Admin where email = '$Email'";
            $result = mysqli_query($connect, $query) or die("query is failed" . mysqli_error($connect));
        } else {
            $query = "Update user_info Set emp_id ='$ID' , name = '$Name' ,  username = '$User' ,
            password = '$Pass' , cellphone = '$Cell'  address = '$Address' ,
             Admin = '$Admin', email = '$Email' where name = '$Name'";
            $result = mysqli_query($connect, $query) or die("query is failed" . mysqli_error($connect));
        }

        if (mysqli_affected_rows($connect) > 0) {
            echo "Data updated";

        } else {
            echo "Data not updated";
        }

        $ID = '';
        $Name = '';
        $Email = '';
        $User = '';
        $Pass = '';
        $Cell = '';
        $Address = '';
        $Admin = '';
    }


if (isset($_POST['FIND'])) {
    $ID = $_POST['ID'];
    $ID = mysqli_real_escape_string($connect, $ID);

    $User = $_POST['User'];
    $User = mysqli_real_escape_string($connect, $User);

    $Name = $_POST['Name'];
    $Name = mysqli_real_escape_string($connect, $Name);

    $Email = $_POST['Email'];
    $Email = mysqli_real_escape_string($connect, $Email);

    $Pass = $_POST['Pass'];
    $Pass = mysqli_real_escape_string($connect, $Pass);

    $Cell = $_POST['Cell'];
    $Cell = mysqli_real_escape_string($connect, $Cell);

    $Address = $_POST['Address'];
    $Address = mysqli_real_escape_string($connect, $Address);

    $Admin = $_POST['Admin'];
    $Admin = mysqli_real_escape_string($connect, $Admin);


    $query = "Select * from user_info where emp_id = '$ID' OR Name = '$Name'";
    $result = mysqli_query($connect, $query) or die ("query is failed" . mysqli_error($connect));
    if (($row = mysqli_fetch_row($result)) == true) {
        $ID = $row[0];
        $Name = $row[1];
        $Email = $row[2];
        $User = $row[3];
        $Pass = $row[4];
        $Cell = $row[5];
        $Address = $row[6];
        $Admin = $row[7];


    } else echo "record not found";
}

// Delete

if (isset($_POST['DELETE'])) {
    $ID = $_POST['ID'];
    $ID = mysqli_real_escape_string($connect, $ID);

    $Name = $_POST['Name'];
    $Name = mysqli_real_escape_string($connect, $Name);

    if (!empty($ID)) {
        $query = "Delete from user_info where emp_id = '$ID' OR Name = '$Name'";
        $result = mysqli_query($connect, $query) or die("query is failed" . mysqli_error($connect));
        if (mysqli_affected_rows($connect) > 0) {
            echo "Record Deleted";
        } else {
            echo "Nothing changed";
        }
    } else {
        echo "Data not changed";
    }
    $ID= '';
    $Name ='';
}

$query = "SELECT * FROM user_info ORDER BY username ASC ";
$result = mysqli_query($connect, $query);

echo "<table border='1' >";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>User</th><th>Password</th><th>Cellphone</th><th>Address</th>
<th>Admin</th></tr>";

while (($row = mysqli_fetch_row($result)) == true) {
    echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td>
<td>$row[5]</td><td>$row[6]</td><td>$row[7]</td></tr>";
}

echo "</table>";


?>


<form method="post">
    <p> Enter ID:<input type="text" name="ID" value="<?php echo $ID ?>"/></p>
    <p> Enter Name: <input type="text" name="Name" value="<?php echo $Name ?>"/></p>
    <p> Enter Email:<input type="text" name="Email" value="<?php echo $Email ?>"/></p>
    <p> Enter User:<input type="text" name="User" value="<?php echo $User ?>"/></p>
    <p> Enter Pass:<input type="text" name="Pass" value="<?php echo $Pass ?>"/></p>
    <p> Enter Cell:<input type="text" name="Cell" value="<?php echo $Cell ?>"/></p>
    <p> Enter Adress:<input type="text" name="Address" value="<?php echo $Address ?>"/></p>
    <p> Enter Admin Status:<input type="text" name="Admin" value="<?php echo $Admin ?>"/></p>

    <input type="submit" value="Update" name="UPDATE"/>
    <input type="submit" value="Delete" name="DELETE"/>
    <input type="submit" value="Save" name="SAVE"/>
    <input type="submit" value="Find" name="FIND"/>

</form>


</body>


</html>
