<?php  

//require('../Imprimir/pdf_js.php');
require('../phpqrcode/qrlib.php');
require_once '../core2.php';


$param=$_POST['param'];


switch ($param) {


case '0':
    
$axid_ejecutivo = $_POST['txtid_ejecutivo'];    
$axid_empresa = $_POST['txtid_empresa']; 
$axbuscar_prospectos = $_POST['txtbuscar_prospectos'];
$axfecha_del = $_POST['txtfecha_del'];
$axfecha_al = $_POST['txtfecha_al'];


if ($axbuscar == '') {
    $SQLListar = "SELECT * FROM MK_PROSPECTOS_ASIGNADOS_EJECUTIVOS WHERE ID_EMPRESA ='$axid_empresa' AND ID_EJECUTIVO='$axid_ejecutivo' ORDER BY FECHA_ASIGNACION DESC";
} else {
    $SQLListar = "SELECT * FROM MK_PROSPECTOS_ASIGNADOS_EJECUTIVOS WHERE ID_EMPRESA ='$axid_empresa' AND ID_EJECUTIVO='$axid_ejecutivo' AND CLIENTE+' '+CELULAR LIKE '%" . $axbuscar . "%' ORDER BY NOMBRE ASC";
}

//echo $SQLListar;
$RSListar = odbc_exec($con, $SQLListar);

if (odbc_num_rows($RSListar) > 0) {

    echo "<div style='text-align: left;'>
        <div class='btn-group btn-group-sm' role='group' aria-label='Small button group' >
        <button type='button' id='btn_rango_fechas_prospectos' data-tipoorden='RANGO' class='btn btn-outline-primary'><i class='bi bi-funnel-fill'></i> Rango Fecha</button>        
        </div>
    </div>
    <p><hr></p>
    <table class='table table-hover table-sm'>
    <thead class='table-primary'>           
        <tr>
            <th style='text-align: center;'>Nº</th>         
            <th style='text-align: left;'>FECHA</th>                     
            <th style='text-align: left;'>PROSPECTOS</th>            
        </tr>
    </thead>

    ";

    while ($fila = odbc_fetch_array($RSListar)) {

        $it = $it+1;
        $axid_prospecto_cz = $fila['ID_PROSPECTO_CZ'];
        $axid_prospecto_dt = $fila['ID_PROSPECTO_DT'];
        $axestado_prospecto = $fila['ESTADO_PROSPECTO'];
        $axid_empresa = $fila['ID_EMPRESA'];
        $axid_ejecutivo = $fila['ID_EJECUTIVO'];
        $axuser_ejecutivo = $fila['USER_EJECUTIVO'];
        $axfecha_asignacion = date('d-m-Y',strtotime($fila['FECHA_ASIGNACION']));
        $axhora_asignacion = $fila['HORA_ASIGNACION'];
        $axcelular = $fila['CELULAR'];
        $axcliente = $fila['CLIENTE'];
        $axmedio = $fila['MEDIO'];
        $axcanal = $fila['CANAL'];
        $axid_proyecto = $fila['ID_PROYECTO'];
        $axproyecto = $fila['PROYECTO'];
        $axcomentario_pst = $fila['COMENTARIO_PST'];
        $nom_pst = $fila['CELULAR'].' '.$fila['CLIENTE'];

        $axfechas = '<b>Fc. '.$axfecha_asignacion.'<br>Hr. '.$axhora_asignacion.'</b>';   
      
        $SQLContar =  "SELECT COUNT(ID_PROSPECTO_SG) AS TT FROM MK_PROSPECTOS_SEGUIMIENTO WHERE ID_PROSPECTO_DT='$axid_prospecto_dt'";
        $RSContar = odbc_exec($con,$SQLContar);
        $fila_c = odbc_fetch_array($RSContar);
        $axnum = $fila_c['TT'];

        if($axnum==0){
            $axnum_revisiones = '<span class="badge rounded-pill text-bg-danger">'.$axnum.'</span>';
            $axdato_mostrar = '<b style="font-size:14px;" class="text-danger">'.$axcelular.' '.$axcliente.'</b>';
        }else{
            $axnum_revisiones = '<span class="badge rounded-pill text-bg-primary">'.$axnum.'</span>';
            $axdato_mostrar = '<b style="font-size:14px;" class="text-primary">'.$axcelular.' '.$axcliente.' '.$axnum_revisiones.'</b>';
        }

        


         echo " <tr>
                <td style='text-align:center;'>$it</td>
                <td style='text-align:left;'>$axfechas</td>                
                <td style='text-align:left;'><a href='#' style='text-decoration:none;' data-comentario='$axcomentario_pst' data-py='$axproyecto' data-idpy='$axid_proyecto' data-iddt='$axid_prospecto_dt' data-idcz='$axid_prospecto_cz' data-nom_pst='$nom_pst' data-cliente='$axcliente' id='btn_seguimiento'>$axdato_mostrar </a>  <br><b>$axmedio | $axcanal | $axproyecto</b></td>
                </tr>";

   }     

    echo "</table>";
} else {
    echo "";
}


break;

case '1':
    
   $axid_prospecto_cz  = $_POST['txtid_prospecto_cz'];
   $axid_doc  = $_POST['txtid_doc'];
   $axnum_doc_cliente_pst  = $_POST['txtnum_doc_cliente_pst'];
   $axtipo_cliente_pst  = $_POST['txttipo_cliente_pst'];
   $axcod_cliente_pst  = $_POST['txtcod_cliente_pst'];
   $axnombres_cliente_pst  = $_POST['txtnombres_cliente_pst'];
   $axpaterno_cliente_pst  = $_POST['txtpaterno_cliente_pst'];
   $axmaterno_cliente_pst  = $_POST['txtmaterno_cliente_pst'];
   $axcliente_pst  = $_POST['txtcliente_pst'];
   $axmodulo  = $_POST['txtmodulo'];
   $axid_usuario  = $_POST['txtid_usuario'];
   $axparametros  = $_POST['txtparametros'];


   $sqlgrabar = "UPDATE MK_PROSPECTOS_CZ SET ID_DOC='$axid_doc',NUM_DOC_CLIENTE_PST='$axnum_doc_cliente_pst',TIPO_CLIENTE_PST='$axtipo_cliente_pst',COD_CLIENTE_PST='$axcod_cliente_pst',NOMBRES_CLIENTE_PST='$axnombres_cliente_pst',PATERNO_CLIENTE_PST='$axpaterno_cliente_pst',MATERNO_CLIENTE_PST='$axmaterno_cliente_pst',CLIENTE_PST='$axcliente_pst' WHERE ID_PROSPECTO_CZ='$axid_prospecto_cz'";

      $rsgrabar = odbc_exec($con,$sqlgrabar);
  // echo $sqlgrabar;

   if($rsgrabar){

      $respuesta =0;
      echo $respuesta;

   }else{

      $respuesta =1;
      echo $respuesta;

   }

break;

case '2':
    
$axid_proyecto = $_POST['txtid_proyecto']; 
$axproyecto = get_row('MK_PROYECTOS','NOMBRE_CORTO_PY','ID_PROYECTO',$axid_proyecto);
    
$SQLCuentas = "SELECT * FROM MK_PROYECTOS_PRODUCTOS WHERE ID_PROYECTO='$axid_proyecto' ORDER BY UBIC_MZ ASC";    
$RSTipodocumentos=odbc_exec($con,$SQLCuentas);


//echo $SQLCuentas;

    if(odbc_num_rows($RSTipodocumentos) > 0){       
        while($fila=odbc_fetch_array($RSTipodocumentos)){
            echo '<option value='.$fila['ID_PRODUCTO'].'>'.$fila['UBIC_MZ'].'-'.$fila['UBIC_LOTE'].'</option>';
        }       
    } else {

        echo "";    
    
    }

break;

case '3':

$axid_proyecto = $_POST["txtid_proyecto"];  
$axbuscar_producto = $_POST["txtbuscar_producto"];  

if($axbuscar_producto ==''){
$SQLListar = "SELECT * FROM  MK_PROYECTOS_PRODUCTOS WHERE ID_PROYECTO='$axid_proyecto' ORDER BY ID_PRODUCTO ASC";
}else{
$SQLListar = "SELECT * FROM  MK_PROYECTOS_PRODUCTOS WHERE ID_PROYECTO='$axid_proyecto' AND UBIC_MZ+''+UBIC_LOTE LIKE '%".$axbuscar_producto."%' ORDER BY ID_PRODUCTO ASC";
}


$RSListar = odbc_exec($con,$SQLListar);

if(odbc_num_rows($RSListar) > 0 ){

    echo "<div class='div3'>
    <table class='table table-hover table-sm'>
    <thead class='table-primary'>           
        <tr>
            <th style='text-align: center;'>Nº</th> 
            <th style='text-align: center;'>ESTADO</th>     
            <th style='text-align: center;'>NOMBRE</th>
            <th style='text-align: center;'>UBICACION</th>
            <th style='text-align: center;'>FRENTE</th>
            <th style='text-align: center;'>FONDO</th>
            <th style='text-align: center;'>DERECHA</th>
            <th style='text-align: center;'>IZQUIERDA</th>
            <th style='text-align: center;'>PERIMETRO</th>
            <th style='text-align: center;'>AREA M2</th>
            <th style='text-align: center;'>PRECIO LISTA</th>
            <th style='text-align: center;'>ASIGNAR</th>
        </tr>
    </thead>";

    while ($fila = odbc_fetch_array($RSListar)) {

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
        $axnom_py = get_row('MK_PROYECTOS','NOMBRE_CORTO_PY','ID_PROYECTO',$id_proyecto);
        $producto = $ubic_mz.'-'.$ubic_lote;
        
        echo "<tr>
            <td style='text-align: center;'>$id_producto</td>   
            <td style='text-align: center;'>$estado_producto</td>   
            <td style='text-align: center;'>$ubic_mz - $ubic_lote</td>   
            <td style='text-align: center;'>$ubic_plano</td> 
            <td style='text-align: center;'>$med_frente</td>    
            <td style='text-align: center;'>$med_fondo</td> 
            <td style='text-align: center;'>$med_derecha</td>   
            <td style='text-align: center;'>$med_izquierda</td> 
            <td style='text-align: center;'>$med_perimetro</td>
            <td style='text-align: center;'>$area_m2</td>
            <td style='text-align: center;'>$precio_lista</td>
            <td style='text-align: center;'>";

            if($estado_producto !=='VENDIDO'){

                echo "<a href='#' id='btn_asignar_producto_py' data-bs-dismiss='modal' title='Click para asignar al prospecto' data-idpy='$id_proyecto' data-idprod='$id_producto' data-nompy='$axnom_py' data-nom_prod='$producto'><b><i class='bi bi-plus-circle-fill' style='font-size:15px;'></i> </a></b>";

            }else{

                echo "<a href='#' title='El producto esta VENDIDO'><b><i class='bi bi-lock-fill' style='font-size:15px; color:red;'></i> </a></b>";
            }

                


            echo "</td>
        <tr>";
    }

    echo "</table>
    </div>"; 

}else{

    echo '';
}

break;

case '4':

   $axid_prospecto_dt = $_POST["txtid_prospecto_dt"];  
   $axnom_prospecto = $_POST["txtnom_prospecto"];  

   $sqlbuscar_seguimientos = "SELECT * FROM MK_PROSPECTOS_SEGUIMIENTO WHERE ID_PROSPECTO_DT='$axid_prospecto_dt' order by ID_PROSPECTO_SG DESC";
   $rsbuscar_seguimientos = odbc_exec($con,$sqlbuscar_seguimientos);

    if(odbc_num_rows($rsbuscar_seguimientos) > 0){

     echo "<div class='list-group text-left' >
            <a href='#' class='list-group-item list-group-item-action active' aria-current='true'>
            $axnom_prospecto
            </a>";
    while ($fila = odbc_fetch_array($rsbuscar_seguimientos)) {

        $axId_prospecto_sg = $fila['ID_PROSPECTO_SG'];
        $axId_prospecto_dt = $fila['ID_PROSPECTO_DT'];
        $axFecha_seguimiento = date('d-m-Y',strtotime($fila['FECHA_SEGUIMIENTO']));
        $axHora_seguimiento = $fila['HORA_SEGUIMIENTO'];
        $axDetalle_comentario = $fila['DETALLE_COMENTARIO'];
        $axEstado_seguimiento = $fila['ESTADO_SEGUIMIENTO'];
        $axFecha_seguimiento_proximo = date('d-m-Y',strtotime($fila['FECHA_SEGUIMIENTO_PROXIMO']));
        $axHora_seguimiento_proximo = $fila['HORA_SEGUIMIENTO_PROXIMO'];
        $axVisita_oficina = $fila['VISITA_OFICINA'];
        $axVistia_proyecto = $fila['VISTIA_PROYECTO'];
        $axId_producto = $fila['ID_PRODUCTO'];

        // Colores base
        if ($axEstado_seguimiento == 'DEJO DE CONTESTAR') {
            $axclass_color = 'list-group-item list-group-item-action list-group-item-danger';
        } elseif ($axEstado_seguimiento == 'FUTURA VENTA') {
            $axclass_color = 'list-group-item list-group-item-action list-group-item-warning';
        } elseif ($axEstado_seguimiento == 'NO INTERESADO') {
            $axclass_color = 'list-group-item list-group-item-action list-group-item-light';
        } elseif ($axEstado_seguimiento == 'NUNCA CONTESTO') {
            $axclass_color = 'list-group-item list-group-item-action list-group-item-dark';            
        } elseif ($axEstado_seguimiento == 'SEGUIMIENTO') {
            $axclass_color = 'list-group-item list-group-item-action list-group-item-success';            
        } elseif ($axEstado_seguimiento == 'VENDIDO') {
            $axclass_color = 'list-group-item list-group-item-action list-group-item-primary';            
        }

        

        echo"<a href='#' class='$axclass_color'><b> $axFecha_seguimiento $axHora_seguimiento - $axEstado_seguimiento <i class='bi bi-chat-left-text-fill'></i> </b><br> <p style='font-size:12px;'>$axDetalle_comentario</p></a>"; 
    }
    
    echo"</div>";

   }else{

    $respuesta = 5;
    echo $respuesta;

   }

break;

case '5':
    
    $axid_prospecto_sg = $_POST['txtid_prospecto_sg'];
    $axid_prospecto_dt = $_POST['txtid_prospecto_dt'];
    $axfecha_seguimiento = $_POST['txtfecha_seguimiento'];
    $axhora_seguimiento = $_POST['txthora_seguimiento'];
    $axdetalle_comentario = $_POST['txtdetalle_comentario'];
    $axestado_seguimiento = $_POST['txtestado_seguimiento'];
    $axfecha_seguimiento_proximo = $_POST['txtfecha_seguimiento_proximo'];
    $axhora_seguimiento_proximo = $_POST['txthora_seguimiento_proximo'];
    $axvisita_oficina = $_POST['txtvisita_oficina'];
    $axvistia_proyecto = $_POST['txtvistia_proyecto'];
    $axid_producto = $_POST['txtid_producto'];
    $axid_cliente = $_POST['txtid_cliente'];
    $axparametros = $_POST['txtparametros'];
    $axagendar = $_POST['txtagendar'];
    $axverificar = $_POST['txtverificar'];

    $axnom_cliente = $_POST['txtnom_cliente'];
    $axquebusca = $_POST['txtquebusca'];
    $axestado_civil = $_POST['txtestado_civil'];
    $axsituacion_laboral = $_POST['txtsituacion_laboral'];
    $axedad_cliente = $_POST['txtedad_cliente'];
    $axciudad_cliente = $_POST['txtciudad_cliente'];


    $axprimer_seguimiento = $_POST['txtprimer_seguimiento'];
    $axestado_agendado='PENDIENTE';
    $axestado_agendado_editar=$_POST['txtestado_agendado'];
    

    if($axparametros==0){

        if($axverificar=='SI'){

           $sqlinsert = "INSERT INTO MK_PROSPECTOS_SEGUIMIENTO (ID_PROSPECTO_DT,FECHA_SEGUIMIENTO,HORA_SEGUIMIENTO,DETALLE_COMENTARIO,ESTADO_SEGUIMIENTO,FECHA_SEGUIMIENTO_PROXIMO,HORA_SEGUIMIENTO_PROXIMO,VISITA_OFICINA,VISTIA_PROYECTO,ID_PRODUCTO,ESTADO_AGENDADO) VALUES ('$axid_prospecto_dt','$axfecha_seguimiento','$axhora_seguimiento','$axdetalle_comentario','$axestado_seguimiento','$axfecha_seguimiento_proximo','$axhora_seguimiento_proximo','$axvisita_oficina','$axvistia_proyecto','$axid_producto','$axestado_agendado')"; 
            
        }elseif($axverificar=='NO'){

            $sqlinsert = "INSERT INTO MK_PROSPECTOS_SEGUIMIENTO (ID_PROSPECTO_DT,FECHA_SEGUIMIENTO,HORA_SEGUIMIENTO,DETALLE_COMENTARIO,ESTADO_SEGUIMIENTO,VISITA_OFICINA,VISTIA_PROYECTO,ID_PRODUCTO,ESTADO_AGENDADO) VALUES ('$axid_prospecto_dt','$axfecha_seguimiento','$axhora_seguimiento','$axdetalle_comentario','$axestado_seguimiento','$axvisita_oficina','$axvistia_proyecto','$axid_producto','')";
        }

        
    }else if($axparametros==1){

         if($axverificar=='SI'){

            $sqlinsert = "UPDATE MK_PROSPECTOS_SEGUIMIENTO SET ID_PROSPECTO_DT='$axid_prospecto_dt',FECHA_SEGUIMIENTO='$axfecha_seguimiento',HORA_SEGUIMIENTO='$axhora_seguimiento',DETALLE_COMENTARIO='$axdetalle_comentario',ESTADO_SEGUIMIENTO='$axestado_seguimiento',FECHA_SEGUIMIENTO_PROXIMO='$axfecha_seguimiento_proximo',HORA_SEGUIMIENTO_PROXIMO='$axhora_seguimiento_proximo',VISITA_OFICINA='$axvisita_oficina',VISTIA_PROYECTO='$axvistia_proyecto',ID_PRODUCTO='$axid_producto',ESTADO_AGENDADO='$axestado_agendado_editar' WHERE ID_PROSPECTO_SG='$axid_prospecto_sg'";

         }elseif($axverificar=='NO'){

            $sqlinsert = "UPDATE MK_PROSPECTOS_SEGUIMIENTO SET ID_PROSPECTO_DT='$axid_prospecto_dt',FECHA_SEGUIMIENTO='$axfecha_seguimiento',HORA_SEGUIMIENTO='$axhora_seguimiento',DETALLE_COMENTARIO='$axdetalle_comentario',ESTADO_SEGUIMIENTO='$axestado_seguimiento',VISITA_OFICINA='$axvisita_oficina',VISTIA_PROYECTO='$axvistia_proyecto',ID_PRODUCTO='$axid_producto',ESTADO_AGENDADO='$axestado_agendado_editar' WHERE ID_PROSPECTO_SG='$axid_prospecto_sg'";

         }
    
        
    }

    //echo $sqlinsert;

    $RsInsert = odbc_exec($con,$sqlinsert);

    if($RsInsert){

        $axId_prospecto_cz = get_row('MK_PROSPECTOS_DT','ID_PROSPECTO_CZ','ID_PROSPECTO_DT',$axid_prospecto_dt);

        //if($axprimer_seguimiento==1){            

            $sqlactualizar_pst ="UPDATE MK_PROSPECTOS_CZ SET CLIENTE_PST='$axnom_cliente', CLIENTE_BUSCA='$axquebusca',CLIENTE_ESTADO_CIVIL='$axestado_civil',CLIENTE_SITU_LABORAL='$axsituacion_laboral',CLIENTE_GRUPO_EDAD='$axedad_cliente',CLIENTE_CIUDAD='$axciudad_cliente',ESTADO_SEGUIMIENTO_ACTUAL='$axestado_seguimiento',FECHA_SEGUIMIENTO_ACTUAL='$axfecha_seguimiento',HORA_SEGUIMIENTO_ACTUAL='$axhora_seguimiento' WHERE ID_PROSPECTO_CZ='$axId_prospecto_cz'";
            $rsactualizar_pst = odbc_exec($con,$sqlactualizar_pst);  

          //  echo $sqlactualizar_pst;         

        //}

          //  $sqlactualizar_pst_estado_actual ="UPDATE MK_PROSPECTOS_CZ SET ESTADO_SEGUIMIENTO_ACTUAL='$axestado_seguimiento',FECHA_SEGUIMIENTO_ACTUAL='$axfecha_seguimiento',HORA_SEGUIMIENTO_ACTUAL='$axhora_seguimiento' WHERE ID_PROSPECTO_CZ='$axId_prospecto_cz'";
           // $rsactualizar_pst_estado_actual = odbc_exec($con,$sqlactualizar_pst_estado_actual);  
           // echo $sqlactualizar_pst_estado_actual;

        $respuesta =0;
        echo $respuesta;

    }else{

        $respuesta =1;
        echo $respuesta;


    }
break;

case '6':
   
   $axid_prospecto_dt= $_POST['txtid_prospecto_dt'];
   $axId_prospecto_cz = get_row('MK_PROSPECTOS_DT','ID_PROSPECTO_CZ','ID_PROSPECTO_DT',$axid_prospecto_dt);
    
    $sql6 = "SELECT * FROM MK_PROSPECTO_PRODUCTOS_EN_SEGUIMIENTO WHERE ID_PROSPECTO_CZ = '$axId_prospecto_cz'";
    
    $result1=odbc_exec($con,$sql6);
    if(odbc_num_rows($result1) > 0) {
    
      $axlistaprov1 = odbc_fetch_object($result1);
      $axlistaprov1 ->status =200;
      echo json_encode($axlistaprov1);
      
  } else {

        $error = array('status'=> 400);
        echo json_encode((object) $error);
  } 


break;

case '7':
    
$axid_ejecutivo = $_POST['txtid_ejecutivo'];

$sql6 = "WITH ProspectosNumerados AS (
    SELECT
        MK_PROSPECTOS_DT.ID_PROSPECTO_CZ,
        MK_PROSPECTOS_DT.ID_PROSPECTO_DT,
        USUARIO.ID_USUARIO AS ID_EJECUTIVO,
        USUARIO.USUARIO AS EJECUTIVO,
        COALESCE(MK_PROSPECTOS_SEGUIMIENTO.FECHA_SEGUIMIENTO, '19000101') AS FECHA_SEGUIMIENTO,
        MK_PROSPECTOS_SEGUIMIENTO.HORA_SEGUIMIENTO,
        COALESCE(MK_PROSPECTOS_SEGUIMIENTO.ESTADO_SEGUIMIENTO, 'SIN REVISION') AS ESTADO_SEGUIMIENTO,
        ROW_NUMBER() OVER (PARTITION BY MK_PROSPECTOS_DT.ID_PROSPECTO_CZ ORDER BY COALESCE(MK_PROSPECTOS_SEGUIMIENTO.FECHA_SEGUIMIENTO, '19000101') DESC, MK_PROSPECTOS_SEGUIMIENTO.HORA_SEGUIMIENTO DESC) AS NumFila
    FROM
        dbo.MK_PROSPECTOS_DT
        INNER JOIN dbo.USUARIO ON MK_PROSPECTOS_DT.ID_USUARIO = USUARIO.ID_USUARIO
        FULL OUTER JOIN dbo.MK_PROSPECTOS_SEGUIMIENTO ON MK_PROSPECTOS_DT.ID_PROSPECTO_DT = dbo.MK_PROSPECTOS_SEGUIMIENTO.ID_PROSPECTO_DT
    WHERE
        (dbo.MK_PROSPECTOS_DT.ID_USUARIO = $axid_ejecutivo)
)
SELECT
    ESTADO_SEGUIMIENTO,
    COUNT(*) AS CANTIDAD
