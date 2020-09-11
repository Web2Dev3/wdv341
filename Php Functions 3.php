
<h1> <?php echo "<h1>WDV341:PHP Functions</h1>"; ?> </h1>
<?php
$departmentName = " DMACC Mailing Department ";
function dateFormat() {
$date=date_create("2020-9-8");
return date_format($date,"m/d/Y") . "<br>";
}

function dateInt() {
$date=date_create("2020-9-8");
return date_format($date,"d/m/Y") . "<br>";
}

function characterCount($inString)
{
        $new_string=trim($inString);
	return 	strlen($new_string) . " " . strtoupper(substr($new_string,0,6)) . strtolower(substr($new_string,6)) . " " . "<br>";	
}

function printNum() {
$num1 = 1234567890;
return number_format($num1) . "<br>";
}

function printCurrency() {
$num2 = 123456;
return "$" . number_format($num2, 2) . " USD";
}
?>
<?php echo dateFormat(); ?>

<?php echo dateInt(); ?>

<?php echo characterCount($departmentName); ?>

<?php echo printNum(); ?>

<?php echo printCurrency(); ?>

