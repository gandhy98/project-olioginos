<?php  

//require('../Imprimir/pdf_js.php');
require('../phpqrcode/qrlib.php');
require_once '../core2.php';


$param=$_POST['param'];


switch ($param) {

case '0': // listar usuarios

	$axidempresa = $_POST['txtid_empresa']; 
	$axbuscaregistro = $_POST['txtbuscar_medios']; 
	$axorden = $_POST['txtorden'];
	$axtipoorden = $_POST['txttipoorden'];
	$axfiltro_buscar = $_POST['txtfiltro_buscar'];
	$axnom_tabla = $_POST['txtnom_tabla'];	
	$axtipo_busqueda = $_POST['txttipo_busqueda'];	
	$axcampo_tabla = $_POST['txtcampo_tabla'];	
	$axcampo_tabla_orden = $_POST['txtcampo_tabla_orden'];	
	$axcampo_contenido = $_POST['txtcampo_contenido'];	

	$axpermiso_editar = $_POST['txtpermiso_editar'];	

	$axtotal_registros = contarRegistros($axnom_tabla);


if($axtipoorden==""){

	if($axbuscaregistro==""){

  		if($axtipo_busqueda=='ORDENAR'){

  		if($axcampo_tabla==''){
  			$sql6 ="SELECT *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' ORDER BY $axcampo_tabla_orden $axorden";  			
  		}else{
  			$sql6 ="SELECT *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE $axcampo_tabla = '$axcampo_contenido' AND ID_EMPRESA='$axidempresa' ORDER BY $axcampo_tabla_orden $axorden";  		
  		}
 		
  		
  	}else{

  		if($axtotal_registros >= 20){

  		$sql6 ="SELECT TOP 20 *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' ORDER BY ID_MEDIO_CAPTACION ASC";	
  		$axcontador = 20 .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>';

	  	}elseif($axtotal_registros < 20){

	  		$sql6 ="SELECT TOP $axtotal_registros *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' ORDER BY ID_MEDIO_CAPTACION ASC";
	  		$axcontador = $axtotal_registros .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>';
	  	}
	 	

  	}

  	

  }else{

  	$sql6 ="SELECT *, COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' AND DESCRIPCION_MEDIO+' '+ESTADO_MEDIO like '%".$axbuscaregistro."%' ORDER BY ID_MEDIO_CAPTACION ASC";
  }
	

	}elseif($axtipoorden=='TODOS'){

		if($axtipo_busqueda=='ORDENAR'){
			$sql6 ="SELECT TOP $axtotal_registros *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' ORDER BY $axcampo_tabla_orden $axorden";  		
			$axcontador = $axtotal_registros .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>';	
		}else{
			$sql6 ="SELECT TOP $axtotal_registros *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' ORDER BY ID_MEDIO_CAPTACION ASC";  		
			$axcontador = $axtotal_registros .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>';	
		}

		
	}
//echo $sql6;

	$RSListar_c = odbc_exec($con, $sql6);
	 $fila_c = odbc_fetch_array($RSListar_c);
   $axcant_registros = $fila_c['cant_registros']; 

   if($axtipo_busqueda=='FILTRAR' || $axtipo_busqueda=='ORDENAR'){
   	//$axcontador = $axcant_registros .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>';	
   	$axcontador = $axcant_registros .' de '.$axtotal_registros;  
   } 

$RSListar = odbc_exec($con,$sql6);

if( odbc_num_rows($RSListar) > 0 ){

	echo "
<table class='table table-hover table-sm'>
	<thead class='table-primary'>	

		<tr class='table-secondary'>
		<th  style='text-align: center;' > <a href='#' id='btn_prospectos_todos' data-tipoorden='TODOS' style='text-decoration:none; color:black;' title='Click para visualizar todos...'><i class='bi bi-arrow-clockwise' style='font-size:15px;'></i> Ver 	todos </a> </th> 
            <th  style='text-align: right;' colspan ='3' >Mostrando $axcontador registros</th>         
        </tr>

		<tr>
			<th style='text-align: center;'>Nº</th>			
			<th style='text-align: left;'>MEDIO</th>
			<th style='text-align: center;'>ESTADO</th>
			<th style='text-align: center;'>ACCION</th>
		</tr>
	</thead>";

	while ($fila =  odbc_fetch_array($RSListar)) {
		
		$it= $it+1;
		$axid_medio = $fila['ID_MEDIO_CAPTACION'];		
		$axdescr_medio = $fila['DESCRIPCION_MEDIO'];
		$axestado_medio = $fila['ESTADO_MEDIO'];	

		echo "
 		<tr>
 			<td style='text-align: center;' >$axid_medio</td>
 			<td style='text-align: left;' >$axdescr_medio</td>
 			<td style='text-align: center;' >$axestado_medio</td> 			
 			
 			<td style='text-align: center;'>
 				<div class='btn-group dropstart'>
					<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
					<ul class='dropdown-menu'>	
					<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-info' id='btn_editar_medio' data-id='$axid_medio' data-bs-toggle='modal' data-bs-target='#exampleModal'><b><i class='bi bi-pencil' ></i> Editar</a></b>
					<!--a href='#' class='dropdown-item text-danger' id='btn_eliminar_medio' data-id='$axid_medio' ><b><i class='bi bi-trash3-fill'></i> Eliminar</a></b-->
					<div><hr class='dropdown-divider'></div>
					</ul>
				</div>

 			</td> 

 		</tr>";
	}

	echo"</table>";
}

break;

case '1':
	
	date_default_timezone_set("America/Lima");
$axfecha_actual = date('Y-m-d');
	
$axid_empresa = $_POST['txtid_empresa'];
$axid_medio_captacion = $_POST['txtid_medio_captacion'];
$axdescripcion_medio = $_POST['txtdescripcion_medio'];
$axestado_medio = $_POST['txtestado_medio'];
$axparametros = $_POST['txtparametros'];

if($axparametros==0){

	$sqlgrabar = "INSERT INTO MK_MEDIO_CAPTACION (DESCRIPCION_MEDIO,ESTADO_MEDIO,FECHA_REGISTRO_MEDIO,ID_EMPRESA) VALUES ('$axdescripcion_medio','$axestado_medio','$axfecha_actual','$axid_empresa')";

	$detalle='AGREGO EL MEDIO DE CAPTACION '.$axdescripcion_medio;

}else{

	$sqlgrabar = "UPDATE MK_MEDIO_CAPTACION SET DESCRIPCION_MEDIO='$axdescripcion_medio',ESTADO_MEDIO='$axestado_medio',FECHA_REGISTRO_MEDIO='$axfecha_actual',ID_EMPRESA='$axid_empresa' WHERE ID_MEDIO_CAPTACION='$axid_medio_captacion'";

	$detalle='EDITO EL MEDIO DE CAPTACION '.$axdescripcion_medio;
}

$rsgrabar = odbc_exec($con,$sqlgrabar);

if($rsgrabar){

	/***************************************/
	    $id_user =$_POST['txtid_usuario'];
	    $modulo = $_POST['txtmodulo'];	    
	    guardar_bitacora($id_user,$modulo,$detalle);
	/***************************************/



	$respuesta =0;
	echo $respuesta;

}else{

	$respuesta =1;
	echo $respuesta;

}

break;

case '2':

$axid_medio_captacion= $_POST['txtid_medio_captacion'];
	
	$sql6 = "SELECT * FROM MK_MEDIO_CAPTACION WHERE ID_MEDIO_CAPTACION = '$axid_medio_captacion'";
	
	$result1=odbc_exec($con,$sql6);
	if(odbc_num_rows($result1) > 0) {
    
      $axlistaprov1 = odbc_fetch_object($result1);
      $axlistaprov1 ->status =200;
      echo json_encode($axlistaprov1);
      
  } else {

  		$error = array('status'=> 400);
  		echo json_encode((object) $error);
  }


break;

case '3':

$axid_medio_captacion= $_POST['txtid_medio_captacion'];
$axdescripcion_medio = get_row('MK_MEDIO_CAPTACION','DESCRIPCION_MEDIO','ID_MEDIO_CAPTACION',$axid_medio_captacion);
	
	$sql6 = "DELETE FROM MK_MEDIO_CAPTACION WHERE ID_MEDIO_CAPTACION = '$axid_medio_captacion'";
	$rsgrabar = odbc_exec($con,$sql6);

	if($rsgrabar){


	/***************************************/
	    $id_user =$_POST['txtid_usuario'];
	    $modulo = $_POST['txtmodulo'];	    
	    $detalle='ELIMINO EL MEDIO DE CAPTACION '.$axdescripcion_medio;
	    guardar_bitacora($id_user,$modulo,$detalle);
		/***************************************/


		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;

	}


break;


}