FROM
    ProspectosNumerados
WHERE
    NumFila = 1
GROUP BY
    ESTADO_SEGUIMIENTO

UNION ALL

SELECT
    '' AS ESTADO,
    0 AS CANTIDAD;
";

// Ejecutar la consulta
$rsbuscar = odbc_exec($con, $sql6);

// Inicializar el array
$jsonDT_1 = [];

// Verificar el resultado de la consulta
if (!$rsbuscar) {

    echo json_encode(['respuesta' => 'Error en la consulta: ' . odbc_errormsg()]);

}else{

    // Imprimir la consulta para depuración
    //echo json_encode(['sql_debug' => $sql6]);

    // Inicializar el contador de filas
    $axnum = 0;

        // Recorrer las filas y construir el array
        while ($filaDT = odbc_fetch_array($rsbuscar)) {
            $jsonDT_1[] = [
                'ESTADO' => $filaDT['ESTADO_SEGUIMIENTO'],
                'CANT' => $filaDT['CANTIDAD']
            ];
            // Incrementar el contador de filas
        $axnum++;
        }

        // Imprimir el array como JSON      
        echo json_encode($jsonDT_1);  
        //echo json_encode(['resultados' => $jsonDT_1]);

        // Verificar si ocurrieron errores durante el recorrido
        $error = odbc_error($con);
        if ($error) {
            echo json_encode(['respuesta' => 'Error al recorrer filas: ' . $error]);
        }
    

} 


