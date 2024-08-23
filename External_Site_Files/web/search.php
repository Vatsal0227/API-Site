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
                    <a href="#" class="navbar-brand">Search Equipment Database</a>
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
                              <p>Click here to modify a equipment</p>
                             <a href="modify.php" class="btn btn-default smoothScroll">Discover more</a>
                         </div>
                    </div>
               </div>
          </div> -->
          <div class="container">
               <div class="row" style="margin-bottom: 15px">
			   <?php
					include("../functions.php");

					$d_result_arr=api_call("list_devices");
					$tmp=explode(": ", $d_result_arr[1]);
					$devices=json_decode($tmp[1]);


					$m_result_arr=api_call("list_manufacturers");
					$tmp=explode(": ", $m_result_arr[1]);
					$manufacturers=json_decode($tmp[1]);				   	
			  	?>
				   <form method="post" action="">
                    <div class="form-group">
                        <label for="exampleDevice">Device:</label>
                        <select class="form-control" name="device">
                            <?php
								echo '<option value="0">All</option>';
                                foreach($devices as $key=>$value)
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleManufacturer">Manufacturer:</label>
                        <select class="form-control" name="manufacturer">
                            <?php
								echo '<option value="0">All</option>';
                                foreach($manufacturers as $key=>$value)
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSerial">Serial Number:</label>
                        <input type="text" class="form-control" id="serialInput" name="serialnumber">
						
                    </div >
					<div class="form-group">
					   	<input type="checkbox" style="transform: scale(1.5); padding-right: 10px" id="showInactive" name="showInactive" value="yes">
						<span style="font-size: 110%; display: inline-flex; padding-left: 5px">Show Inactive</span>
					</div>
                        <button type="submit" class="btn btn-primary" name="submit" value="submit">Search</button>
                   </form>  
               </div>
			  	<?php
				   if(isset($_REQUEST['msg']) && $_REQUEST['msg']=="NoEquipmentFound") 
				   {
						echo '<div class="alert alert-danger" role="alert">No Equipment Found!</div>';
				   }
				?>
               </div>
          </div>
     </section>
</body>
</html>
<?php
	if(isset($_POST['submit']))
	{
		$did=$_POST['device'];
        $mid=$_POST['manufacturer'];
        $sn=trim($_POST['serialnumber']);
		$data="did=$did&mid=$mid&sn=$sn";
		
		if(isset($_POST['showInactive']))
			$data.="&status=inactive";
		
		$s_rst=api_call("search_equipment", $data);
		
		$tmp=explode(": ", $s_rst[0])[1];
		
		if($tmp=="ERROR")
			redirect("search.php?msg=NoEquipmentFound");
		else
		{
			$s_rst=json_decode(explode(": ", $s_rst[1])[1]);	
			echo '<div class="container">';
			echo '<table class="table" border="1">';
			echo "<tr><th>Device Type</th><th>Manufacturer</th><th>Serial Number</th><th>Status</th></tr>";
			foreach($s_rst as $data)
				echo "<tr><td>".htmlspecialchars($data->device_id)."</td><td>".htmlspecialchars($data->manufacturer_id)."</td><td>".htmlspecialchars($data->serial_number)."</td><td>".htmlspecialchars($data->status)."</td></tr>";
			echo "</table>";
			echo '</div>';
		}
	}
?>