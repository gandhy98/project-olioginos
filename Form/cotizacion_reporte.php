
<?php 
session_start();
if(!$_SESSION['userId']) {

	//header('location: login1.php');	
	header('location: ../index.html');	
} 

require('../Imprimir/fpdf.php');
require('../phpqrcode/qrlib.php');


$axusuario =  $_SESSION['userId'];
$axidlocal=$_GET['local'];
$axcodmovBV=$_GET['id'];


define('DB_HOST', 'www.necesitounprograma.com');//DB_HOST:  generalmente suele ser "127.0.0.1"
define('DB_USER', 'sa');//Usuario de tu base de datos
define('DB_PASS', 'auditek*1');//Contrase�a del usuario de la base de datos
define('DB_NAME', 'Oleaginos');//Nombre de la base de datos

/*
define('DB_HOST', '192.168.1.17');//DB_HOST:  generalmente suele ser "127.0.0.1"
define('DB_USER', 'sa');//Usuario de tu base de datos
define('DB_PASS', '123456');//Contraseña del usuario de la base de datos
define('DB_NAME', 'Ferreteria2021');//Nombre de la base de datos
*/

$connection_string = "DRIVER={SQL Server};SERVER=".DB_HOST.";DATABASE=".DB_NAME; 
$con = odbc_connect($connection_string,DB_USER,DB_PASS);


