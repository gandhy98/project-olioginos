<?php require_once '../includes/header.php';?>

<!DOCTYPE html>
	<html>
	<head>
		    
	</head>


	<input type="hidden" name="txtparametros" id="txtparametros">
	<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axiduser";?>">
	<input type="hidden" name="txtid_empresa" id="txtid_empresa" value="<?php echo "$axidempresa";?>">	
	<input type="hidden" name="txtid_usuario" id="txtid_usuario" value="<?php echo "$axid_usuario";?>">

		<input type="hidden" name="txttipoorden" id="txttipoorden">
	<input type="hidden" name="txtorden" id="txtorden">	
	<input type="hidden" name="txtfiltro_buscar" id="txtfiltro_buscar">	

	<input type="hidden" name="txttipoorden" id="txttipoorden">
		<input type="hidden" id="txtnom_tabla" value='MK_CANALES'>	
		<input type="hidden" id="txttipo_busqueda">	
		<input type="hidden" id="txtcampo_contenido">	
		<input type="hidden" id="txtcampo_tabla">	
		<input type="hidden" id="txtcampo_tabla_orden">	
		

		<input type="hidden" id="txtmodulo_eliminar">
		<input type="hidden" id="txtpermiso_editar">


	<body style="padding: 10px;">


	<div class="card">
  	<div class="card-header">
  		<div class="row g-3" id="div_buscar">

  			<div class="col-md-4">
	        <h5 id="titulo_formulario"></h5>
	    	</div>

	    	<div class="col-md-4" style="text-align:left;">
	      	<!--div class="btn-group W-400" role="group">
	          <div class="dropdown">	            				
						<button type="button" class="btn btn-link dropdown" id="div_btn_filtrar" style="text-decoration: none;" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
						Filtrar
						</button>
						<form class="dropdown-menu p-2">
						<ul class="list-group list-group-flush" id='div_filtros' style="font-size: 12px;"></ul>					
						</form>
						</div>
					</div-->
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
				   <input type="text" class="form-control" id="txtbuscar_canales" placeholder="Buscar "oninput="convertirAMayusculas(this)">
				  	<span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
					</div>
				</div>
  	</div>
  	</div>

  	<div class="card-body">

  		
	    <div id="div_listar_canales"></div>			

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
		    <h5 class="modal-title text-primary" id="exampleModalLabel">Registrar Canales</h5>		    
		    </div>

		    	<input type="hidden" class="form-control" id="txtid_canal">
				<input type="hidden" class="form-control" id="txtfecha_registro_canal">

				<div class="modal-body">	

					
									
					<div class="row g-3">

						<div class="col-md-8">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtdescripcion_canal" placeholder="Canal de prospección" oninput="convertirAMayusculas(this)">
  							<label for="txtdescripcion_canal"><b>Canal de prospección</b></label>
					  	</div>
						</div>
					

						<div class="col-md-4">
							<div class="form-floating">
							<select class="form-control custom-select mr-sm-2" id="txtestado_canal">
							<option value="ACTIVO">ACTIVO</option>
							<option value="INACTIVO">INACTIVO</option>
					    </select>
								<label for="txtestado_canal"><b>Estado</b></label> 
							</div>
						  </div>	

					</div>

					
					<br>
					
				</div>
		    
		    <div class="modal-footer">
		    		<button type="button" class="btn btn-outline-success btn-sm"  id="btn_agregar_canal" data-bs-dismiss="modal"><i class="fas fa-save"></i> Grabar</button>
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
	listar();
	traer_nom_menu()



});
/****************************/


$(document).on("click","#btn_prospectos_todos",function(){
	
	$("#txttipoorden").val($(this).data('tipoorden'))		
	listar()
})


	

$(document).on("click","#btn_buscar_campo_contenido",function(){
	
	$("#txtcampo_contenido").val($(this).data('campo_contenido'))		
	listar()		
})

