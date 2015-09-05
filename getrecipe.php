<?php
require_once("praveen.php");
$respjson= array(
    "status"=>"unprocessed",
    "errorCode"=>1
);
$keys=array("locationid");
$sk = new praveen();
if($sk->checkPOST($keys)){

$con=$sk->getConnection();
    if($con){
     $locationid=$sk->safePost("locationid");
        $sql="select id,name from hawabaaz.available_recipies where location='{$locationid}'";
        if($result=$sk->query($sql)){


            $respjson["list"]=array();
            while($row=$result->fetch_array()){
                $entry=array($row['id'],$row['name']);
                $respjson["list"][]=$entry;

            }
            $respjson['errorCode']=0;
            if($sk->debug) {
                $respjson['status'] = "success";
            }

        }else{
            if($sk->debug){
                $resp["status"] = "SQL error";
                $resp["SqlError"] = $con->error;
            }
            $resp["errorCode"] = 4;
        }


    }else{

        if($sk->debug){
            $respjson["status"] = "SQL Connection error";
            $respjson["SqlError"] = $con->error;
        }
        $respjson["errorCode"] = 3;
    }

}else{
    if($sk->debug) {
        $respjson["status"] = "insufficient Data";
        $respjson["missKey"] = $con->error;
    }
    $respjson["errorCode"]=2;

}
echo json_encode($respjson);
?>