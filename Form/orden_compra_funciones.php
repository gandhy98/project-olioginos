<?php  
require('../Imprimir/pdf_js.php');
require_once '../core2.php';

//echo 'Current PHP version: ' . phpversion();


$param=$_POST['param'];


switch ($param) {

/*
###########################
## MODIFICANDO GANDHY INICIO
+
+
###########################
**/


case '1':
    
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


case '2':
	
    date_default_timezone_set("America/Lima");

	$axid_orden_cz = $_POST['txtid_orden_cz'];
	$axtnum_orden = $_POST['txtnum_orden'];
	$axtfecha_orden = $_POST['txtfecha_orden'];
    $axano = date('Y',strtotime($axtfecha_orden));
    $axperido= date('m-Y',strtotime($axtfecha_orden));
	$txtnum_transferencia = $_POST['txtnum_transferencia'];
	$axtfecha_transferencia = $_POST['txtfecha_transferencia'];
	$axtmoneda = $_POST['txtmoneda'];
    $axidlocal = $_POST['txtidlocal'];
	$axtid_beneficiario = $_POST['txtid_beneficiario'];
	$axtestado_orden_compra = $_POST['txtestado_orden_compra'];
	$axtestado_forma_pago = $_POST['txtestado_forma_pago'];
	$axtid_cta = $_POST['txtid_cta'];
	$axtmedio_pago = $_POST['txtmedio_pago'];
    $axid_usuario = $_POST['txtid_usuario'];
	$axparametros = $_POST['txtparametros'];

    

	if($axparametros==0){

        // var_dump($_POST);
        // die();

		$SQLInsert = "INSERT INTO ORDEN_COMPRA_CZ (
         
            NUM_ORDEN_COMPRA
            ,FECHA_ORDEN
            ,ID_BENEFICIARIO
            ,ESTADO_ORDEN_COMPRA
            ,ID_USUARIO
            ,MONEDA            
            ,TIPO_ORDEN_COMPRA
            ,ANO_PROFORMA
            ,MEDIO_PAGO
            ,ID_CTA
            ,PERIODO_ORDEN,ID_LOCAL) VALUES (           
            '$axtnum_orden','$axtfecha_orden','$axtid_beneficiario', '$axtestado_orden_compra','$axid_usuario','$axtmoneda','ORDEN COMPRA','$axano',
            '$axtmedio_pago','$axtid_cta','$axperido','$axidlocal')";

	}else{

		$SQLInsert = "UPDATE ORDEN_COMPRA_CZ SET 

            NUM_ORDEN_COMPRA='$axtnum_orden',FECHA_ORDEN='$axtfecha_orden',ID_BENEFICIARIO='$axtid_beneficiario',ESTADO_ORDEN_COMPRA='$axtestado_orden_compra',ID_USUARIO='$axid_usuario',MONEDA='$axtmoneda',ANO_PROFORMA='$axano',MEDIO_PAGO='$axtmedio_pago',ID_CTA='$axtid_cta',PERIODO_ORDEN='$axperido',ID_LOCAL='$axidlocal'
                
        WHERE ID_ORDEN_COMPRA_CZ='$axid_orden_cz'";
	}
    //echo $SQLInsert;
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

    $axbuscaregistro = $_POST['txtbuscaregistro'];
    $axid_local = $_POST['txtidlocal'];

	if($axbuscaregistro==""){
		$SQLBuscar = "SELECT TOP 400 * FROM ORDEN_COMPRA_REPORTE_CZ WHERE ID_LOCAL = '$axid_local' order by FECHA_ORDEN DESC";
	}else{
		$SQLBuscar ="SELECT TOP 400 *  FROM ORDEN_COMPRA_REPORTE_CZ WHERE ID_LOCAL = '$axid_local' AND NUM_ORDEN_COMPRA+NOM_COMERCIAL like '%".$axbuscaregistro."%' ";
	}
	
//echo "$SQLBuscar";

echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th class='ocultar' style='text-align: center;'>Item</th>
			<th class='ocultar' style='text-align: center;'>Fecha</th>
			<th class='ocultar' style='text-align: center;'>#Orden</th>
			<th class='ocultar' style='text-align: left;'>Proveedor</th>
			<th class='ocultar' style='text-align: center;'>Moneda</th>
            <th class='ocultar' style='text-align: right;'>Monto</th>
			<th class='ocultar' style='text-align: center;'>Estado</th>			
			<th style='text-align: center;'>Acción</th>
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ( odbc_num_rows($RSBuscar) > 0 ){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 

 		$it= $it+1;
        $axid_orden_cz = $fila['ID_ORDEN_COMPRA_CZ'];
        $axfecha_emision = date('d-m-Y',strtotime($fila['FECHA_ORDEN']));
 		$axnum_orden = $fila['NUM_ORDEN_COMPRA'];
		$axproveedor = $fila['NOM_COMERCIAL'];
		$axmoneda = $fila['MONEDA'];
		$axmonto = number_format($fila["MONTO_ORDEN"],2,".",","); 
		$axestado = $fila['ESTADO_ORDEN_COMPRA'];
        echo "
 		<tr> 		
 			<td style='text-align: center;'>".$it."</td> 
 			<td style='text-align: center;'>".$axfecha_emision."</td> 
 			<td style='text-align: center;'>".$axnum_orden."</td>  			
 			<td style='text-align: left;'>".$axproveedor."</td> 
            <td style='text-align: center;'>".$axmoneda."</td>              
 			<td style='text-align: right;'>".$axmonto."</td> 
             <td style='text-align: center;'>".$axestado."</td>
 			
             <td style='text-align: center;'>

 				<div class='btn-group dropstart'>
					<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
					<ul class='dropdown-menu'>	
					<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-info' id='btn_editar_orden_cz' data-bs-toggle='modal' data-bs-target='#mdl_registrar_orden_compra' data-estado='$axestado' data-id='$axid_orden_cz'><b><i class='bi bi-pencil' ></i> Editar</b></a>
					<a href='#' class='dropdown-item text-danger' id='btn_eliminar_orden_cz' data-estado='$axestado' data-id='$axid_orden_cz'><b><i class='bi bi-trash3-fill'></i> Eliminar</b></a>					
					<div><hr class='dropdown-divider'></div>

                    <a href='#' class='dropdown-item text-danger' id='btn_detalle_orden_cz' data-estado='$axestado' data-id='$axid_orden_cz'><b><i class='bi bi-trash3-fill'></i> Detalle</b></a>	


					</ul>
				</div>
 			</td>


 		</tr>";

}
echo "</table>";
}



break;

case '4':
   
	
        $axtid_orden_cz= $_POST['txtid_orden_cz'];
            
        $sql6 = "SELECT * FROM ORDEN_COMPRA_CZ WHERE  ID_ORDEN_COMPRA_CZ='$axtid_orden_cz'";
        
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
case '5':


    $axbuscar_dato =$_POST['txtnom_producto'];
   $axdetalle_movimiento =$_POST['txtdetalle_movimiento'];
   	$axtipo_categoria='MATERIA PRIMA';

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

    case'6':

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

        case '7':

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


$sqlinserta = "INSERT INTO ORDEN_COMPRA_DT
           (
           ID_ORDEN_COMPRA_CZ
           ,ID_PRODUCTO
           ,CANT_COMPRA
           ,PRECIO_COMPRA
           ,DSCTOS_SALIDA
           ,VALOR_SALIDA
           ,IGV_SALIDA
           ,GRAVADAS_SALIDA
           ,INAFECTO_SALIDA
           ,EXONERADO_SALIDA
           ,TOTAL_SALIDA)
     VALUES
           (
           null,
           '$axid_producto',
           '$axcant_ingreso',
           '$axcosto_producto',
           null,
           '$axvalor_ingreso',
           '$axigv_ingreso',
           null,
           null,
           null,
           '$axtotal_ingreso')";

$rsinserta = odbc_exec($con,$sqlinserta);

$respuesta =0;
		echo $respuesta;
// var_dump($rsinserta);
// die();

        break;

/*
###########################
## MODIFICANDO GANDHY FIN
###########################
**/



}

function generateRandomCode($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomCode = '';
    
    for ($i = 0; $i < $length; $i++) {
        $randomCode .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomCode;
}

function number_pad($number,$n) {
return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}

function get_row($table,$col, $id, $equal){
	global $con;
	$querysql="select top 1 $col from $table where $id='$equal' order by $col desc";
	$query=odbc_exec($con,$querysql);
	$rw=odbc_fetch_array($query);
	$value=$rw[$col];
	return $value;
}

function redondeado ($numero, $decimales) { 
   $factor = pow(10, $decimales); 
   return (round($numero*$factor)/$factor); 
}



?>


