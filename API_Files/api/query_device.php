<?php
if(($dName==NULL || empty($dName))  && ($did==NULL || empty($did)))
{
	header('Content-Type: application/json');
	header('HTTP/1.1 200 OK');
	$output[]='Status: ERROR';
	$output[]='MSG: Invalid or missing Device Name OR Device ID';
	$output[]='Action: none';
	$responseData=json_encode($output);
	echo $responseData;
	die();
}
if(!empty($dName))
	$sql="Select * from `devices` where `name`='$dName'";
else
	$sql="Select * from `devices` where `auto_id`='$did'";

$rst=$dblink->query($sql) or 
	die(q_error("<p>Something went wrong with $sql<br>".$dblink->error));
$device=$rst->fetch_array(MYSQLI_ASSOC);
if($rst->num_rows > 0)
{
	
	header('Content-Type: application/json');
	header('HTTP/1.1 200 OK');
	$jsonDevice=json_encode($device);
	$output[]='Status: Success';
	$output[]='MSG: ' . $jsonDevice;
	$output[]='Action: none';
	$responseData=json_encode($output);
	echo $responseData;
	die();
}
else
{
	header('Content-Type: application/json');
	header('HTTP/1.1 200 OK');
	$output[]='Status: ERROR';
	$output[]='MSG: Device does not exist';
	$output[]='Action: none';
	$responseData=json_encode($output);
	echo $responseData;
	die();
}
?>