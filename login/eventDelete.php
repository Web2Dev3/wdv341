<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["validUser"]) || $_SESSION["validUser"] !== true){
    header("location: login.php");
    exit;
}		
	//Setup the variables used by the page
		//field data
		$event_name = "";
		$event_description = "";
		$event_presenter = "";
		$event_date = "";
		$event_time = "";
		

		
		$todaysDate = date("Y-m-d");		//use today's date as the default input to the date( )
		
		//The form needs to display the fields of the selected record
		$updateRecID = $_GET['recId'];	//Record Id to be updated
		//$updateRecId = 2;				//Hard code a key for testing purposes	
			
			try {
				
				require 'connectPDO.php';	//CONNECT to the database
				
				//Create the SQL command string
				$sql = "DELETE FROM wdv341_events WHERE event_id='$updateRecID'";
				
				//PREPARE the SQL statement
				$stmt = $conn->prepare($sql);
				
				//EXECUTE the prepared statement
				$stmt->execute();	
				
				$message = "The Event has been Deleted.";
			}
			
			catch(PDOException $e)
			{
				$message = "There has been a problem. The system administrator has been contacted. Please try again later.";
	
				error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
				error_log(var_dump(debug_backtrace()));
			
				//Clean up any variables or connections that have been left hanging by this error.		
			
				header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
			}

		
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Presenting Information Technology</title>
	<link rel="stylesheet" href="css/pit.css">  
  	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>    

<style>
body {
background-color: aliceblue;
color: navy;
font-size: 1.1em;
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

<div id="container">

	<header>
    	<h1>Presenting Events</h1>
    </header>
    
    <nav>
    
    	<ul>
        	<li><a href="welcome.php">Home</a></li>
            <li><a href="listevents.php">Presenters</a></li>
            <li><a href="inputForm2.php">Add Presenter</a></li>
        	<li><a href="login.php">Sign On</a></li>
        </ul>
    	<div class="clearFloat"></div>
    
    </nav>
    
    <main>
    
        <h1>Delete an Event</h1>
      <h1><?php echo $message ?></h1>
        
	</main>
    
	<footer>
    	<p>Copyright &copy; <script> var d = new Date(); document.write (d.getFullYear());</script> All Rights Reserved</p>
    
    </footer>



</div>
</body>
</html>