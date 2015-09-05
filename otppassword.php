<?php
require_once("praveen.php");
$respjson= array(
    "status"=>"unprocessed",
    "errorCode"=>1

);
$keys=array("otp");
$sk=new praveen();
if($sk->checkPOST($keys)) {
    $userId = 10;
    $otp = $sk->safePost("otp");

    $con = $sk->getConnection();
    if ($con) {
        $sql = "select verified from registered_users where id='{$userId}' and temporary_password ='{$otp}' limit 1";
        if ($result = $sk->query($sql)) {
            $usercount = $result->num_rows;
            if ($usercount == 1) {
                $sql="update  hawabaaz.registered_users set temporary_password='{$otp}', verified=1  where id='{$userId}' ";
                $sk->query($sql);
            } else {
                $respjson["status"]="Authentication Failure";
                $respjson["missKey"]=$sk->error;
                $respjson["errorCode"]=5;

            }

        } else {
            $respjson["status"] = "SQL querry error";
            $respjson["SqlError"] = $conn->error;
            $respjson["errorCode"] = 4;
        }
    } else {
        $respjson["status"] = "SQL Connection error";
        $respjson["SqlError"] = $conn->error;
        $respjson["errorCode"] = 3;
    }

}else{
    $respjson["status"]="insufficient Data";
    $respjson["missKey"]=$sk->error;
    $respjson["errorCode"]=2;

}

?>