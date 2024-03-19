<?php  

//require('../Imprimir/pdf_js.php');
require('../phpqrcode/qrlib.php');
require_once '../conexion.php';

	
$axid_empresa = $_POST['txtid_empresa'];	
$axbuscar = $_POST['txtbuscar_canales'];	

if($axbuscar ==''){
	$SQLListar ="SELECT ID_AREA,AREA_TRABAJO,AREA_ENCARGADO FROM AREAS_TRABAJO WHERE ID_EMPRESA ='$axid_empresa' ORDER BY ID_AREA ASC";
}

//echo $SQLListar.'<br>';

$RSListar_c = odbc_exec($con, $SQLListar);

if( odbc_num_rows($RSListar) > 0 ){

	echo "
	<table  class='table table-hover table-sm' >
	<thead class='table-primary'>
		<tr>
			<th style='text-align: center;'>Nº $boton_filtrar</th>			
			<th style='text-align: left;'>AREA DE TRABAJO $boton_filtrar</th>
			<th style='text-align: left;'>CARGOS $boton_filtrar</th>
			<th style='text-align: center;'>ACCION</th>
		</tr>
	</thead>";

	while ($fila =  odbc_fetch_array($RSListar)) {
		
		$it= $it+1;
		$axid_area = $fila['ID_AREA'];		
		$axarea_trabajo = $fila['AREA_TRABAJO'];
		$axcargo = $fila['AREA_ENCARGADO'];			
		
		echo "
 		<tr>
 			<td style='text-align: center;' >$axid_area</td>
 			<td style='text-align: left;' >$axarea_trabajo</td>
 			<td style='text-align: left;' >$axcargo</td> 			 		
 		</tr>";
	}

	echo"</table>";
}else{

	echo "
	<table  class='table table-hover table-sm' >
	<thead class='table-primary'>
		<tr>
			<th style='text-align: center;'>Nº</th>			
			<th style='text-align: left;'>AREA DE TRABAJO</th>
			<th style='text-align: left;'>CARGOS</th>
			<th style='text-align: center;'>ACCION</th>
		</tr>
	</thead>";

}


?>
