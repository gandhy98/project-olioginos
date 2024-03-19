<?php  

//require('../Imprimir/pdf_js.php');

require('../Imprimir/Classes/PHPExcel/IOFactory.php');
require('../Imprimir/pdf_js.php');
require_once '../core2.php';


$param=$_POST['param'];
date_default_timezone_set("America/Lima");

switch ($param) {

case '0': // listar usuarios

	
	$axiduser = $_POST['txtcodusuario']; 	
	$axpermiso = $_POST['axpermiso']; 
	
	$axid_usuario =$axiduser;
	$axnom_modulo =$axpermiso;
	$axdetalle ='INICIO DE SESION EN EL MODULO '. $axnom_modulo;

	guardar_bitacora($axid_usuario,$axnom_modulo,$axdetalle);

	$sql6 = "SELECT * FROM MODULO_ASIGNADO WHERE ID_USUARIO = '$axiduser' and NOM_MENU='TOTAL'";
	$rspermisos=odbc_exec($con,$sql6);
	//echo $sql6;

	if(odbc_num_rows($rspermisos) == 1){

		$respuesta = 0;
		echo trim($respuesta); // ACCESO TOTAL

	} else {

		$sql7 = "SELECT * FROM MODULO_ASIGNADO WHERE ID_USUARIO = '$axiduser' and NOM_MENU='$axpermiso'";
		$rspermisos7=odbc_exec($con,$sql7);

		if(odbc_num_rows($rspermisos7) == 1){

			$respuesta = 0;
			echo trim($respuesta); // ACCESO TOTAL

		} else{

			$respuesta = 1;
			echo trim($respuesta); // NO TIENE ACCESO A ESTE MODULO
		}		

	}
	
break;


case '1': //LISTAR GASTOS
	
$axbuscaregistro = $_POST['txtbuscar']; 	
$axid_local = $_POST['txtid_local']; 	

if ($axid_local !=='Seleccionar') {

	if($axbuscaregistro==""){
		$SQLBuscar = "SELECT TOP 400 * FROM RENDICION_CZ WHERE ID_LOCAL = '$axid_local' order by FECHA_ENTREGA DESC";
	}else{
		$SQLBuscar ="SELECT TOP 400 *  FROM RENDICION_CZ WHERE ID_LOCAL = '$axid_local' AND NUM_RENDICION+RESPONSABLE_RECIBE like '%".$axbuscaregistro."%' ";
	}
	
//echo "$SQLBuscar";

echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th class='ocultar' style='text-align: center;'>Item</th>
			<th class='ocultar' style='text-align: center;'>Fecha</th>
			<th class='ocultar' style='text-align: center;'>Nùmero</th>
			<th class='ocultar' style='text-align: left;'>Responsable</th>
			<th class='ocultar' style='text-align: right;'>Monto</th>
			<th class='ocultar' style='text-align: center;'>Estado</th>			
			<th style='text-align: center;'>Acción</th>
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 

 		$it= $it+1;
 		$axid_rendicion_cz = $fila['ID_RENDICION_CZ'];
		$axfecha_emision = date('d-m-Y',strtotime($fila['FECHA_ENTREGA']));
		$axnum_rendicion = $fila['NUM_RENDICION'];
		$axresponsable_recibe = $fila['RESPONSABLE_RECIBE'];
		$axmonto = number_format($fila["MONTO_ENTREGADO"],2,".",","); 
		$axestado_rendicion = $fila['ESTADO_RENDICION'];	
		

		if($axestado_rendicion=='POR RENDIR'){
			$axclass = "class='text-danger'";
		}else{
			$axclass = "class='text-success'";
		}

 	echo "
 		<tr> 		
 			<td style='text-align: center;'>".$it."</td> 
 			<td style='text-align: center;'>".$axfecha_emision."</td> 
 			<td style='text-align: center;'>".$axnum_rendicion."</td>  			
 			<td style='text-align: left;'>".$axresponsable_recibe."</td> 
 			<td style='text-align: right;'>".$axmonto."</td> 
 			<td  $axclass style='text-align: center;'><a href='#' id='btn_ver_detalle_rendicion' data-id='$axid_rendicion_cz'style='text-decoration:none;' >".$axestado_rendicion."</a></td> 
 			<td style='text-align: center;'>
 				<div class='btn-group dropstart'>
					<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
					<ul class='dropdown-menu'>	
					<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-info' id='btn_editar_rendicion' data-bs-toggle='modal' data-bs-target='#mdl_registrar_gasto' data-estado='$axestado_rendicion' data-id='$axid_rendicion_cz'><b><i class='bi bi-pencil' ></i> Editar</a></b>
					<a href='#' class='dropdown-item text-danger' id='btn_eliminar_rendicion' data-estado='$axestado_rendicion' data-id='$axid_rendicion_cz'><b><i class='bi bi-trash3-fill'></i> Eliminar</a></b>					
					<div><hr class='dropdown-divider'></div>
					</ul>
				</div>
 			</td>


 		</tr>";

}
echo "</table>";
}


}else{

	echo "<h4 class='text-danger'>Seleccionar un almacén...</h4>";
}

