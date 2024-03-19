<?php  

//require('../Imprimir/pdf_js.php');
require('../phpqrcode/qrlib.php');
require_once '../core2.php';


$param=$_POST['param'];


switch ($param) {

case '0':
	
$axidempresa = $_POST['txtid_empresa']; 
	$axbuscaregistro = $_POST['txtbuscar_areas']; 
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

  	if($axtipo_busqueda=='FILTRAR'){
 	
  		$sql6 ="SELECT TOP $axtotal_registros *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE $axcampo_tabla = '$axcampo_contenido' AND ID_EMPRESA='$axidempresa' ORDER BY $axcampo_tabla ASC";  		
  		
  	}elseif($axtipo_busqueda=='ORDENAR'){

  		if($axcampo_tabla==''){
  			$sql6 ="SELECT *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' ORDER BY $axcampo_tabla_orden $axorden";  			
  		}else{
  			$sql6 ="SELECT *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE $axcampo_tabla = '$axcampo_contenido' AND ID_EMPRESA='$axidempresa' ORDER BY $axcampo_tabla_orden $axorden";  		
  		}
 		
  		
  	}else{

  		if($axtotal_registros >= 20){

  		$sql6 ="SELECT TOP 20 *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' ORDER BY ID_AREA ASC";	
  		$axcontador = 20 .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>';

	  	}elseif($axtotal_registros < 20){

	  		$sql6 ="SELECT TOP $axtotal_registros *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' ORDER BY ID_AREA ASC";
	  		$axcontador = $axtotal_registros .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>';
	  	}
	 	

  	}

  	

  }else{

  	$sql6 ="SELECT *, COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' AND AREA_TRABAJO+' '+AREA_ENCARGADO like '%".$axbuscaregistro."%' ORDER BY ID_AREA ASC";
  }
	

	}elseif($axtipoorden=='TODOS'){

		if($axtipo_busqueda=='ORDENAR'){
			$sql6 ="SELECT TOP $axtotal_registros *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' ORDER BY $axcampo_tabla_orden $axorden";  		
			$axcontador = $axtotal_registros .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>';	
		}else{
			$sql6 ="SELECT TOP $axtotal_registros *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' ORDER BY ID_AREA ASC";  		
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

if(odbc_num_rows($RSListar) > 0 ){

	echo "
<table  class='table table-hover table-sm' >
	<thead class='table-primary'>

		<tr class='table-secondary'>

		<th  style='text-align: center;' > <a href='#' id='btn_prospectos_todos' data-tipoorden='TODOS' style='text-decoration:none; color:black;' title='Click para visualizar todos...'><i class='bi bi-arrow-clockwise' style='font-size:15px;'></i> Ver 	todos </a> </th>

            <th  style='text-align: right;' colspan ='3' >Mostrando $axcontador registros</th>         
        </tr>

		<tr>
			<th style='text-align: center;'>Nº</th>			
			<th style='text-align: left;'>AREA DE TRABAJO</th>
			<th style='text-align: left;'>CARGOS</th>
			<th style='text-align: center;'>ACCION</th>
		</tr>
	</thead>";

	while ($fila =  odbc_fetch_array($RSListar)) {
		
		$it= $it+1;
		$axid_area = $fila['ID_AREA'];		
		$axarea_trabajo = $fila['AREA_TRABAJO'];
		$axcargo = $fila['AREA_ENCARGADO'];			
		

		echo "
 		<tr>
 			<td style='text-align: center;' >$axid_area</td>
 			<td style='text-align: left;' >$axarea_trabajo</td>
 			<td style='text-align: left;' >$axcargo</td> 			
 			
 			<td style='text-align: center;'>
 				<div class='btn-group dropstart'>
					<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
					<ul class='dropdown-menu'>	
					<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-info' id='btn_editar_area' data-id='$axid_area' data-bs-toggle='modal' data-bs-target='#exampleModal'><b><i class='bi bi-pencil' ></i> Editar</a></b>
					<!--a href='#' class='dropdown-item text-danger' id='btn_eliminar_area' data-id='$axid_area' ><b><i class='bi bi-trash3-fill'></i> Eliminar</a></b-->
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
$axid_area = $_POST['txtid_area'];
$axarea_trabajo = $_POST['txtarea_trabajo'];
$axarea_encargado = $_POST['txtarea_encargado'];
$axparametros = $_POST['txtparametros'];
$axtipo_asignacion = $_POST['txttipo_asignacion'];



if($axparametros==0){

	$sqlgrabar = "INSERT INTO AREAS_TRABAJO (AREA_TRABAJO,AREA_ENCARGADO,ID_EMPRESA,ASIG_EQUIPOS) VALUES ('$axarea_trabajo','$axarea_encargado','$axid_empresa','$axtipo_asignacion')";
	$detalle='AGREGO EL AREA DE TRABAJO '.$axdescripcion_canal.' PARA EL CARGO '.$axarea_encargado;

}else{

	$sqlgrabar = "UPDATE AREAS_TRABAJO SET AREA_TRABAJO='$axarea_trabajo',AREA_ENCARGADO='$axarea_encargado',ID_EMPRESA='$axid_empresa',ASIG_EQUIPOS='$axtipo_asignacion' WHERE ID_AREA='$axid_area'";
	$detalle='EDITO EL AREA DE TRABAJO '.$axdescripcion_canal.' PARA EL CARGO '.$axarea_encargado;
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
	
$axid_area= $_POST['txtid_area'];
	
	$sql6 = "SELECT * FROM AREAS_TRABAJO WHERE ID_AREA = '$axid_area'";
	
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
	
	$axid_area= $_POST['txtid_area'];	
	$axarea = get_row('AREAS_TRABAJO','AREA_TRABAJO','ID_AREA',$axid_area);
	$axcargo = get_row('AREAS_TRABAJO','AREA_ENCARGADO','ID_AREA',$axid_area);
	
	$sql6 = "DELETE FROM AREAS_TRABAJO WHERE ID_AREA = '$axid_area'";
	$rsgrabar = odbc_exec($con,$sql6);

	if($rsgrabar){

		/***************************************/
	    $id_user =$_POST['txtid_usuario'];
	    $modulo = $_POST['txtmodulo'];	    
	    $detalle='ELIMINO EL CARGO '.$axcargo.' CORRESPONDIENTE AL AREA '.$axarea;
	    guardar_bitacora($id_user,$modulo,$detalle);
		/***************************************/

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;

	}


break;


case '4':
	
$axbuscar_dato = $_POST["txtarea_trabajo"];   

 if(isset($_POST["txtarea_trabajo"])){

	$output ="";
	$idprov ="";
	$sqlemisor = "SELECT AREA_TRABAJO FROM AREAS_TRABAJO WHERE AREA_TRABAJO LIKE  '%".$axbuscar_dato."%' GROUP BY AREA_TRABAJO";
	//echo $sqlemisor;

	$rsemisor=odbc_exec($con,$sqlemisor);	
	$output ='<ul class="list-group">';  		

	if(odbc_num_rows($rsemisor) > 0){
		 while ($row=odbc_fetch_array($rsemisor)){		
		 		 	
		 	$output .='<a href="#" id="btn_seleccionar_area" class="list-group-item list-group-item-action" style="background:#DAF5FF;">'.utf8_encode(trim($row["AREA_TRABAJO"])).'</a>';
		 }

	}else{
		
		$output .='';
	
	}

	$output .='</ul>';
	echo $output;

	}else{
	echo $output;	
}

break;

}

function contarRegistros($nombreTabla) {
    
    global $con;
    $querysql="SELECT COUNT(*) as total FROM $nombreTabla";
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
