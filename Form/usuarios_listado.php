<?php require_once '../includes/header.php'; ?>


<!DOCTYPE html>
	<html>
	<head>
		    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	</head>
	<body>
	<!--body style="margin: 3; padding: 3; background: url(../img/usuario.PNG) no-repeat center top;  background-size: cover;  font-family: sans-serif;  height: 100vh;"-->
	<br>
	<div class="container-fluid">
      
     <input type="hidden" name="txtidempresa" id="txtidempresa" value="<?php echo "$axidempresa";?>">
		<input type="hidden" name="txtfecharegistro" id="txtfecharegistro" value="<?php echo "$diaactual";?>">
		<input type="hidden" name="txtparametros" id="txtparametros">
		<input type="hidden" name="txtidusuario" id="txtidusuario">
		<input type="hidden" name="txtidpermiso" id="txtidpermiso">
		<input type="hidden" name="txtidasinacion" id="txtidasinacion">
		<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axcoduser";?>">
   
    <div class="row">
    	<div class="col-12">
      <div class="card">
      
      <div class="card-header">
      
      <h5><img src="../icon/user.png" style="width: 50px; height: 50px;"> Usuarios <button type="button" id="bnNuevo"  class="btn btn-outline-primary btn-sm" data-bs-toggle='modal' data-bs-target='#exampleModal'>Nuevo</button></h5>	
      
      <div class="col-md-5">
		  <div class="row g-3">
			<div class="input-group mb-3" style="padding: 2px;">  	
	  	<input type="text" class="form-control" id="txtbuscarusuario" name="txtbuscarusuario" placeholder="Escribe lo que quieres buscar" aria-describedby="basic-addon3">	
	  	<!--div class="input-group-prepend">    
	    <button type="button" class="btn btn-primary" id="bt_buscar"><i class="fas fa-search"></i></button>
	  	</div-->
	  	</div> 
	  	</div> 
			</div> 
			</div>
      
      <div class="card-body">
      <div id="lista1" style="font-size:10pt;"></div>	  
      </div>
      
      </div>    
      </div>
   	</div>
   
 </div>

	<div class="modal" id="exampleModal">
  	<div class="modal-dialog modal-xl">
    		<div class="modal-content">
      			
      			<div class="centrar" style="padding: 5px; margin: 5px ">
    				<h4>Registro de usuarios</h4>

    				
    			
    			<div class="card">
					  
					  <div class="card-header">
					    <ul class="nav nav-tabs card-header-tabs">
					      <li class="nav-item">
					        <a class="nav-link active" id="pndatos" href="#">Datos</a>
					      </li>
					      <li class="nav-item">
					        <a class="nav-link" id="pnpermisos" href="#">Permisos</a>
					      </li>
					      <li class="nav-item">
					        <a class="nav-link" id="pnasignar" href="#">Asignación</a>
					      </li>
					    </ul>
					  </div>

					  <div class="card-body">					 	
					  <div id="divdatos" style="padding: 5px;">

					  <div class="row g-3">

					  	

							<div class="col-md-3">
					  	<div class="input-group mb-3">
  						<input type="text" class="form-control" id="txtcod_interno" placeholder="Cod. Interno" disabled>
  						<button type="button" class="btn btn-outline-success btn-sm"  id="btn_generar_codigo"><i class="bi bi-qr-code"></i> Generar</button>
							</div>
							</div>

							<div class="col-md-3">
					  	<div class="input-group mb-3">
  						<input type="text" class="form-control" id="txtdniusuario" placeholder="# Documento">
  						<button type="button" class="btn btn-outline-primary btn-sm"  id="btn_reniec"><img src="../icon/reniec.png" style="width:15px;"> RENIEC</button>
							</div>
							</div>


							<div class="col-md-3">
					  	<div class="input-group mb-3">
  						<input type="text" class="form-control" id="txtnum_licencia" placeholder="Num. Licencia">  						
							</div>
							</div>

							<div class="col-md-3">
					  	<div class="input-group mb-3">
  						<select class="form-select" id="txtcargo" aria-label="Floating label select example">
				      <option selected>Tipo usuario</option>
				      <option value="ADMINISTRADOR">ADMINISTRADOR</option>
				      <option value="DISTRIBUCION">DISTRIBUCION</option>				        				      
				      <option value="SISTEMAS">SISTEMAS</option>				        				      
				      <option value="VENDEDOR">VENDEDOR</option>
				      </select>
							</div>
							</div>

						</div>
						<br>	
						<div class="row g-3">

							<input type="hidden" class="form-control" id="txtnombreusuario" placeholder="Apellidos y Nombres">

							<div class="col-md-3">
					  	<div class="form-floating">
					    <input type="text" class="form-control" id="txtpaterno" placeholder="Apellidos Paterno">
  						<label for="txtpaterno"><b>Apellidos Paterno</b></label>
					  	</div>
							</div>

							<div class="col-md-3">
					  	<div class="form-floating">
					    <input type="text" class="form-control" id="txtmaterno" placeholder="Apellidos Materno">
  						<label for="txtpaterno"><b>Apellidos Materno</b></label>
					  	</div>
							</div>


							<div class="col-md-6">
					  	<div class="form-floating">
					    <input type="text" class="form-control" id="txtnombres" placeholder="Nombres">
  						<label for="txtnombres"><b>Nombres</b></label>
					  	</div>
							</div>

							<div class="col-md-3">
					  	<div class="form-floating">
					    <input type="text" class="form-control" id="txtusuario" placeholder="Usuario">
  						<label for="txtusuario"><b>Usuario</b></label>
					  	</div>
							</div>


							<div class="col-md-3">
					  	<div class="form-floating">
					    <input type="password" class="form-control" id="txtclave" placeholder="Clave">
  						<label for="txtclave"><b>Clave</b></label>
					  	</div>
							</div>

							<div class="col-md-3">
					  	<div class="form-floating">
					    <input type="text" class="form-control" id="txtcorrelativo_pedidos" placeholder="Num. Correlativo Pedidos" value="0">
  						<label for="txtcorrelativo_pedidos"><b>Num. Correlativo Pedidos</b></label>
					  	</div>
							</div>

							<div class="col-md-3">
					  	<div class="form-floating">
					    <input type="text" class="form-control" id="txtletra_serie" placeholder="Letra Serie Pedido">
  						<label for="txtletra_serie"><b>Letra Serie Pedido</b></label>
					  	</div>
							</div>


							<div class="col-md-4">
					  	<div class="form-floating">
					    <select class="form-select" id="txtcondicion" aria-label="Floating label select example">
				      <option selected>Seleccionar</option>
				      <option value="ALTA">ALTA</option>
				      <option value="BAJA">BAJA</option>				        				      
				      </select>
				      <label for="txtcondicion">Estado</label>
					  	</div>
							</div>	

						</div>
				
						<p><hr></p>

						<button type="button" class="btn btn-outline-success btn-sm"  id="btgrabarusuario"><i class="fas fa-save"></i> Grabar</button>						
						<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal" id="btn_cerrar_modal" ><i class="fas fa-door-closed"></i> Cerrar</button>	

						</div>

					  <div id="divpermisos"  style="display: none;" >

					  	<div class="row">
							  <div class="col-md-6">
							 	<div id="listarpermisos" ></div>
								
							  </div>

							  <div class="col-md-6">							  	
								<div id="listarpermisosasignados" ></div>	
							  </div>
							</div>

						</div>
					  

					  <div id="divasignar" style="display: none;" >

						  <div class="row g-3">

						  <div class="col-md-6">
							<div class="form-floating">
							<input type="text" class="form-control" id="txtusuarioasignar" placeholder="Usuario" disabled='true'>
  						<label for="txtusuarioasignar">Nombre del usuario</label>
							</div>
							</div>
						
							
							<div class="col-md-6">
							<div class="form-floating">
							<select class="form-select" id="txtid_local" aria-label="Floating label select example">				        
							<option selected>Seleccionar</option>
							<?php while($fila=odbc_fetch_array($rslocales)) {?>
						  <option value="<?php echo $fila['ID_LOCAL'];?>"><?php echo $fila['RAZON_SOCIAL'];?></option><?php } ?>
							</select>
							<label for="txtid_local">Almacenes</label>
							</div>
							</div>

							<!--div class="col-md-6">
							<div class="form-floating">
							<select class="form-select" id="txtetapapy" aria-label="Floating label select example"></select>
							<label for="txtetapapy">Etapas del Proyecto</label>
							</div>
							</div-->

							</div>

							<div class="center" style="text-align: right; padding: 5px;">
						  <button type="button" class="btn btn-outline-info" id="btasignaretapa">Asignar Empresa</button>						  
						  <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" id="btn_cerrar_modal_1" ><i class="fas fa-door-closed"></i> Cerrar</button>	
							</div>
							<div id="listaetapasasignadas" ></div>	
					  </div>
					  
					  </div>
						</div>
    				</div>
    				</div>
    				</div>
    				</div>


	</body>
	</html>	



	<script type="text/javascript">

	$(document).ready(function() {	
		Verifica_permiso();
		listarusuario();
	});

