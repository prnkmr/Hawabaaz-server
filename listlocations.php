<?php
require_once("praveen.php");
$app=new praveen();
if(debug)$respjson[status]="unprocessed";
$con=$app->getConnection();
$sql="select id,name from hawabaaz.available_locations";
 $result=$app->query($sql);
   $resp["list"]=array();
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