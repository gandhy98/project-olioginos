<?php require_once '../includes/header.php';?>

<!DOCTYPE html>
	<html>
	<head>
		    
	</head>
	
	<!--img src="../img/empresa.PNG" style="opacity: 0.2;"-->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<input type="hidden" name="txtparametros" id="txtparametros">
	<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axiduser";?>">
	<input type="hidden" name="txtid_empresa" id="txtid_empresa" value="<?php echo "$axidempresa";?>">	
	<input type="hidden" name="txtid_usuario" id="txtid_usuario" value="<?php echo "$axid_usuario";?>">
	<input type="hidden" class="form-control" id="txtubigeo_py">
	

	<body style="padding: 10px; margin: 0;">

		<div class="card">
  	<div class="card-header">
  		<div  style="padding: 2px;"><h5 id="titulo_formulario"></h5></div>
	    <!--h5><i class="bi bi-buildings-fill"></i> Locales <button type="button" id="bnNuevo"  class="btn btn-outline-danger btn-sm" data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='bi bi-file-earmark-plus'></i></i> Nuevo</button></h5-->	
  	</div>

  	<div class="card-body">

  		<div class="row g-3">
			<div class="col-md-3">
			<div class="form-floating">
			<input type="text" class="form-control" id="txtbuscar_medios" placeholder="Buscar negocios">
			<label for="txtbuscar"><b><i class="bi bi-search"></i> Buscar</b></label>
			</div>
			</div>
		</div>
		<br>
	    <div id="div_listar_clientes"></div>			

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
      			
      	<div class="modal-header">
		    <h5 class="modal-title text-primary" id="exampleModalLabel">Registrar Clientes</h5>		    
		    </div>

		    <input type="hidden" class="form-control" id="txtid_cliente">
		    <input type="hidden" class="form-control" id="txtnombres_cliente">
		    <input type="hidden" class="form-control" id="txtpaterno_cliente">
		    <input type="hidden" class="form-control" id="txtmaterno_cliente">

		    <input type="hidden" class="form-control" id="txtnombres_conyugue">
		    <input type="hidden" class="form-control" id="txtpaterno_conyugue">
		    <input type="hidden" class="form-control" id="txtmaterno_conyugue">
		    <input type="hidden" class="form-control" id="txtnom_carpeta">

		    <div class="modal-body">	

					<div class="row g-3">

						<div class="col-md-3">
							<div class="input-group mb-3">						  	
							<input type="text" class="form-control text-center" id="txtcod_cliente" placeholder="Cod. Cliente" aria-label="Username" aria-describedby="basic-addon1" disabled>
							<button type="button" class="btn btn-outline-primary btn-sm"  id="btn_generar_codigo"><i class="bi bi-qr-code"></i> Generar</button>
							</div>
						</div>

						<div class="col-md-3">
							<div class="input-group mb-3">	
							<span class="input-group-text" id="basic-addon2">Estado</span>
							<select class="form-select" aria-label="Default select example" id="txtestado_cliente">											
							<option value="ACTIVO">ACTIVO</option>
							<option value="INACTIVO">INACTIVO</option>
							</select>
							</div>
							</div>

					</div>

					<div class="row g-3" id='div_form_datos_1'>	
			
							<div class="col-md-3">
							<div class="input-group mb-3">	
							<span class="input-group-text" id="basic-addon2">Tipo Cliente</span>
							<select class="form-select" aria-label="Default select example" id="txttipo_cliente">											
							<option value="NATURAL">NATURAL</option>
							<option value="JURIDICA">JURIDICA</option>
							</select>
							</div>
							</div>


							<div class="col-md-6">
							<div class="input-group mb-3">	
							<span class="input-group-text" id="basic-addon2">Tipo documento</span>
							<select class="form-select" aria-label="Default select example" id="txtid_doc">											
							<option value="">Seleccionar</option>
							<?php while($fila=odbc_fetch_array($RSTipo_doc_ident_1)) {?>
							<option value="<?php echo $fila['ID_DOC'];?>"><?php echo $fila['DOC_IDENTIDAD'];?></option><?php } ?>
							</select>
							</div>
							</div>

							<div class="col-md-3">
								<div class="input-group mb-3">						  	
								<input type="text" class="form-control text-center" id="txtnum_documento" placeholder="Doc. Identidad" aria-label="Username" aria-describedby="basic-addon1">
								<button type="button" class="btn btn-outline-primary btn-sm"  id="btn_reniec"><img src="../icon/reniec.png" style="width:15px;"> RENIEC</button>
								<button type="button" class="btn btn-outline-primary btn-sm"  id="btn_sunat" hidden><img src="../icon/sunat.png" style="width:30px;"> SUNAT</button>
								</div>
							</div>

										
							<div class="col-md-6">
								<div class="form-floating">
								<input type="text" class="form-control" id="txtnom_cliente" placeholder="Apellidos y nombres">
								<label for="txtnom_cliente"><b><i class="bi bi-textarea-t"></i> Apellidos y nombres</b></label>
								</div>
							</div>

							<div class="col-md-3">		
								<div class="form-floating">
								<select class="form-select" id="txtgenero_cliente" aria-label="Floating label select example">
								<option selected>Seleccionar</option>
								<option value="MASCULINO">MASCULINO</option>
								<option value="FEMENINO">FEMENINO</option>								
								</select>
								<label for="txtgenero_cliente"><i class="bi bi-gender-male"></i> Género</label>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-floating">
								<input type="date" class="form-control" id="txtfecha_nac_cliente" placeholder="Fecha nacimiento " value="<?php echo "$diaactual";?>" >
								<label  for="txtfecha_nac_cliente"><b><i class="bi bi-calendar-date-fill"></i> Fecha nacimiento </b></label>
								</div>					  
							</div>
							
							

							<div class="col-md-3">
								<div class="form-floating">
								<input type="text" class="form-control" id="txtnum_celular" placeholder="Celular">
								<label for="txtnum_celular"><b><i class="bi bi-phone-fill"></i> Celular</b></label>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-floating">
								<input type="text" class="form-control" id="txtemail_cliente" placeholder="Email">
								<label for="txtemail_cliente"><b><i class="bi bi-envelope-at-fill"></i> Email</b></label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-floating">
								<input type="text" class="form-control" id="txtdireccion_cliente" placeholder="Dirección">
								<label for="txtdireccion_cliente"><b><i class="bi bi-geo-alt-fill"></i> Dirección</b></label>
								</div>
							</div>


							<div class="col-md-8">
							<div class="form-floating">
							<input type="hidden" class="form-control" id="txtdistrito">
							<input type="text" class="form-control" id="txtbuscar_distrito" placeholder="Distrito">
						  <label for="txtdistrito"><b> <i class="bi bi-geo-alt-fill"></i> Distrito</b></label>
							</div>
							<div id="div_listar_ubigeos"></div>
							</div>

							<div class="col-md-4">
							<div class="form-floating">
							<input type="text" class="form-control" id="txtprovincia" placeholder="Provincia" disabled>
						  <label for="txtprovincia"><b> <i class="bi bi-geo-alt-fill"></i> Provincia</b></label>
							</div>
							</div>
							
							<div class="col-md-4">
							<div class="form-floating">
							<input type="text" class="form-control" id="txtdepartamento" placeholder="Departamento" disabled>
						  <label for="txtdepartamento"><b> <i class="bi bi-geo-alt-fill"></i> Departamento</b></label>
							</div>
							</div>

							<div class="col-md-4">
							<div class="form-floating">
							<input type="text" class="form-control" id="txtnacion_cliente" placeholder="Nacionalidad" value="PERUANA">
						  <label for="txtnacion_cliente"><b><i class="bi bi-geo-alt-fill"></i> Nacionalidad</b></label>
							</div>
							</div>
					
							<div class="col-md-4" >		
								<div class="form-floating">
								<select class="form-select" id="txtestado_civil" aria-label="Floating label select example">		
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

						</div>
						<br>
						<div class="row g-3" id='div_form_datos_2'>

							<div class="col-md-4">
								<div class="input-group mb-3">						  	
								<input type="text" class="form-control text-center" id="txtnum_doc_conyugue" placeholder="Doc. Identidad" aria-label="Username" aria-describedby="basic-addon1">
								<button type="button" class="btn btn-outline-primary btn-sm"  id="btn_reniec_conyugue"><img src="../icon/reniec.png" style="width:15px;"> RENIEC</button>								
								</div>
							</div>					

							<div class="col-md-8">
								<div class="input-group mb-3">						  	
								<input type="text" class="form-control text-center" id="txtnom_conyugue" placeholder="Apellidos y nombres conyugue" aria-label="Username" aria-describedby="basic-addon1">
								</div>
								</div>

					</div>

					
					
				</div>
		    
		    <div class="modal-footer">
		    		<button type="button" class="btn btn-outline-success btn-sm"  id="btn_agregar_cliente"><i class="fas fa-save"></i> Grabar</button>
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
	traer_nom_menu()
	listar()

});
/****************************/



