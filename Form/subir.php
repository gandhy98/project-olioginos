
<?php 
	date_default_timezone_set("America/Lima");

	require_once '../core2.php';
	
	$axipo_archivo =$_POST['txtipo_archivo'];
	$axcod_mov_carga =$_POST['txtcod_mov_carga'];
	$axnomexcel =$_POST['txtnomexcel'];
	$axid_local_carga =$_POST['txtid_local_carga'];	
	$nombre_temporal = $_FILES['archivo']['tmp_name'];
 	$nombre = $_FILES['archivo']['name'];	

 	if($axipo_archivo=='EXCEL'){

 		move_uploaded_file($nombre_temporal, '../Archivos/'.$nombre);

 	}else{

	$logitudPass = 10;	
	$nuevo_nombre_a = substr(md5(microtime()),1,$logitudPass);
 	
 	$exploro = explode(".",$nombre);
 	$extencion = array_pop($exploro);
 	$nuevo_nombre = $nuevo_nombre_a.'.'.$extencion;


 	move_uploaded_file($nombre_temporal, '../Archivos/'.$nuevo_nombre);

 	$SQLActualizar = "UPDATE MAESTRO_CZ SET BOUCHER_DIGITAL_1='$nuevo_nombre'  WHERE ID_LOCAL = '$axid_local_carga' AND COD_MOV='$axcod_mov_carga'";
 	$RSActualizar = odbc_exec($con,$SQLActualizar);
 	//echo $SQLActualizar;
 	}

	
	
	

function get_row($table,$col, $id, $equal){

	global $con;
	$querysql="select top 1 $col from $table where $id='$equal' order by $col desc";
	$query=odbc_exec($con,$querysql);
	$rw=odbc_fetch_array($query);
	$value=$rw[$col];
	return $value;
}

 ?>