break;

case '2':
	
	$axid_rendicion_cz = $_POST['txtid_rendicion_cz'];
	$axnum_rendicion = $_POST['txtnum_rendicion'];
	$axfecha_entrega = $_POST['txtfecha_entrega'];
	$axestado_rendicion = $_POST['txtestado_rendicion'];
	$axresponsable_recibe = $_POST['txtresponsable_recibe'];
	$axmonto_entregado = $_POST['txtmonto_entregado'];
	$axsaldo = $_POST['txtsaldo'];
	$axid_cta = $_POST['txtid_cta'];
	$axmedio_pago = $_POST['txtmedio_pago'];
	$axnum_transf = $_POST['txtnum_transf'];
	$axid_local = $_POST['txtid_local'];
	$axparametros = $_POST['txtparametros'];


	if($axparametros==0){

		$SQLInsert = "INSERT INTO RENDICION_CZ (ID_LOCAL,NUM_RENDICION,FECHA_ENTREGA,RESPONSABLE_RECIBE,MONTO_ENTREGADO,SALDO,ESTADO_RENDICION,ID_CTA,MEDIO_PAGO,NUM_TRANSF) VALUES ('$axid_local','$axnum_rendicion','$axfecha_entrega','$axresponsable_recibe','$axmonto_entregado','$axsaldo','$axestado_rendicion','$axid_cta','$axmedio_pago','$axnum_transf')";
	}else{

		$SQLInsert = "UPDATE RENDICION_CZ SET ID_LOCAL='$axid_local',NUM_RENDICION='$axnum_rendicion',FECHA_ENTREGA='$axfecha_entrega',RESPONSABLE_RECIBE='$axresponsable_recibe',MONTO_ENTREGADO='$axmonto_entregado',SALDO='$axsaldo',ESTADO_RENDICION='$axestado_rendicion',ID_CTA='$axid_cta',MEDIO_PAGO='$axmedio_pago',NUM_TRANSF='$axnum_transf' WHERE ID_RENDICION_CZ='$axid_rendicion_cz'";
	}

	$RSInsert = odbc_exec($con,$SQLInsert);

	if($RSInsert){

		$respuesta = 0;
		echo $respuesta;

	}else{

		$respuesta = 1;
		echo $respuesta;


	}


break;

case '3':
	
	$axid_rendicion_cz= $_POST['txtid_rendicion_cz'];
		
	$sql6 = "SELECT * FROM RENDICION_CZ WHERE  ID_RENDICION_CZ='$axid_rendicion_cz'";
	
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

case '4':
	
	$axid_rendicion_dt = $_POST['txtid_rendicion_dt'];
	$axid_rendicion_cz = $_POST['txtid_rendicion_cz'];
	$axid_local = $_POST['txtid_local'];
	$axfecha_gasto = $_POST['txtfecha_gasto'];
	$axid_beneficiario = $_POST['txtid_beneficiario'];
	$axid_td = $_POST['txtid_td'];
	$axtxt_serie = $_POST['txttxt_serie'];
	$axdocumento = $_POST['txtdocumento'];
	$axid_producto = $_POST['txtid_producto'];
	$axmonto_gasto = $_POST['txtmonto_gasto'];

	$SQLInsert ="INSERT INTO RENDICION_DT (ID_RENDICION_CZ,FECHA_GASTO,ID_BENEFICIARIO,ID_TD,TXT_SERIE,DOCUMENTO,ID_PRODUCTO,MONTO_GASTO) VALUES ('$axid_rendicion_cz','$axfecha_gasto','$axid_beneficiario','$axid_td','$axtxt_serie','$axdocumento','$axid_producto','$axmonto_gasto')";
	$RSInsert = odbc_exec($con,$SQLInsert);

	if($RSInsert){
		$respuesta=0;
		echo $respuesta;
	}else{
		$respuesta=1;
		echo $respuesta;
	}



break;


case '5':
	