$(document).on("click","#btn_lista_ubigeos",function(){
		
 	$("#txtubigeo_py").val($(this).data('id'));
 	var axubigeo_py  = $("#txtubigeo_py").val();
 	$("#txtbuscar_distrito").val($(this).text());
	
 	 $.ajax({

      url:"Clientes_funciones.php",
      method: "POST",
      data: {param:7,txtubigeo_py:axubigeo_py},
      success : function(Traedatos){

      	var json = JSON.parse(Traedatos);
		
			if (json.status == 200){				
				
				$("#txtdistrito").val(json.DISTRITO);
				$("#txtprovincia").val(json.PROVINCIA);
				$("#txtdepartamento").val(json.DEPARTAMENTO);
							

			}
        
    }
    
  });
  	$("#div_listar_ubigeos").fadeOut();
});



$('#txtbuscar_distrito').keyup(function(){

  var axbuscar_distrito = $("#txtbuscar_distrito").val();

  if (axbuscar_distrito != '') {

    $.ajax({
      url:"Clientes_funciones.php",
      method: "POST",
      data: {param:6,txtbuscar_distrito:axbuscar_distrito},
      success : function(data){

        $('#div_listar_ubigeos').fadeIn();
        $('#div_listar_ubigeos').html(data);
        
      }
    });
  } 
});



