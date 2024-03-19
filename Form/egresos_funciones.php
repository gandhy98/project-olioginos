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


case '25': //LISTAR COMPRAS Y GASTOS
	
$axbuscaregistro = $_POST['txtbuscar']; 	
$axid_local = $_POST['txtid_local']; 	

if ($axid_local !=='Seleccionar') {

	if($axbuscaregistro==""){
		$SQLBuscar = "SELECT TOP 400 * FROM MAESTRO_EGRESOS_CZ WHERE ID_LOCAL = '$axid_local' order by FECHA_EMISION DESC";
	}else{
		$SQLBuscar ="SELECT TOP 400 *  FROM MAESTRO_EGRESOS_CZ WHERE ID_LOCAL = '$axid_local' AND BUSCAR_EGRESOS like '%".$axbuscaregistro."%' ";
	}
	

//echo "$SQLBuscar";

echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th class='ocultar' style='text-align: center;'>Item</th>
			<th class='ocultar' style='text-align: left; width:8%;'>Tipo</th>
			<th class='ocultar' style='text-align: left; width:8%;'>Fecha Emisión</th>
			<th style='text-align: left; width:8%;'>Documento</th>
			<th style='text-align: left;'>Nom. Proveedor</th>
			<th class='ocultar' style='text-align: left;'>Glosa</th>
			<th style='text-align: right;'>Monto</th>									
			<th style='text-align: center;'>Acción</th>
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$axcod_mov = $fila['COD_MOV'];
		$axfecha_emision = date('d-m-Y',strtotime($fila['FECHA_EMISION']));
		
		$axdocumento =$fila['TXT_SERIE'].'-'.$fila['DOCUMENTO'];
		$axnom_proveedor = $fila['RAZON_SOCIAL'];
		$axglosa = $fila['GLOSA'];
		$axmonto = number_format($fila["TOTAL_VENTA"],2,".",","); 
		$axarchivo_digital = $fila['BOUCHER_DIGITAL_1'];
		$axnum_programacion = $fila['NUM_PROGRAMACION'];
		$axestado_pagado = get_row('MAESTRO_DT','ESTADO_FORMA_PAGO','COD_MOV',$axcod_mov);

		if($axnum_programacion==''){
			$axtipo = $fila['DETALLE_MOVIMIENTO'];
			$axnum_programacion = '';
			$axmostrar = $axtipo;
		}else{
			
			$axtipo = $fila['DETALLE_MOVIMIENTO'].'<br><b>'.$fila['NUM_PROGRAMACION'].'<b>';
			$axmostrar = "<a href='#' style='text-decoration:none;' id='btn_ver_rendicion' data-numrend='$axnum_programacion' data-bs-toggle='modal' data-bs-target='#mdl_rendicion'> ".$axtipo."</a>";
			
		}


		if($axmonto=='' || $axmonto==0.00){
			$axmonto=0;
		}
		
		$contar =strlen($axarchivo_prcd);
		$restar = ($contar -3);
		$extencion = substr($axarchivo_digital,$restar,3);


	

 	echo "
 		<tr> 		
 			<td class='ocultar' style='text-align: center;'>".$it."</td> 
 			<td class='ocultar' style='text-align: left; width:8%;'>$axmostrar</td> 
 			<td class='ocultar' style='text-align: left;'>".$axfecha_emision."</td>";

 			if($axarchivo_digital==''){
 				echo "<td style='text-align: left;'>".$axdocumento."</td>";
 			}else{

 				if($extencion =="PDF" || $extencion== "pdf"){

 					echo "<td style='text-align: left;'>
 						<a href='#' data-nomarchivo='$axarchivo_digital' data-id='$axcod_mov' id='btn_descargar_sustento' title='Clic para visualizar archivo' style='text-decoration:none;' >".$axdocumento."</a>
					</td>";	

 				}else{

 					echo "<td style='text-align: left;'>
 						<a href='#' data-nomarchivo='$axarchivo_digital' data-id='$axcod_mov' id='ver_vouchers_img' title='Clic para visualizar archivo' data-bs-toggle='modal' data-bs-target='#modal_ver_imagen' style='text-decoration:none;' >".$axdocumento."</a>
					</td>";	
 				}

 				
 			}

 	if($axestado_pagado=='PENDIENTE'){
 		echo "<td style='text-align: left;'>".utf8_encode($axnom_proveedor).'<br><b class="text-danger">'.$axestado_pagado."</b></td>";	
 	}else{
 		echo "<td style='text-align: left;'>".utf8_encode($axnom_proveedor).'<br><b class="text-success">'.$axestado_pagado."</b></td>";	
 	}
 	

 	echo "
 			<td class='ocultar' style='text-align: left;'>".utf8_encode($axglosa)."</td>
 			<td style='text-align: right;'>".$axmonto."</td> 			
 			<td style='text-align: center;'>
 				<div class='btn-group dropstart'>
					<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
					<ul class='dropdown-menu'>	
					<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-info' id='btn_editar_egreso' data-id='$axcod_mov'><b><i class='bi bi-pencil' ></i> Editar</a></b>
					<a href='#' class='dropdown-item text-danger' id='btn_eliminar_egreso' data-id='$axcod_mov'><b><i class='bi bi-trash3-fill'></i> Eliminar</a></b>
					<div><hr class='dropdown-divider'></div>
					<a href='#' class='dropdown-item text-danger' id='btn_revertir_egreso' data-id='$axcod_mov'><b><i class='bi bi-plus-slash-minus'></i> Revertir</a></b>
					<a href='#' class='dropdown-item text-success' id='btn_sustento_egreso' data-id='$axcod_mov' ><b><i class='bi bi-cloud-upload-fill'></i> Subir sustento</a></b>
					<div><hr class='dropdown-divider'></div>
					</ul>
				</div>
 			</td>";

}
echo "</table>";
}


}else{

	echo "<h4 class='text-danger'>Seleccionar un almacén...</h4>";
}


break;

case '26': //grabar egreso cz

date_default_timezone_set("America/Lima");
	
$axcodusuario = $_POST['txtcodusuario'];
$axid_empresa = $_POST['txtid_empresa'];
$axcod_mov = $_POST['txtcod_mov'];
$axtipo_mov = $_POST['txttipo_mov'];
$axdetalle_movimiento = $_POST['txtdetalle_movimiento'];
$axcod_tip_nc_nd_ref = $_POST['txtcod_tip_nc_nd_ref'];
$axestado_inventario='INVENTARIO';
$axfecha_emision = $_POST['txtfecha_emision'];
$axperiodo_emision = date('m-Y',strtotime($axfecha_emision));
$axid_td = $_POST['txtid_td'];
$axporc_igv = $_POST['txtporc_igv'];
$axn_serie = $_POST['txtn_serie'];
$axdocumento = $_POST['txtdocumento'];
$axid_beneficiario = $_POST['txtid_beneficiario'];
$axfecha_registro = date('Y-m-d');
$ano_registro= date('Y');
$axid_local = $_POST['txtid_local'];
$axglosa = $_POST['txtglosa'];
$axmoneda = $_POST['txtmoneda'];
$axtipo_cambio = $_POST['txttipo_cambio'];
$axfecha_llegada_mercaderia = $_POST['txtfecha_llegada_mercaderia'];
$axdoc_ingreso_mercaderia = $_POST['txtdoc_ingreso_mercaderia'];
$axdetalle_ingreso = $_POST['txtdetalle_ingreso'];
$axnum_programacion = $_POST['txtnum_programacion'];
$axtipo_nota_debito = $_POST['txttipo_nota_debito'];

$axestado_forma_pago = $_POST['txtestado_forma_pago'];
$axforma_pago = $_POST['txtforma_pago'];
$axmedio_pago = $_POST['txtmedio_pago'];
$axid_cta = $_POST['txtid_cta'];
$axnum_transf = $_POST['txtnum_transf'];
$axfecha_transf = $_POST['txtfecha_transf'];


$axparametros = $_POST['txtparametros'];

