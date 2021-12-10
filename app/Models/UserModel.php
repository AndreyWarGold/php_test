<?php
class User {
   private $name;
   private $email;
   private $gender;
   private $path;
   private $password;

   public function __construct($name = '', $email = '', $gender = '', $path = '', $password = '')
   {
       $this->name = $name;
       $this->email = $email;
       $this->gender = $gender;
       $this->path = $path;
       $this->password = $password;
   }

   public function add($conn) {
       $sql = "INSERT INTO users (email, name, gender, password, path_to_img)
           VALUES ('$this->email', '$this->name','$this->gender', '$this->password', '$this->path')";
           $res = mysqli_query($conn, $sql);
           if ($res) {
               return true;
           }
   }

   public function edit($conn, $id) {
        if($this->path != "defoult.png"){
       $sql = "UPDATE users SET email='$this->email', name='$this->name', gender='$this->gender', password='$this->password', path_to_img='$this->path' WHERE users.id=$id;";
        }else{
          $sql = "UPDATE users SET email='$this->email', name='$this->name', gender='$this->gender', password='$this->password' WHERE users.id=$id;";
        }
           $res = mysqli_query($conn, $sql);
           if ($res) {
               return true;
           }
   }

   public static function all($conn) {
       $sql = "SELECT * FROM users";
       $result = $conn->query($sql); //виконання запиту
       if ($result->num_rows > 0) {
           $arr = [];
           while ( $db_field = $result->fetch_assoc() ) {
               $arr[] = $db_field;
           }
           return $arr;
       } else {
           return [];
       }
   }

   public static function delete($conn, $id) {
       $sql = "DELETE FROM users WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if ($res) {
          return true;
   }
}

public static function byId($conn, $id) {
       $sql = "SELECT * FROM users WHERE id=$id";
       $result = $conn->query($sql); //виконання запиту
       if ($result->num_rows > 0) {
           $arr = [];
           while ( $db_field = $result->fetch_assoc() ) {
               $arr[] = $db_field;
           }
           return $arr[0];
       } else {
           return [];
       }
   }

   public static function byEmail($conn, $email) {
       $sql = "SELECT * FROM users WHERE email='$email'";
       $result = $conn->query($sql); //виконання запиту
       if ($result->num_rows > 0) {
           $arr = [];
           while ( $db_field = $result->fetch_assoc() ) {
               $arr[] = $db_field;
           }
           return $arr[0];
       } else {
           return [];
       }
   }

   public static function getRoleByIdUser($conn, $id) {
        $id_role = (new User())::byId($conn, $id)['role_id'];
       $sql = "SELECT * FROM roles WHERE id='$id_role'";
       $result = $conn->query($sql); //виконання запиту
       if ($result->num_rows > 0) {
           $arr = [];
           while ( $db_field = $result->fetch_assoc() ) {
               $arr[] = $db_field;
           }
           return $arr[0]['role'];
       } else {
           return 'none';
       }
   }
}
