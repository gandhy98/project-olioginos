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

	<body style="margin: 0;">

	<br>
	<div class="card" style="width:calc(100% - 100px); margin-left: 90px;">
  	<div class="card-header">
  		<div  style="padding: 2px;"><h5 id="titulo_formulario"></h5></div>
	    <!--h5><i class="bi bi-buildings-fill"></i> Locales <button type="button" id="bnNuevo"  class="btn btn-outline-danger btn-sm" data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='bi bi-file-earmark-plus'></i></i> Nuevo</button></h5-->	
  	</div>

  	<div class="card-body">

  		<div class="row g-3">
			<div class="col-md-3">
			<div class="form-floating">
			<input type="text" class="form-control" id="txtbuscar" placeholder="Buscar negocios">
			<label for="txtbuscar"><b><i class="bi bi-search"></i> Buscar</b></label>
			</div>
			</div>
		</div>
		<br>
	    <div id="lista1"></div>			

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
		    <h5 class="modal-title text-primary" id="exampleModalLabel">Registrar de Prospecto</h5>		    
		    </div>

		    	<input type="hidden" class="form-control" id="txtid_prospecto_cz">
				<input type="hidden" class="form-control" id="txtid_provecto">
				<input type="hidden" class="form-control" id="txtid_medio_captacion">
				<input type="hidden" class="form-control" id="txtid_canal">
				<input type="hidden" class="form-control" id="txtid_usuario">
				<input type="hidden" class="form-control" id="txtid_doc">
		    	<input type="hidden" class="form-control" id="txtfecha_registro_py">

				<div class="modal-body">	

					
									
					<div class="row g-3">

						<div class="col-md-3">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtcodigo_pst_cz" placeholder="Cod. Proyecto">
  							<label for="txtcodigo_pst_cz"><b>Cod. Prospecto</b></label>
					  	</div>
						</div>
					

						<div class="col-md-6">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtdescripcion_pst" placeholder="Descripción del proyecto">
  							<label for="txtdescripcion_pst"><b>Descripción del prospecto</b></label>
					  	</div>
						</div>

						<div class="col-md-3">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtcomentario_pst" placeholder="Comentario Abreviado">
  							<label for="txtcomentario_pst"><b>Comentario del prospecto</b></label>
					  	</div>
						</div>

											
						<div class="col-md-3">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtcod_cliente_pst" placeholder="Código del cliente">
  							<label for="txtcod_cliente_pst"><b>Código del cliente</b></label>
					  	</div>
						</div>
					

						<div class="col-md-9">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtcliente_pst" placeholder="Cliente">
  							<label for="txtcliente_pst"><b>Cliente</b></label>
					  	</div>
						</div>

						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtnum_doc_cliente" placeholder="Nro. Documento">
  							<label for="txtnum_doc_cliente"><b>Nro. Documento</b></label>
					  	</div>
						</div>



						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txttipo_cliente_pst" placeholder="Tipo de Cliente">
  							<label for="txttipo_cliente_pst"><b>Tipo de Cliente</b></label>
					  	</div>
						</div>

						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtemail_cliente_pst" placeholder="Email de Cliente">
  							<label for="txtemail_cliente_pst"><b>Email de Cliente</b></label>
					  	</div>
						</div>

		
						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtnum_cellar_pst" placeholder="Celular de Cliente">
  							<label for="txtnum_cellar_pst"><b>Celular de Cliente</b></label>
					  	</div>
						</div>

					</div>

					
					<br>
					
				</div>
		    
		    <div class="modal-footer">
		    		<button type="button" class="btn btn-outline-success btn-sm"  id="btgrabarempresa" data-bs-dismiss="modal"><i class="fas fa-save"></i> Grabar</button>
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
	
	//Verifica_permiso()
	//listar_almacenes();
	traer_nom_menu()

});
/****************************/


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
	/*
	var axmodulo = $("#txtmodulo").val();	
	$.ajax({
		url:"permisos.php",
		method: "POST",
		data: {param:2,txtmodulo:axmodulo},
		success : function(data){

*/
		var data ='Registro de prospectos';

			$("#titulo_formulario").html("<img src='../icon/proyectos.png' style='width:50px;'> "+data +" <button type='button' id='btn_nuevo'  class='btn btn-outline-primary btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='bi bi-file-earmark-plus'></i> Nuevo</button>")		
	/*
		}
	})
*/
}


function Verifica_permiso(){
/*
var axiduser =$("#txtcodusuario").val();
	var axtipo_beneficiario =$("#txttipo_beneficiario").val();
	//alert(axtipo_beneficiario)
	var axpermiso_1 = 'LOCALES';	
	$("#txtmodulo").val(axpermiso_1);
	var axmodulo = $("#txtmodulo").val();


	
	$.ajax({
		url:"permisos.php",
		method: "POST",
		data: {param:1,txtcodusuario:axiduser,txtmodulo:axmodulo},
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

	*/
}

</script>