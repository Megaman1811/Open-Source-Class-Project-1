<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Administrator Console</title>
</head>
<body>
<form method="post">

    Logged in as: <?php echo $_SESSION['Username']; ?> | <a href="logout.php">Log out</a><br>
    <p>
        <input type="button" onclick="location.href='makeEmployee.php';" value="Create Employee"/>
        <input type="button" onclick="location.href='displayUsers.php';" value="View All Users"/>
        <input type="button" onclick="location.href='displayTickets.php';" value="View All Tickets"/>
        <input type="button" onclick="location.href='displayCategories.php';" value="View Ticket Categories"/>
    </p>


    <p> Enter Name:<input type="text" placeholder="Enter Name" name="name"</p>
    <input type="submit" value="Find" name="FIND"/>

</form>
</body>
</html>


<?php
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

$query = "Select * from user_info";
$result = mysqli_query($connect, $query) or die("query is failed" . mysqli_error($connect));
echo "<table border='1' >";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>UserName</th><th>Password</th><th>Cell</th><th>Address</th>
<th>Admin</th></tr>";

while (($row = mysqli_fetch_row($result)) == true) {
    echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td>
<td>$row[6]</td><td>$row[7]</td></tr>";
}

echo "</table>";
mysqli_close($connect);


?>