if($axparametros==1){

$SQLInsert = "INSERT INTO MAESTRO_CZ (COD_MOV,TIPO_MOV,DETALLE_MOVIMIENTO,FECHA_EMISION,PERIODO_EMISION,ID_TD,TXT_SERIE,DOCUMENTO,ID_BENEFICIARIO,ID_USUARIO,FECHA_REGISTRO,ANO,ID_LOCAL,GLOSA,PERIODO_CONTABLE,MONEDA,ESTADO_ELECTRO,FECHA_CONTABLE,ESTADO_FINAL,ESTADO_ENVIADO_ITC,TIPO_CAMBIO,FECHA_LLEGADA,MONTO_PAGADO,DETALLE_INGRESO,NUM_PROGRAMACION) VALUES ('$axcod_mov','$axtipo_mov','$axdetalle_movimiento','$axfecha_emision','$axperiodo_emision','$axid_td','$axn_serie','$axdocumento','$axid_beneficiario','$axcodusuario','$axfecha_registro','$ano_registro','$axid_local','$axglosa','$axperiodo_emision','$axmoneda','PROCESADA','$axfecha_emision','PROCESADA','ENVIADO','$axtipo_cambio','$axfecha_llegada_mercaderia',0,'$axdetalle_ingreso','$axnum_programacion')";

}else{

$SQLInsert ="UPDATE MAESTRO_CZ SET TIPO_MOV='$axtipo_mov',DETALLE_MOVIMIENTO='$axdetalle_movimiento',FECHA_EMISION='$axfecha_emision',PERIODO_EMISION='$axperiodo_emision',ID_TD='$axid_td',TXT_SERIE='$axn_serie',DOCUMENTO='$axdocumento',ID_BENEFICIARIO='$axid_beneficiario',ID_USUARIO='$axcodusuario',FECHA_REGISTRO='$axfecha_registro',ANO='$ano_registro',ID_LOCAL='$axid_local',GLOSA='$axglosa',PERIODO_CONTABLE='$axperiodo_emision',MONEDA='$axmoneda',ESTADO_ELECTRO='PROCESADA',FECHA_CONTABLE='$axfecha_emision',ESTADO_FINAL='PROCESADA',ESTADO_ENVIADO_ITC='ENVIADO',TIPO_CAMBIO='$axtipo_cambio',FECHA_LLEGADA='$axfecha_llegada_mercaderia',DETALLE_INGRESO='$axdetalle_ingreso',NUM_PROGRAMACION='$axnum_programacion' WHERE COD_MOV='$axcod_mov'";

}

//echo $SQLInsert;
$RSInserta = odbc_exec($con,$SQLInsert);

if($RSInserta){

	if($axparametros !==1){
		$verificar =  get_row('MAESTRO_DT','COD_MOV','COD_MOV',$axcod_mov);
		if($verificar !==''){

			$SQLActualizar = "UPDATE MAESTRO_DT SET FORMA_PAGO='$axforma_pago',ESTADO_FORMA_PAGO='$axestado_forma_pago',MEDIO_PAGO='$axmedio_pago',NUM_TRANSF='$axnum_transf',FECHA_TRANSF='$axfecha_transf',ID_CTA='$axid_cta' 
			WHERE COD_MOV='$axcod_mov'";
			$RSActualizar = odbc_exec($con,$SQLActualizar);
		}	
	}
	
	
	$respuesta = 0;
	echo $respuesta;
}else{
	$respuesta =1;
	echo $respuesta;
}

break;


case '27': //editar egreso cabeera
	
	$axcod_mov= $_POST['txtcod_mov'];
	$axid_local= $_POST['txtid_local'];
	
	$sql6 = "SELECT * FROM MAESTRO_CZ_EGRESOS_TRAER WHERE ID_LOCAL = '$axid_local' AND COD_MOV='$axcod_mov'";
	
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

case '28': //eliminar compra o gasto pero solo la cabecera
	
	$axcod_mov= $_POST['txtcod_mov'];
	$axid_local= $_POST['txtid_local'];


	$SQLEliminar = "DELETE FROM MAESTRO_CZ WHERE ID_LOCAL = '$axid_local' AND COD_MOV='$axcod_mov'";
	$RSEliminar = odbc_exec($con,$SQLEliminar);

	if($RSEliminar){
		$respuesta =0;
		echo $respuesta;
	}else{
		$respuesta =1;
		echo $respuesta;
	}


break;

case '29':// GRABAR MAESTRO_DT DE COMPRAS

	// var_dump($_POST);
	// die();

$axid_local = $_POST['txtid_local'];	
$axcod_mov = trim($_POST['txtcod_mov']);
$axcod_mov_dt = $_POST['txtcod_mov_dt'];
$axid_producto = $_POST['txtid_producto'];
$axcant_ingreso = $_POST['txtcant_ingreso'];
$axcosto_producto = $_POST['txtcosto_producto'];
$axdsctos_ingreso = $_POST['txtdsctos_ingreso'];
$axvalor_ingreso = $_POST['txtvalor_ingreso'];
$axigv_ingreso = $_POST['txtigv_ingreso'];
$axgravadas_ingreso = $_POST['txtgravadas_ingreso'];
$axinafecto_ingresos = $_POST['txtinafecto_ingresos'];
$axexonerado_ingreso = $_POST['txtexonerado_ingreso'];
$axtotal_ingreso = $_POST['txttotal_ingreso'];
$axcant_salida =$_POST['txtcant_salida'];

$axprs_premiun =$_POST['txtprs_premiun'];
$axprs_menor =$_POST['txtprs_menor'];
$axdsctos_salida =$_POST['txtdsctos_salida'];
$axvalor_salida =$_POST['txtvalor_salida'];
$axigv_salida =$_POST['txtigv_salida'];
$axgravadas_salida =$_POST['txtgravadas_salida'];
$axinafecto_salida =$_POST['txtinafecto_salida'];
$axexonerado_salida =$_POST['txtexonerado_salida'];
$axtotal_salida =$_POST['txttotal_salida'];
$axforma_pago =$_POST['txtforma_pago'];
$axdias_pago =$_POST['txtdias_pago'];
$axestado_forma_pago =$_POST['txtestado_forma_pago'];
$axmedio_pago =$_POST['txtmedio_pago'];
$axnum_transf =$_POST['txtnum_transf'];
$axpor_detraccion =$_POST['txtpor_detraccion'];
$axmonto_detraccion =$_POST['txtmonto_detraccion'];
$axnum_detraccion =$_POST['txtnum_detraccion'];
$axfecha_detraccion =$_POST['txtfecha_detraccion'];
$axestado_producto =$_POST['txtestado_producto'];
$axobservar =$_POST['txtobservar'];
$axfecha_transf =$_POST['txtfecha_transf'];
$axid_cta =$_POST['txtid_cta'];
$axperiodo_transf =date('m-Y',strtotime($axfecha_transf));
$axparametros =$_POST['txtparametros'];
$axvalor =$_POST['txtvalor'];
/*
$axmargen_producto = get_row('PRODUCTOS','MARGEN_PRODUCTO','ID_PRODUCTO',$axid_producto);
$axutilidad = ($axcosto_producto*$axmargen_producto)/100;
$axprs_mayor =$axcosto_producto+$axutilidad;
*/
$axmargen_producto = 0;
$axutilidad = 0;
$axprs_mayor =0;

//$axdetalle_movimiento = get_row('MAESTRO_CZ','TIPO_COMPRA','COD_MOV',$axcod_mov);
$axdetalle_movimiento ='';
$axtipo_doc = get_row('MAESTRO_CZ','ID_TD','COD_MOV',$axcod_mov);

$axtipo_nc = get_row('MAESTRO_CZ','cod_tip_nc_nd_ref','COD_MOV',$axcod_mov);

