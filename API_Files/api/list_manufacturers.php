<?php
if($status!="inactive")
	$sql="Select `name`,`auto_id` from `manufacturers` where `status`='active'";
else
	$sql="Select `name`,`auto_id` from `manufacturers`";
$manufacturers=array();
$result=$dblink->query($sql) or die(q_error("Something went wrong with $sql".$dblink->error));
while ($data=$result->fetch_array(MYSQLI_ASSOC))
	$manufacturers[$data['auto_id']]=$data['name'];

header('Content-Type: application/json');
header('HTTP/1.1 200 OK');
$jsonManufacturers=json_encode($manufacturers);
$output[]='Status: Success';
$output[]='MSG: '.$jsonManufacturers;
$output[]='Action: none';
$responseData=json_encode($output);
echo $responseData;
die();
?>