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
		//error messages
		$eventNameErrMsg = "";
		$eventDescErrMsg = "";
		$priceErrMsg = "";
		$dateErrMsg = "";
		$imgErrMsg = "";
		$taxErrMsg = "";
		$shipErrMsg = "";
		$inventoryErrMsg = "";
		$sellerErrMsg = "";
		$categoryErrMsg = "";

				
		$validForm = false;
				
	if(isset($_POST["button"]))
	{	
		//The form has been submitted and needs to be processed
		if(isset($_POST["test_name"])) {
			header('Location: https://www.google.com');
		}
		
		//Validate the form data here!
	
		//Get the name value pairs from the $_POST variable into PHP variables
		//This example uses PHP variables with the same name as the name atribute from the HTML form
		$prod_name = $_POST['eventName'];
		$prod_description = $_POST['eventDesc'];
		$prod_price = $_POST['price'];
		$prod_date = $_POST['date'];
		$prod_image = $_POST['img'];
		$prod_inventory = $_POST['number'];
		$prod_tax = $_POST['tax'];
		$prod_shipping = $_POST['ship'];
		$prod_special = $_POST['spec'];
		$prod_seller = $_POST['sell'];
		$prod_category = $_POST['cat'];
		

		/*	FORM VALIDATION PLAN
		
			FIELD NAME		VALIDATION TESTS & VALID RESPONSES
			First Name		Required Field		May not be empty
			Last Name		Required Field		May not be empty
			
			City			Optional
			State			Optional
			
			Zip Code		Required Field		Format and Numeric 
			Email			Required Field		Format
		*/
		
		//VALIDATION FUNCTIONS		Use functions to contain the code for the field validations.  
			function validateFirstName($inName)
			{
				global $validForm, $eventNameErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$eventNameErrMsg = "";
				
				if($inName == "" || !preg_match('/^[a-zA-Z0-9 \-_]*$/', $inName))
				{
					$validForm = false;
					$eventNameErrMsg = "Event Name cannot be spaces or special characters";
				}
				else {
				if (strlen($inName) > 50)
					{
					$validForm = false;
					$eventNameErrMsg = "Event Name cannot be more than 50 characters."; 
					}
				}
			}//end validateName()

			function validateLastName($inName)
			{
				global $validForm, $eventDescErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$eventDescErrMsg = "";
				
				if($inName == "" || !preg_match('/^[a-zA-Z0-9 \-_]*$/', $inName))
				{
					$validForm = false;
					$eventDescErrMsg = "Description cannot be spaces or special characters";
				}
				else {
				if (strlen($inName) > 200)
					{
					$validForm = false;
					$eventDescErrMsg = "Description cannot be more than 200 characters."; 
					}
				}
			}//end validateName()
			
			function validateImg($inName)
			{
				global $validForm, $imgErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$imgErrMsg = "";
				
				if($inName == "")
				{
					$validForm = false;
					$imgErrMsg = "Image cannot be spaces";
				}
				else {
				if (strlen($inName) > 50)
					{
					$validForm = false;
					$imgErrMsg = "Image cannot be more than 50 characters."; 
					}
				}
			}//end validateName()
			
			function validatePres($inName)
			{
				global $validForm, $priceErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$priceErrMsg = "";
				
				if($inName == "")
				{
					$validForm = false;
					$priceErrMsg = "Price cannot be spaces";
				}
				else {
				if (strlen($inName) > 50)
					{
					$validForm = false;
					$priceErrMsg = "Price cannot be more than 50 characters."; 
					}
				}
			}//end validateName()		
		function validateTax($inName)
			{
				global $validForm, $taxErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$taxErrMsg = "";
				
				if($inName == "")
				{
					$validForm = false;
					$taxErrMsg = "Tax cannot be spaces";
				}
				else {
				if (strlen($inName) > 50)
					{
					$validForm = false;
					$taxErrMsg = "Tax cannot be more than 50 characters."; 
					}
				}
			}//end validateName()	
			function validateShip($inName)
			{
				global $validForm, $shipErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$shipErrMsg = "";
				
				if($inName == "")
				{
					$validForm = false;
					$shipErrMsg = "Shipping cannot be spaces";
				}
				else {
				if (strlen($inName) > 50)
					{
					$validForm = false;
					$shipErrMsg = "Shipping cannot be more than 50 characters."; 
					}
				}
			}//end validateName()	
		function validateDate($inName)
			{
				global $validForm, $dateErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$dateErrMsg = "";
				
				if(empty($inName))
				{
					$validForm = false;
					$dateErrMsg = "Date cannot be blank";
				}
			}//end validateName()
			
			function validateInventory($inName)
			{
				global $validForm, $inventoryErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$inventoryErrMsg = "";
				
				if(empty($inName))
				{
					$validForm = false;
					$inventoryErrMsg = "Inventory cannot be blank";
				}
				else {
				if ($inName < 0)
					{
					$validForm = false;
					$inventoryErrMsg = "Inventory cannot be negative."; 
					}
				}
			}//end validateName()
			
			function validateSell($inName)
			{
				global $validForm, $sellerErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$sellerErrMsg = "";
				
				if($inName == "")
				{
					$validForm = false;
					$sellerErrMsg = "Seller cannot be spaces";
				}
				else {
				if (strlen($inName) > 200)
					{
					$validForm = false;
					$sellerErrMsg = "Seller cannot be more than 200 characters."; 
					}
				}
			}//end validateName()

			function validateCat($inName)
			{
				global $validForm, $categoryErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$categoryErrMsg = "";
				
				if($inName == "")
				{
					$validForm = false;
					$categoryErrMsg = "Category cannot be spaces";
				}
				else {
				if (strlen($inName) > 50)
					{
					$validForm = false;
					$categoryErrMsg = "Category cannot be more than 50 characters."; 
					}
				}
			}//end validateName()
		
			
			
		
		//VALIDATE FORM DATA  using functions defined above
		$validForm = true;		//switch for keeping track of any form validation errors
		
		validateFirstName($prod_name);
		validateLastName($prod_description);
		validatePres($prod_price);
		validateImg($prod_image);
		validateTax($prod_tax);
		validateShip($prod_shipping);
		validateDate($prod_date);
		validateInventory($prod_inventory);
		validateSell($prod_seller);
		validateCat($prod_category);
		
		if($validForm)
		{
			$message = "All good";	
			
			try {
				
				require 'connectPDO.php';	//CONNECT to the database
				
				
				//Create the SQL command string
				$sql = "INSERT INTO wdv341_final (";
				$sql .= "product_name, ";
				$sql .= "product_image, ";
				$sql .= "product_price, ";
				$sql .= "product_inventory, ";
				$sql .= "product_description, ";
				$sql .= "product_tax, ";
				$sql .= "product_shipping, ";
				$sql .= "product_special, ";
				$sql .= "product_seller, ";
				$sql .= "product_category, ";
				$sql .= "date_created ";
				$sql .= ") VALUES (:eventName, :img, :price, :inventory, :eventDesc, :tax, :ship, :special, :seller, :category, :date)";
				
				//PREPARE the SQL statement
				$stmt = $conn->prepare($sql);
				
				//BIND the values to the input parameters of the prepared statement
				$stmt->bindParam(':eventName', $prod_name);
				$stmt->bindParam(':eventDesc', $prod_description);		
				$stmt->bindParam(':price', $prod_price);		
				$stmt->bindParam(':date', $prod_date);		
				$stmt->bindParam(':img', $prod_image);
				$stmt->bindParam(':inventory', $prod_inventory);
				$stmt->bindParam(':tax', $prod_tax);
				$stmt->bindParam(':ship', $prod_shipping);
				$stmt->bindParam(':special', $prod_special);
				$stmt->bindParam(':seller', $prod_seller);
				$stmt->bindParam(':category', $prod_category);
				
				//EXECUTE the prepared statement
				$stmt->execute();	
				
				$message = "The Product has been added.";
			}
			
			catch(PDOException $e)
			{
				$message = "There has been a problem. The system administrator has been contacted. Please try again later.";
	
				error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
				error_log(var_dump(debug_backtrace()));
			
				//Clean up any variables or connections that have been left hanging by this error.		
			
				header('Location: 505_error_response_page.php');	//sends control to a User friendly page		
				
				$to = "kohlersavanna5@gmail.com";
				$subject = "Add Product Form";
				$body = "There has been an error with the insert form.";
		
				$headers = "From: contact@savannakohler.com";
		
				mail($to, $subject, $body, $headers);						
			}

		}
		else
		{
			$message = "Something went wrong";
		}//ends check for valid form		

	}
	else
	{
		//Form has not been seen by the user.  display the form
	}// ends if submit 
