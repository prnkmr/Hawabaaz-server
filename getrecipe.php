<?php
require_once("praveen.php");
$app=new praveen();
$keys=array("locationid");
$app->checkPOST($keys);

$locationid=$app->escapedPost($keys[0]);

$sql="select id,name from available_recipies where location='{$locationid}'";
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