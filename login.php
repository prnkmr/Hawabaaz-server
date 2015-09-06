<?php
require_once("praveen.php");

$resp= array(
    "status"=>"unprocessed",
    error=>1

);
$keys=array("username","password");
$prn = new praveen();
if($prn->checkPOST($keys)){
$con=$prn->getConnection();
    if($con){
        $username=$prn->safePost("username");
        $password=$prn->safePost("password");
        $sql="select id from registered_users WHERE( phone='$username' or email ='$username') and (password='$password' )limit 1";
        if($result=$prn->query($sql)){
            $usercount=$result->num_rows;
            if($usercount==1){
                $row=$result->fetch_array();
                    $resp['userid']= $row['id'];
                    $resp["status"] = "success";
                    $resp[error] = 0;
            }else{
                $resp["status"] = "Authentication Failure";
                $resp[error] = 5;
            }
        }else{
            $resp["status"] = "SQL error";
            $resp["SqlError"] = $conn->error;
            $resp[error] = 4;
        }
    }else{

        $resp["status"] = "SQL Connection error";
        $resp["SqlError"] = $conn->error;
        $resp[error] = 3;
    }
}else{
    $resp["status"]="insufficient Data";
    $resp["missKey"]=$prn->error;
    $resp[error]=2;
}

echo json_encode($resp);
?>