if($axtipo_doc =='6'){ //si es nota de credito

	if($axtipo_nc=='05'){
		$axcosto_producto=$_POST['txtcosto_producto']/-1;
	}elseif($axtipo_nc=='07' || $axtipo_nc=='01'){
		$axcant_ingreso =$_POST['txtcant_ingreso']/-1;	
	}

	
}


if($axparametros==1){


$sqlinserta ="INSERT INTO MAESTRO_DT (COD_MOV,ID_PRODUCTO,CANT_INGRESO,COSTO_PRODUCTO,DSCTOS_INGRESO,VALOR_INGRESO,IGV_INGRESO,GRAVADAS_INGRESO,INAFECTO_INGRESOS,EXONERADO_INGRESO,TOTAL_INGRESO,CANT_SALIDA,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,FORMA_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,NUM_TRANSF,POR_DETRACCION,MONTO_DETRACCION,NUM_DETRACCION,FECHA_DETRACCION,ESTADO_PRODUCTO,FECHA_TRANSF,ID_CTA,PERIODO_TRANSF) VALUES ('$axcod_mov','$axid_producto','$axcant_ingreso','$axcosto_producto','$axdsctos_ingreso','$axvalor_ingreso','$axigv_ingreso','$axgravadas_ingreso','$axinafecto_ingresos','$axexonerado_ingreso','$axtotal_ingreso','$axcant_salida','$axdsctos_salida','$axvalor_salida','$axigv_salida','$axgravadas_salida','$axinafecto_salida','$axexonerado_salida','$axtotal_salida','$axforma_pago','$axestado_forma_pago','$axmedio_pago','$axnum_transf','$axpor_detraccion','$axmonto_detraccion','$axnum_detraccion','$axfecha_detraccion','$axestado_producto','$axfecha_transf','$axid_cta','$axperiodo_transf')";

}else{

$sqlinserta = "UPDATE MAESTRO_DT SET COD_MOV='$axcod_mov',ID_PRODUCTO='$axid_producto',CANT_INGRESO='$axcant_ingreso',COSTO_PRODUCTO='$axcosto_producto',DSCTOS_INGRESO='$axdsctos_ingreso',VALOR_INGRESO='$axvalor_ingreso',IGV_INGRESO='$axigv_ingreso',GRAVADAS_INGRESO='$axgravadas_ingreso',INAFECTO_INGRESOS='$axinafecto_ingresos',EXONERADO_INGRESO='$axexonerado_ingreso',TOTAL_INGRESO='$axtotal_ingreso',CANT_SALIDA='$axcant_salida',PRS_MAYOR='$axprs_mayor',PRS_PREMIUN='$axprs_premiun',PRS_MENOR='$axprs_menor',DSCTOS_SALIDA='$axdsctos_salida',VALOR_SALIDA='$axvalor_salida',IGV_SALIDA='$axigv_salida',GRAVADAS_SALIDA='$axgravadas_salida',INAFECTO_SALIDA='$axinafecto_salida',EXONERADO_SALIDA='$axexonerado_salida',TOTAL_SALIDA='$axtotal_salida',FORMA_PAGO='$axforma_pago',FECHA_PAGO='$axfecha_pago',ESTADO_FORMA_PAGO='$axestado_forma_pago',MEDIO_PAGO='$axmedio_pago',NUM_TRANSF='$axnum_transf',POR_DETRACCION='$axpor_detraccion',MONTO_DETRACCION='$axmonto_detraccion',NUM_DETRACCION='$axnum_detraccion',FECHA_DETRACCION='$axfecha_detraccion',ESTADO_PRODUCTO='$axestado_producto',FECHA_TRANSF='$axfecha_transf',ID_CTA='$axid_cta',PERIODO_TRANSF='$axperiodo_transf' WHERE COD_MOV_DT='$axcod_mov_dt'";
}

//echo $sqlinserta;

$rsinserta = odbc_exec($con,$sqlinserta);
//mostrando debajo
	if($rsinserta){

		$SQLTotal = "SELECT TOP 1 * FROM MAESTRO_EGRESOS_TT WHERE COD_MOV='$axcod_mov' AND ID_LOCAL='$axid_local'";
		//echo $SQLTotal;
		$RSTotal = odbc_exec($con,$SQLTotal);
		$fila_tt = odbc_fetch_array($RSTotal);

		$axvalor_ingreso = $fila_tt['VALOR_INGRESO'];
		$axigv_ingreso = $fila_tt['IGV_INGRESO'];
		$axgravadas_ingreso = $fila_tt['GRAVADAS_INGRESO'];
		$axinafecto_ingresos = $fila_tt['INAFECTO_INGRESOS'];
		$axexonerado_ingreso = $fila_tt['EXONERADO_INGRESO'];
		$axtotal_ingreso = $fila_tt['TOTAL_INGRESO'];


		$SQLActualizar = "UPDATE MAESTRO_CZ SET VALOR_VENTA='$axvalor_ingreso',IGV='$axigv_ingreso',GRAVADAS='$axgravadas_ingreso',INAFECTAS='$axinafecto_ingresos',EXONERADAS='$axexonerado_ingreso',MNT_TOT_GRAVADAS='$axgravadas_ingreso',MNT_TOT_INAFECTAS='$axinafecto_ingresos',MNT_TOT_EXONERADAS='$axexonerado_ingreso',MNT_TOT_GRATUITAS='0',MNT_TOT='$axtotal_ingreso',TOTAL_VENTA='$axtotal_ingreso' WHERE COD_MOV='$axcod_mov' AND ID_LOCAL='$axid_local'";
		$RSActualizar = odbc_exec($con,$SQLActualizar);

		//echo $SQLActualizar;

		$respuesta =0;
		echo $respuesta;

	}else{
		
		$respuesta =1;
		echo $respuesta;
	}

break;

case '30': //BUSCAR PRODUCTOS PARA COMPRAR
	
   $axbuscar_dato =$_POST['txtnom_producto'];
   $axdetalle_movimiento =$_POST['txtdetalle_movimiento'];
   	$axtipo_categoria=$_POST['txtdetalle_ingreso'];

 if(isset($_POST["txtnom_producto"])){

	$output ='';
	$idprov ='';
	$sqlemisor = "SELECT TOP 5 * FROM PRODUCTOS_LISTADO WHERE TIPO_CATEGORIA ='$axtipo_categoria' and NOM_PRODUCTO+COD_PRODUCTO LIKE  '%".$axbuscar_dato."%' ORDER BY NOM_PRODUCTO";
	//echo $sqlemisor;

	$rsemisor=odbc_exec($con,$sqlemisor);
	//$output ='<ul id="listar" class="list-unstyled ul">';
	$output ='<ul class="list-group">';
  		

	if(odbc_num_rows($rsemisor) > 0){
		 while ($row=odbc_fetch_array($rsemisor)){		
		 	$id =  $row["ID_PRODUCTO"];
		 	$nom_prod =  trim($row["NOM_PRODUCTO"]);

		 	$output .='<a href="#" id="btn_listar_productos_egresos" class="list-group-item list-group-item-action" style="background:#DAF5FF;" data-id='.$id.' data-nom_pro='.$nom_prod.'> <i class="bi bi-box-seam-fill"></i> '.utf8_encode($row["NOM_PRODUCTO"]).' | Und: '.$row["PRESENTACION"].'</a>';
		 }

	}else{
		
		$output .='<a href="#" id="btn_listar_productos_egresos_nuevo" class="list-group-item list-group-item-action bg-danger" data-bs-toggle="modal" data-bs-target="#mdl_nuevo_servicios"> '.$axbuscar_dato.' (Nuevo)</a>';
	
	}

	$output .='</ul>';
	echo $output;

}else{
	echo $output;	
}

break;
case '31':

	
$axcod_mov = $_POST['txtcod_mov']; 	
$axid_local = $_POST['txtid_local']; 	
$axbuscaregistro = $_POST['txtbuscar_dt']; 	

