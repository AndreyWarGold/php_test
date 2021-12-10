<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <style>
       body{
           padding-top: 3rem;
       }
       .container {
           width: 400px;
       }
   </style>
</head>
<body>
<div class="container">
       <!-- Form to add User -->
       <h3>Add New Role</h3>
       <form action="?controller=roles&action=add" method="post" enctype="multipart/form-data">
           <div class="row">
               <div class="field">
                   <label>Name: <input type="text" name="name"></label>
               </div>
           </div>
           <input type="submit" class="btn" value="Add">
       </form>
</div>
</body>
</html>
