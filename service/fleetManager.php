<?php
include '../../zend_obd/jsonAPI/notiFaction.php';
$device = new Alarm();

$vin = $_GET["vin"]; 
$obj = $device->fleetsManage($vin);


$veh = $obj['data'];


echo json_encode($veh);

?>