$(document).on("click","#btn_sunat",function(){

	var  axruc = $("#txtnum_documento").val();

	if(axruc==''){

		Swal.fire({title: "Advertencia",
				 text: "Ingrese el Número documento identidad",
				 icon: "warning"
				});

	}else{

		$.ajax({
			url:"Clientes_funciones.php",
			method: "POST",
			data: {param:5,txtnum_documento:axruc},
			success : function(data){				
				var json = JSON.parse(data);

				if (json.status == 201){

						$("#txtnom_cliente").val(json.NOMBRES_CLIENTE_PST);	
						$("#txtcod_cliente").val(json.COD_CLIENTE_PST);	
						$("#txtnum_celular").val(json.NUM_CELULAR_PST);	
						$("#txtemail_cliente").val(json.EMAIL_CLIENTE_PST);	
						$("#txttipo_cliente").val(json.TIPO_CLIENTE_PST);											

						$("#txtid_doc").val(json.ID_DOC);											
						$("#btn_generar_codigo").prop('disabled',true)

				}else if(json.status == 202){


					Swal.fire({
						  title: "Advertencia",
						  text: "El cliente existe en la base datos",
						  icon: "warning"
						});				


				}else{

					$("#txtnom_cliente").val(json.nombre);
					$("#txtdireccion_cliente").val(json.direccion)
					$("#txtdistrito").val(json.distrito)
					$("#txtprovincia").val(json.provincia)
					$("#txtdepartamento").val(json.departamento)					
					$("#txtid_doc").val(json.tipoDocumento);	
				}
					
					
				
			}

			})

	}

})


$(document).on("click","#btn_reniec_conyugue",function(){

	var  axruc = $("#txtnum_doc_conyugue").val();

	if(axruc==''){

		Swal.fire({title: "Advertencia",
				 text: "Ingrese el Número documento identidad",
				 icon: "warning"
				});

	}else{

		$.ajax({
			url:"Clientes_funciones.php",
			method: "POST",
			data: {param:8,txtnum_doc_conyugue:axruc},
			success : function(data){				
				var json = JSON.parse(data);
						$("#txtnom_conyugue").val(json.nombres+' '+json.apellidoPaterno+' '+json.apellidoMaterno);		
						$("#txtnombres_conyugue").val(json.nombres)
						$("#txtpaterno_conyugue").val(json.apellidoPaterno)
						$("#txtmaterno_conyugue	").val(json.apellidoMaterno)
			}

			})

	}

})


