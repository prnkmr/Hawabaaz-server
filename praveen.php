<?php
require_once('config.php');

$resp=array(
    error=>1
);
if(debug)$resp[status]='unprocessed';


class praveen extends config
{
    public $error;
    public $connection;

    function __construct()
    {
        parent::__construct();
        $this->dbdetails;
        $this->connection = mysqli_connect($this->dbdetails['url'], $this->dbdetails['username'], $this->dbdetails['password'],$this->dbdetails['name']);
        if(!$this->connection) {
            $badResp=array(
                error => 3
            );
            if(debug)
            $badResp[status]='DB Connectivity Error';

            die(json_encode($badResp));
        }

    }

    function checkPOST($keys)
    {
        foreach ($keys as $i) {
            if (!isset($_POST[$i])||$_POST[$i]=="") {
                $badResp=array(
                    error=>2
                );
                if(debug)
                    $badResp[status]="post key '".$i."' required";
                die(json_encode($badResp));
            }
        }
        return true;
    }

    function checkGET($keys)
    {
        foreach ($keys as $i) {
            if (!isset($_GET[$i])||$_GET[$i]=="") {
                $badResp=array(
                    error=>2
                );
                if(debug)
                    $badResp[status]="get key '".$i."' required";
                die(json_encode($badResp));
            }
        }
        return true;
    }

    function getConnection(){
        return $this->connection;
    }

    function query($sql)
    {

         $toReturn=$this->connection->query($sql);
        if($toReturn) return $toReturn;
        else{
            $badResp=array(
                error=>3
            );

            if(debug){
                $badResp[status]="SQL Query Error";
                $badResp['sqlError']=$this->connection->error;
            }
            die(json_encode($badResp));
        }

    }

    function multiQuery($sql){
        $toReturn=$this->connection->multi_query($sql);
        if($toReturn) return $toReturn;
        else{
            $badResp=array(
                error=>3
            );

            if(debug){
                $badResp[status]="SQL Query Error";
                $badResp['sqlError']=$this->connection->error;
            }
            die(json_encode($badResp));
        }
    }

    protected function escapedString($string)
    {
        return mysqli_real_escape_string($this->connection, $string);
    }

    public function escapedPost($key)
    {
        return $this->escapedString($_POST[$key]);
    }

    public function escapedGet($key){
        return $this->escapedString($_GET[$key]);
    }

    function generateRandomString($length=6){
        $allowedCharacters='abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand='';
        for($i=0;$i<$length;$i++) $rand.=$allowedCharacters[rand(0,strlen($allowedCharacters)-1)];
        return $rand;


    }

}