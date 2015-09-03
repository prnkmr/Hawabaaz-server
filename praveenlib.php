<?php

//Libraries created by Praveen kumar
//This library file includes many functions and its description.


//function to check if all the GET requests are set
//parameter - It takes an array of keys.
//return - boolean

require_once('datas.php');

function checkGET($keys)
{
    foreach ($keys as $i) {
        if (!isset($_GET[$i])&&$_GET[$i]=="") return false;
    }
    return true;
}


//function to check if all the POST requests are set
//parameter - It takes an array of keys.
//return - boolean
function checkPOST($keys)
{
    foreach ($keys as $i) {
        if (!isset($_POST[$i])||$_POST[$i]=="") {
            return false;
        }
    }
    return true;
}

function connectSQL()
{
    global $dbdetails;
    $connection = mysqli_connect($dbdetails['url'], $dbdetails['username'], $dbdetails['password'], $dbdetails['name']) ;
    return $connection;
}

function safeString($connection, $string)
{
    return mysqli_real_escape_string($connection, stripcslashes($string));
}



?>
