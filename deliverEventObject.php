<?php
	//Get the Event data from the server.
    require 'connectPDO.php';

try {
    $stmt = $conn->prepare("SELECT event_name, event_description, event_presenter, event_date, event_time FROM wdv341_event WHERE event_id=1");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$row = $stmt->fetch(PDO::FETCH_ASSOC);

$outputObj = new stdClass();

	$outputObj->eventName = $row['event_name'];
	$outputObj->eventDescription = $row['event_description'];
	$outputObj->eventPresenter = $row['event_presenter'];
	$outputObj->eventDate = $row['event_date'];
	$outputObj->eventTime = $row['event_time'];
//
	$returnObj = json_encode($outputObj);	//create the JSON object
//	
	echo $returnObj;

?>
