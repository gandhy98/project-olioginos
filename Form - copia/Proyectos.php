<?php require_once '../includes/header.php';?>

<!DOCTYPE html>
	<html>
	<head></head>

	<style type="text/css">

		/* Agrega estos estilos para personalizar la barra de progreso */
        progress {
            width: 100%;
            margin-top: 10px;
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

	</style>
	
	<!--img src="../img/empresa.PNG" style="opacity: 0.2;"-->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	
	<input type="hidden" name="txtfiltro_buscar" id="txtfiltro_buscar">	
	<input type="hidden" name="txtparametros" id="txtparametros">	
	<input type="hidden" name="txtparametros_detalle" id="txtparametros_detalle" value="0">
	<input type="hidden" name="txtparametros_producto" id="txtparametros_producto">	
	<input type="hidden" name="txtid_usuario" id="txtid_usuario" value="<?php echo "$axid_usuario";?>">
	<input type="hidden" name="txtid_empresa" id="txtid_empresa" value="<?php echo "$axidempresa";?>">	
	<input type="hidden" class="form-control" id="txtid_proyecto">
	<input type="hidden" class="form-control" id="txtid_producto" >
	

		<input type="hidden" name="txttipoorden" id="txttipoorden">
		<input type="hidden" id="txtnom_tabla" value='MK_PROYECTOS_TOTALES'>	
		<input type="hidden" id="txttipo_busqueda">	
		<input type="hidden" id="txtcampo_contenido">	
		<input type="hidden" id="txtcampo_tabla">	
		<input type="hidden" id="txtcampo_tabla_orden">	
		<input type="hidden" name="txtorden" id="txtorden">			

		<input type="hidden" id="txtpermiso_editar">
		<input type="hidden" id="txtmodulo_eliminar">

	<body style="padding: 10px; margin: 0;">	
	<div class="card">
  	<div class="card-header">

  		<div class="row g-3" id="div_buscar">

  			<div class="col-md-4">
	        <h5 id="titulo_formulario"></h5>
	    	</div>

	    	<div class="col-md-4" style="text-align:left;">
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
				</div>

				<div class="col-md-4" style="align-items: center;" >
					<div class="input-group mb-3">
				   <input type="text" class="form-control" id="txtbuscar_proyecto" placeholder="Buscar "oninput="convertirAMayusculas(this)">
				  	<span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
					</div>
				</div>
  	</div>
    

    <!--div class="row g-4" id="div_buscar_py">    
        <div class="col-md-4">
            <h5 id="titulo_formulario"></h5>
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                
                <input type="text" class="form-control d-none d-sm-block" id="txtbuscar_proyecto" placeholder="Buscar" oninput="convertirAMayusculas(this)">		
                <button type='button' id='btn_py_activos' data-tipoorden='ACTIVO' data-filtro_buscar='ACTIVO' class='btn btn-outline-success btn-sm d-none d-sm-block'><i class='bi bi-check-circle-fill'></i>  ACTIVOS</button>
                <button type='button' id='btn_py_inactivos' data-tipoorden='INACTIVO' data-filtro_buscar='INACTIVO' class='btn btn-outline-danger btn-sm d-none d-sm-block'><i class='bi bi-dash-circle-fill'></i> INACTIVOS</button>
                <button type='button' id='btn_py_todos' data-tipoorden='TODOS' data-filtro_buscar='' class='btn btn-outline-warning btn-sm d-none d-sm-block'><i class='bi bi-arrow-clockwise'></i> TODOS</button>
                
                <div class="input-group mb-3 d-sm-none">
                    <input type="text" class="form-control" id="txtbuscar_proyecto" placeholder="Buscar" oninput="convertirAMayusculas(this)">		
                    <button type='button' id='btn_py_activos' data-tipoorden='ACTIVO' data-filtro_buscar='ACTIVO' class='btn btn-outline-success btn-sm'><i class='bi bi-check-circle-fill'></i></button>
                    <button type='button' id='btn_py_inactivos' data-tipoorden='INACTIVO' data-filtro_buscar='INACTIVO' class='btn btn-outline-danger btn-sm'><i class='bi bi-dash-circle-fill'></i></button>
                    <button type='button' id='btn_py_todos' data-tipoorden='TODOS' data-filtro_buscar='' class='btn btn-outline-warning btn-sm'><i class='bi bi-arrow-clockwise'></i></button>
                </div>
            </div>
        </div>
    </div-->


</div>






  	<div class="card-body">
	  	
	  <div class="table-responsive" id="div_listar_py"></div>

	  <div class="table-responsive" id="div_listar_productos_py" hidden>

	  	<div class="row">
			  <div class="col-sm-3 mb-3 mb-sm-0">
			    <div class="card">
			      <div class="list-group" id="div_productos_manzanas_py"></div>
			    </div> 
			  </div>
			  <div class="col-sm-9" >
			    <div class="card">
			      <div class="card-body" id="div_productos_manzanas_detalles_py">

			      </div>
			    </div>
			  </div>
			</div>



	  </div>


	<!-------------------------------------->


	<div class="container" id="div_subir_img_plano" hidden>
    <h2 class="text-danger">Subir imagen del plano</h2>
    <form id="uploadForm" enctype="multipart/form-data">
        
        <!--label for="fileInput">Selecciona una imagen:</label>
        <input type="file" name="fileInput" id="fileInput" accept="image/*"-->

        <div class="input-group mb-3">
		  <!--label class="input-group-text" for="inputGroupFile01">Selecciona una imagen</label-->
		 <input type="file" class="form-control" name="fileInput" id="fileInput" accept="image/*">		 
		</div>

        <input type="hidden" name="txtid_proyecto_enviar" id="txtid_proyecto_enviar">
        <input type="hidden" name="txttipo_archivo" id="txttipo_archivo">
        <input type="hidden" name="txtid_empresa_file" id="txtid_empresa_file">

        <div id="div_btn_subir">
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn_subir_excel" onclick="uploadFile()"><i class="bi bi-cloud-arrow-up-fill"></i> Subir</button>
            <a href="../Archivos/050124 - Modelo de carga de lotes.xlsx" type="button" class="btn btn-outline-success btn-sm" id='archivo_muestra' hidden><i class="bi bi-file-earmark-excel-fill"></i> Modelo de carga</a>
            <button type="button" class="btn btn-outline-danger btn-sm" id="btn_retornar_de_subir" onclick="limpiarContenedor()"><i class="bi bi-arrow-return-left"></i> Retornar</button>
        </div>

        <div aria-label="Example with label">
            <progress class="progress" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" value="0" max="100" id="progressBar"></progress>
        </div>

        <div id="output"></div>
    </form>
</div>
	   		
	<!-------------------------------------->
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
<!------------------------------------->
<div class="modal" id="exampleModal">
<div class="modal-dialog modal-xl">
<div class="modal-content">  
    		<input type="hidden" class="form-control" id="txtid_proyecto">
		    <input type="hidden" class="form-control" id="txtubigeo_py">
		    <input type="hidden" class="form-control" id="txtfecha_registro_py">    			
      	<div class="modal-header">
		    <h5 class="modal-title titulos_form" id="exampleModalLabel">Registro de proyectos inmobiliarios</h5>		    
		    </div>
		    <div class="modal-body">

		    	<div class="card text-center">
					  <div class="card-header bg_card">
					    <ul class="nav nav-tabs card-header-tabs">
					      <li class="nav-item">
						        <a class="nav-link active"  id="pn_datos_py" aria-current="true" href="#"><b>Datos generales</b></a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link"  id="pn_detalles_py" href="#"><b>Datos específicos</b></a>
						      </li>		
						      <li class="nav-item">
						        <a class="nav-link"  id="pn_productos_py" href="#"><b>Productos</b></a>
						      </li>

						      <li class="nav-item">
						        <a class="nav-link"  id="pn_mapa_py" href="#"><b>Mapa</b></a>
						      </li>

									
									
					    </ul>
					  </div>
					  <div class="card-body">
					    
					    <div id="div_datos_py">

					    			<div class="row g-3">
					    				
											<div class="col-md-4">
											<div class="input-group mb-3">						  	
										  <input type="text" class="form-control text-center" id="txtcodigo_py" placeholder="Cod. Proyecto" aria-label="Username" aria-describedby="basic-addon1" disabled>
										  <button type="button" class="btn btn-outline-primary btn-sm"  id="btn_generar_codigo"><i class="bi bi-qr-code"></i> Generar</button>
											</div>
											</div>


											<div class="col-md-3">
												<div class="input-group mb-3">	
													<span class="input-group-text" id="basic-addon2">Estado</span>
											<select class="form-select" aria-label="Default select example" id="txtestado_py">											
											<option value="ACTIVO">ACTIVO</option>
											<option value="INACTIVO">INACTIVO</option>
										  </select>

											</div>
											</div>
										</div>
										
										<div class="row g-3">
											<div class="col-md-4">
											<div class="form-floating">
											<input type="text" class="form-control" id="txtdescripcion_py" placeholder="Descripción del proyecto" oninput="convertirAMayusculas(this)">
						  				<label for="txtdescripcion_py"><b>Nombre de proyecto</b></label>
											</div>
											</div>
											<div class="col-md-3">
											<div class="form-floating">
											<input type="text" class="form-control" id="txtnombre_corto_py" placeholder="Nombre abreviado" oninput="convertirAMayusculas(this)">
						  				<label for="txtnombre_corto_py"><b>Nombre abreviado</b></label>
											</div>
											</div>
																						
											<div class="col-md-5">
											<div class="form-floating">
											<input type="text" class="form-control" id="txtubicacion_py" placeholder="Dirección del proyecto" oninput="convertirAMayusculas(this)">
						  				<label for="txtubicacion_py"><b>Dirección del proyecto</b></label>
											</div>
											</div>
											<div class="col-md-6">
											<div class="form-floating">
											<input type="text" class="form-control" id="txtubicacion_digital_mapa" placeholder="Ubicación en el mapa">
						  				<label for="txtubicacion_digital_mapa"><b>Ubicación en el mapa</b></label>
											</div>
											</div>
											<div class="col-md-6">
											<div class="form-floating">
											<input type="hidden" class="form-control" id="txtdistrito_py">
											<input type="text" class="form-control" id="txtbuscar_distrito" placeholder="Distrito" oninput="convertirAMayusculas(this)">
						  				<label for="txtbuscar_distrito"><b>Distrito</b></label>
											</div>
											<div id="div_listar_ubigeos"></div>
											</div>
											<div class="col-md-4">
											<div class="form-floating">
											<input type="text" class="form-control" id="txtprovincia_py" placeholder="Provincia" disabled>
						  				<label for="txtprovincia_py"><b>Provincia</b></label>
											</div>
											</div>
											<div class="col-md-4">
											<div class="form-floating">
											<input type="text" class="form-control" id="txtdepartamento_py" placeholder="Departamento" disabled>
						  				<label for="txtdepartamento_py"><b>Departamento</b></label>
											</div>
											</div>
											<div class="col-md-4">
											<div class="form-floating">
											<input type="text" class="form-control" id="txtcontacto_py" placeholder="Responsable" oninput="convertirAMayusculas(this)">
						  				<label for="txtcontacto_py"><b>Responsable</b></label>
											</div>
											</div>

											<div class="col-md-4">
											<div class="form-floating">
											<input type="text" class="form-control" id="txtunida_catastral" placeholder="Unidad Catastral" oninput="convertirAMayusculas(this)">
						  				<label for="txtunida_catastral"><b>Unidad Catastral</b></label>
											</div>
											</div>

											<div class="col-md-4">
											<div class="form-floating">
											<input type="text" class="form-control" id="txtpartida_registral" placeholder="Unidad Catastral" oninput="convertirAMayusculas(this)">
						  				<label for="txtpartida_registral"><b>Partida Registral</b></label>
											</div>
											</div>


											<div class="col-md-4">
											<div class="form-floating">
											<input type="date" class="form-control" id="txtfecha_entrega_py" placeholder="Fecha entrega " value="<?php echo "$diaactual";?>" >
						  					<label for="txtfecha_entrega_py"><b>Fecha entrega</b></label>
											</div>
											</div>

											<div class="col-md-12" style="text-align: right;" id="div_btn_grabar_py">
												<button type="button" class="btn btn-outline-success btn-sm"  id="btn_grabar_py"><i class="fas fa-save"></i> Grabar Proyecto</button>
											</div>

												
										</div>
					    </div>

					    <div id="div_detalles_py" hidden>

					    	<input type="hidden" class="form-control" id="txtid_detalle">
					 
					    	<h4 class="text-start text-primary" style="padding: 5px;" id="nom_proyecto_detalle"></h4>
					    	<div class="row g-3">

								<div class="col-md-8">		
								<div class="form-floating">
								<select class="form-select" id="txttipo_caracteristica" aria-label="Floating label select example">		
								<option value="CARACTERISTICAS">CARACTERISTICAS</option>
								<option value="DOCUMENTACION">DOCUMENTACION</option>
								<option value="FINANCIAMIENTO">FINANCIAMIENTO</option>
								
								</select>
								<label for="tipo_caracteristica"><i class="bi bi-buildings-fill"></i> Tipo de detalles</label>
								</div>
								</div>

								<div class="col-md-4">
								<div class="form-floating">								
								<select class="form-select" id="txtestado_caracteristica" aria-label="Floating label select example">				        
								<option value="ACTIVO">ACTIVO</option>						
								<option value="INACTIVO">INACTIVO</option>											
								</select>
								<label for="txtestado_caracteristica"><b>Estado</b></label>
								</div>
								</div>

								</div>

								<br>
								<div class="row g-3" id="div_form_detalles_py">

								<div class="col-md-6">
								<div class="form-floating">
								<input type="text" class="form-control" id="txtnom_caracteristicas" placeholder="Escribe lo que deseas buscar" oninput="convertirAMayusculas(this)">
						  		<label for="txtnom_caracteristicas"><b>Característica</b></label>
								</div>
								<div id="div_listar_nom_caracteristicas"></div>
								</div>


								<div class="col-md-6">
								<div class="form-floating">
								<input type="text" class="form-control" id="txtdetalle" placeholder="Contenido" oninput="convertirAMayusculas(this)">
						  		<label for="txtdetalle"><b>Descripción</b></label>
								</div>
								</div>

								<div class="col-md-12" style="text-align: right;">
								<button type="button" class="btn btn-outline-success btn-sm"  id="btn_grabar_detalle_py"><i class="fas fa-save"></i> Agregar</button>
								</div>

								</div>
								<br>

								<div class="spinner-grow text-primary" id="div_esperando_detalles" role="status" hidden>
								  <span class="visually-hidden">Loading...</span>
								</div>

								<div class="table-responsive" id="div_listar_caracteristicas"></div>

								<!-------------------------------------->

									<div class="container" id="div_subir_documentos" hidden>
								    <h2 class="text-danger">Subir documentos</h2>
								    <form id="uploadForm_doc" enctype="multipart/form-data">							        
								        
								        <div class="input-group mb-3">										  
										 <input type="file" class="form-control" name="fileInput_doc" id="fileInput_doc" accept="*">		 
										</div>

								        <input type="hidden" name="txtid_proyecto_doc" id="txtid_proyecto_doc">
								        <input type="hidden" name="txtid_detalle_doc" id="txtid_detalle_doc">
								        <input type="hidden" name="txtid_empresa_file_doc" id="txtid_empresa_file_doc">


								        <div id="div_btn_subir">
								            <button type="button" class="btn btn-outline-primary btn-sm" id="btn_subir_doc" onclick="uploadFile_doc()"><i class="bi bi-cloud-arrow-up-fill"></i> Subir</button>								            
								            <button type="button" class="btn btn-outline-danger btn-sm" id="btn_retornar_de_subir_doc" onclick="limpiarContenedor_doc()"><i class="bi bi-arrow-return-left"></i> Retornar</button>
								        </div>

								        <div aria-label="Example with label">
								            <progress class="progress" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" value="0" max="100" id="progressBar_doc"></progress>
								        </div>

								        <div id="output_doc"></div>
								    </form>
								</div>
									   		
									<!-------------------------------------->


							</div>

							<div id="div_mapa_py" hidden>
								
								<h4 class="text-start text-primary" style="padding: 5px;" id="nom_proyecto_mapa"></h4>



								<div id="frm_mapa"></div>

							</div>

							<div id="div_productos_py" hidden>

								<h4 class="text-start text-primary" style="padding: 5px;" id="nom_proyecto_productos"></h4>
								<p><hr></p>
								

								<div class="row g-3" id="div_productos_buscar_prod">

								<div class="col-md-6">
									<div class="input-group mb-3">
								  <input type="text" class="form-control" placeholder="Buscar Manzana + Lote" aria-label="Username" id="txtbuscar_producto" aria-describedby="basic-addon1" oninput="convertirAMayusculas(this)">
									<button type='button' id='btn_buscra_producto'  class='btn btn-outline-success btn-sm'><i class="bi bi-search"></i> Buscar</button>
									<button type='button' id='btn_nuevo_producto'  class='btn btn-outline-primary btn-sm'><i class='bi bi-file-earmark-plus'></i> Nuevo</button>									

									</div>								
								</div>

								</div>

								<div class="row g-3" id="div_form_productos" hidden>

									<div class="col-md-4">
									<div class="input-group mb-3">						  	
									<input type="text" class="form-control text-center" id="txtcod_producto" placeholder="Cod. Proyecto" aria-label="Username" aria-describedby="basic-addon1" disabled>
									<button type="button" class="btn btn-outline-primary btn-sm"  id="btn_generar_codigo_producto"><i class="bi bi-qr-code"></i> Generar</button>
									</div>
									</div>

									<div class="col-md-4">
									<div class="input-group mb-3">									
									<select class="form-select" id="txtestado_producto" aria-label="Floating label select example">		
									<option value="">ESTADO</option>		        
									<option value="DISPONIBLE">DISPONIBLE</option>
									<option value="SEPARADO">SEPARADO</option>
									<option value="VENDIDO">VENDIDO</option>
									</select>
					 			  </div>
									</div>

									<div class="col-md-4">
									<div class="input-group mb-3">							
									<select class="form-select" id="txttipo_producto" aria-label="Floating label select example">				        
									<option value="LOTE">LOTE</option>
									</select>
									</div>
									</div>

									<div class="col-md-3">
									<div class="form-floating">
									<input type="text" class="form-control" id="txtubic_mz" placeholder="Manzana" oninput="convertirAMayusculas(this)">
							  	<label for="txtubic_mz"><b>Manzana</b></label>
									</div>								
									</div>

									<div class="col-md-3">
									<div class="form-floating">
									<input type="text" class="form-control" id="txtubic_lote" placeholder="Lote" oninput="convertirAMayusculas(this)">
							  	<label for="txtubic_lote"><b>Lote</b></label>
									</div>								
									</div>

									<div class="col-md-3">
									<div class="form-floating">								
									<input type="text" class="form-control" id="txtmed_frente" placeholder="Frente" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
							  	<label for="txtmed_frente"><b>Frente</b></label>
									</div>								
									</div>

									<div class="col-md-3">
									<div class="form-floating">
									<input type="text" class="form-control" id="txtmed_fondo" placeholder="Fondo" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
							  	<label for="txtmed_fondo"><b>Fondo</b></label>
									</div>								
									</div>

									<div class="col-md-3">
									<div class="form-floating">
									<input type="text" class="form-control" id="txtmed_derecha" placeholder="Derecha"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
							  	<label for="txtmed_derecha"><b>Derecha</b></label>
									</div>								
									</div>

									<div class="col-md-3">
									<div class="form-floating">
									<input type="text" class="form-control" id="txtmed_izquierda" placeholder="Izquierda" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
							  	<label for="txtmed_izquierda"><b>Izquierda</b></label>
									</div>								
									</div>

									<div class="col-md-3">
									<div class="form-floating">
									<input type="text" class="form-control" id="txtmed_perimetro" placeholder="Perimetro" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
							  	<label for="txtmed_perimetro"><b>Perimetro</b></label>
									</div>								
									</div>

									<div class="col-md-3">
									<div class="form-floating">
									<input type="text" class="form-control" id="txtarea_m2" placeholder="Area M2" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
							  	<label for="txtarea_m2"><b>Area M2</b></label>
									</div>								
									</div>

									<div class="col-md-3">
									<div class="form-floating">
									<input type="text" class="form-control" id="txtubic_plano" placeholder="Ubicación plano" oninput="convertirAMayusculas(this)">
							  	<label for="txtubic_plano"><b>Ubicación plano</b></label>
									</div>								
									</div>
									
									<div class="col-md-3">
									<div class="form-floating">
									<input type="text" class="form-control" id="txtprecio_lista" placeholder="Precio Lista" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
							  	<label for="txtprecio_lista"><b>Precio Lista</b></label>
									</div>								
									</div>
									<div class="col-md-12" style="text-align: right;">
										<button type="button" class="btn btn-outline-success btn-sm"  id="btn_grabar_producto_py"><i class="fas fa-save"></i> Agregar</button>
										<button type="button" class="btn btn-outline-danger btn-sm" id="btn_cerrar_form_prod"><i class="bi bi-arrow-return-left"></i> Retornar</button>	
									</div>

								</div>
						

								<div class="spinner-grow text-primary" id="div_esperando_productos" role="status" hidden>
								  <span class="visually-hidden">Loading...</span>
								</div>

								<div  id="div_productos_py_listado"></div>

							</div>

					  </div>
					</div>

				</div>
				<div class="modal-footer">
			
				<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal" id="btn_cerrar_modal"><i class="fas fa-door-closed" ></i> Cerrar</button>	
				</div>

</div>
</div>
</div>
<!-------------------------------------->

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


</html>	

<script type="text/javascript">

$(document).ready(function() {	
	
	Verifica_permiso()
	Verifica_permiso_editar()
	listar_proyectos();

});
/****************************/

$(document).on("click","#btn_descargar_documento",function(){
	
	
	var archivoinput = $(this).data("nomarchivo");
	
	window.open("visor.php?file="+archivoinput);
	

})


$(document).on("click","#btn_retornar_de_subir_doc",function(){

$("#div_subir_documentos").prop('hidden',true)
$("#div_listar_caracteristicas").prop('hidden',false)

listar_caracteristicas()

})



$(document).on("click","#btn_subir_documentos",function(){

	var axid_proyecto = $(this).data('id');
	var axid_detalle = $(this).data('iddt');

	var axid_empresa = $("#txtid_empresa").val()

	//alert(axid_proyecto+' '+axid_detalle)

	$("#txtid_proyecto_doc").val(axid_proyecto)
	$("#txtid_detalle_doc").val(axid_detalle)
	$("#txtid_empresa_file_doc").val(axid_empresa)

	$("#div_subir_documentos").prop('hidden',false)
	$("#div_listar_caracteristicas").prop('hidden',true)
	
})
/*********************************************/

$(document).on("click","#btn_prospectos_todos",function(){

	$("#txtbuscar_proyecto").val('');
	$("#txttipoorden").val($(this).data('tipoorden'))		
	listar_proyectos();
})


	

$(document).on("click","#btn_buscar_campo_contenido",function(){
	
	$("#txtcampo_contenido").val($(this).data('campo_contenido'))		
	listar_proyectos()		
})

$(document).on("click","#btn_ordenar_campo",function(){
	$("#txtorden").val($(this).data('order'))
	$("#txtcampo_tabla_orden").val($(this).data('campo_tabla_orden'))	
	$("#txttipoorden").val('')		
	listar_proyectos()
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

$(document).on("click","#btn_subir_excel",function(){

var axtipo_archivo = $("#txttipo_archivo").val();
var axid_empresa = $("#txtid_empresa").val();
var axid_proyecto = $("#txtid_proyecto_enviar").val();

if(axtipo_archivo=='productos'){

	$.ajax({
      url:"Proyectos_funciones.php",
      method: "POST",
      data: {param:17,txtid_empresa:axid_empresa,txtid_proyecto_enviar:axid_proyecto},
      success : function(data){
      	
      	$("#div_listar_py").prop('hidden',false)
		$("#div_subir_img_plano").prop('hidden',true)

        listar_proyectos();
      }
    });

}

 

})

 function limpiarContenedor_subir() {

    document.getElementById('fileInput').value = ''; // Limpia el campo de entrada de archivos
    document.getElementById('progressBar').value = 0; // Reinicia la barra de progreso
    document.getElementById('output').innerHTML = ''; // Limpia el contenido de salida

//    $("#div_listar_py").prop('hidden',false)
//	$("#div_subir_img_plano").prop('hidden',true)

    }




$(document).on("click","#btn_py_todos",function(){
		$("#txttipoorden").val($(this).data('tipoorden'))	
		$("#txtfiltro_buscar").val($(this).data('filtro_buscar'))				
		var axorden = 'ASC';
		$("#txtorden").val(axorden)	
		listar_proyectos()
	})

$(document).on("click","#btn_py_inactivos",function(){
		$("#txttipoorden").val($(this).data('tipoorden'))	
		$("#txtfiltro_buscar").val($(this).data('filtro_buscar'))				
		var axorden = 'ASC';
		$("#txtorden").val(axorden)	
		listar_proyectos()
	})


$(document).on("click","#btn_py_activos",function(){
		$("#txttipoorden").val($(this).data('tipoorden'))	
		$("#txtfiltro_buscar").val($(this).data('filtro_buscar'))				
		var axorden = 'ASC';
		$("#txtorden").val(axorden)	
		listar_proyectos()
	})


$(document).on("click","#btn_ordenar_estado_asc",function(){
		$("#txttipoorden").val($(this).data('tipoorden'))	
		//$("#txtfiltro_buscar").val($(this).data('filtro_buscar'))				
		var axorden = 'ASC';
		$("#txtorden").val(axorden)	
		listar_proyectos()
	})

$(document).on("click","#btn_ordenar_estado_desc",function(){
		
		$("#txttipoorden").val($(this).data('tipoorden'))	
		//$("#txtfiltro_buscar").val($(this).data('filtro_buscar'))		
		var axorden = 'DESC';
		$("#txtorden").val(axorden)			
		listar_proyectos()
	})

$(document).on("click","#btn_ordenar_vendidos_asc",function(){
		$("#txttipoorden").val($(this).data('tipoorden'))	
		//$("#txtfiltro_buscar").val($(this).data('filtro_buscar'))				
		var axorden = 'ASC';
		$("#txtorden").val(axorden)	
		listar_proyectos()
	})

$(document).on("click","#btn_ordenar_vendidos_desc",function(){
		
		$("#txttipoorden").val($(this).data('tipoorden'))
		//$("#txtfiltro_buscar").val($(this).data('filtro_buscar'))			
		var axorden = 'DESC';
		$("#txtorden").val(axorden)			
		listar_proyectos()
	})



$(document).on("click","#btn_ordenar_separados_asc",function(){
		$("#txttipoorden").val($(this).data('tipoorden'))
		//$("#txtfiltro_buscar").val($(this).data('filtro_buscar'))					
		var axorden = 'ASC';
		$("#txtorden").val(axorden)	
		listar_proyectos()
	})

$(document).on("click","#btn_ordenar_separados_desc",function(){
		
		$("#txttipoorden").val($(this).data('tipoorden'))	
		//$("#txtfiltro_buscar").val($(this).data('filtro_buscar'))		
		var axorden = 'DESC';
		$("#txtorden").val(axorden)			
		listar_proyectos()
	})


$(document).on("click","#btn_ordenar_disponible_asc",function(){
		$("#txttipoorden").val($(this).data('tipoorden'))
		//$("#txtfiltro_buscar").val($(this).data('filtro_buscar'))					
		var axorden = 'ASC';
		$("#txtorden").val(axorden)	
		listar_proyectos()
	})

$(document).on("click","#btn_ordenar_disponible_desc",function(){
		
		$("#txttipoorden").val($(this).data('tipoorden'))
		//$("#txtfiltro_buscar").val($(this).data('filtro_buscar'))			
		var axorden = 'DESC';
		$("#txtorden").val(axorden)			
		listar_proyectos()
	})

	
	$(document).on("click","#btn_ordenar_total_asc",function(){
		$("#txttipoorden").val($(this).data('tipoorden'))	
		//$("#txtfiltro_buscar").val($(this).data('filtro_buscar'))				
		var axorden = 'ASC';
		$("#txtorden").val(axorden)	
		listar_proyectos()
	})

	$(document).on("click","#btn_ordenar_total_desc",function(){
		
		$("#txttipoorden").val($(this).data('tipoorden'))
		//$("#txtfiltro_buscar").val($(this).data('filtro_buscar'))			
		var axorden = 'DESC';
		$("#txtorden").val(axorden)			
		listar_proyectos()
	})
	

	$(document).on("click","#btn_ordenar_desc",function(){
		
		$("#txttipoorden").val($(this).data('tipoorden'))	
		//$("#txtfiltro_buscar").val($(this).data('filtro_buscar'))		
		var axorden = 'DESC';
		$("#txtorden").val(axorden)			
		listar_proyectos()
	})


	$(document).on("click","#btn_ordenar_asc",function(){
		$("#txttipoorden").val($(this).data('tipoorden'))	
		//$("#txtfiltro_buscar").val($(this).data('filtro_buscar'))	
		
		var axorden = 'ASC';
		$("#txtorden").val(axorden)	
		listar_proyectos()
	})


$(document).on("click","#btn_ver_detalles_manzana",function(){

$("#txtubic_mz").val($(this).data('ubic'))

var axid_proyecto = $("#txtid_proyecto").val()
var axestado_producto = $("#txtestado_producto").val()
var axubic_mz =$("#txtubic_mz").val()

$.ajax({
	      url:"Proyectos_funciones.php",
	      method: "POST",
	      data: {param:15,
	      	txtid_proyecto:axid_proyecto,
					txtestado_producto:axestado_producto,
					txtubic_mz:axubic_mz
	    	},
	      success : function(data){
	        $("#div_productos_manzanas_detalles_py").html(data)
	      }

	    });


})



$(document).on("click","#btn_ver_detalles",function(){

$("#txtid_proyecto").val($(this).data('id'))
$("#txtestado_producto").val($(this).data('estado'))

var axid_proyecto = $("#txtid_proyecto").val()
var axestado_producto = $("#txtestado_producto").val()

$.ajax({
	      url:"Proyectos_funciones.php",
	      method: "POST",
	      data: {param:14,
	      	txtid_proyecto:axid_proyecto,
					txtestado_producto:axestado_producto
	    	},
	      success : function(data){	      	

	      	$("#div_listar_py").prop('hidden',true)
	      	$("#div_buscar_py").prop('hidden',true)

	      	$("#btn_retornar_de_detalles").prop('hidden',false)
	      	$("#btn_nuevo").prop('hidden',true)	      	

					$("#div_listar_productos_py").prop('hidden',false)
	        $("#div_productos_manzanas_py").html(data)

	      }
	    });


})


$(document).on("click","#btn_ver_py",function(){

var axid_proyecto = $(this).data('id')
window.open("proyectos_reporte.php?idpy="+axid_proyecto);

})






$(document).on("click","#btn_retornar_de_subir",function(){

$("#div_listar_py").prop('hidden',false)
$("#div_subir_img_plano").prop('hidden',true)


})

$(document).on("click","#btn_subir_productos_py",function(){

$("#txtid_proyecto_enviar").val($(this).data('id'))
$("#txttipo_archivo").val($(this).data('tipo'))
$("#div_listar_py").prop('hidden',true)
$("#div_subir_img_plano").prop('hidden',false)
$("#archivo_muestra").prop('hidden',false)
$('#fileInput').attr('accept', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel');
var axid_empresa = $("#txtid_empresa").val()
$("#txtid_empresa_file").val(axid_empresa);

})

$(document).on("click","#btn_subir_logo_py",function(){

$("#txtid_proyecto_enviar").val($(this).data('id'))
$("#txttipo_archivo").val($(this).data('tipo'))
$("#div_listar_py").prop('hidden',true)
$("#div_subir_img_plano").prop('hidden',false)
$("#archivo_muestra").prop('hidden',true)
$('#fileInput').attr('accept', 'image/*');

})

$(document).on("click","#btn_subir_plano_py",function(){

$("#txtid_proyecto_enviar").val($(this).data('id'))
$("#txttipo_archivo").val($(this).data('tipo'))
$("#div_listar_py").prop('hidden',true)
$("#div_subir_img_plano").prop('hidden',false)
$("#archivo_muestra").prop('hidden',true)
$('#fileInput').attr('accept', 'image/*');

})




$(document).on("click","#btn_eliminar_producto_py",function(){


$("#txtid_producto").val($(this).data('id'))
var axid_producto =$("#txtid_producto").val()

 var axmodulo = $("#txtmodulo").val()
 var axid_usuario = $("#txtid_usuario").val()
 var axid_proyecto = $("#txtid_proyecto").val()

Swal.fire({
  title: "Estas seguro?",
  text: "No podras revertir esto",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Si, Eliminar!"
}).then((result) => {
  if (result.isConfirmed) {

  	$.ajax({
      url:"Proyectos_funciones.php",
      method: "POST",
      data: {param:13,txtid_producto:axid_producto,
      txtmodulo:axmodulo,
	  txtid_usuario:axid_usuario,
	  txtid_proyecto:axid_proyecto

  },
      success : function(data){

      	if(data==0){

      		Swal.fire({
					  position: "center",
					  icon: "success",
					  title: "El registro fue eliminado",
					  showConfirmButton: false,
					  timer: 200
					});
						traer_productos()

      	}else{

      		Swal.fire({
						  title: "Advertencia",
						  text: "Error al intentar eliminar el regsitro",
						  icon: "error"
						});

      	}


      }
    });
  }
});





})


$(document).on("click","#btn_editar_producto_py",function(){

$("#txtid_producto").val($(this).data('id'))
var axid_producto =$("#txtid_producto").val()

//$("#btn_generar_codigo_producto").prop('disabled',true)
$("#txtparametros_producto").val(1);

	var axmodulo = $("#txtmodulo").val()
 	var axid_usuario = $("#txtid_usuario").val()
 	var axid_proyecto = $("#txtid_proyecto").val()

 	var axpermiso_editar = $("#txtpermiso_editar").val()	

		if(axpermiso_editar==0){


 $.ajax({

      url:"Proyectos_funciones.php",
      method: "POST",
      data: {param:12,txtid_producto:axid_producto,
      	txtmodulo:axmodulo,
		txtid_usuario:axid_usuario,
		txtid_proyecto:axid_proyecto
  },
      success : function(Traedatos){

      	var json = JSON.parse(Traedatos);
		
			if (json.status == 200){	

				$("#div_productos_py_listado").prop('hidden',true)
				$("#div_form_productos").prop('hidden',false)
				$("#div_productos_buscar_prod").prop('hidden',true)			
				
				$('#txtid_producto').val(json.ID_PRODUCTO);
				$('#txtid_proyecto').val(json.ID_PROYECTO);
				$('#txtcod_producto').val(json.COD_PRODUCTO);
				$('#txtestado_producto').val(json.ESTADO_PRODUCTO);
				$('#txttipo_producto').val(json.TIPO_PRODUCTO);
				$('#txtubic_mz').val(json.UBIC_MZ);
				$('#txtubic_lote').val(json.UBIC_LOTE);
				$('#txtmed_frente').val(json.MED_FRENTE);
				$('#txtmed_fondo').val(json.MED_FONDO);
				$('#txtmed_derecha').val(json.MED_DERECHA);
				$('#txtmed_izquierda').val(json.MED_IZQUIERDA);
				$('#txtmed_perimetro').val(json.MED_PERIMETRO);
				$('#txtarea_m2').val(json.AREA_M2);
				$('#txtubic_plano').val(json.UBIC_PLANO);
				$('#txtprecio_lista').val(json.PRECIO_LISTA);

			

	
			

			}
        
    }
    
  });
}else{
		Swal.fire("Aviso", "Usted no tiene permiso para EDITAR", "warning")	
		}
})


$(document).on("click","#btn_generar_codigo_producto",function(){

$.ajax({
	      url:"funciones.php",
	      method: "POST",
	      data: {param:0},
	      success : function(data){	      	
	        $("#txtcod_producto").val(data)
	      }
	    });
})


$(document).on("click","#btn_grabar_producto_py",function(){

	

	 // Verificar campos vacíos
    if (verificarCamposVacios_py_productos()) {
        // Si hay campos vacíos, detener la ejecución
        return;
    }

	
  var axid_producto =   $('#txtid_producto').val();	
  var axid_proyecto =   $('#txtid_proyecto').val();
  var axcodigo_py=$('#txtcodigo_py').val();
  var axcod_producto =   $('#txtcod_producto').val();
  var axestado_producto =   $('#txtestado_producto').val();
  var axtipo_producto =   $('#txttipo_producto').val();
  var axubic_mz =   $('#txtubic_mz').val();
  var axubic_lote =   $('#txtubic_lote').val();
  var axmed_frente =   $('#txtmed_frente').val();
  var axmed_fondo =   $('#txtmed_fondo').val();
  var axmed_derecha =   $('#txtmed_derecha').val();
  var axmed_izquierda =   $('#txtmed_izquierda').val();
  var axmed_perimetro =   $('#txtmed_perimetro').val();
  var axarea_m2 =   $('#txtarea_m2').val();
  var axubic_plano =   $('#txtubic_plano').val();
  var axprecio_lista =   $('#txtprecio_lista').val();
  var axparametros_producto = $('#txtparametros_producto').val()

  var axmodulo = $("#txtmodulo").val()
  var axid_usuario = $("#txtid_usuario").val()

  if(axestado_producto == ''){

  	Swal.fire({
			title: "Advertencia",
			text: "Seleccionar el Estado actual",
			icon: "warning"
		});

  }else if(axubic_mz==''){

  	Swal.fire({
			title: "Advertencia",
			text: "Ingrese la Manzana",
			icon: "warning"
		});

  }else if(axubic_lote==''){

  		Swal.fire({
			title: "Advertencia",
			text: "Ingrese el Lote",
			icon: "warning"
		});

   }else if(axcod_producto==''){

  		Swal.fire({
			title: "Advertencia",
			text: "Generar el Codigo QR",
			icon: "warning"
		});

  }else{

		 $.ajax({
      url:"Proyectos_funciones.php",
      method: "POST",
      data: {param:11,

      		
      		txtid_producto:axid_producto,
					txtid_proyecto:axid_proyecto,
      		txtcod_producto:axcod_producto,
					txtestado_producto:axestado_producto,
					txttipo_producto:axtipo_producto,
					txtubic_mz:axubic_mz,
					txtubic_lote:axubic_lote,
					txtmed_frente:axmed_frente,
					txtmed_fondo:axmed_fondo,
					txtmed_derecha:axmed_derecha,
					txtmed_izquierda:axmed_izquierda,
					txtmed_perimetro:axmed_perimetro,
					txtarea_m2:axarea_m2,
					txtubic_plano:axubic_plano,
					txtprecio_lista:axprecio_lista,
					txtparametros_producto:axparametros_producto,
					txtmodulo:axmodulo,
					txtid_usuario:axid_usuario,
					txtcodigo_py:axcodigo_py
    	},
      success : function(data){

      		if(data==0){

        	Swal.fire({
					  position: "center",
					  icon: "success",
					  title: "El registro fue guardado",
					  showConfirmButton: false,
					  timer: 200
					});
					traer_productos()

						$("#div_productos_py_listado").prop('hidden',false)
						$("#div_form_productos").prop('hidden',true)
						$("#div_productos_buscar_prod").prop('hidden',false)
						


        }else{

        	Swal.fire({
						  title: "Advertencia",
						  text: "Error al guardar el registro",
						  icon: "error"
						});

        }
       		
        
      }
    });

  }


})



	
$(document).on("click","#btn_cerrar_modal",function(){
limpiar_modal()	
})



$(document).on("click","#btn_cerrar_form_prod",function(){

	$("#div_productos_py_listado").prop('hidden',false)
	$("#div_form_productos").prop('hidden',true)
	$("#div_productos_buscar_prod").prop('hidden',false)
	
	
})



$(document).on("click","#btn_nuevo_producto",function(){

	$("#div_productos_py_listado").prop('hidden',true)
	$("#div_form_productos").prop('hidden',false)
	$("#div_productos_buscar_prod").prop('hidden',true)
	$("#txtparametros_producto").val(0)
	
})



$(document).on("click","#btn_buscra_producto",function(){
	traer_productos()	
})


function traer_productos(){

	var axid_proyecto = $("#txtid_proyecto").val()
	var axbuscar_producto = $("#txtbuscar_producto").val()
	var axcodigo_py=$('#txtcodigo_py').val();

	$("#div_esperando_productos").prop('hidden',false)

	 $.ajax({
      url:"Proyectos_funciones.php",
      method: "POST",
      data: {param:10,
      	txtid_proyecto:axid_proyecto,
      	txtbuscar_producto:axbuscar_producto,
      	txtcodigo_py:axcodigo_py
      },
      success : function(data){
       		$("#div_esperando_productos").prop('hidden',true)
        $('#div_productos_py_listado').html(data);
        
      }
    });

}


$(document).on("click","#btn_eliminar_detalle_py",function(){

$("#txtid_detalle").val($(this).data('id'))
var axid_detalle = $("#txtid_detalle").val()
var axid_proyecto = $("#txtid_proyecto").val()


Swal.fire({
  title: "Estas seguro?",
  text: "No podras revertir esto",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Si, Eliminar!"
}).then((result) => {
  if (result.isConfirmed) {

  	$.ajax({
      url:"Proyectos_funciones.php",
      method: "POST",
      data: {param:18,
      txtid_detalle:axid_detalle,
      txtid_proyecto:axid_proyecto
  },
      success : function(data){

      	if(data==0){

      		Swal.fire({
					  position: "center",
					  icon: "success",
					  title: "El registro fue eliminado",
					  showConfirmButton: false,
					  timer: 200
					});
					listar_caracteristicas()

      	}else{

      		Swal.fire({
						  title: "Advertencia",
						  text: "Error al intentar eliminar el regsitro",
						  icon: "error"
						});

      	}


      }
    });
  }

});

})


$(document).on("click","#btn_editar_detalle_py",function(){

$("#txtid_detalle").val($(this).data('id'))
var axid_detalle = $("#txtid_detalle").val()
var axid_proyecto = $("#txtid_proyecto").val()

var axpermiso_editar = $("#txtpermiso_editar").val()	

$("#txtparametros_detalle").val(1);

if(axpermiso_editar==0){ 

	$.ajax({

      url:"Proyectos_funciones.php",
      method: "POST",
      data: {param:9,txtid_detalle:axid_detalle,txtid_proyecto:axid_proyecto},
      success : function(Traedatos){

      	var json = JSON.parse(Traedatos);
		
			if (json.status == 200){

				$("#btn_grabar_detalle_py").text("Actualizar");					
				
				$("#txtid_detalle").val(json.ID_DETALLE);
				$("#txtid_proyecto").val(json.ID_PROYECTO);
				$("#txttipo_caracteristica").val(json.TIPO_CARACTERISTICA);
				$("#txtestado_caracteristica").val(json.ESTADO_CARACTERISTICA);
				$("#txtnom_caracteristicas").val(json.NOM_CARACTERISTICAS);
				$("#txtdetalle").val(json.DETALLE);
	
			}
        
    }
    
  });

}else{
	Swal.fire("Aviso", "Usted no tiene permiso para EDITAR", "warning")
}




/*
Swal.fire({
  title: "Estas seguro?",
  text: "No podras revertir esto",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Si, Eliminar!"
}).then((result) => {
  if (result.isConfirmed) {

  	$.ajax({
      url:"Proyectos_funciones.php",
      method: "POST",
      data: {param:9,
      txtid_detalle:axid_detalle,
      txtid_proyecto:axid_proyecto,
	  txtmodulo:axmodulo,
	  txtid_usuario:axid_usuario
  },
      success : function(data){

      	if(data==0){

      		Swal.fire({
					  position: "center",
					  icon: "success",
					  title: "El registro fue eliminado",
					  showConfirmButton: false,
					  timer: 200
					});
					listar_caracteristicas()

      	}else{

      		Swal.fire({
						  title: "Advertencia",
						  text: "Error al intentar eliminar el regsitro",
						  icon: "error"
						});

      	}


      }
    });
  }

});
*/




})



$(document).on("click","#btn_caracteristcias",function(){

	$("#txtnom_caracteristicas").val($(this).text());
	$("#div_listar_nom_caracteristicas").fadeOut();

})
		
 




$('#txtnom_caracteristicas').keyup(function(){

  var axbuscar = $("#txtnom_caracteristicas").val();
  var axtipo_caracteristica = $("#txttipo_caracteristica").val()

  if (axbuscar != '') {

    $.ajax({
      url:"Proyectos_funciones.php",
      method: "POST",
      data: {param:8,txtnom_caracteristicas:axbuscar,txttipo_caracteristica:axtipo_caracteristica},
      success : function(data){

        $('#div_listar_nom_caracteristicas').fadeIn();
        $('#div_listar_nom_caracteristicas').html(data);
        
      }
    });
  } 
});



$(document).on("click","#btn_grabar_detalle_py",function(){

var axid_detalle = $("#txtid_detalle").val();
var axid_proyecto = $("#txtid_proyecto").val();
var axtipo_caracteristica = $("#txttipo_caracteristica").val();
var axestado_caracteristica = $("#txtestado_caracteristica").val();
var axnom_caracteristicas = $("#txtnom_caracteristicas").val();
var axdetalle = $("#txtdetalle").val();
var axparametros_detalle = $("#txtparametros_detalle").val();
var axcodigo_py =  $("#txtcodigo_py").val()

var axmodulo = $("#txtmodulo").val()
var axid_usuario = $("#txtid_usuario").val()

if(axnom_caracteristicas == '') {

		Swal.fire({
			 title: "Advertencia",
				text: "Falta ingresar Descripción",
				icon: "warning"
		});

}else if(axdetalle == ''){

		Swal.fire({
			 title: "Advertencia",
				text: "Falta ingresar Detalle",
				icon: "warning"
		});

}else{


	$.ajax({
      url:"Proyectos_funciones.php",
      method: "POST",
      data: {param:7,

      		txtid_detalle:axid_detalle,
      		txtid_proyecto:axid_proyecto,
					txttipo_caracteristica:axtipo_caracteristica,
					txtestado_caracteristica:axestado_caracteristica,
					txtnom_caracteristicas:axnom_caracteristicas,
					txtdetalle:axdetalle,
					txtcodigo_py:axcodigo_py,
					txtparametros_detalle:axparametros_detalle,
					txtmodulo:axmodulo,
					txtid_usuario:axid_usuario


    	},
      success : function(data){

      	if(data==0){

        	Swal.fire({
					  position: "center",
					  icon: "success",
					  title: "El registro fue guardado",
					  showConfirmButton: false,
					  timer: 200
					});

					$("#txtnom_caracteristicas").val('')
					$("#txtdetalle").val('')
					$("#txtparametros_detalle").val(0);
				
				listar_caracteristicas()
        }else{

        	Swal.fire({
						  title: "Advertencia",
						  text: "Error al guardar el registro",
						  icon: "error"
						});

        }        
             
      }
    });

}


})



$(document).on("change","#txttipo_caracteristica",function(){
listar_caracteristicas()

})


function listar_caracteristicas() {

	var axid_proyecto = $("#txtid_proyecto").val()
	var axtipo_caracteristica = $("#txttipo_caracteristica").val()
	var axcodigo_py = $("#txtcodigo_py").val()

	$("#div_esperando_detalles").prop('hidden',false)


	$.ajax({
      url:"Proyectos_funciones.php",
      method: "POST",
      data: {param:6,txtid_proyecto:axid_proyecto,txttipo_caracteristica:axtipo_caracteristica,txtcodigo_py:axcodigo_py},
      success : function(data){
        
        	$("#div_esperando_detalles").prop('hidden',true)
        $('#div_listar_caracteristicas').html(data)	;
        
      }
    });


	
}


$(document).on("click","#pn_productos_py",function(){

	$("#div_datos_py").prop('hidden',true)
	$("#div_detalles_py").prop('hidden',true)
	$("#div_mapa_py").prop('hidden',true)
	$("#div_productos_py").prop('hidden',false)
	

	var elemento1 = document.getElementById("pn_datos_py");
	var elemento2 = document.getElementById("pn_detalles_py");
	var elemento3 = document.getElementById("pn_mapa_py");
	var elemento4 = document.getElementById("pn_productos_py");
	
	elemento1.className = "nav-link";
	elemento2.className = "nav-link";
	elemento3.className = "nav-link";
	elemento4.className = "nav-link active";

	var axdescripcion_py = $("#txtdescripcion_py").val();
	$("#nom_proyecto_productos").html(axdescripcion_py)	
	traer_productos()

})



$(document).on("click","#pn_mapa_py",function(){

	$("#div_datos_py").prop('hidden',true)
	$("#div_detalles_py").prop('hidden',true)
	$("#div_mapa_py").prop('hidden',false)
	$("#div_productos_py").prop('hidden',true)

	var elemento1 = document.getElementById("pn_datos_py");
	var elemento2 = document.getElementById("pn_detalles_py");
	var elemento3 = document.getElementById("pn_mapa_py");
	var elemento4 = document.getElementById("pn_productos_py");	
	
	elemento1.className = "nav-link";
	elemento2.className = "nav-link";
	elemento3.className = "nav-link active";
	elemento4.className = "nav-link";

var axdescripcion_py = $("#txtdescripcion_py").val();
$("#nom_proyecto_mapa").html(axdescripcion_py)	

})


$(document).on("click","#pn_detalles_py",function(){

	$("#div_datos_py").prop('hidden',true)
	$("#div_detalles_py").prop('hidden',false)
	$("#div_mapa_py").prop('hidden',true)
	$("#div_productos_py").prop('hidden',true)

	var elemento1 = document.getElementById("pn_datos_py");
	var elemento2 = document.getElementById("pn_detalles_py");
	var elemento3 = document.getElementById("pn_mapa_py");
	var elemento4 = document.getElementById("pn_productos_py");	
	
	elemento1.className = "nav-link";
	elemento2.className = "nav-link active";
	elemento3.className = "nav-link";
	elemento4.className = "nav-link";

	listar_caracteristicas()
	var axdescripcion_py = $("#txtdescripcion_py").val();
	$("#nom_proyecto_detalle").html(axdescripcion_py)
	

})

$(document).on("click","#pn_datos_py",function(){

	$("#div_datos_py").prop('hidden',false)
	$("#div_detalles_py").prop('hidden',true)
	$("#div_mapa_py").prop('hidden',true)
	$("#div_productos_py").prop('hidden',true)
	

	var elemento1 = document.getElementById("pn_datos_py");
	var elemento2 = document.getElementById("pn_detalles_py");
	var elemento3 = document.getElementById("pn_mapa_py");
	var elemento4 = document.getElementById("pn_productos_py");	
	
	elemento1.className = "nav-link active";
	elemento2.className = "nav-link";
	elemento3.className = "nav-link";
	elemento4.className = "nav-link";

})


$(document).on("click","#btn_eliminar_py",function(){


$("#txtid_proyecto").val($(this).data('id'))
var axid_proyecto = $("#txtid_proyecto").val()

var axmodulo = $("#txtmodulo").val()
var axid_usuario = $("#txtid_usuario").val()

Swal.fire({
  title: "Estas seguro?",
  text: "No podras revertir esto",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Si, Eliminar!"
}).then((result) => {
  if (result.isConfirmed) {

  		$.ajax({

      url:"Proyectos_funciones.php",
      method: "POST",
      data: {
      	param:5,
      	txtid_proyecto:axid_proyecto,
      	txtmodulo:axmodulo,
		txtid_usuario:axid_usuario
  	},
      success : function(data){

      	if(data==0){

      		Swal.fire({
					  position: "center",
					  icon: "success",
					  title: "El registro fue eliminado",
					  showConfirmButton: false,
					  timer: 200
					});
				listar_proyectos()

      	}else{

      		Swal.fire({
						  title: "Advertencia",
						  text: "Error al intentar eliminar el regsitro",
						  icon: "error"
						});

      	}


    }
    
  });


    
  }
});


 


})



$(document).on("click","#btn_editar_py",function(){


$("#txtid_proyecto").val($(this).data('id'))
var axid_proyecto = $("#txtid_proyecto").val()
$("#txtparametros").val(1);
$("#btn_grabar_py").prop('disabled',false)

	var axpermiso_editar = $("#txtpermiso_editar").val()	

		if(axpermiso_editar==0){

	 $.ajax({

      url:"Proyectos_funciones.php",
      method: "POST",
      data: {param:4,txtid_proyecto:axid_proyecto},
      success : function(Traedatos){

      	var json = JSON.parse(Traedatos);
		
			if (json.status == 200){

				$("#div_datos_py").prop('hidden',false)
				$("#div_detalles_py").prop('hidden',true)
				$("#div_mapa_py").prop('hidden',true)
				$("#div_productos_py").prop('hidden',true)	

				var elemento1 = document.getElementById("pn_datos_py");
				var elemento2 = document.getElementById("pn_detalles_py");
				var elemento3 = document.getElementById("pn_mapa_py");
				var elemento4 = document.getElementById("pn_productos_py");

				elemento1.className = "nav-link active";
				elemento2.className = "nav-link ";
				elemento3.className = "nav-link";
				elemento4.className = "nav-link";			
				
				$("#txtid_empresa").val(json.ID_EMPRESA);
				$("#txtid_proyecto").val(json.ID_PROYECTO);
				$("#txtubigeo_py").val(json.UBIGEO_PY);
				$("#txtfecha_registro_py").val(json.FECHA_REGISTRO_PY);
				$("#txtcodigo_py").val(json.CODIGO_PY);
				$("#txtdescripcion_py").val(json.DESCRIPCION_PY);
				$("#txtnombre_corto_py").val(json.NOMBRE_CORTO_PY);
				$("#txtestado_py").val(json.ESTADO_PY);
				$("#txtubicacion_py").val(json.UBICACION_PY);
				$("#txtdistrito_py").val(json.DISTRITO_PY);
				$("#txtprovincia_py").val(json.PROVINCIA_PY);
				$("#txtdepartamento_py").val(json.DEPARTAMENTO_PY);
				$("#txtcontacto_py").val(json.CONTACTO_PY);
				$("#txtubicacion_digital_mapa").val(json.UBICACION_DIGITAL_MAPA);

				$("#txtunida_catastral").val(json.UNIDAD_CATASTRAL)
				$("#txtpartida_registral").val(json.PARTIDA_REGISTRAL)

				$("#txtbuscar_distrito").val(json.DISTRITO_PY+' - '+json.PROVINCIA_PY+' - '+json.DEPARTAMENTO_PY);

				$("#frm_mapa").html(json.UBICACION_DIGITAL_MAPA);
				

				$("#btn_generar_codigo").prop('disabled',true)
				
				
	

			}
        
    }
    
  });

}else{
			Swal.fire("Aviso", "Usted no tiene permiso para EDITAR", "warning")
		$("#exampleModal").modal('hide',true)
}

})




	$(document).on("keyup","#txtbuscar_proyecto",function(){
		listar_proyectos()
	})




function listar_proyectos() {

var axorden =  $("#txtorden").val()	
var axtipoorden =  $("#txttipoorden").val()
var axidempresa = $("#txtid_empresa").val();
var axbuscar = $("#txtbuscar_proyecto").val();
	
var axfiltro_buscar = $("#txtfiltro_buscar").val();
		
var axnom_tabla = $("#txtnom_tabla").val()
var axtipo_busqueda = $("#txttipo_busqueda").val()			
var axcampo_tabla = $("#txtcampo_tabla").val()	
var axcampo_tabla_orden = $("#txtcampo_tabla_orden").val()	
var axcampo_contenido = $("#txtcampo_contenido").val()	

var axpermiso_editar = $("#txtpermiso_editar").val()	

$.ajax({
      url:"Proyectos_funciones.php",
      method: "POST",      
      data: {param:3,
      	txtid_empresa:axidempresa,
				txtbuscar_proyecto:axbuscar,
				txtorden:axorden,
				txttipoorden:axtipoorden,
				txtfiltro_buscar:axfiltro_buscar,	
				txtnom_tabla:axnom_tabla,
				txttipo_busqueda:axtipo_busqueda,
				txtcampo_tabla:axcampo_tabla,
				txtcampo_tabla_orden:axcampo_tabla_orden,
				txtcampo_contenido:axcampo_contenido,
				txtpermiso_editar:axpermiso_editar

  	},
      success : function(data){
        
        $('#div_listar_py').html(data);
 
      }
    });
	

}


$(document).on("click","#btn_grabar_py",function(){


	 // Verificar campos vacíos
    if (verificarCamposVacios_py()) {
        // Si hay campos vacíos, detener la ejecución
        return;
    }

	var axid_empresa = $("#txtid_empresa").val();
	var axid_proyecto = $("#txtid_proyecto").val();
	var axubigeo_py = $("#txtubigeo_py").val();
	var axfecha_registro_py = $("#txtfecha_registro_py").val();
	var axcodigo_py = $("#txtcodigo_py").val();
	var axdescripcion_py = $("#txtdescripcion_py").val();
	var axnombre_corto_py = $("#txtnombre_corto_py").val();
	var axestado_py = $("#txtestado_py").val();
	var axubicacion_py = $("#txtubicacion_py").val();
	var axdistrito_py = $("#txtdistrito_py").val();
	var axprovincia_py = $("#txtprovincia_py").val();
	var axdepartamento_py = $("#txtdepartamento_py").val();
	var axcontacto_py = $("#txtcontacto_py").val();
	var axparametros = $("#txtparametros").val();
	var axubicacion_digital_mapa = $("#txtubicacion_digital_mapa").val();

	var axid_usuario = $("#txtid_usuario").val()
		
	var axunida_catastral = $("#txtunida_catastral").val()
	var axpartida_registral = $("#txtpartida_registral").val()

	var axfecha_entrega_py = $("#txtfecha_entrega_py").val()

	

	
	var axmodulo = $("#txtmodulo").val()

	$("#nom_proyecto").html(axdescripcion_py)

	if(axcodigo_py ==''){

		Swal.fire({
			title: "Advertencia",
			text: "Debe generar el codigo del proyecto",
			icon: "warning"
		});

	}else{

	$.ajax({
      url:"Proyectos_funciones.php",
      method: "POST",
      data: {param:2,

      	txtid_empresa:axid_empresa,
      	txtid_proyecto:axid_proyecto,
				txtubigeo_py:	axubigeo_py,
				txtfecha_registro_py:	axfecha_registro_py,
				txtcodigo_py:	axcodigo_py,
				txtdescripcion_py:	axdescripcion_py,
				txtnombre_corto_py:	axnombre_corto_py,
				txtestado_py:	axestado_py,
				txtubicacion_py:	axubicacion_py,
				txtdistrito_py:	axdistrito_py,
				txtprovincia_py:	axprovincia_py,
				txtdepartamento_py:	axdepartamento_py,
				txtcontacto_py:	axcontacto_py,
				txtubicacion_digital_mapa:axubicacion_digital_mapa,
				txtparametros:	axparametros,
				txtmodulo:axmodulo,				
				txtid_usuario:axid_usuario,
				txtunida_catastral:axunida_catastral,
				txtpartida_registral:axpartida_registral,
				txtfecha_entrega_py:axfecha_entrega_py
    	},
      success : function(data){

        if(data==0){

        	Swal.fire({
					  position: "center",
					  icon: "success",
					  title: "El registro fue guardado",
					  showConfirmButton: false,
					  timer: 200
					});
				listar_proyectos()
				listar_caracteristicas()

				$("#div_datos_py").prop('hidden',true)
				$("#div_detalles_py").prop('hidden',false)
				$("#div_mapa_py").prop('hidden',true)
				$("#div_productos_py").prop('hidden',true)	

				var elemento1 = document.getElementById("pn_datos_py");
				var elemento2 = document.getElementById("pn_detalles_py");
				var elemento3 = document.getElementById("pn_mapa_py");
				var elemento4 = document.getElementById("pn_productos_py");

				elemento1.className = "nav-link";
				elemento2.className = "nav-link active";
				elemento3.className = "nav-link";
				elemento4.className = "nav-link";

				$("#nom_proyecto_mapa").html(axdescripcion_py)
				$("#nom_proyecto_detalle").html(axdescripcion_py)

				$("#btn_grabar_py").prop('disabled',true)

        }else{

        	Swal.fire({
						  title: "Advertencia",
						  text: "Error al guardar el registro",
						  icon: "error"
						});

        }
        
      }
    });


	}


})





$(document).on("click","#btn_lista_ubigeos",function(){
		
 	$("#txtubigeo_py").val($(this).data('id'));
 	var axubigeo_py  = $("#txtubigeo_py").val();
 	$("#txtbuscar_distrito").val($(this).text());
	
 	 $.ajax({

      url:"Proyectos_funciones.php",
      method: "POST",
      data: {param:1,txtubigeo_py:axubigeo_py},
      success : function(Traedatos){

      	var json = JSON.parse(Traedatos);
		
			if (json.status == 200){				
				
				$("#txtdistrito_py").val(json.DISTRITO);
				$("#txtprovincia_py").val(json.PROVINCIA);
				$("#txtdepartamento_py").val(json.DEPARTAMENTO);
							

			}
        
    }
    
  });
  	$("#div_listar_ubigeos").fadeOut();
});



$('#txtbuscar_distrito').keyup(function(){

  var axbuscar_distrito = $("#txtbuscar_distrito").val();

  if (axbuscar_distrito != '') {

    $.ajax({
      url:"Proyectos_funciones.php",
      method: "POST",
      data: {param:0,txtbuscar_distrito:axbuscar_distrito},
      success : function(data){

        $('#div_listar_ubigeos').fadeIn();
        $('#div_listar_ubigeos').html(data);
        
      }
    });
  } 
});


$(document).on("click","#btn_generar_codigo",function(){

$.ajax({
	      url:"funciones.php",
	      method: "POST",
	      data: {param:0},
	      success : function(data){	      	
	        $("#txtcodigo_py").val(data)
	      }
	    });
})



$(document).on("click","#btn_nuevo",function(){
$("#txtparametros").val(0);

	var elemento2 = document.getElementById("pn_detalles_py");
	var elemento3 = document.getElementById("pn_mapa_py");
	var elemento4 = document.getElementById("pn_productos_py");

	elemento2.className = "nav-link disabled";
	elemento3.className = "nav-link disabled";
	elemento4.className = "nav-link disabled";

	$("#div_btn_grabar_py").prop('disabled',false)


})


/************************************/
$(document).on("click","#help-button",function(){
traer_videos()

})

function traer_videos() {
	var axmodulo = $("#txtmodulo").val()
	
	$.ajax({
	      url:"funciones.php",
	      method: "POST",
	      data: {param:1,txtmodulo:axmodulo},
	      success : function(data){	      	
	        $('#div_listar_videos_tutoriales').html(data);
	      }
	    });
	
}

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

	
			$("#titulo_formulario").html("<i class='bi bi-building-fill-gear' style='font-size:25px;'></i> "+data +" <button type='button' id='btn_nuevo'  class='btn btn-outline-primary btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='bi bi-file-earmark-plus'></i> Nuevo</button>")	


		}
	})

}