/***************************************/


$(document).on("click","#btn_generar_codigo",function(){

$.ajax({
	      url:"funciones_generales.php",
	      method: "POST",
	      data: {param:0},
	      success : function(data){	      	
	        $("#txtcod_interno").val(data)
	      }
	    });
})



$(document).on("click","#btn_reniec",function(){

	var  axruc = $("#txtdniusuario").val();

	if(axruc==''){

		Swal.fire({title: "Advertencia",
				 text: "Ingrese el Número documento identidad",
				 icon: "warning"
				});

	}else{

		$.ajax({
			url:"usuarios_listado_funciones.php",
			method: "POST",
			data: {param:1,txtdniusuario:axruc},
			success : function(data){				
				var json = JSON.parse(data);
						$("#txtnombreusuario").val(json.nombres+' '+json.apellidoPaterno+' '+json.apellidoMaterno);		
						$("#txtnombres").val(json.nombres)
						$("#txtpaterno").val(json.apellidoPaterno)
						$("#txtmaterno	").val(json.apellidoMaterno)

					

			}

			})

	}

})




$(document).on("change","#txtpaterno,#txtmaterno,#txtnombres",function(){
		
	var axpaterno = $("#txtpaterno").val();
	var axmaterno = $("#txtmaterno").val();
	var axnombres = $("#txtnombres").val();

	var axnombreusuario = axpaterno+' '+axmaterno+' '+axnombres;
	$("#txtnombreusuario").val(axnombreusuario);

	})



	$(document).on("keyup","#txtbuscarusuario",function(){
		listarusuario();
	})

		function listarusuario(){

		var axidempresa = $("#txtidempresa").val();
		var axbuscaregistro = $("#txtbuscarusuario").val();	


		$.ajax({

			url:"usuarios_listado_funciones.php",
			method: "POST",
			data: {param:61,
				txtidempresa:axidempresa,
				txtbuscarusuario:axbuscaregistro
				},
				
				success : function(listadeusuarios){

					$("#lista1").html(listadeusuarios);
			}
		})
	}


	function Verifica_permiso(){

	var axiduser =$("#txtcodusuario").val();
	var axpermiso ="PERFILES USUARIOS";

	$.ajax({

	url:"usuarios_listado_funciones.php",
	method: "POST",
	data:{param:0,txtcodusuario:axiduser,axpermiso:axpermiso},
	success : function(permiso){
		if (permiso==1){

			//swal("Usted no tiene acceso al modulo de compras...", {icon: "success",});
			//window.location="principal.php";		
			//setTimeout ("redireccionar()", 5000); //tiempo expresado en milisegundos

			Swal.fire({
			  title: 'Acceso Denegado',
			  text: "Ustede no tiene acceso a este modulo¡",
			  type: 'warning',
			  showCancelButton: false,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Modulo se cerrara!'
			}).then((result) => {
			 	  window.location="principal.php";
			})

			
			

		} 
	}
	})

}



