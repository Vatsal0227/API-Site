<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Advanced Software Engineering</title>
<link href="../assets/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
<link rel="stylesheet" href="../assets/css/owl.carousel.css">
<link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="../assets/css/templatemo-style.css">
</head>
<body>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">
     <!-- MENU -->
     <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
          <div class="container">
               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
						 <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <a href="#" class="navbar-brand">AES Inventory Database</a>
               </div>
               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first">
                         <li><a href="../web/index.php" class="smoothScroll">Home</a></li>
                         <li><a href="../web/search.php" class="smoothScroll">Search Equipment</a></li>
                         <li><a href="../web/add.php" class="smoothScroll">Add Equipment</a></li>
						<li><a href="../web/modify.php" class="smoothScroll">Modify Equipment</a></li>
                    </ul>
               </div>
          </div>
     </section>
 <!-- HOME -->
     <section id="home">
          </div>
     </section>
     <!-- FEATURE -->
     <section id="feature">
          <!-- <div class="container">
               <div class="row">
                    <div class="col-md-4 col-sm-4">
                         <div class="feature-thumb">
                              <h3>Search Equipment</h3>
                              <p>Click here to search an equipment</p>
                              <a href="search.php" class="btn btn-default smoothScroll">Discover more</a>
                         </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                         <div class="feature-thumb">
                              <h3>Add Equipment</h3>
                              <p>Click here to add a new equipment</p>
                             <a href="add.php" class="btn btn-default smoothScroll">Discover more</a>
                         </div>
                    </div>
				    <div class="col-md-4 col-sm-4">
                         <div class="feature-thumb">
                              <h3>Modify Equipment</h3>
                              <p>Click here to modify an equipment</p>
                             <a href="modify.php" class="btn btn-default smoothScroll">Discover more</a>
                         </div>
                    </div>
               </div>
          </div> -->
		 
		 <!-- Equipment -->
		  <div class="container">
               <div class="row" style="margin-top: 0px">
				   <form method="post" action="">
					<?php
					   	include("../functions.php");
					   	if (isset($_REQUEST['msg']))
                        {
							if ($_REQUEST['msg']=="SerialNumEmpty")
							{
								echo '<div class="alert alert-danger" role="alert">Serial Number cannot be Blank!</div>';
							}
							if ($_REQUEST['msg']=="EquipmentNotFound")
							{
								echo '<div class="alert alert-danger" role="alert">Equipment Not Found!</div>';
							}
							if ($_REQUEST['msg']=="NewSerialNumberBlank")
							{
								echo '<div class="alert alert-danger" role="alert">New Serial Number Cannot be Blank!</div>';
							}
							else;
                        }
					?>
                    <div class="form-group">
                        <label for="exampleSerial">Enter the Serial Number to Modify Equipment:</label>
                        <input type="text" class="form-control" id="serialInput" name="serialnumber">
                    </div>
                        <button type="submit" class="btn btn-primary" name="submit" value="submit">Search</button>
                   </form>
               	</div>
     	   </div>
