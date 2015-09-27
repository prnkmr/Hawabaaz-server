<?php
require_once("praveen.php");
$app=new praveen();
$keys=array("orderid","orderstatus");
$app->checkPOST($keys);
$orderid=$app->escapedPost($keys[0]);
$orderstatus=$app->escapedPost($keys[1]);
$sql="update orders set order_status='{$orderstatus}' where id='{$orderid}'";
$app->query($sql);
$resp[error]=0;
if(debug) {
    $resp['status'] = "success";
}
echo json_encode($resp);



?>