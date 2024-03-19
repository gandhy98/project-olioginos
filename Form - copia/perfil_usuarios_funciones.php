<?php  

require('../Imprimir/pdf_js.php');
require_once '../core2.php';


$param=$_POST['param'];


switch ($param) {

case '0': // listar usuarios

	$axidempresa = $_POST['txtid_empresa']; 
	$axbuscaregistro = $_POST['txtbuscarusuario']; 
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

  		$sql6 ="SELECT TOP 20 *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' ORDER BY ID_USUARIO ASC";	
  		$axcontador = 20 .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>';

	  	}elseif($axtotal_registros < 20){

	  		$sql6 ="SELECT TOP $axtotal_registros *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' ORDER BY ID_USUARIO ASC";
	  		$axcontador = $axtotal_registros .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>';
	  	}
	 	

  	}

  	

  }else{

  	$sql6 ="SELECT *, COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' AND USUARIO+' '+NOM_USUARIO+' '+COD_USUARIO+' '+AREA_TRABAJO+' '+AREA_CARGO like '%".$axbuscaregistro."%' ORDER BY ID_USUARIO ASC";
  }
	

	
	}elseif($axtipoorden=='TODOS'){

		if($axtipo_busqueda=='ORDENAR'){
			$sql6 ="SELECT TOP $axtotal_registros *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' ORDER BY $axcampo_tabla_orden $axorden";  		
			$axcontador = $axtotal_registros .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>';	
		}else{
			$sql6 ="SELECT TOP $axtotal_registros *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' ORDER BY ID_USUARIO ASC";  		
			$axcontador = $axtotal_registros .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>';	
		}

		
	}

  
	//echo $sql6;
	$RSListar_c = odbc_exec($con, $sql6);
	 $fila_c = odbc_fetch_array($RSListar_c);
   $axcant_registros = $fila_c['cant_registros']; 

   if($axtipo_busqueda=='FILTRAR' || $axtipo_busqueda=='ORDENAR'){

   		$axcontador = $axcant_registros .' de '.$axtotal_registros; 

   		//   	$axcontador = $axcant_registros .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>';	
   }
   

	
	$result6=odbc_exec($con,$sql6);
	echo "<table class='table table-hover table-sm'>
	<thead class='table-primary'>	
		<tr class='table-secondary'>

		<th  style='text-align: center;' > <a href='#' id='btn_prospectos_todos' data-tipoorden='TODOS' style='text-decoration:none; color:black;' title='Click para visualizar todos...'><i class='bi bi-arrow-clockwise' style='font-size:15px;'></i> Ver 	todos </a> </th>


            <th  style='text-align: right;' colspan ='13' >Mostrando $axcontador registros</th>         
    </tr>		
		<tr>
			<th style='text-align: center;'>Nº</th>			
			<th style='text-align: center;'>DNI</th>			
			<th style='text-align: left;'>APELLIDOS Y NOMBRES</th>
			<th style='text-align: left;'>USUARIO</th>
			<th style='text-align: left;'>AREA</th>			
			<th style='text-align: left;'>CARGO</th>
			<th style='text-align: left;'>EMAIL</th>
			<th style='text-align: left;'>CELULAR</th>
			<th style='text-align: center;'>ESTADO</th>
			<th style='text-align: center;'>ACCION</th>
		</tr>
	</thead>";

	while ($row=odbc_fetch_array($result6)){

		$it =$it+1;
 		$iduser = $row["ID_USUARIO"];
 		$axcod_usuario = $row['COD_USUARIO'];
		$axusuario = $row['USUARIO'];
		$axnom_usuario = utf8_encode($row['NOM_USUARIO']);
		$axcorreo_usuario = $row['CORREO_USUARIO'];
		$axid_area = $row['ID_AREA'];
		$axcelular_usuario = $row['CELULAR_USUARIO'];
		$axestado_habilitado = $row['ESTADO_HABILITADO'];
		$axarea = utf8_decode($row['AREA_TRABAJO']);
		$axcargo = utf8_decode($row['AREA_CARGO']);
		$axfoto = $row['IMAGEN_FOTO'];
		$axequipo = $row['ASIG_EQUIPOS'];
		$axtitulo = "<b>EQUIPO DE VENTAS <br>".$axcargo.' - '.$axnom_usuario.'</b>';	

		if($axfoto==''){
			$axfoto = '../Archivos/foto_usuario.png';
		}
		
		if($axcorreo_usuario==''){
			$axcorreo_usuario='faltacorreo@correo.com';
		}

		if($axcelular_usuario==''){
			$axcelular_usuario='000 000 000';
		}


		echo "
 		<tr style='font-size:12px;'>
 			<td style='text-align: center;' >$iduser</td>
 			<td style='text-align: center;' >$axcod_usuario</td>
 			<td style='text-align: left;' >".utf8_decode($axnom_usuario)."</td>
 			<td style='text-align: left;' >$axusuario</td>
 			<td style='text-align: left;' >".utf8_encode($axarea)."</td> 			
 			<td style='text-align: left;' >".utf8_encode($axcargo)."</td> 			
 			<td style='text-align: left;' >$axcorreo_usuario</td> 			
 			<td style='text-align: left;' >$axcelular_usuario</td> 			
 			<td style='text-align: center;' >$axestado_habilitado</td> 			

 			<td style='text-align: center;'> 				
 				<div class='btn-group dropstart'>
          <button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
            <ul class='dropdown-menu'>                    
            <div><hr class='dropdown-divider'></div>";
            	echo "<a href='#' class='dropdown-item text-info' id='btn_editar_usuario' data-id='$iduser' style='text-decoration:none;'><i class='bi bi-pencil' style='font-size:20pX;'></i> Editar</a>  ";
						echo"
						<!--a href='#' class='dropdown-item text-danger' id='btn_eliminar_usuario' data-id='$iduser' style='text-decoration:none;'><i class='bi bi-trash3-fill' style='font-size:20pX;'></i> Eliminar </a-->";

            echo "<div><hr class='dropdown-divider'></div>";

            if($axequipo=='SI'){
            	echo "
            	<a href='#' class='dropdown-item text-success' id='btn_equpo_usuario' data-titulo='$axtitulo' data-id='$iduser' style='text-decoration:none;' data-bs-toggle='modal' data-bs-target='#mdl_asignar_equipo'><i class='bi bi-person-fill-add' style='font-size:20pX;'></i> Asig. Equipo </a>
            	<div><hr class='dropdown-divider'></div>";

            	
            }

           echo "
            </ul>
        </div>

 			</td> 

 		</tr>";
	}



	
