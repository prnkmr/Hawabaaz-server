<?php
class config
{

    public $onServer = false;
    public $dbdetails, $errorCode,$appdata;

    function __construct()
    {
        if ($this->onServer) {
            $dbURL = "";
            $dbName = "";
            $dbusername = "";
            $dbpassword = "";
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
            6 => "Functional Error",
            101 => "Already Registered",
            102 => "password mismatch",
            103 => "invalid phone number"
        );

        $this->appdata = array();


        echo "runing";

    }

}
?>