$axid_rendicion_cz = $_POST['txtid_rendicion_cz']; 	
$axid_local = $_POST['txtid_local']; 	
$axbuscar = $_POST['txtbuscar_gasto']; 	

if ($axbuscar =='') {

	if($axbuscaregistro==""){
		$SQLBuscar = "SELECT  * FROM RENDICION_DETALLE WHERE ID_RENDICION_CZ = '$axid_rendicion_cz' order by FECHA_GASTO ASC";
	}else{
		$SQLBuscar ="SELECT  *  FROM RENDICION_DETALLE WHERE ID_RENDICION_CZ = '$axid_rendicion_cz' AND DOCUMENTO+DETALLE_GASTO like '%".$axbuscar."%' ";
	}
	



//echo "$SQLBuscar";

echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th class='ocultar' style='text-align: center;'>Item</th>
			<th class='ocultar' style='text-align: center;'>Fecha</th>
			<th class='ocultar' style='text-align: center;'>Comprobante</th>
			<th class='ocultar' style='text-align: left;'>Detalle del gasto</th>
			<th class='ocultar' style='text-align: right;'>Monto</th>			
			<th style='text-align: center;'>Acción</th>
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 

 		$it= $it+1;
 		$axid_rendicion_cz = $fila['ID_RENDICION_CZ'];
 		$axid_rendicion_dt = $fila['ID_RENDICION_DT'];

		$axfecha_emision = date('d-m-Y',strtotime($fila['FECHA_GASTO']));
		$axcomprobante = $fila['COMPROBANTE'];
		$axproveedor = $fila['NOM_COMERCIAL'];
		$axmonto = number_format($fila["MONTO_GASTO"],2,".",","); 
		$axservicio = $fila['DETALLE_GASTO'];	
		$axdetale = $axproveedor.'<br>'.$axservicio;
		

		if($axestado_rendicion=='POR RENDIR'){
			$axclass = "class='text-danger'";
		}else{
			$axclass = "class='text-success'";
		}

 	echo "
 		<tr> 		
 			<td style='text-align: center;'>".$it."</td> 
 			<td style='text-align: center;'>".$axfecha_emision."</td> 
 			<td style='text-align: center;'>".$axcomprobante."</td>  			
 			<td style='text-align: left;'>".$axdetale."</td> 
 			<td style='text-align: right;'>".$axmonto."</td> 
 			<td  $axclass style='text-align: center;'><a href='#' id='btn_ver_detalle_rendicion' data-id='$axid_rendicion_cz'style='text-decoration:none;' >".$axestado_rendicion."</a></td> 
 			<td style='text-align: center;'>
 				<div class='btn-group dropstart'>
					<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
					<ul class='dropdown-menu'>	
					<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-info' id='btn_editar_rendicion' data-bs-toggle='modal' data-bs-target='#mdl_registrar_gasto' data-estado='$axestado_rendicion' data-id='$axid_rendicion_cz'><b><i class='bi bi-pencil' ></i> Editar</a></b>
					<a href='#' class='dropdown-item text-danger' id='btn_eliminar_rendicion' data-estado='$axestado_rendicion' data-id='$axid_rendicion_cz'><b><i class='bi bi-trash3-fill'></i> Eliminar</a></b>					
					<div><hr class='dropdown-divider'></div>
					</ul>
				</div>
 			</td>


 		</tr>";

}
echo "</table>";
}


}else{

	echo "<h4 class='text-danger'>Seleccionar un almacén...</h4>";
}

break;

case '6':
	
$axbuscar_dato =$_POST['txtnom_proveedor'];
   
 if(isset($_POST["txtnom_proveedor"])){

	$output ='';
	$idprov ='';
	$sqlemisor = "SELECT TOP 5 * FROM BENEFICIARIOS WHERE TIPO_PROV_CLIE ='PROVEEDOR' and NOM_COMERCIAL LIKE  '%".$axbuscar_dato."%' ORDER BY NOM_COMERCIAL";
	//echo $sqlemisor;

	$rsemisor=odbc_exec($con,$sqlemisor);
	//$output ='<ul id="listar" class="list-unstyled ul">';
	$output ='<ul class="list-group">';
  		

	if(odbc_num_rows($rsemisor) > 0){
		 while ($row=odbc_fetch_array($rsemisor)){		
		 	$id =  $row["ID_BENEFICIARIO"];
		 	$nom_prod =  trim($row["NOM_COMERCIAL"]);

		 	$output .='<a href="#" id="btn_listar_beneficiarios" class="list-group-item list-group-item-action" style="background:#DAF5FF;" data-id='.$id.' data-nom_pro='.$nom_prod.'> <i class="bi bi-box-seam-fill"></i> '.utf8_encode($row["NOM_COMERCIAL"]).'</a>';
		 }

	}else{
		
		$output .='<a href="#" class="list-group-item list-group-item-action bg-danger"></a>';		
		//$output .='<a href="#" id="btn_listar_productos_egresos_nuevo" class="list-group-item list-group-item-action bg-danger" data-bs-toggle="modal" data-bs-target="#mdl_nuevo_servicios"> '.$axbuscar_dato.' (Nuevo)</a>';
	
	}

	$output .='</ul>';
	echo $output;

}else{
	echo $output;	
}



