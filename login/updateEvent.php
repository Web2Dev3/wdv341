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
		$titleErrMsg = "";
		$descriptionErrMsg = "";
		$cityErrMsg = "";
		$stErrMsg = "";
		$emailErrMsg = "";
		$beginDateErrMsg = "";
		$endDateErrMsg = "";
		
		$validForm = false;

		//mysql DATE stores data in a YYYY-MM-DD format
		$todaysDate = date("Y-m-d");		//use today's date as the default input to the date( )
		
		//The form needs to display the fields of the selected record
		$updateRecID = $_GET['recId'];	//Record Id to be updated
		//$updateRecId = 2;				//Hard code a key for testing purposes	
				
	if(isset($_POST["submit"]))
	{	
		//The form has been submitted and needs to be processed
		
		
		//Validate the form data here!
	
		//Get the name value pairs from the $_POST variable into PHP variables
		//This example uses PHP variables with the same name as the name atribute from the HTML form
		
		$event_name = $_POST['event_title'];
		$event_description = $_POST['event_description'];
		$event_presenter = $_POST['event_city'];
		$event_date = $_POST['event_begin_date'];
		$event_time = $_POST['event_end_date'];		

		/*	FORM VALIDATION PLAN
		
			FIELD NAME		VALIDATION TESTS & VALID RESPONSES
			Event Title		Required Field		May not be empty
			Description				
			City			
			State			
			Email			Required Field		Format
			Begin Date		Required Field		Format
			End Date		Required Field		Format
		*/
		
		//VALIDATION FUNCTIONS		Use functions to contain the code for the field validations.  
			function validateTitle($inValue)
			{
				global $validForm, $titleErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$titleErrMsg = "";
				
				if($inValue == "")
				{
					$validForm = false;
					$titleErrMsg = "Name cannot be spaces";
				}
			}//end validateTitle()
			
			function validateDescription($inValue)
			{
				global $validForm, $descriptionErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$descriptionErrMsg = "";
				
				if($inValue == "")
				{
					$validForm = false;
					$descriptionErrMsg = "Name cannot be spaces";
				}
			}//end validateDescription()
		
			function validateCity($inValue)
			{
				global $validForm, $cityErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$cityErrMsg = "";
				
				if($inValue == "")
				{
					$validForm = false;
					$cityErrMsg = "Name cannot be spaces";
				}
			}//end validateCity()	
			
			function validateSt($inValue)
			{
				global $validForm, $stErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$stErrMsg = "";
				
				if($inValue == "")
				{
					$validForm = false;
					$stErrMsg = "Name cannot be spaces";
				}
			}//end validateSt()			
					
			function validateEmail()
			{
				global $validForm, $emailErrMsg, $event_email;	//Use the GLOBAL Version of these variables instead of making them local
				$emailErrMsg = "";								//Clear the error message. 
				
				// Remove all illegal characters from email
				$event_email = filter_var($event_email, FILTER_SANITIZE_EMAIL);

				// Validate e-mail
				$event_email = filter_var($event_email, FILTER_VALIDATE_EMAIL);

				if($event_email === false)
				{
					$validForm = false;
					$emailErrMsg = "Invalid email"; 					
				}
			}//end validateEmail()		
		
		//VALIDATE FORM DATA  using functions defined above
		$validForm = true;		//switch for keeping track of any form validation errors
		
		validateTitle($event_name);
		validateDescription($event_description);
		validateCity($event_presenter);
		
		if($validForm)
		{
			$message = "All good";	
			
			try {
				
				require 'connectPDO.php';	//CONNECT to the database
				
				//Create the SQL command string
				$sql = "UPDATE wdv341_events SET ";
				$sql .= "event_name='$event_name', ";
				$sql .= "event_description='$event_description', ";
				$sql .= "event_presenter='$event_presenter', ";
				$sql .= "event_date='$event_date', ";
				$sql .= "event_time='$event_time' ";								
				 //Last column does NOT have a comma after it.
				$sql .= "WHERE event_id='$updateRecID'";
				
				//PREPARE the SQL statement
				$stmt = $conn->prepare($sql);
				
				//BIND the values to the input parameters of the prepared statement
				/*
				$stmt->bindParam(':name', $event_name);
				$stmt->bindParam(':description', $event_description);				
				$stmt->bindParam(':presenter', $event_presenter);					
				$stmt->bindParam(':date', $event_date);	
				$stmt->bindParam(':time',$event_time);				
				*/
				
				//EXECUTE the prepared statement
				$stmt->execute();	
				
				$message = "The Event has been Updated.";
			}
			
			catch(PDOException $e)
			{
				$message = "There has been a problem. The system administrator has been contacted. Please try again later.";
	
				error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
				error_log(var_dump(debug_backtrace()));
			
				//Clean up any variables or connections that have been left hanging by this error.		
			
				header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
			}

		}
		else
		{
			$message = "Something went wrong";
		}//ends check for valid form		

	}
	else
	{
		//Form has not been seen by the user.  display the form with the selected event information	
		try {
		  
		  require 'connectPDO.php';	//CONNECT to the database
		  
		  //mysql DATE stores data in a YYYY-MM-DD format
		  $todaysDate = date("Y-m-d");		//use today's date as the default input to the date( )
		  
		  //Create the SQL command string
		  $sql = "SELECT ";
		  $sql .= "event_name, ";
		  $sql .= "event_description, ";
		  $sql .= "event_presenter, ";
		  $sql .= "event_date, ";	  	  
		  $sql .= "event_time "; //Last column does NOT have a comma after it.
		  $sql .= "FROM wdv341_events ";
		  $sql .= "WHERE event_id=$updateRecID";
		  
		  //PREPARE the SQL statement
		  $stmt = $conn->prepare($sql);
		  
		  //EXECUTE the prepared statement
		  $stmt->execute();		
		  
		  //RESULT object contains an associative array
		  $stmt->setFetchMode(PDO::FETCH_ASSOC);	
		  
		  $row=$stmt->fetch(PDO::FETCH_ASSOC);	 
				
			$event_name=$row['event_name'];
			$event_description=$row['event_description'];
			$event_presenter=$row['event_presenter'];
			$event_date=$row['event_date'];
			$event_time=$row['event_time'];					
				 
	  }
	  
	  catch(PDOException $e)
	  {
		  $message = "There has been a problem. The system administrator has been contacted. Please try again later.";
	
		  error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
		  error_log($e->getLine());
		  error_log(var_dump(debug_backtrace()));
	  
		  //Clean up any variables or connections that have been left hanging by this error.		
	  
		  header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
	  }	
		
	}// ends if submit 
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Presenting Events</title>
  	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>    

	<script>
		$(function() {
			$('#event_begin_date').datepicker({dateFormat: "yy-mm-dd"});	//set datepicker format to yyyy-mm-dd to match database expected format
		} );		
		
	</script>

    <script>
		function clearForm() {
			//alert("inside clearForm()");
			$('.errMsg').html("");					//Clear all span elements that have a class of 'errMsg'. 		
			$('input:text').removeAttr('value');	//REMOVE the value attribute supplied by PHP Validations
			$('textarea').html("");					//Clear the textarea innerHTML
		}
	</script>
