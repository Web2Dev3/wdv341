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
<title>Error Response Page</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  

<link rel="stylesheet" type="text/css" href="css/boot-site.css">
<link rel="stylesheet" type="text/css" href="scss/boot-site.scss">
<link rel="stylesheet" type="text/css" href="scss/boot-site2.scss">
<link rel="stylesheet" type="text/css" href="scss/boot-site.css">
<link rel="stylesheet" type="text/css" href="scss/boot-site2.css">

<link href="https://fonts.googleapis.com/css?family=Lobster+Two&display=swap" rel="stylesheet">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<div id="container-fluid">
<div class="row">
<div class="col-sm-1" style="background-color:#34590A;">
	<a class="navbar-brand" href="#">
	<img src="images/urban-logo.png" alt="logo for company">
	</a>
	</div>
	<div class="col-sm-11" style="background-color:#34590A;">
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
  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".collapse" aria-controls="collapsibleNavbar collapsibleNavbar2">
    <span class="navbar-toggler-icon"></span>
  </button>
  </div>
</nav>
</div>

<div class="col-lg-12">
    	<h1>We're sorry. Our system is having problems.  Please try again later.</h1>
    
    <p>Return to <a href="welcome.php">home page</a>.</p>
    </div>
    </div>
    </div>
</body>
</html>
<html>