if($axbuscaregistro==""){
	$SQLBuscar = "SELECT  * FROM MAESTRO_EGRESOS_DT WHERE ID_LOCAL = '$axid_local' AND COD_MOV='$axcod_mov' order by COD_PRODUCTO,COD_MOV_DT ASC";
}else{
	$SQLBuscar ="SELECT  *  FROM MAESTRO_EGRESOS_DT WHERE ID_LOCAL = '$axid_local' AND COD_MOV='$axcod_mov' AND NOM_PRODUCTO like '%".$axbuscaregistro."%' ";
}

//echo "$SQLBuscar";
echo "
	<div id='div3'>
	<div class='col-md-4' id='div_buscar_item_dt' hidden>
		<div class='form-floating'>
		<input type='text' class='form-control' id='txtbuscar_dt' placeholder='Buscar'>
		<label for='txtbuscar'><b><i class='bi bi-search'></i> Buscar</b></label>
		</div>
	</div>
	<br>

	<table class='table table-hover table-sm'>
	<thead class='table-success'>			
		<tr>
			<th class='ocultar'style='text-align: center;'>It</th>			
			<th class='ocultar_1'style='text-align: left;'>Producto</th>
			<th class='ocultar_1'style='text-align: right;'>Cant</th>									
			<th class='ocultar'style='text-align: right;'>Precio</th>									
			<th class='ocultar'style='text-align: right;'>V.Compra</th>									
			<th class='ocultar'style='text-align: right;'>IGV</th>									
			<th class='ocultar'style='text-align: right;'>Gravada</th>									
			<th class='ocultar' style='text-align: right;'>Exonerada</th>									
			<th class='ocultar' style='text-align: right;'>Inafecta</th>									
			<th class='ocultar_1'style='text-align: right;'>Total</th>									
			<th class='ocultar_1'style='text-align: center;'></th>
		</tr>
	</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$axid_producto= $fila['ID_PRODUCTO']; 		
 		$axcod_mov_dt = $fila['COD_MOV_DT']; 		
		$axcod_producto = $fila['COD_PRODUCTO'];
		$axnom_producto =$fila['NOM_PRODUCTO'];
		$axprecio_compra =$fila["COSTO_PRODUCTO"];
		$axcant_compra =$fila["CANT_INGRESO"];

		$axcant = number_format($fila["CANT_INGRESO"],2,".",",");
		$axprecio = number_format($fila["COSTO_PRODUCTO"],4,".",",");
		$axvalor = number_format($fila["VALOR_INGRESO"],2,".",",");
		$axigv = number_format($fila["IGV_INGRESO"],2,".",",");
		$axgravada = number_format($fila["GRAVADAS_INGRESO"],2,".",",");
		$axexonerada = number_format($fila["EXONERADO_INGRESO"],2,".",",");
		$axinafecta = number_format($fila["INAFECTO_INGRESOS"],2,".",",");
		$axtotal = number_format($fila["TOTAL_INGRESO"],2,".",",");

		//echo $axcod_mov_dt;

 	echo "
 		<tr> 		
 			<td class='ocultar'style='text-align: center;'>".$it."</td>
 			<td class='ocultar_1'style='text-align: left;''>".utf8_encode($axnom_producto)."</td>  			
 			<td id='btn_cambiar_cantidad' data-idprod='$axid_producto' data-id_dt='$axcod_mov_dt' data-precio='$axprecio_compra' class='table-danger ocultar_1'style='text-align: right;'>".$axcant."</td> 
 			<td id='btn_cambiar_precio' data-idprod='$axid_producto' data-id_dt='$axcod_mov_dt' data-cantidad='$axcant_compra' class='table-danger ocultar'style='text-align: right;'>".$axprecio."</td> 
 			<td class='ocultar'style='text-align: right;'>".$axvalor."</td> 
 			<td class='ocultar'style='text-align: right;'>".$axigv."</td> 
 			<td class='ocultar'style='text-align: right;'>".$axgravada."</td> 
 			<td class='ocultar' style='text-align: right;'>".$axexonerada."</td> 
 			<td class='ocultar' style='text-align: right;'>".$axinafecta."</td> 
 			<td class='ocultar_1'style='text-align: right;'>".$axtotal."</td>
 			<td class='ocultar_1'style='text-align: center;'>
 				<a href='#' class='dropdown-item text-danger' id='btn_eliminar_egreso_dt' data-id='$axcod_mov_dt'><b><i class='bi bi-trash3-fill'></i></a></b>
 			</td>
 		</tr>";	
}

if($axbuscaregistro==""){
	$SQLBuscar_t = "SELECT  SUM(VALOR_INGRESO) AS VC, SUM(IGV_INGRESO) AS IG, SUM(GRAVADAS_INGRESO) AS GR, SUM(EXONERADO_INGRESO) AS EX, SUM(INAFECTO_INGRESOS) AS IA, SUM(TOTAL_INGRESO) AS TT FROM MAESTRO_EGRESOS_DT WHERE ID_LOCAL = '$axid_local' AND COD_MOV='$axcod_mov'";
}else{
	$SQLBuscar_t ="SELECT  SUM(VALOR_INGRESO) AS VC, SUM(IGV_INGRESO) AS IG, SUM(GRAVADAS_INGRESO) AS GR, SUM(EXONERADO_INGRESO) AS EX, SUM(INAFECTO_INGRESOS) AS IA, SUM(TOTAL_INGRESO) AS TT  FROM MAESTRO_EGRESOS_DT WHERE ID_LOCAL = '$axid_local' AND COD_MOV='$axcod_mov' AND NOM_PRODUCTO like '%".$axbuscaregistro."%' ";
}

$RSBuscar_t = odbc_exec($con,$SQLBuscar_t);
$fila_t = odbc_fetch_array($RSBuscar_t);

$vc = number_format($fila_t["VC"],2,".",",");
$ig = number_format($fila_t["IG"],2,".",",");
$gr = number_format($fila_t["GR"],2,".",",");
$ex = number_format($fila_t["EX"],2,".",",");
$ia = number_format($fila_t["IA"],2,".",",");
$tt = number_format($fila_t["TT"],2,".",",");


echo "
 		<tr>
 		<th class='ocultar_1' style='text-align: right;' ></th>
 		<th class='ocultar_1' style='text-align: right;' ></th>
 		<th class='ocultar' style='text-align: right;' ></th>
 		<th class='ocultar' style='text-align: right;' ></th>
 		<th class='ocultar' style='text-align: right;' >$vc</th>
 		<th class='ocultar' style='text-align: right;' >$ig</th>									
 		<th class='ocultar' style='text-align: right;' >$gr</th>									
 		<th class='ocultar' style='text-align: right;' >$ex</th>									
 		<th class='ocultar' style='text-align: right;' >$ia</th>									
 		<th class='ocultar_1' style='text-align: right;' >$tt</th>																		

 		</tr>
 			";


echo "</table>
</div>";
}else{
	echo "<h4 class='text-danger'>No registra detalle de compra</h4>";
}

break;

case '32':
	
	
$axid_producto= $_POST['txtid_producto'];
	
	$sql6 = "SELECT * FROM PRODUCTOS_LISTADO WHERE ID_PRODUCTO = '$axid_producto'";
	
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
case '33': //traer porcentaje del comprobante
	
$axid_td= $_POST['txtid_td'];
	
	$sql6 = "SELECT * FROM TIPO_DOCUMENTOS WHERE ID_TD = '$axid_td'";
	
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

case '34': // ELIMINAR UN ITEM DEL DETALLE DEL MAESTRO_DT
	
$axcod_mov_dt= $_POST['txtcod_mov_dt'];
$axcod_mov= $_POST['txtcod_mov'];
$axid_local= $_POST['txtid_local'];

$SQLEliminar = "DELETE FROM MAESTRO_DT WHERE COD_MOV_DT='$axcod_mov_dt'";
$RSEliminar = odbc_exec($con,$SQLEliminar);
//echo $SQLEliminar;

