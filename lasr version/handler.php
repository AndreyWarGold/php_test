<?php
	require 'db.php';
  require 'uploads.php';
   function vivod(){
    if(empty(($_POST["name"])) || empty(($_POST["email"])) || empty(($_POST["gender"]))){
      return 'Invalid data';
    }else{
      $path = upload();
      add($_POST['name'], $_POST['email'], $_POST['gender'], $path);
      return "User Added ".$_POST['name']."<br>
             Email ".$_POST['email']."
             Gender ".$_POST['gender']."";
    }
   }
   function add($name, $email, $gender, $photo){
    $sql = "INSERT INTO users (email, name, gender, password, path_to_img)
   VALUES ('$email', '$name','$gender', '11111', '$photo')";
	//echo $sql;
	$res = mysqli_query(get_conn(), $sql);
	if ($res) {
 	  $valid = true;
}

   }
?>
<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <style>
       .container {
           width: 400px;
       }
   </style>
</head>
<body style="padding-top: 3rem;">
 
<div class="container">
   <?php echo vivod(); ?>
   <hr>
   <a class="btn" href="adduser.php">return back</a>
   <a class="btn" href="table.php">view list</a>
</div>
</body>
</html>