<style>
body {
background-color: aliceblue;
color: navy;
font-size: 1.1em;
}

#submit, #button2 {
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
    
        <h1>Setup a new Event</h1>
		<?php
            //If the form was submitted and valid and properly put into database display the INSERT result message
			if($validForm)
			{
        ?>
      <h1><?php echo $message ?></h1>
        
        <?php
			}
			else	//display form
			{
        ?>
        <form id="updateEventForm" name="updateEventForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?recId=$updateRecID"; ?>">
        	<fieldset>
              <legend>New Event</legend>
              <p>
                <label for="event_title">Event Name: </label>
                <input type="text" name="event_title" id="event_title" value="<?php echo $event_name;  ?>" /> 
                <span class="errMsg"> <?php echo $titleErrMsg; ?></span>
              </p>
              <p>
                <label for="event_description">Event Description:</label>
                  <textarea name="event_description" id="event_description" maxlength="700"><?php echo $event_description; ?></textarea>
                <span class="errMsg"><?php echo $descriptionErrMsg; ?></span>                
              </p>
              <p>
                <label for="event_city">Presenter: </label>
                <input type="text" name="event_city" id="event_city" value="<?php echo $event_presenter;  ?>" />
                <span class="errMsg"><?php echo $cityErrMsg; ?></span>                      
              </p>
            </p>
              <p>
                <label for="event_begin_date">Date:</label>
                  <input type="text" name="event_begin_date" id="event_begin_date" required value="<?php echo $event_date; ?>">
              </p>
              <p>
                <label for="event_end_date">Time:</label>   
                  <input type="text" name="event_end_date" id="event_end_date" required value="<?php echo $event_time; ?>">
              </p>   
                       
              
          </fieldset>
         	<p>
            	<input type="submit" name="submit" id="submit" value="Add Event" />
            	<input type="reset" name="button2" id="button2" value="Clear Form" onClick="clearForm()" />
        	</p>  
      </form>
        <?php
			}//end else
        ?>    	
	</main>
    
	<footer>
    	<p>Copyright &copy; <script> var d = new Date(); document.write (d.getFullYear());</script> All Rights Reserved</p>
    
    </footer>



</div>
</body>
</html>