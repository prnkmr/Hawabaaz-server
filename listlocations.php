<?php
require_once("praveen.php");
$app=new praveen();
$sql="select id,name from hawabaaz.available_locations";
 $result=$app->query($sql);
   $resp["list"]=array();
     while($row=$result->fetch_array()){
         $entry=array($row['id'],$row['name']);
         $resp["list"][]=$entry;

     }
     $resp[error]=0;
     if(debug) {
         $resp['status'] = "success";
     }
echo json_encode($resp);
?>