<?php
	
	$productObj = new stdClass();
	
	$productObj->productName = "PHP Textbook";
	$productObj->productPrice = "$129.95";
	$productObj->productPageCount = "327";
	$productObj->productISBN = "13-123443569";
//
	$returnObj = json_encode($productObj);	//create the JSON object
//	
	echo $returnObj;							//send results back to calling program
?>