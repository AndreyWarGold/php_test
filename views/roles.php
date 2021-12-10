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
   <div class="row">
       <table>
           <?php foreach ($roles as $role):?>
              <tr><td><a href="?controller=roles&action=show&id=<?=$role['id']?>"><?php echo $role['id']; ?></a></td>
                <td><?=$role['role']?></td>
                  <td><a href="?controller=roles&action=delete&id=<?=$role['id']?>">X</a></td>
              </tr>
           <?php endforeach;?>
       </table>
   </div>
<a class="btn" href="?controller=roles&action=addForm">add new role</a>
   <a class="btn" href="?controller=index">return back</a>
</div>
</body>
</html>
