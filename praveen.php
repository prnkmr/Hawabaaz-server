<?php
require_once('config.php');

class praveen extends config
{
    public $error;
    public $debug=true;
    public $connection;

    function __construct()
    {
        parent::__construct();
        $this->dbdetails;
        $this->connection = mysqli_connect($this->dbdetails['url'], $this->dbdetails['username'], $this->dbdetails['password'],$this->dbdetails['name']) ;
    }

    function checkPOST($keys)
    {
        foreach ($keys as $i) {
            if (!isset($_POST[$i])||$_POST[$i]=="") {
                $this->error=$i." Required";
                return false;
            }
        }
        return true;
    }

    function checkGET($keys)
    {
        foreach ($keys as $i) {
            if (!isset($_GET[$i])||$_GET[$i]=="") {
                $this->error=$i." Required";
                return false;
            }
        }
        return true;
    }

    function getConnection(){
        return $this->connection;
    }

    function query($sql)
    {

        return $this->connection->query($sql);
    }

    protected function safeString($connection, $string)
    {
        return mysqli_real_escape_string($connection, $string);
    }

    public function safePost($string)
    {
        return $this->safeString($this->connection,$_POST[$string]);
    }

    public function safeGet($string){
        return $this->safeString($this->connection,$_GET[$string]);
    }

    function generateRandomString($length=6){
        $allowedCharacters='abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand='';
        for($i=0;$i<$length;$i++) $rand.=$allowedCharacters[rand(0,strlen($allowedCharacters)-1)];
        return $rand;


    }

}