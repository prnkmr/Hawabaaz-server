<?php
require_once("praveen.php");
$respjson= array(
    "status"=>"unprocessed",
    error=>1
);
$sk=new praveen();
$con=$sk->getConnection();
if($con){
$sql="select id,name from available_locations";
 if($result=$sk->query($sql)){
   $respjson["list"]=array();
     while($row=$result->fetch_array()){
         $entry=array($row['id'],$row['name']);
         $respjson["list"][]=$entry;

     }
     $respjson[error]=0;
     if($sk->debug) {
         $respjson['status'] = "success";
     }
 }else {
     if($sk->debug){
         $respjson["status"] = "SQL querry error";
         $respjson["SqlError"] = $con->error;
 }
     $respjson[error] = 4;
 }


}else{
    if($sk->debug){
    $respjson["status"] = "SQL Connection error";
    $respjson["SqlError"] = $con->error;
    }
    $respjson[error] = 3;

}
echo json_encode($respjson);
?>