<?php
if (empty($mid) || !is_numeric($mid))//decive id is missing
{
    header('Content-Type: application/json');
    header('HTTP/1.1 200 OK');
    $output[]='Status: ERROR';
    $output[]='MSG: Invalid or Missing Manufacturer ID.';
    $output[]='Action: query_device';
    $responseData=json_encode($output);
    echo $responseData;
    die();
}
if (empty($mName) || $mName==NULL) //missing new device name
{
    header('Content-Type: application/json');
    header('HTTP/1.1 200 OK');
    $output[]='Status: ERROR';
    $output[]='MSG: Invalid or missing New Manufacturer Name.';
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
    $output[]='MSG: Invalid or missing Manufacturer Status.';
    $output[]='Action: none';
    $responseData=json_encode($output);
    echo $responseData;
    die();
}

$sql="Update `manufacturers` Set `name`='$mName', `status`='$status' Where `auto_id`='$mid'";
$dblink->query($sql) or
	die(q_error("<p>Something went wrong with $sql<br>".$dblink->error));

header('Content-Type: application/json');
header('HTTP/1.1 200 OK');
$output[]='Status: Success';
$output[]='MSG: Manufacturer Successfully Modified';
$output[]='Action: none';
$responseData=json_encode($output);
echo $responseData;
die();
?>