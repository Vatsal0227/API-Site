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
if (empty($dName) || $dName==NULL) //missing new device name
{
    header('Content-Type: application/json');
    header('HTTP/1.1 200 OK');
    $output[]='Status: ERROR';
    $output[]='MSG: Invalid or missing New Device Name.';
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
    $output[]='MSG: Invalid or missing Device Status.';
    $output[]='Action: none';
    $responseData=json_encode($output);
    echo $responseData;
    die();
}

$sql="Update `devices` Set `name`='$dName', `status`='$status' Where `auto_id`='$did'";
$dblink->query($sql) or
	die(q_error("<p>Something went wrong with $sql<br>".$dblink->error));

header('Content-Type: application/json');
header('HTTP/1.1 200 OK');
$output[]='Status: Success';
$output[]='MSG: Device Successfully Modified';
$output[]='Action: none';
$responseData=json_encode($output);
echo $responseData;
die();
?>