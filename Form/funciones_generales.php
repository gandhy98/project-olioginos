<?php  

//require('../Imprimir/pdf_js.php');
require('../phpqrcode/qrlib.php');

require_once '../core2.php';


$param=$_POST['param'];


switch ($param) {

case '0': // listar usuarios

			
$randomCode = generateRandomCode();
// Genera el QR Code
//QRcode::png($randomCode, '../Archivos/QRs/'.$randomCode.'.png');

echo trim($randomCode);

break;

case '1':

$axmodulo = $_POST['txtmodulo'];

$axid_menu = get_row('MODULOS','ID_MENU','NOM_MENU',$axmodulo);

$SQLListar = "SELECT * FROM TUTORIALES WHERE ID_MENU='$axid_menu' ORDER BY FECHA_CARGA DESC";

$RSLISTAR = odbc_exec($con,$SQLListar);
//echo $SQLListar;

if($RSLISTAR){

   while($fila = odbc_fetch_array($RSLISTAR)){

      $axid_tutorial = $fila['ID_TUTORIAL'];
      $axnom_tutorial = utf8_encode($fila['NOM_TUTORIAL']);
      $axarchivo_digital = $fila['NOM_RUTA_ARCHIVO'];
      $axfecha = $fila['FECHA_CARGA'];      
      echo "<a href='$axarchivo_digital' class='list-group-item list-group-item-action' target='_blank'>$axfecha - $axnom_tutorial </a>";

   }

}

break;

case '2':

$axmodulo = trim($_POST['txtmodulo']); 
   //echo $axmodulo;
   $axnombre = get_row('MODULOS','NOM_MOSTRAR','NOM_MENU',$axmodulo);
   echo trim(utf8_encode(($axnombre)));

	break;
case '3':

   $axiduser = $_POST['txtid_usuario'];   
   $axmodulo = $_POST['txtmodulo']; 

   
   $sql6 = "SELECT * FROM MODULO_ASIGNADO WHERE ID_USUARIO = '$axiduser' and NOM_MENU='TOTAL'";
   $rspermisos=odbc_exec($con,$sql6);
   //echo $sql6;

   if(odbc_num_rows($rspermisos) == 1){

      /***************************************/
      $id_user =$axiduser;
      $modulo = $_POST['txtmodulo'];
      $detalle='INICIO EL MODULO '.$modulo;
      guardar_bitacora($id_user,$modulo,$detalle);
      /***************************************/

      $respuesta = 0;
      echo trim($respuesta); // ACCESO TOTAL

   } else {

      $sql7 = "SELECT * FROM MODULO_ASIGNADO WHERE ID_USUARIO = '$axiduser' and NOM_MENU='$axmodulo'";
      $rspermisos7=odbc_exec($con,$sql7);

      //echo $sql7;

      if(odbc_num_rows($rspermisos7) == 1){

         /***************************************/
         $id_user =$axiduser;
         $modulo = $_POST['txtmodulo'];
         $detalle='INICIO EL MODULO '.$modulo;
         guardar_bitacora($id_user,$modulo,$detalle);
         /***************************************/

         $respuesta = 0;
         echo trim($respuesta); // ACCESO AL MODULO

      } else{

         /***************************************/
         $id_user =$axiduser;
         $modulo = $_POST['txtmodulo'];
         $detalle='INTENTO INICIAR EL MODULO '.$modulo;
         guardar_bitacora($id_user,$modulo,$detalle);
         /***************************************/

         $respuesta = 1;
         echo trim($respuesta); // NO TIENE ACCESO A ESTE MODULO
      }     

   }

	break;

case '4':
   
   /***************************************/
   
   $id_user =$axiduser;
   $modulo = $_POST['txtmodulo'];
   $detalle='INICIO EL MODULO '.$modulo;
     
   guardar_bitacora($id_user,$modulo,$detalle);

   /***************************************/


break;

case '5':
// Datos

$token ='apis-token-3427.Da8fJtEPmb4b3NjaWrDoDtG8vCRuUjyL';
$ruc = $_POST['txtnum_doc_cliente_pst'];


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
case '6':
   
$token ='apis-token-1842.1TicMx74Ee3kROx3PHhIW7dScOyG6P3n';
$dni = $_POST['txtnum_doc_cliente_pst']; 


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

case '7':
   $axiduser = $_POST['txtid_usuario'];   
   $axmodulo = $_POST['txtmodulo_eliminar']; 

   
   
   $sql6 = "SELECT * FROM MODULO_ASIGNADO WHERE ID_USUARIO = '$axiduser' and NOM_MENU='TOTAL'";
   $rspermisos=odbc_exec($con,$sql6);
   //echo $sql6;

   if(odbc_num_rows($rspermisos) == 1){

      /***************************************/
      $id_user =$axiduser;
      $modulo = $_POST['txtmodulo'];
      $detalle='INICIO EL MODULO '.$modulo;
      guardar_bitacora($id_user,$modulo,$detalle);
      /***************************************/

      $respuesta = 0;
      echo trim($respuesta); // ACCESO TOTAL

   } else {

      $sql7 = "SELECT * FROM MODULO_ASIGNADO WHERE ID_USUARIO = '$axiduser' and NOM_MENU='$axmodulo'";
      $rspermisos7=odbc_exec($con,$sql7);

      //echo $sql7;

      if(odbc_num_rows($rspermisos7) == 1){

         /***************************************/
         $id_user =$axiduser;
         $modulo = $_POST['txtmodulo'];
         $detalle='INICIO EL MODULO '.$modulo;
         guardar_bitacora($id_user,$modulo,$detalle);
         /***************************************/

         $respuesta = 0;
         echo trim($respuesta); // ACCESO AL MODULO

      } else{

         /***************************************/
         $id_user =$axiduser;
         $modulo = $_POST['txtmodulo'];
         $detalle='INTENTO INICIAR EL MODULO '.$modulo;
         guardar_bitacora($id_user,$modulo,$detalle);
         /***************************************/

         $respuesta = 1;
         echo trim($respuesta); // NO TIENE ACCESO A ESTE MODULO
      }     

   }
   


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


?>
