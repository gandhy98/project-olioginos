<?php  

//require('../Imprimir/pdf_js.php');
//require_once 'core2.php';
require_once('Conexion/conexion.php');


$param=$_POST['param'];


switch ($param) {

case '0': // listar usuarios

	$axusuario = $_POST['txtUsuario']; 
	$sql6 ="SELECT TOP 1 * FROM USUARIO WHERE USUARIO='$axusuario'";
	//echo $sql6;
	$rsbuscar=odbc_exec($con,$sql6);
	
	if(odbc_num_rows($rsbuscar) == 1) {
    
	    while($fila = odbc_fetch_array($rsbuscar)) {

	    	$axdni = $fila['COD_USUARIO'];
	    	$respuesta = substr($axdni,0,3);
	    	echo $respuesta;
	    }
      
	} 

	
break;
case '1':
	
$axdniusuario = $_POST['txtdniusuario']; 
$axusuario = $_POST['txtUsuario']; 
$axclave_nueva = $_POST['txtContrasena_nueva']; 
$axclave_nueva_verificar = $_POST['txtContrasena_nueva_verificar']; 

	$sql6 ="SELECT TOP 1 * FROM USUARIO WHERE USUARIO='$axusuario' AND COD_USUARIO='$axdniusuario' AND ESTADO_HABILITADO='ACTIVO'";
	echo $sql6;
	$rsbuscar=odbc_exec($con,$sql6);
	
	if(odbc_num_rows($rsbuscar) == 1) {
    
	    while($fila = odbc_fetch_array($rsbuscar)) {

	    	$axiduser = $fila['ID_USUARIO'];
	    	$SQLActualizar = "UPDATE USUARIO SET CLAVE ='$axclave_nueva',CLAVE_VERIFICAR='$axclave_nueva_verificar' WHERE ID_USUARIO='$axiduser'";
	    	$RSActualizar = odbc_exec($con, $SQLActualizar);

	    	if($RSActualizar){

	    		$axnombre = $fila['NOM_USUARIO'];
	    		$respuesta = $axnombre;
	    		echo $respuesta;

	    		//header('location: ../index.html');  
	    		
	    	}else{

	    		$respuesta = 2; // nose actualizo la clave
	    		echo $respuesta;

	    	}

	    	
	    }
      
	}else{

		$respuesta = 1;
	    echo $respuesta;
	}



break;
case '2':
	
$axUsuario = $_POST['txtUsuario']; 
$axRuc = $_POST['txtRuc']; 

$sql6 ="SELECT TOP 1 * FROM USUARIOS_C WHERE USUARIO='$axUsuario' AND RUC_EMPRESA='$axRuc'";
$rsbuscar=odbc_exec($con,$sql6);
if(odbc_num_rows($rsbuscar) == 1) {

	$fila = odbc_fetch_array($rsbuscar);
	$estado = $fila['ESTADO_HABILITADO'];

		if($estado=='ACTIVO'){
			$respuesta = 0; //existe el usuario
	  		echo $respuesta;		
		}elseif($estado=='INACTIVO'){
			$respuesta = 6; //existe ESTA INACTIVO
	  		echo $respuesta;		
	  	}elseif($estado=='BAJA'){
			$respuesta = 7; //ESTA DADO DE BAJA
	  		echo $respuesta;		
		}
		
		
}else{

		$respuesta = 1; //no existe el usuario
	  	echo $respuesta;	
}


break;

}
?>