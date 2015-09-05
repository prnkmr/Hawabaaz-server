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
     $respjson['status']="success";

 }else{

     $respjson["status"] = "SQL querry error";
     $respjson["SqlError"] = $conn->error;
     $respjson["errorCode"] = 4;
 }


}else{
    $respjson["status"] = "SQL Connection error";
    $respjson["SqlError"] = $conn->error;
    $respjson["errorCode"] = 3;

}
?>