// Liberar recursos
odbc_free_result($rsbuscar);


break;

case '8':
    
$axid_ejecutivo = $_POST['txtid_ejecutivo'];
/*
$sql6 = "WITH ProspectosNumerados AS (
    SELECT
        MK_PROSPECTOS_DT.ID_PROSPECTO_CZ,
        MK_PROSPECTOS_DT.ID_PROSPECTO_DT,
        USUARIO.ID_USUARIO AS ID_EJECUTIVO,
        USUARIO.USUARIO AS EJECUTIVO,
        COALESCE(MK_PROSPECTOS_SEGUIMIENTO.FECHA_SEGUIMIENTO, '19000101') AS FECHA_SEGUIMIENTO,
        MK_PROSPECTOS_SEGUIMIENTO.HORA_SEGUIMIENTO,
        COALESCE(MK_PROSPECTOS_SEGUIMIENTO.ESTADO_SEGUIMIENTO, 'SIN REVISION') AS ESTADO_SEGUIMIENTO,
        ROW_NUMBER() OVER (PARTITION BY MK_PROSPECTOS_DT.ID_PROSPECTO_CZ ORDER BY COALESCE(MK_PROSPECTOS_SEGUIMIENTO.FECHA_SEGUIMIENTO, '19000101') DESC, MK_PROSPECTOS_SEGUIMIENTO.HORA_SEGUIMIENTO DESC) AS NumFila
    FROM
        dbo.MK_PROSPECTOS_DT
        INNER JOIN dbo.USUARIO ON MK_PROSPECTOS_DT.ID_USUARIO = USUARIO.ID_USUARIO
        FULL OUTER JOIN dbo.MK_PROSPECTOS_SEGUIMIENTO ON MK_PROSPECTOS_DT.ID_PROSPECTO_DT = dbo.MK_PROSPECTOS_SEGUIMIENTO.ID_PROSPECTO_DT
    WHERE
        (dbo.MK_PROSPECTOS_DT.ID_USUARIO = $axid_ejecutivo)
)
SELECT
    ESTADO_SEGUIMIENTO,
    COUNT(*) AS CANTIDAD
FROM
    ProspectosNumerados
WHERE
    NumFila = 1
GROUP BY
    ESTADO_SEGUIMIENTO
";

*/
$sql6 = "SELECT  COALESCE(ESTADO_SEGUIMIENTO, 'SIN REVISION') AS ESTADO_SEGUIMIENTO,CANTIDAD FROM MK_PROSPECTOS_ESTADO_SEGUIMIENTO_ACTUAL WHERE ID_EJECUTIVO='$axid_ejecutivo'"; 
$rsbuscar = odbc_exec($con, $sql6);
//echo $sql6;

