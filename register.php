<?php
require_once("praveen.php");
$keys=array("phone","email");
$respjson= array(
    "status"=>"unprocessed",
    "errorCode"=>1
);
$prn=new praveen();
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
                            $sql = "insert into hawabaaz.registered_users(email, password) values ('$email','$password')";
                        else if ($email == "") $sql = "insert into hawabaaz.registered_users(email,password) values ('$phone','$password')";
                        else $sql = "insert into hawabaaz.registered_users(phone, email, password) values ('$phone','$email','$password')";
                        $result = $prn->query($sql);
                        if ($result) {
                            $respjson["status"] = "Success";
                            $respjson["errorCode"] = 0;
                        } else {

                            $respjson["status"] = "SQL error";
                            $respjson["SqlError"] = $conn->error;
                            $respjson["errorCode"] = 4;
                        }
                    } else {
                        $respjson["status"] = "Already registered";
                        $respjson["errorCode"] = 101;
                    }
                } else {
                    $respjson["status"] = "SQL error";
                    $respjson["SqlError"] = $conn->error;
                    $respjson["errorCode"] = 4;
                }

        }else{
            $respjson["status"] = "Invalid Phone number";
            $respjson["errorCode"] = 103;
        }
    }else{
        if($prn->debug) {
            $respjson["status"] = "SQL Connection error";
            $respjson["SqlError"] = $conn->error;
        }
        $respjson["errorCode"]=3;
    }
}else{
    $respjson["status"]="insufficient Data";
    $respjson['missKey']=$prn->error;
    $respjson["errorCode"]=2;
}

echo json_encode($respjson);
