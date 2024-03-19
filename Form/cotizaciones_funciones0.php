<?php  


require('../Imprimir/Classes/PHPExcel/IOFactory.php');
require('../Imprimir/pdf_js.php');
//\Imprimir\Classes\PHPExcel

require('../phpqrcode/qrlib.php');
require_once '../core2.php';


$param=$_POST['param'];


switch ($param) {


case '0': // listar usuarios



break;


case '1':
	
   $axid_empresa  = $_POST['txtid_empresa'];
   $axID_COTIZACION_CZ  = $_POST['txtID_COTIZACION_CZ'];
   $axcodigo_pst_cz  = $_POST['txtcodigo_pst_cz'];
   $axdescripcion_pst  = $_POST['txtdescripcion_pst'];
   $axid_proyecto  = $_POST['txtid_proyecto'];
   $axid_medio_captacion  = $_POST['txtid_medio_captacion'];
   $axid_canal  = $_POST['txtid_canal'];
   $axid_usuario_coordinador  = $_POST['txtid_usuario_coordinador'];
   $axid_doc  = $_POST['txtid_doc'];
   $axnum_doc_cliente_pst  = $_POST['txtnum_doc_cliente_pst'];
   $axtipo_cliente_pst  = $_POST['txttipo_cliente_pst'];
   $axcod_cliente_pst  = $_POST['txtcod_cliente_pst'];
   $axnombres_cliente_pst  = $_POST['txtnombres_cliente_pst'];
   $axpaterno_cliente_pst  = $_POST['txtpaterno_cliente_pst'];
   $axmaterno_cliente_pst  = $_POST['txtmaterno_cliente_pst'];
   $axcliente_pst  = $_POST['txtcliente_pst'];
   $axemail_cliente_pst  = $_POST['txtemail_cliente_pst'];
   $axnum_celular_pst  = $_POST['txtnum_celular_pst'];
   $axcomentario_pst  = $_POST['txtcomentario_pst'];
   $axestado_prospecto  = $_POST['txtestado_prospecto'];
   $axfecha_reg_prospecto  = $_POST['txtfecha_reg_prospecto'];
   $axhora_reg_prospecto  = date('H:i',strtotime($_POST['txthora_reg_prospecto']));
   $axtipo_asignacion  = $_POST['txttipo_asignacion'];
   $axmodulo  = $_POST['txtmodulo'];
   $axid_usuario  = $_POST['txtid_usuario'];
   $axparametros  = $_POST['txtparametros'];
   $axid_usuario_vendedor = $_POST['txtid_ejecutivo_ventas_asignar'];


   if($axparametros==0){

		$axcodigo_pst_cz = generateRandomCode();
		$axcod_cliente_pst = generateRandomCode();

      $sqlgrabar = "INSERT INTO MK_PROSPECTOS_CZ (CODIGO_PST_CZ,DESCRIPCION_PST,ID_PROYECTO,ID_MEDIO_CAPTACION,ID_CANAL,ID_USUARIO,ID_DOC,NUM_DOC_CLIENTE_PST,TIPO_CLIENTE_PST,COD_CLIENTE_PST,NOMBRES_CLIENTE_PST,PATERNO_CLIENTE_PST,MATERNO_CLIENTE_PST,CLIENTE_PST,EMAIL_CLIENTE_PST,NUM_CELULAR_PST,COMENTARIO_PST,ESTADO_PROSPECTO,FECHA_REG_PROSPECTO,HORA_REG_PROSPECTO,ID_EMPRESA,TIPO_ASIGNACION) VALUES ('$axcodigo_pst_cz','$axdescripcion_pst','$axid_proyecto','$axid_medio_captacion','$axid_canal','$axid_usuario_coordinador','$axid_doc','$axnum_doc_cliente_pst','$axtipo_cliente_pst','$axcod_cliente_pst','$axnombres_cliente_pst','$axpaterno_cliente_pst','$axmaterno_cliente_pst','$axcliente_pst','$axemail_cliente_pst','$axnum_celular_pst','$axcomentario_pst','$axestado_prospecto','$axfecha_reg_prospecto','$axhora_reg_prospecto','$axid_empresa','$axtipo_asignacion')";

   }else{

      $sqlgrabar = "UPDATE MK_PROSPECTOS_CZ SET CODIGO_PST_CZ='$axcodigo_pst_cz',DESCRIPCION_PST='$axdescripcion_pst',ID_PROYECTO='$axid_proyecto',ID_MEDIO_CAPTACION='$axid_medio_captacion',ID_CANAL='$axid_canal',NUM_CELULAR_PST='$axnum_celular_pst',ID_EMPRESA='$axid_empresa' WHERE ID_COTIZACION_CZ='$axID_COTIZACION_CZ'";

      $axtipo_asignacion ='';
   }

   $rsgrabar = odbc_exec($con,$sqlgrabar);
  // echo $sqlgrabar;

   if($rsgrabar){

    if($axtipo_asignacion=='AUTO'){


    }elseif($axtipo_asignacion=='MANUAL'){

        $axID_COTIZACION_CZ = get_row('MK_PROSPECTOS_CZ','ID_COTIZACION_CZ','CODIGO_PST_CZ',$axcodigo_pst_cz);
        $axid_desviacion = get_row('MK_DESVIACIONES','ID_DESVIACION','TIPO_DESVIACION',$axestado_prospecto);
        $axnom_ejecutivo = get_row('USUARIO','USUARIO','ID_USUARIO',$axid_usuario_vendedor);

        $sqlgrabar_dt = "INSERT INTO MK_PROSPECTOS_DT (ID_COTIZACION_CZ,FECHA_ASIGNACION,HORA_ASIGNACION,ID_USUARIO,ID_DESVIACION) VALUES ('$axID_COTIZACION_CZ','$axfecha_reg_prospecto','$axhora_reg_prospecto','$axid_usuario_vendedor','$axid_desviacion')";
        $rsgrabar_dt = odbc_exec($con,$sqlgrabar_dt);

        $sqlactualizar = "UPDATE MK_PROSPECTOS_CZ SET NOM_EJECUTIVO='$axnom_ejecutivo',ID_EJECUTIVO='$axid_usuario_vendedor',FECHA_ASIGNACION_ACTUAL='$axfecha_reg_prospecto',HORA_ASIGNACION_ACTUAL='$axhora_reg_prospecto' WHERE ID_COTIZACION_CZ='$axID_COTIZACION_CZ'";
        $rsactualizar = odbc_exec($con,$sqlactualizar);
        //echo $sqlactualizar;

    }

    $respuesta =0;
    echo $respuesta;

   }else{

      $respuesta =1;
      echo $respuesta;

   }

break;

case '2':
	
	$axID_COTIZACION_CZ= $_POST['txtID_COTIZACION_CZ'];
	
	$sql6 = "SELECT * FROM COTIZACION_CZ WHERE ID_COTIZACION_CZ = '$axID_COTIZACION_CZ'";
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

case '3':
    
    $axidempresa = $_POST['txtid_empresa'];    
    $axbuscaregistro = $_POST['txtbuscar_prospectos']; 
    $axtipoorden = $_POST['txttipoorden'];
    $axtipoorden_rango = $_POST['txttipoorden_rango'];
    $axtipoorden_numero = $_POST['txttipoorden_numero'];
    $axorden = $_POST['txtorden'];   
    $axfecha_reg_prospecto = $_POST['txtfecha_reg_prospecto'];   
    $axfecha_al = $_POST['txtfecha_al'];   
    $axnom_tabla = $_POST['txtnom_tabla'];  
    $axtipo_busqueda = $_POST['txttipo_busqueda'];  
    $axcampo_tabla = $_POST['txtcampo_tabla'];  
    $axcampo_tabla_orden = $_POST['txtcampo_tabla_orden'];  
    $axcampo_contenido = $_POST['txtcampo_contenido'];
    $axtotal_registros = contarRegistros($axnom_tabla);

    if($axtipoorden==""){

    if($axbuscaregistro==""){

    if($axtipo_busqueda=='FILTRAR'){
    
        $sql6 ="SELECT TOP $axtotal_registros *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE $axcampo_tabla = '$axcampo_contenido' AND ID_EMPRESA='$axidempresa' ORDER BY $axcampo_tabla ASC";        
        
    }elseif($axtipo_busqueda=='ORDENAR'){

        if($axcampo_tabla==''){
            $sql6 ="SELECT *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' ORDER BY $axcampo_tabla_orden $axorden";              
        }else{
            $sql6 ="SELECT *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE $axcampo_tabla = '$axcampo_contenido' AND ID_EMPRESA='$axidempresa' ORDER BY $axcampo_tabla_orden $axorden";        
        }
        
        
    }else{

        if($axtotal_registros >= 20){

        $sql6 ="SELECT TOP 20 *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla  ORDER BY ID_COTIZACION_CZ ASC";  
        $axcontador = 20 .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>';

        }elseif($axtotal_registros < 20){

            $sql6 ="SELECT TOP $axtotal_registros *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla ORDER BY ID_COTIZACION_CZ ASC";
            $axcontador = $axtotal_registros .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>';
        }
        

    }

    echo '<script language="javascript">console.log("'.$sql6.'");</script>';

  }else{

    $sql6 ="SELECT *, COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' AND USUARIO+' '+NOM_USUARIO+' '+COD_USUARIO+' '+AREA_TRABAJO+' '+AREA_CARGO like '%".$axbuscaregistro."%' ORDER BY ID_COTIZACION_CZ ASC";
  }
    

    }elseif($axtipoorden=='TODOS'){

            if($axtipo_busqueda=='ORDENAR'){
                //$sql6 ="SELECT TOP $axtotal_registros *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla WHERE ID_EMPRESA='$axidempresa' ORDER BY $axcampo_tabla_orden $axorden";       
                //$axcontador = $axtotal_registros .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>'; 
                
                $sql6 ="SELECT TOP $axtotal_registros *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla ORDER BY $axcampo_tabla_orden $axorden";       
                $axcontador = $axtotal_registros .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>'; 
            }else{
                $sql6 ="SELECT TOP $axtotal_registros *,COUNT(*) OVER () AS cant_registros FROM $axnom_tabla ORDER BY ID_COTIZACION_CZ ASC";          
                $axcontador = $axtotal_registros .' de '.'<a href="#" id="btn_prospectos_todos" data-tipoorden="TODOS" style="text-decoration:none; color:black;" title="Click para visualizar todos...">'.$axtotal_registros.'</a>';   
            }

    }

        //echo $sql6;
        $RSListar_c = odbc_exec($con, $sql6);
        $fila_c = odbc_fetch_array($RSListar_c);
    $axcant_registros = $fila_c['cant_registros']; 

    if($axtipo_busqueda=='FILTRAR' || $axtipo_busqueda=='ORDENAR'){
        $axcontador = $axcant_registros .' de '.$axtotal_registros;    
    }
    $RSListar=odbc_exec($con,$sql6);

    echo "<table class='table table-hover table-sm'>
        <thead class='table-primary'>  

        <tr class='table-secondary'>
            
                <th  style='text-align: center;' > <a href='#' id='btn_prospectos_todos' data-tipoorden='TODOS' style='text-decoration:none; color:black;' title='Click para visualizar todos...'><i class='bi bi-arrow-clockwise' style='font-size:15px;'></i> Ver todos </a> </th>         
                <th  style='text-align: right;' colspan ='12' > Mostrando $axcontador registros</th>         
            </tr>
            
            <tr>
                <th style='text-align: center;'>Nº
                    <a href='#' id='btn_ordenar_asc' data-tipoorden_numero='NUMERO'  > <b><i class='$axicon_claro' style='font-size:15px;'></i></a></b> 
                    <a href='#' id='btn_ordenar_desc' data-tipoorden_numero='NUMERO' hidden> <b><i class='$axicon_oscuro' style='font-size:15px;'></i></a></b> 
                </th>         
                <th style='text-align: left;'>NUMERO</th>
                <th style='text-align: left;'>FECHA</th>
                <th style='text-align: left;'>RAZON SOCIAL</th>
                <th style='text-align: left;'>CELULAR</th> 
                <th style='text-align: left;'>CORREO ELECTRONICO</th>
                <th style='text-align: center;'>LOCAL</th>
                <th style='text-align: center;'>TOTAL</th>
                <th style='text-align: center;'>ACCION</th>
            </tr>
        </thead>

        ";

    if (odbc_num_rows($RSListar) > 0) {

        while ($fila = odbc_fetch_array($RSListar)) {

            $it = $it + 1;
            $axID_COTIZACION_CZ    = $fila['ID_COTIZACION_CZ'];
            $axNombre = $fila['NOMBRE'];

            if($axNombre==''){
                $axNombre = 'S/N';
            }

            $axId_proyecto     = $fila['ID_PROYECTO'];
            $axProyecto = $fila['PROYECTO'];
            $axCanal = $fila['CANAL'];
            $axMedio = $fila['MEDIO'];
            $axCliente = $fila['CLIENTE'];
            $axEmail = $fila['EMAIL'];
            $axCelular = $fila['CELULAR'];
            $axComentario = $fila['COMENTARIO'];
            $axEstado = $fila['ESTADO'];
            $axId_empresa = $fila['ID_EMPRESA'];
            $axLogo = $fila['LOGO'];
            $axhora = date('H:i',strtotime($fila['HORA_REG_PROSPECTO']));
            $axfecha = date('d-m-Y',strtotime($fila['FECHA_REG_PROSPECTO']));
            $axid_ejecutivo = $fila['ID_EJECUTIVO'];
            $axejecutivo_asignado =get_row('USUARIO','USUARIO','ID_USUARIO',$axid_ejecutivo);
            $axnom_ejecutivo=get_row('USUARIO','NOM_USUARIO','ID_USUARIO',$axid_ejecutivo);

            $nom_pst = $axCelular.' '.$axCliente;

            $axid_coordinador = $fila['ID_COORDINADOR'];
            $axuser_coordinador = $fila['USER_COORDINADOR'];
            $axnom_coordinador = $fila['NOM_COORDINADOR'];

            $fechaAsignacion = $fila['FECHA_ASIGNACION_ACTUAL'];
            $horaAsignacion = $fila['HORA_ASIGNACION_ACTUAL'];

            $fechaSeguimiento = $fila['FECHA_SEGUIMIENTO_ACTUAL'];
            $horaSeguimiento = $fila['HORA_SEGUIMIENTO_ACTUAL'];

            $axinicio = $fechaAsignacion.' '.$horaAsignacion;
            $axfinal = $fechaSeguimiento.' '.$horaSeguimiento;

            $axEstado_seguimiento_actual = $fila['ESTADO_SEGUIMIENTO_ACTUAL'];
            $estado = $fila['ESTADO'];
            $idprospecto=$fila['ID_COTIZACION_CZ'];
            // Llama a la función para calcular el tiempo e indicador
            $resultado = calcularTiempoEIndicador($estado, $fechaAsignacion, $horaAsignacion, $fechaSeguimiento, $horaSeguimiento,$idprospecto);

            // Accede a los resultados
            $tiempoTranscurrido = $resultado["TIEMPO"];
            $indicador = $resultado["INDICADOR"];
                
            $axid_prospecto_dt = get_row_two('MK_PROSPECTOS_DT','ID_PROSPECTO_DT','ID_COTIZACION_CZ','ID_USUARIO',$axID_COTIZACION_CZ,$axid_ejecutivo);        

            $SQLContar =  "SELECT COUNT(ID_PROSPECTO_SG) AS TT FROM MK_PROSPECTOS_SEGUIMIENTO WHERE ID_PROSPECTO_DT='$axid_prospecto_dt'";
            $RSContar = odbc_exec($con,$SQLContar);
            $fila_c = odbc_fetch_array($RSContar);
            $axnum = $fila_c['TT'];

        
            if ($axEstado == 'ASIGNADO' || $axEstado == 'REASIGNADO' ) {
                $axtitulo = "REASIGNAR PROSPECTO";
                $axmotivo = 'MOTIVO DE REASIGNACION';
                
                $axestilo_1 = "background: linear-gradient(to bottom right, #DCFFDA, #DCFFDA);";
                $axclass_color = "text-success";

                $axboton_1 ="<a href='#' class='$axclass_color' title='Click para desviar el prospecto' id='btn_desviar_prospecto' data-coordinador='$axnom_coordinador' data-id_ejecutivo='$axid_ejecutivo' data-id_coordinador='$axid_coordinador' data-nom_ejecutivo='$axnom_ejecutivo' data-bs-toggle='modal' data-bs-target='#mdl_reasignar_prospectos_dt' data-motivo='$axmotivo' data-id='$axID_COTIZACION_CZ' data-titulo='$axtitulo'  style='text-decoration:none;'> ASIGNADO A <b>$axejecutivo_asignado  <i class='bi bi-dash-circle-fill'></i> </b><br> COORDINADOR : <b> $axuser_coordinador </b></a>";

            }elseif($axEstado == 'NO ASIGNADO'){
                $axtitulo = "ASIGNAR PROSPECTO";
                
                $axestilo_1 = "background: linear-gradient(to bottom right, #FEE5E5, #FEE5E5);";
                $axclass_color = "text-danger";
                $axboton_1 ="<a href='#' class='$axclass_color' title='Click para asignar el prospecto' id='btn_asignar_prospecto' data-id_coordinador='$axid_coordinador' data-bs-toggle='modal' data-bs-target='#mdl_asignar_prospectos_dt' data-id='$axID_COTIZACION_CZ' data-titulo='$axtitulo'  style='text-decoration:none;'><b>NO ASIGNADO <i class='bi bi-plus-circle-fill' ></i></b> <br> COORDINADOR : <b> $axuser_coordinador </b></a>";


            }elseif($axEstado == 'CERRADO'){
                $axestilo_1 = "background: linear-gradient(to bottom right, #D8F3FF, #D8F3FF);";
                $axclass_color = "text-primary";

            }



            echo " <tr>
                    <td style='text-align:center;'>$axID_COTIZACION_CZ </td>
                    <td style='text-align:left;'>$axfecha</td>
                    <td style='text-align:center;'>$axhora</td>
                    <td style='text-align:left;'>$axCelular</td>     
                    <td style='text-align:left;'>$axNombre</td>     
                    <td style='text-align:left;'>$axProyecto</td>     
                    <td style='text-align:left;' >$axMedio</td>
                    <td style='text-align:left;' >$axCanal</td>
                    <td style='text-align:left;' class='$axclass_color'>$axboton_1</td>     
                    
                    
                    <!--td style='text-align:center;' >$axinicio</td>
                    <td style='text-align:center;' >$axfinal</td-->

                    <td style='text-align:center;' >$tiempoTranscurrido</td>
                    <td style='text-align:center;' >$indicador</td>
                    
                    <td style='text-align:center;' >

                    <div class='btn-group dropstart'>

                        <button type='button' class='btn btn-outline-dark btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Acción</button>
                        <ul class='dropdown-menu'>                    
                        <div><hr class='dropdown-divider'></div>";
                        

                        if(trim($axid_prospecto_dt) !==''){
                            echo"
                            <a href='#' class='dropdown-item text-info' data-bs-toggle='modal' data-bs-target='#mdl_registrar_prospectos' title='Click para editar el prospecto' id='btn_editar_prospecto_cz' data-id='$axID_COTIZACION_CZ' style='text-decoration:none;'><i class='bi bi-pencil' style='font-size:20pX;'></i> Editar</a>
                            <a href='#' class='dropdown-item text-success ' data-bs-toggle='modal' data-bs-target='#mdl_ver_actividad' title='Click para ver Actividades el prospecto' id='btn_ver_actividad' data-comentario='$axcomentario_pst' data-py='$axproyecto' data-idpy='$axid_proyecto' data-iddt='$axid_prospecto_dt' data-idcz='$axID_COTIZACION_CZ' data-nom_pst='$nom_pst' data-cliente='$axcliente' style='text-decoration:none;'><i class='bi bi-activity' style='font-size:20pX;'></i> Actividades  <span class='badge rounded-pill text-bg-success'>$axnum</span> </a>";  
                        }else{
                            echo"
                            <a href='#' class='dropdown-item text-info' data-bs-toggle='modal' data-bs-target='#mdl_registrar_prospectos' title='Click para editar el prospecto' id='btn_editar_prospecto_cz' data-id='$axID_COTIZACION_CZ' style='text-decoration:none;'><i class='bi bi-pencil' style='font-size:20pX;'></i> Editar</a>";  
                        }
                        

                        echo "
                        <div><hr class='dropdown-divider'></div>
                        </ul>
                    </div>


                    </td>
                    </tr>";
        }

        echo "</table>";
    }else{
        echo "";
    }

        


    break;

case '4':
	
	$axtipo_desviacion = $_POST['txttipo_desviacion']; 
	
	$SQLCuentas = "SELECT * FROM MK_DESVIACIONES WHERE TIPO_DESVIACION='$axtipo_desviacion' ORDER BY CAUSAS_DESVIACION ASC";	
	$RSTipodocumentos=odbc_exec($con,$SQLCuentas);


   //echo $SQLCuentas;

	if(odbc_num_rows($RSTipodocumentos) > 0){		
		while($fila=odbc_fetch_array($RSTipodocumentos)){
	   		echo '<option value='.$fila['ID_DESVIACION'].'>'.utf8_encode($fila['CAUSAS_DESVIACION']).'</option>';
    	}		
	} else {

		echo "";	
	
	}


break;

case '5':
	
	$axid_prospecto_dt = $_POST['txtid_prospecto_dt']; 
	$axID_COTIZACION_CZ = $_POST['txtID_COTIZACION_CZ']; 
	$axfecha_asignacion = $_POST['txtfecha_asignacion']; 
	$axhora_asignacion = date('H:i',strtotime($_POST['txthora_asignacion'])); 
	$axid_usuario_vendedor = $_POST['txtid_ejecutivo_ventas']; 
	$axid_desviacion = $_POST['txtid_desviacion']; 
	$axtipo_desviacion = $_POST['txttipo_desviacion']; 
    $axid_usuario_coordinador_2 = $_POST['txtid_usuario_coordinador_2']; 

	$axnum_estado_prosp = get_row('MK_DESVIACIONES','ESTADO_PROSPECTO','ID_DESVIACION',$axid_desviacion);
	$axnom_ejecutivo = get_row('USUARIO','USUARIO','ID_USUARIO',$axid_usuario_vendedor);

	$sqlgrabar = "INSERT INTO MK_PROSPECTOS_DT (ID_COTIZACION_CZ,FECHA_ASIGNACION,HORA_ASIGNACION,ID_USUARIO,ID_DESVIACION) VALUES ('$axID_COTIZACION_CZ','$axfecha_asignacion','$axhora_asignacion','$axid_usuario_vendedor','$axid_desviacion')";
	$rsgrabar = odbc_exec($con,$sqlgrabar);
	//echo $sqlgrabar;

	if($rsgrabar){

		$sqlactualizar = "UPDATE MK_PROSPECTOS_CZ SET ESTADO_PROSPECTO='$axnum_estado_prosp',NOM_EJECUTIVO='$axnom_ejecutivo',ID_EJECUTIVO='$axid_usuario_vendedor',ID_USUARIO='$axid_usuario_coordinador_2',FECHA_ASIGNACION_ACTUAL='$axfecha_asignacion',HORA_ASIGNACION_ACTUAL='$axhora_asignacion' WHERE ID_COTIZACION_CZ='$axID_COTIZACION_CZ'";
		$rsactualizar = odbc_exec($con,$sqlactualizar);
		//echo $sqlactualizar;

		$respuesta =0;
		echo $respuesta;

	}else{

		$respuesta =1;
		echo $respuesta;
	}

break;

case '6'://POR REVISAR

    $axfecha_del = $_POST['txtfecha_del']; 
    $axfecha_al = $_POST['txtfecha_al']; 
        
    // Simula la obtención de datos desde la base de datos u otra fuente
    $proyeccion = 1000;
    $cumplimiento = 200;
    $pendiente = $proyeccion - $cumplimiento;

    // Obtén la fecha actual
    $fecha_actual = date("Y-m-d");

    // Simula la obtención de datos acumulados hasta la fecha actual
    $proyeccion_acumulada = 900;

    // Calcula la oportunidad de mejora
    $oportunidad_mejora = $proyeccion_acumulada - $cumplimiento;

    // Configura los encabezados para indicar que estás enviando datos JSON
    header('Content-Type: application/json');

    // Devuelve los datos como un array JSON
    echo json_encode([
    'proyeccion' => $proyeccion,
    'cumplimiento' => $cumplimiento,
    'pendiente' => $pendiente,
    'oportunidad_mejora' => $oportunidad_mejora
    ]);

    break;

case '7': // /GRAFICA DE REGISTROS DE PROSPECTOS
    
    $axid_empresa = $_POST['txtid_empresa']; 
    $axfecha_del = $_POST['txtfecha_reg_prospecto']; 
    $axfecha_al = $_POST['txtfecha_al']; 


    //$sql6 ="SELECT MEDIO,COUNT(MEDIO) AS CANT FROM MK_PROSPECTO_REGISTRO_MARKETING WHERE ID_EMPRESA='$axid_empresa' AND FECHA BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY  MEDIO  MEDIO UNION ALL SELECT 'VACIO' AS MEDIO, 0 AS CANT";

    $sql6 = "SELECT MEDIO, COUNT(MEDIO) AS CANT FROM MK_PROSPECTO_REGISTRO_MARKETING WHERE ID_EMPRESA = '$axid_empresa' AND FECHA BETWEEN '$axfecha_del' AND '$axfecha_al' GROUP BY  MEDIO UNION ALL SELECT '' AS MEDIO, 0 AS CANT";
    $rsbuscar = odbc_exec($con, $sql6);

    //echo $sql6;


    $axnum = odbc_num_rows($rsbuscar);
    $jsonDT_1 = [];

    if ($axnum > 0) {
        for ($i = 0; $i < $axnum; $i++) { 
            $filaDT = odbc_fetch_array($rsbuscar);
            $jsonDT_1[$i]['MEDIO'] = $filaDT['MEDIO'];
            $jsonDT_1[$i]['CANT'] = $filaDT['CANT'];
        }

        echo json_encode($jsonDT_1);
    } else {
        $respuesta = 1;
        echo  $respuesta;
    }

    break;

case '8':
    
    $axid_usuario_coordinador_1 = $_POST['txtid_usuario_coordinador_1']; 
        
    $SQLCuentas = "SELECT * FROM USUARIOS_EJECUTIVOS_ASIGNADOS WHERE ID_COORDINADOR='$axid_usuario_coordinador_1' ORDER BY NOM_USUARIO ASC";    
    $RSTipodocumentos=odbc_exec($con,$SQLCuentas);

    //echo $SQLCuentas;

        if(odbc_num_rows($RSTipodocumentos) > 0){       
            while($fila=odbc_fetch_array($RSTipodocumentos)){
                echo '<option value='.$fila['ID_EJECUTIVO'].'>'.utf8_encode($fila['NOM_USUARIO']).'</option>';
            }       
        } else {

            echo "";    
        
        }


    break;

case '9':
        
    $axid_usuario_coordinador_2 = $_POST['txtid_usuario_coordinador_2']; 
        
    $SQLCuentas = "SELECT * FROM USUARIOS_EJECUTIVOS_ASIGNADOS WHERE ID_COORDINADOR='$axid_usuario_coordinador_2' ORDER BY NOM_USUARIO ASC";    
    $RSTipodocumentos=odbc_exec($con,$SQLCuentas);

    //echo $SQLCuentas;

        if(odbc_num_rows($RSTipodocumentos) > 0){       
            while($fila=odbc_fetch_array($RSTipodocumentos)){
                echo '<option value='.$fila['ID_EJECUTIVO'].'>'.utf8_encode($fila['NOM_USUARIO']).'</option>';
            }       
        } else {

            echo "";    
        
        }




    break;

case '10':
    
    $axid_usuario_coordinador = $_POST['txtid_usuario_coordinador']; 
        
    $SQLCuentas = "SELECT * FROM USUARIOS_EJECUTIVOS_ASIGNADOS WHERE ID_COORDINADOR='$axid_usuario_coordinador' ORDER BY NOM_USUARIO ASC";    
    $RSTipodocumentos=odbc_exec($con,$SQLCuentas);

    //echo $SQLCuentas;

        if(odbc_num_rows($RSTipodocumentos) > 0){       
            while($fila=odbc_fetch_array($RSTipodocumentos)){
                echo '<option value='.$fila['ID_EJECUTIVO'].'>'.utf8_encode($fila['NOM_USUARIO']).'</option>';
            }       
        } else {

            echo "";    
        
        }

    break;

case '11':
    
    $axtipo_desviacion = $_POST['txttipo_desviacion_reasignar']; 
        
        $SQLCuentas = "SELECT * FROM MK_DESVIACIONES WHERE TIPO_DESVIACION='REASIGNADO' ORDER BY CAUSAS_DESVIACION ASC";    
        $RSTipodocumentos=odbc_exec($con,$SQLCuentas);


    //echo $SQLCuentas;

        if(odbc_num_rows($RSTipodocumentos) > 0){       
            while($fila=odbc_fetch_array($RSTipodocumentos)){
                echo '<option value='.$fila['ID_DESVIACION'].'>'.utf8_encode($fila['CAUSAS_DESVIACION']).'</option>';
            }       
        } else {

            echo "";    
        
        }

    break;

case '12':

    $axid_prospecto_dt = $_POST['txtid_prospecto_dt']; 
    $axID_COTIZACION_CZ = $_POST['txtID_COTIZACION_CZ']; 
    $axfecha_asignacion = $_POST['txtfecha_reasignacion']; 
    $axhora_asignacion = date('H:i',strtotime($_POST['txthora_reasignacion'])); 
    $axid_usuario_vendedor = $_POST['txtid_ejecutivo_ventas_reasiganr']; 
    $axid_desviacion = $_POST['txtid_desviacion_reasignar']; 
    $axtipo_desviacion = $_POST['txttipo_desviacion_reasignar']; 
    $axid_usuario_coordinador_2 = $_POST['txtid_usuario_coordinador_reasignar']; 

    $axnum_estado_prosp = get_row('MK_DESVIACIONES','ESTADO_PROSPECTO','ID_DESVIACION',$axid_desviacion);
    $axnom_ejecutivo = get_row('USUARIO','USUARIO','ID_USUARIO',$axid_usuario_vendedor);

    $sqlgrabar = "INSERT INTO MK_PROSPECTOS_DT (ID_COTIZACION_CZ,FECHA_ASIGNACION,HORA_ASIGNACION,ID_USUARIO,ID_DESVIACION) VALUES ('$axID_COTIZACION_CZ','$axfecha_asignacion','$axhora_asignacion','$axid_usuario_vendedor','$axid_desviacion')";
    $rsgrabar = odbc_exec($con,$sqlgrabar);
   // echo $sqlgrabar;

    if($rsgrabar){

        $fecha_actualizacion = ($nueva_fecha != '') ? "'$nueva_fecha'" : 'NULL';
        //$sql = "UPDATE tu_tabla SET tu_campo_fecha = $fecha_actualizacion WHERE tu_condicion_de_actualizacion";

        $sqlactualizar = "UPDATE MK_PROSPECTOS_CZ SET 
            ESTADO_PROSPECTO='$axnum_estado_prosp',
            NOM_EJECUTIVO='',
            ID_EJECUTIVO='',
            ID_USUARIO='$axid_usuario_coordinador_2',
                        
            ESTADO_SEGUIMIENTO_ACTUAL='',
            FECHA_SEGUIMIENTO_ACTUAL =$fecha_actualizacion,
            HORA_SEGUIMIENTO_ACTUAL =NULL,
            TIEMPO  ='N/A',
            INDICADOR  =NULL,
            FECHA_ASIGNACION_ACTUAL  =$fecha_actualizacion,
            HORA_ASIGNACION_ACTUAL   =NULL

            


            WHERE ID_COTIZACION_CZ='$axID_COTIZACION_CZ'";

        $rsactualizar = odbc_exec($con,$sqlactualizar);
        //echo $sqlactualizar;

        $respuesta =0;
        echo $respuesta;

    }else{

        $respuesta =1;
        echo $respuesta;
    }    

break;

case '13':

    $axid_empresa = $_POST['txtid_empresa']; 
    $nombrearchivo = get_row('EMPRESA','AUX_FILES','ID_EMPRESA',$axid_empresa);    

    //date_default_timezone_set("America/Lima");

    $axfecha= date("Y-m-d");

    $objPHPExcel = PHPExcel_IOFactory::load($nombrearchivo);    
    $objPHPExcel->setActiveSheetIndex(0);
    $numfilas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

    $SQLEliminar = "DELETE FROM MK_PROSPECTO_CZ_AUXILIAR";
    $RSliminar = odbc_exec($con,$SQLEliminar);
        
    for ($ind=1; $ind <=$numfilas ; $ind++) { 
            
            $a = $objPHPExcel->getActiveSheet()->getCell('A'.$ind)->getCalculatedValue();  //DESCRIPCION_PST
            $b = $objPHPExcel->getActiveSheet()->getCell('B'.$ind)->getCalculatedValue();  //PROYECTO
            $c = $objPHPExcel->getActiveSheet()->getCell('C'.$ind)->getCalculatedValue();  //MEDIO_CAPTACION
            $d = $objPHPExcel->getActiveSheet()->getCell('D'.$ind)->getCalculatedValue();  //CANAL
            $e = $objPHPExcel->getActiveSheet()->getCell('E'.$ind)->getCalculatedValue();  //COORDINADOR
            $f = $objPHPExcel->getActiveSheet()->getCell('F'.$ind)->getCalculatedValue();  //NUM_CELULAR_PST
            $g = $objPHPExcel->getActiveSheet()->getCell('G'.$ind)->getCalculatedValue();  //ESTADO_PROSPECTO

            $h1 = $objPHPExcel->getActiveSheet()->getCell('H'.$ind)->getCalculatedValue(); //FECHA_REG_PROSPECTO
                if($h1==""){
                    $h = '';
                }else{
                    $h = \PHPExcel_Style_NumberFormat::toFormattedString($h1, 'YYYY-MM-DD'); //Date of adoption
                }


            $i1 = $objPHPExcel->getActiveSheet()->getCell('I' . $ind)->getCalculatedValue(); // HORA_REG_PROSPECTO

                if ($i1 == "") {
                    $i = '';
                } else {
                    // Formato de hora en Excel: "HH:MM:SS"
                    $horaExcel = \PHPExcel_Style_NumberFormat::toFormattedString($i1, 'hh:mm:ss');
                    // Convertir la hora de Excel a un objeto DateTime
                    $dateTime = DateTime::createFromFormat('H:i:s', $horaExcel);
                    // Formatear la hora según sea necesario
                    $i = $dateTime ? $dateTime->format("H:i") : '';
                }

            $j = $objPHPExcel->getActiveSheet()->getCell('J'.$ind)->getCalculatedValue();  //TIPO_ASIGNACION
            $filtro = $objPHPExcel->getActiveSheet()->getCell('K'.$ind)->getCalculatedValue();  //FILTRO        
            
            if ($filtro == "PROSPECTOS") {

                $verif_py = get_row('MK_PROYECTOS','ID_PROYECTO','DESCRIPCION_PY',$b);
                if($verif_py==''){
                    $axobs_py='PROYECTO NO EXISTE';
                }
                $verif_medio = get_row('MK_MEDIO_CAPTACION','ID_MEDIO_CAPTACION','DESCRIPCION_MEDIO',$c);
                if($verif_medio==''){
                    $axobs_medio='MEDIO NO EXISTE';
                }
                $verif_canal = get_row('MK_CANALES','ID_CANAL','DESCRIPCION_CANAL',$d);
                if($verif_canal==''){
                    $axobs_canal='CANAL NO EXISTE';
                }
                $verif_coordinador = get_row('USUARIO','ID_USUARIO','USUARIO',$e);
                if($verif_coordinador==''){
                    $axobs_coord = 'COORDINADOR NO EXISTE';
                }

                $axobservaciones = $axobs_py.' '.$axobs_medio.' '.$axobs_canal.' '.$axobs_coord;

                $axcodigo_pst_cz = generateRandomCode();               

                    $sqlgrabar = "INSERT INTO MK_PROSPECTO_CZ_AUXILIAR (CODIGO_PST_CZ,DESCRIPCION_PST,ID_PROYECTO,ID_MEDIO_CAPTACION,ID_CANAL,ID_USUARIO,NUM_CELULAR_PST,ESTADO_PROSPECTO,FECHA_REG_PROSPECTO,HORA_REG_PROSPECTO,ID_EMPRESA,TIPO_ASIGNACION,OBSERVACION_AUXILIAR) VALUES ('$axcodigo_pst_cz','$a','$verif_py','$verif_medio','$verif_canal','$verif_coordinador','$f','$g','$h','$i','$axid_empresa','$j','$axobservaciones')";
                    //echo $sqlgrabar.'<br>';
                    $RSGrabar = odbc_exec($con,$sqlgrabar);  

                    $axobservaciones='';  
                    $axobs_py='';
                    $axobs_medio='';
                    $axobs_canal='';
                    $axobs_coord ='';   

            }

        }


    break;

case '14':

    $axid_empresa = $_POST['txtid_empresa']; 
    $sqllistar = "SELECT * FROM MK_PROSPECTO_CZ_AUXILIAR WHERE ID_EMPRESA='$axid_empresa' and OBSERVACION_AUXILIAR <> ''";
    $rslistar = odbc_exec($con,$sqllistar);

    if(odbc_num_rows($rslistar) > 0){

        echo " <table class='table table-hover table-sm'>
        <thead class='table-primary'>      
        <tr>
            <th style='text-align: center;'>Nº</th>                     
            <th style='text-align: left; width:40%;'>OBSERVACION_AUXILIAR</th>            
            <th style='text-align: center; width:10%;'>FECHA</th>            
            <th style='text-align: center;'>CELULAR</th>            
            <th style='text-align: center;'>PROYECTO</th>            
            <th style='text-align: center;'>MEDIO_CAPTACION</th>            
            <th style='text-align: center;'>CANAL</th>
            <th style='text-align: center;'>COORDINADOR</th>                        
            <th style='text-align: center;'>TIPO_ASIGNACION</th>            
            
        </tr>
    </thead>";

        while ($fila = odbc_fetch_array($rslistar)) {
            $it=$it+1;
            $axcodigo_pst_cz = $fila['CODIGO_PST_CZ'];
            $axfecha_reg_prospecto = $fila['FECHA_REG_PROSPECTO'];
            $axhora_reg_prospecto = $fila['HORA_REG_PROSPECTO'];
            $axnum_celular_pst = $fila['NUM_CELULAR_PST'];
            $axdescripcion_pst = $fila['DESCRIPCION_PST'];
            $axid_proyecto = $fila['ID_PROYECTO'];
            $axid_medio_captacion = $fila['ID_MEDIO_CAPTACION'];
            $axid_canal = $fila['ID_CANAL'];
            $axid_usuario = $fila['ID_USUARIO'];
            $axestado_prospecto = $fila['ESTADO_PROSPECTO'];
            $axtipo_asignacion = $fila['TIPO_ASIGNACION'];
            $axobservacion_auxiliar = $fila['OBSERVACION_AUXILIAR'];


            echo "<tr>
                <td style='text-align:center;'>$it</td>                
                <td style='text-align:left;width:40%;'>$axobservacion_auxiliar</td>
                <td style='text-align:center; width:10%;'>$axfecha_reg_prospecto</td>                
                <td style='text-align:center;'>$axnum_celular_pst</td>                
                <td style='text-align:center;'>$axid_proyecto</td>
                <td style='text-align:center;'>$axid_medio_captacion</td>
                <td style='text-align:center;'>$axid_canal</td>
                <td style='text-align:center;'>$axid_usuario</td>                
                <td style='text-align:center;'>$axtipo_asignacion</td>
                
            </tr>";
        }

        echo "</table>";

    }else{


        $SQLInsert = "INSERT INTO MK_PROSPECTOS_CZ (CODIGO_PST_CZ,DESCRIPCION_PST,ID_PROYECTO,ID_MEDIO_CAPTACION,ID_CANAL,ID_USUARIO,NUM_CELULAR_PST,ESTADO_PROSPECTO,FECHA_REG_PROSPECTO,HORA_REG_PROSPECTO,ID_EMPRESA,TIPO_ASIGNACION) SELECT CODIGO_PST_CZ,DESCRIPCION_PST,ID_PROYECTO,ID_MEDIO_CAPTACION,ID_CANAL,ID_USUARIO,NUM_CELULAR_PST,ESTADO_PROSPECTO,FECHA_REG_PROSPECTO,HORA_REG_PROSPECTO,ID_EMPRESA,TIPO_ASIGNACION FROM MK_PROSPECTO_CZ_AUXILIAR";
        $RSInsert = odbc_exec($con,$SQLInsert);

        if($RSInsert){
            $respuesta =0;
            echo $respuesta;
        }else{
            $respuesta =1;
            echo $respuesta;
        }

    }

    

break;

case '107':
	
	$axbuscar_dato =$_POST['txtbeneficiario_buscar'];
   
    if(isset($_POST["txtbeneficiario_buscar"])){

	$output ="";
	$idprov ="";
	$sqlemisor = "SELECT TOP 30 * FROM BENEFICIARIOS WHERE RAZON_SOCIAL LIKE  '%".$axbuscar_dato."%' ORDER BY RAZON_SOCIAL ASC";
	//echo $sqlemisor;
    echo '<script language="javascript">console.log("'.$sqlemisor.'");</script>';

	$rsemisor=odbc_exec($con,$sqlemisor);	
	$output ="<ul class='list-group'>";  		

	if(odbc_num_rows($rsemisor) > 0){
		 while ($row=odbc_fetch_array($rsemisor)){		
		 	$id =  $row["ID_BENEFICIARIO"];
		 	$axbeneficiario =  trim($row["RAZON SOCIAL"]);

		 	$output .="<a href='#' id='btn_lista_beneficiarios' class='list-group-item list-group-item-action' style='background:#DAF5FF;' data-id='$id' data-beneficiario='$axbeneficiario'>".utf8_encode(trim($row["RAZON_SOCIAL"]))."</a>";
		 }

	}else{
		
		$output .="<a href='#' class='list-group-item list-group-item-action bg-danger'></a>";
	
	}

	$output .="</ul>";
	echo $output;

    }else{
        echo $output;	
    }

break;

}




