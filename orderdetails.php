<?php
require_once("praveen.php");
$app=new praveen();
$keys=array("orderid");
$app->checkPOST($keys);
$orderid=$app->escapedPost($keys[0]);
$sql="select id,item_id,item_count from ordered_items where order_id='{$orderid}'";
$result=$app->query($sql);
$resp["list"]=array();
while($row=$result->fetch_array()){
    $entry=array($row['id'],$row['item_id'],$row['item_count']);
    $resp["list"][]=$entry;
}
$resp[error]=0;
if(debug) {
    $resp['status'] = "success";
}
echo json_encode($resp);

?>