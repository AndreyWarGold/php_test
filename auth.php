<?php

session_start();

const ADMIN_EMAIL = 'admin@admin.com';
const ADMIN_PASSWORD = '111111';

if($_POST["email"] == ADMIN_EMAIL && $_POST["password"] == ADMIN_PASSWORD){
	$_SESSION["auth"] = true;
	$_SESSION["role"] = "admin";
	$_SESSION['email'] = ADMIN_EMAIL;
	header('Location: index.php');
}else{
	include_once 'app/Models/UserModel.php';
	require_once 'config/db.php';
	$db = new Db();
	$conn = $db->getConnect();
	$user = (new User())::byEmail($conn, $_POST['email']);

	if($_POST["password"] == $user['password']){
		$_SESSION["auth"] = true;
		$_SESSION["role"] = (new User())::getRoleByIdUser($conn, $user['id']);
		$_SESSION['email'] = $_POST['email'];
		header('Location: index.php');
	}else{
		header('Location: index.php');
	}
}

?>