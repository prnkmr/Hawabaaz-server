<?php
require_once("praveen.php");
$respjson= array(
    "status"=>"unprocessed",
    error=>1

);
$keys=array("userid","password","repassword");
$prn=new praveen();
$password=$prn->safePost("password");
$repassword=$prn->safePost("repassword");
if($prn->checkPOST($keys)) {
    if(strcmp($password,$repassword)==0){
    $con=$prn->getConnection();
    if($con) {
        $userid = $prn->safePost("userid");
        $sql = "select password from registered_users where id='{$userid}' limit 1";
        if ($result = $prn->query($sql)) {
        $usercount = $result->num_rows;
        if ($usercount == 1) {
          $sql="update  hawabaaz.registered_users set password='{$password}' where id='{$userid}'";
            $prn->query($sql);
            $respjson[error]=0;
            $respjson['status']="success";
        } else {
            $respjson["status"] = "Authentication Failure";
            $respjson[error] = 5;

        }
    }else{

            $respjson["status"] = "SQL querry error";
            $respjson["SqlError"] = $conn->error;
            $respjson[error] = 4;
        }

    }else{
            $respjson["status"] = "SQL Connection error";
            $respjson["SqlError"] = $conn->error;
            $respjson[error] = 3;

    }
}else{
        $respjson["status"]="password mismatch";
        $respjson[error]=102;


    }
}
else{
    $respjson["status"]="insufficient Data";
    $respjson["missKey"]=$prn->error;
    $respjson[error]=2;

}


?>