<?php
require_once("praveen.php");
$respjson= array(
    "status"=>"unprocessed",
    error=>1
);
$keys=array("userid");
$sk = new praveen();
if($sk->checkPOST($keys)) {

    $con=$sk->getConnection();
    if($con){
        $userid=$sk->safePost("userid");
        $sql="select id,order_status from orders where user='{$userid}'";
        if($result=$sk->query($sql)){
            $respjson["list"]=array();
            while($row=$result->fetch_array()){
                $entry=array($row['id'],$row['order_status']);
                $respjson["list"][]=$entry;

            }
            $respjson[error]=0;
            if($sk->debug) {
                $respjson['status'] = "success";
            }

        }else{
            if($sk->debug){
                $resp["status"] = "SQL error";
                $resp["SqlError"] = $con->error;
            }
            $resp["error"] = 4;
        }

    }else{

        if($sk->debug){
            $respjson["status"] = "SQL Connection error";
            $respjson["SqlError"] = $con->error;
        }
        $respjson["error"] = 3;
    }

}else{
    if($sk->debug) {
        $respjson["status"] = "insufficient Data";
        $respjson["missKey"] = $sk->error;
    }
    $respjson["error"]=2;

}

echo json_encode($respjson);
?>