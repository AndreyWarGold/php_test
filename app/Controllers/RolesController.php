<?php
class RolesController
{
   private $conn;
   public function __construct($db)
   {
       $this->conn = $db->getConnect();
   }

   public function index()
   {
       include_once 'app/Models/RoleModel.php';

       // отримання користувачів
       $roles = (new Role())::all($this->conn);

       include_once 'views/roles.php';
   }

   public function addForm(){
        if($_SESSION['auth'] == true && $_SESSION['role'] == "admin"){
           include_once 'views/addRole.php';
        }else{
          header('Location: ?controller=roles');
        }
   }

   public function add()
   {
       include_once 'app/Models/RoleModel.php';
       $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

       if (trim($name) !== "") {
           $role = new Role($name);
           $role->add($this->conn);
       }
       header('Location: ?controller=roles');
   }

   public function delete() {
    if($_SESSION['auth'] == true && $_SESSION['role'] == "admin"){
       include_once 'app/Models/RoleModel.php';
       // блок з валідацією
       //$_GET['controller']
       //$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

       if (trim($id) !== "" && is_numeric($id)) {
           (new Role())::delete($this->conn, $id);
       }
       header('Location: ?controller=roles');
     }else{
      header('Location: ?controller=roles');
     }
  }

  public function show(){
    include_once 'app/Models/RoleModel.php';
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if($_SESSION['auth'] == true && $_SESSION['role'] == "admin"){     
     if (trim($id) !== "" && is_numeric($id)) {
         $role = (new Role())::byId($this->conn, $id);
     }
     include_once 'views/showRole.php';
    }else{
      header('Location: ?controller=roles');
    }
}

public function update()
   {
       include_once 'app/Models/RoleModel.php';
       $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

       if (trim($name) !== "") {
           $role = new Role($name);
           $role->edit($this->conn, $id);
       }
       header('Location: ?controller=roles');
   }

}
