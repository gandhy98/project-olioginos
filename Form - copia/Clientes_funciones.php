<?php  

//require('../Imprimir/pdf_js.php');
require('../phpqrcode/qrlib.php');
require_once '../core2.php';


$param=$_POST['param'];


switch ($param) {

case '0': // listar usuarios

$axid_empresa = $_POST['txtid_empresa'];	
$axbuscar = $_POST['txtbuscar_medios'];	

if($axbuscar ==''){
	$SQLListar ="SELECT ID_CLIENTE,NUM_DOCUMENTO,NOM_CLIENTE,NUM_CELULAR,EMAIL_CLIENTE,ESTADO_CIVIL,ESTADO_CLIENTE FROM CLIENTES WHERE ID_EMPRESA ='$axid_empresa' ORDER BY ID_CLIENTE ASC";
}else{
	$SQLListar ="SELECT ID_CLIENTE,NUM_DOCUMENTO,NOM_CLIENTE,NUM_CELULAR,EMAIL_CLIENTE,ESTADO_CIVIL,ESTADO_CLIENTE FROM CLIENTES WHERE ID_EMPRESA ='$axid_empresa' AND NOM_CLIENTE LIKE '%".$axbuscar."%' ORDER BY ID_CLIENTE ASC";
}

//echo $SQLListar;
$RSListar = odbc_exec($con,$SQLListar);

if( odbc_num_rows($RSListar) > 0 ){

	echo "
<table class='table table-hover table-sm'>
	<thead class='table-primary'>			
		<tr>
			<th style='text-align: center;'>Nº</th>			
			<th style='text-align: center;'>NUM. DOCUMENTO</th>
			<th style='text-align: left;'>NOMBRE DE CLIENTE</th>
			<th style='text-align: center;'>NUM. CELULAR</th>
			<th style='text-align: left;'>CORREO ELECTRONICO</th>
			<th style='text-align: center;'>ESTADO CIVIL</th>
			<th style='text-align: center;'>ESTADO</th>
			<th style='text-align: center;'>ACCION</th>
		</tr>
	</thead>";

	while ($fila =  odbc_fetch_array($RSListar)) {
		
		$it= $it+1;
		$axid_cliente = $fila['ID_CLIENTE'];
		$axnum_documento = $fila['NUM_DOCUMENTO'];	
		$axnom_cliente = $fila['NOM_CLIENTE'];	
		$axnum_celular = $fila['NUM_CELULAR'];	
		$axemail_cliente = $fila['EMAIL_CLIENTE'];	
		$axestado_civil = $fila['ESTADO_CIVIL'];	
		$axestado_cliente = $fila['ESTADO_CLIENTE'];	

		echo "
 		<tr>
 			<td style='text-align: center;' >$it</td>
 			<td style='text-align: center;' >$axnum_documento</td>
 			<td style='text-align: left;' >$axnom_cliente</td> 			
 			<td style='text-align: center;' >$axnum_celular</td> 			
 			<td style='text-align: left;' >$axemail_cliente</td> 			
 			<td style='text-align: center;' >$axestado_civil</td> 			
 			<td style='text-align: center;' >$axestado_cliente</td> 			 			
 			
 			<td style='text-align: center;'>
 				<div class='btn-group dropstart'>
					<button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
					<ul class='dropdown-menu'>	
					<div><hr class='dropdown-divider'></div>				  	
					<a href='#' class='dropdown-item text-info' id='btn_editar_cliente' data-id='$axid_cliente' data-bs-toggle='modal' data-bs-target='#exampleModal'><b><i class='bi bi-pencil' ></i> Editar</a></b>
					<a href='#' class='dropdown-item text-danger' id='btn_eliminar_cliente' data-id='$axid_cliente' ><b><i class='bi bi-trash3-fill'></i> Eliminar</a></b>
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

$axid_cliente = $_POST['txtid_cliente'];
$axtipo_cliente = $_POST['txttipo_cliente'];
$axid_doc = $_POST['txtid_doc'];
$axnum_documento = $_POST['txtnum_documento'];
$axcod_cliente = $_POST['txtcod_cliente'];
$axnombres_cliente = $_POST['txtnombres_cliente'];
$axpaterno_cliente = $_POST['txtpaterno_cliente'];
$axmaterno_cliente = $_POST['txtmaterno_cliente'];
$axnom_cliente = $_POST['txtnom_cliente'];
$axemail_cliente = $_POST['txtemail_cliente'];
$axnum_celular = $_POST['txtnum_celular'];
$axestado_civil = $_POST['txtestado_civil'];
$axgenero_cliente = $_POST['txtgenero_cliente'];
$axfecha_nac_cliente = $_POST['txtfecha_nac_cliente'];
$axnum_doc_conyugue = $_POST['txtnum_doc_conyugue'];
$axnombres_conyugue = $_POST['txtnombres_conyugue'];
$axpaterno_conyugue = $_POST['txtpaterno_conyugue'];
$axmaterno_conyugue = $_POST['txtmaterno_conyugue'];
$axnom_conyugue = $_POST['txtnom_conyugue'];
$axdireccion_cliente = $_POST['txtdireccion_cliente'];
$axdistrito = $_POST['txtdistrito'];
$axprovincia = $_POST['txtprovincia'];
$axdepartamento = $_POST['txtdepartamento'];
$axnacion_cliente = $_POST['txtnacion_cliente'];
$axnom_carpeta = $_POST['txtnom_carpeta'];
$axid_empresa = $_POST['txtid_empresa'];
$axestado_cliente = $_POST['txtestado_cliente'];
$axparametros = $_POST['txtparametros'];

if($axparametros==0){

	$axverificar =get_row('CLIENTES','NOM_CLIENTE','NUM_DOCUMENTO',$axnum_documento);
	//echo $axverificar;

	if($axverificar ==''){

		$rutacarpeta = '../Archivos/FILE_CLIENTES/';
		$nombreCarpeta = $axnum_documento.'/';
		$axnom_carpeta = crearCarpeta($nombreCarpeta,$rutacarpeta);

		$sqlgrabar = "INSERT INTO CLIENTES (TIPO_CLIENTE,ID_DOC,NUM_DOCUMENTO,COD_CLIENTE,NOMBRES_CLIENTE,PATERNO_CLIENTE,MATERNO_CLIENTE,NOM_CLIENTE,EMAIL_CLIENTE,NUM_CELULAR,ESTADO_CIVIL,GENERO_CLIENTE,FECHA_NAC_CLIENTE,NUM_DOC_CONYUGUE,NOMBRES_CONYUGUE,PATERNO_CONYUGUE,MATERNO_CONYUGUE,NOM_CONYUGUE,DIRECCION_CLIENTE,DISTRITO,PROVINCIA,DEPARTAMENTO,NACION_CLIENTE,NOM_CARPETA,ID_EMPRESA,ESTADO_CLIENTE) VALUES ('$axtipo_cliente','$axid_doc','$axnum_documento','$axcod_cliente','$axnombres_cliente','$axpaterno_cliente','$axmaterno_cliente','$axnom_cliente','$axemail_cliente','$axnum_celular','$axestado_civil','$axgenero_cliente','$axfecha_nac_cliente','$axnum_doc_conyugue','$axnombres_conyugue','$axpaterno_conyugue','$axmaterno_conyugue','$axnom_conyugue','$axdireccion_cliente','$axdistrito','$axprovincia','$axdepartamento','$axnacion_cliente','$axnom_carpeta','$axid_empresa','$axestado_cliente')";


		$detalle='AGREGO EL CLIENTE NUEVO '.$axnom_cliente;

	}else{

		$respuesta =3;
		echo $respuesta;
		break;

	}

	

}else{

	$sqlgrabar = "UPDATE CLIENTES SET TIPO_CLIENTE='$axtipo_cliente',ID_DOC='$axid_doc',NUM_DOCUMENTO='$axnum_documento',COD_CLIENTE='$axcod_cliente',NOMBRES_CLIENTE='$axnombres_cliente',PATERNO_CLIENTE='$axpaterno_cliente',MATERNO_CLIENTE='$axmaterno_cliente',NOM_CLIENTE='$axnom_cliente',EMAIL_CLIENTE='$axemail_cliente',NUM_CELULAR='$axnum_celular',ESTADO_CIVIL='$axestado_civil',GENERO_CLIENTE='$axgenero_cliente',FECHA_NAC_CLIENTE='$axfecha_nac_cliente',NUM_DOC_CONYUGUE='$axnum_doc_conyugue',NOMBRES_CONYUGUE='$axnombres_conyugue',PATERNO_CONYUGUE='$axpaterno_conyugue',MATERNO_CONYUGUE='$axmaterno_conyugue',NOM_CONYUGUE='$axnom_conyugue',DIRECCION_CLIENTE='$axdireccion_cliente',DISTRITO='$axdistrito',PROVINCIA='$axprovincia',DEPARTAMENTO='$axdepartamento',NACION_CLIENTE='$axnacion_cliente',NOM_CARPETA='$axnom_carpeta',ID_EMPRESA='$axid_empresa',ESTADO_CLIENTE='$axestado_cliente' WHERE ID_CLIENTE='$axid_cliente'";

	$detalle='EDITO LOS DATOS DEL CLIENTE '.$axnom_cliente;
}

//echo $sqlgrabar;
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

$axid_cliente= $_POST['txtid_cliente'];
	
	$sql6 = "SELECT * FROM CLIENTES WHERE ID_CLIENTE = '$axid_cliente'";
	
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

$axid_cliente= $_POST['txtid_cliente'];
$axnom_cliente = get_row('CLIENTES','NOM_CLIENTE','ID_CLIENTE',$axid_cliente);
	
	$sql6 = "DELETE FROM CLIENTES WHERE ID_CLIENTE = '$axid_cliente'";
	$rsgrabar = odbc_exec($con,$sql6);

	if($rsgrabar){


	/***************************************/
	    $id_user =$_POST['txtid_usuario'];
	    $modulo = $_POST['txtmodulo'];	    
	    $detalle='ELIMINO EL CLIENTE '.$axnom_cliente;
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

$token ='apis-token-1842.1TicMx74Ee3kROx3PHhIW7dScOyG6P3n';
$dni = $_POST['txtnum_documento']; 

$sqlverificar = "SELECT * FROM CLIENTES WHERE NUM_DOCUMENTO = '$dni'";
$rserificar = odbc_exec($con,$sqlverificar);
//echo $sqlverificar;

if(odbc_num_rows($rserificar) == 0) {

	$sqlprospectos = "SELECT * FROM MK_PROSPECTOS_CZ WHERE NUM_DOC_CLIENTE_PST = '$dni'";
	$rsprospectos = odbc_exec($con,$sqlprospectos);

	if(odbc_num_rows($rsprospectos)== 1){

		$axlistaprov1 = odbc_fetch_object($rsprospectos);
      	$axlistaprov1 ->status =201;
      	echo json_encode($axlistaprov1);

	}else{

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

	}
               
} else {

  	$axlistar_clientes = odbc_fetch_object($rserificar);
    $axlistar_clientes ->status =202;
    echo json_encode($axlistar_clientes);

  }

break;

case '5':
	
$token ='apis-token-3427.Da8fJtEPmb4b3NjaWrDoDtG8vCRuUjyL';
$ruc = $_POST['txtnum_documento'];

$sqlverificar = "SELECT * FROM CLIENTES WHERE NUM_DOCUMENTO = '$ruc'";
$rserificar = odbc_exec($con,$sqlverificar);
//echo $sqlverificar;

if(odbc_num_rows($rserificar) == 0) {

	$sqlprospectos = "SELECT * FROM MK_PROSPECTOS_CZ WHERE NUM_DOC_CLIENTE_PST = '$ruc'";
	$rsprospectos = odbc_exec($con,$sqlprospectos);
	//echo $sqlprospectos;

	if(odbc_num_rows($rsprospectos)== 1){

		$axlistaprov1 = odbc_fetch_object($rsprospectos);
      	$axlistaprov1 ->status =201;
      	echo json_encode($axlistaprov1);

	}else{

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
		$empresa = json_decode($response);
		echo json_encode($empresa);


	

	}
               
} else {

  	$axlistar_clientes = odbc_fetch_object($rserificar);
    $axlistar_clientes ->status =202;
    echo json_encode($axlistar_clientes);

  }

break;
case '6':

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
case '7':
	
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

case '8':
	
$token ='apis-token-1842.1TicMx74Ee3kROx3PHhIW7dScOyG6P3n';
$dni = $_POST['txtnum_doc_conyugue']; 


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



function crearCarpeta($nombreCarpeta,$rutacarpeta) {
    // Ruta donde deseas crear la carpeta
    $ruta = $rutacarpeta . $nombreCarpeta;

    // Verificar si la carpeta no existe antes de crearla
    if (!file_exists($ruta)) {
        // Crear la carpeta con permisos de escritura
        if (mkdir($ruta, 0777, true)) {
            return "$ruta";
        } else {
            return "Error al crear la carpeta en $ruta";
        }
    } else {
        return "La carpeta ya existe en $ruta";
    }
}

// Ejemplo de uso
/*
$nombreCarpeta = 'mi_carpeta';
$resultado = crearCarpeta($nombreCarpeta);
echo $resultado;
*/

?>
