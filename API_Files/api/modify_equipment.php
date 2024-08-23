<?php
if (empty($did) || !is_numeric($did))//decive id is missing
{
    header('Content-Type: application/json');
    header('HTTP/1.1 200 OK');
    $output[]='Status: ERROR';
    $output[]='MSG: Invalid or Missing Device ID.';
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
    $output[]='MSG: Invalid or Missing Manufacturer ID.';
    $output[]='Action: query_manufacturer';
    $responseData=json_encode($output);
    echo $responseData;
    die();
}
if (empty($osn)) //missing old serial number
{
	header('Content-Type: application/json');
    header('HTTP/1.1 200 OK');
    $output[]='Status: ERROR';
    $output[]='MSG: Invalid or missing Old Serial Number.';
    $output[]='Action: none';
    $responseData=json_encode($output);
    echo $responseData;
    die();
}
if (empty($status))
{
	header('Content-Type: application/json');
    header('HTTP/1.1 200 OK');
    $output[]='Status: ERROR';
    $output[]='MSG: Invalid or missing Equipment Status.';
    $output[]='Action: none';
    $responseData=json_encode($output);
    echo $responseData;
    die();
}
if (empty($sn))//missing new serial number
{
    header('Content-Type: application/json');
    header('HTTP/1.1 200 OK');
    $output[]='Status: ERROR';
    $output[]='MSG: Invalid or missing New Serial Number.';
    $output[]='Action: none';
    $responseData=json_encode($output);
    echo $responseData;
    die();
}

$sql="Update `serials` Set `device_id`='$did', `manufacturer_id`='$mid', `serial_number`='$sn', `status`='$status' Where `serial_number`='$osn'";
$dblink->query($sql) or
	die(q_error("<p>Something went wrong with $sql<br>".$dblink->error));

header('Content-Type: application/json');
header('HTTP/1.1 200 OK');
$output[]='Status: Success';
$output[]='MSG: Equipement Successfully Modified';
$output[]='Action: none';
$responseData=json_encode($output);
echo $responseData;
die();
?>