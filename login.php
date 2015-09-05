<?php
require_once("praveen.php");

$respjson= array(
    "status"=>"unprocessed",
    "errorCode"=>1

);
$keys=array("username","password");
$sk = new praveen();
if($sk->checkPOST($keys)){
$con=$sk->getConnection();
    if($con){
        $uname=$sk->safePost("username");
        $pass=$sk->safePost("password");
        $sql="select id,verified from registered_users WHERE( phone or email ='{$uname}') and (password or temporary_password ='{$pass}' )limit 1";
        if($result=$sk->query($sql)){
            $usercount=$result->num_rows;
            if($usercount==1){
                $row=$result->fetch_array();
                if($row['verified']==1){
                    $respjson['userid']= $row['id'];
                    $respjson["status"] = "success";
                    $respjson["errorCode"] = 0;

                }else{
                    $respjson["status"] = "OTP Not Verified";
                    $respjson["errorCode"] = 104;

                }

            }else{
                $respjson["status"] = "Authentication Failure";
                $respjson["errorCode"] = 5;

            }
        }else{

            $respjson["status"] = "SQL error";
            $respjson["SqlError"] = $conn->error;
            $respjson["errorCode"] = 4;
        }
    }else{

        $respjson["status"] = "SQL Connection error";
        $respjson["SqlError"] = $conn->error;
        $respjson["errorCode"] = 3;


    }
}else{
    $respjson["status"]="insufficient Data";
    $respjson["missKey"]=$sk->error;
    $respjson["errorCode"]=2;
}
echo json_encode($respjson);
?>