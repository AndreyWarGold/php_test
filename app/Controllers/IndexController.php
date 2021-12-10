<?php
class IndexController
{
   public function __construct($db)
   {
   }

   public function index()
   {
       // виклик відображення
       include_once 'views/home.php';
   }
}
