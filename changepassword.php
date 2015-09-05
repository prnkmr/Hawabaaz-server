<?php
require_once("praveen.php");
$respjson= array(
    "status"=>"unprocessed",
    "errorCode"=>1

);
$keys=array("userid","password","repassword");
$sk=new praveen();
$password=$sk->safePost("password");
$repassword=$sk->safePost("repassword");
if($sk->checkPOST($keys)) {
    if(strcmp($password,$repassword)==0){
    $con=$sk->getConnection();
    if($con) {
        $userid = $sk->safePost("userid");
        $sql = "select password from registered_users where id='{$userid}' limit 1";
        if ($result = $sk->query($sql)) {
        $usercount = $result->num_rows;
        if ($usercount == 1) {
          $sql="update  hawabaaz.registered_users set password='{$password}' where id='{$userid}'";
            $sk->query($sql);
            $respjson['errorCode']=0;
            $respjson['status']="success";
        } else {
            $respjson["status"] = "Authentication Failure";
            $respjson["errorCode"] = 5;

        }
    }else{

            $respjson["status"] = "SQL querry error";
            $respjson["SqlError"] = $conn->error;
            $respjson["errorCode"] = 4;
        }

    }else{
            $respjson["status"] = "SQL Connection error";
            $respjson["SqlError"] = $conn->error;
            $respjson["errorCode"] = 3;

    }
}else{
        $respjson["status"]="password mismatch";
        $respjson["errorCode"]=102;


    }
}
else{
    $respjson["status"]="insufficient Data";
    $respjson["missKey"]=$sk->error;
    $respjson["errorCode"]=2;

}


?>