<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  

<link rel="stylesheet" type="text/css" href="css/boot-site.css">
<link rel="stylesheet" type="text/css" href="scss/boot-site.scss">
<link rel="stylesheet" type="text/css" href="scss/boot-site2.scss">
<link rel="stylesheet" type="text/css" href="scss/boot-site.css">
<link rel="stylesheet" type="text/css" href="scss/boot-site2.css">

<link href="https://fonts.googleapis.com/css?family=Lobster+Two&display=swap" rel="stylesheet">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; margin: auto; width: 97.5%;}
        .btn{padding-right: 10px; padding-left: 0px; background-color: coral;}
         @media screen and (max-width: 1024px) {
         ul {
         flex-direction: column;
         }
}
    </style>
</head>
<body>
<div id="container-fluid">
<div class="row">
<div class="col-sm-12" style="background-color:#34590A;">
<ul style="display: flex; justify-content: space-between;">
<li>
	<a style="font-weight:bold; color: white;" class="navbar-brand" href="#">
	<img  style="max-width: 70px; max-height: 80px; border: none;"  src="images/urban-logo.png" alt="logo for company" width="45" class="img-responsive">Urban Gardens Admin	</a></li>

  <!-- Navbar links -->
      <li>
        <a style="color: white; margin-top: 30px;" class="nav-link" href="welcome.php">Home</a>
      </li>
      <li>
        <a style="color: white;margin-top: 30px;" class="nav-link" href="inputForm.php">Add Products</a>
      </li> 
        <li>
        <a style="color: white;margin-top: 30px;" class="nav-link" href="listevents.php">Edit Products</a>
      </li> 
 
    </ul>
      
</div>
<div class="col-lg-12" style="background-image: url(images/gardening.jpg);height:60vh;min-height:20px; background-size:cover;background-repeat: no-repeat;"></div> 
<div class="col-lg-12">
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    </div>
    <div class="col-lg-12">
	        <p><a href="upload.php">Click here</a> to upload an image.</p>   
    <p>
    	<a href="index.html" class="btn btn-danger">Return to Main Site</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
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