function contarRegistros($axnom_tabla) {
    
    global $con;
    $querysql="SELECT COUNT(*) as total FROM $axnom_tabla";
    $query=odbc_exec($con,$querysql);
    $rw=odbc_fetch_array($query);
    $value=$rw['total'];
    return $value;


}

function guardar_bitacora($id_user,$modulo,$detalle){

date_default_timezone_set("America/Lima");

global $con;

$axfecha = date('Y-m-d');
$axperiodo_uso = date('m-Y',strtotime($axfecha));
$axhora = date('H:i:s');
$axid_usuario = $id_user;
$axnom_usario = get_row('USUARIO','USUARIO','ID_USUARIO',$axid_usuario);
$axnom_modulo = $modulo;
$axdetalle_bitacora = $detalle;
$ip_maquina = obtenerIP();

$SQLInsert = "INSERT INTO BITACORA_USOS (FECHA_MOV,HORA_MOV,USUARIO,ACTIVIDAD_REALIZADA,NOM_MENU,PERIODO_USO,IP_MAQUINA) VALUES ('$axfecha','$axhora','$axnom_usario','$axdetalle_bitacora','$axnom_modulo','$axperiodo_uso','$ip_maquina')";
//echo $SQLInsert;
$RSInsert = odbc_exec($con,$SQLInsert);


}
function obtenerIP() {
    // Si el usuario está accediendo a través de un proxy
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    // Si el usuario está accediendo a través de un proxy compartido
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    // Si el usuario está accediendo directamente
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    
    return $ip;
}


function generateRandomCode($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomCode = '';
    
    for ($i = 0; $i < $length; $i++) {
        $randomCode .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomCode;
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
