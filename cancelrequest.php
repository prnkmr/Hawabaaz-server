<?php
require_once("praveen.php");
$app=new praveen();
$keys=array("orderid");
$app->checkPOST($keys);
$orderid=$app->escapedPost($keys[0]);
$sql="insert into cancel_request (order_id) values ('{$orderid}')";
$app->query($sql);
$resp[error]=0;
if(debug) {
    $resp['status'] = "success";
}
echo json_encode($resp);
?>