class PDF extends FPDF {

function Header(){

	global $con;
	global $axidlocal;
	global $axfechapedido;
	global $axlotecarga;
	global $axcodmovBV;
	global $axobser;

	$SQLCabecera = "SELECT * from COTIZACION_REPORTE_CZ WHERE COD_MOV_PRF='$axcodmovBV' AND ID_LOCAL ='$axidlocal'";
	//echo($SQLCabecera);
	$RSCabecera=odbc_exec($con,$SQLCabecera);
	$filaRes=odbc_fetch_array($RSCabecera);


	$axfechapedido = date("d-m-Y",strtotime($filaRes["FECHA_COTIZACION"]));	
	$diasAsumar = 7; // Número de días que deseas sumar
	
	$axfecha_vence = date("d-m-Y",strtotime($filaRes["FECHA_COTIZACION"]));
	$razonsocial  =$filaRes['RAZON_SOCIAL'];
	$ruc  =$filaRes['RUC_BENEF'];
	$direccion=$filaRes['DIRECCION_FISCAL'];
	$axmoneda=$filaRes['MONEDA'];
	$axforma_pago=$filaRes['FORMA_PAGO'];
	$axid_user=$filaRes['ID_USUARIO'];
	$ano_cotizacion=$filaRes['ANO_COTIZACION'];
	$axlogo= "../img/logo_pedidos0.png";//get_row('LOCALES','LOGO_EMPRESA','ID_LOCAL',$axidlocal);

	
	$axid_beneficiario = $filaRes['ID_BENEFICIARIO'];
	$axnom_cliente = get_row('BENEFICIARIOS','RAZON_SOCIAL','ID_BENEFICIARIO',$axid_beneficiario);	
	$axruc_cliente = get_row('BENEFICIARIOS','RUC_BENEF','ID_BENEFICIARIO',$axid_beneficiario);	
	$axdirec_cliente = get_row('BENEFICIARIOS','DIRECCION_FISCAL','ID_BENEFICIARIO',$axid_beneficiario);	
	$axtelef_cliente = get_row('BENEFICIARIOS','TELEFONO','ID_BENEFICIARIO',$axid_beneficiario);	
	$axcorreo_cliente = get_row('BENEFICIARIOS','EMAIL_PROVEEDOR','ID_BENEFICIARIO',$axid_beneficiario);	
	$axautor = get_row('USUARIOS','USUARIO','ID_USUARIO',$axid_user);	
	

	$axtipo_doc = $filaRes['ID_DT'];
	$axserie ='CT-'.trim($filaRes['NUM_COTIZACION']).'-'.$ano_cotizacion;
		
		
		
		$this->Image($axlogo,11,22,95,'L');		
		$this->SetFont('Arial','B',13);	   
	   $this->Ln(10);
		$this->SetX(115);
		$this->Cell(90,8,'R.U.C. '.$ruc,'RTL',1,'C');
		$this->SetX(115);
		$this->Cell(90,8,'COTIZACION',1,1,'C');
		$this->SetX(115);
		$this->Cell(90,8,$axserie,'RBL',1,'C');
		$this->Ln(5);

		$this->Ln(5);
		$this->SetFont('Arial','B',8);	
		$this->Cell(130,5,'CLIENTE',0,1,'L');   
		$this->Cell(35,5,utf8_decode('Fecha de Emisión:'),'LT',0,'L');
		$this->SetFont('Arial','',8);	   
		$this->Cell(161,5,$axfechapedido,'TR',1,'L');

		$this->SetFont('Arial','B',8);	   
		$this->Cell(35,5,utf8_decode('R.Social:'),'L',0,'L');
		$this->SetFont('Arial','',8);	   
		$this->Cell(131,5,$axnom_cliente,0,'L');
		$this->SetFont('Arial','B',8);	   
		$this->Cell(10,5,utf8_decode('RUC:'),0,'R');
		$this->SetFont('Arial','',8);	   
		$this->Cell(20,5,$axruc_cliente,'R',1,'C');

		$this->SetFont('Arial','B',8);	   
		$this->Cell(35,5,utf8_decode('Dirección:'),'L',0,'L');
		$this->SetFont('Arial','',8);	   
		$this->Cell(161,5,$axdirec_cliente,'R',1,'L');

		$this->SetFont('Arial','B',8);	   
		$this->Cell(35,5,utf8_decode('Telefonos:'),'BL',0,'L');
		$this->SetFont('Arial','',8);	   
		$this->Cell(50,5,$axtelef_cliente,'B',0,'L');

		$this->SetFont('Arial','B',8);	   
		$this->Cell(35,5,utf8_decode('Correo:'),'B',0,'L');
		$this->SetFont('Arial','',8);	   
		$this->Cell(76,5,$axcorreo_cliente,'BR',1,'L');
		$this->Ln(2);
		$this->SetFont('Arial','B',8);			
		$this->Cell(15,5,utf8_decode('Moneda:'),'LTB',0,'L');
		$this->SetFont('Arial','',8);	   
		$this->Cell(15,5,$axmoneda,'TB',0,'L');

		$this->SetFont('Arial','B',8);			
		$this->Cell(35,5,utf8_decode('Condición de pago:'),'LTB',0,'R');
		$this->SetFont('Arial','',8);	   
		$this->Cell(20,5,$axforma_pago,'TRB',0,'C');

		$this->SetFont('Arial','B',8);			
		$this->Cell(45,5,utf8_decode('Presupuesto valido hasta:'),'LTB',0,'R');
		$this->SetFont('Arial','',8);	   
		$this->Cell(25,5,$axfecha_vence,'TB',0,'C');

		$this->SetFont('Arial','B',8);			
		$this->Cell(15,5,utf8_decode('Autor:'),'LTB',0,'R');
		$this->SetFont('Arial','',8);	   
		$this->Cell(26,5,$axautor,'TRB',1,'C');

		$this->Ln(2);
		$this->SetFont('Arial','B',10);
		$this->SetFillColor(170, 209, 254); // establece el color del fondo de la celda (en este caso es AZUL
		//$this->SetTextColor(10, 50, 252 );  // Establece el color del texto (en este caso es blanco)
		$this->SetX(10);
		$this->Cell(10,6,'IT',1,0,'C',True);
		$this->Cell(20,6,'CANTIDAD',1,0,'C',True);
		$this->Cell(25,6,'UND',1,0,'C',True);
		$this->Cell(141,6,'DESCRIPCION',1,1,'C',True);		
		
		

	
}

function Footer(){ 

   $this->SetY(-25);
   $this->SetFont('Arial','B',7);		
   $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,1,'C');
	/*
	$this->SetFillColor(252, 201, 201); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(150,8,'', 1, 0, 'C', True); // en orden lo que informan estos parametros es:
	$this->SetFillColor(25, 60, 236 ); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(46,8,'', 1, 0, 'C', True); // en orden lo que informan estos parametros es:
		*/


   
}