// Verificar el resultado de la consulta
if (!$rsbuscar) {
    echo json_encode(['respuesta' => 'Error en la consulta: ' . odbc_errormsg()]);
}else{

    echo "
    <table class='table table-hover table-sm'>
    <thead class='table-primary'>           
        <tr>
            <th style='text-align: left;'>ESTADO</th>     
            <th style='text-align: center;'>CANT</th>                 
        </tr>
    </thead>";

    while ($fila = odbc_fetch_array($rsbuscar)) {

        $axEstado_seguimiento = $fila['ESTADO_SEGUIMIENTO'];
        $axCantidad = $fila['CANTIDAD'];

          // Colores base
        if ($axEstado_seguimiento == 'DEJO DE CONTESTAR') {
            $axclass_color = 'color:rgba(220, 53, 69)';
        } elseif ($axEstado_seguimiento == 'FUTURA VENTA') {
            $axclass_color = 'color:rgba(255, 193, 7)';
        } elseif ($axEstado_seguimiento == 'NO INTERESADO') {
            $axclass_color = 'color:rgba(240, 210, 230)';
        } elseif ($axEstado_seguimiento == 'NUNCA CONTESTO') {
            $axclass_color = 'color:rgba(52, 58, 64)';
        } elseif ($axEstado_seguimiento == 'SEGUIMIENTO') {
            $axclass_color = 'color:rgba(40, 167, 69)';
        } elseif ($axEstado_seguimiento == 'VENDIDO') {
            $axclass_color = 'color:rgba(0, 123, 255)';
        } elseif ($axEstado_seguimiento == 'SIN REVISION') {
            $axclass_color = 'color:rgba(149, 149, 149)';
        }

         echo "<tr>
            <td style='$axclass_color;text-align:left;'><b>$axEstado_seguimiento</b></td> 
            <td style='$axclass_color;text-align:center;'><b>$axCantidad</b></td> 
            </tr>";
    }   

    echo "</table>";
    

} 