$(document).on("click","#btn_reniec",function(){

	var  axruc = $("#txtnum_documento").val();

	if(axruc==''){

		Swal.fire({title: "Advertencia",
				 text: "Ingrese el Número documento identidad",
				 icon: "warning"
				});

	}else{

		$.ajax({
			url:"Clientes_funciones.php",
			method: "POST",
			data: {param:4,txtnum_documento:axruc},
			success : function(data){				
				var json = JSON.parse(data);

				if (json.status == 201){

					 Swal.fire({
						  title: "Aviso",
						  text: "El cliente forma parte de un PROSPECTO",
						  icon: "success"
						});

						$("#txtnom_cliente").val(json.NOMBRES_CLIENTE_PST+' '+json.PATERNO_CLIENTE_PST+' '+json.MATERNO_CLIENTE_PST);			
						$("#txtpaterno_cliente").val(json.PATERNO_CLIENTE_PST);			
						$("#txtmaterno_cliente").val(json.MATERNO_CLIENTE_PST);			
						$("#txtnombres_cliente").val(json.NOMBRES_CLIENTE_PST);							

						$("#txtcod_cliente").val(json.COD_CLIENTE_PST);	
						$("#txtnum_celular").val(json.NUM_CELULAR_PST);	
						$("#txtemail_cliente").val(json.EMAIL_CLIENTE_PST);	
						$("#txttipo_cliente").val(json.TIPO_CLIENTE_PST);											

						$("#txtid_doc").val(json.ID_DOC);

						$("#btn_generar_codigo").prop('disabled',true)											

				}else if(json.status == 202){


					Swal.fire({
						  title: "Advertencia",
						  text: "El cliente existe en la base datos",
						  icon: "warning"
						});				


				}else{


					$("#txtnom_cliente").val(json.nombres+' '+json.apellidoPaterno+' '+json.apellidoMaterno);			
					$("#txtpaterno_cliente").val(json.apellidoPaterno);			
					$("#txtmaterno_cliente").val(json.apellidoMaterno);			
					$("#txtnombres_cliente").val(json.nombres);	


				}
					
					
				
			}

			})

	}

})


$(document).on("click","#txttipo_cliente",function(){

	var axtipo_cliente=($("#txttipo_cliente option:selected").text());

	if(axtipo_cliente=='NATURAL'){

		$("#btn_reniec").prop('hidden',false)
		$("#btn_sunat").prop('hidden',true)

	}else if(axtipo_cliente=='JURIDICA'){
		$("#btn_reniec").prop('hidden',true)
		$("#btn_sunat").prop('hidden',false)
	}
	
	



})

$(document).on("click","#btn_generar_codigo",function(){

$.ajax({
	      url:"funciones.php",
	      method: "POST",
	      data: {param:0},
	      success : function(data){	      	
	        $("#txtcod_cliente").val(data)
	      }
	    });
})


	$(document).on("keyup","#txtbuscar_medios",function(){
		listar()
	})

