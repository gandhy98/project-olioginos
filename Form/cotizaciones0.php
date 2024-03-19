<?php require_once '../includes/header.php';?>

<!DOCTYPE html>
	<html>
	<head>
		
		 
	</head>
	
	<style type="text/css">

		/* Agrega estos estilos para personalizar la barra de progreso */
        progress {
            width: 100%;
            margin-top: 10px;
            align-items: left;
        }

        /* Estilo inicial de la barra de progreso */
        progress[value] {
            /* Cambia el color base de la barra de progreso */
            background-color: #ddd;
        }

        /* Estilo de la barra de progreso durante la carga */
        progress::-webkit-progress-value {
            /* Cambia el color de la barra de progreso en carga */
            background-color: red; /* Cambia al color que desees */
        }

        /* Estilo de la barra de progreso al completar la carga */
        progress[value="100"]::-webkit-progress-value {
            /* Cambia el color de la barra de progreso cuando está completa */
            background-color: green;
        }

        .custom-border {
		    border-width: 2px; /* Ancho del borde */
		    border-style: solid; /* Tipo de borde */
		    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Estilo de sombra */

		}

		.img-prospecto {
        width: 100%; /* o el ancho deseado */
        height: 150px; /* o la altura deseada */
        object-fit: cover; /* Esto asegura que la imagen se ajuste sin distorsión */
    	}

		.grafico_proyeccion-container {
		  display: flex;
		  align-items: center;
		  justify-content: center;
		  height: 100vh;
		}

		.grafico_proyeccion {
		  width: 400px;
		  height: 300px;
		}

		#grafico_proyeccion {
		  width: 300px;
		  height: 300px;
		}
		
		#chart-container {
		    width: 80%;
		    margin: 0 auto;
		    padding: 20px;
		    border: 1px solid #ccc;
		}

		#chart {
		    height: 400px;
		}



	</style>
	
	<!--img src="../img/empresa.PNG" style="opacity: 0.2;"-->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<input type="hidden" name="txtparametros" id="txtparametros">	
	<input type="hidden" name="txtparametros_detalle" id="txtparametros_detalle" value="0">
	<input type="hidden" name="txtparametros_producto" id="txtparametros_producto">	
	<input type="hidden" name="txtid_usuario" id="txtid_usuario" value="<?php echo "$axid_usuario";?>">
	<input type="hidden" name="txtid_empresa" id="txtid_empresa" value="<?php echo "$axidempresa";?>">	
	<input type="hidden" class="form-control" id="txtid_prospecto_dt">	
	<input type="hidden" class="form-control" id="txtfecha_actual" value="<?php echo "$diaactual";?>" >
	<input type="hidden" class="form-control" id="txtndias" value="<?php echo "$ndias";?>" >
	<input type="hidden" name="txttipoorden" id="txttipoorden">
	<input type="hidden" name="txttipoorden_numero" id="txttipoorden_numero">
	
	<input type="hidden" name="txttipoorden_rango" id="txttipoorden_rango">
	<input type="hidden" name="txtorden" id="txtorden">	
	<input type="hidden" name="txtid_usuario_coordinador_1" id="txtid_usuario_coordinador_1">	

	<input type="hidden" class="form-control" id="txtid_prospecto_cz">
	<input type="hidden" class="form-control" id="txtcodigo_pst_cz">
	<input type="hidden" class="form-control" id="txtcod_cliente_pst">
	<input type="hidden" class="form-control" id="txthora_reg_prospecto">  

	<input type="hidden" class="form-control" id="txtnom_cliente">  
	<input type="hidden" class="form-control" id="txtnom_prospecto">  

	<input type="hidden" id="txtnom_tabla" value='COTIZACION_REPORTE_CZ'>	
	<input type="hidden" id="txttipo_busqueda">	
	<input type="hidden" id="txtcampo_contenido">	
	<input type="hidden" id="txtcampo_tabla">	
	<input type="hidden" id="txtcampo_tabla_orden">	

	<input type="hidden" id="txtpermiso_editar">		
	

	<body onload="mueveReloj()">
	
	<div class="card" style="padding: 10px;">
  	<div class="card-header" >


  		<div class="row g-3" id="div_buscar_py">

  			<div class="col-md-4">
  				<h5 id="titulo_formulario"></h5>
  			</div>

  			<div class="col-md-5" style="text-align:left;">

  				<div class="btn-group W-400" role="group">
       				<div class="dropdown">	            				
				  	<button type="button" class="btn btn-link dropdown" id="div_btn_filtrar" style="text-decoration: none;" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
				    Filtrar
				  	</button>
				  	<form class="dropdown-menu p-2">
			  		<ul class="list-group list-group-flush" id='div_filtros' style="font-size: 12px;"></ul>					
					</form>
					</div>
				</div>
							
	            <div class="btn-group" role="group">
	            	<div class="dropdown">	            				
					<button type="button" class="btn btn-link dropdown" id="div_btn_ordenar" style="text-decoration: none;" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
					Ordenar
					</button>
					<form class="dropdown-menu p-4">
						<ul class="list-group list-group-flush" id='div_ordenar' style="font-size: 12px;"></ul>					
					</form>
					</div>
				</div>

				<div class="btn-group" role="group">
	            	<div class="dropdown">	            				
					<button type="button" class="btn btn-link dropdown" id="div_btn_importar" class='btn btn-outline-success btn-sm' data-bs-toggle='modal' data-bs-target='#mdl_importar_data' style="text-decoration: none;" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
					Importar
					</button>
					<!--form class="dropdown-menu p-4">
						<ul class="list-group list-group-flush" id='div_ordenar' style="font-size: 12px;"></ul>					
					</form-->
					</div>
				</div>			
			</div>

			<div class="col-md-3"  >
				<div class="input-group mb-3">	
				<input type="text" class="form-control" id="txtbuscar_prospectos" placeholder="Buscar "oninput="convertirAMayusculas(this)">
			    <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
				</div>
			</div> 

		</div>

		<div class="row g-3" style="text-align: center;">			 		
		
			<div class="col-md-3">
				<div class="input-group">
			  	<span class="input-group-text" id="basic-addon1">Fec. Inicio</span>
			  	<input type="date" class="form-control" id="txtfecha_reg_prospecto" placeholder="Fec. Actual" value="<?php echo "$diaactual";?>" >
				</div>
			</div>
			<div class="col-md-3">
				<div class="input-group">
			  	<span class="input-group-text" id="basic-addon1">Fec. Fin</span>
			  	<input type="date" class="form-control" id="txtfecha_al" placeholder="Fec. Final" value="<?php echo "$diaactual";?>" >
				</div>
			</div>
			<div class="col-md-3">
				<form name="form_reloj">
				<div class="input-group">
				<span class="input-group-text" id="basic-addon1">Hora</span>
				<input type="text" class="form-control text-danger" id="reloj" name="reloj" placeholder="Hora">			
				</div>
				</form>					  
			</div>
		
		</div>   
  	</div>
  	<br>
  	<div class="card text-center">
	  <div class="card-header" >
	    <ul class="nav nav-tabs card-header-tabs">
	      <li class="nav-item">
	        <a class="nav-link active" id="pn_listado_prospectos" href="#"> <i class="bi bi-list-columns-reverse"></i> Listado</a>	        
	      </li>
	      <li class="nav-item">
	        <a class="nav-link " id="pn_dasboard_prospectos" aria-current="true" href="#" hidden>  <i class="bi bi-clipboard-data-fill"></i> Dashboard</a>
	      </li>	      
	    </ul>
	  </div>
	  <div class="card-body">
	    
	  	<div id="div_dasboard_prospectos" hidden>
	      	<div class="row">
      		
	          <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4" style="padding: 5px;">	  		
			  
			    <div class="card">
			      <div class="card-body">
			      	<div class="row g-3" id="div_form_proyeccion">
			      			

						<div class="col-md-3">
						<div class="form-floating">				
						<input type="text"  class="form-control" id="txtproyeccion" placeholder="PROYECCION"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
						<label for="txtproyeccion" style="font-size:10px;" class="text-primary"><b> PROYECCION </b></label>
						</div>
						</div>

						<div class="col-md-3">
						<div class="form-floating">				
						<input type="text" class="form-control" id="txtcumplimiento" placeholder="CUMPLIMIENTO"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
						<label for="txtcumplimiento" style="font-size:10px;" class="text-success"><b> CUMPLIMIENTO </b></label>
						</div>
						</div>

						<div class="col-md-3">
						<div class="form-floating">				
						<input type="text" class="form-control" id="txtpendiente" placeholder="PENDIENTE"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
						<label for="txtpendiente" style="font-size:10px;" class="text-warning"><b> PENDIENTE </b></label>
						</div>
						</div>

						<div class="col-md-3">
						<div class="form-floating">				
						<input type="text" class="form-control" id="txtmejoras" placeholder="MEJORAS"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
						<label for="txtmejoras" style="font-size:10px;" class="text-secondary"><b> MEJORAS </b></label>
						</div>
						</div>
			      	
			      	</div>

			        <canvas id="grafico_proyeccion"></canvas>	
			      </div>
			    </div>
			  </div>
			  <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4" style="padding: 5px;">	  		
			  
			    <div class="card">
			      <div class="card-body">
			        <canvas id="grafico_barras_horizontales"></canvas>	
			      </div>
			    </div>
			  </div>
			  <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4" style="padding: 5px;">	  		
			    <div class="card">
			      <div class="card-body">
			        <canvas id="histograma_cumplimiento"></canvas>	
			      </div>
			    </div>
			  </div>
			</div>

	      	

	  	</div>


	  	<div id="div_listado_prospectos">



 			<div class="table-responsive" style="font-size: 13px;" id="div_listar_prospectos"></div>
	  	</div>

	  </div>
	</div>

	

	  
	  <div id="div_form_prospectos" hidden>

	  	
	  	<input type="hidden" class="form-control" id="txtnombres_cliente_pst">
	  	<input type="hidden" class="form-control" id="txtpaterno_cliente_pst">
	  	<input type="hidden" class="form-control" id="txtmaterno_cliente_pst">  	
	  		
	  	

			
			<div class="row">			  
			  	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 12px;">	  
			    <div class="card">
			    	<div class="card-header bg-primary text-white">
			    		<h5 >Datos de la cotización:</h5>
			    	</div>
			      <div class="card-body">
			        

			      </div>
			    </div>
			  </div>

			  <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6" style="padding: 12px;" hidden>	  
			  
			    <div class="card">
			    	<div class="card-header bg-primary text-white">
			    		<h5 >Datos del Cliente</h5>
			    	</div>

			      <div class="card-body">			        
			        

			        


			      </div>
			    </div>
			  </div>

			  <div id="div_botones_formulario" style="text-align: right;">
			  		
			  		

			  </div>

			</div>





		</div>					

	  </div>

  	</div>

  	<!-------------------------------------->
	
	<!-- Botón de ayuda con ícono de Bootstrap -->
    <button class="help-button" id="help-button" data-bs-toggle='modal' data-bs-target='#modal_listar_videos'>
        <i class="bi bi-question-circle"></i>
    </button>

    <!-- Contenedor del texto emergente -->
    <div class="help-tooltip" id="help-tooltip">
        Haz clic para ayudarte
    </div>

	</div>
	

