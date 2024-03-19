<?php  

require('../Imprimir/Classes/PHPExcel/IOFactory.php');
require('../Imprimir/pdf_js.php');
require_once '../core2.php';

//Si la variable archivo que pasamos por URL no esta 
//establecida acabamos la ejecucion del script.
if (!isset($_GET['archivo']) || empty($_GET['archivo'])) {
   exit();
}

//Utilizamos basename por seguridad, devuelve el 
//nombre del archivo eliminando cualquier ruta. 
$axtipo = $_GET['axtipo'];
$axestado = $_GET['axestado'];
$axparam = $_GET['param'];
$axid_et = $_GET['id_et'];
$archivo_1 =$_GET['archivo'];
$axiduser =$_GET['user'];

//$axruta = $_GET['ruta'];
$archivo = basename($_GET['archivo']);
$ruta_archivo = $_GET['archivo'];

if (is_file($ruta_archivo)){

// hay una larga lista de content-type, por ejemplo:
header('Content-Type:application/octet-stream'); // rar
header('Content-Type:text/plain'); // txt, html, etc

// más esto:
header('Content-Type:application/force-download');
header('Content-Description:File Transfer');
header('Pragma:public');
header('Expires:0');
header('Cache-Control:no-cache,must-revalidate,post-check=0,pre-check=0');
header('Cache-Control:private,false');
header("Content-Disposition:attachment;filename={$archivo}");
header('Content-Length:'.filesize( $ruta_archivo ));
@readfile( $ruta_archivo );
die();  

}else{
   exit();

	//echo $archivo.'</br>';
	//echo $ruta_archivo.'</br>';
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

