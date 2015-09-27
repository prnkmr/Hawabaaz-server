<?php
require_once("praveen.php");
$app=new praveen();
$keys=array("recipeid","rating","userid","comment");
$app->checkPOST($keys);
$recipeid=$app->escapedPost($keys[0]);
$rating=$app->escapedPost($keys[1]);
$userid=$app->escapedPost($keys[2]);
$comment=$app->escapedPost("$keys[3]");
$sql="insert into ratings (recipe_id,rating,user,comment) VALUES ($recipeid,$rating,$userid,'$comment')";
$app->query($sql);
$resp[error]=0;
if(debug) {
    $resp['status'] = "success";
}
echo json_encode($resp);

?>