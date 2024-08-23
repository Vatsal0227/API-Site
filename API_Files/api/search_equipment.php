<?php
	if (!is_numeric($did))//Invalid Decive id
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
	if (!is_numeric($mid))//Invalid manufacturer id
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
	else
	{
		$sql="Select * From `serials` Where 1 ";
		$d; $m;
		
		if($did!="0")
		{
			$sql.="AND `device_id`='$did' ";
		}
		if($mid!="0")
		{
			$sql.="AND `manufacturer_id`='$mid' ";
		}
		if(!empty($sn))
		{
			$sql.="AND `serial_number`='$sn' ";
		}
		if($status!="inactive")
		{
			$sql.="AND `status`='active' ";
		}
		$sql.="LIMIT 1000";
		
		$rst=$dblink->query($sql) or
             die(q_error("<p>Something went wrong with $sql1<br>".$dblink->error));
		
		if($rst->num_rows>0)
		{
			$s_rst=array();
			while ($data=$rst->fetch_array(MYSQLI_ASSOC)){
				$d=$dblink->query("Select `name` from devices where `auto_id`='".$data["device_id"]."'")->fetch_array(MYSQLI_ASSOC);
				$m=$dblink->query("Select `name` from manufacturers where `auto_id`='".$data["manufacturer_id"]."'")->fetch_array(MYSQLI_ASSOC);
				
				if (!empty($d)) $data["device_id"]=$d["name"];
				if (!empty($m)) $data["manufacturer_id"]=$m["name"];
				array_push($s_rst, $data);
			}
			
			
			header('Content-Type: application/json');
			header('HTTP/1.1 200 OK');
			$jsonRst=json_encode($s_rst);
			$output[]='Status: Success';
			$output[]='MSG: ' . $jsonRst;
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
			$output[]='MSG: No Equipment Found.';
			$output[]='Action: none';
			$responseData=json_encode($output);
			echo $responseData;
			die();
		}
	}
?>