<?php
	if (isset($_POST['modifyE']))
	{
		$did=$_POST['device'];
		$mid=$_POST['manufacturer'];
		$sn=trim($_POST['serialnumber']);
		$osn=trim($_POST['oldSerialNumber']);
		$status=$_POST['status'];
		
		if(empty($sn))
			redirect("modify.php?msg=NewSerialNumberBlank");
		
		$me_rst=api_call("modify_equipment", "did=$did&mid=$mid&osn=$osn&status=$status&sn=$sn");
		$tmp=explode(": ", $me_rst[0])[1];
		if($tmp=="Success") 
			redirect("index.php?msg=EquipmentModified");
		else
			redirect("modify.php?msg=ErrorModifyingingEquipment");
	}
	if (isset($_POST['submit']))
    {
		if (empty($_POST['serialnumber']))
		{
			redirect("modify.php?msg=SerialNumEmpty");
		}
        $sn=trim($_POST['serialnumber']);
		
		
		$qsn_rst=api_call("query_serial_number", "sn=$sn");
		$tmp=explode(": ", $qsn_rst[0])[1];
		if($tmp=="ERROR")
			redirect("modify.php?msg=EquipmentNotFound");
		
		$tmp=json_decode(explode(": ", $qsn_rst[1])[1]);
		$dKey=$tmp->device_id;
		$mKey=$tmp->manufacturer_id;
		$status=$tmp->status;
		
		$d_result_arr=api_call("list_devices");
		$tmp=explode(": ", $d_result_arr[1]);
		$devices=json_decode($tmp[1]);

		$m_result_arr=api_call("list_manufacturers");
		$tmp=explode(": ", $m_result_arr[1]);
		$manufacturers=json_decode($tmp[1]);
		
		echo '<div class="container">
				<div class="row" style="margin-top: 15px">
					<form method="post" action="">
						<div class="form-group">
							<label for="exampleDevice">Device:</label>
							<select class="form-control" name="device">';
							foreach($devices as $key=>$value)
							{
								if ($key==$dKey)
									echo '<option value="'.$key.'" selected>'.$value.'</option>';
								else
									echo '<option value="'.$key.'">'.$value.'</option>';
							}

						echo'</select>
						</div>
						<div class=\"form-group\">
							<label for="exampleManufacturer">Manufacturer:</label>
							<select class="form-control" name="manufacturer">';
							foreach($manufacturers as $key=>$value)
							{
								if ($key==$mKey)
									echo '<option value="'.$key.'" selected>'.$value.'</option>';
								else
									echo '<option value="'.$key.'">'.$value.'</option>';
							}
								
							echo'</select>
						</div>
						<div class="form-group">
							<label for="exampleSerial">Serial Number:</label>
							<input type="hidden" name="oldSerialNumber" value="'.$sn.'">
							<input type="text" class="form-control" id="serialInput" name="serialnumber" value="'.$sn.'">
						</div>
						<div class="form-group">
							<label for="exampleSerial">Equipment Status:</label>
							<select class="form-control" name="status">';
								if($status=="active")
								{
									echo '<option value="'.$status.'" selected>'.$status.'</option>';
									echo '<option value="inactive">inactive</option>';
								}
								else
								{
									echo '<option value="'.$status.'" selected>'.$status.'</option>';
									echo '<option value="active">active</option>';
								}
								
					  echo '</select>
						</div>
						<button type="submit" class="btn btn-primary" name="modifyE" value="modifyE">Modify Equipment</button>
					</form>
				</div>
			</div>';
    }