if($RSEliminar){

		$SQLTotal = "SELECT TOP 1 * FROM MAESTRO_EGRESOS_TT WHERE COD_MOV='$axcod_mov' AND ID_LOCAL='$axid_local'";
		$RSTotal = odbc_exec($con,$SQLTotal);
		$fila_tt = odbc_fetch_array($RSTotal);
		//echo $SQLTotal;

		if(odbc_num_rows($RSTotal) > 0) {

			$axvalor_ingreso = $fila_tt['VALOR_INGRESO'];
			$axigv_ingreso = $fila_tt['IGV_INGRESO'];
			$axgravadas_ingreso = $fila_tt['GRAVADAS_INGRESO'];
			$axinafecto_ingresos = $fila_tt['INAFECTO_INGRESOS'];
			$axexonerado_ingreso = $fila_tt['EXONERADO_INGRESO'];
			$axtotal_ingreso = $fila_tt['TOTAL_INGRESO'];

			$SQLActualizar = "UPDATE MAESTRO_CZ SET VALOR_VENTA='$axvalor_ingreso',IGV='$axigv_ingreso',GRAVADAS='$axgravadas_ingreso',INAFECTAS='$axinafecto_ingresos',EXONERADAS='$axexonerado_ingreso',MNT_TOT_GRAVADAS='$axgravadas_ingreso',MNT_TOT_INAFECTAS='$axinafecto_ingresos',MNT_TOT_EXONERADAS='$axexonerado_ingreso',MNT_TOT_GRATUITAS='0',MNT_TOT='$axtotal_ingreso',TOTAL_VENTA='$axtotal_ingreso' WHERE COD_MOV='$axcod_mov' AND ID_LOCAL='$axid_local'";
			$RSActualizar = odbc_exec($con,$SQLActualizar);
			//echo $SQLActualizar;

		}else{

			$axvalor_ingreso = 0;
			$axigv_ingreso = 0;
			$axgravadas_ingreso = 0;
			$axinafecto_ingresos = 0;
			$axexonerado_ingreso = 0;
			$axtotal_ingreso = 0;

			$SQLActualizar = "UPDATE MAESTRO_CZ SET VALOR_VENTA='$axvalor_ingreso',IGV='$axigv_ingreso',GRAVADAS='$axgravadas_ingreso',INAFECTAS='$axinafecto_ingresos',EXONERADAS='$axexonerado_ingreso',MNT_TOT_GRAVADAS='$axgravadas_ingreso',MNT_TOT_INAFECTAS='$axinafecto_ingresos',MNT_TOT_EXONERADAS='$axexonerado_ingreso',MNT_TOT_GRATUITAS='0',MNT_TOT='$axtotal_ingreso',TOTAL_VENTA='$axtotal_ingreso' WHERE COD_MOV='$axcod_mov' AND ID_LOCAL='$axid_local'";
			$RSActualizar = odbc_exec($con,$SQLActualizar);
			//echo $SQLActualizar;
		}

		

	$respuesta =0;
	echo $respuesta;
}else{
	$respuesta =1;
	echo $respuesta;
}


break;

case '35'://GENERAR COD_MOV DE COMPRAS Y GASTOS

$axcodusuario = $_POST['txtcodusuario'];
$axid_local = $_POST['txtid_local'];
	
$axdni_user = get_row('USUARIOS','COD_USUARIO','ID_USUARIO',$axcodusuario);
$logitudPass = 10;
$axcod = substr($axdni_user,0,3);
$nuevo_nombre_a = substr(md5(microtime()),1,$logitudPass);
$nuevo_nombre = $axid_local.$axcod.$nuevo_nombre_a;
$axcodmovcz = $nuevo_nombre;
echo trim($axcodmovcz);


break;

case '126':
	
	$axcod_mov =$_POST['txtcod_mov'];
	$axtipo_excel =$_POST['txttipo_excel'];
	$nombrearchivo = '../archivos/'.$_POST['txtnomexcel']; 
	$axid_local =get_row('MAESTRO_CZ','ID_LOCAL','COD_MOV',$axcod_mov);
	$axporc_igv = get_row('LOCALES','PORC_IGV','ID_LOCAL',$axid_local);

	//$SQLimpiar = "DELETE FROM MAESTRO_INVENTARIOS_AUXILIAR";
	//$RSLimpiar = odbc_exec($con,$SQLimpiar);

	$axfecha= date("Y-m-d");

	if($axtipo_excel=='INVENTARIO'){

	$objPHPExcel = PHPExcel_IOFactory::load($nombrearchivo);	
	$objPHPExcel->setActiveSheetIndex(0);
	$numfilas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
	
	for ($ind=1; $ind <=$numfilas ; $ind++) { 

		$it=0;
		
		$a = $objPHPExcel->getActiveSheet()->getCell('A'.$ind)->getCalculatedValue();
		$b = $objPHPExcel->getActiveSheet()->getCell('B'.$ind)->getCalculatedValue();
		$c = $objPHPExcel->getActiveSheet()->getCell('C'.$ind)->getCalculatedValue();
	
		$filtro = $objPHPExcel->getActiveSheet()->getCell('D'.$ind)->getCalculatedValue();
		
		if ($filtro == "INVENTARIO") {

				$axid_producto = get_row('PRODUCTOS','ID_PRODUCTO','COD_PRODUCTO',$a);
				
				//$SQLActualizar = "INSERT INTO MAESTRO_INVENTARIOS_AUXILIAR (ID_LOCAL,ID_PRODUCTO,COD_PRODUCTO,NOM_PRODUCTO,STOCK_REAL)VALUES('$axlocal','$axid_producto','$a','$b','$c')";
				//$RSActualizar = odbc_exec($con,$SQLActualizar);
		
				
				$axcant_ingreso = $c;
				$axcosto_producto = get_row('PRODUCTOS','COSTO_PRODUCTO','ID_PRODUCTO',$axid_producto);
				$axdsctos_ingreso = 0;
				$axvalor_ingreso = $axcant_ingreso*$axcosto_producto;
				$axigv_ingreso = $axvalor_ingreso*$axporc_igv;
				$axgravadas_ingreso = $axvalor_ingreso;
				$axinafecto_ingresos = 0;
				$axexonerado_ingreso = 0;
				$axtotal_ingreso = $axvalor_ingreso+$axigv_ingreso;

				$axcant_salida =0;
				$axprs_mayor=0;
				$axprs_premiun =0;
				$axprs_menor =0;
				$axdsctos_salida =0;
				$axvalor_salida =0;
				$axigv_salida =0;
				$axgravadas_salida =0;
				$axinafecto_salida =0;
				$axexonerado_salida =0;
				$axtotal_salida =0;
				$axforma_pago ='CONTADO';
				$axdias_pago =0;
				$axestado_forma_pago ='CANCELADO';
				$axmedio_pago ='EFECTIVO';
				$axnum_transf ='';
				$axpor_detraccion =0;
				$axmonto_detraccion =0;
				$axnum_detraccion =0;				
				$axestado_producto ='BUENO';
				$axobservar ='INVENTARIO';								
				$axparametros =$_POST['txtparametros'];

				$sqlinserta ="INSERT INTO MAESTRO_DT (COD_MOV,ID_PRODUCTO,CANT_INGRESO,COSTO_PRODUCTO,DSCTOS_INGRESO,VALOR_INGRESO,IGV_INGRESO,GRAVADAS_INGRESO,INAFECTO_INGRESOS,EXONERADO_INGRESO,TOTAL_INGRESO,CANT_SALIDA,PRS_MAYOR,PRS_PREMIUN,PRS_MENOR,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,FORMA_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,NUM_TRANSF,POR_DETRACCION,MONTO_DETRACCION,NUM_DETRACCION,ESTADO_PRODUCTO) VALUES ('$axcod_mov','$axid_producto','$axcant_ingreso','$axcosto_producto','$axdsctos_ingreso','$axvalor_ingreso','$axigv_ingreso','$axgravadas_ingreso','$axinafecto_ingresos','$axexonerado_ingreso','$axtotal_ingreso','$axcant_salida','$axprs_mayor','$axprs_premiun','$axprs_menor','$axdsctos_salida','$axvalor_salida','$axigv_salida','$axgravadas_salida','$axinafecto_salida','$axexonerado_salida','$axtotal_salida','$axforma_pago','$axestado_forma_pago','$axmedio_pago','$axnum_transf','$axpor_detraccion','$axmonto_detraccion','$axnum_detraccion','$axestado_producto')";
				$rsinserta =odbc_exec($con,$sqlinserta);
				//echo $sqlinserta.'<br>';


		}


	}


	}elseif($axtipo_excel=='PRECIOS'){
	
	$objPHPExcel = PHPExcel_IOFactory::load($nombrearchivo);	
	$objPHPExcel->setActiveSheetIndex(0);
	$numfilas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
	
	for ($ind=1; $ind <=$numfilas ; $ind++) { 

		$it=0;
		
		$a = $objPHPExcel->getActiveSheet()->getCell('A'.$ind)->getCalculatedValue(); //COD_PRODUCTO
		$b = $objPHPExcel->getActiveSheet()->getCell('B'.$ind)->getCalculatedValue(); //NOMBRE PRODUCTO
		$c = $objPHPExcel->getActiveSheet()->getCell('C'.$ind)->getCalculatedValue(); //COSTO SIN IGV
	
		$filtro = $objPHPExcel->getActiveSheet()->getCell('D'.$ind)->getCalculatedValue(); // FILTRO DE CARGA = 'PRECIOS'
		
		if ($filtro == "PRECIOS") {

				$axid_producto = get_row('PRODUCTOS','ID_PRODUCTO','COD_PRODUCTO',$a);			
				$axcant_ingreso = get_row_two('MAESTRO_DT','CANT_INGRESO','ID_PRODUCTO','COD_MOV',$axid_producto,$axcod_mov);	

				//echo $axcant_ingreso.'<br>';

			
				$axcosto_producto = $c;
				$axdsctos_ingreso = 0;
				$axvalor_ingreso = $axcant_ingreso*$axcosto_producto;
				$axigv_ingreso = $axvalor_ingreso*$axporc_igv;
				$axgravadas_ingreso = $axvalor_ingreso;
				$axinafecto_ingresos = 0;
				$axexonerado_ingreso = 0;
				$axtotal_ingreso = $axvalor_ingreso+$axigv_ingreso;

				$axcant_salida =0;
				$axprs_mayor=0;
				$axprs_premiun =0;
				$axprs_menor =0;
				$axdsctos_salida =0;
				$axvalor_salida =0;
				$axigv_salida =0;
				$axgravadas_salida =0;
				$axinafecto_salida =0;
				$axexonerado_salida =0;
				$axtotal_salida =0;
				$axforma_pago ='CONTADO';
				$axdias_pago =0;
				$axestado_forma_pago ='CANCELADO';
				$axmedio_pago ='EFECTIVO';
				$axnum_transf ='';
				$axpor_detraccion =0;
				$axmonto_detraccion =0;
				$axnum_detraccion =0;				
				$axestado_producto ='BUENO';
				$axobservar ='INVENTARIO';								
				$axparametros =$_POST['txtparametros'];

				if($axcant_ingreso ==''){ // SI EL PRODUCTO NO EXISTE NO ACTUALIZA NADAA
			
				}else{

					$sqlinserta = "UPDATE MAESTRO_DT SET CANT_INGRESO='$axcant_ingreso',COSTO_PRODUCTO='$axcosto_producto',DSCTOS_INGRESO='$axdsctos_ingreso',VALOR_INGRESO='$axvalor_ingreso',IGV_INGRESO='$axigv_ingreso',GRAVADAS_INGRESO='$axgravadas_ingreso',INAFECTO_INGRESOS='$axinafecto_ingresos',EXONERADO_INGRESO='$axexonerado_ingreso',TOTAL_INGRESO='$axtotal_ingreso' WHERE COD_MOV='$axcod_mov' AND ID_PRODUCTO='$axid_producto'";
					$rsinserta =odbc_exec($con,$sqlinserta);		
				//echo $sqlinserta.'<br>';

				}
	
			

		}
	}




	}



