<?php require_once '../includes/header.php'; ?>


<!DOCTYPE html>
	<html>
	<head>

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

        .list-group-item:hover a {
    color: #ff0000; /* Cambia el color a tu preferencia */
    font-weight: bold; /* Otras propiedades de estilo que desees aplicar */
  }


	</style>
		    
	</head>
	<body>
	<!--body style="margin: 3; padding: 3; background: url(../img/usuario.PNG) no-repeat center top;  background-size: cover;  font-family: sans-serif;  height: 100vh;"-->
	<br>
	<div class="container-fluid">
      
    <input type="hidden" name="txtid_empresa" id="txtid_empresa" value="<?php echo "$axidempresa";?>">	
		<input type="hidden" name="txtid_usuario" id="txtid_usuario" value="<?php echo "$axid_usuario";?>">
		<input type="hidden" name="txtfecharegistro" id="txtfecharegistro" value="<?php echo "$diaactual";?>">
		<input type="hidden" name="txtparametros" id="txtparametros">
		<input type="hidden" name="txtidusuario" id="txtidusuario">
		<input type="hidden" name="txtidpermiso" id="txtidpermiso">
		<input type="hidden" name="txtidasinacion" id="txtidasinacion">
		<input type="hidden" name="txtserie" id="txtserie">
		<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axcoduser";?>">
		<input type="hidden" name="txttipo_archivo" id="txttipo_archivo">
		<input type="hidden" name="txttipoorden" id="txttipoorden">
		<input type="hidden" name="txtorden" id="txtorden">			
		<input type="hidden" name="txtfiltro_buscar" id="txtfiltro_buscar">	

		<input type="hidden" id="txtnom_tabla" value='USUARIOS_LISTAR'>	
		<input type="hidden" id="txttipo_busqueda">	
		<input type="hidden" id="txtcampo_contenido">	
		<input type="hidden" id="txtcampo_tabla">	
		<input type="hidden" id="txtcampo_tabla_orden">	

		<input type="hidden" id="txtpermiso_editar">	
		<input type="hidden" id="txtmodulo_eliminar">
		
        <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">	  	
            <div class="card">
              <div class="card-header" >	
	            		
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
							    	<!--div class="list-group" id='div_filtros' style="font-size: 12px;"></div-->							 							    
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
							    	<!--div class="list-group" id='div_ordenar' style="font-size: 12px;"></div-->							 			
							  	</form>
							</div>
							</div>

							</div>
		  					


						<div class="col-md-4" style="align-items: center;" >
							<div class="input-group mb-3">		
							  
							  <!--button type='button' id='btn_perfil_activos' data-tipoorden='ACTIVO' data-filtro_buscar='ACTIVO' class='btn btn-outline-success btn-sm'><i class='bi bi-check-circle-fill' style='font-size:15pX;'></i>  ACTIVOS</button>
					          <button type='button' id='btn_perfil_inactivos' data-tipoorden='INACTIVO' data-filtro_buscar='INACTIVO' class='btn btn-outline-danger  btn-sm'><i class='bi bi-dash-circle-fill' style='font-size:15pX;'></i> INACTIVOS</button>
					          <button type='button' id='btn_perfil_todos' data-tipoorden='TODOS' data-filtro_buscar='' class='btn btn-outline-warning btn-sm'><i class='bi bi-arrow-clockwise' style='font-size:15pX;'></i> TODOS</button-->
					          <input type="text" class="form-control" id="txtbuscarusuario" placeholder="Buscar "oninput="convertirAMayusculas(this)">
					           <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
							</div>
						</div>

						</div>

  			        
              </div>

              <div class="card-body">
              	
              <div class="table-responsive" id="lista1" style="font-size:10pt;"></div>	 

              <!-------------------------------------->

			<div class="container" id="div_subir_img_plano" hidden>
		    <h2 class="text-danger">Subir foto del usuario</h2>
		    <form id="uploadForm" enctype="multipart/form-data">
		        
		      		        <div class="input-group mb-3">
						  <!--label class="input-group-text" for="inputGroupFile01">Selecciona una imagen</label-->
						  <input type="file" class="form-control" name="fileInput" id="fileInput" accept="image/*">
						</div>

		        <input type="hidden" name="txtid_usuario_enviar" id="txtid_usuario_enviar">
		        <input type="hidden" name="txttipo_archivo" id="txttipo_archivo">

		        <div id="div_btn_subir">
		            <button type="button" class="btn btn-outline-success btn-sm" onclick="uploadFile()"><i class="bi bi-cloud-arrow-up-fill"></i> Subir</button>
		            <button type="button" class="btn btn-outline-danger btn-sm" id="btn_retornar_de_subir" onclick="limpiarContenedor()"><i class="bi bi-arrow-return-left"></i> Retornar</button>
		        </div>

		        <div aria-label="Example with label">
		            <progress class="progress" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" value="0" max="100" id="progressBar"></progress>
		        </div>

		        <div id="output"></div>
		    </form>
		</div>
			   		
	<!--------------------------------------> 

			<!-------------------------------------------------------->

				<div class="card text-center" id="div_formulario" hidden>

				  <div class="card-header">
				    <ul class="nav nav-tabs card-header-tabs">
				      <li class="nav-item">
				        <a class="nav-link active" id="pndatos"  aria-current="true" href="#"><h5> <i class="bi bi-person-fill-gear"></i> Datos Usuario </h4></a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" id="pnpermisos"  href="#"><h5> <i class='bi bi-collection-fill'></i> Modulos </h4></a>
				      </li>

				      <li class="nav-item">
				        <a class="nav-link"  id="pnproyectos" href="#"><h5><i class='bi bi-buildings-fill'></i> Proyectos </h4></a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link disabled"  id="pnseries" href="#"><h5> <i class="bi bi-123"></i> Series </h4></a>
				      </li>
			   						      
				    </ul>
				  </div>
				  <div class="card-body">
				  	<input type="hidden" class="form-control" id="txt_id_area">
				  	<div id="divdatos" style="padding: 5px;">

				  			<div class="row g-3">

				  			<div class="col-md-3">
								<div class="input-group mb-3">						  	
								<input type="text" class="form-control text-center" id="txt_qr_usuario" placeholder="Cod. QR" aria-label="Username" aria-describedby="basic-addon1" disabled>
								<button type="button" class="btn btn-outline-primary btn-sm"  id="btn_generar_codigo"><i class="bi bi-qr-code"></i> Generar</button>
								</div>
								</div>

								<div class="col-md-3">
								<div class="input-group mb-3">						  	
								<input type="text" class="form-control text-center" id="txtdniusuario" placeholder="Doc. Identidad" aria-label="Username" aria-describedby="basic-addon1">
								<button type="button" class="btn btn-outline-primary btn-sm"  id="btn_reniec"><img src="../icon/reniec.png" style="width:15px;"> RENIEC</button>
								</div>
								</div>

								<div class="col-md-6">
								<div class="input-group mb-3">						  	
								<input type="text" class="form-control text-center" id="txtnombreusuario" placeholder="Apellidos y nombres" aria-label="Username" aria-describedby="basic-addon1"oninput="convertirAMayusculas(this)">
								</div>
								</div>

												
							</div>
							<p><hr></p>
				  			<div class="row g-3">							

				  				<div class="col-md-3">
								<div class="form-floating">
								<input type="text" class="form-control" id="txtusuario" placeholder="Usuario" oninput="convertirAMayusculas(this)">
								<label for="txtusuario"><b><i class="bi bi-people-fill"></i> Usuario</b></label>
								</div>
								</div>

								<div class="col-md-3">
								<div class="form-floating">
								<input type="text" class="form-control" id="txtclave" placeholder="Clave">
								<label for="txtclave"><b><i class="bi bi-asterisk"></i> Clave</b></label>
								</div>
								</div>

								<div class="col-md-3">		
								<div class="form-floating">
								<select class="form-select" id="txtarea_trabajo_user" aria-label="Floating label select example">
								<option value=''>Seleccionar</option>
								<?php while($fila=odbc_fetch_array($rsareas)) {?>
								<option value="<?php echo $fila['AREA_TRABAJO'];?>"><?php echo $fila['AREA_TRABAJO'];?></option><?php } ?>
								</select>
								<label for="txtarea_trabajo_user"><i class="bi bi-diagram-3-fill"></i>  Área </label>
								</div>
								</div>

								<div class="col-md-3">		
								<div class="form-floating">
								<select class="form-select" id="txtcargo" aria-label="Floating label select example"></select>
								<label for="txtcargo"><i class="bi bi-diagram-3-fill"></i>  Cargo </label>
								</div>
								</div>

								<div class="col-md-3">
								<div class="form-floating">
								<input type="date" class="form-control" id="txt_fecha_nac_usuario" placeholder="Fecha nacimiento " value="<?php echo "$diaactual";?>" >
								<label  for="txt_fecha_nac_usuario"><b><i class="bi bi-calendar-date-fill"></i> Fecha nacimiento </b></label>
								</div>					  
								</div>

								<div class="col-md-3">		
								<div class="form-floating">
								<select class="form-select" id="txt_genero_usuario" aria-label="Floating label select example">
								<option value=''>Seleccionar</option>
								<option value="MASCULINO">MASCULINO</option>
								<option value="FEMENINO">FEMENINO</option>								
								</select>
								<label for="txt_genero_usuario"><i class="bi bi-gender-male"></i> Género</label>
								</div>
								</div>

								<div class="col-md-3">		
								<div class="form-floating">
								<input type="text" class="form-control" id="txt_direccion_usuario" placeholder="Dirección" oninput="convertirAMayusculas(this)">
								<label for="txt_direccion_usuario"><i class="bi bi-geo-alt-fill"></i> Dirección </label>
								</div>
								</div>
							
								<div class="col-md-3">		
								<div class="form-floating">
								<input type="text" class="form-control" id="txt_correo_usuario" placeholder="Email" oninput="convertirAMayusculas(this)">
								<label for="txt_correo_usuario"><i class="bi bi-envelope-at-fill"></i> Email </label>
								</div>
								</div>


								<div class="col-md-3">		
								<div class="form-floating">
								<input type="text" class="form-control" id="txt_celular_usuario" placeholder="Celular">
								<label for="txt_celular_usuario"><i class="bi bi-phone-fill"></i> Celular </label>
								</div>
								</div>


								<div class="col-md-3">		
								<div class="form-floating">
								<select class="form-select" id="txt_estado_habilitado" aria-label="Floating label select example">
								<option value="">Seleccionar</option>
								<option value="ACTIVO">ACTIVO</option>
								<option value="INACTIVO">INACTIVO</option>								
								<option value="BAJA">BAJA</option>								
								</select>
								<label for="txt_estado_habilitado"><i class="bi bi-gender-male"></i> Estado Habilitación</label>
								</div>
								</div>
								

							
								<div class="col-md-12" style="text-align: right;">
									<button type="button" class="btn btn-outline-info" id="btgrabarusuario"><i class="bi bi-floppy-fill"></i> Grabar Usuario</button>
									<a href="perfil_usuarios.php" type="button" class="btn btn-outline-danger" id="btn_cerrar"><i class="bi bi-door-closed-fill"></i> Cerrar</a>									
								</div>

							</div>

				  	</div>

				  	<div  id="divpermisos"  style="display: none;" >

					 		<div class="row">

						  	<div class="col-md-4">
							<div id="listarpermisos" style="text-align:left;" ></div>	
							</div>

							<div class="col-md-8">
							<div id="listarpermisosasignados" style="text-align:left;" ></div>	
							</div>
							
							</div>


							  <div style="padding: 5px; text-align: right;">								  
							  <a href="perfil_usuarios.php" type="button" class="btn btn-outline-danger" id="btn_cerrar"><i class="bi bi-door-closed-fill"></i> Cerrar</a>															
							 </div>
					  	
					</div>

					<div id="divproyectos" style="display: none;" >

							<div class="row g-3">
								<div class="col-md-4">
								<div class="form-floating">
								<input type="text" class="form-control" id="txtusuarioasignar" placeholder="Apellidos y Nombres" oninput="convertirAMayusculas(this)">
								<label for="txtusuarioasignar"><b><i class="bi bi-person-fill-gear"></i> Apellidos y Nombres</b></label>
								</div>
								</div>

								<div class="col-md-4" >		
									<div class="form-floating">
									<select class="form-select" id="txtid_proyecto" aria-label="Floating label select example">		
									<option value="">Seleccionar</option>
									<?php while($fila=odbc_fetch_array($rsproyectos_1)) {?>
									<option value="<?php echo $fila['ID_PROYECTO'];?>"><?php echo $fila['NOMBRE_CORTO_PY'];?></option><?php } ?>
									</select>
									<label for="txtid_proyecto"><i class="bi bi-building-fill-gear"></i> Proyectos</label>
									</div>
								</div>	
								<div class="col-md-4" style="padding:7px; text-align: left;">		
									<button type="button" class="btn btn-outline-info" id="btn_asignar_proyectos">Asignar local</button>
									<button type="button" class="btn btn-outline-danger" id="btn_cerrar"><i class="bi bi-door-closed-fill"></i> Cerrar</button>									
								</div>

							</div>
							<br>
							<div id="listaetapasasignadas" style="text-align:left;"></div>	

							
					</div>

					<div id="divserie" style="display: none;" >

					  		<div class="row">
								  <div class="col-sm-6">
								    <div class="card">
								    	<div class="card-body">
								    		<div class="row g-3">

								    			<div class="col-md-12" >		
												<div class="form-floating">
												<select class="form-select" id="txtid_proyecto_1" aria-label="Floating label select example">		
												<option value="">Seleccionar</option>
												<?php while($fila=odbc_fetch_array($rslocales_todos_1)) {?>
												<option value="<?php echo $fila['ID_LOCAL'];?>"><?php echo $fila['NOM_COMERCIAL'];?></option><?php } ?>
												</select>
												<label for="txtid_proyecto_1"><i class="bi bi-building-fill-gear"></i> Proyectos</label>
												</div>
												</div>

								    		</div>								    	
											<br>								    
									  		<div id='div_lista_series' style="text-align:left;" >LISTA</div>									  	

									  	</div>
								      
								    </div>
								  </div>

								  <div class="col-sm-6">
								    <div class="card">
								      <div class="card-body">
								      	<div class="row g-3">

											<div class="col-md-12">
											<div class="form-floating">
											<input type="text" class="form-control" id="txtusuarioasignar_1" placeholder="Apellidos y Nombres" oninput="convertirAMayusculas(this)">
											<label for="txtusuarioasignar_1"><b><i class="bi bi-person-fill-gear"></i> Apellidos y Nombres</b></label>
											</div>
											</div>

										</div>
										<br>
								        <div id='div_lista_series_asignadas' style="text-align:left;" > ASIGNADAS</div>

								      </div>
								    </div>
								  </div>

								</div>

								<div style="padding: 5px; text-align: right;">								  
							  <a href="perfil_usuarios.php" type="button" class="btn btn-outline-danger" id="btn_cerrar"><i class="bi bi-door-closed-fill"></i> Cerrar</a>																
							 </div>
					 </div>				


				    
				  </div>


				</div>

			<!-------------------------------------------------------->              
              </div>
            </div>	
        </div>
       </div>
   
    </div>
	</div>


	  <!-------------------------------------->

	  <!-- Botón de ayuda con ícono de Bootstrap -->
    <button class="help-button" id="help-button" data-bs-toggle='modal' data-bs-target='#modal_listar_videos'>
        <i class="bi bi-question-circle-fill"></i>
    </button>

    <!-- Contenedor del texto emergente -->
    <div class="help-tooltip" id="help-tooltip">
        Haz clic para ayudarte
    </div>
  