break;


}//switch ($param) {

function verificar_ceros($axnum_pedido){

    global $con;

    $SQLConsulta = "SELECT ID_PRODUCTO, COD_PRODUCTO, NOM_PRODUCTO, CANT_SALIDA, PRS_VENTA
                   FROM PEDIDOS_DESPACHOS
                   WHERE NUM_PEDIDO = '$axnum_pedido' AND PRS_VENTA = 0
                   ORDER BY ID_PRODUCTO_PADRE ASC";

    $RSConsulta = odbc_exec($con, $SQLConsulta);
    $resultados = array();

    while ($fila = odbc_fetch_array($RSConsulta)) {
        $resultados[] = $fila;
    }

    return $resultados;

}

function guardar_bitacora($usuario,$modulo,$detalle){

date_default_timezone_set("America/Lima");

global $con;

$axfecha = date('Y-m-d');
$axhora = date('H:i:s');
$axid_usuario = $usuario;
$axnom_usario = get_row('USUARIOS','NOM_USUARIO','ID_USUARIO',$axid_usuario);
$axnom_modulo = $modulo;
$axdetalle_bitacora = $detalle;

$SQLInsert = "INSERT INTO BITACORA_USOS (FECHA_BITACORA,HORA_BITACORA,ID_USUARIO,USUARIO,DETALLE_BITACORA,NOM_MENU) VALUES ('$axfecha','$axhora','$axid_usuario','$axnom_usario','$axdetalle_bitacora','$axnom_modulo')";
//echo $SQLInsert;
$RSInsert = odbc_exec($con,$SQLInsert);


}

// Función para verificar si un correlativo existe en la tabla PEDIDOS
function existeEnVentas($correlativo,$local,$serie,$tipo) {
    global $con;  // Asegúrate de que $con sea tu conexión válida

    $axtxt_serie = get_row('CORRELATIVOS','N_SERIE','COD_CORR',$serie);
    $correlativo_1 = number_pad($correlativo, 8);

    if($tipo='8'){
    	$sql = "SELECT * FROM GUIA_REMISION_CZ WHERE  ID_LOCAL='$local' AND txt_serie='$axtxt_serie' AND txt_correlativo = '$correlativo_1'";    	
    }else{
    	$sql = "SELECT * FROM MAESTRO_CZ WHERE  ID_LOCAL='$local' AND TXT_SERIE='$axtxt_serie' AND DOCUMENTO = '$correlativo_1'";
    }   

    //echo $sql;

    $result = odbc_exec($con, $sql);
    if ($result === false) {
        die(print_r(odbc_errormsg(), true));
    }

    return odbc_num_rows($result) > 0;
}

function get_row($table,$col, $id, $equal){

	global $con;
	$querysql="select top 1 $col from $table where $id='$equal' order by $col desc";
	$query=odbc_exec($con,$querysql);
	$rw=odbc_fetch_array($query);
	$value=$rw[$col];
	return $value;
}

function get_row_two($table,$col, $id_1, $id_2, $equal_1, $equal_2){

	global $con;
	$querysql="select top 1 $col from $table where $id_1='$equal_1' and $id_2='$equal_2' order by $col desc";
	$query=odbc_exec($con,$querysql);
	$rw=odbc_fetch_array($query);
	$value=$rw[$col];
	return $value;
}

function get_row_three($table,$col, $id_1, $id_2, $id_3,$equal_1, $equal_2,$equal_3){

	global $con;
	$querysql="select top 1 $col from $table where $id_1='$equal_1' and $id_2='$equal_2' and $id_3='$equal_3' order by $col desc";
	$query=odbc_exec($con,$querysql);
	$rw=odbc_fetch_array($query);
	$value=$rw[$col];
	return $value;
}


function redondeado ($numero, $decimales) { 
   $factor = pow(10, $decimales); 
   return (round($numero*$factor)/$factor); 
}

function number_pad($number,$n) {
return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}


?>



