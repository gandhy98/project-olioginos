<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


//error_reporting(0);
error_reporting(E_ALL ^ E_NOTICE);

define('DB_HOST', 'www.necesitounprograma.com');//DB_HOST:  generalmente suele ser "127.0.0.1"
define('DB_USER', 'sa');//Usuario de tu base de datos
define('DB_PASS', 'auditek*1');//Contrase�a del usuario de la base de datos
define('DB_NAME', 'PlusInmobiliaria');//Nombre de la base de datos

/*
define('DB_HOST', 'SOFTCATEDRAL23\SQLEXPRESS');//DB_HOST:  generalmente suele ser "127.0.0.1"
define('DB_USER', 'sa');//Usuario de tu base de datos
define('DB_PASS', '292522');//Contrase�a del usuario de la base de datos
define('DB_NAME', 'PlusInmobiliaria');//Nombre de la base de datos
*/

$connection_string = "DRIVER={SQL Server};SERVER=".DB_HOST.";DATABASE=".DB_NAME; 
$con = odbc_connect($connection_string,DB_USER,DB_PASS);

$axRuc = $_POST['txtRuc']; 
$axUsuario = $_POST['txtUsuario']; 
$axclave_1 = $_POST['txtContrasena_nueva']; 
$axclave_2 = $_POST['txtContrasena_nueva_verificar']; 
$axid_usuario = get_row('USUARIOS_C','ID_USUARIO','USUARIO',$axUsuario);

$SQLActualizar = "UPDATE USUARIO SET CLAVE='$axclave_1',CLAVE_VERIFICAR='$axclave_2' WHERE ID_USUARIO='$axid_usuario'";
$RSActualizar = odbc_exec($con,$SQLActualizar);

if($RSActualizar){

   // header('location: index.php');  

    $respuesta=0;
    echo $respuesta;

}else{

    $respuesta=1;
    echo $respuesta;

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