</body>

<!-- Modal -->
<div class="modal fade" id="mdl_registrar_prospectos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Datos del prospecto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      	<div class="row g-3">

		  <div class="col-md-6">
				<div class="form-floating">
				<input type="text" class="form-control campo"  onkeydown="siguienteCampo(event)"  id="txtnum_cotizacion" placeholder="Nro. Cotización">
				<label for="txtnum_cotizacion"><b><i class="bi bi-phone-vibrate-fill"></i> Nro. Cotización</b></label>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-floating">
				<input type="date" class="form-control campo"  onkeydown="siguienteCampo(event)"  id="txtfecha_cotizacion" placeholder="Fecha Cotización">
				<label for="txtfecha_cotizacion"><b><i class="bi bi-calendar-event"></i> Fecha Cotización</b></label>
				</div>
			</div>

		  	<div class="col-md-5">
			<div class="form-floating">
				
				<input type="text" class="form-control campo"  onkeydown="siguienteCampo(event)"   id="txtbeneficiario_buscar" placeholder="Beneficiario">
				<label for="txtbeneficiario_buscar"><b>Beneficiario</b></label>
			</div>
			<div id="div_beneficiarios"></div>
			</div>    
			<input type="text"  id="txtid_beneficiario" hidden>



			<div class="col-md-3">
			<div class="form-floating">
				
				<input type="text" class="form-control campo"  onkeydown="siguienteCampo(event)"  id="txtidentificacion" placeholder="Núm. de Doc. identificación">
				<label for="txtidentificacion"><b>Doc. Identificación</b></label>
			</div>
			</div>


			<div class="col-md-4">
				<div class="form-floating">
				<input type="text" class="form-control campo"  onkeydown="siguienteCampo(event)"  id="txtnum_celular_pst" placeholder="Celular">
				<label for="txtnum_celular_pst"><b><i class="bi bi-phone-vibrate-fill"></i> Celular</b></label>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-floating">
				<select class="form-select campo" id="txtid_locales" onkeydown="siguienteCampo(event)" aria-label="Floating label select example">				        
				<option value=0 selected>Seleccionar</option>
				<?php while($fila=odbc_fetch_array($rslocales)) {?>
				<option value="<?php echo $fila['ID_LOCAL'];?>"><?php echo $fila['RAZON_SOCIAL'];?></option><?php } ?>
				</select>
				<label for="txtid_locales"><b>Local</b></label>
				</div>
			</div>
			
			<div class="col-md-6" id="divid_vendedor">
				<div class="form-floating">
				<select class="form-select campo" onkeydown="siguienteCampo(event)"  id="txtid_vendedor" aria-label="Floating label select example">				        
				<option selected>Seleccionar</option>
				<?php while($fila=odbc_fetch_array($RSVendedores)) {?>
				<option value="<?php echo $fila['ID_USUARIO'];?>"><?php echo $fila['NOM_USUARIO'];?></option><?php } ?>
				</select>
				<label for="txtid_vendedor"><b>Vendedor</b></label>
				</div>
			</div>	

			
			<div class="col-md-4" >		
				<div class="form-floating">
				<select class="form-select campo" onkeydown="siguienteCampo(event)"  id="txtestado_prospecto" aria-label="Floating label select example">
				<option value="PENDIENTE">PENDIENTE</option>
				<option value="COTIZADO">COTIZADO</option>															
				<option value="CERRADO">CERRADO</option>													
				</select>
				<label for="txtestado_prospecto"><b><i class="bi bi-person-check-fill"></i> Estado actual</b></label>
				</div>
			</div>
		
			<div class="col-md-4" >		
				<div class="form-floating">
				<select class="form-select campo" onkeydown="siguienteCampo(event)" id="txtforma_pago" aria-label="Floating label select example">
				<option value="CONTADO">CONTADO</option>
				<option value="DEPOSITO EN CUENTA">DEPOSITO EN CUENTA</option>															
				<option value="TARJETA">TARJETA</option>													
				</select>
				<label for="txtforma_pago"><b><i class="bi bi-person-check-fill"></i> Forma de pago</b></label>
				</div>
			</div>

			<div class="col-md-4" >		
			<div class="form-floating">
				<input type="date" class="form-control campo"  onkeydown="siguienteCampo(event)"  id="txtfecha_vencimiento" placeholder="Fecha vencimiento">
				<label for="txtfecha_vencimiento"><b><i class="bi bi-calendar-event"></i> Fecha Vencimiento</b></label>
				</div>
			</div>

			<div class="col-md-12" >		
			<div class="form-floating">
				<input type="text" class="form-control campo"  onkeydown="siguienteCampo(event)"  id="txtcomentarios" placeholder="Fecha vencimiento">
				<label for="txtcomentarios"><b><i class="bi bi-chat-left-text"></i> Comentarios</b></label>
				</div>
			</div>

		</div>	


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-success btn-sm campo" data-bs-dismiss="modal" id="btn_agregar_prospecto"><i class="fas fa-save"></i> Agregar</button>
		<button type="button" class="btn btn-outline-primary btn-sm"  id="btn_reniec" hidden><img src="../icon/reniec.png" style="width:15px;"> RENIEC</button>
		<button type="button" class="btn btn-outline-primary btn-sm"  id="btn_sunat_buscar" hidden><img src="../icon/sunat.png" style="width:30px;"> SUNAT</button>
		<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal" id="btn_cerrar_form_prosp"><i class="bi bi-arrow-return-left"></i> Retornar</button>


      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="mdl_asignar_prospectos_dt" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="titulo_modal"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="div_form_prospectos_asignar">

      	 <div class="row g-3">      	 	

			<div class="col-md-6">
				<div class="form-floating">
				<input type="date" class="form-control" id="txtfecha_asignacion" placeholder="Fecha Registro" value="<?php echo "$diaactual";?>" >
				<label  for="txtfecha_asignacion"><b><i class="bi bi-calendar-date-fill"></i> Fecha Registro</b></label>
				</div>					  
			</div>	

			<div class="col-md-6">
				<form name="form_reloj_1">
				<div class="form-floating">
				<input type="text" class="form-control text-danger" id="txthora_asignacion" name="txthora_asignacion" placeholder="Hora">
				<label  for="reloj"><b><i class="bi bi-clock-fill"></i> Hora</b></label>
				</div>
				</form>					  
			</div>

			<div class="col-md-12" id="div_usuario_coordinador_2">		
				<div class="form-floating">
				<select class="form-select" id="txtid_usuario_coordinador_2" aria-label="Floating label select example">		
				<option value="">Seleccionar</option>
				<?php while($fila=odbc_fetch_array($rsuser_coordinador_1)) {?>
				<option value="<?php echo $fila['ID_USUARIO'];?>"><?php echo $fila['NOM_USUARIO'];?></option><?php } ?>
				</select>
				<label for="txtid_usuario_coordinador_2"><b><i class="bi bi-person-check-fill"></i> Equipo de venta</b></label>
				</div>
			</div>


			<div class="col-md-12" >		
				<div class="form-floating">
				<select class="form-select" id="txtid_ejecutivo_ventas" aria-label="Floating label select example"></select>
				<label for="txtid_ejecutivo_ventas"><b><i class="bi bi-person-lines-fill"></i> Ejecutivo de Ventas</b></label>
				</div>
			</div>

			<div class="col-md-12" >		
				<div class="form-floating">
				<select class="form-select" id="txttipo_desviacion" aria-label="Floating label select example">		
				<option value="">Seleccionar</option>
				<?php while($fila=odbc_fetch_array($rsasig_desviacion)) {?>
				<option value="<?php echo $fila['TIPO_DESVIACION'];?>"><?php echo $fila['TIPO_DESVIACION'];?></option><?php } ?>
				</select>
				<label for="txttipo_desviacion"><b><i class="bi bi-list-check"></i> Estado Asignación</b></label>
				</div>
			</div>

			<div class="col-md-12" id="div_tipos_reasignacion" hidden>		
				<div class="form-floating">
				<select class="form-select" id="txtid_desviacion" aria-label="Floating label select example"></select>
				<label for="txtid_desviacion" id='etiqueta_motivos'><b><i class="bi bi-list-check"></i> Detalle </b></label>
				</div>
			</div>

		</div>
        
    </div>
    <div class="modal-footer">
      	<button type="button" class="btn btn-outline-success" id="btn_grabar_asignacion" data-bs-dismiss="modal"><i class="bi bi-floppy-fill"></i> Grabar</button>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="bi bi-door-closed-fill"></i> Cerrar</button>
    </div>

    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="mdl_reasignar_prospectos_dt" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="titulo_modal">REASIGNACION DE PROSPECTO</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="div_form_prospectos_asignar">

      	 <div class="row g-3">  

      	 <input type="hidden" class="form-control text-danger" id="txtid_usuario_coordinador_reasignar" name="txtid_usuario_coordinador_reasignar">    	 	
      	 <input type="hidden" class="form-control text-danger" id="txtid_ejecutivo_ventas_reasiganr" name="txtid_ejecutivo_ventas_reasiganr">    	 	

			<div class="col-md-6">
				<div class="form-floating">
				<input type="date" class="form-control" id="txtfecha_reasignacion" placeholder="Fecha Registro" value="<?php echo "$diaactual";?>" >
				<label  for="txtfecha_asignacion"><b><i class="bi bi-calendar-date-fill"></i> Fecha Registro</b></label>
				</div>					  
			</div>	

			<div class="col-md-6">
				<form name="form_reloj_2">
				<div class="form-floating">
				<input type="text" class="form-control text-danger" id="txthora_reasignacion" name="txthora_reasignacion" placeholder="Hora">
				<label  for="reloj"><b><i class="bi bi-clock-fill"></i> Hora</b></label>
				</div>
				</form>					  
			</div>

			<div class="col-md-12" >		
				<div class="form-floating">
				<input type="text" class="form-control text-danger" id="txtnom_ejecutivo" name="txtnom_ejecutivo" disabled>    	 	
				<label for="txtnom_ejecutivo"><b><i class="bi bi-person-lines-fill"></i> Ejecutivo de Ventas</b></label>
				</div>
			</div>

			<div class="col-md-12" >		
				<div class="form-floating">
				<select class="form-select" id="txttipo_desviacion_reasignar" aria-label="Floating label select example" disabled>		
				<option value="">Seleccionar</option>
				<?php while($fila=odbc_fetch_array($rsasig_desviacion_reasignacion)) {?>
				<option value="<?php echo $fila['TIPO_DESVIACION'];?>"><?php echo $fila['TIPO_DESVIACION'];?></option><?php } ?>
				</select>
				<label for="txttipo_desviacion"><b><i class="bi bi-list-check"></i> Estado Asignación</b></label>
				</div>
			</div>

			<div class="col-md-12">		
				<div class="form-floating">
				<select class="form-select" id="txtid_desviacion_reasignar" aria-label="Floating label select example"></select>
				<label for="txtid_desviacion" id='etiqueta_motivos'><b><i class="bi bi-list-check"></i> Detalle </b></label>
				</div>
			</div>

		</div>
        
    </div>
    <div class="modal-footer">
      	<button type="button" class="btn btn-outline-success" id="btn_grabar_reasignacion" data-bs-dismiss="modal"><i class="bi bi-floppy-fill"></i> Grabar</button>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="bi bi-door-closed-fill"></i> Cerrar</button>
    </div>

    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="mdl_importar_data" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Importación de data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      	<div class="container">
		    <h5 class="text-success">Subir archivo de excel <a href="../Archivos/080124 DATA_CARGA_PROSPECTOS.xlsx" type="button" class="btn btn-outline-success btn-sm"><i class="bi bi-file-earmark-excel-fill"></i> Archivo Modelo de carga</a></h5>
		    <form id="uploadForm" enctype="multipart/form-data">
		        
		        <!--label for="fileInput">Selecciona una imagen:</label>
		        <input type="file" name="fileInput" id="fileInput" accept="image/*"-->

		        <div class="input-group mb-3">
						  <!--label class="input-group-text" for="inputGroupFile01">Selecciona una imagen</label-->
						  <!--input type="file" class="form-control" name="fileInput" id="fileInput" accept="image/*"-->
						  <input type="file" class="form-control" name="fileInput" id="fileInput" accept=".xlsx, .xls, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
						</div>

		        <input type="hidden" name="txtid_empresa_file" id="txtid_empresa_file">
		        <input type="hidden" name="txttipo_archivo" id="txttipo_archivo" value="EXCEL">

		        <div id="div_btn_subir">
		            <button type="button" class="btn btn-outline-primary btn-sm" id="btn_subir_excel" onclick="uploadFile()"><i class="bi bi-cloud-arrow-up-fill"></i> Subir</button>		            
		            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal" onclick="limpiarContenedor_subir()"><i class="bi bi-arrow-return-left"></i> Retornar</button>		            
		        </div>

		        <div aria-label="Example with label">
		            <progress class="progress" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" value="0" max="100" id="progressBar"></progress>
		        </div>

		        <div id="output"></div>
		    </form>
		</div>

		<div  class="table-responsive" style="font-size:10px; " id="div_listar_carga"></div>

      </div>
      <div class="modal-footer">
      	
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="mdl_ver_actividad" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Actividades del prospecto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div  class="table-responsive" id="div_actividades_del_prospecto"></div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="bi bi-door-closed-fill"></i> Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_listar_videos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Videos tutoriales</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">      	
      	<input type="hidden" name="txtmodulo" id="txtmodulo">
        <div class="list-group" id="div_listar_videos_tutoriales"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>        
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_detalle_cotizacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Cotización</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		<div id="cabecera_cotizacion"></div>
      </div>
      <div class="modal-body">      	
      	<input type="hidden" name="txtmodulo" id="txtmodulo">
        <div class="list-group" id="detalles_cotizacion">asdfasdfasdf</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>        
      </div>
    </div>
  </div>