break;

case '9':

$axid_ejecutivo = $_POST['txtid_ejecutivo'];

$sqlagenda = "SELECT * FROM MK_PROSPECTO_LLAMADAS_AGENDADAS WHERE ID_EJECUTIVO='$axid_ejecutivo' AND ESTADO_AGENDADO='PENDIENTE' ORDER BY FECHA_SEGUIMIENTO_PROXIMO DESC";    
$rsbuscar = odbc_exec($con, $sqlagenda);

// Verificar el resultado de la consulta
if (!$rsbuscar) {
    echo json_encode(['respuesta' => 'Error en la consulta: ' . odbc_errormsg()]);
}else{
    echo "
    <table class='table table-hover table-sm'>
    <thead class='table-primary'>           
        <tr>
            <th style='text-align: center;'>FECHA Y HORA</th>     
            <th style='text-align: left;'>AGENDA</th>                 
            <th style='text-align: center;'></th>                 
        </tr>
    </thead>";

    while ($fila = odbc_fetch_array($rsbuscar)) {

        $axId_prospecto_sg = $fila['ID_PROSPECTO_SG'];
        $axid_prospecto_cz = $fila['ID_PROSPECTO_CZ'];
        $axid_prospecto_dt = $fila['ID_PROSPECTO_DT'];
        $axfecha_seguimiento_proximo = date('d-m-Y',strtotime($fila['FECHA_SEGUIMIENTO_PROXIMO']));
        $axhora_seguimiento_proximo = $fila['HORA_SEGUIMIENTO_PROXIMO'];
        $axid_ejecutivo = $fila['ID_EJECUTIVO'];
        $axuser_ejecutivo = $fila['USER_EJECUTIVO'];
        $axcliente = $fila['CLIENTE'];
        $axestado = $fila['ESTADO_AGENDADO'];

        if($axestado ='PENDIENTE'){
            $axclass_color = 'color:rgba(220, 53, 69)';
        }else{
            $axclass_color = 'color:rgba(149, 149, 149)';
        }


         echo "<tr>
            <td style='$axclass_color;text-align:center;'><b>$axfecha_seguimiento_proximo $axhora_seguimiento_proximo</b></td> 
            <td style='$axclass_color;text-align:left;'><b>LLAMAR AL $axcliente</b></td> 
            <td style='$axclass_color;text-align:left;'><b><a href='#' class='$axclass_color' style='text-decoration:none;' id='btn_ejecutar_agenda' title='Click para cambiar estado de lo agendado...' data-id='$axId_prospecto_sg'><i class='bi bi-info-circle-fill' style='font-size:13px;'></i></a></b></td> 
            </tr>";
    }   

    echo "</table>";

}