break;

case '1':
	
	$axidempresa = $_POST['txtidempresa']; 
	$sql6 ="SELECT ID_MENU,NOM_MENU FROM MODULOS ORDER BY NOM_MENU ASC";
	//echo "$sql6";
	$result6=odbc_exec($con,$sql6);

	echo "<div class='list-group'>
			<a href='#' class='list-group-item list-group-item-action active' aria-current='true'>
			<b><i class='bi bi-collection-fill'></i> Listado de Modulos</b>
		  	</a>";

	if ($result6){		
 		while ($row=odbc_fetch_array($result6)){ 
 			$id = $row["ID_MENU"];
 			$axmenu =$row["NOM_MENU"];
 			echo "<a href='#' class='list-group-item list-group-item-action' id='txtasignarpermiso' data-idmenu='$id' title='Click para agregar Modulo...' > <b> <img src='../icon/agregar4.png' style='width:20px; color:blue;'> $axmenu  </b></a>"; 	
 		}
	}
	echo "</div>";

break;

case '2':

date_default_timezone_set("America/Lima");
$axfecha_actual = date('Y-m-d');

	
	$axparametros = $_POST['txtparametros']; 
	$axid_empresa = $_POST['txtid_empresa']; 
	$axdniusuario = $_POST['txtdniusuario']; 
	$axusuario = $_POST['txtusuario']; 
	$axnombreusuario = $_POST['txtnombreusuario']; 
	$axclave = $_POST['txtclave']; 
	$axidusuario = $_POST['txtidusuario']; 	
	$axid_usuario = $_POST['txtidusuario'];
	$ax_fecha_nac_usuario = $_POST['txt_fecha_nac_usuario'];	
	$ax_genero_usuario = $_POST['txt_genero_usuario']; 
	$ax_direccion_usuario = $_POST['txt_direccion_usuario']; 
	$ax_correo_usuario = $_POST['txt_correo_usuario']; 
	$ax_id_area = $_POST['txt_id_area']; 
	$axarea_trabajo_user = $_POST['txtarea_trabajo_user']; 
	$ax_celular_usuario = $_POST['txt_celular_usuario']; 
	$ax_estado_habilitado = $_POST['txt_estado_habilitado']; 
	$ax_qr_usuario = $_POST['txt_qr_usuario'];
	$axcargo = $_POST['txtcargo'];

	$ax_id_area = get_row('AREAS_TRABAJO','ID_AREA','AREA_ENCARGADO',$axcargo);

	$fechaNacimiento = $ax_fecha_nac_usuario;
	// Crear objetos DateTime para la fecha de nacimiento y la fecha actual
	$fechaNacimientoObj = new DateTime($fechaNacimiento);
	$fechaActualObj = new DateTime();
	// Calcular la diferencia entre las dos fechas
	$diferencia = $fechaNacimientoObj->diff($fechaActualObj);
	// Obtener la edad
	$ax_edad_usuario = $diferencia->y; 
	
	if($axparametros==1){

		$Insertar = "INSERT INTO USUARIO 
		(ID_EMPRESA,COD_USUARIO,USUARIO,NOM_USUARIO,CLAVE,F_REGISTRO,FECHA_NAC_USUARIO,EDAD_USUARIO,GENERO_USUARIO,DIRECCION_USUARIO,CORREO_USUARIO,ID_AREA,CELULAR_USUARIO,ESTADO_HABILITADO,QR_USUARIO,AREA_TRABAJO_USER,AREA_CARGO) 
			VALUES ('$axid_empresa','$axdniusuario','$axusuario','$axnombreusuario','$axclave','$axfecha_actual','$ax_fecha_nac_usuario','$ax_edad_usuario','$ax_genero_usuario','$ax_direccion_usuario','$ax_correo_usuario','$ax_id_area','$ax_celular_usuario','$ax_estado_habilitado','$ax_qr_usuario','$axarea_trabajo_user','$axcargo')";
		
	} else {

			$Insertar ="UPDATE USUARIO SET ID_EMPRESA='$axid_empresa',COD_USUARIO='$axdniusuario',USUARIO='$axusuario',NOM_USUARIO='$axnombreusuario',CLAVE='$axclave',F_REGISTRO='$axfecha_actual',FECHA_NAC_USUARIO='$ax_fecha_nac_usuario',EDAD_USUARIO='$ax_edad_usuario',GENERO_USUARIO='$ax_genero_usuario',DIRECCION_USUARIO='$ax_direccion_usuario',CORREO_USUARIO='$ax_correo_usuario',ID_AREA='$ax_id_area',CELULAR_USUARIO='$ax_celular_usuario',ESTADO_HABILITADO='$ax_estado_habilitado',QR_USUARIO='$ax_qr_usuario',AREA_TRABAJO_USER='$axarea_trabajo_user',AREA_CARGO='$axcargo' WHERE ID_USUARIO='$axidusuario'";
			
	}
	//echo "$Insertar";
	$result6=odbc_exec($con,$Insertar); 

	if($result6){

		$respuesta = 0;
		echo"$respuesta"; // grabado



	}else{
		
		$respuesta = 1;
		echo"$respuesta"; // no grabado

	}