</div>

</html>	

<script type="text/javascript">
var varid_beneficiario;
$(document).ready(function() {	
	
	Verifica_permiso()
	listar_prospectos();
	/*
	var fechaActual = $("#txtfecha_actual").val()
    var diasArestar = $("#txtndias").val()
   	var nuevaFecha = restarDiasYFormatear(fechaActual, diasArestar);
    $("#txtfecha_reg_prospecto").val(nuevaFecha);
    */
	
 });
/****************************/
$(document).on("click","#btn_editar_detalles",function(){
	//alert("enrta aqui");
	
});
$('#txtbeneficiario_buscar').keyup(function(){

	var axbuscar_dato = $("#txtbeneficiario_buscar").val();
	console.log("entra aqui");

	if (axbuscar_dato != '') {

	$.ajax({
		url:"cotizaciones_funciones.php",
		method: "POST",
		data: {param:107,txtbeneficiario_buscar:axbuscar_dato},

		success : function(data){

			$('#div_beneficiarios').fadeIn();
		$('#div_beneficiarios').html(data);
		}
	});

	}else{
		$("#div_beneficiarios").fadeOut();
	} 
 });

$(document).on("click","#btn_lista_beneficiarios",function(){

	//var axdistrito_buscar = $(this).text()
	var axbeneficiario = $(this).data('beneficiario')
	console.log($(this).data());
	//var axubigeo_alter = $(this).data('id')

	//alert(axbeneficiario);
	$("#txtbeneficiario_buscar").val(axbeneficiario);

	$("#div_beneficiarios").fadeOut();

	asql="select * from beneficiarios where id_beneficiario="+$(this).data('id');
	console.log(asql);
	regresamatrizjsonasync(asql,"beneficiarioelegido");
	$('#txtidentificacion').val(beneficiarioelegido[0].RUC_BENEF);
	$('#txtnum_celular_pst').val(beneficiarioelegido[0].TELEFONO);
	varid_beneficiario=$(this).data('id');
	$("#txtid_beneficiario").val(beneficiarioelegido[0].ID_BENEFICIARIO);
	//siguienteCampo(event);


 });

