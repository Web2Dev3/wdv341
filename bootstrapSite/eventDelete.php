<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}		
	//Setup the variables used by the page
		//field data
		$prod_name = "";
		$prod_description = "";
		$prod_price = "";
		$prod_date = "";
		$prod_image = "";
		$prod_special = "";
		$prod_inventory = "";
		$prod_tax = "";
		$prod_shipping = "";
		$prod_seller = "";
		$prod_category = "";

		

		
		$todaysDate = date("Y-m-d");		//use today's date as the default input to the date( )
		
		//The form needs to display the fields of the selected record
		$updateRecID = $_GET['recId'];	//Record Id to be updated
		//$updateRecId = 2;				//Hard code a key for testing purposes	
			
			try {
				
				require 'connectPDO.php';	//CONNECT to the database
				
				//Create the SQL command string
				$sql = "DELETE FROM wdv341_final WHERE id='$updateRecID'";
				
				//PREPARE the SQL statement
				$stmt = $conn->prepare($sql);
				
				//EXECUTE the prepared statement
				$stmt->execute();	
				
				$message = "The Product has been Deleted.";
			}
			
			catch(PDOException $e)
			{
				$message = "There has been a problem. The system administrator has been contacted. Please try again later.";
	
				error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
				error_log(var_dump(debug_backtrace()));
			
				//Clean up any variables or connections that have been left hanging by this error.		
			
				header('Location: 505_error_response_page.php');	//sends control to a User friendly page					
			}

		
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Presenting Information Technology</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  

<link rel="stylesheet" type="text/css" href="css/boot-site.css">
<link rel="stylesheet" type="text/css" href="scss/boot-site.scss">
<link rel="stylesheet" type="text/css" href="scss/boot-site2.scss">
<link rel="stylesheet" type="text/css" href="scss/boot-site.css">
<link rel="stylesheet" type="text/css" href="scss/boot-site2.css">

<link href="https://fonts.googleapis.com/css?family=Lobster+Two&display=swap" rel="stylesheet">
  	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>    

	

</head>

<body>

<div id="container-fluid">
<div class="row">
<div class="col-sm-12" style="background-color:#34590A;">
<nav class=" navbar navbar-expand-lg navbar-dark">
 <div class="d-none d-md-block">
	<a style="font-weight:bold;" class="navbar-brand" href="#">
	<img  style="max-width: 60px; max-height: 100px; border: none;"  src="images/urban-logo.png" alt="logo for company" width="45" class="img-responsive">Urban Gardens Admin
	</a>
	</div>
  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar2">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="welcome.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="inputForm.php">Add Products</a>
      </li> 
        <li class="nav-item">
        <a class="nav-link" href="listevents.php">Edit Products</a>
      </li> 
 
    </ul>
    </div>
        <div class="d-flex ml-auto">
                    <form class="form-inline">
      <input class="form-control ml-sm-5" type="search" placeholder="Search" aria-label="Search">
    </form>
    <i class="fa fa-search" style="font-size: 2.13em; color: green; margin-left: 10px;"></i>
    </div>
    
  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".collapse" aria-controls="collapsibleNavbar collapsibleNavbar2">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>
</div>
<div class="col-lg-12">
	<header>
    	<h1>Urban Gardens</h1>
    </header>
    
    <main>
    
        <h1>Delete a Product</h1>
      <h1><?php echo $message ?></h1>
        
	</main>
</div>
 <div class="col-lg-12" style="color:white; background-image: linear-gradient(to bottom left, #128A42, #00621C);">    
	<footer>
    	<p>Copyright &copy; <script> var d = new Date(); document.write (d.getFullYear());</script> All Rights Reserved</p>
    
    </footer>
</div>

</div>
</div>
</body>
</html>