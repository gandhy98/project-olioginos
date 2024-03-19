<?php 
	
	require_once '../core2.php';
	
	//$axcodmovcz =$_POST['axcodmovcz'];
	//$archivoruta =$_POST['archivoruta'];

	$axcodmovcz=$_GET['id'];
	$archivoruta=$_GET['py'];
	$axfiltro_file=$_GET['filtro'];
	$axiduser=$_GET['user'];
	$axid_et=$_GET['id_et'];

	
	/******************************************/
	/*
	  date_default_timezone_set("America/Lima");
	  $diaactual =date("Y-m-d");
	  $horaactual =date("H:i:s");
	  
	  $ausuario = get_row('USUARIO','USUARIO','ID_USUARIO',$axiduser);  	  
	  $axactividad='DESCARGA EL ARCHIVO DIGITAL '.$archivoruta;

	 $sqlbitacora = "INSERT INTO BITACORA (FECHA_MOV,HORA_MOV,TIEMPO_ACTIVIDAD,USUARIO,ACTIVIDAD_REALIZADA,NOM_MENU,ID_ET) VALUES ('$diaactual','$horaactual','0','$ausuario','$axactividad','$axmenu','$axid_et')";
	  $rsbitacora = odbc_exec($con,$sqlbitacora);
	  */
	/******************************************/
	
	
	header('content-type: application/pdf');
	readfile($archivoruta);
	
	


function get_row($table,$col, $id, $equal){

	global $con;
	$querysql="select top 1 $col from $table where $id='$equal' order by $col desc";
	$query=odbc_exec($con,$querysql);
	$rw=odbc_fetch_array($query);
	$value=$rw[$col];
	return $value;
}

 ?>