$(document).on("blur","#txtidentificacion",function(){
	asql="select top 1 * from beneficiarios where RUC_BENEF="+$(this).val();
	regresamatrizjsonasync(asql,"beneficiarioelegido");
	$("#txtbeneficiario_buscar").val(beneficiarioelegido[0].RAZON_SOCIAL);
	$("#txtnum_celular_pst").val(beneficiarioelegido[0].TELEFONO);
	varid_beneficiario=beneficiarioelegido[0].ID_BENEFICIARIO;
	$("#txtid_beneficiario").val(beneficiarioelegido[0].ID_BENEFICIARIO);

 })

$(document).on("click","#btn_prospectos_todos",function(){
	
	$("#txttipoorden").val($(this).data('tipoorden'))		
	listar_prospectos()		
 } )

$(document).on("click","#btn_buscar_campo_contenido",function(){
	
	$("#txtcampo_contenido").val($(this).data('campo_contenido'))		
	listar_prospectos()		
 })

$(document).on("click","#btn_ordenar_campo",function(){
	$("#txtorden").val($(this).data('order'))
	$("#txtcampo_tabla_orden").val($(this).data('campo_tabla_orden'))	
	$("#txttipoorden").val('')		
	listar_prospectos()
 })

function listar_filtros(){

	var axid_empresa = $("#txtid_empresa").val()
	var axnom_tabla = $("#txtnom_tabla").val()
	var axcampo = $("#txtcampo_tabla").val()	

	$.ajax({
		url:"perfil_usuarios_funciones.php",
		method: "POST",
		data: {param:27,txtid_empresa:axid_empresa,txtnom_tabla:axnom_tabla,txtcampo_tabla:axcampo},
		success : function(data){		
				$("#div_filtros").html(data)			
			
		}
	})

 }

