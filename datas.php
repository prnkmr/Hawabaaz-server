<?php

$onServer=false;
if($onServer) {
    $dbURL = "";
    $dbName = "";
    $dbusername = "";
    $dbpassword = "";
}else{
    $dbURL = "localhoost";
    $dbName = "hawabaaz";
    $dbusername = "root";
    $dbpassword = "";
}
$dbdetails = array(
    'url' => $dbURL,
    'name' => $dbName,
    'username' => $dbusername,
    'password' => $dbpassword
);


$errorCode=array(
    1=>"Unprocessed",
    2=>"Insufficient Parameters",
    3=>"DB Connectivity Error",
    4=>"Query Error",
    5=>"Autherntication Failure",
    6=>"Functional Error",
    101=>"Already Registered",
    102=>"password mismatch",
    103=>"invalid phone number"
);

$appdata=array(
);


?>
