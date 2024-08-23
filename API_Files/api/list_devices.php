<?php
if($status!="inactive")
	$sql="Select `name`,`auto_id` from `devices` where `status`='active'";
else
	$sql="Select `name`,`auto_id` from `devices`";
$result=$dblink->query($sql) or 
	die(q_error("Something went wrong with $sql<br>\n".$dblink->error));
$devices=array();
while ($data=$result->fetch_array(MYSQLI_ASSOC))
	$devices[$data['auto_id']]=$data['name'];

header('Content-Type: application/json');
header('HTTP/1.1 200 OK');
$jsonDevices=json_encode($devices);
$output[]='Status: Success';
$output[]='MSG: '.$jsonDevices;
$output[]='Action: none';
$responseData=json_encode($output);
echo $responseData;
die();
?>