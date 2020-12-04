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
		
		 require('validate.php');

  		$errors = [];
		
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
		
		$validation = new UserValidator($_POST);
   		 $errors = $validation->validateForm(); 
   		 
   		 if (empty($errors)) {
   		 $validForm = true;
   		  }
   		 
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
            
                    <form id="presentersForm" name="presentersForm" method="post" action="addPresenter.php">
        	<fieldset>
              <legend>Add a Registration</legend>
              <p>
                <label for="presenter_first_name">Special Request: </label>
                <input type="text" name="presenter_first_name" id="presenter_first_name" value="<?php echo $presenter_first_name;  ?>" /> 
                <span class="errMsg"><?php echo $errors['presenter_first_name'] ?? '' ?></span>
              </p>
              <p>
                <label for="presenter_last_name">Name: </label>  
                <input type="text" name="presenter_last_name" id="presenter_last_name" value="<?php echo $presenter_last_name;  ?>" />
                <span class="errMsg"><?php echo $errors['presenter_last_name'] ?? '' ?></span>                
              </p>
               <p>
                <label for="presenter_num">Phone: </label>  
                <input name="presenter_num" type="text" id="presenter_num" value="<?php echo $presenter_num;  ?>"/>
                <span class="errMsg"><?php echo $errors['presenter_num'] ?? '' ?></span>                
              </p>
              <p>
                <label for="presenter_zip">Zip Code: </label> 
                <input type="text" name="presenter_zip" id="presenter_zip" value="<?php echo $presenter_zip;  ?>"/>
                <span class="errMsg"><?php echo $errors['presenter_zip'] ?? '' ?></span>                
              </p>
              <p>
                <label for="presenter_email">Email: </label> 
                <input type="text" name="presenter_email" id="presenter_email" value="<?php echo $presenter_email;  ?>"/>
                <span class="errMsg"><?php echo $errors['presenter_email'] ?? '' ?></span>                
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
        
       
        <form id="presentersForm" name="presentersForm" method="post" action="addPresenter.php">
        	<fieldset>
              <legend>Add a Registration</legend>
              <p>
                <label for="presenter_first_name">Special Request: </label>
                <input type="text" name="presenter_first_name" id="presenter_first_name" value="<?php echo $presenter_first_name;  ?>" /> 
                <span class="errMsg"><?php echo $errors['presenter_first_name'] ?? '' ?></span>
              </p>
              <p>
                <label for="presenter_last_name">Name: </label>  
                <input type="text" name="presenter_last_name" id="presenter_last_name" value="<?php echo $presenter_last_name;  ?>" />
                <span class="errMsg"><?php echo $errors['presenter_last_name'] ?? '' ?></span>                
              </p>
               <p>
                <label for="presenter_num">Phone: </label>  
                <input name="presenter_num" type="text" id="presenter_num" value="<?php echo $presenter_num;  ?>"/>
                <span class="errMsg"><?php echo $errors['presenter_num'] ?? '' ?></span>                
              </p>
              <p>
                <label for="presenter_zip">Zip Code: </label> 
                <input type="text" name="presenter_zip" id="presenter_zip" value="<?php echo $presenter_zip;  ?>"/>
                <span class="errMsg"><?php echo $errors['presenter_zip'] ?? '' ?></span>                
              </p>
              <p>
                <label for="presenter_email">Email: </label> 
                <input type="text" name="presenter_email" id="presenter_email" value="<?php echo $presenter_email;  ?>"/>
                <span class="errMsg"><?php echo $errors['presenter_email'] ?? '' ?></span>                
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