<?php 
function out(){
if (file_exists('database/users.csv')) {
   $f = file('database/users.csv');
   echo "<table>";
   for($i=0; $i<count($f); $i++){
   	$user = explode(",", $f[$i]);
   	$user[3] = explode("\n", $user[3])[0];
   	echo "<tr>";
   	$path = "";
   	if(file_exists("public/images/" . ($user[3])) && $user[3] != ""){
   		$path = 'public/images/' . ($user[3]);
   	}else{
   		$path = 'public/images/defoult.png';
   	}
   	printf("<td>%-20s</td><td>%-40s</td><td>%-15s</td><td><img src='%s' height='50' width='50'></img></td>", $user[0], $user[1], $user[2], $path);
   	echo "</tr>";
   }
   echo '</table>';
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
   <?php out(); ?>
   <br>
   <a class="btn" href="handler.php">return back</a>
</div>
</body>
</html>