$(document).on("click","#btn_filtrar_campo_tabla",function(){
	
	$("#txttipo_busqueda").val('FILTRAR')
	$("#txtcampo_tabla").val($(this).data('campo_tabla'))
	$("#txttipoorden").val('')	
	listar_filtros()

 })

$(document).on("click","#div_btn_ordenar",function(){
	
	$("#txttipo_busqueda").val('ORDENAR')
	$("#txttipoorden").val('')	
	listar_filtros_orden()

 })

$(document).on("click","#div_btn_filtrar",function(){
	
	$("#txttipo_busqueda").val('FILTRAR')
	listar_filtros_orden()

 })

function listar_filtros_orden(){

	var axid_empresa = $("#txtid_empresa").val()
	var axnom_tabla = $("#txtnom_tabla").val()
	var axtipo_busqueda = $("#txttipo_busqueda").val()	


	$.ajax({
		url:"perfil_usuarios_funciones.php",
		method: "POST",
		data: {param:26,txtid_empresa:axid_empresa,txtnom_tabla:axnom_tabla,txttipo_busqueda:axtipo_busqueda},
		success : function(data){	

			if(axtipo_busqueda=='FILTRAR'){
				$("#div_filtros").html(data)	
			}else if(axtipo_busqueda=='ORDENAR'){
				$("#div_ordenar").html(data)	
			}
			
			
			
		}
	})

 }

/***********************************/

$(document).on("click","#btn_refresh",function(){

	listar_prospectos()
 })
function listar_carga() {

 var axid_empresa = $("#txtid_empresa").val();

 $.ajax({
      url:"cotizaciones_funciones.php",
      method: "POST",
      data: {param:14,txtid_empresa:axid_empresa},
      success : function(data){    
      	if(data==0){
      		listar_prospectos();      		
      		$('#mdl_importar_data').modal('hide')
      	}else{
      		$("#div_listar_carga").html(data)	
      	}
        
      }
    });	


 }

$(document).on("click","#btn_subir_excel",function(){

 var axid_empresa = $("#txtid_empresa").val();

 $.ajax({
      url:"cotizaciones_funciones.php",
      method: "POST",
      data: {param:13,txtid_empresa:axid_empresa},
      success : function(data){
        listar_carga()
      }
    });

 })

$(document).on("click","#div_btn_importar",function(){

	var axid_empresa = $("#txtid_empresa").val();
	$("#txtid_empresa_file").val(axid_empresa);

 })


$(document).on("click","#btn_ordenar_desc",function(){
		
		$("#txttipoorden_numero").val($(this).data('tipoorden_numero'))			
		var axorden = 'DESC';
		$("#txtorden").val(axorden)			
		listar_prospectos();
	})


	$(document).on("click","#btn_ordenar_asc",function(){
		$("#txttipoorden_numero").val($(this).data('tipoorden_numero'))			
		var axorden = 'ASC';
		$("#txtorden").val(axorden)	
		listar_prospectos();
	})




$(document).on("click","#btn_rango_fechas_prospectos",function(){
		
	$("#txttipoorden").val($(this).data('tipoorden'))	
	$("#txttipoorden_rango").val($(this).data('tipoorden_rango'))	
	
	var axorden = 'ASC';
	$("#txtorden").val(axorden)			
	listar_prospectos();
 })

function obtener_ultimos_30_dias() {
    var labels = [];
    for (var i = 1; i <= 30; i += 3) {
        labels.push("Día " + i);
    }
    return labels;
 }
