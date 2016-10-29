<?php


/**
 * export xls
 * */
require ('../libs/Smarty.class.php');
include dirname(dirname(dirname(__FILE__))).'/service/tj_fuelChangeAPI.php';


$startDate = isset($_REQUEST['startDate']) ? $_REQUEST['startDate'] : null;
$stopDate = isset($_REQUEST['stopDate']) ? $_REQUEST['stopDate'] : null;
$devices=isset($_REQUEST['devices']) ? $_REQUEST['devices'] : null;
//echo "abcde";

$obj = new tj_fuelChange();
//if ($obj ==nothing) echo "nothing";
$objArray = $obj->getTjFuelChange($startDate,$stopDate,$devices,true);
//$objArray = array();
//$objArray[0]= array();
//$objArray[0]["a"]="abc";
//$objArray[0]["b"]="xyz";
//$objArray[1]= array();
//$objArray[1]["a"]="1abc";
//$objArray[1]["b"]="2xyz";


print_r($objArray);

$numberArray = array();
$numRows = count($objArray);
for ($i = 0; $i < $numRows; $i++) {
	array_push($numberArray, ($i +1));
}

$list = array (
	"序号",
	"终端号",
	"车牌号",
	"客户名称",
	"车型",
	"加油量(%)",
	"漏油量(%)",
);
//$list = array (
//	"序号",
//	"DeviceID",
//	"终端号",
//);

$starDay=substr($startDate,0,10);
$stopDay=substr($stopDate,0,10);

$title = "加油漏油日统计（".$starDay."~".$stopDay."）";
$filename = iconv("utf-8", "gb2312", "加油漏油日统计（".$starDay."~".$stopDay."）");
$smarty = new Smarty;
$smarty->assign("title", $title);
$smarty->assign("list", $list);
$smarty->assign("objArray", $objArray);
$smarty->assign("numberArray", $numberArray);
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=$filename.xls");
$smarty->display("fuelChange.tpl");
?>
