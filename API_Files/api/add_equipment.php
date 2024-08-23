<?php
if (empty($did) || !is_numeric($did))//decive id is missing
{
    header('Content-Type: application/json');
    header('HTTP/1.1 200 OK');
    $output[]='Status: ERROR';
    $output[]='MSG: Invalid or missing device id.';
    $output[]='Action: query_device';
    $responseData=json_encode($output);
    echo $responseData;
    die();
}
if (empty($mid) || !is_numeric($mid))//missing manufacturer id
{
    header('Content-Type: application/json');
    header('HTTP/1.1 200 OK');
    $output[]='Status: ERROR';
    $output[]='MSG: Invalid or missing manufacturer id.';
    $output[]='Action: query_manufacturer';
    $responseData=json_encode($output);
    echo $responseData;
    die();
}
if (empty($sn))//missing serial number
{
    header('Content-Type: application/json');
    header('HTTP/1.1 200 OK');
    $output[]='Status: ERROR';
    $output[]='MSG: Invalid or missing serial number.';
    $output[]='Action: none';
    $responseData=json_encode($output);
    echo $responseData;
    die();
}
else{
	$sql="Insert into `serials` (`device_id`,`manufacturer_id`,`serial_number`) values ('$did','$mid','$sn')";
	$dblink->query($sql) or
		die(q_error("<p>Something went wrong with $sql<br>".$dblink->error));

	header('Content-Type: application/json');
	header('HTTP/1.1 200 OK');
	$output[]='Status: Success';
	$output[]='MSG: Equipement Successfully Added';
	$output[]='Action: none';
	$responseData=json_encode($output);
	echo $responseData;
	die();
}
?>