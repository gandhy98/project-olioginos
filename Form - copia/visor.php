<?php 
	
	require_once '../core2.php';
	
	//$axcodmovcz =$_POST['axcodmovcz'];
	//$archivoruta =$_POST['archivoruta'];
	
	$archivoruta=$_GET['file'];
	
	header('content-type: application/pdf');
	readfile($archivoruta);
	


 ?>