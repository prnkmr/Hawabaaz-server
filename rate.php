<?php
require_once("praveen.php");
require_once("praveen.php");
$respjson= array(
    "status"=>"unprocessed",
    error=>1
);
$keys=array("recipeid","rating","userid","comment");
$sk = new praveen();
if($sk->checkPOST($keys)) {
    $con=$sk->getConnection();
    if($con) {
     $recipeid=$sk->safePost("recipeid");
     $rating=$sk->safePost("rating");
     $userid=$sk->safePost("userid");
     $comment=$sk->safePost("comment");
     $sql="insert into ratings (recipe_id,rating,user,comment) VALUES ($recipeid,$rating,$userid,'$comment')";
        if($sk->query($sql)){
            $respjson[error]=0;
            if($sk->debug) {
                $respjson['status'] = "success";
            }
        }else{
            if($sk->debug){
                $resp["status"] = "SQL error";
                $resp["SqlError"] = $con->error;
            }
            $resp["error"] = 4;
        }


    }else{

        if($sk->debug){
            $respjson["status"] = "SQL Connection error";
            $respjson["SqlError"] = $con->error;
        }
        $respjson["error"] = 3;
    }

}else{
    if($sk->debug) {
        $respjson["status"] = "insufficient Data";
        $respjson["missKey"] = $sk->error;
    }
    $respjson["error"]=2;

}

?>