<?php 
	session_start();
	#include_once('pages/functions.php');
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Internet Shop</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>



<div class="container">
	<div class="row">
		<header class="col-sm-12 col-md-12 col-lg-12">
			<?php
			include_once('pages/menu.php'); 
	/*include_once('pages/enter.php');*/
			?>
		</header>
	</div>


<div class="row">
	<nav class="col-sm-12 col-md-12 col-lg-12">

<?php ?>

		
	</nav>
</div>


<div class="row">
	<section class="col-sm-12 col-md-12 col-lg-12">
		<?php

		if(isset($_GET['page']))
		{
			$page = $_GET['page'];
			if($page == 1) include_once('pages/catalog.php');
			if($page == 2) include_once('pages/cart.php');
			if($page == 3) include_once('pages/registration.php');
			if($page == 4) include_once('pages/admin.php');
			if(($page == 5) && (isset($_SESSION['radmin']))) include_once('pages/reports.php');
		}
		?>

	</section>
</div>


</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>


	
</body>
</html>