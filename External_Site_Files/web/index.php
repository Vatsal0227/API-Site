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
          <div class="container">
               <div class="row">
                   <?php
                    if (isset($_REQUEST['msg']))
                    {
						if ($_REQUEST['msg']=="EquipmentAdded")
                        	echo '<div class="alert alert-success" role="alert">Equipment successfully added.</div>';
						if ($_REQUEST['msg']=="EquipmentModified")
							echo '<div class="alert alert-success" role="alert">Equipment successfully Modified.</div>';
                    }
                    ?>
                        
                    <div class="col-md-4 col-sm-4">
                         <div class="feature-thumb">
                              <h3>Search Equipment</h3>
                              <p>Click here to search an equipment</p>
                              <a href="../web/search.php" class="btn btn-default smoothScroll">Discover more</a>
                         </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                         <div class="feature-thumb">
                              <h3>Add Equipment</h3>
                              <p>Click here to add a new equipment</p>
                             <a href="../web/add.php" class="btn btn-default smoothScroll">Discover more</a>
                         </div>
                    </div>
				    <div class="col-md-4 col-sm-4">
                         <div class="feature-thumb">
                              <h3>Modify Equipment</h3>
                              <p>Click here to modify a equipment</p>
                             <a href="../web/modify.php" class="btn btn-default smoothScroll">Discover more</a>
                         </div>
                    </div>
               </div>
          </div>
     </section>
</body>
</html>