?>
		 <!-- Device -->
		 <div class="container" style="padding-top: 100px">
		 	<div class="row" style="margin-top: 25px">
				<?php
					if(isset($_REQUEST['msg']))
					{
						if($_REQUEST['msg']=="ErrorSelectingDevice")
							echo '<div class="alert alert-danger" role="alert">Error Selecting Device!</div>';
							
						if($_REQUEST['msg']=="ErrorModifyingingDevice")
							echo '<div class="alert alert-danger" role="alert">Error Modifying Device!</div>';
						
						if($_REQUEST['msg']=="NewDeviceNameBlank")
							echo '<div class="alert alert-danger" role="alert">New Device Name Cannot be Blank!</div>';
							
						if($_REQUEST['msg']=="DeviceModified")
							echo '<div class="alert alert-success" role="alert">Device successfully Modified.</div>';
					}
				
					$dKey;
					if(isset($_POST['dSubmit']))
						$dKey=$_POST['device'];
					$d_result_arr=api_call("list_devices", "status=inactive");
					$tmp=explode(": ", $d_result_arr[1]);
					$devices=json_decode($tmp[1]);
				?>
				<form method="post" action="">
					<div class="form-group">
						<label for="exampleDevice">Select a Device to Modify:</label>
                        <select class="form-control" name="device">
                            <?php
                                foreach($devices as $key=>$value)
									if(!empty($dKey) && $dKey==$key)
										echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                    else
										echo '<option value="'.$key.'">'.$value.'</option>';
                            ?>
                        </select>
					</div>
					<button type="submit" class="btn btn-primary" name="dSubmit" value="dSubmit">Select</button>	
				</form>
			</div>
		 </div>
		 <?php
		 	if(isset($_POST['modifyD']))
			{
				$did=$_POST['did'];
				$dName=$_POST['dName'];
				$status=$_POST['status'];
				if(empty($dName))
					redirect("modify.php?msg=NewDeviceNameBlank");
				
				$md_rst=api_call("modify_device", "did=$did&dName=$dName&status=$status");
				$tmp=explode(": ", $md_rst[0])[1];
				if($tmp=="Success") 
					redirect("modify.php?msg=DeviceModified");
				else
					redirect("modify.php?msg=ErrorModifyingingDevice");
			}
		 
		 	if(isset($_POST['dSubmit']))
			{
				$did=$_POST['device'];
				$q_rst=api_call("query_device", "did=$did");
				$tmp=explode(": ", $q_rst[0])[1];
				if($tmp=="ERROR")
					redirect("modify.php?msg=ErrorSelectingDevice");
		
				$device=json_decode(explode(": ", $q_rst[1])[1]);
				$did=$device->auto_id;
				$dName=$device->name;
				$status=$device->status;
				
		  echo '<div class="container" style="padding-top: 25px">
					<div class="row">
						<form method="post" action="">
							<input type="hidden" name="did" value="'.$did.'">
							<div class="form-group">
								<label for="exampleSerial">Device Name:</label>
								<input type="text" class="form-control" id="dName" name="dName" value="'.$dName.'">
							</div>
							<div class="form-group">
								<label for="exampleSerial">Device Status:</label>
								<select class="form-control" name="status">';
									if($status=="active")
									{
										echo '<option value="'.$status.'" selected>'.$status.'</option>';
										echo '<option value="inactive">inactive</option>';
									}
									else
									{
										echo '<option value="'.$status.'" selected>'.$status.'</option>';
										echo '<option value="active">active</option>';
									}

						  echo '</select>
							</div>
							<button type="submit" class="btn btn-primary" name="modifyD" value="modifyD">Modify Device</button>
						</form>';
			}
		 ?>
		 
		 	<!-- Manufacturer -->
		 	<div class="container" style="padding-top: 100px">
		 	<div class="row" style="margin-top: 25px">
				<?php
					if(isset($_REQUEST['msg']))
					{
						if($_REQUEST['msg']=="ErrorSelectingManufacturer")
							echo '<div class="alert alert-danger" role="alert">Error Selecting Manufacturer!</div>';
							
						if($_REQUEST['msg']=="ErrorModifyingingManufacturer")
							echo '<div class="alert alert-danger" role="alert">Error Modifying Manufacturer!</div>';
						
						if($_REQUEST['msg']=="NewManufacturerNameBlank")
							echo '<div class="alert alert-danger" role="alert">New Manufacturer Name Cannot be Blank!</div>';
							
						if($_REQUEST['msg']=="ManufacturerModified")
							echo '<div class="alert alert-success" role="alert">Manufacturer successfully Modified.</div>';
					}
				
					$mKey;
					if(isset($_POST['mSubmit']))
						$mKey=$_POST['manufacturer'];
					$m_result_arr=api_call("list_manufacturers", "status=inactive");
					$tmp=explode(": ", $m_result_arr[1]);
					$manufacturers=json_decode($tmp[1]);
				?>
				<form method="post" action="">
					<div class="form-group">
						<label for="exampleDevice">Select a Manufacturer to Modify:</label>
                        <select class="form-control" name="manufacturer">
                            <?php
                                foreach($manufacturers as $key=>$value)
									if(!empty($mKey) && $mKey==$key)
										echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                    else
										echo '<option value="'.$key.'">'.$value.'</option>';
                            ?>
                        </select>
					</div>
					<button type="submit" class="btn btn-primary" name="mSubmit" value="mSubmit">Select</button>	
				</form>
			</div>
		 </div>
		 <?php
		 	if(isset($_POST['modifyM']))
			{
				$mid=$_POST['mid'];
				$mName=$_POST['mName'];
				$status=$_POST['status'];
				if(empty($mName))
					redirect("modify.php?msg=NewManufacturerNameBlank");
				
				$mm_rst=api_call("modify_manufacturer", "mid=$mid&mName=$mName&status=$status");
				$tmp=explode(": ", $mm_rst[0])[1];
				if($tmp=="Success") 
					redirect("modify.php?msg=ManufacturerModified");
				else
					redirect("modify.php?msg=ErrorModifyingingManufacturer");
			}
		 
		 	if(isset($_POST['mSubmit']))
			{
				$mid=$_POST['manufacturer'];
				$q_rst=api_call("query_manufacturer", "mid=$mid");
				$tmp=explode(": ", $q_rst[0])[1];
				if($tmp=="ERROR")
					redirect("modify.php?msg=ErrorSelectingManufacturer");
		
				$manufacturer=json_decode(explode(": ", $q_rst[1])[1]);
				$mid=$manufacturer->auto_id;
				$mName=$manufacturer->name;
				$status=$manufacturer->status;
				
		  echo '<div class="container" style="padding-top: 25px">
					<div class="row">
						<form method="post" action="">
							<input type="hidden" name="mid" value="'.$mid.'">
							<div class="form-group">
								<label for="exampleSerial">Manufacturer Name:</label>
								<input type="text" class="form-control" id="mName" name="mName" value="'.$mName.'">
							</div>
							<div class="form-group">
								<label for="exampleSerial">Manufacturer Status:</label>
								<select class="form-control" name="status">';
									if($status=="active")
									{
										echo '<option value="'.$status.'" selected>'.$status.'</option>';
										echo '<option value="inactive">inactive</option>';
									}
									else
									{
										echo '<option value="'.$status.'" selected>'.$status.'</option>';
										echo '<option value="active">active</option>';
									}

						  echo '</select>
							</div>
							<button type="submit" class="btn btn-primary" name="modifyM" value="modifyM">Modify Manufacturer</button>
						</form>';
			}
		 ?>
		 
		 
		 
		 
		 
		 
		 
     </section>
</body>
</html>