break;

case '3':

	$axcoduser= $_POST['txtdniusuario'];
	
	$sql6 = "SELECT * FROM USUARIO WHERE COD_USUARIO = '$axcoduser'";
	
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
	
	$axidusuario = $_POST['txtidusuario']; 
	$axfecharegistro = $_POST['txtfecharegistro']; 
	$axparametros = $_POST['txtparametros']; 
	$axidmenu = $_POST['axidmenu']; 
	$axidpermiso = $_POST['txtidpermiso']; 
	$axnom_modulo = get_row('MODULOS','NOM_MENU','ID_MENU',$axidmenu);

	$sqlbuscar = "SELECT TOP 1 * FROM USUARIO_PERMISOS WHERE ID_MENU='$axidmenu' AND ID_USUARIO='$axidusuario'";
	$rsbuscar = odbc_exec($con,$sqlbuscar);
 	//echo $sqlbuscar;

	if(odbc_num_rows($rsbuscar) > 0 ){

		$respuesta = 2;
		echo"$respuesta"; // existe

	}else{

		if($axnom_modulo=='TOTAL'){

			$SQLEliminar_todo = "DELETE FROM USUARIO_PERMISOS WHERE ID_USUARIO='$axidusuario'";
			$RSEliminar_todo = odbc_exec($con,$SQLEliminar_todo);

			if($RSEliminar_todo){
				
				$Insertar = "INSERT INTO USUARIO_PERMISOS (ID_USUARIO,FECHA_ASIGNACION,ID_MENU) VALUES ('$axidusuario','$axfecharegistro','$axidmenu')";
				$result6=odbc_exec($con,$Insertar); 

				if($result6){

					$respuesta = 0;
					echo"$respuesta"; // grabado

				}else{
					
					$respuesta = 1;
					echo"$respuesta"; // no grabado

				}	

			}

		}else{

			$Insertar = "INSERT INTO USUARIO_PERMISOS (ID_USUARIO,FECHA_ASIGNACION,ID_MENU) VALUES ('$axidusuario','$axfecharegistro','$axidmenu')";
			$result6=odbc_exec($con,$Insertar); 

			if($result6){

				$respuesta = 0;
				echo"$respuesta"; // grabado


			}else{
				
				$respuesta = 1;
				echo"$respuesta"; // no grabado

			}
			
		}

		
	}



break;

