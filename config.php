<?php
define("error","error");
define("status","status");
define("line","line");
define("debug",true);
class config
{
    public $onServer = false;
    public $dbdetails, $errorCode,$appdata;

    function __construct()
    {
        if ($this->onServer) {
            $dbURL = "hawabaaz.com";
            $dbName = "hawabaaz_sql";
            $dbusername = "hawabaaz_sql";
            $dbpassword = "56903#";
        } else {
            $dbURL = "localhost";
            $dbName = "hawabaaz";
            $dbusername = "root";
            $dbpassword = "";
        }
        $this->dbdetails = array(
            'url' => $dbURL,
            'name' => $dbName,
            'username' => $dbusername,
            'password' => $dbpassword
        );


        $this->errorCode = array(
            1 => "Unprocessed",
            2 => "Insufficient Parameters",
            3 => "DB Connectivity Error",
            4 => "Query Error",
            5 => "Autherntication Failure",
            6 => "json decode error",

            101 => "Already Registered",
            102 => "password mismatch",
            103 => "invalid phone number",
            104 => "Password not set",
            105 => "Password Already Set",
            106 => "username not found"

        );


        $this->appdata = array(

        );


    }
}

?>
