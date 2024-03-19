<?php  

//require('../Imprimir/pdf_js.php');

require('../Imprimir/Classes/PHPExcel/IOFactory.php');
require('../Imprimir/pdf_js.php');


require('../phpqrcode/qrlib.php');
require_once '../core2.php';


$param=$_POST['param'];


switch ($param) {


case '0': // listar usuarios

 $axbuscar_dato = $_POST["txtbuscar_distrito"];   
 if(isset($_POST["txtbuscar_distrito"])){

	$output ="";
	$idprov ="";
	$sqlemisor = "SELECT TOP 10 * FROM UBIGEOS_PERU WHERE UBIGEO_PERU LIKE  '%".$axbuscar_dato."%' ORDER BY UBIGEO_PERU";
	//echo $sqlemisor;

	$rsemisor=odbc_exec($con,$sqlemisor);	
	$output ='<ul class="list-group">';  		

	if(odbc_num_rows($rsemisor) > 0){
		 while ($row=odbc_fetch_array($rsemisor)){		
		 	$id =  $row["UBIGEO_REINEC"];
		 	$nom_prod =  trim($row["UBIGEO_PERU"]);
		 	$axprovincia =  trim($row["PROVINCIA"]);
		 	$axdepartamento =  trim($row["DEPARTAMENTO"]);
		 	$axdistrito =  trim($row["DISTRITO"]);
		 	
		 	$output .='<a href="#" id="btn_lista_ubigeos" class="list-group-item list-group-item-action" style="background:#DAF5FF;" data-id='.$id.' data-prov='.$axprovincia.' data-departamento='.$axdepartamento.' data-distrito='.$axdistrito.' >'.utf8_encode(trim($row["UBIGEO_PERU"])).'</a>';
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

case '1':
	
$axubigeo_py= $_POST['txtubigeo_py'];
	
	$sql6 = "SELECT * FROM UBIGEOS_PERU WHERE UBIGEO_REINEC = '$axubigeo_py'";
	
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

case '2':

date_default_timezone_set("America/Lima");
$axfecha_actual = date('Y-m-d');

$axid_empresa = $_POST['txtid_empresa'];	
$axid_proyecto = $_POST['txtid_proyecto'];
$axubigeo_py = $_POST['txtubigeo_py'];
$axfecha_registro_py = $axfecha_actual;
$axcodigo_py = $_POST['txtcodigo_py'];
$axdescripcion_py = $_POST['txtdescripcion_py'];
$axnombre_corto_py = $_POST['txtnombre_corto_py'];
$axestado_py = $_POST['txtestado_py'];
$axubicacion_py = $_POST['txtubicacion_py'];
$axdistrito_py = $_POST['txtdistrito_py'];
$axprovincia_py = $_POST['txtprovincia_py'];
$axdepartamento_py = $_POST['txtdepartamento_py'];
$axcontacto_py = $_POST['txtcontacto_py'];
$axubicacion_digital_mapa = $_POST['txtubicacion_digital_mapa'];

$axunida_catastral = $_POST['txtunida_catastral'];
$axpartida_registral = $_POST['txtpartida_registral'];
$axfecha_entrega_py = $_POST['axfecha_entrega_pytxtfecha_entrega_py'];

$axparametros = $_POST['txtparametros'];

if($axparametros==0){

	$nombreCarpeta = $axnombre_corto_py;
	crearCarpeta($nombreCarpeta);

	$sqlgrabar = "INSERT INTO MK_PROYECTOS (CODIGO_PY,DESCRIPCION_PY,UBICACION_PY,DISTRITO_PY,PROVINCIA_PY,UBIGEO_PY,CONTACTO_PY,FECHA_REGISTRO_PY,NOMBRE_CORTO_PY,ESTADO_PY,ID_EMPRESA,DEPARTAMENTO_PY,UBICACION_DIGITAL_MAPA,UNIDAD_CATASTRAL,PARTIDA_REGISTRAL,FECHA_ENTREGA_PY,NOM_CARPETA) VALUES ('$axcodigo_py','$axdescripcion_py','$axubicacion_py','$axdistrito_py','$axprovincia_py','$axubigeo_py','$axcontacto_py','$axfecha_registro_py','$axnombre_corto_py','$axestado_py','$axid_empresa','$axdepartamento_py','$axubicacion_digital_mapa','$axunida_catastral','$axpartida_registral','$axfecha_entrega_py','$nombreCarpeta')";

		$detalle='AGREGO EL PROYECTO '.$axdescripcion_py;	


}else{

	$sqlgrabar ="UPDATE MK_PROYECTOS SET CODIGO_PY='$axcodigo_py',DESCRIPCION_PY='$axdescripcion_py',UBICACION_PY='$axubicacion_py',DISTRITO_PY='$axdistrito_py',PROVINCIA_PY='$axprovincia_py',UBIGEO_PY='$axubigeo_py',CONTACTO_PY='$axcontacto_py',FECHA_REGISTRO_PY='$axfecha_registro_py',NOMBRE_CORTO_PY='$axnombre_corto_py',ESTADO_PY='$axestado_py',ID_EMPRESA='$axid_empresa',DEPARTAMENTO_PY='$axdepartamento_py',UBICACION_DIGITAL_MAPA='$axubicacion_digital_mapa', UNIDAD_CATASTRAL='$axunida_catastral',PARTIDA_REGISTRAL='$axpartida_registral',FECHA_ENTREGA_PY='$axfecha_entrega_py' WHERE ID_PROYECTO='$axid_proyecto'";

		$detalle='EDITO EL PROYECTO '.$axdescripcion_py;


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

case '3':
	
$axidempresa = $_POST['txtid_empresa']; 
	$axbuscaregistro = $_POST['txtbuscar_proyecto']; 
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

  		$sql6 ="SELECT TOP 20 *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' ORDER BY ID_PROYECTO ASC";	
  		$axcontador = 20 .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>';

	  	}elseif($axtotal_registros < 20){

	  		$sql6 ="SELECT TOP $axtotal_registros *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' ORDER BY ID_PROYECTO ASC";
	  		$axcontador = $axtotal_registros .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>';
	  	}
	 	

  	}

  	

  }else{

  	$sql6 ="SELECT *, COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' AND DESCRIPCION_PY+' '+ESTADO_PY like '%".$axbuscaregistro."%' ORDER BY ID_PROYECTO ASC";
  }
	

	}elseif($axtipoorden=='TODOS'){

		if($axtipo_busqueda=='ORDENAR'){
			$sql6 ="SELECT TOP $axtotal_registros *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' ORDER BY $axcampo_tabla_orden $axorden";  		
			$axcontador = $axtotal_registros .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>';	
		}else{
			$sql6 ="SELECT TOP $axtotal_registros *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' ORDER BY ID_PROYECTO ASC";  		
			$axcontador = $axtotal_registros .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>';	
		}

		
	}

  
	//echo $sql6;
	$RSListar_c = odbc_exec($con, $sql6);
	 $fila_c = odbc_fetch_array($RSListar_c);
   $axcant_registros = $fila_c['cant_registros']; 

   if($axtipo_busqueda=='FILTRAR' || $axtipo_busqueda=='ORDENAR'){

   	$axcontador = $axcant_registros .' de '.$axtotal_registros; 

   	//$axcontador = $axcant_registros .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>';	
   }
   
	$RSListar = odbc_exec($con,$sql6);

if( odbc_num_rows($RSListar) > 0 ){
	$axicon_claro ='bi bi-funnel';
	$axicon_oscuro ='bi bi-funnel-fill';
	echo "
	<!--div style='text-align: left;'>
        <div class='btn-group btn-group-sm' role='group' aria-label='Small button group' >
        <button type='button' id='btn_py_activos' data-tipoorden='ACTIVO' data-filtro_buscar='ACTIVO' class='btn btn-outline-success'><i class='bi bi-check-circle-fill' style='font-size:15pX;'></i>  ACTIVOS</button>
        <button type='button' id='btn_py_inactivos' data-tipoorden='INACTIVO' data-filtro_buscar='INACTIVO' class='btn btn-outline-danger'><i class='bi bi-dash-circle-fill' style='font-size:15pX;'></i> INACTIVOS</button>
        <button type='button' id='btn_py_todos' data-tipoorden='TODOS' data-filtro_buscar='' class='btn btn-outline-warning'><i class='bi bi-database-fill-gear' style='font-size:15pX;'></i> TODOS</button>
        </div>
    </div>
    <br-->
<table class='table table-hover table-sm'>
	<thead class='table-primary'>	
	 	<tr class='table-secondary'>

	 		<th  style='text-align: center;' > <a href='#' id='btn_prospectos_todos' data-tipoorden='TODOS' style='text-decoration:none; color:black;' title='Click para visualizar todos...'><i class='bi bi-arrow-clockwise' style='font-size:15px;'></i> Ver 	todos </a> </th>

            <th  style='text-align: right;' colspan ='13' >Mostrando $axcontador registros</th>         
        </tr>
		<tr>
			<th style='text-align: center;'>Nº</th>		
			<th style='text-align: left;'>NOMBRE DE PROYECTO</th>
			<th style='text-align: left;'>DIRECCION</th>
			<th style='text-align: center;'>TOTAL</th>
			<th style='text-align: center;'>DISPONIBLES</th>
			<th style='text-align: center;'>SEPARADOS</th>
			<th style='text-align: center;'>VENDIDOS</th>	
			<th style='text-align: center;'>ESTADO</th>
			<th style='text-align: center;'>ACCION</th>
		</tr>

		
	</thead>";

	while ($fila =  odbc_fetch_array($RSListar)) {
		
		$it= $it+1;
		$axid_py = $fila['ID_PROYECTO'];		
		$axnom_py = $fila['DESCRIPCION_PY'];
		$axubicacion_py = $fila['UBICACION_PY'];
		$axestado_py = $fila['ESTADO_PY'];

		$disponible ='DISPONIBLE';
		$vendido ='VENDIDO';
		$separado ='SEPARADO';

		$axdisponibles = $fila['DISPONIBLE'];
		$axvendido = $fila['VENDIDO'];
		$axseparado = $fila['SEPARADO'];
		$axtotal = $fila['TOTAL'];


		echo "
 		<tr>
 			<td style='text-align: center;' >$axid_py</td>
 			<td style='text-align: left;' >$axnom_py</td>
 			<td style='text-align: left;' >$axubicacion_py</td> 			
 			<td style='text-align: center;' ><b class='text-success'>$axtotal</b></td>
 			<td style='text-align: center;' ><a href='#' id='btn_ver_detalles' data-id='$axid_py' data-estado='$disponible' style='text-decoration:none;'><b class='text-danger'>$axdisponibles</b></a></td>
 			<td style='text-align: center;' ><a href='#' id='btn_ver_detalles' data-id='$axid_py' data-estado='$separado' style='text-decoration:none;'><b class='text-warning'>$axseparado</b></a></td>
 			<td style='text-align: center;' ><a href='#' id='btn_ver_detalles' data-id='$axid_py' data-estado='$vendido' style='text-decoration:none;'><b class='text-success'>$axvendido</b></a></td>
 			
 			<td style='text-align: center;' >$axestado_py</td>

 			<td style='text-align: center;'>
 				<div class='btn-group dropstart'>
					<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
					<ul class='dropdown-menu'>	
					<!--div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-primary' id='btn_ver_py' data-id='$axid_py'><b><i class='bi bi-eye'></i> Ver</a></b-->

					<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-info' id='btn_editar_py' data-id='$axid_py' data-bs-toggle='modal' data-bs-target='#exampleModal'><b><i class='bi bi-pencil' ></i> Editar</a></b>
					<!--a href='#' class='dropdown-item text-danger' id='btn_eliminar_py' data-id='$axid_py' ><b><i class='bi bi-trash3-fill'></i> Eliminar</a></b-->
					<div><hr class='dropdown-divider'></div>

					<!--a href='#' class='dropdown-item text-danger' id='btn_subir_plano_py' data-tipo='plano' data-id='$axid_py' ><b><i class='bi bi-cloud-arrow-up-fill'></i> Subir Plano</a></b>

					<a href='#' class='dropdown-item text-danger' id='btn_subir_logo_py' data-tipo='logo' data-id='$axid_py' ><b><i class='bi bi-cloud-arrow-up-fill'></i> Subir Logo</a></b-->

					<a href='#' class='dropdown-item text-success' id='btn_subir_productos_py' data-tipo='productos' data-id='$axid_py' ><b><i class='bi bi-cloud-arrow-up-fill'></i> Subir Lotes</a></b>


					<div><hr class='dropdown-divider'></div>

					</ul>
				</div>

 			</td> 

 		</tr>";
	}

	echo"</table>";

} else{

	echo "<table class='table table-hover table-sm'>
	<thead class='table-primary'>	
	 	<tr class='table-secondary'>
            <th  style='text-align: right;' colspan ='13' >Mostrando $axcontador registros</th>         
        </tr>
		<tr>
			<th style='text-align: center;'>Nº</th>		
			<th style='text-align: left;'>NOMBRE DE PROYECTO</th>
			<th style='text-align: left;'>DIRECCION</th>
			<th style='text-align: center;'>TOTAL</th>
			<th style='text-align: center;'>DISPONIBLES</th>
			<th style='text-align: center;'>SEPARADOS</th>
			<th style='text-align: center;'>VENDIDOS</th>	
			<th style='text-align: center;'>ESTADO</th>
			<th style='text-align: center;'>ACCION</th>
		</tr>

		
	</thead>";
}

break;

case '4':
	
$axid_proyecto= $_POST['txtid_proyecto'];
	
	$sql6 = "SELECT * FROM MK_PROYECTOS WHERE ID_PROYECTO = '$axid_proyecto'";
	
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
	
$axid_proyecto= $_POST['txtid_proyecto'];
$axdescripcion_py = get_row('MK_PROYECTOS','DESCRIPCION_PY','ID_PROYECTO',$axid_proyecto);

	$sql6 = "DELETE FROM MK_PROYECTOS WHERE ID_PROYECTO = '$axid_proyecto'";
	$rsgrabar=odbc_exec($con,$sql6);

	if($rsgrabar){

		/***************************************/
		    $id_user =$_POST['txtid_usuario'];
		    $modulo = $_POST['txtmodulo'];	    
		    $detalle='ELIMINO EL PROYECTO '.$axdescripcion_py;
		    guardar_bitacora($id_user,$modulo,$detalle);
		/***************************************/


		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;
	}


break;

case '6':

$axid_proyecto = $_POST['txtid_proyecto'];	
$axcodigo_py = $_POST['txtcodigo_py'];	
$axtipo_caracteristica = $_POST['txttipo_caracteristica'];

if($axid_proyecto==''){
	$axid_proyecto = get_row('MK_PROYECTOS','ID_PROYECTO','CODIGO_PY',$axcodigo_py);
}

if($axtipo_caracteristica ==''){
	$SQLListar ="SELECT * FROM MK_PROYECTOS_DT WHERE ID_PROYECTO ='$axid_proyecto' ORDER BY ID_DETALLE ASC";
}else{
	$SQLListar ="SELECT * FROM MK_PROYECTOS_DT WHERE ID_PROYECTO ='$axid_proyecto' AND TIPO_CARACTERISTICA LIKE '%".$axtipo_caracteristica."%' ORDER BY ID_DETALLE ASC";
}

//echo $SQLListar;
$RSListar = odbc_exec($con,$SQLListar);

if( odbc_num_rows($RSListar) > 0 ){

	echo "
	<div id='div1'>
<table class='table table-hover table-sm'>
	<thead class='table-primary'>			
		<tr>
			<th style='text-align: center;'>Nº</th>			
			<th style='text-align: left;'>CARACTERISTICAS</th>
			<th style='text-align: left;'>DESCRIPCION</th>
			<th style='text-align: center;'>ESTADO</th>
			<th style='text-align: center;'>ACCION</th>
		</tr>
	</thead>";

	while ($fila =  odbc_fetch_array($RSListar)) {
		
		$it= $it+1;	
		$axid_detalle = $fila['ID_DETALLE'];
		$axid_proyecto = $fila['ID_PROYECTO'];		
		$axtipo_caracteristica = $fila['TIPO_CARACTERISTICA'];
		$axnom_caracteristicas = $fila['NOM_CARACTERISTICAS'];
		$axestado_caracteristica = $fila['ESTADO_CARACTERISTICA'];
		$axdetalle = $fila['DETALLE'];
		$axfile = $fila['ARCHIVO_SUSTENTO'];
		$axripo_file= $fila['TIPO_FILE'];		

		echo "
 		<tr>
 			<td style='text-align: center;' >$it</td>";
 			
 			if($axfile ==''){
 				
 				echo"<td style='text-align: left;' >$axnom_caracteristicas</td>";

 			}else{

 				if($axripo_file=='application/pdf'){

 				echo "
	 				<td style='text-align: left;'>
	 				<a href='#' style='text-decoration: none;' id='btn_descargar_documento' data-nomarchivo='$axfile' title='Click para descargar archivo...'><i class='bi bi-file-earmark-pdf-fill' style='color:red;'></i> ".$axnom_caracteristicas." </a>
	 				</td>";

				}else{

					echo"<td style='text-align: left;' >					
						<a href='Descargar_file.php?archivo=$axfile' style='text-decoration:none;'title='Click para descargar archivo...'> <i class='bi bi-cloud-arrow-down-fill'></i> $axnom_caracteristicas</a>

					</td>";
				}


 				
 			}


 		echo"
 			<td style='text-align: left;' >$axdetalle</td>
 			<td style='text-align: center;' >$axestado_caracteristica</td> 			
 			<td style='text-align: center;'>"; 			

 			if($axtipo_caracteristica=='DOCUMENTACION'){

 				echo "<div class='btn-group dropstart' style='font-size:12px;'>
				<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
				<ul class='dropdown-menu'>	
				<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-info' id='btn_editar_detalle_py' data-id='$axid_detalle' ><b><i class='bi bi-pencil' style='font-size:15px;'></i> Editar </b></a>

					<a href='#' class='dropdown-item text-danger' id='btn_eliminar_detalle_py' data-id='$axid_detalle' ><b><i class='bi bi-trash3-fill' style='font-size:15px;'></i> Eliminar </b></a>

				<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-success' id='btn_subir_documentos' data-iddt='$axid_detalle' data-id='$axid_proyecto' ><b><i class='bi bi-cloud-arrow-up-fill'></i> Subir Doc</a></b>

				<div><hr class='dropdown-divider'></div>
				</ul>
			</div>";

 			}else{

 				echo "<div class='btn-group dropstart' style='font-size:12px;'>
				<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
				<ul class='dropdown-menu'>	
				<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-info' id='btn_editar_detalle_py' data-id='$axid_detalle' ><b><i class='bi bi-pencil' style='font-size:15px;'></i> Editar </b></a>

					<a href='#' class='dropdown-item text-danger' id='btn_eliminar_detalle_py' data-id='$axid_detalle' ><b><i class='bi bi-trash3-fill' style='font-size:15px;'></i> Eliminar </b></a>
					
				<div><hr class='dropdown-divider'></div>
				</ul>
			</div>";

 				
 			}
			 			

 		echo"</td>
 		</tr>";
	}

	echo"</table>
	</div>";

} else{

	echo "";
}

break;
case '7':

$axid_detalle = $_POST['txtid_detalle'];
$axid_proyecto = $_POST['txtid_proyecto'];
$axtipo_caracteristica = $_POST['txttipo_caracteristica'];
$axestado_caracteristica = $_POST['txtestado_caracteristica'];
$axnom_caracteristicas = $_POST['txtnom_caracteristicas'];
$axdetalle = $_POST['txtdetalle'];
$axparametros_detalle = $_POST['txtparametros_detalle'];
$axcodigo_py = $_POST['txtcodigo_py'];
$axdescripcion_py = get_row('MK_PROYECTOS','DESCRIPCION_PY','ID_PROYECTO',$axid_proyecto);

if($axparametros_detalle==0){

	$axid_proyecto = get_row('MK_PROYECTOS','ID_PROYECTO','CODIGO_PY',$axcodigo_py);

	$sqlgrabar = "INSERT INTO MK_PROYECTOS_DT (ID_PROYECTO,TIPO_CARACTERISTICA,NOM_CARACTERISTICAS,ESTADO_CARACTERISTICA,DETALLE) VALUES ('$axid_proyecto','$axtipo_caracteristica','$axnom_caracteristicas','$axestado_caracteristica','$axdetalle')";

	$detalle='AGREGO '.$axtipo_caracteristica.' '.$axnom_caracteristicas.' '.$axdetalle.', AL PROYECTO '.$axdescripcion_py;


}else{

	$sqlgrabar ="UPDATE MK_PROYECTOS_DT SET ID_PROYECTO='$axid_proyecto',TIPO_CARACTERISTICA='$axtipo_caracteristica',NOM_CARACTERISTICAS='$axnom_caracteristicas',ESTADO_CARACTERISTICA='$axestado_caracteristica',DETALLE='$axdetalle' WHERE ID_DETALLE ='$axid_detalle '";
}

$RSGrabar = odbc_exec($con,$sqlgrabar);
//echo  $sqlgrabar;

if($RSGrabar){


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


case '8':

$axbuscar_dato = $_POST["txtnom_caracteristicas"];   
$axtipo_caracteristica = $_POST["txttipo_caracteristica"];   

 if(isset($_POST["txtnom_caracteristicas"])){

	$output ="";
	$idprov ="";
	$sqlemisor = "SELECT NOM_CARACTERISTICAS FROM MK_PROYECTOS_DT WHERE TIPO_CARACTERISTICA='$axtipo_caracteristica' AND NOM_CARACTERISTICAS LIKE  '%".$axbuscar_dato."%' GROUP BY NOM_CARACTERISTICAS";
	//echo $sqlemisor;

	$rsemisor=odbc_exec($con,$sqlemisor);	
	$output ='<ul class="list-group">';  		

	if(odbc_num_rows($rsemisor) > 0){
		 while ($row=odbc_fetch_array($rsemisor)){		
		 		 	
		 	$output .='<a href="#" id="btn_caracteristcias" class="list-group-item list-group-item-action" style="background:#DAF5FF;">'.utf8_encode(trim($row["NOM_CARACTERISTICAS"])).'</a>';
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

case '9':

	$axid_proyecto= $_POST['txtid_proyecto'];
	$axid_detalle= $_POST['txtid_detalle'];
	
	$sql6 = "SELECT * FROM MK_PROYECTOS_DT WHERE ID_PROYECTO = '$axid_proyecto' AND ID_DETALLE='$axid_detalle'";
	
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

$axid_proyecto = $_POST["txtid_proyecto"];  
$axbuscar_producto = $_POST["txtbuscar_producto"];  
$axcodigo_py = $_POST["txtcodigo_py"];  

if($axid_proyecto==''){
	$axid_proyecto = get_row('MK_PROYECTOS','ID_PROYECTO','CODIGO_PY',$axcodigo_py);	
}


if($axbuscar_producto ==''){
$SQLListar = "SELECT * FROM  MK_PROYECTOS_PRODUCTOS WHERE ID_PROYECTO='$axid_proyecto' ORDER BY ID_PRODUCTO ASC";
}else{
$SQLListar = "SELECT * FROM  MK_PROYECTOS_PRODUCTOS WHERE ID_PROYECTO='$axid_proyecto' AND UBIC_MZ+''+UBIC_LOTE LIKE '%".$axbuscar_producto."%' ORDER BY ID_PRODUCTO ASC";
}


$RSListar = odbc_exec($con,$SQLListar);

if(odbc_num_rows($RSListar) > 0 ){

	echo "<div class='div3'>
	<table class='table table-hover table-sm'>
	<thead class='table-primary'>			
		<tr>
			<th style='text-align: center;'>Nº</th>	
			<th style='text-align: center;'>ESTADO</th>		
			<th style='text-align: center;'>MANZANA</th>
			<th style='text-align: center;'>LOTE</th>
			<th style='text-align: center;'>FRENTE</th>
			<th style='text-align: center;'>FONDO</th>
			<th style='text-align: center;'>DERECHA</th>
			<th style='text-align: center;'>IZQUIERDA</th>
			<th style='text-align: center;'>PERIMETRO</th>
			<th style='text-align: center;'>AREA M2</th>
			<th style='text-align: center;'>PRECIO LISTA</th>
			<th style='text-align: center;'>ACCION</th>
		</tr>
	</thead>";

	while ($fila = odbc_fetch_array($RSListar)) {

		$it = $it+1;
		$id_producto = $fila['ID_PRODUCTO'];
		$id_proyecto = $fila['ID_PROYECTO'];
		$cod_producto = $fila['COD_PRODUCTO'];
		$tipo_producto = $fila['TIPO_PRODUCTO'];
		//$ubic_mz = $fila['UBIC_MZ'];
		$ubic_mz = htmlspecialchars($fila['UBIC_MZ']);
		$ubic_lote = $fila['UBIC_LOTE'];
		$med_frente = $fila['MED_FRENTE'];
		$med_fondo = $fila['MED_FONDO'];
		$med_derecha = $fila['MED_DERECHA'];
		$med_izquierda = $fila['MED_IZQUIERDA'];
		$med_perimetro = $fila['MED_PERIMETRO'];
		$area_m2 = $fila['AREA_M2'];
		$ubic_plano = $fila['UBIC_PLANO'];
		$precio_lista = number_format($fila['PRECIO_LISTA'],2,".",",");
		$estado_producto = $fila['ESTADO_PRODUCTO'];
		
		echo "<tr>
			<td style='text-align: center;'>$it</td>	
			<td style='text-align: center;'>$estado_producto</td>	
			<td style='text-align: center;'>$ubic_mz</td>	
			<td style='text-align: center;'>$ubic_lote</td>	
			<td style='text-align: center;'>$med_frente</td>	
			<td style='text-align: center;'>$med_fondo</td>	
			<td style='text-align: center;'>$med_derecha</td>	
			<td style='text-align: center;'>$med_izquierda</td>	
			<td style='text-align: center;'>$med_perimetro</td>
			<td style='text-align: center;'>$area_m2</td>
			<td style='text-align: center;'>$precio_lista</td>
			<td style='text-align: center;'>

				<div class='btn-group dropstart'>
					<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
					<ul class='dropdown-menu'>	
					<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-info' id='btn_editar_producto_py' data-id='$id_producto'><b><i class='bi bi-pencil' ></i> Editar</a></b>
					<a href='#' class='dropdown-item text-danger' id='btn_eliminar_producto_py' data-id='$id_producto' ><b><i class='bi bi-trash3-fill'></i> Eliminar</a></b>
					<div><hr class='dropdown-divider'></div>

					</ul>
				</div>



			</td>
		<tr>";
	}

	echo "</table>
	</div>";

}else{

	echo '';
}

break;

case '11':
	
	$axid_producto =$_POST['txtid_producto'];
	$axcodigo_py =$_POST['txtcodigo_py'];
	$axid_proyecto =$_POST['txtid_proyecto'];
	$axcod_producto =$_POST['txtcod_producto'];	
	$axtipo_producto =$_POST['txttipo_producto'];	
	$axubic_mz =$_POST['txtubic_mz'];
	$axubic_lote =$_POST['txtubic_lote'];
	$axmed_frente =$_POST['txtmed_frente'];
	$axmed_fondo =$_POST['txtmed_fondo'];
	$axmed_derecha =$_POST['txtmed_derecha'];
	$axmed_izquierda =$_POST['txtmed_izquierda'];
	$axmed_perimetro =$_POST['txtmed_perimetro'];
	$axarea_m2 =$_POST['txtarea_m2'];
	$axubic_plano =$_POST['txtubic_plano'];
	$axprecio_lista =$_POST['txtprecio_lista'];
	$axestado_producto =$_POST['txtestado_producto'];
	$axparametros_producto =$_POST['txtparametros_producto'];
	$axdescripcion_py = get_row('MK_PROYECTOS','DESCRIPCION_PY','ID_PROYECTO',$axid_proyecto);
	
	
	if($axparametros_producto==0){

		$axid_proyecto = get_row('MK_PROYECTOS','ID_PROYECTO','CODIGO_PY',$axcodigo_py);

		$sqlgrabar ="INSERT INTO MK_PROYECTOS_PRODUCTOS (ID_PROYECTO,COD_PRODUCTO,TIPO_PRODUCTO,UBIC_MZ,UBIC_LOTE,MED_FRENTE,MED_FONDO,MED_DERECHA,MED_IZQUIERDA,MED_PERIMETRO,AREA_M2,UBIC_PLANO,PRECIO_LISTA,ESTADO_PRODUCTO) VALUES ('$axid_proyecto','$axcod_producto','$axtipo_producto','$axubic_mz','$axubic_lote','$axmed_frente','$axmed_fondo','$axmed_derecha','$axmed_izquierda','$axmed_perimetro','$axarea_m2','$axubic_plano','$axprecio_lista','$axestado_producto')";

			$detalle='AGREGO EL PRODUCTO '.$axubic_mz.'-'.$axubic_lote.', AL PROYECTO '.$axdescripcion_py;

	}else{
		$sqlgrabar = "UPDATE MK_PROYECTOS_PRODUCTOS SET ID_PROYECTO='$axid_proyecto',COD_PRODUCTO='$axcod_producto',TIPO_PRODUCTO='$axtipo_producto',UBIC_MZ='$axubic_mz',UBIC_LOTE='$axubic_lote',MED_FRENTE='$axmed_frente',MED_FONDO='$axmed_fondo',MED_DERECHA='$axmed_derecha',MED_IZQUIERDA='$axmed_izquierda',MED_PERIMETRO='$axmed_perimetro',AREA_M2='$axarea_m2',UBIC_PLANO='$axubic_plano',PRECIO_LISTA='$axprecio_lista',ESTADO_PRODUCTO='$axestado_producto' WHERE ID_PRODUCTO='$axid_producto'";

			$detalle='ACTUALIZO LOS DATOS DEL PRODUCTO '.$axubic_mz.'-'.$axubic_lote.', DEL PROYECTO '.$axdescripcion_py;
	}

	$rsgrabar = odbc_exec($con,$sqlgrabar);
	//echo $sqlgrabar;

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

case '12':
	
$axid_producto= $_POST['txtid_producto'];
	
$sql6 = "SELECT * FROM MK_PROYECTOS_PRODUCTOS WHERE ID_PRODUCTO = '$axid_producto'";	
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
case '13':

	$axid_producto = $_POST["txtid_producto"];  
	$axid_proyecto = $_POST["txtid_proyecto"];  
	$axdescripcion_py = get_row('MK_PROYECTOS','DESCRIPCION_PY','ID_PROYECTO',$axid_proyecto);
	$axubic_mz = get_row('MK_PROYECTOS_PRODUCTOS','UBIC_MZ','ID_PRODUCTO',$axid_producto);
	$axubic_lote = get_row('MK_PROYECTOS_PRODUCTOS','UBIC_LOTE','ID_PRODUCTO',$axid_producto);

	$SQLEliminar = "DELETE FROM MK_PROYECTOS_PRODUCTOS WHERE ID_PRODUCTO='$axid_producto'";
	$RSEliminar = odbc_exec($con,$SQLEliminar);

	if($RSEliminar ){

		/***************************************/
	   	$id_user =$_POST['txtid_usuario'];
	   	$modulo = $_POST['txtmodulo'];	    
	   	$detalle='ELIMINO EL PRODUCTO '.$axubic_mz.'-'.$axubic_lote.', DEL PROYECTO '.$axdescripcion_py;

	   	guardar_bitacora($id_user,$modulo,$detalle);
		/***************************************/

		$respuesta =0;
		echo $respuesta;
	}else{
		$respuesta =1;
		echo $respuesta;
	}

break;


case '14':
	
$axid_proyecto = $_POST["txtid_proyecto"];  
$axestado_producto = $_POST["txtestado_producto"];  

$SQLListar = "SELECT ID_PROYECTO,UBIC_MZ,ESTADO_PRODUCTO, COUNT(UBIC_MZ) AS CANT FROM MK_PROYECTOS_PRODUCTOS WHERE ID_PROYECTO='$axid_proyecto' AND ESTADO_PRODUCTO='$axestado_producto' GROUP BY ID_PROYECTO,UBIC_MZ,ESTADO_PRODUCTO";
$RSListar = odbc_exec($con,$SQLListar);
//echo $SQLListar;

if(odbc_num_rows($RSListar) > 0){

	if($axestado_producto=='DISPONIBLE'){
		echo "<a href='#'' class='list-group-item list-group-item bg-danger text-white' aria-current='true'>MANZANAS - $axestado_producto</a>";
	}elseif($axestado_producto=='VENDIDO'){
		echo "<a href='#'' class='list-group-item list-group-item bg-success text-white' aria-current='true'>MANZANAS - $axestado_producto</a>";
	}elseif($axestado_producto=='SEPARADO'){	
		echo "<a href='#'' class='list-group-item list-group-item bg-warning text-white' aria-current='true'>MANZANAS - $axestado_producto</a>";
	}

	

	while ($fila = odbc_fetch_array($RSListar)) {
		
		$axubic_mz = utf8_encode($fila['UBIC_MZ']);
		$axcant_mz = $fila['CANT'];


		echo "<a href='#' id='btn_ver_detalles_manzana' class='list-group-item list-group-item-action' data-ubic='$axubic_mz'> <b> $axubic_mz - Cant: $axcant_mz </b> </a>";

	}

}else{

	echo '';

}

break;

case '15':
	
$axid_proyecto = $_POST["txtid_proyecto"];  
$axestado_producto = $_POST["txtestado_producto"];  
$axubic_mz = $_POST["txtubic_mz"];  


$SQLListar = "SELECT * FROM MK_PROYECTOS_PRODUCTOS WHERE ID_PROYECTO='$axid_proyecto' AND ESTADO_PRODUCTO='$axestado_producto' AND UBIC_MZ='$axubic_mz'";
$RSListar = odbc_exec($con,$SQLListar);
//echo $SQLListar;

if(odbc_num_rows($RSListar) > 0){

	echo "<div class='row row-cols-1 row-cols-md-4 g-4'>";

	while ($fila = odbc_fetch_array($RSListar)) {
		
		$id_producto = $fila['ID_PRODUCTO'];
		$id_proyecto = $fila['ID_PROYECTO'];
		$cod_producto = $fila['COD_PRODUCTO'];
		$tipo_producto = $fila['TIPO_PRODUCTO'];
		$ubic_mz = $fila['UBIC_MZ'];
		$ubic_lote = $fila['UBIC_LOTE'];
		$med_frente = $fila['MED_FRENTE'];
		$med_fondo = $fila['MED_FONDO'];
		$med_derecha = $fila['MED_DERECHA'];
		$med_izquierda = $fila['MED_IZQUIERDA'];
		$med_perimetro = $fila['MED_PERIMETRO'];
		$area_m2 = $fila['AREA_M2'];
		$ubic_plano = $fila['UBIC_PLANO'];
		$precio_lista = number_format($fila['PRECIO_LISTA'],2,".",",");
		$estado_producto = $fila['ESTADO_PRODUCTO'];

			if($axestado_producto=='DISPONIBLE'){
				echo "
				<div class='col'>
			    <div class='card h-100 border border-danger'>      
			      <div class='card-body'>
			        <h5 class='card-title bg-danger' style='padding: 5px; text-align:center; color:#fff;'><b>Manzana $axubic_mz | Lote $ubic_lote</b></h5>
			        <p class='card-text'>Frente: <b>$med_frente</b> | Fondo: <b>$med_fondo</b> Derecha: <b>$med_derecha</b> | Izquierda: <b>$med_izquierda</b> Perimetro: <b>$med_perimetro</b> | Area M2: <b>$area_m2</b></p>
					
			      </div>
			      <div class='card-footer text-center'>
			        <p class='card-text'><b class='text-danger'><a href='#' style='text-decoration:none;' id='btn_ver_detalles_manzana_productos'>PRECIO: $precio_lista</a></b></p>
			      </div>
			    </div>
			  </div>";
				
			}elseif($axestado_producto=='VENDIDO'){

				echo "
				<div class='col'>
			    <div class='card h-100 border border-success'>      
			      <div class='card-body'>
			        <h5 class='card-title bg-success' style='padding: 5px; text-align:center; color:#fff;'><b>Manzana $axubic_mz | Lote $ubic_lote</b></h5>
			        <p class='card-text'>Frente: <b>$med_frente</b> | Fondo: <b>$med_fondo</b> Derecha: <b>$med_derecha</b> | Izquierda: <b>$med_izquierda</b> Perimetro: <b>$med_perimetro</b> | Area M2: <b>$area_m2</b></p>
					
			      </div>
			      <div class='card-footer text-center'>
			        <p class='card-text'><b class='text-danger'><a href='#' style='text-decoration:none;' id='btn_ver_detalles_manzana_productos'>PRECIO: $precio_lista</a></b></p>
			      </div>
			    </div>
			  </div>";
				
			}elseif($axestado_producto=='SEPARADO'){	

				echo "
				<div class='col'>
			    <div class='card h-100 border border-warning'>      
			      <div class='card-body'>
			        <h5 class='card-title bg-warning' style='padding: 5px; text-align:center; color:#fff;'><b>Manzana $axubic_mz | Lote $ubic_lote</b></h5>
			        <p class='card-text'>Frente: <b>$med_frente</b> | Fondo: <b>$med_fondo</b> Derecha: <b>$med_derecha</b> | Izquierda: <b>$med_izquierda</b> Perimetro: <b>$med_perimetro</b> | Area M2: <b>$area_m2</b></p>
					
			      </div>
			      <div class='card-footer text-center'>
			        <p class='card-text'><b class='text-danger'><a href='#' style='text-decoration:none;' id='btn_ver_detalles_manzana_productos'>PRECIO: $precio_lista</a></b></p>
			      </div>
			    </div>
			  </div>";
				
			}



			
	}

	echo "</div>";

}else{

	echo '';

}


break;

case '16':
	
$axtipo_caracteristica = $_POST["txttipo_caracteristica"];  

$SQLListar = "SELECT NOM_CARACTERISTICAS FROM  MK_PROYECTOS_DT WHERE TIPO_CARACTERISTICA='$axtipo_caracteristica' AND ESTADO_CARACTERISTICA='ACTIVA'  GROUP BY NOM_CARACTERISTICAS ORDER BY NOM_CARACTERISTICAS ASC";
//echo $SQLListar;
$RSListar = odbc_exec($con,$SQLListar);

if(odbc_num_rows($RSListar) > 0 ){

	echo "<div class='div3'>
	<table class='table table-hover table-sm'>
	<thead class='table-primary'>			
		<tr>
			<th style='text-align: center;'>Nº</th>	
			<th style='text-align: left;'>DETALLE</th>		
			<th style='text-align: center;'>SI</th>
			<th style='text-align: center;'>NO</th>			
		</tr>
	</thead>";

	while ($fila = odbc_fetch_array($RSListar)) {

		$it = $it+1;
		$axnom_caracteristicas = $fila['NOM_CARACTERISTICAS'];
		
		echo "<tr>
			<td style='text-align: center;'>$it</td>	
			<td style='text-align: left;'>$axnom_caracteristicas</td>	
			<td style='text-align: center;'>SI</td>
			<td style='text-align: center;'>NO</td>	
		
		<tr>";
	}

	echo "</table>
	</div>";

}else{

	echo '';
}
break;

case '17':

$axid_empresa = $_POST['txtid_empresa']; 
$axid_proyecto = $_POST['txtid_proyecto_enviar']; 
$nombrearchivo = get_row('EMPRESA','AUX_FILES','ID_EMPRESA',$axid_empresa);    
$axfecha = date("Y-m-d");

$objPHPExcel = PHPExcel_IOFactory::load($nombrearchivo);    
$objPHPExcel->setActiveSheetIndex(0);
$numfilas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

for ($ind = 1; $ind <= $numfilas; $ind++) { 
    // ... (código para obtener valores de las celdas)

    $a = $objPHPExcel->getActiveSheet()->getCell('A'.$ind)->getCalculatedValue();  //TIPO_PRODUCTO
    $b = $objPHPExcel->getActiveSheet()->getCell('B'.$ind)->getCalculatedValue();  //MANZANA
    //$b = addslashes($b1);

    $c = $objPHPExcel->getActiveSheet()->getCell('C'.$ind)->getCalculatedValue();  //LOTE
    $d = $objPHPExcel->getActiveSheet()->getCell('D'.$ind)->getCalculatedValue();  //FRENTE
    $e = $objPHPExcel->getActiveSheet()->getCell('E'.$ind)->getCalculatedValue();  //FONDO
    $f = $objPHPExcel->getActiveSheet()->getCell('F'.$ind)->getCalculatedValue();  //DERECHA
    $g = $objPHPExcel->getActiveSheet()->getCell('G'.$ind)->getCalculatedValue();  //IZQUIERDA
    $h = $objPHPExcel->getActiveSheet()->getCell('H'.$ind)->getCalculatedValue();  //PERIMETRO
    $i = $objPHPExcel->getActiveSheet()->getCell('I'.$ind)->getCalculatedValue();  //AREA_M2
    $j = $objPHPExcel->getActiveSheet()->getCell('J'.$ind)->getCalculatedValue();  //UBIC_PLANO
    $k = $objPHPExcel->getActiveSheet()->getCell('K'.$ind)->getCalculatedValue();  //PRECIO_LISTA
    $l = $objPHPExcel->getActiveSheet()->getCell('L'.$ind)->getCalculatedValue();  //ESTADO_PRODUCTO       
    $filtro = $objPHPExcel->getActiveSheet()->getCell('M'.$ind)->getCalculatedValue();  //FILTRO  

    if ($filtro == "PRODUCTOS") {

        $axobservaciones = $axobs_py.' '.$axobs_medio.' '.$axobs_canal.' '.$axobs_coord;
        $axcodigo_producto = generateRandomCode();

        // Utilizando parámetros preparados para evitar la inyección SQL
        $sqlgrabar = "INSERT INTO MK_PROYECTOS_PRODUCTOS (ID_PROYECTO, COD_PRODUCTO, TIPO_PRODUCTO, UBIC_MZ, UBIC_LOTE, MED_FRENTE, MED_FONDO, MED_DERECHA, MED_IZQUIERDA, MED_PERIMETRO, AREA_M2, UBIC_PLANO, PRECIO_LISTA, ESTADO_PRODUCTO) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = odbc_prepare($con, $sqlgrabar);
        odbc_execute($stmt, array($axid_proyecto, $axcodigo_producto, $a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k, $l));

        // Verificar si la ejecución fue exitosa
        if (odbc_errormsg($con)) {
            echo "Error en la inserción: " . odbc_errormsg($con);
        } else {
            echo "Inserción exitosa";
        }
    }
}

break;
case '18':
	
	$axid_proyecto= $_POST['txtid_proyecto'];
	$axid_detalle= $_POST['txtid_detalle'];
	
	$sql6 = "DELETE FROM MK_PROYECTOS_DT WHERE ID_PROYECTO = '$axid_proyecto' AND ID_DETALLE='$axid_detalle'";
	$rsql = odbc_exec($con,$sql6);

	if ($rsql) {
    	
    	$respuesta = 0;
    	echo $respuesta;

	} else {
		$respuesta = 1;
    	echo $respuesta;
	    //echo "Error en la eliminación: " . odbc_errormsg($con);
	}
	
break;
case '19':



	

break;

}



function crearCarpeta($nombreCarpeta) {
    // Verificar si la carpeta no existe antes de intentar crearla
    $ruta = '../Archivos/Proyectos/'.$nombreCarpeta;
    if (!is_dir($ruta)) {
        // Intentar crear la carpeta con permisos 0777 (puedes ajustar esto según tus necesidades)
        if (mkdir($ruta, 0777, true)) {
            
        } else {
            echo "Error al crear la carpeta: $ruta";
        }
    } else {
        echo "La carpeta ya existe: $ruta";
    }
}

// Ejemplo de uso:




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

function get_row($table,$col, $id, $equal){
	global $con;
	$querysql="select top 1 $col from $table where $id='$equal' order by $col desc";
	$query=odbc_exec($con,$querysql);
	$rw=odbc_fetch_array($query);
	$value=$rw[$col];
	return $value;
}


?>


