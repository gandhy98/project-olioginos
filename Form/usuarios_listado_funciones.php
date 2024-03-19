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

case '1': 

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

case '2': //EDITAR MODULO ALMACENES.PHP
	
$axid_local= $_POST['txtid_local'];
	
	$sql6 = "SELECT * FROM LOCALES WHERE ID_LOCAL = '$axid_local'";
	
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

case '3': //GRABAR MODULO ALMACENES.PHP
	
$axparametros = $_POST['txtparametros']; 

	$axidempresa = $_POST['txtid_empresa'];
	$axid_local = $_POST['txtid_local'];
	$axruc = $_POST['txtruc_benef'];
	$axrazonsocial = $_POST['txtrazonsocial'];
	$axdireccion = $_POST['txtdireccion'];
	$axtelefono = $_POST['txttelefono'];
	$axrepresentante = $_POST['txtrepresentante'];
	$axtipo_negocio = $_POST['txttipo_negocio'];
	$axemail_cliente = $_POST['txtemail_cliente'];
	$axclave_correo = $_POST['txtclave_correo'];
	$axruta_json = $_POST['txtruta_json'];
	$axurl_produccion = $_POST['txturl_produccion'];
	$axurl_pruebas = $_POST['txturl_pruebas'];
	$axtoken_empresa = $_POST['txttoken_empresa'];
	$axcod_cliente_emis = $_POST['txtcod_cliente_emis'];
	$axcod_ubi_emis = $_POST['txtcod_ubi_emis'];
	$axprov_emis = $_POST['txtprov_emis'];
	$axdpto_emis = $_POST['txtdpto_emis'];
	$axdistr_emis = $_POST['txtdistr_emis'];
	$axcod_operacion = $_POST['txtcod_operacion'];

	


	if($axparametros==1){

		$Insertar = "INSERT INTO LOCALES (RUC_EMPRESA,RAZON_SOCIAL,DIRECCION,TELEFONO,REP_LEGAL,TIPO_NEGOCIO,txt_correo_adquiriente,CLAVE_PRINCIPAL,RUTA_JSON,URL_PRODUCCION,URL_PRUEBAS,TOKEN_EMPRESA,cod_cliente_emis,cod_ubi_emis,txt_prov_emis,txt_dpto_emis,txt_distr_emis,cod_operacion,ID_EMPRESA) VALUES ('$axruc','$axrazonsocial','$axdireccion','$axtelefono','$axrepresentante','$axtipo_negocio','$axemail_cliente','$axclave_correo','$axruta_json','$axurl_produccion','$axurl_pruebas','$axtoken_empresa','$axcod_cliente_emis','$axcod_ubi_emis','$axprov_emis','$axdpto_emis','$axdistr_emis','$axcod_operacion','$axidempresa')";
//echo "$Insertar";
		
	} else {

		$Insertar ="UPDATE LOCALES SET RUC_EMPRESA='$axruc',RAZON_SOCIAL='$axrazonsocial',DIRECCION='$axdireccion',TELEFONO='$axtelefono',REP_LEGAL='$axrepresentante',TIPO_NEGOCIO='$axtipo_negocio',txt_correo_adquiriente='$axemail_cliente',CLAVE_PRINCIPAL='$axclave_correo',RUTA_JSON='$axruta_json',URL_PRODUCCION='$axurl_produccion',URL_PRUEBAS='$axurl_pruebas',TOKEN_EMPRESA='$axtoken_empresa',cod_cliente_emis='$axcod_cliente_emis',cod_ubi_emis='$axcod_ubi_emis',txt_prov_emis='$axprov_emis',txt_dpto_emis='$axdpto_emis',txt_distr_emis='$axdistr_emis',cod_operacion='$axcod_operacion',ID_EMPRESA='$axidempresa' WHERE ID_LOCAL='$axid_local'";
			
	}

	///echo "$Insertar";

	$result6=odbc_exec($con,$Insertar); 

	if($result6){

		$respuesta = 0;
		echo"$respuesta"; // grabado



	}else{
		
		$respuesta = 1;
		echo"$respuesta"; // no grabado

	}


break;

case '4': //CONSULTAR RUC EN SUNAT
	
// Datos

$token ='apis-token-3427.Da8fJtEPmb4b3NjaWrDoDtG8vCRuUjyL';
$ruc = $_POST['txtruc_benef'];


// Iniciar llamada a API
$curl = curl_init();

// Buscar ruc sunat
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.apis.net.pe/v1/ruc?numero=' . $ruc,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Referer: http://apis.net.pe/api-ruc',
    'Authorization: Bearer ' . $token
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// Datos de empresas según padron reducido
$empresa = json_decode($response);
//var_dump($empresa);
//echo json_encode($persona);
echo json_encode($empresa);


break;

case '5': //CREAR DIRECTORIO DE EMPRESA
	

$micarpeta= '../ruta_json/'.$_POST['txtruc_benef'];

//echo $micarpeta;

	if (!file_exists($micarpeta)) {
		mkdir($micarpeta, 0777, true);
	}else{
		$respuesta =1;
		echo $respuesta;
	}	


break;

case '6': // LISTAR PRODUCTOS
	
$axbuscaregistro = $_POST['txtbuscar']; 	
$axid_empresa = $_POST['txtid_empresa']; 	

	if($axbuscaregistro==""){
		
		$SQLBuscar = "SELECT  TOP 30  ID_PRODUCTO,COD_PRODUCTO,NOM_CATEGORIA,NOM_PRODUCTO,TIPO,PRESENTACION,PROCEDENCIA,ESTADO,CANT_CAJA,COSTO_PRODUCTO,PESO_PRODUCTO FROM PRODUCTOS_LISTADO WHERE ID_EMPRESA = '$axid_empresa'";
		
	}else{

		$SQLBuscar ="SELECT  TOP 30 ID_PRODUCTO,COD_PRODUCTO,NOM_CATEGORIA,NOM_PRODUCTO,TIPO,PRESENTACION,PROCEDENCIA,ESTADO,CANT_CAJA,COSTO_PRODUCTO,PESO_PRODUCTO FROM PRODUCTOS_LISTADO WHERE ID_EMPRESA = '$axid_empresa' AND NOM_PRODUCTO+NOM_CATEGORIA+COD_PRODUCTO like '%".$axbuscaregistro."%' ";

	}

	//echo "$SQLBuscar";

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th class='ocultar' style='text-align: center;'>Item</th>
			<th class='ocultar' style='text-align: center;'>Código</th>
			<th class='ocultar' style='text-align: center;'>Categoría</th>
			<th style='text-align: left;'>Descripción</th>
			<th class='ocultar' style='text-align: center;'>Tipo</th>
			<th style='text-align: center;'>Presentación</th>
			<th class='ocultar' style='text-align: center;'>Costo</th>			
			<th style='text-align: right;'>Cant x Caja</th>
			<th style='text-align: right;'>Peso</th>
			<th class='ocultar' style='text-align: center;'>Estado</th>
			<th style='text-align: center;'>Acción</th>
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$id_producto = $fila['ID_PRODUCTO'];
		$cod_producto = $fila['COD_PRODUCTO'];
		$nom_categoria = $fila['NOM_CATEGORIA'];
		$nom_producto = $fila['NOM_PRODUCTO'];
		$tipo = $fila['TIPO'];
		$presentacion = $fila['PRESENTACION'];
		$procedencia = $fila['PROCEDENCIA'];
		$costo = $fila['COSTO_PRODUCTO'];
		$estado = $fila['ESTADO'];
		$cant_caja = $fila['CANT_CAJA'];
		$axpeso = $fila['PESO_PRODUCTO'];

		$axcomplemento = get_row('PRODUCTOS_LISTADO_COMPLEMENTOS_CONTAR','CANT','ID_PRODUCTO',$id_producto);

		//echo $axcomplemento.'<br>';



 	echo "
 		<tr> 		
 			<td class='ocultar' style='text-align: center;'>".$id_producto."</td> 
 			<td class='ocultar' style='text-align: center;'>".$cod_producto."</td> 
 			<td class='ocultar' style='text-align: center;'>".$nom_categoria."</td>";

 		if($axcomplemento > 0){
			echo "<td style='text-align: left;'>
					<a href='#' id='btn_complemento' data-cod='$cod_producto' data-id='$id_producto' data-nom='$nom_producto' style='text-decoration:none;'data-bs-toggle='modal' data-bs-target='#exampleModal_2'>".utf8_encode($nom_producto).''."<span class='badge rounded-pill text-bg-danger'>$axcomplemento</span></a>
				</td> ";
		}else{
			echo "<td style='text-align: left;'>
					<a href='#' id='btn_complemento' data-cod='$cod_producto' data-id='$id_producto' data-nom='$nom_producto' style='text-decoration:none;'data-bs-toggle='modal' data-bs-target='#exampleModal_2'>".utf8_encode($nom_producto)."</a>
				</td> ";
		}

 			
 		echo "
 			<td class='ocultar' style='text-align: center;'>".$tipo."</td> 
 			<td style='text-align: center;'>".$presentacion."</td> 
 			<td class='ocultar' style='text-align: center;'>".$costo."</td> 
 			<td style='text-align: right;'>".$cant_caja."</td>";

 			if($axpeso==0){
 				echo "<td style='text-align: right;'><b class='text-danger'>".$axpeso."</b></td> ";
 			}else{
 				echo "<td style='text-align: right;'>".$axpeso."</td> ";	
 			}

 			

 			echo "
 			<td class='ocultar' style='text-align: center;'>".$estado."</td>  			
 			<td style='text-align: center;'>
 				


 				<div class='btn-group dropstart'>
					<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
					<ul class='dropdown-menu'>	
					<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-info' id='btn_editar_producto' data-id='$id_producto' data-bs-toggle='modal' data-bs-target='#exampleModal'><b><i class='bi bi-pencil' ></i> Editar</a></b>
					<a href='#' class='dropdown-item text-danger' id='btn_eliminar_producto' data-id='$id_producto' ><b><i class='bi bi-trash3-fill'></i> Eliminar</a></b>
					<div><hr class='dropdown-divider'></div>
					</ul>
				</div>

 			</td> 
 		</tr>
 	";

}
echo "</table>";
}


break;

case '7': //EDITAR PRODUCTOS
	
	
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

case '8': //grabar productos
	
	$axparametros = $_POST['txtparametros']; 
	$axid_empresa = $_POST['txtid_empresa'];
	$axid_producto = $_POST['txtid_producto'];
	$axid_categoria = $_POST['txtid_categoria'];
	$axestado = $_POST['txtestado'];
	$axcod_producto = $_POST['txtcod_producto'];
	$axnom_producto = $_POST['txtnom_producto'];
	$axtipo = $_POST['txttipo'];
	$axpresentacion = $_POST['txtpresentacion'];
	$axprocedencia = $_POST['txtprocedencia'];
	$axrotacion = $_POST['txtrotacion'];
	$axcant_caja = $_POST['txtcant_caja'];
	$axprs_minimo = $_POST['txtprs_minimo'];
	$axprs_menor = $_POST['txtprs_menor'];
	$axprs_mayor = $_POST['txtprs_mayor'];
	$axprs_premium = $_POST['txtprs_premium'];
	$axcosto_producto = $_POST['txtcosto_producto'];
	$axmargen_producto = $_POST['txtmargen_producto'];
	$axid_afectacion = $_POST['txtid_afectacion'];
	$axpeso_producto = $_POST['txtpeso_producto'];
	$axfactor_producto = $_POST['txtfactor_producto'];
	
	
	if($axparametros==1){

		$Insertar = "INSERT INTO PRODUCTOS (COD_PRODUCTO,ID_CATEGORIA,NOM_PRODUCTO,TIPO,PRESENTACION,PROCEDENCIA,ESTADO,ROTACION,CANT_CAJA,PRS_MENOR,PRS_MAYOR,PRS_PREMIUN,COSTO_PRODUCTO,MARGEN_PRODUCTO,ID_EMPRESA,ID_AFECTACION,PRS_MINIMO,PESO_PRODUCTO,FACTOR_PROD) VALUES ('$axcod_producto','$axid_categoria','$axnom_producto','$axtipo','$axpresentacion','$axprocedencia','$axestado','$axrotacion','$axcant_caja','$axprs_menor','$axprs_mayor','$axprs_premium','$axcosto_producto','$axmargen_producto','$axid_empresa','$axid_afectacion','$axprs_minimo','$axpeso_producto','$axfactor_producto')";
//echo "$Insertar";
		
	} else {

		$Insertar ="UPDATE PRODUCTOS SET COD_PRODUCTO='$axcod_producto',ID_CATEGORIA='$axid_categoria',NOM_PRODUCTO='$axnom_producto',TIPO='$axtipo',PRESENTACION='$axpresentacion',PROCEDENCIA='$axprocedencia',ESTADO='$axestado',ROTACION='$axrotacion',CANT_CAJA='$axcant_caja',PRS_MENOR='$axprs_menor',PRS_MAYOR='$axprs_mayor',PRS_PREMIUN='$axprs_premium',COSTO_PRODUCTO='$axcosto_producto',MARGEN_PRODUCTO='$axmargen_producto',ID_EMPRESA='$axid_empresa',ID_AFECTACION='$axid_afectacion',PRS_MINIMO='$axprs_minimo',PESO_PRODUCTO='$axpeso_producto',FACTOR_PROD='$axfactor_producto' WHERE ID_PRODUCTO='$axid_producto'";
			
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

case '9':
	

$axbuscar_categoria = $_POST['txtbuscar_categorias']; 	


	if($axbuscar_categoria==""){
		
		$SQLBuscar = "SELECT  * FROM CATEGORIAS ORDER BY NOM_CATEGORIA ASC ";
		
	}else{

		$SQLBuscar ="SELECT  * FROM CATEGORIAS WHERE  NOM_CATEGORIA like '%".$axbuscar_categoria."%' ";

	}

	//echo "$SQLBuscar";

	echo "
		<div id='div3'>
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th style='text-align: center;'>Item</th>
			<th style='text-align: center;'>Código</th>
			<th style='text-align: left;'>Categoría</th>			
			<th style='text-align: center;'>Acción</th>
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$axid_categoria = $fila['ID_CATEGORIA'];		
		$nom_categoria = $fila['NOM_CATEGORIA'];
		

 	echo "
 		<tr> 		
 			<td style='text-align: center;'>".$it."</td> 
 			<td style='text-align: center;'>".$axid_categoria."</td> 
 			<td style='text-align: left;'>".utf8_encode($nom_categoria)."</td>  			
 			<td style='text-align: center;'>
 				<a href='#' class='btn btn-outline-info btn-sm' id='btn_editar_categoria' data-id='$axid_categoria' data-bs-toggle='modal' data-bs-target='#exampleModal_1'><i class='bi bi-pencil'></i> Editar</a>
 			</td> 
 		</tr>
 	";

}
echo "</table>
</div>
";
}

break;
case '10': //grabar categorias
	
	$axid_categoria_1 = $_POST['txtid_categoria_1']; 	
	$axnom_categoria = $_POST['txtnom_categoria']; 
	$axtipo_categoria = $_POST['txttipo_categoria']; 
	$axparamentro = $_POST['txtparametros']; 

	if($axparamentro==1){

		$SQLActualizar ="INSERT INTO CATEGORIAS (NOM_CATEGORIA,TIPO_CATEGORIA) VALUES ('$axnom_categoria','$axtipo_categoria')";	

	}else{

		$SQLActualizar = "UPDATE CATEGORIAS SET NOM_CATEGORIA='$axnom_categoria',TIPO_CATEGORIA='$axtipo_categoria' WHERE ID_CATEGORIA='$axid_categoria_1'";

	}
	echo $SQLActualizar;
	$RSActualizar = odbc_exec($con,$SQLActualizar);

	if($RSActualizar){

		$respuesta = 0;
		echo $respuesta;

	}else{

		$respuesta = 1;
		echo $respuesta;

	}

	break; 
case '11'://editar categorias
	
	$axid_categoria_1= $_POST['txtid_categoria_1'];
	
	$sql6 = "SELECT * FROM CATEGORIAS WHERE ID_CATEGORIA = '$axid_categoria_1'";
	
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


case '311':
	
	$idusuario = $_POST['txtid_usuario'];
	

	$sqleliminar = "DELETE FROM USUARIOS WHERE ID_USUARIO ='$idusuario'";
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


case '12': //grilla de productos por agregarlos como complemento
	
$axbuscaregistro = $_POST['txtbuscar_complemento']; 	
$axid_empresa = $_POST['txtid_empresa']; 	

	if($axbuscaregistro==""){
		
		$SQLBuscar = "SELECT  TOP 10  ID_PRODUCTO,COD_PRODUCTO,NOM_CATEGORIA,NOM_PRODUCTO,TIPO,PRESENTACION,PROCEDENCIA,ESTADO,CANT_CAJA FROM PRODUCTOS_LISTADO WHERE ID_EMPRESA = '$axid_empresa'";
		
	}else{

		$SQLBuscar ="SELECT  TOP 10 ID_PRODUCTO,COD_PRODUCTO,NOM_CATEGORIA,NOM_PRODUCTO,TIPO,PRESENTACION,PROCEDENCIA,ESTADO,CANT_CAJA FROM PRODUCTOS_LISTADO WHERE ID_EMPRESA = '$axid_empresa' AND COD_PRODUCTO like '%".$axbuscaregistro."%' ";

	}

	//echo "$SQLBuscar";

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th style='text-align: left;'>Descripción</th>			
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$id_producto = $fila['ID_PRODUCTO'];
		$cod_producto = $fila['COD_PRODUCTO'];
		$nom_categoria = $fila['NOM_CATEGORIA'];
		$nom_producto = $fila['NOM_PRODUCTO'];
		$tipo = $fila['TIPO'];
		$presentacion = $fila['PRESENTACION'];
		$procedencia = $fila['PROCEDENCIA'];
		$estado = $fila['ESTADO'];
		$cant_caja = $fila['CANT_CAJA'];


 	echo "
 		<tr> 	
 		<td style='text-align: left;'>
 		<a href='#' id='btn_complemento_agregar' data-id='$id_producto' data-tipo='AGREGAR' style='text-decoration:none;' title='Click para asignar...'>".$id_producto.' | '.$cod_producto.' | '.utf8_encode($nom_producto)."</a>
 		</td>  			 			
 		</tr>
 	";

}
echo "</table>";
}


break;

case '13': //asingar complementos

$axid_producto_compl = $_POST['txtid_producto_compl']; 	
$axid_producto_padre = $_POST['txtid_producto_padre']; 	
$axid_empresa = $_POST['txtid_empresa']; 
$axfactor_complemento = $_POST['txtfactor_complemento']; 
$axtipo_mov = $_POST['axtipo_mov']; 

$axcosto_padre = get_row('PRODUCTOS','COSTO_PRODUCTO','ID_PRODUCTO',$axid_producto_padre);
$axcosto_hijo = get_row('PRODUCTOS','COSTO_PRODUCTO','ID_PRODUCTO',$axid_producto_compl);

if($axcosto_padre <= 0 ){

	$respuesta=3; //costo producto padre es 0
	echo $respuesta;
	break;

}elseif($axcosto_hijo <= 0){

	$respuesta=4; //costo producto hijo es 0
	echo $respuesta;
	break;

}else{
	$axporc_precio_hijo_1 =($axcosto_hijo*$axfactor_complemento)/$axcosto_padre;
	echo $axporc_precio_hijo_1;
}




//echo $axporc_precio_hijo_1;

$axporc_precio_hijo = number_format($axporc_precio_hijo_1,4,".",",");

if($axtipo_mov=='AGREGAR'){

	if($axfactor_complemento > 0){

			$sqlbuscar = "SELECT * FROM PRODUCTOS_COMP WHERE ID_PRODUCTO='$axid_producto_padre' AND  ID_PRODUCTO_COMP='$axid_producto_compl' and ID_EMPRESA='$axid_empresa'";
			$rsbuscar = odbc_exec($con,$sqlbuscar);
			//echo $sqlbuscar;

			if(odbc_num_rows($rsbuscar) > 0) {
				
				$respuesta=0;
				echo $respuesta;

			}else{

				$SQLInsert = "INSERT INTO PRODUCTOS_COMP (ID_PRODUCTO_COMP,ID_PRODUCTO,ID_EMPRESA,PORC_COMPL,PRS_MINIMO_COMPL,FACTOR_COMPL) VALUES ('$axid_producto_compl','$axid_producto_padre','$axid_empresa','$axporc_precio_hijo','$axcosto_hijo','$axfactor_complemento')";
				$RSInsert = odbc_exec($con,$SQLInsert);
				//echo $SQLInsert;

				$respuesta=1;
				echo $respuesta;
			}

	}else{

		$respuesta=6; // falta FACTOR
		echo $respuesta;
	}

	

}elseif($axtipo_mov=='Quitar'){


	$SQLDelete ="DELETE FROM PRODUCTOS_COMP WHERE ID_PRODUCTO='$axid_producto_padre' AND  ID_PRODUCTO_COMP='$axid_producto_compl' and ID_EMPRESA='$axid_empresa'";
	$RSDelete = odbc_exec($con,$SQLDelete);

	$respuesta=1;
	echo $respuesta;
}



break;

case '14': //grilla productos complemento
	
$axid_producto_padre = $_POST['txtid_producto_padre']; 	
$axid_empresa = $_POST['txtid_empresa']; 	

$SQLBuscar = "SELECT  * FROM PRODUCTOS_LISTADO_COMPLEMENTOS WHERE ID_PRODUCTO = '$axid_producto_padre'";
		

	//echo "$SQLBuscar";

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th style='text-align: left;'>Descripción</th>			
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$id_producto = $fila['ID_PRODUCTO_COMP'];
		$nom_producto = $fila['NOM_PRODUCTO'];
		$cod_producto = $fila['COD_PRODUCTO'];
		$porc_hijo = $fila['PORC_COMPL'];
		$axt_porc =$axt_porc+$porc_hijo;
 		$axprecio = $fila['PRS_MINIMO_COMPL'];

 	echo "
 		<tr> 	
 		<td style='text-align: left;'>
 		<a href='#' id='btn_complemento_agregar' data-id='$id_producto' data-tipo='Quitar' style='text-decoration:none;' title='Click para quitar..'>".$cod_producto.' | '.utf8_encode($nom_producto).' | '.$porc_hijo.' | '.$axprecio."</a>
 		</td>  			 			
 		</tr>
 	";

}
echo "
	<tr> 	
 		<td style='text-align: left;'>".number_format($axt_porc,2,".",",").'%'."</td>  			 			
 		</tr>
";
echo "</table>";
}

break;

case '15': //listar proveedores o clientes
	

$axbuscaregistro = $_POST['txtbuscar']; 	
$axid_vendedor = $_POST['txtid_usuario_1']; 	
$axid_empresa = $_POST['txtid_empresa']; 	
$axtipo_beneficiario = $_POST['txttipo_beneficiario']; 	

	if($axbuscaregistro==""){
		
		if($axid_vendedor=='Seleccionar'){
			$SQLBuscar = "SELECT TOP 50 * FROM BENEFICIARIOS WHERE ID_EMPRESA = '$axid_empresa' AND TIPO_PROV_CLIE='$axtipo_beneficiario' order by COD_INTERNO ASC";	
		}else{
			$SQLBuscar = "SELECT TOP 50 * FROM BENEFICIARIOS WHERE ID_EMPRESA = '$axid_empresa' AND TIPO_PROV_CLIE='$axtipo_beneficiario' AND ID_USUARIO='$axid_vendedor' order by COD_INTERNO ASC";
		}
		
	}else{

				if($axid_vendedor=='Seleccionar'){
					$SQLBuscar ="SELECT TOP 50 *  FROM BENEFICIARIOS WHERE ID_EMPRESA = '$axid_empresa' AND TIPO_PROV_CLIE='$axtipo_beneficiario' AND RAZON_SOCIAL like '%".$axbuscaregistro."%' ";
				}else{
					$SQLBuscar ="SELECT TOP 50 *  FROM BENEFICIARIOS WHERE ID_EMPRESA = '$axid_empresa' AND TIPO_PROV_CLIE='$axtipo_beneficiario'  AND ID_USUARIO='$axid_vendedor' AND RAZON_SOCIAL like '%".$axbuscaregistro."%' ";
				}

		

	}

	//echo "$SQLBuscar";

	echo "
		<div style='margin-top:5px; padding:5px; text-align: right;'>
		<a href='exportar_excel.php?param=8&empresa=$axid_empresa&tipo=$axtipo_beneficiario'  class='btn btn-outline-success btn-sm' ><b> <i class='bi bi-file-earmark-excel-fill'></i> Excel</b></a>
		</div>

		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th class='ocultar' style='text-align: center;'>Item</th>
			<th class='ocultar' style='text-align: left; width:8%;'>Código</th>
			<th class='ocultar' style='text-align: left; width:8%;'>Tipo documento</th>
			<th style='text-align: left;'>Razón social</th>
			<th class='ocultar' style='text-align: left;'>Domicilio Entrega</th>
			<th class='ocultar' style='text-align: left;'>Distrito</th>
			<th class='ocultar' style='text-align: center;'>Telefono</th>						
			<th style='text-align: center;'>Revisión</th>
			<th style='text-align: center;'>Acción</th>
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$id_beneficiario = $fila['ID_BENEFICIARIO'];
		$cod_interno = $fila['COD_INTERNO'];
		$id_doc = $fila['ID_DOC'];
		$axruc =$fila['RUC_BENEF'];
		$razon_social = $fila['RAZON_SOCIAL'];
		$domic_entrega_pred = $fila['DIRECCION_ENTREGA'];
		$axestado_revision = $fila['ESTADO_REVISION'];


		if ($domic_entrega_pred==''){
			$domic_entrega_pred ='<b class="text-danger">Falta asignar domicilio de entrega...</b>';			
		}

		$distrito = $fila['DISTRITO'];
		$telefono = $fila['TELEFONO'];		
		$estado = $fila['ESTADO'];
		

 	echo "
 		<tr> 		
 			<td class='ocultar' style='text-align: center;'>".$it."</td> 
 			<td class='ocultar' style='text-align: left; width:8%;'>".$cod_interno."</td> 
 			<td class='ocultar' style='text-align: left; width:8%;'>".$id_doc.' | '.$axruc."</td> 
 			<td style='text-align: left;'>".$razon_social."</td>
 			<td class='ocultar' style='text-align: left;'>".$domic_entrega_pred."</td>
 			<td class='ocultar' style='text-align: left;'>".$distrito."</td>
 			<td class='ocultar' style='text-align: center;'>".$telefono."</td>";
 			
		if($axestado_revision=='PENDIENTE'){
			echo "<td class=' text-danger' style='text-align: center;'><b>".$axestado_revision."</b></td>";
		}else{
			echo "<td style='text-align: center;'>".$axestado_revision."</td>";
		}

 			
 		echo "
 			<td  style='text-align: center;'>
 				<div class='btn-group dropstart'>
					<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
					<ul class='dropdown-menu'>	
					<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-info' id='btn_editar_beneficiarios' data-id='$id_beneficiario' data-bs-toggle='modal' data-bs-target='#exampleModal'><b><i class='bi bi-pencil' ></i> Editar</a></b>
					<a href='#' class='dropdown-item text-danger' id='btn_eliminar_beneficiarios' data-id='$id_beneficiario' ><b><i class='bi bi-trash3-fill'></i> Eliminar</a></b>
					<div><hr class='dropdown-divider'></div>
					<a href='#' class='dropdown-item text-success' id='btn_beneficiarios_dir' data-idb='$id_beneficiario' data-nomb_benef='$razon_social' data-id='$cod_interno' data-bs-toggle='modal' data-bs-target='#exampleModal_1' ><b><i class='bi bi-geo-alt-fill'></i> Dir. Entrega</a></b>
					<div><hr class='dropdown-divider'></div>
					</ul>
				</div>
 			</td>";

}
echo "</table>";
}

break;

case '16': //eliminaar productos
	
$axid_empresa = $_POST['txtid_empresa']; 	
$axid_producto = $_POST['txtid_producto']; 	

$SQLEliminar ="DELETE FROM PRODUCTOS WHERE ID_PRODUCTO='$axid_producto' AND ID_EMPRESA='$axid_empresa'";
$RSEliminar = odbc_exec($con,$SQLEliminar);

if($RSEliminar){
	$respuesta =0;
	echo $respuesta;
}else{
	$respuesta =1;
	echo $respuesta;
}


break;

case '17': //grabar beneficiarios

$axid_empresa = $_POST['txtid_empresa']; 
$axid_usuario = $_POST['txtid_usuario']; 
$axserie_user = get_row('USUARIOS','N_SERIE_VENDEDOR','ID_USUARIO',$axid_usuario);
	
$axid_beneficiario = $_POST['txtid_beneficiario']; 
$axtipo_beneficiario = $_POST['txttipo_beneficiario']; 	
$axid_doc = $_POST['txtid_doc']; 	
$axruc_benef = $_POST['txtruc_benef']; 	
$axcod_interno = $_POST['txtcod_interno']; 	
$axnombre_comercial = strtoupper($_POST['txtnombre_comercial']); 	
$axrazon_social_cliente = strtoupper($_POST['txtrazon_social_cliente']); 	
$axpaterno = $_POST['txtpaterno']; 	
$axmaterno = $_POST['txtmaterno']; 	
$axnombre = $_POST['txtnombre']; 		
$axdomicilio_fiscal = strtoupper($_POST['txtdomicilio_fiscal']); 

$axurb_emis = $_POST['txturb_emis']; 	
$axdistrito = $_POST['txtdistrito']; 	
$axreferencia = strtoupper($_POST['txtreferencia']); 	
$axtelefono = $_POST['txttelefono']; 	
$axemail_cliente = $_POST['txtemail_cliente']; 	
$axgrupo = $_POST['txtgrupo']; 	
$axhorario_atencion = $_POST['txthorario_atencion']; 	
$axdivision = $_POST['txtdivision']; 		
$axestado_cliente = $_POST['txtestado_cliente']; 		
$axid_empresa = $_POST['txtid_empresa']; 		
$axestado_revision = $_POST['txtestado_revision']; 		
$axid_usuario = $_POST['txtid_usuario']; 		
$axmonto_cuota = $_POST['txtmonto_cuota']; 		
$axid_usuario_2 = $_POST['txtid_usuario_2'];

$axdomicilio_entrega= strtoupper($_POST['txtdomicilio_entrega']);

$axid_direccion = $_POST['txtid_direccion']; 	
$axcod_interno_traer = $_POST['txtcod_interno']; 	
$axdireccion_alter = strtoupper($_POST['txtdomicilio_entrega']); 	
$axdistrito_alter = $_POST['txtdistrito_alter_1']; 	
$axreferencia_1 = $_POST['txtreferencia_entrega']; 		
$axcod_ubi_llegada = $_POST['txtubigeo_alternativo']; 	
$axid_vendedor = $_POST['txtid_vendedor']; 	


$axparametros = $_POST['txtparametros']; 		


if($axcod_interno==''){
	$axcod_interno=$axruc_benef;
}

if($axparametros==1){

	$axcod_interno_traer =$axserie_user.'-'.$_POST['txtcod_interno']; 	

	$SQLInsert = "INSERT INTO BENEFICIARIOS_DIR (COD_INTERNO,DIRECCION_ALTER,DISTRITO_ALTER,REFERENCIA_1,cod_ubi_llegada) VALUES ('$axcod_interno_traer','$axdireccion_alter','$axdistrito_alter','$axreferencia_1','$axcod_ubi_llegada')";
	$RSInsert = odbc_exec($con,$SQLInsert);
	//echo $SQLInsert;

	if($RSInsert){

		$axid_direccion = get_row('BENEFICIARIOS_DIR','ID_DIRECCION','COD_INTERNO',$axcod_interno_traer);

		$axcod_interno_grabar = $axserie_user.'-'.$axcod_interno;

		$SQLGrabar = "INSERT INTO BENEFICIARIOS (TIPO_PROV_CLIE,ID_DOC,RUC_BENEF,COD_INTERNO,NOM_COMERCIAL,RAZON_SOCIAL,PATERNO,MATERNO,NOMBRES,DIRECCION_FISCAL,DIRECCION_ENTREGA,TXT_URB_EMIS,DISTRITO,REFERENCIA,TELEFONO,EMAIL_PROVEEDOR,GRUPO,HORARIO_ATENCION,DIVISION,ESTADO,ID_EMPRESA,ESTADO_REVISION,ID_USUARIO,MONTO_CUOTA,ID_DIRECCION) VALUES ('$axtipo_beneficiario','$axid_doc','$axruc_benef','$axcod_interno_grabar','$axnombre_comercial','$axrazon_social_cliente','$axpaterno','$axmaterno','$axnombre','$axdomicilio_fiscal','$axdomicilio_entrega','$axurb_emis','$axdistrito','$axreferencia','$axtelefono','$axemail_cliente','$axgrupo','$axhorario_atencion','$axdivision','$axestado_cliente','$axid_empresa','$axestado_revision','$axid_vendedor','$axmonto_cuota','$axid_direccion')";

	}

}else{

$SQLGrabar ="UPDATE BENEFICIARIOS SET TIPO_PROV_CLIE='$axtipo_beneficiario',ID_DOC='$axid_doc',RUC_BENEF='$axruc_benef',COD_INTERNO='$axcod_interno',NOM_COMERCIAL='$axnombre_comercial',RAZON_SOCIAL='$axrazon_social_cliente',PATERNO='$axpaterno',MATERNO='$axmaterno',NOMBRES='$axnombre',DIRECCION_FISCAL='$axdomicilio_fiscal',DIRECCION_ENTREGA='$axdomicilio_entrega',TXT_URB_EMIS='$axurb_emis',DISTRITO='$axdistrito',REFERENCIA='$axreferencia',TELEFONO='$axtelefono',EMAIL_PROVEEDOR='$axemail_cliente',GRUPO='$axgrupo',HORARIO_ATENCION='$axhorario_atencion',DIVISION='$axdivision',ESTADO='$axestado_cliente',ID_EMPRESA='$axid_empresa',ESTADO_REVISION='$axestado_revision',ID_USUARIO='$axid_vendedor',MONTO_CUOTA='$axmonto_cuota' WHERE ID_BENEFICIARIO='$axid_beneficiario'";
}

$RSGrabar = odbc_exec($con,$SQLGrabar);

//echo $SQLGrabar;

if($RSGrabar){

	if($axparametros==1){

		$axcod_interno_actualizar = $axcod_interno;
		//$SQLActualizar = "UPDATE EMPRESA SET CORRELATIVO_CLIENTES='$axcod_interno_actualizar' WHERE ID_EMPRESA='$axid_empresa'";
		$SQLActualizar = "UPDATE USUARIOS SET CORRELATIVO_CLIENTES='$axcod_interno_actualizar' WHERE ID_USUARIO='$axid_usuario'";
		$RSActualizar = odbc_exec($con,$SQLActualizar);	
	}
	

	$respuesta =0;
	echo $respuesta;

}else{

	$respuesta =1;
	echo $respuesta;
}


break;

case '18':// traer datos de los beneficiarios  APP VENDEDORES Y EN OTROS MODULOS
	
$axid_beneficiario= $_POST['txtid_beneficiario'];
	
	//$sql6 = "SELECT * FROM BENEFICIARIOS_CON_DIR_ALTERNA WHERE ID_BENEFICIARIO = '$axid_beneficiario'";
	$sql6 = "SELECT * FROM BENEFICIARIOS WHERE ID_BENEFICIARIO = '$axid_beneficiario'";
	
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

case '19': //RENIEC
	
$token ='apis-token-1842.1TicMx74Ee3kROx3PHhIW7dScOyG6P3n';
$dni = $_POST['txtruc_benef']; 

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


case '20': //eliminar beneficiarios
	
$axid_empresa = $_POST['txtid_empresa']; 	
$axid_beneficiario = $_POST['txtid_beneficiario']; 	

$SQLEliminar ="DELETE FROM BENEFICIARIOS WHERE ID_BENEFICIARIO='$axid_beneficiario'";
$RSEliminar = odbc_exec($con,$SQLEliminar);

if($RSEliminar){
	$respuesta =0;
	echo $respuesta;
}else{
	$respuesta =1;
	echo $respuesta;
}

break;

case '21': // grilla de las direcciones alternativas del beneficiario
	

$axcod_interno_traer = $_POST['txtcod_interno_traer']; 	
$txtid_beneficiario = $_POST['txtid_beneficiario']; 	

$axid_usuario = $_POST['txtid_usuario']; 		
$axnom_modulo = $_POST['txtnom_modulo']; 
$axnom_cliente = get_row('BENEFICIARIOS','NOM_COMERCIAL','COD_INTERNO',$axcod_interno_traer);
$axdetalle = $_POST['axdetalle'].' '.$axnom_cliente; 

guardar_bitacora($axid_usuario,$axnom_modulo,$axdetalle);


$SQLBuscar ="SELECT  * FROM BENEFICIARIOS_DIR WHERE COD_INTERNO='$axcod_interno_traer'";
//echo "$SQLBuscar";

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th style='text-align: center;'></th>
			<th style='text-align: left;'>Direccion</th>			
			
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$axcod_interno = $fila['COD_INTERNO'];		
 		$axid_direccion = $fila['ID_DIRECCION'];		
		$axdireccion_alter = utf8_encode($fila['DIRECCION_ALTER']);
		$axdistrito_alter = utf8_encode($fila['DISTRITO_ALTER']);
		$axreferencia_1 = $fila['REFERENCIA_1'];
		$axubigeo = utf8_encode($fila['cod_ubi_llegada'].' | '.$axdistrito_alter);

		if($axreferencia_1=='SIN REFERENCIA' || $axreferencia_1=='')		{
			$axreferencia_1 = '';
		}else{
			$axreferencia_1 = $fila['REFERENCIA_1'];
		}

 	echo "
 		<tr> 		
 			<td style='text-align: center;'>
 			<a href='#' class='text-danger' id='btn_editar_beneficiarios_alter' data-id='$axid_direccion' ><b><i class='bi bi-pencil-square'></i></a></b>
 			<a href='#' class='text-danger' id='btn_eliminar_beneficiarios_alter' data-id='$axid_direccion' ><b><i class='bi bi-trash3-fill'></i></a></b>
 			</td> 

 			<td style='text-align: left;'>
 			<a href='#' style='text-decoration:none;' id='btn_predeterminada_direc' data-id='$axid_direccion' data-dir_alter='$axdireccion_alter' ><b class='text-danger'>".$axubigeo.' </b><br><b>'.utf8_encode($axdireccion_alter).'<br>'.$axreferencia_1."
 			</a></b>
 			</td> 
 			 			 			
 		</tr>
 	";

}
echo "</table>";
}else{
	echo "<h3>FALTA ASIGNAR DIRECCION DE ENTREGA</h3>";
}

break;

case '22': //grabar direcciones alternativas al beneficiario

$axid_direccion = $_POST['txtid_direccion']; 	
$axcod_interno_traer = $_POST['txtcod_interno_traer']; 	
$axdireccion_alter = $_POST['txtdireccion_alter']; 	
$axdistrito_alter = $_POST['txtdistrito_alter']; 	
$axreferencia_1 = $_POST['txtreferencia_1']; 	
$axcod_ubi_llegada = $_POST['cod_ubi_llegada']; 	
$axparametros = $_POST['txtparametros']; 	

if($axparametros==1){
	
	$SQLInsert = "INSERT INTO BENEFICIARIOS_DIR (COD_INTERNO,DIRECCION_ALTER,DISTRITO_ALTER,REFERENCIA_1,cod_ubi_llegada) VALUES ('$axcod_interno_traer','$axdireccion_alter','$axdistrito_alter','$axreferencia_1','$axcod_ubi_llegada')";

}else{

	$SQLInsert = "UPDATE BENEFICIARIOS_DIR SET COD_INTERNO='$axcod_interno_traer',DIRECCION_ALTER='$axdireccion_alter',DISTRITO_ALTER='$axdistrito_alter',REFERENCIA_1='$axreferencia_1',cod_ubi_llegada='$axcod_ubi_llegada' WHERE ID_DIRECCION='$axid_direccion'";
}
	//echo $SQLInsert;

	$RSInsert = odbc_exec($con,$SQLInsert);

	if($RSInsert){
		$respuesta =0;
		echo $respuesta;
	}else{
		$respuesta =1;
		echo $respuesta;
	}

break;

case '23': //eliminar una direccion alternativa de un beneficiario
	
$axid_direccion = $_POST['txtid_direccion']; 	

$SQLEliminar = "DELETE FROM BENEFICIARIOS_DIR WHERE ID_DIRECCION ='$axid_direccion'";
$RSEliminar = odbc_exec($con,$SQLEliminar);

if($RSEliminar){
	$respuesta =0;
	echo $respuesta;
}else{
	$respuesta =1;
	echo $respuesta;
}

break;

case '24':
	
$axid_direccion = $_POST['txtid_direccion']; 	
$axdireccion_alter = $_POST['txtdomicilio_entrega']; 	
$axid_beneficiario = $_POST['txtid_beneficiario']; 	
$axnum_pedido = $_POST['txtnum_pedido']; 	
$axid_local = $_POST['txtid_local']; 	

$SQLActualizar = "UPDATE BENEFICIARIOS SET DIRECCION_ENTREGA='$axdireccion_alter',ID_DIRECCION='$axid_direccion' WHERE ID_BENEFICIARIO='$axid_beneficiario'";
$RSActualizar = odbc_exec($con,$SQLActualizar);

//echo $SQLActualizar;

if($RSActualizar){


	$SQLBuscar = "SELECT * FROM PEDIDOS WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	if(odbc_num_rows($RSBuscar) > 0) {

		$SQLActualizar_PD = "UPDATE PEDIDOS SET DIRECCION_ENTREGA='$axdireccion_alter' WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
		$RSActualizar_PD = odbc_exec($con,$SQLActualizar_PD);

	}

	$respuesta =0;
	echo $respuesta;
}else{
	$respuesta =1;
	echo $respuesta;
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
		$axtipo = $fila['DETALLE_MOVIMIENTO'];
		$axdocumento =$fila['TXT_SERIE'].'-'.$fila['DOCUMENTO'];
		$axnom_proveedor = $fila['RAZON_SOCIAL'];
		$axglosa = $fila['GLOSA'];
		$axmonto = number_format($fila["TOTAL_VENTA"],2,".",","); 
		$axarchivo_digital = $fila['BOUCHER_DIGITAL_1'];
		$axestado_pagado = get_row('MAESTRO_DT','ESTADO_FORMA_PAGO','COD_MOV',$axcod_mov);

		if($axmonto=='' || $axmonto==0.00){
			$axmonto=0;
		}
		
		$contar =strlen($axarchivo_prcd);
		$restar = ($contar -3);
		$extencion = substr($axarchivo_digital,$restar,3);


	

 	echo "
 		<tr> 		
 			<td class='ocultar' style='text-align: center;'>".$it."</td> 
 			<td class='ocultar' style='text-align: left; width:8%;'>".$axtipo."</td> 
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

if($axdetalle_movimiento !=='MUESTRA'){
	$axestado_inventario='INVENTARIO';
	/******COMPRA Y SOBRAS ENTRAN EN POSITIVO, MERMA EN NEGATIVO AL INVENTARIO********/
}elseif($axdetalle_movimiento =='MUESTRA'){
	/***LAS MUESTRAS NO SE CONSIDERAN EN EL STOCK**/
	$axestado_inventario='';
}

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
$axtipo_nota_debito = $_POST['txttipo_nota_debito'];


if($axtipo_cambio==''){
	$axtipo_cambio=0;
}

//SE AGREGO EL 22.06.23
if($axid_td=='6'){

	if($axcod_tip_nc_nd_ref=='05'){
		$axestado_inventario='';
	}else{
		$axestado_inventario='INVENTARIO';
	}

}




$axparametros = $_POST['txtparametros'];

if($axparametros==1){

$SQLInsert = "INSERT INTO MAESTRO_CZ (COD_MOV,TIPO_MOV,DETALLE_MOVIMIENTO,FECHA_EMISION,PERIODO_EMISION,ID_TD,TXT_SERIE,DOCUMENTO,ID_BENEFICIARIO,ID_USUARIO,FECHA_REGISTRO,ANO,ID_LOCAL,GLOSA,PERIODO_CONTABLE,MONEDA,ESTADO_ELECTRO,FECHA_CONTABLE,ESTADO_FINAL,ESTADO_ENVIADO_ITC,TIPO_CAMBIO,FECHA_LLEGADA,DOC_INGRESO,ESTADO_INVENTARIO,TIPO_COMPRA,cod_tip_nc_nd_ref,TIPO_NDEBITO) VALUES ('$axcod_mov','$axtipo_mov','$axdetalle_movimiento','$axfecha_emision','$axperiodo_emision','$axid_td','$axn_serie','$axdocumento','$axid_beneficiario','$axcodusuario','$axfecha_registro','$ano_registro','$axid_local','$axglosa','$axperiodo_emision','$axmoneda','PROCESADA','$axfecha_emision','PROCESADA','ENVIADO','$axtipo_cambio','$axfecha_llegada_mercaderia','$axdoc_ingreso_mercaderia','$axestado_inventario','$axdetalle_ingreso','$axcod_tip_nc_nd_ref','$axtipo_nota_debito')";

}else{

$SQLInsert ="UPDATE MAESTRO_CZ SET TIPO_MOV='$axtipo_mov',DETALLE_MOVIMIENTO='$axdetalle_movimiento',FECHA_EMISION='$axfecha_emision',PERIODO_EMISION='$axperiodo_emision',ID_TD='$axid_td',TXT_SERIE='$axn_serie',DOCUMENTO='$axdocumento',ID_BENEFICIARIO='$axid_beneficiario',ID_USUARIO='$axcodusuario',FECHA_REGISTRO='$axfecha_registro',ANO='$ano_registro',ID_LOCAL='$axid_local',GLOSA='$axglosa',PERIODO_CONTABLE='$axperiodo_emision',MONEDA='$axmoneda',ESTADO_ELECTRO='PROCESADA',FECHA_CONTABLE='$axfecha_emision',ESTADO_FINAL='PROCESADA',ESTADO_ENVIADO_ITC='ENVIADO',TIPO_CAMBIO='$axtipo_cambio',FECHA_LLEGADA='$axfecha_llegada_mercaderia',DOC_INGRESO='$axdoc_ingreso_mercaderia',ESTADO_INVENTARIO='$axestado_inventario',TIPO_COMPRA='$axdetalle_ingreso',cod_tip_nc_nd_ref='$axcod_tip_nc_nd_ref',TIPO_NDEBITO='$axtipo_nota_debito' WHERE COD_MOV='$axcod_mov'";

}

//echo $SQLInsert;
$RSInserta = odbc_exec($con,$SQLInsert);

if($RSInserta){

		if($axparametros==1){

			if($axid_td=='26' || $axid_td=='11'){
					
				$SQLActualizar = "UPDATE	CORRELATIVOS	SET N_CORRELATIVO	='$axdocumento' WHERE ID_LOCAL='$axid_local' AND ID_TD='$axid_td'";
				$RSActualizar	 = odbc_exec($con,$SQLActualizar);

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
	
	$sql6 = "SELECT * FROM MAESTRO_CZ WHERE ID_LOCAL = '$axid_local' AND COD_MOV='$axcod_mov'";
	
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

$axmargen_producto = get_row('PRODUCTOS','MARGEN_PRODUCTO','ID_PRODUCTO',$axid_producto);
$axutilidad = ($axcosto_producto*$axmargen_producto)/100;
$axprs_mayor =$axcosto_producto+$axutilidad;

$axdetalle_movimiento = get_row('MAESTRO_CZ','TIPO_COMPRA','COD_MOV',$axcod_mov);
$axtipo_doc = get_row('MAESTRO_CZ','ID_TD','COD_MOV',$axcod_mov);

if($axvalor=='NEGATIVO'){

	$axcant_ingreso =$_POST['txtcant_ingreso']/-1;
	$axvalor_salida =$_POST['txtvalor_salida']/-1;
	$axigv_salida =$_POST['txtigv_salida']/-1;
	$axgravadas_salida =$_POST['txtgravadas_salida']/-1;
	$axinafecto_salida =$_POST['txtinafecto_salida']/-1;
	$axexonerado_salida =$_POST['txtexonerado_salida']/-1;
	$axtotal_salida =$_POST['txttotal_salida']/-1;
}

if($axdetalle_movimiento =='MERMA'){
	$axcant_ingreso =$_POST['txtcant_ingreso']/-1;
	$axvalor_salida =$_POST['txtvalor_salida']/-1;
	$axigv_salida =$_POST['txtigv_salida']/-1;
	$axgravadas_salida =$_POST['txtgravadas_salida']/-1;
	$axinafecto_salida =$_POST['txtinafecto_salida']/-1;
	$axexonerado_salida =$_POST['txtexonerado_salida']/-1;
	$axtotal_salida =$_POST['txttotal_salida']/-1;
}

$axtipo_nc = get_row('MAESTRO_CZ','cod_tip_nc_nd_ref','COD_MOV',$axcod_mov);

if($axtipo_doc =='6'){ //si es nota de credito

	if($axtipo_nc=='05'){
		$axcosto_producto=$_POST['txtcosto_producto']/-1;
	}elseif($axtipo_nc=='07' || $axtipo_nc=='01'){
		$axcant_ingreso =$_POST['txtcant_ingreso']/-1;	
	}

	
}


if($axparametros==1){


$sqlinserta ="INSERT INTO MAESTRO_DT (COD_MOV,ID_PRODUCTO,CANT_INGRESO,COSTO_PRODUCTO,DSCTOS_INGRESO,VALOR_INGRESO,IGV_INGRESO,GRAVADAS_INGRESO,INAFECTO_INGRESOS,EXONERADO_INGRESO,TOTAL_INGRESO,CANT_SALIDA,PRS_MAYOR,PRS_PREMIUN,PRS_MENOR,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,FORMA_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,NUM_TRANSF,POR_DETRACCION,MONTO_DETRACCION,NUM_DETRACCION,FECHA_DETRACCION,ESTADO_PRODUCTO,FECHA_TRANSF,ID_CTA,PERIODO_TRANSF) VALUES ('$axcod_mov','$axid_producto','$axcant_ingreso','$axcosto_producto','$axdsctos_ingreso','$axvalor_ingreso','$axigv_ingreso','$axgravadas_ingreso','$axinafecto_ingresos','$axexonerado_ingreso','$axtotal_ingreso','$axcant_salida','$axprs_mayor','$axprs_premiun','$axprs_menor','$axdsctos_salida','$axvalor_salida','$axigv_salida','$axgravadas_salida','$axinafecto_salida','$axexonerado_salida','$axtotal_salida','$axforma_pago','$axestado_forma_pago','$axmedio_pago','$axnum_transf','$axpor_detraccion','$axmonto_detraccion','$axnum_detraccion','$axfecha_detraccion','$axestado_producto','$axfecha_transf','$axid_cta','$axperiodo_transf')";

}else{

$sqlinserta = "UPDATE MAESTRO_DT SET COD_MOV='$axcod_mov',ID_PRODUCTO='$axid_producto',CANT_INGRESO='$axcant_ingreso',COSTO_PRODUCTO='$axcosto_producto',DSCTOS_INGRESO='$axdsctos_ingreso',VALOR_INGRESO='$axvalor_ingreso',IGV_INGRESO='$axigv_ingreso',GRAVADAS_INGRESO='$axgravadas_ingreso',INAFECTO_INGRESOS='$axinafecto_ingresos',EXONERADO_INGRESO='$axexonerado_ingreso',TOTAL_INGRESO='$axtotal_ingreso',CANT_SALIDA='$axcant_salida',PRS_MAYOR='$axprs_mayor',PRS_PREMIUN='$axprs_premiun',PRS_MENOR='$axprs_menor',DSCTOS_SALIDA='$axdsctos_salida',VALOR_SALIDA='$axvalor_salida',IGV_SALIDA='$axigv_salida',GRAVADAS_SALIDA='$axgravadas_salida',INAFECTO_SALIDA='$axinafecto_salida',EXONERADO_SALIDA='$axexonerado_salida',TOTAL_SALIDA='$axtotal_salida',FORMA_PAGO='$axforma_pago',FECHA_PAGO='$axfecha_pago',ESTADO_FORMA_PAGO='$axestado_forma_pago',MEDIO_PAGO='$axmedio_pago',NUM_TRANSF='$axnum_transf',POR_DETRACCION='$axpor_detraccion',MONTO_DETRACCION='$axmonto_detraccion',NUM_DETRACCION='$axnum_detraccion',FECHA_DETRACCION='$axfecha_detraccion',ESTADO_PRODUCTO='$axestado_producto',FECHA_TRANSF='$axfecha_transf',ID_CTA='$axid_cta',PERIODO_TRANSF='$axperiodo_transf' WHERE COD_MOV_DT='$axcod_mov_dt'";
}

//echo $sqlinserta;

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

   if($axdetalle_movimiento=='COMPRA'){
   	$axtipo_categoria ='MERCADERIA';
   }else{
   	$axtipo_categoria ='SERVICIO';
   }
		
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

		 	$output .='<a href="#" id="btn_listar_productos_egresos" class="list-group-item list-group-item-action" style="background:#DAF5FF;" data-id='.$id.' data-nom_pro='.$nom_prod.'> <i class="bi bi-box-seam-fill"></i> ' .$row['COD_PRODUCTO'].' | '.utf8_encode($row["NOM_PRODUCTO"]).' | Und: '.$row["PRESENTACION"].'</a>';
		 }

	}else{
		
		$output .='<a href="#" id="btn_listar_productos_egresos" class="list-group-item list-group-item-action bg-danger"></a>';
	
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
			<th class='table-danger ocultar_1'style='text-align: right;'>Cant</th>									
			<th class='table-danger ocultar'style='text-align: right;'>Precio</th>									
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
 			<td class='ocultar_1'style='text-align: left;''>".$axcod_producto.' | '.utf8_encode($axnom_producto)."</td>  			
 			<td contenteditable id='btn_cambiar_cantidad' data-idprod='$axid_producto' data-id_dt='$axcod_mov_dt' data-precio='$axprecio_compra' class='table-danger ocultar_1'style='text-align: right;'>".$axcant."</td> 
 			<td contenteditable id='btn_cambiar_precio' data-idprod='$axid_producto' data-id_dt='$axcod_mov_dt' data-cantidad='$axcant_compra' class='table-danger ocultar'style='text-align: right;'>".$axprecio."</td> 
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

case '36':
	

$axbuscaregistro = $_POST['txtbuscar']; 	
$axcodusuario = $_POST['txtcodusuario']; 	
$axid_local = $_POST['txtid_local']; 	
$axfecha_actual = $_POST['txtfecha_pedido']; 	
$axid_empresa = $_POST['txtid_empresa']; 	
$axfiltro_busquedas = $_POST['txtfiltro_busquedas']; 	
$axid_vendedor = $_POST['txtid_vendedor']; 	


if($axfiltro_busquedas=='LOCAL'){
	
	$SQLBuscar = "SELECT TOP 30 * FROM PEDIDOS_CZ WHERE ID_USUARIO = '$axid_vendedor' AND ID_EMPRESA='$axid_empresa' order by NUM_PEDIDO DESC";

}elseif($axfiltro_busquedas=='FECHA'){

	$SQLBuscar = "SELECT TOP 30 * FROM PEDIDOS_CZ WHERE ID_USUARIO = '$axid_vendedor' AND FECHA_PEDIDO='$axfecha_actual' order by NUM_PEDIDO ASC";

}elseif($axfiltro_busquedas=='BUSCAR'){

	$SQLBuscar ="SELECT TOP 30 *  FROM PEDIDOS_CZ WHERE ID_USUARIO = '$axid_vendedor' AND NUM_PEDIDO+RAZON_SOCIAL+NOM_COMERCIAL like '%".$axbuscaregistro."%' ";


}elseif($axfiltro_busquedas=='PENDIENTE'){

	$SQLBuscar = "SELECT TOP 30 * FROM PEDIDOS_CZ WHERE ID_USUARIO = '$axid_vendedor' AND ID_EMPRESA='$axid_empresa' AND ESTADO_ATENDIDO='PENDIENTE' order by NUM_PEDIDO DESC";


}elseif($axfiltro_busquedas=='TODOS'){

	$SQLBuscar = "SELECT TOP 30 * FROM PEDIDOS_CZ WHERE ID_USUARIO = '$axid_vendedor' AND ID_EMPRESA='$axid_empresa' order by NUM_PEDIDO DESC";	

}else{

	$SQLBuscar = "SELECT TOP 30 * FROM PEDIDOS_CZ WHERE ID_USUARIO = '$axid_vendedor' AND ID_EMPRESA='$axid_empresa' order by NUM_PEDIDO DESC";	
}

//echo "$SQLBuscar";

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-danger'>			
		<tr>
			<th style='text-align: center;'></th>			
			<th style='text-align: left;'>Detalle</th>
			<!--th style='text-align: center;'>Monto</th-->			
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$axnum_pedido = $fila['NUM_PEDIDO'];
		$axcod_interno = $fila['COD_INTERNO'];		
		$razon_social = $fila['RAZON_SOCIAL'];
		$axtotalpedido =number_format($fila["TOTAL_PEDIDO"],4,".",","); 
		$domic_entrega_pred = $fila['DIRECCION_ENTREGA'];
		$distrto_entrega_pred = $fila['DISTRITO_ALTER'];
		$axdomicilio_entrega = $domic_entrega_pred.' | '.$distrto_entrega_pred;
		
		$axestado_atendido = $fila['ESTADO_ATENDIDO'];
		$id_beneficiario= $fila['ID_BENEFICIARIO'];
		$axnom_beneficiario= $fila['NOM_COMERCIAL'];
		$axfecha_pedido= $fila['FECHA_PEDIDO'];
		$axforma_pago= $fila['FORMA_PAGO'];
		$axdias= $fila['DIAS_CREDITO'];
		$axfecha_transf= $fila['FECHA_TRANSF'];

		$axcod_mov = get_row('MAESTRO_CZ','COD_MOV','NUM_PEDIDO',$axnum_pedido);

		$axid_agencia= $fila['ID_AGENCIA'];
		$axid_td= $fila['ID_TD'];
		$axfecha_despacho= $fila['FECHA_DESPACHO'];
		$axtipo_venta= $fila['TIPO_VENTA'];

		$axcomprobante = get_row('MAESTRO_CZ','DOCUMENTO','NUM_PEDIDO',$axnum_pedido);
		//echo $axcomprobante;

		if($axcomprobante ==''){
			$aviso_1 = '';
		}else{
			$aviso_1 = '<span class="badge rounded-pill text-bg-warning">R</span>';
		}


		//echo $id_beneficiario;

	echo "<tr>";

		if($axestado_atendido=='PENDIENTE'){

			echo "<td class='text-danger'style='text-align: center;'><a href='#' title='Este boton ELIMINA de la base de datos el REGISTRO...' id='eliminar_pedido' data-id='$axnum_pedido'><i class='bi bi-trash3-fill'></i></a></td> 
 					  <td class='text-danger'style='text-align: justify;'><a href='#' class='text-danger' style='text-decoration:none;' id='btn_editar_pedido_cz' data-tventa='$axtipo_venta' data-reprogramado='$axcomprobante' data-agencia='$axid_agencia' data-tdoc='$axid_td' data-despacho='$axfecha_despacho' data-fpago='$axforma_pago' data-npedido='$axnum_pedido' data-id='$id_beneficiario' data-nomb_benef='$axnom_beneficiario' data-cod_int='$axcod_interno' data-rsocial='$razon_social' data-dir='$domic_entrega_pred' data-estado='$axestado_atendido' data-fpedido='$axfecha_pedido' data-dias='$axdias' data-fecha_transf='$axfecha_transf'>".$axnum_pedido.' - '.date('d.m.Y',strtotime($axfecha_pedido)).'<br>'.utf8_encode($razon_social).'<br><b class="text-dark">'.utf8_encode($axdomicilio_entrega).'</b><br>'.$axtotalpedido.' - <b>'.$axestado_atendido.' '.$aviso_1."</b></a></td>";

		}elseif($axestado_atendido=='REVISION'){

			echo "<td class='text-success'style='text-align: center;'><i class='bi bi-person-fill-exclamation'></i></td> 
 					  <td class='text-success'style='text-align: left;'><a href='#' class='text-success' style='text-decoration:none;' id='btn_editar_pedido_cz' data-npedido='$axnum_pedido' data-id='$id_beneficiario' data-nomb_benef='$axnom_beneficiario' data-cod_int='$axcod_interno' data-rsocial='$razon_social' data-dir='$domic_entrega_pred' data-estado='$axestado_atendido'>".$axnum_pedido.' - '.date('d.m.Y',strtotime($axfecha_pedido)).'<br>'.utf8_encode($razon_social).'<br>'.$axtotalpedido.' - <b>'.$axestado_atendido."</b></a></td>";


		}elseif($axestado_atendido=='ATENDIDO'){

			echo "<td class='text-primary'style='text-align: center;'><i class='bi bi-check-circle-fill'></i></td> 
 					  <td class='text-primary'style='text-align: left;'><a href='#' class='text-primary' style='text-decoration:none;' id='btn_editar_pedido_cz' data-npedido='$axnum_pedido' data-id='$id_beneficiario' data-nomb_benef='$axnom_beneficiario' data-cod_int='$axcod_interno' data-rsocial='$razon_social' data-dir='$domic_entrega_pred' data-estado='$axestado_atendido'>".$axnum_pedido.' - '.date('d.m.Y',strtotime($axfecha_pedido)).'<br>'.utf8_encode($razon_social).'<br>'.$axtotalpedido.' - <b>'.$axestado_atendido."</b> </a> <a href='#' id='btn_comprobante' data-id='$axcod_mov' class='text-danger' ><i class='bi bi-cc-circle-fill'></i></a></td>";

 		}elseif($axestado_atendido=='PROGRAMADO'){

			echo "<td class='text-dark'style='text-align: center;'><i class='bi bi-truck'></i></td> 
 					  <td class='text-dark'style='text-align: left;'><a href='#' class='text-dark' style='text-decoration:none;' id='btn_editar_pedido_cz' data-npedido='$axnum_pedido' data-id='$id_beneficiario' data-nomb_benef='$axnom_beneficiario' data-cod_int='$axcod_interno' data-rsocial='$razon_social' data-dir='$domic_entrega_pred' data-estado='$axestado_atendido'>".$axnum_pedido.' - '.date('d.m.Y',strtotime($axfecha_pedido)).'<br>'.utf8_encode($razon_social).'<br>'.$axtotalpedido.' - <b>'.$axestado_atendido."</b></a> </a> <a href='#' id='btn_comprobante' data-id='$axcod_mov' class='text-danger' ><i class='bi bi-cc-circle-fill'></i></a></td>";
		}

 	echo "</tr>	";

}
echo "</table>";
}

break;
case '37':
date_default_timezone_set("America/Lima");

$axid_usuario = $_POST['txtid_usuario']; 			
$axcodusuario = $_POST['txtcodusuario'];
$axid_local = $_POST['txtid_local'];
$axid_empresa = $_POST['txtid_empresa'];
	
$axdni_user = get_row('usuarios','COD_USUARIO','ID_USUARIO',$axcodusuario);
$axserie_vendedor = get_row('usuarios','N_SERIE_VENDEDOR','ID_USUARIO',$axcodusuario);
//$axcorrelativo = get_row('EMPRESA','CORRELATIVO_PEDIDOS','ID_EMPRESA',$axid_empresa)+1;
$axcorrelativo = get_row('usuarios','CORRELATIVO_VENDEDOR','ID_USUARIO',$axcodusuario)+1;

$axfecha = date('Y-m-d');
$axhora = date('H:i:s');

$axnom_usario = get_row('usuarios','NOM_USUARIO','ID_USUARIO',$axid_usuario);
$axnom_modulo = $_POST['txtnom_modulo']; 
$axdetalle = $_POST['axdetalle']; 

guardar_bitacora($axid_usuario,$axnom_modulo,$axdetalle);



$logitudPass = 5;
$axcod = substr($axdni_user,0,5);
$nuevo_nombre_a = substr(md5(microtime()),1,$logitudPass);
$nuevo_nombre = 'P-'.$axcod.'-'.number_pad($axcorrelativo,4);

$nuevo_nombre_c = $axserie_vendedor.'-'.$axcorrelativo;
$axcodmovcz = $nuevo_nombre_c;
echo trim($axcodmovcz);

break;

case '38': //listado de beneficiarios 
	
	$axbuscar_dato =$_POST['txtnom_cliente'];
	$axid_empresa =$_POST['txtid_empresa'];
  	
 if(isset($_POST["txtnom_cliente"])){

	$output ='';
	$idprov ='';
	$sqlemisor ="SELECT TOP 10 *  FROM BENEFICIARIOS WHERE ID_EMPRESA = '$axid_empresa' AND TIPO_PROV_CLIE='CLIENTE' AND RAZON_SOCIAL+RUC_BENEF like '%".$axbuscar_dato."%' ";;
	//echo $sqlemisor;

	$rsemisor=odbc_exec($con,$sqlemisor);
	//$output ='<ul id="listar" class="list-unstyled ul">';
	$output ='<ul class="list-group">';
  		

	if(odbc_num_rows($rsemisor) > 0){
		 while ($row=odbc_fetch_array($rsemisor)){		
		 	$id =  $row["ID_BENEFICIARIO"];
		 	$axnom_comercial =  trim($row["RAZON_SOCIAL"]);

		 	$output .='<a href="#" id="btn_id_beneficiario" class="list-group-item list-group-item-action" style="background:#DAF5FF;" data-id='.$id.' data-nom_pro='.$axnom_comercial.'> <i class="bi bi-person-vcard-fill"></i> ' .$row['RUC_BENEF'].' <br> '.utf8_encode($row["RAZON_SOCIAL"]).'</a>';
		 }

	}else{
		
		$output .='<a href="#" id="btn_id_beneficiario" class="list-group-item list-group-item-action bg-danger"></a>';
	
	}

	$output .='</ul>';
	echo $output;

}else{
	echo $output;	
}

break;

case '39': // traer el stock de los productos

$axnom_producto = $_POST['txtnom_producto']; 	
$axid_empresa = $_POST['txtid_empresa']; 	

	if($axnom_producto==""){
		
		$SQLBuscar = "SELECT  TOP 15  * FROM PRODUCTOS_LISTADO WHERE ID_EMPRESA = '$axid_empresa' AND COSTO_PRODUCTO > 0  ORDER BY NOM_PRODUCTO DESC";
		
	}else{

		$SQLBuscar ="SELECT  TOP 15 * FROM PRODUCTOS_LISTADO WHERE ID_EMPRESA = '$axid_empresa' AND COSTO_PRODUCTO > 0 AND NOM_PRODUCTO+COD_PRODUCTO like '%".$axnom_producto."%' ORDER BY NOM_PRODUCTO DESC";

	}

	//echo "$SQLBuscar";

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th style='text-align: left;'>Productos </th>			
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$id_producto = $fila['ID_PRODUCTO'];
		$cod_producto = $fila['COD_PRODUCTO'];
		$nom_categoria = $fila['NOM_CATEGORIA'];
		$nom_producto = $fila['NOM_PRODUCTO'];
		$tipo = $fila['TIPO'];
		$presentacion = $fila['PRESENTACION'];
		$procedencia = $fila['PROCEDENCIA'];
		$axfactor = $fila['FACTOR_PROD'];
		$estado = $fila['ESTADO'];
		$cant_caja = $fila['CANT_CAJA'];
		$axprs_menimo=  number_format($fila["PRS_MINIMO"],4,".",","); 
		$axprs_menor=  number_format($fila["PRS_MENOR"],4,".",","); 
		$axprs_mayor= number_format($fila["PRS_MAYOR"],4,".",",");
		$axprs_premium=  number_format($fila["PRS_PREMIUN"],4,".",","); 
		$stock_actual= number_format($fila["STOCK_ACTUAL"],4,".",","); 
		$axafectacion= $fila['ABREV_AFECTACION'];
		$axprod_mostrar ='CI: '.$cod_producto.' | <b>'.$tipo.' </b> '.$nom_producto;			


		echo "<tr>
		 		<td style='text-align: justify;'>
					<a href='#' id='btn_producto_asignar' data-afect='$axafectacion' data-factor='$axfactor' data-prs_men='$axprs_menor' data-prs_pre='$axprs_premium' data-prs_may='$axprs_mayor' data-prs_min='$axprs_menimo' data-id='$id_producto' style='text-decoration:none;' data-bs-toggle='modal' data-bs-target='#exampleModal_3'>".utf8_encode($axprod_mostrar)."</a>
				</td> 
				</tr>";
		}

echo "</table>";
}
break;


case '40':// grabar pedidos

date_default_timezone_set("America/Lima");

$axid_empresa =$_POST['txtid_empresa'];

$axid_pedido =$_POST['txtid_pedido'];
$axnum_pedido =$_POST['txtnum_pedido'];
$axid_local =$_POST['txtid_local'];

$axparametros_m =$_POST['txtparametros_m'];

$axid_usuario = $_POST['txtid_usuario']; 		
$axnom_modulo = $_POST['txtnom_modulo']; 
$axtipo_venta = $_POST['txttipo_venta']; 


if($axid_local==''){
	$axid_local = get_row('PEDIDOS_CZ','ID_LOCAL','NUM_PEDIDO',$axnum_pedido);
}

$axcodusuario =$_POST['txtid_vendedor'];
$axid_beneficiario =$_POST['txtid_beneficiario'];

if($axid_beneficiario==''){
$axid_beneficiario =get_row_two('PEDIDOS_CZ','ID_BENEFICIARIO','NUM_PEDIDO','ID_LOCAL',$axnum_pedido,$axid_local);	
}

$axnom_cliente = get_row('BENEFICIARIOS','NOM_COMERCIAL','ID_BENEFICIARIO',$axid_beneficiario);

$axdireccion_entrega =$_POST['txtdireccion_entrega'];

if($axdireccion_entrega==''){
$axdireccion_entrega =get_row_two('PEDIDOS_CZ','DIRECCION_ENTREGA','NUM_PEDIDO','ID_LOCAL',$axnum_pedido,$axid_local);	
}


$axhora_pedido =date('H:i:s');
$axid_producto =$_POST['txtid_producto'];
$axcant_salida_padre =$_POST['txtcant_salida'];
$axcant_salida_1 =$_POST['txtcant_salida'];

$axprs_menor =$_POST['txtprs_menor'];
$axprs_mayor =$_POST['txtprs_mayor'];
$axprs_premiun =$_POST['txtprs_premiun'];
$axcosto_producto =$_POST['txtcosto_producto'];
$axdsctos_salida =$_POST['txtdsctos_salida'];
$axvalor_salida =$_POST['txtvalor_salida'];
$axigv_salida =$_POST['txtigv_salida'];
$axgravadas_salida =$_POST['txtgravadas_salida'];
$axinafecto_salida =$_POST['txtinafecto_salida'];
$axexonerado_salida =$_POST['txtexonerado_salida'];
$axtotal_salida =$_POST['txttotal_salida'];
$axobserv_proforma =$_POST['txtobserv_proforma'];
$axestado_atendido =$_POST['txtestado_atendido'];
$axtotal_pedido =$_POST['txttotal_pedido'];
$axprs_venta =$_POST['txtprs_venta'];

$axid_agencia =$_POST['txtid_agencia'];
$axiid_td =$_POST['txtiid_td'];
if($axiid_td==''){
	$axiid_td =get_row_two('PEDIDOS_CZ','ID_TD','NUM_PEDIDO','ID_LOCAL',$axnum_pedido,$axid_local);	
}

$axfecha_despacho =$_POST['txtfecha_despacho'];

$axforma_pago =$_POST['txtforma_pago'];
$axestado_forma_pago =$_POST['txtestado_forma_pago'];
$axmedio_pago =$_POST['txtmedio_pago'];
$axid_cta =$_POST['txtid_cta'];
$axnum_transf =$_POST['txtnum_transf'];
$axdias_pago =$_POST['txtdias_credito'];

$axnum_pedido_1 = get_row('PEDIDOS','NUM_PEDIDO','NUM_PEDIDO',$axnum_pedido);


$axfecha_pedido_m =$_POST['txtfecha_pedido_m'];
$axfecha_pedido =$axfecha_pedido_m;

//$axfecha_transf =$_POST['txtfecha_transf'];
$axfecha_transf =$axfecha_pedido;
$axperiodo_transf = date('m-Y',strtotime($axfecha_transf));


if($axparametros_m == 0){ //es un pedido nuevo

	$axcontar = strlen($axnum_pedido);	
	$axextraer = $axcontar-2;
  $axcorrelativo =  intval(substr($axnum_pedido,2,$axextraer));	
 //echo $axcorrelativo;

	$SQLActualizar_NP = "UPDATE USUARIO SET CORRELATIVO_VENDEDOR='$axcorrelativo' WHERE ID_USUARIO='$axcodusuario'";		
	$RSActualizar_NP = odbc_exec($con,$SQLActualizar_NP);

	$axfecha_pedido =$_POST['txtfecha_pedido'];
	$axfecha_transf =$axfecha_pedido;
	$axperiodo_transf = date('m-Y',strtotime($axfecha_transf));

	$axtipo_entrega = 'TOTAL';
	$axnum_pedido_parcial='';

}else{

	$axtipo_entrega = get_row('PEDIDOS','TIPO_ENTREGA','NUM_PEDIDO',$axnum_pedido);
	$axnum_pedido_parcial = get_row('PEDIDOS','NUM_PEDIDO_PARCIAL','NUM_PEDIDO',$axnum_pedido);
	
}

$axid_vehiculo = 0;

$SQLBuscar_complementos = "SELECT * FROM PRODUCTOS_COMP WHERE ID_PRODUCTO='$axid_producto'";
$RSBuscar_complementos = odbc_exec($con,$SQLBuscar_complementos);

if( odbc_num_rows($RSBuscar_complementos) > 0){

	while ($fila_comp = odbc_fetch_array($RSBuscar_complementos)) {
		
		$axid_producto_hijo = $fila_comp['ID_PRODUCTO_COMP'];
		$axporc_prod_hijo = $fila_comp['PORC_COMPL'];
		$axfactor_prod_hijo =  $fila_comp['FACTOR_COMPL'];

		$axcant_salida = $axcant_salida_1*$axfactor_prod_hijo;

		$axprs_venta_hijo = ($axprs_venta*$axporc_prod_hijo);
		
		$axafectacion = get_row('PRODUCTOS_LISTADO','ABREV_AFECTACION','ID_PRODUCTO',$axid_producto_hijo);
		$axigv = get_row('LOCALES','PORC_IGV','ID_LOCAL',$axid_local);
		$axigv_1 = 1+$axigv;

		$axprs_menor = get_row('PRODUCTOS','PRS_MENOR','ID_PRODUCTO',$axid_producto_hijo);
		$axprs_mayor = get_row('PRODUCTOS','PRS_MAYOR','ID_PRODUCTO',$axid_producto_hijo);
		$axprs_premiun = get_row('PRODUCTOS','PRS_PREMIUN','ID_PRODUCTO',$axid_producto_hijo);
		$axcosto_producto = get_row('PRODUCTOS','COSTO_PRODUCTO','ID_PRODUCTO',$axid_producto_hijo);


		if($axafectacion=='GRAVADA'){

			$axvalor_salida = $axcant_salida_padre*($axprs_venta_hijo/$axigv_1);
			$axigv_salida = $axvalor_salida*$axigv;
			$axgravadas_salida = $axvalor_salida;
			$axinafecto_salida = 0;
			$axexonerado_salida = 0;
			$axtotal_salida= $axvalor_salida+$axigv_salida;
			$axtotal_pedido=$axtotal_salida;

		}elseif($axafectacion=='EXONERADA'){

			$axvalor_salida = $axcant_salida_padre*($axprs_venta_hijo);
			$axigv_salida = 0;
			$axgravadas_salida = 0;
			$axinafecto_salida = 0;
			$axexonerado_salida = $axvalor_salida;
			$axtotal_salida = $axvalor_salida+$axigv_salida;
			$axtotal_pedido=$axtotal_salida;
			
		}elseif($axafectacion=='INAFECTO'){

			$axvalor_salida = $axcant_salida_padre*($axprs_venta_hijo);
			$axigv_salida = 0;
			$axgravadas_salida = 0;
			$axinafecto_salida = $axvalor_salida;
			$axexonerado_salida = 0;
			$axtotal_salida = $axvalor_salida+$axigv_salida;
			$axtotal_pedido=$axtotal_salida;
			
		}

		$sqlinserta ="INSERT INTO PEDIDOS (NUM_PEDIDO,ID_USUARIO,ID_BENEFICIARIO,DIRECCION_ENTREGA,FECHA_PEDIDO,HORA_PEDIDO,ID_PRODUCTO,CANT_SALIDA,PRS_MENOR,PRS_MAYOR,PRS_PREMIUN,COSTO_PRODUCTO,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,OBSERV_ENTREGA,ESTADO_ATENDIDO,TOTAL_PEDIDO,PRS_VENTA,ID_LOCAL,ID_AGENCIA,ID_TD,FECHA_DESPACHO,FORMA_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,NUM_TRANSF,ID_CTA,PERIODO_TRANSF,FECHA_TRANSF,DIAS_CREDITO,ID_PRODUCTO_PADRE,CANT_PADRE,ESTADO_REVISION,TIPO_VENTA,TIPO_ENTREGA,NUM_PEDIDO_PARCIAL,ID_VEHICULO,NUM_DESPACHO,NOM_CHOFER,ESTADO_ANULADA) values ('$axnum_pedido','$axcodusuario','$axid_beneficiario','$axdireccion_entrega','$axfecha_pedido','$axhora_pedido','$axid_producto_hijo','$axcant_salida','$axprs_menor','$axprs_mayor','$axprs_premiun','$axcosto_producto','$axdsctos_salida','$axvalor_salida','$axigv_salida','$axgravadas_salida','$axinafecto_salida','$axexonerado_salida','$axtotal_salida','$axobserv_proforma','$axestado_atendido','$axtotal_pedido','$axprs_venta_hijo','$axid_local','$axid_agencia','$axiid_td','$axfecha_despacho','$axforma_pago','$axestado_forma_pago','$axmedio_pago','$axnum_transf','$axid_cta','$axperiodo_transf','$axfecha_transf','$axdias_pago','$axid_producto','$axcant_salida_padre','ABIERTO','$axtipo_venta','$axtipo_entrega','$axnum_pedido_parcial','$axid_vehiculo','','','ACTIVO')";
		$rsinserta = odbc_exec($con,$sqlinserta);
		//echo $sqlinserta;

				
	}

	if($rsinserta){
			
			$axcod_producto = get_row('PRODUCTOS','COD_PRODUCTO','ID_PRODUCTO',$axid_producto);
			$axdetalle = $_POST['axdetalle'].' '.$axcod_producto.' CANT: '.$axcant_salida.' PRECIO:'.$axprs_venta.' AL PEDIDO '.$axnum_pedido; 	
			guardar_bitacora($axid_usuario,$axnom_modulo,$axdetalle);

			$respuesta = 0;
			echo $respuesta;
		}else{
			$respuesta = 1;
			echo $respuesta;
		}

}else{

$axcant_salida = $axcant_salida_1;

$sqlinserta ="INSERT INTO PEDIDOS (NUM_PEDIDO,ID_USUARIO,ID_BENEFICIARIO,DIRECCION_ENTREGA,FECHA_PEDIDO,HORA_PEDIDO,ID_PRODUCTO,CANT_SALIDA,PRS_MENOR,PRS_MAYOR,PRS_PREMIUN,COSTO_PRODUCTO,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,OBSERV_ENTREGA,ESTADO_ATENDIDO,TOTAL_PEDIDO,PRS_VENTA,ID_LOCAL,ID_AGENCIA,ID_TD,FECHA_DESPACHO,FORMA_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,NUM_TRANSF,ID_CTA,PERIODO_TRANSF,FECHA_TRANSF,DIAS_CREDITO,ID_PRODUCTO_PADRE,CANT_PADRE,ESTADO_REVISION,TIPO_VENTA,TIPO_ENTREGA,NUM_PEDIDO_PARCIAL,ID_VEHICULO,NUM_DESPACHO,NOM_CHOFER,ESTADO_ANULADA) values ('$axnum_pedido','$axcodusuario','$axid_beneficiario','$axdireccion_entrega','$axfecha_pedido','$axhora_pedido','$axid_producto','$axcant_salida','$axprs_menor','$axprs_mayor','$axprs_premiun','$axcosto_producto','$axdsctos_salida','$axvalor_salida','$axigv_salida','$axgravadas_salida','$axinafecto_salida','$axexonerado_salida','$axtotal_salida','$axobserv_proforma','$axestado_atendido','$axtotal_pedido','$axprs_venta','$axid_local','$axid_agencia','$axiid_td','$axfecha_despacho','$axforma_pago','$axestado_forma_pago','$axmedio_pago','$axnum_transf','$axid_cta','$axperiodo_transf','$axfecha_transf','$axdias_pago','$axid_producto','$axcant_salida_padre','ABIERTO','$axtipo_venta','$axtipo_entrega','$axnum_pedido_parcial','$axid_vehiculo','','','ACTIVO')";
	$rsinserta = odbc_exec($con,$sqlinserta);
	//echo $sqlinserta;
	



	if($rsinserta){

			$axcod_producto = get_row('PRODUCTOS','COD_PRODUCTO','ID_PRODUCTO',$axid_producto);
			$axdetalle = $_POST['axdetalle'].' '.$axcod_producto.' CANT: '.$axcant_salida.' PRECIO:'.$axprs_venta.' AL PEDIDO '.$axnum_pedido; 	
			guardar_bitacora($axid_usuario,$axnom_modulo,$axdetalle);

		$respuesta = 0;
		echo $respuesta;
	}else{
		$respuesta = 1;
		echo $respuesta;
	}

}




break;

case '41': //grilla pedidos_dt

$axbuscaregistro = $_POST['txtbuscar']; 	
$axcodusuario = $_POST['txtcodusuario']; 	
$axid_vendedor = $_POST['txtid_vendedor']; 	
$axnum_pedido = $_POST['txtnum_pedido']; 	
$axid_empresa = $_POST['txtid_empresa']; 	
$axfecha_despacho = get_row('PEDIDOS_CZ','FECHA_DESPACHO','NUM_PEDIDO',$axnum_pedido);
$axid_td= get_row('PEDIDOS_CZ','ID_TD','NUM_PEDIDO',$axnum_pedido);
$axtipodocumento= get_row('TIPO_DOCUMENTOS','DETALLE_DOC','ID_TD',$axid_td);

	if($axbuscaregistro==""){
		
		$SQLBuscar = "SELECT * FROM PEDIDOS_DT_1 WHERE ID_USUARIO = '$axid_vendedor' AND ID_EMPRESA	='$axid_empresa' AND NUM_PEDIDO='$axnum_pedido' order by HORA_PEDIDO ASC";
		
	}else{

		$SQLBuscar ="SELECT *  FROM PEDIDOS_DT_1 WHERE ID_USUARIO = '$axid_vendedor' AND ID_EMPRESA	='$axid_empresa' AND NUM_PEDIDO='$axnum_pedido' AND NOM_PRODUCTO like '%".$axbuscaregistro."%' ";

	}

	//echo "$SQLBuscar";

echo "
	<br>
		<div style='text-align:center;'>	
		<!--button type='button' id='btn_transportista' class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal_4'><i class='bi bi-gear'></i>Ajustes</button-->	
		<button type='button' id='btn_imprimir_pedidido' class='btn btn-danger btn-sm'><i class='bi bi-filetype-pdf'></i>Pdf</button>	
		<p><hr></p>
		<h6 class='text-danger'>Fecha Despacho: <b>".date('d-m-Y',strtotime($axfecha_despacho))."</b> Tipo comprobante: <b>".$axtipodocumento."</b></h6>	
		</div>

		<p><hr></p>
		<table class='table table-hover table-sm'>	
		<thead class='table-success'>				
		<tr>			
			<th style='text-align: left;'></th>			
			<th style='text-align: left;'>Detalle</th>			
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$axid_dt = $fila['ID_PEDIDO'];		
 		$axnom_producto = $fila['ID_BENEFICIARIO'];		
		$axcant_salida =number_format($fila["CANT_SALIDA"],3,".",","); 
		$axprs_venta =number_format($fila["PRS_VENTA"],3,".",","); 
		$axtotal_salida =number_format($fila["TOTAL_SALIDA"],3,".",","); 
		$cod_producto = $fila['COD_PRODUCTO'];
		$nom_categoria = $fila['NOM_CATEGORIA'];
		$nom_producto = $fila['NOM_PRODUCTO'];
		$tipo = $fila['TIPO'];
		$presentacion = $fila['PRESENTACION'];
		$procedencia = $fila['PROCEDENCIA'];
		$estado = $fila['ESTADO'];
		$axid_local = $fila['ID_LOCAL'];

		$cant_caja = $fila['CANT_CAJA'];
		$axid_producto= $fila['ID_PRODUCTO'];
		$axprs_unit = number_format(($axprs_venta/$cant_caja),3,".",",");
		
		$axprod_mostrar = '<b>'.$cod_producto.' | '.$nom_producto.' '.$tipo.' '.$presentacion.' '.$cant_caja.'</b><br><b class="text-danger"> Cant. '.$axcant_salida.'  |Pr.Unit. '.$axprs_unit.' |Pr.Venta : '.$axprs_venta.'  |Total : '.$axtotal_salida.'</b>';					
			
		echo "<tr>
			 <td class='text-danger'style='text-align: center;'><a href='#' id='btn_eliminar_producto_del_pedido' data-npedido='$axnum_pedido' data-local='$axid_local' data-produto='$axid_producto'><i class='bi bi-trash3-fill text-danger'></i></a>
			 </td>

		 		<td style='text-align: justify;'>
					<a href='#' id='btn_producto_asignar' data-id='$id_producto' style='text-decoration:none;'>".utf8_encode($axprod_mostrar)."</a>
				</td> 
				</tr>";
		}

		$SQLTotal = "SELECT SUM(TOTAL_SALIDA) AS TT FROM PEDIDOS_DT WHERE ID_USUARIO = '$axid_vendedor' AND ID_EMPRESA	='$axid_empresa' AND NUM_PEDIDO='$axnum_pedido'";
		$RSTotal = odbc_exec($con,$SQLTotal);
		$fila_t = odbc_fetch_array($RSTotal);
 		$axtotal_pedido = number_format($fila_t["TT"],2,".",","); 

 			echo "<tr >

		 		<td colspan='2' style='text-align: right;'><b class='text-primary'>Total Pedido   :    ".$axtotal_pedido."</b></td> 
				</tr>";
		
}
echo "</table>";

break;

case '42': //eliminar pedidos
	
$axnum_pedido= $_POST['txtnum_pedido'];
$axcodusuario= $_POST['txtid_vendedor'];

$axid_usuario = $_POST['txtid_usuario']; 		
$axnom_modulo = $_POST['txtnom_modulo']; 
$axnom_cliente = get_row('PEDIDOS_CZ','NOM_COMERCIAL','NUM_PEDIDO',$axnum_pedido);
$axdetalle = $_POST['axdetalle'].' '.$axnum_pedido.' DEL CLIENTE '.$axnom_cliente;	

$verificar = get_row('MAESTRO_CZ','NUM_PEDIDO','NUM_PEDIDO',$axnum_pedido);

if($verificar ==''){

	$SQLEliminar = "DELETE FROM PEDIDOS WHERE NUM_PEDIDO='$axnum_pedido' AND ID_USUARIO='$axcodusuario'";
	$RSEliminar = odbc_exec($con,$SQLEliminar);
	//echo $SQLEliminar;

	if($RSEliminar){
		guardar_bitacora($axid_usuario,$axnom_modulo,$axdetalle);
		$respuesta =0;
		echo $respuesta;
	}else{
		$respuesta =1;
		echo $respuesta;
	}
	

}else{

	$respuesta =3; //existe el pedido en maestro y cuenta con factura y guia
	echo $respuesta;

}



break;

case '43': //cargar lista de precios y actualizar en el tabla maestra de productos

	$axtipo_excel =$_POST['txttipo_excel'];
	$axid_empresa =$_POST['txtid_empresa'];
	$nombrearchivo = '../archivos/'.$_POST['txtnomexcel']; 
	$axfecha= date("Y-m-d");

	if($axtipo_excel=='PRECIOS'){

	$objPHPExcel = PHPExcel_IOFactory::load($nombrearchivo);	
	$objPHPExcel->setActiveSheetIndex(0);
	$numfilas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
	
	for ($ind=1; $ind <=$numfilas ; $ind++) { 
		
		$a = $objPHPExcel->getActiveSheet()->getCell('A'.$ind)->getCalculatedValue(); //COD PRODUCTO
		$b = $objPHPExcel->getActiveSheet()->getCell('B'.$ind)->getCalculatedValue(); //NOMBRE PRODUCTO
		$c = $objPHPExcel->getActiveSheet()->getCell('C'.$ind)->getCalculatedValue(); //COSTO PRODUCTO
		$d = $objPHPExcel->getActiveSheet()->getCell('D'.$ind)->getCalculatedValue(); //PRECIO MINIMO
		$e = $objPHPExcel->getActiveSheet()->getCell('E'.$ind)->getCalculatedValue(); //MARGEN
		$f = $objPHPExcel->getActiveSheet()->getCell('F'.$ind)->getCalculatedValue(); //PESO 
		$g = $objPHPExcel->getActiveSheet()->getCell('G'.$ind)->getCalculatedValue();		//CANTIDAD POR CAJAS
		$filtro = $objPHPExcel->getActiveSheet()->getCell('H'.$ind)->getCalculatedValue();
		
		if ($filtro == "PRECIOS") {

		$SQLBuscar = "SELECT * FROM PRODUCTOS WHERE COD_PRODUCTO='$a' AND ID_EMPRESA='$axid_empresa'";
		$RSBuscar = odbc_exec($con,$SQLBuscar);
		$fila =odbc_fetch_array($RSBuscar);

			if(odbc_num_rows($RSBuscar) == 1){
				
				$axid_producto = $fila['ID_PRODUCTO'];
				
				$SQLActualizar = "UPDATE PRODUCTOS SET COSTO_PRODUCTO='$c',PRS_MINIMO='$d',MARGEN_PRODUCTO='$e',PESO_PRODUCTO='$f',CANT_CAJA='$g' WHERE COD_PRODUCTO='$a' AND ID_PRODUCTO='$axid_producto' AND ID_EMPRESA='$axid_empresa'";
				$RSActualizar = odbc_exec($con,$SQLActualizar);

			}


		}

	}

	}elseif($axtipo_excel=='PESOS'){

	$objPHPExcel = PHPExcel_IOFactory::load($nombrearchivo);	
	$objPHPExcel->setActiveSheetIndex(0);
	$numfilas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
	
	for ($ind=1; $ind <=$numfilas ; $ind++) { 
		
		$a = $objPHPExcel->getActiveSheet()->getCell('A'.$ind)->getCalculatedValue(); //COD PRODUCTO
		$b = $objPHPExcel->getActiveSheet()->getCell('B'.$ind)->getCalculatedValue(); //NOMBRE PRODUCTO
		$c = $objPHPExcel->getActiveSheet()->getCell('C'.$ind)->getCalculatedValue(); //PESO PRODUCTO		
		$filtro = $objPHPExcel->getActiveSheet()->getCell('D'.$ind)->getCalculatedValue();
		
		if ($filtro == "PESOS") {

		$SQLBuscar = "SELECT * FROM PRODUCTOS WHERE COD_PRODUCTO='$a' AND ID_EMPRESA='$axid_empresa'";
		$RSBuscar = odbc_exec($con,$SQLBuscar);
		$fila =odbc_fetch_array($RSBuscar);

			if(odbc_num_rows($RSBuscar) == 1){
				
				$axid_producto = $fila['ID_PRODUCTO'];
				
				$SQLActualizar = "UPDATE PRODUCTOS SET PESO_PRODUCTO='$c' WHERE COD_PRODUCTO='$a' AND ID_PRODUCTO='$axid_producto' AND ID_EMPRESA='$axid_empresa'";
				$RSActualizar = odbc_exec($con,$SQLActualizar);

			}


		}

	}

}elseif($axtipo_excel=='PRECIOS_MINIMOS'){

	$objPHPExcel = PHPExcel_IOFactory::load($nombrearchivo);	
	$objPHPExcel->setActiveSheetIndex(0);
	$numfilas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

	$SQLEliminar = "DELETE FROM PRODUCTOS_PRC_MINIMO";
	//$RSEliminar = odbc_exec($con,$SQLEliminar);
	
	for ($ind=1; $ind <=$numfilas ; $ind++) {

			$a1 = $objPHPExcel->getActiveSheet()->getCell('A'.$ind)->getCalculatedValue(); //FECHA CAMBIO
			if($a1==""){
				$a = '';
			}else{
				$a = \PHPExcel_Style_NumberFormat::toFormattedString($a1, 'YYYY-MM-DD'); //Date of adoption
			}

			$b = $objPHPExcel->getActiveSheet()->getCell('B'.$ind)->getCalculatedValue(); //COD PRODUCTO
			$c = $objPHPExcel->getActiveSheet()->getCell('C'.$ind)->getCalculatedValue(); //PRECIO MINIMO
			$d = $objPHPExcel->getActiveSheet()->getCell('D'.$ind)->getCalculatedValue(); //VENDEDOR
			$filtro = $objPHPExcel->getActiveSheet()->getCell('E'.$ind)->getCalculatedValue(); //FILTRO
			
			if($filtro=='PRECIOS_MINIMOS'){

				$axid_producto = get_row('PRODUCTOS','ID_PRODUCTO','COD_PRODUCTO',$b);

				$sqlinserta ="INSERT INTO PRODUCTOS_PRC_MINIMO (ID_PRODUCTO,COD_PRODUCTO,ID_EMPRESA,PRECIO_MINIMO,FECHA_CAMBIO,VENDEDOR) VALUES ('$axid_producto','$b','$axid_empresa','$c','$a','$d')";
				$rsinserta = odbc_exec($con,$sqlinserta);


			}

		}
	
}

break;

case '44':
	
$axnum_pedido= $_POST['txtnum_pedido'];
$axid_local= $_POST['txtid_local'];
$axid_producto= $_POST['txtid_producto'];
$axcod_producto = get_row('PRODUCTOS','COD_PRODUCTO','ID_PRODUCTO',$axid_producto);
$axid_usuario = $_POST['txtid_usuario']; 		
$axnom_modulo = $_POST['txtnom_modulo']; 

$axdetalle = $_POST['axdetalle'].' '.$axcod_producto.' DEL PEDIDO '.$axnum_pedido; 	


$SQLEliminar = "DELETE FROM PEDIDOS WHERE ID_PRODUCTO_PADRE='$axid_producto' AND NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
$RSEliminar = odbc_exec($con,$SQLEliminar);
//echo $SQLEliminar;

if($RSEliminar){

	guardar_bitacora($axid_usuario,$axnom_modulo,$axdetalle);

	$respuesta =0;
	echo $respuesta;
}else{
	$respuesta =1;
	echo $respuesta;
}

break;

case '45':

$axbuscaregistro = $_POST['txtbuscar_dato']; 		
$axid_empresa = $_POST['txtid_empresa']; 	
$axcodusuario = $_POST['txtcodusuario']; 	
$axid_local = $_POST['txtid_local']; 	
$axfecha_del = $_POST['txtfecha_del']; 	
$axfecha_al = $_POST['txtfecha_al']; 	
$axestado_atendido = $_POST['txtestado_atendido']; 	
$axfiltro_estados = $_POST['txtfiltro_estados']; 	

if($axbuscaregistro==""){

	if($axfiltro_estados=='AMBOS'){
		$SQLBuscar = "SELECT * FROM PEDIDOS_CZ WHERE ID_LOCAL='$axid_local' AND ESTADO_ATENDIDO <> 'PROGRAMADO' AND ESTADO_ATENDIDO <> 'ATENDIDO' ORDER BY FECHA_PEDIDO DESC";
	}else{
		$SQLBuscar = "SELECT * FROM PEDIDOS_CZ WHERE ID_LOCAL='$axid_local' AND ESTADO_ATENDIDO <> 'PROGRAMADO' AND ESTADO_ATENDIDO <> 'ATENDIDO' AND ESTADO_ATENDIDO='$axfiltro_estados' ORDER BY FECHA_PEDIDO DESC";
	}
	
}else{
		
	$SQLBuscar = "SELECT * FROM PEDIDOS_CZ WHERE ID_LOCAL='$axid_local' AND ESTADO_ATENDIDO <> 'PROGRAMADO' AND ESTADO_ATENDIDO <> 'ATENDIDO' AND NOM_COMERCIAL+NUM_PEDIDO+VENDEDOR LIKE '%".$axbuscaregistro."%'";


	}

//echo "$SQLBuscar";

	echo "

		<table class='table table-hover table-sm'>
		<thead class='table-danger'>			
		<tr>
			<th style='text-align: center;'>It</th>					
			<th class='ocultar' style='text-align: center;'>Almacén</th>				
			<th class='ocultar' style='text-align: center;'>Vendedor</th>			
			<th class='ocultar' style='text-align: center; '>Fecha</th>			
			<th style='text-align: left;'>Cliente</th>			
			<th style='text-align: right;'>Monto</th>
			<th style='text-align: center;'>Estado</th>						
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$axnum_pedido = $fila['NUM_PEDIDO'];
 		$axvendedor = $fila['VENDEDOR'];
 		$axiduser = $fila['ID_USUARIO'];
		$axcod_interno = $fila['COD_INTERNO'];		
		$axnum_pedido_parcial = $fila['NUM_PEDIDO_PARCIAL'];		
		
		$axruc_cliente = $fila['RUC_BENEF'];
		$razon_social = $axruc_cliente.' | '.$fila['RAZON_SOCIAL'];
		
		$axtotalpedido =number_format($fila["TOTAL_PEDIDO"],2,".",","); 
		$domic_entrega_pred = $fila['DIRECCION_ENTREGA'];
		$axestado_atendido = $fila['ESTADO_ATENDIDO'];
		$id_beneficiario= $fila['ID_BENEFICIARIO'];
		$axnom_beneficiario= $fila['NOM_COMERCIAL'];
		$axfecha_pedido= date('d-m-Y',strtotime($fila['FECHA_PEDIDO']));
		$axid_local_nombre = $fila['LOCAL_CORTO'];
		$axnum_despacho = $fila['NUM_DESPACHO'];
		$axid_agencia= $fila['ID_AGENCIA'];
		$axid_td= $fila['ID_TD'];
		$axid_doc= $fila['ID_DOC'];
		$axnum_pedido_parcial= $fila['NUM_PEDIDO_PARCIAL'];

		$axcomprobante = get_row('MAESTRO_CZ','DOCUMENTO','NUM_PEDIDO',$axnum_pedido);
		//echo $axcomprobante;

		if($axcomprobante ==''){
			$aviso_1 = '';
		}else{
			$aviso_1 = '<span class="badge rounded-pill text-bg-warning">R</span>';
		}

		$axnum_despacho_carro = $axnum_despacho.' | '.$axcamion = get_row('PEDIDOS_CZ_1','CAMION','NUM_PEDIDO',$axnum_pedido);

		if($axid_agencia <> 0){

			$axagencia = get_row('TRANSPORTISTAS','NOM_AGENCIA','ID_AGENCIA',$axid_agencia);
			$axdir_agencia = get_row('TRANSPORTISTAS','DIR_AGENCIA','ID_AGENCIA',$axid_agencia);
			$domic_entrega_pred = 'Agencia: '.$axagencia.' Direc. '.$axdir_agencia;

		}

		$axcod_mov_parcial = get_row('PEDIDOS_PARCIAL','COD_MOV','NUM_PEDIDO',$axnum_pedido_parcial);

		

		//echo $axnum_despacho;

		if($axnum_despacho == ''){
			$aviso='';			
		}else{
			$aviso = '<span class="badge rounded-pill text-bg-danger">F</span>';
		}

		//echo $id_beneficiario;

	echo "<tr>";

		if($axestado_atendido=='PENDIENTE'){

			echo "<td class='text-danger'style='text-align: center;'>$it</td>
						<td class='text-danger ocultar'style='text-align: center;'>$axid_local_nombre</td> 
						<td class='text-danger ocultar'style='text-align: center;'>$axvendedor</td> 					
						<td class='text-danger ocultar'style='text-align: center;'>$axfecha_pedido</td>
 					  <td class='text-danger fst-italic'style='text-align: left;'><a class='text-danger' href='#' id='btn_imprimir_pendiente' title='Click para imprimir PDF del PEDIDO...' data-id='$axnum_pedido' data-vendedor='$axiduser' data-estado='$axestado_atendido' style='text-decoration:none;'><b>".$axnum_pedido.' | '.$razon_social.'</b><br>'.$domic_entrega_pred.' '.$aviso_1."</a></td> 					  
 					  <td class='text-danger'style='text-align: right;'>$axtotalpedido</td>
 					  <td class='text-danger'style='text-align: center;'>$axestado_atendido</td>";

		}elseif($axestado_atendido=='REVISION'){

			echo "<td class='text-success'style='text-align: center;'>$it</td>
						<td class='text-success ocultar'style='text-align: center;'>$axid_local_nombre</td> 
						<td class='text-success ocultar'style='text-align: center;'>$axvendedor</td>					
						<td class='text-success ocultar'style='text-align: center;'>$axfecha_pedido</td>
 					  <td class='text-success fst-italic'style='text-align: left;'>

 					  	<a class='text-success' href='#' id='btn_cambiar_estado_5'  data-id='$axnum_pedido' data-estado='$axestado_atendido' style='text-decoration:none;'><b>".$axnum_pedido.' | '.$razon_social.'</b><br>'.$domic_entrega_pred."</a> 

 					  	<a href='#' id='btn_modal_comprobante' data-id_td='$axid_td' data-parcial='$axnum_pedido_parcial' style='text-decoration:none;' data-bs-toggle='modal' data-bs-target='#exampleModal_9' data-id='$axnum_pedido' data-codmovparcial='$axcod_mov_parcial'  data-doc='$axid_doc' data-ruc='$axruc_cliente' data-cliente='$razon_social'>$aviso </a><br><b>Despacho: $axnum_despacho_carro</b>   
 					  </td> 					  
 					  <td class='text-success'style='text-align: right;'>$axtotalpedido</td>
 					  
 					  <td class='text-success'style='text-align: center;'><a href='#' class='text-success' style='text-decoration:none;' id='btn_cambiar_a_pendiente_param_57' data-id='$axnum_pedido' data-despacho='$axnum_despacho' >$axestado_atendido</a> </td>";


		}elseif($axestado_atendido=='ATENDIDO'){

			echo "<td class='text-primary'style='text-align: center;'>$it</td>
						<td class='text-primary ocultar'style='text-align: center;'>$axid_local_nombre</td> 
						<td class='text-primary ocultar'style='text-align: center;'>$axvendedor</td> 					
						<td class='text-primary ocultar'style='text-align: center;'>$axfecha_pedido</td>
 					  <td class='text-primary fst-italic'style='text-align: left;'><a class='text-success' href='#' id='btn_cambiar_estado_5' data-id='$axnum_pedido' data-estado='$axestado_atendido' style='text-decoration:none;'><b>".$axnum_pedido.' | '.$razon_social.'</b><br>'.$domic_entrega_pred."</a></td> 					  
 					  <td class='text-primary ocultar'style='text-align: right;'>$axtotalpedido</td>
 					  <td class='text-primary'style='text-align: center;'>$axestado_atendido</td>";

 		}elseif($axestado_atendido=='PROGRAMADO'){

 			echo "<td class='text-dark'style='text-align: center;'>$it</td>
 						<td class='text-dark ocultar'style='text-align: center;'>$axid_local_nombre</td> 
						<td class='text-dark ocultar'style='text-align: center;'>$axvendedor</td> 					
						<td class='text-dark ocultar'style='text-align: center;'>$axfecha_pedido</td>
 					  <td class='text-dark fst-italic'style='text-align: left;'><a class='text-success' href='#' id='btn_cambiar_estado_5' data-id='$axnum_pedido' data-estado='$axestado_atendido' style='text-decoration:none;'><b>".$axnum_pedido.' | '.$razon_social.'</b></r>'.$domic_entrega_pred."<a><b</td> 					  
 					  <td class='text-dark'style='text-align: right;'>$axtotalpedido</td>
 					  <td class='text-dark'style='text-align: center;'>$axestado_atendido</td>";
			
		}

 	echo "</tr>	";

}
echo "</table>";
}else{
	echo "";
}

break;

case '46':
	
$axbuscaregistro = $_POST['txtbuscar']; 	
$axcodusuario = $_POST['txtcodusuario']; 	
$axnum_pedido = $_POST['txtnum_pedido']; 	
$axid_empresa = $_POST['txtid_empresa']; 

$axnom_cliente = get_row('PEDIDOS_CZ','NOM_COMERCIAL','NUM_PEDIDO',$axnum_pedido)	;
$axruc_cliente = get_row('PEDIDOS_CZ','RUC_BENEF','NUM_PEDIDO',$axnum_pedido)	;
$axdireccion_entrega = get_row('PEDIDOS_CZ','DIRECCION_ENTREGA','NUM_PEDIDO',$axnum_pedido)	;
$axreferencia = get_row('PEDIDOS_CZ','REFERENCIA','NUM_PEDIDO',$axnum_pedido)	;
$axhorario_entrega = get_row('PEDIDOS_CZ','HORARIO_ATENCION','NUM_PEDIDO',$axnum_pedido)	;
$axid_local = get_row('PEDIDOS_CZ','ID_LOCAL','NUM_PEDIDO',$axnum_pedido)	;

$axfecha_despacho = get_row('PEDIDOS_CZ','FECHA_DESPACHO','NUM_PEDIDO',$axnum_pedido);
$axid_td= get_row('PEDIDOS_CZ','ID_TD','NUM_PEDIDO',$axnum_pedido);
$axtipodocumento= get_row('TIPO_DOCUMENTOS','DETALLE_DOC','ID_TD',$axid_td);
$axfecha_pedido_1 = get_row('PEDIDOS_CZ','FECHA_PEDIDO','NUM_PEDIDO',$axnum_pedido)	;
$axfecha_pedido = date('d-m-Y',strtotime($axfecha_pedido_1));


$axmonto_pedido = get_row('PEDIDOS_CZ','TOTAL_PEDIDO','NUM_PEDIDO',$axnum_pedido);
$axpagado = get_row('PEDIDOS_PAGADOS_TOTAL','MONTO_PAGADO','NUM_PEDIDO',$axnum_pedido);
$axsaldo =$axmonto_pedido-$axpagado;

if($axbuscaregistro==""){
		
		$SQLBuscar = "SELECT * FROM PEDIDOS_DT WHERE ID_EMPRESA	='$axid_empresa' AND NUM_PEDIDO='$axnum_pedido' order by HORA_PEDIDO ASC";
		
}else{

		$SQLBuscar ="SELECT *  FROM PEDIDOS_DT WHERE ID_EMPRESA	='$axid_empresa' AND NUM_PEDIDO='$axnum_pedido' AND NOM_PRODUCTO like '%".$axbuscaregistro."%' ";

}

	//echo "$SQLBuscar";

	echo "
		<div text-center'>
    <h4 class='card-title text-danger fw-bold'>".$axruc_cliente." | ".$axnom_cliente."</h4>
    <p class='card-text fw-bold'>Entregar en: ".$axdireccion_entrega."<br> Referencia: ".$axreferencia."<br>Horario: ".$axhorario_entrega."<br>Fecha Despacho: <b>".date('d-m-Y',strtotime($axfecha_despacho))."</b> Tipo comprobante: <b>".$axtipodocumento."</b> <b> Fecha Pedido:  ".$axfecha_pedido." </b>   </p>        
    
  	</div>
  	<button type='button' id='btn_transportista_1' data-id='$axnum_pedido' data-local='$axid_local' class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal_8'><i class='bi bi-gear'></i>Ajustes</button>
  	<a href='../Form/pedidos_despachos.php' class='btn btn-danger btn-sm' id='btn_retornar_pedidos_cz'><i class='bi bi-arrow-return-left'></i> Retornar</a>

  	<button type='button' id='btn_reprogramar_pedidos_cz' data-id='$axnum_pedido' data-local='$axid_local' class='btn btn-outline-info btn-sm'><i class='bi bi-pin-fill'></i> Parciales </button>

  	<button type='button' id='btn_pedidos_cancelados' data-bs-toggle='modal' data-bs-target='#mdl_pagos_adelantado' data-id='$axnum_pedido' data-local='$axid_local' data-monto='$axsaldo' class='btn btn-outline-danger btn-sm'><i class='bi bi-cash'></i>Pagos Adelantado</button>
  	

		<p><hr></p>
		<table class='table table-hover table-sm'>	
		<thead class='table-success'>				
		<tr>			
			<th class='table-danger' style='text-align: center;'>It</th>			
			
			<th class='table-danger' style='text-align: left;'>Detalle del Pedido </th>		

			<!--th class='table-danger' style='text-align: left;'>Detalle del Pedido <a href='#' id='btn_producto_por_asignar' style='text-decoration:none;' data-bs-toggle='modal' data-bs-target='#exampleModal_3'><i class='bi bi-plus-circle-fill' style='color:green;'></i></a></th-->	

			<th class='table-danger' style='text-align: right;'>Stock</th>					
			<th class='table-danger' style='text-align: right;'>Costo</th>		
			<!--th class='table-danger' style='text-align: right;'>Cant. Padre</th-->				
			


			<th style='text-align: right;'>Cant</th>									
			<th style='text-align: right;'>Prs.Venta</th>			
			<th style='text-align: right;'>Importe</th>			
			

		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$axid_dt = $fila['ID_PEDIDO'];		
 		$axnom_producto = $fila['ID_BENEFICIARIO'];		
		$axcant_salida =number_format($fila["CANT_SALIDA"],2,".",","); 
		$axprs_venta =number_format($fila["PRS_VENTA"],2,".",","); 
		$axprs_minimo =number_format($fila["PRS_MINIMO"],2,".",","); 
		$axtotal_salida =number_format($fila["TOTAL_SALIDA"],2,".",","); 
		$cod_producto = $fila['COD_PRODUCTO'];
		$axid_producto = $fila['ID_PRODUCTO'];
		$axid_producto_padre = $fila['ID_PRODUCTO_PADRE'];
		$nom_categoria = $fila['NOM_CATEGORIA'];
		$nom_producto = $fila['NOM_PRODUCTO'];
		$tipo = $fila['TIPO'];
		$presentacion = $fila['PRESENTACION'];
		$procedencia = $fila['PROCEDENCIA'];
		$axcant_salida_padre = $fila['CANT_PADRE'];
		$estado = $fila['ESTADO'];
		$cant_caja = $fila['CANT_CAJA'];
		$cant_padre = $fila['CANT_PADRE'];
		$axprs_unit = number_format(($axprs_venta/$cant_caja),3,".",","); 
		$axcosto_producto= number_format($fila['COSTO_PRODUCTO'],3,".",","); 

		//$axprod_mostrar = $cod_producto.' | '.$nom_producto.' '.$tipo.' '.$presentacion.' '.$cant_caja.'<br><b class="text-danger"> Cant. '.$axcant_salida.'  |Prs. Unit. '.$axprs_unit.' |Cja/Mll : '.$axprs_venta.'  |Total : '.$axtotal_salida.'</b>';					

		$axprod_mostrar = $cod_producto.' | '.$nom_producto.' '.$tipo.' '.$presentacion.' '.$cant_caja;		

		$SQLStock = "SELECT STOCK_ACTUAL FROM PRODUCTOS_LISTADO_STOCK_1 WHERE ID_LOCAL='$axid_local' AND COD_PRODUCTO='$cod_producto'";
		$RSStock = odbc_exec($con,$SQLStock);
		$fila_stock = odbc_fetch_array($RSStock);
		$axstock_actual = number_format($fila_stock['STOCK_ACTUAL'],2,".",",");  

		if($axstock_actual == ''){
			$axstock_actual = number_format(0,2,".",",");		
		}
	
		echo "<tr>

			<td style='text-align: center;'>$it</td>
			
			<td style='text-align: left;'><a href='#' id='btn_eliminar_producto_del_pedido' data-npedido='$axnum_pedido' data-local='$axid_local' data-produto='$axid_producto_padre'><i class='bi bi-trash3-fill text-danger'></i></a> ".utf8_encode($axprod_mostrar)."</td>			
			<td style='text-align: right;' class='text-danger'>$axstock_actual</td>
			<td style='text-align: right;'>$axcosto_producto</td>	
			<!--td style='text-align: right;'>$cant_padre</td-->				
						
			<td contenteditable class='table-success' style='text-align: right;' data-idprod='$axid_producto' data-idpd='$axid_dt' data-precio='$axprs_venta' data-local='$axid_local' data-id='$axnum_pedido' data-stok ='$axstock_actual' id='txtcant_salida_m' >$axcant_salida</td>			

			<td contenteditable class='table-success' style='text-align: right;' data-idprod='$axid_producto' data-idpd='$axid_dt' data-cant='$axcant_salida_padre' data-local='$axid_local' data-id='$axnum_pedido' data-prs_min='$axprs_minimo' id='txtprs_venta_m'>$axprs_venta</td>

			<td style='text-align: right;'>$axtotal_salida</td>
			</tr>";
		}

		$SQLTotal = "SELECT SUM(TOTAL_SALIDA) AS TT FROM PEDIDOS_DT WHERE ID_EMPRESA	='$axid_empresa' AND NUM_PEDIDO='$axnum_pedido'";
		$RSTotal = odbc_exec($con,$SQLTotal);
		$fila_t = odbc_fetch_array($RSTotal);
 		$axtotal_pedido = number_format($fila_t["TT"],2,".",","); 

 			echo "<tr >

		 		<td colspan='9' style='text-align: right;'><b class='text-primary'>Total Pedido   :    ".$axtotal_pedido."</b></td> 
				</tr>";
		
}
echo "</table>";

break;

case '47':


$axnum_pedido = $_POST['txtnum_pedido']; 	
$axid_local = $_POST['txtid_local']; 	

if($axid_local==''){
	$axid_local = get_row('PEDIDOS_CZ','ID_LOCAL','NUM_PEDIDO',$axnum_pedido)	;
}

$SQLActualizar = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='REVISION',ESTADO_REVISION='PENDIENTE' WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
$RSActualizar = odbc_exec($con,$SQLActualizar);

if($RSActualizar){

	$respuesta =0;
	echo $respuesta;

}else{

	$respuesta =1;
	echo $respuesta;

}

break;

case '48':

$axid_local =$_POST['txtid_local'];
$axnum_pedido =$_POST['txtnum_pedido'];
$axcant_salida =$_POST['txtcant_salida'];
$axprs_venta =$_POST['txtprs_venta'];
$axid_pedido =$_POST['txtid_pedido'];
$axid_producto_hijo =$_POST['txtid_producto'];
//$axid_producto_padre = get_row_two('PEDIDOS','ID_PRODUCTO_PADRE','ID_PRODUCTO','NUM_PEDIDO',$axid_producto_hijo,$axnum_pedido);
$axid_producto_padre = get_row_three('PEDIDOS','ID_PRODUCTO_PADRE','ID_PRODUCTO','NUM_PEDIDO','ID_PEDIDO',$axid_producto_hijo,$axnum_pedido,$axid_pedido);


//echo $axid_producto_padre;

$SQLBuscar_complementos ="SELECT * FROM PRODUCTOS_COMP WHERE ID_PRODUCTO='$axid_producto_padre'";
$RSBuscar_complementos = odbc_exec($con,$SQLBuscar_complementos);
//echo $SQLBuscar_complementos;


if(odbc_num_rows($RSBuscar_complementos) > 0){

	$SQLBuscar = "SELECT * FROM PEDIDOS WHERE ID_PRODUCTO_PADRE='$axid_producto_padre' AND NUM_PEDIDO='$axnum_pedido'";
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	//echo $SQLBuscar.'<br>';

	while($fila_b = odbc_fetch_array($RSBuscar)){

		$axid_pedido= $fila_b['ID_PEDIDO'];
		$axid_producto_hijo = $fila_b['ID_PRODUCTO'];
		$axprs_venta= $fila_b['PRS_VENTA'];
		$axfactor = get_row_two('PRODUCTOS_COMP','FACTOR_COMPL','ID_PRODUCTO_COMP','ID_PRODUCTO',$axid_producto_hijo,$axid_producto_padre);
	
		$cant_caja = get_row('PRODUCTOS','CANT_CAJA','ID_PRODUCTO',$axid_producto_hijo);
		$axprs_unit = number_format(($axprs_venta/$cant_caja),3,".",","); 
		$axcant_mostrar = ($axcant_salida*$axfactor);
		$axtotal_salida = $axcant_salida*$axprs_venta;	

		//echo $axfactor.'|'.$axcant_salida.'|'.$axcant_mostrar.'|'.$axprs_venta.'|'.$axtotal_salida.'<br>';

		$SQLActualizar = "UPDATE PEDIDOS SET CANT_SALIDA='$axcant_mostrar',TOTAL_SALIDA='$axtotal_salida',CANT_PADRE='$axcant_salida' WHERE ID_PEDIDO='$axid_pedido'";
		$RSActualizar = odbc_exec($con,$SQLActualizar);
		//echo $SQLActualizar.'<br>';

	}


}else{


		$axfactor = get_row('PRODUCTOS','FACTOR_PROD','ID_PRODUCTO',$axid_producto_hijo);
	
		$cant_caja = get_row('PRODUCTOS','CANT_CAJA','ID_PRODUCTO',$axid_producto_hijo);
		$axprs_unit = number_format(($axprs_venta/$cant_caja),3,".",","); 
		$axcant_mostrar = ($axcant_salida*$axfactor);
		$axtotal_salida = $axcant_salida*$axprs_venta;	


		//echo $axfactor.'|'.$axcant_salida.'|'.$axcant_mostrar.'|'.$axprs_venta.'|'.$axtotal_salida.'<br>';

		$SQLActualizar = "UPDATE PEDIDOS SET CANT_SALIDA='$axcant_mostrar',TOTAL_SALIDA='$axtotal_salida',CANT_PADRE='$axcant_salida' WHERE ID_PEDIDO='$axid_pedido'";
		$RSActualizar = odbc_exec($con,$SQLActualizar);
		//echo $SQLActualizar.'<br>';

}

//echo $SQLActualizar;

if($RSActualizar){

	$respuesta =0;
	echo $respuesta;

}else{

	$respuesta =1;
	echo $respuesta;

}

break;

case '49':

$axid_local =$_POST['txtid_local'];
$axnum_pedido =$_POST['txtnum_pedido'];
$axcant_salida =$_POST['txtcant_salida'];
$axprs_venta =$_POST['txtprs_venta'];
$axid_pedido =$_POST['txtid_pedido'];
$axid_producto_hijo =$_POST['txtid_producto'];
$axid_producto_padre = get_row_three('PEDIDOS','ID_PRODUCTO_PADRE','ID_PRODUCTO','NUM_PEDIDO','ID_PEDIDO',$axid_producto_hijo,$axnum_pedido,$axid_pedido);
//echo $axid_producto_padre;

$SQLBuscar_complementos ="SELECT * FROM PRODUCTOS_COMP WHERE ID_PRODUCTO='$axid_producto_padre'";
$RSBuscar_complementos = odbc_exec($con,$SQLBuscar_complementos);
//echo $SQLBuscar_complementos;

if(odbc_num_rows($RSBuscar_complementos) > 0){

	$SQLBuscar = "SELECT * FROM PEDIDOS WHERE ID_PRODUCTO_PADRE='$axid_producto_padre' AND NUM_PEDIDO='$axnum_pedido'";
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	//echo $SQLBuscar.'<br>';

	//while($fila_b = odbc_fetch_array($RSBuscar)){

	//$axid_pedido= $fila_b['ID_PEDIDO'];
	//$axid_producto_hijo = $fila_b['ID_PRODUCTO'];
	//$axprs_venta= $fila_b['PRS_VENTA'];
	$axfactor = get_row_two('PRODUCTOS_COMP','FACTOR_COMPL','ID_PRODUCTO_COMP','ID_PRODUCTO',$axid_producto_hijo,$axid_producto_padre);
	$cant_caja = get_row('PRODUCTOS','CANT_CAJA','ID_PRODUCTO',$axid_producto_hijo);
	$axprs_unit = number_format(($axprs_venta/$cant_caja),3,".",","); 
	$axtotal_salida = $axcant_salida*$axprs_venta;	

	//echo $axcant_salida.'x'.$axprs_venta.'='.$axtotal_salida;

	$SQLActualizar = "UPDATE PEDIDOS_DT SET PRS_VENTA='$axprs_venta',TOTAL_SALIDA='$axtotal_salida' WHERE NUM_PEDIDO='$axnum_pedido' AND ID_PEDIDO='$axid_pedido'";
	$RSActualizar = odbc_exec($con,$SQLActualizar);
	//echo $SQLActualizar;

	

	//}


	

}else{



}


if($RSActualizar){

	$respuesta =0;
	echo $respuesta;

}else{

	$respuesta =1;
	echo $respuesta;

}

break;

case '50':
	
$axid_agencia= $_POST['txtid_agencia'];
	
	$sql6 = "SELECT * FROM TRANSPORTISTAS WHERE ID_AGENCIA = '$axid_agencia'";
	
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

case '51':
	
$axid_agencia= $_POST['txtid_agencia'];
$axnum_pedido= $_POST['txtnum_pedido'];
$axid_local= $_POST['txtid_local'];
$axiid_td= $_POST['txtiid_td'];
$axfecha_despacho= $_POST['txtfecha_despacho_1'];

$axforma_pago = $_POST['txtforma_pago'];
$axdias_credito = $_POST['txtdias_credito'];
if($axdias_credito==''){
	$axdias_credito = 0;
}else{
	$axdias_credito = $_POST['txtdias_credito'];
}

$axestado_forma_pago = $_POST['txtestado_forma_pago'];
$axmedio_pago = $_POST['txtmedio_pago'];
$axid_cta = $_POST['txtid_cta'];
$axnum_transf = $_POST['txtnum_transf'];
$axfecha_transf = $_POST['txtfecha_transf'];
$axid_beneficiario = $_POST['txtid_beneficiario'];
$axperiodo_transf = date('m-Y',strtotime($axfecha_transf));
$axdireccion_entrega = get_row('BENEFICIARIOS','DIRECCION_ENTREGA','ID_BENEFICIARIO',$axid_beneficiario);

$SQLBuscar = "SELECT * FROM PEDIDOS WHERE ID_LOCAL='$axid_local' AND NUM_PEDIDO='$axnum_pedido'";
$RSBuscar = odbc_exec($con,$SQLBuscar);

if(odbc_num_rows($RSBuscar) > 0) {

if($axdireccion_entrega==''){

	$respuesta =3;
	echo $respuesta;

}else{

	$SQLActualizar = "UPDATE PEDIDOS SET ID_AGENCIA ='$axid_agencia',ID_TD='$axiid_td',ID_BENEFICIARIO='$axid_beneficiario',FECHA_DESPACHO='$axfecha_despacho', FORMA_PAGO='$axforma_pago',ESTADO_FORMA_PAGO='$axestado_forma_pago',MEDIO_PAGO='$axmedio_pago',NUM_TRANSF='$axnum_transf',ID_CTA='$axid_cta',PERIODO_TRANSF='$axperiodo_transf',FECHA_TRANSF='$axfecha_transf',DIAS_CREDITO='$axdias_credito',DIRECCION_ENTREGA='$axdireccion_entrega' WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";

//echo $SQLActualizar;

	$RSActualizar = odbc_exec($con,$SQLActualizar);

}



}else{

	$respuesta =1;
	echo $respuesta;

}

break;


case '52':
	

$axbuscaregistro = $_POST['txtbuscar_dato']; 	
$axcodusuario = $_POST['txtcodusuario']; 	
$axid_local = $_POST['txtid_local']; 	
$axfecha_despacho = $_POST['txtfecha_despacho']; 	
$axfecha_al = $_POST['txtfecha_al']; 	
$axestado_atendido = $_POST['txtestado_atendido']; 	
$axfitrar_busquedas = $_POST['txtfitrar_busquedas']; 	


	if($axfitrar_busquedas==""){

	if($axid_local==''){
		$SQLBuscar = "SELECT * FROM PEDIDOS_CZ WHERE ESTADO_ATENDIDO='REVISION' OR ESTADO_ATENDIDO='PENDIENTE' order by NUM_PEDIDO DESC";
	}else{
		$SQLBuscar ="SELECT *  FROM PEDIDOS_CZ WHERE ESTADO_ATENDIDO='REVISION' OR ESTADO_ATENDIDO='PENDIENTE' AND ID_LOCAL='$axid_local' order by FECHA_PEDIDO DESC";
	}
		
				
	}elseif($axfitrar_busquedas=="RANGO"){

		$SQLBuscar ="SELECT *  FROM PEDIDOS_CZ WHERE ESTADO_ATENDIDO='REVISION' OR ESTADO_ATENDIDO='PENDIENTE' AND ID_LOCAL='$axid_local' and FECHA_DESPACHO BETWEEN '$axfecha_despacho' AND '$axfecha_despacho' order by FECHA_DESPACHO DESC";

	}elseif($axfitrar_busquedas=="BUSCAR"){

		$SQLBuscar ="SELECT *  FROM PEDIDOS_CZ WHERE ESTADO_ATENDIDO='REVISION' OR ESTADO_ATENDIDO='PENDIENTE' AND ID_LOCAL='$axid_local' and NOM_COMERCIAL+NUM_PEDIDO+VENDEDOR+DISTRITO_ALTER LIKE '%".$axbuscaregistro."%' ";


	}


	//echo "$SQLBuscar";

	echo "

		<table class='table table-hover table-sm'>
		<thead class='table-success'>			
		<tr>
			<th style='text-align: center;'>It</th>								
			<th class='ocultar' style='text-align: center;'>Vendedor</th>						
			<th style='text-align: left;'>Cliente</th>						
			<th style='text-align: left;'>Distrito</th>						
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$axnum_pedido = $fila['NUM_PEDIDO'];
 		$axvendedor = $fila['VENDEDOR'];
		$axcod_interno = $fila['COD_INTERNO'];	
		$axid_local	= $fila['ID_LOCAL'];	
		$razon_social = utf8_encode($fila['RAZON_SOCIAL']);
		$axtotalpedido =number_format($fila["TOTAL_PEDIDO"],4,".",","); 
		$domic_entrega_pred = $fila['DIRECCION_ENTREGA'];
		$axestado_atendido = $fila['ESTADO_ATENDIDO'];
		$id_beneficiario= $fila['ID_BENEFICIARIO'];
		$axnom_beneficiario= $fila['NOM_COMERCIAL'];
		$axfecha_pedido= date('d-m-Y',strtotime($fila['FECHA_PEDIDO']));
		$axid_local_nombre = $fila['LOCAL_CORTO'];
		$axdistrito_entrega= utf8_encode($fila['DISTRITO_ALTER']);
		$axid_agencia= $fila['ID_AGENCIA'];
		$axid_vehiculo= $fila['ID_VEHICULO'];

		if($axid_agencia <> 0){
			$axagencia = get_row('TRANSPORTISTAS','NOM_AGENCIA','ID_AGENCIA',$axid_agencia);
			$axdir_agencia = get_row('TRANSPORTISTAS','DIR_AGENCIA','ID_AGENCIA',$axid_agencia);
			$domic_entrega_pred = 'Agencia: '.$axagencia.' Direc. '.$axdir_agencia;
		}

		$axnom_vehiculo = get_row('VEHICULOS_DESPACHOS','MARCA_VEHICULO','ID_VEHICULO',$axid_vehiculo).'-'.get_row('VEHICULOS_DESPACHOS','NUM_PLACA','ID_VEHICULO',$axid_vehiculo);

		$axdespacho = $fila['NUM_DESPACHO'].' | '.$axnom_vehiculo.' | '.$fila['NOM_CHOFER'];

		if($fila['NUM_DESPACHO']==''){
			$axtexto = '<b>'.$axfecha_pedido.' | '.$axnum_pedido.' | '.$razon_social.' </b><br> '.$domic_entrega_pred;	
		}else{
			$axtexto = '<b>'.$axfecha_pedido.' | '.$axnum_pedido.' | '.$razon_social.' </b><br> '.$domic_entrega_pred. ' <br><b class="text-danger">'.$axdespacho.'</b>';
		}

		

		//echo $axid_local;

	echo "<tr>";

	
			echo "<td class='text-success'style='text-align: center;'>$it</td>						
						<td class='text-success'style='text-align: center;'>$axvendedor</td>											
						<td class='text-success'style='text-align: left;'><a href='#' class='text-success' style='text-decoration:none;' id='btn_ver_detalle_pedido' data-npedido='$axnum_pedido',data-local='$axid_local'>$axtexto</a></td>											
						<td class='text-success'style='text-align: left;'><b>$axdistrito_entrega</b></td>											
 					  

						";


 	echo "</tr>	";

}
echo "</table>";
}else{
	echo "";
}

break;

case '53':	

$axbuscar_filtro = $_POST['txtbuscar_filtro']; 	
$axnum_pedido = $_POST['txtnum_pedido']; 	
$axid_local = get_row('PEDIDOS_CZ','ID_LOCAL','NUM_PEDIDO',$axnum_pedido);
$axdatos_cliente =get_row('PEDIDOS_CZ','NOM_COMERCIAL','NUM_PEDIDO',$axnum_pedido);


if($axbuscar_filtro==''){
	$SQLBuscar = "SELECT * FROM PEDIDOS_CZ WHERE ESTADO_ATENDIDO <> 'PROGRAMADO' AND ESTADO_ATENDIDO <> 'ATENDIDO' order by DISTRITO_ALTER,NOM_COMERCIAL DESC";
}else{
	$SQLBuscar = "SELECT * FROM PEDIDOS_CZ WHERE ESTADO_ATENDIDO <> 'PROGRAMADO' AND ESTADO_ATENDIDO <> 'ATENDIDO' AND NOM_COMERCIAL+NUM_PEDIDO LIKE '%".$axbuscar_filtro."%'";
}

//echo "$SQLBuscar";

	echo "
		<div>
		<h5 class='text-danger fw-bold'>".$axdatos_cliente_mostrar."</h5>
		</div>
		<table class='table table-hover table-sm'>	
		<thead class='table-success'>				
		<tr>			
		
		<th class='table-success' style='text-align: center;'></th>			
			<th class='table-success' style='text-align: center;'>Tipo</th>			
			<th class='table-success' style='text-align: center;'>It</th>
			<th class='table-success' style='text-align: center;'>Empresa</th>			
			<th class='table-success' style='text-align: center;'>Estado</th>			
			<th class='table-success' style='text-align: left;'>Fec. Despacho</th>			
			<th class='table-success' style='text-align: center;'>Vendedor</th>			
			<th class='table-success' style='text-align: center;'>Num. Pedido</th>			
			<th class='table-success' style='text-align: left;'>Detalle del Pedido</th>						
			<th class='table-success' style='text-align: left;'>Distrito</th>						
			<th class='table-success' style='text-align: left;'>Producto</th>						
			<th style='text-align: right;'>Cant</th>	

		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		
 		$it= $it+1;
 		$axid_dt = $fila['ID_PEDIDO'];		
 		$axnum_pedido = $fila['NUM_PEDIDO'];	
 		$axfecha_pedido= $fila['FECHA_PEDIDO'];	
		$axdireccion_entrega = $fila['DIRECCION_ENTREGA'];
		$axvendedor = $fila['VENDEDOR'];


		$axtipo_entrega = $fila['TIPO_ENTREGA'];
		$axnum_pedido_parcial = $fila['NUM_PEDIDO_PARCIAL'];	

			if($axtipo_entrega=='PARCIAL'){
				$axparcial = "<a href='#' style='text-decoration:none;' data-bs-toggle='modal' data-bs-target='#mdl_ver_pedido_original' id='btn_ver_pedido_original' data-pedido='$axnum_pedido_parcial'><b class='text-primary'> - PARCIAL</b></a>";
			}else{
				$axparcial = "";
			}

		//$axdatos_cliente_mostrar = '<b>'.$axnum_pedido.' | '.$axdatos_cliente.'</b><br>'.$axdireccion_entrega;	

		$axdatos_cliente=$fila['NOM_COMERCIAL'].$axparcial;
		$axdatos_cliente_mostrar = '<b>'.$axdatos_cliente.'</b><br>'.$axdireccion_entrega;	

		
		$axestado_atendido = $fila['ESTADO_ATENDIDO'];
		$axfecha_despacho =date('d-m-Y',strtotime($fila['FECHA_DESPACHO']));
		$axdistrito_entrega = utf8_encode($fila['DISTRITO_ALTER']);
		$axlocal =$fila['LOCAL_CORTO'];		
		$axid_local = $fila['ID_LOCAL'];		  
		$axdespacho = $fila['NUM_DESPACHO'];
		$axid_vehiculo = $fila['ID_VEHICULO'];
		$axnom_chofer = $fila['NOM_CHOFER'];
		$axnom_vehiculo = get_row('VEHICULOS_DESPACHOS','MARCA_VEHICULO','ID_VEHICULO',$axid_vehiculo).'-'.get_row('VEHICULOS_DESPACHOS','NUM_PLACA','ID_VEHICULO',$axid_vehiculo);
		$axdespacho_numero = $fila['NUM_DESPACHO'].' | '.$axnom_vehiculo.' | '.$axnom_chofer;

		$axtipo_venta = $fila['TIPO_VENTA'];

			$SQLSumar = "SELECT SUM(CANT_SALIDA) AS CANT FROM PEDIDOS_DT WHERE NUM_PEDIDO='$axnum_pedido'";
			$RSSumar = odbc_exec($con,$SQLSumar);
			$fila_s = odbc_fetch_array($RSSumar);
			$axtotal_cant =number_format($fila_s["CANT"],2,".",",");			

		if($axdespacho==''){

			$axnum_pedido_observado = get_row('PEDIDOS_PRECIOS_OBSERVADOS','NUM_PEDIDO','NUM_PEDIDO',$axnum_pedido);		

			//echo $axnum_pedido_observado.'<br>';

			if($axnum_pedido_observado ==''){

					$axboton ="<a href='#' style='text-decoration:none; color:green;' id='btn_agregar_a_despacho' data-local='$axid_local' data-idveh='$axid_vehiculo'  data-npedido='$axnum_pedido',data-local='$axid_local' data-pparcial='$axnum_pedido_parcial'><i class='bi bi-plus-circle-fill' style='color:green;'></i> Agregar </a>";
					$axdespacho_fecha = $axdatos_cliente_mostrar;
			
				
			}else{


				$axcod_producto_padre = get_row('PEDIDOS_PRECIOS_OBSERVADOS','COD_PRODUCTO','NUM_PEDIDO',$axnum_pedido);
				$axid_producto_padre = get_row('PRODUCTOS','ID_PRODUCTO','COD_PRODUCTO',$axcod_producto_padre);
				$axestado = get_row_two('PEDIDOS','ESTADO_PRC_MINIMO','NUM_PEDIDO','ID_PRODUCTO_PADRE',$axnum_pedido,$axid_producto_padre);

				if($axestado=='RECHAZADO' || $axestado==''){

					$axboton ="<a href='#' style='text-decoration:none; color:green;'  data-local='$axid_local' data-idveh='$axid_vehiculo'  data-npedido='$axnum_pedido',data-local='$axid_local'><i class='bi bi-plus-circle-fill' style='color:green;'></i> Bloqueado </a>";
					$axdespacho_fecha = $axdatos_cliente_mostrar;
						
				}elseif($axestado=='APROBADO'){

					$axboton ="<a href='#' style='text-decoration:none; color:green;' id='btn_agregar_a_despacho' data-local='$axid_local' data-idveh='$axid_vehiculo'  data-npedido='$axnum_pedido',data-local='$axid_local' data-pparcial='$axnum_pedido_parcial'><i class='bi bi-plus-circle-fill' style='color:green;'></i> Agregar </a>";
					$axdespacho_fecha = $axdatos_cliente_mostrar;

				}

				

					

				}
			
			
			
			
		}else{

			$axboton ="<a href='#' style='text-decoration:none; color:red;' id='btn_quitar_a_despacho' data-local='$axid_local' data-idveh='$axid_vehiculo'  data-ndespacho='$axdespacho'data-nvehiculo='$axnom_vehiculo' data-nchofer='$axnom_chofer'  data-npedido='$axnum_pedido',data-local='$axid_local'><i class='bi bi-dash-circle-fill' style='color:red;'></i> Quitar </a>";
			$axdespacho_fecha = '<b>'.$axdatos_cliente_mostrar.'</b><br>'.$axdespacho_numero;
		}

		


			if($axestado_atendido=='PENDIENTE'){

					echo "<tr>
					<td class='text-danger table-secondary' style='text-align: center;'><a href='#' style='text-decoration:none;' id='btn_eliminar_pedido' data-tipoentrega='$axtipo_entrega' data-estado:'$axestado_atendido' data-tventa='$axtipo_venta' data-npedido='$axnum_pedido' title='Este boton cambia de estado ACTIVO a ELIMINADO  a cualquier pedido que estan en estado PENDIENTE...'><i class='bi bi-trash3-fill'></i> </a></td>

					<td class='text-danger table-secondary' style='text-align: center;'><a href='#' style='text-decoration:none;' id='btn_tipo_venta'data-tventa='$axtipo_venta' data-npedido='$axnum_pedido'>$axtipo_venta</a></td>
					<td class='text-danger table-secondary' style='text-align: center;'><b>$it</b></td>					
					<td class='text-danger table-secondary' style='text-align: center;'><a href='#' id='btn_cambiar_local' style='text-decoration:none;'title='Click para cambia el almacen o local del pedido' data-npedido='$axnum_pedido' data-bs-toggle='modal' data-bs-target='#mdl_cambiar_local' ><b>$axlocal</b></a></td>
					<td class='text-danger table-secondary' style='text-align: center;'><b>$axestado_atendido</b></td>
					<td class='text-danger table-secondary' style='text-align: left;'><b>$axfecha_despacho</b></td>
					<td class='text-danger table-secondary' style='text-align: center;'><b>$axvendedor</b></td>
					<td class='text-danger table-secondary' style='text-align: center;'><b><a class='text-danger' href='#' id='btn_cambiar_estado'title='Click para abrir el pedido...' data-id='$axnum_pedido' data-estado='$axestado_atendido' data-fpedido='$axfecha_pedido'  style='text-decoration:none;'>$axnum_pedido</a></b></td>
					<td class='text-danger table-secondary' style='text-align: left;'><b>$axdespacho_fecha</b></td>
					<td class='text-danger table-secondary' style='text-align: left;'><b>$axdistrito_entrega</b></td>			
					<td class='text-danger table-secondary' style='text-align: right;'>$axboton</td>			
					<td class='text-danger table-secondary' style='text-align: right;'><b>$axtotal_cant</b></td>			
					</tr>";


			}elseif($axestado_atendido=='REVISION'){

					echo "<tr>

					<td class='text-danger table-secondary' style='text-align: center;'><a href='#' style='text-decoration:none;' id='btn_eliminar_pedidoXXX' data-tipoentrega='$axtipo_entrega' data-estado:'$axestado_atendido' data-tventa='$axtipo_venta' data-npedido='$axnum_pedido'><i class='bi bi-trash3-fill'></i> </a></td>

					<td class='text-danger table-secondary' style='text-align: center;'>$axtipo_venta</td>
					<td class='text-success table-secondary' style='text-align: center;'><b>$it</b></td>
					<td class='text-success table-secondary' style='text-align: center;'><b>$axlocal</b></td>
					<td class='text-success table-secondary' style='text-align: center;'><b>$axestado_atendido</b></td>
					<td class='text-success table-secondary' style='text-align: left;'><b>$axfecha_despacho</b></td>
					<td class='text-success table-secondary' style='text-align: center;'><b>$axvendedor</b></td>
					<td class='text-success table-secondary' style='text-align: center;'><b><a class='text-danger' href='#' id='btn_cambiar_estado' data-id='$axnum_pedido' data-estado='$axestado_atendido'  data-fpedido='$axfecha_pedido' style='text-decoration:none;'>$axnum_pedido</a></b></td>
					<td class='text-success table-secondary' style='text-align: left;'><b>$axdespacho_fecha</b></td>
					<td class='text-success table-secondary' style='text-align: left;'><b>$axdistrito_entrega</b></td>			
					<td class='text-success table-secondary' style='text-align: right;'>$axboton</td>			
					<td class='text-success table-secondary' style='text-align: right;'><b>$axtotal_cant</b></td>			
					</tr>";
			}

	




			$SQLBuscar_dt ="SELECT *  FROM PEDIDOS_DESPACHOS WHERE NUM_PEDIDO	='$axnum_pedido' order by ID_PRODUCTO_PADRE ASC";
			$RSBuscar_dt = odbc_exec($con,$SQLBuscar_dt);
			//echo $SQLBuscar_dt;

			while ($fila_dt = odbc_fetch_array($RSBuscar_dt)) {
			
				$axcant_salida =number_format($fila_dt["CANT_SALIDA"],2,".",","); 		
				$axid_vehiculo= $fila_dt['ID_VEHICULO'];
				$cod_producto = $fila_dt['COD_PRODUCTO'];
				$axid_producto = $fila_dt['ID_PRODUCTO'];
				$nom_categoria = $fila_dt['NOM_CATEGORIA'];
				$nom_producto = $fila_dt['NOM_PRODUCTO'];
				$tipo = $fila_dt['TIPO'];
				$presentacion = $fila_dt['PRESENTACION'];
				$procedencia = $fila_dt['PROCEDENCIA'];
				$estado = $fila_dt['ESTADO'];
				$cant_caja = $fila_dt['CANT_CAJA'];
				$cant_caja_1 = number_format($fila_dt['CANT_CAJA'],0,".",","); 
				$axprs_unit = number_format(($axprs_venta/$cant_caja),3,".",","); 
				$axcosto_producto= number_format($fila_dt['COSTO_PRODUCTO'],2,".",","); 


				
				$axnom_vehiculo = $fila_dt['NOM_VEHICULO'];
				$axnom_chofer = $fila_dt['NOM_CHOFER'];			
				$axprod_mostrar = $cod_producto.' | '.$nom_producto.' '.$tipo.' '.$presentacion.' '.$cant_caja_1;		

				if($axestado_atendido=='PENDIENTE'){

					echo "<tr>
					<td class='text-danger' style='text-align: center;' colspan='9'></td>				
					<td class='text-danger' style='text-align: left;'>".utf8_encode($axprod_mostrar)."</td>
					<td class='text-danger' style='text-align: right;' >$axcant_salida</td>
					</tr>";

				}elseif($axestado_atendido=='REVISION'){

					echo "<tr>
					<td class='text-success'style='text-align: center;' colspan='9'></td>				
					<td class='text-success'style='text-align: left;'>".utf8_encode($axprod_mostrar)."</td>
					<td class='text-success' style='text-align: right;'>$axcant_salida</td>
					</tr>";

				}				


			}


		}

	
		$SQLSumar_1 = "SELECT SUM(CANT_SALIDA) AS CANT FROM PEDIDOS_DT WHERE ESTADO_ATENDIDO <> 'PROGRAMADO' AND ESTADO_ATENDIDO <> 'ATENDIDO'";
			$RSSumar_1 = odbc_exec($con,$SQLSumar_1);
			$fila_t = odbc_fetch_array($RSSumar_1);
			$axtotal_cant_t =number_format($fila_t["CANT"],2,".",",");	
	
		echo "<tr style='font-size:12px;'>
			<th colspan='10' style='text-align:right;'><b>Total Cajas por despachar</b></th>
			<th style='text-align:right;'><b>$axtotal_cant_t</b></th>
			</tr>";					
				

				
	}
echo "</table>";

break;

case '54':
	
$axid_local = $_POST['txtid_local']; 	
$axnum_pedido = $_POST['txtnum_pedido']; 	
$axfecha_despacho = $_POST['txtfecha_despacho']; 	
$axnum_despacho = $_POST['txtnum_despacho']; 	
$axid_vehiculo = $_POST['txtid_vehiculo']; 	
$axnom_chofer = $_POST['txtnom_chofer']; 	

$axceros = verificar_ceros($axnum_pedido);

if (!empty($axceros)) {

    // Mostrar la tabla HTML si hay registros con PRS_VENTA = 0
    echo "
    <table class='table table-hover table-sm'>	
		<thead class='table-danger'>				
		<tr>
			<th style='text-align: center;'> CODIGO</th>			
			<th style='text-align: left;'> PRODUCTO</th>		
			<th style='text-align: right;'> CANTIDAD</th>		
			<th style='text-align: right;'> PRECIO</th>
		</tr>
		</thead>";

    foreach ($axceros as $registro) {
    echo "<tr>                
          <td style='text-align: center;'> {$registro['COD_PRODUCTO']} </td>
          <td style='text-align: left;'> {$registro['NOM_PRODUCTO']} </td>
          <td style='text-align: right;'> {$registro['CANT_SALIDA']} </td>
          <td style='text-align: right;'> {$registro['PRS_VENTA']} </td>
        </tr>";
    }

    echo "</table>";

} else {

    // Continuar con los demás procesos si no hay registros con PRS_VENTA = 0

    $verificar = get_row_two('MAESTRO_CZ','NUM_PEDIDO','NUM_PEDIDO','ID_LOCAL',$axnum_pedido,$axid_local);
    $adelanto = get_row('CTA_COBRAR_PAGOS_REPORTE','NUM_PEDIDO','NUM_PEDIDO',$axnum_pedido);

			//echo $verificar;

			if($verificar ==''){

			//echo "NO ESTA EN MAESTRO_CZ";

			$SQLActualizar = "UPDATE PEDIDOS SET ID_VEHICULO='$axid_vehiculo',FECHA_DESPACHO='$axfecha_despacho',NUM_DESPACHO='$axnum_despacho',NOM_CHOFER='$axnom_chofer',ESTADO_ATENDIDO='REVISION', TIPO_VENTA='VENTA'  WHERE ID_LOCAL='$axid_local' AND NUM_PEDIDO='$axnum_pedido'";
			$RSActualizar  = odbc_exec($con,$SQLActualizar);
			if($RSActualizar){

				if($adelanto !==''){
					$sqlstock_adelanto_cta_por_cobrar = "UPDATE CTA_COBRAR_PAGOS_REPORTE SET NUM_DESPACHO='$axnum_despacho' WHERE NUM_PEDIDO='$axnum_pedido'";
					$rsstock_adelanto_cta_por_cobrar = odbc_exec($con,$sqlstock_adelanto_cta_por_cobrar);
				}

				$respuesta=0;
				echo $respuesta;
			}else{
				$respuesta=1;
				echo $respuesta;

			}


			}else{

			//echo "SI ESTA EN MAESTRO_CZ";

			$SQLActualizar = "UPDATE PEDIDOS SET ID_VEHICULO='$axid_vehiculo',FECHA_DESPACHO='$axfecha_despacho',NUM_DESPACHO='$axnum_despacho',NOM_CHOFER='$axnom_chofer',ESTADO_ATENDIDO='PROGRAMADO'  WHERE ID_LOCAL='$axid_local' AND NUM_PEDIDO='$axnum_pedido'";
			$RSActualizar  = odbc_exec($con,$SQLActualizar);
			if($RSActualizar){
				
				$SQLActualizar_maestro = "UPDATE MAESTRO_CZ SET ESTADO_INVENTARIO='INVENTARIO' WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
				$RSActualizar_maestro = odbc_exec($con,$SQLActualizar_maestro);

				if($adelanto !==''){
					$sqlstock_adelanto_cta_por_cobrar = "UPDATE CTA_COBRAR_PAGOS_REPORTE SET NUM_DESPACHO='$axnum_despacho' WHERE NUM_PEDIDO='$axnum_pedido'";
					$rsstock_adelanto_cta_por_cobrar = odbc_exec($con,$sqlstock_adelanto_cta_por_cobrar);
				}

				$respuesta=0;
				echo $respuesta;
			}else{
				$respuesta=1;
				echo $respuesta;

			}


		}


}

break;

case '55':
	
$axnum_despacho = $_POST['txtnum_despacho']; 	
$axid_vehiculo = $_POST['txtid_vehiculo']; 	

	$sql6 = "SELECT * FROM PEDIDOS_RESUMEN_CJAS WHERE ID_VEHICULO='$axid_vehiculo' AND NUM_DESPACHO='$axnum_despacho'";
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

case '56':
	
	$axnum_pedido = $_POST['txtnum_pedido']; 	
	$axnum_despacho = $_POST['txtnum_despacho']; 	
	$axid_vehiculo = $_POST['txtid_vehiculo']; 	
	$axnom_chofer = $_POST['txtnom_chofer']; 	
	$axid_local = get_row('PEDIDOS_CZ','ID_LOCAL','NUM_PEDIDO',$axnum_pedido)	;
	$adelanto = get_row('CTA_COBRAR_PAGOS_REPORTE','NUM_PEDIDO','NUM_PEDIDO',$axnum_pedido);

	$SQLActualizar = "UPDATE PEDIDOS SET ID_VEHICULO='',NUM_DESPACHO='',NOM_CHOFER='',ESTADO_ATENDIDO='PENDIENTE' WHERE ID_LOCAL='$axid_local' AND NUM_PEDIDO='$axnum_pedido' AND ID_VEHICULO='$axid_vehiculo' AND NUM_DESPACHO='$axnum_despacho' AND NOM_CHOFER='$axnom_chofer'";
	$RSActualizar = odbc_exec($con,$SQLActualizar);

	//echo $SQLActualizar;

if($RSActualizar){

	if($adelanto !==''){
		$sqlstock_adelanto_cta_por_cobrar = "UPDATE CTA_COBRAR_PAGOS_REPORTE SET NUM_DESPACHO='' WHERE NUM_PEDIDO='$axnum_pedido'";
		$rsstock_adelanto_cta_por_cobrar = odbc_exec($con,$sqlstock_adelanto_cta_por_cobrar);
	}


	$respuesta=0;
	echo $respuesta;
}else{
	$respuesta=1;
	echo $respuesta;

}

break;

case '57':

$axnum_pedido = $_POST['txtnum_pedido']; 	
$axid_local = $_POST['txtid_local']; 	

if($axid_local==''){
	$axid_local = get_row('PEDIDOS_CZ','ID_LOCAL','NUM_PEDIDO',$axnum_pedido)	;
}



$SQLActualizar = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='PENDIENTE' WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
$RSActualizar = odbc_exec($con,$SQLActualizar);

if($RSActualizar){

	$respuesta =0;
	echo $respuesta;

}else{

	$respuesta =1;
	echo $respuesta;

}

break;

case '58':
	

	$axid_local = $_POST['txtid_local']; 		

	$sqletapas = "SELECT * FROM FECHAS_DESPACHOS WHERE ID_LOCAL ='$axid_local' AND ESTADO_ATENDIDO='REVISION' ORDER BY FECHA_DESPACHO DESC" ;
	
	//echo $sqletapas;	      

	$rsetapas=odbc_exec($con,$sqletapas);
	
	if(odbc_num_rows($rsetapas) > 0){
		echo '<option value="">Seleccionar</option>';
		while($fila=odbc_fetch_array($rsetapas)){
	   		echo '<option value='.$fila['FECHA_DESPACHO'].'>'.date('d-m-Y',strtotime($fila['FECHA_DESPACHO'])).'</option>';
    	}
		
	} else {

		echo "";	
	}


break;

case '59':
	
$axid_local= $_POST['txtid_local'];
$axnum_pedido= $_POST['txtnum_pedido'];
	
	$sql6 = "SELECT * FROM PEDIDOS_CZ WHERE ID_LOCAL = '$axid_local' and NUM_PEDIDO='$axnum_pedido'";
	
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

case '60':
	
	
	$axnum_pedido= $_POST['txtnum_pedido'];	
	$axid_local= $_POST['txtid_local'];

	$axid_beneficiario= $_POST['txtid_beneficiario'];
	$axfecha_despacho= $_POST['txtfecha_despacho'];
	$axid_agencia= $_POST['txtid_agencia'];
	$axiid_td= $_POST['txtiid_td'];
	$axtipo_venta= $_POST['txttipo_venta'];

	$axforma_pago =$_POST['txtforma_pago'];
	$axestado_forma_pago =$_POST['txtestado_forma_pago'];
	$axmedio_pago =$_POST['txtmedio_pago'];
	$axid_cta =$_POST['txtid_cta'];
	$axnum_transf =$_POST['txtnum_transf'];
	$axfecha_transf =$_POST['txtfecha_transf'];
	$axperiodo_transf = date('m-Y',strtotime($axfecha_transf));
	$axobservacion_pedido =$_POST['txtobserv_proforma'];

	$axid_usuario = $_POST['txtid_usuario']; 		
	$axnom_modulo = $_POST['txtnom_modulo']; 
	$axnom_cliente = get_row('BENEFICIARIOS','NOM_COMERCIAL','ID_BENEFICIARIO',$axid_beneficiario);
	$axdetalle = $_POST['axdetalle'].' '.$axnom_cliente.' NUM PEDIDO '.$axnum_pedido.' ( SOLO GENERADO)'; 	
	

	$SQLBuscar = "SELECT * FROM PEDIDOS WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
	$RSBuscar = odbc_exec($con,$SQLBuscar);

	if(odbc_num_rows($RSBuscar) > 0) {

		$SQLActualizar_PD = "UPDATE PEDIDOS SET ID_BENEFICIARIO='$axid_beneficiario',FECHA_DESPACHO='$axfecha_despacho',ID_AGENCIA='$axid_agencia', ID_TD='$axiid_td',FORMA_PAGO='$axforma_pago',ESTADO_FORMA_PAGO='$axestado_forma_pago',MEDIO_PAGO='$axmedio_pago',NUM_TRANSF='$axnum_transf',ID_CTA='$axid_cta',PERIODO_TRANSF='$axperiodo_transf',FECHA_TRANSF='$axfecha_transf',OBSERV_ENTREGA='$axobservacion_pedido',TIPO_VENTA='$axtipo_venta' WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
		$RSActualizar_PD = odbc_exec($con,$SQLActualizar_PD);
		//echo $SQLActualizar_PD;
		$axdetalle = 'ACTUALIZO EL NOMBRE DEL CLIENTE '.' | '.$axnom_cliente.' DEL PEDIDO NUMERO '.$axnum_pedido.' (GRABADO EN LA BD)';
		guardar_bitacora($axid_usuario,$axnom_modulo,$axdetalle);

	}else{

		guardar_bitacora($axid_usuario,$axnom_modulo,$axdetalle);
		$respuesta = 1;
		echo $respuesta;


	}

break;

case '61':
	
$axidempresa = $_POST['txtidempresa']; 
	$axbuscaregistro = $_POST['txtbuscarusuario']; 

	if($axbuscaregistro==""){
		
		$sql6 ="SELECT * FROM USUARIOS WHERE ID_EMPRESA='$axidempresa'";

	}else{

		$sql6 ="SELECT * FROM USUARIOS WHERE ID_EMPRESA='$axidempresa' AND USUARIO+NOM_USUARIO like '%".$axbuscaregistro."%' ";

	}
	
	//echo $sql6;

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>					
		<tr>
			<th style='text-align:center;' >IT</th>
			<th style='text-align:center;' >TIPO</th>
			<th style='text-align:center;' >USUARIO</th>
			<th style='text-align:left;' >NOMBRES</th>			
			<th style='text-align:center;' >FEC. REGISTRO</th>			
			<th style='text-align:center;' >ESTADO</th>
			<th style='text-align:center;' >ACCION</th>
		</tr>
		</thead>";
	
	$result6=odbc_exec($con,$sql6);
	
	if ($result6){
 	
 	while ($row=odbc_fetch_array($result6)){ 
 		$iduser = $row["ID_USUARIO"];
 		$it=$it+1;
 	echo "
 		<tr>
 			<td style='text-align:center;'>".$it."</td> 		
 			<td style='text-align:center;'>".$row["TIPO_USUARIO"]."</td> 
 			<td style='text-align:center;'>".$row["USUARIO"]."</td>
 			<td style='text-align:left;'>".$row["NOM_USUARIO"]."</td>
 			<td style='text-align:center;'>".$row["F_REGISTRO"]."</td>  			
 			<td style='text-align:center;'>".$row["CONDICION"]."</td> 
 			<td  style='text-align: center;'>
 				<div class='btn-group dropstart'>
					<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
					<ul class='dropdown-menu'>	
					<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-info' id='bteditarusuario' data-iduser='$iduser' data-bs-toggle='modal' data-bs-target='#exampleModal'><b><i class='bi bi-pencil' ></i> Editar</a></b>
					<a href='#' class='dropdown-item text-danger' id='bteliminarusuario' data-iduser='$iduser' ><b><i class='bi bi-trash3-fill'></i> Eliminar</a></b>					
					<div><hr class='dropdown-divider'></div>
					</ul>
				</div>
 			</td>

 			<td >


 		</tr>
 	";

}
echo "</table>";
}

break;

case '62':
	
$axcoduser= $_POST['axiduser'];
	
	$sql6 = "SELECT * FROM USUARIOS WHERE ID_USUARIO = '$axcoduser'";
	
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

case '63':
	

	
	$axicod_interno = $_POST['txtcod_interno'];
	$axidempresa = $_POST['txtidempresa']; 
	$axidusuario = $_POST['txtidusuario']; 
	$axcoduser = $_POST['txtdniusuario']; 
	$axuser = $_POST['txtusuario']; 
	$axnomusuario = $_POST['txtnombreusuario']; 
	$axclave = $_POST['txtclave']; 
	$axcargo = $_POST['txtcargo']; 
	$axfecharegistro = $_POST['txtfecharegistro'];
	$axcondicion = $_POST['txtcondicion'];
	$axparametros = $_POST['txtparametros']; 
	$axcorrelativo_pedidos = $_POST['txtcorrelativo_pedidos']; 
	$axnum_licencia = $_POST['txtnum_licencia']; 

	$axpaterno = $_POST['txtpaterno'];
	$axmaterno = $_POST['txtmaterno'];
	$axnombres = $_POST['txtnombres'];
	$axletra_serie = $_POST['txtletra_serie'];

if($axcargo=='VENDEDOR'){
	$axfiltro_ventas  =$axcargo;
}else{
	$axfiltro_ventas = '';
}

	
	

	if($axparametros==1){

	 

		$Insertar = "INSERT INTO USUARIOS (COD_INTERNO,ID_EMPRESA,COD_USUARIO,USUARIO,NOM_USUARIO,CLAVE,TIPO_USUARIO,F_REGISTRO,CONDICION,CORRELATIVO_VENDEDOR,NUM_LICENCIA,PATERNO,MATERNO,NOMBRES,N_SERIE_VENDEDOR,FILTRO_VENTAS) VALUES ('$axicod_interno','$axidempresa','$axcoduser','$axuser','$axnomusuario','$axclave','$axcargo','$axfecharegistro','$axcondicion','$axcorrelativo_pedidos','$axnum_licencia','$axpaterno','$axmaterno','$axnombres','$axletra_serie','$axfiltro_ventas')";
		//echo "$Insertar";
		
	} else {

		//$Insertar = "UPDATE MAESTRO_DT SET ESTADO_ATENCION='KIOSKO',HORA_INICIO='$axhoractual' WHERE COD_MOV='$axcodmovCZ'";

		$Insertar ="UPDATE USUARIOS SET ID_EMPRESA='$axidempresa',COD_USUARIO='$axcoduser',USUARIO='$axuser',NOM_USUARIO='$axnomusuario',CLAVE='$axclave',TIPO_USUARIO='$axcargo',F_REGISTRO='$axfecharegistro',CONDICION='$axcondicion',CORRELATIVO_VENDEDOR='$axcorrelativo_pedidos',NUM_LICENCIA='$axnum_licencia',PATERNO='$axpaterno',MATERNO='$axmaterno',NOMBRES='$axnombres',N_SERIE_VENDEDOR='$axletra_serie',FILTRO_VENTAS='$axfiltro_ventas' WHERE ID_USUARIO='$axidusuario'";
			
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

case '64':
	
$axidempresa = $_POST['txtidempresa']; 
	$sql6 ="SELECT ID_MENU,NOM_MENU FROM MODULOS ORDER BY NOM_MENU ASC";
	//echo "$sql6";

	echo "
		
  		
  		<table class='table table-hover table-sm'>
  		<thead>
		<tr>
		  	<th scope='col'>Menu</th>
			<th scope='col' style='text-align: center'>Asignar</th>
		</tr>
		<thead>
		
	";

	$result6=odbc_exec($con,$sql6);
	if ($result6){
 		while ($row=odbc_fetch_array($result6)){ 
 			$id = $row["ID_MENU"];
 		echo "
 			<tr> 		
 				<td >".$row["NOM_MENU"]."</td>
 				<td style='text-align: center'>
 					<a href='#' id='txtasignarpermiso' data-idmenu='$id'><i class='fas fa-plus'></i></a>
 				</td> 
 			</tr>
 		";
}
echo "</table>";
}

break;

case '65':
date_default_timezone_set("America/Lima");
	
	$axcod_interno = $_POST['txtcod_interno']; 
	$axidusuario = get_row('USUARIOS','ID_USUARIO','COD_INTERNO',$axcod_interno);
	$axfecharegistro = date('Y-m-d');
	$axparametros = $_POST['txtparametros']; 
	$axidmenu = $_POST['axidmenu']; 
	$axidpermiso = $_POST['txtidpermiso']; 

	
	$Insertar = "INSERT INTO USUARIO_PERMISOS (ID_USUARIO,FECHA_ASIGNACION,ID_MENU) VALUES ('$axidusuario','$axfecharegistro','$axidmenu')";
	//echo "$Insertar";
	$result6=odbc_exec($con,$Insertar); 
		
	if($result6){
		$respuesta = 0;
		echo"$respuesta"; // grabado
		
	}else{
		$respuesta = 1;
		echo"$respuesta"; // grabado
	}


break;

case '66':
	
	$axcod_interno = $_POST['txtcod_interno']; 
	$axidusuario = get_row('USUARIOS','ID_USUARIO','COD_INTERNO',$axcod_interno);

	$sql6 ="SELECT * FROM MODULO_ASIGNADO WHERE ID_USUARIO='$axidusuario' ORDER BY NOM_MENU ASC";
	//echo "$sql6";
	echo "		
  		<table class='table table-hover table-sm'>
  		<thead>
		<tr>
			<th scope='col'>Acceso a</th>
			<th scope='col' style='text-align: center'>Quitar</th>
		</tr>
		<thead>";

	$result6=odbc_exec($con,$sql6);
	if ($result6){
 		while ($row=odbc_fetch_array($result6)){ 
 			$idpermiso = $row["ID_PERMISO"];
 			$idusuario = $row["ID_USUARIO"];
 			$idmenu = $row["ID_MENU"];
 			
 		echo "
 			<tr> 		
 				<td >".$row["NOM_MENU"]."</td>
 				<td style='text-align: center'>
 					<a href='#' id='btquitarmenu' data-idmenu='$idmenu'><i class='fas fa-minus-circle'></i></a>
 				</td> 
 			</tr>
 		";
}
echo "</table>";
}


break;

case '67':
	

$axidmenu = $_POST['axidmenu'];
	$axidusuario = $_POST['txtidusuario'];
	

	 $sql ="DELETE FROM USUARIO_PERMISOS WHERE ID_MENU='$axidmenu' AND ID_USUARIO ='$axidusuario' ";
   $result6=odbc_exec($con,$sql); 
   //echo $sql;
 
     if ($result6){

     	$respuesta =0;
     	echo $respuesta;

     }else{

     	$respuesta =1;
     	echo $respuesta;

     }

break;

case '68':
	
	$axcod_interno = $_POST['txtcod_interno']; 
	$axidusuario = get_row('USUARIOS','ID_USUARIO','COD_INTERNO',$axcod_interno);
	$axfecharegistro = $_POST['txtfecharegistro']; 
	$axparametros = $_POST['txtparametros']; 
	$axid_local = $_POST['txtid_local']; 
	$axetapapy = $_POST['txtetapapy']; 
	$axidasignacion = $_POST['txtidasinacion']; 

	$Insertar = "INSERT INTO USUARIO_LOCALES (ID_USUARIO,FECHA_ASIGNACION,ID_LOCAL) VALUES ('$axidusuario','$axfecharegistro','$axid_local')";
	$result6=odbc_exec($con,$Insertar); 

	if($result6){

		$respuesta = 0;
		echo"$respuesta"; // grabado

	}else{
		
		$respuesta = 1;
		echo"$respuesta"; // no grabado

	}

break;

case '69':
	
	$axcod_interno = $_POST['txtcod_interno']; 
	$axidusuario = get_row('USUARIOS','ID_USUARIO','COD_INTERNO',$axcod_interno);	
	$sql6 ="SELECT * FROM USUARIOS_LOCALES_ASIG WHERE ID_USUARIO='$axidusuario' ORDER BY RAZON_SOCIAL ASC";

	//echo "$sql6";

	echo "
		
  		<table class='table table-hover table-sm'>
  		<thead>
		<tr>
		  
			<th scope='col'>Acceso a</th>
			<th scope='col'>Acción</th>

		</tr>
		<thead>
		
	";

	$result6=odbc_exec($con,$sql6);
	if ($result6){
 		while ($row=odbc_fetch_array($result6)){ 
 			$idasignacion = $row["ID_ASIGNACION"];
 			
 		echo "
 			<tr> 		
 				<td >".$row["RAZON_SOCIAL"]."</td>
 				<td >
 					<a href='#' class='btn btn-outline-danger btn-sm' id='txtquitaretapa' data-idasignetapa='$idasignacion'>Quitar</a>

 				</td> 
 			</tr>
 		";
}
echo "</table>";
}

break;

case '70':
	
	$idasignetapa = $_POST['idasignetapa'];	
	
	$axcod_interno = $_POST['txtcod_interno']; 
	$axidusuario = get_row('USUARIOS','ID_USUARIO','COD_INTERNO',$axcod_interno);	
	
	$sql ="DELETE FROM USUARIO_LOCALES WHERE ID_ASIGNACION='$idasignetapa'";
    $result6=odbc_exec($con,$sql); 

     if ($result6){

     	$respuesta =0;
     	echo $respuesta;

     }else{

     	$respuesta =1;
     	echo $respuesta;

     }

break;

case '71':
	
	$SQLBuscar = "SELECT * FROM BENEFICIARIOS_DIR ORDER BY DISTRITO_ALTER ASC";
	$RSBuscar = odbc_exec($con,$SQLBuscar);

//	echo $SQLBuscar;

	while ($fila_c = odbc_fetch_array($RSBuscar)) {
		
	$axdistrito =$fila_c['DISTRITO_ALTER'];
	
	$SQLUBIGEO = "SELECT * FROM TB_UBIGEOS_LISTA WHERE DISTRITO = '$axdistrito' AND DEPARTAMENTO='CUSCO'";
	$RSUbigeo = odbc_exec($con,$SQLUBIGEO);
	$fila_u = odbc_fetch_array($RSUbigeo);

	$axcod = $fila_u['UBIGEO_REINEC'];	


	$SQLActualizar = "UPDATE BENEFICIARIOS_DIR SET cod_ubi_llegada='$axcod' WHERE DISTRITO_ALTER='$axdistrito' AND cod_ubi_llegada=''";
	//echo $SQLActualizar.'<br>';	
	$RSActualizar = odbc_exec($con,$SQLActualizar);

	




	}

break;

case '72':

$axid_local = $_POST['txtid_local']; 		
$axid_td_cp = $_POST['txtid_td_cp']; 		
$axiid_td_guia = $_POST['txtid_td_guia']; 		
$axnum_pedido = $_POST['txtnum_pedido']; 		

if($axid_local==''){
	$axid_local = get_row('PEDIDOS_CZ','ID_LOCAL','NUM_PEDIDO',$axnum_pedido);
}

if($axid_td_cp ==''){

	$sqletapas = "SELECT * FROM CORRELATIVOS WHERE ID_LOCAL ='$axid_local' AND ID_TD='$axiid_td_guia' ORDER BY ID_TD ASC" ;

}elseif($axiid_td_guia==''){

	$sqletapas = "SELECT * FROM CORRELATIVOS WHERE ID_LOCAL ='$axid_local' AND ID_TD='$axid_td_cp' ORDER BY ID_TD ASC" ;

}


	
//echo $sqletapas;	      

$rsetapas=odbc_exec($con,$sqletapas);
	
	if(odbc_num_rows($rsetapas) > 0){
	//	echo '<option value="">Seleccionar</option>';
		while($fila=odbc_fetch_array($rsetapas)){
	   		echo '<option value='.$fila['COD_CORR'].'>'.$fila['N_SERIE'].'</option>';
    	}
		
	} else {

		echo "";	
	}




break;

case '73':
	
$axid_local = $_POST['txtid_local']; 		
$axid_td_cp = $_POST['txtid_td_cp']; 		
$axnum_pedido = $_POST['txtnum_pedido']; 		
$axserie = $_POST['txt_serie']; 		
$axiid_td_guia = $_POST['txtid_td_guia']; 		
$axserie_guia = $_POST['txt_serie_guia']; 		
$axn_serie = get_row('CORRELATIVOS','N_SERIE','COD_CORR',$axserie);

if($axid_local==''){
	$axid_local = get_row('PEDIDOS_CZ','ID_LOCAL','NUM_PEDIDO',$axnum_pedido);
}

if($axid_td_cp ==''){

	$sqletapas = "SELECT * FROM CORRELATIVOS WHERE ID_LOCAL ='$axid_local' AND ID_TD='$axiid_td_guia' and COD_CORR='$axserie_guia' ORDER BY ID_TD ASC" ;	
	//echo 'GUIA - '.$sqletapas.'<br>';	      

	$rsetapas=odbc_exec($con,$sqletapas);
	$fila = odbc_fetch_array($rsetapas);

	$axcorrelativo = $fila['N_CORRELATIVO']+1;
	$axcorrelativo  =number_pad($axcorrelativo,8); 
	echo number_pad($axcorrelativo,8);

}elseif($axiid_td_guia==''){

	$sqletapas = "SELECT * FROM CORRELATIVOS WHERE ID_LOCAL ='$axid_local' AND ID_TD='$axid_td_cp' and COD_CORR='$axserie' ORDER BY ID_TD ASC" ;	
//	echo 'FACTURA - '.$sqletapas.'<br>';	

	$rsetapas=odbc_exec($con,$sqletapas);
	$fila = odbc_fetch_array($rsetapas);

	$axcorrelativo = $fila['N_CORRELATIVO']+1;
	$axcorrelativo_1  =number_pad($axcorrelativo,8); 
	//

	$sqlverifica = "SELECT * FROM MAESTRO_CZ WHERE ID_LOCAL='$axid_local' AND TXT_SERIE='$axn_serie' AND DOCUMENTO='$axcorrelativo_1'";
	$RSVerifica = odbc_exec($con,$sqlverifica);
	//echo $sqlverifica.'<br>';	

	if(odbc_num_rows($RSVerifica) > 0){

		$respuesta = 0;
		echo trim($respuesta);

	}else{

		echo number_pad($axcorrelativo,8);

	}

}

      



break;

case '74':

$axcodusuario = $_POST['txtcodusuario'];
$axid_local = $_POST['txtid_local'];
$axnum_pedido = $_POST['txtnum_pedido'];
$axid_td_cp = $_POST['txtid_td_cp'];
	
$axdni_user = get_row('usuarios','COD_USUARIO','ID_USUARIO',$axcodusuario);
$logitudPass = 10;
$axcod = substr($axdni_user,0,3);
$nuevo_nombre_a = substr(md5(microtime()),1,$logitudPass);
$nuevo_nombre = $axid_local.$axcod.$nuevo_nombre_a;
$axcodmovcz = $nuevo_nombre;
echo trim($axcodmovcz);



break;

case '75':

date_default_timezone_set("America/Lima");

$axforma_pago_1 = $_POST['txtforma_pago'];
$axestado_forma_pago_1 = $_POST['txtestado_forma_pago'];
$axmedio_pago_1 = $_POST['txtmedio_pago'];
$axid_cta_1 = $_POST['txtid_cta'];
$axnum_transf_1 = $_POST['txtnum_transf'];
$axfecha_transf_1 = $_POST['txtfecha_transf'];
$axnum_pedido = $_POST['txtnum_pedido'];
$axid_local = $_POST['txtid_local'];
$axnum_pedido_parcial = $_POST['txtnum_pedido_parcial'];

if($axid_local==''){
	$axid_local = get_row('PEDIDOS','ID_LOCAL','NUM_PEDIDO',$axnum_pedido);
}else{
	$axid_local = $_POST['txtid_local'];
}

$axcod_mov_cz = trim($_POST['txtcod_mov_cz']);
$axtipo_mov ='INGRESO';
$axdetalle_movimiento ='VENTA';
$axfecha_emision = $_POST['txtfecha_emision'];
$axperiodo_emision = date('m-Y',strtotime($axfecha_emision));
$axid_td = $_POST['txtid_td_cp'];
$axid_serie = $_POST['txt_serie'];
$axtxt_serie  = get_row('CORRELATIVOS','N_SERIE','COD_CORR',$axid_serie);
$axdocumento = $_POST['txtdocumento'];

$axfecha_registro = date('Y-m-d');
$axmotivo_devolucion ='0';
$axhora_emision = date('H:i:s');
$axano= date('Y',strtotime($axfecha_emision));

$axglosa = 'VENTA DE MERCADERIA';
$axestado_electro ='PENDIENTE';
$axperiodo_contable= date('m-Y',strtotime($axfecha_emision));

$axfecha_referencia= $axfecha_emision;
$axtxt_descr_mtvo_baja ='0';
$axtxt_serie_ref = '0';
$axtxt_correlativo_cpe_ref= '00000000';
$axfec_emis_ref = $axfecha_emision;
$axtxt_sustento= '0';
$axcod_tip_nc_nd_ref='01';

$axfecha_contable= $axfecha_emision;
$axestado_final='PENDIENTE';
$axcod_cpe_ref='0';
$axestado_enviado_itc='PENDIENTE';

$axcod_tip_frpago='1';
$axmnto_crdt_ttal='0';
$axmnto_crdt_cta='0';
//$axfch_cta
$axestado_envio_cliente='PENDIENTE';
//$axarchivo_pdf

if($axnum_pedido_parcial==''){
	$SQLPedidos_cz = "SELECT * FROM PEDIDOS_CZ_1 WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
}else{
	$SQLPedidos_cz = "SELECT * FROM PEDIDOS_CZ_PARCIAL WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
}


$RSpedidos_cz = odbc_exec($con,$SQLPedidos_cz);

//echo $SQLPedidos_cz.'<br>';

while ($fila_pedidos = odbc_fetch_array($RSpedidos_cz)) {
	
	$axid_beneficiario  =$fila_pedidos['ID_BENEFICIARIO'];
	$axid_usuario  =$fila_pedidos['ID_USUARIO'];
	$axtotal_venta =$fila_pedidos['TOTAL_SALIDA'];
	$axvalor_venta =$fila_pedidos['VALOR_VENTA'];
	$axigv =$fila_pedidos['IGV'];
	$axgravadas =$fila_pedidos['GRAVADAS'];
	$axinafectas =$fila_pedidos['INAFECTAS'];
	$axexoneradas =$fila_pedidos['EXONERADAS'];

	$axmoneda ='SOLES';
	$axmnt_tot_gravadas =$fila_pedidos['GRAVADAS'];
	$axmnt_tot_inafectas =$fila_pedidos['INAFECTAS'];
	$axmnt_tot_exoneradas =$fila_pedidos['EXONERADAS'];
	$axmnt_tot_gratuitas =0;
	$axmnt_tot =$fila_pedidos['TOTAL_SALIDA'];

$SQLInsert =  "INSERT INTO MAESTRO_CZ (COD_MOV,TIPO_MOV,DETALLE_MOVIMIENTO,FECHA_EMISION,PERIODO_EMISION,ID_TD,TXT_SERIE,DOCUMENTO,ID_BENEFICIARIO,ID_USUARIO,TOTAL_VENTA,FECHA_REGISTRO,MOTIVO_DEVOLUCION,HORA_EMISION,ANO,ID_LOCAL,GLOSA,VALOR_VENTA,IGV,GRAVADAS,INAFECTAS,EXONERADAS,PERIODO_CONTABLE,MONEDA,MNT_TOT_GRAVADAS,MNT_TOT_INAFECTAS,MNT_TOT_EXONERADAS,MNT_TOT_GRATUITAS,MNT_TOT,ESTADO_ELECTRO,FECHA_REFERENCIA,TXT_DESCR_MTVO_BAJA,txt_serie_ref,txt_correlativo_cpe_ref,fec_emis_ref,txt_sustento,cod_tip_nc_nd_ref,FECHA_CONTABLE,ESTADO_FINAL,COD_CPE_REF,ESTADO_ENVIADO_ITC,COD_TIP_FRPAGO,MNTO_CRDT_TTAL,MNTO_CRDT_CTA,ESTADO_ENVIO_CLIENTE,NUM_PEDIDO,COD_GUIA_CZ,ESTADO_INVENTARIO) VALUES ('$axcod_mov_cz','$axtipo_mov','$axdetalle_movimiento','$axfecha_emision','$axperiodo_emision','$axid_td','$axtxt_serie','$axdocumento','$axid_beneficiario','$axid_usuario','$axtotal_venta','$axfecha_registro','$axmotivo_devolucion','$axhora_emision','$axano','$axid_local','$axglosa','$axvalor_venta','$axigv','$axgravadas','$axinafectas','$axexoneradas','$axperiodo_contable','$axmoneda','$axmnt_tot_gravadas','$axmnt_tot_inafectas','$axmnt_tot_exoneradas','$axmnt_tot_gratuitas','$axmnt_tot','$axestado_electro','$axfecha_referencia','$axtxt_descr_mtvo_baja','$axtxt_serie_ref','$axtxt_correlativo_cpe_ref','$axfec_emis_ref','$axtxt_sustento','$axcod_tip_nc_nd_ref','$axfecha_contable','$axestado_final','$axcod_cpe_ref','$axestado_enviado_itc','$axcod_tip_frpago','$axmnto_crdt_ttal','$axmnto_crdt_cta','$axestado_envio_cliente','$axnum_pedido','','INVENTARIO')";

//echo $SQLInsert;
$RSInsert = odbc_exec($con,$SQLInsert);

	if($RSInsert){

			if($axnum_pedido_parcial==''){

				$SQLPedidos_dt = "SELECT * FROM PEDIDOS_DT WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
				
			}else{

				$SQLActualizar_parcial = "UPDATE PEDIDOS_PARCIAL SET COD_MOV='$axcod_mov_cz' WHERE NUM_PEDIDO='$axnum_pedido_parcial'";
				$RSActualizar_parcial = odbc_exec($con,$SQLActualizar_parcial); //actualizo y marco el PEDIDO PARCIAL, para que en la siguiente no te permit hacerle factura

				$SQLPedidos_dt = "SELECT * FROM PEDIDOS_DT_PARCIAL WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
			}
			
			$RSpedidos_dt = odbc_exec($con,$SQLPedidos_dt);

			//echo $SQLPedidos;

			while ($fila_pedidos_dt = odbc_fetch_array($RSpedidos_dt)) {

			$it = $it+1;
			$axid_producto = $fila_pedidos_dt['ID_PRODUCTO'];
			$axcant_ingreso = 0;
			$axcosto_producto = $fila_pedidos_dt['COSTO_PRODUCTO'];
			$axdsctos_ingreso = 0;
			$axvalor_ingreso = 0;
			$axigv_ingreso = 0;
			$axgravadas_ingreso = 0;
			$axinafecto_ingresos = 0;
			$axexonerado_ingreso = 0;
			$axtotal_ingreso = 0;
			$axcant_salida = $fila_pedidos_dt['CANT_SALIDA'];
			$axprs_mayor = $fila_pedidos_dt['PRS_MAYOR'];
			$axprs_premiun = $fila_pedidos_dt['PRS_PREMIUN'];
			$axprs_menor = $fila_pedidos_dt['PRS_MENOR'];
			$axprs_venta = $fila_pedidos_dt['PRS_VENTA'];
			$axdsctos_salida = $fila_pedidos_dt['DSCTOS_SALIDA'];
			$axvalor_salida = $fila_pedidos_dt['VALOR_SALIDA'];
			$axigv_salida = $fila_pedidos_dt['IGV_SALIDA'];
			$axgravadas_salida = $fila_pedidos_dt['GRAVADAS_SALIDA'];
			$axinafecto_salida = $fila_pedidos_dt['INAFECTO_SALIDA'];
			$axexonerado_salida = $fila_pedidos_dt['EXONERADO_SALIDA'];
			$axtotal_salida = $fila_pedidos_dt['TOTAL_SALIDA'];
			$axcant_padre = $fila_pedidos_dt['CANT_PADRE'];

			$axforma_pago = $axforma_pago_1;
			$axestado_forma_pago = $axestado_forma_pago_1;
			$axmedio_pago = $axmedio_pago_1;
			$axnum_transf = $axnum_transf_1;
			$axpor_detraccion = 0;
			$axmonto_detraccion = 0;
			$axnum_detraccion = 0;
			$axfecha_detraccion =$axfecha_emision;
			$axestado_producto = 'BUENO';
			$axobservar = '0';

			$axfecha_transf = $axfecha_transf_1;
			$axid_cta = $axid_cta_1;
			$axperiodo_transf = date('m-Y',strtotime($axfecha_transf));
			$axnum_lin_item = $it;

			$SQLInsert_dt = "INSERT INTO MAESTRO_DT (COD_MOV,ID_PRODUCTO,CANT_INGRESO,COSTO_PRODUCTO,DSCTOS_INGRESO,VALOR_INGRESO,IGV_INGRESO,GRAVADAS_INGRESO,INAFECTO_INGRESOS,EXONERADO_INGRESO,TOTAL_INGRESO,CANT_SALIDA,PRS_MAYOR,PRS_PREMIUN,PRS_MENOR,PRS_VENTA,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,FORMA_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,NUM_TRANSF,POR_DETRACCION,MONTO_DETRACCION,NUM_DETRACCION,FECHA_DETRACCION,ESTADO_PRODUCTO,OBSERVAR,FECHA_TRANSF,ID_CTA,PERIODO_TRANSF,NUM_LIN_ITEM,CANT_PADRE) VALUES ('$axcod_mov_cz','$axid_producto','$axcant_ingreso','$axcosto_producto','$axdsctos_ingreso','$axvalor_ingreso','$axigv_ingreso','$axgravadas_ingreso','$axinafecto_ingresos','$axexonerado_ingreso','$axtotal_ingreso','$axcant_salida','$axprs_mayor','$axprs_premiun','$axprs_menor','$axprs_venta','$axdsctos_salida','$axvalor_salida','$axigv_salida','$axgravadas_salida','$axinafecto_salida','$axexonerado_salida','$axtotal_salida','$axforma_pago','$axestado_forma_pago','$axmedio_pago','$axnum_transf','$axpor_detraccion','$axmonto_detraccion','$axnum_detraccion','$axfecha_detraccion','$axestado_producto','$axobservar','$axfecha_transf','$axid_cta','$axperiodo_transf','$axnum_lin_item','$axcant_padre')";
				
				$RSInsert_dt =odbc_exec($con,$SQLInsert_dt);

			}

			$SQLActualizar_correlativo = "UPDATE CORRELATIVOS SET N_CORRELATIVO='$axdocumento' WHERE ID_LOCAL='$axid_local' AND COD_CORR='$axid_serie'";
			$RSActualizar_correlativo = odbc_exec($con,$SQLActualizar_correlativo);

			$SQLPedidos = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='PROGRAMADO',ESTADO_REVISION='CERRADO' WHERE ID_LOCAL='$axid_local' AND NUM_PEDIDO='$axnum_pedido'";
			$RSpedidos = odbc_exec($con,$SQLPedidos);
			//echo $SQLPedidos;

				$respuesta = 0;
				echo $respuesta; //SE GRABO LA CABECERA Y EL DETALLE DE LA FACTURA O BELTA


	}else{

				$respuesta = 1;
				echo $respuesta; //NO GRABO LA CABECERA DE LA FACTURA O BELTA

	}


}


break;

case '76':
	

$axbuscaregistro = $_POST['txtbuscar_ventas_programadas']; 	
$axid_empresa = $_POST['txtid_empresa']; 	
$axid_local = $_POST['txtid_local']; 	
$axfecha_actual = $_POST['txtfecha_actual']; 	
$axfiltro_fechas = $_POST['txtfiltro_fechas']; 	
$axnum_despacho = $_POST['txtnum_despacho']; 	
$axestado_atendido = $_POST['txtestado_atendido']; 	
$axtipo_busqueda = $_POST['txttipo_busqueda']; 	

if($axtipo_busqueda=='FECHAS'){ //SEGUN FECHAS

	$SQLBuscar = "SELECT TOP 30 * FROM MAESTRO_CZ_PROGRAMADOS WHERE ID_LOCAL = '$axid_local' AND FECHA_EMISION='$axfecha_actual' ORDER BY FECHA_EMISION DESC";

}elseif($axtipo_busqueda=='CLIENTE'){ //busqueda  por cliente

	$SQLBuscar ="SELECT * FROM MAESTRO_CZ_PROGRAMADOS WHERE ID_EMPRESA = '$axid_empresa' AND NOM_COMERCIAL like '%".$axbuscaregistro."%' ORDER BY FECHA_EMISION DESC";

}elseif($axtipo_busqueda=='NUM DESPACHO'){ //busqueda por NUMERO DESPACHO

	$SQLBuscar = "SELECT * FROM MAESTRO_CZ_PROGRAMADOS WHERE NUM_DESPACHO='$axnum_despacho' ORDER BY ID_LOCAL,FECHA_EMISION,DOCUMENTO DESC";

}elseif($axtipo_busqueda=='COMPROBANTE'){ //MUESTRA TODOS LOS COMPROBANTES Y NOTAS DE SALIDA
	
	$SQLBuscar = "SELECT * FROM MAESTRO_CZ_PROGRAMADOS WHERE ID_LOCAL = '$axid_local' AND COMPROBANTE like '%".$axbuscaregistro."%'  ORDER BY DOCUMENTO DESC";

}elseif($axtipo_busqueda=='PEDIDO'){ //MUESTRA SEGUN NUM PEDIDOS

	$SQLBuscar = "SELECT * FROM MAESTRO_CZ_PROGRAMADOS WHERE ID_LOCAL = '$axid_local' AND NUM_PEDIDO like '%".$axbuscaregistro."%' ORDER BY ID_LOCAL,NUM_PEDIDO DESC";			
	

}elseif($axtipo_busqueda=='GUIA DE REMISION'){ //MUESTRA SEGUN NUM PEDIDOS

	$SQLBuscar = "SELECT * FROM MAESTRO_CZ_PROGRAMADOS WHERE ID_LOCAL = '$axid_local' AND txt_correlativo like '%".$axbuscaregistro."%' ORDER BY ID_LOCAL,txt_correlativo DESC";			

	


}

//echo "$SQLBuscar";

	echo "
		<div id='div3'>
		<table class='table table-hover'>
		<thead class='table-primary'>			
		<tr>
			<th scope='col' style='text-align:center'>Item</th>			
			<th scope='col' style='text-align:center'>Almacen</th>
			<th scope='col' style='text-align:left'>Num. Comprobante</th>
			<th scope='col' style='text-align:left'>Nombre Cliente</th>					
			<th scope='col' style='text-align:left'>Estado Atención</th>
			<th scope='col' style='text-align:right'>Monto</th>
			<th scope='col'>Acción</th>
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);	
	
	if ($RSBuscar){
 	
 	while ($row=odbc_fetch_array($RSBuscar)){ 

 		$it = $it+1;
 		$axcod_mov= $row["COD_MOV"];
 		$axnum_pedido= $row["NUM_PEDIDO"];
 		$axfecha_despacho =get_row('PEDIDOS','FECHA_DESPACHO','NUM_PEDIDO',$axnum_pedido);
 		$axid_local= $row["ID_LOCAL"];
 		$axid_td=$row['ID_TD'];
 		$axfecha_emision = date('d-m-Y', strtotime($row["FECHA_EMISION"]));
 		$axcomprobante = $row["COMPROBANTE"];
 		$axnom_cliente = utf8_encode($row["RAZON_SOCIAL"]);
 		$axtotal_venta =number_format($row["TOTAL_VENTA"],2,".",","); 
 		$axestado_electro = $row["ESTADO_ELECTRO"];
 		$axestado_enviado = $row["ESTADO_ENVIADO_ITC"];
 		$axestado_atendido = $row["ESTADO_ATENDIDO"];
 		$axverif_guia = $row["COD_GUIA_CZ"];
 		$axnum_guia = get_row('GUIA_REMISION_CZ','txt_serie','COD_GUIA_CZ',$axverif_guia).'-'.get_row('GUIA_REMISION_CZ','txt_correlativo','COD_GUIA_CZ',$axverif_guia);;
 		$axtipodoc = get_row('TIPO_DOCUMENTOS','DETALLE_DOC','ID_TD',$axid_td);
 		$axdireccion_entrega =$row["DIRECCION_ENTREGA"];
 		$axid_vehiculo=$row["ID_VEHICULO"];
 		$axnum_despacho=$row["NUM_DESPACHO"];
 		$axlocal_corto = get_row('LOCALES','LOCAL_CORTO','ID_LOCAL',$axid_local);
 		$axid_usuario=$row["ID_USUARIO"];
 		$axfecha_hora_entrega = date('d-m-Y', strtotime($row["FECHA_EMISION"]));
 		$axhora_entrega = $row["HORA_ENTREGA"];
 		$axid_agencia = get_row('PEDIDOS_CZ','ID_AGENCIA','NUM_PEDIDO',$axnum_pedido);

 		$axpagos = get_row('CTA_COBRAR_PAGOS_REPORTE','NUM_PEDIDO','NUM_PEDIDO',$axnum_pedido);

		$axpedido =  get_row('MAESTRO_CZ','NUM_PEDIDO','COD_MOV',$axcod_mov);		
 		$axnom_vehiculo =$axnum_despacho.' | '.get_row('VEHICULOS_DESPACHOS','MARCA_VEHICULO','ID_VEHICULO',$axid_vehiculo).'-'.get_row('VEHICULOS_DESPACHOS','NUM_PLACA','ID_VEHICULO',$axid_vehiculo);

 		
 		$axultima_guia =get_row('GUIA_REMISION_CZ','txt_correlativo','ID_LOCAL',$axid_local,$axnum_serie);

 		//echo 'GUIA: '.$axultima_guia;


 	echo "
 		<tr> 		
 			<td  scope='col' style='text-align:center'>$it</td>
 			<td scope='col' style='text-align:center'>$axlocal_corto</td>";		

			if($axverif_guia==''){

				echo "<td scope='col' style='text-align:left'>".$axfecha_emision."<br><b style='color:#BEBFC0;'>".$axnum_pedido."</b><br><b>".$axcomprobante."</b></td>";
			}else{
				echo "<td scope='col' style='text-align:left'>".$axfecha_emision."<br><b style='color:#BEBFC0;'>".$axnum_pedido."</b><br><b>".$axcomprobante.'</b><br> <b style="color:#BEBFC0;">'.$axnum_guia.'</b>'."</td>";
			}

	

			if($axestado_electro=='PENDIENTE'){

				if($axtipodoc=='NOTA SALIDA'){
						echo "<td scope='col' style='text-align:left'>$axnom_cliente<br>$axdireccion_entrega<br><b class='text-danger' >$axestado_electro - $axestado_enviado</b> </td>";							
				}else{

					echo "<td scope='col' style='text-align:left'>$axnom_cliente<br>$axdireccion_entrega<br><b><a href='#' class='text-danger'style='text-decoration:none;' title='El comprobante no ha sido enviado a SUNAT, comunique con el PROGRAMADOR para verificar por que no se envio y volver enviarlo haciendo clik aqui...' id='btn_procesar_comprobante' data-id='$axcod_mov' data-local='$axid_local' >$axestado_electro - $axestado_enviado</a></b> </td>";	

					//echo "<td scope='col' style='text-align:left'>$axnom_cliente<br>$axdireccion_entrega<br><b><a href='#' class='text-danger'style='text-decoration:none;' id='btn_procesar_comprobante' >$axestado_electro - $axestado_enviado </a></b> </td>";	

					
				}
					
			}else if($axestado_electro=='PROCESADA'){
				echo "<td scope='col' style='text-align:left'>$axnom_cliente<br>$axdireccion_entrega<br><b class='text-primary'>$axestado_electro - $axestado_enviado</b> </td>";				
			
			}else if($axestado_electro=='RECHAZADA'){
				
				echo "<td scope='col' style='text-align:left'>$axnom_cliente<br>$axdireccion_entrega<br><b class='text-danger'>$axestado_electro </b>-<b class='text-primary'> $axestado_enviado</b> </td>";				

			}else if($axestado_electro=='ANULADA'){
				echo "<td scope='col' style='text-align:left'>$axnom_cliente<br>$axdireccion_entrega<br><b class='text-danger'>$axestado_electro - $axestado_enviado</b> </td>";				
			}

			if($axestado_atendido=='PROGRAMADO'){
				$axatendido = $axfecha_hora_entrega.'<br>'.$axnom_vehiculo;
				echo "<td scope='col' style='text-align:left'>$axatendido<br><b class='text-primary'>$axestado_atendido</b></td>";

			}elseif($axestado_atendido=='ATENDIDO'){
				$axatendido = $axfecha_hora_entrega.' - '.$axhora_entrega.'<br>'.$axnom_vehiculo;
				echo "<td scope='col' style='text-align:left'>$axatendido<br><b class='text-success'>$axestado_atendido</b></td>";
			}elseif($axestado_atendido=='PENDIENTE'){
				$axatendido = $axfecha_hora_entrega;
				echo "<td scope='col' style='text-align:left'>$axatendido<br><b class='text-danger'>$axestado_electro</b></td>";
			}else{
				$axatendido = $axfecha_hora_entrega;
				echo "<td scope='col' style='text-align:left'>$axatendido<br><b class='text-danger'>$axestado_electro</b></td>";

			}
 			
 		echo "
 			

 			<td scope='col' style='text-align:right'>$axtotal_venta</td>
 			
 			<td style='text-align: center;'>			

 				<div class='btn-group dropstart'>

				  <button class='btn btn-outline-primary btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>

				  <ul class='dropdown-menu'>
				  	<li><hr class='dropdown-divider'></li>
				  	<li><a class='dropdown-item' href='#'data-id='$axcod_mov' data-local='$axid_local' id='btn_legajo_imprimir' title='Permite imprimir Comprobante, Guia remision y Pedido...'><i class='bi bi-file-earmark-pdf-fill' style='color:green;'></i> Legajo</a></li>
				  	<li><hr class='dropdown-divider'></li>
				    <li><a class='dropdown-item' href='#'data-id='$axcod_mov' data-local='$axid_local' id='btn_comprobante_imprimir' title='Permite imprimir el comprobante...'><i class='bi bi-file-earmark-pdf-fill' style='color:red;'></i> Comprobante</a></li>";

				    if($axverif_guia==''){
				    	if($axtipodoc=='NOTA SALIDA'){
				    		
				    	}else{

				    		if($axestado_electro=='PROCESADA'){
				    			
				    		echo "<li><a class='dropdown-item' href='#' data-local='$axid_local' data-id='$axcod_mov' data-npedido='$axnum_pedido' data-fdespacho='$axfecha_despacho' data-guia='$axverif_guia' id='btn_guia_remision_emitir' data-ultima='$axultima_guia' title='Generar la Guia Remisión del Comprobante..' data-bs-toggle='modal' data-bs-target='#modal_guias_numeros'><i class='bi bi-file-earmark-pdf-fill' style='color:green;'></i> Guía Remisión</a></li>";	
				    		}

				    		

				    	}
				    	

				    }else{

				    	echo "<li><a class='dropdown-item' href='#' data-guia='$axverif_guia' id='btn_guia_remision_pdf' title='Imprime la Guia Remisión del Comprobante...'><i class='bi bi-file-earmark-pdf-fill' style='color:red;'></i> Guía Remisión</a></li>";
				    
				    
				    
				    }

				   echo "
				    
				    <li><a class='dropdown-item' href='#'data-npedido='$axnum_pedido' data-local='$axid_local' data-user='$axid_usuario' id='btn_pedidos_imprimir' title='Imprime el Pedido del Comprobante...' ><i class='bi bi-file-earmark-pdf-fill'style='color:red;'></i> Pedidos</a></li>
				    <li><hr class='dropdown-divider'></li>";

				  if($axestado_electro=='PENDIENTE'){
				  	echo "<li>
				  		<a class='dropdown-item' href='#' data-id='$axcod_mov' data-pagos='$axpagos' title='Elimina la NOTA SALIDA y el pedido pasa a estado REVISION sin GUIA DE REMISION' data-npedido='$axnum_pedido' id='btn_eliminar_ns_comprobantes_pendientes'><i class='bi bi-arrow-clockwise'></i> Revertir</a>
				  		</li>";

				  			
				  }

				  if($axestado_electro=='PROCESADA'){
				  	
				  	echo "
				    <li><a class='dropdown-item' href='#'data-codmov='$axcod_mov' data-guia='$axverif_guia' data-pagos='$axpagos' data-pedido='$axpedido' data-estadoelectro_f='$axestado_electro' data-fecha='$axfecha_emision_comp' id='btn_anular_comprobante' data-bs-toggle='modal' data-bs-target='#exampleModal_anular' title='El comprobante se ANULA EN LA WEB E ITC, EL Pedido pasa a estado PENDIENTE a la espera de ser PROGRAMADO y si tiene GUIA REMISION esta se pierde y hay que ANULAR en SUNAT, Si el PEDIDO es PARCIAL se deberá REVERTIR LA PARCIALIDAD en Prog. Despachos'><i class='bi bi-x-circle-fill'></i> Anular Factura (web y sunat) </a></li>

				    <li><a class='dropdown-item' href='#'data-codmov='$axcod_mov' data-guia='$axverif_guia' data-pagos='$axpagos' data-estadoelectro_f='$axestado_electro' data-fecha='$axfecha_emision_comp' id='btn_rechazar_comprobante' title='El pedido pasa a estado REVISION, EL COMPROBANTE pasa a estado RECHAZADA y la GUIA REMISION se deberá ANULAR en la SUNAT...' ><i class='bi bi-x-circle-fill'></i> Rechazar Comprobante Web </a></li>				    

				    <li><a class='dropdown-item text-danger' href='#'data-codmov='$axcod_mov' data-pagos='$axpagos' data-guia='$axverif_guia' data-pedido='$axpedido' data-estadoelectro_f='$axestado_electro' data-fecha='$axfecha_emision_comp' id='btn_eliminar_comprobante' title='Para eliminar el COMPROBANTE este no debe estar en SUNAT, EL PEDIDO pasa a estado REVISION, se elimina el COMPROBANTE Y la GUIA REMISION hay que ANULAR EN SUNAT' ><i class='bi bi-trash-fill'></i></i> Eliminar Comprobante web</a></li>
				     <li><hr class='dropdown-divider'></li>
				    ";
				    
				  }

				  if($axtipodoc=='NOTA SALIDA'){

				  	if($axverif_guia !==''){
				    	echo "<li><a class='dropdown-item' href='#'data-codmov='$axcod_mov' data-guia='$axverif_guia' data-pagos='$axpagos' data-estadoelectro_f='$axestado_electro' data-fecha='$axfecha_emision_comp' id='btn_rechazar_guia_ns' Title='El comprobante queda sin GUIA REMISION y la GUIA REMISION queda estado RECHAZADO en la WEB y SUNAT' ><i class='bi bi-x-circle-fill'></i> Rechazar Guía Web</a></li>";
				    }

				  }else{

				  	if($axverif_guia !==''){
				    	echo "<li><a class='dropdown-item' href='#'data-codmov='$axcod_mov' data-guia='$axverif_guia' data-estadoelectro_f='$axestado_electro' data-fecha='$axfecha_emision_comp' id='btn_rechazar_guia' title='LA GUIA REMISION CAMBIA ESTADO RECHAZAADA EN LA WEB Y SUNAT, EL COMPROBANTE QUEDA SIN GUIA REMISION' ><i class='bi bi-x-circle-fill'></i> Rechazar Guía Web </a></li>";
				    }	
				  }

				  if($axestado_atendido=='PROGRAMADO'){
				  	if($axestado_electro=='PROCESADA'){
				  		echo "<li><a class='dropdown-item text-danger' title='Elimina el despacho y mantiene FACTURA Y GUIA_REMISION' href='#'data-npedido='$axnum_pedido'  id='btn_reprogramar' ><b><i class='bi bi-arrow-bar-left'></i> Reprogramar despacho</b></a></li>";	
				  	}
				  	
				  }
				  
				  echo "<li><a class='dropdown-item' href='#'data-codmov='$axcod_mov' title='Se desvincula la guia del COMPROBANTE y PEDIDO, debe anularse en SUNAT' data-guia='$axverif_guia' data-estadoelectro_f='$axestado_electro' data-fecha='$axfecha_emision_comp' id='btn_anular_guia' ><i class='bi bi-x-circle-fill'></i> Anular Guía Web </a></li>";

			    echo "		    
				    <li><hr class='dropdown-divider'></li>
				     <li>
				     <a class='dropdown-item' href='#'data-npedido='$axnum_pedido' data-local='$axid_local' data-user='$axid_usuario' data-agencia='$axid_agencia' id='btn_editar_pedido_programado'>
				     	<i class='bi bi-folder2-open'style='color:green;'></i> Editar Pedido Programado</a>
				     </li>
				    <li><hr class='dropdown-divider'></li>";

				  echo "
				  </ul>
				</div>



 			</td>



 		</tr>
 	";

}
echo "</table>
</div>";
}



break;


case '76-ANTES':

$axbuscaregistro = $_POST['txtbuscar_ventas_programadas']; 	
$axid_empresa = $_POST['txtid_empresa']; 	
$axid_local = $_POST['txtid_local']; 	
$axfecha_actual = $_POST['txtfecha_actual']; 	
$axfiltro_fechas = $_POST['txtfiltro_fechas']; 	
$axnum_despacho = $_POST['txtnum_despacho']; 	
$axestado_atendido = $_POST['txtestado_atendido']; 	
$axtipo_busqueda = $_POST['txttipo_busqueda']; 	

if($axtipo_busqueda=='FECHAS'){ //SEGUN FECHAS

	$SQLBuscar = "SELECT TOP 30 * FROM MAESTRO_CZ_PROGRAMADOS WHERE ID_LOCAL = '$axid_local' AND FECHA_EMISION='$axfecha_actual' ORDER BY DOCUMENTO DESC";

}elseif($axtipo_busqueda=='CLIENTE'){ //busqueda  por cliente

	$SQLBuscar ="SELECT * FROM MAESTRO_CZ_PROGRAMADOS WHERE ID_EMPRESA = '$axid_empresa' AND NOM_COMERCIAL like '%".$axbuscaregistro."%' ORDER BY DOCUMENTO DESC";

}elseif($axtipo_busqueda=='NUM DESPACHO'){ //busqueda por NUMERO DESPACHO

	$SQLBuscar = "SELECT * FROM MAESTRO_CZ_PROGRAMADOS WHERE NUM_DESPACHO='$axnum_despacho' ORDER BY ID_LOCAL,DOCUMENTO DESC";

}elseif($axtipo_busqueda=='COMPROBANTE'){ //MUESTRA TODOS LOS COMPROBANTES Y NOTAS DE SALIDA
	
	$SQLBuscar = "SELECT * FROM MAESTRO_CZ_PROGRAMADOS WHERE ID_LOCAL = '$axid_local' AND COMPROBANTE like '%".$axbuscaregistro."%'  ORDER BY DOCUMENTO DESC";

}elseif($axtipo_busqueda=='PEDIDO'){ //MUESTRA SEGUN NUM PEDIDOS

	$SQLBuscar = "SELECT * FROM MAESTRO_CZ_PROGRAMADOS WHERE ID_LOCAL = '$axid_local' AND NUM_PEDIDO like '%".$axbuscaregistro."%' ORDER BY ID_LOCAL,NUM_PEDIDO DESC";			
	

}elseif($axtipo_busqueda=='GUIA DE REMISION'){ //MUESTRA SEGUN NUM PEDIDOS

	$SQLBuscar = "SELECT * FROM MAESTRO_CZ_PROGRAMADOS WHERE ID_LOCAL = '$axid_local' AND txt_correlativo like '%".$axbuscaregistro."%' ORDER BY ID_LOCAL,txt_correlativo DESC";			

	


}

//echo "$SQLBuscar";

	echo "
		<div id='div3'>
		<table class='table table-hover'>
		<thead class='table-primary'>			
		<tr>
			<th class='ocultar' scope='col' style='text-align:center'>Item</th>			
			<th scope='col' style='text-align:center'>Almacen</th>
			<th scope='col' style='text-align:left'>Num. Comprobante</th>
			<th scope='col' style='text-align:left'>Nombre Cliente</th>					
			<th scope='col' style='text-align:left'>Estado Atención</th>
			<th scope='col' style='text-align:right'>Monto</th>
			<th scope='col'>Acción</th>
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);	
	
	if ($RSBuscar){
 	
 	while ($row=odbc_fetch_array($RSBuscar)){ 

 		$it = $it+1;
 		$axcod_mov= $row["COD_MOV"];
 		$axnum_pedido= $row["NUM_PEDIDO"];
 		$axfecha_despacho =get_row('PEDIDOS','FECHA_DESPACHO','NUM_PEDIDO',$axnum_pedido);
 		$axid_local= $row["ID_LOCAL"];
 		$axid_td=$row['ID_TD'];
 		$axfecha_emision = date('d-m-Y', strtotime($row["FECHA_EMISION"]));
 		$axcomprobante = $row["COMPROBANTE"];
 		$axnom_cliente = utf8_encode($row["RAZON_SOCIAL"]);
 		$axtotal_venta =number_format($row["TOTAL_VENTA"],2,".",","); 
 		$axestado_electro = $row["ESTADO_ELECTRO"];
 		$axestado_enviado = $row["ESTADO_ENVIADO_ITC"];
 		$axestado_atendido = $row["ESTADO_ATENDIDO"];
 		$axverif_guia = $row["COD_GUIA_CZ"];
 		$axnum_guia = get_row('GUIA_REMISION_CZ','txt_serie','COD_GUIA_CZ',$axverif_guia).'-'.get_row('GUIA_REMISION_CZ','txt_correlativo','COD_GUIA_CZ',$axverif_guia);;
 		$axtipodoc = get_row('TIPO_DOCUMENTOS','DETALLE_DOC','ID_TD',$axid_td);
 		$axdireccion_entrega =$row["DIRECCION_ENTREGA"];
 		$axid_vehiculo=$row["ID_VEHICULO"];
 		$axnum_despacho=$row["NUM_DESPACHO"];
 		$axlocal_corto = get_row('LOCALES','LOCAL_CORTO','ID_LOCAL',$axid_local);
 		$axid_usuario=$row["ID_USUARIO"];
 		$axfecha_hora_entrega = date('d-m-Y', strtotime($row["FECHA_EMISION"]));
 		$axhora_entrega = $row["HORA_ENTREGA"];
 		$axid_agencia = get_row('PEDIDOS_CZ','ID_AGENCIA','NUM_PEDIDO',$axnum_pedido);

		$axpedido =  get_row('MAESTRO_CZ','NUM_PEDIDO','COD_MOV',$axcod_mov);		
 		$axnom_vehiculo =$axnum_despacho.' | '.get_row('VEHICULOS_DESPACHOS','MARCA_VEHICULO','ID_VEHICULO',$axid_vehiculo).'-'.get_row('VEHICULOS_DESPACHOS','NUM_PLACA','ID_VEHICULO',$axid_vehiculo);

 			


 	echo "
 		<tr> 		
 			<td class='ocultar' scope='col' style='text-align:center'>$it</td>
 			<td class='ocultar' scope='col' style='text-align:center'>$axlocal_corto</td>";		

			if($axverif_guia==''){
				echo "<td scope='col' style='text-align:left'>".$axfecha_emision."<br><b style='color:#BEBFC0;'>".$axnum_pedido."</b><br><b>".$axcomprobante."</b></td>";
			}else{
				echo "<td scope='col' style='text-align:left'>".$axfecha_emision."<br><b style='color:#BEBFC0;'>".$axnum_pedido."</b><br><b>".$axcomprobante.'</b><br> <b style="color:#BEBFC0;">'.$axnum_guia.'</b>'."</td>";
			}

	

			if($axestado_electro=='PENDIENTE'){

				if($axtipodoc=='NOTA SALIDA'){
						echo "<td scope='col' style='text-align:left'>$axnom_cliente<br>$axdireccion_entrega<br><b class='text-danger' >$axestado_electro - $axestado_enviado</b> </td>";							
				}else{
					echo "<td scope='col' style='text-align:left'>$axnom_cliente<br>$axdireccion_entrega<br><b><a href='#' class='text-danger'style='text-decoration:none;' id='btn_procesar_comprobante' >$axestado_electro - $axestado_enviado</a></b> </td>";	

					
				}
					
			}else if($axestado_electro=='PROCESADA'){
				echo "<td scope='col' style='text-align:left'>$axnom_cliente<br>$axdireccion_entrega<br><b class='text-primary'>$axestado_electro - $axestado_enviado</b> </td>";				
			
			}else if($axestado_electro=='RECHAZADA'){
				
				echo "<td scope='col' style='text-align:left'>$axnom_cliente<br>$axdireccion_entrega<br><b class='text-danger'>$axestado_electro </b>-<b class='text-primary'> $axestado_enviado</b> </td>";				

			}else if($axestado_electro=='ANULADA'){
				echo "<td scope='col' style='text-align:left'>$axnom_cliente<br>$axdireccion_entrega<br><b class='text-danger'>$axestado_electro - $axestado_enviado</b> </td>";				
			}

			if($axestado_atendido=='PROGRAMADO'){
				$axatendido = $axfecha_hora_entrega.'<br>'.$axnom_vehiculo;
				echo "<td scope='col' style='text-align:left'>$axatendido<br><b class='text-primary'>$axestado_atendido</b></td>";

			}elseif($axestado_atendido=='ATENDIDO'){
				$axatendido = $axfecha_hora_entrega.' - '.$axhora_entrega.'<br>'.$axnom_vehiculo;
				echo "<td scope='col' style='text-align:left'>$axatendido<br><b class='text-success'>$axestado_atendido</b></td>";
			}elseif($axestado_atendido=='PENDIENTE'){
				$axatendido = $axfecha_hora_entrega;
				echo "<td scope='col' style='text-align:left'>$axatendido<br><b class='text-danger'>$axestado_electro</b></td>";
			}else{
				$axatendido = $axfecha_hora_entrega;
				echo "<td scope='col' style='text-align:left'>$axatendido<br><b class='text-danger'>$axestado_electro</b></td>";

			}
 			
 		echo "
 			

 			<td scope='col' style='text-align:right'>$axtotal_venta</td>
 			
 			<td style='text-align: center;'>			

 				<div class='btn-group dropstart'>

				  <button class='btn btn-outline-primary btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>

				  <ul class='dropdown-menu'>
				  	<li><hr class='dropdown-divider'></li>
				  	<li><a class='dropdown-item' href='#'data-id='$axcod_mov' data-local='$axid_local' id='btn_legajo_imprimir'><i class='bi bi-file-earmark-pdf-fill' style='color:green;'></i> Legajo</a></li>
				  	<li><hr class='dropdown-divider'></li>
				    <li><a class='dropdown-item' href='#'data-id='$axcod_mov' data-local='$axid_local' id='btn_comprobante_imprimir'><i class='bi bi-file-earmark-pdf-fill' style='color:red;'></i> Comprobante</a></li>";

				    if($axverif_guia==''){
				    	if($axtipodoc=='NOTA SALIDA'){
				    		
				    	}else{

				    		if($axestado_electro=='PROCESADA'){
				    		echo "<li><a class='dropdown-item' href='#' data-local='$axid_local' data-id='$axcod_mov' data-npedido='$axnum_pedido' data-fdespacho='$axfecha_despacho' data-guia='$axverif_guia' id='btn_guia_remision_emitir' data-bs-toggle='modal' data-bs-target='#modal_guias_numeros'><i class='bi bi-file-earmark-pdf-fill' style='color:green;'></i> Guía Remisión</a></li>";	
				    		}

				    		

				    	}
				    	

				    }else{
				    	echo "<li><a class='dropdown-item' href='#' data-guia='$axverif_guia' id='btn_guia_remision_pdf' ><i class='bi bi-file-earmark-pdf-fill' style='color:red;'></i> Guía Remisión</a></li>";
				    
				    
				    
				    }

				   echo "
				    
				    <li><a class='dropdown-item' href='#'data-npedido='$axnum_pedido' data-local='$axid_local' data-user='$axid_usuario' id='btn_pedidos_imprimir'><i class='bi bi-file-earmark-pdf-fill'style='color:red;'></i> Pedidos</a></li>
				    <li><hr class='dropdown-divider'></li>";

				  if($axestado_electro=='PENDIENTE'){
				  	echo "<li>
				  		<a class='dropdown-item' href='#' data-id='$axcod_mov' data-npedido='$axnum_pedido' id='btn_eliminar_ns_comprobantes_pendientes'><i class='bi bi-arrow-clockwise'></i> Revertir</a>
				  		</li>";

				  			
				  }

				  if($axestado_electro=='PROCESADA'){
				  	
				  	echo "
				    <li><a class='dropdown-item' href='#'data-codmov='$axcod_mov' data-guia='$axverif_guia' data-pedido='$axpedido' data-estadoelectro_f='$axestado_electro' data-fecha='$axfecha_emision_comp' id='btn_anular_comprobante' data-bs-toggle='modal' data-bs-target='#exampleModal_anular'><i class='bi bi-x-circle-fill'></i> Anular </a></li>

				    <li><a class='dropdown-item' href='#'data-codmov='$axcod_mov' data-guia='$axverif_guia' data-estadoelectro_f='$axestado_electro' data-fecha='$axfecha_emision_comp' id='btn_rechazar_comprobante' ><i class='bi bi-x-circle-fill'></i> Rechazada </a></li>				    

				    <li><a class='dropdown-item text-danger' href='#'data-codmov='$axcod_mov' data-guia='$axverif_guia' data-pedido='$axpedido' data-estadoelectro_f='$axestado_electro' data-fecha='$axfecha_emision_comp' id='btn_eliminar_comprobante' ><i class='bi bi-trash-fill'></i></i> Eliminar Comprobante</a></li>

				    ";
				    
				  }

				  if($axtipodoc=='NOTA SALIDA'){

				  	if($axverif_guia !==''){
				    	echo "<li><a class='dropdown-item' href='#'data-codmov='$axcod_mov' data-guia='$axverif_guia' data-estadoelectro_f='$axestado_electro' data-fecha='$axfecha_emision_comp' id='btn_rechazar_guia_ns' ><i class='bi bi-x-circle-fill'></i> Rechazar Guía </a></li>";
				    }

				  }else{

				  	if($axverif_guia !==''){
				    	echo "<li><a class='dropdown-item' href='#'data-codmov='$axcod_mov' data-guia='$axverif_guia' data-estadoelectro_f='$axestado_electro' data-fecha='$axfecha_emision_comp' id='btn_rechazar_guia' title='LA GUIA REMISION CAMBIA ESTADO RECHAZAADA EN LA WEB Y SUNAT, EL COMPROBANTE QUEDA SIN GUIA REMISION' ><i class='bi bi-x-circle-fill'></i> Rechazar Guía </a></li>";
				    }	
				  }

				  if($axestado_atendido=='PROGRAMADO'){
				  	if($axestado_electro=='PROCESADA'){
				  		echo "<li><a class='dropdown-item text-danger' href='#'data-npedido='$axnum_pedido'  id='btn_reprogramar' title='Elimina el despacho y mantiene FACTURA Y GUIA_REMISION' ><b><i class='bi bi-arrow-bar-left'></i> Reprogramar</b></a></li>";	
				  	}
				  	
				  }
				  

			    echo "		    
				    <li><hr class='dropdown-divider'></li>
				     <li>
				     <a class='dropdown-item' href='#'data-npedido='$axnum_pedido' data-local='$axid_local' data-user='$axid_usuario' data-agencia='$axid_agencia' id='btn_editar_pedido_programado'>
				     	<i class='bi bi-folder2-open'style='color:green;'></i> Editar Pedido Programado</a>
				     </li>
				    <li><hr class='dropdown-divider'></li>";

				  echo "
				  </ul>
				</div>



 			</td>



 		</tr>
 	";

}
echo "</table>
</div>";
}
break;

case '77':

$axcodmovcz = trim($_POST['txtcod_mov_cz']);


if($axidlocal==''){
	$axidlocal= get_row('MAESTRO_CZ','ID_LOCAL','COD_MOV',$axcodmovcz);
}else{
	$axidlocal= $_POST['txtid_local'];	
}

$axcod_cliente_emis= get_row('LOCALES','cod_cliente_emis','ID_LOCAL',$axidlocal);
$axruta= get_row('LOCALES','RUTA_JSON','ID_LOCAL',$axidlocal);
$axtoken= get_row('LOCALES','TOKEN_EMPRESA','ID_LOCAL',$axidlocal);
$axurl= get_row('LOCALES','URL_PRODUCCION','ID_LOCAL',$axidlocal);
//$axurl= get_row('LOCALES','URL_PRUEBAS','ID_LOCAL',$axidlocal);

//echo $axcod_cliente_emis;

$SQLDatos_1 ="SELECT TOP 1 * FROM MAESTRO_GENERAR_JSON WHERE COD_MOV='$axcodmovcz' AND ID_LOCAL='$axidlocal'";
$RSDatos_1=odbc_exec($con,$SQLDatos_1);
$row=odbc_fetch_array($RSDatos_1);
			
	$axrucempresa= $row['RUC_EMPRESA'];
	$axtipodoc= $row['COD_SUNAT'];
	$axnserie= $row['TXT_SERIE'];
	$axcorrelativo= $row['DOCUMENTO'];
	$axdocumento_tipo= $row['DETALLE_DOC'];



	$LblNombreArchivo = $axrucempresa.'-'.$axtipodoc.'-'.$axnserie.'-'.$axcorrelativo.'.json';
	//echo $LblNombreArchivo;



$response=array();

if($axdocumento_tipo=="NOTA SALIDA"){

	$SQLActualizar = "UPDATE MAESTRO_CZ SET ESTADO_ELECTRO='PROCESADA',ESTADO_FINAL='PROCESADA',ESTADO_ENVIADO_ITC='' WHERE COD_MOV='$axcodmovcz'";
		$RSActualizar = odbc_exec($con, $SQLActualizar);	


		$respuesta = 0;
		echo $respuesta;
		break;


}else{

$SQLDatosCZ ="SELECT top 1 identificador,fec_emis,hora_emis,TXT_SERIE,txt_correlativo,cod_tip_cpe,cod_mnd,cod_tip_escenario,txt_placa,cod_cliente_emis,num_ruc_emis,nom_rzn_soc_emis,cod_tip_nif_emis,cod_loc_emis,cod_ubi_emis,txt_dmcl_fisc_emis,TXT_URB_EMIS,txt_prov_emis,txt_dpto_emis,txt_distr_emis,num_iden_recp,cod_tip_nif_recp,nom_rzn_soc_recp,txt_dmcl_fisc_recep,txt_correo_adquiriente,mnt_tot_gravadas,mnt_tot_inafectas,mnt_tot_exoneradas,mnt_tot_gratuitas,mnt_tot_desc_global,mnt_tot_igv,mnt_tot_igv_isc,mnt_tot_base_imponible,mnt_tot_percepcion,mnt_tot_a_percibir,mnt_tot,cod_operacion,porcentaje_dscto,mnt_anticipo,mnt_otros_cargos,tipo_percepcion,porcentaje_percepcion,tipo_cambio,txt_condicion_pago,flag_pagado,OBSERVACIONES,orden_compra,guia_remision,flag_envio_automatico,guia_txt_cod_ubig,guia_txt_dmcl_fisc,guia_txt_urb,guia_txt_prov,guia_txt_dpto,guia_txt_distr,guia_txt_pais,guia_cod_ubig_llegda,guia_txt_dmcl_fisc_llegda,guia_txt_urb_llegda,guia_txt_prov_llegda,guia_txt_dpto_llegda,guia_txt_distr_llegda,guia_txt_pais_llegda,guia_txt_placa_auto_trnsp,guia_txt_cert_auto_trnsp,guia_txt_marca_auto_trnsp,guia_txt_lic_cond_trnsp,guia_txt_ruc_trnsp,guia_txt_cod_otr_trnsp,guia_txt_rzn_scl_trnsp,guia_txt_cod_mod_trnsp,guia_mnt_total_bruto,guia_cod_unid_med,dato_extra_1,dato_extra_2,dato_extra_3,dato_extra_4,marca_expor,origen_expor,despacho_expor,soldto_expor,shipto_expor,numerocajas_expor,pesobruto_expor,pesoneto_expor,volumen_expor,fec_venci,mnt_tot_detrac,percent_detrac,descrip_detrac,num_cta_bn,tip_detrac,infos_detrac,mnt_tot_icbper,cod_tip_frmpgo,mnto_crdt_ttal,mnto_crdt_cta,fch_cta,retencion_codigo,retencion_factor,retencion_base,retencion_monto FROM F_JSON_CZ WHERE COD_MOV='$axcodmovcz'";
	
}

$RSDatosCZ=odbc_exec($con,$SQLDatosCZ);
$filacz = odbc_fetch_array($RSDatosCZ);

$SQLDatosDT ="SELECT num_lin_item,cod_unid_item,cant_unid_item,val_vta_item,cod_tip_afect_igv_item,prc_vta_unit_item,mnt_dscto_item,mnt_igv_item,txt_descr_item,cod_prod_sunat,cod_item,val_unit_item,cod_tip_sist_isc,mnt_isc_item,porcentaje_isc,dato_extra_1,dato_extra_2,importe_total_item,val_unit_icbper,cant_icbper_item,mnt_icbper_item FROM F_JSON_DT WHERE COD_MOV='$axcodmovcz'";


$RSDatosDT=odbc_exec($con,$SQLDatosDT);
$axnum = odbc_num_rows($RSDatosDT);

for ($i=0; $i < $axnum ; $i++) { 
		
	$filaDT = odbc_fetch_array($RSDatosDT);
	$jsonDT_1[$i] = $filaDT;
}

$array1    = $filacz;
$array2['anticipos'] = array();
$array3['detalles'] = $jsonDT_1;
$resultado = $array1 + $array2 + $array3;
$jsonfinal_1 = json_encode($resultado,JSON_PRETTY_PRINT);	
$jsonfinal = preg_replace('#:"(\d+)"#', ':$1', $jsonfinal_1);

$file = $axruta.$LblNombreArchivo;  
file_put_contents($file, $jsonfinal);

if($axcod_cliente_emis !==''){

	$axnom_archivo = $axruta.$LblNombreArchivo;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $axurl);
	$parametros = @file_get_contents($axnom_archivo);	
	curl_setopt($ch, CURLOPT_POSTFIELDS, $parametros);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:'.$axtoken));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);

	$result = curl_exec($ch);
	$codigoRespuesta = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	//echo $axurl.'|'.$codigoRespuesta.'|'.$axtoken;

	
	if($codigoRespuesta === 200){
	    
		$SQLActualizar = "UPDATE MAESTRO_CZ SET BOUCHER_DIGITAL='$LblNombreArchivo',ESTADO_ELECTRO='PROCESADA',ESTADO_FINAL='PROCESADA',ESTADO_ENVIADO_ITC='ENVIADO' WHERE COD_MOV='$axcodmovcz'";
		$RSActualizar = odbc_exec($con, $SQLActualizar);
	
	}else{

    $SQLActualizar = "UPDATE MAESTRO_CZ SET BOUCHER_DIGITAL='$LblNombreArchivo',ESTADO_ELECTRO='PENDIENTE',ESTADO_FINAL='PENDIENTE',ESTADO_ENVIADO_ITC='PENDIENTE' WHERE COD_MOV='$axcodmovcz'";
		$RSActualizar = odbc_exec($con, $SQLActualizar);
	
	}	
	curl_close($ch);
	

	}else{

		$SQLActualizar = "UPDATE MAESTRO_CZ SET BOUCHER_DIGITAL='$LblNombreArchivo',ESTADO_ELECTRO='PROCESADA',ESTADO_FINAL='PENDIENTE',ESTADO_ENVIADO_ITC='PENDIENTE' WHERE COD_MOV='$axcodmovcz'";
		$RSActualizar = odbc_exec($con, $SQLActualizar);	


		$respuesta = 0;
		echo $respuesta;
	}

break;

case '78':
	
$axid_empresa= $_POST['txtid_empresa'];
	

	$sqletapas = "SELECT * FROM NUM_DESPACHOS_PROGRAMADOS WHERE ID_EMPRESA ='$axid_empresa' ORDER BY FECHA_DESPACHO DESC" ;	
	$rsetapas=odbc_exec($con,$sqletapas);
	//echo $sqletapas;
	
	if(odbc_num_rows($rsetapas) > 0){
		echo '<option value="">Num. despachos</option>';
		while($fila=odbc_fetch_array($rsetapas)){

			$axnum_despacho =$fila['NUM_DESPACHO'];


	   		//echo "<option value='$axnom_vehiculo'>".date('d-m-Y',strtotime($fila['FECHA_DESPACHO'])).' | '.$fila['NOM_VEHICULO'].' | '.$fila['NOM_CHOFER']."</option>";
	   		echo "<option value='$axnum_despacho'>".$fila['NUM_DESPACHO'].' | '.$fila['NOM_VEHICULO'].' | '.$fila['NOM_CHOFER']."</option>";

    	}
		
	} else {

		echo "";	
	}


break;

case '79':
	$axid_empresa= $_POST['txtid_empresa'];
	$axcodusuario= $_POST['txtcodusuario'];

	$axnom_chofer = get_row('usuarios','NOM_USUARIO','ID_USUARIO',$axcodusuario);

	$sqletapas = "SELECT * FROM NUM_DESPACHOS_PROGRAMADOS WHERE ID_EMPRESA ='$axid_empresa' AND NOM_CHOFER='$axnom_chofer' ORDER BY NUM_DESPACHO DESC" ;	
	$rsetapas=odbc_exec($con,$sqletapas);
	//echo $sqletapas;
	
	if(odbc_num_rows($rsetapas) > 0){
		echo '<option value="">Num. despachos</option>';
		while($fila=odbc_fetch_array($rsetapas)){


			$axnom_vehiculo =$fila['NOM_VEHICULO'];
			$axnum_despacho =$fila['NUM_DESPACHO'];

	   		echo "<option value='$axnum_despacho'>".$axnum_despacho.' | '.$axnom_vehiculo."</option>";
    	}
		
	} else {

		echo "";	
	}

break;

case '80':
	
	$axnum_despacho= $_POST['txtnum_despacho'];
	$axcodusuario= $_POST['txtcodusuario'];
	$axid_empresa = $_POST['txtid_empresa'];

	$SQLDetalle_1 = "SELECT * from PEDIDOS_DESPACHAR_REPORTE_1  WHERE NUM_DESPACHO ='$axnum_despacho' AND ID_EMPRESA='$axid_empresa' AND ESTADO_ATENDIDO='PROGRAMADO' ORDER BY ID_LOCAL ASC";
	$rsetapas=odbc_exec($con,$SQLDetalle_1);	
	
	//echo $SQLDetalle_1;

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-danger'>			
		<tr>
			<th style='text-align: center;'></th>			
			<th style='text-align: left;'>Detalle</th>			
		</tr>
		</thead>";
	
	if(odbc_num_rows($rsetapas) > 0){
	
		while($fila=odbc_fetch_array($rsetapas)){

			
			$it= $it+1;
 			$axnum_pedido = $fila['NUM_PEDIDO'];
			$axcod_interno = $fila['COD_INTERNO'];		
			$razon_social = $fila['NOM_COMERCIAL'];
			$axtotalpedido =$fila["TOTAL_SALIDA"]; 
			$domic_entrega_pred = $fila['DIRECCION_ENTREGA'];
			$axestado_atendido = $fila['ESTADO_ATENDIDO'];
			$id_beneficiario= $fila['ID_BENEFICIARIO'];
			$axnom_beneficiario= $fila['NOM_COMERCIAL'];
			$axfecha_pedido= $fila['FECHA_PEDIDO'];
			$axid_local= $fila['ID_LOCAL'];



			$axid_agencia= $fila['ID_AGENCIA'];
			$axid_td= $fila['ID_TD'];
			$axfecha_despacho= $fila['FECHA_DESPACHO'];

			echo "<tr>
			<td class='text-dark'style='text-align: center;'><i class='bi bi-truck'></i></td> 
 					  <td class='text-dark'style='text-align: justify;'>
 					  	<a href='#' data-bs-toggle='modal' data-monto='$axtotalpedido'  data-bs-target='#exampleModal_3' class='text-dark' style='text-decoration:none;' id='btn_atender_pedido_programado' data-npedido='$axnum_pedido' data-local='$axid_local' data-nomb_benef='$axnom_beneficiario' data-cod_int='$axcod_interno' data-rsocial='$razon_social' data-dir='$domic_entrega_pred' data-estado='$axestado_atendido'><b>".utf8_encode($razon_social).'</b><br><b class="text-danger" >'.$domic_entrega_pred.' - </b><b class="text-primary">'.$axtotalpedido."</b></a></td>

 					  	<tr>
 					  	";

	  	}
			echo "</table>";
	} else {

		echo "";	
	}


break;
case '81':

date_default_timezone_set("America/Lima");

$axnum_despacho= $_POST['txtnum_despacho'];
$axmedio_pago= $_POST['txtmedio_pago'];
$axmonto_pagado= $_POST['txtmonto_pagado'];
$axobservacion_entrega= $_POST['txtobservacion_entrega'];
$axnum_pedido= $_POST['txtnum_pedido'];
$axid_local= $_POST['txtid_local'];
$axdetalle_pago= 'PAGO DEL CLIENTE';
$axhora_entrega = date('h:i');

$SQLInsert = "INSERT INTO PEDIDOS_DEPACHO_1 (NUM_PEDIDO,ID_LOCAL,MEDIO_PAGO,MONTO_PAGADO,OBSERVACION_DESPACHO,NUM_DESPACHO,DETALLES_PAGOS) values ('$axnum_pedido','$axid_local','$axmedio_pago','$axmonto_pagado','$axobservacion_entrega','$axnum_despacho','$axdetalle_pago')";
$rsinserta = odbc_exec($con,$SQLInsert);

//echo $SQLInsert;

if($rsinserta){

	$SQLActualizar = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='ATENDIDO', HORA_ENTREGA='$axhora_entrega',ESTADO_REVISION='CERRADO' WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
	$RSActualizar = odbc_exec($con,$SQLActualizar);

	$respuesta =0;
	echo $respuesta;

}else{

	$respuesta =1;
	echo $respuesta;

}
	

break;

case '82':
	
$axnum_pedido= $_POST['txtnum_pedido'];
$axid_local= $_POST['txtid_local'];

$SQLBuscar ="SELECT  * FROM PEDIDOS_DEPACHO_1 WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";

//echo "$SQLBuscar";

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-danger'>			
		<tr>
			<th style='text-align: left;'>Medio</th>
			<th style='text-align: right;'>Monto</th>			
			<th style='text-align: center;'></th>			
			
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$axid_modo = $fila['ID_MODO_PAGO'];		
 		$axrnum_pedido = $fila['NUM_PEDIDO'];		
		$axid_local = $fila['ID_LOCAL'];
		$axmedio_pago = $fila['MEDIO_PAGO'];
		$axmonto_pagado = number_format($fila["MONTO_PAGADO"],4,".",",");  
		$axobservar = $fila['OBSERVACION_DESPACHO'];

 	echo "
 		<tr> 		
 			<td style='text-align: left;'>$axmedio_pago</td> 
 			<td style='text-align: right;'>$axmonto_pagado</td> 
 			<td style='text-align: center;'><a href='#' id='btn_quitar_pago'  data-id='$axid_modo' style='text-decoration:none;'><i class='bi bi-trash3-fill'></i></a></td> 
 		</tr>
 	";

}
	$SQLBuscar_t ="SELECT  SUM(MONTO_PAGADO) AS TT FROM PEDIDOS_DEPACHO_1 WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
	$RSBuscar_t = odbc_exec($con,$SQLBuscar_t);
	$fila_t = odbc_fetch_array($RSBuscar_t);
	$axmonto_pagado_1 = number_format($fila_t["TT"],4,".",",");  

	echo "<tr>
	<td style='text-align: right;'><b>Total Cobrado</b></td> 
	<td style='text-align: right;'><b>$axmonto_pagado_1</b></td> 
	</tr>";

echo "</table>";
}


break;

case '83':

$axid_modo= $_POST['txtid_modo_pago'];

$SQLEliminar ="DELETE FROM PEDIDOS_DEPACHO_1 WHERE ID_MODO_PAGO='$axid_modo'";
$RSEliminar = odbc_exec($con,$SQLEliminar);

//echo $SQLEliminar;

if($RSEliminar){

	$respuesta=0;
	echo $respuesta;

}else{

	$respuesta=1;
	echo $respuesta;
}

break;

case '84':
	
$axnum_pedido= $_POST['txtnum_pedido'];
$axid_local= $_POST['txtid_local'];
	
	$sql6 = "SELECT * FROM MAESTRO_FORMA_PAGOS WHERE ID_LOCAL = '$axid_local'";
	
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

case '85':
	
date_default_timezone_set("America/Lima");

$axmedio_pago= $_POST['txtmedio_pago'];
$axmonto_pagado= 0;
$axobservacion_entrega= $_POST['txtobservacion_entrega'];
$axnum_pedido= $_POST['txtnum_pedido'];
$axid_local= $_POST['txtid_local'];
$axhora_entrega = date('h:i');
/*
$SQLInsert = "INSERT INTO PEDIDOS_DEPACHO_1 (NUM_PEDIDO,ID_LOCAL,MEDIO_PAGO,MONTO_PAGADO,OBSERVACION_DESPACHO) values ('$axnum_pedido','$axid_local','$axmedio_pago','$axmonto_pagado','$axobservacion_entrega')";
$rsinserta = odbc_exec($con,$SQLInsert);
*/
$SQLActualizar = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='ATENDIDO', HORA_ENTREGA='$axhora_entrega',ESTADO_REVISION='CERRADO' WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
	$RSActualizar = odbc_exec($con,$SQLActualizar);

//echo $SQLInsert;

if($RSActualizar){	

	$respuesta =0;
	echo $respuesta;

}else{

	$respuesta =1;
	echo $respuesta;

}

break;

case '86':
	
	$axnum_despacho= $_POST['txtnum_despacho'];
	$axcodusuario= $_POST['txtcodusuario'];
	$axid_empresa = $_POST['txtid_empresa'];

	$SQLDetalle_1 = "SELECT * from PEDIDOS_DESPACHAR_REPORTE_1  WHERE NUM_DESPACHO ='$axnum_despacho' AND ID_EMPRESA='$axid_empresa' AND ESTADO_ATENDIDO='ATENDIDO' ORDER BY ID_LOCAL ASC";
	$rsetapas=odbc_exec($con,$SQLDetalle_1);	
	
	echo $SQLDetalle_1;

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th style='text-align: center;'></th>			
			<th style='text-align: left;'>Detalle</th>			
		</tr>
		</thead>";
	
	if(odbc_num_rows($rsetapas) > 0){
	
		while($fila=odbc_fetch_array($rsetapas)){

			
			$it= $it+1;
 			$axnum_pedido = $fila['NUM_PEDIDO'];
			$axcod_interno = $fila['COD_INTERNO'];		
			$razon_social = $fila['NOM_COMERCIAL'];
			$axtotalpedido =$fila["TOTAL_SALIDA"]; 
			$domic_entrega_pred = $fila['DIRECCION_ENTREGA'];
			$axestado_atendido = $fila['ESTADO_ATENDIDO'];
			$id_beneficiario= $fila['ID_BENEFICIARIO'];
			$axnom_beneficiario= $fila['NOM_COMERCIAL'];
			$axfecha_pedido= $fila['FECHA_PEDIDO'];
			$axid_local= $fila['ID_LOCAL'];



			$axid_agencia= $fila['ID_AGENCIA'];
			$axid_td= $fila['ID_TD'];
			$axfecha_despacho= $fila['FECHA_DESPACHO'];

			echo "<tr>
			<td class='text-dark'style='text-align: center;'> <a href='#' data-npedido='$axnum_pedido' data-local='$axid_local' id='btn_quitar_atendido'><i class='bi bi-trash-fill'></i></a> </td> 
 					  <td class='text-dark'style='text-align: justify;'>
 					  	<a href='#' class='text-dark' style='text-decoration:none;'><b class='text-primary'>".utf8_encode($razon_social)."</b></a></td>
 					  	<tr>

 					  	";

	  	}
			echo "</table>";
	} else {

		echo "";	
	}

break;
case '87':
	
date_default_timezone_set("America/Lima");

$axmedio_pago= $_POST['txtmedio_pago'];
$axmonto_pagado= 0;
$axobservacion_entrega= $_POST['txtobservacion_entrega'];
$axnum_pedido= $_POST['txtnum_pedido'];
$axid_local= $_POST['txtid_local'];
$axhora_entrega = date('h:i');
/*
$SQLInsert = "INSERT INTO PEDIDOS_DEPACHO_1 (NUM_PEDIDO,ID_LOCAL,MEDIO_PAGO,MONTO_PAGADO,OBSERVACION_DESPACHO) values ('$axnum_pedido','$axid_local','$axmedio_pago','$axmonto_pagado','$axobservacion_entrega')";
$rsinserta = odbc_exec($con,$SQLInsert);
*/
$SQLActualizar = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='PROGRAMADO', HORA_ENTREGA='',ESTADO_REVISION='CERRADO' WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
	$RSActualizar = odbc_exec($con,$SQLActualizar);

//echo $SQLInsert;

if($RSActualizar){	

	$SQLEliminar = "DELETE FROM PEDIDOS_DEPACHO_1 WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
	$RSEliminar = odbc_exec($con,$SQLEliminar);

	$respuesta =0;
	echo $respuesta;

}else{

	$respuesta =1;
	echo $respuesta;

}

break;
case '88':

$axbuscaregistro = $_POST['txtbuscar_venta_atendida']; 	
$axid_empresa = $_POST['txtid_empresa']; 	
$axid_local = $_POST['txtid_local']; 	
$axfiltro_busquedas = $_POST['txtfiltro_busquedas']; 	

if($axbuscaregistro==""){

if($axfiltro_busquedas=='RECHAZADA'){
	$SQLBuscar ="SELECT * FROM MAESTRO_CZ_PROGRAMADOS WHERE ID_LOCAL='$axid_local' AND ESTADO_ELECTRO like '%".$axfiltro_busquedas."%'  ORDER BY DOCUMENTO DESC";
}else{
	$SQLBuscar = "SELECT * FROM MAESTRO_CZ_PROGRAMADOS WHERE ID_LOCAL='$axid_local' AND ESTADO_ATENDIDO='ATENDIDO' ORDER BY DOCUMENTO DESC";		
}

		


	
}else{
	if($axfiltro_busquedas=='Cliente'){
		$SQLBuscar ="SELECT * FROM MAESTRO_CZ_PROGRAMADOS WHERE ID_LOCAL='$axid_local' AND NOM_COMERCIAL like '%".$axbuscaregistro."%' ";
	}elseif($axfiltro_busquedas=='Comprobante'){
		$SQLBuscar ="SELECT * FROM MAESTRO_CZ_PROGRAMADOS WHERE ID_LOCAL='$axid_local' AND DOCUMENTO like '%".$axbuscaregistro."%' ";
	
	}

}
	
	//echo "$SQLBuscar";

	echo "
		<div id='div3'>
		<table class='table table-hover'>
		<thead class='table-success'>			
		<tr>
			<th scope='col' style='text-align:center'>Item</th>
			<th scope='col' style='text-align:center'>Fecha Emisión</th>
			<th scope='col' style='text-align:center'>Num. Comprobante</th>
			<th scope='col' style='text-align:left'>Nombre Cliente</th>
			<th scope='col' style='text-align:left'>Fecha Hora entrega</th>
			<th scope='col' style='text-align:left'>Vehiculo</th>			
			<th scope='col' style='text-align:right'>Monto</th>
			<th scope='col'>Acción</th>
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);	
	
	if ($RSBuscar){
 	
 	while ($row=odbc_fetch_array($RSBuscar)){ 

 		$it = $it+1;
 		$axcod_mov= $row["COD_MOV"];
 		$axnum_pedido= $row["NUM_PEDIDO"];
 		$axfecha_emision_comp= $row["FECHA_EMISION"];
 		$axid_local= $row["ID_LOCAL"];
 		$axid_td=$row['ID_TD'];
 		$axid_vehiculo=$row['ID_VEHICULO'];
 		$axfecha_emision = date('d-m-Y', strtotime($row["FECHA_EMISION"]));
 		$axcomprobante = $row["COMPROBANTE"];
 		$axnom_cliente = utf8_encode($row["RAZON_SOCIAL"]);
 		$axtotal_venta =number_format($row["TOTAL_VENTA"],2,".",","); 
 		$axestado_electro = $row["ESTADO_ELECTRO"];
 		$axestado_enviado = $row["ESTADO_ENVIADO_ITC"];
 		$axestado_atendido = $row["ESTADO_ATENDIDO"];
 		$axjson = $row["BOUCHER_DIGITAL"];
 		$axfecha_hora_entrega = date('d-m-Y', strtotime($row["FECHA_EMISION"])).' - '.$row["HORA_ENTREGA"];;
 		$axnom_vehiculo =get_row('VEHICULOS_DESPACHOS','MARCA_VEHICULO','ID_VEHICULO',$axid_vehiculo).'-'.get_row('VEHICULOS_DESPACHOS','NUM_PLACA','ID_VEHICULO',$axid_vehiculo);
 		$axnom_chofer =$row["NOM_CHOFER"];
 		$axdireccion_entrega =$row["DIRECCION_ENTREGA"];
 		$axverif_guia = $row["COD_GUIA_CZ"];
 		$axnum_guia = get_row('GUIA_REMISION_CZ','txt_serie','COD_GUIA_CZ',$axverif_guia).'-'.get_row('GUIA_REMISION_CZ','txt_correlativo','COD_GUIA_CZ',$axverif_guia);;

 		$axestado_electro_G =  get_row('GUIA_REMISION_CZ','ESTADO_ELECTRO','COD_GUIA_CZ',$axverif_guia);
 		$axestado_enviado_G = get_row('GUIA_REMISION_CZ','ESTADO_ENVIADO_ITC','COD_GUIA_CZ',$axverif_guia); 

 		$axnum_pedido_1 =  get_row('MAESTRO_CZ','NUM_PEDIDO','COD_MOV',$axcod_mov);

 	echo "
 		<tr> 		
 			<td scope='col' style='text-align:center'>$it</td>
			<td scope='col' style='text-align:center'>$axfecha_emision</td>			
			<td scope='col' style='text-align:center'>".$axcomprobante.'<br> <b style="color:#BEBFC0;">'.$axnum_guia.'</b>'."</td>";

			if($axestado_electro=='ANULADA'){
				echo "<td scope='col' style='text-align:left'>$axnom_cliente<br>$axdireccion_entrega<b class='text-danger'> - $axestado_electro</b> </td>";	
			}elseif($axestado_electro=='RECHAZADA'){
				echo "<td scope='col' style='text-align:left'>$axnom_cliente<br>$axdireccion_entrega<b class='text-danger'> - $axestado_electro</b> </td>";	
			}else{
				echo "<td scope='col' style='text-align:left'>$axnom_cliente<br>$axdireccion_entrega<b class='text-primary'> - $axestado_electro</b></td>";	
			}

			echo "
			
			<td scope='col' style='text-align:left' class='text-success'><b>$axfecha_hora_entrega</b></td>
			<td scope='col' class='text-success' style='text-align:left'><b>$axnom_vehiculo<br>$axnom_chofer</b></td>";				
					
 			
 		echo "
 		<td scope='col' style='text-align:right'>$axtotal_venta</td>
 			<td style='text-align: center;'>			

 				<div class='btn-group dropstart'>

				  <button class='btn btn-outline-primary btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>

				  <ul class='dropdown-menu'>
				  	<li><hr class='dropdown-divider'></li>
				    <li><a class='dropdown-item' href='#'data-id='$axcod_mov' data-local='$axid_local' id='btn_comprobante_imprimir'><i class='bi bi-file-earmark-pdf-fill' style='color:red;'></i> Comprobante</a></li>";

				    if($axverif_guia==''){
				    	if($axtipodoc=='NOTA SALIDA'){
				    		
				    	}else{
				    		echo "<li><a class='dropdown-item' href='#' data-local='$axid_local' data-id='$axcod_mov' data-npedido='$axnum_pedido' data-guia='$axverif_guia' id='btn_guia_remision_emitir' data-bs-toggle='modal' data-bs-target='#modal_guias_numeros'><i class='bi bi-file-earmark-pdf-fill' style='color:green;'></i> Guía Remisión</a></li>";
				    	}
				    	

				    }else{
				    	echo "<li><a class='dropdown-item' href='#' data-guia='$axverif_guia' id='btn_guia_remision_pdf' ><i class='bi bi-file-earmark-pdf-fill' style='color:red;'></i> Guía Remisión</a></li>";
				    }

				   echo "
				    
				    <li><a class='dropdown-item' href='#'data-npedido='$axnum_pedido' data-local='$axid_local' id='btn_pedidos_imprimir'><i class='bi bi-file-earmark-pdf-fill'style='color:red;'></i> Pedidos</a></li>
				    <li><hr class='dropdown-divider'></li>";

				  if($axestado_electro=='PENDIENTE'){
				  	echo "<li>
				  		<a class='dropdown-item' href='#' data-id='$axcod_mov' data-npedido='$axnum_pedido' id='btn_eliminar_ns_comprobantes_pendientes'><i class='bi bi-trash3-fill'></i>Eliminar</a>
				  		</li>";
				  }

				  if($axestado_electro=='PROCESADA'){
				  	
				  	echo "
				    <li><a class='dropdown-item' href='#'data-codmov='$axcod_mov' data-pedido='$axnum_pedido_1' data-guia='$axverif_guia' data-estadoelectro_f='$axestado_electro' data-fecha='$axfecha_emision_comp' id='btn_anular_comprobante' data-bs-toggle='modal' data-bs-target='#exampleModal_anular'><i class='bi bi-x-circle-fill'></i> Anular </a></li>

				    <li><a class='dropdown-item' href='#'data-codmov='$axcod_mov' data-guia='$axverif_guia' data-estadoelectro_f='$axestado_electro' data-fecha='$axfecha_emision_comp' id='btn_nota_credito' ><i class='bi bi-file-earmark-ruled-fill'></i> Nota de Crédito </a></li>
				    ";
				  }

			    echo "
				    
				    <li><hr class='dropdown-divider'></li>
				  </ul>
				</div>




 			</td>



 		</tr>
 	";

}
echo "</table>
</div>";
}

break;

case '89':
	
$axnum_despacho_2 = $_POST['txtnum_despacho_2']; 	
$axid_empresa = $_POST['txtid_empresa']; 	
$axid_local = $_POST['txtid_local']; 	

$SQLBuscar = "SELECT * FROM MAESTRO_CZ_PROGRAMADOS WHERE ID_LOCAL = '$axid_local' AND ID_TD='12' AND ESTADO_ATENDIDO='PROGRAMADO' AND COD_GUIA_CZ='' AND NUM_DESPACHO='$axnum_despacho_2' ORDER BY COMPROBANTE ASC";
	
	
	
	//echo "$SQLBuscar";

	echo "
		<table class='table table-hover'>
		<thead class='table-primary'>			
		<tr>
			<th scope='col' style='text-align:left'>Comprobante</th>			
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);	
		
	if(odbc_num_rows($RSBuscar) > 0){
 	
 	while ($row=odbc_fetch_array($RSBuscar)){ 

 		$it = $it+1;
 		$axcod_mov= $row["COD_MOV"];
 		$axnum_pedido= $row["NUM_PEDIDO"];
 		$axid_local= $row["ID_LOCAL"];
 		$axid_td=$row['ID_TD'];
 		$axfecha_emision = date('d-m-Y', strtotime($row["FECHA_EMISION"]));
 		$axcomprobante = $row["COMPROBANTE"];
 		$axnom_cliente = utf8_encode($row["RAZON_SOCIAL"]);
 		$axtotal_venta =number_format($row["TOTAL_VENTA"],4,".",","); 
 		$axestado_electro = $row["ESTADO_ELECTRO"];
 		$axestado_enviado = $row["ESTADO_ENVIADO_ITC"];
 		$axestado_atendido = $row["ESTADO_ATENDIDO"];
 		$axjson = $row["BOUCHER_DIGITAL"];



 	echo "
 		<tr> 		
 			<td scope='col' style='text-align:left'><a href='#' style='text-decoration:none;' id='btn_producto_asignar_a_guia' data-filtro='ADICIONAR' data-codmov='$axcod_mov'>".$axcomprobante.' - '."$axfecha_emision".'<br>'."$axnom_cliente</a></td>			
 		</tr>
 	";

}
echo "</table>";
}else{

	echo "<h4>No existen comprobantes</h4>";

}

break;

case '90':
	
 $axbuscar_dato =$_POST['txtdistrito_alter'];
   
 if(isset($_POST["txtdistrito_alter"])){

	$output ="";
	$idprov ="";
	$sqlemisor = "SELECT * FROM TB_UBIGEOS_LISTA WHERE UBIGEO_PERU LIKE  '%".$axbuscar_dato."%' ORDER BY UBIGEO_PERU";
	//echo $sqlemisor;

	$rsemisor=odbc_exec($con,$sqlemisor);	
	$output ='<ul class="list-group">';  		

	if(odbc_num_rows($rsemisor) > 0){
		 while ($row=odbc_fetch_array($rsemisor)){		
		 	$id =  $row["UBIGEO_REINEC"];
		 	$nom_prod =  trim($row["UBIGEO_PERU"]);

		 	$output .='<a href="#" id="btn_lista_ubigeos" class="list-group-item list-group-item-action" style="background:#DAF5FF;" data-id='.$id.' data-nom_pro='.$nom_prod.'>'.utf8_encode(trim($row["UBIGEO_PERU"])).'</a>';
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
case '91':

$axcodusuario = $_POST['txtcodusuario'];
	
$Identificador='GR';
$axcod_guia_cz = $_POST['txtcod_guia_cz']; 		
$axcod_mov_cz = $_POST['txtcod_mov_cz']; 	
$axid_local = $_POST['txtid_local']; 	
$axfecha_traslado = $_POST['txtfecha_traslado']; 	
$axnum_despacho = $_POST['txtnum_despacho_2']; 	

$axid_vehiculo =get_row('PEDIDOS','ID_VEHICULO','NUM_DESPACHO',$axnum_despacho);
$axnom_chofer =get_row('PEDIDOS','NOM_CHOFER','NUM_DESPACHO',$axnum_despacho);
$axid_chofer =get_row('usuarios','ID_USUARIO','NOM_USUARIO',$axnom_chofer);

$axIdentificador ='GR';
$axid_tipo_doc = $_POST['txtid_td_guia']; 	
$cod_tip_cpe = get_row('TIPO_DOCUMENTOS','COD_SUNAT','ID_TD',$axid_tipo_doc);
$axnum_pedido=get_row('MAESTRO_CZ','NUM_PEDIDO','COD_MOV',$axcod_mov_cz);
//$axid_vehiculo =get_row('PEDIDOS','ID_VEHICULO','NUM_PEDIDO',$axnum_pedido);

$axfecha_emision_guia = $_POST['txtfecha_emision_guia']; 	
$txt_serie_cod = $_POST['txt_serie_guia']; 	
$txt_serie = get_row('CORRELATIVOS','N_SERIE','COD_CORR',$txt_serie_cod);

$txt_correlativo = $_POST['txtdocumento_guia']; 	

$trans_cod_tip_modalidad = $_POST['trans_cod_tip_modalidad']; 	
$cod_mot_trasalado = $_POST['cod_mot_trasalado']; 	

$cod_cliente_emis = get_row('LOCALES','cod_cliente_emis','ID_LOCAL',$axid_local);
$num_ruc_rem= get_row('LOCALES','RUC_EMPRESA','ID_LOCAL',$axid_local);
$nom_rzn_soc_rem= get_row('LOCALES','RAZON_SOCIAL','ID_LOCAL',$axid_local);
$cod_tip_nif_rem=get_row('LOCALES','cod_tip_nif_rem','ID_LOCAL',$axid_local);

$axid_beneficiario = $_POST['txtid_beneficiario_guia'];;

$num_iden_prov='';
$nom_rzn_soc_prov='';
$cod_tip_nif_prov='';

$fec_emis= $_POST['txtfecha_emision_guia']; 	
$hora_emis = date('H:i:s');

//if($cod_mot_trasalado=='04'){ //TRASLADO ENTRE LOCALES DE LA MISMA EMPRESA

	$num_ruc_dest  = get_row('LOCALES','RUC_EMPRESA','ID_LOCAL',$axid_beneficiario);
	$nom_rzn_soc_dest= get_row('LOCALES','RAZON_SOCIAL','ID_LOCAL',$axid_beneficiario);
	$cod_tip_nif_dest= get_row('LOCALES','ID_DOC','ID_LOCAL',$axid_beneficiario);
	$cod_ubi_partida=get_row('LOCALES','cod_ubi_partida','ID_LOCAL',$axid_local);

	$txt_domicilio_partida=get_row('LOCALES','txt_domicilio_partida','ID_LOCAL',$axid_local);
	$txt_domicilio_llegada=get_row('LOCALES','txt_domicilio_llegada','ID_LOCAL',$axid_local);
	$cod_ubi_llegada=get_row('LOCALES','cod_ubi_llegada','ID_LOCAL',$axid_local);
/*
}else{

	$num_ruc_dest  = get_row('BENEFICIARIOS','RUC_BENEF','ID_BENEFICIARIO',$axid_beneficiario);
	$nom_rzn_soc_dest= get_row('BENEFICIARIOS','RAZON_SOCIAL','ID_BENEFICIARIO',$axid_beneficiario);
	$cod_tip_nif_dest= get_row('BENEFICIARIOS','ID_DOC','ID_BENEFICIARIO',$axid_beneficiario);

	$cod_ubi_partida=get_row('LOCALES','cod_ubi_partida','ID_LOCAL',$axid_local);
	$txt_domicilio_partida=get_row('LOCALES','txt_domicilio_partida','ID_LOCAL',$axid_local);
	$txt_domicilio_llegada=get_row('BENEFICIARIOS_UBIGEOS','DIR_LLEGADA','ID_BENEFICIARIO',$axid_beneficiario);
	$cod_ubi_llegada=get_row('BENEFICIARIOS_UBIGEOS','cod_ubi_llegada','ID_BENEFICIARIO',$axid_beneficiario);

}
*/
$axid_agencia = get_row('PEDIDOS','ID_AGENCIA','NUM_PEDIDO',$axnum_pedido);
$axfiltro = '20';
$axdesc_traslado = get_row_two('CATALOGOS_SUNAT','DESCRIPCION_CATALOGO','COD_CATALOGO','FILTRO',$cod_mot_trasalado,$axfiltro);
//echo 'xxx-'.$axdesc_traslado;


//if($axid_agencia=='0' OR $axid_agencia==''){ //

	$trans_txt_nombre='';
	$trans_txt_ruc='';
	$trans_cod_tip_nif='';
	$trans_fec_ini = $axfecha_traslado;
	$axtipo = "Transporte privado";
/*
}else{ 

	$trans_txt_nombre=get_row('TRANSPORTISTAS','NOM_AGENCIA','ID_AGENCIA',$axid_agencia);
	$trans_txt_ruc=get_row('TRANSPORTISTAS','RUC_AGENCIA','ID_AGENCIA',$axid_agencia);
	$trans_cod_tip_nif=get_row('TRANSPORTISTAS','ID_DOC','ID_AGENCIA',$axid_agencia);
	$trans_fec_ini = get_row('PEDIDOS','FECHA_DESPACHO','NUM_PEDIDO',$axnum_pedido);
	$axtipo = "Transporte privado";

}
*/
$observaciones="la guia de remision tiene que ser llevada obligatoriamente";
$txt_desc_motiv_tras= $axdesc_traslado.'-'.$axtipo;
$dato_extra_1="";
$dato_extra_2="";
$dato_extra_3="";
$dato_extra_4="";
$vrs_guia='2.0';

/*

cant_bultos_expor
cod_unid_peso_bruto
mnt_tot_peso_bruto

*/

$SQLInsert = "INSERT INTO GUIA_REMISION_CZ (COD_GUIA_CZ,ID_LOCAL,Identificador,cod_tip_cpe,txt_serie,txt_correlativo,cod_cliente_emis,num_ruc_rem,nom_rzn_soc_rem,cod_tip_nif_rem,num_ruc_dest,nom_rzn_soc_dest,cod_tip_nif_dest,num_iden_prov,nom_rzn_soc_prov,cod_tip_nif_prov,fec_emis,hora_emis,cod_ubi_partida,txt_domicilio_partida,txt_domicilio_llegada,cod_ubi_llegada,trans_txt_nombre,trans_txt_ruc,trans_cod_tip_nif,trans_fec_ini,cod_mot_trasalado,trans_cod_tip_modalidad,observaciones,txt_desc_motiv_tras,dato_extra_1,dato_extra_2,dato_extra_3,dato_extra_4,vrs_guia,ID_VEHICULO,ID_USUARIO) VALUES ('$axcod_guia_cz','$axid_local','$Identificador','$cod_tip_cpe','$txt_serie','$txt_correlativo','$cod_cliente_emis','$num_ruc_rem','$nom_rzn_soc_rem','$cod_tip_nif_rem','$num_ruc_dest','$nom_rzn_soc_dest','$cod_tip_nif_dest','$num_iden_prov','$nom_rzn_soc_prov','$cod_tip_nif_prov','$fec_emis','$hora_emis','$cod_ubi_partida','$txt_domicilio_partida','$txt_domicilio_llegada','$cod_ubi_llegada','$trans_txt_nombre','$trans_txt_ruc','$trans_cod_tip_nif','$trans_fec_ini','$cod_mot_trasalado','$trans_cod_tip_modalidad','$observaciones','$txt_desc_motiv_tras','$dato_extra_1','$dato_extra_2','$dato_extra_3','$dato_extra_4','$vrs_guia','$axid_vehiculo','$axid_chofer')";


	//echo $SQLInsert;
	$RSInsert = odbc_exec($con,$SQLInsert);

	if($RSInsert){

			$respuesta =0;
			echo $respuesta;

	}else{

		$respuesta =1;
			echo $respuesta;

	}


break;



case '92':
	
	$axid_empresa = $_POST['txtid_empresa']; 		
	$axcod_mot_trasalado = $_POST['cod_mot_trasalado']; 		
	$axid_local = $_POST['txtid_local']; 		

	if($axcod_mot_trasalado=='04'){

		$sqletapas = "SELECT * FROM LOCALES WHERE ID_LOCAL='$axid_local' ORDER BY ID_LOCAL ASC" ;
		$rsetapas=odbc_exec($con,$sqletapas);	

		if(odbc_num_rows($rsetapas) > 0){
		
			//echo '<option value="">Seleccionar</option>';
			while($fila=odbc_fetch_array($rsetapas)){
	   		echo '<option value='.$fila['ID_LOCAL'].'>'.utf8_encode($fila['RAZON_SOCIAL']).'</option>';
    	}
		
		} else {
			echo "";	
		}


	}else{

		$sqletapas = "SELECT * FROM BENEFICIARIOS WHERE TIPO_PROV_CLIE ='CLIENTE' ORDER BY RAZON_SOCIAL ASC" ;	
		$rsetapas=odbc_exec($con,$sqletapas);	

		if(odbc_num_rows($rsetapas) > 0){
		
			echo '<option value="">Seleccionar</option>';
			while($fila=odbc_fetch_array($rsetapas)){
	   		echo '<option value='.$fila['ID_BENEFICIARIO'].'>'.utf8_encode($fila['RAZON_SOCIAL']).'</option>';
    	}
		
		} else {
			echo "";	
		}

	}

	
	
	//echo $sqletapas;	      

break;
case '93':

$axid_local = $_POST['txtid_local']; 		
$axiid_td_guia = $_POST['txtid_td_guia_1']; 		
$axnum_pedido = $_POST['txtnum_pedido']; 		
	

if($axid_local==''){
	$axid_local = get_row('PEDIDOS_CZ','ID_LOCAL','NUM_PEDIDO',$axnum_pedido);
}

$sqletapas = "SELECT * FROM CORRELATIVOS WHERE ID_LOCAL ='$axid_local' AND ID_TD='$axiid_td_guia' ORDER BY ID_TD ASC" ;

//echo $sqletapas;	      

$rsetapas=odbc_exec($con,$sqletapas);
	
	if(odbc_num_rows($rsetapas) > 0){
	//	echo '<option value="">Seleccionar</option>';
		while($fila=odbc_fetch_array($rsetapas)){
	   		echo '<option value='.$fila['COD_CORR'].'>'.$fila['N_SERIE'].'</option>';
    	}
		
	} else {

		echo "";	
	}

break;

case '94':

$axid_local = $_POST['txtid_local']; 		
$axid_td_cp = $_POST['txtid_td_cp']; 		
$axnum_pedido = $_POST['txtnum_pedido']; 		
$axserie = $_POST['txt_serie_1']; 		
$axiid_td_guia = $_POST['txtid_td_guia_1']; 		
$axserie_guia = $_POST['txt_serie_guia_1']; 		
$local = $axid_local;

if ($axid_local == '') {
    $axid_local = get_row('PEDIDOS_CZ', 'ID_LOCAL', 'NUM_PEDIDO', $axnum_pedido);
}

if ($axid_td_cp == '') {
    $sqletapas = "SELECT * FROM CORRELATIVOS WHERE ID_LOCAL ='$axid_local' AND ID_TD='$axiid_td_guia' and COD_CORR='$axserie_guia' ORDER BY ID_TD asc";
    $tipo = $axiid_td_guia;
    $serie = $axserie_guia;
} elseif ($axiid_td_guia == '') {
    $sqletapas = "SELECT * FROM CORRELATIVOS WHERE ID_LOCAL ='$axid_local' AND ID_TD='$axid_td_cp' and COD_CORR='$axserie' ORDER BY ID_TD asc";
    $tipo = $axid_td_cp;
    $serie = $axserie;
}

$rsetapas = odbc_exec($con, $sqletapas);
//echo $sqletapas;

$fila = odbc_fetch_array($rsetapas);


if (odbc_num_rows($rsetapas) > 0) {

	$axcorrelativo = $fila['N_CORRELATIVO'];
$nuevoCorrelativo = $axcorrelativo + 1;

    // Verificar si el nuevo correlativo ya existe en la tabla PEDIDOS
    if (existeEnVentas($nuevoCorrelativo,$local,$serie,$tipo)) {
        //echo "Alerta: El correlativo $nuevoCorrelativo ya existe en la tabla VENTAS.";
        $respuesta = 0;
        echo $respuesta;
    } else {
        echo number_pad($nuevoCorrelativo, 8);
    }

} else {
    // Si no hay correlativos existentes, inicia en 401 y verifica si existe en la tabla PEDIDOS

    if (existeEnVentas($nuevoCorrelativo,$local,$serie,$tipo)) {

      //  echo "Alerta: El correlativo $nuevoCorrelativo ya existe en la tabla VENTAS.";
        $respuesta = 0;
        echo $respuesta;
    } else {
        echo number_pad($nuevoCorrelativo, 8);
    }
}






break;

case '95':

$axcodusuario = $_POST['txtcodusuario'];
	
$Identificador='GR';
//$axcod_guia_cz = $_POST['txtcod_guia_cz']; 		
$axcod_mov_cz = $_POST['txtcod_mov_cz']; 	
$axid_local = get_row('MAESTRO_CZ','ID_LOCAL','COD_MOV',$axcod_mov_cz);


$axdni_user = get_row('usuarios','COD_USUARIO','ID_USUARIO',$axcodusuario);
$logitudPass = 10;
$axcod = substr($axdni_user,0,3);
$nuevo_nombre_a = substr(md5(microtime()),1,$logitudPass);
$nuevo_nombre = $axid_local.$axcod.$nuevo_nombre_a;
$axcod_guia_cz = trim($nuevo_nombre);

$axIdentificador ='GR';
$axid_tipo_doc = $_POST['txtid_td_guia_1']; 	
$cod_tip_cpe = get_row('TIPO_DOCUMENTOS','COD_SUNAT','ID_TD',$axid_tipo_doc);

$axnum_pedido=get_row('MAESTRO_CZ','NUM_PEDIDO','COD_MOV',$axcod_mov_cz);
$axid_vehiculo =get_row('PEDIDOS','ID_VEHICULO','NUM_PEDIDO',$axnum_pedido);

$axfecha_emision_guia = $_POST['txtfecha_emision_guia']; 	
$txt_serie_cod = $_POST['txt_serie_guia_1']; 	
$txt_serie = get_row('CORRELATIVOS','N_SERIE','COD_CORR',$txt_serie_cod);

$txt_correlativo = $_POST['txtdocumento_guia_1']; 	


/*************/

 /****************/

$trans_cod_tip_modalidad = $_POST['trans_cod_tip_modalidad']; 	
$cod_mot_trasalado = '01'; 	

$cod_cliente_emis = get_row('LOCALES','cod_cliente_emis','ID_LOCAL',$axid_local);
$num_ruc_rem= get_row('LOCALES','RUC_EMPRESA','ID_LOCAL',$axid_local);
$nom_rzn_soc_rem= get_row('LOCALES','RAZON_SOCIAL','ID_LOCAL',$axid_local);
$cod_tip_nif_rem=get_row('LOCALES','cod_tip_nif_rem','ID_LOCAL',$axid_local);


$axid_beneficiario = get_row('MAESTRO_CZ','ID_BENEFICIARIO','COD_MOV',$axcod_mov_cz);


$num_iden_prov='';
$nom_rzn_soc_prov='';
$cod_tip_nif_prov='';

$fec_emis= $_POST['txtfecha_emision_guia']; 	
$hora_emis = date('H:i:s');

	$num_ruc_dest  = get_row('BENEFICIARIOS','RUC_BENEF','ID_BENEFICIARIO',$axid_beneficiario);
	$nom_rzn_soc_dest= get_row('BENEFICIARIOS','RAZON_SOCIAL','ID_BENEFICIARIO',$axid_beneficiario);
	$cod_tip_nif_dest= get_row('BENEFICIARIOS','ID_DOC','ID_BENEFICIARIO',$axid_beneficiario);

	$cod_ubi_partida=get_row('LOCALES','cod_ubi_partida','ID_LOCAL',$axid_local);
	

	$txt_domicilio_partida=get_row('LOCALES','txt_domicilio_partida','ID_LOCAL',$axid_local);
	$txt_domicilio_llegada=get_row('BENEFICIARIOS_UBIGEOS','DIR_LLEGADA','ID_BENEFICIARIO',$axid_beneficiario);
	$cod_ubi_llegada=get_row('BENEFICIARIOS_UBIGEOS','cod_ubi_llegada','ID_BENEFICIARIO',$axid_beneficiario);
	



$axid_agencia = get_row('PEDIDOS','ID_AGENCIA','NUM_PEDIDO',$axnum_pedido);
$axfiltro = '20';
$axdesc_traslado = get_row_two('CATALOGOS_SUNAT','DESCRIPCION_CATALOGO','COD_CATALOGO','FILTRO',$cod_mot_trasalado,$axfiltro);
//echo 'xxx-'.$axdesc_traslado;


//if($axid_agencia=='0' OR $axid_agencia==''){ //

	$trans_txt_nombre='';
	$trans_txt_ruc='';
	$trans_cod_tip_nif='';
	//$trans_fec_ini = get_row('PEDIDOS','FECHA_DESPACHO','NUM_PEDIDO',$axnum_pedido);
	$trans_fec_ini = $_POST['txtfecha_despacho_4']; 	
	$axtipo = "Transporte privado";

/*
}else{ 

	$trans_txt_nombre=get_row('TRANSPORTISTAS','NOM_AGENCIA','ID_AGENCIA',$axid_agencia);
	$trans_txt_ruc=get_row('TRANSPORTISTAS','RUC_AGENCIA','ID_AGENCIA',$axid_agencia);
	$trans_cod_tip_nif=get_row('TRANSPORTISTAS','ID_DOC','ID_AGENCIA',$axid_agencia);
	//$trans_fec_ini = get_row('PEDIDOS','FECHA_DESPACHO','NUM_PEDIDO',$axnum_pedido);
	$trans_fec_ini = $_POST['txtfecha_despacho_4']; 	
	
	$axtipo = "Transporte privado";

}
*/
$observaciones="la guia de remision tiene que ser llevada obligatoriamente";
$txt_desc_motiv_tras= $axdesc_traslado.'-'.$axtipo;
$dato_extra_1="";
$dato_extra_2="";
$dato_extra_3="";
$dato_extra_4="";
$vrs_guia='2.0';


$cant_bultos_expor = 0;
$cod_unid_peso_bruto = 'KGM';
$mnt_tot_peso_bruto=get_row_two('GUIAS_BULTOS','PESO','NUM_PEDIDO','ID_LOCAL',$axnum_pedido,$axid_local);
//echo 'Monto Bultos: '.$mnt_tot_peso_bruto.'<br>';

if($mnt_tot_peso_bruto==0 || $mnt_tot_peso_bruto==''){

	$respuesta =8;
	echo $respuesta;

}else{

$SQLInsert = "INSERT INTO GUIA_REMISION_CZ (COD_MOV,COD_GUIA_CZ,ID_LOCAL,Identificador,cod_tip_cpe,txt_serie,txt_correlativo,cod_cliente_emis,num_ruc_rem,nom_rzn_soc_rem,cod_tip_nif_rem,num_ruc_dest,nom_rzn_soc_dest,cod_tip_nif_dest,num_iden_prov,nom_rzn_soc_prov,cod_tip_nif_prov,fec_emis,hora_emis,cod_ubi_partida,txt_domicilio_partida,txt_domicilio_llegada,cod_ubi_llegada,trans_txt_nombre,trans_txt_ruc,trans_cod_tip_nif,trans_fec_ini,cod_mot_trasalado,cant_bultos_expor,cod_unid_peso_bruto,mnt_tot_peso_bruto, trans_cod_tip_modalidad,observaciones,txt_desc_motiv_tras,dato_extra_1,dato_extra_2,dato_extra_3,dato_extra_4,vrs_guia) VALUES ('$axcod_mov_cz','$axcod_guia_cz','$axid_local','$Identificador','$cod_tip_cpe','$txt_serie','$txt_correlativo','$cod_cliente_emis','$num_ruc_rem','$nom_rzn_soc_rem','$cod_tip_nif_rem','$num_ruc_dest','$nom_rzn_soc_dest','$cod_tip_nif_dest','$num_iden_prov','$nom_rzn_soc_prov','$cod_tip_nif_prov','$fec_emis','$hora_emis','$cod_ubi_partida','$txt_domicilio_partida','$txt_domicilio_llegada','$cod_ubi_llegada','$trans_txt_nombre','$trans_txt_ruc','$trans_cod_tip_nif','$trans_fec_ini','$cod_mot_trasalado','$cant_bultos_expor','$cod_unid_peso_bruto','$mnt_tot_peso_bruto','$trans_cod_tip_modalidad','$observaciones','$txt_desc_motiv_tras','$dato_extra_1','$dato_extra_2','$dato_extra_3','$dato_extra_4','$vrs_guia')";
	//echo $SQLInsert;

	$RSInsert = odbc_exec($con,$SQLInsert);

	if($RSInsert){

			$SQLActualizar_correlativo = "UPDATE CORRELATIVOS SET N_CORRELATIVO='$txt_correlativo' WHERE COD_CORR='$txt_serie_cod'";
			$RSActualizar_correlativo = odbc_exec($con,$SQLActualizar_correlativo);

			$SQLActualizar_maestro = "UPDATE MAESTRO_CZ SET COD_GUIA_CZ='$axcod_guia_cz' WHERE COD_MOV='$axcod_mov_cz'";
			$RSActualizar_maestro = odbc_exec($con,$SQLActualizar_maestro);

			$SQLActualizar_pedidos = "UPDATE PEDIDOS SET COD_GUIA_CZ='$axcod_guia_cz' WHERE NUM_PEDIDO='$axnum_pedido'";
			$RSActualizar_pedidos = odbc_exec($con,$SQLActualizar_pedidos);
		
			$SQLPedidos_dt = "SELECT * FROM PEDIDOS_DT WHERE NUM_PEDIDO='$axnum_pedido' order by ID_PEDIDO ASC";
			$RSpedidos_dt = odbc_exec($con,$SQLPedidos_dt);

			while ($fila = odbc_fetch_array($RSpedidos_dt)) {
				
				$it = $it+1;	

				
				$num_lin_item = $it;
				$cod_unid_item = $fila['PRESENTACION'];
				$cant_unid_item = $fila['CANT_SALIDA'];
				$val_vta_item = 0;
				$cod_tip_afect_igv_item =0;
				$prc_vta_unit_item =0;
				$mnt_dscto_item = 0;
				$mnt_igv_item = 0;
				$txt_descr_item = $fila['NOM_PRODUCTO'];
				$cod_prod_sunat = '00000000';
				$cod_item = $fila['COD_PRODUCTO'];
				$val_unit_item = 0;
				$mnt_isc_item = 0;
				$importe_total_item = 0;
				$val_unit_icbper = 0;
				$cant_icbper_item = 0;
				$mnt_icbper_item = 0;
				$dato_extra_1 ='';
				$dato_extra_2 ='';
				$cod_gtin = '';

				$SQLInsert = "INSERT INTO GUIA_REMISION_DT (COD_GUIA_CZ,num_lin_item,cod_unid_item,cant_unid_item,val_vta_item,cod_tip_afect_igv_item,prc_vta_unit_item,mnt_dscto_item,mnt_igv_item,txt_descr_item,cod_prod_sunat,cod_item,val_unit_item,mnt_isc_item,importe_total_item,val_unit_icbper,cant_icbper_item,mnt_icbper_item,dato_extra_1,dato_extra_2,cod_gtin) VALUES ('$axcod_guia_cz','$num_lin_item','$cod_unid_item','$cant_unid_item','$val_vta_item','$cod_tip_afect_igv_item','$prc_vta_unit_item','$mnt_dscto_item','$mnt_igv_item','$txt_descr_item','$cod_prod_sunat','$cod_item','$val_unit_item','$mnt_isc_item','$importe_total_item','$val_unit_icbper','$cant_icbper_item','$mnt_icbper_item','$dato_extra_1','$dato_extra_2','$cod_gtin')";
				$RSInsert = odbc_exec($con,$SQLInsert);

			}

			$respuesta =0;
			echo $respuesta;



	}else{

		$respuesta =1;
			echo $respuesta;

	}
	
}

break;

case '96':
	
$axcodmovcz = trim($_POST['txtcod_mov_cz']);
$axidlocal= $_POST['txtid_local'];

$axcod_guia_cz = get_row('GUIA_REMISION_CZ','COD_GUIA_CZ','COD_MOV',$axcodmovcz);

$axcod_cliente_emis= get_row('LOCALES','cod_cliente_emis','ID_LOCAL',$axidlocal);
$axruta= get_row('LOCALES','RUTA_JSON','ID_LOCAL',$axidlocal);
$axtoken= get_row('LOCALES','TOKEN_EMPRESA','ID_LOCAL',$axidlocal);
$axurl= get_row('LOCALES','URL_PRODUCCION','ID_LOCAL',$axidlocal);
//$axurl= get_row('LOCALES','URL_PRUEBAS','ID_LOCAL',$axidlocal);

$SQLDatos_1 ="SELECT TOP 1 * FROM GUIA_REMISION_CZ WHERE COD_GUIA_CZ='$axcod_guia_cz' AND ID_LOCAL='$axidlocal'";
$RSDatos_1=odbc_exec($con,$SQLDatos_1);
$row=odbc_fetch_array($RSDatos_1);
			
	$axrucempresa= $row['num_ruc_rem'];
	$axtipodoc= $row['cod_tip_cpe'];
	$axnserie= $row['txt_serie'];
	$axcorrelativo= $row['txt_correlativo'];
	$axdocumento_tipo= $row['DETALLE_DOC'];

	$LblNombreArchivo = $axrucempresa.'-'.$axtipodoc.'-'.$axnserie.'-'.$axcorrelativo.'.json';
	//echo $LblNombreArchivo;



$response=array();

$SQLDatosCZ ="SELECT top 1 Identificador,cod_tip_cpe,txt_serie,txt_correlativo,cod_cliente_emis,num_ruc_rem,nom_rzn_soc_rem,cod_tip_nif_rem,num_ruc_dest,nom_rzn_soc_dest,cod_tip_nif_dest,num_iden_prov,nom_rzn_soc_prov,cod_tip_nif_prov,fec_emis,hora_emis,cod_ubi_partida,txt_domicilio_partida,txt_domicilio_llegada,cod_ubi_llegada,trans_txt_nombre,trans_txt_ruc,trans_cod_tip_nif,trans_fec_ini,cod_mot_trasalado,cant_bultos_expor,cod_unid_peso_bruto,mnt_tot_peso_bruto,trans_cod_tip_modalidad,observaciones,txt_desc_motiv_tras,dato_extra_1,dato_extra_2,dato_extra_3,dato_extra_4,vrs_guia FROM GUIA_REMISION_CZ WHERE COD_GUIA_CZ='$axcod_guia_cz'";

$RSDatosCZ=odbc_exec($con,$SQLDatosCZ);
//echo $SQLDatosCZ;


$filacz = odbc_fetch_array($RSDatosCZ);

$SQLDatosDT ="SELECT num_lin_item,cod_unid_item,cant_unid_item,val_vta_item,cod_tip_afect_igv_item,prc_vta_unit_item,mnt_dscto_item,mnt_igv_item,txt_descr_item,cod_prod_sunat,cod_item,val_unit_item,mnt_isc_item,importe_total_item,val_unit_icbper,cant_icbper_item,mnt_icbper_item,dato_extra_1,dato_extra_2,cod_gtin FROM GUIA_REMISION_DT WHERE COD_GUIA_CZ='$axcod_guia_cz'";


$RSDatosDT=odbc_exec($con,$SQLDatosDT);
$axnum = odbc_num_rows($RSDatosDT);

for ($i=0; $i < $axnum ; $i++) { 
		
	$filaDT = odbc_fetch_array($RSDatosDT);
	$jsonDT_D[$i] = $filaDT;
}


$SQLVehiculos ="SELECT veh_iden,veh_txt_placa,veh_tarj_unic_circ,veh_reg_mtc,veh_ent_emt_auto,veh_num_autoriza FROM documentoVehiculo_json WHERE COD_GUIA_CZ='$axcod_guia_cz'";
$RSVehiculos=odbc_exec($con,$SQLVehiculos);
$axnum_v = odbc_num_rows($RSVehiculos);

for ($v=0; $v < $axnum_v ; $v++) { 
		
	$fila_V = odbc_fetch_array($RSVehiculos);
	$jsonDT_V[$v] = $fila_V;
}


$SQLChoferes ="SELECT con_iden,con_tip_iden,con_num_iden,con_nombre,con_apellido,con_num_lic FROM documentoConductor_json WHERE COD_GUIA_CZ='$axcod_guia_cz'";
$RSChoferes=odbc_exec($con,$SQLChoferes);
$axnum_c = odbc_num_rows($RSChoferes);

for ($c=0; $c < $axnum_c ; $c++) { 
		
	$fila_c = odbc_fetch_array($RSChoferes);
	$jsonDT_C[$c] = $fila_c;
}


$SQLIndicadores ="SELECT ind_nom FROM indicadores_json WHERE COD_GUIA_CZ='$axcod_guia_cz'";
$RSIndicadores=odbc_exec($con,$SQLIndicadores);
$axnum_i = odbc_num_rows($RSIndicadores);

for ($d=0; $d < $axnum_i ; $d++) { 
		
	$fila_ind = odbc_fetch_array($RSIndicadores);
	$jsonDT_ind[$d] = $fila_ind;
}


$array1    = $filacz;
$array2['indicador'] = $jsonDT_ind;
$array3['documentoVehiculo'] = $jsonDT_V;
$array4['documentoConductor'] = $jsonDT_C;
$array5['detalles'] = $jsonDT_D;

$resultado = $array1 + $array2 + $array3+$array4+$array5;
//var_dump($resultado);

$jsonfinal_1 = json_encode($resultado,JSON_PRETTY_PRINT);	
$jsonfinal = preg_replace('#:"(\d+)"#', ':$1', $jsonfinal_1);

$file = $axruta.$LblNombreArchivo;  
file_put_contents($file, $jsonfinal);

if($axcod_cliente_emis !==''){

	$axnom_archivo = $axruta.$LblNombreArchivo;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $axurl);
	$parametros = @file_get_contents($axnom_archivo);

	//echo $parametros;

	curl_setopt( $ch, CURLOPT_POSTFIELDS, $parametros);
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization: '.$axtoken));
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	$result = curl_exec($ch);
	$codigoRespuesta = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	if($codigoRespuesta === 200){
	    
		$SQLActualizar = "UPDATE GUIA_REMISION_CZ SET BOUCHER_DIGITAL='$LblNombreArchivo',ESTADO_ELECTRO='PROCESADA',ESTADO_ENVIADO_ITC='ENVIADO' WHERE COD_MOV='$axcodmovcz'";
		$RSActualizar = odbc_exec($con, $SQLActualizar);
	
	}else{

    $SQLActualizar = "UPDATE GUIA_REMISION_CZ SET BOUCHER_DIGITAL='$LblNombreArchivo',ESTADO_ELECTRO='PENDIENTE',ESTADO_ENVIADO_ITC='PENDIENTE' WHERE COD_MOV='$axcodmovcz'";
		$RSActualizar = odbc_exec($con, $SQLActualizar);
	
	}
	curl_close($ch);

	}else{

		$SQLActualizar = "UPDATE GUIA_REMISION_CZ SET BOUCHER_DIGITAL='$LblNombreArchivo',ESTADO_ELECTRO='PROCESADA',ESTADO_ENVIADO_ITC='PENDIENTE' WHERE COD_MOV='$axcodmovcz'";
		$RSActualizar = odbc_exec($con, $SQLActualizar);	

		$respuesta = 0;
		echo $respuesta;
	}


break;
case '97':
	
$axbuscaregistro = $_POST['txtbuscar_prod_inventario']; 	
$axid_local = $_POST['txtid_local']; 	
$axfecha_del = $_POST['txtfecha_del']; 	
$axfecha_al = $_POST['txtfecha_al']; 	
$axperiodo_actual = $_POST['txtperiodo_inventario']; 	

$axmes_antes = intval(substr($axperiodo_actual,0,2))-1;
$axperiodo_anterior = number_pad($axmes_antes,2,0).'-'.substr($axperiodo_actual,3,4); //03-2023

//echo $axperiodo_anterior;

$axfitro_f = $_POST['txtfitrar_f']; 	

	$SQLEliminar_P = "DELETE FROM PRODUCTOS_INVENTARIOS WHERE ESTADO_PERIODO='ABIERTO' AND PERIODO_INVENTARIO='$axperiodo_actual'";
	$RSEliminar_P = odbc_exec($con,$SQLEliminar_P);

	$SQLEliminar_v = "DELETE FROM VERIFICACION_PONDERADO WHERE ESTADO_PERIODO='ABIERTO' AND PERIODO_INVENTARIO='$axperiodo_actual'";
	$RSEliminar_v = odbc_exec($con,$SQLEliminar_v);

	$SQLEliminar_d = "DELETE FROM VERIFICACION_DETALLE WHERE ESTADO_PERIODO='ABIERTO' AND PERIODO_INVENTARIO='$axperiodo_actual'";
	$RSEliminar_d = odbc_exec($con,$SQLEliminar_d);

	


	if($axfitro_f=='TODOS'){

/************BUSCAR PRECIOS PROMEDIO EN EL MES ANTERIOR************************/	
	$SQLBuscar_antes ="SELECT ID_PRODUCTO,COD_PRODUCTO FROM INVENTARIO_SEGUN_FECHAS_1 WHERE FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY ID_PRODUCTO,COD_PRODUCTO";
	$RSBuscar_antes = odbc_exec($con,$SQLBuscar_antes);

	if(odbc_num_rows($RSBuscar_antes) > 0){

		while ($fila_antes = odbc_fetch_array($RSBuscar_antes)) {
			
			$axcod_producto_antes = $fila_antes['COD_PRODUCTO'];
			$axid_producto_antes = $fila_antes['ID_PRODUCTO'];

			$sqlsaldo_anterior = "SELECT * FROM PRODUCTOS_INVENTARIOS WHERE ID_PRODUCTO='$axid_producto_antes' AND PERIODO_INVENTARIO='$axperiodo_anterior'";
			$rssaldo_antes = odbc_exec($con,$sqlsaldo_anterior);
			//echo $sqlsaldo_anterior.'<br>';
			
				if(odbc_num_rows($rssaldo_antes) > 0){

					while ($fila_antes = odbc_fetch_array($rssaldo_antes)) {

						$axid_producto = $fila_antes['ID_PRODUCTO'];
						$axdetalle_movimiento = 'COMPRA';
						$axfecha_emision = $axfecha_al;
						$axcant_ingreso = $fila_antes['STOCK_ACTUAL'];
						$axcosto_producto = $fila_antes['PRC_COMPRA_PROM'];
						$axtotal_ingreso = $axcant_ingreso*$axcosto_producto;
						$axvalor_ingreso = 0;
						$axestado_inventario = '';
						$axcod_mov = '';
						$axcomprobante = 'PERIODO ANTERIOR - '.$axperiodo_anterior;						

						$sqlinserta_v = "INSERT INTO VERIFICACION_PONDERADO (ID_PRODUCTO,DETALLE_MOVIMIENTO,FECHA_EMISION,CANT_INGRESO,COSTO_PRODUCTO,TOTAL_INGRESO,VALOR_INGRESO,ESTADO_INVENTARIO,COD_MOV,COMPROBANTE,PERIODO_INVENTARIO,ESTADO_PERIODO) VALUES ('$axid_producto','$axdetalle_movimiento','$axfecha_emision','$axcant_ingreso','$axcosto_producto','$axtotal_ingreso','$axvalor_ingreso','$axestado_inventario','$axcod_mov','$axcomprobante','$axperiodo_actual','ABIERTO')";
						$rsinserta_v = odbc_exec($con,$sqlinserta_v);
						//echo $sqlinserta_v;

				
					}
				}
			}
	}

	/****************SACAR EL STOCK DEL PERIODO ANTERIOR Y GRABARLO EN EL PERIODO ACTUAL********************/

	$SQLBuscar_antes ="SELECT ID_PRODUCTO,COD_PRODUCTO FROM INVENTARIO_SEGUN_FECHAS_1 WHERE FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY ID_PRODUCTO,COD_PRODUCTO";
	$RSBuscar_antes = odbc_exec($con,$SQLBuscar_antes);

	if(odbc_num_rows($RSBuscar_antes) > 0){

		while ($fila_antes = odbc_fetch_array($RSBuscar_antes)) {
			
			$axcod_producto_antes = $fila_antes['COD_PRODUCTO'];
			$axid_producto_antes = $fila_antes['ID_PRODUCTO'];

			$sqlsaldo_anterior = "SELECT * FROM PRODUCTOS_INVENTARIOS WHERE ID_PRODUCTO='$axid_producto_antes' AND PERIODO_INVENTARIO='$axperiodo_anterior'";
			$rssaldo_antes = odbc_exec($con,$sqlsaldo_anterior);
			//echo $sqlsaldo_anterior.'<br>';
			
				if(odbc_num_rows($rssaldo_antes) > 0){

					while ($fila_antes_s = odbc_fetch_array($rssaldo_antes)) {

									
						$detalle_movimiento = 'COMPRA';
						$tipo_mov = 'INGRESO';						
						$fecha_emision = $axfecha_al;						
						$id_local = $fila_antes_s['ID_LOCAL'];
						$num_pedido = '';
						$nom_comercial = 'SALDO PERIODO ANTERIOR - '.$axperiodo_anterior;
						$id_producto = $fila_antes_s['ID_PRODUCTO'];
						$cod_producto = $fila_antes_s['COD_PRODUCTO'];
						$ingreso = $fila_antes_s['STOCK_ACTUAL'];

						if($ingreso==''){
						$ingreso = 0;							
						}

						$prs_compra = $fila_antes_s['PRC_COMPRA_PROM'];
						$salida = 0;
						$prs_venta = 0;
						$stock = 0;						
						$estado_periodo = 'ABIERTO';
						$estado_inventario='INVENTARIO';
			

						$sqlinserta_DT = "INSERT INTO VERIFICACION_DETALLE  (DETALLE_MOVIMIENTO,TIPO_MOV,FECHA_EMISION,ID_LOCAL,NUM_PEDIDO,NOM_COMERCIAL,ID_PRODUCTO,COD_PRODUCTO,INGRESO,PRS_COMPRA,SALIDA,PRS_VENTA,STOCK,ESTADO_INVENTARIO,COD_MOV,COMPROBANTE,VALOR_INGRESO,TOTAL_INGRESO,PERIODO_INVENTARIO,ESTADO_PERIODO,NUM_ORDEN) VALUES ('$detalle_movimiento','$tipo_mov','$fecha_emision','$id_local','$num_pedido','$nom_comercial','$id_producto','$cod_producto','$ingreso','$prs_compra','$salida','$prs_venta','$stock','$estado_inventario','','',0,0,'$axperiodo_actual','$estado_periodo','0')";
						//echo $sqlinserta_DT.'<br>';
						$RSInsert_DT = odbc_exec($con,$sqlinserta_DT);

				
					}
				}
			}
	}

	/******************EL DETALLE DE ESOS INGRESOS Y EGRESOS GUARDALOS EN LA TABLA PARA LOS REPORTES*************************/


	$SQLBuscar_productos_D ="SELECT ID_PRODUCTO,COD_PRODUCTO FROM INVENTARIO_SEGUN_FECHAS_1 WHERE FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY ID_PRODUCTO,COD_PRODUCTO";
	$RSBuscar_productos_D = odbc_exec($con,$SQLBuscar_productos_D);

	if(odbc_num_rows($RSBuscar_productos_D) > 0){

		while ($fila_d = odbc_fetch_array($RSBuscar_productos_D)) {
			
			$axcod_producto_d = $fila_d['COD_PRODUCTO'];
			$axid_producto_d = $fila_d['ID_PRODUCTO'];


			$sqlsaldo_anterior = "SELECT * FROM VERIFICACIONES_1 WHERE FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' AND ID_PRODUCTO='$axid_producto_d' ORDER BY NUM_PEDIDO ASC";
			$rssaldo_antes = odbc_exec($con,$sqlsaldo_anterior);
			//echo $sqlsaldo_anterior.'<br>';
			
				if(odbc_num_rows($rssaldo_antes) > 0){

					while ($fila_dt = odbc_fetch_array($rssaldo_antes)) {

						$it=$it+1;
						$detalle_movimiento = $fila_dt['DETALLE_MOVIMIENTO'];
						$tipo_mov = $fila_dt['TIPO_MOV'];
						$fecha_emision = $fila_dt['FECHA_EMISION'];
						$id_local = $fila_dt['ID_LOCAL'];
						$num_pedido = $fila_dt['NUM_PEDIDO'];
						$nom_comercial = $fila_dt['NOM_COMERCIAL'];
						$id_producto = $fila_dt['ID_PRODUCTO'];
						$cod_producto = $fila_dt['COD_PRODUCTO'];
						$ingreso = $fila_dt['INGRESO'];
						$prs_compra = $fila_dt['PRS_COMPRA'];
						$salida = $fila_dt['SALIDA'];
						$prs_venta = $fila_dt['PRS_VENTA'];

						if($prs_venta==''){
						$prs_venta = 0;							
						}

						$stock = $fila_dt['STOCK'];
						$estado_inventario = $fila_dt['ESTADO_INVENTARIO'];
						$cod_mov = $fila_dt['COD_MOV'];
						$comprobante = $fila_dt['COMPROBANTE'];
						$valor_ingreso = $fila_dt['VALOR_INGRESO'];
						$total_ingreso = $fila_dt['TOTAL_INGRESO'];
						$periodo_inventario = $fila_dt['PERIODO_INVENTARIO'];
						$estado_periodo = 'ABIERTO';

						$sqlinserta_D = "INSERT INTO VERIFICACION_DETALLE  (DETALLE_MOVIMIENTO,TIPO_MOV,FECHA_EMISION,ID_LOCAL,NUM_PEDIDO,NOM_COMERCIAL,ID_PRODUCTO,COD_PRODUCTO,INGRESO,PRS_COMPRA,SALIDA,PRS_VENTA,STOCK,ESTADO_INVENTARIO,COD_MOV,COMPROBANTE,VALOR_INGRESO,TOTAL_INGRESO,PERIODO_INVENTARIO,ESTADO_PERIODO,NUM_ORDEN) VALUES ('$detalle_movimiento','$tipo_mov','$fecha_emision','$id_local','$num_pedido','$nom_comercial','$id_producto','$cod_producto','$ingreso','$prs_compra','$salida','$prs_venta','$stock','$estado_inventario','$cod_mov','$comprobante','$valor_ingreso','$total_ingreso','$axperiodo_actual','$estado_periodo','$it')";
						//echo $sqlinserta_D.'<br>';
						$RSInsert_D = odbc_exec($con,$sqlinserta_D);

					}

				}
			}
	}
	
	/*******AGRUPA LOS INGRESOS Y EGRESOS Y SACA EL SCTOCK DE CADA PRODCUTO*************************/
	$SQLBuscar ="SELECT ID_PRODUCTO,COD_PRODUCTO FROM INVENTARIO_SEGUN_FECHAS_1 WHERE FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY ID_PRODUCTO,COD_PRODUCTO";
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	//echo $SQLBuscar;

	if(odbc_num_rows($RSBuscar) > 0){

		while ($fila = odbc_fetch_array($RSBuscar)) {
			
			$axcod_producto = $fila['COD_PRODUCTO'];
			$axid_producto = $fila['ID_PRODUCTO'];

			$SQLBuscar_1 = "SELECT COD_PRODUCTO,SUM(INGRESO) AS ING, SUM(SALIDA) AS SAL, SUM(INGRESO-SALIDA) AS ST FROM VERIFICACION_DETALLE WHERE FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' AND ID_PRODUCTO='$axid_producto' GROUP BY COD_PRODUCTO";
			$RSBuscar_1 = odbc_exec($con,$SQLBuscar_1);
			$fila_1 = odbc_fetch_array($RSBuscar_1);
			//echo $SQLBuscar_1.'<br>';

			$axcod_producto = $fila_1['COD_PRODUCTO'];
			$axnom_producto = get_row('PRODUCTOS','NOM_PRODUCTO','ID_PRODUCTO',$axid_producto);
			$axingresos = $fila_1['ING'];
			$axsalidas = $fila_1['SAL'];
			$axstock = $fila_1['ST'];

			$axcosto = $fila_1['CV'];
			if($axcosto==''){
				$axcosto=0;
			}

			$axprc_venta = $fila_1['PV'];
			if($axprc_venta==''){
				$axprc_venta=0;
			}

			$axtitulo = 'Fecha del: '. date('d-m-Y',strtotime($axfecha_del)).' al '.date('d-m-Y',strtotime($axfecha_al));

			$sqlinserta = "INSERT INTO PRODUCTOS_INVENTARIOS (TITULO,ID_PRODUCTO,COD_PRODUCTO,NOM_PRODUCTO,INGRESOS,SALIDAS,STOCK_ACTUAL,ESTADO_PERIODO,PERIODO_INVENTARIO) values ('$axtitulo','$axid_producto','$axcod_producto','$axnom_producto','$axingresos','$axsalidas','$axstock','ABIERTO','$axperiodo_actual')";			
			$rsinserta = odbc_exec($con,$sqlinserta);
			//echo $sqlinserta.'<br>';
		
		}
	}


/**COSTO PROMEDIO PONDERADO DEL PRODUCTO ***/

$SQLTraer = "SELECT ID_PRODUCTO,COD_PRODUCTO FROM INVENTARIO_SEGUN_FECHAS_1 WHERE FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' AND PRS_COMPRA > 0 GROUP BY ID_PRODUCTO,COD_PRODUCTO";
$RSTraer = odbc_exec($con,$SQLTraer);

while ($row = odbc_fetch_array($RSTraer)) {
	
	$axid_producto_p = $row['ID_PRODUCTO'];

	$SQLVerifica = "SELECT * FROM VERIFICACIONES_1 WHERE ID_PRODUCTO='$axid_producto_p' AND FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' AND PRS_COMPRA > 0 ORDER BY FECHA_EMISION ASC";
	$RSVerifica = odbc_exec($con,$SQLVerifica);

	while ($fila_v = odbc_fetch_array($RSVerifica)) {
		
		$axid_producto = $fila_v['ID_PRODUCTO'];
		$axdetalle_movimiento = $fila_v['DETALLE_MOVIMIENTO'];
		$axfecha_emision = $fila_v['FECHA_EMISION'];
		$axcant_ingreso = $fila_v['INGRESO'];
		$axcosto_producto = $fila_v['PRS_COMPRA'];
		$axtotal_ingreso = $fila_v['TOTAL_INGRESO'];
		$axvalor_ingreso = $fila_v['VALOR_INGRESO'];
		$axestado_inventario = $fila_v['ESTADO_INVENTARIO'];
		$axcod_mov = $fila_v['COD_MOV'];
		$axcomprobante = $fila_v['COMPROBANTE'];
		

		$sqlinserta_v = "INSERT INTO VERIFICACION_PONDERADO (ID_PRODUCTO,DETALLE_MOVIMIENTO,FECHA_EMISION,CANT_INGRESO,COSTO_PRODUCTO,TOTAL_INGRESO,VALOR_INGRESO,ESTADO_INVENTARIO,COD_MOV,COMPROBANTE,PERIODO_INVENTARIO,ESTADO_PERIODO) VALUES ('$axid_producto','$axdetalle_movimiento','$axfecha_emision','$axcant_ingreso','$axcosto_producto','$axtotal_ingreso','$axvalor_ingreso','$axestado_inventario','$axcod_mov','$axcomprobante','$axperiodo_actual','ABIERTO')";
		$rsinserta_v = odbc_exec($con,$sqlinserta_v);
		//echo $sqlinserta_v;

	}

	$sqlbuscar_precio = "SELECT SUM(CANT_INGRESO) AS CANT,SUM(TOTAL_INGRESO) AS TT,SUM(TOTAL_INGRESO)/SUM(CANT_INGRESO) AS PP FROM VERIFICACION_PONDERADO WHERE COSTO_PRODUCTO > 0 AND ID_PRODUCTO='$axid_producto_p' AND PERIODO_INVENTARIO='$axperiodo_actual' GROUP BY ID_PRODUCTO ORDER BY ID_PRODUCTO ASC";


	$rsBuscar_precio = odbc_exec($con,$sqlbuscar_precio);	
	$fila_p =odbc_fetch_array($rsBuscar_precio);
	//echo $sqlbuscar_precio.'<br>';

		$axprs_promedio = $fila_p['PP'];

		if($axprs_promedio==''){
			$axprs_promedio =0;
		}

		$axverifica = get_row_two('PRODUCTOS_INVENTARIOS','ID_PRODUCTO','ID_PRODUCTO','PERIODO_INVENTARIO',$axid_producto_p,$axperiodo_actual);

			if($axverifica !==''){
				$sqlinserta  ="UPDATE PRODUCTOS_INVENTARIOS SET PRC_COMPRA_PROM='$axprs_promedio' WHERE ID_PRODUCTO='$axid_producto_p' AND PERIODO_INVENTARIO='$axperiodo_actual'";
				$rsinserta = odbc_exec($con,$sqlinserta);
				//echo $sqlinserta;
			}	
}



/*********************************************************************************************************************/

	
}else if($axfitro_f=='LOGICO'){

	//FILTRO TODOS LOS PEDIDOS PROGRAMADOS, REVISION, ATENDIDOS, PENDIENTES
	$SQLBuscar_p ="SELECT ID_PRODUCTO,NOM_PRODUCTO,SUM(CANT_SALIDA) AS SAL FROM CANT_PEDIDOS_INVENTARIO WHERE FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY ID_PRODUCTO,NOM_PRODUCTO  ORDER BY ID_PRODUCTO ASC";
	$RSBuscar_p = odbc_exec($con,$SQLBuscar_p);
	//echo $SQLBuscar;

	if(odbc_num_rows($RSBuscar_p) > 0){

		while ($fila_p = odbc_fetch_array($RSBuscar_p)) {

			$axid_producto = $fila_p['ID_PRODUCTO'];
			$axcod_producto = get_row('PRODUCTOS','COD_PRODUCTO','ID_PRODUCTO',$axid_producto);
			$axnom_producto = $fila_p['NOM_PRODUCTO'];
			$axsalidas = $fila_p['SAL'];	
			$axingresos=0;
			$axstock=0;
			$axcosto=0;
			$axprc_venta=0;

			$axtitulo = 'Fecha del: '. date('d-m-Y',strtotime($axfecha_del)).' al '.date('d-m-Y',strtotime($axfecha_al));

			$sqlinserta = "INSERT INTO PRODUCTOS_INVENTARIOS (TITULO,ID_PRODUCTO,COD_PRODUCTO,NOM_PRODUCTO,INGRESOS,SALIDAS,STOCK_ACTUAL,PRC_COMPRA_PROM,PRC_VENTA_PROM) values ('$axtitulo','$axid_producto','$axcod_producto','$axnom_producto','$axingresos','$axsalidas','$axstock','$axcosto','$axprc_venta')";			
			$rsinserta = odbc_exec($con,$sqlinserta);
		}
	}

	//FILTRO TODOS LAS COMPRAS
	$SQLBuscar_p ="SELECT ID_PRODUCTO,NOM_PRODUCTO,SUM(CANT_INGRESO) AS ING FROM CANT_COMPRAS_INVENTARIO  WHERE FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY ID_PRODUCTO,NOM_PRODUCTO ORDER BY ID_PRODUCTO ASC";
	$RSBuscar_p = odbc_exec($con,$SQLBuscar_p);
	//echo $SQLBuscar;

	if(odbc_num_rows($RSBuscar_p) > 0){

		while ($fila_p = odbc_fetch_array($RSBuscar_p)) {

			$axid_producto = $fila_p['ID_PRODUCTO'];
			$axcod_producto = get_row('PRODUCTOS','COD_PRODUCTO','ID_PRODUCTO',$axid_producto);
			$axnom_producto = $fila_p['NOM_PRODUCTO'];
			$axsalidas = 0;	
			$axingresos=$fila_p['ING'];	
			$axstock=0;
			$axcosto=0;
			$axprc_venta=0;
			$axtitulo = 'Fecha del: '. date('d-m-Y',strtotime($axfecha_del)).' al '.date('d-m-Y',strtotime($axfecha_al));

			$axverifica = get_row('PRODUCTOS_INVENTARIOS','ID_PRODUCTO','ID_PRODUCTO',$axid_producto);
			if($axverifica !==''){
				
				$sqlinserta  ="UPDATE PRODUCTOS_INVENTARIOS SET INGRESOS='$axingresos' WHERE ID_PRODUCTO='$axid_producto'";

			}else{

				$sqlinserta = "INSERT INTO PRODUCTOS_INVENTARIOS (TITULO,ID_PRODUCTO,COD_PRODUCTO,NOM_PRODUCTO,INGRESOS,SALIDAS,STOCK_ACTUAL,PRC_COMPRA_PROM,PRC_VENTA_PROM) values ('$axtitulo','$axid_producto','$axcod_producto','$axnom_producto','$axingresos','$axsalidas','$axstock','$axcosto','$axprc_venta')";				

			}
			$rsinserta = odbc_exec($con,$sqlinserta);
		}
	}


	}else{


	$SQLBuscar ="SELECT ID_PRODUCTO,COD_PRODUCTO FROM INVENTARIO_SEGUN_FECHAS WHERE ID_LOCAL='$axid_local' AND FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY ID_PRODUCTO,COD_PRODUCTO";
	$RSBuscar = odbc_exec($con,$SQLBuscar);

	if(odbc_num_rows($RSBuscar) > 0){

		while ($fila = odbc_fetch_array($RSBuscar)) {
			
			$axcod_producto = $fila['COD_PRODUCTO'];
			$axid_producto = $fila['ID_PRODUCTO'];

			$SQLBuscar_1 = "SELECT COD_PRODUCTO,NOM_PRODUCTO,SUM(INGRESO) AS ING, SUM(SALIDA) AS SAL, SUM(STOCK) AS ST,AVG(COSTO_PRODUCTO) AS CV, AVG(PRS_VENTA) AS PV FROM INVENTARIO_SEGUN_FECHAS WHERE ID_LOCAL='$axid_local' AND FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' AND COD_PRODUCTO='$axcod_producto' GROUP BY COD_PRODUCTO,NOM_PRODUCTO";
			$RSBuscar_1 = odbc_exec($con,$SQLBuscar_1);
			$fila_1 = odbc_fetch_array($RSBuscar_1);

			$axcod_producto = $fila_1['COD_PRODUCTO'];
			$axnom_producto = $fila_1['NOM_PRODUCTO'];
			$axingresos = $fila_1['ING'];
			$axsalidas = $fila_1['SAL'];
			$axstock = $fila_1['ST'];

			$axcosto = $fila_1['CV'];
			if($axcosto==''){
				$axcosto=0;
			}

			$axprc_venta = $fila_1['PV'];
			if($axprc_venta==''){
				$axprc_venta=0;
			}

			$axtitulo = 'Fecha del: '. date('d-m-Y',strtotime($axfecha_del)).' al '.date('d-m-Y',strtotime($axfecha_al));

			$sqlinserta = "INSERT INTO PRODUCTOS_INVENTARIOS (TITULO,ID_PRODUCTO,COD_PRODUCTO,NOM_PRODUCTO,INGRESOS,SALIDAS,STOCK_ACTUAL,PRC_COMPRA_PROM,PRC_VENTA_PROM,ID_LOCAL) values ('$axtitulo','$axid_producto','$axcod_producto','$axnom_producto','$axingresos','$axsalidas','$axstock','$axcosto','$axprc_venta','$axid_local')";			
			$rsinserta = odbc_exec($con,$sqlinserta);
			//echo $sqlinserta.'<br>';
		
		}

	}


	}



break;

case '98':
	
$axid_producto_padre = $_POST['txtid_producto']; 	
$axid_empresa = $_POST['txtid_empresa']; 	
$axid_local = $_POST['txtid_local']; 	

$SQLBuscar = "SELECT  * FROM PRODUCTOS_LISTADO_COMPLEMENTOS_CON_STOCK WHERE ID_PRODUCTO = '$axid_producto_padre' AND ID_LOCAL='$axid_local'";
		

	//echo "$SQLBuscar";

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th style='text-align: center;'>Id</th>			
			<th style='text-align: left;'>Descripción</th>			
			<th style='text-align: center;'>Salida</th>			
			<th style='text-align: right;'>Stock</th>			
			<!--th style='text-align: center;'>Acción</th-->			
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$id_producto = $fila['ID_PRODUCTO_COMP'];
 		$cod_producto = $fila['COD_PRODUCTO'];
		$nom_producto = $fila['NOM_PRODUCTO'];
		$axund = $fila['PRESENTACION'];
		$axcant_transf =  number_format($fila['CANT_TRANSF'],2,".",","); 
		$axstock = number_format($fila['STOCK_ACTUAL'],2,".",",");


 	echo "
 		<tr> 	
 		<td style='text-align: center;'>$id_producto</td> 
 		<td style='text-align: left;'>".$cod_producto.' | '.utf8_encode($nom_producto).' | '.$axund."</a></td> 
 		<td contenteditable style='text-align: center;' class='table-danger' id='btn_cantidad' data-id='$id_producto'><b>$axcant_transf</b></td>  
 		<td style='text-align: right;'>$axstock</td>  
 		
 		</tr>
 	";

}
echo "</table>";
}	


break;

case '99':
	
date_default_timezone_set("America/Lima");

$axid_producto_padre = $_POST['txtid_producto']; 	
$axid_local = $_POST['txtid_local']; 	
$axcodusuario = $_POST['txtcodusuario'];
$axcant_salida_transformar_ingreso= $_POST['txtcant_transformar_ingreso'];
$axruc_benef = get_row('LOCALES','RUC_EMPRESA','ID_LOCAL',$axid_local);
 
$SQLComplementos = "SELECT * FROM PRODUCTOS_LISTADO_COMPLEMENTOS WHERE ID_PRODUCTO='$axid_producto_padre'";
$RSComplementos = odbc_exec($con,$SQLComplementos);
//echo $SQLComplementos;

if(odbc_num_rows($RSComplementos) > 0){

	while ($fila = odbc_fetch_array($RSComplementos)) {
		
	$axid_producto_compl = $fila['ID_PRODUCTO_COMP'];
	//echo $axid_producto_compl.'<br>';

  /*GENERO COD_MOV*/		
	$axdni_user = get_row('usuarios','COD_USUARIO','ID_USUARIO',$axcodusuario);
	$logitudPass = 10;
	$axcod = substr($axdni_user,0,3);
	$nuevo_nombre_a = substr(md5(microtime()),1,$logitudPass);
	$nuevo_nombre = $axid_local.$axcod.$nuevo_nombre_a;
	$axcodmovcz = $nuevo_nombre;

	$axcod_mov_cz = trim($axcodmovcz);
	$axtipo_mov ='INGRESO';
	$axdetalle_movimiento ='VENTA';
	$axdetalle_movimiento_1 ='TRANSFORMACION';
	$axfecha_emision = date('Y-m-d');
	$axperiodo_emision = date('m-Y',strtotime($axfecha_emision));
	$axid_td = '12'; //NOTA DE SALIDA, NO CAMBIAR ESTE CODIGO
	
	$axtxt_serie = get_row_two('CORRELATIVOS','N_SERIE','ID_LOCAL','ID_TD',$axid_local,$axid_td);
	$axdocumento = get_row_two('CORRELATIVOS','N_CORRELATIVO','ID_LOCAL','ID_TD',$axid_local,$axid_td);
	$axid_serie= get_row_two('CORRELATIVOS','COD_CORR','ID_LOCAL','ID_TD',$axid_local,$axid_td);

	$axfecha_registro = $axfecha_emision;
	$axmotivo_devolucion ='0';
	$axhora_emision = date('H:i:s');
	$axano= date('Y',strtotime($axfecha_emision));

	$axglosa = 'TRANSFORMACION DE MERCADERIA';
	$axestado_electro ='PENDIENTE';
	$axperiodo_contable= date('m-Y',strtotime($axfecha_emision));

	$axfecha_referencia= $axfecha_emision;
	$axtxt_descr_mtvo_baja ='0';
	$axtxt_serie_ref = '0';
	$axtxt_correlativo_cpe_ref= '00000000';
	$axfec_emis_ref = $axfecha_emision;
	$axtxt_sustento= '0';
	$axcod_tip_nc_nd_ref='01';

	$axfecha_contable= $axfecha_emision;
	$axestado_final='PENDIENTE';
	$axcod_cpe_ref='0';
	$axestado_enviado_itc='PENDIENTE';

	$axcod_tip_frpago='1';
	$axmnto_crdt_ttal='0';
	$axmnto_crdt_cta='0';
	
	$axestado_envio_cliente='PENDIENTE';

	$axid_beneficiario  =get_row('BENEFICIARIOS','ID_BENEFICIARIO','RUC_BENEF',$axruc_benef);
	$axid_usuario  =$axcodusuario;
	$axtotal_venta =0;
	$axvalor_venta =0;
	$axigv =0;
	$axgravadas =0;
	$axinafectas =0;
	$axexoneradas =0;

	$axmoneda ='SOLES';
	$axmnt_tot_gravadas =0;
	$axmnt_tot_inafectas =0;
	$axmnt_tot_exoneradas =0;
	$axmnt_tot_gratuitas =0;
	$axmnt_tot =0;

$SQLInsert =  "INSERT INTO MAESTRO_CZ (COD_MOV,TIPO_MOV,DETALLE_MOVIMIENTO,FECHA_EMISION,PERIODO_EMISION,ID_TD,TXT_SERIE,DOCUMENTO,ID_BENEFICIARIO,ID_USUARIO,TOTAL_VENTA,FECHA_REGISTRO,MOTIVO_DEVOLUCION,HORA_EMISION,ANO,ID_LOCAL,GLOSA,VALOR_VENTA,IGV,GRAVADAS,INAFECTAS,EXONERADAS,PERIODO_CONTABLE,MONEDA,MNT_TOT_GRAVADAS,MNT_TOT_INAFECTAS,MNT_TOT_EXONERADAS,MNT_TOT_GRATUITAS,MNT_TOT,ESTADO_ELECTRO,FECHA_REFERENCIA,TXT_DESCR_MTVO_BAJA,txt_serie_ref,txt_correlativo_cpe_ref,fec_emis_ref,txt_sustento,cod_tip_nc_nd_ref,FECHA_CONTABLE,ESTADO_FINAL,COD_CPE_REF,ESTADO_ENVIADO_ITC,COD_TIP_FRPAGO,MNTO_CRDT_TTAL,MNTO_CRDT_CTA,ESTADO_ENVIO_CLIENTE,DETALLE_MOVIMIENTO_T) VALUES ('$axcod_mov_cz','$axtipo_mov','$axdetalle_movimiento','$axfecha_emision','$axperiodo_emision','$axid_td','$axtxt_serie','$axdocumento','$axid_beneficiario','$axid_usuario','$axtotal_venta','$axfecha_registro','$axmotivo_devolucion','$axhora_emision','$axano','$axid_local','$axglosa','$axvalor_venta','$axigv','$axgravadas','$axinafectas','$axexoneradas','$axperiodo_contable','$axmoneda','$axmnt_tot_gravadas','$axmnt_tot_inafectas','$axmnt_tot_exoneradas','$axmnt_tot_gratuitas','$axmnt_tot','$axestado_electro','$axfecha_referencia','$axtxt_descr_mtvo_baja','$axtxt_serie_ref','$axtxt_correlativo_cpe_ref','$axfec_emis_ref','$axtxt_sustento','$axcod_tip_nc_nd_ref','$axfecha_contable','$axestado_final','$axcod_cpe_ref','$axestado_enviado_itc','$axcod_tip_frpago','$axmnto_crdt_ttal','$axmnto_crdt_cta','$axestado_envio_cliente','$axdetalle_movimiento_1')";

	//echo $SQLInsert;

	$RSInsert = odbc_exec($con,$SQLInsert);
 
  if($RSInsert){

  	/*INSERTA EL DETALLE DE LA CABECERA*/
  	$axdocumento=$axdocumento+1;

  	$SQLActualizar_correlativo = "UPDATE CORRELATIVOS SET N_CORRELATIVO='$axdocumento' WHERE ID_LOCAL='$axid_local' AND COD_CORR='$axid_serie'";
		$RSActualizar_correlativo = odbc_exec($con,$SQLActualizar_correlativo);
		//echo $SQLActualizar_correlativo;

  	$it = $it+1;
			$axid_producto = $axid_producto_compl;
			$axcant_salida_transformar = get_row('PRODUCTOS_COMP','CANT_TRANSF','ID_PRODUCTO_COMP', $axid_producto_compl);
			$axcant_ingreso = 0;
			$axcosto_producto = get_row('PRODUCTOS','COSTO_PRODUCTO','ID_PRODUCTO',$axid_producto); 
			$axdsctos_ingreso = 0;
			$axvalor_ingreso = 0;
			$axigv_ingreso = 0;
			$axgravadas_ingreso = 0;
			$axinafecto_ingresos = 0;
			$axexonerado_ingreso = 0;
			$axtotal_ingreso = 0;
			$axcant_salida = $axcant_salida_transformar;
			$axprs_mayor = get_row('PRODUCTOS','PRS_MAYOR','ID_PRODUCTO',$axid_producto);
			$axprs_premiun =get_row('PRODUCTOS','PRS_PREMIUN','ID_PRODUCTO',$axid_producto); 
			$axprs_menor =get_row('PRODUCTOS','PRS_MENOR','ID_PRODUCTO',$axid_producto); 
			$axprs_venta =get_row('PRODUCTOS','COSTO_PRODUCTO','ID_PRODUCTO',$axid_producto); 
			$axdsctos_salida = 0;
			$axvalor_salida = ($axprs_venta/1.18)*($axcant_salida);
			$axigv_salida = $axvalor_salida*.18;
			$axgravadas_salida = $axvalor_salida;
			$axinafecto_salida = 0;
			$axexonerado_salida = 0;
			$axtotal_salida = $axvalor_salida+$axigv_salida;

			$axforma_pago = 'CONTADO';
			$axestado_forma_pago = 'CANCELADO';
			$axmedio_pago = 'EFECTIVO';
			$axnum_transf = '';
			$axpor_detraccion = 0;
			$axmonto_detraccion = 0;
			$axnum_detraccion = 0;
			$axfecha_detraccion =$axfecha_emision;
			$axestado_producto = 'BUENO';
			$axobservar = '0';

			$axfecha_transf = $axfecha_emision;
			$axid_cta = '';
			$axperiodo_transf = date('m-Y',strtotime($axfecha_transf));
			$axnum_lin_item = $it;

			$SQLInsert_dt = "INSERT INTO MAESTRO_DT (COD_MOV,ID_PRODUCTO,CANT_INGRESO,COSTO_PRODUCTO,DSCTOS_INGRESO,VALOR_INGRESO,IGV_INGRESO,GRAVADAS_INGRESO,INAFECTO_INGRESOS,EXONERADO_INGRESO,TOTAL_INGRESO,CANT_SALIDA,PRS_MAYOR,PRS_PREMIUN,PRS_MENOR,PRS_VENTA,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,FORMA_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,NUM_TRANSF,POR_DETRACCION,MONTO_DETRACCION,NUM_DETRACCION,FECHA_DETRACCION,ESTADO_PRODUCTO,OBSERVAR,FECHA_TRANSF,ID_CTA,PERIODO_TRANSF,NUM_LIN_ITEM) VALUES ('$axcod_mov_cz','$axid_producto','$axcant_ingreso','$axcosto_producto','$axdsctos_ingreso','$axvalor_ingreso','$axigv_ingreso','$axgravadas_ingreso','$axinafecto_ingresos','$axexonerado_ingreso','$axtotal_ingreso','$axcant_salida','$axprs_mayor','$axprs_premiun','$axprs_menor','$axprs_venta','$axdsctos_salida','$axvalor_salida','$axigv_salida','$axgravadas_salida','$axinafecto_salida','$axexonerado_salida','$axtotal_salida','$axforma_pago','$axestado_forma_pago','$axmedio_pago','$axnum_transf','$axpor_detraccion','$axmonto_detraccion','$axnum_detraccion','$axfecha_detraccion','$axestado_producto','$axobservar','$axfecha_transf','$axid_cta','$axperiodo_transf','$axnum_lin_item')";
				//echo $SQLInsert_dt.'<br>';
				$RSInsert_dt =odbc_exec($con,$SQLInsert_dt);

				$axtotal_venta =$axtotal_salida;
				$axvalor_venta =$axvalor_salida;
				$axigv =$axigv_salida;
				$axgravadas =$axvalor_venta;
				$axinafectas =0;
				$axexoneradas =0;

				$axmoneda ='SOLES';
				$axmnt_tot_gravadas =$axvalor_venta;
				$axmnt_tot_inafectas =0;
				$axmnt_tot_exoneradas =0;
				$axmnt_tot_gratuitas =0;
				$axmnt_tot =$axtotal_salida;

				$SQLActualizar = "UPDATE MAESTRO_CZ SET TOTAL_VENTA='$axtotal_venta',VALOR_VENTA='$axvalor_venta',IGV='$axigv',GRAVADAS='$axgravadas',INAFECTAS=0,EXONERADAS=0,MNT_TOT_GRAVADAS='$axgravadas',MNT_TOT_INAFECTAS=0,MNT_TOT_EXONERADAS=0,MNT_TOT_GRATUITAS=0,MNT_TOT='$axmnt_tot' WHERE COD_MOV='$axcod_mov_cz'";
				$RSActualizar = odbc_exec($con,$SQLActualizar);

  	/*FIN DE INSERTAR EL DETALLE DE LA CABECERA*/

  }else{

  	$respuesta = 1;
  	echo $respuesta;
  }
	

}

  /*GENERO COD_MOV*/		
	$axdni_user = get_row('usuarios','COD_USUARIO','ID_USUARIO',$axcodusuario);
	$logitudPass = 10;
	$axcod = substr($axdni_user,0,3);
	$nuevo_nombre_a = substr(md5(microtime()),1,$logitudPass);
	$nuevo_nombre = $axid_local.$axcod.$nuevo_nombre_a;
	$axcod_mov = $nuevo_nombre;
	
	$axtipo_mov = 'EGRESO';
	$axdetalle_movimiento = 'COMPRA';
	$axdetalle_movimiento_1 ='TRANSFORMACION';	


	$axfecha_emision = date('Y-m-d');
	$axperiodo_emision = date('m-Y',strtotime($axfecha_emision));
	$axid_td = '11'; //NOTA DE SALIDA, NO CAMBIAR ESTE CODIGO
	
	$axn_serie = get_row_two('CORRELATIVOS','N_SERIE','ID_LOCAL','ID_TD',$axid_local,$axid_td);
	$axdocumento = get_row_two('CORRELATIVOS','N_CORRELATIVO','ID_LOCAL','ID_TD',$axid_local,$axid_td)+1;
	$axid_serie= get_row_two('CORRELATIVOS','COD_CORR','ID_LOCAL','ID_TD',$axid_local,$axid_td);

	$axfecha_registro = $axfecha_emision;
	$axmotivo_devolucion ='0';
	$axhora_emision = date('H:i:s');
	$axano= date('Y',strtotime($axfecha_emision));

	$axglosa = 'TRANSFORMACION DE MERCADERIA';
	$axestado_electro ='PENDIENTE';
	$axperiodo_contable= date('m-Y',strtotime($axfecha_emision));

	$axfecha_referencia= $axfecha_emision;
	$axtxt_descr_mtvo_baja ='0';
	$axtxt_serie_ref = '0';
	$axtxt_correlativo_cpe_ref= '00000000';
	$axfec_emis_ref = $axfecha_emision;
	$axtxt_sustento= '0';
	$axcod_tip_nc_nd_ref='01';
	$axid_beneficiario  =get_row('BENEFICIARIOS','ID_BENEFICIARIO','RUC_BENEF',$axruc_benef);
	
	$axfecha_registro = $axfecha_emision;
	$ano_registro= date('Y');
	
	$axglosa = 'TRANSFORMACION DE MERCADERIA';
	$axmoneda = 'SOLES';
	$axtipo_cambio=0;
	

	$SQLInsert_c = "INSERT INTO MAESTRO_CZ (COD_MOV,TIPO_MOV,DETALLE_MOVIMIENTO,FECHA_EMISION,PERIODO_EMISION,ID_TD,TXT_SERIE,DOCUMENTO,ID_BENEFICIARIO,ID_USUARIO,FECHA_REGISTRO,ANO,ID_LOCAL,GLOSA,PERIODO_CONTABLE,MONEDA,ESTADO_ELECTRO,FECHA_CONTABLE,ESTADO_FINAL,ESTADO_ENVIADO_ITC,TIPO_CAMBIO,DETALLE_MOVIMIENTO_T) VALUES ('$axcod_mov','$axtipo_mov','$axdetalle_movimiento','$axfecha_emision','$axperiodo_emision','$axid_td','$axn_serie','$axdocumento','$axid_beneficiario','$axcodusuario','$axfecha_registro','$ano_registro','$axid_local','$axglosa','$axperiodo_emision','$axmoneda','PROCESADA','$axfecha_emision','PROCESADA','ENVIADO','$axtipo_cambio','$axdetalle_movimiento_1')";
	//echo $SQLInsert_c;
	$RSInsert_c = odbc_exec($con,$SQLInsert_c);

	if($RSInsert_c){

		$axid_producto = $axid_producto_padre;
		$axcant_ingreso = $axcant_salida_transformar_ingreso;
		$axcosto_producto = get_row('PRODUCTOS','COSTO_PRODUCTO','ID_PRODUCTO',$axid_producto); 
		$axdsctos_ingreso = 0;
		$axvalor_ingreso = ($axcosto_producto/1.18)*$axcant_ingreso;
		$axigv_ingreso = $axvalor_ingreso*.18;
		$axgravadas_ingreso = $axvalor_ingreso;
		$axinafecto_ingresos = 0;
		$axexonerado_ingreso = 0;
		$axtotal_ingreso = $axvalor_ingreso+$axigv_ingreso;

		$axcant_salida =0;
		$axprs_premiun =get_row('PRODUCTOS','PRS_PREMIUN','ID_PRODUCTO',$axid_producto); 
		$axprs_menor =get_row('PRODUCTOS','PRS_MENOR','ID_PRODUCTO',$axid_producto); 

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
		$axfecha_detraccion =$axfecha_emision;
		$axestado_producto ='BUENO';
		$axobservar ='';
		$axfecha_transf =$axfecha_emision;;
		$axid_cta ='';
		$axperiodo_transf =date('m-Y',strtotime($axfecha_transf));
		
		$axmargen_producto = get_row('PRODUCTOS','MARGEN_PRODUCTO','ID_PRODUCTO',$axid_producto);
		$axutilidad = ($axcosto_producto*$axmargen_producto)/100;
		$axprs_mayor =$axcosto_producto+$axutilidad;



		$sqlinserta_D ="INSERT INTO MAESTRO_DT (COD_MOV,ID_PRODUCTO,CANT_INGRESO,COSTO_PRODUCTO,DSCTOS_INGRESO,VALOR_INGRESO,IGV_INGRESO,GRAVADAS_INGRESO,INAFECTO_INGRESOS,EXONERADO_INGRESO,TOTAL_INGRESO,CANT_SALIDA,PRS_MAYOR,PRS_PREMIUN,PRS_MENOR,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,FORMA_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,NUM_TRANSF,POR_DETRACCION,MONTO_DETRACCION,NUM_DETRACCION,FECHA_DETRACCION,ESTADO_PRODUCTO,FECHA_TRANSF,ID_CTA,PERIODO_TRANSF) VALUES ('$axcod_mov','$axid_producto','$axcant_ingreso','$axcosto_producto','$axdsctos_ingreso','$axvalor_ingreso','$axigv_ingreso','$axgravadas_ingreso','$axinafecto_ingresos','$axexonerado_ingreso','$axtotal_ingreso','$axcant_salida','$axprs_mayor','$axprs_premiun','$axprs_menor','$axdsctos_salida','$axvalor_salida','$axigv_salida','$axgravadas_salida','$axinafecto_salida','$axexonerado_salida','$axtotal_salida','$axforma_pago','$axestado_forma_pago','$axmedio_pago','$axnum_transf','$axpor_detraccion','$axmonto_detraccion','$axnum_detraccion','$axfecha_detraccion','$axestado_producto','$axfecha_transf','$axid_cta','$axperiodo_transf')";
		$rsinserta_d = odbc_exec($con,$sqlinserta_D);

		if($rsinserta_d){
			
			//$axdocumento=$axdocumento;
  		$SQLActualizar_correlativo = "UPDATE CORRELATIVOS SET N_CORRELATIVO='$axdocumento' WHERE ID_LOCAL='$axid_local' AND COD_CORR='$axid_serie'";
			$RSActualizar_correlativo = odbc_exec($con,$SQLActualizar_correlativo);
			//echo $SQLActualizar_correlativo;		


				$axtotal_venta =$axtotal_ingreso;
				$axvalor_venta =$axvalor_ingreso;
				$axigv =$axigv_ingreso;
				$axgravadas =$axvalor_venta;
				$axinafectas =0;
				$axexoneradas =0;

				$axmoneda ='SOLES';
				$axmnt_tot_gravadas =$axvalor_venta;
				$axmnt_tot_inafectas =0;
				$axmnt_tot_exoneradas =0;
				$axmnt_tot_gratuitas =0;
				$axmnt_tot =$axtotal_ingreso;

				$SQLActualizar = "UPDATE MAESTRO_CZ SET TOTAL_VENTA='$axtotal_venta',VALOR_VENTA='$axvalor_venta',IGV='$axigv',GRAVADAS='$axgravadas',INAFECTAS=0,EXONERADAS=0,MNT_TOT_GRAVADAS='$axgravadas',MNT_TOT_INAFECTAS=0,MNT_TOT_EXONERADAS=0,MNT_TOT_GRATUITAS=0,MNT_TOT='$axmnt_tot' WHERE COD_MOV='$axcod_mov'";
				$RSActualizar = odbc_exec($con,$SQLActualizar);	

				$respuesta = 0;
				echo $respuesta;
		}


}else{

	$respuesta = 1;
	echo $respuesta;

}

}


break;

case '100':

	$axid_direccion= $_POST['txtid_direccion'];
	
	$sql6 = "SELECT * FROM BENEFICIARIOS_DIR WHERE ID_DIRECCION = '$axid_direccion'";
	
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

case '101':

	$axid_empresa = $_POST['txtid_empresa']; 		

	$sqletapas = "SELECT * FROM PRODUCTOS_COMPLEMENTOS_TRANSFORMAR WHERE ID_EMPRESA ='$axid_empresa' ORDER BY NOM_PRODUCTO DESC" ;
	
	//echo $sqletapas;	      

	$rsetapas=odbc_exec($con,$sqletapas);
	
	if(odbc_num_rows($rsetapas) > 0){
		echo '<option value="">Seleccionar</option>';
		while($fila=odbc_fetch_array($rsetapas)){
	   		echo '<option value='.$fila['ID_PRODUCTO'].'>'.utf8_encode(($fila['NOM_PRODUCTO'])).'</option>';
    	}
		
	} else {

		echo "";	
	}

break;

case '102':
	
$axcant_transformar = $_POST['txtcant_transformar_salida']; 		
$axid_producto_comp = $_POST['axid_producto_comp']; 		
$axidlocal = $_POST['txtidlocal']; 		

$SQLActualizar = "UPDATE PRODUCTOS_COMP SET CANT_TRANSF='$axcant_transformar' WHERE ID_PRODUCTO_COMP='$axid_producto_comp'";
$RSActualizar = odbc_exec($con,$SQLActualizar);

//echo $SQLActualizar;
if($RSActualizar){

	$respuesta =0;
	echo $respuesta;

}else{

	$respuesta =1;
	echo $respuesta;

}

break;

case '103':
	
	$axcod_mov_cz = $_POST['axcod_mov_cz']; 		
	$axcod_guia_cz = $_POST['txtcod_guia_cz']; 		
	$axfiltrar = $_POST['axfiltro']; 		

	//$axfiltro_proceso = get_row('MAESTRO_DT','COD_MOV_PR_GUIA','COD_MOV',$axcod_mov_cz);



	if($axfiltrar=='ADICIONAR'){

		$SQLActualizar = "UPDATE MAESTRO_DT SET COD_MOV_PR_GUIA='$axcod_guia_cz' WHERE COD_MOV='$axcod_mov_cz'";
		$RSActualizar = odbc_exec($con,$SQLActualizar);

		$SQLActualizar_1 = "UPDATE MAESTRO_CZ SET COD_GUIA_CZ='$axcod_guia_cz' WHERE COD_MOV='$axcod_mov_cz'";
		$RSActualizar_1 = odbc_exec($con,$SQLActualizar_1);

	}elseif($axfiltrar=='ELIMINAR'){

		$SQLActualizar = "UPDATE MAESTRO_DT SET COD_MOV_PR_GUIA='' WHERE COD_MOV_PR_GUIA='$axcod_guia_cz' AND COD_MOV='$axcod_mov_cz'";
	 	$RSActualizar = odbc_exec($con,$SQLActualizar);

	 	$SQLActualizar_1 = "UPDATE MAESTRO_CZ SET COD_GUIA_CZ='' WHERE COD_GUIA_CZ='$axcod_guia_cz' AND COD_MOV='$axcod_mov_cz'";
		$RSActualizar_1 = odbc_exec($con,$SQLActualizar_1);

	 	//echo $SQLActualizar.'<br>';
	 	//echo $SQLActualizar_1;
	}

	
	//echo $SQLActualizar;

		echo "
		<table class='table table-hover'>
		<thead class='table-primary'>			
		<tr>
			<th style='text-align:center;' scope='col'>COMPROBANTE</th>
			<th style='text-align:center;' scope='col'>CODIGO</th>
			<th style='text-align:center;' scope='col'>CANT</th>
			<th style='text-align:left;' scope='col'>DESCRIPCION</th>
			<th style='text-align:left;' scope='col'></th>
			
		</tr>
		</thead>";

	if($RSActualizar){

		$sqltraer_prd = "SELECT * FROM MAESTRO_GUIAS_VARIAS_1 WHERE COD_MOV_PR_GUIA='$axcod_guia_cz' ORDER BY COMPROBANTE ASC";
		$rstraer_prd= odbc_exec($con,$sqltraer_prd);

		if(odbc_num_rows($rstraer_prd)>0){

				while ($fila = odbc_fetch_array($rstraer_prd)) {
					
					$axcod_producto = $fila['COD_PRODUCTO'];
					$axcant = $fila['CANT_SALIDA'];
					$axnom_producto = $fila['NOM_PRODUCTO'];
					$axcomprobante =$fila['COMPROBANTE'];
					$axcod_mov =$fila['COD_MOV'];
					

				echo "
		 		<tr> 		
		 			<td style='text-align:center;'>$axcomprobante</td> 
		 			<td style='text-align:center;'>$axcod_producto</td> 
		 			<td style='text-align:center;'>$axcant</td> 
		 			<td style='text-align:left;'>$axnom_producto</td> 
		 			<td style='text-align:left;'><a href='#' style='text-decoration:none;' data-filtro='ELIMINAR' data-codmov='$axcod_mov' data-cgv='$axcod_guia_cz' id='btn_producto_quitar_de_guia'><i class='bi bi-trash3-fill'></i></a></td> 
		 			
		 		</tr>	";

			}

			echo "
			<tr>
			<th colspan='2' style='text-align:left;'><button type='button' class='btn btn-danger btn-sm' id='btn_generar_guia_varias' data-cgv='$axcod_guia_cz'> Generar Guía Remisión</button>
		  </th>
		  </tr>
			</table>
			";

		}else{


		}

	}


break;

case '104':
	
	$axcod_guia_cz = $_POST['txtcod_guia_cz']; 		
	$axid_td_guia = $_POST['txtid_td_guia']; 		
	$axid_local = $_POST['txtid_local']; 		
	
	$SQLPedidos_dt = "SELECT * FROM MAESTRO_GUIAS_VARIAS WHERE COD_MOV_PR_GUIA='$axcod_guia_cz' order by COD_PRODUCTO ASC";
	$RSpedidos_dt = odbc_exec($con,$SQLPedidos_dt);

	while ($fila = odbc_fetch_array($RSpedidos_dt)) {
				
				$it = $it+1;				
				$num_lin_item = $it;
				$cod_unid_item = $fila['PRESENTACION'];
				$cant_unid_item = $fila['CANT_SALIDA'];
				$val_vta_item = 0;
				$cod_tip_afect_igv_item =0;
				$prc_vta_unit_item =0;
				$mnt_dscto_item = 0;
				$mnt_igv_item = 0;
				$txt_descr_item = $fila['NOM_PRODUCTO'];
				$cod_prod_sunat = '00000000';
				$cod_item = $fila['COD_PRODUCTO'];
				$val_unit_item = 0;
				$mnt_isc_item = 0;
				$importe_total_item = 0;
				$val_unit_icbper = 0;
				$cant_icbper_item = 0;
				$mnt_icbper_item = 0;
				$dato_extra_1 ='';
				$dato_extra_2 ='';
				$cod_gtin = '';

				$SQLInsert = "INSERT INTO GUIA_REMISION_DT (COD_GUIA_CZ,num_lin_item,cod_unid_item,cant_unid_item,val_vta_item,cod_tip_afect_igv_item,prc_vta_unit_item,mnt_dscto_item,mnt_igv_item,txt_descr_item,cod_prod_sunat,cod_item,val_unit_item,mnt_isc_item,importe_total_item,val_unit_icbper,cant_icbper_item,mnt_icbper_item,dato_extra_1,dato_extra_2,cod_gtin) VALUES ('$axcod_guia_cz','$num_lin_item','$cod_unid_item','$cant_unid_item','$val_vta_item','$cod_tip_afect_igv_item','$prc_vta_unit_item','$mnt_dscto_item','$mnt_igv_item','$txt_descr_item','$cod_prod_sunat','$cod_item','$val_unit_item','$mnt_isc_item','$importe_total_item','$val_unit_icbper','$cant_icbper_item','$mnt_icbper_item','$dato_extra_1','$dato_extra_2','$cod_gtin')";
				$RSInsert = odbc_exec($con,$SQLInsert);
				//echo $SQLInsert;

}


	$cant_bultos_expor = 0;
	$cod_unid_peso_bruto = 'KGM';
	$mnt_tot_peso_bruto=get_row('GUIAS_BULTOS_MAESTROS','PESO','COD_MOV_PR_GUIA',$axcod_guia_cz);
	$txt_correlativo=get_row('GUIA_REMISION_CZ','txt_correlativo','COD_GUIA_CZ',$axcod_guia_cz);

	$SQLActualizar_correlativo = "UPDATE CORRELATIVOS SET N_CORRELATIVO='$txt_correlativo' WHERE ID_LOCAL='$axid_local' AND ID_TD='$axid_td_guia'";
	$RSActualizar_correlativo = odbc_exec($con,$SQLActualizar_correlativo);

	$SQLActualizar_cabeza_guia = "UPDATE GUIA_REMISION_CZ SET cod_unid_peso_bruto='$cod_unid_peso_bruto',mnt_tot_peso_bruto='$mnt_tot_peso_bruto',cant_bultos_expor='$cant_bultos_expor' WHERE COD_GUIA_CZ='$axcod_guia_cz'";
	$RSActualizar_cabeza_guia = odbc_exec($con,$SQLActualizar_cabeza_guia);

	$SQLPedidos_dt_1 = "SELECT COD_MOV,NUM_PEDIDO FROM MAESTRO_GUIAS_VARIAS_1 WHERE COD_MOV_PR_GUIA='$axcod_guia_cz' GROUP BY COD_MOV,NUM_PEDIDO";
	$RSpedidos_dt_1 = odbc_exec($con,$SQLPedidos_dt_1);

	while ($fila_1 = odbc_fetch_array($RSpedidos_dt_1)) {

		$axcod_mov_cz_1 = $fila_1['COD_MOV'];
		$axnum_pedido_1 = $fila_1['NUM_PEDIDO'];

		$SQLActualizar_maestro = "UPDATE MAESTRO_CZ SET COD_GUIA_CZ='$axcod_guia_cz' WHERE COD_MOV='$axcod_mov_cz_1'";
		$RSActualizar_maestro = odbc_exec($con,$SQLActualizar_maestro);

		$SQLActualizar_pedidos = "UPDATE PEDIDOS SET COD_GUIA_CZ='$axcod_guia_cz' WHERE NUM_PEDIDO='$axnum_pedido_1'";
		$RSActualizar_pedidos = odbc_exec($con,$SQLActualizar_pedidos);

	}


break;

case '105':
	
$axcodusuario = $_POST['txtcodusuario'];
$axid_local = $_POST['txtid_local'];

$SQLBuscar = "SELECT * FROM MAESTRO_CZ_PROGRAMADOS WHERE ID_LOCAL='$axid_local' AND ESTADO_ATENDIDO='PROGRAMADO'AND COD_GUIA_CZ=''";
$RSBuscar = odbc_exec($con,$SQLBuscar);
//echo $SQLBuscar;

if(odbc_num_rows($RSBuscar)>0){

	$axdni_user = get_row('usuarios','COD_USUARIO','ID_USUARIO',$axcodusuario);
	$logitudPass = 10;
	$axcod = substr($axdni_user,0,3);
	$nuevo_nombre_a = substr(md5(microtime()),1,$logitudPass);
	$nuevo_nombre = $axid_local.$axcod.$nuevo_nombre_a;
	$axcodmovcz = $nuevo_nombre;
	echo trim($axcodmovcz);

}else{

	$respuesta=5;
	echo $respuesta;

}

break;


case '106':
	
//$axcodmovcz = trim($_POST['txtcod_mov_cz']);
$axidlocal= $_POST['txtid_local'];

$axcod_guia_cz = $_POST['txtcod_guia_cz'];

$axcod_cliente_emis= get_row('LOCALES','cod_cliente_emis','ID_LOCAL',$axidlocal);
$axruta= get_row('LOCALES','RUTA_JSON','ID_LOCAL',$axidlocal);
$axtoken= get_row('LOCALES','TOKEN_EMPRESA','ID_LOCAL',$axidlocal);
$axurl= get_row('LOCALES','URL_PRODUCCION','ID_LOCAL',$axidlocal);
//$axurl= get_row('LOCALES','URL_PRUEBAS','ID_LOCAL',$axidlocal);

$SQLDatos_1 ="SELECT TOP 1 * FROM GUIA_REMISION_CZ WHERE COD_GUIA_CZ='$axcod_guia_cz' AND ID_LOCAL='$axidlocal'";
$RSDatos_1=odbc_exec($con,$SQLDatos_1);
$row=odbc_fetch_array($RSDatos_1);
			
	$axrucempresa= $row['num_ruc_rem'];
	$axtipodoc= $row['cod_tip_cpe'];
	$axnserie= $row['txt_serie'];
	$axcorrelativo= $row['txt_correlativo'];
	$axdocumento_tipo= $row['DETALLE_DOC'];

	$LblNombreArchivo = $axrucempresa.'-'.$axtipodoc.'-'.$axnserie.'-'.$axcorrelativo.'.json';
//	echo $LblNombreArchivo;



$response=array();

$SQLDatosCZ ="SELECT top 1 Identificador,cod_tip_cpe,txt_serie,txt_correlativo,cod_cliente_emis,num_ruc_rem,nom_rzn_soc_rem,cod_tip_nif_rem,num_ruc_dest,nom_rzn_soc_dest,cod_tip_nif_dest,num_iden_prov,nom_rzn_soc_prov,cod_tip_nif_prov,fec_emis,hora_emis,cod_ubi_partida,cod_establ_partida,num_asoc_partida,txt_domicilio_partida,txt_domicilio_llegada,cod_establ_llegada,num_asoc_llegada,cod_ubi_llegada,trans_txt_nombre,trans_txt_ruc,trans_cod_tip_nif,trans_fec_ini,cod_mot_trasalado,cant_bultos_expor,cod_unid_peso_bruto,mnt_tot_peso_bruto,trans_cod_tip_modalidad,observaciones,txt_desc_motiv_tras,dato_extra_1,dato_extra_2,dato_extra_3,dato_extra_4,vrs_guia FROM GUIA_REMISION_NS WHERE COD_GUIA_CZ='$axcod_guia_cz'";

$RSDatosCZ=odbc_exec($con,$SQLDatosCZ);
//echo $SQLDatosCZ;


$filacz = odbc_fetch_array($RSDatosCZ);

$SQLDatosDT ="SELECT num_lin_item,cod_unid_item,cant_unid_item,val_vta_item,cod_tip_afect_igv_item,prc_vta_unit_item,mnt_dscto_item,mnt_igv_item,txt_descr_item,cod_prod_sunat,cod_item,val_unit_item,mnt_isc_item,importe_total_item,val_unit_icbper,cant_icbper_item,mnt_icbper_item,dato_extra_1,dato_extra_2,cod_gtin FROM GUIA_REMISION_DT WHERE COD_GUIA_CZ='$axcod_guia_cz'";


$RSDatosDT=odbc_exec($con,$SQLDatosDT);
$axnum = odbc_num_rows($RSDatosDT);

for ($i=0; $i < $axnum ; $i++) { 
		
	$filaDT = odbc_fetch_array($RSDatosDT);
	$jsonDT_D[$i] = $filaDT;
}


$SQLVehiculos ="SELECT veh_iden,veh_txt_placa,veh_tarj_unic_circ,veh_reg_mtc,veh_ent_emt_auto,veh_num_autoriza FROM documentoVehiculo_json_ns WHERE COD_GUIA_CZ='$axcod_guia_cz'";
$RSVehiculos=odbc_exec($con,$SQLVehiculos);
$axnum_v = odbc_num_rows($RSVehiculos);

for ($v=0; $v < $axnum_v ; $v++) { 
		
	$fila_V = odbc_fetch_array($RSVehiculos);
	$jsonDT_V[$v] = $fila_V;
}


$SQLChoferes ="SELECT con_iden,con_tip_iden,con_num_iden,con_nombre,con_apellido,con_num_lic FROM documentoConductor_json_ns WHERE COD_GUIA_CZ='$axcod_guia_cz'";
$RSChoferes=odbc_exec($con,$SQLChoferes);
$axnum_c = odbc_num_rows($RSChoferes);

for ($c=0; $c < $axnum_c ; $c++) { 
		
	$fila_c = odbc_fetch_array($RSChoferes);
	$jsonDT_C[$c] = $fila_c;
}


$SQLIndicadores ="SELECT ind_nom FROM indicadores_json WHERE COD_GUIA_CZ='$axcod_guia_cz'";
$RSIndicadores=odbc_exec($con,$SQLIndicadores);
$axnum_i = odbc_num_rows($RSIndicadores);

for ($d=0; $d < $axnum_i ; $d++) { 
		
	$fila_ind = odbc_fetch_array($RSIndicadores);
	$jsonDT_ind[$d] = $fila_ind;
}


$array1    = $filacz;
$array2['indicador'] = $jsonDT_ind;
$array3['documentoVehiculo'] = $jsonDT_V;
$array4['documentoConductor'] = $jsonDT_C;
$array5['detalles'] = $jsonDT_D;

$resultado = $array1 + $array2 + $array3+$array4+$array5;
//var_dump($resultado);

$jsonfinal_1 = json_encode($resultado,JSON_PRETTY_PRINT);	
$jsonfinal = preg_replace('#:"(\d+)"#', ':$1', $jsonfinal_1);

$file = $axruta.$LblNombreArchivo;  
file_put_contents($file, $jsonfinal);

if($axcod_cliente_emis !==''){

	$axnom_archivo = $axruta.$LblNombreArchivo;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $axurl);
	$parametros = @file_get_contents($axnom_archivo);

	//echo $parametros;

	curl_setopt( $ch, CURLOPT_POSTFIELDS, $parametros);
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization: '.$axtoken));
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	$result = curl_exec($ch);
	$codigoRespuesta = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	if($codigoRespuesta === 200){
	    
		$SQLActualizar = "UPDATE GUIA_REMISION_CZ SET BOUCHER_DIGITAL='$LblNombreArchivo',ESTADO_ELECTRO='PROCESADA',ESTADO_ENVIADO_ITC='ENVIADO' WHERE COD_GUIA_CZ='$axcod_guia_cz'";
		$RSActualizar = odbc_exec($con, $SQLActualizar);
	
	}else{

    $SQLActualizar = "UPDATE GUIA_REMISION_CZ SET BOUCHER_DIGITAL='$LblNombreArchivo',ESTADO_ELECTRO='PENDIENTE',ESTADO_ENVIADO_ITC='PENDIENTE' WHERE COD_GUIA_CZ='$axcod_guia_cz'";
		$RSActualizar = odbc_exec($con, $SQLActualizar);
	
	}
	curl_close($ch);

	}else{

		$SQLActualizar = "UPDATE GUIA_REMISION_CZ SET BOUCHER_DIGITAL='$LblNombreArchivo',ESTADO_ELECTRO='PROCESADA',ESTADO_ENVIADO_ITC='PENDIENTE' WHERE COD_GUIA_CZ='$axcod_guia_cz'";
		$RSActualizar = odbc_exec($con, $SQLActualizar);	

		$respuesta = 0;
		echo $respuesta;
	}



break;

case '107':
	
	$axbuscar_dato =$_POST['txtdistrito_buscar'];
   
 if(isset($_POST["txtdistrito_buscar"])){

	$output ="";
	$idprov ="";
	$sqlemisor = "SELECT TOP 30 * FROM UBIGEOS_PERU WHERE UBIGEO_PERU LIKE  '%".$axbuscar_dato."%' ORDER BY UBIGEO_PERU ASC";
	//echo $sqlemisor;

	$rsemisor=odbc_exec($con,$sqlemisor);	
	$output ="<ul class='list-group'>";  		

	if(odbc_num_rows($rsemisor) > 0){
		 while ($row=odbc_fetch_array($rsemisor)){		
		 	$id =  $row["UBIGEO_REINEC"];
		 	$axdistrito =  trim($row["UBIGEO_PERU"]);

		 	$output .="<a href='#' id='btn_lista_ubi' class='list-group-item list-group-item-action' style='background:#DAF5FF;' data-id='$id' data-distrito='$axdistrito'>".utf8_encode(trim($row["UBIGEO_PERU"]))."</a>";
		 }

	}else{
		
		$output .="<a href='#' class='list-group-item list-group-item-action bg-danger'></a>";
	
	}

	$output .="</ul>";
	echo $output;

}else{
	echo $output;	
}

break;
case '108':
	

	$axbuscar_dato =$_POST['txtgrupo'];
   
 if(isset($_POST["txtgrupo"])){

	$output ="";
	$idprov ="";
	$sqlemisor = "SELECT TOP 15 GRUPO FROM BENEFICIARIOS WHERE GRUPO LIKE  '%".$axbuscar_dato."%' GROUP BY GRUPO";
	//echo $sqlemisor;

	$rsemisor=odbc_exec($con,$sqlemisor);	
	$output ="<ul class='list-group'>";  		

	if(odbc_num_rows($rsemisor) > 0){
		 while ($row=odbc_fetch_array($rsemisor)){		
		 	
		 	$axgrupo =  trim($row["GRUPO"]);

		 	$output .="<a href='#' id='btn_lista_grupo' class='list-group-item list-group-item-action' style='background:#DAF5FF;'>".utf8_encode(trim($row["GRUPO"]))."</a>";
		 }

	}else{
		
		$output .="<a href='#' class='list-group-item list-group-item-action bg-danger'></a>";
	
	}

	$output .="</ul>";
	echo $output;

}else{
	echo $output;	
}

break;

case '109':
	

$axbuscaregistro = $_POST['txtbuscar']; 	
$axcodusuario = $_POST['txtcodusuario']; 	
$axnum_pedido = $_POST['txtnum_pedido']; 	
$axid_empresa = $_POST['txtid_empresa']; 	
$axfecha_despacho = get_row('PEDIDOS_CZ','FECHA_DESPACHO','NUM_PEDIDO',$axnum_pedido);
$axid_td= get_row('PEDIDOS_CZ','ID_TD','NUM_PEDIDO',$axnum_pedido);
$axtipodocumento= get_row('TIPO_DOCUMENTOS','DETALLE_DOC','ID_TD',$axid_td);

$SQLBuscar = "SELECT ID_PRODUCTO_PADRE FROM PEDIDOS_DT WHERE ID_USUARIO = '$axcodusuario' AND ID_EMPRESA	='$axid_empresa' AND NUM_PEDIDO='$axnum_pedido' GROUP BY ID_PRODUCTO_PADRE";
//echo "$SQLBuscar";

echo "
	<br>
		<div style='text-align:center;'>			
		<button type='button' id='btn_imprimir_pedidido' class='btn btn-danger btn-sm'><i class='bi bi-filetype-pdf'></i>Pdf</button>	
		<p><hr></p>
		<h6 class='text-danger'>Fecha Despacho: <b>".date('d-m-Y',strtotime($axfecha_despacho))."</b> Tipo comprobante: <b>".$axtipodocumento."</b></h6>	
		</div>

		<p><hr></p>
		<table class='table table-hover table-sm'>	
		<thead class='table-success'>				
		<tr>			
			<th style='text-align: left;'></th>			
			<th style='text-align: left;'>Detalle</th>			
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 

 		$it= $it+1;
 		$axid_dt = $fila['ID_PEDIDO'];		
 		$axnom_producto = $fila['ID_BENEFICIARIO'];		
 		$axid_producto_padre= $fila['ID_PRODUCTO_PADRE'];
 		$axnom_producto_padre= get_row('PRODUCTOS','NOM_PRODUCTO','ID_PRODUCTO',$axid_producto_padre);
 		$axcod_producto_padre= get_row('PRODUCTOS','COD_PRODUCTO','ID_PRODUCTO',$axid_producto_padre);
 		
 		$tipo =   get_row('PRODUCTOS','TIPO','ID_PRODUCTO',$axid_producto_padre); 
		$presentacion = get_row('PRODUCTOS','PRESENTACION','ID_PRODUCTO',$axid_producto_padre); 
		$cant_caja = get_row('PRODUCTOS','CANT_CAJA','ID_PRODUCTO',$axid_producto_padre);  

 		$axmostrar_padre = $tipo.' '.$presentacion.' '.$cant_caja;

 		$axprod_mostrar= $axcod_producto_padre.' | '.$axnom_producto_padre.' '.$axmostrar_padre;

 			echo "<tr>
			 <td class='text-danger'style='text-align: center;'><a href='#' id='btn_eliminar_producto_del_pedido' data-id='$axid_producto_padre' data-numpedido='$axnum_pedido'><i class='bi bi-trash3-fill text-danger'></i></a></td>
		 		<td style='text-align: justify; font-size:11px;'>
					<a href='#' id='btn_producto_asignar' data-id='$id_producto' style='text-decoration:none;'><b>".utf8_encode($axprod_mostrar)."</b></a>
				</td>
				</tr>";
				


				$SQLPedidos_dt = "SELECT * FROM PEDIDOS_DT WHERE ID_USUARIO = '$axcodusuario' AND ID_EMPRESA	='$axid_empresa' AND NUM_PEDIDO='$axnum_pedido' AND ID_PRODUCTO_PADRE='$axid_producto_padre'";
				$RSPedidos_dt = odbc_exec($con,$SQLPedidos_dt);
				//echo $SQLPedidos_dt.'<br>';
				
				if(odbc_num_rows($RSPedidos_dt) > 1){
					
					 	while ($fila=odbc_fetch_array($RSPedidos_dt)){ 
						 		$it= $it+1;
						 		$axid_dt = $fila['ID_PEDIDO'];		
						 		$axnom_producto = $fila['ID_BENEFICIARIO'];		
								$axcant_salida =number_format($fila["CANT_SALIDA"],2,".",","); 
								$axprs_venta =number_format($fila["PRS_VENTA"],2,".",","); 
								$axtotal_salida =number_format($fila["TOTAL_SALIDA"],2,".",","); 
								$cod_producto_hijo = $fila['COD_PRODUCTO'];
								$nom_categoria = $fila['NOM_CATEGORIA'];
								$nom_producto_hijo = $fila['NOM_PRODUCTO'];
								$tipo = $fila['TIPO'];
								$presentacion = $fila['PRESENTACION'];
								$procedencia = $fila['PROCEDENCIA'];
								$estado = $fila['ESTADO'];
								$cant_caja = $fila['CANT_CAJA'];
								$axid_producto_hijo= $fila['ID_PRODUCTO'];
								$axprs_unit = number_format(($axprs_venta/$cant_caja),3,".",","); 
								
							
								$axprod_mostrar_detalle =  $nom_producto_hijo.' '.$tipo.' '.$presentacion.' '.$cant_caja.'<br><b class="text-danger"> Cant. '.$axcant_salida.'| Pr.Unit. '.$axprs_unit.'| Pr.Venta : '.$axprs_venta.'| Total : '.$axtotal_salida.'</b>';		
								
								echo "<tr>								
									 	<td class='text-danger'style='text-align: center;'></td>
								 		<td class='table-success' style='font-size:10px; text-align: justify;'>
											<a href='#' id='btn_producto_asignar' data-id='$axid_producto_hijo' style='text-decoration:none;'>".utf8_encode($axprod_mostrar_detalle)."</a>
										</td> 
								
								</tr>";
								}

								
				}else{

					 	while ($fila=odbc_fetch_array($RSPedidos_dt)){ 
						 		$it= $it+1;
						 		$axid_dt = $fila['ID_PEDIDO'];		
						 		$axnom_producto = $fila['ID_BENEFICIARIO'];		
								$axcant_salida =number_format($fila["CANT_SALIDA"],2,".",","); 
								$axprs_venta =number_format($fila["PRS_VENTA"],2,".",","); 
								$axtotal_salida =number_format($fila["TOTAL_SALIDA"],2,".",","); 
								$cod_producto_hijo = $fila['COD_PRODUCTO'];
								$nom_categoria = $fila['NOM_CATEGORIA'];
								$nom_producto_hijo = $fila['NOM_PRODUCTO'];
								$tipo = $fila['TIPO'];
								$presentacion = $fila['PRESENTACION'];
								$procedencia = $fila['PROCEDENCIA'];
								$estado = $fila['ESTADO'];
								$cant_caja = $fila['CANT_CAJA'];
								$axid_producto_hijo= $fila['ID_PRODUCTO'];
								$axprs_unit = number_format(($axprs_venta/$cant_caja),3,".",","); 
															
								$axprod_mostrar_detalle =  '<b class="text-danger"> Cant. '.$axcant_salida.'  |Pr.Unit. '.$axprs_unit.' |Pr.Venta : '.$axprs_venta.'  |Total : '.$axtotal_salida.'</b>';		
								
								echo "<tr>								
									 	<td class='text-danger'style='text-align: center;'></td>
								 		<td class='table-success' style='font-size:10px; text-align: justify;'>
											<a href='#' id='btn_producto_asignar' data-id='$axid_producto_hijo' style='text-decoration:none;'>".utf8_encode($axprod_mostrar_detalle)."</a>
										</td> 
								
								</tr>";
								}



				}
				
		}

}

echo "</table>";

break;


case '110':
	
$axbuscar_dato =$_POST['txtnum_despacho'];
   
 if(isset($_POST["txtnum_despacho"])){

	$output ="";
	$idprov ="";
	$sqlemisor = "SELECT TOP 5 NUM_DESPACHO FROM PEDIDOS WHERE NUM_DESPACHO LIKE  '%".$axbuscar_dato."%' GROUP BY NUM_DESPACHO ORDER BY NUM_DESPACHO";
	//echo $sqlemisor;

	$rsemisor=odbc_exec($con,$sqlemisor);	
	$output ='<ul class="list-group">';  		

	if(odbc_num_rows($rsemisor) > 0){

		 while ($row=odbc_fetch_array($rsemisor)){
		 	$nom_prod =  trim($row["NUM_DESPACHO"]);
		 	$output .='<a href="#" id="btn_lista_despachos" class="list-group-item list-group-item-action" style="background:#DAF5FF;">'.utf8_encode(trim($row["NUM_DESPACHO"])).'</a>';
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

case '111':

$axnum_despacho= $_POST['txtnum_despacho'];
	
	$sql6 = "SELECT TOP 1 * FROM PEDIDOS_CZ WHERE NUM_DESPACHO = '$axnum_despacho'";
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

case '112':
	

$axbuscaregistro = $_POST['txtbuscar']; 	
$axid_empresa = $_POST['txtid_empresa']; 	

	if($axbuscaregistro==""){
		
		$SQLBuscar = "SELECT  TOP 30 * FROM TRANSPORTISTAS WHERE ID_EMPRESA = '$axid_empresa'";
		
	}else{

		$SQLBuscar ="SELECT  TOP 30 * FROM TRANSPORTISTAS WHERE ID_EMPRESA = '$axid_empresa' AND NOM_AGENCIA like '%".$axbuscaregistro."%' ";

	}

	//echo "$SQLBuscar";

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th style='text-align: center;'>Item</th>
			<th style='text-align: center;'>RUC | DNI</th>
			<th style='text-align: left;'>NOM. AGENCIA</th>
			<th style='text-align: left;'>DIRECCION AGENCIA</th>
			<th style='text-align: left;'>DISTRITO</th>
			<th style='text-align: center;'>TELEFONOS</th>
			<th style='text-align: center;'>HORARIOS</th>			
			<th style='text-align: left;'>OBSERVACION</th>			
			<th style='text-align: center;'>Acción</th>
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$axid_agencia = $fila['ID_AGENCIA'];
		$axid_doc = $fila['ID_DOC'];
		$axruc_agencia = $fila['RUC_AGENCIA'];
		$axnom_agencia = $fila['NOM_AGENCIA'];
		$axdir_agencia = $fila['DIR_AGENCIA'];
		$axref_agencia = $fila['REF_AGENCIA'];
		$axdistrito_agencia = $fila['DISTRITO_AGENCIA'];
		$axtelef_agencia = $fila['TELEF_AGENCIA'];
		$axhorarios_agencia = $fila['HORARIOS_AGENCIA'];
		$axdetalle_envio = $fila['DETALLE_ENVIO'];
		$axid_empresa = $fila['ID_EMPRESA'];		

 	echo "
 		<tr> 		
 			<td style='text-align: center;'>".$it."</td> 
 			<td style='text-align: center;'>".$axruc_agencia."</td> 
 			<td style='text-align: left;'>".utf8_encode($axnom_agencia)."</td> 
 			<td style='text-align: left;'>".utf8_encode($axdir_agencia)."</td> 
 			<td style='text-align: left;'>".utf8_encode($axdistrito_agencia)."</td>  			
 			<td style='text-align: center;'>".$axtelef_agencia."</td>  			
 			<td style='text-align: center;'>".$axhorarios_agencia."</td>  			
 			<td style='text-align: left;'>".$axdetalle_envio."</td>  			 			
 			<td style='text-align: center;'>

			<div class='btn-group dropstart'>
					<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
					<ul class='dropdown-menu'>	
					<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-info' id='btn_editar_agencia' data-id='$axid_agencia' data-bs-toggle='modal' data-bs-target='#exampleModal'><b><i class='bi bi-pencil' ></i> Editar</a></b>
					<a href='#' class='dropdown-item text-danger' id='btn_eliminar_agencia' data-id='$axid_agencia' ><b><i class='bi bi-trash3-fill'></i> Eliminar</a></b>
					<div><hr class='dropdown-divider'></div>
					</ul>
				</div>

 			</td> 
 		</tr>
 	";

}
echo "</table>";
}

break;
case '113':
	
$axid_empresa = $_POST['txtid_empresa'];	
$axid_agencia = $_POST['txtid_agencia'];
$axid_doc = $_POST['txtid_doc'];
$axruc_agencia = $_POST['txtruc_agencia'];
$axnom_agencia = $_POST['txtnom_agencia'];
$axdir_agencia = $_POST['txtdir_agencia'];
$axref_agencia = $_POST['txtref_agencia'];
$axdistrito_agencia = $_POST['txtdistrito_agencia'];
$axtelef_agencia = $_POST['txttelef_agencia'];
$axhorario_agencia = $_POST['txthorario_agencia'];
$axdetalle_envio	 = $_POST['txtdetalle_envio'];
$axparametros	 = $_POST['txtparametros'];

if($axparametros==0){

	$SQLInsert = "INSERT INTO TRANSPORTISTAS (ID_DOC,RUC_AGENCIA,NOM_AGENCIA,DIR_AGENCIA,REF_AGENCIA,DISTRITO_AGENCIA,TELEF_AGENCIA,HORARIOS_AGENCIA,DETALLE_ENVIO,ID_EMPRESA) VALUES ('$axid_doc','$axruc_agencia','$axnom_agencia','$axdir_agencia','$axref_agencia','$axdistrito_agencia','$axtelef_agencia','$axhorario_agencia','$axdetalle_envio','$axid_empresa')";

}elseif($axparametros==1) {

	$SQLInsert = "UPDATE TRANSPORTISTAS SET	ID_DOC='$axid_doc',RUC_AGENCIA='$axruc_agencia',NOM_AGENCIA='$axnom_agencia',DIR_AGENCIA='$axdir_agencia',REF_AGENCIA='$axref_agencia',DISTRITO_AGENCIA='$axdistrito_agencia',TELEF_AGENCIA='	$axtelef_agencia',HORARIOS_AGENCIA='$axhorario_agencia',DETALLE_ENVIO='$axdetalle_envio',ID_EMPRESA='$axid_empresa' WHERE ID_AGENCIA='$axid_agencia'";
}
//echo $SQLInsert;

$RSInsert = odbc_exec($con,$SQLInsert);

if ($RSInsert) {
	
	$respuesta = 0;
	echo $respuesta;

}else{

	$respuesta = 1;
	echo $respuesta;
}

break;

case '114':
	
$axid_agencia= $_POST['txtid_agencia'];
	
$sql6 = "SELECT * FROM TRANSPORTISTAS WHERE ID_AGENCIA='$axid_agencia'";
	
$result1=odbc_exec($con,$sql6);
if(odbc_num_rows($result1) > 0) {
    
    $axlistaprov1 = odbc_fetch_object($result1);
    $axlistaprov1 ->status =200;
    echo json_encode($axlistaprov1);
      
}else{

  	$error = array('status'=> 400);
  	echo json_encode((object) $error);
}

break;
case '115':
	
$axid_agencia= $_POST['txtid_agencia'];

$sqlbuscar = "SELECT * FROM PEDIDOS WHERE ID_AGENCIA='$axid_agencia'";
$rsbuscar = odbc_exec($con,$sqlbuscar);

//echo $sqlbuscar;

if(odbc_num_rows($rsbuscar) > 0) {

	$respuesta = 1;
	echo $respuesta;

}else{

	$SQLEliminar ="DELETE FROM TRANSPORTISTAS WHERE ID_AGENCIA='$axid_agencia'";
	$RSEliminar = odbc_exec($con,$SQLEliminar);

	$respuesta = 0;
	echo $respuesta;

}

break;

case '116':
	
$axbuscaregistro = $_POST['txtbuscar']; 	
$axid_local = $_POST['txtid_local']; 	


	if($axbuscaregistro==""){
		$SQLBuscar = "SELECT * FROM CORRELATIVOS_LISTAR WHERE ID_LOCAL = '$axid_local' order by DETALLE_DOC ASC";
	}else{
		$SQLBuscar ="SELECT *  FROM CORRELATIVOS_LISTAR WHERE ID_LOCAL = '$axid_local'  AND DETALLE_DOC like '%".$axbuscaregistro."%' ";
	}

	//echo "$SQLBuscar";

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th class='ocultar' style='text-align: center;'>Item</th>
			<th class='ocultar' style='text-align: center;'>COD SUNAT</th>
			<th class='ocultar' style='text-align: left;'>TIPO DOCUMENTO</th>			
			<th class='ocultar' style='text-align: left;'>CORRELATIVO</th>
			<th style='text-align: center;'>Acción</th>
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 

 		$it= $it+1;
 		$id=$fila['COD_CORR'];
 		$axid_td = $fila['ID_TD'];
		$axtipodocumento = $fila['DETALLE_DOC'];
		$axserie =$fila['N_SERIE'];
		$axcorrelativo = $fila['N_CORRELATIVO'];
		$axabrev = $fila['TIPO_D'];
		$axcod_sunat = $fila['COD_SUNAT'];

 	echo "
 		<tr> 		
 			<td style='text-align: center;'>".$it."</td> 
 			<td style='text-align: center;'>".$axcod_sunat."</td> 
 			<td style='text-align: left;'>".$axtipodocumento."</td>  			
 			<td style='text-align: left;'>".$axserie.'-'.number_pad($axcorrelativo,8,0)."</td>  			

 			<td  style='text-align: center;'>
 				<div class='btn-group dropstart'>
					<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
					<ul class='dropdown-menu'>	
					<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-info' id='btn_editar_corr' data-id='$id' data-bs-toggle='modal' data-bs-target='#exampleModal'><b><i class='bi bi-pencil' ></i> Editar</a></b>
					<!--a href='#' class='dropdown-item text-danger' id='btn_eliminar_corr' data-id='$id' ><b><i class='bi bi-trash3-fill'></i> Eliminar</a></b-->					
					<div><hr class='dropdown-divider'></div>
					</ul>
				</div>
 			</td>";

}
echo "</table>";
}

break;
case '117':
	
	$axid_local = $_POST['txtid_local'];
	$axcod_corr = $_POST['txtcod_corr'];
	$axid_td = $_POST['txtid_td'];
	$axn_serie = $_POST['txtn_serie'];
	$axn_correlativo = $_POST['txtn_correlativo'];
	$axtipo_d = $_POST['txttipo_d'];
	$axparametros = $_POST['txtparametros'];


	$axid_usuario =$_POST['txtid_usuario'];
	$axnom_modulo ='CORRELATIVOS';


	if($axparametros==0){

		$SQLInsert = "INSERT INTO CORRELATIVOS (ID_LOCAL,COD_SERIE,N_SERIE,N_CORRELATIVO,TIPO_D,ID_TD) VALUES ('$axid_local','$axn_serie','$axn_serie','$axn_correlativo','$axtipo_d','$axid_td')";

		$axdetalle ='AGREGO NUEVO CORRELATIVO PARA EL DOCUMENTO '. $axtipo_d.' DE LA SERIE '.$axn_serie;
		guardar_bitacora($axid_usuario,$axnom_modulo,$axdetalle);

	}else{

		$SQLInsert = "UPDATE CORRELATIVOS SET ID_LOCAL='$axid_local',COD_SERIE='$axn_serie',N_SERIE='$axn_serie',N_CORRELATIVO='$axn_correlativo',TIPO_D='$axtipo_d',ID_TD='$axid_td' WHERE COD_CORR='$axcod_corr'";

		$axdetalle ='CAMBIO EL NUMERO DE CORRELATIVO ACTUAL POR '. $axn_correlativo.' DE LA SERIE '.$axn_serie;
		guardar_bitacora($axid_usuario,$axnom_modulo,$axdetalle);

	}
	//echo	 $SQLInsert;

	$RSInsert = odbc_exec($con,$SQLInsert);

	if($RSInsert){

		$respuesta=0;
		echo $respuesta;

	}else{

		$respuesta=1;
		echo $respuesta;

	}
break;
case '118':
	

$axid_corr= $_POST['txtcod_corr'];
$sql6 = "SELECT * FROM CORRELATIVOS WHERE COD_CORR='$axid_corr'";


	
$result1=odbc_exec($con,$sql6);
if(odbc_num_rows($result1) > 0) {
    
    $axlistaprov1 = odbc_fetch_object($result1);
    $axlistaprov1 ->status =200;
    echo json_encode($axlistaprov1);
      
}else{

  	$error = array('status'=> 400);
  	echo json_encode((object) $error);
}

break;

case '119':

date_default_timezone_set("America/Lima");
	
$axid_empresa= $_POST['txtid_empresa'];
$axfecha_despacho= $_POST['txtfecha_despacho'];


$sql6 = "SELECT * FROM EMPRESA WHERE ID_EMPRESA='$axid_empresa'";
$result1=odbc_exec($con,$sql6);
$fila = odbc_fetch_array($result1);
$axcorrelativo = $fila['CORRELATIVO_DESPACHOS']+1;

$axcod_despacho = date('dmy',strtotime($axfecha_despacho)).'-'.number_pad($axcorrelativo,4);
$SQLActualizar = "UPDATE EMPRESA SET CORRELATIVO_DESPACHOS='$axcorrelativo' WHERE ID_EMPRESA='$axid_empresa'";
$RSActualizar = odbc_exec($con,$SQLActualizar);
echo $axcod_despacho;

break;

case '120':
	
$axid_local= $_POST['txtid_local_stock'];

if($axid_local==''){
	$sqlstock = "SELECT * FROM PEDIDOS_ABIERTOS_STOCK WHERE ESTADO_REVISION='ABIERTO' ORDER BY ID_LOCAL,COD_PRODUCTO ASC";	
}else{
	$sqlstock = "SELECT * FROM PEDIDOS_ABIERTOS_STOCK WHERE ID_LOCAL='$axid_local' AND ESTADO_REVISION='ABIERTO' ORDER BY ID_LOCAL,COD_PRODUCTO ASC";
}
//echo $sqlstock;
$rsstock = odbc_exec($con,$sqlstock);


echo "
	<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
		<th style='text-align: center;'>ITEM</th>
		<th style='text-align: center;'>ALMACEN</th>
			<th style='text-align: center;'>CODIGO</th>
			<th style='text-align: left;'>NOMBRE PRODUCTO</th>
			<th style='text-align: center;'>STOCK ACTUAL</th>
			<th style='text-align: center;'>REQUERIDO</th>						
		</tr>
		</thead>";

while ($fila = odbc_fetch_array($rsstock)) {
	
	$it=$it+1;
	$axlocal_corto =$fila['LOCAL_CORTO'];
	$axid_local_corto =$fila['ID_LOCAL'];
	$axid_producto =$fila['ID_PRODUCTO'];
	$axcod_producto =$fila['COD_PRODUCTO'];
	$axnom_producto =$fila['NOM_PRODUCTO'];
	$axcant_requerida =number_format($fila['CANT_SALIDA'],2,".",",");
	$axstock_1 = get_row_two('INVENTARIO_ACTUAL','STOCK_ACTUAL','ID_LOCAL','ID_PRODUCTO',$axid_local_corto,$axid_producto);

	if($axstock_1 > 0){

		echo "<tr>		
		<td style='text-align:center;'>$it</td>	
		<td style='text-align:center;'>$axlocal_corto</td>	
		<td style='text-align:center;'>$axcod_producto</td>
		<td style='text-align:left;'>$axnom_producto</td>
		<td style='text-align:center;'>$axstock_1</td>
		<td style='text-align:center;'>$axcant_requerida</td>
	</tr>";

	}else{

		if($axstock_1==''){
			$axstock_1 =0;
		}

		echo "<tr>		
		<td style='text-align:center;'><b class='text-danger'>$it</b></td>	
		<td style='text-align:center;'><b class='text-danger'>$axlocal_corto</b></td>	
		<td style='text-align:center;'><b class='text-danger'>$axcod_producto</b></td>
		<td style='text-align:left;'><b class='text-danger'>$axnom_producto</b></td>
		<td style='text-align:center;'><b class='text-danger'>$axstock_1</b></td>
		<td style='text-align:center;'><b class='text-danger'>$axcant_requerida</b></td>
	</tr>";

	}

	
}

echo "</table>";


break;

case '121':
 /*El comprobante se ANULA EN LA WEB E ITC, EL Pedido, que estado PENDIENT a la espera de ser PROGRAMADO y si tiene GUIA REMISION queda ANULADA*/
	$axcodmovcz= $_POST['txtcod_mov_cz'];
	$axidlocal= $_POST['txtid_local'];
	$axfecha_anulado = $_POST['txtfecha_anulacion'];
	$axestado_comprobante= $_POST['txtestado_comprobante'];
	$axmotivo_anulacion= $_POST['txtmotivo_baja'];

	$axnum_pedido = get_row('MAESTRO_CZ','NUM_PEDIDO','COD_MOV',$axcodmovcz);
	$axcod_guia_cz = get_row('GUIA_REMISION_CZ','COD_GUIA_CZ','COD_MOV',$axcodmovcz);
	$axcomprobante = get_row('MAESTRO_CZ','TXT_SERIE','COD_MOV',$axcodmovcz).'-'.get_row('MAESTRO_CZ','DOCUMENTO','COD_MOV',$axcodmovcz);
	$axestado_final = $axestado_comprobante.' | '.$axcomprobante;

	$axfecha_emision = get_row('MAESTRO_CZ','FECHA_EMISION','COD_MOV',$axcodmovcz);


	$SQLBaja = "UPDATE MAESTRO_CZ SET TXT_DESCR_MTVO_BAJA='$axmotivo_anulacion', ESTADO_ELECTRO='$axestado_comprobante', FECHA_REFERENCIA='$axfecha_anulado',NUM_PEDIDO='',COD_GUIA_CZ='',ESTADO_INVENTARIO='$axestado_comprobante' WHERE COD_MOV = '$axcodmovcz' AND ID_LOCAL='$axidlocal'";
	$RSBaja = odbc_exec($con, $SQLBaja);

	if($RSBaja){

		$SQLPedidos = "UPDATE PEDIDOS SET COD_GUIA_CZ='',ID_VEHICULO='',NOM_CHOFER='',NUM_DESPACHO='',ESTADO_REVISION='ABIERTO',ESTADO_ATENDIDO='PENDIENTE' WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axidlocal'";
		$RSpedidos = odbc_exec($con,$SQLPedidos);

		$SQLGuias = "UPDATE GUIA_REMISION_CZ SET ESTADO_FINAL='$axestado_final' WHERE COD_GUIA_CZ='$axcod_guia_cz'";
		$RSpedidos = odbc_exec($con,$SQLGuias);

		$respuesta=0;
		echo $respuesta;
	} else{

		$respuesta=1;
		echo $respuesta;

	}	




break;

case '122':
header('Content-Type: application/json; charset=utf-8');


$axcodmovcz = trim($_POST['txtcod_mov_cz']);
$axidlocal= get_row('MAESTRO_CZ','ID_LOCAL','COD_MOV',$axcodmovcz);
$axcod_guia_cz = get_row('GUIA_REMISION_CZ','COD_GUIA_CZ','COD_MOV',$axcodmovcz);
$cod_cliente_emis= get_row('LOCALES','cod_cliente_emis','ID_LOCAL',$axidlocal);
$axruta= get_row('LOCALES','RUTA_JSON','ID_LOCAL',$axidlocal);
$axtoken= get_row('LOCALES','TOKEN_EMPRESA','ID_LOCAL',$axidlocal);
$axurl= get_row('LOCALES','URL_PRODUCCION','ID_LOCAL',$axidlocal);
//$axurl= get_row('LOCALES','URL_PRUEBAS','ID_LOCAL',$axidlocal);

$SQLDatos_1 ="SELECT TOP 1 * FROM MAESTRO_GENERAR_JSON WHERE COD_MOV='$axcodmovcz' AND ID_LOCAL='$axidlocal'";
$RSDatos_1=odbc_exec($con,$SQLDatos_1);
$row=odbc_fetch_array($RSDatos_1);
			
	$axrucempresa= $row['RUC_EMPRESA'];
	$axtipodoc= $row['COD_SUNAT'];
	$axnserie= $row['TXT_SERIE'];
	$axcorrelativo= $row['DOCUMENTO'];
	$axdocumento_tipo= $row['DETALLE_DOC'];
	
	$LblNombreArchivo = $axrucempresa.'-'.$axtipodoc.'-'.$axnserie.'-'.$axcorrelativo.'-C.json';
	//echo $LblNombreArchivo;

	$response=array();

	$SQLDatosCZ ="SELECT identificador,fec_emis,fec_gener_baja,cod_tip_escenario,txt_serie,cod_iden_cb,cod_cliente_emis,num_ruc_emis,txt_correlativo,cod_tip_cpe,txt_descr_mtvo_baja FROM F_JSON_BAJA WHERE COD_MOV='$axcodmovcz'";
	$RSDatosCZ=odbc_exec($con,$SQLDatosCZ);
	$filacz = odbc_fetch_array($RSDatosCZ);

	//$response = array($filacz);

	$array1    = $filacz;
	$resultado = $array1;
	//var_dump($resultado);

	$jsonfinal_1 = json_encode($resultado,JSON_PRETTY_PRINT|JSON_PRESERVE_ZERO_FRACTION);	
	$jsonfinal = preg_replace('#:"(\d+)"#', ':$1', $jsonfinal_1);
	

	$file = $axruta.$LblNombreArchivo;   
	file_put_contents($file, $jsonfinal);

	
	if($cod_cliente_emis !==''){		

	$axnom_archivo = $axruta.$LblNombreArchivo;
	//echo $axnom_archivo;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $axurl);
	$parametros = @file_get_contents($axnom_archivo);

	//echo $parametros;

	curl_setopt( $ch, CURLOPT_POSTFIELDS, $parametros);
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization: '.$axtoken));
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	$result = curl_exec($ch);

	$codigoRespuesta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	//echo $codigoRespuesta.'<br>';

	if($codigoRespuesta === 200){
	    
		
		$SQLActualizar = "UPDATE MAESTRO_CZ SET BOUCHER_DIGITAL='$LblNombreArchivo',ESTADO_ENVIADO_ITC='ENVIADO' WHERE COD_MOV='$axcodmovcz'";
		$RSActualizar = odbc_exec($con, $SQLActualizar);
	

		$respuesta = 0;
		echo $respuesta;
	
	}else{

	    $SQLActualizar = "UPDATE MAESTRO_CZ SET BOUCHER_DIGITAL='$LblNombreArchivo',ESTADO_ENVIADO_ITC='PENDIENTE' WHERE COD_MOV='$axcodmovcz'";
		$RSActualizar = odbc_exec($con, $SQLActualizar);

		$respuesta = 1;
		echo $respuesta;
		

	}
	curl_close($ch);

}


break;
case '123':

/**Elimina la NOTA SALIDA y el pedido pasa a estado REVISION sin GUIA DE REMISION**/

	$axcodmovcz = $_POST['axcod_mov_cz'];
	$axnum_pedido = get_row('MAESTRO_CZ','NUM_PEDIDO','COD_MOV',$axcodmovcz);
	$axid_local = get_row('MAESTRO_CZ','ID_LOCAL','COD_MOV',$axcodmovcz);

	$SQLMaestro_dt = "DELETE FROM MAESTRO_DT WHERE COD_MOV='$axcodmovcz'";
	$RSMaestro_dt = odbc_exec($con,$SQLMaestro_dt);
	//echo $SQLMaestro_dt;


	if($RSMaestro_dt){

		$SQLMaestro_cz = "DELETE FROM MAESTRO_CZ WHERE COD_MOV='$axcodmovcz'";
		$RSMaestro_cz = odbc_exec($con,$SQLMaestro_cz);

		$SQLPedidos = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='REVISION',COD_GUIA_CZ='' WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
		$RSpedidos = odbc_exec($con,$SQLPedidos);

		$respuesta = 0;
		echo $respuesta;		



	}else{

		$respuesta = 1;
		echo $respuesta;
	}

break;

case '124':	

$axnum_pedido = $_POST['axnum_pedido']; 	
$axid_empresa = $_POST['txtid_empresa'];

$axid_local = get_row('PEDIDOS_CZ','ID_LOCAL','NUM_PEDIDO',$axnum_pedido)	;
$axcodusuario = get_row('PEDIDOS_CZ','ID_USUARIO','NUM_PEDIDO',$axnum_pedido)	;
	
$axdni_user = get_row('usuarios','COD_USUARIO','ID_USUARIO',$axcodusuario);
//$axcorrelativo = get_row('EMPRESA','CORRELATIVO_PEDIDOS','ID_EMPRESA',$axid_empresa)+1;

$axserie_vendedor = get_row('usuarios','N_SERIE_VENDEDOR','ID_USUARIO',$axcodusuario);
$axcorrelativo = get_row('usuarios','CORRELATIVO_VENDEDOR','ID_USUARIO',$axcodusuario)+1;

$SQLActualizar_correlativo = "UPDATE USUARIO SET CORRELATIVO_VENDEDOR='$axcorrelativo' WHERE ID_USUARIO='$axcodusuario'";		
//$SQLActualizar_correlativo = "UPDATE EMPRESA SET CORRELATIVO_PEDIDOS='$axcorrelativo' WHERE ID_EMPRESA ='$axid_empresa'";
$RSActualizar_correlativo = odbc_exec($con,$SQLActualizar_correlativo);

//$nuevo_nombre = number_pad($axcorrelativo,4);
$nuevo_nombre = $axserie_vendedor.'-'.$axcorrelativo;
$axcodmovcz = trim($nuevo_nombre);
//echo trim($axcodmovcz);

$axveri_pedido = get_row('PEDIDOS_PARCIAL','NUM_PEDIDO','NUM_PEDIDO',$axnum_pedido);

/**HACER UNA COPIA DEL PEDIDO EN PEDIDOS_PARCIALES**/

if($axveri_pedido !==''){

	$SQLEliminar = "DELETE FROM PEDIDOS_PARCIAL WHERE NUM_PEDIDO='$axnum_pedido'";
	$RSEliminar = odbc_exec($con,$SQLEliminar);

$SqlCopiar ="INSERT INTO PEDIDOS_PARCIAL (NUM_PEDIDO,ID_USUARIO,ID_BENEFICIARIO,DIRECCION_ENTREGA,FECHA_PEDIDO,HORA_PEDIDO,ID_PRODUCTO,CANT_SALIDA,PRS_MENOR,PRS_MAYOR,PRS_PREMIUN,COSTO_PRODUCTO,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,OBSERV_ENTREGA,ESTADO_ATENDIDO,TOTAL_PEDIDO,PRS_VENTA,ID_LOCAL,ID_AGENCIA,ID_TD,FECHA_DESPACHO,FORMA_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,NUM_TRANSF,ID_CTA,PERIODO_TRANSF,FECHA_TRANSF,DIAS_CREDITO,ID_PRODUCTO_PADRE,CANT_PADRE,ESTADO_REVISION,TIPO_ENTREGA,NUM_PEDIDO_PARCIAL,TIPO_VENTA,ESTADO_ANULADA) SELECT NUM_PEDIDO,ID_USUARIO,ID_BENEFICIARIO,DIRECCION_ENTREGA,FECHA_PEDIDO,HORA_PEDIDO,ID_PRODUCTO,CANT_SALIDA,PRS_MENOR,PRS_MAYOR,PRS_PREMIUN,COSTO_PRODUCTO,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,OBSERV_ENTREGA,ESTADO_ATENDIDO,TOTAL_PEDIDO,PRS_VENTA,ID_LOCAL,ID_AGENCIA,ID_TD,FECHA_DESPACHO,FORMA_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,NUM_TRANSF,ID_CTA,PERIODO_TRANSF,FECHA_TRANSF,DIAS_CREDITO,ID_PRODUCTO_PADRE,CANT_PADRE,ESTADO_REVISION,TIPO_ENTREGA,NUM_PEDIDO_PARCIAL,TIPO_VENTA,ESTADO_ANULADA FROM PEDIDOS WHERE NUM_PEDIDO='$axnum_pedido'";
	$RSCopiar = odbc_exec($con,$SqlCopiar);

}else{

	$SqlCopiar ="INSERT INTO PEDIDOS_PARCIAL (NUM_PEDIDO,ID_USUARIO,ID_BENEFICIARIO,DIRECCION_ENTREGA,FECHA_PEDIDO,HORA_PEDIDO,ID_PRODUCTO,CANT_SALIDA,PRS_MENOR,PRS_MAYOR,PRS_PREMIUN,COSTO_PRODUCTO,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,OBSERV_ENTREGA,ESTADO_ATENDIDO,TOTAL_PEDIDO,PRS_VENTA,ID_LOCAL,ID_AGENCIA,ID_TD,FECHA_DESPACHO,FORMA_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,NUM_TRANSF,ID_CTA,PERIODO_TRANSF,FECHA_TRANSF,DIAS_CREDITO,ID_PRODUCTO_PADRE,CANT_PADRE,ESTADO_REVISION,TIPO_ENTREGA,NUM_PEDIDO_PARCIAL,TIPO_VENTA,ESTADO_ANULADA) SELECT NUM_PEDIDO,ID_USUARIO,ID_BENEFICIARIO,DIRECCION_ENTREGA,FECHA_PEDIDO,HORA_PEDIDO,ID_PRODUCTO,CANT_SALIDA,PRS_MENOR,PRS_MAYOR,PRS_PREMIUN,COSTO_PRODUCTO,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,OBSERV_ENTREGA,ESTADO_ATENDIDO,TOTAL_PEDIDO,PRS_VENTA,ID_LOCAL,ID_AGENCIA,ID_TD,FECHA_DESPACHO,FORMA_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,NUM_TRANSF,ID_CTA,PERIODO_TRANSF,FECHA_TRANSF,DIAS_CREDITO,ID_PRODUCTO_PADRE,CANT_PADRE,ESTADO_REVISION,TIPO_ENTREGA,NUM_PEDIDO_PARCIAL,TIPO_VENTA,ESTADO_ANULADA FROM PEDIDOS WHERE NUM_PEDIDO='$axnum_pedido'";
	$RSCopiar = odbc_exec($con,$SqlCopiar);


}


$SQLBuscar = "SELECT  * FROM PEDIDOS WHERE ID_LOCAL	='$axid_local' AND NUM_PEDIDO='$axnum_pedido'";
$RSBuscar = odbc_exec($con,$SQLBuscar);

//echo $SQLBuscar;

while ($fila_p =odbc_fetch_array($RSBuscar)) {
	
$axid_pedido =$fila_p['ID_PEDIDO'];
$axnum_pedido_nuevo =$axcodmovcz;
$axid_local =$fila_p['ID_LOCAL'];
$axcodusuario =$fila_p['ID_USUARIO'];
$axid_beneficiario =$fila_p['ID_BENEFICIARIO'];
$axdireccion_entrega =$fila_p['DIRECCION_ENTREGA'];
$axfecha_pedido =$fila_p['FECHA_PEDIDO'];
$axhora_pedido =$fila_p['HORA_PEDIDO'];
$axid_producto_hijo =$fila_p['ID_PRODUCTO'];
$axcant_salida_padre =$fila_p['CANT_PADRE'];
$axcant_salida =$fila_p['CANT_SALIDA'];

$axprs_menor =$fila_p['PRS_MENOR'];
$axprs_mayor =$fila_p['PRS_MAYOR'];
$axprs_premiun =$fila_p['PRS_PREMIUN'];
$axcosto_producto =$fila_p['COSTO_PRODUCTO'];
$axdsctos_salida =$fila_p['DSCTOS_SALIDA'];
$axvalor_salida =$fila_p['VALOR_SALIDA'];
$axigv_salida =$fila_p['IGV_SALIDA'];
$axgravadas_salida =$fila_p['GRAVADAS_SALIDA'];
$axinafecto_salida =$fila_p['INAFECTO_SALIDA'];
$axexonerado_salida =$fila_p['EXONERADO_SALIDA'];
$axtotal_salida =$fila_p['TOTAL_SALIDA'];
$axobserv_proforma =$fila_p['OBSERV_ENTREGA'];
$axestado_atendido =$fila_p['ESTADO_ATENDIDO'];
$axestado_revision =$fila_p['ESTADO_REVISION'];
$axtotal_pedido =$fila_p['TOTAL_PEDIDO'];
$axprs_venta_hijo =$fila_p['PRS_VENTA'];

$axid_agencia =$fila_p['ID_AGENCIA'];
$axiid_td =$fila_p['ID_TD'];
$axfecha_despacho =$fila_p['FECHA_DESPACHO'];

$axforma_pago =$fila_p['FORMA_PAGO'];
$axestado_forma_pago =$fila_p['ESTADO_FORMA_PAGO'];
$axmedio_pago =$fila_p['MEDIO_PAGO'];
$axid_cta =$fila_p['ID_CTA'];
$axnum_transf =$fila_p['NUM_TRANSF'];
$axfecha_transf =$fila_p['FECHA_TRANSF'];
$axperiodo_transf = $fila_p['PERIODO_TRANSF'];

$axdias_pago =$fila_p['DIAS_CREDITO'];
$axid_padre=$fila_p['ID_PRODUCTO_PADRE'];


$sqlinserta ="INSERT INTO PEDIDOS (NUM_PEDIDO,ID_USUARIO,ID_BENEFICIARIO,DIRECCION_ENTREGA,FECHA_PEDIDO,HORA_PEDIDO,ID_PRODUCTO,CANT_SALIDA,PRS_MENOR,PRS_MAYOR,PRS_PREMIUN,COSTO_PRODUCTO,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,OBSERV_ENTREGA,ESTADO_ATENDIDO,TOTAL_PEDIDO,PRS_VENTA,ID_LOCAL,ID_AGENCIA,ID_TD,FECHA_DESPACHO,FORMA_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,NUM_TRANSF,ID_CTA,PERIODO_TRANSF,FECHA_TRANSF,DIAS_CREDITO,ID_PRODUCTO_PADRE,CANT_PADRE,ESTADO_REVISION,TIPO_ENTREGA,NUM_PEDIDO_PARCIAL,TIPO_VENTA,ESTADO_ANULADA) values ('$axnum_pedido_nuevo','$axcodusuario','$axid_beneficiario','$axdireccion_entrega','$axfecha_pedido','$axhora_pedido','$axid_producto_hijo','$axcant_salida','$axprs_menor','$axprs_mayor','$axprs_premiun','$axcosto_producto','$axdsctos_salida','$axvalor_salida','$axigv_salida','$axgravadas_salida','$axinafecto_salida','$axexonerado_salida','$axtotal_salida','$axobserv_proforma','$axestado_atendido','$axtotal_pedido','$axprs_venta_hijo','$axid_local','$axid_agencia','$axiid_td','$axfecha_despacho','$axforma_pago','$axestado_forma_pago','$axmedio_pago','$axnum_transf','$axid_cta','$axperiodo_transf','$axfecha_transf','$axdias_pago','$axid_padre','$axcant_salida_padre','$axestado_revision','PARCIAL','$axnum_pedido','VENTA','ACTIVO')";
	$rsinserta = odbc_exec($con,$sqlinserta);
	//echo $sqlinserta.'<br>';
		
}

if($rsinserta){

	$SQLActualizar = "UPDATE PEDIDOS SET NUM_PEDIDO_PARCIAL='$axnum_pedido',TIPO_ENTREGA='PARCIAL' WHERE NUM_PEDIDO='$axnum_pedido'";
	$RSActualizar = odbc_exec($con,$SQLActualizar);

	$respuesta = $axnum_pedido_nuevo;
	echo $respuesta;

}else{

	$respuesta = 1;
	echo $respuesta;

}

break;

case '125':

$axnum_pedido = trim($_POST['txtnum_pedido_copia']); 
$axid_local = get_row('PEDIDOS_CZ','ID_LOCAL','NUM_PEDIDO',$axnum_pedido)	;

$axnom_cliente = get_row('PEDIDOS_CZ','NOM_COMERCIAL','NUM_PEDIDO',$axnum_pedido)	;
$axruc_cliente = get_row('PEDIDOS_CZ','RUC_BENEF','NUM_PEDIDO',$axnum_pedido)	;
$axdireccion_entrega = get_row('PEDIDOS_CZ','DIRECCION_ENTREGA','NUM_PEDIDO',$axnum_pedido)	;
$axreferencia = get_row('PEDIDOS_CZ','REFERENCIA','NUM_PEDIDO',$axnum_pedido)	;
$axhorario_entrega = get_row('PEDIDOS_CZ','HORARIO_ATENCION','NUM_PEDIDO',$axnum_pedido)	;
$axid_local = get_row('PEDIDOS_CZ','ID_LOCAL','NUM_PEDIDO',$axnum_pedido)	;
$axid_empresa= get_row('PEDIDOS_CZ','ID_EMPRESA','NUM_PEDIDO',$axnum_pedido)	;


$axfecha_despacho = get_row('PEDIDOS_CZ','FECHA_DESPACHO','NUM_PEDIDO',$axnum_pedido);
$axid_td= get_row('PEDIDOS_CZ','ID_TD','NUM_PEDIDO',$axnum_pedido);
$axtipodocumento= get_row('TIPO_DOCUMENTOS','DETALLE_DOC','ID_TD',$axid_td);




$SQLBuscar = "SELECT * FROM PEDIDOS_DT WHERE ID_LOCAL	='$axid_local' AND NUM_PEDIDO='$axnum_pedido' order by HORA_PEDIDO ASC";
//echo "$SQLBuscar";

	echo "
		<div text-center'>
    	<h4 class='card-title text-danger fw-bold'>".$axnum_pedido."</h4>
  	</div>
		<table class='table table-hover table-sm'>	
		<thead class='table-success'>				
		<tr>			
			<th class='table-danger' style='text-align: center;'>It</th>						
			<th class='table-danger' style='text-align: left;'>Detalle del Pedido</th>									
			<th class='table-danger' style='text-align: right;'>Stock</th>					
			<th class='table-danger' style='text-align: right;'>Costo</th>		
			<!--th class='table-danger' style='text-align: right;'>Cant. Padre</th-->				
			


			<th style='text-align: right;'>Cant</th>									
			<th style='text-align: right;'>Prs.Venta</th>			
			<th style='text-align: right;'>Importe</th>			
			

		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$axid_dt = $fila['ID_PEDIDO'];		
 		$axnom_producto = $fila['ID_BENEFICIARIO'];		
		$axcant_salida =number_format($fila["CANT_SALIDA"],2,".",","); 
		$axprs_venta =number_format($fila["PRS_VENTA"],2,".",","); 
		$axprs_minimo =number_format($fila["PRS_MINIMO"],2,".",","); 
		$axtotal_salida =number_format($fila["TOTAL_SALIDA"],2,".",","); 
		$cod_producto = $fila['COD_PRODUCTO'];
		$axid_producto = $fila['ID_PRODUCTO'];
		$axid_producto_padre= $fila['ID_PRODUCTO_PADRE'];
		$nom_categoria = $fila['NOM_CATEGORIA'];
		$nom_producto = $fila['NOM_PRODUCTO'];
		$tipo = $fila['TIPO'];
		$presentacion = $fila['PRESENTACION'];
		$procedencia = $fila['PROCEDENCIA'];
		$axcant_salida_padre = $fila['CANT_PADRE'];
		$estado = $fila['ESTADO'];
		$cant_caja = $fila['CANT_CAJA'];
		$cant_padre = $fila['CANT_PADRE'];
		$axprs_unit = number_format(($axprs_venta/$cant_caja),3,".",","); 
		$axcosto_producto= number_format($fila['COSTO_PRODUCTO'],3,".",","); 

		//$axprod_mostrar = $cod_producto.' | '.$nom_producto.' '.$tipo.' '.$presentacion.' '.$cant_caja.'<br><b class="text-danger"> Cant. '.$axcant_salida.'  |Prs. Unit. '.$axprs_unit.' |Cja/Mll : '.$axprs_venta.'  |Total : '.$axtotal_salida.'</b>';					

		$axprod_mostrar = $cod_producto.' | '.$nom_producto.' '.$tipo.' '.$presentacion.' '.$cant_caja;		

		$SQLStock = "SELECT STOCK_ACTUAL FROM PRODUCTOS_LISTADO_STOCK_1 WHERE ID_LOCAL='$axid_local' AND COD_PRODUCTO='$cod_producto'";
		$RSStock = odbc_exec($con,$SQLStock);
		$fila_stock = odbc_fetch_array($RSStock);
		$axstock_actual = number_format($fila_stock['STOCK_ACTUAL'],2,".",",");  

		if($axstock_actual == ''){
			$axstock_actual = number_format(0,2,".",",");		
		}
	
		echo "<tr>

			<td style='text-align: center;'>$it</td>
			<td style='text-align: left;'><a href='#' id='btn_eliminar_producto_del_pedido_m1' data-npedido='$axnum_pedido' data-local='$axid_local' data-produto='$axid_producto_padre'><i class='bi bi-trash3-fill text-danger'></i></a> ".utf8_encode($axprod_mostrar)."</td>			
			<td style='text-align: right;' class='text-danger'>$axstock_actual</td>
			<td style='text-align: right;'>$axcosto_producto</td>	
			<!--td style='text-align: right;'>$cant_padre</td-->	
			
						
			<td contenteditable class='table-success' style='text-align: right;' data-idprod='$axid_producto' data-idpd='$axid_dt' data-precio='$axprs_venta' data-local='$axid_local' data-id='$axnum_pedido' data-stok ='$axstock_actual' id='txtcant_salida_m1' >$axcant_salida</td>					
			
			<td contenteditable class='table-success' style='text-align: right;' data-idprod='$axid_producto' data-idpd='$axid_dt' data-cant='$axcant_salida_padre' data-local='$axid_local' data-id='$axnum_pedido' data-prs_min='$axprs_minimo' id='txtprs_venta_m1'>$axprs_venta</td>

			<td style='text-align: right;'>$axtotal_salida</td>
			</tr>";
		}

		$SQLTotal = "SELECT SUM(TOTAL_SALIDA) AS TT FROM PEDIDOS_DT WHERE	ID_EMPRESA='$axid_empresa' AND NUM_PEDIDO='$axnum_pedido'";
		$RSTotal = odbc_exec($con,$SQLTotal);
		//echo $SQLTotal;

		$fila_t = odbc_fetch_array($RSTotal);
 		$axtotal_pedido = number_format($fila_t["TT"],2,".",","); 

 		echo "<tr>
 			<td colspan='9' style='text-align: right;'><b class='text-primary'>Total Pedido   :    ".$axtotal_pedido."</b></td> 
		</tr>";
		
}
echo "</table>";

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

case '127':
	
/**El pedido pasa a estado REVISION, EL COMPROBANTE pasa a estado RECHAZADA y la GUIA REMISION se deberá ANULAR en la SUNAT**/

	$axcod_mov_cz = $_POST['txtcod_mov_cz']; 		
	$axnum_pedido = get_row('MAESTRO_CZ','NUM_PEDIDO','COD_MOV',$axcod_mov_cz);
	$axid_local = get_row('MAESTRO_CZ','ID_LOCAL','COD_MOV',$axcod_mov_cz);

	$axcod_guia_cz = get_row('MAESTRO_CZ','COD_GUIA_CZ','COD_MOV',$axcod_mov_cz);
	$axcomprobante = get_row('MAESTRO_CZ','TXT_SERIE','COD_MOV',$axcod_mov_cz).'-'.get_row('MAESTRO_CZ','DOCUMENTO','COD_MOV',$axcod_mov_cz);
	$axestado_final = 'RECHAZADA | '.$axcomprobante;

	$SQLActualizar_pedidos = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='REVISION' WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
	$RSActualizar_pedidos = odbc_exec($con,$SQLActualizar_pedidos);

	if($RSActualizar_pedidos){

		$SQLActualizar_maestro = "UPDATE MAESTRO_CZ SET ESTADO_ELECTRO='RECHAZADA', ESTADO_INVENTARIO='RECHAZADA', NUM_PEDIDO='',COD_GUIA_CZ='' WHERE COD_MOV='$axcod_mov_cz'";
		$RSActualizar_pedidos = odbc_exec($con,$SQLActualizar_maestro);

		$SQLGuias = "UPDATE GUIA_REMISION_CZ SET ESTADO_FINAL='$axestado_final' WHERE COD_GUIA_CZ='$axcod_guia_cz'";
		$RSpedidos = odbc_exec($con,$SQLGuias);

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;

	}

break;


case '128':


$axfecha_despacho = $_POST['txtfecha_despacho']; 		
$axnum_despacho = $_POST['txtnum_despacho']; 		
$axid_vehiculo = $_POST['txtid_vehiculo']; 		

$sqlbuscar = "SELECT ID_PRODUCTO,COD_PRODUCTO,NOM_PRODUCTO,SUM(CANT_SALIDA) AS TT from PEDIDOS_DESPACHAR_REPORTE WHERE FECHA_DESPACHO='$axfecha_despacho' AND NUM_DESPACHO ='$axnum_despacho' AND ID_VEHICULO='$axid_vehiculo' GROUP BY ID_PRODUCTO,COD_PRODUCTO,NOM_PRODUCTO ORDER BY COD_PRODUCTO";
//echo $sqlbuscar;

$RSBuscar =odbc_exec($con,$sqlbuscar);

echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			
			<th style='text-align: center;'>Código</th>
			<th style='text-align: left;'>Productos</th>
			<th style='text-align: right;'>Cantidad</th>
			
		</tr>
		</thead>";

	if(odbc_num_rows($RSBuscar)> 0){

		while ($fila = odbc_fetch_array($RSBuscar)) {
			
			$axid_producto= $fila['ID_PRODUCTO'];
			$axcod_producto = $fila['COD_PRODUCTO'];
			$axnom_producto = $fila['NOM_PRODUCTO'];			
			$axcant_salida = number_format($fila["TT"],2,".",","); 


			echo "<tr>

				<td style='text-align: center;'>$axcod_producto</td>
				<td style='text-align: left;'>$axnom_producto</td>
				<td style='text-align: right;'><a href='#' id='btn_ver_detalle_producto' style='text-decoration:none;' data-idprod='$axid_producto'>$axcant_salida</a></td>
			</tr>";
		}
		$sqlbuscar_TT = "SELECT NUM_DESPACHO,SUM(CANT_SALIDA) AS TT from PEDIDOS_DESPACHAR_REPORTE WHERE NUM_DESPACHO ='$axnum_despacho' GROUP BY NUM_DESPACHO";
		$rsbuscar_tt = odbc_exec($con,$sqlbuscar_TT);
		$fila_tt = odbc_fetch_array($rsbuscar_tt);
		$total =  number_format($fila_tt["TT"],2,".",",");
		echo "<tr>

				<th style='text-align: center;' colspan='2'>Total cajas</th>
				<th style='text-align: right;'><b>$total</b></th>
				
			</tr>";






		echo "</table>";

	}else{

	}


break;
case '129':
	
$axid_producto = $_POST['txtid_producto']; 			
$axfecha_despacho = $_POST['txtfecha_despacho']; 		
$axnum_despacho = $_POST['txtnum_despacho']; 		
$axid_vehiculo = $_POST['txtid_vehiculo']; 		

$sqlbuscar = "SELECT * from PRODUCTOS_SEGUN_CLIENTES WHERE ID_PRODUCTO='$axid_producto' AND  FECHA_DESPACHO='$axfecha_despacho' AND NUM_DESPACHO ='$axnum_despacho' AND ID_VEHICULO='$axid_vehiculo' ORDER BY NOM_COMERCIAL ASC";
//echo $sqlbuscar;

$RSBuscar =odbc_exec($con,$sqlbuscar);

echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			
			<th style='text-align: center;'>Pedido</th>
			<th style='text-align: left;'>Cliente</th>
			<th style='text-align: right;'>Cantidad</th>
			
		</tr>
		</thead>";

	if(odbc_num_rows($RSBuscar)> 0){

		while ($fila = odbc_fetch_array($RSBuscar)) {
			
			$axnum_pedido= $fila['NUM_PEDIDO'];
			$axnom_comercial = $fila['NOM_COMERCIAL'];			
			$axcant_salida = number_format($fila["CANT_SALIDA"],2,".",","); 


			echo "<tr>

				<td style='text-align: center;'>$axnum_pedido</td>
				<td style='text-align: left;'>$axnom_comercial</td>
				<td style='text-align: right;'>$axcant_salida</td>
			</tr>";
		}

		echo "</table>";

	}else{

	}
break;

case '130':
	

$axnom_producto = $_POST['txtnom_producto']; 	
$axid_empresa = $_POST['txtid_empresa']; 	

	if($axnom_producto==""){
		
		$SQLBuscar = "SELECT  TOP 15  * FROM PRODUCTOS_LISTADO WHERE ID_EMPRESA = '$axid_empresa' AND COSTO_PRODUCTO > 0  ORDER BY NOM_PRODUCTO DESC";
		
	}else{

		$SQLBuscar ="SELECT  TOP 15 * FROM PRODUCTOS_LISTADO WHERE ID_EMPRESA = '$axid_empresa' AND COSTO_PRODUCTO > 0 AND NOM_PRODUCTO+COD_PRODUCTO like '%".$axnom_producto."%' ORDER BY NOM_PRODUCTO DESC";

	}

	//echo "$SQLBuscar";

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th style='text-align: left;'>Productos </th>			
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$id_producto = $fila['ID_PRODUCTO'];
		$cod_producto = $fila['COD_PRODUCTO'];
		$nom_categoria = $fila['NOM_CATEGORIA'];
		$nom_producto = $fila['NOM_PRODUCTO'];
		$tipo = $fila['TIPO'];
		$presentacion = $fila['PRESENTACION'];
		$procedencia = $fila['PROCEDENCIA'];
		$axfactor = $fila['FACTOR_PROD'];
		$estado = $fila['ESTADO'];
		$cant_caja = $fila['CANT_CAJA'];
		$axprs_menimo=  number_format($fila["PRS_MINIMO"],4,".",","); 
		$axprs_menor=  number_format($fila["PRS_MENOR"],4,".",","); 
		$axprs_mayor= number_format($fila["PRS_MAYOR"],4,".",",");
		$axprs_premium=  number_format($fila["PRS_PREMIUN"],4,".",","); 
		$stock_actual= number_format($fila["STOCK_ACTUAL"],4,".",","); 
		$axafectacion= $fila['ABREV_AFECTACION'];
		$axprod_mostrar ='CI: '.$cod_producto.' | <b>'.$tipo.' </b> '.$nom_producto;				

		echo "<tr>
		 		<td style='text-align: justify;'>
					<a href='#' id='btn_producto_agregar' data-afect='$axafectacion' data-factor='$axfactor' data-prs_men='$axprs_menor' data-prs_pre='$axprs_premium' data-prs_may='$axprs_mayor' data-prs_min='$axprs_menimo' data-id='$id_producto' style='text-decoration:none;' >".utf8_encode($axprod_mostrar)."</a>
				</td> 
				</tr>";
		}

echo "</table>";
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
	case '133':
		
		/**LA GUIA REMISION CAMBIA ESTADO RECHAZAADA EN LA WEB Y SUNAT, EL COMPROBANTE QUEDA SIN GUIA REMISION**/
	
		$axcod_guia_cz = $_POST['txtcod_guia_cz']; 			
		$axid_local = $_POST['txtid_local']; 		
		$axcod_mov_cz =get_row('GUIA_REMISION_CZ','COD_MOV','COD_GUIA_CZ',$axcod_guia_cz);		

		$SQLActualizar_pedidos = "UPDATE GUIA_REMISION_CZ SET ESTADO_ELECTRO='RECHAZADA',COD_MOV='' WHERE COD_GUIA_CZ='$axcod_guia_cz' AND ID_LOCAL='$axid_local'";
		$RSActualizar_pedidos = odbc_exec($con,$SQLActualizar_pedidos);

	if($RSActualizar_pedidos){

		$SQLActualizar_maestro = "UPDATE MAESTRO_CZ SET COD_GUIA_CZ='' WHERE COD_MOV='$axcod_mov_cz' AND ID_LOCAL='$axid_local'";
		$RSActualizar_pedidos = odbc_exec($con,$SQLActualizar_maestro);

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;

	}

	break;

	case '134':
	
	$axid_local = $_POST['txtid_local']; 				
	$axtipo_documento = $_POST['txttipo_documento']; 			
	$axfecha_emision_del = $_POST['txtfecha_emision_del']; 			
	$axfecha_emision_al = $_POST['txtfecha_emision_al']; 			
	$axnom_cliente = $_POST['txtnom_cliente']; 			
	$axnum_comprobante_emitido = $_POST['txtnum_comprobante_emitido']; 			


	if($axtipo_documento=='FACTURA' || $axtipo_documento=='BOLETA DE VENTA' || $axtipo_documento=='NOTA DE CREDITO' || $axtipo_documento=='NOTA SALIDA'){

		if($axnom_cliente !==''){

			$SQLBuscar = "SELECT * FROM DOC_MAESTRO_EMITIDOS WHERE ID_LOCAL='$axid_local' AND DETALLE_DOC='$axtipo_documento' AND FECHA_EMISION BETWEEN '$axfecha_emision_del' AND '$axfecha_emision_al' AND NOM_COMERCIAL LIKE '%".$axnom_cliente."%' ORDER BY DOCUMENTO ASC";
		
		}elseif($axnum_comprobante_emitido!==''){

			$SQLBuscar = "SELECT * FROM DOC_MAESTRO_EMITIDOS WHERE ID_LOCAL='$axid_local' AND DETALLE_DOC='$axtipo_documento' AND FECHA_EMISION BETWEEN '$axfecha_emision_del' AND '$axfecha_emision_al' AND CORRELATIVO LIKE '%".$axnum_comprobante_emitido."%' ORDER BY DOCUMENTO ASC";
			
		}else{

			$SQLBuscar = "SELECT * FROM DOC_MAESTRO_EMITIDOS WHERE ID_LOCAL='$axid_local' AND DETALLE_DOC='$axtipo_documento' AND FECHA_EMISION BETWEEN '$axfecha_emision_del' AND '$axfecha_emision_al' ORDER BY DOCUMENTO ASC";
			
		}	

//echo $SQLBuscar;
			$RSBuscar = odbc_exec($con,$SQLBuscar);
			if(odbc_num_rows($RSBuscar) > 0){
			echo "
				<table class='table table-hover table-sm'>
				<thead class='table-primary'>			
				<tr>
					<th style='text-align: center;'>Item</th>
					<th style='text-align: left;'>Cliente</th>
					<th style='text-align: center;'>Correlativo</th>
					<th style='text-align: center;'>Fecha Emisión</th>
					<th style='text-align: center;'>Estado</th>
					<th style='text-align: right;'>Monto</th>
					<th style='text-align: center;'> Acción</th>
				</tr>
				</thead>";

				while ($fila = odbc_fetch_array($RSBuscar)) {
					
					$it=$it+1;
					$axcod_mov = $fila['COD_MOV'];	
					$axcliente = $fila['NOM_COMERCIAL'];	
					$axcorrelativo = $fila['CORRELATIVO'];	
					$axserie = $fila['TXT_SERIE'];	
					$axdocumento= $fila['DOCUMENTO'];	
					$axfecha_emision = date('d-m-Y',strtotime($fila['FECHA_EMISION']));	
					$axfecha_emision_1 = $fila['FECHA_EMISION'];
					$axestado = $fila['ESTADO_ELECTRO'];	
					$axmonto= number_format($fila['TOTAL_VENTA'],2,".",",");
					$axdoc = $axserie.'-'.$axdocumento;
										
				
				echo "
				<tr>
					<td style='text-align: center;'>$it</td>
					<td style='text-align: left;'>$axcliente</td>
					<td style='text-align: center;'>$axcorrelativo</td>
					<td style='text-align: center;'>$axfecha_emision</td>";

					if($axestado=='PROCESADA'){
						echo "<td style='text-align: center;' class='text-primary'><b>$axestado</b></td>";
					}else{
						echo "<td style='text-align: center;' class='text-danger'><b>$axestado</b></td>";	
					}
				
					echo "
					<td style='text-align: right;'>$axmonto</td>
					<td style='text-align: center;'>
						<div class='btn-group dropstart'>
						<button class='btn btn-outline-primary btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
				  	<ul class='dropdown-menu'>
				  	<li><hr class='dropdown-divider'></li>
				    <li><a class='dropdown-item text-primary' href='#'data-id='$axcod_mov' data-local='$axid_local' id='btn_comprobante_imprimir'><i class='bi bi-printer-fill'></i> Imprimir</a></li>
				    <li><a class='dropdown-item text-danger' href='#'data-codmov='$axcod_mov' data-local='$axid_local' id='btn_comprobante_rechazar_nc'><i class='bi bi-r-circle-fill'></i> Rechazar</a></li>
				    ";				    
				    
				    if($axtipo_documento=='FACTURA' || $axtipo_documento=='BOLETA DE VENTA'){
				    	if($axestado=='PROCESADA'){

				    		echo "
				    <li><a class='dropdown-item text-danger' href='#'data-id='$axcod_mov' data-fecha='$axfecha_emision_1' data-nserie='$axserie' data-ncomprobante='$axdocumento' data-local='$axid_local' data-cliente='$axcliente' id='btn_nota_credito'><i class='bi bi-journal-check'></i> Nota de crédito</a></li>				    
				    ";	

				     }	

				      }

				    if($axestado=='PENDIENTE'){
				    	echo "
				    <li><a class='dropdown-item text-danger' href='#'data-id='$axcod_mov' data-fecha='$axfecha_emision_1' data-nserie='$axserie' data-ncomprobante='$axdoc' data-local='$axid_local' data-cliente='$axcliente' id='btn_eliminar_comprobante_pendiente'><i class='bi bi-journal-check'></i> Eliminar </a></li>				    
				    ";	
				    }

			    


				    echo "
				    <li><hr class='dropdown-divider'></li>
				  	</ul>
					</div>
					
					</td>
				</tr>";

				}

echo "</table>
		</div>";
	}else{
		echo "";
	}

	}elseif($axtipo_documento=='PEDIDO'){

		if($axnom_cliente !==''){
			
			$SQLBuscar = "SELECT * FROM DOC_PEDIDOS_EMITIDOS WHERE FECHA_EMISION BETWEEN '$axfecha_emision_del' AND '$axfecha_emision_al' AND NOM_COMERCIAL LIKE '%".$axnom_cliente."%' ORDER BY ID_LOCAL,FECHA_EMISION,CORRELATIVO ASC";

		}elseif($axnum_comprobante_emitido !=='')	{

			$SQLBuscar = "SELECT * FROM DOC_PEDIDOS_EMITIDOS WHERE FECHA_EMISION BETWEEN '$axfecha_emision_del' AND '$axfecha_emision_al' AND CORRELATIVO LIKE '%".$axnum_comprobante_emitido."%' ORDER BY ID_LOCAL,FECHA_EMISION,CORRELATIVO ASC";			

		}else{

			$SQLBuscar = "SELECT * FROM DOC_PEDIDOS_EMITIDOS WHERE FECHA_EMISION BETWEEN '$axfecha_emision_del' AND '$axfecha_emision_al' ORDER BY ID_LOCAL,FECHA_EMISION,CORRELATIVO ASC";
			
		}	

	//echo $SQLBuscar;
	$RSBuscar = odbc_exec($con,$SQLBuscar);

	if(odbc_num_rows($RSBuscar) > 0){
	echo "
	<div id='div3'>
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th style='text-align: center;'>Item</th>
			<th style='text-align: left;'>Local</th>
			<th style='text-align: left;'>Vendedor</th>			
			<th style='text-align: left;'>Cliente</th>
			<th style='text-align: center;'>Num. Pedido</th>			
			<th style='text-align: center;'>Fecha Emisión</th>
			<th style='text-align: left;'>Estado</th>
			<th style='text-align: right;'>Monto</th>
			<th style='text-align: center;'><i class='bi bi-printer-fill'></i> Imprimir</th>
		</tr>
		</thead>";

		while ($fila = odbc_fetch_array($RSBuscar)) {
			
			$it=$it+1;
			$axnum_pedido = $fila['NUM_PEDIDO'];	
			$axlocal = $fila['LOCAL_CORTO'];	
			$axid_user =$fila['ID_USUARIO'];
			$axid_vendedor = $fila['USUARIO'];	
			$axcliente = $fila['NOM_COMERCIAL'];	
			$axcorrelativo = $fila['CORRELATIVO'];	
			$axfecha_emision = date('d-m-Y',strtotime($fila['FECHA_EMISION']));	
			$axestado = $fila['ESTADO_ATENDIDO'];	
			$axmonto= number_format($fila['TOTAL_VENTA'],2,".",",");
			
		
		echo "
		<tr>
			<td style='text-align: center;'>$it</td>
			<td style='text-align: left;'>$axlocal</td>
			<td style='text-align: left;'>$axid_vendedor</td>			
			<td style='text-align: left;'>$axcliente</td>		
			<td style='text-align: center;'>$axcorrelativo</td>	
			<td style='text-align: center;'>$axfecha_emision</td>";

			if($axestado=='PROGRAMADO'){
				echo "<td style='text-align: left;' ><b class='text-primary'> $axestado</b></td>";
			}elseif($axestado=='ATENDIDO'){
				echo "<td style='text-align: left;' ><b class='text-info'> $axestado</b></td>";
			}elseif($axestado=='REVISION'){
				echo "<td style='text-align: left;' ><b class='text-success'> $axestado</b></td>";
			}elseif($axestado=='PENDIENTE'){	
				echo "<td style='text-align: left;' ><b class='text-danger'> $axestado</b></td>";
			}


		echo "
			
			<td style='text-align: right;'>$axmonto</td>
			<td style='text-align: center;'><a class='dropdown-item' href='#'data-npedido='$axcorrelativo' data-user='$axid_user' data-local='$axid_local' id='btn_pedidos_imprimir'><i class='bi bi-file-earmark-pdf-fill'></i></a></td>
		</tr>";

		}
		echo "</table>
		</div>";

	}else{
		echo "";
	}


	}elseif($axtipo_documento=='GUIA DE REMISION REMITENTE'){

		if($axnom_cliente !==''){
			
			$SQLBuscar = "SELECT * FROM DOC_GUAS_EMITIDOS WHERE ID_LOCAL='$axid_local' AND FECHA_EMISION BETWEEN '$axfecha_emision_del' AND '$axfecha_emision_al' AND NOM_COMERCIAL LIKE '%".$axnom_cliente."%' ORDER BY ID_LOCAL,FECHA_EMISION,CORRELATIVO ASC";

		}elseif($axnum_comprobante_emitido !=='')	{

			$SQLBuscar = "SELECT * FROM DOC_GUAS_EMITIDOS WHERE ID_LOCAL='$axid_local' AND FECHA_EMISION BETWEEN '$axfecha_emision_del' AND '$axfecha_emision_al' AND CORRELATIVO LIKE '%".$axnum_comprobante_emitido."%' ORDER BY ID_LOCAL,FECHA_EMISION,CORRELATIVO ASC";			

		}else{
			
			$SQLBuscar = "SELECT * FROM DOC_GUAS_EMITIDOS WHERE ID_LOCAL='$axid_local' AND FECHA_EMISION BETWEEN '$axfecha_emision_del' AND '$axfecha_emision_al' ORDER BY ID_LOCAL,FECHA_EMISION,CORRELATIVO ASC";
			
		}	

	//echo $SQLBuscar;
	$RSBuscar = odbc_exec($con,$SQLBuscar);

	if(odbc_num_rows($RSBuscar) > 0){
	echo "
	<div id='div3'>
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th style='text-align: center;'>Item</th>
			<th style='text-align: left;'>Local</th>
			<th style='text-align: left;'>Vendedor</th>			
			<th style='text-align: left;'>Cliente</th>
			<th style='text-align: center;'>Num. Guía</th>			
			<th style='text-align: center;'>Fecha Emisión</th>
			<th style='text-align: left;'>Estado</th>			
			<th style='text-align: left;'>Estado Comprobante</th>			
			<th style='text-align: center;'><i class='bi bi-printer-fill'></i></th>
			<th style='text-align: center;'><i class='bi bi-r-circle-fill'></i></th>
		</tr>
		</thead>";

		while ($fila = odbc_fetch_array($RSBuscar)) {
			
			$it=$it+1;
			$axcod_guia_cz = $fila['COD_GUIA_CZ'];	
			$axlocal = $fila['LOCAL_CORTO'];	
			$axid_vendedor = $fila['USUARIO'];	
			$axcliente = $fila['NOM_COMERCIAL'];	
			$axcorrelativo = $fila['CORRELATIVO'];	
			$axfecha_emision = date('d-m-Y',strtotime($fila['FECHA_EMISION']));	
			$axestado = $fila['ESTADO_ELECTRO'];	
			$axmonto= number_format($fila['TOTAL_VENTA'],2,".",",");
			$axverif_guia= $fila['COD_GUIA_CZ'];	
			$axestado_final = $fila['ESTADO_FINAL'];
		
		echo "
		<tr>
			<td style='text-align: center;'>$it</td>
			<td style='text-align: left;'>$axlocal</td>
			<td style='text-align: left;'>$axid_vendedor</td>			
			<td style='text-align: left;'>$axcliente</td>		
			<td style='text-align: center;'>$axcorrelativo</td>	
			<td style='text-align: center;'>$axfecha_emision</td>";

			if($axestado=='PROCESADA'){

				echo "<td style='text-align: left;'><b class='text-primary'>$axestado</b></td>";

			}elseif($axestado=='RECHAZADA'){

				echo "<td style='text-align: left;'><b class='text-danger'>$axestado</b></td>";

			}

			echo "<td style='text-align: center;'>$axestado_final</td>";
			
			echo "
			<td style='text-align: center;'>
				<a class='dropdown-item' href='#' data-guia='$axverif_guia' id='btn_guia_remision_pdf' ><i class='bi bi-file-earmark-pdf-fill' style='color:red;'></i></a>				
				</td>

			<td style='text-align: center;'>
			<a class='dropdown-item' href='#'data-codmov='$axcod_mov' data-guia='$axverif_guia' data-estadoelectro_f='$axestado_electro' data-fecha='$axfecha_emision_comp' id='btn_rechazar_guia' title='LA GUIA REMISION CAMBIA ESTADO RECHAZAADA EN LA WEB Y SUNAT, EL COMPROBANTE QUEDA SIN GUIA REMISION' ><i class='bi bi-r-circle-fill'></i></a>
			</td>

		</tr>";

		}
		echo "</table>
		</div>";

	}else{
		echo "";
	}


	}

	
break;
case '135':

	$axid_empresa= $_POST['txtid_empresa'];
	$axcodusuario= $_POST['txtcodusuario'];

	$axnom_chofer = get_row('usuarios','NOM_USUARIO','ID_USUARIO',$axcodusuario);

	$sqletapas = "SELECT * FROM NUM_DESPACHOS_PROGRAMADOS_1 WHERE ID_EMPRESA ='$axid_empresa' AND ESTADO_ATENDIDO <>'PENDIENTE' ORDER BY FECHA_DESPACHO DESC" ;	
	$rsetapas=odbc_exec($con,$sqletapas);
	//echo $sqletapas;
	
	if(odbc_num_rows($rsetapas) > 0){
		echo '<option value="">Num. despachos</option>';
		while($fila=odbc_fetch_array($rsetapas)){


			$axnom_vehiculo =$fila['NOM_VEHICULO'];
			$axnum_despacho =$fila['NUM_DESPACHO'];

			$axestado =$fila['ESTADO_ATENDIDO'];

			if($axestado=='PROGRAMADO'){
				echo "<b><option class='text-primary' value='$axnum_despacho'>".$axnum_despacho.' | '.$axnom_vehiculo."</option></b>";
			}elseif($axestado=='ATENDIDO'){
				echo "<b><option class='text-success' value='$axnum_despacho'>".$axnum_despacho.' | '.$axnom_vehiculo."</option></b>";
			}

	   		
    	}
		
	} else {

		echo "";	
	}


break;

case '136':
	
	$axid_empresa= $_POST['txtid_empresa'];	
	$axbuscar_despacho= $_POST['txtbuscar_despacho'];	
	$axnum_despacho_programados= $_POST['txtnum_despacho_programados'];	
	$axnum_despacho_liquidados= $_POST['txtnum_despacho_liquidados'];	
	$axfiltro_busquedas= $_POST['txtfiltro_busquedas'];	
	$axtitulo_despacho =$axnum_despacho_liquidados.' | '.get_row('NUM_DESPACHOS_PROGRAMADOS_1','NOM_VEHICULO','NUM_DESPACHO',$axnum_despacho_liquidados).' | '.get_row('NUM_DESPACHOS_PROGRAMADOS_1','NOM_CHOFER','NUM_DESPACHO',$axnum_despacho_liquidados);

	$sqletapas = "SELECT * FROM PEDIDOS_CZ WHERE NUM_DESPACHO ='$axnum_despacho_programados' ORDER BY NUM_PEDIDO ASC" ;		
	$rsetapas=odbc_exec($con,$sqletapas);

	//echo $sqletapas;

		echo "
		<div id='div3'>		
		<div style='text-align: left;'>";
			
		//	if(odbc_num_rows($rsetapas) > 1){
				echo "<button type='button' class='btn btn-primary btn-sm' id='btn_atender_todos'> Atender todos</button>";
			//}

		echo "
		</div>
		<br>
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		
		<tr>			
		<th style='text-align: center;'>It</th>			
			<th style='text-align: left;'>Pedido</th>															
			<!--th style='text-align: center;'>Atender</th-->					
		</tr>
		
		</thead>";

		while($fila=odbc_fetch_array($rsetapas)){

			$axid =$fila['ID_MODO_PAGO'];
			$axnum_pedido =$fila['NUM_PEDIDO'];
			$axcliente_1 = get_row('PEDIDOS_CZ','NOM_COMERCIAL','NUM_PEDIDO',$axnum_pedido);	
			$axid_beneficiario 		= get_row('PEDIDOS_CZ','ID_BENEFICIARIO','NUM_PEDIDO',$axnum_pedido);	
			//$axcliente = substr($axcliente_1, 0,25).'...';
			$axcliente = $axcliente_1;
			$axmedio_pago =$fila['MEDIO_PAGO'];
			$axmonto_pagado_1 =$fila['MONTO_PAGADO'];
			$axobservaciones =$fila['OBSERVACION_DESPACHO'];
			$axfacturado = number_format($fila['TOTAL_PEDIDO'],2,".",",");
			//$axfacturado = get_row('MAESTRO_CZ','TOTAL_VENTA','NUM_PEDIDO',$axnum_pedido);
			$axcod_mov = get_row('MAESTRO_CZ','COD_MOV','NUM_PEDIDO',$axnum_pedido);
			$axestado_forma_pago = get_row('MAESTRO_DT','ESTADO_FORMA_PAGO','COD_MOV',$axcod_mov);
			$axdocumento = get_row('MAESTRO_CZ','TXT_SERIE','COD_MOV',$axcod_mov).'-'.get_row('MAESTRO_CZ','DOCUMENTO','COD_MOV',$axcod_mov);

			$axmonto_pagado=number_format($axmonto_pagado_1,2,".",",");

			$it=$it+1;

			echo "
			<tr>
			<td style='text-align: center;'>$it</td>
			<td style='text-align: left;'><a href='#' style='text-decoration:none;' id='btn_ver_detalle_cliente' data-idcliente='$axid_beneficiario'><b class='text-primary'>$axnum_pedido | $axcliente </b><br><b class='text-danger'> $axdocumento - $axestado_forma_pago - $axfacturado</b></a></td>					

			</tr>";

    	}

    	


    	echo "</table>";
	
break;

case '137':
	
	/**El comprobante queda sin GUIA REMISION y la GUIA REMISION queda estado RECHAZADO en la WEB y SUNAT**/

$axcod_guia_cz = $_POST['txtcod_guia_cz']; 			
$axid_local = $_POST['txtid_local']; 		
//$axcod_mov_cz =get_row('GUIA_REMISION_CZ','COD_MOV','COD_GUIA_CZ',$axcod_guia_cz);		

$sqlbuscar = "SELECT * FROM MAESTRO_CZ WHERE COD_GUIA_CZ='$axcod_guia_cz' AND ID_LOCAL='$axid_local'";
$rsbuscar = odbc_exec($con,$sqlbuscar);
//echo $sqlbuscar;
if(odbc_num_rows($rsbuscar) > 0){

	while ($fila = odbc_fetch_array($rsbuscar)) {

		$axcod_mov_cz = $fila['COD_MOV'];
		
		$SQLActualizar_maestro = "UPDATE MAESTRO_CZ SET COD_GUIA_CZ='' WHERE COD_MOV='$axcod_mov_cz' AND ID_LOCAL='$axid_local'";
		$RSActualizar_pedidos = odbc_exec($con,$SQLActualizar_maestro);	
	
	}

		$SQLActualizar_pedidos = "UPDATE GUIA_REMISION_CZ SET ESTADO_ELECTRO='RECHAZADA',COD_MOV='' WHERE COD_GUIA_CZ='$axcod_guia_cz' AND ID_LOCAL='$axid_local'";
		$RSActualizar_pedidos = odbc_exec($con,$SQLActualizar_pedidos);

		if($RSActualizar_pedidos){

			$respuesta =0;
			echo $respuesta;
		}else{
			$respuesta =1;
			echo $respuesta;
		}


}

break;

case '138':
	

$axid_empresa = $_POST['txtid_empresa']; 	
$axid_local = $_POST['txtid_local']; 	

//$SQLBuscar = "SELECT NUM_DESPACHO,FECHA_DESPACHO,CAMION FROM MAESTRO_CZ_PROGRAMADOS WHERE ID_LOCAL = '$axid_local' AND ID_TD='12' AND ESTADO_ATENDIDO='PROGRAMADO' AND COD_GUIA_CZ='' GROUP by NUM_DESPACHO,FECHA_DESPACHO,CAMION ORDER BY NUM_DESPACHO ASC";
$SQLBuscar = "SELECT NUM_DESPACHO,FECHA_DESPACHO,CAMION FROM MAESTRO_CZ_PROGRAMADOS WHERE ID_LOCAL = '$axid_local' AND ESTADO_ATENDIDO='PROGRAMADO' AND COD_GUIA_CZ='' GROUP by NUM_DESPACHO,FECHA_DESPACHO,CAMION ORDER BY NUM_DESPACHO ASC";
	
$rsetapas=odbc_exec($con,$SQLBuscar);
	
	if(odbc_num_rows($rsetapas) > 0){
		echo '<option value="">Seleccionar</option>';
		while($fila=odbc_fetch_array($rsetapas)){
	   		echo '<option value='.$fila['NUM_DESPACHO'].'>'.$fila['NUM_DESPACHO'].' | '.$fila['CAMION'].'</option>';
    	}
		
	} else {

		echo "";	
	}

break;

case '139':
	
$axid_empresa = $_POST['txtid_empresa']; 	
$axcodusuario = $_POST['txtcodusuario']; 	
//$axcod_interno = get_row('EMPRESA','CORRELATIVO_CLIENTES','ID_EMPRESA',$axid_empresa)+1;
$axcod_interno = get_row('USUARIOS','CORRELATIVO_CLIENTES','ID_USUARIO',$axcodusuario)+1;
echo trim($axcod_interno);


break;

case '140':
	
/**EL PEDIDO QUEDA LIBRE DE DESPACHO Y PASA A ESTADO PENDIENTE, Y COMPROBANTE NO ES CONSIDERADO PARA EL INVENTARIO**/

$axnum_pedido = $_POST['txtnum_pedido']; 	
$axid_local = get_row('PEDIDOS','ID_LOCAL','NUM_PEDIDO',$axnum_pedido);

$SQLActualizar = "UPDATE PEDIDOS SET NUM_DESPACHO='',NOM_CHOFER='',ID_VEHICULO='', ESTADO_ATENDIDO='PENDIENTE' WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
$RSActualizar = odbc_exec($con,$SQLActualizar);

//echo $SQLActualizar;

if($RSActualizar){

	$SQLActualizar_maestro = "UPDATE MAESTRO_CZ SET ESTADO_INVENTARIO='' WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
	$RSActualizar_maestro = odbc_exec($con,$SQLActualizar_maestro);

	$respuesta = 0;
	echo $respuesta;

}else{

	$respuesta = 1;
	echo $respuesta;
}

break;

case '141':
	
$axbuscar_dato =$_POST['txtdistrito_alter_1'];
   
 if(isset($_POST["txtdistrito_alter_1"])){

	$output ="";
	$idprov ="";
	$sqlemisor = "SELECT TOP 30 * FROM UBIGEOS_PERU WHERE UBIGEO_PERU LIKE  '%".$axbuscar_dato."%' ORDER BY UBIGEO_PERU ASC";
	//echo $sqlemisor;

	$rsemisor=odbc_exec($con,$sqlemisor);	
	$output ="<ul class='list-group'>";  		

	if(odbc_num_rows($rsemisor) > 0){
		 while ($row=odbc_fetch_array($rsemisor)){		
		 	$id =  $row["UBIGEO_REINEC"];
		 	$axdistrito =  trim($row["UBIGEO_PERU"]);

		 	$output .="<a href='#' id='btn_lista_ubi_1' class='list-group-item list-group-item-action' style='background:#DAF5FF;' data-id='$id' data-distrito='$axdistrito'>".utf8_encode(trim($row["UBIGEO_PERU"]))."</a>";
		 }

	}else{
		
		$output .="<a href='#' class='list-group-item list-group-item-action bg-danger'></a>";
	
	}

	$output .="</ul>";
	echo $output;

}else{
	echo $output;	
}

break;

case '142':

	$axbuscaregistro =$_POST['txtbuscar_prod_inventario'];
	$axperiodo_inventario =$_POST['txtperiodo_inventario'];
	$axfecha_del =$_POST['txtfecha_del'];
	$axfecha_al =$_POST['txtfecha_al'];

	$axtitulo = 'Fecha del: '. date('d-m-Y',strtotime($axfecha_del)).' al '.date('d-m-Y',strtotime($axfecha_al));

	if($axbuscaregistro==''){
		
		$SQLBuscar ="SELECT  *  FROM PRODUCTOS_INVENTARIOS  WHERE TITULO ='$axtitulo' AND PERIODO_INVENTARIO='$axperiodo_inventario' ORDER BY COD_PRODUCTO ASC";

	}else{
		
			$SQLBuscar ="SELECT  *  FROM PRODUCTOS_INVENTARIOS WHERE TITULO ='$axtitulo' AND PERIODO_INVENTARIO='$axperiodo_inventario' AND NOM_PRODUCTO+COD_PRODUCTO like '%".$axbuscaregistro."%' ";	
		

	}	


	//$SQLBuscar ="SELECT * FROM PRODUCTOS_INVENTARIOS ORDER BY STOCK_ACTUAL DESC"; 
	//echo $SQLBuscar;

	echo "
		<div style='margin-top:5px; padding:5px; text-align: right;'>
		<a href='exportar_excel.php?param=1&periodo=$axperiodo_inventario&titulo=$axtitulo'  class='btn btn-outline-success btn-sm' ><b> <i class='bi bi-file-earmark-excel-fill'></i> Excel</b></a>
		</div>
		
		
		<table class='table table-hover table-sm' id='tbl_inventario'>
		<thead class='table-success'>			
		<tr>
			<th style='text-align: center;'>Item</th>
			<th style='text-align: center;'>Estado</th>
			<th style='text-align: center;'>Código</th>
			<th style='text-align: left;'>Producto</th>						
			<th class='table-success' style='text-align: right;'>Prc. Ponderado</th>			
			<th class='table-success' style='text-align: right;'>Comprado</th>			
			<th class='table-success' style='text-align: right;'>Saldo Anterior</th>
			<th class='table-primary' style='text-align: right;'>Ventas</th>			
			<th class='table-primary' style='text-align: right;'>Despachado</th>			
			<th class='table-primary' style='text-align: right;'>Por Despachar</th>			
			<th class='table-primary' style='text-align: right;'>Stock Logico Actual</th>			
			<th class='table-primary' style='text-align: right;'>Stock Fisico Actual</th>			

		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		
 		$it= $it+1; 		
 		$axid_producto = $fila['ID_PRODUCTO'];
		$axcod_producto = $fila['COD_PRODUCTO'];		
		$axnom_producto = $fila['NOM_PRODUCTO'];
		$axcosto = number_format($fila["PRC_COMPRA_PROM"],4,".",","); 		
		$axcomprado = $fila["COMPRADO"]; 
		$axestado_cierre = $fila["ESTADO_PERIODO"]; 
		$axstock_antes = $fila["STOCK_ANTERIOR"]; 
		$axcompras_total =$axcomprado+$axstock_antes;
		$axvendido = $fila["VENDIDOS"]; 
		$axdepachado = $fila["DESPACHADO"]; 
		$axpor_depachado = $fila["POR_DESPACHAR"]; 
		$axstock_total = $axcompras_total-$axdepachado-$axpor_depachado;
		$axstock_logico =$axstock_total;
		$axstock_fiscio = $axcompras_total-$axdepachado;

		$axnombre = $axcod_producto.' | '.$axnom_producto;

		$axcomprado_1 = number_format($axcomprado,2,".",","); 
		$axstock_antes_1 = number_format($axstock_antes,2,".",","); 
		$axvendido_1 = number_format($axvendido,2,".",","); 
		$axdepachado_1 = number_format($axdepachado,2,".",","); 
		$axpor_depachado_1 = number_format($axpor_depachado,2,".",","); 
		$axstock_logico_1 = number_format($axstock_logico,2,".",","); 
		$axstock_fiscio_1 = number_format($axstock_fiscio,2,".",",");

		

 	echo "
 		<tr> 		
 			<td style='text-align: center;'>".$it."</td> 
 			<td style='text-align: center;'>".$axestado_cierre."</td> 
 			
 			<td style='text-align: center;'>".$axcod_producto."</td> 
 			<td style='text-align: left;'>".$axnom_producto."</td>  			
 			
 			
 			<td  class='text-success' style='text-align: right;'><b><a href='#' style='text-decoration:none;' id='btn_ver_detalle_ponderado' data-producto='$axnombre' data-id='$axid_producto' data-bs-toggle='modal' data-bs-target='#exampleModal_pagos_rendicion'>".$axcosto."</a></b></td>  


 			<td class='text-success' style='text-align: right;'><b><a href='#' style='text-decoration:none;' id='btn_ver_detalle_compras' data-producto='$axnombre' data-id='$axid_producto' data-bs-toggle='modal' data-bs-target='#exampleModal_pagos_rendicion'>".$axcomprado_1."</a></b></td>

 			<td class='text-success' style='text-align: right;'><b><a href='#' style='text-decoration:none;' id='btn_ver_detalle_saldo_anterior' data-producto='$axnombre' data-id='$axid_producto' data-bs-toggle='modal' data-bs-target='#exampleModal_pagos_rendicion'>".$axstock_antes_1."</a></b></td>

				
 			

 			<td class='text-success' style='text-align: right;'><b><a href='#' style='text-decoration:none;' id='btn_filtrar_detallado' data-producto='$axnombre' data-id='$axid_producto' data-bs-toggle='modal' data-bs-target='#exampleModal_pagos_rendicion'>".$axvendido_1."</a></b></td>

 			<td class='text-success' style='text-align: right;'><b><a href='#' style='text-decoration:none;' id='btn_filtrar_detallado_despachado' data-producto='$axnombre' data-id='$axid_producto' data-bs-toggle='modal' data-bs-target='#exampleModal_pagos_rendicion'>".$axdepachado_1."</a></b></td> 

 			
 			<td class='text-success' style='text-align: right;'><b><a href='#' style='text-decoration:none;' id='btn_filtrar_detallado_por_despachado' data-producto='$axnombre' data-id='$axid_producto' data-bs-toggle='modal' data-bs-target='#exampleModal_pagos_rendicion'>".$axpor_depachado_1."</a></b></td> 
 			
	
 			<td class='text-primary' style='text-align: right;'><b>".$axstock_logico_1."</b></td> 	
 			<td class='text-primary' style='text-align: right;'><b>".$axstock_fiscio_1."</b></td> 	
 			
 			
 			
 		</tr>";
 	
 	}
	echo "</table>";
	}


break;

case '143':
	
$axid_producto =$_POST['txtid_producto'];
$axfecha_del =$_POST['txtfecha_del'];
$axfecha_al =$_POST['txtfecha_al'];


$SQLBuscar ="SELECT * FROM VERIFICACION_DETALLE WHERE FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' AND ID_PRODUCTO='$axid_producto' ORDER BY DETALLE_MOVIMIENTO,NUM_ORDEN ASC"; 
echo $SQLBuscar;

echo "
		<!--div style='margin-top:5px; padding:5px; text-align: right;'>
		<a href='exportar_excel.php?param=1&local=$axid_local' class='btn btn-outline-success btn-sm' ><b> <i class='bi bi-file-earmark-excel-fill'></i> Excel</b></a>
		</div-->
		<div id='div3'>	
		
		<table class='table table-hover table-sm'>
		<thead class='table-success'>			
		<tr>
			<th style='text-align: center;'>Tipo</th>
			<th style='text-align: center;'>Fecha</th>
			<th style='text-align: center;'>Num Pedido</th>
			<th style='text-align: left;'>Cliente</th>						
			<th class='table-success' style='text-align: right;'>Ingresos</th>			
			<th class='table-success' style='text-align: right;'>Salidas</th>			
			<!--th class='table-primary' style='text-align: right;'>Costo Producto</th>			
			<th class='table-primary' style='text-align: right;'>Precio Venta</th-->			
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		
 		$it= $it+1;
 		$axtipo = $fila['DETALLE_MOVIMIENTO'];
 		$axid_producto = $fila['ID_PRODUCTO'];
		
		$axnum_pedido = $fila['NUM_PEDIDO'];
		
		

		if($axtipo=='COMPRA'){
			$axfecha = date('d-m-Y', strtotime($fila['FECHA_EMISION']));		
			$axcomprobante = $fila['COMPROBANTE'];		

		}else{
			$axfecha = get_row('PEDIDOS','FECHA_PEDIDO','NUM_PEDIDO',$axnum_pedido);	
			$axcomprobante = $axnum_pedido;
		}

		$axcliente = $fila['NOM_COMERCIAL'];		
		$axingreso = number_format($fila["INGRESO"],2,".",","); 
		$axsalida = number_format($fila["SALIDA"],2,".",","); 		
		$axcosto = number_format($fila["PRS_COMPRA"],2,".",","); 
		$axprecio = number_format($fila["PRC_VENTA"],2,".",","); 

 	echo "
 		<tr> 		
 			<td style='text-align: center;'>".$axtipo."</td>  			
 			<td style='text-align: center;'>".$axfecha."</td> 
 			<td style='text-align: center;'>".$axcomprobante."</td> 
 			<td style='text-align: left;'>".$axcliente."</td> 
 			<td class='text-success' style='text-align: right;'><b>".$axingreso."</b></td>  			
 			<td class='text-danger' style='text-align: right;'><b>".$axsalida."</b></td>  			
 			<!--td class='text-primary' style='text-align: right;'><b>".$axcosto."</b></td>  			
 			<td class='text-primary' style='text-align: right;'><b>".$axprecio."</b></td--> 	 			
 			
 		</tr>";
 	
 	}

 	//CASE WHEN dbo.MAESTRO_CZ.DETALLE_MOVIMIENTO = 'VENTA' THEN dbo.MAESTRO_DT.PRS_VENTA ELSE '0' END

 	$SQLBuscar_tt ="SELECT SUM(INGRESO) as ING, SUM(SALIDA) AS SAL, AVG(PRS_COMPRA)  AS PC,AVG(PRS_VENTA) AS PV FROM VERIFICACION_DETALLE WHERE FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' AND ID_PRODUCTO='$axid_producto'"; 
 	$RSBuscar_tt = odbc_exec($con,$SQLBuscar_tt);
 	$fila_tt = odbc_fetch_array($RSBuscar_tt);
 	$axingresos_tt=$fila_tt['ING'];
 	$axsalidas_tt=$fila_tt['SAL'];
 	$axcosto_p=$fila_tt['PC'];
 	$axprecio_p=$fila_tt['PV'];

 	$axstock =$axingresos_tt-$axsalidas_tt;

 	echo "<tr>
 	<th style='text-align: right;' colspan='4'><b></b></th> 	 			
 	<th class='text-success' style='text-align: right;' ><b>$axingresos_tt</b></th> 	 			
 	<th class='text-danger' style='text-align: right;' ><b>$axsalidas_tt</b></th> 	 			
 	<!--th class='text-success' style='text-align: right;' ><b>$axcosto_p</b></th> 	 			
 	<th class='text-success' style='text-align: right;' ><b>$axprecio_p</b></th--> 	 			
 	</tr>

 	<tr>
 	<th class='text-primary' style='text-align: right;' colspan='5'><b>Stock Actual</b></th> 	 			
 	<th class='text-primary' style='text-align: right;' ><b>$axstock</b></th> 	 			 	
 	</tr>
 	";


	echo "</table>
	</div>
	";
	}


break;
case '144':
	
$axid_producto =$_POST['txtid_producto'];
$axfecha_del =$_POST['txtfecha_del'];
$axfecha_al =$_POST['txtfecha_al'];
$axtipo_venta =$_POST['txttipo_venta'];
$axperiodo_inventario =$_POST['txtperiodo_inventario'];

$axperiodo_actual = $_POST['txtperiodo_inventario']; 	

$axmes_antes = intval(substr($axperiodo_actual,0,2))-1;
$axperiodo_anterior = number_pad($axmes_antes,2,0).'-'.substr($axperiodo_actual,3,4); //03-2023

if($axtipo_venta=='VENDIDO'){

$SQLBuscar ="SELECT * FROM VERIFICACION_DETALLE WHERE DETALLE_MOVIMIENTO ='VENTA' AND FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' AND ID_PRODUCTO='$axid_producto' ORDER BY FECHA_EMISION ASC";

}else if($axtipo_venta=='DESPACHADO'){

	$SQLBuscar ="SELECT * FROM VERIFICACION_DETALLE WHERE ESTADO_ATENDIDO <> 'PENDIENTE' AND DETALLE_MOVIMIENTO ='VENTA' AND FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' AND ID_PRODUCTO='$axid_producto' ORDER BY FECHA_EMISION ASC";

}else if($axtipo_venta=='POR_DESPACHADO'){

	$SQLBuscar ="SELECT * FROM VERIFICACION_DETALLE WHERE ESTADO_ATENDIDO = 'PENDIENTE' AND DETALLE_MOVIMIENTO ='VENTA' AND FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' AND ID_PRODUCTO='$axid_producto' ORDER BY FECHA_EMISION ASC";

}else if($axtipo_venta=='ANTERIOR'){

	$SQLBuscar ="SELECT * FROM VERIFICACION_DETALLE WHERE DETALLE_MOVIMIENTO ='VENTA' AND PERIODO_INVENTARIO='$axperiodo_anterior' AND ID_PRODUCTO='$axid_producto' ORDER BY FECHA_EMISION ASC";

}

//echo $SQLBuscar;

echo "
		<div id='div3'>
		<div style='margin-top:5px; padding:5px; text-align: right;'>
		<a href='exportar_excel.php?param=2&local=$axid_local&del=$axfecha_del&al=$axfecha_al&filtro=$axtipo_venta&id_producto=$axid_producto' class='btn btn-outline-danger btn-sm' ><b> <i class='bi bi-file-earmark-excel-fill'></i> Excel</b></a>
		</div>
		
		
		<table class='table table-hover table-sm'>
		<thead class='table-success'>			
		<tr>
	
			<th style='text-align: center;'>Fecha</th>		
			<th style='text-align: center;'>Num Pedido</th>			
			<th style='text-align: left;'>Cod</th>						
			<th style='text-align: left;'>Cliente</th>						
			<th class='table-success' style='text-align: right;'>Ingresos</th>
			<th class='table-primary' style='text-align: right;'>Precio Venta</th>			
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);		
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		
 		$it= $it+1;
 		$axtipo = $fila['DETALLE_MOVIMIENTO'];
 		$axid_producto = $fila['ID_PRODUCTO'];
 		$axcod_producto = $fila['COD_PRODUCTO'];
		$axfecha = date('d-m-Y', strtotime($fila['FECHA_EMISION']));		
		$axnum_pedido = $fila['NUM_PEDIDO'];
		$axcliente = $fila['NOM_COMERCIAL'];	
		$axcod_cliente = get_row('BENEFICIARIOS','COD_INTERNO','NOM_COMERCIAL',$axcliente);
		$axestado_inventario = $fila['ESTADO_INVENTARIO'];		

		if($axestado_inventario =='ANULADA' || $axestado_inventario =='RECHAZADA'){
			$aviso = '<b class="text-danger">('.$axestado_inventario.')</b>';
		}else{
			$aviso = '';
		}

		$axingreso = number_format($fila["INGRESO"],2,".",","); 
		$axsalida = number_format($fila["SALIDA"],2,".",","); 		
		$axcosto = number_format($fila["PRS_COMPRA"],2,".",","); 
		$axprecio = number_format($fila["PRS_VENTA"],2,".",","); 

 	echo "
 		<tr> 		
 	
 			<td style='text-align: center;'>".$axfecha."</td>  	
 			<td style='text-align: center;'>".$axnum_pedido."</td>  			
 			<td style='text-align: left;'>".$axcod_cliente."</td> 
 			<td style='text-align: left;'>".$axcliente.' '.$aviso."</td> 
 			<td class='text-success' style='text-align: right;'><b>".$axsalida."</b></td>
 			<td class='text-primary' style='text-align: right;'><b>".$axprecio."</b></td> 	 			
 			
 		</tr>";
 	
 	}


if($axtipo_venta=='VENDIDO'){

$SQLBuscar_T ="SELECT SUM(SALIDA) AS TS FROM VERIFICACION_DETALLE WHERE DETALLE_MOVIMIENTO ='VENTA' AND FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' AND ID_PRODUCTO='$axid_producto'";

}else if($axtipo_venta=='DESPACHADO'){

	$SQLBuscar_T ="SELECT SUM(SALIDA) AS TS FROM VERIFICACION_DETALLE WHERE ESTADO_ATENDIDO <> 'PENDIENTE' AND DETALLE_MOVIMIENTO ='VENTA' AND FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' AND ID_PRODUCTO='$axid_producto'";

}else if($axtipo_venta=='POR_DESPACHADO'){

	$SQLBuscar_T ="SELECT SUM(SALIDA) AS TS FROM VERIFICACION_DETALLE WHERE ESTADO_ATENDIDO = 'PENDIENTE' AND DETALLE_MOVIMIENTO ='VENTA' AND FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' AND ID_PRODUCTO='$axid_producto'";

}else if($axtipo_venta=='ANTERIOR'){

	$SQLBuscar_T ="SELECT SUM(SALIDA) AS TS FROM VERIFICACION_DETALLE WHERE DETALLE_MOVIMIENTO ='VENTA' AND PERIODO_INVENTARIO='$axperiodo_anterior' AND ID_PRODUCTO='$axid_producto'";

}

$rsBuscar_TT = odbc_exec($con,$SQLBuscar_T);
$fila_t = odbc_fetch_array($rsBuscar_TT);

$axtotal_salida = number_format($fila_t["TS"],2,".",","); 

echo "
 		<tr> 		
 	
 			<th class='text-success' style='text-align: center;' colspan='4'><b>Total Vendido</b></th>  	
 			<th class='text-success' style='text-align: right;'><b>".$axtotal_salida."</b></th>  		
	 			
 			
 		</tr>";

	echo "</table>




	</div>";
	}

break;

case '145':
	
	
	
	$axid_pago =$_POST['txtid_modo_pago'];
	$axmonto_pagado =$_POST['txtmonto_pagado'];
	

	$SQLActualizar = "UPDATE PEDIDOS_DEPACHO_1 SET MONTO_PAGADO='$axmonto_pagado' WHERE ID_MODO_PAGO='$axid_pago'";
	$RSActualizar = odbc_exec($con,$SQLActualizar);

	//echo $SQLActualizar;

	if($RSActualizar){

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;

	}

break;

case '146':
	
$axid_empresa= $_POST['txtid_empresa'];
	$axcodusuario= $_POST['txtcodusuario'];

	$axnom_chofer = get_row('usuarios','NOM_USUARIO','ID_USUARIO',$axcodusuario);

	$sqletapas = "SELECT * FROM NUM_DESPACHOS_PROGRAMADOS_1 WHERE ID_EMPRESA ='$axid_empresa' AND ESTADO_ATENDIDO='ATENDIDO' ORDER BY NUM_DESPACHO DESC" ;	
	$rsetapas=odbc_exec($con,$sqletapas);
	//echo $sqletapas;
	
	if(odbc_num_rows($rsetapas) > 0){
		echo '<option value="">Num. despachos</option>';
		while($fila=odbc_fetch_array($rsetapas)){


			$axnom_vehiculo =$fila['NOM_VEHICULO'];
			$axnum_despacho =$fila['NUM_DESPACHO'];

			$axestado =$fila['ESTADO_ATENDIDO'];

			if($axestado=='PROGRAMADO'){
				echo "<b><option class='text-primary' value='$axnum_despacho'>".$axnum_despacho.' | '.$axnom_vehiculo."</option></b>";
			}elseif($axestado=='ATENDIDO'){
				echo "<b><option class='text-success' value='$axnum_despacho'>".$axnum_despacho.' | '.$axnom_vehiculo."</option></b>";
			}

	   		
    	}
		
	} else {

		echo "";	
	}

break;

case '147':
	
date_default_timezone_set("America/Lima");

$axnum_despacho= $_POST['txtnum_despacho_programados'];

$axdetalle_pago= 'PAGO DEL CLIENTE';
$axhora_entrega = date('h:i:s');


$sqlbuscar ="SELECT * FROM PEDIDOS_CZ WHERE NUM_DESPACHO='$axnum_despacho'";
$rsbuscar = odbc_exec($con,$sqlbuscar);
//echo $sqlbuscar;

if($rsbuscar){

	while ($fila = odbc_fetch_array($rsbuscar)) {

		$axnum_pedido= $fila['NUM_PEDIDO'];
		$axid_local=$fila['ID_LOCAL']; // get_row('PEDIDOS','ID_LOCAL','NUM_PEDIDO',$axnum_pedido);
		$axmedio_pago=$fila['MEDIO_PAGO']; 
		$axforma_pago=$fila['FORMA_PAGO']; 
		$axfecha_pago=$fila['FECHA_PAGO']; 
		$axdia_pago=$fila['DIAS_PAGO']; 
		$axestado_forma_pago=$fila['ESTADO_FORMA_PAGO']; 
		$axmonto_facturado= $fila['TOTAL_PEDIDO'];

		$axmonto_pagado= $fila['TOTAL_PEDIDO'];
		$axcod_mov = get_row('MAESTRO_CZ','COD_MOV','NUM_PEDIDO',$axnum_pedido);		
		$axnum_comprobante = get_row('MAESTRO_CZ','TXT_SERIE','COD_MOV',$axcod_mov).'-'.get_row('MAESTRO_CZ','DOCUMENTO','COD_MOV',$axcod_mov);;

		$verificar = get_row_two('PEDIDOS_DEPACHO_1','NUM_PEDIDO','NUM_PEDIDO','NUM_DESPACHO',$axnum_pedido,$axnum_despacho);

		if($verificar==''){

			$SQLInsert = "INSERT INTO PEDIDOS_DEPACHO_1 (NUM_PEDIDO,ID_LOCAL,MEDIO_PAGO,MONTO_PAGADO,OBSERVACION_DESPACHO,NUM_DESPACHO,DETALLES_PAGOS,ESTADO_ATENDIDO,NUM_COMPROBANTE,COD_MOV,FORMA_PAGO,DIAS_PAGO,ESTADO_FORMA_PAGO,MONTO_FACTURADO) values ('$axnum_pedido','$axid_local','$axmedio_pago','$axmonto_pagado','$axobservacion_entrega','$axnum_despacho','$axdetalle_pago','ATENDIDO','$axnum_comprobante','$axcod_mov','$axforma_pago','$axdia_pago','$axestado_forma_pago','$axmonto_facturado')";
				$rsinserta = odbc_exec($con,$SQLInsert);

				if($rsinserta){

					$SQLActualizar = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='ATENDIDO', HORA_ENTREGA='$axhora_entrega',ESTADO_REVISION='CERRADO' WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
					$RSActualizar = odbc_exec($con,$SQLActualizar);

					$respuesta =0;
					echo $respuesta;

				}else{

					$respuesta =1;
					echo $respuesta;

				}

		}
		
		

	}



}

break;

case '148':
	
date_default_timezone_set("America/Lima");

$axid_modo_pago =$_POST['txtid_modo_pago'];
$axnum_despacho_editar =$_POST['txtnum_despacho_editar'];
$axnum_pedido =$_POST['txtnum_pedido'];
$axid_local =$_POST['txtid_local'];
$axdetalles_pagos =$_POST['txtdetalles_pagos'];
$axcod_mov =$_POST['txtcod_mov'];

$axestado_atendido =$_POST['txtestado_atendido'];
$axforma_pago =$_POST['txtforma_pago'];
$axfecha_pago =$_POST['txtfecha_pago'];
$axdias_pago =$_POST['txtdias_pago'];
$axestado_forma_pago =$_POST['txtestado_forma_pago'];
$axmedio_pago =$_POST['txtmedio_pago'];
$axid_cta =$_POST['txtid_cta'];
$axnum_transf =$_POST['txtnum_transf'];
$axfecha_transf =$_POST['txtfecha_transf'];
$axperiodo_transf = date('m-Y',strtotime($axfecha_transf));
$axmonto_pagado =$_POST['txtmonto_pagado'];
$axmonto_facturado =$_POST['txtmonto_facturado'];
$axresponsable =$_POST['txtresponsable'];
$axparametros =$_POST['txtparametros'];

if($axparametros==1){

		$SQLInsert = "INSERT INTO PEDIDOS_DEPACHO_1 (NUM_PEDIDO,ID_LOCAL,MONTO_PAGADO,NUM_DESPACHO,DETALLES_PAGOS,ESTADO_ATENDIDO,COD_MOV,FORMA_PAGO,FECHA_PAGO,DIAS_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,FECHA_TRANSF,NUM_TRANSF,ID_CTA,PERIODO_TRANSF,MONTO_FACTURADO,RESPONSABLE) values ('$axnum_pedido','$axid_local','$axmonto_pagado','$axnum_despacho_editar','$axdetalles_pagos','$axestado_atendido','$axcod_mov','$axforma_pago','$axfecha_pago','$axdias_pago','$axestado_forma_pago','$axmedio_pago','$axfecha_transf','$axnum_transf','$axid_cta','$axperiodo_transf','$axmonto_facturado','$axresponsable')";
		
}else{

$SQLInsert ="UPDATE PEDIDOS_DEPACHO_1 SET NUM_PEDIDO='$axnum_pedido',ID_LOCAL='$axid_local',MONTO_PAGADO='$axmonto_pagado',NUM_DESPACHO='$axnum_despacho_editar',DETALLES_PAGOS='$axdetalles_pagos',ESTADO_ATENDIDO='$axestado_atendido',COD_MOV='$axcod_mov',FORMA_PAGO='$axforma_pago',FECHA_PAGO='$axfecha_pago',DIAS_PAGO='$axdias_pago',ESTADO_FORMA_PAGO='$axestado_forma_pago',MEDIO_PAGO='$axmedio_pago',FECHA_TRANSF='$axfecha_transf',NUM_TRANSF='$axnum_transf',ID_CTA='$axid_cta',PERIODO_TRANSF='$axperiodo_transf',MONTO_FACTURADO='$axmonto_facturado',RESPONSABLE='$axresponsable' WHERE ID_MODO_PAGO='$axid_modo_pago'";

}

$rsinserta = odbc_exec($con,$SQLInsert);
//echo $SQLInsert;

if($rsinserta){

	$axcobrado =  get_row('CUENTAS_POR_COBRAR_POR_PEDIDOS','PAGADO','NUM_PEDIDO',$axnum_pedido);
	$axfacturado = get_row('PEDIDOS_CZ','TOTAL_PEDIDO','NUM_PEDIDO',$axnum_pedido);

	if($axcobrado==$axfacturado){
		$SQLActualizar = "UPDATE PEDIDOS_DEPACHO_1 SET ESTADO_FORMA_PAGO='CANCELADO' WHERE NUM_PEDIDO='$axnum_pedido'";
		$RSActualizar = odbc_exec($con,$SQLActualizar);
	}

	$respuesta =0;
	echo $respuesta;

}else{

	$respuesta =1;
	echo $respuesta;

}



break;

case '149':
	
$axid_pago= $_POST['txtid_modo_pago'];
	
	$sql6 = "SELECT * FROM PEDIDOS_DEPACHO_1 WHERE ID_MODO_PAGO = '$axid_pago'";

	
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

case '150':
	
$axid_pago= $_POST['txtid_modo_pago'];

$sqlduplicar = "SELECT * FROM PEDIDOS_DEPACHO_1 WHERE ID_MODO_PAGO = '$axid_pago' order by ID_MODO_PAGO";
$rsduplicar = odbc_exec($con,$sqlduplicar);

while ($fila = odbc_fetch_array($rsduplicar)) {

$axid_modo_pago =$fila['txtid_modo_pago'];
$axid_local =$fila['ID_LOCAL'];
$axnum_pedido =$fila['NUM_PEDIDO'];
$axmonto_pagado =$fila['MONTO_PAGADO'];
$axnum_despacho_editar =$fila['NUM_DESPACHO'];
$axdetalles_pagos =$fila['DETALLES_PAGOS'];
$axestado_atendido =$fila['ESTADO_ATENDIDO'];
$axcod_mov =$fila['COD_MOV'];
$axforma_pago =$fila['FORMA_PAGO'];
$axfecha_pago =$fila['FECHA_PAGO'];
$axdias_pago =$fila['DIAS_PAGO'];
$axestado_forma_pago =$fila['ESTADO_FORMA_PAGO'];
$axmedio_pago =$fila['MEDIO_PAGO'];
$axfecha_transf =$fila['FECHA_TRANSF'];
$axnum_comprobante =$fila['NUM_COMPROBANTE'];
$axnum_transf =$fila['NUM_TRANSF'];
$axid_cta =$fila['ID_CTA'];
$axperiodo_transf = $fila['PERIODO_TRANSF'];
$axmonto_facturado =$fila['MONTO_FACTURADO'];

$SQLInsert = "INSERT INTO PEDIDOS_DEPACHO_1 (NUM_PEDIDO,ID_LOCAL,MONTO_PAGADO,NUM_DESPACHO,DETALLES_PAGOS,ESTADO_ATENDIDO,COD_MOV,FORMA_PAGO,FECHA_PAGO,DIAS_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,FECHA_TRANSF,NUM_TRANSF,ID_CTA,PERIODO_TRANSF,MONTO_FACTURADO,NUM_COMPROBANTE) values ('$axnum_pedido','$axid_local','$axmonto_pagado','$axnum_despacho_editar','$axdetalles_pagos','$axestado_atendido','$axcod_mov','$axforma_pago','$axfecha_pago','$axdias_pago','$axestado_forma_pago','$axmedio_pago','$axfecha_transf','$axnum_transf','$axid_cta','$axperiodo_transf','$axmonto_facturado','$axnum_comprobante')";
$rsinserta =odbc_exec($con,$SQLInsert);

if($rsinserta){

	$respuesta =0;
	echo $respuesta;

}else{

	$respuesta =1;
	echo $respuesta;

}

			

}
break;

case '151':
	

$axid_pago= $_POST['txtid_modo_pago'];
$axnum_pedido= $_POST['txtnum_pedido'];
$axnum_despacho= $_POST['txtnum_despacho_editar'];


$sqlbuscar = "SELECT * FROM PEDIDOS_DEPACHO_1 WHERE NUM_PEDIDO='$axnum_pedido' order by ID_MODO_PAGO";
$rsbuscar = odbc_exec($con,$sqlbuscar);

if(odbc_num_rows($rsbuscar) == 1){

	$SQLActualizar ="UPDATE PEDIDOS SET ESTADO_ATENDIDO='PROGRAMADO' WHERE NUM_DESPACHO='$axnum_despacho' and NUM_PEDIDO='$axnum_pedido'";
	$RSActualizar = odbc_exec($con,$SQLActualizar);

	$SQLEliminar ="DELETE FROM PEDIDOS_DEPACHO_1 WHERE ID_MODO_PAGO='$axid_pago'";
	$RSEliminar = odbc_exec($con,$SQLEliminar);


}else{
	
	$SQLEliminar ="DELETE FROM PEDIDOS_DEPACHO_1 WHERE ID_MODO_PAGO='$axid_pago'";
	$RSEliminar = odbc_exec($con,$SQLEliminar);


}

break;

case '152':
	
	$axid_pago =$_POST['txtid_modo_pago'];
	$axnum_transf =$_POST['txtnum_transf'];
	

	$SQLActualizar = "UPDATE PEDIDOS_DEPACHO_1 SET NUM_TRANSF='$axnum_transf' WHERE ID_MODO_PAGO='$axid_pago'";
	$RSActualizar = odbc_exec($con,$SQLActualizar);

	//echo $SQLActualizar;

	if($RSActualizar){

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;

	}

break;

case '153':
	
$axnum_despacho_editar =$_POST['txtnum_despacho_editar'];
$axestado_forma_pago =$_POST['txtestado_forma_pago'];
$axmedio_pago =$_POST['txtmedio_pago'];
$axid_cta =$_POST['txtid_cta'];
$axnum_transf =$_POST['txtnum_transf'];
$axfecha_transf =$_POST['txtfecha_transf'];
$axperiodo_transf = date('m-Y',strtotime($axfecha_transf));

$SQLActualizar = "UPDATE PEDIDOS_DEPACHO_1 SET FECHA_PAGO='$axfecha_transf',ESTADO_FORMA_PAGO='$axestado_forma_pago',MEDIO_PAGO='$axmedio_pago',FECHA_TRANSF='$axfecha_transf',NUM_TRANSF='$axnum_transf',ID_CTA='$axid_cta',PERIODO_TRANSF='$axperiodo_transf' WHERE NUM_DESPACHO='$axnum_despacho_editar' AND NUM_TRANSF IS NULL";
$RSActualizar = odbc_exec($con,$SQLActualizar);

//echo $SQLActualizar;

	if($RSActualizar){

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;

	}

break;

case '154':
	

	$axid_pago =$_POST['txtid_modo_pago'];
	$axestado_forma_pago =$_POST['txtestado_forma_pago'];
	
	if($axestado_forma_pago=='PENDIENTE'){
		$axestado_forma_pago='CANCELADO';
	}elseif($axestado_forma_pago=='CANCELADO'){
		$axestado_forma_pago='PENDIENTE';
	}

	$SQLActualizar = "UPDATE PEDIDOS_DEPACHO_1 SET ESTADO_FORMA_PAGO='$axestado_forma_pago' WHERE ID_MODO_PAGO='$axid_pago'";
	$RSActualizar = odbc_exec($con,$SQLActualizar);

	//echo $SQLActualizar;

	if($RSActualizar){

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;

	}

break;
case '155':

$axid_modo_pago =$_POST['txtid_modo_pago'];
$axnum_despacho_editar =$_POST['txtnum_despacho_editar'];
$axdetalles_pagos_gasto =$_POST['txtdetalles_pagos_gasto'];
$axfecha_pago_gasto =$_POST['txtfecha_pago_gasto'];
$axobservacion_gasto =$_POST['txtobservacion_gasto'];
$axmonto_gastado =$_POST['txtmonto_gastado']/-1;
$axmedio_pago_gasto =$_POST['txtmedio_pago_gasto'];
$axparametros =$_POST['txtparametros'];

if($axparametros==0){
	$sqinsertar = "INSERT INTO PEDIDOS_DEPACHO_1 (DETALLES_PAGOS,FECHA_PAGO,OBSERVACION_DESPACHO,MONTO_PAGADO,NUM_DESPACHO,ESTADO_FORMA_PAGO,MEDIO_PAGO) VALUES ('$axdetalles_pagos_gasto','$axfecha_pago_gasto','$axobservacion_gasto','$axmonto_gastado','$axnum_despacho_editar','CANCELADO','$axmedio_pago_gasto')";	
}else{
	$sqinsertar = "UPDATE PEDIDOS_DEPACHO_1 SET DETALLES_PAGOS='$axdetalles_pagos_gasto',FECHA_PAGO='$axfecha_pago_gasto',OBSERVACION_DESPACHO='$axobservacion_gasto',MONTO_PAGADO='$axmonto_gastado',ESTADO_FORMA_PAGO='CANCELADO',MEDIO_PAGO='$axmedio_pago_gasto' WHERE ID_MODO_PAGO='$axid_modo_pago'";
}

//echo $sqinsertar;

$RSInsert = odbc_exec($con,$sqinsertar);
if($RSInsert){

	$respuesta =0;
	echo $respuesta;

}else{

	$respuesta =1;
	echo $respuesta;

}
break;
case '156':

$axid_pago =$_POST['txtid_modo_pago'];
	$axresponsabel =$_POST['txtresponsable'];
	

	$SQLActualizar = "UPDATE PEDIDOS_DEPACHO_1 SET RESPONSABLE='$axresponsabel' WHERE ID_MODO_PAGO='$axid_pago'";
	$RSActualizar = odbc_exec($con,$SQLActualizar);

	//echo $SQLActualizar;

	if($RSActualizar){

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;

	}

	
break;

case '157':
	
$axnum_despacho_editar =$_POST['txtnum_despacho_editar'];

$sqlbuscar = "SELECT * FROM RESUMEN_LIQUIDACION WHERE NUM_DESPACHO='$axnum_despacho_editar' AND PAGADO > 0";
$RSBuscar =odbc_exec($con,$sqlbuscar);
//echo $sqlbuscar;

if($RSBuscar){

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th style='text-align: left;'>Detalle</th>
			<th style='text-align: right;'>Deposito</th>
			<th style='text-align: right;'>Efectivo</th>
			<th style='text-align: right;'>Transferencia</th>
			<th style='text-align: right;'>Otros</th>
			<th style='text-align: left;'>Responsable</th>
		</tr>
		</thead>";

		while ($fila = odbc_fetch_array($RSBuscar)) {
			
			$axdetalle = $fila['DETALLES_PAGOS']; 
			$axdeposito = number_format($fila['DEPOSITO'],2,".",","); 
			$axefectivo = number_format($fila['EFECTIVO'],2,".",","); 
			$axtransferencia = number_format($fila['TRANSFERENCIA'],2,".",","); 
			$axotros = number_format($fila['OTROS'],2,".",","); 
			$axresponsable = $fila['RESPONSABLE'];

			if($axdetalle=='GASTOS EN TRASLADO'){

				echo "<tr> 
				<td class='text-danger' style='text-align: left;'>$axdetalle</td>
				<td class='text-danger' style='text-align: right;'>$axdeposito</td>
				<td class='text-danger' style='text-align: right;'>$axefectivo</td>
				<td class='text-danger' style='text-align: right;'>$axtransferencia</td>
				<td class='text-danger' style='text-align: right;'>$axotros</td>
				<td class='text-danger' style='text-align: left;'>$axresponsable</td>

			</tr>";

			}else{

				echo "<tr> 
				<td style='text-align: left;'>$axdetalle</td>
				<td style='text-align: right;'>$axdeposito</td>
				<td style='text-align: right;'>$axefectivo</td>
				<td style='text-align: right;'>$axtransferencia</td>
				<td style='text-align: right;'>$axotros</td>
				<td style='text-align: left;'>$axresponsable</td>

			</tr>";

			}

			
		}

		$sqlbuscar_T = "SELECT SUM(DEPOSITO) AS DP, SUM(EFECTIVO) AS EF,SUM(TRANSFERENCIA) AS TR, SUM(OTROS) AS OT FROM RESUMEN_LIQUIDACION WHERE NUM_DESPACHO='$axnum_despacho_editar'";
		$RSBuscar_T =odbc_exec($con,$sqlbuscar_T);
		$fila_t = odbc_fetch_array($RSBuscar_T);

		$axdeposito_1 = number_format($fila_t['DP'],2,".",","); 
		$axefectivo_1 = number_format($fila_t['EF'],2,".",","); 
		$axtransferencia_1 = number_format($fila_t['TR'],2,".",","); 
		$axotros_1 = number_format($fila_t['OT'],2,".",","); 

		echo "<tr class='table-danger'> 
				<th style='text-align: left;'>Totales</th>
				<th style='text-align: right;'>$axdeposito_1</th>
				<th style='text-align: right;'>$axefectivo_1</th>
				<th style='text-align: right;'>$axtransferencia_1</th>
				<th style='text-align: right;'>$axotros_1</th>
				<th style='text-align: left;'>$axresponsable_1</th>

			</tr>";

		echo "</table>";

}

break;

case '158':
	
$axbuscar_cliente =$_POST['txtbuscar_cliente'];

if($axbuscar_cliente==''){
	$sqlbuscar = "SELECT * FROM CUENTAS_POR_COBRAR WHERE ESTADO_FORMA_PAGO='PENDIENTE' ORDER BY ESTADO_FORMA_PAGO ASC";
}else{
	$sqlbuscar = "SELECT * FROM CUENTAS_POR_COBRAR WHERE NOM_COMERCIAL like '%".$axbuscar_cliente."%' ORDER BY NUM_COMPROBANTE,ESTADO_FORMA_PAGO ASC";
}


$RSBuscar =odbc_exec($con,$sqlbuscar);
//echo $sqlbuscar;

if($RSBuscar){

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th style='text-align: center;'>Item</th>
			<th style='text-align: left;'>Cliente</th>			
			<th style='text-align: center;'># Pedido</th>			
			<th style='text-align: center;'># Comprobante</th>			
			<th style='text-align: right;'>Facturado</th>
			<th style='text-align: right;'>Cobrado</th>
			<th style='text-align: right;'>Por cobrar</th>			
			<th style='text-align: center;'>Estado</th>
			<th style='text-align: center;'>Num. Despacho</th>
			<th style='text-align: center;'>Acción</th>
		</tr>
		</thead>";

		while ($fila = odbc_fetch_array($RSBuscar)) {
			


			$it=$it+1;
			$axid= $fila['ID_MODO_PAGO']; 
			$axcliente = $fila['NOM_COMERCIAL']; 
			$axpedido = $fila['NUM_PEDIDO']; 
			$axcomprobante = $fila['NUM_COMPROBANTE']; 
			$axnum_despacho = $fila['NUM_DESPACHO']; 
			$axestado_forma_pago = $fila['ESTADO_FORMA_PAGO']; 
			
			$axnum_transf = $fila['NUM_TRANSF']; 
			$axid_cta = $fila['ID_CTA']; 

			if($axestado_forma_pago=='CANCELADO' or $axnum_transf<>''){
				$axmedio_pago_1 = get_row('CUENTA_BANCARIAS','BANCO_CUENTA','ID_CTA',$axid_cta);
				$axmedio_pago = $fila['MEDIO_PAGO']. '-' .$axmedio_pago_1; 	
			}else{
				$axmedio_pago='';
			}

			$axcliente = get_row('PEDIDOS_CZ','NOM_COMERCIAL','NUM_PEDIDO',$axpedido);									
			$mostrar =$axpedido.' | '.$axcliente;

			$axcobrado = get_row('CUENTAS_POR_COBRAR_POR_PEDIDOS','PAGADO','NUM_PEDIDO',$axpedido);
		

			$axfacturado =number_format($fila['MONTO_FACTURADO'],2,".",",");   
			//$axcobrado = number_format($fila['MONTO_PAGADO'],2,".",","); 
			$axpor_cobrar = $fila['MONTO_FACTURADO']-$axcobrado; 
			$axestado_forma_pago = $fila['ESTADO_FORMA_PAGO'];

			echo "<tr> 
				
				<td class='text-danger' style='text-align: center;'>$it</td>
				<td class='text-danger' style='text-align: left;'>$axcliente</td>
				<td class='text-danger' style='text-align: center;'>$axpedido</td>
				<td class='text-danger' style='text-align: center;'>$axcomprobante</td>

				<td class='text-danger' style='text-align: right;'>$axfacturado</td>
				<td class='text-danger' style='text-align: right;'>$axcobrado</td>				
				<td class='text-danger' style='text-align: right;'>".number_format($axpor_cobrar,2,".",",")."</td>
								
				<td class='text-danger' style='text-align: center;'>$axestado_forma_pago</td>
				<td class='text-danger' style='text-align: center;'>$axnum_despacho</td>
				<td class='text-danger' style='text-align: center;'>
					<button type='button' class='btn btn-danger btn-sm' id='btn_asignar_pago_a_rendicion' data-id='$axid' data-titulo='$mostrar' ><i class='bi bi-cash-coin'></i> Pagar</button>
				</td>
			
			

			</tr>";

			
		}


		echo "</table>";

}

break;

case '159':
	
$axcod_mov_cz = $_POST['txtcod_mov_cz']; 		
$axid_td_nc = $_POST['txtid_tipo_doc_nc']; 
$axid_local = get_row('MAESTRO_CZ','ID_LOCAL','COD_MOV',$axcod_mov_cz);


$sqletapas = "SELECT * FROM CORRELATIVOS WHERE ID_LOCAL ='$axid_local' AND ID_TD='$axid_td_nc' ORDER BY ID_TD ASC" ;
//echo $sqletapas;	      
$rsetapas=odbc_exec($con,$sqletapas);
	
	if(odbc_num_rows($rsetapas) > 0){
	//	echo '<option value="">Seleccionar</option>';
		while($fila=odbc_fetch_array($rsetapas)){
	   		echo '<option value='.$fila['COD_CORR'].'>'.$fila['N_SERIE'].'</option>';
    	}
		
	} else {

		echo "";	
	}

break;

case '160':
	
$axserie_nc = $_POST['txt_serie_nc']; 		
$sqletapas = "SELECT * FROM CORRELATIVOS WHERE COD_CORR='$axserie_nc' ORDER BY ID_TD ASC" ;	

//echo $sqletapas;	      
$rsetapas=odbc_exec($con,$sqletapas);
$fila = odbc_fetch_array($rsetapas);

$axcorrelativo = $fila['N_CORRELATIVO']+1;
echo number_pad($axcorrelativo,8);

break;


case '161':
	
$axid_local =$_POST['txtid_local'];
$axfecha_del =$_POST['txtfecha_del'];
$axfecha_al =$_POST['txtfecha_al'];


$SQLBuscar ="SELECT * FROM REPORTE_IMPUESTOS WHERE DETALLE_DOC <> 'NOTA SALIDA' AND FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' ORDER BY TXT_SERIE,DOCUMENTO ASC"; 
//echo $SQLBuscar;

echo "
		<div style='margin-top:5px; padding:5px; text-align: right;'>
		<a href='exportar_excel.php?param=3&local=$axid_local&del=$axfecha_del&al=$axfecha_al' class='btn btn-outline-danger btn-sm' ><b> <i class='bi bi-file-earmark-excel-fill'></i> Excel</b></a>
		</div>
		
		
		<table class='table table-hover table-sm'>
		<thead class='table-success'>			
		<tr>
			<th style='text-align: center;'>Item</th>
			<th style='text-align: center;'>Fecha Emisión</th>
			<th style='text-align: center;'>Serie</th>
			<th style='text-align: center;'>Correlativo</th>			
			<th style='text-align: center;'>Num. Pedido</th>			
			<th style='text-align: center;'>Ruc </th>			
			<th style='text-align: left;'>Cliente</th>						
			<th class='table-success' style='text-align: right;'>Valor Venta</th>			
			<th class='table-success' style='text-align: right;'>Igv</th>						
			<th class='table-primary' style='text-align: right;'>Total Venta</th>			
			<th style='text-align: center;'>Estado</th>			
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);		
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		
 		$it= $it+1;
 		$axfecha = date('d-m-Y', strtotime($fila['FECHA_EMISION']));		 		
 		$axserie = $fila['TXT_SERIE'];
 		$axdocumento = $fila['DOCUMENTO'];				
 		$axnum_pedido = $fila['NUM_PEDIDO'];				
 		$axruc = $fila['RUC_BENEF'];				
		$axcliente = $fila['CLIENTE'];		
		$axvalor_venta = number_format($fila["VALOR_VENTA"],2,".",","); 
		$axigv = number_format($fila["IGV"],2,".",","); 		
		$axtotalventa = number_format($fila["TOTAL_VENTA"],2,".",","); 
		$axestado_electro = $fila['ESTADO_ELECTRO'];		
		

 	echo "
 		<tr> 		
 			<td style='text-align: center;'>".$it."</td> 
 			<td style='text-align: center;'>".$axfecha."</td> 
 			<td style='text-align: center;'>".$axserie."</td> 
 			<td style='text-align: center;'>".$axdocumento."</td> 
 			<td style='text-align: center;'>".$axnum_pedido."</td> 
 			<td style='text-align: center;'>".$axruc."</td>  			
 			<td style='text-align: left;'>".$axcliente."</td> 
 			<td style='text-align: right;'>".$axvalor_venta."</td>  			
 			<td style='text-align: right;'>".$axigv."</td>  			
 			<td style='text-align: right;'>".$axtotalventa."</td>";

 			if($axestado_electro=='ANULADA'){

 				echo "<td class='text-danger' style='text-align: center;'><b>".$axestado_electro."</b></td>";

 			}elseif($axestado_electro=='RECHAZADA'){

 				echo "<td class='text-primary' style='text-align: center;'><b>".$axestado_electro."</b></td>";

 			}else{

 				echo "<td class='text-success' style='text-align: center;'><b>".$axestado_electro."</b></td>";
 			}

 			
 			
 			
 		echo "</tr>";
 	
 	}



	echo "</table>";
	}

break;

case '162':

date_default_timezone_set("America/Lima");

$axcod_mov_cz = $_POST['txtcod_mov_cz']; 
$axid_td = $_POST['txtid_tipo_doc_nc']; 
$axid_serie = $_POST['txt_serie_nc']; 
$axdocumento = $_POST['txtn_correlativo_nc']; 
$axfec_emis_ref = $_POST['txtfecha_doc_ref']; 
$axtxt_serie_ref = $_POST['txtnum_serie_ref']; 
$axtxt_correlativo_cpe_ref = $_POST['txtcorrelativo_ref']; 
$axtxt_sustento = $_POST['txtsustento']; 
$axcod_tip_nc_nd_ref = $_POST['txtcod_tip_nc_nd_ref']; 
$axfecha_emision = $_POST['txtfecha_actual']; 
$axmonto_dscto = $_POST['txtmonto_dscto']; 
$axperiodo_emision = date('m-Y',strtotime($axfecha_emision));
$axfecha_registro = date('Y-m-d');
$axmotivo_devolucion ='0';
$axhora_emision = date('H:i:s');
$axano= date('Y',strtotime($axfecha_emision));
$axtxt_serie  = get_row('CORRELATIVOS','N_SERIE','COD_CORR',$axid_serie);
$axtxt_descr_mtvo_baja ='0';

if($axcod_tip_nc_nd_ref=='04' || $axcod_tip_nc_nd_ref=='05'){
	$axestado_inventario='';
}else{
	$axestado_inventario='INVENTARIO';
}



$SQLMaestro_cz = "SELECT * FROM MAESTRO_CZ WHERE COD_MOV='$axcod_mov_cz'";
$RSMaestro_cz = odbc_exec($con,$SQLMaestro_cz);

while ($fila_cz = odbc_fetch_array($RSMaestro_cz)) {

	$axid_local=$fila_cz['ID_LOCAL'];
	$axcodusuario =$fila_cz['ID_USUARIO'];

	$axcodmovcz_nuevo= $_POST['txtcod_mov_cz_NC']; 
	
	$axtipo_mov =$fila_cz['TIPO_MOV'];
	$axdetalle_movimiento =$fila_cz['DETALLE_MOVIMIENTO'];
	$axglosa =$fila_cz['GLOSA'];
	$axestado_electro ='PENDIENTE';
	$axperiodo_contable= date('m-Y',strtotime($axfecha_emision));

	$axfecha_contable= $axfecha_emision;
	$axestado_final=$fila_cz['ESTADO_FINAL'];
	$axid_td_rf= get_row('MAESTRO_CZ','ID_TD','COD_MOV',$axcod_mov_cz);
	$axcod_cpe_ref= get_row('TIPO_DOCUMENTOS','COD_SUNAT','ID_TD',$axid_td_rf);
	$axestado_enviado_itc='PENDIENTE';
	
	$axcod_tip_frpago=$fila_cz['COD_TIP_FRPAGO'];
	$axmnto_crdt_ttal=$fila_cz['MNTO_CRDT_TTAL'];
	$axmnto_crdt_cta=$fila_cz['MNTO_CRDT_CTA'];
	$axestado_envio_cliente=$fila_cz['ESTADO_ENVIO_CLIENTE'];

	$axid_beneficiario  =$fila_cz['ID_BENEFICIARIO'];
	$axid_usuario  =$fila_cz['ID_USUARIO'];
	$axtotal_venta =$fila_cz['TOTAL_VENTA'];
	$axvalor_venta =$fila_cz['VALOR_VENTA'];
	$axigv =$fila_cz['IGV'];
	$axgravadas =$fila_cz['GRAVADAS'];
	$axinafectas =$fila_cz['INAFECTAS'];
	$axexoneradas =$fila_cz['EXONERADAS'];
	$axnum_pedido =$fila_cz['NUM_PEDIDO'];
	$axcod_guia_cz=$fila_cz['COD_GUIA_CZ'];

	$axmoneda ='SOLES';
	$axmnt_tot_gravadas =$fila_cz['MNT_TOT_GRAVADAS'];
	$axmnt_tot_inafectas =$fila_cz['MNT_TOT_INAFECTAS'];
	$axmnt_tot_exoneradas =$fila_cz['MNT_TOT_EXONERADAS'];
	$axmnt_tot_gratuitas =0;
	$axmnt_tot =$fila_cz['MNT_TOT'];

	//cod_tip_nc_nd_ref

	$SQLInsert =  "INSERT INTO MAESTRO_CZ (COD_MOV,TIPO_MOV,DETALLE_MOVIMIENTO,FECHA_EMISION,PERIODO_EMISION,ID_TD,TXT_SERIE,DOCUMENTO,ID_BENEFICIARIO,ID_USUARIO,TOTAL_VENTA,FECHA_REGISTRO,MOTIVO_DEVOLUCION,HORA_EMISION,ANO,ID_LOCAL,GLOSA,VALOR_VENTA,IGV,GRAVADAS,INAFECTAS,EXONERADAS,PERIODO_CONTABLE,MONEDA,MNT_TOT_GRAVADAS,MNT_TOT_INAFECTAS,MNT_TOT_EXONERADAS,MNT_TOT_GRATUITAS,MNT_TOT,ESTADO_ELECTRO,txt_serie_ref,txt_correlativo_cpe_ref,fec_emis_ref,txt_sustento,cod_tip_nc_nd_ref,FECHA_CONTABLE,ESTADO_FINAL,COD_CPE_REF,ESTADO_ENVIADO_ITC,COD_TIP_FRPAGO,MNTO_CRDT_TTAL,MNTO_CRDT_CTA,ESTADO_ENVIO_CLIENTE,NUM_PEDIDO,ESTADO_INVENTARIO) VALUES ('$axcodmovcz_nuevo','$axtipo_mov','$axdetalle_movimiento','$axfecha_emision','$axperiodo_emision','$axid_td','$axtxt_serie','$axdocumento','$axid_beneficiario','$axid_usuario','$axtotal_venta','$axfecha_registro','$axmotivo_devolucion','$axhora_emision','$axano','$axid_local','$axglosa','$axvalor_venta','$axigv','$axgravadas','$axinafectas','$axexoneradas','$axperiodo_contable','$axmoneda','$axmnt_tot_gravadas','$axmnt_tot_inafectas','$axmnt_tot_exoneradas','$axmnt_tot_gratuitas','$axmnt_tot','$axestado_electro','$axtxt_serie_ref','$axtxt_correlativo_cpe_ref','$axfec_emis_ref','$axtxt_sustento','$axcod_tip_nc_nd_ref','$axfecha_contable','$axestado_final','$axcod_cpe_ref','$axestado_enviado_itc','$axcod_tip_frpago','$axmnto_crdt_ttal','$axmnto_crdt_cta','$axestado_envio_cliente','','$axestado_inventario')";

//echo $SQLInsert;
$RSInsert = odbc_exec($con,$SQLInsert);

		if($RSInsert){

			if($axcod_tip_nc_nd_ref =='04'){

				$axid_producto = 194; //CODIGO DEL SERVICIO CREADO EN PRODUCTOS NO BORRAR ESTE PRODUCTO
				$axprs_venta = $axmonto_dscto;
				
				$axafectacion = get_row('PRODUCTOS_LISTADO','ABREV_AFECTACION','ID_PRODUCTO',$axid_producto);
				$axigv = get_row('LOCALES','PORC_IGV','ID_LOCAL',$axid_local);
				$axigv_1 = 1+$axigv;
				$axcant_salida_padre=1;

			if($axafectacion=='GRAVADA'){

				$axvalor_salida = $axcant_salida_padre*($axprs_venta/$axigv_1);
				$axigv_salida = $axvalor_salida*$axigv;
				$axgravadas_salida = $axvalor_salida;
				$axinafecto_salida = 0;
				$axexonerado_salida = 0;
				$axtotal_salida= $axvalor_salida+$axigv_salida;
				$axtotal_pedido=$axtotal_salida;

			}elseif($axafectacion=='EXONERADA'){

				$axvalor_salida = $axcant_salida_padre*($axprs_venta);
				$axigv_salida = 0;
				$axgravadas_salida = 0;
				$axinafecto_salida = 0;
				$axexonerado_salida = $axvalor_salida;
				$axtotal_salida = $axvalor_salida+$axigv_salida;
				$axtotal_pedido=$axtotal_salida;
				
			}elseif($axafectacion=='INAFECTO'){

				$axvalor_salida = $axcant_salida_padre*($axprs_venta);
				$axigv_salida = 0;
				$axgravadas_salida = 0;
				$axinafecto_salida = $axvalor_salida;
				$axexonerado_salida = 0;
				$axtotal_salida = $axvalor_salida+$axigv_salida;
				$axtotal_pedido=$axtotal_salida;
				
			}

				$axforma_pago = get_row('MAESTRO_DT','FORMA_PAGO','COD_MOV',$axcod_mov_cz);
				$axestado_forma_pago = get_row('MAESTRO_DT','ESTADO_FORMA_PAGO','COD_MOV',$axcod_mov_cz);
				$axmedio_pago = get_row('MAESTRO_DT','MEDIO_PAGO','COD_MOV',$axcod_mov_cz);
				$axnum_transf = '0';
				$axpor_detraccion = 0;
				$axmonto_detraccion = 0;
				$axnum_detraccion = 0;
				$axfecha_detraccion =$fila_pedidos_dt['FECHA_DETRACCION'];
				$axestado_producto = 'BUENO';
				$axobservar = '0';

				$axfecha_transf = get_row('MAESTRO_DT','FECHA_TRANSF','COD_MOV',$axcod_mov_cz); 
				$axid_cta = get_row('MAESTRO_DT','ID_CTA','COD_MOV',$axcod_mov_cz); 
				$axperiodo_transf = get_row('MAESTRO_DT','PERIODO_TRANSF','COD_MOV',$axcod_mov_cz); 
				$axnum_lin_item = 1;
				$axcant_padre = $axid_producto;

				$SQLInsert_dt = "INSERT INTO MAESTRO_DT (COD_MOV,ID_PRODUCTO,CANT_SALIDA,PRS_VENTA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,FORMA_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,NUM_TRANSF,ESTADO_PRODUCTO,OBSERVAR,FECHA_TRANSF,ID_CTA,PERIODO_TRANSF,NUM_LIN_ITEM,CANT_PADRE) VALUES ('$axcodmovcz_nuevo','$axid_producto','$axcant_salida_padre','$axprs_venta','$axvalor_salida','$axigv_salida','$axgravadas_salida','$axinafecto_salida','$axexonerado_salida','$axtotal_salida','$axforma_pago','$axestado_forma_pago','$axmedio_pago','$axnum_transf','$axestado_producto','$axobservar','$axfecha_transf','$axid_cta','$axperiodo_transf','$axnum_lin_item','$axcant_padre')";
					$RSInsert_dt =odbc_exec($con,$SQLInsert_dt);
					//echo $SQLInsert_dt;


			}else{

				$SQLPedidos_dt = "SELECT * FROM MAESTRO_DT WHERE COD_MOV='$axcod_mov_cz'";
				$RSpedidos_dt = odbc_exec($con,$SQLPedidos_dt);

					//echo $SQLPedidos;

					while ($fila_pedidos_dt = odbc_fetch_array($RSpedidos_dt)) {

					$it = $it+1;
					$axid_producto = $fila_pedidos_dt['ID_PRODUCTO'];
					$axcant_ingreso = 0;
					$axcosto_producto = $fila_pedidos_dt['COSTO_PRODUCTO'];
					$axdsctos_ingreso = 0;
					$axvalor_ingreso = 0;
					$axigv_ingreso = 0;
					$axgravadas_ingreso = 0;
					$axinafecto_ingresos = 0;
					$axexonerado_ingreso = 0;
					$axtotal_ingreso = 0;
					$axcant_salida = $fila_pedidos_dt['CANT_SALIDA']/-1;
					$axprs_mayor = $fila_pedidos_dt['PRS_MAYOR'];
					$axprs_premiun = $fila_pedidos_dt['PRS_PREMIUN'];
					$axprs_menor = $fila_pedidos_dt['PRS_MENOR'];
					$axprs_venta = $fila_pedidos_dt['PRS_VENTA'];
					$axdsctos_salida = $fila_pedidos_dt['DSCTOS_SALIDA'];
					$axvalor_salida = $fila_pedidos_dt['VALOR_SALIDA'];
					$axigv_salida = $fila_pedidos_dt['IGV_SALIDA'];
					$axgravadas_salida = $fila_pedidos_dt['GRAVADAS_SALIDA'];
					$axinafecto_salida = $fila_pedidos_dt['INAFECTO_SALIDA'];
					$axexonerado_salida = $fila_pedidos_dt['EXONERADO_SALIDA'];
					$axtotal_salida = $fila_pedidos_dt['TOTAL_SALIDA'];
					$axcant_padre = $fila_pedidos_dt['CANT_PADRE'];

					$axforma_pago = $fila_pedidos_dt['FORMA_PAGO'];
					$axestado_forma_pago = $fila_pedidos_dt['ESTADO_FORMA_PAGO'];
					$axmedio_pago = $fila_pedidos_dt['MEDIO_PAGO'];
					$axnum_transf = $fila_pedidos_dt['NUM_TRANSF'];
					$axpor_detraccion = 0;
					$axmonto_detraccion = 0;
					$axnum_detraccion = 0;
					$axfecha_detraccion =$fila_pedidos_dt['FECHA_DETRACCION'];
					$axestado_producto = 'BUENO';
					$axobservar = '0';

					$axfecha_transf = $fila_pedidos_dt['FECHA_TRANSF'];
					$axid_cta = $fila_pedidos_dt['ID_CTA'];
					$axperiodo_transf = $fila_pedidos_dt['PERIODO_TRANSF'];
					$axnum_lin_item = $fila_pedidos_dt['NUM_LIN_ITEM'];

						

							$SQLInsert_dt = "INSERT INTO MAESTRO_DT (COD_MOV,ID_PRODUCTO,CANT_INGRESO,COSTO_PRODUCTO,DSCTOS_INGRESO,VALOR_INGRESO,IGV_INGRESO,GRAVADAS_INGRESO,INAFECTO_INGRESOS,EXONERADO_INGRESO,TOTAL_INGRESO,CANT_SALIDA,PRS_MAYOR,PRS_PREMIUN,PRS_MENOR,PRS_VENTA,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,FORMA_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,NUM_TRANSF,POR_DETRACCION,MONTO_DETRACCION,NUM_DETRACCION,FECHA_DETRACCION,ESTADO_PRODUCTO,OBSERVAR,FECHA_TRANSF,ID_CTA,PERIODO_TRANSF,NUM_LIN_ITEM,CANT_PADRE) VALUES ('$axcodmovcz_nuevo','$axid_producto','$axcant_ingreso','$axcosto_producto','$axdsctos_ingreso','$axvalor_ingreso','$axigv_ingreso','$axgravadas_ingreso','$axinafecto_ingresos','$axexonerado_ingreso','$axtotal_ingreso','$axcant_salida','$axprs_mayor','$axprs_premiun','$axprs_menor','$axprs_venta','$axdsctos_salida','$axvalor_salida','$axigv_salida','$axgravadas_salida','$axinafecto_salida','$axexonerado_salida','$axtotal_salida','$axforma_pago','$axestado_forma_pago','$axmedio_pago','$axnum_transf','$axpor_detraccion','$axmonto_detraccion','$axnum_detraccion','$axfecha_detraccion','$axestado_producto','$axobservar','$axfecha_transf','$axid_cta','$axperiodo_transf','$axnum_lin_item','$axcant_padre')";

							$RSInsert_dt =odbc_exec($con,$SQLInsert_dt);
							//echo $SQLInsert_dt;

			}






		}
	}	
}
/*****/	

/*

	

			

			

				
				

			}


			$SQLPedidos = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='PROGRAMADO',ESTADO_REVISION='CERRADO' WHERE ID_LOCAL='$axid_local' AND NUM_PEDIDO='$axnum_pedido'";
			$RSpedidos = odbc_exec($con,$SQLPedidos);
			//echo $SQLPedidos;

				$respuesta = 0;
				echo $respuesta; //SE GRABO LA CABECERA Y EL DETALLE DE LA FACTURA O BELTA


	}else{

				$respuesta = 1;
				echo $respuesta; //NO GRABO LA CABECERA DE LA FACTURA O BELTA

	}


}

*/

break;

case '163':

	
$axcod_mov = $_POST['txtcod_mov_cz_NC']; 	
$axcod_tipo = get_row('MAESTRO_CZ','cod_tip_nc_nd_ref','COD_MOV',$axcod_mov);

$SQLBuscar = "SELECT  * FROM MAESTRO_INGRESOS_DT WHERE COD_MOV='$axcod_mov' order by COD_MOV_DT ASC";
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
			<th class='table-danger ocultar_1'style='text-align: right;'>Cant</th>									
			<th class='table-danger ocultar'style='text-align: right;'>Precio</th>									
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
		$axcant_compra =$fila["CANT_SALIDA"];
		$axcod_tipo = get_row('MAESTRO_CZ','cod_tip_nc_nd_ref','COD_MOV',$axcod_mov);
		$axprecio_v = $fila["PRS_VENTA"];


		$axcant = number_format($fila["CANT_SALIDA"],2,".",",");
		$axprecio = number_format($fila["PRS_VENTA"],4,".",",");
		$axvalor = number_format($fila["VALOR_SALIDA"],2,".",",");
		$axigv = number_format($fila["IGV_SALIDA"],2,".",",");
		$axgravada = number_format($fila["GRAVADAS_SALIDA"],2,".",",");
		$axexonerada = number_format($fila["EXONERADO_SALIDA"],2,".",",");
		$axinafecta = number_format($fila["INAFECTO_SALIDA"],2,".",",");
		$axtotal = number_format($fila["TOTAL_SALIDA"],2,".",",");

		//echo $axcod_mov_dt;

	if($axcod_tipo=='01' || $axcod_tipo=='04'){

			echo "
 		<tr> 		
 			<td class='ocultar'style='text-align: center;'>".$it."</td>
 			<td class='ocultar_1'style='text-align: left;''>".$axcod_producto.' | '.utf8_encode($axnom_producto)."</td>  			
 			<td class='table-danger ocultar_1'style='text-align: right;'>".$axcant."</td> 
 			<td class='table-danger ocultar'style='text-align: right;'>".$axprecio."</td> 
 			<td class='ocultar'style='text-align: right;'>".$axvalor."</td> 
 			<td class='ocultar'style='text-align: right;'>".$axigv."</td> 
 			<td class='ocultar'style='text-align: right;'>".$axgravada."</td> 
 			<td class='ocultar' style='text-align: right;'>".$axexonerada."</td> 
 			<td class='ocultar' style='text-align: right;'>".$axinafecta."</td> 
 			<td class='ocultar_1'style='text-align: right;'>".$axtotal."</td>
 			<td class='ocultar_1'style='text-align: center;'>
 				<b><i class='bi bi-x-circle-fill'></i></b>
 			</td>
 		</tr>";	

	}else if($axcod_tipo=='05' ){

				echo "
 		<tr> 		
 			<td class='ocultar'style='text-align: center;'>".$it."</td>
 			<td style='text-align: left;''>".$axcod_producto.' | '.utf8_encode($axnom_producto)."</td>  			
 			<td class='table-danger' style='text-align: right;'>".$axcant."</td> 
 			<td contenteditable id='btn_cambiar_precio_nc' data-idprod='$axid_producto' data-id_dt='$axcod_mov_dt' data-cantidad='$axcant_compra' class='table-danger ocultar'style='text-align: right;'>".$axprecio."</td> 
 			<td class='ocultar'style='text-align: right;'>".$axvalor."</td> 
 			<td class='ocultar'style='text-align: right;'>".$axigv."</td> 
 			<td class='ocultar'style='text-align: right;'>".$axgravada."</td> 
 			<td class='ocultar' style='text-align: right;'>".$axexonerada."</td> 
 			<td class='ocultar' style='text-align: right;'>".$axinafecta."</td> 
 			<td class='ocultar_1'style='text-align: right;'>".$axtotal."</td>
 			<td class='ocultar_1'style='text-align: center;'>
 				<a href='#' class='dropdown-item text-danger' id='btn_eliminar_dt' data-id='$axcod_mov_dt'><b><i class='bi bi-trash3-fill'></i></a></b>
 			</td>
 		</tr>";	


	}else{

			echo "
 		<tr> 		
 			<td class='ocultar'style='text-align: center;'>".$it."</td>
 			<td class='ocultar_1'style='text-align: left;''>".$axcod_producto.' | '.utf8_encode($axnom_producto)."</td>  			
 			<td contenteditable id='btn_cambiar_cantidad_nc' data-idprod='$axid_producto' data-id_dt='$axcod_mov_dt' data-precio='$axprecio_v' class='table-danger ocultar_1'style='text-align: right;'>".$axcant."</td> 
 			<td class='table-danger ocultar'style='text-align: right;'>".$axprecio."</td> 
 			<td class='ocultar'style='text-align: right;'>".$axvalor."</td> 
 			<td class='ocultar'style='text-align: right;'>".$axigv."</td> 
 			<td class='ocultar'style='text-align: right;'>".$axgravada."</td> 
 			<td class='ocultar' style='text-align: right;'>".$axexonerada."</td> 
 			<td class='ocultar' style='text-align: right;'>".$axinafecta."</td> 
 			<td class='ocultar_1'style='text-align: right;'>".$axtotal."</td>
 			<td class='ocultar_1'style='text-align: center;'>
 				<a href='#' class='dropdown-item text-danger' id='btn_eliminar_dt' data-id='$axcod_mov_dt'><b><i class='bi bi-trash3-fill'></i></a></b>
 			</td>
 		</tr>";	

	}

 
}

$SQLBuscar_t = "SELECT  SUM(VALOR_SALIDA) AS VC, SUM(IGV_SALIDA) AS IG, SUM(GRAVADAS_SALIDA) AS GR, SUM(EXONERADO_SALIDA) AS EX, SUM(INAFECTO_SALIDA) AS IA, SUM(TOTAL_SALIDA) AS TT FROM MAESTRO_INGRESOS_DT WHERE COD_MOV='$axcod_mov'"; 
//echo $SQLBuscar_t;


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

case '164':
	
	$axcod_mov = $_POST['txtcod_mov_cz_NC']; 	

	$SQLDelete = "DELETE FROM MAESTRO_DT WHERE COD_MOV='$axcod_mov'";
	$RSDelete = odbc_exec($con,$SQLDelete);

	if($RSDelete){

		$SQLDelete_cz = "DELETE FROM MAESTRO_CZ WHERE COD_MOV='$axcod_mov'";
		$RSDelete_cz = odbc_exec($con,$SQLDelete_cz);

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;


	}

break;

case '165': ///nota de credito
	

$axcodmovcz = trim($_POST['txtcod_mov_cz_NC']);
$axid_serie = $_POST['txt_serie_nc']; 

if($axidlocal==''){
	$axidlocal= get_row('MAESTRO_CZ','ID_LOCAL','COD_MOV',$axcodmovcz);
}else{
	$axidlocal= $_POST['txtid_local'];	
}

$axcod_cliente_emis= get_row('LOCALES','cod_cliente_emis','ID_LOCAL',$axidlocal);
$axruta= get_row('LOCALES','RUTA_JSON','ID_LOCAL',$axidlocal);
$axtoken= get_row('LOCALES','TOKEN_EMPRESA','ID_LOCAL',$axidlocal);
$axurl= get_row('LOCALES','URL_PRODUCCION','ID_LOCAL',$axidlocal);
//$axurl= "http://testsee.itc.com.pe/api/billservice";

//echo $axcod_cliente_emis;

$SQLDatos_1 ="SELECT TOP 1 * FROM MAESTRO_GENERAR_JSON WHERE COD_MOV='$axcodmovcz' AND ID_LOCAL='$axidlocal'";
$RSDatos_1=odbc_exec($con,$SQLDatos_1);
$row=odbc_fetch_array($RSDatos_1);
			
	$axrucempresa= $row['RUC_EMPRESA'];
	$axtipodoc= $row['COD_SUNAT'];
	$axnserie= $row['TXT_SERIE'];
	$axcorrelativo= $row['DOCUMENTO'];
	$axdocumento_tipo= $row['DETALLE_DOC'];

	$LblNombreArchivo = $axrucempresa.'-'.$axtipodoc.'-'.$axnserie.'-'.$axcorrelativo.'.json';
	//echo $LblNombreArchivo;
	$response=array();

	$SQLDatosCZ ="SELECT top 1 identificador,fec_emis,hora_emis,TXT_SERIE,txt_correlativo,cod_tip_cpe,cod_mnd,cod_tip_escenario,txt_placa,cod_cliente_emis,num_ruc_emis,nom_rzn_soc_emis,cod_tip_nif_emis,cod_loc_emis,cod_ubi_emis,txt_dmcl_fisc_emis,TXT_URB_EMIS,txt_prov_emis,txt_dpto_emis,txt_distr_emis,num_iden_recp,cod_tip_nif_recp,nom_rzn_soc_recp,txt_dmcl_fisc_recep,txt_correo_adquiriente,mnt_tot_gravadas,mnt_tot_inafectas,mnt_tot_exoneradas,mnt_tot_gratuitas,mnt_tot_desc_global,mnt_tot_igv,mnt_tot_igv_isc,mnt_tot_base_imponible,mnt_tot_percepcion,mnt_tot_a_percibir,mnt_tot,cod_tip_nc_nd_ref,txt_serie_ref,txt_correlativo_cpe_ref,fec_emis_ref,cod_cpe_ref,txt_sustento,cod_operacion,porcentaje_dscto,mnt_anticipo,mnt_otros_cargos,tipo_percepcion,porcentaje_percepcion,tipo_cambio,OBSERVACIONES,flag_envio_automatico,dato_extra_1,dato_extra_2,dato_extra_3,dato_extra_4,mnt_tot_icbper,cod_tip_frmpgo,mnto_crdt_ttal,mnto_crdt_cta,fch_cta FROM F_JSON_CZ WHERE COD_MOV='$axcodmovcz'";

$RSDatosCZ=odbc_exec($con,$SQLDatosCZ);
$filacz = odbc_fetch_array($RSDatosCZ);


$SQLDatosDT ="SELECT num_lin_item,cod_unid_item,cant_unid_item,val_vta_item,cod_tip_afect_igv_item,prc_vta_unit_item,mnt_dscto_item,mnt_igv_item,txt_descr_item,cod_prod_sunat,cod_item,val_unit_item,cod_tip_sist_isc,mnt_isc_item,porcentaje_isc,dato_extra_1,dato_extra_2,importe_total_item,val_unit_icbper,cant_icbper_item,mnt_icbper_item FROM F_JSON_DT_NC WHERE COD_MOV='$axcodmovcz'";


$RSDatosDT=odbc_exec($con,$SQLDatosDT);
$axnum = odbc_num_rows($RSDatosDT);

for ($i=0; $i < $axnum ; $i++) { 
		
	$filaDT = odbc_fetch_array($RSDatosDT);
	$jsonDT_1[$i] = $filaDT;
}

$array1    = $filacz;
$array2['anticipos'] = array();
$array3['detalles'] = $jsonDT_1;
$resultado = $array1 + $array2 + $array3;
$jsonfinal_1 = json_encode($resultado,JSON_PRETTY_PRINT);	
$jsonfinal = preg_replace('#:"(\d+)"#', ':$1', $jsonfinal_1);

$file = $axruta.$LblNombreArchivo;  
file_put_contents($file, $jsonfinal);


if($axcod_cliente_emis !==''){

	$axnom_archivo = $axruta.$LblNombreArchivo;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $axurl);
	$parametros = @file_get_contents($axnom_archivo);	
	curl_setopt($ch, CURLOPT_POSTFIELDS, $parametros);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:'.$axtoken));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);

	$result = curl_exec($ch);
	$codigoRespuesta = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	//echo $axurl.'|'.$codigoRespuesta.'|'.$axtoken;

	
	if($codigoRespuesta === 200){
	    
		$SQLActualizar = "UPDATE MAESTRO_CZ SET BOUCHER_DIGITAL='$LblNombreArchivo',ESTADO_ELECTRO='PROCESADA',ESTADO_FINAL='PROCESADA',ESTADO_ENVIADO_ITC='ENVIADO' WHERE COD_MOV='$axcodmovcz'";
		$RSActualizar = odbc_exec($con, $SQLActualizar);

		$SQLActualizar_correlativo = "UPDATE CORRELATIVOS SET N_CORRELATIVO='$axcorrelativo' WHERE ID_LOCAL='$axidlocal' AND COD_CORR='$axid_serie'";
		$RSActualizar_correlativo = odbc_exec($con,$SQLActualizar_correlativo);

		$respuesta = 200;
		echo $respuesta;
	
	}else{

    $SQLActualizar = "UPDATE MAESTRO_CZ SET BOUCHER_DIGITAL='$LblNombreArchivo',ESTADO_ELECTRO='PENDIENTE',ESTADO_FINAL='PENDIENTE',ESTADO_ENVIADO_ITC='PENDIENTE' WHERE COD_MOV='$axcodmovcz'";
		$RSActualizar = odbc_exec($con, $SQLActualizar);
	
	}	

	curl_close($ch);
	

	}else{

		$SQLActualizar = "UPDATE MAESTRO_CZ SET BOUCHER_DIGITAL='$LblNombreArchivo',ESTADO_ELECTRO='PROCESADA',ESTADO_FINAL='PENDIENTE',ESTADO_ENVIADO_ITC='PENDIENTE' WHERE COD_MOV='$axcodmovcz'";
		$RSActualizar = odbc_exec($con, $SQLActualizar);	


		$respuesta = 0;
		echo $respuesta;
	}


break;

case '166':
	
$axcod_mov_dt= $_POST['txtcod_mov_dt'];
$axcod_mov= get_row('MAESTRO_DT','COD_MOV','COD_MOV_DT',$axcod_mov_dt);
$axid_local= get_row('MAESTRO_CZ','ID_LOCAL','COD_MOV',$axcod_mov);

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
case '167':
	
$axid_local =$_POST['txtid_local'];

$axcant_salida =$_POST['txtcant_ingreso'];
$axprecio_venta =$_POST['txtprecio_venta'];
$axcod_mov_dt =$_POST['txtcod_mov_dt'];
$axcod_mov =get_row('MAESTRO_DT','COD_MOV','COD_MOV_DT',$axcod_mov_dt);
$axid_producto =$_POST['txtid_producto'];
$axporc_igv = get_row('LOCALES','PORC_IGV','ID_LOCAL',$axid_local);
$axigv1 = 1+$axporc_igv;

$axafectacion = get_row('PRODUCTOS_LISTADO','ABREV_AFECTACION','ID_PRODUCTO',$axid_producto);

if($axafectacion=='GRAVADA'){

	$axvalor_salida = $axcant_salida*$axprecio_venta/$axigv1;
	$axigv_salida =$axvalor_salida* $axporc_igv;
	$axgravadas_salida = $axvalor_salida;
	$axinafecto_salida = 0;
	$axexonerado_salida = 0;
	$axtotal_salida = $axvalor_salida+$axigv_salida;

}elseif($axafectacion=='EXONERADA'){

	$axvalor_salida = $axcant_salida*$axprecio_venta/$axigv1;
	$axigv_isalida=0;
	$axgravadas_salida = 0;
	$axinafecto_salida = $axvalor_salida;
	$axexonerado_salida = 0;
	$axtotal_salida = $axvalor_salida+$axigv_salida;

}elseif($axafectacion=='INAFECTO'){

	$axvalor_salida = $axcant_salida*$axprecio_venta/$axigv1;
	$axigv_salida =0;
	$axgravadas_salida = 0;
	$axinafecto_salida = 0;
	$axexonerado_salida = $axvalor_salida;;
	$axtotal_salida = $axvalor_salida+$axigv_salida;

}

$axcant_salida_1 =$axcant_salida/-1;

	$sqlinserta = "UPDATE MAESTRO_DT SET CANT_SALIDA='$axcant_salida_1',DSCTOS_SALIDA='0',VALOR_SALIDA='$axvalor_salida',IGV_SALIDA='$axigv_salida',GRAVADAS_SALIDA='$axgravadas_salida',INAFECTO_SALIDA='$axinafecto_salida',EXONERADO_SALIDA='$axexonerado_salida',TOTAL_SALIDA='$axtotal_salida' WHERE COD_MOV_DT='$axcod_mov_dt'";
	$rsinserta = odbc_exec($con,$sqlinserta);
	//echo $sqlinserta;


	if($rsinserta){

		$SQLTotal = "SELECT TOP 1 * FROM MAESTRO_INGRESOS_TT WHERE COD_MOV='$axcod_mov' AND ID_LOCAL='$axid_local'";
		$RSTotal = odbc_exec($con,$SQLTotal);
		$fila_tt = odbc_fetch_array($RSTotal);

		//echo $SQLTotal;

		$axvalor_salida = $fila_tt['VALOR_SALIDA'];
		$axigv_salida = $fila_tt['IGV_SALIDA'];
		$axgravadas_salida = $fila_tt['GRAVADAS_SALIDA'];
		$axinafecto_isalida = $fila_tt['INAFECTO_SALIDA'];
		$axexonerado_salida = $fila_tt['EXONERADO_SALIDA'];
		$axtotal_salida = $fila_tt['TOTAL_SALIDA'];

		$SQLActualizar = "UPDATE MAESTRO_CZ SET VALOR_VENTA='$axvalor_salida',IGV='$axigv_salida',GRAVADAS='$axgravadas_salida',INAFECTAS='$axinafecto_isalida',EXONERADAS='$axexonerado_salida',MNT_TOT_GRAVADAS='$axgravadas_salida',MNT_TOT_INAFECTAS='$axinafecto_isalida',MNT_TOT_EXONERADAS='$axexonerado_salida',MNT_TOT_GRATUITAS='0',MNT_TOT='$axtotal_salida',TOTAL_VENTA='$axtotal_salida' WHERE COD_MOV='$axcod_mov' AND ID_LOCAL='$axid_local'";
		$RSActualizar = odbc_exec($con,$SQLActualizar);

		$respuesta=0;
		echo $respuesta;

	}else{

		$respuesta=1;
		echo $respuesta;

	}

break;

case '168':
	
$axnum_despacho = $_POST['txtnum_despacho']; 	
$axbuscar_detalle_depachos = $_POST['txtbuscar_detalle_despachos']; 	
$axfecha_liquidacion = $_POST['txtfecha_liquidacion']; 	

	if($axbuscar_detalle_depachos==""){
		
		$SQLBuscar = "SELECT TOP 20 * FROM PEDIDOS_CZ WHERE NUM_DESPACHO='$axnum_despacho' AND ESTADO_ATENDIDO <> 'PENDIENTE' order by NUM_DESPACHO ASC";	
		
				
	}else{
	
		$SQLBuscar ="SELECT * FROM PEDIDOS_CZ WHERE ESTADO_ATENDIDO <> 'PENDIENTE' AND NUM_PEDIDO like '%".$axbuscar_detalle_depachos."%' ORDER BY NUM_DESPACHO ASC";
		
	
	}

	//echo "$SQLBuscar";

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th class='ocultar' style='text-align: center;'>Item</th>
			<th style='text-align: left;'>Detalle</th>			
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$axnum_pedido = $fila['NUM_PEDIDO'];
		$axid_beneficiario= $fila['ID_BENEFICIARIO'];
		$axestado_atendido= $fila['ESTADO_ATENDIDO'];
		$axestado_forma_pago= $fila['ESTADO_FORMA_PAGO'];
		$axuser= $fila['VENDEDOR'];

		$axcomprobante_1 = get_row('MAESTRO_CZ','TXT_SERIE','NUM_PEDIDO',$axnum_pedido).'-'.get_row('MAESTRO_CZ','DOCUMENTO','NUM_PEDIDO',$axnum_pedido);

		if($axcomprobante_1==''){
			$axcomprobante ='FALTA COMPROB.';
		}else{
			$axcomprobante =$axcomprobante_1;
		}


		if($fila['ESTADO_ATENDIDO']=='PROGRAMADO'){
			$axmostrar_1 = '<b class="text-primary"># PEDIDO : '.$fila['NUM_PEDIDO'].' - '.$fila['ESTADO_ATENDIDO'].' | '.$axcomprobante.' | '.$axuser.'</b>';
		}elseif($fila['ESTADO_ATENDIDO']=='ATENDIDO'){
			$axmostrar_1 = '<b class="text-success"># PEDIDO : '.$fila['NUM_PEDIDO'].' - '.$fila['ESTADO_ATENDIDO'].' | '.$axcomprobante.' | '.$axuser.'</b>';
		}

		if($fila['ESTADO_FORMA_PAGO']=='PENDIENTE'){
			$axmostrar_2 = '<b class="text-danger">'.$fila['NOM_COMERCIAL'].' - '.$fila['ESTADO_FORMA_PAGO'].' - S/ '.number_format($fila['TOTAL_PEDIDO'],2,".",",").'</b>';

		}elseif($fila['ESTADO_FORMA_PAGO']=='CANCELADO'){
			$axmostrar_2 = '<b class="text-success">'.$fila['NOM_COMERCIAL'].' - '.$fila['ESTADO_FORMA_PAGO'].' - S/ '.number_format($fila['TOTAL_PEDIDO'],2,".",",").'</b>';
		}

		$axmostrar = $axmostrar_1.'<br>'.$axmostrar_2;
		
		$axmonto_pedido = get_row('PEDIDOS_CZ','TOTAL_PEDIDO','NUM_PEDIDO',$axnum_pedido);
		$axpagado = get_row('PEDIDOS_PAGADOS_TOTAL','MONTO_PAGADO','NUM_PEDIDO',$axnum_pedido);
		$axsaldo =$axmonto_pedido-$axpagado;

		$axverif_estado =  get_row('CTA_COBRAR_PAGOS','NUM_PEDIDO','NUM_PEDIDO',$axnum_pedido);
		$axverif_adelantado =  get_row('CTA_COBRAR_PAGOS','ESTADO_PAGO_PEDIDO','NUM_PEDIDO',$axnum_pedido);

		if($axverif_estado==''){

			$btn_atender = "<br><a href='#' class='btn btn-primary btn-sm' style='text-decoration:none;' id='btn_agregar_estado_atendido' data-saldo='$axpagado' data-estadopago='PENDIENTE' data-atencion='ATENDIDO' data-idcliente='$axid_beneficiario' data-numpedido='$axnum_pedido' style='font-size:10px;'><b><i class='bi bi-check2-circle'></i> Despachado</b></a>";
			

		}else{

			$axestado_atendido =$fila['ESTADO_ATENDIDO'];

			if($axverif_adelantado=='ADELANTO' ){

				if($axestado_atendido=='PROGRAMADO'){

					$btn_atender = "<br><a href='#' class='btn btn-primary btn-sm' style='text-decoration:none;' id='btn_agregar_estado_atendido' data-saldo='$axpagado' data-estadopago='PENDIENTE' data-atencion='ATENDIDO' data-idcliente='$axid_beneficiario' data-numpedido='$axnum_pedido' style='font-size:10px;'><b><i class='bi bi-check2-circle'></i> Despachado</b></a>";
						
				}elseif($axestado_atendido=='ATENDIDO'){

					$btn_atender = "";
					
				}

				

			}else{
				$btn_atender = "";
			}

			
		}

		echo "
 		<tr> 		
 			<td class='ocultar' style='text-align: center;'>".$it."</td>  			
 			<td style='text-align: left;'>
 				<a href='#' style='text-decoration:none;' id='btn_agregar_pago' data-saldo='$axsaldo' data-estadopago='$axestado_forma_pago' data-atencion='$axestado_atendido' data-idcliente='$axid_beneficiario' data-numpedido='$axnum_pedido'>".$axmostrar."</a> $btn_atender
 				</td>";
}
echo "</table>";
}

break;

case '169':

$axid_local =$_POST['txtid_local'];

$axcant_salida_1 =$_POST['txtcant_ingreso'];
$axprecio_venta =$_POST['txtprecio_venta'];
$axcod_mov_dt =$_POST['txtcod_mov_dt'];
$axcod_mov =get_row('MAESTRO_DT','COD_MOV','COD_MOV_DT',$axcod_mov_dt);
$axid_producto =$_POST['txtid_producto'];
$axporc_igv = get_row('LOCALES','PORC_IGV','ID_LOCAL',$axid_local);
$axigv1 = 1+$axporc_igv;

$axafectacion = get_row('PRODUCTOS_LISTADO','ABREV_AFECTACION','ID_PRODUCTO',$axid_producto);
$axcant_salida =$axcant_salida_1/-1;

if($axafectacion=='GRAVADA'){

	$axvalor_salida = $axcant_salida*$axprecio_venta/$axigv1;
	$axigv_salida =$axvalor_salida* $axporc_igv;
	$axgravadas_salida = $axvalor_salida;
	$axinafecto_salida = 0;
	$axexonerado_salida = 0;
	$axtotal_salida = $axvalor_salida+$axigv_salida;

}elseif($axafectacion=='EXONERADA'){

	$axvalor_salida = $axcant_salida*$axprecio_venta/$axigv1;
	$axigv_isalida=0;
	$axgravadas_salida = 0;
	$axinafecto_salida = $axvalor_salida;
	$axexonerado_salida = 0;
	$axtotal_salida = $axvalor_salida+$axigv_salida;

}elseif($axafectacion=='INAFECTO'){

	$axvalor_salida = $axcant_salida*$axprecio_venta/$axigv1;
	$axigv_salida =0;
	$axgravadas_salida = 0;
	$axinafecto_salida = 0;
	$axexonerado_salida = $axvalor_salida;;
	$axtotal_salida = $axvalor_salida+$axigv_salida;

}



	$sqlinserta = "UPDATE MAESTRO_DT SET PRS_VENTA='$axprecio_venta',DSCTOS_SALIDA='0',VALOR_SALIDA='$axvalor_salida',IGV_SALIDA='$axigv_salida',GRAVADAS_SALIDA='$axgravadas_salida',INAFECTO_SALIDA='$axinafecto_salida',EXONERADO_SALIDA='$axexonerado_salida',TOTAL_SALIDA='$axtotal_salida' WHERE COD_MOV_DT='$axcod_mov_dt'";
	$rsinserta = odbc_exec($con,$sqlinserta);
	//echo $sqlinserta;


	if($rsinserta){

		$SQLTotal = "SELECT TOP 1 * FROM MAESTRO_INGRESOS_TT WHERE COD_MOV='$axcod_mov' AND ID_LOCAL='$axid_local'";
		$RSTotal = odbc_exec($con,$SQLTotal);
		$fila_tt = odbc_fetch_array($RSTotal);

		//echo $SQLTotal;

		$axvalor_salida = $fila_tt['VALOR_SALIDA'];
		$axigv_salida = $fila_tt['IGV_SALIDA'];
		$axgravadas_salida = $fila_tt['GRAVADAS_SALIDA'];
		$axinafecto_isalida = $fila_tt['INAFECTO_SALIDA'];
		$axexonerado_salida = $fila_tt['EXONERADO_SALIDA'];
		$axtotal_salida = $fila_tt['TOTAL_SALIDA'];

		$SQLActualizar = "UPDATE MAESTRO_CZ SET VALOR_VENTA='$axvalor_salida',IGV='$axigv_salida',GRAVADAS='$axgravadas_salida',INAFECTAS='$axinafecto_isalida',EXONERADAS='$axexonerado_salida',MNT_TOT_GRAVADAS='$axgravadas_salida',MNT_TOT_INAFECTAS='$axinafecto_isalida',MNT_TOT_EXONERADAS='$axexonerado_salida',MNT_TOT_GRATUITAS='0',MNT_TOT='$axtotal_salida',TOTAL_VENTA='$axtotal_salida' WHERE COD_MOV='$axcod_mov' AND ID_LOCAL='$axid_local'";
		$RSActualizar = odbc_exec($con,$SQLActualizar);

		$respuesta=0;
		echo $respuesta;

	}else{

		$respuesta=1;
		echo $respuesta;

	}

break;

case '170':
	
$axnum_despacho =$_POST['txtnum_despacho'];

$SQLBuscar ="SELECT * FROM CTA_COBRAR_PAGOS_REPORTE WHERE NUM_DESPACHO = '$axnum_despacho' ORDER BY MONTO_PAGADO,NUM_PEDIDO DESC"; 
//echo $SQLBuscar;

echo "
		
		<table class='table table-hover table-sm' id=tbl_pagos>
		<thead class='table-success'>			
		<tr>
			<th style='text-align: center;'>Item</th>
			<th class='table-danger' style='text-align: left;'>Fecha Liquidar</th>
			<th style='text-align: left;'>Num. Pedido</th>
			<th style='text-align: left;'>Cliente</th>
			<th style='text-align: center;'>Fecha Pago</th>						
			<th style='text-align: center;'>Num. Operacion</th>						
			<th style='text-align: center;'>Medio Pago</th>									
			<th class='table-success' style='text-align: right;'>Pagado</th>						
			<th style='text-align: center;'>Acción</th>			
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);		
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		
 		$it= $it+1;
 		$axid_pago=$fila['ID_PAGO'];
 		$axfecha = date('d-m-Y', strtotime($fila['FECHA_PAGO']));		
 		$axfecha_liquidacion 		= date('d-m-Y', strtotime($fila['FECHA_LIQUIDACION']));		
 		$axnum_pedido = $fila['NUM_PEDIDO'];
 		$axid_beneficiario = $fila['ID_BENEFICIARIO'];				
 		$axcliente = substr($fila['NOM_COMERCIAL'],0,30).'...';		
		$axpagado = number_format($fila["MONTO_PAGADO"],2,".",","); 		
		$axnum_transf = $fila['NUM_TRANSF'];		
		$axid_cta = $fila['ID_CTA'];	
		$axbanco = $fila['BANCO_CUENTA'];		
		$axmedio = $fila['MEDIO_PAGO'];		

		if($fila["MONTO_PAGADO"]==0){
		$axbanco = '';	
		$axmedio = '';
		$axnum_transf = '-';		
		}	
		

 	echo "
 		<tr> 		
 			<td style='text-align: center;'>".$it."</td> 
 			<td class='table-danger' style='text-align: left;'>".$axfecha_liquidacion."</td> 
 			<td style='text-align: left;'>".$axnum_pedido."</td> 
 			<td style='text-align: left;'>".$axcliente."</td> 
 			<td style='text-align: center;'>".$axfecha."</td> 
 			<td style='text-align: center;'>".$axnum_transf."</td>  						
 			<td style='text-align: center;'>".$axmedio.'-'.$axbanco."</td>  			 			
 			<td style='text-align: right;'>".$axpagado."</td>
 			<td class='text-success' style='text-align: center;'>

 				<div class='btn-group dropstart'>
					<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
					<ul class='dropdown-menu'>	
					<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-info' id='btn_editar_pago' data-id='$axid_pago' ><b><i class='bi bi-pencil' ></i> Editar</a></b>
					<a href='#' class='dropdown-item text-danger' id='btn_eliminar_pago' data-npedido='$axnum_pedido' data-id='$axid_pago' ><b><i class='bi bi-trash3-fill'></i> Eliminar</a></b>
					<div><hr class='dropdown-divider'></div>
					</ul>
				</div>

 		

 			</td>";
 		echo "</tr>";
 	
 	}

 	$SQLBuscar_tt ="SELECT sum(MONTO_PAGADO) as tt FROM CTA_COBRAR_PAGOS_REPORTE WHERE NUM_DESPACHO = '$axnum_despacho'"; 
 	$rsBuscar_tt = odbc_exec($con,$SQLBuscar_tt);
 	$fila = odbc_fetch_array($rsBuscar_tt);

 	$axtotal = $fila['tt'];

 	echo "<tr> 		
 			<th style='text-align: right;' colspan='8'>".number_format($axtotal,2,".",",")."</th> 
 			</tr>";

	echo "</table>";
	}else{
		echo "";
	}


break;

case '171':

$axid_pago =$_POST['txtid_pago'];
$axid_beneficiario =$_POST['txtid_beneficiario'];
$axnum_pedido =$_POST['txtnum_pedido'];
$axnum_despacho =$_POST['txtnum_despacho'];

$axsaldo_pendiente =$_POST['txtsaldo_pendiente'];
$axfecha_pago =$_POST['txtfecha_pago'];
$axperiodo_transf = date('m-Y',strtotime($axfecha_pago));
$axmedio_pago =$_POST['txtmedio_pago'];
$axnum_transf =$_POST['txtnum_transf'];
$axid_cta =$_POST['txtid_cta'];
$axmonto_pagado =$_POST['txtmonto_pagado'];
$axestado_forma_pago =$_POST['txtestado_forma_pago'];

$axfecha_liquidacion = $_POST['txtfecha_liquidacion'];
$axuser_encargado = $_POST['txtuser_encargado'];
$axestado_liquidacion = $_POST['txtestado_liquidacion'];
$axrecibido_por = $_POST['txtrecibido_por'];

 if($axmonto_pagado==0){
 	$axmedio_pago ='';
	$axnum_transf ='';
	//$axid_cta ='0';
 }


$axparametros =$_POST['txtparametros'];



if($axparametros==0){

	$SQLGrabar = "INSERT INTO CTA_COBRAR_PAGOS (ID_BENEFICIARIO,FECHA_PAGO,MONTO_PAGADO,NUM_PEDIDO,NUM_DESPACHO,SALDO_PENDIENTE,NUM_TRANSF,ID_CTA,ESTADO_FORMA_PAGO,MEDIO_PAGO,PERIODO_TRANSF,FECHA_LIQUIDACION,RESPONSABLE_LIQUIDAR,ESTADO_LIQUIDACION,RECIBIDO_POR) VALUES ('$axid_beneficiario','$axfecha_pago','$axmonto_pagado','$axnum_pedido','$axnum_despacho','$axsaldo_pendiente','$axnum_transf','$axid_cta','$axestado_forma_pago','$axmedio_pago','$axperiodo_transf','$axfecha_liquidacion','$axuser_encargado','$axestado_liquidacion','$axrecibido_por')";
	

}else{

	 $SQLGrabar = "UPDATE CTA_COBRAR_PAGOS SET ID_BENEFICIARIO='$axid_beneficiario',FECHA_PAGO='$axfecha_pago',MONTO_PAGADO='$axmonto_pagado',NUM_PEDIDO='$axnum_pedido',NUM_DESPACHO='$axnum_despacho',SALDO_PENDIENTE='$axsaldo_pendiente',NUM_TRANSF='$axnum_transf',ID_CTA='$axid_cta',ESTADO_FORMA_PAGO='$axestado_forma_pago',MEDIO_PAGO='$axmedio_pago',PERIODO_TRANSF='$axperiodo_transf',FECHA_LIQUIDACION='$axfecha_liquidacion',RESPONSABLE_LIQUIDAR='$axuser_encargado',ESTADO_LIQUIDACION='$axestado_liquidacion',RECIBIDO_POR='$axrecibido_por' WHERE ID_PAGO='$axid_pago'";

}
//echo $SQLGrabar;

$rsgrabar = odbc_exec($con,$SQLGrabar);

if($rsgrabar){
	$axmonto_pedido = get_row('PEDIDOS_CZ','TOTAL_PEDIDO','NUM_PEDIDO',$axnum_pedido);
	$axpagado = get_row('PEDIDOS_PAGADOS_TOTAL','MONTO_PAGADO','NUM_PEDIDO',$axnum_pedido);

	//echo $axmonto_pedido.'|'.$axpagado;
	
	if(intval($axmonto_pedido) == intval($axpagado)){
		$SQLActualizar_pedidos = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='ATENDIDO',ESTADO_FORMA_PAGO='CANCELADO' WHERE NUM_PEDIDO='$axnum_pedido'";
		$SQLActualizar_cxc = "UPDATE CTA_COBRAR_PAGOS SET ESTADO_FORMA_PAGO='CANCELADO' WHERE NUM_PEDIDO='$axnum_pedido'";
	
	}elseif(intval($axpagado) < intval($axmonto_pedido)){
			$SQLActualizar_pedidos = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='ATENDIDO',ESTADO_FORMA_PAGO='PENDIENTE' WHERE NUM_PEDIDO='$axnum_pedido'";
			$SQLActualizar_cxc = "UPDATE CTA_COBRAR_PAGOS SET ESTADO_FORMA_PAGO='PENDIENTE' WHERE NUM_PEDIDO='$axnum_pedido'";

	}elseif(intval($axpagado) == 0){
		$SQLActualizar_pedidos = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='PROGRAMADO',ESTADO_FORMA_PAGO='PENDIENTE' WHERE NUM_PEDIDO='$axnum_pedido'";
	}

	$RSActualizar = odbc_exec($con,$SQLActualizar_pedidos);
	$RSActualizar_cxc = odbc_exec($con,$SQLActualizar_cxc);

	//echo $SQLActualizar_pedidos;

	$respuesta =0;
	echo $respuesta;

}else{

	$respuesta =1;
	echo $respuesta;

}
	
break;

case '172':
	
	$axid_pago= $_POST['txtid_pago'];
	
	$sql6 = "SELECT * FROM CTA_COBRAR_PAGOS WHERE ID_PAGO = '$axid_pago'";
	
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
case '173':
	
	$axid_pago= $_POST['txtid_pago'];
	$axnum_pedido = $_POST['txtnum_pedido'];

	$SQLGrabar = "DELETE FROM CTA_COBRAR_PAGOS WHERE ID_PAGO = '$axid_pago'";
	$rsgrabar = odbc_exec($con,$SQLGrabar);

	if($rsgrabar){

	$axmonto_pedido = get_row('PEDIDOS_CZ','TOTAL_PEDIDO','NUM_PEDIDO',$axnum_pedido);
	if($axmonto_pedido==''){
		$axmonto_pedido=0;
	}

	$axpagado = get_row('PEDIDOS_PAGADOS_TOTAL','MONTO_PAGADO','NUM_PEDIDO',$axnum_pedido);
	//echo $axmonto_pedido.'|'.$axpagado;
	
	
	if(intval($axpagado) < intval($axmonto_pedido)){
			$SQLActualizar_pedidos = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='PROGRAMADO',ESTADO_FORMA_PAGO='PENDIENTE' WHERE NUM_PEDIDO='$axnum_pedido'";	
	}
	
	//echo $SQLActualizar_pedidos.' | '.$axnum_pedido;
	$RSActualizar = odbc_exec($con,$SQLActualizar_pedidos);

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;

	}

break;

case '174':
	
	
 $axbuscar_dato =$_POST['txtrecibido_por'];
   
 if(isset($_POST["txtrecibido_por"])){

	$output ="";
	$idprov ="";
	$sqlemisor = "SELECT RECIBIDO_POR FROM CTA_COBRAR_PAGOS WHERE RECIBIDO_POR LIKE  '%".$axbuscar_dato."%' GROUP BY RECIBIDO_POR ORDER BY RECIBIDO_POR";
	//echo $sqlemisor;

	$rsemisor=odbc_exec($con,$sqlemisor);	
	$output ='<ul class="list-group">';  		

	if(odbc_num_rows($rsemisor) > 0){
		 while ($row=odbc_fetch_array($rsemisor)){				 	
		 	$nom_prod =  trim($row["RECIBIDO_POR"]);
		 	$output .='<a href="#" id="btn_listar_1" class="list-group-item list-group-item-action" style="background:#DAF5FF;">'.utf8_encode(trim($row["RECIBIDO_POR"])).'</a>';
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
case '175':

$axid_producto =$_POST['txtid_producto'];
$axfecha_del =$_POST['txtfecha_del'];
$axfecha_al =$_POST['txtfecha_al'];


$SQLBuscar ="SELECT * FROM VERIFICACION_PONDERADO WHERE FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' AND ID_PRODUCTO='$axid_producto' AND COSTO_PRODUCTO > 0 ORDER BY FECHA_EMISION ASC"; 
//echo $SQLBuscar;

echo "
			
		<table class='table table-hover table-sm'>
		<thead class='table-success'>			
		<tr>
			<th style='text-align: center;'>Item</th>
			<th style='text-align: center;'>Fecha</th>
			<th style='text-align: center;'>Num Comprobante</th>			
			<th class='table-success' style='text-align: right;'>Cantidad</th>			
			<th class='table-success' style='text-align: right;'>Costo sin igv</th>			
			<th class='table-primary' style='text-align: right;'>Total con igv</th>						
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		
 		$it= $it+1; 		
 		$axid_producto = $fila['ID_PRODUCTO'];
		$axfecha = date('d-m-Y', strtotime($fila['FECHA_EMISION']));		
		$axcomprobante = $fila['COMPROBANTE'];
		
		$axingreso = number_format($fila["CANT_INGRESO"],2,".",","); 
		$axcosto = number_format($fila["COSTO_PRODUCTO"],4,".",","); 		
		
		$axtotal = number_format($fila["TOTAL_INGRESO"],2,".",","); 		

		$axtotal = number_format($fila["TOTAL_INGRESO"],2,".",","); 		

 	echo "
 		<tr> 		
 			<td style='text-align: center;'>".$it."</td> 
 			<td style='text-align: center;'>".$axfecha."</td> 
 			<td style='text-align: center;'>".$axcomprobante."</td>  			
 			<td class='text-success' style='text-align: right;'><b>".$axingreso."</b></td>  			
 			<td class='text-danger' style='text-align: right;'><b>".$axcosto."</b></td>  			
 			<td class='text-primary' style='text-align: right;'><b>".$axtotal."</b></td>  			 			
 			
 		</tr>";
 	
 	}

 	//CASE WHEN dbo.MAESTRO_CZ.DETALLE_MOVIMIENTO = 'VENTA' THEN dbo.MAESTRO_DT.PRS_VENTA ELSE '0' END

 	$SQLBuscar_tt ="SELECT SUM(CANT_INGRESO) as ING, SUM(TOTAL_INGRESO) AS TT,SUM(TOTAL_INGRESO)/SUM(CANT_INGRESO) AS PP FROM VERIFICACION_PONDERADO WHERE FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' AND ID_PRODUCTO='$axid_producto' AND COSTO_PRODUCTO > 0"; 
 	$RSBuscar_tt = odbc_exec($con,$SQLBuscar_tt);
 	$fila_tt = odbc_fetch_array($RSBuscar_tt);

 	$axingresos_tt=number_format($fila_tt["ING"],2,".",",");
 	$axtotal_ingreso=number_format($fila_tt["TT"],2,".",",");
 	$axcosto_p=number_format($fila_tt["PP"],4,".",",");
 	
 	echo "<tr>
 	<th style='text-align: right;' colspan='3'><b></b></th> 	 			
 	<th class='text-success' style='text-align: right;' ><b>$axingresos_tt</b></th> 	 			
 	<th class='text-danger' style='text-align: right;' ></th> 	 			 	
 	<th class='text-danger' style='text-align: right;' ><b>$axtotal_ingreso</b></th> 	 			 	
 	</tr>	
 	<tr>
	<th class='text-danger' style='text-align: right;' colspan='4' ><b>Costor Promedio Ponderado </b></th> 	 			 	
	<th class='text-danger' style='text-align: right;' ><b>$axcosto_p</b></th> 	 			 	
 	</tr>
 	";


	echo "</table>";
	}
	
break;

case '176':
	
$axperiodo_inventario =$_POST['txtperiodo_inventario'];
$axestado_periodo =$_POST['txtestado_periodo'];
$axfecha_del =$_POST['txtfecha_del'];
$axfecha_al =$_POST['txtfecha_al'];

$axtitulo = 'Fecha del: '. date('d-m-Y',strtotime($axfecha_del)).' al '.date('d-m-Y',strtotime($axfecha_al));
$axbuscar = get_row('PRODUCTOS_INVENTARIOS','TITULO','TITULO',$axtitulo);

//echo $axtitulo.'<br>';
//echo $axbuscar.'<br>';

if($axbuscar !== ''){

	$SQLActualizar = "UPDATE PRODUCTOS_INVENTARIOS SET PERIODO_INVENTARIO='$axperiodo_inventario',ESTADO_PERIODO='$axestado_periodo' WHERE TITULO='$axtitulo'";
	$RSActualizar = odbc_exec($con,$SQLActualizar);
	//echo $SQLActualizar;

	if($RSActualizar){

		$SQLActualizar_v = "UPDATE VERIFICACION_PONDERADO SET ESTADO_PERIODO='$axestado_periodo' WHERE PERIODO_INVENTARIO='$axperiodo_inventario'";
		$RSActualizar_v = odbc_exec($con,$SQLActualizar_v);

		$SQLActualizar_D = "UPDATE VERIFICACION_DETALLE SET ESTADO_PERIODO='$axestado_periodo' WHERE PERIODO_INVENTARIO='$axperiodo_inventario'";
		$RSActualizar_D = odbc_exec($con,$SQLActualizar_D);


		$respuesta =0;
		echo $respuesta;		
	}else{
		$respuesta =2;
		echo $respuesta;
	}

}else{

	$respuesta =1;
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
	
$axperiodo_inventario = $_POST['txtperiodo_inventario']; 		
$axfecha_del = $_POST['txtfecha_del']; 		
$axfecha_al = $_POST['txtfecha_al']; 		

//Stock, genera el Stock según el rango de fechas seleccionado...

$axtitulo_enviado = 'Fecha del: '. date('d-m-Y',strtotime($axfecha_del)).' al '.date('d-m-Y',strtotime($axfecha_al));

$axverifica = "SELECT TITULO,ESTADO_PERIODO FROM VERIFICACION_DETALLE WHERE PERIODO_INVENTARIO='$axperiodo_inventario' GROUP by TITULO,ESTADO_PERIODO";
$RSVerifica = odbc_exec($con,$axverifica);
//echo $axverifica;

if(odbc_num_rows($RSVerifica) > 0) {

	while($fila = odbc_fetch_array($RSVerifica)){

		$axtitulo_existente = $fila['TITULO'];
		$axestado_periodo =$fila['ESTADO_PERIODO'];

		if($axtitulo_existente==$axtitulo_enviado){

			if($axestado_periodo=='CERRADA'){

				$respuesta=2;  //existe y concuerdan el estado y las fechas y esta cerrado
				echo $respuesta;

			}else{

				$respuesta=1;  //existe y concuerdan las fechas pero esta abierto
				echo $respuesta;

			}

		}else{

			$respuesta=3;  //el rango de fechas no cononcuerta con el existente
			echo $respuesta;

		}

	}

	
}else{

		$respuesta=4;  //no existe el periodo
		echo $respuesta;
	
}

break;


case '179':
	

$axid_local =$_POST['txtid_local'];
$axfecha_del =$_POST['txtfecha_del'];
$axfecha_al =$_POST['txtfecha_al'];


$SQLBuscar ="SELECT * FROM REPORTE_IMPUESTOS WHERE ID_LOCAL='$axid_local' AND FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' ORDER BY TXT_SERIE,DOCUMENTO ASC"; 
echo $SQLBuscar;

echo "
		<div style='margin-top:5px; padding:5px; text-align: right;'>
		<a href='exportar_excel.php?param=4&local=$axid_local&del=$axfecha_del&al=$axfecha_al' class='btn btn-outline-danger btn-sm' ><b> <i class='bi bi-file-earmark-excel-fill'></i> Excel</b></a>
		</div>
		
		
		<table class='table table-hover table-sm'>
		<thead class='table-success'>			
		<tr>
			<th style='text-align: center;'>Item</th>
			<th style='text-align: center;'>Fecha Emisión</th>
			<th style='text-align: center;'>Serie</th>
			<th style='text-align: center;'>Correlativo</th>			
			<th style='text-align: center;'>Num. Pedido</th>			
			<th style='text-align: center;'>Ruc </th>			
			<th style='text-align: left;'>Cliente</th>						
			<th class='table-success' style='text-align: right;'>Valor Venta</th>			
			<th class='table-success' style='text-align: right;'>Igv</th>						
			<th class='table-primary' style='text-align: right;'>Total Venta</th>			
			<th style='text-align: center;'>Estado</th>			
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);		
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		
 		$it= $it+1;
 		$axfecha = date('d-m-Y', strtotime($fila['FECHA_EMISION']));		 		
 		$axserie = $fila['TXT_SERIE'];
 		$axdocumento = $fila['DOCUMENTO'];				
 		$axnum_pedido = $fila['NUM_PEDIDO'];				
 		$axruc = $fila['RUC_BENEF'];				
		$axcliente = $fila['CLIENTE'];		
		$axvalor_venta = number_format($fila["VALOR_VENTA"],2,".",","); 
		$axigv = number_format($fila["IGV"],2,".",","); 		
		$axtotalventa = number_format($fila["TOTAL_VENTA"],2,".",","); 
		$axestado_electro = $fila['ESTADO_ELECTRO'];		
		

 	echo "
 		<tr> 		
 			<td style='text-align: center;'>".$it."</td> 
 			<td style='text-align: center;'>".$axfecha."</td> 
 			<td style='text-align: center;'>".$axserie."</td> 
 			<td style='text-align: center;'>".$axdocumento."</td> 
 			<td style='text-align: center;'>".$axnum_pedido."</td> 
 			<td style='text-align: center;'>".$axruc."</td>  			
 			<td style='text-align: left;'>".$axcliente."</td> 
 			<td style='text-align: right;'>".$axvalor_venta."</td>  			
 			<td style='text-align: right;'>".$axigv."</td>  			
 			<td style='text-align: right;'>".$axtotalventa."</td>";

 			if($axestado_electro=='ANULADA'){

 				echo "<td class='text-danger' style='text-align: center;'><b>".$axestado_electro."</b></td>";

 			}elseif($axestado_electro=='RECHAZADA'){

 				echo "<td class='text-primary' style='text-align: center;'><b>".$axestado_electro."</b></td>";

 			}else{

 				echo "<td class='text-success' style='text-align: center;'><b>".$axestado_electro."</b></td>";
 			}

 			
 			
 			
 		echo "</tr>";
 	
 	}



	echo "</table>";
	}


break;

case '180':

set_time_limit(3000);
	
	$axbuscaregistro = $_POST['txtbuscar_prod_inventario']; 	
	$axid_local = $_POST['txtid_local']; 	
	$axfecha_del = $_POST['txtfecha_del']; 	
	$axfecha_al = $_POST['txtfecha_al']; 	
	$axperiodo_actual = $_POST['txtperiodo_inventario'];
	$axtitulo = 'Fecha del: '. date('d-m-Y',strtotime($axfecha_del)).' al '.date('d-m-Y',strtotime($axfecha_al)); 	

	$axperiodo_actual = $_POST['txtperiodo_inventario'];	
	$fecha = DateTime::createFromFormat('m-Y', $axperiodo_actual);	
	$fecha->modify('-1 month');
	$axmes_antes = $fecha->format('m-Y');
	//echo $axmes_antes;
	//$axmes_antes = intval(substr($axperiodo_actual,0,2))-1;
	
	$axperiodo_anterior=$axmes_antes;
	//$axperiodo_anterior = number_pad($axmes_antes,2,0).'-'.substr($axperiodo_actual,3,4); //03-2023
	

	$SQLEliminar_P = "DELETE FROM PRODUCTOS_INVENTARIOS WHERE ESTADO_PERIODO='ABIERTA' AND PERIODO_INVENTARIO='$axperiodo_actual'";
	$RSEliminar_P = odbc_exec($con,$SQLEliminar_P);

	$SQLEliminar_v = "DELETE FROM VERIFICACION_PONDERADO WHERE ESTADO_PERIODO='ABIERTA' AND PERIODO_INVENTARIO='$axperiodo_actual'";
	$RSEliminar_v = odbc_exec($con,$SQLEliminar_v);

	$SQLEliminar_d = "DELETE FROM VERIFICACION_DETALLE WHERE ESTADO_PERIODO='ABIERTA' AND PERIODO_INVENTARIO='$axperiodo_actual'";
	$RSEliminar_d = odbc_exec($con,$SQLEliminar_d);

/*
/******************TRAER A LA TABLA VERIFICACION DETALLE, TODOS LOS MOVIMIENTOS DE COMPRA *************************/


	//$SQLBuscar_productos_D ="SELECT ID_PRODUCTO,COD_PRODUCTO FROM INVENTARIO_SEGUN_FECHAS WHERE FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY ID_PRODUCTO,COD_PRODUCTO";
	$SQLBuscar_productos_D ="SELECT ID_PRODUCTO,COD_PRODUCTO FROM PRODUCTOS ORDER BY COD_PRODUCTO ASC";
	$RSBuscar_productos_D = odbc_exec($con,$SQLBuscar_productos_D);

	if(odbc_num_rows($RSBuscar_productos_D) > 0){

		while ($fila_d = odbc_fetch_array($RSBuscar_productos_D)) {
			
			$axcod_producto_d = $fila_d['COD_PRODUCTO'];
			$axid_producto_d = $fila_d['ID_PRODUCTO'];


			$sqlsaldo_anterior = "SELECT * FROM VERIFICACIONES WHERE FECHA_LLEGADA BETWEEN '$axfecha_del' AND '$axfecha_al' AND ID_PRODUCTO='$axid_producto_d'  AND TIPO_MOV='EGRESO' ORDER BY FECHA_EMISION ASC";
			$rssaldo_antes = odbc_exec($con,$sqlsaldo_anterior);
			//echo $sqlsaldo_anterior.'<br>';
			
				if(odbc_num_rows($rssaldo_antes) > 0){

					$it=0;

					while ($fila_dt = odbc_fetch_array($rssaldo_antes)) {

						$it=$it+1;
						$axtipo_ND = $fila_dt['TIPO_NDEBITO'];						
						$detalle_movimiento = $fila_dt['DETALLE_MOVIMIENTO'];
						$tipo_mov = $fila_dt['TIPO_MOV'];
						$fecha_emision = $fila_dt['FECHA_EMISION'];						
						$axfecha_llegada_mercaderia = $fila_dt['FECHA_LLEGADA'];						
						$id_local = $fila_dt['ID_LOCAL'];
						$num_pedido = $comprobante;
						$nom_comercial = $fila_dt['NOM_COMERCIAL'];
						$id_producto = $fila_dt['ID_PRODUCTO'];
						$cod_producto = $fila_dt['COD_PRODUCTO'];
						$ingreso = $fila_dt['INGRESO'];

						if($axtipo_ND=='02'){
							$ingreso = 0;	
						}

						$prs_compra = $fila_dt['PRS_COMPRA'];
						$salida = $fila_dt['SALIDA'];
						$prs_venta = $fila_dt['PRS_VENTA'];

						$axtipo_nc = $fila_dt['cod_tip_nc_nd_ref'];
						$axtipo_doc = $fila_dt['ID_TD'];						


						if($prs_venta==''){
						$prs_venta = 0;							
						}

						$stock = $fila_dt['STOCK'];
						$estado_inventario = $fila_dt['ESTADO_INVENTARIO'];
						$cod_mov = $fila_dt['COD_MOV'];
						$comprobante = $fila_dt['COMPROBANTE'];
						$valor_ingreso = $fila_dt['VALOR_INGRESO'];
						$total_ingreso = $fila_dt['TOTAL_INGRESO'];
						$periodo_inventario = $fila_dt['PERIODO_INVENTARIO'];
						$estado_periodo = 'ABIERTA';


						if($axtipo_doc =='6'){ //si es nota de credito
							
							if($axtipo_nc=='05'){ //DESCUENTO POR ITEM
								
								//$axcosto_producto=$_POST['txtcosto_producto']/-1;
								$prs_compra = $fila_dt['PRS_COMPRA'];
								$ingreso = 0;
								$total_ingreso = $fila_dt['TOTAL_INGRESO']/-1;

							}elseif($axtipo_nc=='07' || $axtipo_nc=='01'){ //ANULACION DE LA VENTA Y/O DEVOLUCION POR ITEM
								
								//$axcant_ingreso =$_POST['txtcant_ingreso']/-1;	
								$ingreso = $fila_dt['INGRESO'];
								$prs_compra = 0;
								$total_ingreso = 0;
							}
						}

						$sqlinserta_D = "INSERT INTO VERIFICACION_DETALLE  (DETALLE_MOVIMIENTO,TIPO_MOV,FECHA_EMISION,ID_LOCAL,NUM_PEDIDO,NOM_COMERCIAL,ID_PRODUCTO,COD_PRODUCTO,INGRESO,PRS_COMPRA,SALIDA,PRS_VENTA,STOCK,ESTADO_INVENTARIO,COD_MOV,COMPROBANTE,VALOR_INGRESO,TOTAL_INGRESO,PERIODO_INVENTARIO,ESTADO_PERIODO,NUM_ORDEN,TITULO,FECHA_LLEGADA) VALUES ('$detalle_movimiento','$tipo_mov','$fecha_emision','$id_local','$num_pedido','$nom_comercial','$id_producto','$cod_producto','$ingreso','$prs_compra','$salida','$prs_venta','$stock','$estado_inventario','$cod_mov','$comprobante','$valor_ingreso','$total_ingreso','$axperiodo_actual','$estado_periodo','$it','$axtitulo','$axfecha_llegada_mercaderia')";
						//echo $sqlinserta_D.'<br>';
						$RSInsert_D = odbc_exec($con,$sqlinserta_D);

					}

				}
			}
	}


	/******************TRAER A LA TABLA VERIFICACION DETALLE, TODOS LOS MOVIMIENTOS DE VENTAS DE TODOS LOS PEDIDOS*************************/

	/***AGRUPO TODOS PRODUCTOS UTILIZADOS EN LOS PEDIDOS SEGUN EL RANGO DE FECHA***/
	//$SQLBuscar_productos_D ="SELECT ID_PRODUCTO FROM PEDIDOS WHERE FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY ID_PRODUCTO";
	$SQLBuscar_productos_D ="SELECT ID_PRODUCTO FROM PRODUCTOS ORDER BY COD_PRODUCTO ASC";
	$RSBuscar_productos_D = odbc_exec($con,$SQLBuscar_productos_D);

	if(odbc_num_rows($RSBuscar_productos_D) > 0){

		while ($fila_d = odbc_fetch_array($RSBuscar_productos_D)) {			
			
			$axid_producto_d = $fila_d['ID_PRODUCTO'];

			$sqlsaldo_anterior = "SELECT FECHA_PEDIDO,NUM_PEDIDO,ID_PRODUCTO,ID_BENEFICIARIO,SUM(CANT_SALIDA) AS SALIDA,PRS_VENTA,SUm(VALOR_SALIDA) AS VS,SUM(TOTAL_SALIDA) AS TS FROM PEDIDOS WHERE ID_PRODUCTO='$axid_producto_d' AND FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY FECHA_PEDIDO,NUM_PEDIDO,ID_PRODUCTO,PRS_VENTA,ID_BENEFICIARIO ORDER BY FECHA_PEDIDO ASC";
			$rssaldo_antes = odbc_exec($con,$sqlsaldo_anterior);
			//echo $sqlsaldo_anterior.'<br>';
			
				if(odbc_num_rows($rssaldo_antes) > 0){
					$it=0;
					while ($fila_dt = odbc_fetch_array($rssaldo_antes)) {

						$it=$it+1;
						
						$detalle_movimiento = 'VENTA';
						$tipo_mov = 'INGRESO'; //INGRESO DE DINERO
						$fecha_emision = $fila_dt['FECHA_PEDIDO'];
						$id_local =get_row('PEDIDOS','ID_LOCAL','NUM_PEDIDO',$num_pedido); 						 
						$num_pedido = $fila_dt['NUM_PEDIDO'];						
						$axid_beneficiario= $fila_dt['ID_BENEFICIARIO'];						
						$cod_mov = get_row('MAESTRO_CZ','COD_MOV','NUM_PEDIDO',$num_pedido);
						$estado_inventario =get_row('MAESTRO_CZ','ESTADO_INVENTARIO','COD_MOV',$cod_mov); 						
						$axestado_atendido =get_row('PEDIDOS','ESTADO_ATENDIDO','NUM_PEDIDO',$num_pedido); 						

						$nom_comercial = get_row('BENEFICIARIOS','NOM_COMERCIAL','ID_BENEFICIARIO',$axid_beneficiario); 
						$id_producto = $axid_producto_d;
						$cod_producto = get_row('PRODUCTOS','COD_PRODUCTO','ID_PRODUCTO',$axid_producto_d);
			


						if($estado_inventario=='ANULADA' || $estado_inventario=='RECHAZADA'){

							$ingreso = 0;
							$prs_compra = 0;
							$salida = 0;
							$prs_venta = 0;						
							$stock = 0;
							$valor_salida = 0;
							$total_salida = 0;

						}else{

							$ingreso = 0;
							$prs_compra = 0;
							$salida = $fila_dt['SALIDA'];
							$prs_venta = $fila_dt['PRS_VENTA'];						
							$stock = 0;
							$valor_salida = $fila_dt['VS'];
							$total_salida = $fila_dt['TS'];

						}


						$axtipo_nc = get_row('MAESTRO_CZ','cod_tip_nc_nd_ref','COD_MOV',$cod_mov); 
						$axtipo_doc = get_row('MAESTRO_CZ','ID_TD','COD_MOV',$cod_mov);  

						if($axtipo_doc =='6'){ //si es nota de credito
							
							if($axtipo_nc=='05'){ //DESCUENTO POR ITEM
								
								//$axcosto_producto=$_POST['txtcosto_producto']/-1;
								$prs_compra = $fila_dt['PRS_COMPRA'];
								$salida = 0;
								$valor_salida = $fila_dt['VS']/-1;
								$total_salida = $fila_dt['TS']/-1;

							}elseif($axtipo_nc=='07' || $axtipo_nc=='01'){ //ANULACION DE LA VENTA Y/O DEVOLUCION POR ITEM
								
								//$axcant_ingreso =$_POST['txtcant_ingreso']/-1;	
								$salida = $fila_dt['SALIDA'];;
								$valor_salida = $fila_dt['VS']/-1;
								$total_salida = $fila_dt['TS']/-1;
							}
						}


						
						$comprobante = get_row('MAESTRO_CZ','TXT_SERIE','COD_MOV',$cod_mov).'-'.get_row('MAESTRO_CZ','DOCUMENTO','COD_MOV',$cod_mov);  

						
						$periodo_inventario = $axperiodo_actual;
						$estado_periodo = 'ABIERTA';

						$sqlinserta_D = "INSERT INTO VERIFICACION_DETALLE  (DETALLE_MOVIMIENTO,TIPO_MOV,FECHA_EMISION,ID_LOCAL,NUM_PEDIDO,NOM_COMERCIAL,ID_PRODUCTO,COD_PRODUCTO,INGRESO,PRS_COMPRA,SALIDA,PRS_VENTA,STOCK,ESTADO_INVENTARIO,COD_MOV,COMPROBANTE,VALOR_INGRESO,TOTAL_INGRESO,PERIODO_INVENTARIO,ESTADO_PERIODO,NUM_ORDEN,ESTADO_ATENDIDO,TITULO) VALUES ('$detalle_movimiento','$tipo_mov','$fecha_emision','$id_local','$num_pedido','$nom_comercial','$id_producto','$cod_producto','$ingreso','$prs_compra','$salida','$prs_venta','$stock','$estado_inventario','$cod_mov','$comprobante','$valor_salida','$total_salida','$axperiodo_actual','$estado_periodo','$it','$axestado_atendido','$axtitulo')";
						//echo $sqlinserta_D.'<br>';
						$RSInsert_D = odbc_exec($con,$sqlinserta_D);

					}

				}
			}
	}

/******************TRAER A LA TABLA VERIFICACION DETALLE, TODOS LOS MOVIMIENTOS DE VENTAS DE TODOS LAS NOTAS DE CREDITO*************************/

	$SQLBuscar_productos_nc ="SELECT ID_PRODUCTO FROM PRODUCTOS ORDER BY COD_PRODUCTO ASC";
	$RSBuscar_productos_nc = odbc_exec($con,$SQLBuscar_productos_nc);

	if(odbc_num_rows($RSBuscar_productos_nc) > 0){

		while ($fila_nc = odbc_fetch_array($RSBuscar_productos_nc)) {

			$axid_producto_nc = $fila_nc['ID_PRODUCTO'];

			$sqlsaldo_anterior_nc = "SELECT FECHA_EMISION,COMPROBANTE,ID_PRODUCTO,ID_BENEFICIARIO,COD_MOV,ESTADO_INVENTARIO,cod_tip_nc_nd_ref,COD_PRODUCTO,NOM_COMERCIAL,SUM(CANT_PADRE) AS SALIDA,PRS_VENTA,SUm(VALOR_SALIDA) AS VS,SUM(TOTAL_SALIDA) AS TS FROM MAESTRO_NOTA_CREDITO WHERE ID_PRODUCTO='$axid_producto_nc' AND ESTADO_INVENTARIO='INVENTARIO'AND FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY FECHA_EMISION,COMPROBANTE,ID_PRODUCTO,PRS_VENTA,ID_BENEFICIARIO,COD_MOV,ESTADO_INVENTARIO,cod_tip_nc_nd_ref,COD_PRODUCTO,NOM_COMERCIAL ORDER BY FECHA_EMISION ASC";
			$rssaldo_antes_nc = odbc_exec($con,$sqlsaldo_anterior_nc);

			if(odbc_num_rows($rssaldo_antes_nc) > 0){
				$it=0;
					while ($fila_dt_1 = odbc_fetch_array($rssaldo_antes_nc)) {

						$it=$it+1;
						
						$detalle_movimiento = 'VENTA';
						$tipo_mov = 'INGRESO'; //INGRESO DE DINERO
						$fecha_emision = $fila_dt_1['FECHA_EMISION'];
						$cod_mov =  $fila_dt_1['COD_MOV'];
						$id_local =get_row('MAESTRO_CZ','ID_LOCAL','COD_MOV',$cod_mov); 						 
						$num_pedido = $fila_dt_1['COMPROBANTE'];						
						$axid_beneficiario= $fila_dt_1['ID_BENEFICIARIO'];						
						
						$estado_inventario = $fila_dt_1['ESTADO_INVENTARIO'];
						$axestado_atendido = 'PROGRAMADO';

						$nom_comercial = $fila_dt_1['NOM_COMERCIAL']; 
						$id_producto = $axid_producto_nc;
						$cod_producto = $fila_dt_1['COD_PRODUCTO']; 
			


						if($estado_inventario=='ANULADA' || $estado_inventario=='RECHAZADA'){

							$ingreso = 0;
							$prs_compra = 0;
							$salida = 0;
							$prs_venta = 0;						
							$stock = 0;
							$valor_salida = 0;
							$total_salida = 0;

						}else{

							$ingreso = 0;
							$prs_compra = 0;
							$salida = $fila_dt_1['SALIDA']/-1;
							$prs_venta = $fila_dt_1['PRS_VENTA'];						
							$stock = 0;
							$valor_salida = $fila_dt_1['VS'];
							$total_salida = $fila_dt_1['TS'];

						}


						$axtipo_nc =  $fila_dt_1['cod_tip_nc_nd_ref']; 
						$axtipo_doc = $fila_dt_1['ID_TD']; 

						if($axtipo_doc =='6'){ //si es nota de credito
							
							if($axtipo_nc=='05'){ //DESCUENTO POR ITEM
								
								//$axcosto_producto=$_POST['txtcosto_producto']/-1;
								$prs_compra = $fila_dt['PRS_COMPRA'];
								$salida = 0;
								$valor_salida = $fila_dt['VS']/-1;
								$total_salida = $fila_dt['TS']/-1;

							}elseif($axtipo_nc=='07' || $axtipo_nc=='01'){ //ANULACION DE LA VENTA Y/O DEVOLUCION POR ITEM
								
								//$axcant_ingreso =$_POST['txtcant_ingreso']/-1;	
								$salida = $fila_dt['SALIDA'];;
								$valor_salida = $fila_dt['VS']/-1;
								$total_salida = $fila_dt['TS']/-1;
							}
						}


						
						$comprobante = $fila_dt_1['COMPROBANTE'];						

						
						$periodo_inventario = $axperiodo_actual;
						$estado_periodo = 'ABIERTA';

						$sqlinserta_D = "INSERT INTO VERIFICACION_DETALLE  (DETALLE_MOVIMIENTO,TIPO_MOV,FECHA_EMISION,ID_LOCAL,NUM_PEDIDO,NOM_COMERCIAL,ID_PRODUCTO,COD_PRODUCTO,INGRESO,PRS_COMPRA,SALIDA,PRS_VENTA,STOCK,ESTADO_INVENTARIO,COD_MOV,COMPROBANTE,VALOR_INGRESO,TOTAL_INGRESO,PERIODO_INVENTARIO,ESTADO_PERIODO,NUM_ORDEN,ESTADO_ATENDIDO,TITULO) VALUES ('$detalle_movimiento','$tipo_mov','$fecha_emision','$id_local','$num_pedido','$nom_comercial','$id_producto','$cod_producto','$ingreso','$prs_compra','$salida','$prs_venta','$stock','$estado_inventario','$cod_mov','$comprobante','$valor_salida','$total_salida','$axperiodo_actual','$estado_periodo','$it','$axestado_atendido','$axtitulo')";
						//echo $sqlinserta_D.'<br>';
						$RSInsert_D = odbc_exec($con,$sqlinserta_D);




					}
			}

		}

	}

		
/****************SACAR EL STOCK DEL PERIODO ANTERIOR Y GRABARLO EN EL PERIODO ACTUAL********************/

	/***AGRUPO TODOS PRODUCTOS UTILIZADOS EN LOS PEDIDOS SEGUN EL RANGO DE FECHA***/
	$SQLBuscar_productos_1 ="SELECT ID_PRODUCTO FROM PRODUCTOS ORDER BY COD_PRODUCTO ASC";
	//$SQLBuscar_productos_1 ="SELECT ID_PRODUCTO FROM PEDIDOS WHERE FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY ID_PRODUCTO";
	$RSBuscar_productos_1 = odbc_exec($con,$SQLBuscar_productos_1);


	if(odbc_num_rows($RSBuscar_productos_1) > 0){

		while ($fila_antes = odbc_fetch_array($RSBuscar_productos_1)) {
			
			$axcod_producto_antes = $fila_antes['COD_PRODUCTO'];
			$axid_producto_antes = $fila_antes['ID_PRODUCTO'];

			$SQLSaldo_productos = "SELECT ID_PRODUCTO,COD_PRODUCTO,SUM(INGRESO-SALIDA) AS STOCK_ANTERIOR FROM VERIFICACION_DETALLE WHERE ID_PRODUCTO='$axid_producto_antes' AND PERIODO_INVENTARIO='$axperiodo_anterior' GROUP BY ID_PRODUCTO,COD_PRODUCTO ";
			$RSSaldo_productos = odbc_exec($con,$SQLSaldo_productos);
			//echo $SQLSaldo_productos.'<br>';
			
				if(odbc_num_rows($RSSaldo_productos) > 0){

					while ($fila_saldos = odbc_fetch_array($RSSaldo_productos)) {

									
						$detalle_movimiento = '';
						$tipo_mov = 'STOCK_ANTES';						
						$fecha_emision = $axfecha_del;											
						$id_local = '';
						$num_pedido = '';
						$nom_comercial = 'SALDO PERIODO ANTERIOR - '.$axperiodo_anterior;
						$id_producto = $fila_saldos['ID_PRODUCTO'];
						$cod_producto = $fila_saldos['COD_PRODUCTO'];
						$ingreso = $fila_saldos['STOCK_ANTERIOR'];

						if($ingreso==''){
						$ingreso = 0;							
						}

						$prs_compra = 0;
						$salida = 0;
						$prs_venta = 0;
						$stock = 0;						
						$estado_periodo = 'ABIERTA';
						$estado_inventario='INVENTARIO';
			

						$sqlinserta_DT = "INSERT INTO VERIFICACION_DETALLE  (DETALLE_MOVIMIENTO,TIPO_MOV,FECHA_EMISION,ID_LOCAL,NUM_PEDIDO,NOM_COMERCIAL,ID_PRODUCTO,COD_PRODUCTO,INGRESO,PRS_COMPRA,SALIDA,PRS_VENTA,STOCK,ESTADO_INVENTARIO,COD_MOV,COMPROBANTE,VALOR_INGRESO,TOTAL_INGRESO,PERIODO_INVENTARIO,ESTADO_PERIODO,NUM_ORDEN,TITULO) VALUES ('$detalle_movimiento','$tipo_mov','$fecha_emision','$id_local','$num_pedido','$nom_comercial','$id_producto','$cod_producto','$ingreso','$prs_compra','$salida','$prs_venta','$stock','$estado_inventario','','',0,0,'$axperiodo_actual','$estado_periodo','0','$axtitulo')";
						//echo $sqlinserta_DT.'<br>';
						$RSInsert_DT = odbc_exec($con,$sqlinserta_DT);

				
					}
				}
			}
		}

/**COSTO PROMEDIO PONDERADO DEL PRODUCTO ***/

	/***AGRUPO TODOS PRODUCTOS UTILIZADOS EN LOS PEDIDOS SEGUN EL RANGO DE FECHA***/
	//$SQLBuscar_productos_2 ="SELECT ID_PRODUCTO FROM PEDIDOS WHERE FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY ID_PRODUCTO";
	$SQLBuscar_productos_2 ="SELECT ID_PRODUCTO FROM PRODUCTOS ORDER BY COD_PRODUCTO ASC";
	$RSBuscar_productos_2 = odbc_exec($con,$SQLBuscar_productos_2);

	if(odbc_num_rows($RSBuscar_productos_2) > 0){
	
	while ($row = odbc_fetch_array($RSBuscar_productos_2)) {
	
	$axid_producto_p1 = $row['ID_PRODUCTO'];

	$SQLVerifica_1 = "SELECT * FROM VERIFICACION_DETALLE WHERE ID_PRODUCTO='$axid_producto_p1' AND FECHA_LLEGADA BETWEEN '$axfecha_del' AND '$axfecha_al' AND PRS_COMPRA > 0  AND DETALLE_MOVIMIENTO='COMPRA' ORDER BY FECHA_LLEGADA ASC";
	$RSVerifica_1 = odbc_exec($con,$SQLVerifica_1);

		while ($fila_p = odbc_fetch_array($RSVerifica_1)) {
			
			$axid_producto = $fila_p['ID_PRODUCTO'];
			$axdetalle_movimiento = $fila_p['DETALLE_MOVIMIENTO'];
			$axfecha_emision = $fila_p['FECHA_EMISION'];
			$axfecha_llegada_mercaderia = $fila_p['FECHA_LLEGADA'];
			$axcant_ingreso = $fila_p['INGRESO'];
			$axcosto_producto = $fila_p['PRS_COMPRA'];
			$axtotal_ingreso = $fila_p['TOTAL_INGRESO'];
			$axvalor_ingreso = $fila_p['VALOR_INGRESO'];
			$axestado_inventario = $fila_p['ESTADO_INVENTARIO'];
			$axcod_mov = $fila_p['COD_MOV'];
			$axcomprobante = $fila_p['COMPROBANTE'];
			

			$sqlinserta_5 = "INSERT INTO VERIFICACION_PONDERADO (ID_PRODUCTO,DETALLE_MOVIMIENTO,FECHA_EMISION,CANT_INGRESO,COSTO_PRODUCTO,TOTAL_INGRESO,VALOR_INGRESO,ESTADO_INVENTARIO,COD_MOV,COMPROBANTE,PERIODO_INVENTARIO,ESTADO_PERIODO,FECHA_LLEGADA) VALUES ('$axid_producto','$axdetalle_movimiento','$axfecha_emision','$axcant_ingreso','$axcosto_producto','$axtotal_ingreso','$axvalor_ingreso','$axestado_inventario','$axcod_mov','$axcomprobante','$axperiodo_actual','ABIERTA','$axfecha_llegada_mercaderia')";
			$rsinserta_5 = odbc_exec($con,$sqlinserta_5);
			//echo $sqlinserta_5.'<br>';

		}

	}

}

/**************TRAER EL SALDO ANTERIOR DE LA TABLA VERIFICACION_DETALLE*********************/

/***AGRUPO TODOS PRODUCTOS UTILIZADOS EN LOS PEDIDOS SEGUN EL RANGO DE FECHA***/
	//$sqlfinal ="SELECT ID_PRODUCTO FROM PEDIDOS WHERE FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY ID_PRODUCTO";
	$sqlfinal ="SELECT ID_PRODUCTO FROM PRODUCTOS ORDER BY COD_PRODUCTO ASC";
	$rsfinal = odbc_exec($con,$sqlfinal);

	if(odbc_num_rows($rsfinal) > 0){

		while ($fila_final = odbc_fetch_array($rsfinal)) {
			
			$axid_producto_final = $fila_final['ID_PRODUCTO'];

			$SQLSaldo_anterior = "SELECT INGRESO AS SALDO_ANTERIOR,TITULO,COD_PRODUCTO FROM VERIFICACION_DETALLE WHERE TIPO_MOV='STOCK_ANTES' AND FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' AND PERIODO_INVENTARIO='$axperiodo_actual' AND ID_PRODUCTO='$axid_producto_final'";
			$RSSaldo_anterior = odbc_exec($con,$SQLSaldo_anterior);
			//echo $SQLSaldo_anterior.'<br>';

			if(odbc_num_rows($RSSaldo_anterior) > 0){

				while ($fila_saldo_anterior = odbc_fetch_array($RSSaldo_anterior)) {
				
					$axsaldo_anterior = $fila_saldo_anterior['SALDO_ANTERIOR'];

					$axtitulo = $fila_saldo_anterior['TITULO'];
					$axid_producto = $axid_producto_final;
					$axcod_producto = $fila_saldo_anterior['COD_PRODUCTO'];
					$axnom_producto = get_row('PRODUCTOS','NOM_PRODUCTO','ID_PRODUCTO',$axid_producto);
					$axstock_anterior = $axsaldo_anterior;
					$axvendidos = 0;
					$axdespachado =0 ;
					$axpor_despachar =0 ;
					$axstock_total = 0;
					$axstock_logico = 0;
					$axstock_fisico = 0;
					$axprc_compra_prom =0 ;
					$axprc_venta_prom = 0;
					$axid_local = '';
					$axperiodo_inventario = $axperiodo_actual;
					$axestado_periodo = 'ABIERTA';

					$SQLInsert_saldo = "INSERT INTO PRODUCTOS_INVENTARIOS (TITULO,ID_PRODUCTO,COD_PRODUCTO,NOM_PRODUCTO,STOCK_ANTERIOR,VENDIDOS,DESPACHADO,POR_DESPACHAR,STOCK_TOTAL,STOCK_LOGICO,STOCK_FISICO,PRC_COMPRA_PROM,PRC_VENTA_PROM,ID_LOCAL,PERIODO_INVENTARIO,ESTADO_PERIODO) VALUES ('$axtitulo','$axid_producto','$axcod_producto','$axnom_producto','$axstock_anterior','$axvendidos','$axdespachado','$axpor_despachar','$axstock_total','$axstock_logico','$axstock_fisico','$axprc_compra_prom','$axprc_venta_prom','$axid_local','$axperiodo_inventario','$axestado_periodo')";
					//echo $SQLInsert_saldo.'<br>';
					$RSInsert_saldo = odbc_exec($con,$SQLInsert_saldo);

				}		

			}else{


					$axsaldo_anterior = 0;
					$axtitulo = '';
					$axid_producto = $axid_producto_final;
					$axcod_producto = get_row('PRODUCTOS','COD_PRODUCTO','ID_PRODUCTO',$axid_producto);
					$axnom_producto = get_row('PRODUCTOS','NOM_PRODUCTO','ID_PRODUCTO',$axid_producto);
					$axstock_anterior = 0;
					$axvendidos = 0;
					$axdespachado =0 ;
					$axpor_despachar =0 ;
					$axstock_total = 0;
					$axstock_logico = 0;
					$axstock_fisico = 0;
					$axprc_compra_prom =0 ;
					$axprc_venta_prom = 0;
					$axid_local = '';
					$axperiodo_inventario = $axperiodo_actual;
					$axestado_periodo = 'ABIERTA';

					$SQLInsert_saldo = "INSERT INTO PRODUCTOS_INVENTARIOS (TITULO,ID_PRODUCTO,COD_PRODUCTO,NOM_PRODUCTO,STOCK_ANTERIOR,VENDIDOS,DESPACHADO,POR_DESPACHAR,STOCK_TOTAL,STOCK_LOGICO,STOCK_FISICO,PRC_COMPRA_PROM,PRC_VENTA_PROM,ID_LOCAL,PERIODO_INVENTARIO,ESTADO_PERIODO) VALUES ('$axtitulo','$axid_producto','$axcod_producto','$axnom_producto','$axstock_anterior','$axvendidos','$axdespachado','$axpor_despachar','$axstock_total','$axstock_logico','$axstock_fisico','$axprc_compra_prom','$axprc_venta_prom','$axid_local','$axperiodo_inventario','$axestado_periodo')";
					//echo $SQLInsert_saldo.'<br>';
					$RSInsert_saldo = odbc_exec($con,$SQLInsert_saldo);

			}
		}

	}

/**************TRAER EL TOTAL DE LO  COMPRADO TABLA VERIFICACION_DETALLE*********************/

/***AGRUPO TODOS PRODUCTOS UTILIZADOS EN LOS PEDIDOS SEGUN EL RANGO DE FECHA***/
	$sqlcomprado ="SELECT ID_PRODUCTO FROM PRODUCTOS ORDER BY COD_PRODUCTO ASC";
	//$sqlcomprado ="SELECT ID_PRODUCTO FROM PEDIDOS WHERE FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY ID_PRODUCTO";
	$rscomprado = odbc_exec($con,$sqlcomprado);

	if(odbc_num_rows($rscomprado) > 0){

		while ($fila_comprado = odbc_fetch_array($rscomprado)) {
			
			$axid_producto_compras = $fila_comprado['ID_PRODUCTO'];

			$sqlcomprado_total = "SELECT SUM(INGRESO) AS COMPRAS FROM VERIFICACION_DETALLE WHERE DETALLE_MOVIMIENTO='COMPRA' AND FECHA_LLEGADA BETWEEN '$axfecha_del' AND '$axfecha_al' AND PERIODO_INVENTARIO='$axperiodo_actual' AND ID_PRODUCTO='$axid_producto_compras'";
			$rscomprado_total = odbc_exec($con,$sqlcomprado_total);
			//echo $sqlcomprado_total.'<br>';

			if(odbc_num_rows($rscomprado_total) > 0){

				while ($fila_comprado_t = odbc_fetch_array($rscomprado_total)) {
				
					$axcomprado = $fila_comprado_t['COMPRAS'];
					if($axcomprado==''){
						$axcomprado=0;
					}
					$sqlactualizar_comprado = "UPDATE  PRODUCTOS_INVENTARIOS  SET COMPRADO='$axcomprado' WHERE PERIODO_INVENTARIO='$axperiodo_actual' AND ID_PRODUCTO='$axid_producto_compras'";					
					$rsactualizar_comprado = odbc_exec($con,$sqlactualizar_comprado);

				}		

			}
		}

	}

/**************TRAER EL TOTAL DE LO  VENDIDO TABLA VERIFICACION_DETALLE*********************/

/***AGRUPO TODOS PRODUCTOS UTILIZADOS EN LOS PEDIDOS SEGUN EL RANGO DE FECHA***/

	$sqlvendido ="SELECT ID_PRODUCTO FROM PRODUCTOS ORDER BY COD_PRODUCTO ASC";
	//$sqlvendido ="SELECT ID_PRODUCTO FROM PEDIDOS WHERE FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY ID_PRODUCTO";
	$rsvendido = odbc_exec($con,$sqlvendido);

	if(odbc_num_rows($rsvendido) > 0){

		while ($fila_vendido = odbc_fetch_array($rsvendido)) {
			
			$axid_producto_ventas = $fila_vendido['ID_PRODUCTO'];

			$sqlvendido_t = "SELECT SUM(SALIDA) AS VENDIDO FROM VERIFICACION_DETALLE WHERE FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' AND PERIODO_INVENTARIO='$axperiodo_actual' AND ID_PRODUCTO='$axid_producto_ventas'";
			$rsvendido_t = odbc_exec($con,$sqlvendido_t);
			//echo $sqlvendido_t.'<br>';

			if(odbc_num_rows($rsvendido_t) > 0){

				while ($fila_vendido_1 = odbc_fetch_array($rsvendido_t)) {
				
					$axvendido = $fila_vendido_1['VENDIDO'];
					if($axvendido==''){
						$axvendido=0;
					}

					$sqlactualizar_vendido = "UPDATE  PRODUCTOS_INVENTARIOS  SET VENDIDOS='$axvendido' WHERE PERIODO_INVENTARIO='$axperiodo_actual' AND ID_PRODUCTO='$axid_producto_ventas'";					
					//echo $sqlactualizar_vendido.'<br>';
					$rsactualizar_vendido = odbc_exec($con,$sqlactualizar_vendido);


				}		

			}
		}

	}

/**************TRAER EL TOTAL DE LO  DESPACHADO - PROGRAMADO TABLA VERIFICACION_DETALLE*********************/

/***AGRUPO TODOS PRODUCTOS UTILIZADOS EN LOS PEDIDOS SEGUN EL RANGO DE FECHA***/
	$sqldespachado ="SELECT ID_PRODUCTO FROM PRODUCTOS ORDER BY COD_PRODUCTO ASC";
	//$sqldespachado ="SELECT ID_PRODUCTO FROM PEDIDOS WHERE FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY ID_PRODUCTO";
	$rsdespachado = odbc_exec($con,$sqldespachado);

	if(odbc_num_rows($rsdespachado) > 0){

		while ($fila_despacho = odbc_fetch_array($rsdespachado)) {
			
			$axid_producto_despachado = $fila_despacho['ID_PRODUCTO'];

			$sqldespachado_1 = "SELECT SUM(SALIDA) AS DESPACHADO FROM VERIFICACION_DETALLE WHERE FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' AND PERIODO_INVENTARIO='$axperiodo_actual' AND ID_PRODUCTO='$axid_producto_despachado' AND ESTADO_ATENDIDO <>'PENDIENTE'";
			$rsdespachado_1 = odbc_exec($con,$sqldespachado_1);
			//echo $sqldespachado_1.'<br>';

			if(odbc_num_rows($rsdespachado_1) > 0){

				while ($fila_despacho_1 = odbc_fetch_array($rsdespachado_1)) {
				
					$axdespachado = $fila_despacho_1['DESPACHADO'];

					if($axdespachado==''){
						$axdespachado=0;
					}

					$sqlactualizar_despachado = "UPDATE  PRODUCTOS_INVENTARIOS  SET DESPACHADO='$axdespachado' WHERE PERIODO_INVENTARIO='$axperiodo_actual' AND ID_PRODUCTO='$axid_producto_despachado'";					
					//echo $sqlactualizar_vendido.'<br>';
					$rsactualizar_despachado = odbc_exec($con,$sqlactualizar_despachado);


				}		

			}
		}

	}

/**************TRAER EL TOTAL DE LO  POR DESPACHAR - PENDIENTE TABLA VERIFICACION_DETALLE*********************/

/***AGRUPO TODOS PRODUCTOS UTILIZADOS EN LOS PEDIDOS SEGUN EL RANGO DE FECHA***/
	$sqlpor_despachar ="SELECT ID_PRODUCTO FROM PRODUCTOS ORDER BY COD_PRODUCTO ASC";
	//$sqlpor_despachar ="SELECT ID_PRODUCTO FROM PEDIDOS WHERE FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY ID_PRODUCTO";
	$rspor_despachar = odbc_exec($con,$sqlpor_despachar);

	if(odbc_num_rows($rspor_despachar) > 0){

		while ($fila_por_despachar = odbc_fetch_array($rspor_despachar)) {
			
			$axid_producto_por_despachado = $fila_por_despachar['ID_PRODUCTO'];

			$sqlpor_despachar_1 = "SELECT SUM(SALIDA) AS POR_DESPACHADO FROM VERIFICACION_DETALLE WHERE FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' AND PERIODO_INVENTARIO='$axperiodo_actual' AND ID_PRODUCTO='$axid_producto_por_despachado' AND ESTADO_ATENDIDO='PENDIENTE'";
			$rspor_despachar_1 = odbc_exec($con,$sqlpor_despachar_1);
			//echo $sqlpor_despachar_1.'<br>';

			if(odbc_num_rows($rspor_despachar_1) > 0){

				while ($fila_por_despachar_1 = odbc_fetch_array($rspor_despachar_1)) {
				
					$axpor_despachar = $fila_por_despachar_1['POR_DESPACHADO'];
					$axtitulo = $fila_por_despachar_1['TITULO'];

					if($axpor_despachar==''){
					$axpor_despachar = 0;						
					}

					$sqlactualizar_por_despachado = "UPDATE  PRODUCTOS_INVENTARIOS  SET POR_DESPACHAR='$axpor_despachar',TITULO='$axtitulo' WHERE PERIODO_INVENTARIO='$axperiodo_actual' AND ID_PRODUCTO='$axid_producto_por_despachado'";					
					//echo $sqlactualizar_vendido.'<br>';
					$rsactualizar_por_despachado = odbc_exec($con,$sqlactualizar_por_despachado);


				}		

			}
		}

	}

/************BUSCAR PRECIOS PROMEDIO EN EL MES ANTERIOR************************/	
	
	$SQLPonderado_antes ="SELECT ID_PRODUCTO FROM PRODUCTOS ORDER BY COD_PRODUCTO ASC";
	//$SQLPonderado_antes ="SELECT ID_PRODUCTO FROM PEDIDOS WHERE FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY ID_PRODUCTO";
	$RSPonderado_antes = odbc_exec($con,$SQLPonderado_antes);

	if(odbc_num_rows($RSPonderado_antes) > 0){

		while ($fila_antes = odbc_fetch_array($RSPonderado_antes)) {
			
			$axcod_producto_antes = $fila_antes['COD_PRODUCTO'];
			$axid_producto_antes = $fila_antes['ID_PRODUCTO'];

			$sqlsaldo_anterior = "SELECT * FROM PRODUCTOS_INVENTARIOS WHERE ID_PRODUCTO='$axid_producto_antes' AND PERIODO_INVENTARIO='$axperiodo_anterior'";
			$rssaldo_antes = odbc_exec($con,$sqlsaldo_anterior);
			//echo $sqlsaldo_anterior.'<br>';
			
				if(odbc_num_rows($rssaldo_antes) > 0){

					while ($fila_antes = odbc_fetch_array($rssaldo_antes)) {

						$axid_producto = $fila_antes['ID_PRODUCTO'];
						$axdetalle_movimiento = 'COMPRA';
						$axfecha_emision = $axfecha_del;
						$axcant_ingreso = $fila_antes['STOCK_FISICO'];
						$axcosto_producto = $fila_antes['PRC_COMPRA_PROM'];
						$axtotal_ingreso = $axcant_ingreso*$axcosto_producto;
						$axvalor_ingreso = 0;
						$axestado_inventario = '';
						$axcod_mov = '';
						$axcomprobante = 'PERIODO ANTERIOR - '.$axperiodo_anterior;						

						$sqlinserta_v = "INSERT INTO VERIFICACION_PONDERADO (ID_PRODUCTO,DETALLE_MOVIMIENTO,FECHA_EMISION,CANT_INGRESO,COSTO_PRODUCTO,TOTAL_INGRESO,VALOR_INGRESO,ESTADO_INVENTARIO,COD_MOV,COMPROBANTE,PERIODO_INVENTARIO,ESTADO_PERIODO) VALUES ('$axid_producto','$axdetalle_movimiento','$axfecha_emision','$axcant_ingreso','$axcosto_producto','$axtotal_ingreso','$axvalor_ingreso','$axestado_inventario','$axcod_mov','$axcomprobante','$axperiodo_actual','ABIERTA')";
						$rsinserta_v = odbc_exec($con,$sqlinserta_v);
						//echo $sqlinserta_v.'<br>';

				
					}
				}
			}
	}

	/**COSTO PROMEDIO PONDERADO DEL PRODUCTO ***/

/***AGRUPO TODOS PRODUCTOS UTILIZADOS EN LOS PEDIDOS SEGUN EL RANGO DE FECHA***/
//$SQLPonderado ="SELECT ID_PRODUCTO FROM PEDIDOS WHERE FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY ID_PRODUCTO";
$SQLPonderado ="SELECT ID_PRODUCTO FROM PRODUCTOS ORDER BY COD_PRODUCTO ASC";
$RSPonderado = odbc_exec($con,$SQLPonderado);

if(odbc_num_rows($RSPonderado) > 0){

while ($row = odbc_fetch_array($RSPonderado)) {
	
	$axid_producto_p = $row['ID_PRODUCTO'];

	$sqlbuscar_precio = "SELECT SUM(CANT_INGRESO) AS CANT,SUM(TOTAL_INGRESO) AS TT,SUM(TOTAL_INGRESO)/SUM(CANT_INGRESO) AS PP FROM VERIFICACION_PONDERADO WHERE CANT_INGRESO <> 0 and COSTO_PRODUCTO > 0 AND ID_PRODUCTO='$axid_producto_p' AND PERIODO_INVENTARIO='$axperiodo_actual' GROUP BY ID_PRODUCTO ORDER BY ID_PRODUCTO ASC";

	$rsBuscar_precio = odbc_exec($con,$sqlbuscar_precio);	
	$fila_p =odbc_fetch_array($rsBuscar_precio);
	//echo $sqlbuscar_precio.'<br>';

		$axprs_promedio = $fila_p['PP'];

		if($axprs_promedio==''){
			$axprs_promedio =0;
		}

		$axverifica = get_row_two('PRODUCTOS_INVENTARIOS','ID_PRODUCTO','ID_PRODUCTO','PERIODO_INVENTARIO',$axid_producto_p,$axperiodo_actual);
		$axtitulo = get_row_two('VERIFICACION_DETALLE','TITULO','ID_PRODUCTO','PERIODO_INVENTARIO',$axid_producto_p,$axperiodo_actual);

		$axcosto = number_format($fila["PRC_COMPRA_PROM"],2,".",","); 		
		$axcomprado =get_row_two('PRODUCTOS_INVENTARIOS','COMPRADO','ID_PRODUCTO','PERIODO_INVENTARIO',$axid_producto_p,$axperiodo_actual);  
		$axstock_antes = get_row_two('PRODUCTOS_INVENTARIOS','STOCK_ANTERIOR','ID_PRODUCTO','PERIODO_INVENTARIO',$axid_producto_p,$axperiodo_actual);   
		$axcompras_total =$axcomprado+$axstock_antes;
		$axvendido = get_row_two('PRODUCTOS_INVENTARIOS','VENDIDOS','ID_PRODUCTO','PERIODO_INVENTARIO',$axid_producto_p,$axperiodo_actual);    
		$axdepachado = get_row_two('PRODUCTOS_INVENTARIOS','DESPACHADO','ID_PRODUCTO','PERIODO_INVENTARIO',$axid_producto_p,$axperiodo_actual);     
		$axpor_depachado = get_row_two('PRODUCTOS_INVENTARIOS','POR_DESPACHAR','ID_PRODUCTO','PERIODO_INVENTARIO',$axid_producto_p,$axperiodo_actual);      
		$axstock_total = $axcompras_total-$axdepachado-$axpor_depachado;
		$axstock_logico =$axstock_total;
		$axstock_fiscio = $axcompras_total-$axdepachado;


			if($axverifica !==''){
				$sqlinserta  ="UPDATE PRODUCTOS_INVENTARIOS SET PRC_COMPRA_PROM='$axprs_promedio',TITULO='$axtitulo',STOCK_LOGICO='$axstock_logico',STOCK_FISICO='$axstock_fiscio' WHERE ID_PRODUCTO='$axid_producto_p' AND PERIODO_INVENTARIO='$axperiodo_actual'";
				$rsinserta = odbc_exec($con,$sqlinserta);
				//echo $sqlinserta;
			}	
}

}

break;

case '181':
	
$axid_producto =$_POST['txtid_producto'];
$axfecha_del =$_POST['txtfecha_del'];
$axfecha_al =$_POST['txtfecha_al'];


$SQLBuscar ="SELECT * FROM VERIFICACION_DETALLE WHERE DETALLE_MOVIMIENTO='COMPRA' AND FECHA_LLEGADA BETWEEN '$axfecha_del' AND '$axfecha_al' AND ID_PRODUCTO='$axid_producto'  ORDER BY FECHA_LLEGADA ASC"; 
//echo $SQLBuscar;

echo "
			
		<table class='table table-hover table-sm'>
		<thead class='table-success'>			
		<tr>
			<th style='text-align: center;'>Item</th>
			<th style='text-align: center;'>Fecha Emisión</th>
			<th style='text-align: center;'>Fecha Llegada</th>
			<th style='text-align: center;'>Num Comprobante</th>			
			<th class='table-success' style='text-align: right;'>Cantidad</th>			
			<th class='table-success' style='text-align: right;'>Costo</th>			
			<th class='table-primary' style='text-align: right;'>Total</th>						
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		
 		$it= $it+1; 		
 		$axid_producto = $fila['ID_PRODUCTO'];
		$axfecha = date('d-m-Y', strtotime($fila['FECHA_EMISION']));		
		$axfecha_llegada_mercaderia = date('d-m-Y', strtotime($fila['FECHA_LLEGADA']));		
		$axcomprobante = $fila['COMPROBANTE'];
		
		$axingreso = number_format($fila["INGRESO"],2,".",","); 
		$axcosto = number_format($fila["PRS_COMPRA"],2,".",","); 	 
		$axtotal = number_format($fila["TOTAL_INGRESO"],2,".",","); 		

 	echo "
 		<tr> 		
 			<td style='text-align: center;'>".$it."</td> 
 			<td style='text-align: center;'>".$axfecha."</td> 
 			<td style='text-align: center;'>".$axfecha_llegada_mercaderia."</td> 
 			<td style='text-align: center;'>".$axcomprobante."</td>  			
 			<td class='text-success' style='text-align: right;'><b>".$axingreso."</b></td>  			
 			<td class='text-danger' style='text-align: right;'><b>".$axcosto."</b></td>  			
 			<td class='text-primary' style='text-align: right;'><b>".$axtotal."</b></td>  			 			
 			
 		</tr>";


 	}


 	$SQLBuscar_t ="SELECT SUM(INGRESO) AS TT FROM VERIFICACION_DETALLE WHERE DETALLE_MOVIMIENTO='COMPRA' AND FECHA_LLEGADA BETWEEN '$axfecha_del' AND '$axfecha_al' AND ID_PRODUCTO='$axid_producto'"; 
 	$RSBuscar_T = odbc_exec($con,$SQLBuscar_t);
 	$fila = odbc_fetch_array($RSBuscar_T);
 	$axtotal = number_format($fila["TT"],2,".",","); 

 	echo "
 		<tr> 		
 			<th style='text-align: right;' colspan='4'><b>Total Comprado</b></th> 
 			<th style='text-align: right;'><b>".$axtotal."</b></th>  		 			
 			
 		</tr>";


	echo "</table>";
	}
	
	break;

	case '182':
		
	$axbuscaregistro =$_POST['txtbuscar_prod_inventario'];
	$axperiodo_inventario =$_POST['txtperiodo_inventario'];
	$axfecha_del =$_POST['txtfecha_del'];
	$axfecha_al =$_POST['txtfecha_al'];

	if($axfecha_del==''){

		$año = substr($axperiodo_inventario_1,3,4);
		$mes_1 = substr($axperiodo_inventario_1,0,2);
		$mes=intval($mes_1)-1;

		$axperiodo_inventario = number_pad($mes,2,0).'-'.$año;

		$ultimoDia = date("t", strtotime("$año-$mes-01"));
		$axfecha_del = $año.'-'.$mes.'-01';
		$axfecha_al = $año.'-'.$mes.'-'.$ultimoDia;

	}else{

		$axtitulo = 'Fecha del: '. date('d-m-Y',strtotime($axfecha_del)).' al '.date('d-m-Y',strtotime($axfecha_al));	

	}


	/**************ACTUALIZAR LOS PRECIOS PONDERADOS EN TABLA INSUMOS********************/

	//$SQLBuscar ="SELECT  *  FROM PRODUCTOS_INVENTARIOS  WHERE TITULO ='$axtitulo' AND PERIODO_INVENTARIO='$axperiodo_inventario' AND  ID_PRODUCTO = '$axproducto' ORDER BY ID_PRODUCTO ASC";
	$SQLBuscar ="SELECT  *  FROM PRODUCTOS_INVENTARIOS  WHERE TITULO ='$axtitulo' AND PERIODO_INVENTARIO='$axperiodo_inventario' ORDER BY ID_PRODUCTO ASC";
	$rsBuscar = odbc_exec($con,$SQLBuscar);
	//echo $SQLBuscar;

	if(odbc_num_rows($rsBuscar) > 0){

		while ($fila = odbc_fetch_array($rsBuscar) ) {
		
			$axid_producto_actualizar = $fila['ID_PRODUCTO'];
			$axcosto_producto = $fila['PRC_COMPRA_PROM'];

			//echo $axid_producto_actualizar.'<br>';

			if($axcosto_producto > 0){

				$SQLActualizar = "UPDATE PRODUCTOS SET COSTO_PRODUCTO ='$axcosto_producto' WHERE ID_PRODUCTO ='$axid_producto_actualizar'";
				////echo $SQLActualizar.'<br>';
				$RSActualizar = odbc_exec($con,$SQLActualizar);	

					$axbuscar_prod_compl = get_row('PRODUCTOS_COMP','ID_PRODUCTO_COMP','ID_PRODUCTO_COMP',$axid_producto_actualizar);

				if($axbuscar_prod_compl==''){

				}else{
					$SQLActualizar_compl = "UPDATE PRODUCTOS_COMP SET PRS_MINIMO_COMPL ='$axcosto_producto' WHERE ID_PRODUCTO_COMP ='$axid_producto_actualizar'";
					//echo $SQLActualizar_compl.'<br>';
					$RSActualizar_compl = odbc_exec($con,$SQLActualizar_compl);
				}

			}

				
		}
	}

/**************BUSCO LOS ID DE LOS PRODUCTOS PADRES ****************/

$SQLPadres ="SELECT ID_PRODUCTO FROM PRODUCTOS_LISTADO_COMPLEMENTOS  GROUP BY ID_PRODUCTO";
$RSPadres = odbc_exec($con,$SQLPadres);
//echo $SQLPadres;

	if(odbc_num_rows($RSPadres) > 0){

		while ($fila_padre = odbc_fetch_array($RSPadres) ) {
		
			$axid_producto_padre = $fila_padre['ID_PRODUCTO'];		
			/***BUSCO LOS PRODUCTOS HIJOS DE LOS PADRES***/
			
			$SQLBuscar_hijos = "SELECT * FROM PRODUCTOS_LISTADO_COMPLEMENTOS WHERE ID_PRODUCTO='$axid_producto_padre'";
			$RSBuscar_hijos = odbc_exec($con,$SQLBuscar_hijos);
			//echo $SQLBuscar_hijos.'<br>';

			$axcosto_producto_actualizar =0;

			while ($fila_datos = odbc_fetch_array($RSBuscar_hijos)) {

				/***SUMO LOS PRECIOS ***/
				
				$axid_producto_hijo = $fila_datos['ID_PRODUCTO_COMP'];
								
				$axcosto_producto_1 = get_row('PRODUCTOS','COSTO_PRODUCTO','ID_PRODUCTO',$axid_producto_hijo);				
				$axfactor_complemento = get_row_two('PRODUCTOS_COMP','FACTOR_COMPL','ID_PRODUCTO_COMP','ID_PRODUCTO',$axid_producto_hijo,$axid_producto_padre);				


				if($axcosto_producto_1 !==''){

					$axcosto_producto = $axcosto_producto_1*$axfactor_complemento;
					$axcosto_producto_actualizar = $axcosto_producto_actualizar+$axcosto_producto;					

				}

				//echo $axid_producto_padre.' | '.$axid_producto_hijo.' | '.$axcosto_producto.' | '.$axfactor_complemento.' | '.$axcosto_producto_actualizar.'<br>';
			}

			/****ACTUALIZAMOS EL COSTO DEL PRODUCTO PADRE******/
			//echo 'Costo producto: '.$axid_producto_padre.' | '.$axcosto_producto_actualizar.'<br>';

			if($axcosto_producto_actualizar > 0){

				$SQLActualizar_padre = "UPDATE PRODUCTOS SET COSTO_PRODUCTO='$axcosto_producto_actualizar' WHERE ID_PRODUCTO='$axid_producto_padre'";
				$RSActualizar_padre = odbc_exec($con,$SQLActualizar_padre);
				//echo $SQLActualizar_padre.'<br>';
				
			}

			

		}
	}
	
	/***************ASIGNO LOS PORCENTAJES A LOS COMPLEMENTOS********************/

	$SQLPadres_c ="SELECT ID_PRODUCTO FROM PRODUCTOS_LISTADO_COMPLEMENTOS  GROUP BY ID_PRODUCTO";
	$RSPadres_c = odbc_exec($con,$SQLPadres_c);
//echo $SQLPadres;

	if(odbc_num_rows($RSPadres_c) > 0){

		while ($fila_padre_c = odbc_fetch_array($RSPadres_c) ) {
		
			$axid_producto_padre_c = $fila_padre_c['ID_PRODUCTO'];		
			/***BUSCO LOS PRODUCTOS HIJOS DE LOS PADRES***/
			
			$SQLBuscar_hijos_c = "SELECT * FROM PRODUCTOS_COMP WHERE ID_PRODUCTO='$axid_producto_padre_c'";
			$RSBuscar_hijos_c = odbc_exec($con,$SQLBuscar_hijos_c);

			while ($fila_h = odbc_fetch_array($RSBuscar_hijos_c)) {
			
				$axfactor_complemento =  $fila_h['FACTOR_COMPL']; 
				$axid_producto_hijo=  $fila_h['ID_PRODUCTO_COMP']; 
				$axcod_producto=get_row('PRODUCTOS','COD_PRODUCTO','ID_PRODUCTO',$axid_producto_padre_c);
				$axcosto_hijo =  $fila_h['PRS_MINIMO_COMPL']; 				
				$axcosto_padre = get_row('PRODUCTOS','COSTO_PRODUCTO','ID_PRODUCTO',$axid_producto_padre_c);

				if($axcosto_padre > 0){
					$axporc_precio_hijo_1 =($axcosto_hijo*$axfactor_complemento)/$axcosto_padre;	
				}

				//echo $axcod_producto.'|'.$axid_producto_padre_c.'|'.$axid_producto_hijo.' |'.$axcosto_padre.'|'.$axcosto_hijo.'|'.$axfactor_complemento.'|'.$axporc_precio_hijo_1.'<br>';	

				$SQLActualizar_compl = "UPDATE PRODUCTOS_COMP SET PORC_COMPL='$axporc_precio_hijo_1' WHERE ID_PRODUCTO='$axid_producto_padre_c' AND ID_PRODUCTO_COMP='$axid_producto_hijo'";
				$RSActualizar_compl = odbc_exec($con,$SQLActualizar_compl);

				if($RSActualizar_compl){
					$respuesta =0;
					echo $respuesta;
				}else{
					$respuesta =1;
					echo $respuesta;
				}
			}

		}
}
		
			
			

break;

case '183':

$axid_local = $_POST['txtid_local']; 		
$axpermiso_abrir = $_POST['txtpermiso_abrir']; 		
$axiduser = $_POST['txtcodusuario']; 		

if($axpermiso_abrir==1){
	$sqletapas = "SELECT * FROM USUARIOS  WHERE ID_USUARIO='$axiduser' AND FILTRO_VENTAS='VENDEDOR' ORDER BY NOM_USUARIO asc" ;
}elseif($axpermiso_abrir==0){
	$sqletapas = "SELECT * FROM USUARIOS WHERE FILTRO_VENTAS='VENDEDOR' ORDER BY NOM_USUARIO asc" ;
}
	
	
	//echo $sqletapas;	      

	$rsetapas=odbc_exec($con,$sqletapas);
	
	if(odbc_num_rows($rsetapas) > 0){
		//echo '<option value="">Seleccionar</option>';
		while($fila=odbc_fetch_array($rsetapas)){
	   		echo '<option value='.$fila['ID_USUARIO'].'>'.utf8_encode($fila['NOM_USUARIO']).'</option>';
    	}
		
	} else {

		echo "";	
	}



break;

case '184':
date_default_timezone_set("America/Lima");

$axfecha = date('Y-m-d');
$axhora = date('H:i:s');
$axid_usuario = $_POST['txtid_usuario']; 		
$axbtn_inicio = $_POST['txtbtn_inicio']; 		
$axnom_usario = get_row('usuarios','NOM_USUARIO','ID_USUARIO',$axid_usuario);
$axnom_modulo = $_POST['txtnom_modulo']; 

if($axbtn_inicio=='INICIO'){

$axdetalle_bitacora = 'INICIO DE SESION EN EL MODULO '.$axnom_modulo;	

}else{
	
	$axdetalle_bitacora = 'RETORNO AL INICIO DE PEDIDOS '.$axnom_modulo;
}



$SQLInsert = "INSERT INTO BITACORA_USOS (FECHA_BITACORA,HORA_BITACORA,ID_USUARIO,USUARIO,DETALLE_BITACORA,NOM_MENU) VALUES ('$axfecha','$axhora','$axid_usuario','$axnom_usario','$axdetalle_bitacora','$axnom_modulo')";
//echo $SQLInsert;
$RSInsert = odbc_exec($con,$SQLInsert);

break;

case '185':
	
	$axnum_pedido = $_POST['txtnum_pedido']; 		

	$axid_usuario = $_POST['txtid_usuario']; 		
	$axnom_modulo = $_POST['txtnom_modulo']; 
	$axnom_cliente = get_row('PEDIDOS_CZ','NOM_COMERCIAL','NUM_PEDIDO',$axnum_pedido);
	$axdetalle = $_POST['axdetalle'].' '.$axnum_pedido.' DEL CLIENTE '.$axnom_cliente; 	
	guardar_bitacora($axid_usuario,$axnom_modulo,$axdetalle);

break;

case '186':
	
	$axid_local = $_POST['txtid_local']; 				
	$axtipo_documento = $_POST['txttipo_documento']; 			
	$axfecha_emision_del = $_POST['txtfecha_emision_del']; 			
	$axfecha_emision_al = $_POST['txtfecha_emision_al']; 			
	$axnom_cliente = $_POST['txtnom_cliente']; 			
	$axnum_comprobante_emitido = $_POST['txtnum_comprobante_emitido']; 

	$SQLListar = "SELECT DETALLE_DOC FROM RESUMEN_COMPROBANTES_ENVIADOS WHERE ID_LOCAL='$axid_local' AND FECHA_EMISION BETWEEN '$axfecha_emision_del' AND '$axfecha_emision_al' GROUP BY DETALLE_DOC";
	$RSListar = odbc_exec($con,$SQLListar);


	if(odbc_num_rows($RSListar) > 0){

		echo "<table class='table table-hover table-sm'>
		<thead class='table-success'>			
		<tr>
			<th style='text-align: left;'>Detalle</th>			
			<th style='text-align: center;'>Cant</th>			
			<th style='text-align: center;'>Ver</th>			
		</tr>
		</thead>";


		while ($fila = odbc_fetch_array($RSListar)) {
				
				$axtipo_comprobante = $fila['DETALLE_DOC'];
				echo "<tr>
					<td style='text-align: left;' colspan='3'><b>&#160 $axtipo_comprobante</b></td>			
				</tr>";		

			$SQLMostrar = "SELECT ESTADO_ELECTRO,SUM(CANT) AS CT FROM RESUMEN_COMPROBANTES_ENVIADOS WHERE DETALLE_DOC = '$axtipo_comprobante' AND ID_LOCAL='$axid_local' AND FECHA_EMISION BETWEEN '$axfecha_emision_del' AND '$axfecha_emision_al' GROUP BY ESTADO_ELECTRO";
			$RSMostrar = odbc_exec($con,$SQLMostrar);

			if(odbc_num_rows($RSMostrar) > 0){

				while($fila_m =odbc_fetch_array($RSMostrar)){

					$axestado = $fila_m['ESTADO_ELECTRO'];
					$axcant = $fila_m['CT'];

					echo "<tr>
					<td style='text-align: left;'>&#160 &#160 &#160 $axestado</td>			
					<td style='text-align: center;'>$axcant</td>			
					<td style='text-align: center;'><a href='#' style='text-decoration:none;'><i class='bi bi-eye-fill'></i></a></td>			
				</tr>";	

				}

			}





		}

	echo "</table>";	

	}else{

	}


break;

case '187':
	
	$axbuscar_cliente = $_POST['txtbuscar_cliente']; 		
	$axfiltro_busquedas = $_POST['txtfiltro_busquedas']; 		
	$axpaneles = $_POST['txtpaneles']; 		
	$axfecha_pago = $_POST['txtfecha_pago']; 		

	if($axpaneles=='0'){

		if($axbuscar_cliente==''){

			$SQLListar = "SELECT ID_BENEFICIARIO,NOM_COMERCIAL,NUM_PEDIDO,SUM(PAGADO) AS MONTO_PAGADO FROM CTAS_COBRAR_VENDEDORES_CZ WHERE ESTADO_FORMA_PAGO='PENDIENTE' GROUP BY ID_BENEFICIARIO,NOM_COMERCIAL,NUM_PEDIDO order by NOM_COMERCIAL asc";

			$axbtn = "<div style='padding:8px; text-align:right;'> 
								<button type='button' class='btn btn-danger btn-sm' id='btn_pdf'><i class='bi bi-file-earmark-pdf-fill'></i> PDF</button>		
								<a href='exportar_excel.php?param=7'  class='btn btn-success btn-sm' ><b> <i class='bi bi-file-earmark-excel-fill'></i> Excel</b></a>
							</div>";

		}else{

			if($axfiltro_busquedas=='FECHA PAGO'){
				$SQLListar = "SELECT  * FROM CTA_COBRAR_PAGOS WHERE FECHA_PAGO = '$axfecha_pago' order by FECHA_PAGO ASC";		
			}elseif($axfiltro_busquedas=='VENDEDOR'){
				$SQLListar = "SELECT  * FROM CTAS_COBRAR_VENDEDORES_CZ WHERE VENDEDOR like '%".$axbuscar_cliente."%' order by VENDEDOR ASC";		

			}elseif($axfiltro_busquedas=='CLIENTE'){
				$SQLListar = "SELECT  * FROM CTAS_COBRAR_VENDEDORES_CZ WHERE NOM_COMERCIAL like '%".$axbuscar_cliente."%' order by NOM_COMERCIAL ASC";		
						$axbtn = "<div style='padding:8px; text-align:right;'> 	
											<a href='#' class='btn btn-outline-success btn-sm' onclick='exportar_excel()' ><b> <i class='bi bi-file-earmark-excel-fill'></i> Excel</b></a>	
										</div>";
			}elseif($axfiltro_busquedas=='NUM PEDIDO'){
				$SQLListar = "SELECT  * FROM CTA_COBRAR_PAGOS WHERE NUM_PEDIDO = '$axbuscar_cliente' order by NUM_PEDIDO ASC";		

			}
		}

		//echo $SQLListar;
		$RSListar = odbc_exec($con,$SQLListar);
		if(odbc_num_rows($RSListar) > 0){
		echo	$axbtn;
		echo "<table class='table table-hover table-sm' id='tbl_clientes'>
			<thead class='table-success'>			
			<tr>
			<th style='text-align: center;'>Item</th>			
			<th style='text-align: left;'>Cliente</th>";

			//if($axbuscar_cliente==''){
				echo "<th style='text-align: left;'>Fec. Vencimiento</th>";	
			//}else{
				//echo "<th style='text-align: left;'>Fec. Pago</th>";
			//}

			echo "
			<th style='text-align: center;'>Condición</th>			
			<th style='text-align: center;'># Pedido</th>			
			<th style='text-align: center;'># Despacho</th>			
			<th style='text-align: center;'># Comprobante</th>			
			<th style='text-align: center;'>Num. Operación</th>		
			<th style='text-align: center;'>Fecha Pago</th>		
			<th style='text-align: right;'>Monto</th>				
			<th style='text-align: right;'>Pagado</th>				
			<th style='text-align: right;' class='table-danger'>Saldo</th>				
		</tr>
		</thead>";

			while ($fila = odbc_fetch_array($RSListar)) {
				
				$it=$it+1;				
				$axnum_pedido = $fila['NUM_PEDIDO'];
				$axcliente = $fila['NOM_COMERCIAL'];

				if($axcliente==''){
					$axcliente = get_row('PEDIDOS_CZ','NOM_COMERCIAL','NUM_PEDIDO',$axnum_pedido);	
				}
				
				$axcomprobante = get_row('MAESTRO_CZ','TXT_SERIE','NUM_PEDIDO',$axnum_pedido).'-'.get_row('MAESTRO_CZ','DOCUMENTO','NUM_PEDIDO',$axnum_pedido);
				$axnum_operacion = get_row('CTA_COBRAR_PAGOS','NUM_TRANSF','NUM_PEDIDO',$axnum_pedido);
				$axfecha_pago = date('d-m-Y',strtotime(get_row('CTA_COBRAR_PAGOS','FECHA_PAGO','NUM_PEDIDO',$axnum_pedido)));

				//if($axbuscar_cliente==''){

					$axfecha_despacho_1 = get_row('PEDIDOS_CZ','FECHA_DESPACHO','NUM_PEDIDO',$axnum_pedido);
					$axdias =get_row('PEDIDOS_CZ','DIAS_CREDITO','NUM_PEDIDO',$axnum_pedido);
					$axfecha_pedido =get_row('PEDIDOS_CZ','FECHA_PEDIDO','NUM_PEDIDO',$axnum_pedido);
					$axfecha = date('d-m-Y', strtotime($axfecha_despacho_1 . ' + ' . $axdias . ' days'));

				//}else{
				//	$axfecha = date('d-m-Y',strtotime($fila['FECHA_PAGO']));									
				//}

				
				$axmonto_pedido_1 = get_row('PEDIDOS_CZ','TOTAL_PEDIDO','NUM_PEDIDO',$axnum_pedido);					
				$axcondicion_1 = get_row('PEDIDOS_CZ','FORMA_PAGO','NUM_PEDIDO',$axnum_pedido);	
				$axdias_pago = get_row('PEDIDOS_CZ','DIAS_CREDITO','NUM_PEDIDO',$axnum_pedido);	
				$axmonto_pedido = number_format($axmonto_pedido_1,2,".",",");  
				$axnum_despacho=get_row('PEDIDOS_CZ','NUM_DESPACHO','NUM_PEDIDO',$axnum_pedido);				
				
				if($axfiltro_busquedas=='VENDEDOR' || $axfiltro_busquedas=='CLIENTE'){
					$axmonto_pagado_1 = number_format($fila['PAGADO'],2,".",",");  
					$axsaldo_1 = $axmonto_pedido_1-$fila['PAGADO'];					
				}else{
					$axmonto_pagado_1 = number_format($fila['MONTO_PAGADO'],2,".",",");  
					$axsaldo_1 = $axmonto_pedido_1-$fila['MONTO_PAGADO'];
				}

				//
				

			//	echo $axmonto_pedido_1.'<br>'.$axmonto_pagado_1.'<br>'; 
				

				
				$axsaldo = number_format($axsaldo_1,2,".",",");  ;

				if($axcondicion_1=='CREDITO'){
					$axcondicion = $axcondicion_1.' '.$axdias_pago;
				}else{
					$axcondicion=$axcondicion_1;
				}

					echo "<tr>
					<td style='text-align: center;' >$it</td>								
					<td style='text-align: left;' >$axcliente</td>
					<td style='text-align: left;' >$axfecha</td>
					<td style='text-align: center;' >$axcondicion</td>						
					<!--td style='text-align: center;' >$axnum_pedido</td-->			
					<td style='text-align: center;' >
						<a href='#' style='text-decoration:none;' title='Click para Cancelar Pedido...' data-bs-toggle='modal' data-bs-target='#mdl_cancelar_pedido' id='btn_agregar_pago_1' data-ndespacho='$axnum_despacho' data-saldo='$axsaldo_1' data-estadopago='$axestado_forma_pago' data-atencion='$axestado_atendido' data-idcliente='$axid_beneficiario' data-numpedido='$axnum_pedido'>".$axnum_pedido."</a>

						</td>			
					


					<td style='text-align: center;' >$axnum_despacho</td>			
					<td style='text-align: center;' >$axcomprobante</td>					
					<td style='text-align: center;' >$axnum_operacion</td>			
					<td style='text-align: center;' >$axfecha_pago</td>			
					<td style='text-align: right;' >$axmonto_pedido</td>			
					<td style='text-align: right;' >$axmonto_pagado_1</td>";

					if($axsaldo > 0){
						echo "<td style='text-align: right;' class='table-danger'>$axsaldo</td>";	
					}else{
						echo "<td style='text-align: right;'>$axsaldo</td>";
					}
					
				echo "
				</tr>";	
			}
		}		


}elseif($axpaneles=='1'){ // ADELANTOS


if($axbuscar_cliente==''){

		$SQLListar = "SELECT * FROM PEDIDOS_ADELANTADOS WHERE ESTADO_PAGO_PEDIDO = 'ADELANTO' ORDER BY FECHA_PEDIDO DESC";
	
}else{		

		if($axfiltro_busquedas=='FECHA PAGO'){
				$SQLListar = "SELECT  * FROM PEDIDOS_ADELANTADOS WHERE ESTADO_PAGO_PEDIDO = 'ADELANTO' AND FECHA_PAGO = '$axfecha_pago' order by FECHA_PAGO ASC";		
			}elseif($axfiltro_busquedas=='VENDEDOR'){
				$SQLListar = "SELECT  * FROM PEDIDOS_ADELANTADOS WHERE ESTADO_PAGO_PEDIDO = 'ADELANTO' AND VENDEDOR like '%".$axbuscar_cliente."%' order by VENDEDOR ASC";		
			}elseif($axfiltro_busquedas=='CLIENTE'){
				$SQLListar = "SELECT  * FROM PEDIDOS_ADELANTADOS WHERE ESTADO_PAGO_PEDIDO = 'ADELANTO' AND NOM_COMERCIAL like '%".$axbuscar_cliente."%' order by NOM_COMERCIAL ASC";		
			}elseif($axfiltro_busquedas=='NUM PEDIDO'){
				$SQLListar = "SELECT  * FROM PEDIDOS_ADELANTADOS WHERE ESTADO_PAGO_PEDIDO = 'ADELANTO' AND NUM_PEDIDO = '$axbuscar_cliente' order by NUM_PEDIDO ASC";		

			}
	
}

//echo "$SQLBuscar";

	echo "

		<table class='table table-hover table-sm'>
		<thead class='table-danger'>			
		<tr>
			<th style='text-align: center;'>It</th>					
			<th class='ocultar' style='text-align: center;'>Almacén</th>				
			<th class='ocultar' style='text-align: center;'>Vendedor</th>			
			<th class='ocultar' style='text-align: center; '>Fecha</th>			
			<th style='text-align: left;'>Cliente</th>			
			<th style='text-align: right;'>Total Pedido</th>
			<th style='text-align: right;'>Monto Adelanto</th>										
			<th style='text-align: center;'>Estado Atención</th>		

		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLListar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$axnum_pedido = $fila['NUM_PEDIDO'];
 		$axvendedor = $fila['VENDEDOR'];
 		$axiduser = $fila['ID_USUARIO'];
		$axcod_interno = $fila['COD_INTERNO'];		
		$axruc_cliente = $fila['RUC_BENEF'];
		$razon_social = $axruc_cliente.' | '.$fila['RAZON_SOCIAL'];
		

		$axestado_pago_pedido = $fila['ESTADO_PAGO_PEDIDO'];

		$axtotalpedido =number_format($fila["TOTAL_PEDIDO"],2,".",","); 
		$axadelanto_1 = get_row_two('CTA_COBRAR_PAGOS','MONTO_PAGADO','NUM_PEDIDO','ESTADO_PAGO_PEDIDO',$axnum_pedido,$axestado_pago_pedido);

		$axadelanto=number_format($axadelanto_1,2,".",","); 
		


		$domic_entrega_pred = $fila['DIRECCION_ENTREGA'];
		$axestado_atendido = $fila['ESTADO_ATENDIDO'];
		$id_beneficiario= $fila['ID_BENEFICIARIO'];
		$axnom_beneficiario= $fila['NOM_COMERCIAL'];
		$axfecha_pedido= date('d-m-Y',strtotime($fila['FECHA_PEDIDO']));
		$axid_local_nombre = $fila['LOCAL_CORTO'];
		$axnum_despacho = $fila['NUM_DESPACHO'];
		$axid_agencia= $fila['ID_AGENCIA'];
		$axid_td= $fila['ID_TD'];
		$axid_doc= $fila['ID_DOC'];

		$axcomprobante = get_row('MAESTRO_CZ','DOCUMENTO','NUM_PEDIDO',$axnum_pedido);
		//echo $axcomprobante;


		//echo $id_beneficiario;

	echo "<tr>";

			echo "<td style='text-align: center;'>$it</td>
						<td style='text-align: center;'>$axid_local_nombre</td> 
						<td style='text-align: center;'>$axvendedor</td> 					
						<td style='text-align: center;'>$axfecha_pedido</td>
 					  <td style='text-align: left;'>$axnum_pedido | $razon_social<br>$domic_entrega_pred | <a href='#' style='text-decoration:none;'><b class='text-danger'>$axestado_pago_pedido</b></a></td> 					  
 					  <td style='text-align: right;'>$axtotalpedido</td>
 					  <td style='text-align: right;'>$axadelanto</td>
 					  <td style='text-align: center;'>$axestado_atendido</td>";

		echo "</tr>	";

}
echo "</table>";
}else{
	echo "";
}




	}elseif($axpaneles=='2'){	

	}
/*
	
		while ($fila = odbc_fetch_array($RSListar)) {

				if($axbuscar_cliente==''){
					$SQLDeuda = "SELECT SUM(TOTAL_PEDIDO) AS DEUDA FROM PEDIDOS_CZ WHERE ESTADO_FORMA_PAGO='PENDIENTE' AND ESTADO_ATENDIDO='ATENDIDO'";

				}else{

							$SQLTotales = "SELECT SUM(TOTAL_PEDIDO) AS FACTURADO, (SELECT SUM(MONTO_PAGADO) AS PAGADO FROM CTA_COBRAR_1 WHERE NOM_COMERCIAL like '%".$axbuscar_cliente."%') AS PAGADO FROM CTAS_COBRAR_VENDEDORES_CLIENTE WHERE NOM_COMERCIAL like '%".$axbuscar_cliente."%'";
							$RSTotal = odbc_exec($con,$SQLTotales);
							//echo $SQLTotales;
							$fila = odbc_fetch_array($RSTotal);

							$axfacturado_1 = $fila['FACTURADO'];
							$axpagado_1 = $fila['PAGADO'];
							$axdeura_1 = $axfacturado_1-$axpagado_1;


							$axfacturado = number_format($axfacturado_1,2,".",",");  
							$axpagado = number_format($axpagado_1,2,".",",");  
							$axdeura =  number_format($axdeura_1,2,".",",");  

							echo "<tr>
								<td class='table-danger' style='text-align: right;' colspan='2'><b>Total Facturado</b></td>
								<td class='table-danger' style='text-align: center;' ><b>$axfacturado</b></td>
								<td class='table-success' style='text-align: right;'><b>Total Pagado</b></td>
								<td class='table-success' style='text-align: right;' ><b>$axpagado</b></td>								
								<td class='table-primary' style='text-align: center;' ><b>$axdeura</b></td>
							</tr>";

				}

	echo "</table>";		

}
*/
break;

case '188':
		
		$axnum_pedido = $_POST['txtnum_pedido']; 		
		$axtipo_venta = $_POST['txttipo_venta']; 		

		if($axtipo_venta=='VENTA'){
			$SQLActualizar = "UPDATE PEDIDOS SET TIPO_VENTA='PRE VENTA' WHERE NUM_PEDIDO='$axnum_pedido'";			
		}else{
			$SQLActualizar = "UPDATE PEDIDOS SET TIPO_VENTA='VENTA' WHERE NUM_PEDIDO='$axnum_pedido'";			
		}

		$RSActualizar = odbc_exec($con,$SQLActualizar);

		if($RSActualizar){

			$respuesta=0;
			echo $respuesta;

		}else{

			$respuesta=1;
			echo $respuesta;
		}

break;

case '189':
	
$axperiodo_inventario = $_POST['txtperiodo_inventario']; 		
$axfecha_del = $_POST['txtfecha_del']; 		
$axfecha_al = $_POST['txtfecha_al']; 		
$axtitulo_enviado = 'Fecha del: '. date('d-m-Y',strtotime($axfecha_del)).' al '.date('d-m-Y',strtotime($axfecha_al));

$SQLEliminar = "DELETE FROM RESUMEN_VENTAS_PERIODO";
$RSEliminar = odbc_exec($con,$SQLEliminar);

$sqlpedidos_vendedores = "SELECT ID_USUARIO,VENDEDOR FROM PEDIDOS_CZ WHERE FECHA_PEDIDO  BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP by ID_USUARIO,VENDEDOR";
$rspedidos_vendedores = odbc_exec($con,$sqlpedidos_vendedores);
//echo $rspedidos_vendedores;


if(odbc_num_rows($rspedidos_vendedores) > 0){

	while ($fila_vendedor=odbc_fetch_array($rspedidos_vendedores)) {
		
		$axid_vendedor = $fila_vendedor['ID_USUARIO'];
		$axvendedor = $fila_vendedor['VENDEDOR'];
	
		/***AGRUPO TODOS PRODUCTOS UTILIZADOS EN LOS PEDIDOS SEGUN EL RANGO DE FECHA***/

		$SQLBuscar_productos_2 ="SELECT ID_PRODUCTO FROM PEDIDOS WHERE FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al' AND TIPO_VENTA='VENTA' AND ID_USUARIO='$axid_vendedor' GROUP BY ID_PRODUCTO";	
		$RSBuscar_productos_2 = odbc_exec($con,$SQLBuscar_productos_2);

		if(odbc_num_rows($RSBuscar_productos_2) > 0){
	
			while ($row = odbc_fetch_array($RSBuscar_productos_2)) {
	
				$axid_producto_p1 = $row['ID_PRODUCTO'];
				
				$SQLVerifica_1 = "SELECT SUM(CANT_SALIDA) AS CANT, SUM(TOTAL_SALIDA) AS TOTAL,SUM(TOTAL_SALIDA)/SUM(CANT_SALIDA) AS PRC_VENTA_PROM,AVG(PRS_VENTA) AS PRS_VENDIDO,AVG(COSTO_PRODUCTO) AS PRS_COMPRA FROM PEDIDOS WHERE ID_PRODUCTO='$axid_producto_p1' AND FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al'  AND TIPO_VENTA='VENTA' AND ID_USUARIO='$axid_vendedor'";
				$RSVerifica_1 = odbc_exec($con,$SQLVerifica_1);
				//echo $SQLVerifica_1.'<br>';

				while ($fila_p = odbc_fetch_array($RSVerifica_1)) {			
				
					$axid_producto = $axid_producto_p1;
					$axdetalle_movimiento = 'VENTA';
					$axcod_producto = get_row('PRODUCTOS','COD_PRODUCTO','ID_PRODUCTO',$axid_producto);
					$axfamilia = get_row('PRODUCTOS_LISTADO','FAMILIA','ID_PRODUCTO',$axid_producto);

					$axprecio_venta = $fila_p['PRS_VENDIDO'];									
					$axcosto_compra = $fila_p['PRS_COMPRA'];				
					$axcantidad = $fila_p['CANT'];
					$axprs_prom_venta = $fila_p['PRC_VENTA_PROM'];	

					//echo'PRS. VENTA PROMEDIO '.$axprs_prom_venta.' CANTIDAD '.$axcantidad.'<br>'.

					$axmonto_soles = $axprs_prom_venta*$axcantidad;	
					//echo $axmonto_soles.'<br>';

					//echo'PRS. COMPRA PROMEDIO '.$axcosto_compra.' CANTIDAD '.$axcantidad.'<br>'.
					$axcosto =$axcantidad*$axcosto_compra;
					//echo $axcosto.'<br>';

					$axutilidad = $axmonto_soles-$axcosto;
					//echo $axutilidad.'| '.$axmonto_soles.'<br>';

					if($axutilidad > 0){
						$axmargen =$axutilidad/$axmonto_soles;	
					}else{
						$axmargen =0;
					}
					//echo $axmargen.'<br>';
					$axproveedor = get_row('PRODUCTOS_PROVEEDORES','PROVEEDOR','ID_PRODUCTO',$axid_producto);
		
					$sqlinserta_5 = "INSERT INTO RESUMEN_VENTAS_PERIODO (ID_VENDEDOR,VENDEDOR,PERIODO_REPORTE,ID_PRODUCTO,PRECIO_VENTA,COSTO_COMPRA,CANTIDAD,MONTO_SOLES,PRC_PROM_VENTA,POR_MARGEN,UTILIDAD_SOLES,COD_PRODUCTO,FAMILIA,PROVEEDOR,MONTO_COSTO) VALUES ('$axid_vendedor','$axvendedor','$axperiodo_inventario','$axid_producto','$axprecio_venta','$axcosto_compra','$axcantidad','$axmonto_soles','$axprs_prom_venta','$axmargen','$axutilidad','$axcod_producto','$axfamilia','$axproveedor','$axcosto')";
					$rsinserta_5 = odbc_exec($con,$sqlinserta_5);
				//echo $sqlinserta_5.'<br>';

				}
			}
		}
	}
}

break;

case '190':

$axperiodo_inventario = $_POST['txtperiodo_inventario']; 		

$SQLListar = "SELECT * FROM RESUMEN_VENTAS_PERIODO WHERE PERIODO_REPORTE='$axperiodo_inventario' ORDER BY VENDEDOR ASC";
$RSListar = odbc_exec($con,$SQLListar);

if(odbc_num_rows($RSListar) > 0){



	echo "

	<div style='margin-top:5px; padding:5px; text-align: right;'>
		<a href='exportar_excel.php?param=6&periodo=$axperiodo_inventario&titulo=$axtitulo'  class='btn btn-outline-success btn-sm' ><b> <i class='bi bi-file-earmark-excel-fill'></i> Excel</b></a>
		</div>
		

		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th class='ocultar' style='text-align: center;'>Vendedor</th>
			<th class='ocultar' style='text-align: left;'>Proveedor</th>
			<th class='ocultar' style='text-align: left;'>Familia</th>
			<th class='ocultar' style='text-align: center;'>Código</th>
			<th style='text-align: left;'>Descripción</th>
			<th style='text-align: right;'>Precios</th>
			<th style='text-align: right;'>Costo</th>
			<th style='text-align: right;'>Unid</th>
			<th style='text-align: right;'>Soles</th>
			<th style='text-align: right;'>Prc.Prom. Venta</th>
			<th style='text-align: right;'>Total Costo</th>
			<th style='text-align: right;'>% Margen</th>
			<th style='text-align: right;'>Util. Soles</th>
		</tr>
		</thead>";

		while ($fila_p=odbc_fetch_array($RSListar)){ 
	 		
	 				$axid_producto = $fila_p['ID_PRODUCTO'];														
					$axproveedor = $fila_p['PROVEEDOR'];									
					$axvendedor = $fila_p['VENDEDOR'];									
					$axid_vendedor = $fila_p['ID_VENDEDOR'];									
					$axfamilia = $fila_p['FAMILIA'];
					$axcod_producto = $fila_p['COD_PRODUCTO'];														
					$axdescripcion = get_row('PRODUCTOS','NOM_PRODUCTO','ID_PRODUCTO',$axid_producto);

					$axprecio_venta = $fila_p['PRECIO_VENTA'];									
					$axcosto_compra = $fila_p['COSTO_COMPRA'];				
					$axcantidad = $fila_p['CANTIDAD'];
					$axprs_prom_venta = $fila_p['PRC_PROM_VENTA'];	

					$axmonto_soles = $fila_p['MONTO_SOLES'];					
					$axcosto =$fila_p['MONTO_COSTO'];					
					$axutilidad = $fila_p['UTILIDAD_SOLES'];					
					$axmargen =$fila_p['POR_MARGEN'];				

					$axdato = $axcod_producto.' | '.$axdescripcion;

 	echo "
 		<tr> 		
 			<td style='text-align: center;'>".$axvendedor."</td> 
 			<td style='text-align: left;'>".$axproveedor."</td> 
 			<td style='text-align: left;'>".$axfamilia."</td> 
 			<td style='text-align: center;'>".$axcod_producto."</td> 
 			<td style='text-align: left;'>".$axdescripcion."</td>
 			<td style='text-align: right;'>".$axprecio_venta."</td>
 			<td style='text-align: right;'>".$axcosto_compra."</td>
 			<td style='text-align: right;'>
 			
 			<a href='#' style='text-decoration:none;'id='btn_ver_detalle_venta' data-id='$axid_producto' data-tt='$axdato' data-idvendedor='$axid_vendedor' data-bs-toggle='modal' data-bs-target='#exampleModal_pagos_rendicion'>".$axcantidad."</a>

 			</td>
 			<td style='text-align: right;'>".$axmonto_soles."</td>
 			<td style='text-align: right;'>".$axprs_prom_venta."</td>
 			<td style='text-align: right;'>".$axcosto."</td>
 			<td style='text-align: right;'>".$axmargen."</td>
 			<td style='text-align: right;'>".$axutilidad."</td>
 		</tr>";

	}

	echo "</table>";

}

break;

case '191':


$axid_producto =$_POST['txtid_producto'];
$axfecha_del =$_POST['txtfecha_del'];
$axfecha_al =$_POST['txtfecha_al'];
$axtipo_venta =$_POST['txttipo_venta'];
$axid_vendedor =$_POST['txtid_vendedor'];


$SQLBuscar = "SELECT * FROM PEDIDOS WHERE ID_PRODUCTO='$axid_producto' AND FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al'  AND TIPO_VENTA='VENTA' AND ID_USUARIO='$axid_vendedor'";
$RSBuscar = odbc_exec($con,$SQLVerifica_1);

//echo $SQLBuscar;

echo "
		<div id='div3'>
		<!--div style='margin-top:5px; padding:5px; text-align: right;'>
		<a href='exportar_excel.php?param=2&local=$axid_local&del=$axfecha_del&al=$axfecha_al&filtro=$axtipo_venta&id_producto=$axid_producto' class='btn btn-outline-danger btn-sm' ><b> <i class='bi bi-file-earmark-excel-fill'></i> Excel</b></a>
		</div-->
		
		
		<table class='table table-hover table-sm'>
		<thead class='table-success'>			
		<tr>
	
			<th style='text-align: center;'>Fecha</th>		
			<th style='text-align: center;'>Num Pedido</th>						
			<th style='text-align: left;'>Cliente</th>						
			<th class='table-success' style='text-align: right;'>Cant. Venta</th>
			<th class='table-primary' style='text-align: right;'>Precio Venta</th>			
			<th class='table-primary' style='text-align: right;'>Total Venta</th>			
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);		
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		
 		$it= $it+1; 		
 		$axfecha = date('d-m-Y', strtotime($fila['FECHA_PEDIDO']));		
 		$axnum_pedido = $fila['NUM_PEDIDO']; 		
 		$axid_beneficiario = $fila['ID_BENEFICIARIO'];
 		$axcod_producto = get_row('PRODUCTOS','COD_PRODUCTO','ID_PRODUCTO',$axid_producto);		
		$axcliente = get_row('BENEFICIARIOS','NOM_COMERCIAL','ID_BENEFICIARIO',$axid_beneficiario);
		
		$axingreso = number_format($fila["TOTAL_SALIDA"],2,".",","); 
		$axsalida = number_format($fila["CANT_SALIDA"],2,".",","); 		
		$axcosto = number_format($fila["COSTO_PRODUCTO"],2,".",","); 
		$axprecio = number_format($fila["PRS_VENTA"],2,".",","); 
		$axtotal_pedido = number_format($fila["TOTAL_SALIDA"],2,".",","); 

 	echo "
 		<tr>
 			<td style='text-align: center;'>".$axfecha."</td>  	
 			<td style='text-align: center;'>".$axnum_pedido."</td>  			 			
 			<td style='text-align: left;'>".$axcliente."</td> 
 			<td class='text-success' style='text-align: right;'><b>".$axsalida."</b></td>
 			<td class='text-primary' style='text-align: right;'><b>".$axprecio."</b></td> 	 			
 			<td class='text-primary' style='text-align: right;'><b>".$axtotal_pedido."</b></td> 	 			
 			
 		</tr>";
 	
 	}


$SQLBuscar_T ="SELECT SUM(TOTAL_SALIDA) AS TT, SUM(CANT_SALIDA) AS TS FROM PEDIDOS WHERE ID_PRODUCTO='$axid_producto' AND FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al'  AND TIPO_VENTA='VENTA' AND ID_USUARIO='$axid_vendedor'";

$rsBuscar_TT = odbc_exec($con,$SQLBuscar_T);
$fila_t = odbc_fetch_array($rsBuscar_TT);

$axtotal_cantidad = number_format($fila_t["TS"],2,".",","); 
$axtotal_salida = number_format($fila_t["TT"],2,".",","); 

$axprs_promedio_1 =$fila_t["TT"]/$fila_t["TS"];

$axprs_promedio = number_format($axprs_promedio_1,2,".",","); 

echo "
 		<tr> 			
 			<th class='text-success' style='text-align: right;' colspan='3'><b>Total Vendido</b></th>  	
 			<th class='text-success' style='text-align: right;'><b>".$axtotal_cantidad."</b></th>  		
 			<th class='text-success' style='text-align: center;' ></th>  	
 			<th class='text-success' style='text-align: right;'><b>".$axtotal_salida."</b></th>  		
 		</tr>

 		<tr> 			
 			<th class='text-danger' style='text-align: right;' colspan='4'><b>Precio Promedio</b></th>  	
 			<th class='text-danger' style='text-align: right;'><b>".$axprs_promedio."</b></th>  		
 			
 		</tr>";

	echo "</table>




	</div>";
	}

break;

case '193':


	
	$axid_agencia_nueva =$_POST['txtid_agencia_nueva'];
	$axnum_pedido =$_POST['txtnum_pedido'];
	$axid_local =$_POST['txtid_local'];

	$SQLActualizar = "UPDATE PEDIDOS SET ID_AGENCIA='$axid_agencia_nueva' WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
	$RSActualizar = odbc_exec($con,$SQLActualizar);
	//echo $SQLActualizar;

	if($RSActualizar){

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;
	}


break;

case '194':
	
	$axcod_mov_cz = $_POST['txtcod_mov_cz']; 		

	$axid_usuario = $_POST['txtid_usuario']; 		
	$axnom_modulo = $_POST['txtnom_modulo']; 
	
	/**Para eliminar el COMPROBANTE este no debe estar en SUNAT, EL PEDIDO pasa a estado REVISION, se elimina el COMPROBANTE Y la GUIA REMISION hay que ANULAR EN SUNAT **/

	$axnum_pedido = get_row('MAESTRO_CZ','NUM_PEDIDO','COD_MOV',$axcod_mov_cz);
	$axid_local = get_row('MAESTRO_CZ','ID_LOCAL','COD_MOV',$axcod_mov_cz);

	$axcod_guia_cz = get_row('MAESTRO_CZ','COD_GUIA_CZ','COD_MOV',$axcod_mov_cz);
	$axcomprobante = get_row('MAESTRO_CZ','TXT_SERIE','COD_MOV',$axcod_mov_cz).'-'.get_row('MAESTRO_CZ','DOCUMENTO','COD_MOV',$axcod_mov_cz);
	$axestado_final = 'ELIMINO | '.$axcomprobante;

	$axdetalle = $_POST['axdetalle'].' '.$axcomprobante; 

	$SQLActualizar_pedidos = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='REVISION' WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
	$RSActualizar_pedidos = odbc_exec($con,$SQLActualizar_pedidos);

	if($RSActualizar_pedidos){

		$SQLEliminar_comprobante_DT = "DELETE FROM MAESTRO_DT WHERE COD_MOV='$axcod_mov_cz'";
		$RSActualizar_pedidos_DT = odbc_exec($con,$SQLEliminar_comprobante_DT);

		$SQLEliminar_comprobante_CZ = "DELETE FROM MAESTRO_CZ  WHERE COD_MOV='$axcod_mov_cz'";
		$RSActualizar_pedidos_CZ = odbc_exec($con,$SQLEliminar_comprobante_CZ);

		$SQLGuias = "UPDATE GUIA_REMISION_CZ SET ESTADO_FINAL='$axestado_final' WHERE COD_GUIA_CZ='$axcod_guia_cz'";
		$RSpedidos = odbc_exec($con,$SQLGuias);

		guardar_bitacora($axid_usuario,$axnom_modulo,$axdetalle);

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;

	}


break;

case '195':
	
$axiduser = $_POST['txtcodusuario']; 	
	$axpermiso = $_POST['axpermiso']; 
	

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

case '196':

$axnum_pedido =$_POST['txtnum_pedido'];
$axnum_despacho =$_POST['txtnum_despacho'];


$axid_beneficiario =get_row('PEDIDOS','ID_BENEFICIARIO','NUM_PEDIDO',$axnum_pedido);
$axsaldo_pendiente =get_row('PEDIDOS','TOTAL_PEDIDO','NUM_PEDIDO',$axnum_pedido);

$axfecha_pago =date('Y-m-d');
$axperiodo_transf = date('m-Y',strtotime($axfecha_pago));

$axmedio_pago ='';
$axnum_transf ='';
$axid_cta =1;
$axmonto_pagado =0;

$axestado_forma_pago ='PENDIENTE';

$axfecha_liquidacion = $_POST['txtfecha_liquidacion'];
$axuser_encargado = $_POST['txtuser_encargado'];
$axestado_liquidacion = $_POST['txtestado_liquidacion'];
$axrecibido_por = $_POST['txtrecibido_por'];

	$SQLGrabar = "INSERT INTO CTA_COBRAR_PAGOS (ID_BENEFICIARIO,FECHA_PAGO,MONTO_PAGADO,NUM_PEDIDO,NUM_DESPACHO,SALDO_PENDIENTE,NUM_TRANSF,ID_CTA,ESTADO_FORMA_PAGO,MEDIO_PAGO,PERIODO_TRANSF,FECHA_LIQUIDACION,RESPONSABLE_LIQUIDAR,ESTADO_LIQUIDACION,RECIBIDO_POR) VALUES ('$axid_beneficiario','$axfecha_pago','$axmonto_pagado','$axnum_pedido','$axnum_despacho','$axsaldo_pendiente','$axnum_transf','$axid_cta','$axestado_forma_pago','$axmedio_pago','$axperiodo_transf','$axfecha_liquidacion','$axuser_encargado','$axestado_liquidacion','$axrecibido_por')";

//echo $SQLGrabar;

$rsgrabar = odbc_exec($con,$SQLGrabar);

if($rsgrabar){
	$axmonto_pedido = get_row('PEDIDOS_CZ','TOTAL_PEDIDO','NUM_PEDIDO',$axnum_pedido);
	$axpagado = get_row('PEDIDOS_PAGADOS_TOTAL','MONTO_PAGADO','NUM_PEDIDO',$axnum_pedido);

	//echo $axmonto_pedido.'|'.$axpagado;
	
	if(intval($axmonto_pedido) == intval($axpagado)){
		$SQLActualizar_pedidos = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='ATENDIDO',ESTADO_FORMA_PAGO='CANCELADO' WHERE NUM_PEDIDO='$axnum_pedido'";
		$SQLActualizar_cxc = "UPDATE CTA_COBRAR_PAGOS SET ESTADO_FORMA_PAGO='CANCELADO' WHERE NUM_PEDIDO='$axnum_pedido'";
	
	}elseif(intval($axpagado) < intval($axmonto_pedido)){
			$SQLActualizar_pedidos = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='ATENDIDO',ESTADO_FORMA_PAGO='PENDIENTE' WHERE NUM_PEDIDO='$axnum_pedido'";
			$SQLActualizar_cxc = "UPDATE CTA_COBRAR_PAGOS SET ESTADO_FORMA_PAGO='PENDIENTE' WHERE NUM_PEDIDO='$axnum_pedido'";

	}elseif(intval($axpagado) == 0){
		$SQLActualizar_pedidos = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='PROGRAMADO',ESTADO_FORMA_PAGO='PENDIENTE' WHERE NUM_PEDIDO='$axnum_pedido'";
	}

	$RSActualizar = odbc_exec($con,$SQLActualizar_pedidos);
	$RSActualizar_cxc = odbc_exec($con,$SQLActualizar_cxc);

	//echo $SQLActualizar_pedidos;

	$respuesta =0;
	echo $respuesta;

}else{

	$respuesta =1;
	echo $respuesta;

}

break;

case '197':
	
$axnum_pedido =$_POST['txtnum_pedido'];
$axid_usuario =$_POST['txtid_usuario'];


$axid_beneficiario = get_row('PEDIDOS','ID_BENEFICIARIO','NUM_PEDIDO',$axnum_pedido);
$axnum_despacho ='';
$axsaldo_pendiente =0;
$axfecha_pago =$_POST['txtfecha_pago'];
$axperiodo_transf = date('m-Y',strtotime($axfecha_pago));
$axmedio_pago =$_POST['txtmedio_pago'];
$axnum_transf =$_POST['txtnum_transf'];
$axid_cta =$_POST['txtid_cta'];
$axmonto_pagado =$_POST['txtmonto_pagado'];
$axestado_forma_pago =$_POST['txtestado_forma_pago'];

$axfecha_liquidacion = $_POST['txtfecha_pago'];;
$axuser_encargado = get_row('usuarios','NOM_USUARIO','ID_USUARIO',$axid_usuario);
$axestado_liquidacion = 'ABIERTA';
$axrecibido_por = $_POST['txtrecibido_por'];

$SQLGrabar = "INSERT INTO CTA_COBRAR_PAGOS (ID_BENEFICIARIO,FECHA_PAGO,MONTO_PAGADO,NUM_PEDIDO,NUM_DESPACHO,SALDO_PENDIENTE,NUM_TRANSF,ID_CTA,ESTADO_FORMA_PAGO,MEDIO_PAGO,PERIODO_TRANSF,FECHA_LIQUIDACION,RESPONSABLE_LIQUIDAR,ESTADO_LIQUIDACION,RECIBIDO_POR,ESTADO_PAGO_PEDIDO) VALUES ('$axid_beneficiario','$axfecha_pago','$axmonto_pagado','$axnum_pedido','$axnum_despacho','$axsaldo_pendiente','$axnum_transf','$axid_cta','$axestado_forma_pago','$axmedio_pago','$axperiodo_transf','$axfecha_liquidacion','$axuser_encargado','$axestado_liquidacion','$axrecibido_por','ADELANTO')";
	
//echo $SQLGrabar;

$rsgrabar = odbc_exec($con,$SQLGrabar);

if($rsgrabar){

	$axmonto_pedido = get_row('PEDIDOS_CZ','TOTAL_PEDIDO','NUM_PEDIDO',$axnum_pedido);
	$axpagado = get_row('PEDIDOS_PAGADOS_TOTAL','MONTO_PAGADO','NUM_PEDIDO',$axnum_pedido);

	//echo $axmonto_pedido.'|'.$axpagado;
	
	if(intval($axmonto_pedido) == intval($axpagado)){

		$SQLActualizar_pedidos = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='PENDIENTE',ESTADO_FORMA_PAGO='CANCELADO' ,ESTADO_PAGO_PEDIDO='ADELANTO' WHERE NUM_PEDIDO='$axnum_pedido'";
		$SQLActualizar_cxc = "UPDATE CTA_COBRAR_PAGOS SET ESTADO_FORMA_PAGO='CANCELADO' WHERE NUM_PEDIDO='$axnum_pedido'";
	
	}elseif(intval($axpagado) < intval($axmonto_pedido)){

			$SQLActualizar_pedidos = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='PENDIENTE',ESTADO_FORMA_PAGO='PENDIENTE',ESTADO_PAGO_PEDIDO='ADELANTO'  WHERE NUM_PEDIDO='$axnum_pedido'";
			$SQLActualizar_cxc = "UPDATE CTA_COBRAR_PAGOS SET ESTADO_FORMA_PAGO='PENDIENTE' WHERE NUM_PEDIDO='$axnum_pedido'";

	}elseif(intval($axpagado) == 0){

		$SQLActualizar_pedidos = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='PENDIENTE',ESTADO_FORMA_PAGO='PENDIENTE' ,ESTADO_PAGO_PEDIDO='ADELANTO' WHERE NUM_PEDIDO='$axnum_pedido'";
	}

	$RSActualizar = odbc_exec($con,$SQLActualizar_pedidos);
	$RSActualizar_cxc = odbc_exec($con,$SQLActualizar_cxc);

	//echo $SQLActualizar_pedidos;

	$respuesta =0;
	echo $respuesta;

}else{

	$respuesta =1;
	echo $respuesta;

}


break;

case '198':
	
$axbuscaregistro = $_POST['txtbuscar']; 	

	if($axbuscaregistro==""){
		$SQLBuscar = "SELECT * FROM CATEGORIAS  order by NOM_CATEGORIA ASC";
	}else{
		$SQLBuscar ="SELECT *  FROM CATEGORIAS WHERE NOM_CATEGORIA like '%".$axbuscaregistro."%' ";
	}

	//echo "$SQLBuscar";

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th class='ocultar' style='text-align: center;'>Item</th>
			<th class='ocultar' style='text-align: left;'>Categoria</th>
			<th class='ocultar' style='text-align: left;'>Familia</th>						
			<th style='text-align: center;'>Acción</th>
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 

 		$it= $it+1;
 		$id=$fila['ID_CATEGORIA'];
 		$axnom_categoria = $fila['NOM_CATEGORIA'];
		$axfamilia = $fila['FAMILIA'];
		
 	echo "
 		<tr> 		
 			<td style='text-align: center;'>".$it."</td> 
 			<td style='text-align: left;'>".$axnom_categoria."</td> 
 			<td style='text-align: left;'>".$axfamilia."</td>  			
 			
 			<td  style='text-align: center;'>
 				<div class='btn-group dropstart'>
					<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
					<ul class='dropdown-menu'>	
					<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-info' id='btn_editar_corr' data-id='$id' data-bs-toggle='modal' data-bs-target='#exampleModal'><b><i class='bi bi-pencil' ></i> Editar</a></b>
					<!--a href='#' class='dropdown-item text-danger' id='btn_eliminar_corr' data-id='$id' ><b><i class='bi bi-trash3-fill'></i> Eliminar</a></b-->					
					<div><hr class='dropdown-divider'></div>
					</ul>
				</div>
 			</td>";

}
echo "</table>";
}


break;

case '199':
	

$axid_categoria= $_POST['txtid_categoria'];
$sql6 = "SELECT * FROM CATEGORIAS WHERE ID_CATEGORIA='$axid_categoria'";
$result1=odbc_exec($con,$sql6);
//echo $sql6;

if(odbc_num_rows($result1) > 0) {
    
    $axlistaprov1 = odbc_fetch_object($result1);
    $axlistaprov1 ->status =200;
    echo json_encode($axlistaprov1);
      
}else{

  	$error = array('status'=> 400);
  	echo json_encode((object) $error);
}

break;

case '200':
	$axid_categoria= $_POST['txtid_categoria'];
	$axnom_categoria= $_POST['txtnom_categoria'];
	$axitipo_categoria= $_POST['txtitipo_categoria'];
	$axfamilia= $_POST['txtfamilia'];
	$axparametros= $_POST['txtparametros'];

	if($axparametros==0){

		$sqlinserta = "INSERT INTO CATEGORIAS (NOM_CATEGORIA,TIPO_CATEGORIA,FAMILIA) VALUES ('$axnom_categoria','$axitipo_categoria','$axfamilia')";

	}else{

		$sqlinserta = "UPDATE CATEGORIAS SET NOM_CATEGORIA='$axnom_categoria',TIPO_CATEGORIA='$axitipo_categoria',FAMILIA='$axfamilia' WHERE ID_CATEGORIA='$axid_categoria'";

	}

	$RSInsert = odbc_exec($con,$sqlinserta);

	if($RSInsert){

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;
	}


break;
case '201':
	

$axbuscaregistro = $_POST['txtbuscar']; 	

	if($axbuscaregistro==""){
		$SQLBuscar = "SELECT * FROM VEHICULOS_DESPACHOS  order by MARCA_VEHICULO ASC";
	}else{
		$SQLBuscar ="SELECT *  FROM VEHICULOS_DESPACHOS WHERE MARCA_VEHICULO+NUM_PLACA like '%".$axbuscaregistro."%' ";
	}

	//echo "$SQLBuscar";

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th class='ocultar' style='text-align: center;'>Item</th>
			<th class='ocultar' style='text-align: left;'>Vehiculo</th>
			<th class='ocultar' style='text-align: left;'>Placa</th>						
			<th style='text-align: center;'>Acción</th>
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		

 		$it= $it+1;
 		$id=$fila['ID_VEHICULO'];
 		$axvehiculo = $fila['MARCA_VEHICULO'];
		$axnum_placa = $fila['NUM_PLACA'];
		
 	echo "
 		<tr> 		
 			<td style='text-align: center;'>".$it."</td> 
 			<td style='text-align: left;'>".$axvehiculo."</td> 
 			<td style='text-align: left;'>".$axnum_placa."</td>  			
 			
 			<td  style='text-align: center;'>
 				<div class='btn-group dropstart'>
					<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
					<ul class='dropdown-menu'>	
					<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-info' id='btn_editar_corr' data-id='$id' data-bs-toggle='modal' data-bs-target='#exampleModal'><b><i class='bi bi-pencil' ></i> Editar</a></b>
					<!--a href='#' class='dropdown-item text-danger' id='btn_eliminar_corr' data-id='$id' ><b><i class='bi bi-trash3-fill'></i> Eliminar</a></b-->					
					<div><hr class='dropdown-divider'></div>
					</ul>
				</div>
 			</td>";

}
echo "</table>";
}

break;
case '202':
	
$axid_vehiculo= $_POST['txtid_vehiculo'];

$sql6 = "SELECT * FROM VEHICULOS_DESPACHOS WHERE ID_VEHICULO='$axid_vehiculo'";
$result1=odbc_exec($con,$sql6);
//echo $sql6;

if(odbc_num_rows($result1) > 0) {
    
    $axlistaprov1 = odbc_fetch_object($result1);
    $axlistaprov1 ->status =200;
    echo json_encode($axlistaprov1);
      
}else{

  	$error = array('status'=> 400);
  	echo json_encode((object) $error);
}

break;

case '203':
	
	$axid_vehiculo= $_POST['txtid_vehiculo'];
	$axnum_placa= $_POST['txtnum_placa'];
	$axmarca_vehiculo= $_POST['txtmarca_vehiculo'];	
	$axparametros= $_POST['txtparametros'];

	if($axparametros==0){

		$sqlinserta = "INSERT INTO VEHICULOS_DESPACHOS (NUM_PLACA,MARCA_VEHICULO) VALUES ('$axnum_placa','$axmarca_vehiculo')";

	}else{

		$sqlinserta = "UPDATE VEHICULOS_DESPACHOS SET NUM_PLACA='$axnum_placa',MARCA_VEHICULO='$axmarca_vehiculo' WHERE ID_VEHICULO='$axid_vehiculo'";

	}
 	
	
	$RSInsert = odbc_exec($con,$sqlinserta);

	if($RSInsert){

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;
	}


break;

case '204':
	
$axid_cta= $_POST['txtid_cta'];

$sql6 = "SELECT * FROM CUENTA_BANCARIAS WHERE ID_CTA='$axid_cta'";
$result1=odbc_exec($con,$sql6);
//echo $sql6;

if(odbc_num_rows($result1) > 0) {
    
    $axlistaprov1 = odbc_fetch_object($result1);
    $axlistaprov1 ->status =200;
    echo json_encode($axlistaprov1);
      
}else{

  	$error = array('status'=> 400);
  	echo json_encode((object) $error);
}


break;

case '205':
	
	$axid_local= $_POST['txtid_local'];
	$axid_cta= $_POST['txtid_cta'];
	$axnum_cuenta= $_POST['txtnum_cuenta'];	
	$axbanco_cuenta= $_POST['txtbanco_cuenta'];	
	$axmoneda_cuenta= $_POST['txtmoneda_cuenta'];	
	$axparametros= $_POST['txtparametros'];
	$fecha = date('Y-m-d');

	if($axparametros==0){

		$sqlinserta = "INSERT INTO CUENTA_BANCARIAS (NUM_CUENTA,BANCO_CUENTA,MONEDA_CTA,CCI_CUENTA,ID_LOCAL,FECHA_INICIO,FILTRO_TIPO) VALUES ('$axnum_cuenta','$axbanco_cuenta','$axmoneda_cuenta','$axnum_cuenta','$axid_local','$fecha','RECAUDAR')";

	}else{

		$sqlinserta = "UPDATE CUENTA_BANCARIAS SET NUM_CUENTA='$axnum_cuenta',BANCO_CUENTA='$axbanco_cuenta',MONEDA_CTA='$axmoneda_cuenta',CCI_CUENTA='$axnum_cuenta',ID_LOCAL='$axid_local',FECHA_INICIO='$fecha' WHERE ID_CTA='$axid_cta'";

	}

		
	
	$RSInsert = odbc_exec($con,$sqlinserta);

	if($RSInsert){

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;
	}



break;

case '206':
	

$axbuscaregistro = $_POST['txtbuscar']; 	
$axid_local = $_POST['txtid_local']; 	

	if($axbuscaregistro==""){
		$SQLBuscar = "SELECT * FROM CUENTA_BANCARIAS WHERE ID_LOCAL='$axid_local' order by NUM_CUENTA ASC";
	}else{
		$SQLBuscar ="SELECT *  FROM CUENTA_BANCARIAS WHERE ID_LOCAL='$axid_local' AND NUM_CUENTA+BANCO_CUENTA like '%".$axbuscaregistro."%' ";
	}


	//echo "$SQLBuscar";

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th class='ocultar' style='text-align: center;'>Item</th>
			<th class='ocultar' style='text-align: left;'>Número ò Nombre Cuenta</th>
			<th class='ocultar' style='text-align: left;'>Banco</th>						
			<th class='ocultar' style='text-align: center;'>Moneda</th>						
			<th style='text-align: center;'>Acción</th>
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){  		

 		$it= $it+1;
 		$id=$fila['ID_CTA'];
 		$axnum_cta = $fila['NUM_CUENTA'];
		$axbanco = $fila['BANCO_CUENTA'];
		$axmoneda = $fila['MONEDA_CTA'];
		
 	echo "
 		<tr> 		
 			<td style='text-align: center;'>".$it."</td> 
 			<td style='text-align: left;'>".$axnum_cta."</td> 
 			<td style='text-align: left;'>".$axbanco."</td>  			
 			<td style='text-align: center;'>".$axmoneda."</td>  			
 			
 			<td  style='text-align: center;'>
 				<div class='btn-group dropstart'>
					<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
					<ul class='dropdown-menu'>	
					<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-info' id='btn_editar_corr' data-id='$id' data-bs-toggle='modal' data-bs-target='#exampleModal'><b><i class='bi bi-pencil' ></i> Editar</a></b>
					<!--a href='#' class='dropdown-item text-danger' id='btn_eliminar_corr' data-id='$id' ><b><i class='bi bi-trash3-fill'></i> Eliminar</a></b-->					
					<div><hr class='dropdown-divider'></div>
					</ul>
				</div>
 			</td>";

}
echo "</table>";
}
break;

case '207':
	
$axnum_despacho = $_POST['txtnum_despacho']; 	
$axid_vehiculo_e = $_POST['txtid_vehiculo_e']; 	
$axnom_chofer_e = $_POST['txtnom_chofer_e']; 	
$axfecha_despacho_e = $_POST['txtfecha_despacho_e']; 	

$sqlactualizar ="UPDATE PEDIDOS SET ID_VEHICULO='$axid_vehiculo_e' , NOM_CHOFER='$axnom_chofer_e', FECHA_DESPACHO='$axfecha_despacho_e' WHERE NUM_DESPACHO='$axnum_despacho'";
$rsactualizar = odbc_exec($con,$sqlactualizar);
//echo $sqlactualizar;

if($rsactualizar){
	$respuesta =0;
	echo $respuesta;
}else{
	$respuesta =1;
	echo $respuesta;
}

break;

case '208':
	
	$SQLListar = "SELECT NOM_CATEGORIA FROM PRODUCTOS_LISTADO GROUP BY NOM_CATEGORIA  ORDER BY NOM_CATEGORIA ASC";
	$RSListar = odbc_exec($con,$SQLListar);


	if(odbc_num_rows($RSListar) > 0){

		echo "<table class='table table-hover table-sm'>
		<thead class='table-success'>			
		<tr>
			<th style='text-align: left;' >SUB FAMILIA</th>			
			<th style='text-align: left;' >CODIGO</th>			
			<th style='text-align: left;' >PRODUCTO</th>			
		</tr>
		</thead>";


		while ($fila = odbc_fetch_array($RSListar)) {
				
				$axsubfamilia = $fila['NOM_CATEGORIA'];
				echo "<tr>
					<td style='text-align: left;' colspan='3'><b>$axsubfamilia</b></td>			
				</tr>";		

			$SQLMostrar = "SELECT ID_PRODUCTO,NOM_CATEGORIA,COD_PRODUCTO,NOM_PRODUCTO FROM PRODUCTOS_LISTADO WHERE NOM_CATEGORIA='$axsubfamilia' ORDER BY NOM_CATEGORIA ASC";
			$RSMostrar = odbc_exec($con,$SQLMostrar);

			if(odbc_num_rows($RSMostrar) > 0){

				while($fila_m =odbc_fetch_array($RSMostrar)){

					$axcod = $fila_m['COD_PRODUCTO'];
					$id_producto = $fila_m['ID_PRODUCTO'];
					$axnom_producto = utf8_decode($fila_m['NOM_PRODUCTO']);

					$axcomplemento = get_row('PRODUCTOS_LISTADO_COMPLEMENTOS_CONTAR','CANT','ID_PRODUCTO',$id_producto);

					if($axcomplemento==''){
						$axtipo = '<b class="text-success">Hijo</b>';
					}else{
						$axtipo = '<b class="text-danger">Padre</b>';
					}

					echo "<tr>
					<td style='text-align: left;'>&#160 $axtipo</td>			
					<td style='text-align: left;'>$axcod</td>			
					<td style='text-align: left;'>$axnom_producto</td>			
					
				</tr>";	

				}
		}

}

}

break;

case '209':
	

$axnum_despacho =$_POST['txtnum_despacho'];
$axnum_pedido =$_POST['txtnum_pedido'];

$SQLBuscar ="SELECT * FROM CTA_COBRAR_PAGOS_REPORTE WHERE NUM_DESPACHO = '$axnum_despacho' AND NUM_PEDIDO='$axnum_pedido' ORDER BY MONTO_PAGADO,NUM_PEDIDO DESC"; 
//echo $SQLBuscar;

echo "
		<table class='table table-hover table-sm'>
		<thead class='table-success'>			
		<tr>
			<th style='text-align: center;'>Item</th>
			<th class='table-danger' style='text-align: left;'>Fecha Liquidar</th>
			<th style='text-align: left;'>Num. Pedido</th>
			<th style='text-align: left;'>Cliente</th>
			<th style='text-align: center;'>Fecha Pago</th>						
			<th style='text-align: center;'>Num. Operacion</th>						
			<th style='text-align: center;'>Medio Pago</th>									
			<th class='table-success' style='text-align: right;'>Pagado</th>									
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);		
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		
 		$it= $it+1;
 		$axid_pago=$fila['ID_PAGO'];
 		$axfecha = date('d-m-Y', strtotime($fila['FECHA_PAGO']));		
 		$axfecha_liquidacion 		= date('d-m-Y', strtotime($fila['FECHA_LIQUIDACION']));		
 		$axnum_pedido = $fila['NUM_PEDIDO'];
 		$axid_beneficiario = $fila['ID_BENEFICIARIO'];				
 		$axcliente = substr($fila['NOM_COMERCIAL'],0,30).'...';		
		$axpagado = number_format($fila["MONTO_PAGADO"],2,".",","); 		
		$axnum_transf = $fila['NUM_TRANSF'];		
		$axid_cta = $fila['ID_CTA'];	
		$axbanco = $fila['BANCO_CUENTA'];		
		$axmedio = $fila['MEDIO_PAGO'];		

		if($fila["MONTO_PAGADO"]==0){
		$axbanco = '';	
		$axmedio = '';
		$axnum_transf = '-';		
		}	
		

 	echo "
 		<tr> 		
 			<td style='text-align: center;'>".$it."</td> 
 			<td class='table-danger' style='text-align: left;'>".$axfecha_liquidacion."</td> 
 			<td style='text-align: left;'>".$axnum_pedido."</td> 
 			<td style='text-align: left;'>".$axcliente."</td> 
 			<td style='text-align: center;'>".$axfecha."</td> 
 			<td style='text-align: center;'>".$axnum_transf."</td>  						
 			<td style='text-align: center;'>".$axmedio.'-'.$axbanco."</td>  			 			
 			<td style='text-align: right;'>".$axpagado."</td>";
 		echo "</tr>";
 	
 	}

 	$SQLBuscar_tt ="SELECT sum(MONTO_PAGADO) as tt FROM CTA_COBRAR_PAGOS_REPORTE WHERE NUM_DESPACHO = '$axnum_despacho' AND NUM_PEDIDO='$axnum_pedido'"; 
 	$rsBuscar_tt = odbc_exec($con,$SQLBuscar_tt);
 	$fila = odbc_fetch_array($rsBuscar_tt);

 	$axtotal = $fila['tt'];

 	echo "<tr> 		
 			<th style='text-align: right;' colspan='8'>".number_format($axtotal,2,".",",")."</th> 
 			</tr>";

	echo "</table>";
	}else{
		echo "";
	}

break;

case '210':

$axid_pago =$_POST['txtid_pago'];
$axcodusuario =$_POST['txtcodusuario'];

$axnum_pedido =$_POST['txtnum_pedido'];
$axnum_despacho =$_POST['txtnum_despacho'];
$axid_beneficiario = get_row('PEDIDOS_CZ','ID_BENEFICIARIO','NUM_PEDIDO',$axnum_pedido);

$axsaldo_pendiente =$_POST['txtsaldo_pendiente'];
$axfecha_pago =$_POST['txtfecha_pago_actual'];
$axperiodo_transf = date('m-Y',strtotime($axfecha_pago));
$axmedio_pago =$_POST['txtmedio_pago'];
$axnum_transf =$_POST['txtnum_transf'];
$axid_cta =$_POST['txtid_cta'];
$axmonto_pagado =$_POST['txtmonto_pagado'];
$axestado_forma_pago =$_POST['txtestado_forma_pago'];

$axfecha_liquidacion = $_POST['txtfecha_pago'];
$axuser_encargado = get_row('usuarios','NOM_USUARIO','ID_USUARIO',$axcodusuario);
$axestado_liquidacion = 'ABIERTA';
$axrecibido_por = $_POST['txtrecibido_por'];

 if($axmonto_pagado==0){
 	$axmedio_pago ='';
	$axnum_transf ='';
	//$axid_cta ='0';
 }


$axparametros =$_POST['txtparametros'];



if($axparametros==0){

	$SQLGrabar = "INSERT INTO CTA_COBRAR_PAGOS (ID_BENEFICIARIO,FECHA_PAGO,MONTO_PAGADO,NUM_PEDIDO,NUM_DESPACHO,SALDO_PENDIENTE,NUM_TRANSF,ID_CTA,ESTADO_FORMA_PAGO,MEDIO_PAGO,PERIODO_TRANSF,FECHA_LIQUIDACION,RESPONSABLE_LIQUIDAR,ESTADO_LIQUIDACION,RECIBIDO_POR) VALUES ('$axid_beneficiario','$axfecha_pago','$axmonto_pagado','$axnum_pedido','$axnum_despacho','$axsaldo_pendiente','$axnum_transf','$axid_cta','$axestado_forma_pago','$axmedio_pago','$axperiodo_transf','$axfecha_liquidacion','$axuser_encargado','$axestado_liquidacion','$axrecibido_por')";
	

}else{

	 $SQLGrabar = "UPDATE CTA_COBRAR_PAGOS SET ID_BENEFICIARIO='$axid_beneficiario',FECHA_PAGO='$axfecha_pago',MONTO_PAGADO='$axmonto_pagado',NUM_PEDIDO='$axnum_pedido',NUM_DESPACHO='$axnum_despacho',SALDO_PENDIENTE='$axsaldo_pendiente',NUM_TRANSF='$axnum_transf',ID_CTA='$axid_cta',ESTADO_FORMA_PAGO='$axestado_forma_pago',MEDIO_PAGO='$axmedio_pago',PERIODO_TRANSF='$axperiodo_transf',FECHA_LIQUIDACION='$axfecha_liquidacion',RESPONSABLE_LIQUIDAR='$axuser_encargado',ESTADO_LIQUIDACION='$axestado_liquidacion',RECIBIDO_POR='$axrecibido_por' WHERE ID_PAGO='$axid_pago'";

}
//echo $SQLGrabar;


$rsgrabar = odbc_exec($con,$SQLGrabar);
if($rsgrabar){
	$axmonto_pedido = get_row('PEDIDOS_CZ','TOTAL_PEDIDO','NUM_PEDIDO',$axnum_pedido);
	$axpagado = get_row('PEDIDOS_PAGADOS_TOTAL','MONTO_PAGADO','NUM_PEDIDO',$axnum_pedido);

	//echo $axmonto_pedido.'|'.$axpagado;
	
	if(intval($axmonto_pedido) == intval($axpagado)){
		$SQLActualizar_pedidos = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='ATENDIDO',ESTADO_FORMA_PAGO='CANCELADO' WHERE NUM_PEDIDO='$axnum_pedido'";
		$SQLActualizar_cxc = "UPDATE CTA_COBRAR_PAGOS SET ESTADO_FORMA_PAGO='CANCELADO' WHERE NUM_PEDIDO='$axnum_pedido'";
	
	}elseif(intval($axpagado) < intval($axmonto_pedido)){
			$SQLActualizar_pedidos = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='ATENDIDO',ESTADO_FORMA_PAGO='PENDIENTE' WHERE NUM_PEDIDO='$axnum_pedido'";
			$SQLActualizar_cxc = "UPDATE CTA_COBRAR_PAGOS SET ESTADO_FORMA_PAGO='PENDIENTE' WHERE NUM_PEDIDO='$axnum_pedido'";

	}elseif(intval($axpagado) == 0){
		$SQLActualizar_pedidos = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='PROGRAMADO',ESTADO_FORMA_PAGO='PENDIENTE' WHERE NUM_PEDIDO='$axnum_pedido'";
	}

	$RSActualizar = odbc_exec($con,$SQLActualizar_pedidos);
	$RSActualizar_cxc = odbc_exec($con,$SQLActualizar_cxc);

	//echo $SQLActualizar_pedidos;

	$respuesta =0;
	echo $respuesta;

}else{

	$respuesta =1;
	echo $respuesta;

}	




break;

case '211':
	
	$axcod_mov_cz = $_POST['txtcod_mov_cz']; 		
	//$axnum_pedido = get_row('MAESTRO_CZ','NUM_PEDIDO','COD_MOV',$axcod_mov_cz);
	//$axid_local = get_row('MAESTRO_CZ','ID_LOCAL','COD_MOV',$axcod_mov_cz);

	//$axcod_guia_cz = get_row('MAESTRO_CZ','COD_GUIA_CZ','COD_MOV',$axcod_mov_cz);
	//$axcomprobante = get_row('MAESTRO_CZ','TXT_SERIE','COD_MOV',$axcod_mov_cz).'-'.get_row('MAESTRO_CZ','DOCUMENTO','COD_MOV',$axcod_mov_cz);
	//$axestado_final = 'RECHAZADA | '.$axcomprobante;

	//$SQLActualizar_pedidos = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='REVISION' WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
	//$RSActualizar_pedidos = odbc_exec($con,$SQLActualizar_pedidos);

	//if($RSActualizar_pedidos){

		$SQLActualizar_maestro = "UPDATE MAESTRO_CZ SET ESTADO_ELECTRO='RECHAZADA', ESTADO_INVENTARIO='RECHAZADA' WHERE COD_MOV='$axcod_mov_cz'";
		$RSActualizar_pedidos = odbc_exec($con,$SQLActualizar_maestro);

		//$SQLGuias = "UPDATE GUIA_REMISION_CZ SET ESTADO_FINAL='$axestado_final' WHERE COD_GUIA_CZ='$axcod_guia_cz'";
		//$RSpedidos = odbc_exec($con,$SQLGuias);
	if($RSActualizar_pedidos){

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;

	}

break;

case '212':
	

$axid_local = $_POST['txtid_local'];
$axbuscar = $_POST['txtbuscar'];
$axfecharegistro = $_POST['txtfecharegistro'];
$axfiltro = $_POST['txtfiltro'];
$axtipodoc_emitidos_estado = $_POST['txttipodoc_emitidos_estado'];

if($axfiltro=='B'){

	$SQLBuscar = "SELECT * FROM DOC_GUAS_EMITIDOS_NUEVO WHERE ID_LOCAL='$axid_local' AND CORRELATIVO+COMPROBANTE LIKE  '%".$axbuscar."%' ORDER BY CORRELATIVO DESC";	

}else if($axfiltro=='F'){

	$SQLBuscar = "SELECT * FROM DOC_GUAS_EMITIDOS_NUEVO WHERE ID_LOCAL='$axid_local' AND FECHA_EMISION='$axfecharegistro' ORDER BY CORRELATIVO DESC";

}else if($axfiltro=='E'){
	
	$SQLBuscar = "SELECT * FROM DOC_GUAS_EMITIDOS_NUEVO WHERE ID_LOCAL='$axid_local' AND ESTADO_ELECTRO='$axtipodoc_emitidos_estado' ORDER BY CORRELATIVO DESC";

}else{

	$SQLBuscar = "SELECT TOP 20 * FROM DOC_GUAS_EMITIDOS_NUEVO WHERE ID_LOCAL='$axid_local'  ORDER BY CORRELATIVO DESC";

}

//echo $SQLBuscar;

	$RSBuscar = odbc_exec($con,$SQLBuscar);

	if(odbc_num_rows($RSBuscar) > 0){
	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th style='text-align: center;'>Item</th>			
			<th style='text-align: center;'>Fecha Emisión</th>
			<th style='text-align: left;'>Cliente</th>
			<th style='text-align: left;'>Tipo</th>							
			<th style='text-align: center;'>Num. Guía</th>			
			<th style='text-align: center;'>Estado Sunat</th>						
			<th style='text-align: center;'>Num. Comprobante</th>						
			
			<th style='text-align: center;'>Acción</th>							
		</tr>
		</thead>";

		while ($fila = odbc_fetch_array($RSBuscar)) {
			
			$it=$it+1;
			$axcod_guia_cz = $fila['COD_GUIA_CZ'];	
			$axlocal = $fila['LOCAL_CORTO'];	
			$axid_vendedor = $fila['USUARIO'];	
			$axcliente = $fila['NOM_COMERCIAL'];	
			$axcorrelativo = $fila['CORRELATIVO'];				
			$axfecha_emision = date('d-m-Y',strtotime($fila['FECHA_EMISION']));	
			$axestado = $fila['ESTADO_ELECTRO'];	
			$axestado_comprobante = $fila['ESTADO_COMPROBANTE'];	
			$axmonto= number_format($fila['TOTAL_VENTA'],2,".",",");
			$axverif_guia= $fila['COD_GUIA_CZ'];	
			$axestado_final = $fila['ESTADO_FINAL'];
			$axarchivo_digital = $fila['BOUCHER_DIGITAL'];

			$axcod_mov_cz= $fila['COD_MOV'];

			$axnom_rzn_soc_prov = $fila['nom_rzn_soc_prov'];
			$axcod_mot_trasalado= $fila['cod_mot_trasalado'];
			$axcod_mov= $fila['COD_MOV'];

			$axcod_mot_trasalado = $fila['cod_mot_trasalado'];

			if($axcod_mot_trasalado=='01'){
				$axtipo = 'VENTA';
			}elseif($axcod_mot_trasalado=='02'){
				$axtipo = 'COMPRA';
			}elseif($axcod_mot_trasalado=='04'){
				$axtipo = 'TRASLADO';
			}
			

			if($axcod_mot_trasalado=='02'){
				$axcliente=$axnom_rzn_soc_prov;
			}else{

				$axcliente = $fila['NOM_COMERCIAL'];	
			}

			$axcomprobante = get_row('MAESTRO_CZ','TXT_SERIE','COD_MOV',$axcod_mov_cz).'-'.get_row('MAESTRO_CZ','DOCUMENTO','COD_MOV',$axcod_mov_cz);
			
		
		echo "
		<tr>
			<td style='text-align: center;'>$it</td>			
			<td style='text-align: center;'>$axfecha_emision</td>			
			<td style='text-align: left;'>$axcliente</td>		
			<td style='text-align: left;'>$axtipo</td>
			<td style='text-align: center;'>$axcorrelativo</td>";

			if($axestado=='PENDIENTE'){
				echo "<td style='text-align: center;'><a href='#' class='text-danger' style='text-decoration:none;' data-estado_ft='$axestado_comprobante' data-estado_g='$axestado' data-codguia='$axcod_guia_cz'><b>$axestado</b></a></td>";
			}elseif(($axestado=='RECHAZADA')){
				echo "<td style='text-align: center;'><a href='#' class='text-warning' style='text-decoration:none;' data-estado_ft='$axestado_comprobante' data-estado_g='$axestado' data-codguia='$axcod_guia_cz'><b>$axestado</b></a></td>";					
			}else{
				echo "<td style='text-align: center;'><a href='#' class='text-primary' style='text-decoration:none;' data-estado_ft='$axestado_comprobante' data-estado_g='$axestado' data-codguia='$axcod_guia_cz'><b>$axestado</b></a></td>";
			}

			echo "
			<!--td style='text-align: center;'>$axarchivo_digital</td-->
			<td style='text-align: center;'>$axcomprobante</td>";

			
	
			echo "
			<td style='text-align: center;'>
				<div class='btn-group dropstart'>
					<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
					<ul class='dropdown-menu'>	
					<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-info' id='btn_imprimir_guia' data-codguia='$axcod_guia_cz' data-bs-toggle='modal' data-bs-target='#exampleModal'><b><i class='bi bi-pencil' ></i> Imprimir</a></b>
					<div><hr class='dropdown-divider'></div>";

					if($axestado=='PENDIENTE' || $axestado==''){
						echo "<a href='#' class='dropdown-item text-danger' id='btn_eliminar_guia'  data-estado='$axestado'  data-codguia='$axcod_guia_cz' ><b><i class='bi bi-trash3-fill'></i> Eliminar</a></b>";	
					}

					if($axestado=='PROCESADA'){
						echo "<a href='#' class='dropdown-item text-danger' id='btn_rechazar_guia' title='LA GUIA REMISION CAMBIA ESTADO RECHAZAADA EN LA WEB Y SUNAT, EL COMPROBANTE QUEDA SIN GUIA REMISION' data-estado='$axestado'   data-codguia='$axcod_guia_cz' ><b><i class='fas fa-exclamation-circle'></i> Rechazar</a></b>";
						echo "<a href='#' class='dropdown-item text-danger' id='btn_revertir_guia'  data-estado='$axestado'  data-codguia='$axcod_guia_cz' ><b><i class='bi bi-trash3-fill'></i> Revertir</a></b>";	
					}


					echo "									
					<div><hr class='dropdown-divider'></div>
					</ul>
				</div>	

			</td>


			";

				


			echo "

		</tr>";

		}
		echo "</table>";
	}

break;

case '213':


$axnum_despacho_2 = $_POST['txtnum_despacho_2']; 	
$axcod_mot_trasalado = $_POST['cod_mot_trasalado']; 	
$axid_local = $_POST['txtid_local']; 	

if($axcod_mot_trasalado=='04'){ //TRASLADO

	$SQLBuscar = "SELECT * FROM MAESTRO_CZ_PROGRAMADOS WHERE  DETALLE_MOVIMIENTO='VENTA'  AND ID_LOCAL = '$axid_local' AND ID_TD='12' AND ESTADO_ATENDIDO='PROGRAMADO' AND COD_GUIA_CZ='' ORDER BY FECHA_EMISION DESC";

}elseif($axcod_mot_trasalado=='01'){ //VENTA

	$SQLBuscar = "SELECT TOP 10 * FROM MAESTRO_CZ_PROGRAMADOS WHERE DETALLE_MOVIMIENTO='VENTA'  AND ESTADO_ELECTRO='PROCESADA' AND  ID_LOCAL = '$axid_local' AND ID_TD <>'12' ORDER BY FECHA_EMISION DESC";

}elseif($axcod_mot_trasalado=='02'){ //COMPRAS

	$SQLBuscar = "SELECT TOP 10 * FROM MAESTRO_CZ_PROGRAMADOS WHERE  DETALLE_MOVIMIENTO='COMPRA'  AND ID_LOCAL = '$axid_local' AND ID_TD <>'12' ORDER BY FECHA_EMISION DESC";

}

	
	//echo "$SQLBuscar";

	echo "
		<table class='table table-hover'>
		<thead class='table-primary'>			
		<tr>
			<th scope='col' style='text-align:left'>Comprobante</th>			
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);	
		
	if(odbc_num_rows($RSBuscar) > 0){
 	
 	while ($row=odbc_fetch_array($RSBuscar)){ 

 		$it = $it+1;
 		$axcod_mov= $row["COD_MOV"];
 		$axnum_pedido= $row["NUM_PEDIDO"];
 		$axid_local= $row["ID_LOCAL"];
 		$axid_td=$row['ID_TD'];
 		$axfecha_emision = date('d-m-Y', strtotime($row["FECHA_EMISION"]));
 		$axcomprobante = $row["COMPROBANTE"];
 		$axnom_cliente = utf8_encode($row["RAZON_SOCIAL"]);
 		$axtotal_venta =number_format($row["TOTAL_VENTA"],4,".",","); 
 		$axestado_electro = $row["ESTADO_ELECTRO"];
 		$axestado_enviado = $row["ESTADO_ENVIADO_ITC"];
 		$axestado_atendido = $row["ESTADO_ATENDIDO"];
 		$axjson = $row["BOUCHER_DIGITAL"];

 		$axnum_despacho = get_row('PEDIDOS','NUM_DESPACHO','NUM_PEDIDO',$axnum_pedido);

 		$axid_beneficiario= $row["ID_BENEFICIARIO"];
 		$axid_direccion= $row["ID_DIRECCION"];
 		$axid_doc= $row["ID_DOC"];
		$axruc_benef= $row["RUC_BENEF"];

		$axcliente= $row["RAZON_SOCIAL"];
		$axidir_entrega= $row["DIRECCION_ENTREGA"];
		$axcod_ubi_llegada= $row["cod_ubi_llegada"];

		$axid_vehiculo = $row["ID_VEHICULO"];
		$axnom_chofer = trim($row["NOM_CHOFER"]);
		//echo $axnom_chofer.'<br>';
		
		$axnombres = get_row('usuarios','NOMBRES','NOM_USUARIO',$axnom_chofer);		
		$axpaterno =get_row('usuarios','PATERNO','NOM_USUARIO',$axnom_chofer);;		
		$axmaterno =get_row('usuarios','MATERNO','NOM_USUARIO',$axnom_chofer);;		

		$axcod_guia_cz = $row["COD_GUIA_CZ"];
		$axnum_guia = get_row('GUIA_REMISION_CZ','txt_serie','COD_GUIA_CZ',$axcod_guia_cz).'-'.get_row('GUIA_REMISION_CZ','txt_correlativo','COD_GUIA_CZ',$axcod_guia_cz);

		$axapellidos = $axpaterno.' '.$axmaterno;

		$axnum_licencia = get_row('usuarios','NUM_LICENCIA','NOM_USUARIO',$axnom_chofer);
		$axnum_dni = get_row('usuarios','COD_USUARIO','NOM_USUARIO',$axnom_chofer);

		//echo $axpaterno.' '.$axmaterno.'<br>';

		$axidir_partida_proveedor= get_row('BENEFICIARIOS','DIRECCION_ENTREGA','ID_BENEFICIARIO',$axid_beneficiario); //del proveedor
		$axcod_ubi_partida_prov= get_row('BENEFICIARIOS_DIR','cod_ubi_llegada','ID_DIRECCION',$axid_direccion); //del proveedor 
		//echo $axidir_entrega;
		

		$axdato_comprobante = '<h3>'.$axcomprobante.' | Fecha Emisión: '.$axfecha_emision.' </h3>';
		
		if($axcod_guia_cz==''){
		$axdato="<b>".$axcomprobante.' - '."$axfecha_emision".'</b><br>'."$axnom_cliente</a>";
		}else{
			$axdato="<b>".$axcomprobante.' - '."$axfecha_emision".' </b><b class="text-danger"> | #Guía: '.$axnum_guia.'</b><br>'."$axnom_cliente</a>";	
		}
		$axtipo_entrega ='PARCIAL';
		$ver_parciales = get_row_two('PEDIDOS_DESPACHO_EXTRAS','COD_GUIA_CZ','COD_MOV','TIPO_ENTREGA',$axcod_mov,$axtipo_entrega);
		
		//echo $ver_parciales.'<br>';

		$axruc_empresa = get_row('LOCALES','RUC_EMPRESA','ID_LOCAL',$axid_local);
		$axid_doc = get_row('LOCALES','ID_DOC','ID_LOCAL',$axid_local);
		$axnom_empresa = get_row('LOCALES','razon_social','ID_LOCAL',$axid_local);
		$axidir_partida= get_row('LOCALES','txt_domicilio_partida','ID_LOCAL',$axid_local);
		$axidir_llegada= get_row('LOCALES','txt_domicilio_llegada','ID_LOCAL',$axid_local);
		$axcod_ubi_partida= get_row('LOCALES','cod_ubi_partida','ID_LOCAL',$axid_local);
		$axcod_ubi_llegada_empresa= get_row('LOCALES','cod_ubi_llegada','ID_LOCAL',$axid_local);

 	echo "<tr>";
 			
 	if($axcod_mot_trasalado=='04'){ //TRASLADO

 		echo "<td scope='col' style='text-align:left'><a href='#' style='text-decoration:none;' id='btn_asignar_comprobante_a_guia' data-filtro='ADICIONAR' data-local='$axid_local' data-id='$axcod_mov'  data-idprovee='$axid_beneficiario' data-rucempresa='$axruc_empresa' data-empresa='$axnom_empresa' data-iddocempresa='$axid_doc' data-dir_partida='$axidir_partida'data-dir_entrega='$axidir_llegada' data-idvehi='$axid_vehiculo' data-nom_chofer='$axnombres' data-apell_chofer='$axapellidos' data-licencia='$axnum_licencia' data-dnichofer='$axnum_dni' data-ubig_llegada='$axcod_ubi_llegada_empresa' data-ubig_parida='$axcod_ubi_partida' data-ndespacho='$axnum_despacho' ><b>".$axcomprobante.' - '."$axfecha_emision".'</b><br>'."$axnom_cliente</a></td>";			

 	}elseif($axcod_mot_trasalado=='01'){ //VENTA

 		if($ver_parciales==''){
 			$axver = '';
 		}else{
 			$axver = ' <span class="badge rounded-pill text-bg-warning"><i class="bi bi-info-circle-fill"></i></span>';
 		}

 		echo "<td scope='col' style='text-align:left'>
 		
 		<a href='#' style='text-decoration:none;' data-local='$axid_local' data-id='$axcod_mov'  data-idprovee='$axid_beneficiario' data-iddoc='$axid_doc' data-cliente='$axcliente' data-rucliente='$axruc_benef' data-dir_entrega='$axidir_entrega' data-dir_partida='$axidir_partida' data-mostrar='$axdato_comprobante' id='btn_asignar_comprobante_a_guia' data-rucempresa='$axruc_empresa' data-empresa='$axnom_empresa' data-iddocempresa='$axid_doc' data-idvehi='$axid_vehiculo' data-nom_chofer='$axnombres' data-apell_chofer='$axapellidos' data-licencia='$axnum_licencia' data-dnichofer='$axnum_dni' data-ubig_llegada='$axcod_ubi_llegada' data-ubig_parida='$axcod_ubi_partida' data-ndespacho='$axnum_despacho' >".$axdato.$axver."</a>


 		</td>";		

 		}elseif($axcod_mot_trasalado=='02'){ //COMPRA

 		echo "<td scope='col' style='text-align:left'>
 		
 		<a href='#' style='text-decoration:none;' data-local='$axid_local' data-id='$axcod_mov'  data-idprovee='$axid_beneficiario' data-iddoc='$axid_doc' data-rucprov='$axruc_proveedor' data-proveedor='$axcliente' data-dir_entrega='$axidir_partida' data-dir_partida='$axidir_partida_proveedor' data-mostrar='$axdato_comprobante' id='btn_asignar_comprobante_a_guia' data-rucempresa='$axruc_empresa' data-empresa='$axnom_empresa' data-iddocempresa='$axid_doc' data-iddoc='$axid_doc' data-cliente='$axcliente' data-rucliente='$axruc_benef' data-ubig_llegada='$axcod_ubi_llegada_empresa' data-ubig_parida='$axcod_ubi_partida_prov' >".$axdato."</a>


 		</td>";			

	}
}

}
	
break;

case '214':
	

$axid_local = $_POST['txtid_local']; 		
$axid_td_cp = $_POST['txtid_td_cp']; 		
$axnum_pedido = $_POST['txtnum_pedido']; 		
$axserie = $_POST['txt_serie_1']; 		
$axiid_td_guia = $_POST['txtid_td_guia']; 		
$axserie_guia = $_POST['txt_serie_guia']; 		

if($axid_td_cp ==''){

	$sqletapas = "SELECT * FROM CORRELATIVOS WHERE ID_LOCAL ='$axid_local' AND ID_TD='$axiid_td_guia' and COD_CORR='$axserie_guia' ORDER BY ID_TD ASC" ;	

}elseif($axiid_td_guia==''){

	$sqletapas = "SELECT * FROM CORRELATIVOS WHERE ID_LOCAL ='$axid_local' AND ID_TD='$axid_td_cp' and COD_CORR='$axserie' ORDER BY ID_TD ASC" ;	
}

//echo $sqletapas;	      
$rsetapas=odbc_exec($con,$sqletapas);
$fila = odbc_fetch_array($rsetapas);

$axcorrelativo = $fila['N_CORRELATIVO']+1;
echo number_pad($axcorrelativo,8);


break;

case '215':
	
$axid_local = $_POST['txtid_local']; 		
$axiid_td_guia = $_POST['txtid_td_guia']; 		

$sqletapas = "SELECT * FROM CORRELATIVOS WHERE ID_LOCAL ='$axid_local' AND ID_TD='$axiid_td_guia' ORDER BY ID_TD ASC" ;
//echo $sqletapas;	      
$rsetapas=odbc_exec($con,$sqletapas);
	
if(odbc_num_rows($rsetapas) > 0){
	while($fila=odbc_fetch_array($rsetapas)){
		echo '<option value='.$fila['COD_CORR'].'>'.$fila['N_SERIE'].'</option>';
    }
	
} else {

	echo "";	

}

break;

case '216':
		
	 $axcod_guia_cz = trim($_POST['txtcod_guia_cz']);	
	 $axcod_mov_cz = trim($_POST['txtcod_mov_cz']);
	 $axid_local = $_POST['txtid_local'];
	 $axIdentificador ='GR';
	 
	 $axid_td_guia = $_POST['txtid_td_guia'];
	 $cod_tip_cpe = get_row('TIPO_DOCUMENTOS','COD_SUNAT','ID_TD',$axid_td_guia);

	 $axcod_serie = $_POST['txt_serie_guia'];	 
	 $txt_serie = get_row('CORRELATIVOS','N_SERIE','COD_CORR',$axcod_serie);	 

	 $txt_correlativo = $_POST['txtdocumento_guia'];
	 $cod_cliente_emis= get_row('LOCALES','cod_cliente_emis','ID_LOCAL',$axid_local);

	 $axnum_ruc_rem = $_POST['txtnum_ruc_rem'];
	 $axnum_rzn_soc_rem = $_POST['txtnum_rzn_soc_rem'];	 
	 $axcod_tip_nif_rem = $_POST['txtcod_tip_nif_rem'];

	 $axnum_ruc_dest = $_POST['txtnum_ruc_dest'];
	 $axnum_rzn_soc_dest = $_POST['txtnum_rzn_soc_dest'];
	 $axcod_tip_nif_dest = $_POST['txtcod_tip_nif_dest'];

	 $axnum_iden_prov = $_POST['txtnum_ruc_prov'];
	 $axcod_tip_nif_prov = $_POST['txtcod_tip_nif_prov'];
	 $axnom_rzn_soc_prov = $_POST['txtnom_rzn_soc_prov'];
	 
	 $axfecha_emision_guia = $_POST['txtfecha_emision_guia'];
	 $axhora_actual = date('H:i:s');

	 $axcod_ubi_partida = $_POST['txtcod_ubi_partida'];
	 $axdomicilio_partida = $_POST['txtdomicilio_partida'];
	 $axdomicilio_llegada = $_POST['txt_domicilio_llegada'];
	 $axcod_ubi_llegada = $_POST['txtcod_ubi_llegada'];

	 $axtrans_txt_nombre = $_POST['txttrans_txt_nombre'];
	 $axtrans_txt_ruc = $_POST['txttrans_txt_ruc'];
	 $axtrans_cod_tip_nif = $_POST['txttrans_cod_tip_nif'];

	 $axtrans_cod_tip_modalidad = $_POST['trans_cod_tip_modalidad'];
	 
	 $axfecha_traslado = $_POST['txtfecha_traslado'];
	 $ax_mot_trasalado = $_POST['cod_mot_trasalado'];

	 $cant_bultos_expor = 0;
   $cod_unid_peso_bruto = 'KGM';
   $mnt_tot_peso_bruto=get_row_two('GUIAS_BULTOS','PESO','NUM_PEDIDO','ID_LOCAL',$axnum_pedido,$axid_local);
	 if($mnt_tot_peso_bruto==0 || $mnt_tot_peso_bruto==''){
	 	$mnt_tot_peso_bruto = 10;
	 }

	$axobservaciones ='la guia de remision tiene que ser llevada obligatoriamente';
	 
	$axfiltro = '20';
	$axdesc_traslado = get_row_two('CATALOGOS_SUNAT','DESCRIPCION_CATALOGO','COD_CATALOGO','FILTRO',$cod_mot_trasalado,$axfiltro);


	if($axtrans_cod_tip_modalidad=='02'){ // VENTA Y TRASLADO PRIVADO
		
		$axtipo = "Transporte privado";

	}elseif($axtrans_cod_tip_modalidad=='01'){ //COMPRA PUBLICO
		$axtipo = "Transporte publico";
	}
	
	$txt_desc_motiv_tras= $axdesc_traslado.'-'.$axtipo;
	$dato_extra_1="";
	$dato_extra_2="";
	$dato_extra_3="";
	$dato_extra_4="";
	$vrs_guia='2.0';
	
	$axid_beneficiario = $_POST['txtid_beneficiario'];
	 
	$axnum_despacho = $_POST['txtnum_despacho'];	

	$axcodusuario = $_POST['txtcodusuario'];
	$ax_veh_txt_placa = $_POST['txt_veh_txt_placa'];
	$ax_con_nombre = $_POST['txt_con_nombre'];
	$ax_con_apellido = $_POST['txt_con_apellido'];
	$ax_con_num_lic = $_POST['txt_con_num_lic'];
	$ax_con_num_iden = $_POST['txt_con_num_iden'];
	$axid_vehiculo = $_POST['txtid_vehiculo'];	 
	
	 $sqlinserta = "INSERT INTO GUIA_REMISION_CZ (COD_GUIA_CZ,COD_MOV,ID_LOCAL,Identificador,cod_tip_cpe,txt_serie,txt_correlativo,cod_cliente_emis,num_ruc_rem,nom_rzn_soc_rem,cod_tip_nif_rem,num_ruc_dest,nom_rzn_soc_dest,cod_tip_nif_dest,num_iden_prov,nom_rzn_soc_prov,cod_tip_nif_prov,fec_emis,hora_emis,cod_ubi_partida,txt_domicilio_partida,txt_domicilio_llegada,cod_ubi_llegada,trans_txt_nombre,trans_txt_ruc,trans_cod_tip_nif,trans_fec_ini,cod_mot_trasalado,cant_bultos_expor,cod_unid_peso_bruto,mnt_tot_peso_bruto,trans_cod_tip_modalidad,observaciones,txt_desc_motiv_tras,dato_extra_1,dato_extra_2,dato_extra_3,dato_extra_4,vrs_guia,ESTADO_ELECTRO,ESTADO_ENVIADO_ITC,ID_VEHICULO,ID_USUARIO) VALUES ('$axcod_guia_cz','$axcod_mov_cz','$axid_local','$axIdentificador','$cod_tip_cpe','$txt_serie','$txt_correlativo','$cod_cliente_emis','$axnum_ruc_rem','$axnum_rzn_soc_rem','$axcod_tip_nif_rem','$axnum_ruc_dest','$axnum_rzn_soc_dest','$axcod_tip_nif_dest','$axnum_iden_prov','$axnom_rzn_soc_prov','$axcod_tip_nif_prov','$axfecha_emision_guia','$axhora_actual','$axcod_ubi_partida','$axdomicilio_partida','$axdomicilio_llegada','$axcod_ubi_llegada','$axtrans_txt_nombre','$axtrans_txt_ruc','$axtrans_cod_tip_nif','$axfecha_traslado','$ax_mot_trasalado','$cant_bultos_expor','$cod_unid_peso_bruto','$mnt_tot_peso_bruto','$axtrans_cod_tip_modalidad','$axobservaciones','$txt_desc_motiv_tras','$dato_extra_1','$dato_extra_2','$dato_extra_3','$dato_extra_4','$vrs_guia','PENDIENTE','PENDIENTE','$axid_vehiculo','$axcodusuario')";
		 //echo $sqlinserta;
	 
		 $rsinserta = odbc_exec($con,$sqlinserta);

		 if($rsinserta){
	
			$respuesta =0;
			echo $respuesta;

		 }else{

		 	$respuesta =1;
			echo $respuesta;

		 }

break;

case '217':
	
$axnum_despacho= $_POST['txtnum_despacho'];
	
	$sql6 = "SELECT TOP 1 * FROM PEDIDOS_DESPACHOS_1 WHERE NUM_DESPACHO = '$axnum_despacho'";
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

case '218':
	
$axbuscar_dato =$_POST['txtnum_despacho'];
   
 if(isset($_POST["txtnum_despacho"])){

	$output ="";
	$idprov ="";
	$sqlemisor = "SELECT TOP 5 NUM_DESPACHO FROM PEDIDOS WHERE NUM_DESPACHO LIKE  '%".$axbuscar_dato."%' GROUP BY NUM_DESPACHO ORDER BY NUM_DESPACHO";
	//echo $sqlemisor;

	$rsemisor=odbc_exec($con,$sqlemisor);	
	$output ='<ul class="list-group">';  		

	if(odbc_num_rows($rsemisor) > 0){

		 while ($row=odbc_fetch_array($rsemisor)){
		 	$nom_prod =  trim($row["NUM_DESPACHO"]);
		 	$output .='<a href="#" id="btn_lista_despachos" class="list-group-item list-group-item-action" style="background:#DAF5FF;">'.utf8_encode(trim($row["NUM_DESPACHO"])).'</a>';
		 }

	}else{
		
		$output .='<a href="#" class="list-group-item list-group-item-action bg-danger">No existe</a>';
	
	}

	$output .='</ul>';
	echo $output;

}else{
	echo $output;	
}

break;

case '219':

$axcod_mov = $_POST['txtcod_mov_cz']; 		
$axcod_mot_trasalado = $_POST['cod_mot_trasalado']; 		

if($axcod_mot_trasalado=='01'){ // venta

	$sqletapas = "SELECT * FROM MAESTRO_GUIAS_VARIAS_1 WHERE COD_MOV='$axcod_mov' order by COD_PRODUCTO asc" ;
	//echo $sqletapas;
	$rsetapas=odbc_exec($con,$sqletapas);	
		if(odbc_num_rows($rsetapas) > 0){
			echo '<option value="">Seleccionar</option>';
			while($fila=odbc_fetch_array($rsetapas)){
		   		echo '<option value='.$fila['ID_PRODUCTO'].'>'.$fila['COD_PRODUCTO'].' | '.$fila['NOM_PRODUCTO'].'</option>';
	    	}		
		} 

}elseif($axcod_mot_trasalado=='04'){ //traslado


	$sqletapas = "SELECT * FROM MAESTRO_GUIAS_VARIAS_1 WHERE COD_MOV='$axcod_mov' order by COD_PRODUCTO asc" ;
	//echo $sqletapas;
	$rsetapas=odbc_exec($con,$sqletapas);	
		if(odbc_num_rows($rsetapas) > 0){
			echo '<option value="">Seleccionar</option>';
			while($fila=odbc_fetch_array($rsetapas)){
		   		echo '<option value='.$fila['ID_PRODUCTO'].'>'.$fila['COD_PRODUCTO'].' | '.$fila['NOM_PRODUCTO'].'</option>';
	    	}		
		} 

}elseif($axcod_mot_trasalado=='01'){ //compra


	$sqletapas = "SELECT * FROM MAESTRO_GUIAS_VARIAS_1 WHERE COD_MOV='$axcod_mov' order by COD_PRODUCTO asc" ;
	//echo $sqletapas;
	$rsetapas=odbc_exec($con,$sqletapas);	
		if(odbc_num_rows($rsetapas) > 0){
			echo '<option value="">Seleccionar</option>';
			while($fila=odbc_fetch_array($rsetapas)){
		   		echo '<option value='.$fila['ID_PRODUCTO'].'>'.$fila['COD_PRODUCTO'].' | '.$fila['NOM_PRODUCTO'].'</option>';
	    	}		
		} 

}

	


	

break;

case '220':
	
	$axid_producto= $_POST['txtid_producto'];
	$axcod_mov= $_POST['txtcod_mov_cz'];
	$axcod_mot_trasalado= $_POST['cod_mot_trasalado'];
	
	if($axcod_mot_trasalado=='01'){ //VENTA
		
		$axverifica = get_row('PEDIDOS_DESPACHO_EXTRAS','COD_MOV','COD_MOV',$axcod_mov);

		if($axverifica==''){

			$sql6 = "SELECT * FROM MAESTRO_DT WHERE COD_MOV = '$axcod_mov' AND ID_PRODUCTO='$axid_producto'";			

		}else{

			$sql6 ="SELECT CANT_COMPROBANTE - SUM(CANT_DESPACHADA) AS CANT_SALIDA FROM PEDIDOS_DESPACHO_EXTRAS WHERE COD_MOV = '$axcod_mov' AND ID_PRODUCTO = '$axid_producto' GROUP BY CANT_COMPROBANTE";

		}

	}else{
		$sql6 = "SELECT * FROM MAESTRO_DT WHERE COD_MOV = '$axcod_mov' AND ID_PRODUCTO='$axid_producto'";		
	}
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

case '221':

	$axid_producto= trim($_POST['txtid_producto']);
	$axcant_guia= $_POST['txtcant_guia'];
	$axcant_despachar= $_POST['txtcant_despachar'];
	$axcod_guia_cz= trim($_POST['txtcod_guia_cz']);
	$axcod_mov_cz= $_POST['txtcod_mov_cz'];
	$axnum_pedido = get_row('MAESTRO_CZ','NUM_PEDIDO','COD_MOV',$axcod_mov_cz);
	$axnum_despacho= $_POST['txtnum_despacho'];
	$axfecha_traslado= $_POST['txtfecha_traslado'];
	$axid_vehiculo= $_POST['txtid_vehiculo'];

		$it = 0;	
		$axid_insumo = $axid_producto;
		$num_lin_item = $it;
		$cod_unid_item = get_row('PRODUCTOS','PRESENTACION','ID_PRODUCTO',$axid_insumo);
		$cant_unid_item = $axcant_despachar;
		$val_vta_item = 0;
		$cod_tip_afect_igv_item =0;
		$prc_vta_unit_item =0;
		$mnt_dscto_item = 0;
		$mnt_igv_item = 0;
		$txt_descr_item =get_row('PRODUCTOS','NOM_PRODUCTO','ID_PRODUCTO',$axid_insumo); 
		$cod_prod_sunat = '00000000';
		$cod_item = get_row('PRODUCTOS','COD_PRODUCTO','ID_PRODUCTO',$axid_insumo); 
		$val_unit_item = 0;
		$mnt_isc_item = 0;
		$importe_total_item = 0;
		$val_unit_icbper = 0;
		$cant_icbper_item = 0;
		$mnt_icbper_item = 0;
		$dato_extra_1 ='';
		$dato_extra_2 ='';
		$cod_gtin = '';

		if($axcant_guia !==$axcant_despachar){
			$axcant_pendiente =$axcant_guia-$axcant_despachar;
			$axtipo_entrega = 'PARCIAL';
		}else{
			$axtipo_entrega = '';
			$axcant_pendiente =0;
		}

		$SQLInsert = "INSERT INTO GUIA_REMISION_DT (COD_GUIA_CZ,num_lin_item,cod_unid_item,cant_unid_item,val_vta_item,cod_tip_afect_igv_item,prc_vta_unit_item,mnt_dscto_item,mnt_igv_item,txt_descr_item,cod_prod_sunat,cod_item,val_unit_item,mnt_isc_item,importe_total_item,val_unit_icbper,cant_icbper_item,mnt_icbper_item,dato_extra_1,dato_extra_2,cod_gtin,TIPO_ENTREGA) VALUES ('$axcod_guia_cz','$num_lin_item','$cod_unid_item','$cant_unid_item','$val_vta_item','$cod_tip_afect_igv_item','$prc_vta_unit_item','$mnt_dscto_item','$mnt_igv_item','$txt_descr_item','$cod_prod_sunat','$cod_item','$val_unit_item','$mnt_isc_item','$importe_total_item','$val_unit_icbper','$cant_icbper_item','$mnt_icbper_item','$dato_extra_1','$dato_extra_2','$cod_gtin','$axtipo_entrega')";
			
			$RSInsert = odbc_exec($con,$SQLInsert);

			//echo $SQLInsert;

				if($RSInsert){
/*
					if($axtipo_entrega=='PARCIAL'){

						$SQLInsert_d = "INSERT INTO PEDIDOS_DESPACHO_EXTRAS (NUM_DESPACHO,NUM_PEDIDO,FECHA_DESPACHO,ID_VEHICULO,COD_GUIA_CZ,COD_MOV,ID_PRODUCTO,COD_PRODUCTO,NOM_PRODUCTO,CANT_PENDIENTE,ESTADO_DESPACHO,TIPO_ENTREGA) VALUES ('$axnum_despacho','$axnum_pedido','$axfecha_traslado','$axid_vehiculo','$axcod_guia_cz','$axcod_mov_cz','$axid_insumo','$cod_item','$txt_descr_item','$axcant_pendiente','PENDIENTE','PARCIAL')";
			  	$RSInsert_d = odbc_exec($con,$SQLInsert_d);		
						
					}
			*/		 
					$respuesta =0;
					echo $respuesta;

				}else{

					$respuesta =1;
					echo $respuesta;

				}

break;

case '222':
	
$axcod_guia_cz = trim($_POST['txtcod_guia_cz']); 	

$SQLBuscar_detalle = "SELECT * FROM GUIA_REMISION_DT WHERE COD_GUIA_CZ='$axcod_guia_cz'  ORDER BY cod_item DESC";
//echo $SQLBuscar;
$RSBuscar_detalle = odbc_exec($con,$SQLBuscar_detalle);

//echo odbc_num_rows($RSBuscar_detalle);

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th style='text-align: center;'>Item</th>			
			<th style='text-align: left;'>Descripción</th>
			<th style='text-align: center;'>Unidad</th>
			<th style='text-align: right;'>Cantidad</th>			
			<th style='text-align: center;'>Quitar</th>							
		</tr>
		</thead>";

		while ($fila = odbc_fetch_array($RSBuscar_detalle)) {
			
			$it=$it+1;
			$iddt =$fila['ID_GUIA_DT'];	
			$axcod_guia_cz = $fila['COD_GUIA_CZ'];	
			$ax_descr_item = $fila['txt_descr_item'];				
			$ax_cod_item = $fila['cod_item'];				
			$ax_cod_unid_item = $fila['cod_unid_item'];	
			$ax_cant_unid_item= number_format($fila['cant_unid_item'],2,".",",");
			$axid_producto =$fila['cod_item'];	

			//echo $axid_producto.' '.$iddt.' '.$axcod_guia_cz.'<br>';
			
		
		echo "
		<tr>
			<td style='text-align: center;'>$it</td>			
			<!--td style='text-align: left;'>$ax_cod_item | $ax_descr_item</td-->			
			<td style='text-align: left;'>$ax_descr_item</td>			
			<td style='text-align: center;'>$ax_cod_unid_item</td>		
			<td style='text-align: right;'>$ax_cant_unid_item</td>
			<td style='text-align: center;'>
				<a href='#' id='btn_item_guia' data-id='$iddt' data-idprod='$axid_producto' data-codguia='$axcod_guia_cz' ><b><i class='bi bi-trash3-fill'></i></a></b>
			</td>
		</tr>";

		}

		echo "<tr>
			<td style='text-align: right;' colspan='5'>
				<a href='#' class='btn btn-outline-success btn-sm' id='btn_generar_guia' data-id='$iddt' data-idprod='$axid_producto' data-codguia='$axcod_guia_cz' ><b><i class='bi bi-check2-square'></i> Procesar </a></b>
				<a href='../Form/generar_guia_remision.php' class='btn btn-outline-danger btn-sm' id='btn_cancelar_proceso' data-id='$iddt' data-idprod='$axid_producto' data-codguia='$axcod_guia_cz' ><b><i class='bi bi-x-circle-fill'></i> Cancelar </a></b>
			</td>
		</tr>";

		echo "</table>";





break;

case '223':
	
	$axcod_guia_cz = $_POST['txtcod_guia_cz']; 	

	$SQLDelete = "DELETE FROM GUIA_REMISION_DT WHERE COD_GUIA_CZ='$axcod_guia_cz'";
	$RSDelete = odbc_exec($con,$SQLDelete);

	if($RSDelete){

		$SQLDelete_cz = "DELETE FROM GUIA_REMISION_CZ WHERE COD_GUIA_CZ='$axcod_guia_cz'";
		$RSDelete_cz = odbc_exec($con,$SQLDelete_cz);

		$axcod_mov = get_row('MAESTRO_CZ','COD_MOV','COD_GUIA_CZ',$axcod_guia_cz);
		$axnum_pedido = get_row('PEDIDOS','NUM_PEDIDO','COD_GUIA_CZ',$axcod_guia_cz);

		$SQLActualizar_maestro = "UPDATE MAESTRO_CZ SET COD_GUIA_CZ='' WHERE COD_GUIA_CZ='$axcod_guia_cz'";
		$RSActualizar_maestro = odbc_exec($con,$SQLActualizar_maestro);

		$SQLActualizar_pedidos = "UPDATE PEDIDOS SET COD_GUIA_CZ='' WHERE COD_GUIA_CZ='$axcod_guia_cz'";
		$RSActualizar_pedidos = odbc_exec($con,$SQLActualizar_pedidos);

		$SQLEliminar_aux = "DELETE FROM PEDIDOS_DESPACHO_EXTRAS WHERE COD_GUIA_CZ='$axcod_guia_cz'";
		$RSEliminar_aux = odbc_exec($con,$SQLEliminar_aux);

		$respuesta=0;
		echo $respuesta;

	}else{

		$respuesta=1;
		echo $respuesta;

	}

break;

case '224':
	
$axcod_guia_cz = $_POST['txtcod_guia_cz']; 	
$axcod_guia_dt = $_POST['txtcod_guia_dt']; 	
$axid_producto = $_POST['txtid_producto']; 	

	$SQLDelete = "DELETE FROM GUIA_REMISION_DT WHERE ID_GUIA_DT='$axcod_guia_dt'";
	$RSDelete = odbc_exec($con,$SQLDelete);

	if($RSDelete){

		$SQLEliminar_aux = "DELETE FROM PEDIDOS_DESPACHO_EXTRAS WHERE COD_GUIA_CZ='$axcod_guia_cz' AND COD_PRODUCTO='$axid_producto' AND TIPO_ENTREGA='PARCIAL'";
		$RSEliminar_aux = odbc_exec($con,$SQLEliminar_aux);

		$respuesta=0;
		echo $respuesta;

	}else{

		$respuesta=1;
		echo $respuesta;

	}

break;

case '225':
	
	$axcod_guia_cz = trim($_POST['txtcod_guia_cz']); 	
	$axcod_mov_cz = trim($_POST['txtcod_mov_cz']); 	
	$ax_serie_guia = $_POST['txt_serie_guia']; 	
	$axnum_despacho = $_POST['txtnum_despacho']; 	
	$axfecha_traslado = $_POST['txtfecha_traslado']; 	
	$axid_vehiculo = $_POST['txtid_vehiculo']; 	
	$axtipo_entrega = $_POST['txttipo_entrega']; 	
	$axcorrelativo = get_row('CORRELATIVOS','N_CORRELATIVO','COD_CORR',$ax_serie_guia)+1;

	/***Actualizo el correlativo***/

	$SQLActualizar_correlativo = "UPDATE CORRELATIVOS SET N_CORRELATIVO='$axcorrelativo' WHERE COD_CORR='$ax_serie_guia'";
	$RSActualizar_correlativo = odbc_exec($con,$SQLActualizar_correlativo);

	//echo $SQLActualizar_correlativo;

	/**Verifico si la guia esta asignada alguna FACTURA Y PEDIDOS**/
	$axverifica_1 = get_row('MAESTRO_CZ','COD_GUIA_CZ','COD_MOV',$axcod_mov_cz);
	$axnum_pedido = get_row('MAESTRO_CZ','NUM_PEDIDO','COD_MOV',$axcod_mov_cz);	

	//echo 'Maestro: '.$axverifica_1.' Pedido:'.$axnum_pedido;

			if($axverifica_1==''){

				/**Si no esta asigando a ninguna factura o pedido la asigno**/

				$SQLActualizar_maestro = "UPDATE MAESTRO_CZ SET COD_GUIA_CZ='$axcod_guia_cz' WHERE COD_MOV='$axcod_mov_cz'";
				$RSActualizar_maestro = odbc_exec($con,$SQLActualizar_maestro);
				//echo $SQLActualizar_maestro.'<br>';

				$SQLActualizar_pedidos = "UPDATE PEDIDOS SET COD_GUIA_CZ='$axcod_guia_cz' WHERE NUM_PEDIDO='$axnum_pedido'";
				$RSActualizar_pedidos = odbc_exec($con,$SQLActualizar_pedidos);
				//echo $SQLActualizar_pedidos.'<br>';

				/**UNA VEZ QUE LE ASIGNO AL COMPROBANTE Y EL PEDIDO LA GUIA, grabo esta guia en una tabla auxliar, con los datos de la factura y pedido y guardo el detalle de lo que estan despachando, como despacho parcial**/

				$SQLComprobante = "SELECT * FROM MAESTRO_DT WHERE COD_MOV='$axcod_mov_cz'";
				$RSComprobante = odbc_exec($con,$SQLComprobante);
				//echo $SQLComprobante;

				while ($fila_c = odbc_fetch_array($RSComprobante)) {

					$axid_insumo = $fila_c['ID_PRODUCTO'];
					$cod_item = get_row('PRODUCTOS','COD_PRODUCTO','ID_PRODUCTO',$axid_insumo);
					$txt_descr_item = get_row('PRODUCTOS','NOM_PRODUCTO','ID_PRODUCTO',$axid_insumo);
					$axcant_pendiente = $fila_c['CANT_SALIDA'];

					$axcant_despachada_1  = get_row_two('GUIA_REMISION_DT','cant_unid_item','COD_GUIA_CZ','cod_item',$axcod_guia_cz,$cod_item);

					if($axcant_despachada_1==''){
						
						$axcant_despachada =0;
					}else{
						$axcant_despachada = $axcant_despachada_1;
					}
					
					$SQLInsert_d = "INSERT INTO PEDIDOS_DESPACHO_EXTRAS (NUM_DESPACHO,NUM_PEDIDO,FECHA_DESPACHO,ID_VEHICULO,COD_GUIA_CZ,COD_MOV,ID_PRODUCTO,COD_PRODUCTO,NOM_PRODUCTO,CANT_PENDIENTE,CANT_COMPROBANTE,ESTADO_DESPACHO,TIPO_ENTREGA,CANT_DESPACHADA) VALUES ('$axnum_despacho','$axnum_pedido','$axfecha_traslado','$axid_vehiculo','$axcod_guia_cz','$axcod_mov_cz','$axid_insumo','$cod_item','$txt_descr_item',0,'$axcant_pendiente','','$axtipo_entrega','$axcant_despachada')";
					//echo $SQLInsert_d.'<br>';
			  	$RSInsert_d = odbc_exec($con,$SQLInsert_d);	
				
				}

				$SQLContar = "SELECT cod_item,COD_GUIA_CZ FROM GUIA_REMISION_DT WHERE COD_GUIA_CZ='$axcod_guia_cz'";
				$RSContar = odbc_exec($con,$SQLContar);

				//echo $SQLContar.'<br>';

				while ($fila_contar = odbc_fetch_array($RSContar)) {
					
					$it = $it+1;
					$axcod_producto = $fila_contar['cod_item'];
					$SQLActualizar = "UPDATE GUIA_REMISION_DT SET num_lin_item='$it' WHERE cod_item='$axcod_producto' and COD_GUIA_CZ='$axcod_guia_cz'";
					$RSActualizar = odbc_exec($con,$SQLActualizar);
					//echo $SQLActualizar;

				}

			  $sqldespachado= "SELECT SUM(CANT_DESPACHADA) AS Resultado FROM PEDIDOS_DESPACHO_EXTRAS WHERE COD_MOV = '$axcod_mov_cz'";
			  $rsdespachado = odbc_exec($con,$sqldespachado);
			  $fila_d = odbc_fetch_array($rsdespachado);
			  $axdespachado = $fila_d['Resultado'];

				$sqlcomprobante = "SELECT SUM(CANT_SALIDA) AS Resultado FROM MAESTRO_DT WHERE COD_MOV = '$axcod_mov_cz'";
				$rscomprobante = odbc_exec($con,$sqlcomprobante);
			  $fila_c = odbc_fetch_array($rscomprobante);
			  $axcomprobante = $fila_c['Resultado'];

			  $axresultado = $axcomprobante-$axdespachado;

			 // echo $axresultado = $axcomprobante-$axdespachado;

			  if($axresultado==0){

			  	$sqlactualizar_estado = "UPDATE PEDIDOS_DESPACHO_EXTRAS SET TIPO_ENTREGA='TOTAL' WHERE COD_MOV='$axcod_mov_cz'";
			  	$rsactualizar_estado = odbc_exec($con,$sqlactualizar_estado);

			  }

				$respuesta = 0;
				echo $respuesta;
				

			}else{
				

			/**UNA VEZ QUE LE ASIGNO AL COMPROBANTE Y EL PEDIDO LA GUIA, grabo esta guia en una tabla auxliar, con los datos de la factura y pedido y guardo el detalle de lo que estan despachando, como despacho parcial**/

				$SQLComprobante = "SELECT * FROM MAESTRO_DT WHERE COD_MOV='$axcod_mov_cz'";
				$RSComprobante = odbc_exec($con,$SQLComprobante);
				//echo $SQLComprobante;

				while ($fila_c = odbc_fetch_array($RSComprobante)) {

					$axid_insumo = $fila_c['ID_PRODUCTO'];
					$cod_item = get_row('PRODUCTOS','COD_PRODUCTO','ID_PRODUCTO',$axid_insumo);
					$txt_descr_item = get_row('PRODUCTOS','NOM_PRODUCTO','ID_PRODUCTO',$axid_insumo);
					$axcant_pendiente = $fila_c['CANT_SALIDA'];

					$axcant_despachada_1  = get_row_two('GUIA_REMISION_DT','cant_unid_item','COD_GUIA_CZ','cod_item',$axcod_guia_cz,$cod_item);

					if($axcant_despachada_1==''){
						
						$axcant_despachada =0;
					}else{
						$axcant_despachada = $axcant_despachada_1;
					}
					
					$SQLInsert_d = "INSERT INTO PEDIDOS_DESPACHO_EXTRAS (NUM_DESPACHO,NUM_PEDIDO,FECHA_DESPACHO,ID_VEHICULO,COD_GUIA_CZ,COD_MOV,ID_PRODUCTO,COD_PRODUCTO,NOM_PRODUCTO,CANT_PENDIENTE,CANT_COMPROBANTE,ESTADO_DESPACHO,TIPO_ENTREGA,CANT_DESPACHADA) VALUES ('$axnum_despacho','$axnum_pedido','$axfecha_traslado','$axid_vehiculo','$axcod_guia_cz','$axcod_mov_cz','$axid_insumo','$cod_item','$txt_descr_item',0,'$axcant_pendiente','','$axtipo_entrega','$axcant_despachada')";
					//echo $SQLInsert_d.'<br>';
			  	$RSInsert_d = odbc_exec($con,$SQLInsert_d);	
				
				}


				$SQLContar = "SELECT cod_item,COD_GUIA_CZ FROM GUIA_REMISION_DT WHERE COD_GUIA_CZ='$axcod_guia_cz'";
				$RSContar = odbc_exec($con,$SQLContar);

				//echo $SQLContar.'<br>';

				while ($fila_contar = odbc_fetch_array($RSContar)) {
					
					$it = $it+1;
					$axcod_producto = $fila_contar['cod_item'];
					$SQLActualizar = "UPDATE GUIA_REMISION_DT SET num_lin_item='$it' WHERE cod_item='$axcod_producto' and COD_GUIA_CZ='$axcod_guia_cz'";
					$RSActualizar = odbc_exec($con,$SQLActualizar);
					//echo $SQLActualizar;

				}

				$sqldespachado= "SELECT SUM(CANT_DESPACHADA) AS Resultado FROM PEDIDOS_DESPACHO_EXTRAS WHERE COD_MOV = '$axcod_mov_cz'";
			  $rsdespachado = odbc_exec($con,$sqldespachado);
			  $fila_d = odbc_fetch_array($rsdespachado);
			  $axdespachado = $fila_d['Resultado'];

				$sqlcomprobante = "SELECT SUM(CANT_SALIDA) AS Resultado FROM MAESTRO_DT WHERE COD_MOV = '$axcod_mov_cz'";
				$rscomprobante = odbc_exec($con,$sqlcomprobante);
			  $fila_c = odbc_fetch_array($rscomprobante);
			  $axcomprobante = $fila_c['Resultado'];

				$axresultado = $axcomprobante-$axdespachado;

			  if($axresultado==0){

			  	$sqlactualizar_estado = "UPDATE PEDIDOS_DESPACHO_EXTRAS SET TIPO_ENTREGA='TOTAL' WHERE COD_MOV='$axcod_mov_cz'";
			  	$rsactualizar_estado = odbc_exec($con,$sqlactualizar_estado);
			  	
			  }

				$respuesta = 0;
				echo $respuesta;
	

			  
			}


break;

case '226':
	

$axidlocal= $_POST['txtid_local'];
$axcod_guia_cz = trim($_POST['txtcod_guia_cz']);
$axtipo_motivo=$_POST['cod_mot_trasalado'];

$axcod_cliente_emis= get_row('LOCALES','cod_cliente_emis','ID_LOCAL',$axidlocal);
$axruta= get_row('LOCALES','RUTA_JSON','ID_LOCAL',$axidlocal);
$axtoken= get_row('LOCALES','TOKEN_EMPRESA','ID_LOCAL',$axidlocal);
$axurl= get_row('LOCALES','URL_PRODUCCION','ID_LOCAL',$axidlocal);

$SQLDatos_1 ="SELECT TOP 1 * FROM GUIA_REMISION_CZ WHERE COD_GUIA_CZ='$axcod_guia_cz' AND ID_LOCAL='$axidlocal'";
$RSDatos_1=odbc_exec($con,$SQLDatos_1);
$row=odbc_fetch_array($RSDatos_1);
			
	$axrucempresa= $row['num_ruc_rem'];
	$axtipodoc= $row['cod_tip_cpe'];
	$axnserie= $row['txt_serie'];
	$axcorrelativo= $row['txt_correlativo'];
	$axdocumento_tipo= $row['DETALLE_DOC'];

	$LblNombreArchivo = $axrucempresa.'-'.$axtipodoc.'-'.$axnserie.'-'.$axcorrelativo.'.json';
	//echo $LblNombreArchivo;

$response=array();

if($axtipo_motivo=='04'){ //traslado entre establecimientos

	$SQLDatosCZ ="SELECT top 1 Identificador,cod_tip_cpe, txt_serie, txt_correlativo, cod_cliente_emis, num_ruc_rem, nom_rzn_soc_rem, cod_tip_nif_rem, num_ruc_dest, nom_rzn_soc_dest, cod_tip_nif_dest,num_iden_prov, nom_rzn_soc_prov, cod_tip_nif_prov, fec_emis, hora_emis, cod_ubi_partida,cod_establ_partida,num_asoc_partida,txt_domicilio_partida, txt_domicilio_llegada,cod_establ_llegada,num_asoc_llegada,cod_ubi_llegada, trans_txt_nombre, trans_txt_ruc, trans_cod_tip_nif, trans_fec_ini,cod_mot_trasalado, cant_bultos_expor, cod_unid_peso_bruto, mnt_tot_peso_bruto, trans_cod_tip_modalidad, observaciones, txt_desc_motiv_tras, dato_extra_1, dato_extra_2, dato_extra_3, dato_extra_4, vrs_guia FROM GUIA_REMISION_NS WHERE COD_GUIA_CZ='$axcod_guia_cz'";

}else{

	$SQLDatosCZ ="SELECT top 1 Identificador,cod_tip_cpe,txt_serie,txt_correlativo,cod_cliente_emis,num_ruc_rem,nom_rzn_soc_rem,cod_tip_nif_rem,num_ruc_dest,nom_rzn_soc_dest,cod_tip_nif_dest,num_iden_prov,nom_rzn_soc_prov,cod_tip_nif_prov,fec_emis,hora_emis,cod_ubi_partida,txt_domicilio_partida,txt_domicilio_llegada,cod_ubi_llegada,trans_txt_nombre,trans_txt_ruc,trans_cod_tip_nif,trans_fec_ini,cod_mot_trasalado,cant_bultos_expor,cod_unid_peso_bruto,mnt_tot_peso_bruto,trans_cod_tip_modalidad,observaciones,txt_desc_motiv_tras,dato_extra_1,dato_extra_2,dato_extra_3,dato_extra_4,vrs_guia FROM GUIA_REMISION_CZ WHERE COD_GUIA_CZ='$axcod_guia_cz'";

}


$RSDatosCZ=odbc_exec($con,$SQLDatosCZ);
//echo $SQLDatosCZ;


$filacz = odbc_fetch_array($RSDatosCZ);

$SQLDatosDT ="SELECT num_lin_item,cod_unid_item,cant_unid_item,val_vta_item,cod_tip_afect_igv_item,prc_vta_unit_item,mnt_dscto_item,mnt_igv_item,txt_descr_item,cod_prod_sunat,cod_item,val_unit_item,mnt_isc_item,importe_total_item,val_unit_icbper,cant_icbper_item,mnt_icbper_item,dato_extra_1,dato_extra_2,cod_gtin FROM GUIA_REMISION_DT WHERE COD_GUIA_CZ='$axcod_guia_cz'";


//echo $SQLDatosDT.'<br>';


$RSDatosDT=odbc_exec($con,$SQLDatosDT);
$axnum = odbc_num_rows($RSDatosDT);

for ($i=0; $i < $axnum ; $i++) { 
		
	$filaDT = odbc_fetch_array($RSDatosDT);
	$jsonDT_D[$i] = $filaDT;
}


$SQLVehiculos ="SELECT veh_iden,veh_txt_placa,veh_tarj_unic_circ,veh_reg_mtc,veh_ent_emt_auto,veh_num_autoriza FROM documentoVehiculo_json WHERE COD_GUIA_CZ='$axcod_guia_cz'";
$RSVehiculos=odbc_exec($con,$SQLVehiculos);



$axnum_v = odbc_num_rows($RSVehiculos);

for ($v=0; $v < $axnum_v ; $v++) { 
		
	$fila_V = odbc_fetch_array($RSVehiculos);
	$jsonDT_V[$v] = $fila_V;
}


$SQLChoferes ="SELECT con_iden,con_tip_iden,con_num_iden,con_nombre,con_apellido,con_num_lic FROM documentoConductor_json WHERE COD_GUIA_CZ='$axcod_guia_cz'";
$RSChoferes=odbc_exec($con,$SQLChoferes);
$axnum_c = odbc_num_rows($RSChoferes);

for ($c=0; $c < $axnum_c ; $c++) { 
		
	$fila_c = odbc_fetch_array($RSChoferes);
	$jsonDT_C[$c] = $fila_c;
}


$SQLIndicadores ="SELECT ind_nom FROM indicadores_json WHERE COD_GUIA_CZ='$axcod_guia_cz'";
$RSIndicadores=odbc_exec($con,$SQLIndicadores);
$axnum_i = odbc_num_rows($RSIndicadores);

for ($d=0; $d < $axnum_i ; $d++) { 
		
	$fila_ind = odbc_fetch_array($RSIndicadores);
	$jsonDT_ind[$d] = $fila_ind;
}

if($axtipo_motivo=='02'){//COMPRA

$array1    = $filacz;
$array5['detalles'] = $jsonDT_D;

$resultado = $array1 + $array5;

$jsonfinal_1 = json_encode($resultado,JSON_PRETTY_PRINT);	
$jsonfinal = preg_replace('#:"(\d+)"#', ':$1', $jsonfinal_1);


}else{ // VENTAS Y TRASLADOS

$array1    = $filacz;
$array2['indicador'] = $jsonDT_ind;
$array3['documentoVehiculo'] = $jsonDT_V;
$array4['documentoConductor'] = $jsonDT_C;
$array5['detalles'] = $jsonDT_D;

$resultado = $array1 +$array2+$array3+$array4+$array5;
$jsonfinal_1 = json_encode($resultado,JSON_PRETTY_PRINT);	
$jsonfinal = preg_replace('#:"(\d+)"#', ':$1', $jsonfinal_1);

} 

$file = $axruta.$LblNombreArchivo;  
file_put_contents($file, $jsonfinal);

//echo $axcod_cliente_emis;

if($axcod_cliente_emis !==''){

	$axnom_archivo = $axruta.$LblNombreArchivo;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $axurl);
	$parametros = @file_get_contents($axnom_archivo);

	//echo $parametros;

	curl_setopt( $ch, CURLOPT_POSTFIELDS, $parametros);
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization: '.trim($axtoken)));
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	$result = curl_exec($ch);
	$codigoRespuesta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	
//	echo 'Tocken '.$axtoken.' Cliente' .$axcod_cliente_emis.' axurl '.$axurl.' Ruta '.$axruta.' Respuesta '.$codigoRespuesta ;

	if($codigoRespuesta === 200){

		$SQLActualizar = "UPDATE GUIA_REMISION_CZ SET BOUCHER_DIGITAL='$LblNombreArchivo',ESTADO_ELECTRO='PROCESADA',ESTADO_ENVIADO_ITC='ENVIADO' WHERE COD_GUIA_CZ='$axcod_guia_cz'";
		$RSActualizar = odbc_exec($con, $SQLActualizar);
		//echo $codigoRespuesta.' - '.$SQLActualizar;
		
		echo $codigoRespuesta;

	}else{

    $SQLActualizar = "UPDATE GUIA_REMISION_CZ SET BOUCHER_DIGITAL='$LblNombreArchivo',ESTADO_ELECTRO='PENDIENTE',ESTADO_ENVIADO_ITC='PENDIENTE' WHERE COD_GUIA_CZ='$axcod_guia_cz'";
		$RSActualizar = odbc_exec($con, $SQLActualizar);

		//echo $codigoRespuesta.' xxx '.$SQLActualizar;

		echo $codigoRespuesta;
	
	}
	curl_close($ch);

	

	}else{

		$SQLActualizar = "UPDATE GUIA_REMISION_CZ SET BOUCHER_DIGITAL='$LblNombreArchivo',ESTADO_ELECTRO='PROCESADA',ESTADO_ENVIADO_ITC='PENDIENTE' WHERE COD_GUIA_CZ='$axcod_guia_cz'";
		$RSActualizar = odbc_exec($con, $SQLActualizar);	

		$respuesta = 0;
		echo $respuesta;
	}

break;


case '227':
	
$axid_local = $_POST['txtid_local'];
$axbuscar = $_POST['txtbuscar'];
$axfecharegistro = $_POST['txtfecharegistro'];
$axfiltro = $_POST['txtfiltro'];
$axtipodoc_emitidos_estado = $_POST['txttipodoc_emitidos_estado'];

$SQLBuscar = "SELECT * FROM DOC_GUAS_EMITIDOS_PARCIALES WHERE ID_LOCAL='$axid_local'  ORDER BY FECHA_EMISION DESC";


//echo $SQLBuscar;

	$RSBuscar = odbc_exec($con,$SQLBuscar);

	if(odbc_num_rows($RSBuscar) > 0){
	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th style='text-align: center;'>Item</th>			
			<th style='text-align: center;'>Fecha Comprobante</th>
			<th style='text-align: left;'>Cliente</th>
			<th style='text-align: left;'>Num. Comprobante</th>										
			<th style='text-align: left;'>Num. Pedido</th>							
			<th style='text-align: center;'>Acción</th>							
		</tr>
		</thead>";

		while ($fila = odbc_fetch_array($RSBuscar)) {
			
			$it=$it+1;
			$axcod_guia_cz = $fila['COD_GUIA_CZ'];	
			$axcod_mov = $fila['COD_MOV'];	
			$axlocal = $fila['LOCAL_CORTO'];	
			
			$axfecha_emision = date('d-m-Y',strtotime($fila['FECHA_EMISION']));	
			$axcomprobante = $fila['COMPROBANTE'];	
			$axcliente = $fila['RAZON_SOCIAL'];	
			$axguia = $fila['GUIA_REMISION'];	
			$axpedido = $fila['NUM_PEDIDO'];	


		
		echo "
		<tr>
			<td style='text-align: center;'>$it</td>			
			<td style='text-align: center;'>$axfecha_emision</td>			
			<td style='text-align: left;'>$axcliente</td>		
			<td style='text-align: left;'>$axcomprobante</td>			
			<td style='text-align: left;'>$axpedido</td>";

			echo "
			<td style='text-align: center;'>
				<a href='#' class='dropdown-item text-danger' id='btn_ver_detalle'   data-bs-toggle='modal' data-bs-target='#mdl_detalle_guias_parciales' data-codmov='$axcod_mov' ><b><i class='bi bi-eye-fill'></i></a></b>	
			</td>		
		</tr>";

		}
		echo "</table>";
	}

break;

case '228':

$axcod_mov = $_POST['txtcod_mov_cz'];

$SQLBuscar = "SELECT ID_PRODUCTO,COD_PRODUCTO,NOM_PRODUCTO, SUM(CANT_DESPACHADA) AS DEPACHADO FROM PEDIDOS_DESPACHO_EXTRAS WHERE COD_MOV='$axcod_mov' GROUP BY ID_PRODUCTO,COD_PRODUCTO,NOM_PRODUCTO ORDER BY COD_PRODUCTO";


//echo $SQLBuscar;

	$RSBuscar = odbc_exec($con,$SQLBuscar);

	if(odbc_num_rows($RSBuscar) > 0){
	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th style='text-align: center;'>Item</th>			
			<th style='text-align: center;'>Cod Producto</th>
			<th style='text-align: left;'>Producto</th>
			<th style='text-align: right;'>Cant. Comprobante</th>										
			<th style='text-align: right;'>Despachado</th>										
			<th style='text-align: right;'>Saldo</th>										
			
		</tr>
		</thead>";

		while ($fila = odbc_fetch_array($RSBuscar)) {
			
			$it=$it+1;		
			$axid_producto = $fila['ID_PRODUCTO'];
			$axcod_producto = $fila['COD_PRODUCTO'];	
			$axnom_producto = $fila['NOM_PRODUCTO'];	
			$axdespachado = $fila['DEPACHADO'];		
			$axcant_comprobante = get_row_two('MAESTRO_DT','CANT_SALIDA','COD_MOV','ID_PRODUCTO',$axcod_mov,$axid_producto);
			$axsaldo_1 = $axcant_comprobante-$axdespachado;

			$axsaldo = number_format($axsaldo_1,2,".",",");

		echo "
		<tr>
			<td style='text-align: center;'>$it</td>			
			<td style='text-align: center;'>$axcod_producto</td>			
			<td style='text-align: left;'>$axnom_producto</td>					
			<td style='text-align: right;'>$axcant_comprobante</td>
			<td style='text-align: right;'>$axdespachado</td>
			<td style='text-align: right;'>$axsaldo</td>
		</tr>";

		}
		echo "<tr>
			<th style='text-align: right;' colspan='6'>
				<a href='#' type='button' class='btn btn-outline-danger' data-bs-dismiss='modal'><i class='bi bi-door-closed-fill'></i> Cerrar</a>
			</th>						
		</tr>";

		echo "</table>";
	}
break;

case '229':

$axcod_guia_cz = $_POST['txtcod_guia_cz']; 	

	$SQLDelete = "UPDATE GUIA_REMISION_CZ SET ESTADO_ELECTRO='RECHAZADA' WHERE COD_GUIA_CZ='$axcod_guia_cz'";
	$RSDelete = odbc_exec($con,$SQLDelete);

	if($RSDelete){

//		$SQLDelete_cz = "DELETE FROM GUIA_REMISION_CZ WHERE COD_GUIA_CZ='$axcod_guia_cz'";
	//	$RSDelete_cz = odbc_exec($con,$SQLDelete_cz);

		$axcod_mov = get_row('MAESTRO_CZ','COD_MOV','COD_GUIA_CZ',$axcod_guia_cz);
		$axnum_pedido = get_row('PEDIDOS','NUM_PEDIDO','COD_GUIA_CZ',$axcod_guia_cz);

		$SQLActualizar_maestro = "UPDATE MAESTRO_CZ SET COD_GUIA_CZ='' WHERE COD_MOV='$axcod_mov'";
		$RSActualizar_maestro = odbc_exec($con,$SQLActualizar_maestro);

		$SQLActualizar_pedidos = "UPDATE PEDIDOS SET COD_GUIA_CZ='' WHERE NUM_PEDIDO='$axnum_pedido'";
		$RSActualizar_pedidos = odbc_exec($con,$SQLActualizar_pedidos);

		$SQLEliminar_aux = "DELETE FROM PEDIDOS_DESPACHO_EXTRAS WHERE COD_GUIA_CZ='$axcod_guia_cz'";
		$RSEliminar_aux = odbc_exec($con,$SQLEliminar_aux);

		$respuesta=0;
		echo $respuesta;

	}else{

		$respuesta=1;
		echo $respuesta;

	}	
	
break;

case '230':
	
$axcod_guia_cz = $_POST['txtcod_guia_cz']; 	

	$SQLDelete = "UPDATE GUIA_REMISION_CZ SET ESTADO_ELECTRO='ANULADA' WHERE COD_GUIA_CZ='$axcod_guia_cz'";
	$RSDelete = odbc_exec($con,$SQLDelete);

	if($RSDelete){

//		$SQLDelete_cz = "DELETE FROM GUIA_REMISION_CZ WHERE COD_GUIA_CZ='$axcod_guia_cz'";
	//	$RSDelete_cz = odbc_exec($con,$SQLDelete_cz);

		$axcod_mov = get_row('MAESTRO_CZ','COD_MOV','COD_GUIA_CZ',$axcod_guia_cz);
		$axnum_pedido = get_row('PEDIDOS','NUM_PEDIDO','COD_GUIA_CZ',$axcod_guia_cz);

		$SQLActualizar_maestro = "UPDATE MAESTRO_CZ SET COD_GUIA_CZ='' WHERE COD_GUIA_CZ='$axcod_guia_cz'";
		$RSActualizar_maestro = odbc_exec($con,$SQLActualizar_maestro);

		$SQLActualizar_pedidos = "UPDATE PEDIDOS SET COD_GUIA_CZ='' WHERE COD_GUIA_CZ='$axcod_guia_cz'";
		$RSActualizar_pedidos = odbc_exec($con,$SQLActualizar_pedidos);

		$SQLEliminar_aux = "DELETE FROM PEDIDOS_DESPACHO_EXTRAS WHERE COD_GUIA_CZ='$axcod_guia_cz'";
		$RSEliminar_aux = odbc_exec($con,$SQLEliminar_aux);

		$respuesta=0;
		echo $respuesta;

	}else{

		$respuesta=1;
		echo $respuesta;

	}	

break;

case '231':
	

$axcod_guia_cz = $_POST['txtcod_guia_cz']; 			
$axid_local = $_POST['txtid_local']; 		
//$axcod_mov_cz =get_row('GUIA_REMISION_CZ','COD_MOV','COD_GUIA_CZ',$axcod_guia_cz);		

$sqlbuscar = "SELECT * FROM MAESTRO_CZ WHERE COD_GUIA_CZ='$axcod_guia_cz' AND ID_LOCAL='$axid_local'";
$rsbuscar = odbc_exec($con,$sqlbuscar);
//echo $sqlbuscar;
if(odbc_num_rows($rsbuscar) > 0){

	while ($fila = odbc_fetch_array($rsbuscar)) {

		$axcod_mov_cz = $fila['COD_MOV'];
		$axnum_pedido= $fila['NUM_PEDIDO'];
		
		$SQLActualizar_maestro = "UPDATE MAESTRO_CZ SET COD_GUIA_CZ='' WHERE COD_MOV='$axcod_mov_cz' AND ID_LOCAL='$axid_local'";
		$RSActualizar_pedidos = odbc_exec($con,$SQLActualizar_maestro);	

			$SQLActualizar_P = "UPDATE PEDIDOS SET COD_GUIA_CZ='' WHERE NUM_PEDIDO='$axnum_pedido' AND ID_LOCAL='$axid_local'";
		$RSActualizar_p = odbc_exec($con,$SQLActualizar_p);
	
	}

		$SQLActualizar_pedidos = "UPDATE GUIA_REMISION_CZ SET ESTADO_ELECTRO='ANULADA',COD_MOV='' WHERE COD_GUIA_CZ='$axcod_guia_cz' AND ID_LOCAL='$axid_local'";
		$RSActualizar_pedidos = odbc_exec($con,$SQLActualizar_pedidos);

		if($RSActualizar_pedidos){

			$respuesta =0;
			echo $respuesta;
		}else{
			$respuesta =1;
			echo $respuesta;
		}


}

break;

case '232':
	
$axperiodo_inventario = $_POST['txtperiodo_inventario']; 	
$axfecha_del = $_POST['txtfecha_del']; 		
$axfecha_al = $_POST['txtfecha_al']; 		
$axtitulo_enviado = 'Fecha del: '. date('d-m-Y',strtotime($axfecha_del)).' al '.date('d-m-Y',strtotime($axfecha_al));

$SQLEliminar = "DELETE FROM RESUMEN_VENTAS_PERIODO";
$RSEliminar = odbc_exec($con,$SQLEliminar);
	
/***AGRUPO TODOS PRODUCTOS PADRES UTILIZADOS EN LOS PEDIDOS SEGUN EL RANGO DE FECHA***/

		$SQLBuscar_productos_2 ="SELECT ID_PRODUCTO FROM PEDIDOS_DT_2 WHERE FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al' AND TIPO_VENTA='VENTA' GROUP BY ID_PRODUCTO";	
		$RSBuscar_productos_2 = odbc_exec($con,$SQLBuscar_productos_2);

		if(odbc_num_rows($RSBuscar_productos_2) > 0){
	
			while ($row = odbc_fetch_array($RSBuscar_productos_2)) {
	
				$axid_producto_p1 = $row['ID_PRODUCTO'];

//				echo $axid_producto_p1.'<br>';

				
				$SQLVerifica_1 = "SELECT SUM(CANT_SALIDA) AS CANT, SUM(TOTAL_SALIDA) AS TOTAL,SUM(TOTAL_SALIDA)/SUM(CANT_SALIDA) AS PRC_VENTA_PROM,AVG(PRS_VENTA) AS PRS_VENDIDO,AVG(COSTO_PRODUCTO) AS PRS_COMPRA FROM PEDIDOS_DT_2 WHERE ID_PRODUCTO='$axid_producto_p1' AND FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al'  AND TIPO_VENTA='VENTA'";
				$RSVerifica_1 = odbc_exec($con,$SQLVerifica_1);
				//echo $SQLVerifica_1.'<br>';

				while ($fila_p = odbc_fetch_array($RSVerifica_1)) {			
				
					$axid_producto = $axid_producto_p1;
					$axdetalle_movimiento = 'VENTA';
					$axcod_producto = get_row('PRODUCTOS','COD_PRODUCTO','ID_PRODUCTO',$axid_producto);
					//echo $axcod_producto.' '.$axid_producto.'<br>';
					$axfamilia = trim(get_row('PRODUCTOS_LISTADO','FAMILIA','ID_PRODUCTO',$axid_producto));

					$axprecio_venta = $fila_p['PRS_VENDIDO'];									
					$axcosto_compra = $fila_p['PRS_COMPRA'];				
					$axcantidad = $fila_p['CANT'];
					$axprs_prom_venta = $fila_p['PRC_VENTA_PROM'];	

					//echo'PRS. VENTA PROMEDIO '.$axprs_prom_venta.' CANTIDAD '.$axcantidad.'<br>'.

					$axmonto_soles = $axprs_prom_venta*$axcantidad;	
					//echo $axmonto_soles.'<br>';

					//echo'PRS. COMPRA PROMEDIO '.$axcosto_compra.' CANTIDAD '.$axcantidad.'<br>'.
					$axcosto =$axcantidad*$axcosto_compra;
					//echo $axcosto.'<br>';

					$axutilidad = $axmonto_soles-$axcosto;
					//echo $axutilidad.'| '.$axmonto_soles.'<br>';

					if($axutilidad > 0){
						$axmargen =$axutilidad/$axmonto_soles;	
					}else{
						$axmargen =0;
					}
					//echo $axmargen.'<br>';

					$axid_producto_hijo = get_row('PEDIDOS','ID_PRODUCTO','ID_PRODUCTO_PADRE',$axid_producto);
					$axproveedor_1 = get_row('PRODUCTOS_PROVEEDORES','PROVEEDOR','ID_PRODUCTO',$axid_producto_hijo);
					$axproveedor = trim($axproveedor_1);
					//echo $axfamilia.'<br>';			
					
					if($axfamilia=='CK&MK - CONTENEDOR'){
						$axproveedor='CK & MK DISTRIBUCIONES S.A.C.';
						$axtipo = "OTROS";
						//echo $axid_producto.' | '.$axproveedor.' | '.$axfamilia.'<br>';
					}else{
						$axtipo = "VENTAS";
						//echo $axid_producto.' | '.$axproveedor.' | '.$axfamilia.'<br>';
					}	

					if($axproveedor==''){
							$axproveedor='CK & MK DISTRIBUCIONES S.A.C.';			
					}	
				
		
					$sqlinserta_5 = "INSERT INTO RESUMEN_VENTAS_PERIODO (PERIODO_REPORTE,ID_PRODUCTO,PRECIO_VENTA,COSTO_COMPRA,CANTIDAD,MONTO_SOLES,PRC_PROM_VENTA,POR_MARGEN,UTILIDAD_SOLES,COD_PRODUCTO,FAMILIA,PROVEEDOR,MONTO_COSTO,TIPO_MOV) VALUES ('$axperiodo_inventario','$axid_producto','$axprecio_venta','$axcosto_compra','$axcantidad','$axmonto_soles','$axprs_prom_venta','$axmargen','$axutilidad','$axcod_producto','$axfamilia','$axproveedor','$axcosto','$axtipo')";
					$rsinserta_5 = odbc_exec($con,$sqlinserta_5);
				//echo $sqlinserta_5.'<br>';

				}
			}
		}


		

		

	
break;

case '233':
	
$axperiodo_inventario = $_POST['txtperiodo_inventario']; 		

$SQLTipo = "SELECT TIPO_MOV FROM RESUMEN_VENTAS_PERIODO WHERE PERIODO_REPORTE='$axperiodo_inventario' GROUP BY TIPO_MOV ORDER BY TIPO_MOV DESC";
$RSTipo = odbc_exec($con,$SQLTipo);

//echo $SQLTipo;

if(odbc_num_rows($RSTipo) > 0){

	echo "

	<div style='margin-top:5px; padding:5px; text-align: right;'>
		<a href='#' class='btn btn-outline-success btn-sm' onclick='exportar_excel()' ><b> <i class='bi bi-file-earmark-excel-fill'></i> Excel</b></a>
		<button type='button' id='btn_imprimir_reporte' class='btn btn-danger btn-sm'><i class='bi bi-filetype-pdf'></i> Pdf</button>	

		<button type='button' class='btn btn-primary btn-sm' id='btn_ver_detalle' title='Click para visualizar el detalle de los comprobantes emitidos...' data-bs-toggle='modal' data-bs-target='#mdl_ver_detalle' title='Sustento de todos los comprobantes que generan el reporte...'><i class='bi bi-card-list'></i> Sustento</button>	
	</div>
		
	<table class='table table-hover table-bordered table-sm' id='tbl_ventas'>
		<thead class='table-primary'>			
		<tr>
			<th style='text-align: left; width:3%;'><a href='#' style='text-decoration:none;' id='btn_ordenar' title='Te permite ordenar los proveedores a su criterio...' data-bs-toggle='modal' data-bs-target='#mdl_ordenar_proveedores'>Tipo</a></th>
			<th style='text-align: left; width:5%;'>Proveedor</th>
			<th style='text-align: left;'>Familia</th>
			<th style='text-align: center;'>Código</th>
			<th style='text-align: left;'>Descripción</th>
			<th style='text-align: right;background-color:#402E4E; color:white;'>Precios</th>
			<th style='text-align: right; background-color:#402E4E; color:white;'>Costo</th>
			<th style='text-align: right; background-color:#D20808; color:white;'>Unid</th>
			<th style='text-align: right; background-color:#2D682D; color:white;'>Soles</th>
			<th style='text-align: right; background-color:#2A4EAC; color:white;'>Promedio</th>
			<th style='text-align: right;'>Total Costo</th>
			<th style='text-align: right; background-color:#402E4E; color:white;'>% Margen</th>
			<th style='text-align: right; background-color:#916162; color:white;'>Util. Soles</th>
			<th style='text-align: right; background-color:#C49FDA; color:white;'>Prom.- Soles</th>
			<th style='text-align: right; background-color:#C49FDA; color:white;'>MG</th>
		</tr>
		</thead>";

		  // Variable para almacenar el proveedor y familia actual
        $proveedorActual = '';
        $familiaActual = '';
        $tipoactual = '';

		while ($fila_p=odbc_fetch_array($RSTipo)) {
			echo "<tr>"; 		 			
	 				$axtipo = $fila_p['TIPO_MOV'];	


	 				echo "<td style='text-align: left; background-color:#E3DFEB; width:3%;' colspan='15'><b>".$axtipo."</b>";	
				 			
				 			$SQLProveedores = "SELECT NUM_ORDEN,PROVEEDOR FROM RESUMEN_VENTAS_PERIODO WHERE PERIODO_REPORTE='$axperiodo_inventario' AND TIPO_MOV='$axtipo' GROUP by NUM_ORDEN,PROVEEDOR ORDER BY NUM_ORDEN ASC";
	 						//echo $SQLProveedores.'<br>'; 
							$RSProveedores = odbc_exec($con,$SQLProveedores);

							while ($fila_prov = odbc_fetch_array($RSProveedores)) {
								echo "<tr>";
								$axproveedor = $fila_prov['PROVEEDOR'];
								
								if($axproveedor !==$proveedorActual){									
									echo "<td style='text-align: left;' ></td> ";				 			
									echo "<td style='text-align: left;' colspan='4'><b>".$axproveedor."</b></td> ";				 			
 									$proveedorActual=$axproveedor;
								} 					
				 				echo "</tr>";		

				 				$SQLFamilias = "SELECT FAMILIA FROM RESUMEN_VENTAS_PERIODO WHERE PERIODO_REPORTE='$axperiodo_inventario' AND TIPO_MOV='$axtipo' AND PROVEEDOR='$axproveedor' GROUP BY FAMILIA ORDER BY FAMILIA ASC";
	 							//echo $SQLFamilias.'<br>'; 
								$RSFamilias = odbc_exec($con,$SQLFamilias);
								$familiaActual_1 = '';

								while ($fila_fam = odbc_fetch_array($RSFamilias)){
									echo "<tr>";
										$axfamilia_1 = $fila_fam['FAMILIA'];

										echo "<td style='text-align: left;' ></td> ";				 			
										echo "<td style='text-align: left;' ></td> ";				 			
													 			

										if($axfamilia_1 !==$familiaActual_1){
					 						echo "<td style='text-align: left;' colspan='3'>

					 						<a href='#'style='text-decoration:none;' data-tipo='$axtipo' data-prov='$axproveedor' data-fam='$axfamilia_1' data-mv='$axmeta_venta' data-mc='$axmeta_costo' data-bs-toggle='modal' data-bs-target='#mdl_cambiar_tipo' id='btn_editar_reporte' title='Te permite cambiar el nombre del Tipo de movimiento (VENTAS ó OTROS), de igualmanera tambien puedes cambiar el nombre del PROVEEDOR'><b>".$axfamilia_1."</b></a>

					 						</td> ";




	 										$familiaActual_1=$axfamilia_1;
		 								}else{
		 									echo "<td style='text-align: left;'></td>";
		 								}
									echo "</tr>";

											$SQLProductos = "SELECT * FROM RESUMEN_VENTAS_PERIODO WHERE PERIODO_REPORTE='$axperiodo_inventario' AND TIPO_MOV='$axtipo' AND PROVEEDOR='$axproveedor' AND FAMILIA='$axfamilia_1'  ORDER BY COD_PRODUCTO ASC";
			 								//echo $SQLFamilias.'<br>'; 
											$RSProductos = odbc_exec($con,$SQLProductos);

											while ($fila_detalle = odbc_fetch_array($RSProductos)) {
											echo "<tr>";

											$axcodigo = $fila_detalle['COD_PRODUCTO'];		 																								

							 				$axproducto = get_row('PRODUCTOS','NOM_PRODUCTO','COD_PRODUCTO',$axcodigo);
							 				$axprecio =number_format($fila_detalle['PRECIO_VENTA'],2,".",",");  
							 				$axcosto_producto = number_format($fila_detalle['COSTO_COMPRA'],2,".",","); 
							 				$axcantidad = number_format($fila_detalle['CANTIDAD'],2,".",","); 
							 				$axsoles = number_format($fila_detalle['MONTO_SOLES'],2,".",","); 
							 				$axprc_venta_prom = number_format($fila_detalle['PRC_PROM_VENTA'],2,".",","); 
							 				
							 				$axutilida = number_format($fila_detalle['UTILIDAD_SOLES'],2,".",","); 
							 				$axtotal_costo_1 = $fila_detalle['CANTIDAD']*$fila_detalle['COSTO_COMPRA'];
							 				$axtotal_costo = number_format($axtotal_costo_1,2,".",","); 
							 				$axmargen_1 = $fila_detalle['POR_MARGEN']*100; 
							 				$axmargen = number_format($axmargen_1,2,".",","); 
							 				$axprom_soles =$fila_detalle['PRC_PROM_VENTA']-$fila_detalle['PRECIO_VENTA'];
							 				$prom_soles = number_format($axprom_soles,2,".",","); 

							 				$axmg_1 =($fila_detalle['UTILIDAD_SOLES']/$fila_detalle['MONTO_SOLES'])*100;
							 				$axmg = number_format($axmg_1,2,".",","); 	

							 				$axfamilia_1 = $fila_detalle['FAMILIA'];			 	
							 				$axid_reporte = $fila_detalle['ID_REPORTE'];	

							 				echo "
							 					<td style='text-align: left;'></td> 							 					
							 					<td style='text-align: left;'></td> 							 					
							 					<td style='text-align: left;'></td> 							 					
							 					<td style='text-align: center;'><a href='#' style='text-decoration:none;' data-id='$axid_reporte' data-tipo='$axtipo' data-prov='$axproveedor' data-fam='$axfamilia_1' data-mv='$axmeta_venta' data-mc='$axmeta_costo' data-bs-toggle='modal' data-bs-target='#mdl_cambiar_tipo' id='btn_editar_reporte' title='Actualizar TIPO MOV del producto...'>".$axcodigo."</a></td>

							 					<td style='text-align: left;'>".$axproducto."</td> 
						 						<td style='text-align: right; background-color:#FBFCC5;'>".$axprecio."</td> 
						 						<td style='text-align: right;'>".$axcosto_producto."</td> 

						 						<td style='text-align: right; background-color:#FBFCC5;'>".$axcantidad."</td> 
						 						<!--td style='text-align: right; background-color:#FBFCC5;'><a href='#'style='text-decoration:none;' id='btn_ver_detalle' title='Click para visualizar el detalle de los comprobantes emitidos...' data-bs-toggle='modal' data-bs-target='#mdl_ver_detalle' data-id='$axcodigo'>".$axcantidad."</a></td--> 

						 						<td style='text-align: right;'>".$axsoles."</td> 
						 						<td style='text-align: right; background-color:#FBFCC5;'>".$axprc_venta_prom."</td> 
						 						<td style='text-align: right;'>".$axtotal_costo."</td> 
						 						<td style='text-align: right; background-color:#E3DFEB;'>".$axmargen."%</td>"; 

						 							if($fila_p['UTILIDAD_SOLES'] < 0 ){
						 								echo "<td style='text-align: right;'><b class='text-danger'>".$axutilida."</b></td>";
						 							}else{
						 								echo "<td style='text-align: right;'>".$axutilida."</td>"; 
						 							}

								 					if($axprom_soles < 0 ){
								 						echo "<td style='text-align: right;'><b class='text-danger'> ".$prom_soles." <i class='bi bi-hand-thumbs-down-fill'></i></b></td>";
								 					}elseif($axprom_soles == 0){
								 						echo "<td style='text-align: right;'><b class='text-success'>  ".$prom_soles." <i class='bi bi-emoji-neutral-fill'></i></b></td>"; 
								 					}else{
								 						echo "<td style='text-align: right;'><b class='text-success'>  ".$prom_soles." <i class='bi bi-hand-thumbs-up-fill'></i></b></td>"; 
								 					}

								 					if($axmg_1 < 0 ){
								 						echo "<td style='text-align: right;'><b class='text-danger'>".$axmg."</b></td>";
								 					}else{
								 						echo "<td style='text-align: right;'><b class='text-success'>".$axmg."%</b></td>"; 
								 					}
											
											echo "</tr>";				
											}/**WHILE PRODUCTOS**/
								

											$sql_totales_general_fam = "SELECT SUM(CANTIDAD) AS T_UND,SUM(MONTO_SOLES) AS T_SOLES,SUM(MONTO_SOLES)/SUM(CANTIDAD) AS T_PROM, SUM(MONTO_COSTO) AS T_COSTO,SUM(UTILIDAD_SOLES) AS T_UT_SOLES,(SUM(UTILIDAD_SOLES)/SUM(MONTO_SOLES)*100) AS T_MARG FROM RESUMEN_VENTAS_PERIODO WHERE PERIODO_REPORTE='$axperiodo_inventario' AND TIPO_MOV='$axtipo' AND PROVEEDOR='$axproveedor' AND FAMILIA='$axfamilia_1'";
							//echo $sql_totales_general_fam.'<br>';
							 	$rs_totales_general_fam = odbc_exec($con,$sql_totales_general_fam);

							 	while ($fila_general_fam = odbc_fetch_array($rs_totales_general_fam)) {
							 		$axtotal_cant_fam = number_format($fila_general_fam['T_UND'],2,".",",");
							 		$axtotal_soles_fam = number_format($fila_general_fam['T_SOLES'],2,".",",");
							 		$axtotal_prom_fam = number_format($fila_general_fam['T_PROM'],2,".",",");
							 		$axtotal_costo_fam = number_format($fila_general_fam['T_COSTO'],2,".",",");
							 		$axtotal_ut_soles_fam = number_format($fila_general_fam['T_UT_SOLES'],2,".",",");
							 		$axtotal_mg_fam = number_format($fila_general_fam['T_MARG'],2,".",",");

							 		echo "
							 		<tr>
							 			<td style='text-align: left;'></td> 							 					
							 			<td style='text-align: left;'></td> 							 					
							 			<td style='text-align: left; background-color:#DAEEF4;' colspan='5'><b>Total - ".$axfamilia_1."</b></td>
							 			<td style='text-align: right; background-color:#DAEEF4;' ><b>".$axtotal_cant_fam."</b></td>
							 			<td style='text-align: right; background-color:#DAEEF4;' ><b>".$axtotal_soles_fam."</b></td>
							 			<td style='text-align: right; background-color:#DAEEF4;' ><b>".$axtotal_prom_fam."</b></td>
							 			<td style='text-align: right; background-color:#DAEEF4;' ><b>".$axtotal_costo_fam."</b></td>							 			
							 			<td style='text-align: right; background-color:#DAEEF4;' ><b>".$axtotal_mg_fam."%</b></td>
							 			<td style='text-align: right; background-color:#DAEEF4;' ><b>".$axtotal_ut_soles_fam."</b></td>
							 			<td style='text-align: right; background-color:#DAEEF4;' ><b></b></td>
							 			<td style='text-align: right; background-color:#DAEEF4;' ><b>".$axtotal_mg_fam."%</b></td>

							 			<tr>
							 		";
							 	}



								}/*** while familia**/


								$sql_totales_general_prov = "SELECT SUM(CANTIDAD) AS T_UND,SUM(MONTO_SOLES) AS T_SOLES,SUM(MONTO_SOLES)/SUM(CANTIDAD) AS T_PROM, SUM(MONTO_COSTO) AS T_COSTO,SUM(UTILIDAD_SOLES) AS T_UT_SOLES,(SUM(UTILIDAD_SOLES)/SUM(MONTO_SOLES)*100) AS T_MARG FROM RESUMEN_VENTAS_PERIODO WHERE PERIODO_REPORTE='$axperiodo_inventario' AND TIPO_MOV='$axtipo' AND PROVEEDOR='$axproveedor'";
								//echo $sql_totales_general_prov.'<br>';
							 	$rs_totales_genera_prov = odbc_exec($con,$sql_totales_general_prov);

							 	while ($fila_general_prov = odbc_fetch_array($rs_totales_genera_prov)) {
							 		$axtotal_cant_prov = number_format($fila_general_prov['T_UND'],2,".",",");
							 		$axtotal_soles_prov = number_format($fila_general_prov['T_SOLES'],2,".",",");
							 		$axtotal_prom_prov = number_format($fila_general_prov['T_PROM'],2,".",",");
							 		$axtotal_costo_prov = number_format($fila_general_prov['T_COSTO'],2,".",",");
							 		$axtotal_ut_soles_prov = number_format($fila_general_prov['T_UT_SOLES'],2,".",",");
							 		$axtotal_mg_prov = number_format($fila_general_prov['T_MARG'],2,".",",");

							 		echo "
							 		<tr>
							 			<td style='text-align: left;'  colspan='1'></td> 							 					
							 			<td style='text-align: left; background-color:#ECF0E1;' colspan='6'><b>Total - ".$axproveedor."</b></td>
							 			<td style='text-align: right; background-color:#ECF0E1;' ><b>".$axtotal_cant_prov."</b></td>
							 			<td style='text-align: right; background-color:#ECF0E1;' ><b>".$axtotal_soles_prov."</b></td>
							 			<td style='text-align: right; background-color:#ECF0E1;' ><b>".$axtotal_prom_prov."</b></td>
							 			<td style='text-align: right; background-color:#ECF0E1;' ><b>".$axtotal_costo_prov."</b></td>							 			
							 			<td style='text-align: right; background-color:#ECF0E1;' ><b>".$axtotal_mg_prov."%</b></td>
							 			<td style='text-align: right; background-color:#ECF0E1;' ><b>".$axtotal_ut_soles_prov."</b></td>
							 			<td style='text-align: right; background-color:#ECF0E1;' ><b></b></td>
							 			<td style='text-align: right; background-color:#ECF0E1;' ><b>".$axtotal_mg_prov."%</b></td>

							 			<tr>
							 		";
							 	}
		 			
								
	 						} /**WHILE PROVEEDOR**/		

	 						echo "</tr>"; 

	 			$sql_totales_general = "SELECT SUM(CANTIDAD) AS T_UND,SUM(MONTO_SOLES) AS T_SOLES,SUM(MONTO_SOLES)/SUM(CANTIDAD) AS T_PROM, SUM(MONTO_COSTO) AS T_COSTO,SUM(UTILIDAD_SOLES) AS T_UT_SOLES,(SUM(UTILIDAD_SOLES)/SUM(MONTO_SOLES)*100) AS T_MARG FROM RESUMEN_VENTAS_PERIODO WHERE PERIODO_REPORTE='$axperiodo_inventario' AND TIPO_MOV='$axtipo'";
				//echo $sql_totales_general.'<br>';
							 	$rs_totales_general = odbc_exec($con,$sql_totales_general);

							 	while ($fila_general = odbc_fetch_array($rs_totales_general)) {
							 		$axtotal_cant = number_format($fila_general['T_UND'],2,".",",");
							 		$axtotal_soles = number_format($fila_general['T_SOLES'],2,".",",");
							 		$axtotal_prom = number_format($fila_general['T_PROM'],2,".",",");
							 		$axtotal_costo = number_format($fila_general['T_COSTO'],2,".",",");
							 		$axtotal_ut_soles = number_format($fila_general['T_UT_SOLES'],2,".",",");
							 		$axtotal_mg = number_format($fila_general['T_MARG'],2,".",",");

							 		echo "
							 		<tr>
							 			<td style='text-align: left; background-color:#E3DFEB;' colspan='7'><b>Total - ".$axtipo."</b></td>
							 			<td style='text-align: right; background-color:#E3DFEB;' ><b>".$axtotal_cant."</b></td>
							 			<td style='text-align: right; background-color:#E3DFEB;' ><b>".$axtotal_soles."</b></td>
							 			<td style='text-align: right; background-color:#E3DFEB;' ><b>".$axtotal_prom."</b></td>
							 			<td style='text-align: right; background-color:#E3DFEB;' ><b>".$axtotal_costo."</b></td>							 			
							 			<td style='text-align: right; background-color:#E3DFEB;' ><b>".$axtotal_mg."%</b></td>
							 			<td style='text-align: right; background-color:#E3DFEB;' ><b>".$axtotal_ut_soles."</b></td>
							 			<td style='text-align: right; background-color:#E3DFEB;' ><b></b></td>
							 			<td style='text-align: right; background-color:#E3DFEB;' ><b>".$axtotal_mg."%</b></td>

							 			<tr>
							 		";
							 	}
	 		echo "<tr><td colspan='15'></td><tr>";				
	 		
		} /**WHILE TIPO**/ 

		$sql_totales_general_T = "SELECT SUM(CANTIDAD) AS T_UND,SUM(MONTO_SOLES) AS T_SOLES,SUM(MONTO_SOLES)/SUM(CANTIDAD) AS T_PROM, SUM(MONTO_COSTO) AS T_COSTO,SUM(UTILIDAD_SOLES) AS T_UT_SOLES,(SUM(UTILIDAD_SOLES)/SUM(MONTO_SOLES)*100) AS T_MARG FROM RESUMEN_VENTAS_PERIODO WHERE PERIODO_REPORTE='$axperiodo_inventario'";
				//echo $sql_totales_general_T.'<br>';
							 	$rs_totales_general_T = odbc_exec($con,$sql_totales_general_T);

							 	while ($fila_general_T = odbc_fetch_array($rs_totales_general_T)) {

							 			$axtotal_cant_T = number_format($fila_general_T['T_UND'],2,".",",");
							 		$axtotal_soles_T = number_format($fila_general_T['T_SOLES'],2,".",",");
							 		$axtotal_prom_T = number_format($fila_general_T['T_PROM'],2,".",",");
							 		$axtotal_costo_T = number_format($fila_general_T['T_COSTO'],2,".",",");
							 		$axtotal_ut_soles_T = number_format($fila_general_T['T_UT_SOLES'],2,".",",");
							 		$axtotal_mg_T = number_format($fila_general_T['T_MARG'],2,".",",");


							 		echo "
							 		<tr>
							 			<td style='text-align: left; background-color:#9EE4FF;' colspan='7'><b>Total General</b></td>
							 			<td style='text-align: right; background-color:#9EE4FF;' ><b>".$axtotal_cant_T."</b></td>
							 			<td style='text-align: right; background-color:#9EE4FF;' ><b>".$axtotal_soles_T."</b></td>
							 			<td style='text-align: right; background-color:#9EE4FF;' ><b>".$axtotal_prom_T."</b></td>
							 			<td style='text-align: right; background-color:#9EE4FF;' ><b>".$axtotal_costo_T."</b></td>							 			
							 			<td style='text-align: right; background-color:#9EE4FF;' ><b>".$axtotal_mg_T."%</b></td>
							 			<td style='text-align: right; background-color:#9EE4FF;' ><b>".$axtotal_ut_soles."</b></td>
							 			<td style='text-align: right; background-color:#9EE4FF;' ><b></b></td>
							 			<td style='text-align: right; background-color:#9EE4FF;' ><b>".$axtotal_mg_T."%</b></td>

							 			<tr>
							 		";

							 	}

		

	 	echo "</table>";		
		
}  /** IF TIPO **/	 			

break;

case '234':
	
$axperiodo_inventario = $_POST['txtperiodo_inventario']; 		
$axmeta_ventas = $_POST['txtmeta_ventas']; 		
$axmeta_costo = $_POST['txtmeta_costo']; 		
$axtipo_mov = $_POST['txttipo_mov']; 		
$axproveedor = utf8_decode($_POST['txtproveedor']); 		
$axproveedor_cambiar = utf8_decode($_POST['txtproveedor_cambiar']); 		
$axfamilia = $_POST['txtfamilia']; 		
$axid_reporte = $_POST['txtid_reporte']; 		

if($axid_reporte==''){

$sqlactualizar = "UPDATE RESUMEN_VENTAS_PERIODO SET TIPO_MOV='$axtipo_mov',PROVEEDOR='$axproveedor_cambiar' WHERE PERIODO_REPORTE='$axperiodo_inventario' AND FAMILIA='$axfamilia' AND PROVEEDOR='$axproveedor'";
//echo $sqlactualizar;
$rsactualizar = odbc_exec($con,$sqlactualizar);

if($rsactualizar){

	//$sqlactualizar_T = "UPDATE RESUMEN_VENTAS_PERIODO SET META_VENTA='$axmeta_ventas', META_COSTO='$axmeta_costo' WHERE PERIODO_REPORTE='$axperiodo_inventario'";	
	//$rsactualizar_T = odbc_exec($con,$sqlactualizar_T);

	$respuesta =0;
	echo $respuesta;

}else{

	$respuesta =1;
	echo $respuesta;

}


}else{

$sqlactualizar = "UPDATE RESUMEN_VENTAS_PERIODO SET TIPO_MOV='$axtipo_mov'WHERE PERIODO_REPORTE='$axperiodo_inventario' AND ID_REPORTE='$axid_reporte'";
//echo $sqlactualizar;
$rsactualizar = odbc_exec($con,$sqlactualizar);

if($rsactualizar){
	
	$respuesta =0;
	echo $respuesta;

}else{

	$respuesta =1;
	echo $respuesta;

}

}

break;


case '235':
	
$axnum_pedido_original = $_POST['txtnum_pedido_original']; 		

$sqllistar = "SELECT * FROM PEDIDOS_PARCIAL WHERE NUM_PEDIDO ='$axnum_pedido_original'";
$rslistar = odbc_exec($con,$sqllistar);

	echo "
		
		<table class='table table-hover table-sm' >
		<thead class='table-primary'>			
		<tr>
			<th style='text-align: center;'>Cód Padre</th>
			<th style='text-align: center;'>Cód Hijo</th>
			<th style='text-align: left;'>Producto</th>
			<th style='text-align: center;'>Unidad</th>
			<th style='text-align: right;'>Cantidad</th>
		</tr>
		</thead>";

	$axcod_producto_padre_Actual = '';

	while ($fila = odbc_fetch_array($rslistar)) {

		

		$axid_producto = $fila['ID_PRODUCTO'];
		$axid_producto_padre = $fila['ID_PRODUCTO_PADRE'];
		$axcod_producto = get_row('PRODUCTOS','COD_PRODUCTO','ID_PRODUCTO',$axid_producto);
		$axnom_producto = get_row('PRODUCTOS','NOM_PRODUCTO','ID_PRODUCTO',$axid_producto);
		$axund_producto = get_row('PRODUCTOS','PRESENTACION','ID_PRODUCTO',$axid_producto);
		$axcant_salida= $fila['CANT_SALIDA'];
		$axcod_producto_padre = get_row('PRODUCTOS','COD_PRODUCTO','ID_PRODUCTO',$axid_producto_padre);	

		echo "<tr>";
			if($axcod_producto_padre !==$axcod_producto_padre_Actual){									
				echo "<td style='text-align: center;'>".$axcod_producto_padre."</td>";
 				$axcod_producto_padre_Actual=$axcod_producto_padre;
			}else{
				echo "<td style='text-align: center;'></td>";
			}
				
		echo "
				<td style='text-align: center;'>".$axcod_producto."</td>
				<td style='text-align: left;'>".$axnom_producto."</td>
				<td style='text-align: center;'>".$axund_producto."</td>
				<td style='text-align: right;'>".$axcant_salida."</td>
		</tr>";
	}

	$sqllistar_T = "SELECT SUM(CANT_SALIDA) AS CANT FROM PEDIDOS_PARCIAL WHERE NUM_PEDIDO ='$axnum_pedido_original' GROUP BY NUM_PEDIDO";
	$rslistar_T = odbc_exec($con,$sqllistar_T);
	$fila_T = odbc_fetch_array($rslistar_T);
	$axcant_salida_t =$fila_T['CANT'];

		echo "<tr>
				<th style='text-align: right;' colspan='4'><b>Total Cantidad</b></th>				
				<th style='text-align: right;'><b>".$axcant_salida_t."</b></th>
		</tr>";

	echo "</table>";

break;

case '236':
	
$axdato = $_POST['txtprec_moficar']; 		
$axid_producto = $_POST['txtid_producto']; 		
$axperiodo = $_POST['txtperiodo_inventario']; 		
$axtitulo = $_POST['txtitulo']; 		
$tipo = $_POST['axtipo']; 		



if($tipo=='precio'){
	$sqlactualizar = "UPDATE PRODUCTOS_INVENTARIOS SET PRC_COMPRA_PROM='$axdato' WHERE ID_PRODUCTO='$axid_producto' AND PERIODO_INVENTARIO='$axperiodo' AND TITULO='$axtitulo'";
}elseif($tipo=='cant'){
	$sqlactualizar = "UPDATE PRODUCTOS_INVENTARIOS SET STOCK_ANTERIOR='$axdato' WHERE ID_PRODUCTO='$axid_producto' AND PERIODO_INVENTARIO='$axperiodo' AND TITULO='$axtitulo'";
}


$rsactualizar = odbc_exec($con,$sqlactualizar);

if($rsactualizar){

	$respuesta = 0;
	echo $respuesta;

}else{

	$respuesta = 1;
	echo $respuesta;

}

break;

case '237':

$axperiodo = $_POST['txtperiodo_inventario']; 		

$SQLCierre = "SELECT * FROM CIERRE_JULIO_FINAL ORDER BY COD ASC";
$RSCierre = odbc_exec($con,$SQLCierre);

while ($fila_c = odbc_fetch_array($RSCierre)) {
	
	$axcod = $fila_c['COD'];

	$axcod1= $fila_c['COD1'];
	$axcosto1= $fila_c['COSTO_1'];

	$SQLCod_1 = "UPDATE PRODUCTOS_INVENTARIOS SET PRC_COMPRA_PROM='$axcosto1',ACTUALIZAR='SI' WHERE COD_PRODUCTO='$axcod1' AND PERIODO_INVENTARIO='$axperiodo'";
	$RSCod_1 = odbc_exec($con,$SQLCod_1);

	$axcod2= $fila_c['COD2'];
	$axcosto2= $fila_c['COSTO_2'];

	if($axcod2 !=='SN00'){
		$SQLCod_2 = "UPDATE PRODUCTOS_INVENTARIOS SET PRC_COMPRA_PROM='$axcosto2',ACTUALIZAR='SI' WHERE COD_PRODUCTO='$axcod2' AND PERIODO_INVENTARIO='$axperiodo'";
		$RSCod_2 = odbc_exec($con,$SQLCod_2);	
	}

	$axcod3= $fila_c['COD3'];
	$axcosto3= $fila_c['COSTO_3'];

	if($axcod3 !=='SN00'){
		$SQLCod_3 = "UPDATE PRODUCTOS_INVENTARIOS SET PRC_COMPRA_PROM='$axcosto3',ACTUALIZAR='SI' WHERE COD_PRODUCTO='$axcod3' AND PERIODO_INVENTARIO='$axperiodo'";
		$RSCod_3 = odbc_exec($con,$SQLCod_3);	
	}

		

}

break;

case '238':
	
$axperiodo_inventario = $_POST['txtperiodo_inventario']; 	

$año = substr($axperiodo_inventario,3,4);
$mes = substr($axperiodo_inventario,0,2);

$ultimoDia = date("t", strtotime("$año-$mes-01"));
//echo $ultimoDia.' | '.$año;

$axfecha_del = $año.'-'.$mes.'-01';
$axfecha_al = $año.'-'.$mes.'-'.$ultimoDia;
$axtitulo_enviado = 'Fecha del: '. date('d-m-Y',strtotime($axfecha_del)).' al '.date('d-m-Y',strtotime($axfecha_al));

$SQLEliminar = "DELETE FROM RESUMEN_VENTAS_PERIODO";
$RSEliminar = odbc_exec($con,$SQLEliminar);
	
/***AGRUPO TODOS PRODUCTOS PADRES UTILIZADOS EN LOS PEDIDOS SEGUN EL RANGO DE FECHA***/

		$SQLBuscar_productos_2 ="SELECT ID_PRODUCTO FROM PEDIDOS_DT_2 WHERE FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al' AND TIPO_VENTA='VENTA' GROUP BY ID_PRODUCTO";	
		$RSBuscar_productos_2 = odbc_exec($con,$SQLBuscar_productos_2);

		if(odbc_num_rows($RSBuscar_productos_2) > 0){
	
			while ($row = odbc_fetch_array($RSBuscar_productos_2)) {
	
				$axid_producto_p1 = $row['ID_PRODUCTO'];
				
				$SQLVerifica_1 = "SELECT SUM(CANT_SALIDA) AS CANT, SUM(TOTAL_SALIDA) AS TOTAL,SUM(TOTAL_SALIDA)/SUM(CANT_SALIDA) AS PRC_VENTA_PROM,AVG(PRS_VENTA) AS PRS_VENDIDO,AVG(COSTO_PRODUCTO) AS PRS_COMPRA FROM PEDIDOS_DT_2 WHERE ID_PRODUCTO='$axid_producto_p1' AND FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al'  AND TIPO_VENTA='VENTA'";
				$RSVerifica_1 = odbc_exec($con,$SQLVerifica_1);
				//echo $SQLVerifica_1.'<br>';

				while ($fila_p = odbc_fetch_array($RSVerifica_1)) {			
				
					$axid_producto = $axid_producto_p1;
					$axdetalle_movimiento = 'VENTA';
					$axcod_producto = get_row('PRODUCTOS','COD_PRODUCTO','ID_PRODUCTO',$axid_producto);
					$axfamilia = trim(get_row('PRODUCTOS_LISTADO','FAMILIA','ID_PRODUCTO',$axid_producto));

					$axprecio_venta = $fila_p['PRS_VENDIDO'];									
					$axcosto_compra = $fila_p['PRS_COMPRA'];				
					$axcantidad = $fila_p['CANT'];
					$axprs_prom_venta = $fila_p['PRC_VENTA_PROM'];	

					//echo'PRS. VENTA PROMEDIO '.$axprs_prom_venta.' CANTIDAD '.$axcantidad.'<br>'.

					$axmonto_soles = $axprs_prom_venta*$axcantidad;	
					//echo $axmonto_soles.'<br>';

					//echo'PRS. COMPRA PROMEDIO '.$axcosto_compra.' CANTIDAD '.$axcantidad.'<br>'.
					$axcosto =$axcantidad*$axcosto_compra;
					//echo $axcosto.'<br>';

					$axutilidad = $axmonto_soles-$axcosto;
					//echo $axutilidad.'| '.$axmonto_soles.'<br>';

					if($axutilidad > 0){
						$axmargen =$axutilidad/$axmonto_soles;	
					}else{
						$axmargen =0;
					}
					//echo $axmargen.'<br>';
					$axid_producto_hijo = get_row('PEDIDOS','ID_PRODUCTO','ID_PRODUCTO_PADRE',$axid_producto);
					$axproveedor_1 = get_row('PRODUCTOS_PROVEEDORES','PROVEEDOR','ID_PRODUCTO',$axid_producto_hijo);
					$axproveedor = trim($axproveedor_1);		

					//echo $axfamilia.'<br>';			
					
					if($axfamilia=='CK&MK - CONTENEDOR'){
						$axproveedor='CK&MK';
						//echo $axproveedor.' | '.$axfamilia.'<br>';
					}	

					
		
					$sqlinserta_5 = "INSERT INTO RESUMEN_VENTAS_PERIODO (PERIODO_REPORTE,ID_PRODUCTO,PRECIO_VENTA,COSTO_COMPRA,CANTIDAD,MONTO_SOLES,PRC_PROM_VENTA,POR_MARGEN,UTILIDAD_SOLES,COD_PRODUCTO,FAMILIA,PROVEEDOR,MONTO_COSTO,TIPO_MOV) VALUES ('$axperiodo_inventario','$axid_producto','$axprecio_venta','$axcosto_compra','$axcantidad','$axmonto_soles','$axprs_prom_venta','$axmargen','$axutilidad','$axcod_producto','$axfamilia','$axproveedor','$axcosto','VENTA')";
					$rsinserta_5 = odbc_exec($con,$sqlinserta_5);
				//echo $sqlinserta_5.'<br>';

				}
			}
		}

break;

case '239':
	
 $axbuscar_dato =$_POST['txtbuscar_prod_inventario'];
 $axperiodo_inventario = $_POST['txtperiodo_inventario']; 	
   
 if(isset($_POST["txtbuscar_prod_inventario"])){

	$output ="";
	$idprov ="";
	//$sqlemisor = "SELECT * FROM PRODUCTOS_VENTAS_PERIODO WHERE PERIODO_REPORTE='$axperiodo_inventario' AND BUSCAR  LIKE  '%".$axbuscar_dato."%' ORDER BY NOM_PRODUCTO";
	//$sqlemisor = "SELECT * FROM PRODUCTOS_COMPLEMENTOS_TRANSFORMAR WHERE COD_PRODUCTO+NOM_PRODUCTO  LIKE  '%".$axbuscar_dato."%' ORDER BY NOM_PRODUCTO";
	$sqlemisor = "SELECT * FROM PRODUCTOS WHERE COD_PRODUCTO+NOM_PRODUCTO  LIKE  '%".$axbuscar_dato."%' ORDER BY NOM_PRODUCTO";
	//echo $sqlemisor;

	$rsemisor=odbc_exec($con,$sqlemisor);	
	$output ='<ul class="list-group">';  		

	if(odbc_num_rows($rsemisor) > 0){
		 while ($row=odbc_fetch_array($rsemisor)){	

		 	$id = $row['ID_PRODUCTO'];		
		 	$nom_prod =  trim($row["NOM_PRODUCTO"]);
		 	$dato = utf8_encode($row["COD_PRODUCTO"].' | '.$row["NOM_PRODUCTO"]);
		 	
		 	$output .='<a href="#" id="btn_producto_ver" data-idprod='.$id.' class="list-group-item list-group-item-action" style="background:#DAF5FF;">'.$dato.'</a>';
		 }



	}else{
		

		$output .='<a href="#" class="list-group-item list-group-item-action bg-danger">xxxx</a>';
	
	}

	$output .='</ul>';
	echo $output;

}else{
	echo $output;	
}

break;

case '240': //**ELIMINAR PEDIDO, EN PEDIDOS DESPACHOS
	
$axnum_pedido = $_POST['txtnum_pedido']; 	

$SQLEliminar = "UPDATE PEDIDOS SET ESTADO_ANULADA='ELIMINADA' WHERE NUM_PEDIDO='$axnum_pedido'";
$RSEliminar = odbc_exec($con,$SQLEliminar);

if($RSEliminar){

	$respuesta =0;
	echo $respuesta;

}else{

	$respuesta =1;
	echo $respuesta;

}


break;

case '241': //PEDIDOS DESPACHOS ESTA PENDIENTE
	
$axnum_pedido_original = $_POST['txtnum_pedido_original']; 	

$SQLEliminar = "DELETE FROM PEDIDOS WHERE NUM_PEDIDO='$axnum_pedido_original'";
$RSEliminar = odbc_exec($con,$SQLEliminar);

$SQLEliminar_1 = "DELETE FROM PEDIDOS WHERE NUM_PEDIDO_PARCIAL='$axnum_pedido_original'";
$RSEliminar_1 = odbc_exec($con,$SQLEliminar_1);

$SqlCopiar ="INSERT INTO PEDIDOS (NUM_PEDIDO,ID_USUARIO,ID_BENEFICIARIO,DIRECCION_ENTREGA,FECHA_PEDIDO,HORA_PEDIDO,ID_PRODUCTO,CANT_SALIDA,PRS_MENOR,PRS_MAYOR,PRS_PREMIUN,COSTO_PRODUCTO,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,OBSERV_ENTREGA,ESTADO_ATENDIDO,TOTAL_PEDIDO,PRS_VENTA,ID_LOCAL,ID_AGENCIA,ID_TD,FECHA_DESPACHO,FORMA_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,NUM_TRANSF,ID_CTA,PERIODO_TRANSF,FECHA_TRANSF,DIAS_CREDITO,ID_PRODUCTO_PADRE,CANT_PADRE,ESTADO_REVISION,TIPO_ENTREGA,NUM_PEDIDO_PARCIAL,TIPO_VENTA,ESTADO_ANULADA) 

	SELECT NUM_PEDIDO,ID_USUARIO,ID_BENEFICIARIO,DIRECCION_ENTREGA,FECHA_PEDIDO,HORA_PEDIDO,ID_PRODUCTO,CANT_SALIDA,PRS_MENOR,PRS_MAYOR,PRS_PREMIUN,COSTO_PRODUCTO,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,OBSERV_ENTREGA,ESTADO_ATENDIDO,TOTAL_PEDIDO,PRS_VENTA,ID_LOCAL,ID_AGENCIA,ID_TD,FECHA_DESPACHO,FORMA_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,NUM_TRANSF,ID_CTA,PERIODO_TRANSF,FECHA_TRANSF,DIAS_CREDITO,ID_PRODUCTO_PADRE,CANT_PADRE,ESTADO_REVISION,TIPO_ENTREGA,NUM_PEDIDO_PARCIAL,TIPO_VENTA,ESTADO_ANULADA FROM PEDIDOS_PARCIAL WHERE NUM_PEDIDO='$axnum_pedido_original'";
 
 	//echo $SqlCopiar.'<br>';

	$RSCopiar = odbc_exec($con,$SqlCopiar);

	if($RSCopiar){

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;

	}
	
  

break;

case '242':
	

$axperiodo_inventario = $_POST['txtperiodo_inventario']; 	
$año = substr($axperiodo_inventario,3,4);
$mes = substr($axperiodo_inventario,0,2);

$ultimoDia = date("t", strtotime("$año-$mes-01"));
$axfecha_del = $año.'-'.$mes.'-01';
$axfecha_al = $año.'-'.$mes.'-'.$ultimoDia;

//Stock, genera el Stock según el rango de fechas seleccionado...

$axtitulo_enviado = 'Fecha del: '. date('d-m-Y',strtotime($axfecha_del)).' al '.date('d-m-Y',strtotime($axfecha_al));
//echo $axtitulo_enviado;

$axverifica = "SELECT TITULO,ESTADO_PERIODO FROM VERIFICACION_DETALLE WHERE PERIODO_INVENTARIO='$axperiodo_inventario' GROUP by TITULO,ESTADO_PERIODO";
$RSVerifica = odbc_exec($con,$axverifica);

//echo $axverifica;

if(odbc_num_rows($RSVerifica) > 0) {

	while($fila = odbc_fetch_array($RSVerifica)){

		$axtitulo_existente = $fila['TITULO'];
		$axestado_periodo =$fila['ESTADO_PERIODO'];

		if($axtitulo_existente==$axtitulo_enviado){

			if($axestado_periodo=='CERRADA'){

				$respuesta=2;  //existe y concuerdan el estado y las fechas y esta cerrado
				echo $respuesta;

			}else{

				$respuesta=1;  //existe y concuerdan las fechas pero esta abierto
				echo $respuesta;

			}

		}else{

			$respuesta=3;  //el rango de fechas no cononcuerta con el existente
			echo $respuesta;

		}

	}

	
}else{

		$respuesta=4;  //no existe el periodo
		echo $respuesta;
	
}

break;

case '243':

$axperiodo_inventario = $_POST['txtperiodo_inventario']; 	
$axid_producto_padre = $_POST['txtid_producto_padre']; 	
//$axid_usuario = $_POST['txtid_usuario']; 	
$axid_usuario = 12;
$axvendedor = get_row('usuarios','USUARIO','ID_USUARIO',$axid_usuario);

	$SQLBuscar_hijos = "SELECT * FROM PRODUCTOS_LISTADO_COMPLEMENTOS WHERE ID_PRODUCTO='$axid_producto_padre'";
	$RSBuscar_hijos = odbc_exec($con,$SQLBuscar_hijos);
		//echo $SQLBuscar_hijos.'<br>';

			$axcosto_producto_actualizar =0;

			if(odbc_num_rows($RSBuscar_hijos) > 0){

					while ($fila_datos = odbc_fetch_array($RSBuscar_hijos)) {

					/***SUMO LOS PRECIOS ***/
					
					$axid_producto_hijo = $fila_datos['ID_PRODUCTO_COMP'];
									
					$axcosto_producto_1 = get_row_two('PRODUCTOS_INVENTARIOS','PRC_COMPRA_PROM','ID_PRODUCTO','PERIODO_INVENTARIO',$axid_producto_hijo,$axperiodo_inventario);	
					$axfactor_complemento = get_row_two('PRODUCTOS_COMP','FACTOR_COMPL','ID_PRODUCTO_COMP','ID_PRODUCTO',$axid_producto_hijo,$axid_producto_padre);				
					$axprc_minimo = get_row_two('PRODUCTOS_PRC_MINIMO','PRECIO_MINIMO','ID_PRODUCTO','VENDEDOR',$axid_producto_padre,$axvendedor);				

					//echo $axid_producto_hijo.'|'.$axperiodo_inventario.'|'.$axcosto_producto_1.'<br>';

					if($axcosto_producto_1 ==''){

					//	echo 'no hay en el periodo y se trae el mes anterior '.$axcosto_producto_1.'<br>';

						/*Si no encuentra en el precio promedio del mes en curso, trae el ultimo costo grabado en la tabla productos*/
						$axcosto_producto_1 = get_row('PRODUCTOS','COSTO_PRODUCTO','ID_PRODUCTO',$axid_producto_hijo);

						$axcosto_producto = $axcosto_producto_1*$axfactor_complemento;
						$axcosto_producto_actualizar = $axcosto_producto_actualizar+$axcosto_producto;						

						//echo 'ID '.$axid_producto_hijo .' / '.$axcosto_producto_1.' COSTO ACT '.$axcosto_producto_actualizar.'<br>';

						
					}else{

						$axcosto_producto = $axcosto_producto_1*$axfactor_complemento;
						$axcosto_producto_actualizar = $axcosto_producto_actualizar+$axcosto_producto;						

					}				
				}

			}else{

					//	echo 'no hay en el periodo y se trae el mes anterior '.$axcosto_producto_1.'<br>';

						/*Si no encuentra en el precio promedio del mes en curso, trae el ultimo costo grabado en la tabla productos*/
						$axcosto_producto_1 = get_row('PRODUCTOS','COSTO_PRODUCTO','ID_PRODUCTO',$axid_producto_padre);

						//$axcosto_producto = $axcosto_producto_1*$axfactor_complemento;
						//$axcosto_producto_actualizar = $axcosto_producto_actualizar+$axcosto_producto;						

						$axcosto_producto_actualizar = $axcosto_producto_1;

						//echo 'ID '.$axid_producto_padre .' / '.$axcosto_producto_1.' COSTO ACT '.$axcosto_producto_actualizar.'<br>';

			}

		


			/***ACTUALIZAR LA TABLA PRODUCTOS, EL COSTO PRODUCTO PADRE E HIJOS Y LA TABLA PRODUCTOS_COMP SUS PORCENTAJES ***/

			$axcosto_padre =$axcosto_producto_actualizar;

			$sqlactualizar_padre = "UPDATE PRODUCTOS SET COSTO_PRODUCTO='$axcosto_padre' WHERE ID_PRODUCTO='$axid_producto_padre'";
			$rsactualizar_padre = odbc_exec($con,$sqlactualizar_padre);

			if($rsactualizar_padre){

					$SQLBuscar_hijos_1 = "SELECT * FROM PRODUCTOS_LISTADO_COMPLEMENTOS WHERE ID_PRODUCTO='$axid_producto_padre'";
					$RSBuscar_hijos_1 = odbc_exec($con,$SQLBuscar_hijos_1);
				//	echo $SQLBuscar_hijos_1.'<br>';

					if(odbc_num_rows($RSBuscar_hijos_1)> 0) {

						while ($fila_datos_1 = odbc_fetch_array($RSBuscar_hijos_1)) {

						$axid_producto_hijo_1 = $fila_datos_1['ID_PRODUCTO_COMP'];

						$axcosto_producto_1 = get_row_two('PRODUCTOS_INVENTARIOS','PRC_COMPRA_PROM','ID_PRODUCTO','PERIODO_INVENTARIO',$axid_producto_hijo_1,$axperiodo_inventario);				
						$axfactor_complemento_1 = get_row_two('PRODUCTOS_COMP','FACTOR_COMPL','ID_PRODUCTO_COMP','ID_PRODUCTO',$axid_producto_hijo_1,$axid_producto_padre);	

						//echo	'Costo producto: '.$axcosto_producto_1;
						
						if($axcosto_producto_1 == ''){

							//echo "COSTO EN BLANO O CERO";

						}else{				

							$axporc_precio_hijo_1 =($axcosto_producto_1*$axfactor_complemento_1)/$axcosto_padre;	

							$SQLActualizar_compl = "UPDATE PRODUCTOS_COMP SET PORC_COMPL='$axporc_precio_hijo_1',PRS_MINIMO_COMPL='$axcosto_producto_1' WHERE ID_PRODUCTO='$axid_producto_padre' AND ID_PRODUCTO_COMP='$axid_producto_hijo_1'";
								$RSActualizar_compl = odbc_exec($con,$SQLActualizar_compl);
								//echo $SQLActualizar_compl.'<br>';

								$sqlactualizar_hijos = "UPDATE PRODUCTOS SET COSTO_PRODUCTO='$axcosto_padre' WHERE ID_PRODUCTO='$axid_producto_hijo_1'";
								$rsactualizar_hijos = odbc_exec($con,$sqlactualizar_hijos);
								//echo $sqlactualizar_hijos.'<br>';

								//echo $axid_producto_padre.' | '.$axid_producto_hijo_1.' | '.$axcosto_producto_1.' | '.$axfactor_complemento_1.' | '.$axcosto_padre.' | '.$axporc_precio_hijo_1.'<br>';

						}

						
					}

				}

					

			}

			

			echo $axcosto_producto_actualizar;






break;

case '244':
	
/*****Buscar Codigo Padre del PEDIDO*****/

$SQLEliminar = "DELETE FROM PEDIDOS_PRECIOS_OBSERVADOS";
$RSEliminar = odbc_exec($con,$SQLEliminar);

$SQLBuscar = "SELECT * FROM PEDIDOS_CZ WHERE ESTADO_ATENDIDO <> 'PROGRAMADO' AND ESTADO_ATENDIDO <> 'ATENDIDO' order by DISTRITO_ALTER,NOM_COMERCIAL DESC";
$rsBuscar = odbc_exec($con,$SQLBuscar);
 
//echo $SQLBuscar.'<br>';

while ($fila_cz = odbc_fetch_array($rsBuscar)) {
	
	$axnum_pedido = $fila_cz['NUM_PEDIDO'];	
	$axvendedor = $fila_cz['VENDEDOR'];	

	//echo $axvendedor.'<br>';


	$SQLBuscar_dt = "SELECT COD_PRODUCTO,PRS_VENTA FROM PEDIDOS_DT_1 WHERE NUM_PEDIDO='$axnum_pedido'";
	$rsBuscar_dt = odbc_exec($con,$SQLBuscar_dt);

	//echo $SQLBuscar_dt.'<br>';

		while ($fila_padre = odbc_fetch_array($rsBuscar_dt)) {

				$axprs=0;

				$axcod_producto_padre = $fila_padre['COD_PRODUCTO'];
				$axprc_venta_padre = $fila_padre['PRS_VENTA'];
				$axprs_venta_minimo = get_row_two('PRODUCTOS_PRC_MINIMO','PRECIO_MINIMO','VENDEDOR','COD_PRODUCTO',$axvendedor,$axcod_producto_padre);

				$axnom_cliente = get_row('PEDIDOS_CZ','NOM_COMERCIAL','NUM_PEDIDO',$axnum_pedido);
				$axnom_producto= get_row_two('PEDIDOS_DT_1','NOM_PRODUCTO','NUM_PEDIDO','COD_PRODUCTO',$axnum_pedido,$axcod_producto_padre);

				if($axprs_venta_minimo !==''){

					if($axprc_venta_padre < $axprs_venta_minimo){
						$axprs = $axprs+1;					
						$axmostrar_boton=$axprs;

						$sqlinserta_ob	= "INSERT INTO PEDIDOS_PRECIOS_OBSERVADOS (NUM_PEDIDO,NOM_COMERCIAL,COD_PRODUCTO,NOM_PRODUCTO,PRECIO_MINIMO,PRS_VENTA) VALUES ('$axnum_pedido','$axnom_cliente','$axcod_producto_padre','$axnom_producto','$axprs_venta_minimo','$axprc_venta_padre')";
						$rsinserta_ob = odbc_exec($con,$sqlinserta_ob);
						//echo $sqlinserta_ob.'<br>';

					}else{
						$axmostrar_boton='0';
					}				

				}

				
				

				//echo 'Cod Padre: '.$axcod_producto_padre.' |  Prc. Padre '.$axprc_venta_padre.' <= Prc. Minimo '.$axprs_venta_minimo.' Dif: '.$axprs.'<br>';

		}

		//echo $axmostrar_boton;

}	

break;

case '245':
	

$SQLBuscar ="SELECT  * FROM PEDIDOS_PRECIOS_OBSERVADOS ORDER BY NUM_PEDIDO ASC";
//echo "$SQLBuscar";

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-secondary'>			
		<tr>
			<th style='text-align: left;'>#Pedido</th>
			<th style='text-align: left;'>Cliente</th>			
			<th style='text-align: center;'>Código</th>			
			<th style='text-align: left;'>Producto</th>			
			<th style='text-align: right;'>Cant.</th>			
			<th class='table-primary' style='text-align: right;'>Prc. Vendido</th>			
			<th class='table-danger' style='text-align: right;'>Prc. Minimo</th>
			<th class='table-danger' style='text-align: center;'>Estado</th>
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$axnum_pedido = $fila['NUM_PEDIDO'];		
 		$axcliente = utf8_encode($fila['NOM_COMERCIAL']);		
		$axcod_producto = $fila['COD_PRODUCTO'];
		$axid_producto_padre = get_row('PRODUCTOS','ID_PRODUCTO','COD_PRODUCTO',$axcod_producto);
		$axnom_producto = utf8_encode($fila['NOM_PRODUCTO']);
		$axprec_venta = number_format($fila['PRS_VENTA'],2,".",",");
		$axprec_minimo = number_format($fila['PRECIO_MINIMO'],2,".",",");
		$axcant = get_row_two('PEDIDOS_DT_1','CANT_SALIDA','COD_PRODUCTO','NUM_PEDIDO',$axcod_producto,$axnum_pedido);

		$axestado =get_row_two('PEDIDOS','ESTADO_PRC_MINIMO','NUM_PEDIDO','ID_PRODUCTO_PADRE',$axnum_pedido,$axid_producto_padre);

	


	echo "
 		<tr> 		
 			<td class='text-dark' style='text-align: left;'>$axnum_pedido</td> 
 			<td class='text-dark' style='text-align: left;'>$axcliente<br><b>$axestado</b></td> 
 			<td class='text-dark' style='text-align: center;'>$axcod_producto</td> 
 			<td class='text-dark' style='text-align: left;'>$axnom_producto</td> 
 			<td class='text-dark' style='text-align: right;'><b>$axcant</b></td> 
 			<td class='table-primary'style='text-align: right;'><b>$axprec_venta</b></td> 
 			<td class='table-danger' style='text-align: right;'><b>$axprec_minimo</b></td> 
 			<td class='table-danger' style='text-align: center;'><a href='#' style='text-decoration:none;' data-npedido='$axnum_pedido' data-idpd='$axcod_producto' id='btn_aprobar'><i class='bi bi-hand-thumbs-up-fill'></i></a></td> 
 		</tr>
 	";


 
}
echo "</table>";
}

break;

case '246':
	
$axid_producto_padre = $_POST['txtid_producto_padre']; 	
//$axid_usuario = $_POST['txtid_usuario']; 	
$axid_usuario = 12;
$axvendedor = get_row('usuarios','USUARIO','ID_USUARIO',$axid_usuario);
$axcod_producto_padre= get_row('PRODUCTOS','COD_PRODUCTO','ID_PRODUCTO',$axid_producto_padre);

//$axprs_venta_minimo = get_row_two('PRODUCTOS_PRC_MINIMO','PRECIO_MINIMO','VENDEDOR','COD_PRODUCTO',$axvendedor,$axcod_producto_padre);

$sql6 = "SELECT * FROM PRODUCTOS_PRECIO_MARGENES WHERE VENDEDOR = '$axvendedor' AND COD_PRODUCTO='$axcod_producto_padre'";
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

//echo 'Producto:'.$axcod_producto_padre.'Vendedor '.$axvendedor.' Prc. Minimo: '.$axprs_venta_minimo;
//echo trim($axprs_venta_minimo);

break;

case '247':
	
$axfecha_del =$_POST['txtfecha_del'];
$axfecha_al =$_POST['txtfecha_al'];

$SQLBuscar ="SELECT * FROM CTA_COBRAR_PAGOS_REPORTE WHERE FECHA_PAGO BETWEEN '$axfecha_del' AND '$axfecha_al' AND MONTO_PAGADO > 0 ORDER BY NOM_COMERCIAL,FECHA_PAGO ASC"; 
//echo $SQLBuscar;

echo "
	<div style='text-align:right; padding:5px;'>
		<a href='#' class='btn btn-outline-success btn-sm' onclick='exportar_excel()' ><b> <i class='bi bi-file-earmark-excel-fill'></i> Excel</b></a>
		</div>
		<table class='table table-hover table-sm' id='tbl_pagos'>
		<thead class='table-success'>			
		<tr>
			<th style='text-align: center;'>Item</th>
			<th class='table-danger' style='text-align: left;'>Fecha Liquidar</th>
			<th style='text-align: left;'>Num. Pedido</th>
			<th style='text-align: left;'>Cliente</th>
			<th style='text-align: center;'>Fecha Pago</th>						
			<th style='text-align: center;'>Num. Operacion</th>						
			<th style='text-align: center;'>Medio Pago</th>									
			<th class='table-success' style='text-align: right;'>Pagado</th>						
			
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);		
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		
 		$it= $it+1;
 		$axid_pago=$fila['ID_PAGO'];
 		$axfecha = date('d-m-Y', strtotime($fila['FECHA_PAGO']));		
 		$axfecha_liquidacion 		= date('d-m-Y', strtotime($fila['FECHA_LIQUIDACION']));		
 		$axnum_pedido = $fila['NUM_PEDIDO'];
 		$axid_beneficiario = $fila['ID_BENEFICIARIO'];				
 		$axcliente = substr($fila['NOM_COMERCIAL'],0,30).'...';		
		$axpagado = number_format($fila["MONTO_PAGADO"],2,".",","); 		
		$axnum_transf = $fila['NUM_TRANSF'];		
		$axid_cta = $fila['ID_CTA'];	
		$axbanco = $fila['BANCO_CUENTA'];		
		$axmedio = $fila['MEDIO_PAGO'];		

		if($fila["MONTO_PAGADO"]==0){
		$axbanco = '';	
		$axmedio = '';
		$axnum_transf = '-';		
		}	
		

 	echo "
 		<tr> 		
 			<td style='text-align: center;'>".$it."</td> 
 			<td class='table-danger' style='text-align: left;'>".$axfecha_liquidacion."</td> 
 			<td style='text-align: left;'>".$axnum_pedido."</td> 
 			<td style='text-align: left;'>".$axcliente."</td> 
 			<td style='text-align: center;'>".$axfecha."</td> 
 			<td style='text-align: center;'>".$axnum_transf."</td>  						
 			<td style='text-align: center;'>".$axmedio.'-'.$axbanco."</td>  			 			
 			<td style='text-align: right;'>".$axpagado."</td>
 			";
 		echo "</tr>";
 	
 	}

 	$SQLBuscar_tt ="SELECT sum(MONTO_PAGADO) as tt FROM CTA_COBRAR_PAGOS_REPORTE WHERE FECHA_PAGO BETWEEN '$axfecha_del' AND '$axfecha_al'"; 
 	$rsBuscar_tt = odbc_exec($con,$SQLBuscar_tt);
 	$fila = odbc_fetch_array($rsBuscar_tt);

 	$axtotal = $fila['tt'];

 	echo "<tr> 		
 			<th style='text-align: right;' colspan='8'>".number_format($axtotal,2,".",",")."</th> 
 			</tr>";

	echo "</table>";
	}else{
		echo "";
	}

break;

case '248':
	
$axperiodo = $_POST['txtperiodo_inventario']; 		

	$sqletapas = "SELECT NOM_COMERCIAL FROM BENEFICIARIOS WHERE TIPO_PROV_CLIE='PROVEEDOR'" ;
	
	//echo $sqletapas;	      

	$rsetapas=odbc_exec($con,$sqletapas);
	
	if(odbc_num_rows($rsetapas) > 0){
		//echo '<option value="">Seleccionar</option>';
		while($fila=odbc_fetch_array($rsetapas)){
			$axproveedor = $fila['NOM_COMERCIAL'];
			  		echo '<option value='.$axproveedor.'>'.$axproveedor.'</option>';
    	}
		
	} else {

		echo "";	
	}

break;

case '249':
	
$axfecha_del =$_POST['txtfecha_del'];
$axfecha_al =$_POST['txtfecha_al'];
$axcod_producto =$_POST['txtcod_producto'];

//$SQLBuscar = "SELECT * FROM PEDIDOS_DT_2 WHERE FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al' AND TIPO_VENTA='VENTA' AND COD_PRODUCTO='$axcod_producto' ORDER BY ID_TD ASC";	
$SQLBuscar = "SELECT * FROM PEDIDOS_DT_2 WHERE FECHA_PEDIDO BETWEEN '$axfecha_del' AND '$axfecha_al' AND TIPO_VENTA='VENTA'  ORDER BY ID_TD ASC";	
echo "$SQLBuscar";

	echo "
		<div style='margin-top:5px; padding:5px; text-align: right;'>
		<a href='#' class='btn btn-outline-success btn-sm' onclick='exportar_excel_1()' ><b> <i class='bi bi-file-earmark-excel-fill'></i> Excel</b></a>
		</div>

		<table class='table table-hover table-sm' id='tbl_detalles'>
		<thead class='table-primary'>			
		<tr>
			<th class='ocultar' style='text-align: center;'>Num. Pedido</th>
			<th class='ocultar' style='text-align: center;'>Fecha Pedido</th>
			<th class='ocultar' style='text-align: center;'>Mes/periodo</th>
			<th class='ocultar' style='text-align: center;'>Fecha Despacho</th>
			<th class='ocultar' style='text-align: center;'>Ruc</th>
			<th class='ocultar' style='text-align: center;'>RAZON SOCIAL</th>
			<th class='ocultar' style='text-align: center;'>DIRECCION ENTREGA</th>
			<!--th class='ocultar' style='text-align: center;'>DISTRITO ENTREGA</th>
			<th class='ocultar' style='text-align: center;'>PROVINCIA</th>
			<th class='ocultar' style='text-align: center;'>TELEFONO</th>
			<th class='ocultar' style='text-align: center;'>CONDICION PAGO</th-->
			<th class='ocultar' style='text-align: center;'>TIPO DOCUMENTO</th>
			<th class='ocultar' style='text-align: center;'>NUM. DOCUMENTo</th>
			<th class='ocultar' style='text-align: center;'>VENDEDOR</th>
			<th class='ocultar' style='text-align: center;'>NUM_DESPACHO</th>
			<th class='ocultar' style='text-align: center;'>CODIGO</th>
			<th class='ocultar' style='text-align: center;'>DESCRIPCION</th>
			<th class='ocultar' style='text-align: right;'>UND</th>			
			<th class='ocultar' style='text-align: right;'>PRECIO UNIT</th>			
			<th class='ocultar' style='text-align: right;'>COSTO UNIT</th>			
			<th class='ocultar' style='text-align: right;'>TOTAL SOLES</th>			
			<th class='ocultar' style='text-align: right;'>COTAL COSTO</th>			

		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		$it= $it+1;
 		$id_beneficiario = $fila['ID_BENEFICIARIO'];
		$axcliente = get_row('BENEFICIARIOS','RAZON_SOCIAL','ID_BENEFICIARIO',$id_beneficiario);
		$axruc = get_row('BENEFICIARIOS','RUC_BENEF','ID_BENEFICIARIO',$id_beneficiario);
		$axdir_entrega = get_row('BENEFICIARIOS','DIRECCION_ENTREGA','ID_BENEFICIARIO',$id_beneficiario);
		$id_td = $fila['ID_TD'];
		$axtipodocumento = get_row('TIPO_DOCUMENTOS','ABREV_DOC','ID_TD',$id_td);
		$axcomprobante = $fila['COMPROBANTE'];
		$axnum_pedido = $fila['NUM_PEDIDO'];
		$axproducto = $fila['NOM_PRODUCTO'];
		$axvendedor = $fila['VENDEDOR'];
		$axcod_producto = $fila['COD_PRODUCTO'];
		$axfechapedido = date('d-m-Y',strtotime($fila['FECHA_PEDIDO']));
		$axperiodo = date('m-Y',strtotime($fila['FECHA_PEDIDO']));
		$axcantidad = number_format($fila['CANT_SALIDA'],2,".",",");
		$axprecio_v = number_format($fila['PRS_VENTA'],2,".",",");
		$axcosto = number_format($fila['COSTO_PRODUCTO'],2,".",",");
		$axprecio_total_1=$fila['PRS_VENTA']*$fila['CANT_SALIDA'];
		$axcosto_total_1=$fila['COSTO_PRODUCTO']*$fila['CANT_SALIDA'];
		$axnum_despacho = get_row('PEDIDOS','NUM_DESPACHO','NUM_PEDIDO',$axnum_pedido);
		$axfechadespacho= get_row('PEDIDOS','FECHA_DESPACHO','NUM_PEDIDO',$axnum_pedido);
		$axprecio_total = number_format($axprecio_total_1,2,".",",");
		$axcosto_total = number_format($axcosto_total_1,2,".",",");


 	echo "
 		<tr> 		
 			<td style='text-align: left;'>".$axnum_pedido."</td> 
 			<td style='text-align: left;'>".$axfechapedido."</td> 
 			<td style='text-align: left;'>".$axperiodo."</td>
 			<td style='text-align: left;'>".$axfechadespacho."</td> 
 			<td style='text-align: left;'>".$axruc."</td>
 			<td style='text-align: right;'>".$axcliente."</td>			
 			<td style='text-align: right;'>".$axdir_entrega."</td>			
 			<td style='text-align: right;'>".$axtipodocumento."</td>			
 			<td style='text-align: right;'>".$axcomprobante."</td>			
 			<td style='text-align: right;'>".$axvendedor."</td>			
 			<td style='text-align: right;'>".$axnum_despacho."</td>			
 			<td style='text-align: right;'>".$axcod_producto."</td>			
 			<td style='text-align: right;'>".$axproducto."</td>			
 			<td style='text-align: right;'>".$axcantidad."</td>			
 			<td style='text-align: right;'>".$axprecio_v."</td>			
 			<td style='text-align: right;'>".$axcosto."</td>			
 			<td style='text-align: right;'>".$axprecio_total."</td>			
 			<td style='text-align: right;'>".$axcosto_total."</td>			


 		</tr>"; 

}

/***********INSERTAR NOTAS DE CREDITO************************/

		
 $SQLNC = "SELECT ID_LOCAL,txt_serie_ref,txt_correlativo_cpe_ref FROM RESUMEN_NOTA_CREDITO WHERE FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY ID_LOCAL,txt_serie_ref,txt_correlativo_cpe_ref";
 $RSNC = odbc_exec($con,$SQLNC);

 if(odbc_num_rows($RSNC) > 0){

 	$SQLDelete ="DELETE FROM RESUMEN_VENTAS_INC_NC";
	$RSDelete = odbc_exec($con,$SQLDelete);

 	while ($fila_nc= odbc_fetch_array($RSNC) ) {
 		$axlocal = $fila_nc['ID_LOCAL'];
 		$axserie = $fila_nc['txt_serie_ref'];
 		$axdocumento = $fila_nc['txt_correlativo_cpe_ref'];

 		$axnum_pedido = get_row_three('MAESTRO_CZ','NUM_PEDIDO','ID_LOCAL','TXT_SERIE','DOCUMENTO',$axlocal,$axserie,$axdocumento);

 		if($axnum_pedido !==''){
 			
 			$SQLAgrupa_hijos = "SELECT txt_serie_ref,txt_correlativo_cpe_ref,UNID, STRING_AGG(ID_PRODUCTO, ',') AS ID_PRODUCTO_HIJOS
			FROM RESUMEN_NOTA_CREDITO WHERE FECHA_EMISION BETWEEN '$axfecha_del' AND '$axfecha_al' AND txt_serie_ref='$axserie' AND txt_correlativo_cpe_ref='$axdocumento' AND ID_LOCAL='$axlocal' 
			GROUP BY txt_serie_ref,txt_correlativo_cpe_ref,UNID";
			$RSAgrupa_hijos = odbc_exec($con,$SQLAgrupa_hijos);
			$fila_hijos = odbc_fetch_array($RSAgrupa_hijos);
			$axcant_padre = $fila_hijos['UNID'];
			$axid_producto_hijos = $fila_hijos['ID_PRODUCTO_HIJOS'];

			$sqldatos_nc = "SELECT ID_PRODUCTO_PADRE,CANT_PADRE,SUM(PRS_VENTA) AS PU,SUM(COSTO_PRODUCTO) AS CP,SUM(TOTAL_SALIDA) AS TS,(SUM(COSTO_PRODUCTO)*CANT_PADRE) AS TC FROM PEDIDOS WHERE NUM_PEDIDO='$axnum_pedido' AND  ID_PRODUCTO IN ($axid_producto_hijos) GROUP BY ID_PRODUCTO_PADRE,CANT_PADRE";
			$rsdatos_nc = odbc_exec($con,$sqldatos_nc);
			//echo $sqldatos_nc.'<br>';

			while ($fila_h = odbc_fetch_array($rsdatos_nc)) {

							$axid_producto_padre = $fila_h['ID_PRODUCTO_PADRE'];

							$axnota_venta = $axnum_pedido;			        
			        
			        $axfecha_despacho = get_row('PEDIDOS','FECHA_DESPACHO','NUM_PEDIDO',$axnota_venta);
			        $axnum_despacho = get_row('PEDIDOS','NUM_DESPACHO','NUM_PEDIDO',$axnota_venta);

			        $axid_beneficiario = get_row('PEDIDOS','ID_BENEFICIARIO','NUM_PEDIDO',$axnota_venta);

			        //$axruc = get_row('BENEFICIARIOS','RUC_BENEF','ID_BENEFICIARIO',$axid_beneficiario);

			         $axruc = get_row('BENEFICIARIOS','RUC_BENEF','ID_BENEFICIARIO',$axid_beneficiario);

                    if($axruc=='00000000000' || $axruc=='' ){
                       $axruc = get_row('BENEFICIARIOS','COD_INTERNO','ID_BENEFICIARIO',$axid_beneficiario); 
                    }




			        $axrazon_social = get_row('BENEFICIARIOS','RAZON_SOCIAL','ID_BENEFICIARIO',$axid_beneficiario); 
			        $axdireccion_entrega = get_row('BENEFICIARIOS','DIRECCION_ENTREGA','ID_BENEFICIARIO',$axid_beneficiario);  
			        $axid_direccion =get_row('BENEFICIARIOS','ID_DIRECCION','ID_BENEFICIARIO',$axid_beneficiario);  
			        $axdistrito_entrega = get_row('BENEFICIARIOS_DIR','DISTRITO_ALTER','ID_DIRECCION',$axid_direccion);   
							$axprovincia = get_row('BENEFICIARIOS_DIR','PROVINCIA','ID_DIRECCION',$axid_direccion);  
			        $axtelefono = get_row('BENEFICIARIOS','TELEFONO','ID_BENEFICIARIO',$axid_beneficiario);  

			        $axcondicion_pago = get_row_three('RESUMEN_NOTA_CREDITO','CONDICION_PAGO','txt_serie_ref','txt_correlativo_cpe_ref','ID_LOCAL',$axserie,$axdocumento,$axlocal);
			        $axtipo_documento = get_row_three('RESUMEN_NOTA_CREDITO','TIPO_DOCUMENTO','txt_serie_ref','txt_correlativo_cpe_ref','ID_LOCAL',$axserie,$axdocumento,$axlocal);
			        $axnumero_documento = get_row_three('RESUMEN_NOTA_CREDITO','NUMERO_DOCUMENTO','txt_serie_ref','txt_correlativo_cpe_ref','ID_LOCAL',$axserie,$axdocumento,$axlocal); 

			        $axfechapedido = get_row_three('RESUMEN_NOTA_CREDITO','FECHA_EMISION','txt_serie_ref','txt_correlativo_cpe_ref','ID_LOCAL',$axserie,$axdocumento,$axlocal); 

			        $axvendedor = get_row_three('RESUMEN_NOTA_CREDITO','VENDEDOR','txt_serie_ref','txt_correlativo_cpe_ref','ID_LOCAL',$axserie,$axdocumento,$axlocal);  
			        
			        $axcodigo =  get_row('PRODUCTOS','COD_PRODUCTO','ID_PRODUCTO',$axid_producto_padre);
			        $axdescripcion = get_row('PRODUCTOS','NOM_PRODUCTO','ID_PRODUCTO',$axid_producto_padre);
			        $axunid = $fila_h['CANT_PADRE'];

			        $axprecio_unit = $fila_h['PU'];
			        $axcosto_unit = $fila_h['CP'];
			        $axtotal_soles = $fila_h['TS'];
			        $axtotal_costo = $fila_h['TC'];

				
				 $sqlinserta_nc = "INSERT INTO RESUMEN_VENTAS_INC_NC (NOTA_VENTA, FECHA_PEDIDO, FECHA_DESPACHO, RUC, RAZON_SOCIAL, DIRECCION_ENTREGA, DISTRITO_ENTREGA, PROVINCIA, TELEFONO, CONDICION_PAGO, TIPO_DOCUMENTO, NUMERO_DOCUMENTO, VENDEDOR, CODIGO, DESCRIPCION, UNID, PRECIO_UNIT, COSTO_UNIT, TOTAL_SOLES, TOTAL_COSTO,NUM_DESPACHO) values('$axnota_venta','$axfechapedido','$axfecha_despacho','$axruc','$axrazon_social','$axdireccion_entrega','$axdistrito_entrega','$axprovincia','$axtelefono','$axcondicion_pago','$axtipo_documento','$axnumero_documento','$axvendedor','$axcodigo','$axdescripcion','$axunid','$axprecio_unit','$axcosto_unit','$axtotal_soles','$axtotal_costo','$axnum_despacho')";
			        $rsinserta_nc = odbc_exec($con,$sqlinserta_nc);   
			        //echo $sqlinserta_nc.'<br>';

			}
 		}

 	}

 }

 $sqldatos_nc ="SELECT * FROM RESUMEN_VENTAS_INC_NC ORDER BY NUMERO_DOCUMENTO";
 $RSdatos_nc = odbc_exec($con,$sqldatos_nc);

 if(odbc_num_rows($RSdatos_nc) > 0){

	 	 while ($fila_nc = odbc_fetch_array($RSdatos_nc)) {

	 	 	$axnum_pedido_nc = $fila_nc['NOTA_VENTA'];
			$axfechapedido_nc = $fila_nc['FECHA_PEDIDO'];
			$axperiodo_nc = date('m-Y',strtotime($axfechapedido_nc));
			$axfechadespacho_nc = $fila_nc['FECHA_DESPACHO'];
			$axruc_nc = $fila_nc['RUC'];
			$axcliente_nc = $fila_nc['RAZON_SOCIAL'];
			$axdir_entrega_nc = $fila_nc['DIRECCION_ENTREGA'];
			$axtipodocumento_nc = $fila_nc['TIPO_DOCUMENTO'];
			$axcomprobante_nc = $fila_nc['NUMERO_DOCUMENTO'];
			$axvendedor_nc = $fila_nc['VENDEDOR'];
			$axnum_despacho_nc = $fila_nc['NUM_DESPACHO'];
			$axcod_producto_nc = $fila_nc['CODIGO'];
			$axproducto_nc = $fila_nc['DESCRIPCION'];
			$axcantidad_nc = $fila_nc['UNID'];
			$axprecio_v_nc = $fila_nc['PRECIO_UNIT'];
			$axcosto_nc = $fila_nc['COSTO_UNIT'];
			$axprecio_total_nc = $fila_nc['TOTAL_SOLES'];
			$axcosto_total_nc = $fila_nc['TOTAL_COSTO'];

	 	echo "
	 		<tr> 		
	 			<td style='text-align: left;'>".$axnum_pedido_nc."</td> 
	 			<td style='text-align: left;'>".$axfechapedido_nc."</td> 
	 			<td style='text-align: left;'>".$axperiodo_nc."</td>
	 			<td style='text-align: left;'>".$axfechadespacho_nc."</td> 
	 			<td style='text-align: left;'>".$axruc_nc."</td>
	 			<td style='text-align: right;'>".$axcliente_nc."</td>			
	 			<td style='text-align: right;'>".$axdir_entrega_nc."</td>			
	 			<td style='text-align: right;'>".$axtipodocumento_nc."</td>			
	 			<td style='text-align: right;'>".$axcomprobante_nc."</td>			
	 			<td style='text-align: right;'>".$axvendedor_nc."</td>			
	 			<td style='text-align: right;'>".$axnum_despacho_nc."</td>			
	 			<td style='text-align: right;'>".$axcod_producto_nc."</td>			
	 			<td style='text-align: right;'>".$axproducto_nc."</td>			
	 			<td style='text-align: right;'>".$axcantidad_nc."</td>			
	 			<td style='text-align: right;'>".$axprecio_v_nc."</td>			
	 			<td style='text-align: right;'>".$axcosto_nc."</td>			
	 			<td style='text-align: right;'>".$axprecio_total_nc."</td>			
	 			<td style='text-align: right;'>".$axcosto_total_nc."</td>			

	 		</tr>";
	 		
 		}

 }


echo "</table>";
}

break;

case '250':
	

$axperiodo_inventario =$_POST['txtperiodo_inventario'];

$SQLBuscar = "SELECT NUM_ORDEN,PROVEEDOR FROM RESUMEN_VENTAS_PERIODO WHERE PERIODO_REPORTE='$axperiodo_inventario' GROUP BY PROVEEDOR,NUM_ORDEN  ORDER BY NUM_ORDEN ASC";	
//echo "$SQLBuscar";

	echo "
		
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>			
		<tr>
			<th class='ocultar' style='text-align: left;'>Num. Orden</th>
			<th class='ocultar' style='text-align: left;'>proveedores</th>
			
		</tr>
		</thead>";
	
	$RSBuscar = odbc_exec($con,$SQLBuscar);
	
	
	if ($RSBuscar){
 	
 	while ($fila=odbc_fetch_array($RSBuscar)){ 
 		
 		$axnum_orden = $fila['NUM_ORDEN'];
		$axproveedor = $fila['PROVEEDOR'];
		
		
 	echo "
 		<tr> 		
 			<td contenteditable data-prov='$axproveedor' id='btn_editar_orden' class='table-danger' style='text-align: center;'>".$axnum_orden."</td> 
 			<td style='text-align: left;'>".$axproveedor."</td> 
 			
 		</tr>"; 

}


echo "</table>";
}

break;
case '251':

	$axnum_orden =$_POST['txtnum_orden'];
	$axproveedor =$_POST['txtproveedor'];

	$SQLActualizar = "UPDATE RESUMEN_VENTAS_PERIODO SET NUM_ORDEN='$axnum_orden' WHERE PROVEEDOR='$axproveedor'";
	$RSActualizar = odbc_exec($con,$SQLActualizar);

	if($RSActualizar){

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;

	}

break;

case '252':
	
	$axnum_pedido =$_POST['txtnum_pedido'];
	$axcod_producto =$_POST['txtcod_producto'];
	$axestado_aprobado =$_POST['txtestado_aprobado'];
	$axpersona_aprobo =$_POST['txtpersona_aprobo'];

	$axid_producto = get_row('PRODUCTOS','ID_PRODUCTO','COD_PRODUCTO',$axcod_producto);

	$SQLActualizar = "UPDATE PEDIDOS SET ESTADO_PRC_MINIMO='$axestado_aprobado',PRECIO_MINIMO_APRO='$axpersona_aprobo' WHERE NUM_PEDIDO='$axnum_pedido' AND ID_PRODUCTO_PADRE='$axid_producto'";
	$RSActualizar = odbc_exec($con,$SQLActualizar);
	//echo $SQLActualizar;


	if($RSActualizar){

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;

	}

break;

case '253':
	
$axidempresa = $_POST['txtidempresa']; 
	$axbuscaregistro = $_POST['txtbuscarusuario']; 

	if($axbuscaregistro==""){
		
		$sql6 ="SELECT TOP 50 * FROM BITACORA_USOS ORDER BY FECHA_BITACORA DESC";

	}else{

		$sql6 ="SELECT * FROM BITACORA_USOS WHERE DETALLE_BITACORA+USUARIO+NOM_MENU like '%".$axbuscaregistro."%' ORDER BY FECHA_BITACORA DESC";

	}
	
	//echo $sql6;

	echo "
		<table class='table table-hover table-sm'>
		<thead class='table-primary'>					
		<tr>			
			<th scope='col'>FECHA</th>
			<th scope='col'>USUARIO</th>
			<th scope='col'>DETALLE BITACORA</th>						
			<th scope='col'>MENU</th>			
		</tr>
		</thead>";
	
	$result6=odbc_exec($con,$sql6);
	
	if ($result6){
 	
 	while ($row=odbc_fetch_array($result6)){ 
 		
 		$axhora = $row["HORA_BITACORA"];
 		$axfecha = date('d/m/Y',strtotime($row["FECHA_BITACORA"])).' '.$axhora;

 		$it=$it+1;
 	echo "
 		<tr>
 			<td >".$axfecha."</td> 
 			<td >".$row["USUARIO"]."</td>
 			<td >".$row["DETALLE_BITACORA"]."</td>
 			<td >".$row["NOM_MENU"]."</td>  			 			
 		</tr>
 	";

}
echo "</table>";
}

break;

case '254':	
	
$axnum_pedido = $_POST['txtnum_pedido']; 
$axcodusuario = $_POST['txtcodusuario'];
$axid_local = $_POST['txtid_local'];
$axcod_mov_cz_parcial = $_POST['txtcod_mov_cz_parcial']; 
$axcod_mov_cz = trim($_POST['txtcod_mov_cz']); 
$axnum_pedido_parcial = trim($_POST['txtnum_pedido_parcial']); 

$SQLEliminar_CZ = "DELETE FROM MAESTRO_CZ_1";
$RSEliminar_CZ = odbc_exec($con,$SQLEliminar_CZ);

$SQLEliminar_dt = "DELETE FROM MAESTRO_DT_1";
$RSEliminar_dt = odbc_exec($con,$SQLEliminar_dt);

/****COPIA EL COMPROBANTE EN LA TABLA AUXILIAR***/

$SqlCopiar_cz ="INSERT INTO MAESTRO_CZ_1 (COD_MOV,TIPO_MOV,DETALLE_MOVIMIENTO,FECHA_EMISION,PERIODO_EMISION,ID_TD,TXT_SERIE,DOCUMENTO,ID_BENEFICIARIO,ID_USUARIO,TOTAL_VENTA,EFECTIVO,VUELTO,FECHA_REGISTRO,TRANSPORTISTA,DOCUMENTO_REF,ESTADO_CIERRE,MOTIVO_DEVOLUCION,HORA_EMISION,ANO,ID_LOCAL,BOUCHER_DIGITAL,GLOSA,VALOR_VENTA,IGV,GRAVADAS,INAFECTAS,EXONERADAS,PERIODO_CONTABLE,MONEDA,COD_CONTABLE,COD_MOV_CONTA,DESTINO_CONT,FILTRO_CIERRE,MNT_TOT_GRAVADAS,MNT_TOT_INAFECTAS,MNT_TOT_EXONERADAS,MNT_TOT_GRATUITAS,MNT_TOT,ESTADO_ELECTRO,FECHA_REFERENCIA,TXT_DESCR_MTVO_BAJA,txt_serie_ref,txt_correlativo_cpe_ref,fec_emis_ref,txt_sustento,cod_tip_nc_nd_ref,FECHA_CONTABLE,NUM_PROGRAMACION,OBSERV_FALTA_2,ESTADO_FINAL,BOUCHER_DIGITAL_1,REG_COMPRA,COD_CPE_REF,ESTADO_ENVIADO_ITC,COD_TIP_FRPAGO,MNTO_CRDT_TTAL,MNTO_CRDT_CTA,FCH_CTA,ESTADO_ENVIO_CLIENTE,ARCHIVO_PDF,TIPO_CAMBIO,MONTO_PAGADO,DETALLE_MOVIMIENTO_T,FECHA_LLEGADA,DOC_INGRESO,ESTADO_INVENTARIO,TIPO_COMPRA) 

SELECT COD_MOV,TIPO_MOV,DETALLE_MOVIMIENTO,FECHA_EMISION,PERIODO_EMISION,ID_TD,TXT_SERIE,DOCUMENTO,ID_BENEFICIARIO,ID_USUARIO,TOTAL_VENTA,EFECTIVO,VUELTO,FECHA_REGISTRO,TRANSPORTISTA,DOCUMENTO_REF,ESTADO_CIERRE,MOTIVO_DEVOLUCION,HORA_EMISION,ANO,ID_LOCAL,BOUCHER_DIGITAL,GLOSA,VALOR_VENTA,IGV,GRAVADAS,INAFECTAS,EXONERADAS,PERIODO_CONTABLE,MONEDA,COD_CONTABLE,COD_MOV_CONTA,DESTINO_CONT,FILTRO_CIERRE,MNT_TOT_GRAVADAS,MNT_TOT_INAFECTAS,MNT_TOT_EXONERADAS,MNT_TOT_GRATUITAS,MNT_TOT,ESTADO_ELECTRO,FECHA_REFERENCIA,TXT_DESCR_MTVO_BAJA,txt_serie_ref,txt_correlativo_cpe_ref,fec_emis_ref,txt_sustento,cod_tip_nc_nd_ref,FECHA_CONTABLE,NUM_PROGRAMACION,OBSERV_FALTA_2,ESTADO_FINAL,BOUCHER_DIGITAL_1,REG_COMPRA,COD_CPE_REF,ESTADO_ENVIADO_ITC,COD_TIP_FRPAGO,MNTO_CRDT_TTAL,MNTO_CRDT_CTA,FCH_CTA,ESTADO_ENVIO_CLIENTE,ARCHIVO_PDF,TIPO_CAMBIO,MONTO_PAGADO,DETALLE_MOVIMIENTO_T,FECHA_LLEGADA,DOC_INGRESO,ESTADO_INVENTARIO,TIPO_COMPRA FROM MAESTRO_CZ WHERE COD_MOV='$axcod_mov_cz_parcial'";

	$RSCopiar_cz = odbc_exec($con,$SqlCopiar_cz);
	//echo $SqlCopiar.'<br>';

	if($RSCopiar_cz){


			$SqlCopiar_dt ="INSERT INTO MAESTRO_DT_1 (COD_MOV,ID_PRODUCTO,CANT_INGRESO,COSTO_PRODUCTO,DSCTOS_INGRESO,VALOR_INGRESO,IGV_INGRESO,GRAVADAS_INGRESO,INAFECTO_INGRESOS,EXONERADO_INGRESO,TOTAL_INGRESO,CANT_SALIDA,PRS_MAYOR,PRS_PREMIUN,PRS_MENOR,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,FORMA_PAGO,DIAS_PAGO,FECHA_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,NUM_TRANSF,POR_DETRACCION,MONTO_DETRACCION,NUM_DETRACCION,FECHA_DETRACCION,ESTADO_PRODUCTO,OBSERVAR,FECHA_TRANSF,ID_CTA,PERIODO_TRANSF,NUM_LIN_ITEM,PRS_VENTA,COD_MOV_PR_GUIA,CANT_PADRE,TIPO_ENTREGA)

		SELECT COD_MOV,ID_PRODUCTO,CANT_INGRESO,COSTO_PRODUCTO,DSCTOS_INGRESO,VALOR_INGRESO,IGV_INGRESO,GRAVADAS_INGRESO,INAFECTO_INGRESOS,EXONERADO_INGRESO,TOTAL_INGRESO,CANT_SALIDA,PRS_MAYOR,PRS_PREMIUN,PRS_MENOR,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,FORMA_PAGO,DIAS_PAGO,FECHA_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,NUM_TRANSF,POR_DETRACCION,MONTO_DETRACCION,NUM_DETRACCION,FECHA_DETRACCION,ESTADO_PRODUCTO,OBSERVAR,FECHA_TRANSF,ID_CTA,PERIODO_TRANSF,NUM_LIN_ITEM,PRS_VENTA,COD_MOV_PR_GUIA,CANT_PADRE,TIPO_ENTREGA FROM MAESTRO_DT WHERE COD_MOV='$axcod_mov_cz_parcial'";

			$RSCopiar_dt = odbc_exec($con,$SqlCopiar_dt);
			//echo $SqlCopiar_dt.'<br>';

		}

	/*****ACTUALIZO LA TABLA AUXILIAR CON EL NUEVO COD_MOV Y EL PEDIDO******/

	$sqlactualizar_1 = "UPDATE MAESTRO_CZ_1 SET COD_MOV='$axcod_mov_cz',NUM_PEDIDO='$axnum_pedido' WHERE COD_MOV='$axcod_mov_cz_parcial'";
	$rsactualizar_1 = odbc_exec($con,$sqlactualizar_1);

	$sqlactualizar_2 = "UPDATE MAESTRO_DT_1 SET COD_MOV='$axcod_mov_cz' WHERE COD_MOV='$axcod_mov_cz_parcial'";
	$rsactualizar_2 = odbc_exec($con,$sqlactualizar_2);

	/******************INSERTO LOS REGISTROS DE LA TABLA MAESTRO_CZ_1 Y MAESTRO_DT_1 A LAS TABLAS ORIGINALES*************************/

	$SqlCopiar_cz_aux ="INSERT INTO MAESTRO_CZ (COD_MOV,TIPO_MOV,DETALLE_MOVIMIENTO,FECHA_EMISION,PERIODO_EMISION,ID_TD,TXT_SERIE,DOCUMENTO,ID_BENEFICIARIO,ID_USUARIO,TOTAL_VENTA,EFECTIVO,VUELTO,FECHA_REGISTRO,TRANSPORTISTA,DOCUMENTO_REF,ESTADO_CIERRE,MOTIVO_DEVOLUCION,HORA_EMISION,ANO,ID_LOCAL,BOUCHER_DIGITAL,GLOSA,VALOR_VENTA,IGV,GRAVADAS,INAFECTAS,EXONERADAS,PERIODO_CONTABLE,MONEDA,COD_CONTABLE,DESTINO_CONT,FILTRO_CIERRE,MNT_TOT_GRAVADAS,MNT_TOT_INAFECTAS,MNT_TOT_EXONERADAS,MNT_TOT_GRATUITAS,MNT_TOT,ESTADO_ELECTRO,FECHA_REFERENCIA,TXT_DESCR_MTVO_BAJA,txt_serie_ref,txt_correlativo_cpe_ref,fec_emis_ref,txt_sustento,cod_tip_nc_nd_ref,FECHA_CONTABLE,NUM_PROGRAMACION,OBSERV_FALTA_2,ESTADO_FINAL,BOUCHER_DIGITAL_1,REG_COMPRA,COD_CPE_REF,ESTADO_ENVIADO_ITC,COD_TIP_FRPAGO,MNTO_CRDT_TTAL,MNTO_CRDT_CTA,FCH_CTA,ESTADO_ENVIO_CLIENTE,ARCHIVO_PDF,TIPO_CAMBIO,MONTO_PAGADO,DETALLE_MOVIMIENTO_T,FECHA_LLEGADA,DOC_INGRESO,ESTADO_INVENTARIO,TIPO_COMPRA,NUM_PEDIDO) 

SELECT COD_MOV,TIPO_MOV,DETALLE_MOVIMIENTO,FECHA_EMISION,PERIODO_EMISION,ID_TD,TXT_SERIE,DOCUMENTO,ID_BENEFICIARIO,ID_USUARIO,TOTAL_VENTA,EFECTIVO,VUELTO,FECHA_REGISTRO,TRANSPORTISTA,DOCUMENTO_REF,ESTADO_CIERRE,MOTIVO_DEVOLUCION,HORA_EMISION,ANO,ID_LOCAL,BOUCHER_DIGITAL,GLOSA,VALOR_VENTA,IGV,GRAVADAS,INAFECTAS,EXONERADAS,PERIODO_CONTABLE,MONEDA,COD_CONTABLE,DESTINO_CONT,FILTRO_CIERRE,MNT_TOT_GRAVADAS,MNT_TOT_INAFECTAS,MNT_TOT_EXONERADAS,MNT_TOT_GRATUITAS,MNT_TOT,ESTADO_ELECTRO,FECHA_REFERENCIA,TXT_DESCR_MTVO_BAJA,txt_serie_ref,txt_correlativo_cpe_ref,fec_emis_ref,txt_sustento,cod_tip_nc_nd_ref,FECHA_CONTABLE,NUM_PROGRAMACION,OBSERV_FALTA_2,ESTADO_FINAL,BOUCHER_DIGITAL_1,REG_COMPRA,COD_CPE_REF,ESTADO_ENVIADO_ITC,COD_TIP_FRPAGO,MNTO_CRDT_TTAL,MNTO_CRDT_CTA,FCH_CTA,ESTADO_ENVIO_CLIENTE,ARCHIVO_PDF,TIPO_CAMBIO,MONTO_PAGADO,DETALLE_MOVIMIENTO_T,FECHA_LLEGADA,DOC_INGRESO,ESTADO_INVENTARIO,TIPO_COMPRA,NUM_PEDIDO FROM MAESTRO_CZ_1 WHERE COD_MOV='$axcod_mov_cz'";
	
	$RSCopiar_cz_aux = odbc_exec($con,$SqlCopiar_cz_aux);
	//echo $SqlCopiar_cz_aux.'<br>';

	if($RSCopiar_cz_aux){

		$SqlCopiar_dt_aux ="INSERT INTO MAESTRO_DT (COD_MOV,ID_PRODUCTO,CANT_INGRESO,COSTO_PRODUCTO,DSCTOS_INGRESO,VALOR_INGRESO,IGV_INGRESO,GRAVADAS_INGRESO,INAFECTO_INGRESOS,EXONERADO_INGRESO,TOTAL_INGRESO,CANT_SALIDA,PRS_MAYOR,PRS_PREMIUN,PRS_MENOR,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,FORMA_PAGO,DIAS_PAGO,FECHA_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,NUM_TRANSF,POR_DETRACCION,MONTO_DETRACCION,NUM_DETRACCION,FECHA_DETRACCION,ESTADO_PRODUCTO,OBSERVAR,FECHA_TRANSF,ID_CTA,PERIODO_TRANSF,NUM_LIN_ITEM,PRS_VENTA,COD_MOV_PR_GUIA,CANT_PADRE,TIPO_ENTREGA)

		SELECT COD_MOV,ID_PRODUCTO,CANT_INGRESO,COSTO_PRODUCTO,DSCTOS_INGRESO,VALOR_INGRESO,IGV_INGRESO,GRAVADAS_INGRESO,INAFECTO_INGRESOS,EXONERADO_INGRESO,TOTAL_INGRESO,CANT_SALIDA,PRS_MAYOR,PRS_PREMIUN,PRS_MENOR,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA,FORMA_PAGO,DIAS_PAGO,FECHA_PAGO,ESTADO_FORMA_PAGO,MEDIO_PAGO,NUM_TRANSF,POR_DETRACCION,MONTO_DETRACCION,NUM_DETRACCION,FECHA_DETRACCION,ESTADO_PRODUCTO,OBSERVAR,FECHA_TRANSF,ID_CTA,PERIODO_TRANSF,NUM_LIN_ITEM,PRS_VENTA,COD_MOV_PR_GUIA,CANT_PADRE,TIPO_ENTREGA FROM MAESTRO_DT_1 WHERE COD_MOV='$axcod_mov_cz'";

			$RSCopiar_dt_aux = odbc_exec($con,$SqlCopiar_dt_aux);


	}

	$SQLPedidos = "UPDATE PEDIDOS SET ESTADO_ATENDIDO='PROGRAMADO',ESTADO_REVISION='CERRADO' WHERE ID_LOCAL='$axid_local' AND NUM_PEDIDO='$axnum_pedido'";
	$RSpedidos = odbc_exec($con,$SQLPedidos);
	//echo $SQLPedidos;

break;

case '255':

	$axnum_pedido =$_POST['txtnum_pedido'];
	$axid_local_cambiar =$_POST['txtid_local_cambiar'];

	$sql = "UPDATE PEDIDOS SET ID_LOCAL='$axid_local_cambiar' WHERE NUM_PEDIDO='$axnum_pedido'";
	$rsl = odbc_exec($con,$sql);

	if($rsl){

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;

	}



break;

}//switch ($param) {


	function generateRandomCode($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomCode = '';
    
    for ($i = 0; $i < $length; $i++) {
        $randomCode .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomCode;
}

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
$axnom_usario = get_row('usuarios','NOM_USUARIO','ID_USUARIO',$axid_usuario);
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



