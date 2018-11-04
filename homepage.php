<?php session_start(); ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title><?php echo $_SESSION['Username']; ?>'s Homepage</title>
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
            <input type="button" onclick="location.href='Incident.php';" value="Submit Incident"/>
            <?php if (isset($_SESSION['Admin'])) {
                echo "<input type=\"button\" onclick=\"location.href='adminconsole.php';\" value=\"Admin Console\"/>";
            } //Checks if Admin. if you are, adds button to console?>
            <input type="button" onclick="location.href='logout.php';" value="Logout"/>
        </p>

    </form>
    </body>
    </html>

<?php

if (!isset($_SESSION['Username'])) {
    header('Location:restricted.php');
}
