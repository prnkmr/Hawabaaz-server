<?php
require_once("praveen.php");
$keys=array("phone","email");
$prn=new praveen();
$resp= array(
    error=>1
);

if($prn->debug){
    $resp["status"]="unprocessed"; }
if($prn->checkPOST($keys)){
    $conn=$prn->getConnection();
    if($conn){
        $phone=$prn->safePost('phone');
        $email=$prn->safePost('email');
        if(is_numeric($phone)) {
                $sql = "select (id) from registered_users where phone='$phone' or email='$email' limit 1";
                if ($result = $prn->query($sql)) {
                    $userCount = $result->num_rows;
                    if ($userCount == 0) {
                        $password=$prn->generateRandomString(8);
                        if ($phone == "")
                            $sql = "insert into registered_users(email, password) values ('$email','$password')";
                        else if ($email == "") $sql = "insert into registered_users(email,password) values ('$phone','$password')";
                        else $sql = "insert into registered_users(phone, email, password) values ('$phone','$email','$password')";
                        $result = $prn->query($sql);
                        if ($result) {
                            if($prn->debug){
                            $resp["status"] = "Success";}
                            $resp[error] = 0;
                        } else {
                            if($prn->debug){
                            $resp["status"] = "SQL error";
                            $resp["SqlError"] = $conn->error; }
                            $resp[error] = 4;
                        }
                    } else {
                        if($prn->debug){
                        $resp["status"] = "Already registered"; }
                        $resp[error] = 101;
                    }
                } else {
                    if($prn->debug){
                    $resp["status"] = "SQL error";
                    $resp["SqlError"] = $conn->error;}
                    $resp[error] = 4;
                }

        }else{
            if($prn->debug){
            $resp["status"] = "Invalid Phone number"; }
            $resp[error] = 103;
        }
    }else{
        if($prn->debug) {
            $resp["status"] = "SQL Connection error";
            $resp["SqlError"] = $conn->error;
        }
        $resp[error]=3;
    }
}else{
    if($prn->debug){
    $resp["status"]="insufficient Data";
    $resp['missKey']=$prn->error;}
    $resp[error]=2;
}

echo json_encode($resp);
?>