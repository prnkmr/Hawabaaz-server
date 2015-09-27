<?php
require_once("praveen.php");
$keys=array("userId","orders");
$app=new praveen();
$conn=$app->getConnection();
$app->checkPOST($keys);

        $userId=$app->escapedPost($keys[0]);
        $json=$app->escapedPost($keys[1]);
        $sql = "insert into orders(user) value ($userId)";
        $result = $app->query($sql);
            $orderId=$conn->insert_id;
            if($orders=json_decode($json,true)){
                $sql="";
                foreach ($orders as $order) {
                    $sql.="insert into ordered_items(order_id, item_id, item_count) VALUES ($orderId,$order[0],$order[1]);";
                }
                $app->multiQuery($sql);
                    $resp[error]=0;
                    if(debug){
                        $resp[status]="success";
                    }


            }else{
                $resp[error]=6;
                if(debug){
                    $resp['status']="Json decode error";
                    $resp['json']=$json;
                    $resp[line]=__LINE__;
                }
            }
echo json_encode($resp);
?>