break;

case '131':
	
$axid_local =$_POST['txtid_local'];
$axcod_mov =$_POST['txtcod_mov'];
$axcant_ingreso =$_POST['txtcant_ingreso'];
$axcosto_producto =$_POST['txtcosto_producto'];
$axcod_mov_dt =$_POST['txtcod_mov_dt'];
$axid_producto =$_POST['txtid_producto'];
$axporc_igv = get_row('LOCALES','PORC_IGV','ID_LOCAL',$axid_local);

$axtipo_nc = get_row('MAESTRO_CZ','cod_tip_nc_nd_ref','COD_MOV',$axcod_mov);

$axafectacion = get_row('PRODUCTOS_LISTADO','ABREV_AFECTACION','ID_PRODUCTO',$axid_producto);

if($axafectacion=='GRAVADA'){

	$axvalor_ingreso = $axcant_ingreso*$axcosto_producto;
	$axigv_ingreso =$axvalor_ingreso* $axporc_igv;
	$axgravadas_ingreso = $axvalor_ingreso;
	$axinafecto_ingresos = 0;
	$axexonerado_ingreso = 0;
	$axtotal_ingreso = $axvalor_ingreso+$axigv_ingreso;

}elseif($axafectacion=='EXONERADA'){

	$axvalor_ingreso = $axcant_ingreso*$axcosto_producto;
	$axigv_ingreso =0;
	$axgravadas_ingreso = 0;
	$axinafecto_ingresos = $axvalor_ingreso;
	$axexonerado_ingreso = 0;
	$axtotal_ingreso = $axvalor_ingreso+$axigv_ingreso;

}elseif($axafectacion=='INAFECTO'){

	$axvalor_ingreso = $axcant_ingreso*$axcosto_producto;
	$axigv_ingreso =0;
	$axgravadas_ingreso = 0;
	$axinafecto_ingresos = 0;
	$axexonerado_ingreso = $axvalor_ingreso;;
	$axtotal_ingreso = $axvalor_ingreso+$axigv_ingreso;

}

$axdetalle_movimiento = get_row('MAESTRO_CZ','TIPO_COMPRA','COD_MOV',$axcod_mov);
$axtipo_doc = get_row('MAESTRO_CZ','ID_TD','COD_MOV',$axcod_mov);

if($axdetalle_movimiento =='MERMA'){

	$axcant_ingreso =$_POST['txtcant_ingreso']/-1;	
	$axtotal_ingreso_1 = $axtotal_ingreso/-1;

}else{
	$axtotal_ingreso_1 = $axtotal_ingreso;
}

