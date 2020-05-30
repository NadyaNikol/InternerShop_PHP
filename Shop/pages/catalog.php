<?php 
 include_once('classes.php');
 ?>



<div class="col-sm-12 col-md-12 col-lg-12" style="margin:10px;">

	<select class="pull-right" name="catid" onchange="getItemsCat(this.value)" >
      <option value="0">All</option>


    <?php
    

      try 
      {

        $categ = Categories::fromDb();

         foreach ($categ as $c)
         {
         	 echo "<option value='".$c->id."'>".$c->name."</option>";
         }

      } 

     catch (Exception $e) { echo $e->getMessage();}
    ?>
</select>

<div class="row" id="result" style="margin-right: 10px;"></div>

</div>

<script type="text/javascript">

	window.onload = getItemsCat('0');

	function getItemsCat(value)
	{
	/*	if(value=='0')
		{
			document.getElementById("result").innerHTML = value;
		}*/

		if(window.XMLHttpRequest)
		{
			 ao = new XMLHttpRequest(); 
		}

		else
		{
			ao =new ActiveXObject('Microsoft.XMLHTTP');
		}

			
		ao.onreadystatechange = function(){

		if(ao.readyState == 4 && ao.status == 200)
		{				
			resp = ao.responseText;
			document.getElementById("result").innerHTML = resp;
		} }


		ao.open("POST", "pages/ajaxLists.php", true);
		ao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		ao.send("id=" +value);
		
	}

	function createCookie(uname,id)
	{
		var date = new Date(new Date().getTime() + 60 *1000 * 30);
		document.cookie = uname+"="+id+"; path=/; expires=" + date.toUTCString();
	}


</script>