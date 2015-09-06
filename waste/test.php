<?php
require_once("../praveen.php");


debug_print_backtrace();
$bt = debug_backtrace();
$caller = array_shift($bt);

echo $caller['file'];
echo $caller['line'];
echo __LINE__;
$arr=array(

        array(1,3),array(4,1),array(2,54),array(14,2)

);
echo json_encode($arr);

?>