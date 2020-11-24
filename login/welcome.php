<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["validUser"]) || $_SESSION["validUser"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
body {
background-color: aliceblue;
color: navy;
font-size: 1.9em;
text-align: center;
}

nav ul {
  width:100%;
  justify-content: center;
  justify-content:space-around;
  padding: .5em;
  text-decoration: none;
  text-align: center;
}

li {
	display:inline-block;
	font-weight: bold;
}
    </style>
</head>
<body>
 <nav>
    
    	<ul>
        	<li><a href="welcome.php">Home</a></li>
            <li><a href="listevents.php">Presenters</a></li>
            <li><a href="inputForm2.php">Add Presenter</a></li>
        	<li><a href="login.php">Sign On</a></li>
        </ul>
    	<div class="clearFloat"></div>
    
    </nav>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <p>
    	<a href="inputForm2.php" class="btn btn-danger">Add Events</a>
    	<a href="listevents.php" class="btn btn-danger">Edit Events</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>