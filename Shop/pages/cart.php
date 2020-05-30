
<div class="col-sm-9 col-md-9 col-lg-9">

<form action="index.php?page=2" method="POST">
		<?php

		include_once("classes.php");

		$ruser='';
		if(!isset($_SESSION['ruser']) || !isset($_SESSION['radmin']))
		{
			$ruser='cart';
		}
		else
		{
			$ruser= (isset($_SESSION['ruser']))? $_SESSION['ruser'] : $_SESSION['radmin'];
		}


		$total =0;
		foreach ($_COOKIE as $k => $v)
		{
	    	$pos=strpos($k,"_");
			if(substr($k,0,$pos)==$ruser)
			{
	    		$id=substr($k,$pos+1);       
	    		$ng= Good::fromDb($id);

	    		$total+=$ng[0]->price;
				$ng[0]->DrawForCart();
	    	}
	    		
		}

		echo "	<span>Total price: ".$total." $</span>";
	    
		?>

		<input type="submit" name="sale" value="Купить" class="btn btn-success">
		<!-- <button  name="sale" class="btn btn-success" onclick="SaleGoods()">Купить</button> -->

</form>
</div>

<?php 

	if(isset($_POST['sale']))
	{
		foreach($_COOKIE as $k => $v)
    	{
	        $pos=strpos($k,"_");
	        if(substr($k,0,$pos) == $ruser)
	        {
	           echo $k;
	            $id=substr($k, $pos+1);            
	           	Good::Sale($id);
	           	setcookie($k, '', time() - 60 * 1000 * 30, '/');
	        }
   		}
	}

 ?>



<script type="text/javascript">
	function deleteCookie(uname) 
    {
        var theCookies = document.cookie.split(';');
	    for (var i = 1 ; i <= theCookies.length; i++) 
	    {
	        
		      if(theCookies[i-1].indexOf(uname) === 1)
		      {
		        var theCookie=theCookies[i-1].split('=');
		        
		        var date = new Date(new Date().getTime() - 60 * 1000 * 30);
		        document.cookie = theCookie[0]+"="+"id"+"; path=/; expires=" + 
		            date.toUTCString();
		      }
	    }
    }

</script>
