
<?php 
session_start();
if(!$_SESSION['userId']) {

	//header('location: login1.php');	
	header('location: ../index.html');	
} 

require('../Imprimir/fpdf.php');
require('../phpqrcode/qrlib.php');


$axusuario =  $_SESSION['userId'];

$axid_py=$_GET['idpy'];

define('DB_HOST', 'www.necesitounprograma.com');//DB_HOST:  generalmente suele ser "127.0.0.1"
define('DB_USER', 'sa');//Usuario de tu base de datos
define('DB_PASS', 'auditek*1');//Contrase�a del usuario de la base de datos
define('DB_NAME', 'PlusInmobiliaria');//Nombre de la base de datos

$connection_string = "DRIVER={SQL Server};SERVER=".DB_HOST.";DATABASE=".DB_NAME; 
$con = odbc_connect($connection_string,DB_USER,DB_PASS);


class PDF extends FPDF {

function Header(){

	global $con;
	global $axid_py;
	global $it;

	$axlogo_py = get_row('MK_PROYECTOS','IMG_LOGO','ID_PROYECTO',$axid_py);
	$axplano_py = get_row('MK_PROYECTOS','IMG_PLANO','ID_PROYECTO',$axid_py);
	$axubicacion_py = get_row('MK_PROYECTOS','UBICACION_PY','ID_PROYECTO',$axid_py);
	$axnombre_corto_py = get_row('MK_PROYECTOS','NOMBRE_CORTO_PY','ID_PROYECTO',$axid_py);


	//SELECT NOMBRE_CORTO_PY,IMG_PLANO FROM MK_PROYECTOS 

	
		$this->Image('../img/logo.jpeg',10,2,30,'C');
		$this->Image($axlogo_py,85,10,70,'C');
		//$this->Image($axplano_py,10,50,190,'C');
		
		$sqlproductos = "SELECT * FROM MK_PROYECTOS_PRODUCTOS WHERE ID_PROYECTO='$axid_py' AND ESTADO_PRODUCTO <> 'VENDIDO' ORDER BY UBIC_MZ ASC";
		$rsproductos = odbc_exec($con,$sqlproductos);

		if(odbc_num_rows($rsproductos) > 0){

			 $this->SetFont('Arial','B',7);
	   	 $this->SetY(40);
	   	 $this->Cell(8,4,'No',1,0,'C');
	   	 $this->Cell(10,4,'MZ',1,0,'C');
	   	 $this->Cell(10,4,'LTE',1,0,'C');
	   	 $this->Cell(12,4,'FRT',1,0,'C');
	   	 $this->Cell(12,4,'FDO',1,0,'C');
	   	 $this->Cell(12,4,'DCHA',1,0,'C');
	   	 $this->Cell(12,4,'IZDA',1,0,'C');
	   	 $this->Cell(15,4,'PERIM.',1,0,'C');
	   	 $this->Cell(15,4,'M2',1,0,'C');
	   	 $this->Cell(15,4,'PRECIO',1,1,'C');

	   	 while ($fila = odbc_fetch_array($rsproductos)) {
	   	 		
	   	 		$it = $it+1;
					$id_producto = $fila['ID_PRODUCTO'];
					$id_proyecto = $fila['ID_PROYECTO'];
					$cod_producto = $fila['COD_PRODUCTO'];
					$tipo_producto = $fila['TIPO_PRODUCTO'];
					$ubic_mz = $fila['UBIC_MZ'];
					$ubic_lote = $fila['UBIC_LOTE'];
					$med_frente = $fila['MED_FRENTE'];
					$med_fondo = $fila['MED_FONDO'];
					$med_derecha = $fila['MED_DERECHA'];
					$med_izquierda = $fila['MED_IZQUIERDA'];
					$med_perimetro = $fila['MED_PERIMETRO'];
					$area_m2 = $fila['AREA_M2'];
					$ubic_plano = $fila['UBIC_PLANO'];
					$precio_lista = number_format($fila['PRECIO_LISTA'],2,".",",");
					$estado_producto = $fila['ESTADO_PRODUCTO'];
					
					 $this->SetFont('Arial','',6);	
					 $this->Cell(8,4,$it,1,0,'C');
			   	 $this->Cell(10,4,$ubic_mz,1,0,'C');
			   	 $this->Cell(10,4,$ubic_lote,1,0,'C');
			   	 $this->Cell(12,4,$med_frente,1,0,'C');
			   	 $this->Cell(12,4,$med_fondo,1,0,'C');
			   	 $this->Cell(12,4,$med_derecha,1,0,'C');
			   	 $this->Cell(12,4,$med_izquierda,1,0,'C');
			   	 $this->Cell(15,4,$med_perimetro,1,0,'C');
			   	 $this->Cell(15,4,$area_m2,1,0,'C');
			   	 $this->Cell(15,4,$precio_lista,1,1,'C');

	   	 }


		}else{

		}

	   
	  


	   //$this->Cell(70,6,$axubicacion_py,0,1,'C');
		
		/*
		$this->SetFont('Arial','B',9);
		$this->SetX(5);
		
		$this->SetFont('Arial','',9);
		$this->SetX(5);
		$this->Cell(70,4,$direccion,0,1,'C');
		$this->SetX(5);
		//$this->Cell(70,4,"LIMA - LIMA - SAN MARTIN DE PORRES",0,1,'C');
		$this->SetX(5);
		$this->SetFont('Arial','B',10);
		$this->Cell(70,5,'RUC: '.$ruc,0,1,'C');
		$this->Ln(5);
		*/
	
}

function Footer()
{
 
 /*
    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    $this->SetDrawColor(188,188,188);
	$this->Line(10,195,290,195);
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
*/
   
}





}//class PDF extends FPDF {


// Creación del objeto de la clase heredada

$pdf = new PDF('P','mm','A4');

$pdf->skipHeader = false;
$pdf->skipFooter = false;
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
//$pdf->Detalle_CZ();
//$pdf->CodigoQR();

$pdf->Output();
//$pdf->Output('F',$axruta.$nombre_archivo.'.pdf'); 

 
function get_row($table,$col, $id, $equal){
	global $con;
	$querysql="select top 1 $col from $table where $id='$equal' order by $col desc";
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

