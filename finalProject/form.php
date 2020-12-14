<!DOCTYPE html>
<html>
<head>
	<title>form.html</title>
<!--Author: Savanna Kohler
Date: March 12th 2020-->

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="about contacts">
<meta name="keywords" content="gardens, contact">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  

<link rel="stylesheet" type="text/css" href="css/boot-site.css">
<link rel="stylesheet" type="text/css" href="scss/boot-site.scss">
<link rel="stylesheet" type="text/css" href="scss/boot-site2.scss">
<link rel="stylesheet" type="text/css" href="scss/boot-site.css">
<link rel="stylesheet" type="text/css" href="scss/boot-site2.css">

<link href="https://fonts.googleapis.com/css?family=Lobster+Two&display=swap" rel="stylesheet">
<?php
	$userName = "";
	$userEmail = "";	 
	$userMessage = "";
	$remenber = "";
	$emailErrMsg = "";
	$firstNameErrMsg = "";	

	$validForm = false;
				
	if(isset($_POST["button"]))
	{	
	
	$userName = $_POST['floatName'];
	$userEmail = $_POST['floatEmail'];
	$userMessage = $_POST['floatMessage'];
	
		if(isset($_POST['remember']))
		{
			$remember = "Remember Me";
		}
	function validateEmail($inEmail)
			{
				global $validForm, $emailErrMsg;			//Use the GLOBAL Version of these variables instead of making them local
				$emailErrMsg = "";							//Clear the error message. 
				
				// Remove all illegal characters from email
				$inEmail = filter_var($inEmail, FILTER_SANITIZE_EMAIL);

				// Validate e-mail
				$inEmail = filter_var($inEmail, FILTER_VALIDATE_EMAIL);

				if($inEmail === false)
				{
					$validForm = false;
					$emailErrMsg = "Invalid email"; 					
				}
			}//end validateEmail()
			
			function validateFirstName($inName)
			{
				global $validForm, $firstNameErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$firstNameErrMsg = "";
				
				if($inName == "")
				{
					$validForm = false;
					$firstNameErrMsg = "Name cannot be spaces";
				}
				else {
				if (strlen($inName) > 200)
					{
					$validForm = false;
					$firstNameErrMsg = "Name cannot be more than 200 characters."; 
					}
				}
			}//end validateName()
		$validForm = true;	
		validateFirstName($userName);
		validateEmail($userEmail);
		
		if($validForm)
		{
		$to = "kohlersavanna5@gmail.com";
		$subject = "Email from my website";
		$body = "Information Submitted by ".$userName.".\n\n".$userMessage."\n\n".$remember;
		
		$headers = "From: contact@savannakohler.com";
		
		mail($to, $subject, $body, $headers);
            $message = "Thank You. Your message has been sent.";
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
<style>
h3 {
color:#ED79BE;
text-align: center;
}

img {
border-radius: 3.8em;
}

p a {
color:white;
}

</style>

</head>
<body>

<div class="container-fluid" style="border:2px solid #00621C; box-shadow:5px 5px grey;">
<div class="row">

<div class="col-sm-12" style="background-color:#34590A;">
<nav class="navbar navbar-expand-lg navbar-dark">
 <div class="d-none d-md-block">
	<a style="font-weight:bold;" class="navbar-brand" href="index.html">
	<img  style="max-width: 60px; max-height: 100px; border: none;"  src="images/urban-logo.png" alt="logo for company" width="45" class="img-responsive">Academic Project
	</a>
	</div>
  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
     <li class="nav-item">
        <a class="nav-link" href="index.html">Home</a>
      </li> 
     <li class="nav-item">
        <a class="nav-link" href="about.html">About Us</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="facts.php">Products</a>
      </li> 
        <li class="nav-item">
        <a class="nav-link" href="gallery.html">Gallery</a>
      </li> 
        <li class="nav-item">
        <a class="nav-link" href="form.php">Contact Us</a>
      </li> 
       <li class="nav-item">
        <a class="nav-link" href="login.php">Admin</a>
      </li> 
    </ul>
  </div> 
        <div class="d-flex ml-auto">
                    <form class="form-inline">
      <input class="form-control ml-sm-5" type="search" placeholder="Search" aria-label="Search">
    </form>
    <i class="fa fa-search" style="font-size: 2.13em; color: green; margin-left: 10px;"></i>
  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".collapse" aria-controls="collapsibleNavbar collapsibleNavbar2">
    <span class="navbar-toggler-icon"></span>
  </button>
  </div>
</nav>
</div>

<div class="col-sm-12" style="background-color:#34590A;">
<h1>Contact Us</h1>

</div>

    <div class="col-md-8" style="background-color:#34590A;">
<h3>Please Leave a Message</h3>
	<div class="form">
	<?php
            //If the form was submitted and valid and properly put into database display the INSERT result message
			if($validForm)
			{
        ?>
            <h5 style="color:deeppink;"><?php echo $message ?></h5>
        
        <?php
			}
			else	//display form
			{
        ?>
   	  <form method="POST" action="form.php">
                   	<h2 style="text-shadow:2px 2px black; color:#128A42;">CONTACT US</h2>
                    <p style="color:#ED79BE;">
                      	<label for="floatName" style="background-color:#00621C; padding-right: 0.9em;">NAME</label>
                        <input type="text" name="floatName" id="floatName">
                         <span class="errMsg"><?php echo $firstNameErrMsg; ?></span> 
                    </p>
                    <p style="color:#ED79BE;">
                      <label for="floatEmail" style="background-color:#00621C; padding-right: 0.9em;">EMAIL</label>
                      <input type="text" name="floatEmail" id="floatEmail">
                       <span class="errMsg"><?php echo $emailErrMsg; ?></span> 
                    </p>
                    <p style="color:#ED79BE;">
                      <label for="floatMessage" style="background-color:#00621C; padding-right: 0.9em;">MESSAGE</label>
                      <textarea name="floatMessage" id="floatMessage"></textarea>
                    </p>
                    <p>   <input type="checkbox" name="remember" value="Remember Me">
 			  <label for="remember">Remember Me</label>
 		   </p>
                    <p>
                      <input type="submit" name="button" id="button" value="Submit">
                      <input type="reset" name="button2" id="button2" value="Reset">
                    </p>
           </form>
           <?php
			}//end else
        ?>    	
	</div>
</div>

<div class="col-md-4" style="background-color:#34590A;">

<img src="images/pathway.jpg" alt="colorful pathway" width="100%"> 
</div>

<div id="footer" class="col-sm-12" style="color:white; background-image: linear-gradient(to bottom left, #128A42, #00621C);  display: flex; justify-content: flex-end; justify-content: space-between;">
<p>
©Copyright 2020 Urban Gardens LTD. All rights reserved.</p>
<p><a href="#" class="fa fa-facebook"></a>
<a href="#" class="fa fa-twitter"></a>
<a href="#" class="fa fa-instagram"></a>
</p>
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
