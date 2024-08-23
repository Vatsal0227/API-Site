<?php
function db_connect($db) {
	$username="webuser";
	$password=")/DcaCT9!I4XgWdB";
	$host="localhost";
	$dblink=new mysqli($host,$username,$password,$db);
	return $dblink;
}

function redirect ($uri)
{
?>
	<script type="text/javascript">
		<!--
		document.location.href="<?php echo $uri; ?>";
		-->
	</script>
<?php die;
}

//Error Function `auto_id` `line_num` `data` `Error_msg`
/*function log_errors($row,$count,$error_msg,$dblink)
{ 
  $s_row=implode(",", $row);
  $sql="Insert into `error_logs` (`line_num`,`data`,`error_msg`) values ('$count','$s_row','$error_msg')";
  $dblink->query($sql) or
    die("Something went wrong with $sql<br>\n".$dblink->error);
  return;
}*/

function api_call ($api_name, $data="") {
	$ch=curl_init("https://ec2-18-116-30-237.us-east-2.compute.amazonaws.com/api/$api_name");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//ignore ssl
	curl_setopt($ch, CURLOPT_POST,1);//tell curl we are using post
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//this is the data
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//prepare a response
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'content-type: application/x-www-form-urlencoded',
		'content-length: '.strlen($data))
				);
	$result=curl_exec($ch);
	curl_close($ch);
	$nonjsonResult=json_decode($result,true);
	return $nonjsonResult;
}

function q_error ($qer) {
	header('Content-Type: application/json');
	header('HTTP/1.1 200 OK');
	$output[]='Status: ERROR';
	$output[]='MSG: '.$qer;
	$output[]='Action: none';
	$responseData=json_encode($output);
	echo $responseData;
	die();
}

/*function fields_check($row,$count,$dblink)
{
	if(count($row) > 3)
	{
		$error_msg="Incorrect Format: There are too many commas";
    		log_errors($row,$count,$error_msg,$dblink);
		return 0;
	}
	if(count($row) < 3)
	{
		$error_msg="Incorrect Format: There are missing fields";
		log_errors($row,$count,$error_msg,$dblink);
		return 0;
	}
	return 1;
}

function empty_check($row,$count,$dblink) 
{
  $result=1;
	$error_msg="";
	if(empty($row[0]))
	{
		$error_msg.="device_type field, ";
	}
	if(empty($row[1]))
	{
		$error_msg.="manufacturer field, ";
	}
	if (empty($row[2])) 
	{
		$error_msg.="serial_number field, ";
	}
	if (strlen($error_msg) > 0) 
	{
    		$error_msg.="is empty";
    		log_errors($row,$count,$error_msg,$dblink);
       $result=0;
  	}
	return $result;
}
function invalid_char_check($row,$count,$dblink)
{
  	$temp_row=$row;
  $row[0]=str_replace("'", "", $row[0]);
  $row[1]=str_replace("'", "", $row[1]);
  $row[2]=str_replace("'", "", $row[2]);
	$result=1;
	$search='\'';
  	$b_slash="\\";
  	$error_msg="";
	if(strpos($temp_row[0], $search)) 
	{
    		$temp_row[0]=substr_replace($temp_row[0],$b_slash,strpos($temp_row[0], $search),0);
		$error_msg.="Device_type field, ";
		$result=0;
	}
	if(strpos($temp_row[1], $search)) 
	{
    		$temp_row[1]=substr_replace($temp_row[1],$b_slash,strpos($temp_row[1], $search),0);
		$error_msg.="Manufacturer field, ";
		$result=0;
	}
	if(strpos($temp_row[2], $search)) 
	{
    		$temp_row[2]=substr_replace($temp_row[2],$b_slash,strpos($temp_row[2], $search),0);
		$error_msg.="Serial_number field, ";
		$result=0;
	}
	if($result==0) 
	{
    		$error_msg.="contains an invalid character";
    		log_errors($temp_row,$count,$error_msg,$dblink);
    		return $row;
  	}
 
	return $row;
}

function dup_check($row,$count,$dblink) 
{
  	$dupQuery="SELECT `serial_number` FROM `devices` WHERE `serial_number`='$row[2]'";
	$dupResult=$dblink->query($dupQuery) or
		die("Something went wrong with $sql<br>\n".$dblink->error);
   
	if("$dupResult->num_rows" > 0) 
	{
		$error_msg="Encountered a Duplicate serial_number";
		log_errors($row,$count,$error_msg,$dblink);
    		return 0;
	}
  	return 1;
}*/
?>

