<?php session_start(); ?>
<!-- Restricts User based on their session id -->
<html>
<head>
    <title>Access Denied</title>
</head>
<body>
<h1>You are not allowed on this page</h1>
<?php


if (!isset($_SESSION['Username'])) {
    echo "<p>You will be redirected to the login page in 5 seconds.</p>";
    echo "<meta http-equiv=\"refresh\" content=\"5;url=login.php\"/>"; //Refreshes page in 5 seconds
} else if (!isset($_SESSION['Admin'])) {
    echo "<p>You will be redirected to your homepage in 5 seconds.</p>";
    echo "<meta http-equiv=\"refresh\" content=\"5;url=homepage.php\"/>";
} else if (isset($_SESSION['Username'])) {
    echo "<p>You are already logged in.</p><br><p>You will be redirected to your homepage in 5 seconds.</p>";
    echo "<meta http-equiv=\"refresh\" content=\"5;url=homepage.php\"/>";
}
?>


</body>
</html>