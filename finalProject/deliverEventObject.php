<?php
	//Get the Event data from the server.
    require 'connectPDO.php';

try {
    $stmt = $conn->prepare("SELECT discount, promo_price, code_name, date_expires FROM wdv341_promo WHERE id=1");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$row = $stmt->fetch(PDO::FETCH_ASSOC);

$orgDate = $row['date_expires'];
$newDate = date("m-d-Y", strtotime($orgDate));

$outputObj = new stdClass();

	$outputObj->promoDiscount = $row['discount'];
	$outputObj->promoPrice = $row['promo_price'];
	$outputObj->promoCode = $row['code_name'];
	$outputObj->expireDate = $newDate;
//
	$returnObj = json_encode($outputObj);	//create the JSON object
//	
	echo $returnObj;
	
	$conn = null;	

?>
