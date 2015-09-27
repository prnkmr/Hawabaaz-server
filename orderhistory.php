<?php
require_once("praveen.php");
$app=new praveen();
$keys=array("userid");
$app->checkPOST($keys);
$userid=$app->escapedPost($keys[0]);
$sql="select id,order_status from orders where user='{$userid}'";
$result=$app->query($sql);
$resp["list"]=array();
while($row=$result->fetch_array()){
    $entry=array($row['id'],$row['order_status']);
    $resp["list"][]=$entry;
}
$resp[error]=0;
if(debug) {
    $resp['status'] = "success";
}
echo json_encode($resp);

?>