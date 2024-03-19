<?php

require_once '../core2.php';
date_default_timezone_set("America/Lima");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $axid_py =$_POST['txtid_proyecto_enviar'];
    $axtipo =$_POST['txttipo_archivo'];    
    $axidempresa=$_POST['txtid_empresa_file'];    
    

    $extencion_archivo = pathinfo($_FILES['fileInput']['name'], PATHINFO_EXTENSION);    
    $axnom_py = get_row('MK_PROYECTOS','NOMBRE_CORTO_PY','ID_PROYECTO',$axid_py);    

    if($axtipo=='logo'){
        $uploadDir = '../Archivos/Logos/';
        $axnom_nuevo_archivo = 'logo_'.$axnom_py.'_'.date('dmYHis') . '.' . $extencion_archivo;
    }elseif($axtipo=='plano'){
        $uploadDir = '../Archivos/Planos/';
        $axnom_nuevo_archivo = 'Plano_'.$axnom_py.'_'.date('dmYHis') . '.' . $extencion_archivo;    
    }elseif($axtipo=='EXCEL'){
        $uploadDir = '../Archivos/Excel/';
        $axnom_nuevo_archivo = 'Excel_'.date('dmYHis').'.'.$extencion_archivo;   
    }elseif($axtipo=='productos'){
        $uploadDir = '../Archivos/Excel/';
        $axnom_nuevo_archivo = 'Productos_'.date('dmYHis').'.'.$extencion_archivo;    
    }


    
    $uploadFile = $uploadDir . basename($_FILES['fileInput']['name']);

     if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $uploadFile)) {
        // Renombrar el archivo
        $nuevoPath = $uploadDir . $axnom_nuevo_archivo;
        rename($uploadFile, $nuevoPath);        

        //echo 'Archivo subido con éxito y renombrado a: ' . $axnom_nuevo_archivo;

        if($axtipo=='logo'){

        $sqlactualizar = "UPDATE MK_PROYECTOS SET IMG_LOGO='$nuevoPath' WHERE ID_PROYECTO='$axid_py'";
        $rsactualizar = odbc_exec($con,$sqlactualizar);
        
        }elseif($axtipo=='plano'){

        $sqlactualizar = "UPDATE MK_PROYECTOS SET IMG_PLANO='$nuevoPath' WHERE ID_PROYECTO='$axid_py'";
        $rsactualizar = odbc_exec($con,$sqlactualizar);

        }elseif($axtipo=='EXCEL' || $axtipo=='productos'){

        $sqlactualizar_file = "UPDATE EMPRESA SET AUX_FILES='$nuevoPath' WHERE ID_EMPRESA='$axidempresa'";
        $rsactualizar_file = odbc_exec($con,$sqlactualizar_file);
        
        }

        



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
