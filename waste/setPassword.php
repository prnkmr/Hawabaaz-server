<?php
require_once("praveen.php");
$resp= array(
    "status"=>"unprocessed",
    error=>1
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
                            $resp[error] = 0;
                            if ($prn->debug) {
                                $resp['status'] = "success";
                            }
                        } else {
                            $resp[error] = 4;
                        }
                    }else{
                        $resp[error]=105;
                    }
                } else {
                    $resp["status"] = "Authentication Failure";
                    $resp[error] = 5;
                }
            } else {
                if ($prn->debug) {
                $resp["status"] = "SQL querry error";
                $resp["SqlError"] = $conn->error;}
                $resp[error] = 4;
            }
        } else {
            if ($prn->debug) {
            $resp["status"] = "SQL Connection error";
            $resp["SqlError"] = $conn->error;}
            $resp[error] = 3;
        }
    }else{
        $resp[error]=102;
    }
}else{
    if ($prn->debug) {
    $resp["status"]="insufficient Data";
    $resp["missKey"]=$prn->error;}
    $resp[error]=2;
}

echo json_encode($resp);
?>