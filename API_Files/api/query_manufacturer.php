<?php
if(($mName==NULL || empty($mName))  && ($mid==NULL || empty($mid)))
{
	header('Content-Type: application/json');
	header('HTTP/1.1 200 OK');
	$output[]='Status: ERROR';
	$output[]='MSG: Invalid or missing Manufacturer Name OR Manufacturer ID';
	$output[]='Action: none';
	$responseData=json_encode($output);
	echo $responseData;
	die();
}

if(!empty($mName))
	$sql="Select * from `manufacturers` where `name`='$mName'";
else
	$sql="Select * from `manufacturers` where `auto_id`='$mid'";
$rst=$dblink->query($sql) or 
	die(q_error("<p>Something went wrong with $sql<br>".$dblink->error));
$manufacturer=$rst->fetch_array(MYSQLI_ASSOC);
if($rst->num_rows > 0)
{
	
	header('Content-Type: application/json');
	header('HTTP/1.1 200 OK');
	$jsonDevice=json_encode($manufacturer);
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
	$output[]='MSG: Manufacturer does not exist';
	$output[]='Action: none';
	$responseData=json_encode($output);
	echo $responseData;
	die();
}
?>