<?php
include_once('classes.php');

$cat=$_POST['id'];
$pdo=Tools::connect();

$goods =  Good::GetGood($cat);


if($goods==null) exit();



	foreach ($goods as $g) {
		$g->Draw();
	}
?>