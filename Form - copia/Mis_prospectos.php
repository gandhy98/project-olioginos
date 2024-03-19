<?php require_once '../includes/header.php';?>

<!DOCTYPE html>
	<html>
	<head>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>		 
	</head>
	

	
	<!--img src="../img/empresa.PNG" style="opacity: 0.2;"-->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<input type="hidden" name="txtparametros" id="txtparametros">	
	<input type="hidden" name="txtparametros_detalle" id="txtparametros_detalle" value="0">
	<input type="hidden" name="txtparametros_producto" id="txtparametros_producto">	
	<input type="hidden" name="txtid_usuario" id="txtid_usuario" value="<?php echo "$axid_usuario";?>">
	<input type="hidden" name="txtid_ejecutivo" id="txtid_ejecutivo" value="<?php echo "$axid_usuario";?>">
	<input type="hidden" name="txtid_empresa" id="txtid_empresa" value="<?php echo "$axidempresa";?>">	
	<input type="hidden" class="form-control" id="txtid_prospecto_dt">	
	<input type="hidden" class="form-control" id="txtfecha_actual" value="<?php echo "$diaactual";?>" >
	<input type="hidden" class="form-control" id="txtndias" value="<?php echo "$ndias";?>" >
	<input type="hidden" name="txttipoorden" id="txttipoorden">
	<input type="hidden" name="txtorden" id="txtorden">	
	<input type="hidden" name="txtverificar" id="txtverificar" value="NO">	

	<input type="hidden" class="form-control" id="txtid_prospecto_sg">
	<input type="hidden" class="form-control" id="txtid_prospecto_dt">
	<input type="hidden" class="form-control" id="txtid_prospecto_cz">
	<input type="hidden" class="form-control" id="txtnom_prospecto">
	<input type="hidden" class="form-control" id="txtprimer_seguimiento">	
	<input type="hidden" class="form-control" id="txtnombres_cliente_pst">
	<input type="hidden" class="form-control" id="txtpaterno_cliente_pst">
	<input type="hidden" class="form-control" id="txtmaterno_cliente_pst"> 
	<input type="hidden" class="form-control" id="txtestado_agendado"> 

	
	<body>

	<div class="card" style="padding: 10px;">
  	<div class="card-header" >

  		<div  style="padding: 2px;"><h5 id="titulo_formulario"></h5></div>	

  		<div class="row g-3" id="div_buscar_py">

			<div class="col-md-3">
			<div class="form-floating">
			<input type="text" class="form-control" id="txtbuscar_prospectos" placeholder="Buscar Prospecto">
			<label for="txtbuscar_prospectos"><b><i class="bi bi-search"></i> Buscar</b></label>
			</div>
			</div>

			<div class="col-md-3">
			<div class="form-floating">
			<input type="date" class="form-control" id="txtfecha_del" placeholder="Fec. Actual" value="<?php echo "$diaactual";?>" >
			<label  for="txtfecha_reg_prospecto"><b><i class="bi bi-calendar-date-fill"></i> Fec. Actual</b></label>
			</div>					  
			</div>	

			<div class="col-md-3">
			<div class="form-floating">
			<input type="date" class="form-control" id="txtfecha_al" placeholder="Fec. Final" value="<?php echo "$diaactual";?>" >
			<label  for="txtfecha_al"><b><i class="bi bi-calendar-date-fill"></i> Fec. Final</b></label>
			</div>					  
			</div>

		
		</div>   
  	</div>
	<br>

  	<div class="row">

	  <div class="col-sm-4 mb-3 mb-sm-0">
	    <div class="card">
	      <div class="card-body">
	        <div id="div_prospectos_asignados" class="table-responsive"></div>
	      </div>
	    </div>
	  </div>

	  <div class="col-sm-8">
	    <div class="card">
	      <div class="card-body">
	        
	        	<div class="card text-center">
				  <div class="card-header">
				    <ul class="nav nav-tabs card-header-tabs">
				      <li class="nav-item">
				        <a class="nav-link active" id="pn_prospectos_asignados_seguimientos" aria-current="true" href="#">Seguimientos</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link disabled"  id="pn_prospectos_asignados_formulario" href="#">Formulario</a>
				      </li>
				    </ul>
				  </div>
				  <div class="card-body">
				    
				  	<div id="div_prospectos_asignados_seguimientos" style="text-align: left;">

				  		<div class="row g-3" id="div_buscar_seguimiento" hidden>

				  		<div class="col-md-8">
						<div class="input-group mb-3">
						<input type="text" class="form-control" id="txtbuscar_seguimiento" placeholder="Buscar Seguimientos" onkeydown="focusNextElement(event, 'txtquebusca')" oninput="convertirAMayusculas(this)">					
						<button type="button" class="btn btn-outline-success btn-sm"  id="btn_buscar_seguimiento"><i class="bi bi-search"></i> Buscar </button>
						<button type='button' id='btn_grafica_seguimiento'  class='btn btn-outline-danger btn-sm'><i class="bi bi-bar-chart-fill"></i> Grafica</button>
						<button type='button' id='btn_nuevo_seguimiento'  class='btn btn-outline-primary btn-sm'><i class='bi bi-file-earmark-plus'></i> Nuevo</button>
						</div>
						</div>

						</div>
						
						<div id="div_prospectos_asignados_seguimientos_graficar_resumen">
							
							<!--div class="card mb-3">
							  <div class="card-body" >
							  	<div id="lista_barras_horizontales"></div>
							  </div>
							  <canvas id="grafico_barras_horizontales"></canvas>	
							</div-->


							<div class="row">
							  <div class="col-sm-8 mb-3 mb-sm-0">
							    <div class="card">
							      <div class="card-body">
							        <div id="lista_tareas_agendadas"></div>
							      </div>
							    </div>
							  </div>
							  <div class="col-sm-4">
							    <div class="card">
							      <div class="card-body">
							        <div id="lista_barras_horizontales"></div>
							      </div>
							    </div>
							  </div>
							</div>

							

						</div>

				  		<div id="div_prospectos_asignados_seguimientos_listado"></div>
				    	
				    </div>

				    <div id="div_prospectos_asignados_formulario" hidden>	

				    	<div class="card">
				<h5 class="card-header" style="background: #FFBA55 ;">Perfil del Cliente <a href="#" style="text-decoration:none;" class="text-success" data-bs-toggle="modal" data-bs-target="#mdl_agregar_datos_cliente"><i class="bi bi-person-fill-add" style="font-size: 25px;"></i></a></h5>
				<div class="card-body">
				    <div style="text-align: center;">
				    	<h5 class="card-title text-danger" id="txtcomentario"></h5>

				    </div>
				    <div class="row g-3">
						
						<div class="col-md-4">
						<div class="form-floating">
						<input type="text" class="form-control" id="txtnom_cliente" placeholder="Nombre del cliente "onkeydown="focusNextElement(event, 'txtquebusca')" oninput="convertirAMayusculas(this)">					
						<label for="txtnom_cliente"><b><i class="bi bi-textarea-t"></i> Nombre del cliente </b></label>
						</div>
						</div>

						<div class="col-md-4">
						<div class="form-floating">
					
						<select class="form-select" id="txtquebusca" aria-label="Floating label select example" onkeydown="focusNextElement(event, 'txtestado_civil')" >					
						<option value="">Seleccionar</option>
						<option value="1RA VIVIENDA">1RA VIVIENDA</option>
						<option value="2DA VIVIENDA">2DA VIVIENDA</option>				
						<option value="EMPRENDEDOR">EMPRENDEDOR</option>				
						<option value="INVERSION">INVERSION</option>										
						</select>

						<label for="txtquebusca"><b><i class="bi bi-search-heart-fill"></i> Que busca </b></label>
						</div>
						</div>

						<div class="col-md-4" >		
						<div class="form-floating">
						<select class="form-select" id="txtestado_civil" aria-label="Floating label select example" onkeydown="focusNextElement(event, 'txtsituacion_laboral')" >					
						<option value="">Seleccionar</option>
						<option value="SOLTERO">SOLTERO</option>
						<option value="CASADO">CASADO</option>				
						<option value="VIUDO">VIUDO</option>				
						<option value="DIVORCIADO">DIVORCIADO</option>				
						<option value="SEPARADO">SEPARADO</option>
						</select>
						<label for="txtestado_civil"><b><i class="bi bi-person-fill-gear"></i> Estado Civil</b></label>
						</div>
						</div>

						<div class="col-md-4">
						<div class="form-floating">
				
						<select class="form-select" id="txtsituacion_laboral" aria-label="Floating label select example" onkeydown="focusNextElement(event, 'txtedad_cliente')" >					
						<option value="">Seleccionar</option>
						<option value="DEPENDIENTE">DEPENDIENTE</option>
						<option value="INDEPENDIENTE">INDEPENDIENTE</option>				
						<option value="OTROS">OTROS</option>										
						</select>
						<label for="txtsituacion_laboral"><b><i class="bi bi-person-walking"></i> Situación laboral </b></label>
						</div>
						</div>

						<div class="col-md-4">
						<div class="form-floating">
						<select class="form-select" id="txtedad_cliente" aria-label="Floating label select example" onkeydown="focusNextElement(event, 'txtciudad_cliente')" >					
						<option value="">Seleccionar</option>
						<option value="ADULTO">ADULTO</option>
						<option value="JOVEN">JOVEN</option>										
						</select>
						<label for="txtedad_cliente"><b><i class="bi bi-ui-checks-grid"></i> Grupo de Edad </b></label>
						</div>
						</div>

						<div class="col-md-4">
						<div class="form-floating">
						<input type="text" class="form-control" id="txtciudad_cliente" placeholder="Ciudad referencia" onkeydown="focusNextElement(event, 'txtfecha_seguimiento')" oninput="convertirAMayusculas(this)">									
						<label for="txtciudad_cliente"><b><i class="bi bi-globe-americas"></i> Ciudad referencia </b></label>
						</div>
						</div>


				    </div>
				</div>
				</div>
				<br>
				<div class="card">
				  <h5 class="card-header bg-primary text-white">Comercial</h5>
				  <div class="card-body">

				  	<div class="row g-3">

				  		<div class="col-md-4">
						<div class="form-floating">
						<input type="date" class="form-control" id="txtfecha_seguimiento" placeholder="Fecha" onkeydown="focusNextElement(event, 'txthora_seguimiento')" value="<?php echo "$diaactual";?>">									
						<label  for="txtfecha_seguimiento"><b><i class="bi bi-calendar-date-fill"></i> Fecha</b></label>
						</div>					  
						</div>	

						<div class="col-md-4">
						<div class="form-floating">
						<input type="text" class="form-control" id="txthora_seguimiento" placeholder="Hora" onkeydown="focusNextElement(event, 'txtdetalle_comentario')">												
						<label for="txthora_seguimiento"><b><i class="bi bi-alarm-fill"></i> Hora</b></label>
						</div>
						</div>	

						<div class="col-md-4" style="text-align: left; padding: 15px;">		
						<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" role="switch" id="txtagendar" value="NO">
						<label class="form-check-label" for="txtagendar">Agendar llamada</label>
						</div>
	               		</div>

				  		<div class="col-md-8">
						<div class="form-floating">					
						<textarea class="form-control" placeholder="Leave a comment here" id="txtdetalle_comentario" style="height: 100px" oninput="convertirAMayusculas(this)" onkeydown="focusNextElement(event, 'txtestado_seguimiento')"></textarea>												
						<label for="txtdetalle_comentario"><b><i class="bi bi-chat-right-dots-fill"></i> Comentario</b></label>
						</div>
						</div>

						<div class="col-md-4" >		
						<div class="form-floating">
						<select class="form-select" id="txtestado_seguimiento" aria-label="Floating label select example" onkeydown="focusNextElement(event, 'txtvisita_oficina')">						
						<option value="DEJO DE CONTESTAR">DEJO DE CONTESTAR</option>					
						<option value="FUTURA VENTA">FUTURA VENTA</option>					
						<option value="NO INTERESADO">NO INTERESADO</option>
						<option value="NUNCA CONTESTO">NUNCA CONTESTO</option>												
						<option value="SEGUIMIENTO">SEGUIMIENTO</option>													
						<option value="VENDIDO">VENDIDO</option>													
						</select>
						<label for="txtestado_seguimiento"><b><i class="bi bi-card-checklist"></i> Estado Situación</b></label>
						</div>
						</div>

						<div class="col-md-4">						
						<div class="input-group mb-3">
						<span class="input-group-text" id="basic-addon1">Visita Oficinas</span>						  	
						<select class="form-select" id="txtvisita_oficina" aria-label="Floating label select example" onkeydown="focusNextElement(event, 'txtvistia_proyecto')">						
						<option value="NO">NO</option>
						<option value="SI">SI</option>
						</select>
						</div>
						</div>

						<div class="col-md-4">						
						<div class="input-group mb-3">
						<span class="input-group-text" id="basic-addon1">Visita Proyecto</span>						  	
						<select class="form-select" id="txtvistia_proyecto" aria-label="Floating label select example" onkeydown="focusNextElement(event, 'txtid_producto')">						
						<option value="NO">NO</option>
						<option value="SI">SI</option>
						</select>
						</div>
						</div>

						<div class="col-md-4">						
						<div class="input-group mb-3">
						<span class="input-group-text" id="basic-addon1"><a href="#" style="text-decoration:none;" data-bs-toggle="modal" data-bs-target="#mdl_productos" id="btn_traer_productos" title="Click para ver los productos...">Productos</a></span>						  	
						<!--select class="form-select" id="txtid_producto" aria-label="Floating label select example" onkeydown="focusNextElement(event, 'txtfecha_seguimiento_proximo')" disabled></select-->
						<input type="hidden" class="form-control" id="txtid_producto" >					
						<input type="text" class="form-control" id="txtnom_producto" disabled>					

						</div>
						</div>


						<div class="col-md-4" id='div_fecha_proxima' hidden>
						<div class="form-floating">
						<input type="date" class="form-control" id="txtfecha_seguimiento_proximo" placeholder="Fec. proxima" value="<?php echo "$diaactual";?>" onkeydown="focusNextElement(event, 'txthora_seguimiento_proximo')">
						<label  for="txtfecha_seguimiento_proximo"><b><i class="bi bi-calendar-date-fill"></i> Fec. proxima</b></label>
						</div>					  
						</div>	

						<div class="col-md-4" id='div_hora_proxima' hidden>
						<div class="form-floating">
						<input type="text" class="form-control" id="txthora_seguimiento_proximo" placeholder="Hora proxima">					
						<label for="txthora_seguimiento_proximo"><b><i class="bi bi-alarm-fill"></i> Hora proxima</b></label>
						</div>
						</div>

				  	</div>

				    
				  </div>
				  <div class="card-footer text-body-secondary text-center">
				    <button type="button" class="btn btn-outline-success btn-sm"  id="btn_grabar_segumiento"><i class="fas fa-save"></i> Guardar</button>
				    <button type="button" class="btn btn-outline-danger btn-sm" id="btn_cerrar_form_prod"><i class="bi bi-arrow-return-left"></i> Retornar</button>	
				  </div>

				  

				</div>

				    </div>
				  </div>
				</div>	        	

	        
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
<div class="modal fade" id="mdl_productos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Proyectos en curso</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div class="row g-3">

			<div class="col-md-6">
			<div class="input-group mb-3">
			<span class="input-group-text" id="basic-addon1">Proyectos</span>						  	
			<select class="form-select" id="txtid_proyecto" aria-label="Floating label select example">		
			<option value="">Seleccionar</option>
			<?php while($fila=odbc_fetch_array($rsproyectos_1)) {?>
			<option value="<?php echo $fila['ID_PROYECTO'];?>"><?php echo $fila['NOMBRE_CORTO_PY'];?></option><?php } ?>
			</select>
			</div>								
			</div>
			<div class="col-md-6">
			<div class="input-group mb-3">
			<input type="text" class="form-control" placeholder="Buscar Manzana + Lote" aria-label="Username" id="txtbuscar_producto" aria-describedby="basic-addon1" oninput="convertirAMayusculas(this)">
			<button type='button' id='btn_buscra_producto'  class='btn btn-outline-success btn-sm'><i class="bi bi-search"></i> Buscar</button>			
			</div>								
			</div>
		</div>

		<div class="spinner-grow text-primary" id="div_esperando_productos" role="status" hidden>
			<span class="visually-hidden">Loading...</span>
		</div>

		<div  id="div_productos_py_listado"></div>
       
      </div>
      <div class="modal-footer">        
		<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-arrow-return-left"></i> Retornar</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="mdl_agregar_datos_cliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Actualizar datos del cliente</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div class="row g-3">

			<div class="col-md-6" >		
				<div class="form-floating">
				<select class="form-select" id="txttipo_cliente_pst" aria-label="Floating label select example" onkeydown="focusNextElement(event, 'txtid_doc')">	
				<option value="NATURAL">NATURAL</option>
				<option value="JURIDICA">JURIDICA</option>				
				</select>
				<label for="txttipo_cliente_pst"><b><i class="bi bi-person-fill-gear"></i> Tipo</b></label>
				</div>
			</div>

			<div class="col-md-6" >		
				<div class="form-floating">
				<select class="form-select" id="txtid_doc" aria-label="Floating label select example" onkeydown="focusNextElement(event, 'txtnum_doc_cliente_pst')">	
				<option value="">Seleccionar</option>
				<?php while($fila=odbc_fetch_array($RSTipo_doc_ident_1)) {?>
				<option value="<?php echo $fila['ID_DOC'];?>"><?php echo $fila['DOC_IDENTIDAD'];?></option><?php } ?>
				</select>
				<label for="txtid_doc"><b><i class="bi bi-files"></i> Tipo documento</b></label>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-floating">
				<input type="text" class="form-control" id="txtnum_doc_cliente_pst" placeholder="Num. documento" onkeydown="focusNextElement(event, 'txtcliente_pst')">
				<label for="txtnum_doc_cliente_pst"> <i class="bi bi-123"></i> Num. documento</label>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-floating">
				<input type="text" class="form-control" id="txtcliente_pst" placeholder="Nombres" oninput="convertirAMayusculas(this)">
				<label for="txtcliente_pst"><i class="bi bi-textarea-t"></i> Nombres</label>
				</div>
			</div>

		</div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-success btn-sm"  id="btn_agregar_datos_prospecto" data-bs-dismiss="modal"><i class="fas fa-save"></i> Agregar</button>
		<button type="button" class="btn btn-outline-primary btn-sm"  id="btn_reniec"><img src="../icon/reniec.png" style="width:15px;"> RENIEC</button>
		<button type="button" class="btn btn-outline-primary btn-sm"  id="btn_sunat_buscar" hidden><img src="../icon/sunat.png" style="width:30px;"> SUNAT</button>
		<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-arrow-return-left"></i> Retornar</button>
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