var grafico_barras_horizontales
function creargrafico_registro_prospectos(data) {

 var ctx1 = document.getElementById('grafico_barras_horizontales').getContext('2d');

    // Destruir el gráfico existente si hay uno
    if (grafico_barras_horizontales) {
        grafico_barras_horizontales.destroy();
    }

    // Convertir cadenas de texto a números
    var labels = data.map(item => item.MEDIO);
    var valores = data.map(item => parseInt(item.CANT));

    // Configuración del gráfico de barras horizontales
    grafico_barras_horizontales = new Chart(ctx1, {
        type: 'horizontalBar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Cantidad',
                data: valores,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1, // Asegurar que los ticks sean enteros
                        precision: 0
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            size: window.innerWidth < 600 ? 8 : 12
                        }
                    }
                }
            }
        }
    });


        
 }

$(document).on("change","#txtfecha_reg_prospecto",function(){
	formato_periodo()
	//traerdatos_registro_prospectos()
	})

	$(document).on("change","#txtfecha_al",function(){
	formato_periodo()
	//traerdatos_registro_prospectos()
	})


	function formato_periodo() {

	//new Date("16,Nov,2021");
	var axfecha_del = $("#txtfecha_al").val();

	var fecha =new Date(axfecha_del); 

	let dia = fecha.getDate();
	let mes_1 = fecha.getMonth() + 1;

	
		var mes = mes_1.toString().padStart(2, '0');

	let anio = fecha.getFullYear();
	
	var axperiodo_inventario = mes + "-" + anio;

		$("#txtperiod_actul").val(axperiodo_inventario);


 }
$(document).on("click","#pn_listado_prospectos",function(){

	$("#div_dasboard_prospectos").prop('hidden',true)
	$("#div_listado_prospectos").prop('hidden',false)
	$("#div_form_prospectos").prop('hidden',true)

		
	var elemento1 = document.getElementById("pn_dasboard_prospectos");
	var elemento2 = document.getElementById("pn_listado_prospectos");
						
	elemento1.className = "nav-link";
	elemento2.className = "nav-link active";

 })
$(document).on("click","#btn_editar_cotizacion",function(){

	$("#txtid_prospecto_cz").val($(this).data('id'))

	var axid_cotizacion = $("#txtid_prospecto_cz").val()


	$("#txtparametros").val(1);
	/*
	$("#div_listar_prospectos").prop('hidden',true)
	$("#div_form_prospectos").prop('hidden',false)
	$("#div_buscar_py").prop('hidden',true)
	$("#btn_nuevo").prop('hidden',true)
	*/
	$.ajax({
		url:"cotizaciones_funciones.php",
		method: "POST",
		data: 
			{param:2,
				txtid_cotizacion:axid_cotizacion},
		success : function(data){				
		var json = JSON.parse(data);
		console.log(json);
		if (json.status == 200){
			$("#txtid_prospecto_cz").val(json.ID_COTIZACION_CZ);
			$("#txtnum_celular_pst").val(json.TELEFONO);
			$("#txtnum_cotizacion").val(json.NUM_COTIZACION);
			$("#txtfecha_cotizacion").val(json.FECHA_COTIZACION);
			$("#txtbeneficiario_buscar").val(json.RAZON_SOCIAL);
			$("#txtid_beneficiario").val(json.ID_BENEFICIARIO);
			//var axid_beneficiario = varid_beneficiario;
			$("#txtidentificacion").val(json.INDENTIFICACION);
			$("#txtnum_celular_pst").val(json.NUM_COTIZACION);
			$("#txtid_locales").val(json.ID_LOCAL);
			$("#txtestado_prospecto").val(json.ESTADO_COTIZACION);
			$("#txtid_vendedor").val(json.ID_USUARIO);
			$("#txtforma_pago").val(json.FORMA_PAGO);
			$("#txtfecha_vencimiento").val(json.FECHA_VENCIMIENTO);
			$("#txtcomentarios").val(json.COMENTARIOS);
			
			}
			
		}
	})


	})



function listar_prospectos() {
			
	var axid_empresa = $("#txtid_empresa").val();
	var axbuscar = $("#txtbuscar_prospectos").val();
	var axorden =  $("#txtorden").val()	
	var axtipoorden =  $("#txttipoorden").val()
	var axtipoorden_numero =  $("#txttipoorden_numero").val()
	var axtipoorden_rango =  $("#txttipoorden_rango").val()
	var axfecha_reg_prospecto =  $("#txtfecha_reg_prospecto").val()
	var axfecha_al =  $("#txtfecha_al").val()
	//var axfiltro_buscar = $("#txtfiltro_buscar").val();

		var axnom_tabla = $("#txtnom_tabla").val()
		var axtipo_busqueda = $("#txttipo_busqueda").val()			
		var axcampo_tabla = $("#txtcampo_tabla").val()	
		var axcampo_tabla_orden = $("#txtcampo_tabla_orden").val()	
		var axcampo_contenido = $("#txtcampo_contenido").val()	
		var axpermiso_editar = $("#txtpermiso_editar").val()

	$.ajax({
		url:"cotizaciones_funciones.php",
		method: "POST",
		data: {param:3,
			txtid_empresa:axid_empresa,
			txtbuscar_prospectos:axbuscar,
			txtorden:axorden,
			txttipoorden:axtipoorden,
			txtfecha_reg_prospecto:axfecha_reg_prospecto,
			txtfecha_al:axfecha_al,
			txttipoorden_rango:axtipoorden_rango,
			txttipoorden_numero:axtipoorden_numero,

					//txtfiltro_buscar:axfiltro_buscar,	
			txtnom_tabla:axnom_tabla,
			txttipo_busqueda:axtipo_busqueda,
			txtcampo_tabla:axcampo_tabla,
			txtcampo_tabla_orden:axcampo_tabla_orden,
			txtcampo_contenido:axcampo_contenido,
			txtpermiso_editar:axpermiso_editar

		},
		success : function(data){
			
			$('#div_listar_prospectos').html(data);

			if(axorden=='ASC'){
			
				$("#btn_ordenar_asc").prop('hidden',true)
				$("#btn_ordenar_desc").prop('hidden',false)

			}else if(axorden=='DESC'){
				
				$("#btn_ordenar_asc").prop('hidden',false)
				$("#btn_ordenar_desc").prop('hidden',true)
			}

			

			
			
		}
		});

	}

