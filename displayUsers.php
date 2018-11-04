<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Display Users</title>
</head>
<body>
Logged in as: <?php echo $_SESSION['Username']; ?> | <a href="logout.php">Log out</a> | <a href="adminconsole.php">Admin
    Console</a> <br>
<?php if (isset($_GET['employeeCreated']) == 1) echo "Employee Created"; ?>

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

// SQL variables
$host = "localhost";
$user = "root";
$password = "";
$dbName = "proj_db";
$connect = mysqli_connect($host, $user, $password, $dbName) or die("Connection Failed");

$Name = '';
$Email = '';
$Username = '';

// Find by name
if (isset($_POST['FIND'])) {
    $Name = $_POST['name'];
    $query = "Select * from user_info where name LIKE '$Name'";
    $result = mysqli_query($connect, $query) or die ("query is failed" . mysqli_error($connect));
    if (($row = mysqli_fetch_row($result))) {
        $Name = $row[1];
        $Email = $row[2];

        print_r($row);
    } else echo "record not found";
}

//Shows table of users ordered by user ID
$query = "Select * from user_info ORDER BY emp_id asc ";
$result = mysqli_query($connect, $query) or die("query is failed" . mysqli_error($connect));
echo "<table border='1' >";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>UserName</th><th>Password</th><th>Cell</th><th>Address</th>
<th>Admin</th></tr>";
while (($row = mysqli_fetch_row($result)) == true) {
    echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td>
<td>$row[6]</td><td>";
    if ($row[7] == 1) {
        echo "Yes";
    } else echo "No";

    echo "</td></tr>";
}

echo "</table>";
mysqli_close($connect);


?>

<form method="post">
    <p> Enter Name:<input type="text" placeholder="Enter Name" name="name" value="<?php echo $Name ?>"/></p>
    <p> Enter Email:<input type="text" name="email" value="<?php echo $Email ?>"/></p>
    <input type="submit" value="Update" name="UPDATE"/>
    <input type="submit" value="Delete" name="DELETE"/>
    <input type="submit" value="Save" name="SAVE"/>
    <input type="submit" value="Find" name="FIND"/>

</form>




</body>


</html>
