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
                if ($userCount == 0) {
                    $password=$prn->generateRandomString(8);
                    if ($phone == "")
                        $sql = "insert into hawabaaz.registered_users(email, password) values ('$email','$password')";
                    else if ($email == "") $sql = "insert into hawabaaz.registered_users(email,password) values ('$phone','$password')";
                    else $sql = "insert into hawabaaz.registered_users(phone, email, password) values ('$phone','$email','$password')";
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
                        $resp["status"] = "Already registered"; }
                    $resp["errorCode"] = 101;
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