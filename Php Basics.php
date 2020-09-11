<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - PHP Basics</title>
</head>

<body>

<h1> <?php echo "<h1>WDV341 3-1:PHP Basics</h1>"; ?> </h1>

<?php
	$yourName = "Savanna Kohler";
?>

<?php
	echo "<h2>My name is " . $yourName . " </h2>";	
?>
<?php
	$number1 = 2;		
?>
<?php
	$number2 = 4;		
?>
<?php
	$total = 6;		
?>

<?php echo "<p>$number1</p>"; ?>
<?php echo "<p>$number2</p>"; ?>
<?php echo "<p>$total</p>"; ?>

<script>
	<?php $Languages = array("PHP", "HTML", "Javascript"); ?>

	<?php echo "document.write( '<h3>$Languages[0] $Languages[1] $Languages[2]</h3>' );"; ?>

	<?php $new = "'PHP ', 'HTML ', 'Javascript'"; ?>

	let langs = [<?php echo $new; ?>];

	document.write(langs);
	
</script>

<p>&nbsp;</p>
</body>
</html>

