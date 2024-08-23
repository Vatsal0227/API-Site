<?php
if($sn==NULL || empty($sn))
{
	header('Content-Type: application/json');
	header('HTTP/1.1 200 OK');
	$output[]='Status: ERROR';
	$output[]='MSG: Invalid or missing Serial Number.';
	$output[]='Action: none';
	$responseData=json_encode($output);
	echo $responseData;
	die();
}

$sql="Select * from `serials` where `serial_number`='$sn'";
$rst=$dblink->query($sql) or 
	die(q_error("<p>Something went wrong with $sql<br>".$dblink->error));
$serial=$rst->fetch_array(MYSQLI_ASSOC);
if($rst->num_rows > 0)
{	
	header('Content-Type: application/json');
	header('HTTP/1.1 200 OK');
	$jsonDevice=json_encode($serial);
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
	$output[]='MSG: Serial Number does not exist';
	$output[]='Action: none';
	$responseData=json_encode($output);
	echo $responseData;
	die();
}
?>