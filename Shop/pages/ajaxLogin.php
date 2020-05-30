<?php

include_once('classes.php');
		$pdo = Tools::connect();

		$text = $_POST['text'];
		$text = strtolower($text);


		$cust = Customer::fromDb(0, $text);
		if(count(var) > 0) echo "true";

/*		try 
		{*/
			/*$ps = $pdo->prepare("SELECT login FROM customers where login= (:t)");
			$ps->execute(array("t" => $text));*/

			/*$ps = $pdo->prepare("SELECT login FROM customers where login= ?");
			$ps->execute(array($text));


			if(count(var) > 0) echo "true";*/
			
/*		} 
		catch (Exception $e) {
			echo $e->getMessage();
		}*/
		

		/*if ($ps->rowCount() > 0)
		{
			$f2 = mysqli_fetch_array($q2);
			echo "<option value = '$f2[0]'>$f2[1]</option>";
			echo "true";
		}*/

?>