$(document).on("click","#btn_eliminar_cliente",function(){
	
		$("#txtid_cliente").val($(this).data('id'))	
	var axid_cliente = $("#txtid_cliente").val();
	
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
      url:"Clientes_funciones.php",
      method: "POST",
      data: {param:3,
      txtid_cliente:axid_cliente,
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
						listar();

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

$(document).on("click","#btn_editar_cliente",function(){
	
	$("#txtid_cliente").val($(this).data('id'))	
	var axid_cliente = $("#txtid_cliente").val();
	$("#txtparametros").val(1)

	 $.ajax({

      url:"Clientes_funciones.php",
      method: "POST",
      data: {param:2,txtid_cliente:axid_cliente},
      success : function(Traedatos){     	
     	var json = JSON.parse(Traedatos);		
			
			if (json.status == 200){				
				
				$("#txtid_cliente").val(json.ID_CLIENTE)
				$("#txttipo_cliente").val(json.TIPO_CLIENTE)
				$("#txtid_doc").val(json.ID_DOC)
				$("#txtnum_documento").val(json.NUM_DOCUMENTO)
				$("#txtcod_cliente").val(json.COD_CLIENTE)
				$("#txtnombres_cliente").val(json.NOMBRES_CLIENTE)
				$("#txtpaterno_cliente").val(json.PATERNO_CLIENTE)
				$("#txtmaterno_cliente").val(json.MATERNO_CLIENTE)
				$("#txtnom_cliente").val(json.NOM_CLIENTE)
				$("#txtemail_cliente").val(json.EMAIL_CLIENTE)
				$("#txtnum_celular").val(json.NUM_CELULAR)
				$("#txtestado_civil").val(json.ESTADO_CIVIL)
				$("#txtgenero_cliente").val(json.GENERO_CLIENTE)
				$("#txtfecha_nac_cliente").val(json.FECHA_NAC_CLIENTE)
				$("#txtnum_doc_conyugue").val(json.NUM_DOC_CONYUGUE)
				$("#txtnombres_conyugue").val(json.NOMBRES_CONYUGUE)
				$("#txtpaterno_conyugue").val(json.PATERNO_CONYUGUE)
				$("#txtmaterno_conyugue").val(json.MATERNO_CONYUGUE)
				$("#txtnom_conyugue").val(json.NOM_CONYUGUE)
				$("#txtdireccion_cliente").val(json.DIRECCION_CLIENTE)
				$("#txtdistrito").val(json.DISTRITO)
				$("#txtprovincia").val(json.PROVINCIA)
				$("#txtdepartamento").val(json.DEPARTAMENTO)
				$("#txtnacion_cliente").val(json.NACION_CLIENTE)
				$("#txtnom_carpeta").val(json.NOM_CARPETA)
				$("#txtid_empresa").val(json.ID_EMPRESA)
				$("#txtestado_cliente").val(json.ESTADO_CLIENTE)
				$("#txtbuscar_distrito").val(json.DISTRITO+' - '+json.PROVINCIA+' - '+json.DEPARTAMENTO)

				$("#btn_generar_codigo").prop('disabled',true)


			}
        
    }
    
  });


})


$(document).on("click","#btn_nuevo",function(){
	$("#txtparametros").val(0)
	limpiarCampos();
	//$("#btn_generar_codigo").prop('disabled',false)
})


$(document).on("click","#btn_agregar_cliente",function(){

	 // Verificar campos vacíos
    if (verificar_campos_vacios()) {
        // Si hay campos vacíos, detener la ejecución
        return;
    }


	var axid_cliente = $("#txtid_cliente").val()
	var axtipo_cliente = $("#txttipo_cliente").val()
	var axid_doc = $("#txtid_doc").val()
	var axnum_documento = $("#txtnum_documento").val()
	var axcod_cliente = $("#txtcod_cliente").val()
	var axnombres_cliente = $("#txtnombres_cliente").val()
	var axpaterno_cliente = $("#txtpaterno_cliente").val()
	var axmaterno_cliente = $("#txtmaterno_cliente").val()
	var axnom_cliente = $("#txtnom_cliente").val()
	var axemail_cliente = $("#txtemail_cliente").val()
	var axnum_celular = $("#txtnum_celular").val()
	var axestado_civil = $("#txtestado_civil").val()
	var axgenero_cliente = $("#txtgenero_cliente").val()
	var axfecha_nac_cliente = $("#txtfecha_nac_cliente").val()
	var axnum_doc_conyugue = $("#txtnum_doc_conyugue").val()
	var axnombres_conyugue = $("#txtnombres_conyugue").val()
	var axpaterno_conyugue = $("#txtpaterno_conyugue").val()
	var axmaterno_conyugue = $("#txtmaterno_conyugue").val()
	var axnom_conyugue = $("#txtnom_conyugue").val()
	var axdireccion_cliente = $("#txtdireccion_cliente").val()
	var axdistrito = $("#txtdistrito").val()
	var axprovincia = $("#txtprovincia").val()
	var axdepartamento = $("#txtdepartamento").val()
	var axnacion_cliente = $("#txtnacion_cliente").val()
	var axnom_carpeta = $("#txtnom_carpeta").val()
	var axid_empresa = $("#txtid_empresa").val()
	var axestado_cliente = $("#txtestado_cliente").val()

 var axparametros = $("#txtparametros").val();

 var axmodulo = $("#txtmodulo").val()
 var axid_usuario = $("#txtid_usuario").val()



 $.ajax({
      url:"Clientes_funciones.php",
      method: "POST",
      data: {param:1,

      	txtid_cliente:axid_cliente,
				txttipo_cliente:axtipo_cliente,
				txtid_doc:axid_doc,
				txtnum_documento:axnum_documento,
				txtcod_cliente:axcod_cliente,
				txtnombres_cliente:axnombres_cliente,
				txtpaterno_cliente:axpaterno_cliente,
				txtmaterno_cliente:axmaterno_cliente,
				txtnom_cliente:axnom_cliente,
				txtemail_cliente:axemail_cliente,
				txtnum_celular:axnum_celular,
				txtestado_civil:axestado_civil,
				txtgenero_cliente:axgenero_cliente,
				txtfecha_nac_cliente:axfecha_nac_cliente,
				txtnum_doc_conyugue:axnum_doc_conyugue,
				txtnombres_conyugue:axnombres_conyugue,
				txtpaterno_conyugue:axpaterno_conyugue,
				txtmaterno_conyugue:axmaterno_conyugue,
				txtnom_conyugue:axnom_conyugue,
				txtdireccion_cliente:axdireccion_cliente,
				txtdistrito:axdistrito,
				txtprovincia:axprovincia,
				txtdepartamento:axdepartamento,
				txtnacion_cliente:axnacion_cliente,
				txtnom_carpeta:axnom_carpeta,
				txtid_empresa:axid_empresa,
				txtestado_cliente:axestado_cliente,
				txtparametros:axparametros,
				txtmodulo:axmodulo,
				txtid_usuario:axid_usuario

    	},
      success : function(data){
        
        if(data==0){

        	$('#exampleModal').modal('hide');

        	Swal.fire({
					  position: "center",
					  icon: "success",
					  title: "El registro fue guardado",
					  showConfirmButton: false,
					  timer: 200
					});
					
				listar()
				limpiarCampos()
			
        }else if(data==1){

        	Swal.fire({
						  title: "Advertencia",
						  text: "Error al guardar el registro",
						  icon: "error"
						});


        }else if(data==3){

        	Swal.fire({
						  title: "Advertencia",
						  text: "El cliente ya existe en la base datos",
						  icon: "warning"
						});

        	$('#exampleModal').modal('hide');
        	limpiarCampos()

        }
        
      }
    });



})


function listar() {
		
var axid_empresa = $("#txtid_empresa").val();
var axbuscar = $("#txtbuscar_medios").val();

 $.ajax({
      url:"Clientes_funciones.php",
      method: "POST",
      data: {param:0,txtid_empresa:axid_empresa,txtbuscar_medios:axbuscar},
      success : function(data){
        
        $('#div_listar_clientes').html(data);
        
      }
    });

}



$(document).on("click","#help-button",function(){
traer_videos()

})

function traer_videos() {
	var axmodulo = $("#txtmodulo").val()
	
	$.ajax({
	      url:"permisos.php",
	      method: "POST",
	      data: {param:0,txtmodulo:axmodulo},
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

	
			$("#titulo_formulario").html("<i class='bi bi-people-fill'></i> "+data +" <button type='button' id='btn_nuevo'  class='btn btn-outline-primary btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='bi bi-file-earmark-plus'></i> Nuevo</button>")		

		}
	})

}


function Verifica_permiso(){

	var axiduser =$("#txtid_usuario").val();
	var axtipo_beneficiario =$("#txttipo_beneficiario").val();	
	var axpermiso_1 = 'CLIENTES';	
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


function verificar_campos_vacios() {
   var elementos = document.querySelectorAll('#div_form_datos_1 input, #div_form_datos_1 select');
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

function limpiarCampos() {
    // Limpiar los valores de los campos de entrada
    $("#txtcod_cliente").val("");
    $("#txtestado_cliente").val("ACTIVO");
    $("#txttipo_cliente").val("NATURAL");
    $("#txtid_doc").val("");
    $("#txtnum_documento").val("");
    $("#txtnom_cliente").val("");
    $("#txtgenero_cliente").val("");
    $("#txtfecha_nac_cliente").val("");
    $("#txtnum_celular").val("");
    $("#txtemail_cliente").val("");
    $("#txtdireccion_cliente").val("");
    $("#txtbuscar_distrito").val("");
    $("#txtdistrito").val("");
    $("#txtprovincia").val("");
    $("#txtdepartamento").val("");
    $("#txtnacion_cliente").val("PERUANA");
    $("#txtestado_civil").val("");
    $("#txtnum_doc_conyugue").val("");
    $("#txtnom_conyugue").val("");

    
}

</script>