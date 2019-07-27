<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">

  <title>PHP-CRUD</title>
</head>
<body>
  <nav class="navbar navbar-light bg-dark">
    <center>
  <p style="color:white;">CRUD (Create, Read, Update & Delete) using PHP and Bootstrap</p></center>
</nav>

  <?php require_once 'process.php'; ?>
  <?php
  if (isset($_SESSION['message'])):
   ?>
   <div class="alert alert-<?=$_SESSION['msg_type']?>">
     <?php

      echo $_SESSION['message'];
      unset($_SESSION['message']);

      ?>
    </div>
  <?php endif ?>

  <div class="container">
    <br><h3>List: </h3>

  <?php
    $mysqli=new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));
    $result=$mysqli->query("SELECT* FROM data") or die($mysqli->error);
    // pre_r($result);

    ?>
    <div class="row justify-content-center">
      <table class="table">
        <th>
          <tr>
            <th>Name</th>
            <th>Location</th>
            <th colspan="2">Action</th>
          </tr>
        </th>
        <?php
          while($row=$result->fetch_assoc()):

         ?>
         <tr>
           <td><?php echo $row['name']; ?></td>
           <td><?php echo $row['location']; ?></td>
           <td>
             <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">EDIT </a>
             <a href="process.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">DELETE</a>
           </td>
         </tr>

       <?php endwhile; ?>
      </table>
    </div>



    <?php
    pre_r($result->fetch_assoc());


    function pre_r($array){
      echo '<pre';
      print_r($array);
      echo '</pre>';
    }





   ?>
   <hr>
   <h3>Please input Details : </h3><br>

  <div class="row justify-content-center">

    <form action="process.php"  method="POST">
      <input type="hidden" name="id" value="<?php echo $id ?>">
      <div class="form-group row">
        <label align="center" class="col-sm-2 col-form-label"><b>Name </b></label>
        <input class="form-control" type="text" name="name" placeholder="Enter your name" value="<?php echo $name; ?>">
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>Location </b> </label>
        <input class="form-control" type="text" name="location" placeholder="Enter your location"value="<?php echo $location; ?>">
      </div>
      <div class="form-group">
        <?php
        if ($update == true):
         ?>
        <button class="btn btn-info" type="submit" name="update">Update</button>
      <?php else: ?>
          <button class="btn btn-primary" type="submit" name="save">Save</button>
        <?php endif; ?>
      </div>
    </form>
  </div>

</div>







</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
</html>
