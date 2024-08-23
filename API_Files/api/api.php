<?php
include("../functions.php");
$dblink=db_connect("equipment");
/*$url=$_SERVER['REQUEST_URI'];
header('Content-Type: application/json');
header('HTTP/1.1 200 OK');
$output[]='Status: ERROR';
$output[]='MSG: System Disabled';
$output[]='Action: None';
//log_error($_SERVER['REMOTE_ADDR'],"SYSTEM DISABLED","SYSTEM DISABLED: $endPoint",$url,"api.php");*/
$url=$_SERVER['REQUEST_URI'];
$path = parse_url($url, PHP_URL_PATH);
$pathComponents = explode("/", trim($path, "/"));
$endPoint=$pathComponents[1];
switch($endPoint)
{
    case "add_equipment":	//Done
        $did=$_REQUEST['did'];
        $mid=$_REQUEST['mid'];
        $sn=$_REQUEST['sn'];
        include("add_equipment.php");
        break;
		
	case "add_device":	//Done
		$dName=$_REQUEST['dName'];
		include("add_device.php");
		break;
		
	case "add_manufacturer":	//Done
		$mName=$_REQUEST['mName'];
		include("add_manufacturer.php");
		break;
		
	case "search_equipment":	//Done
		$did=$_REQUEST['did'];
        $mid=$_REQUEST['mid'];
        $sn=$_REQUEST['sn'];
		$status=$_REQUEST['status'];
		include("search_equipment.php");
		break;
		
	case "modify_equipment":	//Done
		$did=$_REQUEST['did'];
		$mid=$_REQUEST['mid'];
		$sn=trim($_REQUEST['sn']);
		$osn=trim($_REQUEST['osn']);
		$status=$_REQUEST['status'];
		include("modify_equipment.php");
		break;
		
	case "modify_device":	//Done
		$did=$_REQUEST['did'];
		$dName=$_REQUEST['dName'];
		$status=$_REQUEST['status'];
		include("modify_device.php");
		break;
		
	case "modify_manufacturer":
		$mid=$_REQUEST['mid'];
		$mName=$_REQUEST['mName'];
		$status=$_REQUEST['status'];
		include("modify_manufacturer.php");
		break;
		
	case "query_device":	//Done
		$did=$_REQUEST['did'];
		$dName=$_REQUEST['dName'];
		include("query_device.php");
		break;
		
	case "query_manufacturer":	//Done
		$mid=$_REQUEST['mid'];
		$mName=$_REQUEST['mName'];
		include("query_manufacturer.php");
		break;
		
	case "query_serial_number":	//Done
		$sn=$_REQUEST['sn'];
		include("query_serial_number.php");
		break;
		
	case "list_devices":	//Done
		$status=$_REQUEST['status'];
		include("list_devices.php");
		break;
		
	case "list_manufacturers":	//Done
		$status=$_REQUEST['status'];
		include("list_manufacturers.php");
		break;
		
    default:
        header('Content-Type: application/json');
        header('HTTP/1.1 200 OK');
        $output[]='Status: ERROR';
        $output[]='MSG: Invalid or missing endpoint';
        $output[]='Action: None';
        $responseData=json_encode($output);
        echo $responseData;
        break;
}
die();
?>