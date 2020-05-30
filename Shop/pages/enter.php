<?php
if($_SESSION['ruser'] || $_SESSION['radmin'])
{

	$user = ($_SESSION['ruser'])? $_SESSION['ruser'] : $_SESSION['radmin'];

	echo '<div class="pull-right" style="color:white;">';
	echo '<form action="index.php';

	if(isset($_GET['page'])) echo '?page='.$_GET['page'].'" ';

	echo 'class="form-inline " method="post">';
	echo '<h4>Hello, <span>'.$user.'</span>&nbsp;';
	echo '<input style="color:lightblue;" type="submit" value="Logout" id="ex" name="ex" class="btn btn-default btn-xs"></h4>';
	echo '</form>';
	echo '</div>';

	if($_POST['ex'])
	{
		unset($_SESSION['ruser']);
		unset($_SESSION['radmin']);
		echo '<script>window.location.reload()</script>';
	}
}

else
{

	if(!isset($_POST['submit']))
	{
		echo '<div class="pull-right">';
		echo '<form action="index.php';

		if(isset($_GET['page'])) echo '?page='.$_GET['page'].'" ';

		echo 'class="form-inline " method="post">';
		echo ' <div class="form-group mx-sm-3 mb-2">
	    <label class="sr-only">Email</label>
	    <input name ="log" type="text" class="form-control mr-sm-2" placeholder="Login">
	  </div>
	  <div class="form-group mx-sm-3 mb-2">
	    <label class="sr-only">Password</label>
	    <input name ="pass" type="text" class="form-control mr-sm-2" placeholder="Password">
	  </div>
	  <input type="submit" name="submit" class="btn btn-primary mb-2">
	</form>';
	echo '</div>';

	}

	else
	{
		include_once('classes.php');
		if(Customer::login($_POST['log'], $_POST['pass']))
			echo '<script>window.location.reload()</script>';

	}
}



?>