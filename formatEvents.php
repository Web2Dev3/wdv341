<?php
	//Get the Event data from the server.
    require 'connectPDO.php';

try {
    $stmt = $conn->prepare("SELECT event_name, event_description, event_presenter, event_date, event_time FROM wdv341_event ORDER By event_name, event_description, event_presenter, event_date, event_time DESC");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}



?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>WDV341 Intro PHP  - Display Events Example</title>
    <style>
		.eventBlock{
			width:500px;
			margin-left:auto;
			margin-right:auto;
			background-color:#CCC;	
		}
		
		.displayEvent{
			text_align:left;
			font-size:18px;	
		}
		
		.displayDescription {
			margin-left:100px;
		}
	</style>
</head>

<body>
    <h1>WDV341 Intro PHP</h1>
    <h2>Example Code - Display Events as formatted output blocks</h2>   
    <h3>??? Events are available today.</h3>

<?php
	//Display each row as formatted output in the div below
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
$status=$row['event_date'];
$name=$row['event_name'];
if($status=="2018-10-25")
{
    $design="color:red";
}
else if($status>"2020")
{
	$design="font-style:italic";
}
else 
{
    $design="color:black";
}

if($status=="2018-10-25" && $status>"2020")
{
     $design="color:red; font-style:italic";
}
?>
	<p>
        <div class="eventBlock">	
            <div>
            	<span class="displayEvent">Event:<?php echo "<table><tr><td></td><td></td><td></td><td></td><td></td><td style='$design'>".$name ."</td></tr></table>";?></span>
                <span>Presenter:<?php echo $row['event_presenter'];?></span>
            </div>
            <div>
            	<span class="displayDescription">Description:<?php echo $row['event_description'];?></span>
            </div>
            <div>
            	<span class="displayTime">Time:<?php echo $row['event_time'];?></span>
            </div>
            <div>
            	<span class="displayDate">Date:<?php echo $row['event_date'];?></span>
            </div>
        </div>
    </p>

<?php
endwhile;

	//Close the database connection

$conn = null;	
?>
</div>	
</body>
</html>