<?php

require_once '../core2.php';
date_default_timezone_set("America/Lima");
$fecha_actual = date('Y-m-d');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $axidempresa=$_POST['txtid_empresa_file_doc'];  
    $axid_py =$_POST['txtid_proyecto_doc'];
    $id_detalle =$_POST['txtid_detalle_doc'];    
    
    $uploadDir = get_row('MK_PROYECTOS','NOM_CARPETA','ID_PROYECTO',$axid_py);
    $axnom_doc = get_row('MK_PROYECTOS_DT','NOM_CARACTERISTICAS','ID_DETALLE',$id_detalle);       

    $extencion_archivo = pathinfo($_FILES['fileInput_doc']['name'], PATHINFO_EXTENSION);  
    $tipo_file = $_FILES['fileInput_doc']['type'];
    $tamano_file = $_FILES['fileInput_doc']['size'];
    // Puedes convertir el tamaño a kilobytes o megabytes para hacerlo más legible
    //$tamano_file_kb = round($tamano_file / 1024, 2); // Tamaño en kilobytes
    $tamano_file_mb = round($tamano_file / (1024 * 1024), 2); // Tamaño en megabytes

    $axnom_nuevo_archivo = $axnom_doc.'.'.$extencion_archivo;          
    
    $uploadFile = $uploadDir . basename($_FILES['fileInput_doc']['name']);

     if (move_uploaded_file($_FILES['fileInput_doc']['tmp_name'], $uploadFile)) {
        // Renombrar el archivo
        $nuevoPath = $uploadDir . $axnom_nuevo_archivo;
        rename($uploadFile, $nuevoPath);        

        //echo 'Archivo subido con éxito y renombrado a: ' . $axnom_nuevo_archivo;

        $sqlactualizar = "UPDATE MK_PROYECTOS_DT SET ARCHIVO_SUSTENTO='$nuevoPath',TIPO_FILE='$tipo_file',TAMANO_FILE='$tamano_file_mb',FECHA_CARGA='$fecha_actual',ARCHIVO_NOMBRE='$axnom_nuevo_archivo' WHERE ID_PROYECTO='$axid_py' and ID_DETALLE='$id_detalle'";
        $rsactualizar = odbc_exec($con,$sqlactualizar);


    } else {
        echo 'Error al subir el archivo.';
    }

} else {
    echo 'Acceso no permitido.';
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