<!--------------------------------->	


	</body>


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
<div class="modal fade" id="mdl_asignar_equipo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <p id="staticBackdropLabel">Asignar equipo de ventas</p>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	

      	<input type="hidden" class="form-control" id="txtid_coordinador">
      	<input type="hidden" class="form-control" id="txtid_asignacion">


        <div class="row">
       		<div class="col-md-8">		
				<div class="form-floating">
				<select class="form-select" id="txtid_ejecutivo" aria-label="Floating label select example">
				<option value=''>Seleccionar</option>
				<?php while($fila=odbc_fetch_array($rsejecutivos_venta)) {?>
				<option value="<?php echo $fila['ID_USUARIO'];?>"><?php echo $fila['NOM_USUARIO'];?></option><?php } ?>
				</select>
				<label for="txtid_ejecutivo"><i class="bi bi-people-fill"></i>  Ejecutivo de ventas </label>
				</div>
			</div>
			<div class="col-md-4" style="text-align: center; margin-top: 10px;">
				<button type="button" class="btn btn-outline-info" id="btn_asignar_ejecutivo"><i class="bi bi-floppy-fill"></i> Asignar</button>
			</div>
		</div>
		<br>
		<div id="div_equipo_coordinador" class="table-responsive"></div>

			
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="bi bi-door-closed-fill"></i> Close</button>  
      </div>
    </div>
  </div>