case '5':
	
	$axidusuario = $_POST['txtidusuario']; 

	$sql6 ="SELECT * FROM MODULO_ASIGNADO WHERE ID_USUARIO='$axidusuario' ORDER BY NOM_USUARIO ASC";
	//echo "$sql6";
	echo "<div class='list-group'>
		<a href='#' class='list-group-item list-group-item-action active' aria-current='true'>
		<b><i class='bi bi-collection-fill'></i> Modulos Asignados</b>		
	  	</a>";

	$result6=odbc_exec($con,$sql6);
	if ($result6){
 		while ($row=odbc_fetch_array($result6)){ 
 			$idpermiso = $row["ID_PERMISO"];
 			$idusuario = $row["ID_USUARIO"];
 			$idmenu = $row["ID_MENU"];
 			$axmenu =$row["NOM_MENU"];

 			echo "<a href='#' class='list-group-item list-group-item-action' id='btquitarmenu' data-idmenu='$idmenu' title='Click para quitar el Modulo...' > <b> <img src='../icon/quitar.png' style='width:20px; color:blue;'> $axmenu </b></a>";  			
		}
	}

	echo "</div>";




break;

case '6':

date_default_timezone_set("America/Lima");
$axfecha_actual = date('Y-m-d');
	
	$axidusuario = $_POST['txtidusuario']; 
	$axfecharegistro = $_POST['txtfecharegistro']; 
	$axparametros = $_POST['txtparametros']; 
	$axid_proyecto = $_POST['txtid_proyecto']; 
	$axidasignacion = $_POST['txtidasinacion']; 

	$sqlbuscar = "SELECT * FROM USUARIOS_PROYECTOS WHERE ID_USUARIO='$axidusuario' AND ID_PROYECTO='$axid_proyecto'";
	$rsbuscar = odbc_exec($con,$sqlbuscar);

	if(odbc_num_rows($rsbuscar) > 0){

		$respuesta = 2;
		echo"$respuesta"; // ya existe

	
	}else{

		$Insertar = "INSERT INTO USUARIOS_PROYECTOS (ID_USUARIO,FECHA_ASIGNACION,ID_PROYECTO) VALUES ('$axidusuario','$axfecharegistro','$axid_proyecto')";
		$result6=odbc_exec($con,$Insertar); 
		if($result6){
			$respuesta = 0;
			echo"$respuesta"; // grabado
		}else{		
			$respuesta = 1;
			echo"$respuesta"; // no grabado
		}
	}

	



break;

case '7':
	
	$axidusuario = $_POST['txtidusuario']; 

	$sql6 ="SELECT * FROM USUARIOS_PROYECTOS_ASIGNADOS WHERE ID_USUARIO='$axidusuario' ORDER BY NOMBRE_CORTO_PY ASC";
	//echo "$sql6";

		echo "<div class='list-group'>
		<a href='#' class='list-group-item list-group-item-action active' aria-current='true'>
		<b><i class='bi bi-buildings-fill'></i> Locales Asignados</b>		
	  	</a>";
	$result6=odbc_exec($con,$sql6);
	if ($result6){
 		while ($row=odbc_fetch_array($result6)){ 
 			$idasignacion = $row["ID_ASIGNACION"];
 			$axlocal =$row["NOMBRE_CORTO_PY"];
 			
 			echo "<a href='#' class='list-group-item list-group-item-action' id='txtquitaretapa' data-idasignetapa='$idasignacion' title='Click para quitar el local Asignado...' > <b> <img src='../icon/quitar.png' style='width:20px; color:blue;'> $axlocal </b></a>"; 
		}	
	}
	echo "</div>";

break;

case '8':

	$axcoduser= $_POST['axiduser'];
	
	$sql6 = "SELECT * FROM USUARIOS_LISTAR WHERE ID_USUARIO = '$axcoduser'";
	
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
	
	$axidmenu = $_POST['axidmenu'];
	$axidusuario = $_POST['txtidusuario'];

	 $sql ="DELETE FROM USUARIO_PERMISOS WHERE ID_MENU='$axidmenu' AND ID_USUARIO ='$axidusuario' ";
     $result6=odbc_exec($con,$sql); 

     //echo $sql;

     if($result6){
     	$respuesta =0;
     	echo $respuesta;
     }else{
     	$respuesta =1;
     	echo $respuesta;
     }

break;

case '10':
	
	$idasignetapa = $_POST['idasignetapa'];	
	$axidusuario = $_POST['txtidusuario'];
	
	$sql ="DELETE FROM USUARIOS_PROYECTOS WHERE ID_ASIGNACION='$idasignetapa' AND ID_USUARIO ='$axidusuario'";
    $result6=odbc_exec($con,$sql); 

    if($result6){
     	$respuesta =0;
     	echo $respuesta;
     }else{
     	$respuesta =1;
     	echo $respuesta;
     }

break;