/******************************************/
function limpiar_modal() {

	var axdniusuario = $("#txtdniusuario").val('')
	var axnombreusuario = $("#txtnombreusuario").val('')
	var axusuario = $("#txtusuario").val('')
	var axclave = $("#txtclave").val('')
	var axemail_usuario = $("#txtemail_usuario").val('')
	var axclave_email_usuario = $("#txtclave_email_usuario").val('')

}



$(document).on("click","#btn_cerrar_modal_1",function(){

	limpiar_modal()

})

$(document).on("click","#btn_cerrar_modal",function(){

	limpiar_modal()

})

$('#txtcontrata').keyup(function(){

	  var axbuscar_dato = $("#txtcontrata").val();
	  var axid_et = $("#txtid_et").val();
	  
	  if (axbuscar_dato != '') {

	    $.ajax({
	      url:"usuarios_listado_funciones.php",
	      method: "POST",
	      data: {param:13,txtcontrata:axbuscar_dato,txtid_et:axid_et},
	      success : function(data){


	      	$('#listar_contratas').fadeIn();
	        $('#listar_contratas').html(data);
	      	

        
	      }
	    });
	  } 
	});


	$(document).on("click","#listar_contratas_click",function(){
		
	$("#txtcontrata").val($(this).text());
	$("#listar_contratas").fadeOut();


	})



	$(document).on("click","#txtquitaretapa",function(){

		var idasignetapa = $(this).data("idasignetapa");
		var axidusuario= $("#txtidusuario").val();
		var axcod_interno = $("#txtcod_interno").val();

		Swal.fire({
		  title: 'Esta seguro de eliminar?',
		  text: "Una vez eliminado, no podrá recuperar este registro!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si Eliminar!'
		}).then((result) => {
		  if (result.value) {

		  	$.ajax({
		      	url:"usuarios_listado_funciones.php",
	    	  	method: "POST",
	      		data: {param:70,
	      		idasignetapa:idasignetapa,
	      		txtidusuario:axidusuario,
	      		txtcod_interno:axcod_interno
	      	},
	      		success : function(eliminaretapa){      			

	        		listaretapasasignas();
	      		}
	    
	    	});

		  	Swal.fire({
				  position: 'center',
				  icon: 'success',
				  title: 'El registro fue eliminado',
				  showConfirmButton: false,
				  timer: 500
				})

		   
		  }
		})


		})




	$(document).on("click","#btquitarmenu",function(){

		var axidmenu = $(this).data("idmenu");
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
		      	url:"usuarios_listado_funciones.php",
	    	  	method: "POST",
	      		data: {param:67,axidmenu:axidmenu,txtidusuario:axidusuario},
	      		success : function(data){      			

	      			if(data==0){
	      					Swal.fire({
									  position: 'center',
									  icon: 'success',
									  title: 'El registro fue eliminado',
									  showConfirmButton: false,
									  timer: 500
									})
	      				listapermisosasignadosxusuario();
	      			}else{
	      				Swal.fire('Eliminado!','El registro no fue eliminado','error')
	      			}
	        		
	      		}
	    
	    	});



  }
})



	})

	$(document).on("click","#bteliminarusuario",function(){
		var axiduser = $(this).data("iduser");
		Swal.fire({
  title: 'Estas seguro?',
  text: "No podrá revertir esto!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Eliminar!'
}).then((result) => {
  if (result.isConfirmed) {

  	$.ajax({

		url:"usuarios_listado_funciones.php",
		method: "POST",
		data: {param:311,txtid_usuario:axiduser},
			success : function(data){

				if(data==0){
					//Swal.fire('Aviso!','El registro a sido eliminado','success')
					Swal.fire({
							  position: 'center',
							  icon: 'success',
							  title: 'El proceso se registro correctamente',
							  showConfirmButton: false,
							  timer: 500
							})
					listarusuario()
				}else{
					Swal.fire('Aviso!','El registro No se elimino, primero debe eliminar los COMPLEMENTOS','error')
				}

			}
		})

  }
})

	});

	$(document).on("click","#bteditarusuario",function(){

		var axiduser = $(this).data("iduser");

		$.ajax({

			url:"usuarios_listado_funciones.php",
			method: "POST",
			data: {param:62,axiduser:axiduser},
				
				success : function(traerdatosuser){
					var json = JSON.parse(traerdatosuser);
					console.log(json);

		  			if (json.status == 200){

						$("#txtcod_interno").val(json.COD_INTERNO);
						$("#txtidusuario").val(json.ID_USUARIO);
						$("#txtidempresa").val(json.ID_EMPRESA);
						$("#txtdniusuario").val(json.COD_USUARIO);
						$("#txtcargo").val(json.TIPO_USUARIO);
						$("#txtnum_licencia").val(json.NUM_LICENCIA);
						$("#txtnombreusuario").val(json.NOM_USUARIO);						
						$("#txtusuario").val(json.USUARIO);						
						$("#txtusuarioasignar").val(json.NOM_USUARIO);						
						$("#txtclave").val(json.CLAVE);
						$("#txtcorrelativo_pedidos").val(json.CORRELATIVO_VENDEDOR);						
						$("#txtfecharegistro").val(json.F_REGISTRO);
						$("#txtcondicion").val(json.CONDICION);
						$("#txtletra_serie").val(json.N_SERIE_VENDEDOR);
						

						$("#txtpaterno").val(json.PATERNO);
						$("#txtmaterno").val(json.MATERNO);
						$("#txtnombres").val(json.NOMBRES);
						//$("#btn_generar_codigo").style("blo")
						document.getElementById("btn_generar_codigo").disabled = true;
					
			//			listapermisosasignadosxusuario();
				//		listaretapasasignas()

		  			}


				}
		})


	})



	function traeridusuario() {
		
		var axcoduser= $("#txtdniusuario").val();

		$.ajax({

			url:"usuarios_listado_funciones.php",
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
	

	$(document).on("click","#btasignaretapa",function(){

			var axcod_interno = $("#txtcod_interno").val();
			var axidusuario = $("#txtidusuario").val();
			var axfecharegistro = $("#txtfecharegistro").val();
			var axparmetro= $("#txtparametros").val();
			var axidasignacion= $("#txtidasinacion").val();
			var axid_local= $("#txtid_local").val();
			var axetapapy= $("#txtetapapy").val();
	

		$.ajax({

			url:"usuarios_listado_funciones.php",
			method: "POST",
			data: {param:68,
				txtidusuario:axidusuario,
				txtfecharegistro:axfecharegistro,
				txtparametros:axparmetro,
				txtetapapy:axetapapy,
				txtid_local:axid_local,
				txtidasinacion:axidasignacion,
				txtcod_interno:axcod_interno
		
			},
				success : function(asignaretapa){

					if(asignaretapa==0){
     			   		
						listaretapasasignas()
						limpiar_modal()
    
      		} else {
						swal("Aviso", "No se grabo el registro...", "warning");

			    }
				}
		})
		
	})


	function listaretapasasignas() {

		var axidusuario = $("#txtidusuario").val();	
		var axcod_interno = $("#txtcod_interno").val();

		$.ajax({
			url:"usuarios_listado_funciones.php",
			method: "POST",
			data: {param:69,
				txtidusuario:axidusuario,
				txtcod_interno:axcod_interno
				},
			success : function(listadoetapasxusuarios){
				$("#listaetapasasignadas").html(listadoetapasxusuarios);
			}
		})
	}



	$(document).on("click","#txtasignarpermiso",function(){

			var axcod_interno = $("#txtcod_interno").val();
			var axidmenu = $(this).data("idmenu");
			var axidusuario = $("#txtidusuario").val();
			var axfecharegistro = $("#txtfecharegistro").val();
			var axparmetro= $("#txtparametros").val();
			var axidpermiso= $("#txtidpermiso").val();
	

		$.ajax({

			url:"usuarios_listado_funciones.php",
			method: "POST",
			data: {param:65,
				txtidusuario:axidusuario,
				txtfecharegistro:axfecharegistro,
				txtparametros:axparmetro,
				axidmenu:axidmenu,
				txtidpermiso:axidpermiso,
				txtcod_interno:axcod_interno
				
			},
				success : function(data){

					if(data==0){
       			  listapermisosasignadosxusuario();       			   		
      		} else {
      				Swal.fire("Alerta", "El Registro no fue Grabado...", "warning");
			    }

				}
		})

})
	


	function listapermisosasignadosxusuario() {

		var axidusuario = $("#txtidusuario").val();		
		var axcod_interno = $("#txtcod_interno").val();

		$.ajax({
			url:"usuarios_listado_funciones.php",
			method: "POST",
			data: {param:66,txtidusuario:axidusuario,txtcod_interno:axcod_interno},
			success : function(listadomenuxusuarios){
				$("#listarpermisosasignados").html(listadomenuxusuarios);
			}
		})
	}





	$(document).on("click","#bnNuevo",function(){
		document.getElementById("btn_generar_codigo").disabled = false;
		$("#txtidusuario").val("");
		//$("#txtidempresa").val("");
		$("#txtdniusuario").val("");
		$("#txtcargo").val("");
		$("#txtnum_licencia").val("");
		$("#txtnombreusuario").val("");						
		$("#txtusuario").val("");						
		$("#txtusuarioasignar").val("");						
		$("#txtclave").val("");
		$("#txtcorrelativo_pedidos").val("");						
		$("#txtfecharegistro").val("");
		$("#txtcondicion").val("");
		$("#txtletra_serie").val("");
		

		$("#txtpaterno").val("");
		$("#txtmaterno").val("");
		$("#txtnombres").val("");

		$("#txtparametros").val(1);

	})

	$(document).on("click","#bteditarusuario",function(){

		$("#txtparametros").val(2);

	})

	$(document).on("click","#btgrabarusuario",function(){

			 
    if (verificar_campos_vacios()) {        
        return;
    }
		
		var axcod_interno = $("#txtcod_interno").val();
		var axparmetro= $("#txtparametros").val();
		var axidempresa = $("#txtidempresa").val();
		var axdniusuario = $("#txtdniusuario").val();
		var axcargo = $("#txtcargo").val();
		var axnum_licencia = $("#txtnum_licencia").val();
		var axnomusuario = $("#txtnombreusuario").val();
		var axuser = $("#txtusuario").val();
		var axclave = $("#txtclave").val();
		var axcorrelativo_pedidos = $("#txtcorrelativo_pedidos").val();
		var axfecharegistro = $("#txtfecharegistro").val();
		var axidusuario= $("#txtidusuario").val();				
		var axcondicion= $("#txtcondicion").val();
		var axfecharegistro=$("#txtfecharegistro").val();

		var axpaterno = $("#txtpaterno").val();
		var axmaterno = $("#txtmaterno").val();
		var axnombres = $("#txtnombres").val();

		var axletra_serie = $("#txtletra_serie").val();
		
		$.ajax({

			url:"usuarios_listado_funciones.php",
			method: "POST",
			data: {param:63,
				txtcod_interno:axcod_interno,
				txtparametros:axparmetro,
				txtidempresa:axidempresa,
				txtdniusuario:axdniusuario,
				txtcargo:axcargo,
				txtnum_licencia:axnum_licencia,
				txtnombreusuario:axnomusuario,
				txtusuario:axuser,
				txtclave:axclave,
				txtcorrelativo_pedidos:axcorrelativo_pedidos,
				txtfecharegistro:axfecharegistro,
				txtidusuario:axidusuario,
				txtfecharegistro:axfecharegistro,
				txtpaterno:axpaterno,
				txtmaterno:axmaterno,
				txtnombres:axnombres,
				txtcondicion:axcondicion,
				txtletra_serie:axletra_serie
			},
				success : function(grabarusuario){


					if(grabarusuario==0){
         			   	

         		 //$("#listarpermisos").html(grabarusuario);
						$("#divdatos").css({'display':'none'});	
						$("#divpermisos").css({'display':'block'});
						$("#divasignar").css({'display':'none'});

						var elemento1 = document.getElementById("pndatos");
						var elemento2 = document.getElementById("pnpermisos");
						var elemento3 = document.getElementById("pnasignar");
						elemento1.className = "nav-link";
						elemento2.className = "nav-link active";
						elemento3.className = "nav-link";

							listarusuario();
							listarmenu();            			
            	traeridusuario();
            	listapermisosasignadosxusuario()

         			var axnomusuario = $("#txtnombreusuario").val();
         			$("#txtusuarioasignar").val(axnomusuario);

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
		$("#divasignar").css({'display':'none'});

		var elemento1 = document.getElementById("pndatos");
		var elemento2 = document.getElementById("pnpermisos");
		var elemento3 = document.getElementById("pnasignar");
		elemento1.className = "nav-link active";
		elemento2.className = "nav-link";
		elemento3.className = "nav-link";

	})

	$(document).on("click","#pnpermisos",function(){

		$("#divdatos").css({'display':'none'});
		$("#divpermisos").css({'display':'block'});
		$("#divasignar").css({'display':'none'});

		var elemento1 = document.getElementById("pndatos");
		var elemento2 = document.getElementById("pnpermisos");
		var elemento3 = document.getElementById("pnasignar");
		elemento1.className = "nav-link";
		elemento2.className = "nav-link active";
		elemento3.className = "nav-link";


		listarmenu();
		listapermisosasignadosxusuario()
		


	})


	function listarmenu() {
		var axidempresa = $("#txtidempresa").val();
		
		$.ajax({

			url:"usuarios_listado_funciones.php",
			method: "POST",
			data: {param:64,txtidempresa:axidempresa},
				success : function(listadomenu){
				$("#listarpermisos").html(listadomenu);
			}
		})
	}


	$(document).on("click","#pnasignar",function(){

		$("#divdatos").css({'display':'none'});
		$("#divpermisos").css({'display':'none'});
		$("#divasignar").css({'display':'block'});

		var elemento1 = document.getElementById("pndatos");
		var elemento2 = document.getElementById("pnpermisos");
		var elemento3 = document.getElementById("pnasignar");
		elemento1.className = "nav-link";
		elemento2.className = "nav-link";
		elemento3.className = "nav-link active";

		listaretapasasignas()

	})


function verificar_campos_vacios() {
   var elementos = document.querySelectorAll('#divdatos input, #divdatos select');
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



