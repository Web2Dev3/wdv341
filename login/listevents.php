<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["validUser"]) || $_SESSION["validUser"] !== true){
    header("location: login.php");
    exit;
}

	try {
	  
	  require 'connectPDO.php';	//CONNECT to the database
	  
	  //mysql DATE stores data in a YYYY-MM-DD format
	  $todaysDate = date("Y-m-d");		//use today's date as the default input to the date( )
	  
	  //Create the SQL command string
	  $sql = "SELECT ";
	  $sql .= "event_id, ";
	  $sql .= "event_name, ";
	  $sql .= "event_description, ";
	  $sql .= "event_presenter, ";
	  $sql .= "event_date, ";
	  $sql .= "event_time ";	  	   //Last column does NOT have a comma after it.
	  $sql .= "FROM wdv341_events";
	  
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
  
	  //header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
  }

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Presenting Information Technology</title>

<style>
body {
background-color: aliceblue;
color: navy;
font-size: 1.1em;
}

button, input {
background-color: navy;
color: white; }

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
 <nav>
    
    	<ul>
        	<li><a href="welcome.php">Home</a></li>
            <li><a href="listevents.php">Presenters</a></li>
            <li><a href="inputForm2.php">Add Presenter</a></li>
        	<li><a href="login.php">Sign On</a></li>
        </ul>
    	<div class="clearFloat"></div>
    
    </nav>
	<header>
    	<h1>Events List</h1>
    </header>
    
    
    <main>
    
        <h1>Display Available Events</h1>
        
        <?php 
			while( $row=$stmt->fetch(PDO::FETCH_ASSOC)) {
		?>		
				<div class="eventBlock">
					<div class="row">
						<span class="eventTitle"><?php echo $row['event_name']; ?></span>
					</div>
					<div class="row">
						<span class="eventDescription"><?php echo $row['event_description']; ?></span>
					</div>                    
					<div class="row">
                        <div class="col-1-2">
                        	<span class="eventAddress">Dates: <?php echo $row['event_date'] . " " . $row['event_time'] . "." ?></span>
                        </div>
						<div class="col-1-2">
                        	<span class="eventAddress">Presenter: <?php echo $row['event_presenter']; ?></span>
                        </div>
					</div>
                    <div class="row">
                    	<?php $event_id=$row['event_id'];	//put event_id into a variable for further processing  ?>
                    	<a href='updateEvent.php?recId=<?php echo $event_id; ?>'><button>Update</button></a>
                        <a href='eventDelete.php?recId=<?php echo $event_id; ?>'><input type="button" value="Delete"></a>
                    </div>                
				</div><!-- Close Event Block -->
        <?php
			}
		?>	
  	
        
	</main>
    
	<footer>
    	<p>Copyright &copy; <script> var d = new Date(); document.write (d.getFullYear());</script> All Rights Reserved</p>
    
    </footer>




</div>
</body>
</html>