</html>	

<script type="text/javascript">

$(document).ready(function() {	
	
	Verifica_permiso()
	listar_mis_prospectos_asignados();
	//traer_resumen_iteraccion_segun_ejecutivo_grafica()
	traer_tareas_agendadas()
	traer_resumen_iteraccion_segun_ejecutivo_listado()
	
	$("#txthora_seguimiento").mask('00:00');
	$("#txthora_seguimiento_proximo").mask('00:00');
	
});
/****************************/


$(document).on("click","#btn_ejecutar_agenda",function(){

	$("#txtid_prospecto_sg").val($(this).data('id'));
	var axid_prospecto_sg = $("#txtid_prospecto_sg").val();

	Swal.fire({

	  title: "Agenda",
	  text: "Se ejecuto la agenda!",
	  icon: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#3085d6",
	  cancelButtonColor: "#d33",
	  confirmButtonText: "Si, Ejecutada!"
	}).then((result) => {
	  if (result.isConfirmed) {
	    
	  	$.ajax({
	      url:"Mis_prospectos_funciones.php",
	      method: "POST",
	      data: {param:10,txtid_prospecto_sg:axid_prospecto_sg},
	      success : function(data){
	      	if(data==0){
	      		traer_tareas_agendadas()	        	
	      	}
	        
	      }
	    });


	  }
	});



})




