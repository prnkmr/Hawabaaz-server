<?php
require_once("praveen.php");
$keys=array("userId","orders");
$prn=new praveen();
$resp= array(
    error=>1
);
if($prn->debug){
    $resp["status"]="unprocessed"; }
if($prn->checkPOST($keys)){
    $conn=$prn->getConnection();
    if($conn){
        $userId=$prn->safePost('userId');
        $json=$prn->safePost('orders');
        $sql = "insert into orders(user) value ($userId)";
        if ($result = $prn->query($sql)) {
            $orderId=$conn->insert_id;
            if($orders=json_decode($json,true)){
                $sql="";
                foreach ($orders as $order) {
                    $sql.="insert into ordered_items(order_id, item_id, item_count) VALUES ($orderId,$order[0],$order[1]);";
                }
                if($conn->multi_query($sql)){
                    $resp[error]=0;
                    if($prn->debug){
                        $resp[status]="success";
                    }
                }else{
                    if($prn->debug){
                        $resp[status] = "SQL error";
                        $resp["SqlError"] = $conn->error;
                        $resp[line]=__LINE__;}
                    $resp[error] = 4;
                }

            }else{
                $resp[error]=6;
                if($prn->debug){
                    $resp['status']="Json decode error";
                    $resp['json']=$json;
                    $resp[line]=__LINE__;
                }
            }


        } else {
            if($prn->debug){
                $resp[status] = "SQL error";
                $resp["SqlError"] = $conn->error;
                $resp[line]=__LINE__;}
            $resp[error] = 4;
        }


    }else{
        if($prn->debug) {
            $resp["status"] = "SQL Connection error";
            $resp["SqlError"] = $conn->error;
            $resp[line]=__LINE__;
        }
        $resp[error]=3;
    }
}else{
    if($prn->debug){
        $resp["status"]="insufficient Data";
        $resp['missKey']=$prn->error;
        $resp[line]=__LINE__;}
    $resp[error]=2;
}

echo json_encode($resp);

?>