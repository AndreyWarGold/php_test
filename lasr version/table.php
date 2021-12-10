<?php 
function out(){
  require 'db.php';
    $sql = "SELECT * FROM users";
    $result = get_conn()->query($sql);
    echo "<table>";
    if ($result->num_rows > 0) {
       // output data of each row
       while($row = $result->fetch_assoc()) {
              echo "<tr>";
              $path = "";
              if(file_exists("public/images/" . ($row['path_to_img'])) && $row['path_to_img'] != ""){
                  $path = 'public/images/' . ($row['path_to_img']);
                }else{
                  $path = 'public/images/defoult.png';
                }
                printf("<td>%s</td><td>%s</td><td>%s</td><td><img src='%s' height='50' width='50'></td>", $row['name'], $row["email"], $row["gender"], $path);
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