$(document).on("click","#btn_agregar_prospecto",function(){

	/*
	 // Verificar campos vacíos
    if (verificarCamposVacios()) {
        // Si hay campos vacíos, detener la ejecución
        return;
    }
    */

	var axid_empresa =$("#txtid_empresa").val();
	var axid_prospecto_cz =$("#txtid_prospecto_cz").val();
	var axcodigo_pst_cz   =$("#txtcodigo_pst_cz").val();
	var axnum_celular_pst = $("#txtnum_celular_pst").val();
	var axnum_cotizacion = $("#txtnum_cotizacion").val();
	var axfecha_cotizacion = $("#txtfecha_cotizacion").val();
	var axid_beneficiario =  $("#txtid_beneficiario").val();
	var axidentificacion = $("#txtidentificacion").val();
	var axnum_celular_pst = $("#txtnum_celular_pst").val();
	var axid_local = $("#txtid_locales").val();
	var axestado_cotizacion = $("#txtestado_prospecto").val();
	var axid_usuario = $("#txtid_vendedor").val();
	var axforma_pago = $("#txtforma_pago").val();
	var axfecha_vencimiento = $("#txtfecha_vencimiento").val();
	var axcomentario = $("#txtcomentarios").val();

	
    $.ajax({
      url:"cotizaciones_funciones.php",
      method: "POST",
      data: {param:1,

		txtid_empresa:axid_empresa,
		txtid_prospecto_cz:axid_prospecto_cz,
		txtcodigo_pst_cz:axcodigo_pst_cz,
		txtnum_celular_pst:axnum_celular_pst,
		txtnum_cotizacion:axnum_cotizacion,
		txtfecha_cotizacion:axfecha_cotizacion,
		txtid_beneficiario:axid_beneficiario,
		txtidentificacion:axidentificacion,
		txtid_local:axid_local,
		txtestado_cotizacion:axestado_cotizacion,
		txtid_usuario:axid_usuario,
		txtforma_pago:axforma_pago,
		txtfecha_vencimiento:axfecha_vencimiento,
		txtparametros:$("#txtparametros").val(),
		txtcomentario:axcomentario

    	},
      success : function(data){

      		//if(data==0){
		if(data.substr(0,1)=='0'){ 

        	Swal.fire({
					  position: "center",
					  icon: "success",
					  title: "El registro fue guardado",
					  showConfirmButton: false,
					  timer: 2000
					});
        			listar_prospectos()
        			limpiarContenedor()
					$("#div_listar_prospectos").prop('hidden',false)
					$("#div_form_prospectos").prop('hidden',true)
					$("#div_buscar_py").prop('hidden',false)
					$("#btn_nuevo").prop('hidden',false)
					


        }else{

        	Swal.fire({
						  title: "Advertencia",
						  text: "Error al guardar el registro",
						  icon: "error"
						});

        }
       		
        
      }
    });




	})

function limpiarContenedor(){

	$("#txtid_empresa").val("");
	$("#txtid_prospecto_cz").val("");
	$("#txtcodigo_pst_cz").val("");
	$("#txtnum_celular_pst").val("");
	$("#txtnum_cotizacion").val("");
	$("#txtfecha_cotizacion").val("");
	//var axid_beneficiario = varid_beneficiario;
	$("#txtidentificacion").val("");
	$("#txtnum_celular_pst").val("");
	$("#txtid_locales").val("");
	$("#txtestado_prospecto").val("");
	$("#txtid_vendedor").val("");
	$("#txtforma_pago").val("");
	$("#txtfecha_vencimiento").val("");
	$("#txtcomentarios").val("");

 }





$(document).on("keyup","#txtbuscar_prospectos",function(){
	listar_prospectos()
 })





$(document).on("click","#btn_nuevo",function(){

	$("#txtparametros").val(0);
	/*
	$("#div_listar_prospectos").prop('hidden',true)
	$("#div_form_prospectos").prop('hidden',false)
	$("#div_buscar_py").prop('hidden',true)
	$("#btn_nuevo").prop('hidden',true)
	$("#div_dasboard_prospectos").prop('hidden',true)
	*/

	})


/************************************/



 // Muestra el texto emergente al pasar el mouse sobre el botón de ayuda
document.getElementById("help-button").addEventListener("mouseover", function() {
   document.getElementById("help-tooltip").style.display = "block";
   });

   // Oculta el texto emergente cuando el mouse sale del botón de ayuda
   document.getElementById("help-button").addEventListener("mouseout", function() {
   document.getElementById("help-tooltip").style.display = "none";
  });

function traer_nom_menu(){

	var axmodulo = $("#txtmodulo").val();	
	$.ajax({
		url:"funciones.php",
		method: "POST",
		data: {param:2,txtmodulo:axmodulo},
		success : function(data){

	
			//$("#titulo_formulario").html("<i class='fa-solid fa-users' style='font-size:25px;'></i> "+data +" <button type='button' id='btn_nuevo'  class='btn btn-outline-primary btn-sm' data-bs-toggle='modal' data-bs-target='#mdl_registrar_prospectos'><i class='bi bi-file-earmark-plus'></i> Nuevo</button> <button type='button' id='btn_importar_prosepectos'  class='btn btn-outline-success btn-sm' data-bs-toggle='modal' data-bs-target='#mdl_importar_data'><i class='bi bi-cloud-upload-fill'></i> Importar data</button> <button type='button' id='btn_rango_fechas_prospectos' data-tipoorden='RANGO' data-tipoorden_rango='RANGO'   class='btn btn-outline-primary btn-sm' ><i class='bi bi-funnel-fill'></i> RANGO FECHAS </button> <button type='button' id='btn_prospectos_asignados' data-tipoorden='ASIGNADO'   class='btn btn-outline-success btn-sm' ><i class='bi bi-person-fill-add'></i> ASIGNADOS </button> <button type='button' id='btn_prospectos_no_asignados' data-tipoorden='NO ASIGNADO'  class='btn btn-outline-danger btn-sm' ><i class='bi bi-person-fill-dash'></i>ASIGNADOS </button> <button type='button' id='btn_prospectos_todos' data-tipoorden='TODOS'   class='btn btn-outline-warning btn-sm' ><i class='bi bi-arrow-clockwise'></i> TODOS </button>")		

			$("#titulo_formulario").html("<i class='fa-solid fa-users' style='font-size:25px;'></i> "+data +" <button type='button' id='btn_nuevo'  class='btn btn-outline-primary btn-sm' data-bs-toggle='modal' data-bs-target='#mdl_registrar_prospectos'><i class='bi bi-file-earmark-plus'></i> Nuevo</button> <!--button type='button' id='btn_importar_prosepectos'  class='btn btn-outline-success btn-sm' data-bs-toggle='modal' data-bs-target='#mdl_importar_data'><i class='bi bi-cloud-upload-fill'></i> Importar data</button-->")		

		}
	})

 }


