<?php
require_once("praveen.php");
$app=new praveen();
$keys=array("recipeid");
$app->checkPOST($keys);
$recipeid=$app->escapedPost($keys[0]);
$sql="select comment from ratings where recipe_id=$recipeid";
$result = $app->query($sql);
$resp["list"]=array();
while($row=$result->fetch_array()){
    $entry=array($row['comment']);
    $resp["list"][]=$entry;

}
$resp[error]=0;
if(debug) {
    $resp['status'] = "success";
}
echo json_encode($resp);

?>