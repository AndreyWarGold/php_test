<?php 
function upload(){
	$target_dir = "public/images/";
	$target_file = $target_dir . basename($_FILES["photo"]["name"]);
	$isUploaded = false;
	$filePath = '';
	if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
	   $filePath = $target_dir . basename($_FILES["photo"]["name"]);
	   $isUploaded = true;
	}
	if(basename($_FILES["photo"]["name"]) != ""){
		return basename($_FILES["photo"]["name"]);
	}else{
		return "defoult.png";
	}

} 
?>