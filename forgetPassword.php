<?php
require_once("praveen.php");
$app=new praveen();
$keys=array("username");
$app->checkPOST($keys);

$username=$app->escapedPost($keys[0]);
$sql = "select (id) from registered_users where phone='$username' or email='$username' limit 1";
$result = $app->query($sql);
$userCount = $result->num_rows;
    if ($userCount == 1) {
        $password=$app->generateRandomString(8);
        $sql = "update registered_users set password='$password' where (phone='$username' or email='$username') ";
        $result = $app->query($sql);
        if(debug){
            $resp["status"] = "Success";}
        $resp[error] = 0;
    } else {
        if(debug)
            $resp["status"] = "Invalid Username";
        $resp[error] = 106;
    }
echo json_encode($resp);
?>