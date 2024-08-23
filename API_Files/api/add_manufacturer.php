<?php
if($mName==NULL || empty($mName))
{
	header('Content-Type: application/json');
	header('HTTP/1.1 200 OK');
	$output[]='Status: ERROR';
	$output[]='MSG: Invalid or missing Manufacturer Name.';
	$output[]='Action: none';
	$responseData=json_encode($output);
	echo $responseData;
	die();
}

$sql="Insert into `manufacturers` (`name`) values ('$mName')";
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