if($axtipo_doc =='6'){ //si es nota de credito

	if($axtipo_nc=='05'){
		$axcosto_producto=$_POST['txtcosto_producto']/-1;
	}elseif($axtipo_nc=='07' || $axtipo_nc=='01'){
		$axcant_ingreso =$_POST['txtcant_ingreso']/-1;	
	}

	
}


	$sqlinserta = "UPDATE MAESTRO_DT SET CANT_INGRESO='$axcant_ingreso',DSCTOS_INGRESO='0',VALOR_INGRESO='$axvalor_ingreso',IGV_INGRESO='$axigv_ingreso',GRAVADAS_INGRESO='$axgravadas_ingreso',INAFECTO_INGRESOS='$axinafecto_ingresos',EXONERADO_INGRESO='$axexonerado_ingreso',TOTAL_INGRESO='$axtotal_ingreso_1' WHERE COD_MOV_DT='$axcod_mov_dt'";
	$rsinserta = odbc_exec($con,$sqlinserta);

	//echo $sqlinserta;

	if($rsinserta){

		$SQLTotal = "SELECT TOP 1 * FROM MAESTRO_EGRESOS_TT WHERE COD_MOV='$axcod_mov' AND ID_LOCAL='$axid_local'";
		$RSTotal = odbc_exec($con,$SQLTotal);
		$fila_tt = odbc_fetch_array($RSTotal);

		$axvalor_ingreso = $fila_tt['VALOR_INGRESO'];
		$axigv_ingreso = $fila_tt['IGV_INGRESO'];
		$axgravadas_ingreso = $fila_tt['GRAVADAS_INGRESO'];
		$axinafecto_ingresos = $fila_tt['INAFECTO_INGRESOS'];
		$axexonerado_ingreso = $fila_tt['EXONERADO_INGRESO'];
		$axtotal_ingreso = $fila_tt['TOTAL_INGRESO'];

		$SQLActualizar = "UPDATE MAESTRO_CZ SET VALOR_VENTA='$axvalor_ingreso',IGV='$axigv_ingreso',GRAVADAS='$axgravadas_ingreso',INAFECTAS='$axinafecto_ingresos',EXONERADAS='$axexonerado_ingreso',MNT_TOT_GRAVADAS='$axgravadas_ingreso',MNT_TOT_INAFECTAS='$axinafecto_ingresos',MNT_TOT_EXONERADAS='$axexonerado_ingreso',MNT_TOT_GRATUITAS='0',MNT_TOT='$axtotal_ingreso',TOTAL_VENTA='$axtotal_ingreso' WHERE COD_MOV='$axcod_mov' AND ID_LOCAL='$axid_local'";
		$RSActualizar = odbc_exec($con,$SQLActualizar);

		$respuesta=0;
		echo $respuesta;

	}else{

		$respuesta=1;
		echo $respuesta;

	}



break;

case '132':

$axid_local =$_POST['txtid_local'];
$axcod_mov =$_POST['txtcod_mov'];
$axcant_ingreso =$_POST['txtcant_ingreso'];
$axcosto_producto =$_POST['txtcosto_producto'];
$axcod_mov_dt =$_POST['txtcod_mov_dt'];
$axid_producto =$_POST['txtid_producto'];
$axporc_igv = get_row('LOCALES','PORC_IGV','ID_LOCAL',$axid_local);

$axafectacion = get_row('PRODUCTOS_LISTADO','ABREV_AFECTACION','ID_PRODUCTO',$axid_producto);

if($axafectacion=='GRAVADA'){

	$axvalor_ingreso = $axcant_ingreso*$axcosto_producto;
	$axigv_ingreso =$axvalor_ingreso* $axporc_igv;
	$axgravadas_ingreso = $axvalor_ingreso;
	$axinafecto_ingresos = 0;
	$axexonerado_ingreso = 0;
	$axtotal_ingreso = $axvalor_ingreso+$axigv_ingreso;

}elseif($axafectacion=='EXONERADA'){

	$axvalor_ingreso = $axcant_ingreso*$axcosto_producto;
	$axigv_ingreso =0;
	$axgravadas_ingreso = 0;
	$axinafecto_ingresos = $axvalor_ingreso;
	$axexonerado_ingreso = 0;
	$axtotal_ingreso = $axvalor_ingreso+$axigv_ingreso;

}elseif($axafectacion=='INAFECTO'){

	$axvalor_ingreso = $axcant_ingreso*$axcosto_producto;
	$axigv_ingreso =0;
	$axgravadas_ingreso = 0;
	$axinafecto_ingresos = 0;
	$axexonerado_ingreso = $axvalor_ingreso;;
	$axtotal_ingreso = $axvalor_ingreso+$axigv_ingreso;

}

	$sqlinserta = "UPDATE MAESTRO_DT SET COSTO_PRODUCTO='$axcosto_producto',DSCTOS_INGRESO='0',VALOR_INGRESO='$axvalor_ingreso',IGV_INGRESO='$axigv_ingreso',GRAVADAS_INGRESO='$axgravadas_ingreso',INAFECTO_INGRESOS='$axinafecto_ingresos',EXONERADO_INGRESO='$axexonerado_ingreso',TOTAL_INGRESO='$axtotal_ingreso' WHERE COD_MOV_DT='$axcod_mov_dt'";
	$rsinserta = odbc_exec($con,$sqlinserta);

	if($rsinserta){

		$SQLTotal = "SELECT TOP 1 * FROM MAESTRO_EGRESOS_TT WHERE COD_MOV='$axcod_mov' AND ID_LOCAL='$axid_local'";
		$RSTotal = odbc_exec($con,$SQLTotal);
		$fila_tt = odbc_fetch_array($RSTotal);

		$axvalor_ingreso = $fila_tt['VALOR_INGRESO'];
		$axigv_ingreso = $fila_tt['IGV_INGRESO'];
		$axgravadas_ingreso = $fila_tt['GRAVADAS_INGRESO'];
		$axinafecto_ingresos = $fila_tt['INAFECTO_INGRESOS'];
		$axexonerado_ingreso = $fila_tt['EXONERADO_INGRESO'];
		$axtotal_ingreso = $fila_tt['TOTAL_INGRESO'];

		$SQLActualizar = "UPDATE MAESTRO_CZ SET VALOR_VENTA='$axvalor_ingreso',IGV='$axigv_ingreso',GRAVADAS='$axgravadas_ingreso',INAFECTAS='$axinafecto_ingresos',EXONERADAS='$axexonerado_ingreso',MNT_TOT_GRAVADAS='$axgravadas_ingreso',MNT_TOT_INAFECTAS='$axinafecto_ingresos',MNT_TOT_EXONERADAS='$axexonerado_ingreso',MNT_TOT_GRATUITAS='0',MNT_TOT='$axtotal_ingreso',TOTAL_VENTA='$axtotal_ingreso' WHERE COD_MOV='$axcod_mov' AND ID_LOCAL='$axid_local'";
		$RSActualizar = odbc_exec($con,$SQLActualizar);


		$respuesta=0;
		echo $respuesta;

	}else{

		$respuesta=1;
		echo $respuesta;

	}

	break;

case '177':
	
$axid_td = $_POST['txtid_td']; 		
$axid_local = $_POST['txtid_local']; 		

$sql6 = "SELECT * FROM TIPO_DOCUMENTO_EGRESOS WHERE ID_LOCAL = '$axid_local' AND ID_TD='$axid_td'";
	
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

case '178':
	
$axid_empresa = $_POST['txtid_empresa']; 		
$axid_categoria = $_POST['txtid_categoria']; 		
$axnuevo_servicios = $_POST['txtnuevo_servicios']; 		

$axcod_producto = '';
$axestado = 'ACTIVO';
$axnom_producto = $axnuevo_servicios;
$axpresentacion = 'Glb';
$axpeso_producto = 0;
$txtcosto_producto_sin = 0;
$txtigvcosto =0;
$axcosto_producto = 0;
$txtprecio_sin = 0;
$txtigv_prc_venta = 0;
$txtprecio_venta = 0;
$axid_afectacion = 1;
$txtstock_minimo = 0;
$axprs_minimo = 0;

$Insertar = "INSERT INTO PRODUCTOS (ID_CATEGORIA,COD_PRODUCTO,ESTADO_PRODUCTO,NOM_PRODUCTO,PRESENTACION,PESO_PRODUCTO,COSTO_PRODUCTO_SIN,IGV_COSTO,COSTO_PRODUCTO,PRECIO_VENTA_SIN,IGV_PRC_VENTA,PRECIO_VENTA,ID_AFECTACION,STOCK_MINIMO,PRS_MINIMO) VALUES ('$axid_categoria','$axcod_producto','$axestado','$axnom_producto','$axpresentacion','$axpeso_producto','$txtcosto_producto_sin','$txtigvcosto','$axcosto_producto','$txtprecio_sin','$txtigv_prc_venta','$txtprecio_venta','$axid_afectacion','$txtstock_minimo','$axprs_minimo')";
$result6=odbc_exec($con,$Insertar); 

