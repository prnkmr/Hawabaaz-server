<?php
require_once("praveen.php");
$app=new praveen();
$keys=array("phone","email");
$app->checkPOST($keys);
$phone=$app->escapedPost($keys[0]);
$email=$app->escapedPost($keys[0]);
if(is_numeric($phone)) {
    $sql = "select (id) from registered_users where phone='$phone' or email='$email' limit 1";
    $result=$app->query($sql);
    $userCount = $result->num_rows;
    if ($userCount == 0) {
        $password=$app->generateRandomString(8);
        if ($phone == "")
            $sql = "insert into registered_users(email, password) values ('$email','$password')";
        else if ($email == "") $sql = "insert into registered_users(email,password) values ('$phone','$password')";
        else $sql = "insert into registered_users(phone, email, password) values ('$phone','$email','$password')";
        $result=$app->query($sql);
        $resp[error]=0;
        if(debug) {
            $resp['status'] = "success";
        }

    }else {
        if(debug){
            $resp["status"] = "Already registered"; }
        $resp[error] = 101;
    }

}else{
    if(debug){
        $resp["status"] = "Invalid Phone number";
    }
    $resp[error] = 103;
}
echo json_encode($resp);
?>