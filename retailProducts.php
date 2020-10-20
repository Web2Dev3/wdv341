<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<?php
	//Get the Event data from the server.
    require 'connectPDO.php';

try {
    $stmt = $conn->prepare("SELECT product_name, product_description, product_price, product_image, product_inStock, product_status FROM wdv341_products ORDER BY product_name DESC");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}



?>	
	<style>
	
		.productBlock	{
			
			width:300px;
			background-color: aquamarine;
			border:thin solid black;
		}
		
		.productImage img {
			display:block;
			margin-left:auto;
			margin-right:auto;
			width:280px;
			height:280px;				
		}
	
		.productName {
			text-align:center;
			font-size: large;
		}	
		
		.productDesc {
			margin-left:10px;
			margin-right:10px;
			text-align:justify;
		}
		
		.productPrice {
			text-align: center;
			font-size:larger;
			color:blue;
		}
		
		.productStatus {
			text-align:center;
			font-weight:bolder;
			color:darkslategray;
		}
		
		.productInventory {
			text-align:center;
		}
		
		.productLowInventory {
			color:red;
		}
		
	</style>
</head>

<body>
	
	<h1>DMACC Electronics Store!</h1>
	<h2>Products for your Home and School Office</h2>
<?php
	//Display each row as formatted output in the div below
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):

if($row['product_inStock'] < 10)
{
     $design="productInventory productLowInventory";
}
else {
    $design="productInventory";
}

if($row['product_status'] == "")
{
     $designClass="";
}
else {
    $designClass="productStatus";
}

?>	
	<div class="productBlock">
		<div class="productImage">
                <image src="productImages/<?php echo $row['product_image'];?>">	
		</div>
		<p class="productName"><?php echo $row['product_name'];?></p>	
		<p class="productDesc"><?php echo $row['product_description'];?></p>
		<p class="productPrice"><?php echo $row['product_price'];?></p>
		<p class="<?php echo $designClass;?>"><?php echo $row['product_status'];?></p>
		<p class="<?php echo $design;?>"><?php echo $row['product_inStock'];?> In Stock</p>
	</div>
<?php
endwhile;

	//Close the database connection

$conn = null;	
?>	
</body>
</html>