function traer_tareas_agendadas(){

  var axid_ejecutivo = $("#txtid_ejecutivo").val();

  $.ajax({
      url:"Mis_prospectos_funciones.php",
      method: "POST",
      data: {param:9,txtid_ejecutivo:axid_ejecutivo},
      success : function(data){
       		
        $('#lista_tareas_agendadas').html(data);
        
      }
    });

}


function traer_resumen_iteraccion_segun_ejecutivo_listado(){
  var axid_ejecutivo = $("#txtid_ejecutivo").val();


  $.ajax({
      url:"Mis_prospectos_funciones.php",
      method: "POST",
      data: {param:8,txtid_ejecutivo:axid_ejecutivo},
      success : function(data){
       		
        $('#lista_barras_horizontales').html(data);
        
      }
    });

}


function traer_resumen_iteraccion_segun_ejecutivo_grafica() {

  var axid_ejecutivo = $("#txtid_ejecutivo").val();

  $.ajax({
    url: "Mis_prospectos_funciones.php",
    method: "POST",
    dataType: 'json',
    data: { param:7,txtid_ejecutivo:axid_ejecutivo},
    success: function (data) {
    
      crear_grafica_de_avance_segun_ejecutivo(data)      
    },
    error: function (error) {
      console.error('Error en la solicitud Ajax:', error);
    }
  });
}