if($result6){

	$sql6 = "SELECT * FROM PRODUCTOS_LISTADO WHERE NOM_PRODUCTO = '$axnom_producto'";
	
		$result1=odbc_exec($con,$sql6);
		if(odbc_num_rows($result1) > 0) {
	    
	      $axlistaprov1 = odbc_fetch_object($result1);
	      $axlistaprov1 ->status =200;
	      echo json_encode($axlistaprov1);
	      
	  	} else {

	  		$error = array('status'=> 400);
	  		echo json_encode((object) $error);
	  	}
	

}else{
		
	$respuesta = '1';
	echo"$respuesta"; // no grabado

}

break;

case '179':
	
$axnum_programacion = $_POST['txtnum_programacion']; 	
$axid_local = $_POST['txtid_local']; 	

$SQLBuscar = "SELECT  * FROM REPORTE_RENDICIONES WHERE ID_LOCAL = '$axid_local' AND NUM_PROGRAMACION='$axnum_programacion' order by FECHA_EMISION ASC";

echo "
	<table class='table table-hover table-sm'>
	<thead class='table-primary'>			
	<tr>
		<th style='text-align: center;'>Item</th>
		<th style='text-align: left;'>Categoria</th>
		<th style='text-align: center; '>Fecha</th>
		<th style='text-align: center; '>Documento</th>
		<th style='text-align: left;'>Proveedor</th>
		<th style='text-align: left;'>Glosa</th>
		<th style='text-align: right;'>Monto</th>											
	</tr>
	</thead>";

	$rsbuscar = odbc_exec($con,$SQLBuscar);
	if(odbc_num_rows($rsbuscar) > 0){

		while ($fila = odbc_fetch_array($rsbuscar)) {
			
			$it=$it+1;
			$axcategoria =$fila['CATEGORIA'];
			$axfecha = $fila['FECHA_EMISION'];
			$axdocumento = $fila['DOCUMENTO'];
			$axproveedor =$fila['PROVEEDOR'];
			$axgasto =$fila['GASTO'];
			$axtotal = number_format($fila["TOTAL_INGRESO"],2,".",",");  
			$axnum_programacion = $fila['NUM_PROGRAMACION'];

			echo"<tr>";
			
				echo "
					<td style='text-align: center;'>$it</td>
					<td style='text-align: left;'>$axcategoria</td>
					<td style='text-align: center;'>$axfecha</td>
					<td style='text-align: center;'>$axdocumento</td>
					<td style='text-align: left;'>$axproveedor</td>
					<td style='text-align: left;'>$axgasto</td>
					<td style='text-align: right;'>$axtotal</td>
				</tr>";
		}

		$sqltotal = "SELECT SUM(TOTAL_INGRESO) AS TT FROM REPORTE_RENDICIONES WHERE ID_LOCAL = '$axid_local' AND NUM_PROGRAMACION='$axnum_programacion'";
		$rstotal = odbc_exec($con,$sqltotal);
		$fila_t = odbc_fetch_array($rstotal);
		$axtotal_g = number_format($fila_t["TT"],2,".",",");


		echo"<tr style='font-size:14px;'>
			<th style='text-align: right;' colspan='6'><b>Total Rendición</b></th>
			<th style='text-align: right;'><b>$axtotal_g</b></th>
			</tr>";



		echo "</table>";

	}


break;

case '180':

	$axbuscar_dato =$_POST['txtnum_programacion'];
    $axid_local =$_POST['txtid_local'];
   	
 if(isset($_POST["txtnum_programacion"])){

	$output ='';
	$idprov ='';
	$sqlemisor = "SELECT  TOP 5 NUM_PROGRAMACION FROM MAESTRO_CZ WHERE ID_LOCAL ='$axid_local' and NUM_PROGRAMACION LIKE  '%".$axbuscar_dato."%' GROUP BY NUM_PROGRAMACION ORDER BY NUM_PROGRAMACION";
	//echo $sqlemisor;
	$rsemisor=odbc_exec($con,$sqlemisor);
	$output ='<ul class="list-group">';
  	
	if(odbc_num_rows($rsemisor) > 0){
		 while ($row=odbc_fetch_array($rsemisor)){				 	
		 	$nom_programacion =  trim($row["NUM_PROGRAMACION"]);

		 	$output .='<a href="#" id="btn_listar_programaciones" class="list-group-item list-group-item-action" style="background:#DAF5FF;" data-id='.$nom_programacion.'>'.$nom_programacion.'</a>';
		 }

	}else{
		
		$output .='<a href="#" class="list-group-item list-group-item-action bg-danger"></a>';
	
	}

	$output .='</ul>';
	echo $output;

}else{
	echo $output;	
}


break;

case '181':
	
	$axnum_programacion= $_POST['txtnum_programacion'];
	$axid_local= $_POST['txtid_local'];
	
	$sql6 = "SELECT * FROM MAESTRO_CZ_EGRESOS_TRAER WHERE ID_LOCAL = '$axid_local' AND NUM_PROGRAMACION='$axnum_programacion'";
	
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

case '182':
	
	$axid_local= $_POST['txtid_local'];
	$axcod_mov= $_POST['txtcod_mov'];

	$SQLBuscar = "SELECT COSTO_PRODUCTO,DSCTOS_INGRESO,VALOR_INGRESO,IGV_INGRESO,GRAVADAS_INGRESO,INAFECTO_INGRESOS,EXONERADO_INGRESO,TOTAL_INGRESO FROM MAESTRO_DT WHERE COD_MOV='$axcod_mov'";
	$RSBuscar = odbc_exec($con,$SQLBuscar);

	if(odbc_num_rows($RSBuscar) > 0){

		while ($fila = odbc_fetch_array($RSBuscar)) {
			
			$axcosto_producto =  $fila['COSTO_PRODUCTO']/-1;
			$axvalor_ingreso = $fila['VALOR_INGRESO']/-1;
			$axigv_ingreso = $fila['IGV_INGRESO']/-1;
			$axgravadas_ingreso = $fila['GRAVADAS_INGRESO']/-1;
			$axinafecto_ingresos = $fila['INAFECTO_INGRESOS']/-1;
			$axexonerado_ingreso = $fila['EXONERADO_INGRESO']/-1;
			$axtotal_ingreso = $fila['TOTAL_INGRESO']/-1;

			$SQLActualizar = "UPDATE MAESTRO_DT SET  COSTO_PRODUCTO='$axcosto_producto',VALOR_INGRESO='$axvalor_ingreso',IGV_INGRESO='$axigv_ingreso',GRAVADAS_INGRESO='$axgravadas_ingreso',INAFECTO_INGRESOS='$axinafecto_ingresos',EXONERADO_INGRESO='$axexonerado_ingreso',TOTAL_INGRESO='$axtotal_ingreso' WHERE COD_MOV='$axcod_mov'";
			$RSActualizar = odbc_exec($con,$SQLActualizar);

			if ($RSActualizar) {

				$SQLBuscar_cz = "SELECT VALOR_VENTA,IGV,GRAVADAS,INAFECTAS,EXONERADAS,TOTAL_VENTA FROM MAESTRO_CZ WHERE COD_MOV='$axcod_mov'";
				$RSBuscar_cz = odbc_exec($con,$SQLBuscar_cz);
				$fila_cz = odbc_fetch_array($RSBuscar_cz);

				$axvalor_venta = $fila_cz['VALOR_VENTA']/-1;
				$axigv_venta = $fila_cz['IGV']/-1;
				$axgravada = $fila_cz['GRAVADAS']/-1;
				$axinafecta = $fila_cz['INAFECTAS']/-1;
				$axexonerada = $fila_cz['EXONERADAS']/-1;
				$axtotal_venta = $fila_cz['TOTAL_VENTA']/-1;

				$SQLActualizar_cz = "UPDATE MAESTRO_CZ SET VALOR_VENTA='$axvalor_venta',IGV='$axigv_venta',GRAVADAS='$axgravada',INAFECTAS='$axinafecta',EXONERADAS='$axexonerada',TOTAL_VENTA='$axtotal_venta' WHERE COD_MOV='$axcod_mov'";
				$RSActualizar_cz = odbc_exec($con,$SQLActualizar_cz);



			}else{

			}

		}

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



