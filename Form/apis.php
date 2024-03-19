<?php  

//require('../Imprimir/pdf_js.php');

require('../Imprimir/Classes/PHPExcel/IOFactory.php');
require('../Imprimir/pdf_js.php');
require_once '../core2.php';


$param=$_POST['param'];
date_default_timezone_set("America/Lima");

switch ($param) {

case '0': // TIPO DE CAMBIO

//$token = 'apis-token-1.aTSI1U7KEuT-6bbbCguH-4Y8TI6KS73N';
$token ='apis-token-3427.Da8fJtEPmb4b3NjaWrDoDtG8vCRuUjyL';
$fecha = $_POST['txtfecha_actual'];

// Iniciar llamada a API
$curl = curl_init();

curl_setopt_array($curl, array(
  // para usar la api versión 2
  CURLOPT_URL => 'https://api.apis.net.pe/v2/sunat/tipo-cambio?date=' . $fecha,
  // para usar la api versión 1
  // CURLOPT_URL => 'https://api.apis.net.pe/v1/tipo-cambio-sunat?fecha=' . $fecha,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 2,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Referer: https://apis.net.pe/tipo-de-cambio-sunat-api',
    'Authorization: Bearer ' . $token
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$tipoCambioSunat = json_decode($response);
//var_dump($tipoCambioSunat);
echo json_encode($tipoCambioSunat);
	
break;

}//switch ($param) {


?>



