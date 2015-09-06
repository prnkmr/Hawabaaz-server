<?php
require_once("praveen.php");
$keys=array("username");
$prn=new praveen();
$resp= array(
    "errorCode"=>1
);
if($prn->debug){
    $resp["status"]="unprocessed"; }
if($prn->checkPOST($keys)){
    $conn=$prn->getConnection();
    if($conn){
        $username=$prn->safePost('username');
            $sql = "select (id) from registered_users where phone='$username' or email='$username' limit 1";
            if ($result = $prn->query($sql)) {
                $userCount = $result->num_rows;
                if ($userCount == 1) {
                    $password=$prn->generateRandomString(8);
                        $sql = "update registered_users set password='$password' where (phone='$username' or email='$username') ";
                    $result = $prn->query($sql);
                    if ($result) {
                        if($prn->debug){
                            $resp["status"] = "Success";}
                        $resp["errorCode"] = 0;
                    } else {
                        if($prn->debug){
                            $resp["status"] = "SQL error";
                            $resp["SqlError"] = $conn->error; }
                        $resp["errorCode"] = 4;
                    }
                } else {
                    if($prn->debug){
                        $resp["status"] = "Invalid Username"; }
                    $resp["errorCode"] = 106;
                }
            } else {
                if($prn->debug){
                    $resp["status"] = "SQL error";
                    $resp["SqlError"] = $conn->error;}
                $resp["errorCode"] = 4;
            }


    }else{
        if($prn->debug) {
            $resp["status"] = "SQL Connection error";
            $resp["SqlError"] = $conn->error;
        }
        $resp["errorCode"]=3;
    }
}else{
    if($prn->debug){
        $resp["status"]="insufficient Data";
        $resp['missKey']=$prn->error;}
    $resp["errorCode"]=2;
}

echo json_encode($resp);

?>