case '11':
	
	$axiduser = $_POST['txtcodusuario']; 	
	$axpermiso = $_POST['axpermiso']; 
	

	$sql6 = "SELECT * FROM MENU_ASIGNADO WHERE ID_USUARIO = '$axiduser' and NOM_MENU='TOTAL'";
	$rspermisos=odbc_exec($con,$sql6);
	//echo $sql6;

	if(odbc_num_rows($rspermisos) == 1){

		$respuesta = 0;
		echo"$respuesta"; // ACCESO TOTAL

	} else {

		$sql7 = "SELECT * FROM MENU_ASIGNADO WHERE ID_USUARIO = '$axiduser' and NOM_MENU='$axpermiso'";
		$rspermisos7=odbc_exec($con,$sql7);
		//echo $sql7;

		if(odbc_num_rows($rspermisos7) == 1){

			$respuesta = 0;
			echo"$respuesta"; // ACCESO TOTAL

		} else{

			$respuesta = 1;
			echo"$respuesta"; // NO TIENE ACCESO A ESTE MODULO
		}		

	}



break;

case '12':
	
	$axidlocal = $_POST['txtetapapy_1']; 	
	$sql6 ="SELECT * FROM CORRELATIVOS_LISTAR WHERE ID_LOCAL='$axidlocal' ORDER BY DETALLE_DOC";

	//echo "$sql6";

	echo "<div class='list-group'>
		<a href='#' class='list-group-item list-group-item-action active' aria-current='true'>
		<b><i class='bi bi-123'></i> Series de documentos</b>		
	  	</a>";
	
	$result6=odbc_exec($con,$sql6);
	
	if ($result6){
 	
 	while ($row=odbc_fetch_array($result6)){ 
 		$id = $row["COD_CORR"];
 		$axserie =$row["N_SERIE"].' '.$row["DETALLE_DOC"];

	echo "<a href='#' class='list-group-item list-group-item-action' id='btn_asignar_serie' data-id='$id' title='Click para asignar número de serie' >
			<b> <img src='../icon/agregar4.png' style='width:20px;'> $axserie </b>
		</a>";  

 	

}
echo "</table>";
}

break;

case '13':
	
$axid_corre = $_POST['txtserie']; 	
$axidlocal = $_POST['txtetapapy_1']; 	
$axid_usuario = $_POST['txtidusuario']; 	

$SQLBuscar = "SELECT * FROM USUARIO_CORRELATIVO WHERE ID_LOCAL='$axidlocal' AND ID_USUARIO='$axid_usuario' AND COD_CORR='$axid_corre'";
$RSBuscar = odbc_exec($con,$SQLBuscar);

if(odbc_num_rows($RSBuscar) > 0){
	
	$respuesta = 1; //EXISTE
	echo $respuesta;

}else{

	$SqlInser = "INSERT INTO USUARIO_CORRELATIVO (ID_USUARIO,COD_CORR,ID_LOCAL) VALUES ('$axid_usuario','$axid_corre','$axidlocal')";
	$RsInsert = odbc_exec($con,$SqlInser);

	if($RsInsert){
		$respuesta = 0; //grabado
		echo $respuesta;
	}else{
		$respuesta = 2; // no grabado
		echo $respuesta;
	}

}


break;

case '14':


$axidlocal = $_POST['txtetapapy_1']; 	
$axid_usuario = $_POST['txtidusuario']; 	

$sql6 ="SELECT * FROM USUARIOS_CORRELATIVOS_ASIGNADOS WHERE ID_LOCAL='$axidlocal' AND ID_USUARIO='$axid_usuario' ORDER BY DETALLE_DOC";

	//echo "$sql6";

	echo "<div class='list-group'>
		<a href='#' class='list-group-item list-group-item-action active' aria-current='true'>
		<b><i class='bi bi-123'></i> Series asignados al usuario</b>		
	  	</a>";

	
	$result6=odbc_exec($con,$sql6);
	
	if ($result6){
 	
 	while ($row=odbc_fetch_array($result6)){ 
 		$id = $row["ID_ASIG_CORRELATIVO"];
 		$axserie =$row["N_SERIE"].' '.$row["DETALLE_DOC"];

 		echo "<a href='#' class='list-group-item list-group-item-action' id='btn_quitar_serie' data-id='$id' title='Click para quitar número de serie' >
			<b> <img src='../icon/quitar.png' style='width:20px;'> $axserie </b>
		</a>";  

 	
}
echo "</table>";
}

break;
case '15':

$axid_asignacion = $_POST['axid_asignacion']; 	
$sqldelete = "DELETE FROM USUARIO_CORRELATIVO WHERE ID_ASIG_CORRELATIVO='$axid_asignacion'";
$RSDelete = odbc_exec($con,$sqldelete);

if($RSDelete){
	$respuesta = 0; // eliminado
	echo $respuesta;
}else{
	$respuesta = 1; // no se eliminado
	echo $respuesta;
}

break;

