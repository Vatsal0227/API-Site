<?php
if($dName==NULL || empty($dName))
{
	header('Content-Type: application/json');
	header('HTTP/1.1 200 OK');
	$output[]='Status: ERROR';
	$output[]='MSG: Invalid or missing Device Name.';
	$output[]='Action: none';
	$responseData=json_encode($output);
	echo $responseData;
	die();
}

$sql="Insert into `devices` (`name`) values ('$dName')";
$dblink->query($sql) or 
	die(q_error("<p>Something went wrong with $sql<br>".$dblink->error));
	
header('Content-Type: application/json');
header('HTTP/1.1 200 OK');
$output[]='Status: Success';
$output[]='MSG: Device Successfully Added';
$output[]='Action: none';
$responseData=json_encode($output);
echo $responseData;
die();
?>