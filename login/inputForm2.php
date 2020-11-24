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
		//error messages
		$eventNameErrMsg = "";
		$eventDescErrMsg = "";
		$eventPresErrMsg = "";
		$dateErrMsg = "";
		$timeErrMsg = "";
				
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
		$event_name = $_POST['eventName'];
		$event_description = $_POST['eventDesc'];
		$event_presenter = $_POST['pres'];
		$event_date = $_POST['date'];
		$event_time = $_POST['time'];
		

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
			
			function validatePres($inName)
			{
				global $validForm, $eventPresErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$eventPresErrMsg = "";
				
				if($inName == "" || !preg_match('/^[a-zA-Z0-9 \-_]*$/', $inName))
				{
					$validForm = false;
					$eventPresErrMsg = "Presenter cannot be spaces or special characters";
				}
				else {
				if (strlen($inName) > 50)
					{
					$validForm = false;
					$eventPresErrMsg = "Presenter cannot be more than 50 characters."; 
					}
				}
			}//end validateName()	
			
			
		function validateDate($inName)
			{
				global $validForm, $dateErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$eventDescErrMsg = "";
				
				if(empty($inName))
				{
					$validForm = false;
					$dateErrMsg = "Date cannot be blank";
				}
			}//end validateName()
			
			function validateTime($inName)
			{
				global $validForm, $timeErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$eventDescErrMsg = "";
				
				if(empty($inName))
				{
					$validForm = false;
					$timeErrMsg = "Time cannot be blank";
				}
			}//end validateName()		
			
			
		
		//VALIDATE FORM DATA  using functions defined above
		$validForm = true;		//switch for keeping track of any form validation errors
		
		validateFirstName($event_name);
		validateLastName($event_description);
		validatePres($event_presenter);
		validateDate($event_date);
		validateTime($event_time);
		
		if($validForm)
		{
			$message = "All good";	
			
			try {
				
				require 'connectPDO.php';	//CONNECT to the database
				
				
				//Create the SQL command string
				$sql = "INSERT INTO wdv341_events (";
				$sql .= "event_name, ";
				$sql .= "event_description, ";
				$sql .= "event_presenter, ";
				$sql .= "event_date, ";
				$sql .= "event_time ";
				$sql .= ") VALUES (:eventName, :eventDesc, :pres, :date, :time)";
				
				//PREPARE the SQL statement
				$stmt = $conn->prepare($sql);
				
				//BIND the values to the input parameters of the prepared statement
				$stmt->bindParam(':eventName', $event_name);
				$stmt->bindParam(':eventDesc', $event_description);		
				$stmt->bindParam(':pres', $event_presenter);		
				$stmt->bindParam(':date', $event_date);		
				$stmt->bindParam(':time', $event_time);
				
				//EXECUTE the prepared statement
				$stmt->execute();	
				
				$message = "The Event has been registered.";
			}
			
			catch(PDOException $e)
			{
				$message = "There has been a problem. The system administrator has been contacted. Please try again later.";
	
				error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
				error_log(var_dump(debug_backtrace()));
			
				//Clean up any variables or connections that have been left hanging by this error.		
			
				//header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
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

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - Event Form Example</title>
<style>
#test_name {
    display: none;
}

body {
background-color: aliceblue;
color: navy;
font-size: 1.1em;
text-align: center;
}

#button, #button2 {
background-color: navy;
color: white;
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
<h1>WDV341 Intro PHP</h1>
 <nav>
    
    	<ul>
        	<li><a href="welcome.php">Home</a></li>
            <li><a href="listevents.php">Presenters</a></li>
            <li><a href="inputForm2.php">Add Presenter</a></li>
        	<li><a href="login.php">Sign On</a></li>
        </ul>
    	<div class="clearFloat"></div>
    
    </nav>
<?php
            //If the form was submitted and valid and properly put into database display the INSERT result message
			if($validForm)
			{
        ?>
     
            <h1><?php echo $message ?></h1>
<form id="form1" name="form1" method="post" action="inputForm2.php">
 <input id="test_name" name="testName" type="text" />
  <p>Event Name: 
    <input type="text" name="eventName" id="eventName" value="<?php echo $event_name;  ?>"/>
    <span class="errMsg"> <?php echo $eventNameErrMsg; ?></span>
</p>
  <p>Event Description: 
    <input type="text" name="eventDesc" id="eventDesc" value="<?php echo $event_description;  ?>"/>
    <span class="errMsg"> <?php echo $eventDescErrMsg; ?></span>
  </p>
  <p>Event Presenter: 
    <input type="text" name="pres" id="pres" value="<?php echo $event_presenter;  ?>"/>
    <span class="errMsg"> <?php echo $eventPresErrMsg; ?></span>
  </p>
    <p>Event Date: 
    <input type="date" name="date" id="date" value="<?php echo $event_date;  ?>"/>
    <span class="errMsg"> <?php echo $dateErrMsg; ?></span>
  </p>
  <p>Event Time: 
    <input type="time" name="time" id="time" value="<?php echo $event_time;  ?>"/>
    <span class="errMsg"> <?php echo $timeErrMsg; ?></span>
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
    	
<form id="form1" name="form1" method="post" action="inputForm2.php">
 <input id="test_name" name="testName" type="text" />
  <p>Event Name: 
    <input type="text" name="eventName" id="eventName" value="<?php echo $event_name;  ?>"/>
    <span class="errMsg"> <?php echo $eventNameErrMsg; ?></span>
</p>
  <p>Event Description: 
    <input type="text" name="eventDesc" id="eventDesc" value="<?php echo $event_description;  ?>"/>
    <span class="errMsg"> <?php echo $eventDescErrMsg; ?></span>
  </p>
  <p>Event Presenter: 
    <input type="text" name="pres" id="pres" value="<?php echo $event_presenter;  ?>"/>
    <span class="errMsg"> <?php echo $eventPresErrMsg; ?></span>
  </p>
    <p>Event Date: 
    <input type="date" name="date" id="date" value="<?php echo $event_date;  ?>"/>
    <span class="errMsg"> <?php echo $dateErrMsg; ?></span>
  </p>
  <p>Event Time: 
    <input type="time" name="time" id="time" value="<?php echo $event_time;  ?>"/>
    <span class="errMsg"> <?php echo $timeErrMsg; ?></span>
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Submit" />
    <input type="reset" name="button2" id="button2" value="Reset" />
  </p>
</form>

        <?php
			}//end else
        ?>    

<p>&nbsp;</p>
</body>

</html>