function Detalle_CZ(){

global $con;
global $axidlocal;
global $axfechapedido;
global $axlotecarga,$axcontar;
global $axcodmovBV;
global $it;

	//$SQLDocumentoCZ ="SELECT * from F_TEXTO_CZ  WHERE codigo='$axcodmovBV' AND ID_LOCAL ='$axidlocal' ORDER BY TXT_CORRELATIVO ASC ";
	$SQLDocumentoCZ ="SELECT * from LISTA_COTIZACION_DT  WHERE COD_MOV_PRF='$axcodmovBV'";
	$RSDocumentoCZ=odbc_exec($con,$SQLDocumentoCZ);
	//echo $SQLDocumentoCZ;

//$this->Ln(2);

	while ($rowCZ=odbc_fetch_array($RSDocumentoCZ)){

		$it = $it+1;
		$axcod = $rowCZ['COD_PRODUCTO'];
		if($axcod==""){
			$axnom_comercial= $rowCZ['NOM_PRODUCTO'];	
		}else{
			$axnom_comercial= $axcod.' | '.$rowCZ['NOM_PRODUCTO'];
		}
		$axid_cotizacion_cz = $rowCZ['ID_COTIZACION_CZ'];	

		$axcantidad=number_format($rowCZ["CANT_SALIDA"],2,".",",");
		$axprecio=number_format($rowCZ["PRECIO_V"],2,".",",");
		$axprecio=number_format($rowCZ["PRECIO_V"],2,".",",");
		$axtotal=number_format($rowCZ["TOTAL_SALIDA"],2,".",",");

		$axforma_pago = '- Forma de pago: '.  get_row('COTIZACION_CZ','FORMA_PAGO','ID_COTIZACION_CZ',$axid_cotizacion_cz);
		$axtiempo_entrega = utf8_decode('- Tiempo de entrega: 04 días');

		$this->SetFont('Arial','',9);
		$this->SetX(10);
		$this->Cell(10,6,$it,1,0,'C');
		$this->Cell(20,6,$axcantidad,1,0,'C');		
		$this->Cell(25,6,utf8_decode($rowCZ['PRESENTACION']),1,0,'C');		
		$this->Cell(141,6,utf8_decode($axnom_comercial),1,1,'L');				
			

		/*
		$this->Cell(15,6,$axprecio,1,0,'R');		
		$this->Cell(25,6,$axtotal,1,1,'R');				
		*/
		
	}	

		$this->Ln(20);
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(148, 148, 148); // establece el color del fondo de la celda (en este caso es AZUL		
		$this->Cell(50,6,'ELABORADO POR','T',0,'C');				

	/*	

	$SQLDocumentoCZ_Total ="SELECT SUM(TOTAL_SALIDA) AS TT from LISTA_COTIZACION_DT  WHERE COD_MOV_PRF='$axcodmovBV'";
	$RSDocumentoCZ_Total=odbc_exec($con,$SQLDocumentoCZ_Total);
	$fila_t= odbc_fetch_array($RSDocumentoCZ_Total);
	$axtotal_T=number_format($fila_t["TT"],2,".",",");

	$axempresa = get_row('COTIZACION_REPORTE_CZ','RAZON_SOCIAL','COD_MOV_PRF',$axcodmovBV);

		$this->SetFillColor(170, 209, 254); // establece el color del fondo de la celda (en este caso es AZUL
		$this->SetFont('Arial','B',10);
		$this->Cell(171,8,'TOTAL C/IGV',1,0,'R');
		$this->Cell(25,8,'S/ '.$axtotal_T,1,1,'R',True);

	$actipocotizacion = get_row('COTIZACION_REPORTE_CZ','TIPO_COTIZACION','COD_MOV_PRF',$axcodmovBV);

		if($actipocotizacion=='PROVEEDOR'){
			$this->SetFont('Arial','B',10);
			$this->SetTextColor(148, 148, 148); // establece el color del fondo de la celda (en este caso es AZUL
			$this->Cell(100,6,$axempresa,0,1,'L');
			$this->Cell(80,5,'CTA CORRIENTE BCP - 310-9293638-0-41',0,0,'L');				
			$this->Cell(80,5,'CCI - 002-310-009293638041-16',0,1,'L');	
			$this->Cell(80,5,'CTA CORRIENTE SCOTIABANK - 000-1474074',0,0,'L');
			$this->Cell(80,5,'CCI - 009-360-000001474074-90',0,1,'L');
		
	}
*/

}



}//class PDF extends FPDF {

// Creación del objeto de la clase heredada
//$pdf = new PDF($orientation='P',$unit='mm', array(80,220));

$pdf = new PDF('P','mm','A4');

$pdf->skipHeader = false;
$pdf->skipFooter = false;
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Detalle_CZ();
//$pdf->CodigoQR();

$pdf->Output();
//$pdf->Output('F',$axruta.$nombre_archivo.'.pdf'); 

 
function get_row($table,$col, $id, $equal){
	global $con;
	$querysql="select top 1 $col from $table where $id='$equal' order by $col desc";
	//echo $querysql;
	$query=odbc_exec($con,$querysql);
	$rw=odbc_fetch_array($query);
	$value=$rw[$col];
	return $value;
}

// ceros a la izquierda
function number_pad($number,$n) {
return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}

?>

