<?php  
require('../Imprimir/pdf_js.php');
require_once '../core2.php';

//echo 'Current PHP version: ' . phpversion();


$param=$_POST['param'];


switch ($param) {

case '0': // listar usuarios

	$axidlocal = $_POST['txtidlocal']; 
	$axbuscar = $_POST['txtbuscar']; 
	$axiduser = $_POST['txtid_usuario']; 
	$axfecharegistro = $_POST['txtfecharegistro']; 	
	$axfiltro_busca_fecha = $_POST['txtfiltro_busca_fecha']; 	
	$axtipo_ORDEN_COMPRA = $_POST['txttipo_ORDEN_COMPRA']; 	


	if($axbuscar==""){
		//echo '<script>console.log("'.$axfiltro_busca_fecha.'")</script>';
		if($axfiltro_busca_fecha=='FECHA'){

			$sql6 ="SELECT TOP 15 * FROM ORDEN_COMPRA_REPORTE_CZ WHERE ID_LOCAL='$axidlocal' AND FECHA_ORDEN_COMPRA ='$axfecharegistro' AND TIPO_ORDEN_COMPRA='$axtipo_ORDEN_COMPRA' ORDER BY FECHA_ORDEN_COMPRA DESC";		
		}else{
			$sql6 ="SELECT  TOP 15 * FROM ORDEN_COMPRA_REPORTE_CZ WHERE ID_LOCAL='$axidlocal'  AND TIPO_ORDEN_COMPRA='$axtipo_ORDEN_COMPRA' ORDER BY FECHA_ORDEN_COMPRA DESC";		
		}
	
	}else{

		$sql6 ="SELECT TOP 15 * FROM ORDEN_COMPRA_REPORTE_CZ WHERE TIPO_ORDEN_COMPRA='$axtipo_ORDEN_COMPRA' AND ID_LOCAL='$axidlocal' AND RAZON_SOCIAL+NUM_ORDEN_COMPRA LIKE  '%".$axbuscar."%' ORDER BY FECHA_ORDEN_COMPRA DESC";	

	}
	
	//echo $sql6;
	echo '<script>console.log("'.$sql6.'")</script>';
	echo "
	<table class='table table-sm table-striped table-hover table-bordered table-sm'>
		<thead class='table-danger'>			
		<tr>
			<th scope='col' style='text-align: center; width:5px;'>Item</th>
			<th scope='col' style='text-align: left; width:10px;'>Elaborado por</th>
			<th scope='col' style='text-align: center; '>Fecha</th>			
			<th scope='col' style='text-align: left;'>Cliente</th>
			<th scope='col' style='text-align: left;'>Teléfono</th>
			<th scope='col' style='text-align: left;'>Estado</th>
			<th scope='col' style='text-align: center;'></th>
			<th scope='col' style='text-align: right;' >V.Venta</th>			
			<th scope='col' style='text-align: right;' >IGV</th>
			<th scope='col' style='text-align: right;' >Monto</th>
			<th scope='col' style='text-align: center;'></th>
		</tr>
		</thead>";
	
	$result6=odbc_exec($con,$sql6);
	
	if ($result6){
 	while ($row=odbc_fetch_array($result6)){ 
 		
 		$it = $it+1;
 		$axnum_proforma_1 =$row['NUM_ORDEN_COMPRA'];
 		
 		$axtipo_ORDEN_COMPRA=$row["TIPO_ORDEN_COMPRA"]; 
 	
 		$id = $row["COD_MOV_PRF"];
 		$axestadoelectro=$row["ESTADO_ATENDIDO"]; 
 		$axelaboradopor =$row["USUARIO"];
		$id_producto=$row["ID_ORDEN_COMPRA_CZ"];

 		//echo $axestadoelectro;
 		
 		if($row["MONEDA"]=="SOLES"){
 			$axmoneda='S/';
 		}else{
 			$axmoneda='$';
 		}
 		
		 $axmoneda='S/';

 	echo "
 		<tr>
 			<td style='text-align: center; width:5px;'>".$it."</td>  	
 			<td style='text-align: left; width:10px;'>".$axelaboradopor."</td>  			
 			<td style='text-align: center; '>".date("d-m-Y",strtotime($row["FECHA_ORDEN_COMPRA"]))."</td>  				
 	 		<td style='text-align: left;'>".$axnum_proforma_1.' | '.$row["RAZON_SOCIAL"]."</td>
			<td style='text-align: left;'>".$row["TELEFONO"]."</td>
			<td style='text-align: left;'>".$row["ESTADO_ORDEN_COMPRA"]."</td>
 	 		<td style='text-align: center;'><b>".$axmoneda."</b></td> 		
 	 		<td style='text-align: right;' >".number_format($row["TOTAL"]/1.18,2,".",",")."</td>
 	 		<td style='text-align: right;' >".number_format($row["TOTAL"]/1.18*0.18,2,".",",")."</td>
 	 		<td style='text-align: right;' >".number_format($row["TOTAL"],2,".",",")."</td>
			<td style='text-align: center; '>			
				
				<div class='btn-group dropstart'>
				<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
				<ul class='dropdown-menu'>	
				<div><hr class='dropdown-divider'></div>				  	
				<a href='#' class='dropdown-item text-info' id='btn_editar_producto' data-id='$id_producto' data-bs-toggle='modal' data-bs-target='#exampleModal'><b><i class='bi bi-pencil' ></i> Editar</a></b>
				<a href='#' class='dropdown-item text-danger' id='btn_eliminar_producto' data-id='$id_producto' ><b><i class='bi bi-trash3-fill'></i> Eliminar</a></b>
				<a href='#' onclick='imprimir_ORDEN_COMPRA($id_producto)' class='dropdown-item text-success' id='btn_imprimir_producto' data-id='$id_producto' data-bs-toggle='modal' data-bs-target='#exampleModal'><b><i class='bi bi-printer' ></i> Imprimir</a></b>
				<div><hr class='dropdown-divider'></div>				  	
				<a href='#' class='dropdown-item text-dark' id='btn_atender_producto' data-id='$id_producto' data-bs-toggle='modal' data-bs-target='#exampleModal'><b><i class='bi bi-shop' ></i> Atender</a></b>
				<div><hr class='dropdown-divider'></div>
				</ul>
				</div>

 			</td>

 		</tr>
 	";

}
echo "</table>

";
}

	
break;

case '1':
	
	$axiduser = $_POST['txtid_usuario']; 	
	$axpermiso = $_POST['axpermiso']; 	
		

	//$sql6 = "SELECT * FROM MENU_ASIGNADO WHERE ID_USUARIO = '$axiduser' and NOM_MENU='TOTAL'";
	$sql6 = "SELECT * FROM MENU_ASIGNADO WHERE ID_USUARIO = 1";
	$rspermisos=odbc_exec($con,$sql6);

	//echo $sql6;

	if(odbc_num_rows($rspermisos) == 1){

		$respuesta = 0;
		echo"$respuesta"; // Si existe

	} else {

		$sql7 = "SELECT * FROM MENU_ASIGNADO WHERE ID_USUARIO = '$axiduser' and NOM_MENU='$axpermiso'";
		$rspermisos7=odbc_exec($con,$sql7);

		if(odbc_num_rows($rspermisos7) == 1){

			$respuesta = 0;
			echo"$respuesta"; // No existe existe

		} else{

			$respuesta = 1;
			echo"$respuesta"; // No existe existe
		}

	}


break;

case '2':
	
	$axidempresa = $_POST['txtidempresa']; 
	$axbuscar = $_POST['txtbuscararticulo']; 
	$axidlocal = $_POST['txtidlocal']; 
	$axtipo_ORDEN_COMPRA = $_POST['txttipo_ORDEN_COMPRA']; 

	if($axtipo_ORDEN_COMPRA=='CLIENTE'){ 

		if($axbuscar==""){		
			$sql6 ="SELECT TOP 5 ID_PRODUCTO,COD_PRODUCTO,NOM_PRODUCTO,PRESENTACION,STOCK,PRECIO_VENTA,PRECIO_COMPRA,TIPO_CATEGORIA 
				FROM PRODUCTOS_LISTADO 
				WHERE TIPO_CATEGORIA='PRODUCTO TERMINADO' ORDER BY NOM_PRODUCTO";
		}else{
			$sql6 ="SELECT TOP 20 ID_PRODUCTO,COD_PRODUCTO,NOM_PRODUCTO,PRESENTACION,STOCK,PRECIO_VENTA,PRECIO_COMPRA,TIPO_CATEGORIA 
				FROM PRODUCTOS_LISTADO 
				WHERE TIPO_CATEGORIA='PRODUCTO TERMINADO' AND NOM_PRODUCTO+COD_PRODUCTO LIKE  '%".$axbuscar."%'";		
		}


	}else{ 

		if($axbuscar==""){		
			$sql6 ="SELECT TOP 5 ID_PRODUCTO,COD_PRODUCTO,NOM_PRODUCTO,PRESENTACION,STOCK,PRECIO_VENTA,PRECIO_COMPRA,TIPO_CATEGORIA 
				FROM PRODUCTOS_LISTADO 
				WHERE TIPO_CATEGORIA='MATERIA PRIMA' ORDER BY NOM_PRODUCTO";
		}else{
			$sql6 ="SELECT TOP 20 ID_PRODUCTO,COD_PRODUCTO,NOM_PRODUCTO,PRESENTACION,STOCK,PRECIO_VENTA,PRECIO_COMPRA,TIPO_CATEGORIA 
				FROM PRODUCTOS_LISTADO 
				WHERE TIPO_CATEGORIA='MATERIA PRIMA' AND NOM_PRODUCTO+COD_PRODUCTO LIKE  '%".$axbuscar."%'";		
		}


	}



	
	
	
	//echo $sql6;

	echo "
	
		<table class='table table-sm table-striped table-hover table-bordered table-sm'>
		<thead class='table-danger'>			
		<tr>
			
			<th scope='col' style='text-align: left;'>Nom. Comercial</th>
			<th scope='col' style='text-align: center;'>Unidad</th>						
			<th scope='col' style='text-align: right;'>Prs. Venta</th>
			<th scope='col' style='text-align: right;'>Prs. Compra</th>
			<th scope='col' style='text-align: right;'>Stock</th>
			
			
		</tr>
		</thead>";
	
	$result6=odbc_exec($con,$sql6);
	
	if ($result6){
 	
 	while ($row=odbc_fetch_array($result6)){ 
 		
 		$id = $row["ID_PRODUCTO"];
 		$prs_venta=$row["PRECIO_VENTA"];
 		$prs_compra=$row["PRECIO_COMPRA"];
 		$stock=$row["STOCK"];
 		$unidad=$row["PRESENTACION"];
 		$axnombre =$row["NOM_PRODUCTO"];
 	
 		echo "
 		<tr>
 			
 			<td style='text-align: left;'>".$axnombre."</td> 
 			<td style='text-align: center;'>".$unidad."</td> 
 			<td style='text-align: right;' >".number_format($prs_venta,2,".",",")."
 				<a href='#'><img src='../icon/agregar4.png'id='btagregarproforma' data-idlocal='$axidlocal' data-precio='$prs_venta' data-idinsumo='$id'></a>
 			</td>

 			<td style='text-align: right;' >".number_format($prs_compra,2,".",",")."
 				<a href='#'><img src='../icon/agregar4.png'id='btagregarproforma' data-idlocal='$axidlocal' data-precio='$prs_compra' data-idinsumo='$id'></a>
 			</td> 			
 			<td style='text-align: right;' >".number_format($stock,2,".",",")."</td> 			
 			
 		</tr>
 		";
 		

  
	

}
echo "</table>
";
}

break;


case '3':

$axidlocal = $_POST['txtidlocal']; 

$SQLTipodocumentos = "SELECT DISTINCT(ID_DT),DETALLE_DOC FROM TIPO_DOC_ASIGNADO WHERE FILTRO_LIBROS='COTIZAR' ORDER BY DETALLE_DOC" ;
echo $SQLTipodocumentos;	      

$RSTipodocumentos=odbc_exec($con,$SQLTipodocumentos);
if(odbc_num_rows($RSTipodocumentos) > 0){
	
	while($fila=odbc_fetch_array($RSTipodocumentos)){
	   	echo '<option value='.$fila['ID_DT'].'>'.$fila['DETALLE_DOC'].'</option>';
    }
		
} else {

	echo "NO HAY TIPO DE DOCUMENTOS";	
	//<script>console.log("entra aqui")</script>
}

break;

case '4':

	$axidlocal = $_POST['txtidlocal']; 
	$axtipodoc = $_POST['txttipodoc']; 
	
	
	$SQLTipodocumentos = "SELECT * FROM CORRELATIVOS WHERE ID_LOCAL ='$axidlocal' AND ID_DT='$axtipodoc' ORDER BY COD_CORR" ;	

	
//	echo "$SQLTipodocumentos";	      

	$RSTipodocumentos=odbc_exec($con,$SQLTipodocumentos);
	if(odbc_num_rows($RSTipodocumentos) > 0){
		while($fila=odbc_fetch_array($RSTipodocumentos)){
		   	echo '<option value='.$fila['N_SERIE'].'>'.$fila['N_SERIE'].'</option>';
	    }
			
	} else {

		echo "";	
	}
break;

case '5':
	
	$axidlocal = $_POST['txtidlocal']; 
	$axnserie = $_POST['txtnserie']; 

	$SQLTipodocumentos = "SELECT * FROM CORRELATIVOS WHERE ID_LOCAL ='$axidlocal' AND N_SERIE='$axnserie' ORDER BY COD_CORR" ;
	$result1=odbc_exec($con,$SQLTipodocumentos);

	if(odbc_num_rows($result1) > 0) {
    
      $axlistaprov1 = odbc_fetch_object($result1);
      $axlistaprov1 ->status =200;
      echo json_encode($axlistaprov1);
      
  } else {

  		$error = array('status'=> 400);
  		echo json_encode((object) $error);
  }	


break;

case '6':
	

	$axidlocal = $_POST['txtidlocal']; 
	$axmoneda = $_POST['txtmoneda']; 

	$SQLTipodocumentos = "SELECT * FROM CUENTA_BANCARIAS WHERE ID_LOCAL ='$axidlocal' AND MONEDA_CTA='$axmoneda' ORDER BY ID_CTA" ;
	//echo "$SQLTipodocumentos";	      

	$RSTipodocumentos=odbc_exec($con,$SQLTipodocumentos);
	if(odbc_num_rows($RSTipodocumentos) > 0){
		echo '<option value="Seleccionar">Seleccionar</option>';
		while($fila=odbc_fetch_array($RSTipodocumentos)){
		   	echo '<option value='.$fila['ID_CTA'].'>'.$fila['NUM_CUENTA'].'</option>';
	    }
			
	} else {

		echo "";	
	}


break;

case '7':
	
	$axbuscarcliente = $_POST["txtnom_cliente"];
	$axtipo_ORDEN_COMPRA = $_POST["txttipo_ORDEN_COMPRA"];
		
	if(isset($_POST["txtnom_cliente"])){

	$output ='';
	$idprov ='';

	if($axtipo_ORDEN_COMPRA=='CLIENTE'){
		$sql9 = "SELECT TOP 5 * FROM BENEFICIARIOS WHERE RAZON_SOCIAL+RUC_BENEF LIKE  '%".$axbuscarcliente."%' AND TIPO_PROV_CLIE='CLIENTE'";	
	}else{
		$sql9 = "SELECT TOP 5 * FROM BENEFICIARIOS WHERE RAZON_SOCIAL+RUC_BENEF LIKE  '%".$axbuscarcliente."%' AND TIPO_PROV_CLIE='PROVEEDOR'";
	}
	//echo "$sql9";

	$result1=odbc_exec($con,$sql9);
	$output ='<ul id="ulproductos" class="list-unstyled ul">';

	if(odbc_num_rows($result1) > 0){
		 while ($row=odbc_fetch_array($result1)){

		 	$output .='<li id="libeneficiarios" class="li" data-nombenef='.$row["RAZON_SOCIAL"].' data-idbenef='.$row["ID_BENEFICIARIO"].'>'.$row["RAZON_SOCIAL"].'</li>';

		 }

	}else{
//		$output .='';
		
		$output .='<li id="linuevoregistro" class="li" data-toggle="modal" data-target=".bd-example-modal-xl">"Registro no se encuentra en la base datos"</li>';

		
		
	}

	$output .='</ul>';
	echo $output;


}

break;

case '8':

	$axidcliente= $_POST['txtidcliente'];
	
	$sql6 = "SELECT * FROM BENEFICIARIOS WHERE ID_BENEFICIARIO = '$axidcliente'";
	
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

case '9':
	$axidinsumo= $_POST['txtidinsumo'];
	$axidlocal= $_POST['txtidlocal'];
	
	$sql6 = "SELECT * FROM PRODUCTOS WHERE ID_PRODUCTO=$axidinsumo";

	//echo $sql6;
	
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


case '10':

	$axcodproformacz = trim($_POST['txtcodmovprof']);
	$axidinsumo = $_POST['txtidinsumo'];
	$axcantidad = $_POST['txtcant_venta'];
	$axprecio_venta = $_POST['txtprecio_venta'];
	$axprecio_compra = $_POST['txtprecio_compra'];
	$axdscto = $_POST['txtdscto_Venta'];
	$axvalor_venta = $_POST['txtvalor_venta'];
	$axigv_venta = $_POST['txtigv_venta'];
	$axgravada = $_POST['txtgravadas_venta'];
	$axinafecta =$_POST['txtinafectas_venta'];
	$axexonerada = $_POST['txtexonerada_venta'];
	$axtotalventa = $_POST['txttotal_venta'];
	$axobservacion = $_POST['txtobservacion'];

	$axiduser = $_POST['txtid_usuario'];
	$axfechaactual = $_POST['txtfecharegistro'];
	$axidlocal = $_POST['txtidlocal'];
	$axhoraemision = $_POST['txthoraemision'];
	$axtipo_ORDEN_COMPRA = $_POST['txttipo_ORDEN_COMPRA'];

	$axid_ORDEN_COMPRA_cz = get_row('ORDEN_COMPRA_CZ','ID_ORDEN_COMPRA_CZ','COD_MOV_PRF',$axcodproformacz);
	
	
	$SQLInsertar = "INSERT INTO ORDEN_COMPRA_DT (ID_ORDEN_COMPRA_CZ,COD_MOV_PRF,ID_PRODUCTO,CANT_SALIDA,PRECIO_V,PRECIO_C,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA) VALUES ('$axid_ORDEN_COMPRA_cz','$axcodproformacz','$axidinsumo','$axcantidad','$axprecio_venta','$axprecio_compra','$axdscto','$axvalor_venta','$axigv_venta','$axgravada','$axinafecta','$axexonerada','$axtotalventa')";

	//ID_ORDEN_COMPRA_CZ,COD_MOV_PRF,ID_PRODUCTO,CANT_SALIDA,PRECIO_V,PRECIO_C,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,

  //echo $SQLInsertar;

	$RSInsertar=odbc_exec($con,$SQLInsertar); 

	if($RSInsertar){

	$sql6 = "SELECT * FROM LISTA_ORDEN_COMPRA_DT WHERE COD_MOV_PRF = '".$axcodproformacz."' ORDER BY NOM_PRODUCTO";
	//echo $sql6;
	echo "
	<table class='table table-sm table-hover'>";

 		$result6=odbc_exec($con,$sql6);

		if ($result6){
		
		while ($row=odbc_fetch_array($result6)){ 

		$codmovpf = $row['COD_MOV_PRF'];
		$idins = $row['ID_PRODUCTO'];

		if($row['CODIGO_PROD']==''){
			$axnomcomercial = $row["NOM_PRODUCTO"];
		}else{
			$axnomcomercial = $row["ID_INSUMO"].' | '.$row["NOM_PRODUCTO"];
		}

		//if($axobser==""){

			

		//}else{

		//	$axnomcomercial = $row["NOM_PRODUCTO"].' - '.$axobser;
		//}


	 	echo "
 		<tr >
		
 			<td style='text-align: center;'>".number_format($row["CANT_SALIDA"],2,".",",")."</td>
			<td style='text-align: left;'>".$axnomcomercial."</td> 
			<td style='text-align: center;'>".$row["PRESENTACION"]."</td> 			
			<!--td contenteditable class='text-danger' style='text-align: right;' id='axcant_modificar' data-id='$codmovpf' data-idinsumo='$idins'>".number_format($row["PRECIO_V"],2,".",",")."</td-->
			<td class='text-danger' style='text-align: right;' id='axcant_modificar' data-id='$codmovpf' data-idinsumo='$idins'>".number_format($row["PRECIO_V"],2,".",",")."</td>
			<td style='text-align: right;'>".number_format($row["TOTAL_SALIDA"],2,".",",")."</td>
 			
 			<td style='text-align: center;''>
 				<a href='#'><img src='../icon/remover4.png' id='btquitaritemproforma' data-idinsumo='$idins' data-codmov='$codmovpf'></a>
			</td>

 			
 		</tr>";
		
		}

		$SQLTotal = "SELECT SUM(TOTAL_SALIDA) AS TT FROM LISTA_ORDEN_COMPRA_DT WHERE COD_MOV_PRF = '".$axcodproformacz."'";
		$RSTTotal=odbc_exec($con,$SQLTotal);
		while ($fila=odbc_fetch_array($RSTTotal)){
			$total = number_format($fila['TT'],2,".",",");
		}


		echo "
		<tr class='table-active'>
			<th scope='col' style='text-align: right;' colspan='4'><h5>Total Venta</h5></th>
			<th scope='col' style='text-align: right;' id='tbtotalprof'><h5>".$total."</h5></th>
		</tr>";

		echo "</table>";
		}

		//$respuesta = 0;
		//echo"$respuesta"; // grabado

	}else{

		$respuesta = 1;
		echo"$respuesta"; // no grabado

	}

break;




case '11':
	
	$axcodmov = $_POST['axcodmov'];
	$axidinsumo = $_POST['axidinsumo'];

	$sqleliminar = "DELETE FROM ORDEN_COMPRA_DT WHERE COD_MOV_PRF ='$axcodmov' AND ID_PRODUCTO='$axidinsumo'";
	$RSEliminar=odbc_exec($con,$sqleliminar);

	//echo $sqleliminar;

	if(odbc_num_rows($RSEliminar) > 0){
	
		$respuesta = 0;
		echo"$respuesta"; // Si existe

	} else {

		$respuesta = 1;
		echo"$respuesta"; // No existe existe

	}

break;

case '12':
	
	$axcodproformacz = $_POST['txtcodmovprof'];
	$sql6 = "SELECT * FROM LISTA_ORDEN_COMPRA_DT WHERE COD_MOV_PRF = '".$axcodproformacz."' ORDER BY ID_ORDEN_COMPRA_DT";
	//echo "$sql6";
	echo "
	
	<table class='table table-sm table-hover'>";

 	$result6=odbc_exec($con,$sql6);

	if ($result6){
		
		while ($row=odbc_fetch_array($result6)){ 

		$codmovpf = $row['COD_MOV_PRF'];
		$idins = $row['ID_PRODUCTO'];

		if($row['ID_INSUMO']==''){
			$axnomcomercial = $row["NOM_PRODUCTO"];
		}else{
			$axnomcomercial = $row["ID_INSUMO"].' | '.$row["NOM_PRODUCTO"];
		}

	 	echo "
 		<tr >
		
 		<td style='text-align: center;'>".number_format($row["CANT_SALIDA"],2,".",",")."</td>
			<td style='text-align: left;'>".$axnomcomercial."</td> 
			<td style='text-align: center;'>".$row["PRESENTACION"]."</td> 			
			<!--td contenteditable class='text-danger' style='text-align: right;' id='axcant_modificar' data-id='$codmovpf' data-idinsumo='$idins'>".number_format($row["PRECIO_V"],2,".",",")."</td-->
			<td class='text-danger' style='text-align: right;' id='axcant_modificar' data-id='$codmovpf' data-idinsumo='$idins'>".number_format($row["PRECIO_V"],2,".",",")."</td>
			<td style='text-align: right;'>".number_format($row["TOTAL_SALIDA"],2,".",",")."</td>
 			
 			<td style='text-align: center;''>
 				<a href='#'><img src='../icon/remover4.png' id='btquitaritemproforma' data-idinsumo='$idins' data-codmov='$codmovpf'></a>
			</td>

 			
 		</tr>";
		
		}

		$SQLTotal = "SELECT SUM(TOTAL_SALIDA) AS TT FROM LISTA_ORDEN_COMPRA_DT WHERE COD_MOV_PRF = '".$axcodproformacz."'";
		$RSTTotal=odbc_exec($con,$SQLTotal);
		while ($fila=odbc_fetch_array($RSTTotal)){
			$total = $fila['TT'];
		}


		echo "
		<tr class='table-active'>
			<th scope='col' style='text-align: right;' colspan='4'><h5>Total Venta</h5></th>
			<th scope='col' style='text-align: right;' id='tbtotalprof'><h5>".$total."</h5></th>
		</tr>";

		echo "</table>";
		}

		//$respuesta = 0;
		//echo"$respuesta"; // grabado
break;

case '13':

	$axidbeneficiario = $_POST['txtidcliente'];
	$axcodusuario = $_POST['txtid_usuario'];
	$axfechaemision = $_POST['txtfecharegistro'];
	$axidlocal = $_POST['txtidlocal'];	
	$axmoneda = $_POST['txtmoneda'];
	$axtipodoc = $_POST['txttipodoc'];
	$axmediopago= $_POST['txtmedipago_compra'];
	$axformapago =$_POST['txtformapago_compra'];
	$axestadoformapago= $_POST['txtestadopago_compra'];
	$axcodproformacz = trim($_POST['txtcodmovprof']);
	$axparamentro = $_POST['txtparametros'];
	$axnom_cliente_pedido = strtoupper($_POST['txtnom_cliente_pedido']);
	$axnum_proforma_1 = $_POST['txtnum_proforma_1'];

	$SQLActualizar = "UPDATE ORDEN_COMPRA_CZ SET ID_BENEFICIARIO='$axidbeneficiario',ID_USUARIO='$axcodusuario',FECHA_ORDEN_COMPRA='$axfechaemision',ID_LOCAL='$axidlocal',MONEDA='$axmoneda',ID_DT='$axtipodoc',MEDIO_PAGO='$axmediopago',FORMA_PAGO='$axformapago',ESTADO_FORMA_PAGO='$axestadoformapago',ESTADO_ORDEN_COMPRA='PENDIENTE',NOM_CLIENTE_PROF='$axnom_cliente_pedido',NUM_ORDEN_COMPRA='$axnum_proforma_1',ESTADO_TRANSFORMAR='PENDIENTE' WHERE COD_MOV_PRF='$axcodproformacz'";

	$RSActualizar = odbc_exec($con,$SQLActualizar);

//NUM_ORDEN_COMPRA,FECHA_ORDEN_COMPRA,ID_BENEFICIARIO,ID_LOCAL,ESTADO_ORDEN_COMPRA,ID_USUARIO,FORMA_PAGO,,MONEDA,COD_MOV_PRF,ID_DT,MEDIO_PAGO,ESTADO_FORMA_PAGO,,NOM_CLIENTE_PROF,


	//echo $SQLActualizar;

	if($RSActualizar){
		
		$respuesta = 0;
		echo $respuesta;

	}else{

		$respuesta = 1;
		echo $respuesta;

	}

break;

case '14':

$axfechaoperacion = $_POST['txtfechaoperacion']; 
	
	//$sql6 = "SELECT * FROM TIPO_CAMBIO WHERE FECHA_TC = '$axfechaoperacion'";
	$sql6 = "SELECT top 1 * FROM TIPO_CAMBIO order by costo desc";
	
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

case '15':

	$axnumcuenta = $_POST['txtnuncta_compra']; 
	
	$sql6 = "SELECT * FROM CUENTA_BANCARIAS WHERE ID_CTA ='$axnumcuenta' ";
	
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

case '16':



break;

case '17':

	$axcodmovcz = $_POST['txtcodmovcz'];
	$LblNombreArchivo = $_POST['LblNombreArchivo'];

	/*
	$tipodocumento = $_POST['tipodocumento'];
	$AxIdentificadorCZ = $_POST['AxIdentificadorCZ'];
	$AxIdentificadorDt = $_POST['AxIdentificadorDt'];
	$AxfechaRef = $_POST['AxfechaRef'];
	*/

	if($LblNombreArchivo==""){

		$SQLDatosCZ ="SELECT * FROM F_TEXTO_CZ WHERE codigo='$axcodmovcz'";
		$RSDatosCZ=odbc_exec($con,$SQLDatosCZ);

		//echo $SQLDatosCZ;

		while ($rowCZ=odbc_fetch_array($RSDatosCZ)){

			$tipodocumento = $rowCZ['ABREV_DOC'];
			$axnserie=$rowCZ['SERIE'];
			$axrucempresa=$rowCZ['RUC_EMPRESA'];
			$AxfechaRef = $rowCZ['FECHA_EMISION'];
			$axcorrelativo= $rowCZ['TXT_CORRELATIVO'];

			//echo $tipodocumento;

			if($tipodocumento=="BV"){

				$AxIdentificadorCZ = "BC";
		        $AxIdentificadorDt = "BD";
		        $AxTd = $rowCZ['TIPO'];
		        $AxExtencion = ".CAB";

			}elseif($tipodocumento=="FT"){

				$AxIdentificadorCZ = "FC";
		        $AxIdentificadorDt = "FD";
		        $AxTd = $rowCZ['TIPO'];
		        $AxExtencion = ".CAB";

			}elseif($tipodocumento=="NC"){

				$AxIdentificadorCZ = "CC";
		        $AxIdentificadorDt = "CD";
		        $AxTd = $rowCZ['TIPO'];
		        $AxExtencion = ".NOT";

			}elseif($tipodocumento=="ND"){

				$AxIdentificadorCZ = "DC";
		        $AxIdentificadorDt = "DD";
		        $AxTd = $rowCZ['TIPO'];
		        $AxExtencion = ".NOT";

			}

			$LblNombreArchivo = $axrucempresa.'-'.$AxTd.'-'.$axnserie.'-'.$axcorrelativo.$AxExtencion;
			//echo $LblNombreArchivo;

		}
	} 

	$sqlTextoCZ ="SELECT * FROM F_TEXTO_CZ WHERE codigo='$axcodmovcz'";
	$RSTextoCZ=odbc_exec($con,$sqlTextoCZ);
	
	if(odbc_num_rows($RSTextoCZ) > 0) {

		$archivo = fopen('../comprobantes/'.$LblNombreArchivo,'a');
		
		while ($row=odbc_fetch_array($RSTextoCZ)){
		
			 $emailproveedor = $row['EMAIL_PROVEEDOR'];
			 $AxEspacio = "";
	         $AxCodSunat = "50192303";
	         $AxCeros ="0.00";
		
			if ($emailproveedor = "0") {
				$emailproveedor = "";
			} else {
			    $emailproveedor = $row['EMAIL_PROVEEDOR'];
			}

			if ($tipodocumento=='FT' || $tipodocumento=='BV' ){
			
				$file = fopen('../comprobantes/'.$LblNombreArchivo,'a');				

				fwrite($file, $AxIdentificadorCZ.'|'.$row['FEC_EMIS'].'|'.$row['HORA_EMIS'].'|'.$row['TXT_SERIE'].'|'.$row['TXT_CORRELATIVO'].'|'.$row['COD_TIP_CPE'].'|'.$row['COD_MND'].'|'.$row['COD_TIP_ESCENARIO'].'|'.$AxEspacio.'|'.$row['COD_CLIENTE_EMIS'].'|'.$row['NUM_RUC_EMIS'].'|'.$row['NOM_RZN_SOC_EMIS'].'|'.$row['COD_TIP_NIF_EMIS'].'|'.$row['COD_LOC_EMIS'].'|'.$row['COD_UBI_EMIS'].'|'.$row['TXT_DMCL_FISC_EMIS'].'|'.$row['TXT_URB_EMIS'].'|'.$row['TXT_PROV_EMIS'].'|'.$row['TXT_DPTO_EMIS'].'|'.$row['TXT_DISTR_EMIS'].'|'.$row['NUM_IDEN_RECP'].'|'.$row['COD_TIP_NIF_RECP'].'|'.$row['NOM_RZN_SOC_RECP'].'|'.$row['TXT_DMCL_FISC_RECEP'].'|'.$emailproveedor.'|'.redondeado($row['MNT_TOT_GRAVADAS'],2).'|'.$row['MNT_TOT_INAFECTAS'].'|'.$row['MNT_TOT_EXONERADAS'].'|'.$row['MNT_TOT_GRATUITAS'].'|'.$row['MNT_TOT_DESC_GLOBAL'].'|'.$row['MNT_TOT_IGV'].'|'.redondeado($row['MNT_TOT_IGV_ISC'],2).'|'.$row['MNT_TOT_BASE_IMPONIBLE'].'|'.$row['MNT_TOT_PERCEPCION'].'|'.$row['MNT_TOT_A_PERCIBIR'].'|'.redondeado($row['MNT_TOT'],2).'|'.$row['COD_OPERACION'].'|'.$AxEspacio.'|'.$row['MNT_ANTICIPO'].'|'.$row['MNT_OTROS_CARGOS'].'|'.$row['TIPO_PERCEPCION'].'|'.$AxEspacio.'|'.$row['TIPO_CAMBIO'].'|'.$row['TXT_CONDICION_PAGO'].'|'.$row['FLAG_PAGADO'].'|'.$AxEspacio.'|'.$AxEspacio.'|'.'|'.$AxEspacio.'|'.$row['FLAG_ENVIO_AUTOMATICO'].'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxCeros.'|'.$AxCeros.'|'.$AxCeros.'|'.$AxEspacio.'|'.$row['MNT_TOT_DETRAC'].'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.PHP_EOL);

				fclose($file);

			
			} elseif ($tipodocumento=='NC' || $tipodocumento=='ND'){
				
				$file = fopen('../comprobantes/'.$LblNombreArchivo,'a');

			

				fwrite($file, $AxIdentificadorCZ.'|'.$row['FEC_EMIS'].'|'.$row['HORA_EMIS'].'|'.$row['TXT_SERIE'].'|'.$row['TXT_CORRELATIVO'].'|'.$row['COD_TIP_CPE'].'|'.$row['COD_MND'].'|'.$row['COD_TIP_ESCENARIO'].'|'.$AxEspacio.'|'.$row['COD_CLIENTE_EMIS'].'|'.$row['NUM_RUC_EMIS'].'|'.$row['NOM_RZN_SOC_EMIS'].'|'.$row['COD_TIP_NIF_EMIS'].'|'.$row['COD_LOC_EMIS'].'|'.$row['COD_UBI_EMIS'].'|'.$row['TXT_DMCL_FISC_EMIS'].'|'.$row['TXT_URB_EMIS'].'|'.$row['TXT_PROV_EMIS'].'|'.$row['TXT_DPTO_EMIS'].'|'.$row['TXT_DISTR_EMIS'].'|'.$row['NUM_IDEN_RECP'].'|'.$row['COD_TIP_NIF_RECP'].'|'.$row['NOM_RZN_SOC_RECP'].'|'.$row['TXT_DMCL_FISC_RECEP'].'|'.$emailproveedor.'|'.$row['MNT_TOT_GRAVADAS'].'|'.$row['MNT_TOT_INAFECTAS'].'|'.$row['MNT_TOT_EXONERADAS'].'|'.$row['MNT_TOT_GRATUITAS'].'|'.$row['MNT_TOT_DESC_GLOBAL'].'|'.$row['MNT_TOT_IGV'].'|'.$row['MNT_TOT_IGV_ISC'].'|'.$row['MNT_TOT_BASE_IMPONIBLE'].'|'.$row['MNT_TOT_PERCEPCION'].'|'.$row['MNT_TOT_A_PERCIBIR'].'|'.$row['MNT_TOT'].'|'.$row['COD_TIP_NC_ND_REF'].'|'.$row['TXT_SERIE_REF'].'|'.$row['TXT_CORRELATIVO_CPE_REF'].'|'.$AxfechaRef.'|'.$row['COD_CPE_REF'].'|'.$row['TXT_SUSTENTO'].'|'.$row['COD_OPERACION'].'|'.$AxEspacio.'|'.$row['MNT_ANTICIPO'].'|'.$row['MNT_OTROS_CARGOS'].'|'.$row['TIPO_PERCEPCION'].'|'.$AxEspacio.'|'.$row['TIPO_CAMBIO'].'|'.$AxEspacio.'|'.$row['FLAG_ENVIO_AUTOMATICO'].'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.$AxEspacio.'|'.PHP_EOL);

				fclose($file);
			} 

		} //while ($row=odbc_fetch_array($RSTextoCZ)){

			$sqlTextoDT ="SELECT * FROM F_TEXTO_DT WHERE codigo='$axcodmovcz'";
			$RSTextoDT=odbc_exec($con,$sqlTextoDT);
			
			if(odbc_num_rows($RSTextoDT) > 0) {

				$file = fopen('../comprobantes/'.$LblNombreArchivo,'a');

				while ($rowDT=odbc_fetch_array($RSTextoDT)){

					$Axcuenta = $Axcuenta+1;
					$AxCanSalida = $rowDT['CANT_UNID_ITEM'];

					if($AxCanSalida < 0) {
						$AxCanSalida = $rowDT['CANT_UNID_ITEM']/-1;
					} else {
						$AxCanSalida = $rowDT['CANT_UNID_ITEM'];
					}

					 

					if ($tipodocumento=='FT' || $tipodocumento=='BV' ){

						fwrite($file, 

							$AxIdentificadorDt.'|'.
							$Axcuenta.'|'.
							$rowDT['COD_UNID_ITEM'].'|'.
							redondeado($AxCanSalida,2).'|'.
							redondeado($rowDT['VAL_VTA_ITEM'],2).'|'.
							$rowDT['COD_TIP_AFECT_IGV_ITEM'].'|'.
							redondeado($rowDT['PRC_VTA_UNIT_ITEM'],2).'|'.
							redondeado($rowDT['MNT_DSCTO_ITEM'],2).'|'.
							redondeado($rowDT['MNT_IGV_ITEM'],2).'|'.
							redondeado($rowDT['TXT_DESC_ITEM'],2).'|'.
							$AxCodSunat.'|'.
							$rowDT['COD_ITEM'].'|'.
							redondeado($rowDT['VAL_UNIT_ITEM'],2).'|'.
							$AxEspacio.'|'.
							$rowDT['MNT_ISC_ITEM'].'|'.
							$AxEspacio.'|'.
							$AxEspacio.'|'.
							$AxEspacio.'|'.
							redondeado($rowDT['IMPORTE_TOTAL_ITEM'],2).'|'.
							PHP_EOL);

					} elseif ($tipodocumento=='NC' || $tipodocumento=='ND'){

						fwrite($file, 

							$AxIdentificadorDt.'|'.
							$Axcuenta.'|'.
							$rowDT['COD_UNID_ITEM'].'|'.
							redondeado($AxCanSalida,2).'|'.
							redondeado($rowDT['VAL_VTA_ITEM'],2).'|'.
							$rowDT['COD_TIP_AFECT_IGV_ITEM'].'|'.
							redondeado($rowDT['PRC_VTA_UNIT_ITEM'],2).'|'.
							redondeado($rowDT['MNT_DSCTO_ITEM'],2).'|'.
							redondeado($rowDT['MNT_IGV_ITEM'],2).'|'.
							redondeado($rowDT['TXT_DESC_ITEM'],2).'|'.
							$AxCodSunat.'|'.
							$rowDT['COD_ITEM'].'|'.
							redondeado($rowDT['VAL_UNIT_ITEM'],2).'|'.
							$AxEspacio.'|'.
							$rowDT['MNT_ISC_ITEM'].'|'.
							$AxEspacio.'|'.
							$AxEspacio.'|'.
							$AxEspacio.'|'.
							redondeado($rowDT['IMPORTE_TOTAL_ITEM'],2).'|'.
							PHP_EOL);
							
					}

				}
					
					$Axcuenta=0;
					$sqlaestadoelectro ="UPDATE MAESTRO_CZ SET ESTADO_ELECTRO='PROCESADA' WHERE COD_MOV = '$axcodmovcz'";
					$rsestadoeletro=odbc_exec($con,$sqlaestadoelectro); 

					$respuesta = 0;
	    			echo"$respuesta"; // se cargo el detalle de los registros al TXT		

			} else {

					$sqlaestadoelectro ="UPDATE MAESTRO_CZ SET ESTADO_ELECTRO='PENDIENTE' WHERE COD_MOV = '$axcodmovcz'";
					$rsestadoeletro=odbc_exec($con,$sqlaestadoelectro); 

					$file = fopen('../comprobantes/'.$LblNombreArchivo,'w');				
					
					fwrite($file, 'Archivo con error'.'|'.PHP_EOL);
					fclose($file);	

					$respuesta = 2;
					echo"$respuesta"; // no hay registros en el detalle para cargar al TXT
			}
							 

	} else { //if(odbc_num_rows($RSTextoCZ) > 0) {


		$respuesta = 1;
		echo"$respuesta"; // ya esta procesada y no puede volver a procesarla


	}  //} else { //if(odbc_num_rows($RSTextoCZ) > 0) {
				

break;


case '18':

break;

case '19': /// EMITE LOS JSON POR BOLETAS,FACTURAS Y NOTAS DE CREDITO

//header('Content-Type: application/json; charset=utf-8');

$axcodmovcz = $_POST['txtcodmovcz'];
$axidlocal= $_POST['txtidlocal'];
$axdocumento_tipo= $_POST['axdocumento_tipo'];
$axruta= $_POST['txtruta'];
$axobservado= $_POST['txtobservado'];
$axruta_proc= $_POST['txtruta_proc'];

$ruta_api= $_POST['txtruta_ap'];
$token= $_POST['txttoken'];

$SQLDatos_1 ="SELECT * FROM REG_VENTAS_CZ WHERE COD_MOV='$axcodmovcz' AND ID_LOCAL='$axidlocal'";
$RSDatos_1=odbc_exec($con,$SQLDatos_1);

while ($row=odbc_fetch_array($RSDatos_1)) {
			
	$axrucempresa= $row['RUC_EMPRESA'];
	$axtipodoc= $row['COD_SUNAT'];
	$axnserie= $row['TXT_SERIE'];
	$axcorrelativo= $row['DOCUMENTO'];
	$axfecha_emision= $row['FECHA_EMISION'];
}

$date = new DateTime($axfecha_emision);
$fecha_archivo = $date->format('dmy');


$LblNombreArchivo = $axrucempresa.'-'.$axtipodoc.'-'.$axnserie.'-'.$axcorrelativo.'.json';
$LblNombreArchivo_1 = $axrucempresa.'-'.$axtipodoc.'-'.$axnserie.'-'.$axcorrelativo.'-'.$fecha_archivo.'.json';



//$LblNombreArchivo = $_POST['LblNombreArchivo'];

$response=array();

if($axdocumento_tipo=="NOTA DE CREDITO"){

$SQLDatosCZ ="SELECT top 1 identificador,fec_emis,hora_emis,TXT_SERIE,txt_correlativo,cod_tip_cpe,cod_mnd,cod_tip_escenario,txt_placa,cod_cliente_emis,num_ruc_emis,nom_rzn_soc_emis,cod_tip_nif_emis,cod_loc_emis,cod_ubi_emis,txt_dmcl_fisc_emis,TXT_URB_EMIS,txt_prov_emis,txt_dpto_emis,txt_distr_emis,num_iden_recp,cod_tip_nif_recp,nom_rzn_soc_recp,txt_dmcl_fisc_recep,txt_correo_adquiriente,mnt_tot_gravadas,mnt_tot_inafectas,mnt_tot_exoneradas,mnt_tot_gratuitas,mnt_tot_desc_global,mnt_tot_igv,mnt_tot_igv_isc,mnt_tot_icbper,mnt_tot_base_imponible,mnt_tot_percepcion,mnt_tot_a_percibir,mnt_tot,cod_tip_nc_nd_ref,txt_serie_ref,txt_correlativo_cpe_ref,fec_emis_ref,cod_cpe_ref,txt_sustento,cod_operacion,porcentaje_dscto,mnt_anticipo,mnt_otros_cargos,tipo_percepcion,porcentaje_percepcion,tipo_cambio,txt_observ,flag_envio_automatico,dato_extra_1,dato_extra_2,dato_extra_3,dato_extra_4 FROM F_JSON_CZ WHERE COD_MOV='$axcodmovcz'";

} else {

$SQLDatosCZ ="SELECT top 1 identificador,fec_emis,hora_emis,TXT_SERIE,txt_correlativo,cod_tip_cpe,cod_mnd,cod_tip_escenario,txt_placa,cod_cliente_emis,num_ruc_emis,nom_rzn_soc_emis,cod_tip_nif_emis,cod_loc_emis,cod_ubi_emis,txt_dmcl_fisc_emis,TXT_URB_EMIS,txt_prov_emis,txt_dpto_emis,txt_distr_emis,num_iden_recp,cod_tip_nif_recp,nom_rzn_soc_recp,txt_dmcl_fisc_recep,txt_correo_adquiriente,mnt_tot_gravadas,mnt_tot_inafectas,mnt_tot_exoneradas,mnt_tot_gratuitas,mnt_tot_desc_global,mnt_tot_igv,mnt_tot_igv_isc,mnt_tot_icbper,mnt_tot_base_imponible,mnt_tot_percepcion,mnt_tot_a_percibir,mnt_tot,cod_operacion,porcentaje_dscto,mnt_anticipo,mnt_otros_cargos,tipo_percepcion,porcentaje_percepcion,tipo_cambio,txt_condicion_pago,flag_pagado,txt_observ,orden_compra,guia_remision,flag_envio_automatico,guia_txt_cod_ubig,guia_txt_dmcl_fisc,guia_txt_urb,guia_txt_prov,guia_txt_dpto,guia_txt_distr,guia_txt_pais,guia_cod_ubig_llegda,guia_txt_dmcl_fisc_llegda,guia_txt_urb_llegda,guia_txt_prov_llegda,guia_txt_dpto_llegda,guia_txt_distr_llegda,guia_txt_pais_llegda,guia_txt_placa_auto_trnsp,guia_txt_cert_auto_trnsp,guia_txt_marca_auto_trnsp,guia_txt_lic_cond_trnsp,guia_txt_ruc_trnsp,guia_txt_cod_otr_trnsp,guia_txt_rzn_scl_trnsp,guia_txt_cod_mod_trnsp,guia_mnt_total_bruto,guia_cod_unid_med,dato_extra_1,dato_extra_2,dato_extra_3,dato_extra_4,marca_expor,origen_expor,despacho_expor,soldto_expor,shipto_expor,numerocajas_expor,pesobruto_expor,pesoneto_expor,volumen_expor,fec_venci,mnt_tot_detrac,percent_detrac,descrip_detrac,num_cta_bn,tip_detrac,infos_detrac FROM F_JSON_CZ WHERE COD_MOV='$axcodmovcz'";

}


$RSDatosCZ=odbc_exec($con,$SQLDatosCZ);
$filacz = odbc_fetch_array($RSDatosCZ);

//$response = array($filacz);
$SQLDatosDT ="SELECT num_lin_item,cod_unid_item,cant_unid_item,val_vta_item,cod_tip_afect_igv_item,prc_vta_unit_item,mnt_dscto_item,mnt_igv_item,txt_descr_item,cod_prod_sunat,cod_item,val_unit_item,cod_tip_sist_isc,mnt_isc_item,porcentaje_isc,dato_extra_1,dato_extra_2,importe_total_item,val_unit_icbper,cant_icbper_item,mnt_icbper_item FROM F_JSON_DT WHERE COD_MOV='$axcodmovcz'";

$RSDatosDT=odbc_exec($con,$SQLDatosDT);
$axnum = odbc_num_rows($RSDatosDT);

for ($i=0; $i < $axnum ; $i++) { 
		
	$filaDT = odbc_fetch_array($RSDatosDT);
	$jsonDT_1[$i] = $filaDT;

}

$array1    = $filacz;
$array2['anticipos'] = array();
//$array3['detalles'] = array($jsonDT_1);
$array3['detalles'] = $jsonDT_1;
$resultado = $array1 + $array2 + $array3;
//var_dump($resultado);

$jsonfinal_1 = json_encode($resultado,JSON_PRETTY_PRINT);	
$jsonfinal = preg_replace('#:"(\d+)"#', ':$1', $jsonfinal_1);

$file = $axruta.$LblNombreArchivo;   
file_put_contents($file, $jsonfinal);

$SQLActualizar = "UPDATE MAESTRO_CZ SET BOUCHER_DIGITAL='$LblNombreArchivo',ESTADO_ELECTRO='PROCESADA',ESTADO_FINAL='PROCESADA' WHERE COD_MOV='$axcodmovcz'";
$RSActualizar = odbc_exec($con, $SQLActualizar);
/*		
$file_proc = $axruta_proc.$LblNombreArchivo;

if (file_exists($file_proc)) {
	$axestadoelectro = "PROCESADA";
	$SQLActualizar ="UPDATE MAESTRO_CZ SET ESTADO_FINAL='$axestadoelectro', ESTADO_ELECTRO='$axestadoelectro',BOUCHER_DIGITAL='$LblNombreArchivo' WHERE COD_MOV='$axcodmovcz'";
	$RSActualizar = odbc_exec($con, $SQLActualizar);
} else {
	$axestadoelectro = "PENDIENTE";
	$SQLActualizar ="UPDATE MAESTRO_CZ SET ESTADO_FINAL='$axestadoelectro', ESTADO_ELECTRO='$axestadoelectro',BOUCHER_DIGITAL='$LblNombreArchivo' WHERE COD_MOV='$axcodmovcz'";
	$RSActualizar = odbc_exec($con, $SQLActualizar);
}	
*/


/*
$ruta_api_buscar =$axruta.$LblNombreArchivo_1;   
$contexto = stream_context_create(array(
	'http' => array('header' => 
		'Metodo: GET',
		'Autorization: usuario:"'.$token.'"',
		'Content-Type: application/json')	
));

return file_get_contents($ruta_api.$ruta_api_buscar,false,$contexto);

if ($data['Resultado']==true) {
	echo $leer_respuesta['Resultado'];
} else {
    echo $leer_respuesta['Resultado'];
}
*/


break;

case '20':
	
	$axcodmovcz= $_POST['txtcodmovcz'];
	$axidlocal= $_POST['txtidlocal'];
	$axfecha_anulado = $_POST['txtfecha_anulacion'];
	$axestado_comprobante= $_POST['txtestado_comprobante'];
	$axmotivo_anulacion= $_POST['txtmotivo_baja'];

	$SQLBaja = "UPDATE MAESTRO_CZ SET TXT_DESCR_MTVO_BAJA='$axmotivo_anulacion', ESTADO_ELECTRO='$axestado_comprobante', FECHA_REFERENCIA='$axfecha_anulado' WHERE COD_MOV = '$axcodmovcz' AND ID_LOCAL='$axidlocal'";
	$RSBaja = odbc_exec($con, $SQLBaja);

	if($RSBaja){

		$respuesta=0;
		echo $respuesta;
	} else{

		$respuesta=1;
		echo $respuesta;

	}


break;

case '21': //GENERAR JSON DE BAJA DE FACTURAS O BOLETAS

	header('Content-Type: application/json; charset=utf-8');
	//$axcodmovcz = $_POST['axcodmovcz'];
	$axcodmovcz = $_POST['txtcodmovcz'];
	$axidlocal= $_POST['txtidlocal'];
	$axruta= $_POST['txtruta'];
	

	$SQLDatos_1 ="SELECT * FROM REG_VENTAS_CZ WHERE COD_MOV='$axcodmovcz' AND ID_LOCAL='$axidlocal'";
	$RSDatos_1=odbc_exec($con,$SQLDatos_1);

	while ($row=odbc_fetch_array($RSDatos_1)) {
				
		$axrucempresa= $row['RUC_EMPRESA'];
		$axtipodoc= $row['COD_SUNAT'];
		$axnserie= $row['TXT_SERIE'];
		$axcorrelativo= $row['DOCUMENTO'];

	}

	$LblNombreArchivo = $axrucempresa.'-'.$axtipodoc.'-'.$axnserie.'-'.$axcorrelativo.'-C.json';

	$response=array();

	$SQLDatosCZ ="SELECT identificador,fec_emis,fec_gener_baja,cod_tip_escenario,txt_serie,cod_iden_cb,cod_cliente_emis,num_ruc_emis,txt_correlativo,cod_tip_cpe,txt_descr_mtvo_baja FROM F_JSON_BAJA WHERE COD_MOV='$axcodmovcz'";
	$RSDatosCZ=odbc_exec($con,$SQLDatosCZ);
	$filacz = odbc_fetch_array($RSDatosCZ);

	//$response = array($filacz);

	$array1    = $filacz;
	$resultado = $array1;
	var_dump($resultado);

	$jsonfinal_1 = json_encode($resultado,JSON_PRETTY_PRINT|JSON_PRESERVE_ZERO_FRACTION);	
	$jsonfinal = preg_replace('#:"(\d+)"#', ':$1', $jsonfinal_1);
	

	$file = $axruta.$LblNombreArchivo;   
	file_put_contents($file, $jsonfinal);
	
	$SQLActualizar = "UPDATE MAESTRO_CZ SET BOUCHER_DIGITAL='$LblNombreArchivo' WHERE COD_MOV='$axcodmovcz'";
	$RSActualizar = odbc_exec($con, $SQLActualizar);

break;

case '22': //PRUEBAS JSON DE CARACTERES

	//$axcodmovcz = $_POST['axcodmovcz'];
	$axidlocal= $_POST['txtidlocal'];
	$axruta= $_POST['txtruta'];

	$axfechaactual= $_POST['txtfecharegistro'];
	$axruta_exc= $_POST['txtruta_exc'];
	$axruta_obs= $_POST['txtruta_obs'];
	$axruta_proc= $_POST['txtruta_proc'];



	$SQaxnom_archivo = "SELECT * FROM MAESTRO_CZ WHERE ID_LOCAL='$axidlocal' AND FECHA_EMISION='$axfechaactual' AND DETALLE_MOVIMIENTO='VENTA' ORDER BY TXT_SERIE,DOCUMENTO";
	$RSaxnom_archivo = odbc_exec($con, $SQaxnom_archivo);

	//echo $SQaxnom_archivo;
	
	while ($fila_n = odbc_fetch_array($RSaxnom_archivo)) {
		
		$LblNombreArchivo = $fila_n['BOUCHER_DIGITAL'];
		$axcodmovcz= $fila_n['COD_MOV'];
		//echo $LblNombreArchivo.'</br>';

		$file_exc = $axruta_exc.$LblNombreArchivo;
		$file_obs = $axruta_obs.$LblNombreArchivo;
		$file_proc = $axruta_proc.$LblNombreArchivo;
		
		if (file_exists($file_proc)) {
			
			$axestadoelectro = "PROCESADA";
			$SQLActualizar ="UPDATE MAESTRO_CZ SET ESTADO_FINAL='$axestadoelectro', ESTADO_ELECTRO='$axestadoelectro' WHERE COD_MOV='$axcodmovcz' AND ID_LOCAL='$axidlocal'";
			$RSActualizar = odbc_exec($con, $SQLActualizar);


		} else {

			$axestadoelectro = "PENDIENTE";
			$SQLActualizar ="UPDATE MAESTRO_CZ SET ESTADO_FINAL='$axestadoelectro', ESTADO_ELECTRO='$axestadoelectro' WHERE COD_MOV='$axcodmovcz' AND ID_LOCAL='$axidlocal'";
			$RSActualizar = odbc_exec($con, $SQLActualizar);

		}	
		
		//echo $axestadoelectro.'</br>';
	}



	$sql6 ="SELECT * FROM REG_VENTAS_CZ WHERE ID_LOCAL='$axidlocal' AND FECHA_EMISION='$axfechaactual' AND DETALLE_MOVIMIENTO='VENTA' ORDER BY TXT_SERIE,DOCUMENTO";
	$result6=odbc_exec($con,$sql6);
	//echo $sql6;
	echo "
	<div id='div3'>
		<table class='table table-sm table-hover' id='tblobservdas'>
		<thead>			
		<tr>
			<th scope='col' style='text-align: center;'>Item</th>
			<th scope='col' style='text-align: center;'>Fecha Emisión</th>
			<th scope='col' style='text-align: center;'>Comprobante</th>
			<th scope='col' style='text-align: center;'>Estado</th>			
		</tr>
		</thead>";
	
	while ($row=odbc_fetch_array($result6)){ 
 	$it = $it+1;	
 	$axestaodfinal = $row["ESTADO_FINAL"];

	 	if($axestaodfinal=="PENDIENTE"){

	 		echo "
	 		<tr>
	 			<td class='text-danger' style='text-align: center; text-color'><b>".$it."</b></td>  		
	 			<td class='text-danger' style='text-align: center;'><b>".date("d-m-Y",strtotime($row["FECHA_EMISION"]))."</b></td>  				
	 	 		<td class='text-danger' style='text-align: center;'><b>".$row["TXT_SERIE"].'-'.$row["DOCUMENTO"]."</b></td> 		
	 	 		<td class='text-danger' style='text-align: center;'><b>".$row["ESTADO_FINAL"]."</b></td> 		
			</tr>";

	 	 		
	 	} elseif ($axestaodfinal=="PROCESADA"){

	 		echo "
	 		<tr>
	 			<td class='text-primary' style='text-align: center; text-color'>".$it."</td>  		
	 			<td class='text-primary' style='text-align: center;'>".date("d-m-Y",strtotime($row["FECHA_EMISION"]))."</td>  				
	 	 		<td class='text-primary' style='text-align: center;'>".$row["TXT_SERIE"].'-'.$row["DOCUMENTO"]."</td> 		
	 	 		<td class='text-primary' style='text-align: center;'>".$row["ESTADO_FINAL"]."</td> 		
			</tr>";

	 	}

 	}

	echo "</table>	
	</div>";
	
	
/*
	
	$nombre_fichero = $axruta.$LblNombreArchivo;

	if (file_exists($nombre_fichero)) {
		echo $axruta.'</br>';
	    echo "El fichero $nombre_fichero existe";
	} else {
		echo $axruta.'</br>';
	    echo "El fichero $nombre_fichero no existe";
	}






/* GENERAR NOMBRES DE ARCHIVOS EN LA TABLA MAESTRO_CZ
	$SQaxnom_archivo = "SELECT * FROM MAESTRO_1 WHERE ID_LOCAL='$axidlocal' AND DETALLE_MOVIMIENTO='VENTA' ORDER BY TXT_SERIE,DOCUMENTO ASC";
	$RSaxnom_archivo = odbc_exec($con, $SQaxnom_archivo);

	while ($row = odbc_fetch_array($RSaxnom_archivo)) {

		$axcodmovcz= $row['COD_MOV'];	
		$axrucempresa= $row['RUC_EMPRESA'];	
		$axtipodoc= $row['COD_SUNAT'];
		$axnserie= $row['TXT_SERIE'];
		$axcorrelativo= $row['DOCUMENTO'];
		$axestadoelectro= $row['ESTADO_ELECTRO'];

		if($axestadoelectro=="ANULADA"){

			$axestencion = '-C.json';
		}else{
			$axestencion = '.json';

		}


		$LblNombreArchivo = $axrucempresa.'-'.$axtipodoc.'-'.$axnserie.'-'.$axcorrelativo.$axestencion;
	//	echo $LblNombreArchivo.'</br>';

		$SQLActualizar = "UPDATE MAESTRO_CZ SET BOUCHER_DIGITAL='$LblNombreArchivo' WHERE COD_MOV='$axcodmovcz'";
		$RSActualizar = odbc_exec($con, $SQLActualizar);
	}
*/	


/**
	$axcodmovcz = $_POST['axcodmovcz'];
	$axidlocal= $_POST['txtidlocal'];

	$SQLDatosCZ ="SELECT * FROM F_JSON_CZ WHERE COD_MOV='$axcodmovcz'";
	$RSDatosCZ=odbc_exec($con,$SQLDatosCZ);
	$filacz = odbc_fetch_array($RSDatosCZ);

	foreach ($filacz as $key => $valor) {
		
		echo $key .', </br>';
		//echo $key .',';
			
	}
*/	
	
break;


case '23': // SI REALIZA ALGUN CAMBIO EN ESTE PROCEDMIENTO TAMBIEN DEBERA HACER CAMBIOS EN BENEFICIARIOS_FUNCIONES EL PROCEDIMIENTO 1
	
	$axidbeneficiario= $_POST['txtidbeneficiario'];
	$axtipobenef= $_POST['txttipobeneficiario'];
	$axcalificacion= $_POST['txtcalificar'];
	$axiddoc= $_POST['txttipodoc_cliente'];
	$axruc= $_POST['txtruc_cliente'];
	$axnombenefi= $_POST['txtnombeneficiario'];
	$axdirbenefi= $_POST['txtdireccion_cliente'];
	$axidubigeo= $_POST['txtidubigeo'];
	$axtelefbenefi= $_POST['txttelefonos'];
	$axemailbenefi= $_POST['txtemail'];
	$axparamentro= $_POST['txtparametros'];
	$axurbaniz= $_POST['txturbanizacion'];

	$Insertar = "INSERT INTO BENEFICIARIO (TIPO_PROV_CLIE,CALIFIC_PROVEEDOR,ID_DOC,RUC_BENEF,NOM_PROVEEDOR,DIR_PROVEEDOR,ID_UBIGEO,TELEF_PROVEEDOR,EMAIL_PROVEEDOR,TXT_URB_EMIS) VALUES ('$axtipobenef','$axcalificacion','$axiddoc','$axruc','$axnombenefi','$axdirbenefi','$axidubigeo','$axtelefbenefi','$axemailbenefi','$axurbaniz')";

//	echo $Insertar;

	$result6=odbc_exec($con,$Insertar); 
	if($result6){
		$respuesta = 0;
		echo"$respuesta"; // grabado
	}else{
		$respuesta = 1;
		echo"$respuesta"; // no grabado
	}
break;

case '24': //cambiar precio en profromas
	
	$cod_mov_pf= $_POST['cod_mov_pf'];
	$id_insumo= $_POST['id_insumo'];
	$axprecio_nuevo= $_POST['cant_nueva'];
	$txtidlocal= $_POST['txtidlocal'];
	$axporc_igv= $_POST['txtporc_igv'];

	$SQLBuscarInsumo = "SELECT * FROM INSUMOS_LISTA WHERE ID_INSUMO ='$id_insumo'";
	$RSBuscarInsumo = odbc_exec($con, $SQLBuscarInsumo);

	$filainsumo = odbc_fetch_array($RSBuscarInsumo);

	//echo $SQLBuscarInsumo;

	$axcondicion = $filainsumo['ABREV_AFECTACION'];

	//echo $axcondicion;

	$SQLBuscar = "SELECT * FROM PROFORMA WHERE COD_MOV_PRF ='$cod_mov_pf' AND ID_INSUMO ='$id_insumo'";
	$RSBuscar = odbc_exec($con, $SQLBuscar);

	//echo $SQLBuscar;

	while ($filas =odbc_fetch_array($RSBuscar) ) {
		
		$axprecio_actual = $filas['PRECIO_V'];
		$axcant_actual = $filas['CANT_SALIDA'];
		$valor_nuevo = $axcant_actual*$axprecio_nuevo;
		$axid = $filas['COD_MOV_PRF'];
		//echo $axid;

		if($axcondicion=="GRAVADA"){

			$axprecio_nuevo_sin_igv = ($axprecio_nuevo/(1+$axporc_igv));
			$valor_nuevo = ($axcant_actual*$axprecio_nuevo_sin_igv);
			$axigv_nuevo = $valor_nuevo*$axporc_igv;
			$axgravada = $valor_nuevo;
			$axexonerada = 0;
			$axinafecta = 0;
			$axtotalventa = $valor_nuevo+$axigv_nuevo;
			$axventas_gravadas = $valor_nuevo+$axigv_nuevo;

		} elseif($axcondicion=="EXONERADA"){

			$axprecio_nuevo_sin_igv = ($axprecio_nuevo/(1+$axporc_igv));
			$valor_nuevo = ($axcant_actual*$axprecio_nuevo_sin_igv);
			$axigv_nuevo = $valor_nuevo*$axporc_igv;
			$axgravada = 0;
			$axexonerada = $valor_nuevo;
			$axinafecta = 0;
			$axtotalventa = $valor_nuevo+$axigv_nuevo;
			$axventas_exonerada = $valor_nuevo+$axigv_nuevo;


		} elseif($axcondicion=="INAFECTO"){

			$axprecio_nuevo_sin_igv = $axprecio_nuevo;
			$valor_nuevo = ($axcant_actual*$axprecio_nuevo_sin_igv);
			$axigv_nuevo = 0;
			$axgravada = 0;
			$axexonerada = 0;
			$axinafecta = $valor_nuevo;
			$axtotalventa = $valor_nuevo+$axigv_nuevo;
			$axventas_inafecta = $axvalor_venta+$axigv_nuevo;

		//	echo $axprecio_nuevo_sin_igv.'|'.$axcant_actual.'|'.$axprecio_nuevo.'</br>';
		//	echo $axinafecta.'</br>';

		}

		$SQLInsertar = "UPDATE PROFORMA SET PRECIO_V='$axprecio_nuevo',VALOR_SALIDA='$valor_nuevo',IGV_SALIDA='$axigv_nuevo',GRAVADAS_SALIDA='$axgravada',INAFECTO_SALIDA='$axinafecta',EXONERADO_SALIDA='$axexonerada',TOTAL_SALIDA='$axtotalventa' WHERE COD_MOV_PRF='$cod_mov_pf' AND ID_INSUMO='$id_insumo' AND COD_MOV_PRF ='$axid'";
		$RSInsertar=odbc_exec($con,$SQLInsertar); 

		//echo $SQLInsertar ;
	}

	
	$sql6 = "SELECT * FROM PROFORMA_GRILLA WHERE COD_MOV_PRF = '".$cod_mov_pf."' ORDER BY NOM_COMERCIAL";
	//echo "$sql6";
	echo "
	<table class='table table-sm table-hover'>";

 		$result6=odbc_exec($con,$sql6);

		if ($result6){
		
		while ($row=odbc_fetch_array($result6)){ 

		$codmovpf = $row['COD_MOV_PRF'];
		$idins = $row['ID_PRODUCTO'];

	 	echo "
 		<tr >
		
 			<td style='text-align: center;'>".number_format($row["CANT_SALIDA"],2,".",",")."</td>
			<td style='text-align: left;'>".$row["NOM_COMERCIAL"]."</td> 
			<td style='text-align: center;'>".$row["PRES_ABREV"]."</td> 
			<!--td style='text-align: right;'>".number_format($row["PRECIO_V"],2,".",",")."</td-->
			<td contenteditable class='text-danger' style='text-align: center;' id='axcant_modificar' data-id='$codmovpf' data-idinsumo='$idins'>".number_format($row["PRECIO_V"],2,".",",")."</td>
			<td style='text-align: right;'>".number_format($row["TOTAL_SALIDA"],2,".",",")."</td>
 			
 			<td style='text-align: center;''>
 				<a href='#'><img src='../icon/remover4.png' id='btquitaritemproforma' data-idinsumo='$idins' data-codmov='$codmovpf'></a>
			</td>

 			
 		</tr>";
		
		}

		$SQLTotal = "SELECT SUM(TOTAL_SALIDA) AS TT FROM PROFORMA_GRILLA WHERE COD_MOV_PRF = '".$cod_mov_pf."'";
		$RSTTotal=odbc_exec($con,$SQLTotal);
		while ($fila=odbc_fetch_array($RSTTotal)){
			$total = $fila['TT'];
		}


		echo "
		<tr class='table-active'>
			<th scope='col' style='text-align: right;' colspan='4'><h5>Total Venta</h5></th>
			<th scope='col' style='text-align: right;' id='tbtotalprof'><h5>".$total."</h5></th>
		</tr>";

		echo "</table>";
		}

break;
case '25':
	
	$ruc = $_POST['txtruc_cliente'];
	$data = file_get_contents("https://api.sunat.cloud/ruc/".$ruc);
	//$data = file_get_contents("https://cors-anywhere.herokuapp.com/wmtechnology.org/Consultar-RUC/?modo=1&btnBuscar=Buscar&nruc=".$ruc);
	

	$info = json_decode($data,true);

	if($data==='[]' || $info['fecha_inscripcion']==='--'){
		$datos = array(0 => 'nada');
		echo json_encode($datos);
	}else{
		$datos =array(
			0 => $info['ruc'],
			1 => $info['razon_social'],
			2 => $info['domicilio_fiscal'],
			3 => $info['contribuyente_estado'],
			4 => $info['representante_legal'],
			5 => $info['contribuyente_condicion']	

			
		);

		echo json_encode($datos);

	}	


break;

case '26':
	# code...
	$axidempresa = $_POST['txtidempresa']; 
	$axdel = $_POST['txtfecha_del']; 
	$axidlocal = $_POST['txtidlocal']; 
	$axal = $_POST['txtfecha_al']; 
	$axtipo_reporte = $_POST['txtreportes'];
	$axconcepto = $_POST['axconcepto'];  

	if($axtipo_reporte=="TODOS"){

		$sql6 ="SELECT ID_LOCAL,FECHA_EMISION,TXT_SERIE,DOCUMENTO,NOM_CODIGOS,NOM_COMERCIAL,TOTAL_SALIDA,ID_INSUMO,NOM_PROVEEDOR,COD_MOV FROM  MAESTRO_1 WHERE FECHA_EMISION BETWEEN '$axdel' AND '$axal' AND ESTADO_ELECTRO ='PROCESADA' AND DETALLE_MOVIMIENTO='VENTA' AND ID_LOCAL='$axidlocal' AND NOM_CATEGORIA <>'CONCEPTOS EXTRAORDINARIOS' ORDER BY TXT_SERIE,DOCUMENTO ASC";
	
		
	} else {
		
		$sql6 ="SELECT ID_LOCAL,FECHA_EMISION,TXT_SERIE,DOCUMENTO,NOM_CODIGOS,NOM_COMERCIAL,TOTAL_SALIDA,ID_INSUMO,NOM_PROVEEDOR,COD_MOV FROM  MAESTRO_1 WHERE FECHA_EMISION BETWEEN '$axdel' AND '$axal' AND ESTADO_ELECTRO ='PROCESADA' AND DETALLE_MOVIMIENTO='VENTA' AND ID_LOCAL='$axidlocal' AND NOM_CODIGOS='$axconcepto' AND NOM_CATEGORIA <>'CONCEPTOS EXTRAORDINARIOS' ORDER BY TXT_SERIE,DOCUMENTO ASC";

	}			
	echo $sql6;
	
	$result6=odbc_exec($con,$sql6);

	echo "
		
		<table class='table table-sm table-hover' id='tblconceptos'>
		<input type='button' class='btn btn-outline-success btn-sm'  onclick='guardarexcel_conceptos()' value='Exportar a Excel'>	
		<p><hr></p>	
		<thead>			
		<tr>
			<th scope='col' style='text-align: center;'>Item</th>
			<th scope='col' style='text-align: left;'>Concepto</th>
			<!--th scope='col' style='text-align: left;'>Cant</th-->
			<th scope='col' style='text-align: center;'>Fecha Emisión</th>
			<th scope='col' style='text-align: center;'>Comprobante</th>			
			<th scope='col' style='text-align: left;'>Cliente</th>
			<th scope='col' style='text-align: right;' >Montos</th>			
		</tr>
		</thead>";
	 	
 	while ($row=odbc_fetch_array($result6)){ 
 		
 		$it = $it+1;
 		$id_insumo = $row['ID_INSUMO'];
 		$axcodmovcz = $row['COD_MOV'];

 		$SQLCuenta = "SELECT count(ID_INSUMO) AS CANT FROM MAESTRO_1 WHERE ID_LOCAL='$axidlocal' AND ID_INSUMO='$id_insumo' AND COD_MOV='$axcodmovcz'";
 		$RSCuenta = odbc_exec($con, $SQLCuenta);

 		//echo $SQLCuenta;

 		$fila = odbc_fetch_array($RSCuenta);
 		$axcant = $fila['CANT'];
 		
 	echo "<tr>
			<td style='text-align: center;'>".$it."</td> 		
			<td style='text-align: left;'>".$row["NOM_CODIGOS"]."</td>
			<!--td style='text-align: right;' >".number_format($axcant,0,".",",")."</td-->
			<td style='text-align: center;'>".date("d-m-Y",strtotime($row["FECHA_EMISION"]))."</td>  				
			<td style='text-align: center;'>".$row["TXT_SERIE"].'-'.$row["DOCUMENTO"]."</td>
			<td style='text-align: left;'>".$row["NOM_PROVEEDOR"]."</td>
			<td style='text-align: right;' >".number_format($row["TOTAL_SALIDA"],2,".",",")."</td>
	";
 	}


 	if($axtipo_reporte=="TODOS"){

 		$SqlResumenGeneral ="SELECT SUM(TOTAL_SALIDA) AS TT FROM MAESTRO_1 WHERE FECHA_EMISION BETWEEN '$axdel' AND '$axal' AND ESTADO_ELECTRO ='PROCESADA' AND DETALLE_MOVIMIENTO='VENTA' AND ID_LOCAL='$axidlocal'";

 	}else{

 		$SqlResumenGeneral ="SELECT SUM(TOTAL_SALIDA) AS TT FROM  MAESTRO_1 WHERE FECHA_EMISION BETWEEN '$axdel' AND '$axal' AND ESTADO_ELECTRO ='PROCESADA' AND DETALLE_MOVIMIENTO='VENTA' AND ID_LOCAL='$axidlocal' AND NOM_CODIGOS='$axconcepto'";

 	}

 	
	$RSResumengenera=odbc_exec($con,$SqlResumenGeneral);
	$filaRes=odbc_fetch_array($RSResumengenera);


	echo "
 		<tr>
 			<th scope='col'style='text-align: right;' colspan='5'>Total </th>
 			<th scope='col'style='text-align: right;'>".number_format($filaRes["TT"],2,".",",")."</th>

 		</tr>";


	echo "</table>";

break;

case '27':
	
	$axidlocal = $_POST['txtidlocal']; 
	$axdel = $_POST['txtfecha_del']; 
	$axal = $_POST['txtfecha_al']; 
	

	$SQLCuentas = "SELECT DISTINCT(NOM_CODIGOS) AS NP FROM MAESTRO_1 WHERE FECHA_EMISION BETWEEN '$axdel' AND '$axal' AND ESTADO_ELECTRO ='PROCESADA' AND ID_LOCAL='$axidlocal' AND DETALLE_MOVIMIENTO='VENTA' ORDER BY NOM_CODIGOS ASC";	

	$RSTipodocumentos=odbc_exec($con,$SQLCuentas);

	echo $SQLCuentas;

	if(odbc_num_rows($RSTipodocumentos) > 0){
	
		while($fila=odbc_fetch_array($RSTipodocumentos)){

	   		echo '<option value='.$fila['NP'].'>'.$fila['NP'].'</option>';
    	}
		
	} else {

		echo "";	
	
	}

	break;

	case '28':
	

	$axidlocal = $_POST['txtidlocal']; 
	$axnserie = $_POST['txtnserie']; 
	$axnum_correlativo = $_POST['txtcorrelativo']; 
	$axdocumento_tipo = $_POST['axdocumento_tipo']; 

	//SELECT ID_DT,DETALLE_DOC,TXT_SERIE,DOCUMENTO FROM MAESTRO_1 WHERE ID_LOCAL ='3' AND TXT_SERIE='B003' AND DOCUMENTO ='00000784'
	$SQLTipodocumentos = "SELECT * FROM MAESTRO_1 WHERE ID_LOCAL ='$axidlocal' AND DETALLE_DOC='$axdocumento_tipo' AND TXT_SERIE='$axnserie' AND DOCUMENTO ='$axnum_correlativo'";
	//echo $SQLTipodocumentos;
	$result1=odbc_exec($con,$SQLTipodocumentos);

	if(odbc_num_rows($result1) > 0) {
    
    	$respuesta = 0; //existe
    	echo $respuesta;

      
	 } else {

	 	$respuesta = 1; //no existe
    	echo $respuesta;

  	}	
	

	break;



case '29':

$axcodmovcz = $_POST['txtcodmovprof']; 
$axidlocal = $_POST['txtidlocal']; 

$SQLDelete = "DELETE FROM PROFORMA WHERE COD_MOV_PRF='$axcodmovcz' and ID_LOCAL='$axidlocal'";
$RSDelete = odbc_exec($con, $SQLDelete);

//echo $SQLDelete;

if($RSDelete){
	
	$respuesta = 0; //existe
   	echo $respuesta;

}else{
			
	$respuesta = 1; //no existe
    echo $respuesta;

}

break;

case '30':
	
	$axcod_barra= $_POST['txtcod_barra'];
	$axidlocal= $_POST['txtidlocal'];
	
	$sql6 = "SELECT * FROM STOCK_ACTUAL_1 WHERE ID_LOCAL='$axidlocal' AND COD_BARRA='$axcod_barra'";
	
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

case '32':
	
	$axidlocal = $_POST['txtidlocal']; 
	$axcodproformacz = $_POST['txtcodmovprof']; 

	$SQLTipodocumentos = "SELECT * FROM ORDEN_COMPRA_REPORTE_CZ WHERE COD_MOV_PRF ='$axcodproformacz' ORDER BY COD_MOV_PRF" ;
	$result1=odbc_exec($con,$SQLTipodocumentos);

	if(odbc_num_rows($result1) > 0) {
    
      $axlistaprov1 = odbc_fetch_object($result1);
      $axlistaprov1 ->status =200;
      echo json_encode($axlistaprov1);
      
  } else {

  		$error = array('status'=> 400);
  		echo json_encode((object) $error);
  }	

break;

case '33':
	
	$axidlocal = $_POST['txtidlocal']; 
	$axcodproformacz = $_POST['txtcodmovprof'];

	$SQLActualizar = "UPDATE PROFORMA SET TIPO_PROFORMA='PEDIDO' WHERE COD_MOV_PRF='$axcodproformacz'  AND ID_LOCAL='$axidlocal'";
	$RSActualizar = odbc_exec($con,$SQLActualizar);
	//echo $SQLActualizar;


	if ($RSActualizar){
		$respuesta= 0;
		echo $respuesta;
	}else{
		$respuesta= 1;
		echo $respuesta;
	}


break;

case '34':

	$axidlocal = $_POST['txtidlocal']; 
	$axcodproformacz = $_POST['txtcodmovprof'];

	$SQLActualizar = "UPDATE PROFORMA SET TIPO_PROFORMA='ORDEN_COMPRA' WHERE COD_MOV_PRF='$axcodproformacz' AND ID_LOCAL='$axidlocal'";
	$RSActualizar = odbc_exec($con,$SQLActualizar);
	//echo $SQLActualizar;


	if ($RSActualizar){
		$respuesta= 0;
		echo $respuesta;
	}else{
		$respuesta= 1;
		echo $respuesta;
	}

break;


case '35':

	$local = $_POST['txtidlocal']; 
	$tipo = $_POST['txttipo_ORDEN_COMPRA'];
	$ano = date('Y');
	$axultimo = contarRegistros($local,$tipo)+1;
	$axnum_cotizcion = 'CT-'.number_pad($axultimo,5).'-'.$ano;

	echo trim($axnum_cotizcion);

break;

case '36':

	$axcodusuario = $_POST['txtcodusuario']; 
	$axidlocal = $_POST['txtidlocal'];
	$axtipo_ORDEN_COMPRA = $_POST['txttipo_ORDEN_COMPRA'];
	$axcodmovprof = trim($_POST['txtcodmovprof']);
	

	$sql ="INSERT INTO ORDEN_COMPRA_CZ (ID_LOCAL,TIPO_ORDEN_COMPRA,ID_USUARIO,COD_MOV_PRF)VALUES('$axidlocal','$axtipo_ORDEN_COMPRA','$axcodusuario','$axcodmovprof')";
	$rsql = odbc_exec($con,$sql);

	if ($rsql){
		$respuesta= 0;
		echo $respuesta;
	}else{
		$respuesta= 1;
		echo $respuesta;
	}



	/*
id_beneficiario
estado_ORDEN_COMPRA
forma_pago
fecha_vencimiento


comentarios
telefono
cod_mov_prf
id_dt
medio_pago
estado_forma_pago
estado_atendido
nom_cliente_prof
*/

break;

case '37':
	
$axcod_mov = generateRandomCode();

echo $axcod_mov;


break;

}

function generateRandomCode($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomCode = '';
    
    for ($i = 0; $i < $length; $i++) {
        $randomCode .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomCode;
}


function contarRegistros($local,$tipo) {
    global $con;
    $querysql = "SELECT COUNT(NUM_ORDEN_COMPRA) as total FROM ORDEN_COMPRA_CZ WHERE ID_LOCAL='$local' AND TIPO_ORDEN_COMPRA='$tipo'";
    //echo $querysql.'<br>';
    $query = odbc_exec($con, $querysql);
    $rw = odbc_fetch_array($query);
    $value = $rw['total'];
    return $value;
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

function obtenerErrorDeJSON()
{
    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            return "No ha ocurrido ningún error";
        case JSON_ERROR_DEPTH:
            return "Se ha excedido la profundidad máxima de la pila.";
        case JSON_ERROR_STATE_MISMATCH:
            return "Error por desbordamiento de buffer o los modos no coinciden";
        case JSON_ERROR_CTRL_CHAR:
            return "Error del carácter de control, posiblemente se ha codificado de forma incorrecta.";
        case JSON_ERROR_SYNTAX:
            return "Error de sintaxis.";
        case JSON_ERROR_UTF8:
            return "Caracteres UTF-8 mal formados, posiblemente codificados incorrectamente.";
        case JSON_ERROR_RECURSION:
            return "El objeto o array pasado a json_encode() incluye referencias recursivas y no se puede codificar.";
        case JSON_ERROR_INF_OR_NAN:
            return "El valor pasado a json_encode() incluye NAN (Not A Number) o INF (infinito)";
        case JSON_ERROR_UNSUPPORTED_TYPE:
            return "Se proporcionó un valor de un tipo no admitido para json_encode(), tal como un resource.";
        default:
            return "Error desconocido";
    }
}


?>



