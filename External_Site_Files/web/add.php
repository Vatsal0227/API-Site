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
                    <a href="#" class="navbar-brand">Add New Equipment</a>
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
                              <p>Click here to a add new equipment</p>
                             <a href="add.php" class="btn btn-default smoothScroll">Discover more</a>
                         </div>
                    </div>
				    <div class="col-md-4 col-sm-4">
                         <div class="feature-thumb">
                              <h3>Modify Equipment</h3>
                              <p>Click here to modify a equipment</p>
                             <a href="modify.php" class="btn btn-default smoothScroll">Discover more</a>
                         </div>
                    </div>
               </div> 
          </div> -->
          <div class="container">
			  <!-- ADD EQUIPMENT -->
               <div class="row" style="margin-top: 0px">
                    <form method="post" action="">
                    <div class="form-group">
						
						<?php 
							include("../functions.php");
						
							if (isset($_REQUEST['msg']))
                        	{
								if($_REQUEST['msg']=="EquipmentExists")
									echo '<div class="alert alert-danger" role="alert">Serial Number already exists in database!</div>';
								if($_REQUEST['msg']=="ErrorAddingEquipment")
									echo '<div class="alert alert-danger" role="alert">Error Adding Equipment!</div>';
								if($_REQUEST['msg']=="SerialNumberBlank")
									echo '<div class="alert alert-danger" role="alert">Serial Number Cannot Be Blank!!</div>';
								else;
                        	}	
						
							$d_result_arr=api_call("list_devices");
							$tmp=explode(": ", $d_result_arr[1]);
							$devices=json_decode($tmp[1]);

							$m_result_arr=api_call("list_manufacturers");
							$tmp=explode(": ", $m_result_arr[1]);
							$manufacturers=json_decode($tmp[1]);
						?>
						
                        <label for="exampleDevice">Device:</label>
                        <select class="form-control" name="device">
                            <?php
                                foreach($devices as $key=>$value)
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleManufacturer">Manufacturer:</label>
                        <select class="form-control" name="manufacturer">
                            <?php
                                foreach($manufacturers as $key=>$value)
                                    echo '<option value="'.$key.'">'.$value.'</option>';//
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSerial">Serial Number:</label>
                        <input type="text" class="form-control" id="serialInput" name="serialnumber">
                    </div>
                        <button type="submit" class="btn btn-primary" name="submit" value="submit">Add Equipment</button>
                   </form>
               </div>
			  
			  <!-- ADD DEVICES -->
			  <?php
     
			  ?>
			  <div class="row" style="margin-top: 50px">
			  	<form method="post" action="">
					<div class="form-group">
						<?php 
							if(isset($_REQUEST['msg']))
							{
								if($_REQUEST['msg']=="DeviceNameEmpty")
									echo '<div class="alert alert-danger" role="alert">Device Name Cannot Be Blank!</div>';
								if($_REQUEST['msg']=="DeviceExists")
									echo '<div class="alert alert-danger" role="alert">Similar Device Already Exists!</div>';
								if($_REQUEST['msg']=="ErrorAddingDevice")
									echo '<div class="alert alert-danger" role="alert">Error Adding Device!</div>';
								if($_REQUEST['msg']=="DeviceAdded")
									echo '<div class="alert alert-success" role="alert">Device successfully added.</div>';
								else;
							}
						?>
						<label for="exampleDevice">Enter New Device:</label>
						<input type="text" class="form-control" id="deviceInput" name="newdevice">
					</div>
					<button type="submit" class="btn btn-primary" name="dSubmit" value="dSubmit">Add Device</button>
				</form>
			  </div>
			  
			  <!-- ADD MANUFACTURER -->
			  <?php

			  ?>
			  <div class="row" style="margin-top: 50px">
				<form method="post" action="">
					<div class="form-group">
						<?php 
							if(isset($_REQUEST['msg']))
							{
								if($_REQUEST['msg']=="ManufacturerNameEmpty")
									echo '<div class="alert alert-danger" role="alert">Manufacturer Name Cannot Be Blank!</div>';
								if($_REQUEST['msg']=="ManufacturerExists")
									echo '<div class="alert alert-danger" role="alert">Similar Manufacturer Already Exists!</div>';
								if($_REQUEST['msg']=="ErrorAddingManufacturer")
									echo '<div class="alert alert-danger" role="alert">Error Adding Manufacturer!</div>';
								if($_REQUEST['msg']=="ManufacturerAdded")
									echo '<div class="alert alert-success" role="alert">Manufacturer successfully added.</div>';
								else;
							}
						?>
						<label for="exampleDevice">Enter New Manufacturer:</label>
						<input type="text" class="form-control" id="manufacturerInput" name="newmanufacturer">
					</div>
					<button type="submit" class="btn btn-primary" name="mSubmit" value="mSubmit">Add Manufacturer</button>
				</form>  			  
			  </div>
          </div>
     </section>
</body>
</html>
<?php
    if (isset($_POST['submit']))
    {
        $did=$_POST['device'];
        $mid=$_POST['manufacturer'];
        $sn=trim($_POST['serialnumber']);
		if(empty($sn))
			redirect("add.php?msg=SerialNumberBlank");
		
		$sn_rst=api_call("query_serial_number", "sn=$sn");
		$tmp=explode(": ", $sn_rst[0])[1];
		if($tmp=="Success")
			redirect("add.php?msg=EquipmentExists");

		$add_rst=api_call("add_equipment", "did=$did&mid=$mid&sn=$sn");
		$tmp=explode(": ", $add_rst[0])[1];
		if($tmp=="Success") 
			redirect("index.php?msg=EquipmentAdded");
		else
			redirect("add.php?msg=ErrorAddingEquipment");

    }

	if (isset($_POST['dSubmit']))
	{
		if(empty($_POST['newdevice']))
		{
			redirect("add.php?msg=DeviceNameEmpty");
		}
		$dName=$_POST['newdevice'];
		$dName=addslashes($dName);

		$d_rst=api_call("query_device", "dName=$dName");
		$tmp=explode(": ", $d_rst[0])[1];
		if($tmp=="Success")
			redirect("add.php?msg=DeviceExists");
		
		$add_rst=api_call("add_device", "dName=$dName");
		$tmp=explode(": ", $add_rst[0])[1];
		if($tmp=="Success")
			redirect("add.php?msg=DeviceAdded");
		else
			redirect("add.php?msg=ErrorAddingDevice");
	}

	if (isset($_POST['mSubmit']))
	{
		if (empty($_POST['newmanufacturer']))
		{
			redirect("add.php?msg=ManufacturerNameEmpty");
		}
		$mName=$_POST['newmanufacturer'];
		$mName=addslashes($mName);
		
		$m_rst=api_call("query_manufacturer", "mName=$mName");
		$tmp=explode(": ", $m_rst[0])[1];
		if($tmp=="Success")
			redirect("add.php?msg=ManufacturerExists");

		$add_rst=api_call("add_manufacturer", "mName=$mName");
		$tmp=explode(": ", $add_rst[0])[1];
		if($tmp=="Success")
			redirect("add.php?msg=ManufacturerAdded");
		else
			redirect("add.php?msg=ErrorAddingManufacturer");
	}
?>