?>
<?php
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $text= "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    $text= "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  $text= "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  $text= "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $text= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $text= "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $text= "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
  } else {
    $text= "Sorry, there was an error uploading your file.";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - Event Form Example</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  

<link rel="stylesheet" type="text/css" href="css/boot-site.css">
<link rel="stylesheet" type="text/css" href="scss/boot-site.scss">
<link rel="stylesheet" type="text/css" href="scss/boot-site2.scss">
<link rel="stylesheet" type="text/css" href="scss/boot-site.css">
<link rel="stylesheet" type="text/css" href="scss/boot-site2.css">

<link href="https://fonts.googleapis.com/css?family=Lobster+Two&display=swap" rel="stylesheet">
<style>
#test_name {
    display: none;
}

#button, #button2 {
background-color: green;
color: white;
}
.form {
color: white;
border: none;
}

body {
background-image: url(images/greenery2.jpg);
background-repeat: repeat;
background-size: cover;
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
<div class="col-lg-12">
<h1>Add Products</h1>
<?php
            //If the form was submitted and valid and properly put into database display the INSERT result message
			if($validForm)
			{
        ?>
            <h1><?php echo $message ?></h1>
<form class="form" id="form1" name="form1" method="post" action="inputForm.php">
 <input id="test_name" name="testName" type="text" />
  <p>Product Name: 
    <input type="text" name="eventName" id="eventName" value="<?php echo $prod_name;  ?>"/>
    <span class="errMsg"> <?php echo $eventNameErrMsg; ?></span>
</p>
  <p>Product Description: 
    <input type="text" name="eventDesc" id="eventDesc" value="<?php echo $prod_description;  ?>"/>
    <span class="errMsg"> <?php echo $eventDescErrMsg; ?></span>
  </p>
  <p>Product Price: 
    <input type="text" name="price" id="price" value="<?php echo $prod_price;  ?>"/>
    <span class="errMsg"> <?php echo $priceErrMsg; ?></span>
  </p>
  <p>Product Image: 
    <input type="text" name="img" id="img" value="<?php echo $prod_image;  ?>"/>
    <span class="errMsg"> <?php echo $imgErrMsg; ?></span>
  </p>
    <p>Product Tax: 
    <input type="text" name="tax" id="tax" value="<?php echo $prod_tax;  ?>"/>
    <span class="errMsg"> <?php echo $taxErrMsg; ?></span>
  </p>
    <p>Product Shipping: 
    <input type="text" name="ship" id="ship" value="<?php echo $prod_shipping;  ?>"/>
    <span class="errMsg"> <?php echo $shipErrMsg; ?></span>
  </p>
  <p>Product WholeSaler: 
    <input type="text" name="sell" id="sell" value="<?php echo $prod_seller;  ?>"/>
    <span class="errMsg"> <?php echo $sellerErrMsg; ?></span>
  </p>
  <p>Product Category: 
    <input type="text" name="cat" id="cat" value="<?php echo $prod_category;  ?>"/>
    <span class="errMsg"> <?php echo $categoryErrMsg; ?></span>
  </p>
    <p>Product Special Message(optional): 
    <input type="text" name="spec" id="spec" value="<?php echo $prod_special;  ?>"/>
  </p>
    <p>Product Date: 
    <input type="date" name="date" id="date" value="<?php echo $prod_date;  ?>"/>
    <span class="errMsg"> <?php echo $dateErrMsg; ?></span>
  </p>
  <p>Product Inventory: 
    <input type="number" name="number" id="number" value="<?php echo $prod_inventory;  ?>"/>
    <span class="errMsg"> <?php echo $inventoryErrMsg; ?></span>
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Submit" />
    <input type="reset" name="button2" id="button2" value="Reset" />
  </p>
</form>
        
        <?php
			}
			else	//display form
			{
        ?>
    	
<form class="form" id="form1" name="form1" method="post" action="inputForm.php">
 <input id="test_name" name="testName" type="text" />
  <p>Product Name: 
    <input type="text" name="eventName" id="eventName" value="<?php echo $prod_name;  ?>"/>
    <span class="errMsg"> <?php echo $eventNameErrMsg; ?></span>
</p>
  <p>Product Description: 
    <input type="text" name="eventDesc" id="eventDesc" value="<?php echo $prod_description;  ?>"/>
    <span class="errMsg"> <?php echo $eventDescErrMsg; ?></span>
  </p>
  <p>Product Price: 
    <input type="text" name="price" id="price" value="<?php echo $prod_price;  ?>"/>
    <span class="errMsg"> <?php echo $priceErrMsg; ?></span>
  </p>
  <p>Product Image: 
    <input type="text" name="img" id="img" value="<?php echo $prod_image;  ?>"/>
    <span class="errMsg"> <?php echo $imgErrMsg; ?></span>
  </p>
    <p>Product Tax: 
    <input type="text" name="tax" id="tax" value="<?php echo $prod_tax;  ?>"/>
    <span class="errMsg"> <?php echo $taxErrMsg; ?></span>
  </p>
    <p>Product Shipping: 
    <input type="text" name="ship" id="ship" value="<?php echo $prod_shipping;  ?>"/>
    <span class="errMsg"> <?php echo $shipErrMsg; ?></span>
  </p>
  <p>Product WholeSaler: 
    <input type="text" name="sell" id="sell" value="<?php echo $prod_seller;  ?>"/>
    <span class="errMsg"> <?php echo $sellerErrMsg; ?></span>
  </p>
  <p>Product Category: 
    <input type="text" name="cat" id="cat" value="<?php echo $prod_category;  ?>"/>
    <span class="errMsg"> <?php echo $categoryErrMsg; ?></span>
  </p>
    <p>Product Special Message(optional): 
    <input type="text" name="spec" id="spec" value="<?php echo $prod_special;  ?>"/>
  </p>
    <p>Product Date: 
    <input type="date" name="date" id="date" value="<?php echo $prod_date;  ?>"/>
    <span class="errMsg"> <?php echo $dateErrMsg; ?></span>
  </p>
  <p>Product Inventory: 
    <input type="number" name="number" id="number" value="<?php echo $prod_inventory;  ?>"/>
    <span class="errMsg"> <?php echo $inventoryErrMsg; ?></span>
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Submit" />
    <input type="reset" name="button2" id="button2" value="Reset" />
  </p>
</form>
<form class="form" action="upload.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
    <span class="errMsg"> <?php echo $text; ?></span>
</form>

        <?php
			}//end else
        ?>    
</div>
<p>&nbsp;</p>
  <div class="col-lg-12" style="color:white; background-image: linear-gradient(to bottom left, #128A42, #00621C);">
      
  
	<footer>
    	<p>Copyright &copy; <script> var d = new Date(); document.write (d.getFullYear());</script> All Rights Reserved</p>
    
    </footer>
</div>
</div>
</div>
</body>

</html>
