<?php
	
		
	//Setup the variables used by the page
		//field data
		$presenter_first_name = "";
		$presenter_last_name = "";
		$presenter_city = "";
		$presenter_st = "";
		$presenter_zip = "";
		$presenter_num = "";
		$presenter_email = "";
		$present_opt = "";
		$present_opt2 = "";
		//error messages
		$firstNameErrMsg = "";
		$lastNameErrMsg = "";
		$cityErrMsg = "";
		$numErrMsg = "";
		$stErrMsg = "";
		$zipErrMsg = "";
		$emailErrMsg = "";
		$optErrMsg = "";
		$optErrMsg2 = "";
		
		$validForm = false;
				
	if(isset($_POST["submit"]))
	{	
		//The form has been submitted and needs to be processed
		
		
		//Validate the form data here!
	
		//Get the name value pairs from the $_POST variable into PHP variables
		//This example uses PHP variables with the same name as the name atribute from the HTML form
		$presenter_first_name = $_POST['presenter_first_name'];
		$presenter_last_name = $_POST['presenter_last_name'];
		$presenter_city = $_POST['presenter_city'];
		$presenter_st = $_POST['presenter_st'];
		$presenter_zip = $_POST['presenter_zip'];
		$presenter_num = $_POST['presenter_num'];
		$presenter_email = $_POST['presenter_email'];

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
		  if (isset($_POST['optradio'])) {
       			 $present_opt = $_POST['optradio'];
   		 } else {
        		$optErrMsg = "Please select option";
        		$validForm = false;
   		 }
   		 if (isset($_POST['optradio2'])) {
       			 $present_opt2 = $_POST['optradio2'];
   		 } else {
        		$optErrMsg2 = "Please select option";
        		$validForm = false;
   		 }
			function validateFirstName($inName)
			{
				global $validForm, $firstNameErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$firstNameErrMsg = "";
				
				if($inName == "" || !preg_match('/^[a-zA-Z0-9 \-_]*$/', $inName))
				{
					$validForm = false;
					$firstNameErrMsg = "Name cannot be spaces or special characters."; 
				}
				else {
				if (strlen($inName) > 200)
					{
					$validForm = false;
					$firstNameErrMsg = "Name cannot be more than 200 characters."; 
					}
				}
			}//end validateName()

			function validateLastName($inName)
			{
				global $validForm, $lastNameErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$lastNameErrMsg = "";
				
				$inName = filter_var($inName, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				
				if($inName == "" || !preg_match('/^[a-zA-Z0-9 \-_]*$/', $inName))
				{
					$validForm = false;
					$lastNameErrMsg = "Name cannot be spaces or special characters."; 
				}
			}//end validateName()			
			
			function validateZip($inZip)
			{
				global $validForm, $zipErrMsg;
				$zipErrMsg = "";
				
				if(empty($inZip))
				{
					$validForm = false;
					$zipErrMsg = "Zip Code required"; 					
				}
				else
				{
					 if(!preg_match('/^[0-9]{5}([- ]?[0-9]{4})?$/', $inZip))
					 {
						$validForm = false;
						$zipErrMsg = "Invalid Zip Code"; 
					 }
				}
			}//end validateZip()
			
			function validateNum($inNum)
			{
				global $validForm, $numErrMsg;
				$numErrMsg = "";
				
				if(empty($inNum))
				{
					$validForm = false;
					$numErrMsg = "Phone Number required"; 					
				}
				else
				{
					 if(!preg_match('/^[0-9]{3}[0-9]{3}[0-9]{4}$/', $inNum))
					 {
						$validForm = false;
						$numErrMsg = "Invalid Phone Number"; 
					 }
				}
			}//end validateZip()	
					
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
		
		//VALIDATE FORM DATA  using functions defined above
		$validForm = true;		//switch for keeping track of any form validation errors
		
		validateFirstName($presenter_first_name);
		validateLastName($presenter_last_name);
		validateZip($presenter_zip);
		validateNum($presenter_num);
		validateEmail($presenter_email);
		
		if($validForm)
		{
			$message = "All good";	

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
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>WDV341 Intro PHP - Form Validation Example</title>

<style>
#container	{
	width:600px;
	background-color:#CF9;
}

.errMsg	{
	color:red;
	font-style:italic;	
}
</style>
</head>

<body>

<div id="container">

	<h1>WDV341 Intro PHP</h1>
<h2>Form Validation Assignment


</h2>		
<?php
            //If the form was submitted and valid and properly put into database display the INSERT result message
			if($validForm)
			{
        ?>
            <h1><?php echo $message ?></h1>
            
                    <form id="presentersForm" name="presentersForm" method="post" action="addPresenter(1) (1).php">
        	<fieldset>
              <legend>Add a Registration</legend>
              <p>
                <label for="presenter_first_name">Special Request: </label>
                <input type="text" name="presenter_first_name" id="presenter_first_name" value="<?php echo $presenter_first_name;  ?>" /> 
                <span class="errMsg"> <?php echo $firstNameErrMsg; ?></span>
              </p>
              <p>
                <label for="presenter_last_name">Name: </label>  
                <input type="text" name="presenter_last_name" id="presenter_last_name" value="<?php echo $presenter_last_name;  ?>" />
                <span class="errMsg"><?php echo $lastNameErrMsg; ?></span>                
              </p>
               <p>
                <label for="presenter_num">Phone: </label>  
                <input name="presenter_num" type="text" id="presenter_num" value="<?php echo $presenter_num;  ?>"/>
                <span class="errMsg"><?php echo $numErrMsg; ?></span>                
              </p>
              <p>
                <label for="presenter_zip">Zip Code: </label> 
                <input type="text" name="presenter_zip" id="presenter_zip" value="<?php echo $presenter_zip;  ?>"/>
                <span class="errMsg"><?php echo $zipErrMsg; ?></span>                
              </p>
              <p>
                <label for="presenter_email">Email: </label> 
                <input type="text" name="presenter_email" id="presenter_email" value="<?php echo $presenter_email;  ?>"/>
                <span class="errMsg"><?php echo $emailErrMsg; ?></span>                
              </p>
    <p>Registration:</p>              
   <p>Phone
   <input type="radio" class="form-check-input" name="optradio" id="optradio1" value="Phone" <?php if (isset($_POST["optradio"]) && $_POST['optradio'] == 'Phone') echo ' checked="checked"';?>>
  </p>
  <p>Email
   <input type="radio" class="form-check-input" name="optradio" id="optradio2" value="Email" <?php if (isset($_POST["optradio"]) && $_POST['optradio'] == 'Email') echo ' checked="checked"';?>>
  </p>
  <p>US Mail
   <input type="radio" class="form-check-input" name="optradio" id="optradio3" value="US Mail" <?php if (isset($_POST["optradio"]) && $_POST['optradio'] == 'US Mail') echo ' checked="checked"';?>>
   <span class="errMsg"><?php echo $optErrMsg; ?><?php echo $present_opt; ?></span>
  </p>
  
   <p>Badge Holder:</p>              
   <p>Option 1
   <input type="radio" class="form-check-input" name="optradio2" id="optradio4" value="1" <?php if (isset($_POST["optradio2"]) && $_POST['optradio2'] == '1') echo ' checked="checked"';?>>
  </p>
  <p>Option 2
   <input type="radio" class="form-check-input" name="optradio2" id="optradio5" value="2" <?php if (isset($_POST["optradio2"]) && $_POST['optradio2'] == '2') echo ' checked="checked"';?>>
  </p>
  <p>Option 3
   <input type="radio" class="form-check-input" name="optradio2" id="optradio6" value="3" <?php if (isset($_POST["optradio2"]) && $_POST['optradio2'] == '3') echo ' checked="checked"';?>>
   <span class="errMsg"><?php echo $optErrMsg2; ?><?php echo $present_opt2; ?></span>
  </p>
  
   <input type="checkbox" id="meals" name="meals" value="Meals"  <?php if (isset($_POST["meals"])) {echo 'checked="checked"';} ?>>
  <label for="vehicle1"> Provided Meals (optional)</label><br> </form>
        
        <?php
			}
			else	//display form
			{
        ?>
        
       
        <form id="presentersForm" name="presentersForm" method="post" action="addPresenter(1) (1).php">
        	<fieldset>
              <legend>Add a Registration</legend>
              <p>
                <label for="presenter_first_name">Special Request: </label>
                <input type="text" name="presenter_first_name" id="presenter_first_name" value="<?php echo $presenter_first_name;  ?>" /> 
                <span class="errMsg"> <?php echo $firstNameErrMsg; ?></span>
              </p>
              <p>
                <label for="presenter_last_name">Name: </label>  
                <input type="text" name="presenter_last_name" id="presenter_last_name" value="<?php echo $presenter_last_name;  ?>" />
                <span class="errMsg"><?php echo $lastNameErrMsg; ?></span>                
              </p>
               <p>
                <label for="presenter_num">Phone: </label>  
                <input name="presenter_num" type="text" id="presenter_num" value="<?php echo $presenter_num;  ?>"/>
                <span class="errMsg"><?php echo $numErrMsg; ?></span>                
              </p>
              <p>
                <label for="presenter_zip">Zip Code: </label> 
                <input type="text" name="presenter_zip" id="presenter_zip" value="<?php echo $presenter_zip;  ?>"/>
                <span class="errMsg"><?php echo $zipErrMsg; ?></span>                
              </p>
              <p>
                <label for="presenter_email">Email: </label> 
                <input type="text" name="presenter_email" id="presenter_email" value="<?php echo $presenter_email;  ?>"/>
                <span class="errMsg"><?php echo $emailErrMsg; ?></span>                
              </p>
    <p>Registration:</p>              
   <p>Phone
   <input type="radio" class="form-check-input" name="optradio" id="optradio1" value="Phone" <?php if (isset($_POST["optradio"]) && $_POST['optradio'] == 'Phone') echo ' checked="checked"';?>>
  </p>
  <p>Email
   <input type="radio" class="form-check-input" name="optradio" id="optradio2" value="Email" <?php if (isset($_POST["optradio"]) && $_POST['optradio'] == 'Email') echo ' checked="checked"';?>>
  </p>
  <p>US Mail
   <input type="radio" class="form-check-input" name="optradio" id="optradio3" value="US Mail" <?php if (isset($_POST["optradio"]) && $_POST['optradio'] == 'US Mail') echo ' checked="checked"';?>>
   <span class="errMsg"><?php echo $optErrMsg; ?><?php echo $present_opt; ?></span>
  </p>
  
   <p>Badge Holder:</p>              
   <p>Option 1
   <input type="radio" class="form-check-input" name="optradio2" id="optradio4" value="1" <?php if (isset($_POST["optradio2"]) && $_POST['optradio2'] == '1') echo ' checked="checked"';?>>
  </p>
  <p>Option 2
   <input type="radio" class="form-check-input" name="optradio2" id="optradio5" value="2" <?php if (isset($_POST["optradio2"]) && $_POST['optradio2'] == '2') echo ' checked="checked"';?>>
  </p>
  <p>Option 3
   <input type="radio" class="form-check-input" name="optradio2" id="optradio6" value="3" <?php if (isset($_POST["optradio2"]) && $_POST['optradio2'] == '3') echo ' checked="checked"';?>>
   <span class="errMsg"><?php echo $optErrMsg2; ?><?php echo $present_opt2; ?></span>
  </p>
  
   <input type="checkbox" id="meals" name="meals" value="Meals"  <?php if (isset($_POST["meals"])) {echo 'checked="checked"';} ?>>
  <label for="vehicle1"> Provided Meals (optional)</label><br>

            </fieldset>
         	<p>
            	<input type="submit" name="submit" id="submit" value="Register" />
            	<input type="reset" name="button2" id="button2" value="Clear Form" onClick="clearForm()" />
        	</p>  
        </form>
        <?php
			}//end else
        ?>    	
        

    
	<footer>
    	<p>Copyright &copy; <script> var d = new Date(); document.write (d.getFullYear());</script> All Rights Reserved</p>
    
    </footer>




</div>
</body>
</html>