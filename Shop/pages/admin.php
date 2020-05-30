<?php 
if($_SESSION['radmin']) {
 ?>

    <div class="col-sm-6 col-md-6 col-lg-6">



<form action="index.php?page=4" method="POST" enctype='multipart/form-data'>
  <h5>Add new good</h5>
  <div class="form-group">
    <label for="title">Title </label>
    <input type="text" class="form-control" name="title" >
  </div>
  <div class="form-group">
    <label for="price">Price </label>
    <input type="text" class="form-control" name="price">
  </div>
  <div class="form-group">
    <label for="categoryid">Categories</label>
    <select class="form-control" name="categoryid">
      <!-- <option>2</option>
     <option>3</option>
     <option>4</option>
     <option>5</option> -->

    <?php

      include_once('classes.php');

         $cat = Categories::fromDb();

         foreach ($cat as $c) {
           echo "<option value='".$c->id."'>".$c->name."</option>";
         }


         

         /* while ($row=$ps->fetch())
          {
           v
          }*/

    ?>

    </select>
  </div>
 
  <div class="form-group">
    <label for="info">Info</label>
    <textarea class="form-control" rows="3" name="info"></textarea>
  </div>

   <div class="form-group">
    <label for="image">Choose file</label>
    <input type="file" class="form-control-file" name = "filename">
  </div>
  <input type="submit" name="addgood" value="Add" class="btn btn-primary">
</form>


</div>

<?php

if(isset($_POST['addgood']))
{
    if ($_FILES && $_FILES['filename']['error']== UPLOAD_ERR_OK)
    {
      $name = $_FILES['filename']['name'];
      move_uploaded_file($_FILES['filename']['tmp_name'], 'images/'.$name);
    }

  $g = new Good($_POST['title'], $_POST['price'], $_POST['categoryid'], $_FILES['filename']['name'], $_POST['info']);

  $g->intoDb();

  /*if($g->intoDb()) 
  {
    echo '<script language="javascript">';
    echo 'alert("Товар успешно добавлен")';
    echo '</script>';
  }*/
}

 }

 else
  echo '<h5 style="color:red">You must be admin</h5>';


?>
