<?php
require_once("praveen.php");
$respjson= array(
    "status"=>"unprocessed",
    "errorCode"=>1
);
$keys=array("orderid","orderstatus");
$sk = new praveen();
if($sk->checkPOST($keys)) {
$con = $sk->getConnection();
 if($con){
     $orderid=$sk->safePost("orderid");
     $orderstatus=$sk->safePost("orderstatus");
 $sql="update hawabaaz.orders set order_status='{$orderstatus}' where id='{$orderid}'";

     if($result=$sk->query($sql)){
     $respjson['errorCode']=0;
     if($sk->debug) {
         $respjson['status'] = "success";
     }}else {
         if($sk->debug){
             $respjson["status"] = "SQL querry error";
             $respjson["SqlError"] = $con->error;
         }
         $respjson["errorCode"] = 4;
     }
 }   else{

     if($sk->debug){
         $respjson["status"] = "SQL Connection error";
         $respjson["SqlError"] = $con->error;
     }
     $respjson["errorCode"] = 3;
 }


}else{
    if($sk->debug) {
        $respjson["status"] = "insufficient Data";
        $respjson["missKey"] = $sk->error;
    }
    $respjson["errorCode"]=2;
}
echo json_encode($respjson);
?>