<?php session_start(); ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Display Users</title>
    </head>
    <body>
    Logged in as: <?php echo $_SESSION['Username']; ?> | <a href="logout.php">Log out</a><br>
    <?php if (isset($_GET['employeeCreated']) == 1) echo "Employee Created"; ?>

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
$connect = mysqli_connect($host, $user, $password, $dbName) or die("Connection Failed");


if (isset($_POST['FIND'])) {
    $Name = $_POST['name'];
    $query = "Select * from user_info where name LIKE '$Name'";
    $result = mysqli_query($connect, $query) or die ("query is failed" . mysqli_error($connect));
    if (($row = mysqli_fetch_row($result))) {
        $Name = $row[1];
    } else echo "record not found";
}

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



