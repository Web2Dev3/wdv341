<?php
	//Get the Event data from the server.
    require 'connectPDO.php';

try {
    $stmt = $conn->prepare("SELECT product_name, product_description, product_price, product_image, product_inventory, product_category, product_special FROM wdv341_final");
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
	<title>facts.html</title>
<!--Author: Savanna Kohler
Date: March 12th 2020-->

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="about products">
<meta name="keywords" content="products, learn">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  

<link rel="stylesheet" type="text/css" href="css/boot-site.css">


<link href="https://fonts.googleapis.com/css?family=Lobster+Two&display=swap" rel="stylesheet">	
<style>
h3 {
color:#ED79BE;
text-align: center;
}

h3 ~ p::first-letter {
  color:hotpink;
  font-weight: bold;
}

ul > li {
  font-size: 25px;
  color:#128A42;
}

h4 + p::first-line {
  background-color: AntiqueWhite;
  color: forestgreen;
}

p a {
color:white;
}
	.productImage img {
			display:block;
			margin-left:auto;
			margin-right:auto;
			width:80%;
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
			color:white;
		}
		.productStatus {
			text-align:center;
			font-weight:bolder;
			color:green;
			text-shadow: 1px 1px black;
		}
		
		.productInventory {
			text-align:center;
		}
		
		.productLowInventory {
			color:red;
		}
button {
background-color: green;
color: white;
margin-left: 180px;
}

button:hover {
background-color: white;
color: green;
}
</style>
<script>
var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		  if (this.readyState == 4 && this.status == 200) {
			  console.log(this.responseText);
			var myObj = JSON.parse(this.responseText);
			document.getElementById("promo").innerHTML = "Use the code " + myObj.promoCode + " for "
+ myObj.promoDiscount + " off purchases of $" + myObj.promoPrice + "! Expires " + myObj.expireDate + ".";
		  }
		};
		xmlhttp.open("GET", "deliverEventObject.php", true);
		xmlhttp.send();		
</script>
</head>
<body>

<div class="container-fluid" style="border:2px solid #00621C; box-shadow:5px 5px grey;">
<div class="row">

<div class="col-sm-12" style="background-color:#34590A;">	
<nav class="navbar navbar-expand-lg navbar-dark">
 <div class="d-none d-md-block">
	<a style="font-weight:bold;" class="navbar-brand" href="index.html">
	<img  style="max-width: 60px; max-height: 100px; border: none;"  src="images/urban-logo.png" alt="logo for company" width="45" class="img-responsive">Academic Project
	</a>
	</div>
  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
     <li class="nav-item">
        <a class="nav-link" href="index.html">Home</a>
      </li> 
    <li class="nav-item">
        <a class="nav-link" href="about.html">About Us</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="facts.php">Products</a>
      </li> 
        <li class="nav-item">
        <a class="nav-link" href="gallery.html">Gallery</a>
      </li> 
        <li class="nav-item">
        <a class="nav-link" href="form.php">Contact Us</a>
      </li> 
        <li class="nav-item">
        <a class="nav-link" href="login.php">Admin</a>
      </li> 
    </ul>
  </div>
          <div class="d-flex ml-auto">
                    <form class="form-inline">
      <input class="form-control ml-sm-5" type="search" placeholder="Search" aria-label="Search">
    </form>
    <i class="fa fa-search" style="font-size: 2.13em; color: green; margin-left: 10px;"></i>
  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".collapse" aria-controls="collapsibleNavbar collapsibleNavbar2">
    <span class="navbar-toggler-icon"></span>
  </button>
  </div> 
</nav>
</div>

<div class="col-sm-12" style="background-color:#34590A;">
<h1>Our Products</h1>

</div>
<div class="col-md-12" style="background-color:#34590A;">

<p id="promo" style="text-align:center;"></p>

</div>
<?php
	//Display each row as formatted output in the div below
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):

if($row['product_inventory'] < 10)
{
     $design="productInventory productLowInventory";
}
else {
    $design="productInventory";
}

if($row['product_special'] == "")
{
     $designClass="";
}
else {
    $designClass="productStatus";
}

?>
	<div class="col-md-4" style="background-color:#34590A;">
		<div class="productImage">
                <image src="images/<?php echo $row['product_image'];?>">	
		</div>
		<p class="productName"><?php echo $row['product_name'];?></p>	
		<p class="productDesc"><?php echo $row['product_description'];?></p>
		<p class="productPrice">$<?php echo $row['product_price'];?></p>
		<p class="<?php echo $designClass;?>"><?php echo $row['product_special'];?></p>
		<p class="<?php echo $design;?>"><?php echo $row['product_inventory'];?> In Stock</p>
		<p class="productName">Category: <?php echo $row['product_category'];?></p>
		<button>Buy Now!</button><br>
	</div>
<?php
endwhile;

	//Close the database connection

$conn = null;	
?>	

<div id="footer" class="col-sm-12" style="margin-top: 20px; color:white; background-image: linear-gradient(to bottom left, #128A42, #00621C);  display: flex; justify-content: flex-end; justify-content: space-between;">
<p>
©Copyright 2020 Urban Gardens LTD. All rights reserved.</p>
<p><a href="#" class="fa fa-facebook"></a>
<a href="#" class="fa fa-twitter"></a>
<a href="#" class="fa fa-instagram"></a>
</p>
</div>

</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
