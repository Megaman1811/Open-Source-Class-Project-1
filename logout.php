<?php
/**
 * Created by PhpStorm.
 * User: ccerr
 * Date: 2018-11-03
 * Time: 12:24 AM
 */

session_start();
session_destroy();

//Logs User Out


header('Location:login.php?logout=1');