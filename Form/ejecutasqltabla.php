<?php
	//error_reporting(0);
	$sql = $_POST['q'];
	//require_once "conexionmysql.php"; 
    require_once '../includes/core.php'; 
	
	$jsondata = array();
	
	if ( $result = odbc_exec($con,$sql)){
        //odbc_exec($con,$sqlinserta)
		if( $result) {
			//echo("entra aqui 1");
			$jsondata["success"] = true;
			$jsondata["data"]["message"] = sprintf("Se han encontrado %d datos", odbc_num_rows($result));
			$jsondata["data"]["formulas"] = array();
			$nn=1;
			
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
        //odbc_close($result);
	}else{
		//echo("entra aqui 3");
		$jsondata["success"] = false;
        $jsondata["data"] = array('message' => $con->error);
	}
	header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata, JSON_FORCE_OBJECT);
	exit();  
	?> 