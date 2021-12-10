<?php
class UsersController
{
   private $conn;
   public function __construct($db)
   {
       $this->conn = $db->getConnect();
   }

   public function index()
   {
       include_once 'app/Models/UserModel.php';

       // отримання користувачів
       $users = (new User())::all($this->conn);

       include_once 'views/users.php';
   }

   public function logout(){
    $_SESSION["auth"] = false;
    header('Location: index.php');
   }

   public function addForm(){
        if($_SESSION['auth'] == true && $_SESSION['role'] == "admin"){
           include_once 'views/addUser.php';
        }else{
          header('Location: ?controller=users');
        }
   }

   public function add()
   {
       include_once 'app/Models/UserModel.php';
       // блок з валідацією
       $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
       $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

       include 'uploads.php';
       $path = upload();

       if (trim($name) !== "" && trim($email) !== "" && trim($gender) !== "") {
           // додати користувача
           $user = new User($name, $email, $gender, $path, $password);
           $user->add($this->conn);
       }
       header('Location: ?controller=users');
   }

   public function delete() {
    if($_SESSION['auth'] == true && $_SESSION['role'] == "admin"){
       include_once 'app/Models/UserModel.php';
       // блок з валідацією
       //$_GET['controller']
       //$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

       if (trim($id) !== "" && is_numeric($id)) {
           (new User())::delete($this->conn, $id);
       }
       header('Location: ?controller=users');
     }else{
      header('Location: ?controller=users');
     }
  }

  public function show(){
    include_once 'app/Models/UserModel.php';
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if($_SESSION['auth'] == true && ($_SESSION['role'] == "admin" || (new User())::byEmail($this->conn, $_SESSION['email'])['id'] == $id)){     
     if (trim($id) !== "" && is_numeric($id)) {
         $user = (new User())::byId($this->conn, $id);
     }
     include_once 'views/showUser.php';
    }else{
      header('Location: ?controller=users');
    }
}

public function update()
   {
       include_once 'app/Models/UserModel.php';
       // блок з валідацією
       $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
       $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

       include 'uploads.php';
       $path = upload();

       if (trim($name) !== "" && trim($email) !== "" && trim($gender) !== "") {
           // додати користувача
           $user = new User($name, $email, $gender, $path, $password);
           $user->edit($this->conn, $id);
       }
       header('Location: ?controller=users');
   }

}