function Verifica_permiso_editar(){

	var axiduser =$("#txtid_usuario").val();
	var axtipo_beneficiario =$("#txttipo_beneficiario").val();	
	var axpermiso_1 = 'PROYECTOS EDITAR';
	$("#txtmodulo_eliminar").val(axpermiso_1);
	var axmodulo = $("#txtmodulo_eliminar").val();
	
	$.ajax({
		url:"funciones.php",
		method: "POST",
		data: {param:7,txtid_usuario:axiduser,txtmodulo_eliminar:axmodulo},
		success : function(permiso){

			$("#txtpermiso_editar").val(permiso)
		}
		})

}


function Verifica_permiso(){

	var axiduser =$("#txtid_usuario").val();
	var axtipo_beneficiario =$("#txttipo_beneficiario").val();	
	var axpermiso_1 = 'PROYECTOS';	
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


function  limpiar_modal() {
	
        // Limpiar campos de texto
       
        $('#txtubigeo_py').val('');
        $('#txtfecha_registro_py').val('');
        $('#txtcodigo_py').val('');
        $('#txtestado_py').val('');
        $('#txtdescripcion_py').val('');
        $('#txtnombre_corto_py').val('');
        $('#txtubicacion_py').val('');
        $('#txtubicacion_digital_mapa').val('');
        $('#txtdistrito_py').val('');
        $('#txtbuscar_distrito').val('');
        $('#txtprovincia_py').val('');
        $('#txtdepartamento_py').val('');
        $('#txtcontacto_py').val('');

        // Limpiar campos de detalles
        $('#txtid_detalle').val('');
        $('#nom_proyecto_detalle').text('');
        $('#txttipo_caracteristica').val('');
        $('#txtestado_caracteristica').val('');
        $('#txtnom_caracteristicas').val('');
        $('#txtdetalle').val('');

        // Limpiar campos de mapa
        $('#nom_proyecto_mapa').text('');

        // Limpiar campos de productos
        $('#nom_proyecto_productos').text('');
        $('#txtbuscar_producto').val('');
        $('#txtcod_producto').val('');
        $('#txtestado_producto').val('');
        //$('#txttipo_producto').val('');
        $('#txtubic_mz').val('');
        $('#txtubic_lote').val('');
        $('#txtmed_frente').val('0');
        $('#txtmed_fondo').val('0');
        $('#txtmed_derecha').val('0');
        $('#txtmed_izquierda').val('0');
        $('#txtmed_perimetro').val('0');
        $('#txtarea_m2').val('0');
        $('#txtubic_plano').val('');
        $('#txtprecio_lista').val('0');

             // Limpiar listados o resultados
        $('#div_listar_ubigeos').empty();
        $('#div_listar_caracteristicas').empty();
        $('#div_productos_py_listado').empty();


}


  function limpiarContenedor_doc() {
        document.getElementById('fileInput_doc').value = ''; // Limpia el campo de entrada de archivos
        document.getElementById('progressBar_doc').value = 0; // Reinicia la barra de progreso
        document.getElementById('output_doc').innerHTML = ''; // Limpia el contenido de salida
    }


function uploadFile_doc() {


    var fileInput = document.getElementById('fileInput_doc');
    var idpy = document.getElementById('txtid_proyecto_doc');
    var iddt = document.getElementById('txtid_detalle_doc');
    var empresa = document.getElementById('txtid_empresa_file_doc');
            
    var progressBar = document.getElementById('progressBar_doc');
    var output = document.getElementById('output_doc');

    if (fileInput.files.length > 0) {
        var file = fileInput.files[0];

        // Utilizas FormData para enviar el archivo y txtid_proyecto_enviar
        var formData = new FormData();
        formData.append('fileInput_doc', file);
        formData.append('txtid_proyecto_doc', idpy.value); // Obtén el valor del input
        formData.append('txtid_detalle_doc', iddt.value); // Obtén el valor del input
        formData.append('txtid_empresa_file_doc', empresa.value); // Obtén el valor del input

        var xhr = new XMLHttpRequest();

        xhr.open('POST', 'upload_doc.php', true);

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




  function limpiarContenedor() {
        document.getElementById('fileInput').value = ''; // Limpia el campo de entrada de archivos
        document.getElementById('progressBar').value = 0; // Reinicia la barra de progreso
        document.getElementById('output').innerHTML = ''; // Limpia el contenido de salida

        $("#div_listar_py").prop('hidden',false)
		$("#div_subir_img_plano").prop('hidden',true)

    }


 function uploadFile() {

    var fileInput = document.getElementById('fileInput');
    var idpy = document.getElementById('txtid_proyecto_enviar');
    var tipo = document.getElementById('txttipo_archivo');
    var empresa = document.getElementById('txtid_empresa_file');


    
    
    var progressBar = document.getElementById('progressBar');
    var output = document.getElementById('output');

    if (fileInput.files.length > 0) {
        var file = fileInput.files[0];

        // Utilizas FormData para enviar el archivo y txtid_proyecto_enviar
        var formData = new FormData();
        formData.append('fileInput', file);
        formData.append('txtid_proyecto_enviar', idpy.value); // Obtén el valor del input
        formData.append('txttipo_archivo', tipo.value); // Obtén el valor del input
        formData.append('txtid_empresa_file', empresa.value); // Obtén el valor del input

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

function verificarCamposVacios_py() {
   var elementos = document.querySelectorAll('#div_datos_py input, #div_datos_py select');
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

function verificarCamposVacios_py_productos() {
   var elementos = document.querySelectorAll('#div_form_productos input, #div_form_productos select');
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

function convertirAMayusculas(input) {
  input.value = input.value.toUpperCase();
}




</script>


