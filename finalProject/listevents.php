<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

	try {
	  
	  require 'connectPDO.php';	//CONNECT to the database
	  
	  //mysql DATE stores data in a YYYY-MM-DD format
	  $todaysDate = date("Y-m-d");		//use today's date as the default input to the date( )
	  
	  //Create the SQL command string
	  $sql = "SELECT ";
	  $sql .= "id, ";
	  $sql .= "product_name, ";
	  $sql .= "product_description, ";
	  $sql .= "product_price, ";
	  $sql .= "product_image, ";
	  $sql .= "product_inventory, ";
	  $sql .= "product_tax, ";
	  $sql .= "product_shipping, ";
	  $sql .= "product_special, ";
	  $sql .= "product_seller, ";
	  $sql .= "product_category, ";
	  $sql .= "date_created ";	  	   //Last column does NOT have a comma after it.
	  $sql .= "FROM wdv341_final";
	  
	  //PREPARE the SQL statement
	  $stmt = $conn->prepare($sql);
	  
	  //EXECUTE the prepared statement
	  $stmt->execute();		
	  
	  //RESULT object contains an associative array
	  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	  
  }
  
  catch(PDOException $e)
  {
	  $message = "There has been a problem. The system administrator has been contacted. Please try again later.";

	  error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
	  error_log($e->getLine());
	  error_log(var_dump(debug_backtrace()));
  
	  //Clean up any variables or connections that have been left hanging by this error.		
  
	  header('Location: 505_error_response_page.php');	//sends control to a User friendly page
	  
	  $to = "kohlersavanna5@gmail.com";
	  $subject = "Display Product Form";
	  $body = "There has been an error with the display products form.";
		
	  $headers = "From: contact@savannakohler.com";
		
	  mail($to, $subject, $body, $headers);								
  }

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Presenting Information Technology</title>

 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 
 <link rel="stylesheet" type="text/css" href="css/boot-site.css">
<link rel="stylesheet" type="text/css" href="scss/boot-site.scss">
<link rel="stylesheet" type="text/css" href="scss/boot-site2.scss">
<link rel="stylesheet" type="text/css" href="scss/boot-site.css">
<link rel="stylesheet" type="text/css" href="scss/boot-site2.css">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  

<link href="https://fonts.googleapis.com/css?family=Lobster+Two&display=swap" rel="stylesheet">
<style>
span {
color: white;
font-weight: bold;
text-shadow: 2px 2px black;
}

button, input {
background-color: green;
color: white;
}

button:hover, input:hover {
background-color: white;
color: green;
}
</style>
</head>

<body>

<div id="container-fluid">
<div class="row">
<div class="col-sm-12" style="background-color:#34590A;">
<a style="font-weight:bold; color:white;" class="navbar-brand" href="welcome.php">
	<img  style="max-width: 70px; max-height: 80px; border: none;"  src="images/urban-logo.png" alt="logo for company" width="45" class="img-responsive">Urban Gardens Admin
	</a>
   <div class="d-none d-md-block">
<nav class=" navbar navbar-expand-lg navbar-dark">
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
</div>
<div class="col-lg-12" style="background-color:#34590A;">
	<header>
    	<h1>Products</h1>
    </header>  
    </div>
    <div class="col-lg-12" style="background-image: url(images/nature-scene.jpg);height:70vh;min-height:20px; background-size:cover;background-repeat: no-repeat;"></div> 
<div class="col-lg-12" style="background-color:#34590A;">
        <h1>Display Available Products</h1>
  </div>      
        <?php 
			while( $row=$stmt->fetch(PDO::FETCH_ASSOC)) {
		?>		
			<div class="col-md-4" style="background-color:#34590A; margin: 20px;">
				<div class="eventBlock">
					<div>
						<span id="eventTitle"><?php echo $row['product_name']; ?></span>
					</div>
					<div class="productImage">
                				<image style="min-width:300px;" src="images/<?php echo $row['product_image'];?>">	
					</div>
					<div>
						<span id="eventImg"><?php echo $row['product_image']; ?></span>
					</div>
					<div>
						<span id="eventPrice"><?php echo $row['product_price']; ?></span>
					</div>
					<div>
						<span id="eventDescription"><?php echo $row['product_description']; ?></span>
					</div> 
					<div>
						<span id="eventInventory"><?php echo $row['product_inventory']; ?></span>
					</div>
					<div>
						<span id="eventTax"><?php echo $row['product_tax']; ?></span>
					</div> 
					<div>
						<span id="eventShip"><?php echo $row['product_shipping']; ?></span>
					</div>
					<div>
						<span id="eventSell"><?php echo $row['product_seller']; ?></span>
					</div>
					<div>
						<span id="eventCat"><?php echo $row['product_category']; ?></span>
					</div>
					<div>
						<span id="eventSpec"><?php echo $row['product_special']; ?></span>
					</div>                  
					<div>
                        <div class="col-1-2">
                        	<span id="eventAddress">Dates: <?php echo $row['date_created']; ?></span>
                        </div>
					</div>
                    <div><br>
                    	<?php $event_id=$row['id'];	//put event_id into a variable for further processing  ?>
                    	<a href='updateEvent.php?recId=<?php echo $event_id; ?>'><button>Update</button></a>
                        <a href='eventDelete.php?recId=<?php echo $event_id; ?>'><input type="button" value="Delete"></a>
                    </div>                
				</div><!-- Close Event Block -->
				</div>
        <?php
			}
		?>	
  	
  <div class="col-lg-12" style="color:white; background-image: linear-gradient(to bottom left, #128A42, #00621C);">
      
  
	<footer>
    	<p>Copyright &copy; <script> var d = new Date(); document.write (d.getFullYear());</script> All Rights Reserved</p>
    
    </footer>
</div>


</div>
</div>
</body>
</html>