function Verifica_permiso(){

	var axiduser =$("#txtid_usuario").val();
	var axtipo_beneficiario =$("#txttipo_beneficiario").val();	
	var axpermiso_1 = 'PROSPECTOS';	
	$("#txtmodulo").val(axpermiso_1);
	var axmodulo = $("#txtmodulo").val();
	
	$.ajax({
		url:"funciones.php",
		method: "POST",
		data: {param:3,txtid_usuario:axiduser,txtmodulo:axmodulo},
		success : function(permiso){

			if (permiso==1){	

				Swal.fire({
				  title: 'Acceso denegado',
				  text: "¡No tienes acceso a este módulo!",
				  icon: 'warning',
				  showCancelButton: false,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: '¡El módulo se cerrará!'
				}).then((result) => {
				  if (result.isConfirmed) {
				     window.location="principal.php";
				  }
				})

			}else{

				traer_nom_menu()
				
			} 
		}
		})
 }


function mueveReloj(){ 
   	momentoActual = new Date() 
   	hora = addZero(momentoActual.getHours());
   	minuto = addZero(momentoActual.getMinutes()); 
   	segundo = addZero(momentoActual.getSeconds()); 

   	horaImprimible = hora + ":" + minuto + ":" + segundo 
   	horaImprimible_g = hora + ":" + minuto 

   	document.form_reloj.reloj.value = horaImprimible 
   	document.form_reloj_1.txthora_asignacion.value = horaImprimible
   	document.form_reloj_2.txthora_reasignacion.value = horaImprimible 
   	setTimeout("mueveReloj()",1000)
 }

function zeros( number, width )
 {
  width -= number.toString().length;
  if ( width > 0 )
  {
    return new Array( width + (/\./.test( number ) ? 2 : 1) ).join( '0' ) + number;
  }
  return number + ""; // siempre devuelve tipo cadena
 }



function addZero(i) {
  if (i < 10) {
    i = "0" + i;
  }
  return i;
 }

 $("input[type=text]").focus(function(){	   
  this.select();
 });

function decimales(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
 }



function verificarCamposVacios() {

    var elementos = document.querySelectorAll('#div_form_prospectos input, #div_form_prospectos select');
    var camposVacios = false;

    for (var i = 0; i < elementos.length; i++) {
        if (elementos[i].value.trim() === '') {
            elementos[i].style.borderColor = 'red';
            camposVacios = true;
            Swal.fire({
                title: "Advertencia",
                text: "Éxisten campos en blanco...",
                icon: "warning"
            });
        } else {
            elementos[i].style.borderColor = '';
        }
    }

    return camposVacios;

 }


function verificarCamposVacios_prospectos_asignar() {

   var elementos = document.querySelectorAll('#div_form_prospectos_asignar input, #div_form_prospectos_asignar select');
    var camposVacios = false;

    for (var i = 0; i < elementos.length; i++) {
        if (elementos[i].value.trim() === '') {
            elementos[i].style.borderColor = 'red';
            camposVacios = true;
            Swal.fire({
                title: "Advertencia",
                text: "Éxisten campos en blanco...",
                icon: "warning"
            });
        } else {
            elementos[i].style.borderColor = '';
        }
    }

    return camposVacios;
 }

 // Ejemplo de uso
    


function restarDiasYFormatear(fechaActual, dias) {

        var partesFecha = fechaActual.split('/');
        var fecha = new Date(partesFecha[2], partesFecha[1] - 1, partesFecha[0]);
        fecha.setDate(fecha.getDate() - dias);
        var dia = fecha.getDate();
        var mes = fecha.getMonth() + 1;
        var anio = fecha.getFullYear();
        dia = dia < 10 ? '0' + dia : dia;
        mes = mes < 10 ? '0' + mes : mes;
        return dia + '/' + mes + '/' + anio;
    }

   
function convertirAMayusculas(input) {
  input.value = input.value.toUpperCase();
 }

 function limpiarContenedor_subir() {
        document.getElementById('fileInput').value = ''; // Limpia el campo de entrada de archivos
        document.getElementById('progressBar').value = 0; // Reinicia la barra de progreso
        document.getElementById('output').innerHTML = ''; // Limpia el contenido de salida

        $("#div_listar_py").prop('hidden',false)
		$("#div_subir_img_plano").prop('hidden',true)

    }

function uploadFile() {

    var fileInput = document.getElementById('fileInput');
    var idempresa = document.getElementById('txtid_empresa_file');
    var tipo = document.getElementById('txttipo_archivo');
    
    var progressBar = document.getElementById('progressBar');
    var output = document.getElementById('output');

    if (fileInput.files.length > 0) {
        var file = fileInput.files[0];

        // Utilizas FormData para enviar el archivo y txtid_proyecto_enviar
        var formData = new FormData();
        formData.append('fileInput', file);
        formData.append('txtid_empresa_file', idempresa.value); // Obtén el valor del input
        formData.append('txttipo_archivo', tipo.value); // Obtén el valor del input

        var xhr = new XMLHttpRequest();

        xhr.open('POST', 'upload.php', true);

        xhr.upload.onprogress = function (e) {
            if (e.lengthComputable) {
                var percent = Math.round((e.loaded / e.total) * 100);
                progressBar.value = percent;
            }
        };

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                output.innerHTML = '<p>Archivo subido con éxito.</p>';
                progressBar.value = 100; // Aseguramos que la barra esté llena al completar la carga
            }
        };

        xhr.send(formData);
    } else {
        alert('Por favor, selecciona un archivo.');
    }

  }
function regresamatrizjsonasync(sqljson,variable){//
  //var variables;
  console.log("Entra aqui:");
  console.log(sqljson);
  var resultado;
  resultado=$.ajax({
      url: 'ejecutasqltabla.php',
      type: 'POST',
      data: {q: sqljson},
      async: false,

      beforeSend: function () {
                    //$("#mensajesis").html("Procesando, espere por favor...");
                    datosactualizado=0;
                    //$.ajaxblock();
                },
        success:function(response) {
			console.log(response);
          window[variable] = response.data.formulas;
          console.log("se procesa la variable: "+variable);
         
           
        }
    });
  
 }

function siguienteCampo(event) {
            // Verifica si la tecla presionada es Enter
			console.log("entra aqui 1");
            if (event.key === 'Enter') {
				console.log("entra aqui 2");
                // Obtiene todos los campos de la clase 'campo'
                var campos = document.getElementsByClassName('campo');

                // Encuentra el índice del campo actual
                var indiceCampoActual = Array.from(campos).indexOf(document.activeElement);

                // Calcula el índice del siguiente campo
                var indiceSiguienteCampo = indiceCampoActual + 1;

                // Si el siguiente campo existe, asigna el foco a ese campo
                if (campos[indiceSiguienteCampo]) {
					console.log("entra aqui 3");
                    event.preventDefault(); // Evita que el formulario se envíe al presionar Enter
                    campos[indiceSiguienteCampo].focus();
                }
            }
        }
</script>