</div>

<!-- Modal -->


	</html>	
	<script type="text/javascript">

	$(document).ready(function() {	
		Verifica_permiso();
		Verifica_permiso_editar()
		listarusuario();
		
	});
/************************************/


$(document).on("click","#btn_prospectos_todos",function(){
	
	$("#txttipoorden").val($(this).data('tipoorden'))		
	listarusuario()		
})


	

$(document).on("click","#btn_buscar_campo_contenido",function(){
	
	$("#txtcampo_contenido").val($(this).data('campo_contenido'))		
	listarusuario()		
})

$(document).on("click","#btn_ordenar_campo",function(){
	$("#txtorden").val($(this).data('order'))
	$("#txtcampo_tabla_orden").val($(this).data('campo_tabla_orden'))		
	listarusuario()
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

$(document).on("click","#btn_eliminar_ejecutivo",function(){

$("#txtid_asignacion").val($(this).data('id'))	
var axid_asignacion = $("#txtid_asignacion").val();

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
      url:"perfil_usuarios_funciones.php",
      method: "POST",
      data: {param:25,
	      	txtid_asignacion:axid_asignacion,
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
			listar_equipo_del_coordinador();

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

function listar_equipo_del_coordinador(){

var axid_coordinador = $("#txtid_coordinador").val()

	$.ajax({
		url:"perfil_usuarios_funciones.php",
		method: "POST",
		data: {param:24,txtid_coordinador:axid_coordinador},
		success : function(data){				
			$("#div_equipo_coordinador").html(data);			
		}
	})


}

$(document).on("click","#btn_asignar_ejecutivo",function(){
		
	var axid_coordinador = $("#txtid_coordinador").val()
	var axid_ejecutivo =$("#txtid_ejecutivo").val()
	var axid_asignacion =$("#txtid_asignacion").val()

		$.ajax({
		url:"perfil_usuarios_funciones.php",
		method: "POST",
		data: {param:23,
			txtid_coordinador:axid_coordinador,
			txtid_ejecutivo:axid_ejecutivo,
			txtid_asignacion:axid_asignacion
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
        		listar_equipo_del_coordinador()
	        }else if(data==1){

        		Swal.fire({
					title: "Advertencia",
					text: "Error al guardar el registro",
					icon: "error"
				});

			}else if(data==2){

				Swal.fire({
					title: "Advertencia",
					text: "El ejecutivo se encuentra asignado a otro equipo",
					icon: "warning"
				});

        	}

		}
	})		

})

$(document).on("click","#btn_equpo_usuario",function(){
		
	$("#staticBackdropLabel").html($(this).data('titulo'))
	$("#txtid_coordinador").val($(this).data('id'))	
	listar_equipo_del_coordinador()

})



$(document).on("click","#btn_ordenar_numero_desc",function(){
		
		$("#txttipoorden").val($(this).data('tipoorden'))	
		$("#txtfiltro_buscar").val($(this).data('filtro_buscar'))	
		var axorden = 'DESC';
		$("#txtorden").val(axorden)			
		listarusuario()
	})



$(document).on("click","#btn_ordenar_numero_asc",function(){
		
		$("#txttipoorden").val($(this).data('tipoorden'))	
		$("#txtfiltro_buscar").val($(this).data('filtro_buscar'))	
		var axorden = 'ASC';
		$("#txtorden").val(axorden)			
		listarusuario()
	})


		$(document).on("click","#btn_perfil_todos",function(){
		
		$("#txttipoorden").val($(this).data('tipoorden'))	
		$("#txtfiltro_buscar").val($(this).data('filtro_buscar'))	
		var axorden = 'DESC';
		$("#txtorden").val(axorden)			
		listarusuario()
	})


		$(document).on("click","#btn_perfil_inactivos",function(){
		
		$("#txttipoorden").val($(this).data('tipoorden'))	
		$("#txtfiltro_buscar").val($(this).data('filtro_buscar'))	
		var axorden = 'ASC';
		$("#txtorden").val(axorden)			
		listarusuario()
	})
	
	$(document).on("click","#btn_perfil_activos",function(){
		
		$("#txttipoorden").val($(this).data('tipoorden'))	
		$("#txtfiltro_buscar").val($(this).data('filtro_buscar'))	
		var axorden = 'ASC';
		$("#txtorden").val(axorden)			
		listarusuario()
	})



	$(document).on("click","#btn_ordenar_estado_asc",function(){
		
		$("#txttipoorden").val($(this).data('tipoorden'))		
		var axorden = 'ASC';
		$("#txtorden").val(axorden)			
		listarusuario()
	})


	$(document).on("click","#btn_ordenar_estado_desc",function(){
		$("#txttipoorden").val($(this).data('tipoorden'))				
		var axorden = 'DESC';
		$("#txtorden").val(axorden)	
		listarusuario()
	})


	$(document).on("click","#btn_ordenar_area_asc",function(){
		
		$("#txttipoorden").val($(this).data('tipoorden'))		
		var axorden = 'ASC';
		$("#txtorden").val(axorden)			
		listarusuario()
	})


	$(document).on("click","#btn_ordenar_area_desc",function(){
		$("#txttipoorden").val($(this).data('tipoorden'))				
		var axorden = 'DESC';
		$("#txtorden").val(axorden)	
		listarusuario()
	})


	$(document).on("click","#btn_ordenar_desc",function(){
		
		$("#txttipoorden").val($(this).data('tipoorden'))		
		var axorden = 'DESC';
		$("#txtorden").val(axorden)			
		listarusuario()
	})


	$(document).on("click","#btn_ordenar_asc",function(){
		$("#txttipoorden").val($(this).data('tipoorden'))				
		var axorden = 'ASC';
		$("#txtorden").val(axorden)	
		listarusuario()
	})


$(document).on("click","#btn_eliminar_usuario",function(){

		var axiduser = $(this).data("id");

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
		      url:"perfil_usuarios_funciones.php",
		      method: "POST",
		      data: {param:21,axiduser:axiduser},
		      success : function(data){

		      	if(data==0){

		      		Swal.fire({
							  position: "center",
							  icon: "success",
							  title: "El registro fue eliminado",
							  showConfirmButton: false,
							  timer: 200
							});
								listarusuario();

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


$(document).on("click","#btn_retornar_de_subir",function(){

$("#lista1").prop('hidden',false)
$("#div_subir_img_plano").prop('hidden',true)




})

$(document).on("click","#btn_cambiar_foto_usuario",function(){

$("#txtid_usuario_enviar").val($(this).data('id'))
$("#txttipo_archivo").val($(this).data('tipo'))
$("#lista1").prop('hidden',true)
$("#div_subir_img_plano").prop('hidden',false)

})


$(document).on("change","#txtarea_trabajo_user",function(){
	traer_roles()	
})


function traer_roles(){

	var axarea_trabajo_user = $("#txtarea_trabajo_user").val()
	
	$.ajax({
		url:"perfil_usuarios_funciones.php",
		method: "POST",
		data: {param:20,txtarea_trabajo_user:axarea_trabajo_user},
		success : function(data){				
			$("#txtcargo").html(data);			
		}
	})

}


$(document).on("click","#btn_reniec",function(){

	var  axruc = $("#txtdniusuario").val();

	if(axruc==''){

		Swal.fire({
						  title: "Advertencia",
						  text: "Ingrese el Número documento identidad",
						  icon: "warning"
						});

	}else{

		$.ajax({
			url:"perfil_usuarios_funciones.php",
			method: "POST",
			data: {param:19,txtdniusuario:axruc},
			success : function(data){				
				var json = JSON.parse(data);
					
					$("#txtnombreusuario").val(json.nombre);			
					
			}

			})

	}

})


$(document).on("click","#btn_generar_codigo",function(){

$.ajax({
	      url:"funciones.php",
	      method: "POST",
	      data: {param:0},
	      success : function(data){	      	
	        $("#txt_qr_usuario").val(data)
	      }
	    });
})

$(document).on("click","#btn_cerrar",function(){

	$("#btn_nuevo").prop('hidden',false)
	$("#div_buscar").prop('hidden',false)
	$("#lista1").prop('hidden',false)
	$("#div_formulario").prop('hidden',true)

})

$(document).on("change","#txtid_proyecto_2",function(){

listar_tiendas_asignadas()

})


function listar_tiendas_asignadas(){
	
	var axid_usuario = $("#txtidusuario").val();
	var axtetapapy_2 = $("#txtid_proyecto_2").val();			

	$.ajax({
		url:"perfil_usuarios_funciones.php",
		method: "POST",
		data: {param:18,txtidusuario:axid_usuario,txtid_proyecto_2:axtetapapy_2},
		success : function(listar){
			$("#div_lista_almacenes_asignadas").html(listar);
		}
	})
}


	$(document).on("click","#btn_asignar_tienda",function(){
		
			
		var axtetapapy_2 = $("#txtid_proyecto_2").val();
		var axtid_tienda = $("#txtid_tienda").val();						
		var axid_usuario = $("#txtidusuario").val();	

		$.ajax({

			url:"perfil_usuarios_funciones.php",
			method: "POST",
			data: {param:17,
				txtid_proyecto_2:axtetapapy_2,
				txtid_tienda:axtid_tienda,
				txtidusuario:axid_usuario
				},
				
				success : function(listar){

					if(listar==0){
						listar_tiendas_asignadas()	
					}else{
						Swal.fire('Aviso!','No se grabo el registro','error')
					}

					

			}
		})		


	})



	function traer_datos_local(){
	
		var axid_usuario = $("#txtidusuario").val();			

		$.ajax({

			url:"perfil_usuarios_funciones.php",
			method: "POST",
			data: {param:16,txtidusuario:axid_usuario},
				
				success : function(listar){

					$("#txtid_proyecto_2").html(listar);

			}
		})


	}


	$(document).on("click","#txtcolor_user",function(){

		// Obtener el elemento de entrada de color y el elemento de visualización
        var colorSelector = document.getElementById("txtcolor_user");
        var colorDisplay = document.getElementById("colorDisplay");

        // Agregar un evento de cambio al selector de color
        colorSelector.addEventListener("input", function() {
            // Obtener el valor seleccionado por el usuario
            var selectedColor = colorSelector.value;
            //$("#txtcolor_user").val(selectedColor);
            // Actualizar el color de fondo del elemento de visualización
            colorDisplay.style.backgroundColor = selectedColor;
        });


	}) 


	

	$(document).on("click","#btn_quitar_serie",function(){
	var axid_asignacion = $(this).data('id');

		  
	$.ajax({

			url:"perfil_usuarios_funciones.php",
			method: "POST",
			data: {param:15,axid_asignacion:axid_asignacion},
				
				success : function(data){
					if(data==0){

						listar_series_asignado()

					}else if(listar==1){

						Swal.fire('Aviso!','No se elimino la serie','error')

					}else{
						
					}
					
			}
		})



	})

	function listar_series_asignado(){

		var axidlocal = $("#txtid_proyecto_1").val();	
		var axid_usuario = $("#txtidusuario").val();	
		//var axbuscar = $("#txtbuscar").val();	

		$.ajax({

			url:"perfil_usuarios_funciones.php",
			method: "POST",
			data: {param:14,txtid_proyecto_1:axidlocal,txtidusuario:axid_usuario},
				
				success : function(listar){

					$("#div_lista_series_asignadas").html(listar);
			}
		})
	}

$(document).on("click","#btn_asignar_serie",function(){
	var axid_corre_1 = $(this).data('id');
	$("#txtserie").val(axid_corre_1)

	var axid_corre =$("#txtserie").val()
	var axidlocal = $("#txtid_proyecto_1").val();	
	var axid_usuario = $("#txtidusuario").val();	
		  
	$.ajax({

			url:"perfil_usuarios_funciones.php",
			method: "POST",
			data: {param:13,
				txtserie:axid_corre,
				txtid_proyecto_1:axidlocal,
				txtidusuario:axid_usuario
			},
				
				success : function(listar){
					if(listar==1){

						 Swal.fire('Aviso!','La serie esta asignda...','warning')

					}else if(listar==2){

						Swal.fire('Aviso!','No se asigno la serie','error')

					}else{
						listar_series_asignado()
					}
					
			}
		})



	})

$(document).on("change","#txtid_proyecto_1",function(){
listar_series()
listar_series_asignado()
})

	

	

	function listar_series(){

		var axidlocal = $("#txtid_proyecto_1").val();	
		//var axbuscar = $("#txtbuscar").val();	

		$.ajax({

			url:"perfil_usuarios_funciones.php",
			method: "POST",
			data: {param:12,txtid_proyecto_1:axidlocal},
				
				success : function(listar){

					$("#div_lista_series").html(listar);
			}
		})
	}


	
	$(document).on("keyup","#txtbuscarusuario",function(){
		listarusuario();
	})

	$(document).on("click","#txtquitaretapa",function(){

		var idasignetapa = $(this).data("idasignetapa");
		var axidusuario= $("#txtidusuario").val();

		Swal.fire({
		  title: 'Esta seguro de eliminar?',
		  text: "Una vez eliminado, no podrá recuperar este registro!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, Eliminar!'
		}).then((result) => {
		  if (result.isConfirmed) {
		   	
		   	$.ajax({
		      	url:"perfil_usuarios_funciones.php",
	    	  	method: "POST",
	      		data: {param:10,idasignetapa:idasignetapa,txtidusuario:axidusuario},
	      		success : function(data){      			

	      			if(data==0){
	      				Swal.fire({
						  position: 'center',
						  icon: 'success',
						  title: 'Se elimino el Local al usuario',
						  showConfirmButton: false,
						  timer: 400
						})	
	      				listaretapasasignas();
	      			}else{
	      				Swal.fire('Advertencia','NO se elimino el registro','error')
	      			}        		
	      		}
	    
	    	});

		  }
		})



	})




	$(document).on("click","#btquitarmenu",function(){

		var axidmenu = $(this).data("idmenu");
		var axidusuario= $("#txtidusuario").val();

		Swal.fire({
		  title: 'Esta seguro de eliminar?',
		  text: "Una vez eliminado, no podrá recuperar este registro!",
		  icon: 'question',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, Eliminar!'
		}).then((result) => {
		  if (result.isConfirmed) {
		    
		  	$.ajax({
		      	url:"perfil_usuarios_funciones.php",
	    	  	method: "POST",
	      		data: {param:9,axidmenu:axidmenu,txtidusuario:axidusuario},
	      		success : function(data){    

	      			if(data==0){
	      				Swal.fire({
						  position: 'center',
						  icon: 'success',
						  title: 'Se elimino el Permiso al Modulo ',
						  showConfirmButton: false,
						  timer: 400
						})		
						listapermisosasignadosxusuario();
	      			}else{

	      				Swal.fire('Advertencia','NO se elimino el registro','error')
	      			}

	        	
	        		
	      		}
	    
	    	});


		  }
		})


	})





	$(document).on("click","#btn_editar_usuario",function(){

		var axiduser = $(this).data("id");

		$("#txtparametros").val(2);
		$("#btgrabarusuario").prop('disabled',false)
		var axpermiso_editar = $("#txtpermiso_editar").val()	

		if(axpermiso_editar==0){

			$.ajax({

			url:"perfil_usuarios_funciones.php",
			method: "POST",
			data: {param:8,axiduser:axiduser},
				
				success : function(traerdatosuser){
					var json = JSON.parse(traerdatosuser);

		  			if (json.status == 200){

		  				traer_roles()

		  				$("#btn_nuevo").prop('hidden',true)
						$("#div_buscar").prop('hidden',true)
						$("#lista1").prop('hidden',true)
						$("#div_formulario").prop('hidden',false)
						$("#btn_generar_codigo").prop('disabled',true)						

						$("#txtid_empresa").val(json.ID_EMPRESA);
						$("#txtdniusuario").val(json.COD_USUARIO);
						$("#txtusuario").val(json.USUARIO);
						$("#txtnombreusuario").val(json.NOM_USUARIO);
						$("#txtclave").val(json.CLAVE);				
						$("#txtidusuario").val(json.ID_USUARIO);
						
						$("#txtid_usuario").val(json.ID_USUARIO);
						$("#txt_fecha_nac_usuario").val(json.FECHA_NAC_USUARIO);
						$("#txt_genero_usuario").val(json.GENERO_USUARIO);
						$("#txt_direccion_usuario").val(json.DIRECCION_USUARIO);
						$("#txt_correo_usuario").val(json.CORREO_USUARIO);						
						
						$("#txt_celular_usuario").val(json.CELULAR_USUARIO);
						$("#txt_estado_habilitado").val(json.ESTADO_HABILITADO);
						$("#txt_qr_usuario").val(json.QR_USUARIO);

						$("#txtarea_trabajo_user").val(json.AREA_TRABAJO);					
						$("#txt_id_area").val(json.ID_AREA)

						var axcargo = json.AREA_CARGO
						//alert(axcargo)

						var axarea_trabajo_user = $("#txtarea_trabajo_user").val();					
						$.ajax({
							url:"perfil_usuarios_funciones.php",
							method: "POST",
							data: {param:22,txtarea_trabajo_user:axarea_trabajo_user,axcargo:axcargo},
							success : function(data){				
								$("#txtcargo").html(data);			
							}
						})

						
						listapermisosasignadosxusuario();
						listaretapasasignas()


		  			}


		  			

				}
		})

		}else{

			
			Swal.fire("Aviso", "Usted no tiene permiso para EDITAR", "warning")

		}

		

		


	})



	function traeridusuario() {
		
		var axcoduser= $("#txtdniusuario").val();

		$.ajax({

			url:"perfil_usuarios_funciones.php",
			method: "POST",
			data: {param:3,
				txtdniusuario:axcoduser
				},
				success : function(traerdato){
					var json = JSON.parse(traerdato);
		  			if (json.status == 200){
						
						$("#txtidusuario").val(json.ID_USUARIO);

		  			}


				}
		})

	}
	

	$(document).on("click","#btn_asignar_proyectos",function(){

		var idusuario = $("#txtidusuario").val();

		if (idusuario==""){

			Swal.fire("Aviso", "Se debe registrar y grabar al usuario antes de asignarle Etapas...", "warning")
			

		} else {

			var axidusuario = $("#txtidusuario").val();
			var axfecharegistro = $("#txtfecharegistro").val();
			var axparmetro= $("#txtparametros").val();
			var axidasignacion= $("#txtidasinacion").val();
			var axid_proyecto= $("#txtid_proyecto").val();
	

		$.ajax({

			url:"perfil_usuarios_funciones.php",
			method: "POST",
			data: {param:6,
				txtidusuario:axidusuario,
				txtfecharegistro:axfecharegistro,
				txtparametros:axparmetro,
				txtid_proyecto:axid_proyecto,
				txtidasinacion:axidasignacion
		
			},
				success : function(asignaretapa){

					if(asignaretapa==0){
						Swal.fire({
						  position: 'center',
						  icon: 'success',
						  title: 'Se Asigno Local al Usuario',
						  showConfirmButton: false,
						  timer: 400
						})
     			   		listaretapasasignas()
    				}else if(asignaretapa==2){
    					Swal.fire('Aviso','El local ya se encuentra asignado al usuario','warning')
   					
      				} else {
						Swal.fire('Aviso','No se grabo el registro...','error')

			      	}
				}
		})
		}
	})


	function listaretapasasignas() {

		var axidusuario = $("#txtidusuario").val();		
		$.ajax({
			url:"perfil_usuarios_funciones.php",
			method: "POST",
			data: {param:7,txtidusuario:axidusuario},
			success : function(listadoetapasxusuarios){
				$("#listaetapasasignadas").html(listadoetapasxusuarios);
			}
		})
	}



	$(document).on("click","#txtasignarpermiso",function(){

		var idusuario = $("#txtidusuario").val();

		if (idusuario==""){

			Swal.fire('Aviso','Se debe registrar y grabar al usuario antes de asignarle permisos...','warning')

		} else {

			var axidmenu = $(this).data("idmenu");
			var axidusuario = $("#txtidusuario").val();
			var axfecharegistro = $("#txtfecharegistro").val();
			var axparmetro= $("#txtparametros").val();
			var axidpermiso= $("#txtidpermiso").val();
	

		$.ajax({

			url:"perfil_usuarios_funciones.php",
			method: "POST",
			data: {param:4,
				txtidusuario:axidusuario,
				txtfecharegistro:axfecharegistro,
				txtparametros:axparmetro,
				axidmenu:axidmenu,
				txtidpermiso:axidpermiso
				
			},
				success : function(data){

					if(data==0){
						Swal.fire({
						  position: 'center',
						  icon: 'success',
						  title: 'Se Asigno Permiso al Modulo',
						  showConfirmButton: false,
						  timer: 400
						})	
       			   		listapermisosasignadosxusuario();
       			   	}else if(data==2){
       			   		Swal.fire('Aviso','El Modulo ya esta asignado al usuario','warning')
      				} else {						
						Swal.fire('Aviso','No se grabo el registro...','error')
			      	}
				}
		})


		}

		



	})
	


	function listapermisosasignadosxusuario() {

		var axidusuario = $("#txtidusuario").val();		
		$.ajax({
			url:"perfil_usuarios_funciones.php",
			method: "POST",
			data: {param:5,txtidusuario:axidusuario},
			success : function(listadomenuxusuarios){
				$("#listarpermisosasignados").html(listadomenuxusuarios);
			}
		})
	}





	$(document).on("click","#btn_nuevo",function(){

		$("#txtparametros").val(1);

		$("#btn_nuevo").prop('hidden',true)
		$("#div_buscar").prop('hidden',true)
		$("#lista1").prop('hidden',true)
		$("#div_formulario").prop('hidden',false)

		$("#btn_generar_codigo").prop('disabled',false)						

	})

	

	$(document).on("click","#btgrabarusuario",function(){

		 // Verificar campos vacíos
		   if (verificar_campos()) {		        
		        return;
		    }

		var axparmetro= $("#txtparametros").val();
		var axidempresa = $("#txtid_empresa").val();
		var axcoduser = $("#txtdniusuario").val();
		var axuser = $("#txtusuario").val();
		var axnomusuario = $("#txtnombreusuario").val();
		var axclave = $("#txtclave").val();				
		var axidusuario= $("#txtidusuario").val();
		
		var axid_usuario = $("#txtid_usuario").val();
		var ax_fecha_nac_usuario = $("#txt_fecha_nac_usuario").val();
		var ax_edad_usuario = $("#txt_edad_usuario").val();
		var ax_genero_usuario = $("#txt_genero_usuario").val();
		var ax_direccion_usuario = $("#txt_direccion_usuario").val();
		var ax_correo_usuario = $("#txt_correo_usuario").val();
		var ax_id_area = $("#txt_id_area").val();
		var axarea_trabajo_user = $("#txtarea_trabajo_user").val();
		var ax_celular_usuario = $("#txt_celular_usuario").val();
		var ax_estado_habilitado = $("#txt_estado_habilitado").val();
		var ax_qr_usuario = $("#txt_qr_usuario").val();
		var axcargo = $("#txtcargo").val();


		$.ajax({

			url:"perfil_usuarios_funciones.php",
			method: "POST",
			data: {param:2,
					
					txtparametros:axparmetro,
					txtid_empresa:axidempresa,
					txtdniusuario:axcoduser,
					txtusuario:axuser,
					txtnombreusuario:axnomusuario,
					txtclave:axclave,
					txtidusuario:axidusuario,					
					txtid_usuario:axid_usuario,
					txt_fecha_nac_usuario:ax_fecha_nac_usuario,
					txt_edad_usuario:ax_edad_usuario,
					txt_genero_usuario:ax_genero_usuario,
					txt_direccion_usuario:ax_direccion_usuario,
					txt_correo_usuario:ax_correo_usuario,
					txt_id_area:ax_id_area,
					txtarea_trabajo_user:axarea_trabajo_user,
					txt_celular_usuario:ax_celular_usuario,
					txt_estado_habilitado:ax_estado_habilitado,
					txt_qr_usuario:ax_qr_usuario,
					txtcargo:axcargo

			},
				success : function(grabarusuario){


					if(grabarusuario==0){
         			   	

         			    //$("#listarpermisos").html(grabarusuario);
						$("#divdatos").css({'display':'none'});	
						$("#divpermisos").css({'display':'block'});
						$("#divproyectos").css({'display':'none'});
						$("#divserie").css({'display':'none'});
						$("#divproyectos_tienda").css({'display':'none'});
						

						var elemento1 = document.getElementById("pndatos");
						var elemento2 = document.getElementById("pnpermisos");
						var elemento3 = document.getElementById("pnproyectos");
						var elemento4 = document.getElementById("pnseries");
						

						elemento1.className = "nav-link";
						elemento2.className = "nav-link active";
						elemento3.className = "nav-link";
						elemento4.className = "nav-link disabled";
						

						listarmenu();
            			
            			traeridusuario();

            			var axnomusuario = $("#txtnombreusuario").val();
            			$("#txtusuarioasignar").val(axnomusuario);
            			
            			listarusuario()

            			$("#btgrabarusuario").prop('disabled',true)

      				} else {
						swal("Aviso", "No se grabo el registro...", "warning");

			      	}
				}
		})

	})

	

	



	$(document).on("click","#pndatos",function(){

		$("#divdatos").css({'display':'block'});
		$("#divpermisos").css({'display':'none'});
		$("#divproyectos").css({'display':'none'});
		$("#divserie").css({'display':'none'});
		



		var elemento1 = document.getElementById("pndatos");
		var elemento2 = document.getElementById("pnpermisos");
		var elemento3 = document.getElementById("pnproyectos");
		var elemento4 = document.getElementById("pnseries");
		

		elemento1.className = "nav-link active";
		elemento2.className = "nav-link";
		elemento3.className = "nav-link";
		elemento4.className = "nav-link disabled";
		



	})

	$(document).on("click","#pnpermisos",function(){

		$("#divdatos").css({'display':'none'});
		$("#divpermisos").css({'display':'block'});
		$("#divproyectos").css({'display':'none'});
		$("#divserie").css({'display':'none'});
		


		var elemento1 = document.getElementById("pndatos");
		var elemento2 = document.getElementById("pnpermisos");
		var elemento3 = document.getElementById("pnproyectos");
		var elemento4 = document.getElementById("pnseries");
		


		elemento1.className = "nav-link";
		elemento2.className = "nav-link active";
		elemento3.className = "nav-link";
		elemento4.className = "nav-link disabled";
		


		listarmenu();

	})


	function listarmenu() {
		var axidempresa = $("#txtid_empresa").val();
		
		$.ajax({

			url:"perfil_usuarios_funciones.php",
			method: "POST",
			data: {param:1,txtid_empresa:axidempresa},
				success : function(listadomenu){
				$("#listarpermisos").html(listadomenu);
			}
		})
	}


	$(document).on("click","#pnproyectos",function(){

		$("#divdatos").css({'display':'none'});
		$("#divpermisos").css({'display':'none'});
		$("#divproyectos").css({'display':'block'});
		$("#divserie").css({'display':'none'});
		

		var elemento1 = document.getElementById("pndatos");
		var elemento2 = document.getElementById("pnpermisos");
		var elemento3 = document.getElementById("pnproyectos");
		var elemento4 = document.getElementById("pnseries");
		

		elemento1.className = "nav-link";
		elemento2.className = "nav-link";
		elemento3.className = "nav-link active";
		elemento4.className = "nav-link disabled";
		

	})


$(document).on("click","#pnseries",function(){
	/*
		$("#divdatos").css({'display':'none'});
		$("#divpermisos").css({'display':'none'});
		$("#divproyectos").css({'display':'none'});
		$("#divserie").css({'display':'block'});
		

		var elemento1 = document.getElementById("pndatos");
		var elemento2 = document.getElementById("pnpermisos");
		var elemento3 = document.getElementById("pnproyectos");
		var elemento4 = document.getElementById("pnseries");
		

		elemento1.className = "nav-link";
		elemento2.className = "nav-link";
		elemento3.className = "nav-link";
		elemento4.className = "nav-link active";
		

		listar_series()
		listar_series_asignado()
		*/
	})



	function listarusuario(){

		var axidempresa = $("#txtid_empresa").val();
		var axbuscaregistro = $("#txtbuscarusuario").val();	
		var axorden =  $("#txtorden").val()	
		var axtipoorden =  $("#txttipoorden").val()
		var axfiltro_buscar = $("#txtfiltro_buscar").val();

		var axnom_tabla = $("#txtnom_tabla").val()
		var axtipo_busqueda = $("#txttipo_busqueda").val()			
		var axcampo_tabla = $("#txtcampo_tabla").val()	
		var axcampo_tabla_orden = $("#txtcampo_tabla_orden").val()	
		var axcampo_contenido = $("#txtcampo_contenido").val()	

		var axpermiso_editar = $("#txtpermiso_editar").val()	
		
	

		$.ajax({

			url:"perfil_usuarios_funciones.php",
			method: "POST",
			data: {param:0,

				txtid_empresa:axidempresa,
				txtbuscarusuario:axbuscaregistro,
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
				
				success : function(listadeusuarios){

					$("#lista1").html(listadeusuarios);				


			}
		})
	}





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

			$("#titulo_formulario").html("<i class='bi bi-person-fill-gear' style='font-size: 25px;'></i> "+data +" <button type='button' id='btn_nuevo'  class='btn btn-outline-primary btn-sm'><i class='bi bi-file-earmark-plus' style='font-size:15px;'></i> Nuevo</button>")		

			

		}
	})

}

function Verifica_permiso_editar(){

	var axiduser =$("#txtid_usuario").val();
	var axtipo_beneficiario =$("#txttipo_beneficiario").val();		
	var axpermiso_1 = 'PERFILES USUARIO EDITAR';
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
	var axpermiso_1 = 'PERFILES USUARIO';	
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


function limpiarContenedor() {
        document.getElementById('fileInput').value = ''; // Limpia el campo de entrada de archivos
        document.getElementById('progressBar').value = 0; // Reinicia la barra de progreso
        document.getElementById('output').innerHTML = ''; // Limpia el contenido de salida

        $("#lista1").prop('hidden',false)
				$("#div_subir_img_plano").prop('hidden',true)

				listarusuario();

    }

 function uploadFile() {

    var fileInput = document.getElementById('fileInput');
    var idpy = document.getElementById('txtid_usuario_enviar');
    var tipo = document.getElementById('txttipo_archivo');
    
    var progressBar = document.getElementById('progressBar');
    var output = document.getElementById('output');

    if (fileInput.files.length > 0) {
        var file = fileInput.files[0];

        // Utilizas FormData para enviar el archivo y txtid_proyecto_enviar
        var formData = new FormData();
        formData.append('fileInput', file);
        formData.append('txtid_usuario_enviar', idpy.value); // Obtén el valor del input
        formData.append('txttipo_archivo', tipo.value); // Obtén el valor del input

        var xhr = new XMLHttpRequest();

        xhr.open('POST', 'subir_foto_usuario.php', true);

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

function convertirAMayusculas(input) {
  input.value = input.value.toUpperCase();
}


function verificar_campos() {

   var elementos = document.querySelectorAll('#divdatos input, #divdatos select');
    var camposVacios = false;

    for (var i = 0; i < elementos.length; i++) {

        if (elementos[i].value.trim() === '') {
        	console.log(elementos[i]);
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



	</script>