$(document).on("click","#btn_ordenar_campo",function(){
	$("#txtorden").val($(this).data('order'))
	$("#txtcampo_tabla_orden").val($(this).data('campo_tabla_orden'))	
	$("#txttipoorden").val('')		
	listar()
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



$(document).on("click","#btn_ordenar_estado_asc",function(){
		$("#txttipoorden").val($(this).data('tipoorden'))				
		var axorden = 'ASC';
		$("#txtorden").val(axorden)	
		listar()
	})

$(document).on("click","#btn_ordenar_estado_desc",function(){
		
		$("#txttipoorden").val($(this).data('tipoorden'))		
		var axorden = 'DESC';
		$("#txtorden").val(axorden)			
		listar()
	})


$(document).on("click","#btn_ordenar_canal_asc",function(){
		$("#txttipoorden").val($(this).data('tipoorden'))				
		var axorden = 'ASC';
		$("#txtorden").val(axorden)	
		listar()
	})

$(document).on("click","#btn_ordenar_canal_desc",function(){
		
		$("#txttipoorden").val($(this).data('tipoorden'))		
		var axorden = 'DESC';
		$("#txtorden").val(axorden)			
		listar()
	})


	$(document).on("keyup","#txtbuscar_canales",function(){
		listar()
	})

$(document).on("click","#btn_eliminar_canal",function(){
	
	$("#txtid_canal").val($(this).data('id'))	
	var axid_canal = $("#txtid_canal").val();

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
      url:"Canales_funciones.php",
      method: "POST",
      data: {param:3,txtid_canal:axid_canal,
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



$(document).on("click","#btn_editar_canal",function(){
	
	$("#txtid_canal").val($(this).data('id'))	
	var axid_canal = $("#txtid_canal").val();
	$("#txtparametros").val(1)
	var axpermiso_editar = $("#txtpermiso_editar").val()	

		if(axpermiso_editar==0){

		 $.ajax({

      url:"Canales_funciones.php",
      method: "POST",
      data: {param:2,txtid_canal:axid_canal},
      success : function(Traedatos){

      	var json = JSON.parse(Traedatos);
		
			if (json.status == 200){				
				
				$("#txtid_empresa").val(json.ID_EMPRESA);
				$("#txtid_canal").val(json.ID_CANAL);
				$("#txtdescripcion_canal").val(json.DESCRIPCION_CANAL);
				$("#txtestado_canal").val(json.ESTADO_CANAL);
				
		

			}
        
    }
    
  });

	 }else{
	 			Swal.fire("Aviso", "Usted no tiene permiso para EDITAR", "warning")
		$("#exampleModal").modal('hide',true)
			
		}


})


$(document).on("click","#btn_nuevo",function(){
	$("#txtparametros").val(0)
})


$(document).on("click","#btn_agregar_canal",function(){

var axid_empresa = $("#txtid_empresa").val();
var axid_canal = $("#txtid_canal").val();
var axdescripcion_canal = $("#txtdescripcion_canal").val();
var axestado_canal = $("#txtestado_canal").val();
var axparametros = $("#txtparametros").val();

var axmodulo = $("#txtmodulo").val()
 var axid_usuario = $("#txtid_usuario").val()

if(axdescripcion_canal==''){

	Swal.fire({
						  title: "Advertencia",
						  text: "Ingrese la descipción...",
						  icon: "error"
						});

}else{



 $.ajax({
      url:"Canales_funciones.php",
      method: "POST",
      data: {param:1,

      	txtid_empresa:axid_empresa,
				txtid_canal:axid_canal,
				txtdescripcion_canal:axdescripcion_canal,
				txtestado_canal:axestado_canal,
				txtparametros:axparametros,
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
					$("#txtdescripcion_canal").val('');
				listar()
			
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







function listar() {
		
var axid_empresa = $("#txtid_empresa").val();
var axbuscar = $("#txtbuscar_canales").val();
var axorden =  $("#txtorden").val()	
var axtipoorden =  $("#txttipoorden").val()

var axnom_tabla = $("#txtnom_tabla").val()
var axtipo_busqueda = $("#txttipo_busqueda").val()			
var axcampo_tabla = $("#txtcampo_tabla").val()	
var axcampo_tabla_orden = $("#txtcampo_tabla_orden").val()	
var axcampo_contenido = $("#txtcampo_contenido").val()	

var axpermiso_editar = $("#txtpermiso_editar").val()	

 $.ajax({
      url:"Canales_funciones.php",
      method: "POST",
      data: {param:0,
      	   txtid_empresa:axid_empresa,
				txtbuscar_canales:axbuscar,
				txtorden:axorden,
				txttipoorden:axtipoorden,				
				txtnom_tabla:axnom_tabla,
				txttipo_busqueda:axtipo_busqueda,
				txtcampo_tabla:axcampo_tabla,
				txtcampo_tabla_orden:axcampo_tabla_orden,
				txtcampo_contenido:axcampo_contenido,
				txtpermiso_editar:axpermiso_editar

			},
      success : function(data){

        $('#div_listar_canales').html(data);

          
        
      }
    });

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

	
			$("#titulo_formulario").html("<i class='fa-solid fa-eye' style='font-size:25px;'></i> "+data +" <button type='button' id='btn_nuevo'  class='btn btn-outline-primary btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='bi bi-file-earmark-plus'></i> Nuevo</button> <a href='Proyectos.php' id='btn_retornar_de_detalles'  class='btn btn-outline-danger btn-sm' hidden><i class='bi bi-arrow-return-left'></i> Retornar</a>")		

		}
	})

}
function Verifica_permiso_editar(){

	var axiduser =$("#txtid_usuario").val();
	var axtipo_beneficiario =$("#txttipo_beneficiario").val();	
	var axpermiso_1 = 'CANALES EDITAR';
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
	var axpermiso_1 = 'CANALES';	
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

function convertirAMayusculas(input) {
  input.value = input.value.toUpperCase();
}


</script>