case '16':
	
	$axid_usuario = $_POST['txtidusuario']; 
		
	$SQLCuentas = "SELECT * FROM USUARIOS_LOCALES WHERE ID_USUARIO='$axid_usuario' ORDER BY DESCRICION_LC ASC";	
	$RSTipodocumentos=odbc_exec($con,$SQLCuentas);

	//echo $SQLCuentas;

	if(odbc_num_rows($RSTipodocumentos) > 0){		
		while($fila=odbc_fetch_array($RSTipodocumentos)){
	   		echo '<option value='.$fila['ID_LOCAL'].'>'.$fila['DESCRICION_LC'].'</option>';
    	}		
	} else {

		echo "";	
	
	}

break;

case '17':
	
$axtetapapy_2 = $_POST['txtetapapy_2']; 
$axtid_tienda = $_POST['txtid_tienda']; 
$axid_usuario = $_POST['txtidusuario']; 

$SqlInser = "INSERT INTO USUARIO_TIENDAS (ID_USUARIO,ID_TIENDA,ID_LOCAL) VALUES ('$axid_usuario','$axtid_tienda','$axtetapapy_2')";
$RsInsert = odbc_exec($con,$SqlInser);

if($RsInsert){
	$respuesta =0;
	echo $respuesta;
}else{
	$respuesta =1;
	echo $respuesta;

}

break;

case '18':
	
$axid_usuario = $_POST['txtidusuario']; 	
$axtetapapy_2 = $_POST['txtetapapy_2']; 	

$sql6 ="SELECT * FROM USUARIOS_TIENDAS_ASIGNADAS WHERE ID_LOCAL='$axtetapapy_2' AND ID_USUARIO='$axid_usuario'";
//echo "$sql6";

	echo "
		<table class='table table-sm'>
		<thead>			
		<tr>
			<th scope='col' style='text-align: center;'>Item</th>			
			<th scope='col'>Nombre Almacen</th>			
			<th scope='col'style='text-align: center;'>Acción</th>
		</tr>
		</thead>";
	
	$result6=odbc_exec($con,$sql6);
	
	if ($result6){
 	
 	while ($row=odbc_fetch_array($result6)){ 
 		$id = $row["ID_ASIG_TIENDA"];
 		$axtid_tienda = $row["ID_TIENDA"];
 		$it = $it+1;
 		 	echo "
 		<tr> 		
 			<td style='text-align: center;' >".$it."</td>  	
 			<td >".$row["NOM_TIENDA"]."</td> 
 			<td style='text-align: center;' ><a href='#' class='btn btn-outline-info btn-sm' id='btn_quitar_serie'  data-id='$id'>Quitar</a></td> 
 		</tr>
 	";

}
echo "</table>";
}

break;

case '19':

$token ='apis-token-1842.1TicMx74Ee3kROx3PHhIW7dScOyG6P3n';
$dni = $_POST['txtdniusuario']; 

	// Iniciar llamada a API
$curl = curl_init();

// Buscar dni
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.apis.net.pe/v1/dni?numero=' . $dni,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 2,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Referer: https://apis.net.pe/consulta-dni-api',
    'Authorization: Bearer ' . $token
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$persona = json_decode($response);
echo json_encode($persona);


break;
case '20':

	$axarea_trabajo_user = $_POST['txtarea_trabajo_user']; 
	
	$SQLCuentas = "SELECT * FROM AREAS_TRABAJO  WHERE AREA_TRABAJO='$axarea_trabajo_user' ORDER BY AREA_ENCARGADO ASC";	
		
	
	$RSTipodocumentos=odbc_exec($con,$SQLCuentas);

	//echo $SQLCuentas;

	if(odbc_num_rows($RSTipodocumentos) > 0){		
		while($fila=odbc_fetch_array($RSTipodocumentos)){
			$axcargo = $fila['AREA_ENCARGADO'];
			$axidcargo= $fila['ID_AREA'];
	   		echo "<option value='$axcargo'>".$axcargo."</option>";
    	}		
	} else {

		echo "";	
	
	}




break;

case '21':
	
$axiduser = $_POST['axiduser']; 

$SQLEliminar = "DELETE FROM USUARIO WHERE ID_USUARIO='$axiduser'";
$RSEliminar = odbc_exec($con,$SQLEliminar);

//echo $SQLEliminar;

if($RSEliminar){
	$respuesta =0;
	echo $respuesta;

}else{
	$respuesta =1;
	echo $respuesta;

}


break;

case '22':
	