var grafico_barras_horizontales;

function crear_grafica_de_avance_segun_ejecutivo(data) {
    var ctx1 = document.getElementById('grafico_barras_horizontales').getContext('2d');

    // Destruir el gráfico existente si hay uno
    if (grafico_barras_horizontales) {
        grafico_barras_horizontales.destroy();
    }


	// Ajustar el tamaño del canvas
    ctx1.canvas.width = 350;
    ctx1.canvas.height = 180;

    // Mapear los colores correspondientes a cada estado
    var colorMap = {
        'DEJO DE CONTESTAR': 'rgba(220, 53, 69, 0.2)',
        'FUTURA VENTA': 'rgba(255, 193, 7, 0.2)',
        'NO INTERESADO': 'rgba(240, 210, 230, 0.2)',
        'NUNCA CONTESTO': 'rgba(52, 58, 64, 0.2)',
        'SEGUIMIENTO': 'rgba(40, 167, 69, 0.2)',
        'VENDIDO': 'rgba(0, 123, 255, 0.2)',
        'SIN REVISION': 'rgba(149, 149, 149,0.2)'
    };

    // Configuración del gráfico de barras horizontales
    grafico_barras_horizontales = new Chart(ctx1, {
        type: 'horizontalBar',
        data: {
            labels: data.map(item => item.ESTADO),
            datasets: [{
                label: 'INTERACCIONES',
                data: data.map(item => parseInt(item.CANT)),
                backgroundColor: data.map(item => colorMap[item.ESTADO] || 'rgba(0, 0, 0, 0)'),  // Asignar colores según el estado, o negro si no hay color
                borderColor: data.map(item => (colorMap[item.ESTADO] || 'rgba(0, 0, 0, 0)').replace(/, 0.2\)/, ', 1)')),  // Borde con opacidad completa o negro si no hay color
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    beginAtZero: true  // Ajuste para que el eje X comience desde cero
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




function limpiar(){

//$("#txtnom_cliente").val('')
$("#txtquebusca").val('')
$("#txtestado_civil").val('')
$("#txtsituacion_laboral").val('')
$("#txtedad_cliente").val('')
$("#txtciudad_cliente").val('')
$("#txthora_seguimiento").val('')
$("#txtdetalle_comentario").val('')
$("#txtestado_seguimiento").val('')
$("#txtvisita_oficina").val('NO')
$("#txtvistia_proyecto").val('NO')
$("#txtid_producto").val('')
$("#txtnom_producto").val('')
$("#txtnom_producto").val('')
$("#txthora_seguimiento_proximo").val('')

}



function traer_datos_del_seguimientos(){

var axid_prospecto_dt =$("#txtid_prospecto_dt").val()
var axnom_prospecto =$("#txtnom_prospecto").val()

 $.ajax({
      url:"Mis_prospectos_funciones.php",
      method: "POST",
      data: {param:6,
      	txtid_prospecto_dt:axid_prospecto_dt,
      	txtnom_prospecto:axnom_prospecto
      },
      success : function(data){
      var json = JSON.parse(data);

      	
		$("#txtquebusca").val(json.CLIENTE_BUSCA)
		$("#txtestado_civil").val(json.CLIENTE_ESTADO_CIVIL)
		$("#txtsituacion_laboral").val(json.CLIENTE_SITU_LABORAL)
		$("#txtedad_cliente").val(json.CLIENTE_GRUPO_EDAD)
		$("#txtciudad_cliente").val(json.CLIENTE_CIUDAD)
		$("#txtid_producto").val(json.ID_PRODUCTO)
		$("#txtnom_producto").val(json.PRODUCTO)
        
      }

    });


}


$(document).on("click","#btn_cerrar_form_prod",function(){

	$("#div_prospectos_asignados_seguimientos").prop('hidden',false)
	$("#div_prospectos_asignados_formulario").prop('hidden',true)

	var elemento1 = document.getElementById("pn_prospectos_asignados_seguimientos");
	var elemento2 = document.getElementById("pn_prospectos_asignados_formulario");
								
	elemento1.className = "nav-link active";
	elemento2.className = "nav-link disabled";

	$("#txtparametros").val(0)
	limpiar()


})


$(document).on("click","#btn_nuevo_seguimiento",function(){

	$("#div_prospectos_asignados_seguimientos").prop('hidden',true)
	$("#div_prospectos_asignados_formulario").prop('hidden',false)

	var elemento1 = document.getElementById("pn_prospectos_asignados_seguimientos");
	var elemento2 = document.getElementById("pn_prospectos_asignados_formulario");
								
	elemento1.className = "nav-link disabled";
	elemento2.className = "nav-link active";

	$("#txtparametros").val(0)

	traer_datos_del_seguimientos()


})





$(document).on("click","#btn_grabar_segumiento",function(){


var axid_prospecto_sg = $("#txtid_prospecto_sg").val();
var axid_prospecto_dt = $("#txtid_prospecto_dt").val();
var axfecha_seguimiento = $("#txtfecha_seguimiento").val();
var axhora_seguimiento = $("#txthora_seguimiento").val();
var axdetalle_comentario = $("#txtdetalle_comentario").val();
var axestado_seguimiento = $("#txtestado_seguimiento").val();
var axfecha_seguimiento_proximo = $("#txtfecha_seguimiento_proximo").val();
var axhora_seguimiento_proximo = $("#txthora_seguimiento_proximo").val();
var axvisita_oficina = $("#txtvisita_oficina").val();
var axvistia_proyecto = $("#txtvistia_proyecto").val();
var axid_producto = $("#txtid_producto").val();
var axid_cliente = $("#txtid_cliente").val();
var axagendar = $("#txtagendar").val();
var axverificar = $("#txtverificar").val()
var axprimer_seguimiento = $("#txtprimer_seguimiento").val();

var axnom_cliente = $("#txtnom_cliente").val();
var axquebusca = $("#txtquebusca").val();
var axestado_civil = $("#txtestado_civil").val();
var axsituacion_laboral = $("#txtsituacion_laboral").val();
var axedad_cliente = $("#txtedad_cliente").val();
var axciudad_cliente = $("#txtciudad_cliente").val();
var axestado_agendado = $("#txtestado_agendado").val()

var axparametros = $("#txtparametros").val();



 $.ajax({
      url:"Mis_prospectos_funciones.php",
      method: "POST",
      data: {param:5,      		
			txtid_prospecto_sg:axid_prospecto_sg,
			txtid_prospecto_dt:axid_prospecto_dt,
			txtfecha_seguimiento:axfecha_seguimiento,
			txthora_seguimiento:axhora_seguimiento,
			txtdetalle_comentario:axdetalle_comentario,
			txtestado_seguimiento:axestado_seguimiento,
			txtfecha_seguimiento_proximo:axfecha_seguimiento_proximo,
			txthora_seguimiento_proximo:axhora_seguimiento_proximo,
			txtvisita_oficina:axvisita_oficina,
			txtvistia_proyecto:axvistia_proyecto,
			txtid_producto:axid_producto,
			txtid_cliente:axid_cliente,
			txtagendar:axagendar,
			txtverificar:axverificar,
			txtprimer_seguimiento:axprimer_seguimiento,

			txtnom_cliente:axnom_cliente,
			txtquebusca:axquebusca,
			txtestado_civil:axestado_civil,
			txtsituacion_laboral:axsituacion_laboral,
			txtedad_cliente:axedad_cliente,
			txtciudad_cliente:axciudad_cliente,
			txtestado_agendado:axestado_agendado,

			txtparametros:axparametros
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
		        	traer_seguimientos()
		        	listar_mis_prospectos_asignados()
		        	traer_tareas_agendadas()	        	
		        	limpiar()
		        	$("#txtparametros").val(0);
		        	

				
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

$(document).on("click","#btn_grafica_seguimiento",function(){

$("#grafico_barras_horizontales").prop('hidden',false)
$("#lista_barras_horizontales").prop('hidden',false)

$("#div_prospectos_asignados_seguimientos").prop('hidden',false)
$("#div_prospectos_asignados_formulario").prop('hidden',true)

$("#div_prospectos_asignados_seguimientos_listado").prop('hidden',true)
$("#div_prospectos_asignados_seguimientos_graficar_resumen").prop('hidden',false)
$("#btn_nuevo_seguimiento").prop('hidden',true)
$("#div_buscar_seguimiento").prop('hidden',true)

//traer_resumen_iteraccion_segun_ejecutivo_grafica()
traer_resumen_iteraccion_segun_ejecutivo_listado()
traer_tareas_agendadas()	        	






})

$(document).on("click","#btn_seguimiento",function(){

$("#txtid_prospecto_dt").val($(this).data('iddt'))
$("#txtid_prospecto_cz").val($(this).data('idcz'))
$("#txtcomentario").html($(this).data('comentario'))
$("#txtnom_cliente").val($(this).data('cliente'))
$("#txtid_proyecto").val($(this).data('idpy'))
$("#btn_traer_productos").html($(this).data('py'))
$("#txtnom_prospecto").val($(this).data('nom_pst'))


$("#grafico_barras_horizontales").prop('hidden',true)
$("#lista_barras_horizontales").prop('hidden',true)
$("#btn_nuevo_seguimiento").prop('hidden',false)

$("#div_prospectos_asignados_seguimientos_listado").prop('hidden',false)
$("#div_prospectos_asignados_seguimientos_graficar_resumen").prop('hidden',true)







//traer_productos()
traer_seguimientos()



//$("#div_prospectos_asignados_formulario").prop('hidden',false)


})

function traer_seguimientos(){

var axid_prospecto_dt =$("#txtid_prospecto_dt").val()
var axnom_prospecto =$("#txtnom_prospecto").val()



 $.ajax({
      url:"Mis_prospectos_funciones.php",
      method: "POST",
      data: {param:4,
      	txtid_prospecto_dt:axid_prospecto_dt,
      	txtnom_prospecto:axnom_prospecto
      },
      success : function(data){
       		
      	if(data==5){ /**no tiene seguimientos**/
      		$("#txtparametros").val(0);
      		$("#txtprimer_seguimiento").val(1);
      		
      		$("#div_prospectos_asignados_seguimientos").prop('hidden',true)
			$("#div_prospectos_asignados_formulario").prop('hidden',false)

			var elemento1 = document.getElementById("pn_prospectos_asignados_seguimientos");
			var elemento2 = document.getElementById("pn_prospectos_asignados_formulario");
								
			elemento1.className = "nav-link disabled";
			elemento2.className = "nav-link active";

			$("#div_buscar_seguimiento").prop('hidden',true)

      		traer_productos_por_proyecto()
      	}else{

      		$("#div_buscar_seguimiento").prop('hidden',false)

      		$("#div_prospectos_asignados_seguimientos").prop('hidden',false)
			$("#div_prospectos_asignados_formulario").prop('hidden',true)

			var elemento1 = document.getElementById("pn_prospectos_asignados_seguimientos");
			var elemento2 = document.getElementById("pn_prospectos_asignados_formulario");
								
			elemento1.className = "nav-link active";
			elemento2.className = "nav-link disabled";

      		$("#div_prospectos_asignados_seguimientos_listado").html(data)
      	}
        
      }
    });


}

$(document).on("click","#pn_prospectos_asignados_seguimientos",function(){

	$("#div_prospectos_asignados_seguimientos").prop('hidden',false)
	$("#div_prospectos_asignados_formulario").prop('hidden',true)

	var elemento1 = document.getElementById("pn_prospectos_asignados_seguimientos");
	var elemento2 = document.getElementById("pn_prospectos_asignados_formulario");
						
	elemento1.className = "nav-link active";
	elemento2.className = "nav-link disabled";
})



$(document).on("click","#pn_prospectos_asignados_formulario",function(){

	$("#div_prospectos_asignados_seguimientos").prop('hidden',true)
	$("#div_prospectos_asignados_formulario").prop('hidden',false)

	var elemento1 = document.getElementById("pn_prospectos_asignados_seguimientos");
	var elemento2 = document.getElementById("pn_prospectos_asignados_formulario");
						
	elemento1.className = "nav-link disabled";
	elemento2.className = "nav-link active";
	
})





$(document).on("click","#btn_asignar_producto_py",function(){


	
var axid_proyecto = $(this).data('idpy')
var axid_producto = $(this).data('idprod')
$("#btn_traer_productos").html($(this).data('nompy'))
$("#txtnom_producto").val($(this).data('nom_prod'))

$("#txtid_proyecto").val(axid_proyecto)
$("#txtid_producto").val(axid_producto)

//traer_productos()

})


$(document).on("click","#btn_buscra_producto",function(){
	traer_productos_por_proyecto()	
})

$(document).on("click","#btn_traer_productos",function(){
traer_productos_por_proyecto()

})

$(document).on("change","#txtid_proyecto",function(){
traer_productos_por_proyecto()

})


function traer_productos_por_proyecto(){

	var axid_proyecto = $("#txtid_proyecto").val()
	var axbuscar_producto = $("#txtbuscar_producto").val()	

	$("#div_esperando_productos").prop('hidden',false)

	 $.ajax({
      url:"Mis_prospectos_funciones.php",
      method: "POST",
      data: {param:3,
      	txtid_proyecto:axid_proyecto,
      	txtbuscar_producto:axbuscar_producto
      },
      success : function(data){
       		$("#div_esperando_productos").prop('hidden',true)
        $('#div_productos_py_listado').html(data);
        
      }
    });

}


function traer_productos(){

var axid_proyecto = $("#txtid_proyecto").val()

$.ajax({
	url:"Mis_prospectos_funciones.php",
	method: "POST",
	data: {param:2,txtid_proyecto:axid_proyecto},
	success : function(data){		
		
		$("#txtid_producto").html(data)
	}

	})

}

$(document).on("change","#txtagendar",function(){

	if ($(this).prop('checked')) {   			
   	
		$("#div_fecha_proxima").prop('hidden',false)
		$("#div_hora_proxima").prop('hidden',false)

		$("#txtverificar").val('SI')

   } else {

   		
   		$("#div_fecha_proxima").prop('hidden',true)
		$("#div_hora_proxima").prop('hidden',true)	

		$("#txtverificar").val('NO')
   }


})


$(document).on("click","#btn_agregar_datos_prospecto",function(){

	$("#txtparametros").val(1);

	var axid_prospecto_cz =$("#txtid_prospecto_cz").val()
	var axtipo_cliente_pst = $("#txttipo_cliente_pst").val()
	var axid_doc = $("#txtid_doc").val()
	var axnum_doc_cliente_pst =	$("#txtnum_doc_cliente_pst").val()
	var axcod_cliente_pst =	$("#txtcod_cliente_pst").val()
	var axnombres_cliente_pst = $("#txtnombres_cliente_pst").val()
	var axpaterno_cliente_pst = $("#txtpaterno_cliente_pst").val()
	var axmaterno_cliente_pst = $("#txtmaterno_cliente_pst").val()
	var axcliente_pst = $("#txtcliente_pst").val()			
	
	var axmodulo = $("#txtmodulo").val()
	var axid_usuario = $("#txtid_usuario").val()

	var axparametros = $("#txtparametros").val();

    $.ajax({
      url:"Mis_prospectos_funciones.php",
      method: "POST",
      data: {param:1,

      		
      		txtid_prospecto_cz:axid_prospecto_cz,
			txttipo_cliente_pst:axtipo_cliente_pst,
			txtid_doc:axid_doc,
			txtnum_doc_cliente_pst:axnum_doc_cliente_pst,
			txtcod_cliente_pst:axcod_cliente_pst,
			txtnombres_cliente_pst:axnombres_cliente_pst,
			txtpaterno_cliente_pst:axpaterno_cliente_pst,
			txtmaterno_cliente_pst:axmaterno_cliente_pst,
			txtcliente_pst:axcliente_pst,
			txtmodulo:axmodulo,
			txtid_usuario:axid_usuario,
			txtparametros:axparametros
      		
    	},
      success : function(data){

      		if(data==0){

        	Swal.fire({
					  position: "center",
					  icon: "success",
					  title: "El registro fue ACTUALIZADO",
					  showConfirmButton: false,
					  timer: 200
					});
        			$("#txtparametros").val(0)

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

$(document).on("click","#btn_sunat_buscar",function(){

var  axruc = $("#txtnum_doc_cliente_pst").val();

$.ajax({
	url:"funciones.php",
	method: "POST",
	data: {param:5,txtnum_doc_cliente_pst:axruc},
	success : function(data){		
		
		var json = JSON.parse(data);
		$("#txtcliente_pst").val(json.nombre);
		$("#txtnom_cliente").val(json.nombre);								
		$("#txtid_doc").val(json.tipoDocumento);	
							
	}

	})

})


$(document).on("click","#btn_reniec",function(){

	var  axruc = $("#txtnum_doc_cliente_pst").val();

	if(axruc==''){

		Swal.fire({title: "Advertencia",
				 text: "Ingrese el Número documento identidad",
				 icon: "warning"
				});

	}else{

		$.ajax({
			url:"funciones.php",
			method: "POST",
			data: {param:6,txtnum_doc_cliente_pst:axruc},
			success : function(data){				
				var json = JSON.parse(data);
					
					$("#txtcliente_pst").val(json.nombres+' '+json.apellidoPaterno);	
					$("#txtnom_cliente").val(json.nombres+' '+json.apellidoPaterno);								
					$("#txtpaterno_cliente_pst").val(json.apellidoPaterno);			
					$("#txtmaterno_cliente_pst").val(json.apellidoMaterno);			
					$("#txtnombres_cliente_pst").val(json.nombre);		
					$("#txtid_doc").val(json.tipoDocumento);		
						

					
			}

			})

	}

})


$(document).on("click","#txttipo_cliente_pst",function(){

	var axtipo_cliente_pst=($("#txttipo_cliente_pst option:selected").text());

	if(axtipo_cliente_pst=='NATURAL'){

		$("#btn_reniec").prop('hidden',false)
		$("#btn_sunat_buscar").prop('hidden',true)

	}else if(axtipo_cliente_pst=='JURIDICA'){
		$("#btn_reniec").prop('hidden',true)
		$("#btn_sunat_buscar").prop('hidden',false)
	}
	
	



})


function listar_mis_prospectos_asignados(){

var axid_ejecutivo = $("#txtid_ejecutivo").val()
var axid_empresa = $("#txtid_empresa").val()
var axbuscar_prospectos = $("#txtbuscar_prospectos").val()
var axfecha_del = $("#txtfecha_del").val()
var axfecha_al = $("#txtfecha_al").val()

$.ajax({
	url:"Mis_prospectos_funciones.php",
	method: "POST",
	data: {param:0,

		txtid_ejecutivo:axid_ejecutivo,
		txtid_empresa:axid_empresa,
		txtbuscar_prospectos:axbuscar_prospectos,
		txtfecha_del:axfecha_del,
		txtfecha_al:axfecha_al

		},
		success : function(data){	      	
	        $('#div_prospectos_asignados').html(data);
	     }
	});


}


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

	
			$("#titulo_formulario").html("<i class='bi bi-person-hearts' style='font-size:25px;'></i> "+data)		

		}
	})

}


function Verifica_permiso(){

	var axiduser =$("#txtid_usuario").val();
	var axtipo_beneficiario =$("#txttipo_beneficiario").val();	
	var axpermiso_1 = 'MIS PROSPECTOS';	
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
   	//horaImprimible = hora + ":" + minuto 

   	document.form_reloj.reloj.value = horaImprimible 
   	document.form_reloj_1.txthora_asignacion.value = horaImprimible 
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

   function focusNextElement(event, nextElementId) {
        if (event.key === "Enter") {
            event.preventDefault(); // Evitar que se envíe el formulario
            const nextElement = document.getElementById(nextElementId);
            if (nextElement) {
                nextElement.focus();
            }
        }
    }

    function convertirAMayusculas(input) {
  input.value = input.value.toUpperCase();
}


</script>


