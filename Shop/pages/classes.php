<?php

/**
 * 
 */
class Tools 
{

/*	function __construct(argument)
	{
		# code...
	}*/

	static function connect( $host="localhost", $user="root", $pass="", $dbname="shop")
	{
		$cs='mysql:host='.$host.';dbname='.$dbname.';charset=utf8;';
		$options=array(
			PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
			PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8'); 

		try
		{
			$pdo=new PDO($cs,$user,$pass,$options);
			return $pdo;
		}

		catch(PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	static function register($login, $password, $email)
	{
		$ll= strlen($login);
		$lp= strlen($password);

		if($ll < 3 || $ll > 30 || $lp < 3 || $lp > 30)
		{
			echo "<h3><span style='color:red'>VALUES LENGTH MUST BE BETWEEN 3 AND 30</span></h3>";
			return false;
		}

		$c = new Customer($login, $password, $email, 2, NULL, NULL);
		$c->intoDb();
		return true;

	}
}



class Customer 
{
	public $id;
	public $login;
	public $pass;
	public $email;
	public $roleid;
	
	function __construct($login, $pass, $email, $roleid, $id=0)
	{
		$this->login = $login;
		$this->pass = $pass;
		$this->email = $email;
		$this->roleid = $roleid;
		$this->id = $id;
	}

	function intoDb()
	{

		try 
		{
			$pdo = Tools::connect();
			$ar=(array)$this;
			array_shift($ar);
				/*	var_dump($ar);*/
			$ps1 = $pdo->prepare("INSERT INTO customers (login, pass, email, roleid) VALUES ( :login, :pass, :email, :roleid)");
			$ps1->execute($ar);
		} 

		catch (Exception $e) 
		{
			$err=$e->getMessage();

			if(substr($err, 0, strrpos($err,":")) == 'SQLSTATE[23000]:Integrity constraint violation')
			return 1062;

			else return $e->getMessage();
		}
	}

	static function fromDb($id=0, $login="", $pass="") 
	{
		$pdo = Tools::connect();

		try
		{
			$pss="";
			if($login=="" && $pass=="")
			$pss = ($id==0)? $pdo->query("SELECT * FROM customers"): $pdo->query("SELECT * FROM customers where id=".$id);

			else if($login!="" && $pass=="")
				$pss = $pdo->query("SELECT * FROM customers where login='".$login);

			else 
				$pss = $pdo->query("SELECT * FROM customers where login='".$login."' && pass='".$pass."'");
		
			/*$list=$ps->execute();*/
			/*var_dump($ps);*/
			/*return $ps;*/


			$cust;

			 while ($row=$pss->fetch())
			{

				$cust[] = new Customer($row['login'], $row['pass'], $row['email'], $row['roleid'], $row['id']);
			}

			return $cust;
		} 

		catch (Exception $e) { echo $e->getMessage();}	
	}

	static function login($login, $password)
	{

		$ps3 = Customer::fromDb(0, $login, $password);

		if ($ps3!=NULL)
		{
			
			if($ps3[0]->roleid=="1")
			$_SESSION['radmin'] = $login;

			else
			$_SESSION['ruser'] = $login;

			return true;

		}

		echo ' <script>window.location = "index.php?page=3";</script>';
		return true;
	}

}


class Good 
{
	public $id;
	public $title;
	public $price;
	public $categoryid;
	public $image;
	public $info;
	
	function __construct($title, $price, $categoryid, $image, $info, $id=0)
	{
		$this->title = $title;
		$this->price = $price;
		$this->categoryid = $categoryid;
		$this->image = $image;
		$this->info = $info;
		$this->id = $id;
	}

	function intoDb()
	{
		try 
		{
			$pdo = Tools::connect();
			$ar=(array)$this;
			array_shift($ar);
/*					var_dump($ar);*/
			$ps1 = $pdo->prepare("INSERT INTO goods (title, price, categoryid, image, info) VALUES (:title, :price, :categoryid, :image, :info)");
			$ps1->execute($ar);
			/*if ($ps1->rowCount() > 0) { echo "string"; return true;}*/
		} 

		catch (Exception $e) 
		{
			$err=$e->getMessage();

			if(substr($err, 0, strrpos($err,":")) == 'SQLSTATE[23000]:Integrity constraint violation')
			return 1062;

			else return $e->getMessage();
		}
	}

	static function fromDb($id=0) 
	{
		try
		{
			$pdo = Tools::connect();
			$ps = ($id==0)? $pdo->query("SELECT * FROM goods"): $pdo->query("SELECT * FROM goods where id=".$id);

			$goods;

			 while ($row=$ps->fetch())
			{

				$goods[] = new Good($row['title'], $row['price'], $row['categoryid'], $row['image'], $row['info'], $row['id']);
			}

			return $goods;
		} 

		catch (Exception $e) { echo $e->getMessage();}	
	}

	static function GetGood($categoryId=0)
    {

 		try{

        	$pdo = Tools::connect();
			$ps = ($categoryId==0)? $pdo->query("SELECT * FROM goods"): $pdo->query("SELECT * FROM goods where categoryid=".$categoryId);

			$goods;
			
			 while ($row=$ps->fetch())
			{
				$goods[] = new Good($row['title'], $row['price'], $row['categoryid'], $row['image'], $row['info'], $row['id']);
			}

			return $goods;
 		  }

 		catch (Exception $e) { echo $e->getMessage();}	

 	}

	function Draw()
	{
		$ruser='';
		if(!isset($_SESSION['ruser']) || !isset($_SESSION['radmin']))
		{
			$ruser='cart_'.$this->id;
		}
		else
		{
			$ruser= (isset($_SESSION['ruser']))? $_SESSION['ruser'].'_'.$this->id : $_SESSION['radmin'].'_'.$this->id;
		}

		/*$ar2=(array)$this;*/

		echo '<div class="card text-center card border-dark mb-3" style="width: 18rem; position: relative; margin:1%;">
  			<img src="images/'.$this->image.'" class="card-img-top" alt="Нет изображения" style="width: 12rem; height: 10rem;">
  			<span style="position: absolute; left: 200px; top: 50px; color: red; font-size:20px;">'.$this->price.' $</span>
	  		<div class="card-body">
		    	<h5 class="card-title">'.$this->title.'</h5>
		   		<p class="card-text">'.$this->info.'</p>
		    	<button name="addToCart" class="btn btn-success"  onclick=createCookie("'.$ruser.'","'.$this->id.'")>Add to my cart</button>';
		    	echo '</div>';
				echo '</div>';
	}

	 function DrawForCart()
	{
		$ruser='';
		if(!isset($_SESSION['ruser']) || !isset($_SESSION['radmin']))
		{
			$ruser='cart_'.$this->id;
		}
		else
		{
			$ruser= (isset($_SESSION['ruser']))? $_SESSION['ruser'].'_'.$this->id : $_SESSION['radmin'].'_'.$this->id;
		}


				echo '<ul class="list-group" style="margin: 2%;">
		  <li class="list-group-item d-flex justify-content-between align-items-center">
		    <img src="images/'.$this->image.'" class="card-img-top" alt="Нет изображения" style="width: 5rem; height: 3rem;">
		    <h5 class="card-title">'.$this->title.'</h5>
		    <span class="card-title" style="color:red;">'.$this->price.' $</span>
		    <button class="badge badge-primary badge-pill btn btn-danger" onclick=deleteCookie("'.$ruser.'")>&#10008;</button>';
		  echo '</li>';
		echo '</ul>';
	}

	static function Sale($id)
	{
		try 
		{
			$pdo = Tools::connect();
			$pdo2 = Tools::connect();
			$ps2 = $pdo2->prepare("INSERT INTO sales (goodid) VALUES (:goodid)");
			$ps = $pdo->prepare("DELETE FROM goods WHERE id = ?");
		
			#$ps = $pdo->query("SELECT * FROM goods");
			$list2=$ps2->execute(array("goodid" => $id));
			$list=$ps->execute(array($id));
			
			
		} 
		catch (Exception $e) { echo $e->getMessage();}	
	}

}


class Categories
{
	public $id;
	public $name;
	
	function __construct($name,$id=0)
	{
		$this->name = $name;
		$this->id = $id;
	}

	static function fromDb()
	{
		$pdo = Tools::connect();

		try
		{
			$ps = $pdo->query("SELECT * FROM categories");
		
			$cats;

			 while ($row=$ps->fetch())
			{
				$cats[] = new Categories($row['name'], $row['id']);
			}

			return $cats;
		} 

		catch (Exception $e) { echo $e->getMessage();}	
	}
}



class Sale 
{
	public $id;
	public $goodid;
	
	function __construct($goodid, $id=0)
	{
		$this->id = $id;
		$this->goodid = $goodid;
	}

	function intoDb()
	{
		try 
		{
			$pdo = Tools::connect();
			$ar=(array)$this;
			array_shift($ar);
/*					var_dump($ar);*/
			$ps1 = $pdo->prepare("INSERT INTO sales (goodid) VALUES (:goodid)");
			$ps1->execute($ar);
			/*if ($ps1->rowCount() > 0) { echo "string"; return true;}*/
		} 

		catch (Exception $e) 
		{
			$err=$e->getMessage();

			if(substr($err, 0, strrpos($err,":")) == 'SQLSTATE[23000]:Integrity constraint violation')
			return 1062;

			else return $e->getMessage();
		}
	}


}




?>