$axarea_trabajo_user = $_POST['txtarea_trabajo_user']; 
	$axcargo = $_POST['axcargo']; 

	if($axarea_trabajo_user!=='' || $axcargo !==''){
		
	$SQLCuentas = "SELECT * FROM AREAS_TRABAJO WHERE AREA_TRABAJO='$axarea_trabajo_user' AND AREA_ENCARGADO='$axcargo' ORDER BY AREA_ENCARGADO ASC";	
		
	}elseif($axarea_trabajo_user!==''){

		$SQLCuentas = "SELECT * FROM AREAS_TRABAJO  WHERE AREA_TRABAJO='$axarea_trabajo_user' ORDER BY AREA_ENCARGADO ASC";	
		
	}else{

		$SQLCuentas = "SELECT * FROM AREAS_TRABAJO ORDER BY AREA_ENCARGADO ASC";	
	}
		
	
	$RSTipodocumentos=odbc_exec($con,$SQLCuentas);

	//echo $SQLCuentas;

	if(odbc_num_rows($RSTipodocumentos) > 0){		
		while($fila=odbc_fetch_array($RSTipodocumentos)){
			$axcargo = $fila['AREA_ENCARGADO'];
	   		echo "<option value='$axcargo'>".$axcargo."</option>";
    	}		
	} else {

		echo "";	
	
	}
break;

case '23':

date_default_timezone_set("America/Lima");
$axfecha_actual = date('Y-m-d');
	
	$axid_coordinador = $_POST['txtid_coordinador'];
	$axid_ejecutivo = $_POST['txtid_ejecutivo'];
	$axid_asignacion = $_POST['txtid_asignacion'];

	$axverificar = get_row('USUARIO_EQUIPOS_VENTAS','ID_EJECUTIVO','ID_EJECUTIVO',$axid_ejecutivo);


	if($axverificar ==''){

			$SqlInser = "INSERT USUARIO_EQUIPOS_VENTAS (ID_COORDINADOR,ID_EJECUTIVO,FECHA_ASIGNACION) values ('$axid_coordinador','$axid_ejecutivo','$axfecha_actual')";
			$RsInsert = odbc_exec($con,$SqlInser);

			if($RsInsert){

				$respuesta=0;
				echo $respuesta;

			}else{

				$respuesta=1;
				echo $respuesta;
			}

	}else{

			//echo 'Existe '.$axverificar;
		
			$respuesta=2;
			echo $respuesta;

	}
	
break;


case '24':

	$axid_coordinador = $_POST['txtid_coordinador'];

	$sqllistar = "SELECT * FROM USUARIOS_EJECUTIVOS_ASIGNADOS WHERE ID_COORDINADOR='$axid_coordinador'";
	$rslistar = odbc_exec($con,$sqllistar);

	//echo $sqllistar;

	if(odbc_num_rows($rslistar) > 0){

	echo "<table class='table table-hover table-sm'>
	<thead class='table-primary'>	
		<tr>
			<th style='text-align: center;'>Nº</th>			
			<th style='text-align: left;'>EJECUTIVO DE VENTA</th>			
			<th style='text-align: center;'>ELIMINAR</th>			
		</tr>
	</thead>";

	while ($fila = odbc_fetch_array($rslistar)) {
		echo "<tr>";
		$axit = $axit+1;
		$axid_asig =  $fila['ID_ASIGN_EJECUTIVO'] ;
		$axid_coordinador= $fila['ID_COORDINADOR'] ;
		$axid_ejecutivo= $fila['ID_EJECUTIVO'] ;
		$axnom_ejecutivo= $fila['NOM_USUARIO'] ;

		echo "
			<td style='text-align:center;'>$axit</td>
			<td style='text-align:left;'>$axnom_ejecutivo</td>
			<td style='text-align:center;'>
			<a href='#' class='text-danger' id='btn_eliminar_ejecutivo' data-id='$axid_asig' style='text-decoration:none;'><i class='bi bi-trash3-fill'></i></a>
			</td>
			<tr>";
	}

	}else{

		echo "<table class='table table-hover table-sm'>
	<thead class='table-primary'>	
		<tr>
			<th style='text-align: center;'>Nº</th>			
			<th style='text-align: left;'>EJECUTIVO DE VENTA</th>			
			<th style='text-align: center;'>ELIMINAR</th>			
		</tr>
	</thead>";

	}


echo "</table>";	

break;

case '25':	
	
	$axid_asignacion= $_POST['txtid_asignacion'];	
	$axejecutivo_asignado = get_row('USUARIOS_EJECUTIVOS_ASIGNADOS','NOM_USUARIO','ID_ASIGN_EJECUTIVO',$axid_asignacion);
	$axid_coordinador = get_row('USUARIOS_EJECUTIVOS_ASIGNADOS','ID_COORDINADOR','ID_ASIGN_EJECUTIVO',$axid_asignacion);
	$axcoordinador = get_row('USUARIO','NOM_USUARIO','ID_USUARIO',$axid_coordinador);
	
	$sql6 = "DELETE FROM USUARIO_EQUIPOS_VENTAS WHERE ID_ASIGN_EJECUTIVO = '$axid_asignacion'";
	$rsgrabar = odbc_exec($con,$sql6);

	if($rsgrabar){

		/***************************************/
	    $id_user =$_POST['txtid_usuario'];
	    $modulo = $_POST['txtmodulo'];	    
	    $detalle='ELIMINO EL EJECUTIVO '.$axejecutivo_asignado.' DEL EQUIPO DEL COORDINADOR '.$axcoordinador;
	    guardar_bitacora($id_user,$modulo,$detalle);
		/***************************************/

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;

	}


