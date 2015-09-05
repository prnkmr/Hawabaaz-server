<?php
require_once("praveen.php");
$respjson= array(
    "status"=>"unprocessed",
    "errorCode"=>1
);
$sk=new praveen();
$con=$sk->getConnection();
if($con){
$sql="select id,name from hawabaaz.available_locations";
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
 }else {
     if($sk->debug){
         $respjson["status"] = "SQL querry error";
         $respjson["SqlError"] = $con->error;
 }
     $respjson["errorCode"] = 4;
 }


}else{
    if($sk->debug){
    $respjson["status"] = "SQL Connection error";
    $respjson["SqlError"] = $con->error;
    }
    $respjson["errorCode"] = 3;

}
echo json_encode($respjson);
?>