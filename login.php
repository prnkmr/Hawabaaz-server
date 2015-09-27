<?php
require_once("praveen.php");
$app=new praveen();
$keys=array("username","password");
$app->checkPOST($keys);
$username=$app->escapedPost($keys[0]);
$password=$app->escapedPost($keys[1]);
$sql="select id from registered_users WHERE( phone='$username' or email ='$username') and (password='$password' )limit 1";
$result=$app->query($sql);
$usercount=$result->num_rows;
if($usercount==1){
    $row=$result->fetch_array();
    $resp['userid']= $row['id'];
    $resp[error]=0;
    if(debug) {
        $resp['status'] = "success";
    }
}else{
    $resp[error] = 5;

        if(debug) {
            $resp['status'] = "Authentication Failure";
        }

}
echo json_encode($resp);
?>