break;

case '26':
	
	$axid_empresa = $_POST['txtid_empresa'];	
	$axnom_tabla = $_POST['txtnom_tabla'];	
	$axtipo_busqueda = $_POST['txttipo_busqueda'];	

	$respuesta = listar_filtros_orden($axnom_tabla,$axtipo_busqueda,$axid_empresa);

break;

case '27':
	

	$axid_empresa = $_POST['txtid_empresa'];	
	$axnom_tabla = $_POST['txtnom_tabla'];	
	$axcampo = $_POST['txtcampo_tabla'];	

	$respuesta = listar_filtrar($axnom_tabla,$axcampo,$axid_empresa);


break;

}

function listar_filtrar($axnom_tabla,$axcampo,$axid_empresa){

global $con;

	$sql_6 = "SELECT $axcampo FROM $axnom_tabla GROUP BY $axcampo ORDER BY $axcampo ASC";	
	//echo $sql_6;
	$rsql_6 =odbc_exec($con,$sql_6);

	while ($fila_6 = odbc_fetch_array($rsql_6)) {
		$axcampo_M =$fila_6[$axcampo] ;
		//echo " <a href='#' data-alias='$axalias' class='list-group-item list-group-item-action'>$axalias</a>";
		echo "<li class='list-group-item'><a href='#' class='text-body-tertiary' style='text-decoration:none;' id='btn_buscar_campo_contenido' data-campo_contenido='$axcampo_M'>$axcampo_M</a></li>";
	}


}


function listar_filtros_orden($axnom_tabla,$axtipo_busqueda,$axid_empresa){

global $con;

if($axtipo_busqueda=='FILTRAR'){
	$sql = "SELECT * FROM TABLAS_PLUS WHERE NOM_TABLA='$axnom_tabla' AND COLUMN_FILTRAR='SI' AND ID_EMPRESA='$axid_empresa' ORDER BY COLUMN_ALIAS ASC";	
}elseif($axtipo_busqueda=='ORDENAR'){
	$sql = "SELECT * FROM TABLAS_PLUS WHERE NOM_TABLA='$axnom_tabla' AND COLUMN_ORDENAR='SI' AND ID_EMPRESA='$axid_empresa' ORDER BY COLUMN_ALIAS ASC";	
}

$rsql =odbc_exec($con,$sql);
while ($fila = odbc_fetch_array($rsql)) {
	$axcampo =$fila['COLUMN_NAME'] ;
	$axalias =$fila['COLUMN_ALIAS'] ;
	
	/*ID_TABLA,NOM_TABLA,COLUMN_NAME,COLUMN_ALIAS,COLUMN_FILTRAR,COLUMN_ORDENAR,ID_EMPRESA*/
	//echo " <a href='#' data-alias='$axalias' class='list-group-item list-group-item-action'>$axalias</a>";
	
	if($axtipo_busqueda=='FILTRAR'){
	echo "<li class='list-group-item'>
	<a href='#' class='text-body-tertiary' id='btn_filtrar_campo_tabla' style='text-decoration:none;' data-campo_tabla='$axcampo'> $axalias</a>
	</li>";	

	}elseif($axtipo_busqueda=='ORDENAR'){

	echo "<li class='list-group-item'>$axalias <br> 
		<a href='#' class='text-body-tertiary' id='btn_ordenar_campo' style='text-decoration:none;' data-order='ASC' data-campo_tabla_orden='$axcampo'><b class='text-success' style='font-size:10px;'> ASC </b></a> |
		<a href='#' class='text-body-tertiary' id='btn_ordenar_campo' style='text-decoration:none;' data-order='DESC' data-campo_tabla_orden='$axcampo'><b class='text-danger' style='font-size:10px;'> DESC </b></a>

	</li>";
}
	
}


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


function contarRegistros($nombreTabla) {
    
    global $con;
    $querysql="SELECT COUNT(*) as total FROM $nombreTabla";
    $query=odbc_exec($con,$querysql);
    $rw=odbc_fetch_array($query);
    $value=$rw['total'];
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



function get_row_two($table,$col, $id_1, $id_2, $equal_1, $equal_2){

	global $con;
	$querysql="select top 1 $col from $table where $id_1='$equal_1' and $id_2='$equal_2' order by $col desc";
	$query=odbc_exec($con,$querysql);
	$rw=odbc_fetch_array($query);
	$value=$rw[$col];
	return $value;
}

?>