function calcularTiempoEIndicador($estado, $fechaAsignacion, $horaAsignacion, $fechaSeguimiento, $horaSeguimiento, $idprospecto) {
    date_default_timezone_set("America/Lima");
    global $con;

    if ($estado === 'ASIGNADO') {
        $fechaHoraAsignacion = new DateTime("$fechaAsignacion $horaAsignacion");

        if (!empty($fechaSeguimiento) && !empty($horaSeguimiento)) {
            $fechaHoraSeguimiento = new DateTime("$fechaSeguimiento $horaSeguimiento");
        } else {
            // Si no hay fecha ni hora de seguimiento, usar la hora del sistema
            $fechaHoraSeguimiento = new DateTime();
        }

        $intervalo = $fechaHoraSeguimiento->diff($fechaHoraAsignacion);
        $minutosTotales = ($intervalo->days * 24 * 60) + ($intervalo->h * 60) + $intervalo->i;

        // Lógica para determinar el indicador según el tiempo
        if ($minutosTotales <= 30) {
            $minutosTotales_guardar = $minutosTotales.' min';
            $indicador = '1';
        } elseif ($minutosTotales > 30 && $minutosTotales <= 60) {
            $minutosTotales_guardar = $minutosTotales.' min';
            $indicador = '2';
        } elseif ($minutosTotales > 60 && $minutosTotales <= 180) {
            $minutosTotales_guardar = $minutosTotales.' min';
            $indicador = '3';
        } elseif ($minutosTotales > 180 && $minutosTotales <= 1440) {
            $minutosTotales_guardar = $minutosTotales.' min';
            $indicador = '4';
        } else {
            $dias = '1 dia a mas';
            $minutosTotales_guardar = $dias;
            $indicador = '5';
        }

        $sqlactualizar = "UPDATE MK_PROSPECTOS_CZ SET TIEMPO='$minutosTotales_guardar', INDICADOR='$indicador' WHERE ID_COTIZACION_CZ='$idprospecto'";
        $rsactualizar = odbc_exec($con, $sqlactualizar);

        // Devolver el resultado después de actualizar la base de datos
        if ($minutosTotales <= 30) {
            return array("TIEMPO" => "$minutosTotales min", "INDICADOR" => '<i class="bi bi-emoji-smile-fill text-success" style="font-size:20px;"></i>'); // Verde
        } elseif ($minutosTotales > 30 && $minutosTotales <= 60) {
            return array("TIEMPO" => "$minutosTotales min", "INDICADOR" => '<i class="bi bi-emoji-neutral-fill text-warning" style="font-size:20px;"></i>'); // Amarillo
        } elseif ($minutosTotales > 60 && $minutosTotales <= 180) {
            return array("TIEMPO" => "$minutosTotales min", "INDICADOR" => '<i class="bi bi-emoji-frown-fill text-danger" style="font-size:20px;"></i>'); // Rojo
        } elseif ($minutosTotales > 180 && $minutosTotales <= 1440) {
            return array("TIEMPO" => "$minutosTotales min", "INDICADOR" => '<i class="bi bi-emoji-angry-fill text-dark" style="font-size:20px;"></i>'); // Negro
        } else {
            return array("TIEMPO" => "$dias", "INDICADOR" => '<i class="bi bi-emoji-dizzy-fill text-primary" style="font-size:20px;"></i>'); // Azul
        }
    } else {
        // Otro caso (puedes ajustar según tus requisitos)
        $sqlactualizar = "UPDATE MK_PROSPECTOS_CZ SET TIEMPO='N/A', INDICADOR='6' WHERE ID_COTIZACION_CZ='$idprospecto'";
        $rsactualizar = odbc_exec($con, $sqlactualizar);
        return array("TIEMPO" => "N/A", "INDICADOR" => ''); // Por ejemplo, N/A si no está asignado o en otro estado
    }
}





function contarRegistros($nombreTabla) {
    
    global $con;
    $querysql="SELECT COUNT(*) as total FROM $nombreTabla";
    $query=odbc_exec($con,$querysql);
    $rw=odbc_fetch_array($query);
    $value=$rw['total'];
    return $value;


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