break;

case '10':

    $axid_prospecto_sg = $_POST['txtid_prospecto_sg'];

    $sqlactualizar = "UPDATE MK_PROSPECTOS_SEGUIMIENTO SET ESTADO_AGENDADO ='EJECUTADA' WHERE ID_PROSPECTO_SG='$axid_prospecto_sg'";
    $rsactualizar = odbc_exec($con,$sqlactualizar);

    if($rsactualizar){
        $respuesta =0;
        echo $respuesta;
    }else{
        $respuesta =1;
        echo $respuesta;
    }



break;

}

function guardar_bitacora($id_user,$modulo,$detalle){

date_default_timezone_set("America/Lima");

global $con;

$axfecha = date('Y-m-d');
$axperiodo_uso = date('m-Y',strtotime($axfecha));
$axhora = date('H:i:s');
$axid_usuario = $id_user;
$axnom_usario = get_row('USUARIO','USUARIO','ID_USUARIO',$axid_usuario);
$axnom_modulo = $modulo;
$axdetalle_bitacora = $detalle;
$ip_maquina = obtenerIP();

$SQLInsert = "INSERT INTO BITACORA_USOS (FECHA_MOV,HORA_MOV,USUARIO,ACTIVIDAD_REALIZADA,NOM_MENU,PERIODO_USO,IP_MAQUINA) VALUES ('$axfecha','$axhora','$axnom_usario','$axdetalle_bitacora','$axnom_modulo','$axperiodo_uso','$ip_maquina')";
//echo $SQLInsert;
$RSInsert = odbc_exec($con,$SQLInsert);


}
function obtenerIP() {
    // Si el usuario está accediendo a través de un proxy
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    // Si el usuario está accediendo a través de un proxy compartido
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    // Si el usuario está accediendo directamente
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    
    return $ip;
}



function generateRandomCode($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomCode = '';
    
    for ($i = 0; $i < $length; $i++) {
        $randomCode .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomCode;
}


function get_row_two($table,$col, $id_1, $id_2, $equal_1, $equal_2){

	global $con;
	$querysql="select top 1 $col from $table where $id_1='$equal_1' and $id_2='$equal_2' order by $col desc";
	$query=odbc_exec($con,$querysql);
	$rw=odbc_fetch_array($query);
	$value=$rw[$col];
	return $value;
}

function get_row_three($table,$col, $id_1, $id_2, $id_3,$equal_1, $equal_2,$equal_3){

	global $con;
	$querysql="select top 1 $col from $table where $id_1='$equal_1' and $id_2='$equal_2' and $id_3='$equal_3' order by $col desc";
	$query=odbc_exec($con,$querysql);
	$rw=odbc_fetch_array($query);
	$value=$rw[$col];
	return $value;
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


