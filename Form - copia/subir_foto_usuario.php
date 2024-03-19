<?php

require_once '../core2.php';
date_default_timezone_set("America/Lima");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $axid_usuario =$_POST['txtid_usuario_enviar'];
    $axtipo =$_POST['txttipo_archivo'];    

    $extencion_archivo = pathinfo($_FILES['fileInput']['name'], PATHINFO_EXTENSION);    
    $axnom_usuario = get_row('USUARIO','USUARIO','ID_USUARIO',$axid_usuario);    

    $uploadDir = '../Archivos/Foto_usuarios/';
    $axnom_nuevo_archivo = 'Foto_'.$axnom_usuario.'_'.date('dmYHis') . '.' . $extencion_archivo;    
   

    $uploadFile = $uploadDir . basename($_FILES['fileInput']['name']);

     if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $uploadFile)) {
        // Renombrar el archivo
        $nuevoPath = $uploadDir . $axnom_nuevo_archivo;
        rename($uploadFile, $nuevoPath);        

        $sqlactualizar = "UPDATE USUARIO SET IMAGEN_FOTO='$nuevoPath' WHERE ID_USUARIO='$axid_usuario'";
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
