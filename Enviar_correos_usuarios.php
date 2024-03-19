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

$axcorreo_empresa = get_row('USUARIOS_C','txt_correo_adquiriente','RUC_EMPRESA',$axRuc);
$axclave_empresa = get_row('USUARIOS_C','CLAVE_PRINCIPAL','RUC_EMPRESA',$axRuc);

$axcorreo_usuario = get_row('USUARIOS_C','CORREO_USUARIO','USUARIO',$axUsuario);
$axnombre_usuario = get_row('USUARIOS_C','NOM_USUARIO','USUARIO',$axUsuario);

echo 'usuario '.$axnombre_usuario;

if($axnombre_usuario !==''){

//echo $axcorreo_usuario;

// Configuración del servidor SMTP de Gmail
$mail = new PHPMailer(true);

try {
    
    $mail->SMTPDebug = 2; // Puedes ajustar el nivel de depuración
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $axcorreo_empresa; // Tu dirección de Gmail
    $mail->Password   = $axclave_empresa; // Tu contraseña de Gmail
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Configuración del correo
    $mail->setFrom($axcorreo_empresa, 'Soporte Plus Inmobiliaria RA.');
    $mail->addAddress($axcorreo_usuario, $axnombre_usuario);
    $mail->isHTML(true);
    $mail->Subject = utf8_decode('Restablece tu contraseña');
    $mail->Body    = '

              
    


            <h4>Estimado(a) <b>'.$axnombre_usuario.'</b></h4>

            <img src="https://www.necesitounprograma.com/catedral/PlusInmobiliariaRA/img/logo_inicio.jpeg" style="width: 150px;">

            <p>Recientemente hubo una solicitud para cambiar la contraseña de su cuenta.<br> 
            <b>Si usted solicita este cambio, establezca una nueva contraseña aquí:</b></p>
            <br>
            <div style="text-align:center; width:400px;">
            <a href="https://www.necesitounprograma.com/catedral/PlusInmobiliariaRA/restablecer_clave.php?user='.$axUsuario.'" type="button" style="text-decoration:none; margin-top: 10px;background-color: #F49818; color: #fff; border-radius: 20px; border: none;padding: 10px 15px; cursor: pointer; margin-top: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, .1);"> Restablecer contraseña </a>
            </div>
            
            <br>
            <br>
            <br>
            <p>Si usted no realizó esta solicitud, puede ignorar este mensaje de correo electrónico y la contraseña seguirá siendo la misma.</p>
            <br>
            <br>
            <b>Saludos,<br>El Equipo de Soporte de Plus Inmobiliaria RA.</b>
            <br>
            <br>
            <p><hr></p>
            <p>Este correo se envió desde una cuenta no monitoreada. Por favor, no responda a este correo.</p>

    ';

    // Envío del correo
    $mail->send();

    $respuesta = 0;
    echo $respuesta;

} catch (Exception $e) {

    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}


}else{

    $respuesta = 5;
    echo $respuesta; //USUARIO NO EXISTE---
    
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
