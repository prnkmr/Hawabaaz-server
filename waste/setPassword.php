<?php
require_once("praveen.php");
$resp= array(
    "status"=>"unprocessed",
    "errorCode"=>1
);
$keys=array("OTP","userId","password","rePassword");
$prn=new praveen();
if($prn->checkPOST($keys)) {
    $userId = $prn->safePost("userId");
    $otp = $prn->safePost("OTP");
    $password=$prn->safePost("password");
    $rePassword=$prn->safePost("rePassword");
    if($password==$rePassword) {
        $con = $prn->getConnection();
        if ($con) {
            $sql = "select verified from registered_users where id='$userId' and temporary_password ='$otp' limit 1";
            if ($result = $prn->query($sql)) {
                $usercount = $result->num_rows;
                if ($usercount == 1) {
                    $row=$result->fetch_array();
                    if($row['verified']==0) {
                        $sql = "update  hawabaaz.registered_users set password='$password', temporary_password='', verified=1  where id='$userId' ";
                        if ($prn->query($sql)) {
                            $resp['errorCode'] = 0;
                            if ($prn->debug) {
                                $resp['status'] = "success";
                            }
                        } else {
                            $resp['errorCode'] = 4;
                        }
                    }else{
                        $resp['errorCode']=105;
                    }
                } else {
                    $resp["status"] = "Authentication Failure";
                    $resp["errorCode"] = 5;
                }
            } else {
                if ($prn->debug) {
                $resp["status"] = "SQL querry error";
                $resp["SqlError"] = $conn->error;}
                $resp["errorCode"] = 4;
            }
        } else {
            if ($prn->debug) {
            $resp["status"] = "SQL Connection error";
            $resp["SqlError"] = $conn->error;}
            $resp["errorCode"] = 3;
        }
    }else{
        $resp["errorCode"]=102;
    }
}else{
    if ($prn->debug) {
    $resp["status"]="insufficient Data";
    $resp["missKey"]=$prn->error;}
    $resp["errorCode"]=2;
}

echo json_encode($resp);
?>