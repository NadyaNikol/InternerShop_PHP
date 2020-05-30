<?php 
include_once('classes.php');
$_GET['page'] = 3;

 ?>

<h5>Registration form</h5>


<form action="index.php?page=3" method="POST">
  <div class="form-group">
    <label for="login">Login</label>
    <input type="text" class="form-control" name="login" aria-describedby="Login" oninput ="EnterLogin(this.value)">
    <small id="Login" class="form-text text-muted">Enter login</small>
    <span id="errorLogin" style="color: red"></span>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password">
  </div>
   <div class="form-group">
    <label for="confirmPassword">Confirm Password</label>
    <input type="password" class="form-control" name="confirmPassword">
    <small id="Login" class="form-text text-muted">Confirm the password</small>
  </div>
 <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
    <small id="Email" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <input type="submit" class="btn btn-primary" value="Submit" name = "ok">
</form>



<?php 

if(isset($_POST['ok']))
{
	if($_POST['password'] == $_POST['confirmPassword'])
	{
		if(Tools::register($_POST['login'], $_POST['password'], $_POST['email']))
      echo "<h3><span style='color:green'>NEW USER ADDED</span></h3>";
	}

  else
  {
  	echo "<h3><span style='color:red'>password and password confirmation do not match</span></h3>";
  }

}



 ?>

 <script type="text/javascript">
   
function EnterLogin(value)
{
  /*if(value=='0')
  {
    document.getElementById("errorLogin").innerHTML = "";
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

    if(resp=="true")
     document.getElementById("errorLogin").innerHTML = "This login are already exist";

   else
     document.getElementById("errorLogin").innerHTML = "";

  } }


  ao.open("POST", "pages/ajaxLogin.php", true);
  ao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  ao.send("text=" + value);
}


 </script>