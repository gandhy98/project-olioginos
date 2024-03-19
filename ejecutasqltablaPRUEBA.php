<?php
	//error_reporting(0);
	$sql = $_GET['q'];
	require_once "conexion/conexion.php"; 
	
	$jsondata = array();
	//$result = odbc_exec($con,$sql);
	
	
	//if ($RSBuscar){
 	//$it=0;
     //echo '<script language="javascript">console.log("'.json_encode($RSBuscar).'");</script>';
     //php_console_log($RSBuscar);
 	//while ($fila=odbc_fetch_array($RSBuscar)){ 


	if ($result = odbc_exec($con,$sql)){
		//if( $result->num_rows > 0 ) {
		if(odbc_num_rows($result) > 0){
			//echo("entra aqui 1");
			$jsondata["success"] = true;
			$jsondata["data"]["message"] = sprintf("Se han encontrado %d datos", $result->num_rows);
			$jsondata["data"]["formulas"] = array();
			$nn=1;
			//while( $row = $result->fetch_object() ) {
			while ($row=odbc_fetch_array($result)){ 
				$jsondata["data"]["formulas"][] = $row;
				//echo("prueba".$nn);
				$nn=$nn+1;
				//echo($jsondata["data"]["formulas"][0]);
			}	
		}else{
			//echo("entra aqui 2");
			$jsondata["success"] = false;
            $jsondata["data"] = array('message' => 'No se encontró ningún resultado.');
            $jsondata["data"]["formulas"] = array();
		}
		//$result->close();
	}else{
		//echo("entra aqui 3");
		$jsondata["success"] = false;
        $jsondata["data"] = array('message' => $con->error);
	}
	header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata, JSON_FORCE_OBJECT);
	exit();  
	?> 