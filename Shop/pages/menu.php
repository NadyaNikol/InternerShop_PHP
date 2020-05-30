<?php $page = $_GET['page'] ?>

<nav type="GET" class="navbar navbar-dark bg-dark">
<ul class="nav nav-pills">
  <li class="nav-item">
    <a <?php echo ($page==1)? "class='nav-link active'": "class='nav-link'" ?> href="index.php?page=1">Catalog</a>
  </li>
  <li class="nav-item">
    <a <?php echo ($page==2)? "class='nav-link active'": "class='nav-link'" ?> href="index.php?page=2">Cart</a>
  </li>
  <li class="nav-item">
    <a <?php echo ($page==3)? "class='nav-link active'": "class='nav-link'" ?> href="index.php?page=3">Registration</a>
  </li>
  <li class="nav-item">
    <a <?php echo ($page==4)? "class='nav-link active'": "class='nav-link'" ?> href="index.php?page=4">Admin Forms</a>
  </li>
<!-- 
<?php
//if(isset($_SESSION['radmin']))
{
?> -->
  <!--  <li class="nav-item">
   <a <?php /*echo ($page==5)? "class='nav-link active'": "class='nav-link'"*/ ?> href="index.php?page=5">Reports</a>
    </li> -->

<!-- <?php
}

?> -->

</ul>
<?php
include_once('pages/enter.php');
?>

</nav>