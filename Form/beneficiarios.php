<?php require_once '../includes/header.php'; 
$tipo = $_GET['id'];

?>


<!DOCTYPE html>
	<html>
	<head>
		    
	</head>
	
	<!--img src="../img/empresa.PNG" style="opacity: 0.2;"-->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<input type="hidden" name="txtparametros" id="txtparametros">
	<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axiduser";?>">
	<input type="hidden" name="txtid_empresa" id="txtid_empresa" value="<?php echo "$axidempresa";?>">
	<input type="hidden" name="txttipo_beneficiario" id="txttipo_beneficiario" value="<?php echo "$tipo";?>">
	<input type="hidden" name="txtid_usuario" id="txtid_usuario" value="<?php echo "$axcoduser";?>">
	
	<body>

	<br>
	<div class="card">
  	<div class="card-header">
	    <h5 id="titulo_formulario"></h5>	
  	</div>

		<!--button type="button" class="btn btn-outline-dark btn-sm"  id="btn_data">data</button-->		    	

  	<div class="card-body">

  		<div class="row g-3">
			<div class="col-md-6">
			<div class="form-floating">
			<input type="text" class="form-control" id="txtbuscar" placeholder="Buscar ">
			<label for="txtbuscar"><b><i class="bi bi-search"></i> Buscar</b></label>
			</div>
			</div>

			<div class="col-md-6" id="divid_vendedor">
				<div class="form-floating">
				<select class="form-select" id="txtid_vendedor" aria-label="Floating label select example">				        
				<option selected>Seleccionar</option>
				<?php while($fila=odbc_fetch_array($RSVendedores)) {?>
				<option value="<?php echo $fila['ID_USUARIO'];?>"><?php echo $fila['NOM_USUARIO'];?></option><?php } ?>
				</select>
				<label for="txtid_vendedor"><b>Vendedor</b></label>
				</div>
			</div>	


		</div>
		<br>
	    <div  id="lista1"></div>			

  	</div>
	</div>
	<!-------------------------------------->
		
	<div class="modal" id="exampleModal">
  	<div class="modal-dialog modal-xl">
    <div class="modal-content">
      			
      	<div class="modal-header">
		    <h5 class="modal-title" id="exampleModalLabel">Registrar Beneficiarios</h5>		    
		    </div>

				<div class="modal-body">	
				
					<div class="row g-3">

						<input type="hidden" class="form-control" id="txtid_beneficiario" >		    	
				    	<input type="hidden" class="form-control" id="txtpaterno" >		    	
				    	<input type="hidden" class="form-control" id="txtmaterno" >		    	
				    	<input type="hidden" class="form-control" id="txtnombre" >		    	
				    	<input type="hidden" class="form-control" id="txturb_emis" value="-" >	
				    	<input type="hidden" class="form-control" id="txtdistrito">			
				    	<input type="hidden" class="form-control" id="txtubigeo_fiscal">				    		    	
				    	<input type="hidden" id="txtubigeo_alternativo">
				    	<input type="hidden" class="form-control" id="txtcod_interno" placeholder="Cód Interno" disabled>
				    	

					
						<div class="col-md-3">
						<div class="form-floating">
						<select class="form-select" id="txtid_doc" aria-label="Floating label select example">				        
						<option selected>Seleccionar</option>
						<?php while($fila=odbc_fetch_array($RSTipo_doc_ident_1)) {?>
				    	<option value="<?php echo $fila['ID_DOC'];?>"><?php echo $fila['ABREV_TD'];?></option><?php } ?>
						</select>
						<label for="txtid_doc"><b>Tipo documento</b></label>
						</div>
						</div>	

						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtruc_benef" placeholder="# Documento">
  							<label for="txtruc_benef"><b># Documento</b></label>
					  	</div>
						</div>

						<div class="col-md-3">
						<div class="form-floating">
						<select class="form-select" id="txtestado_cliente" aria-label="Floating label select example">			        
						<option value="ACTIVO">ACTIVO</option>						
						<option value="INACTIVO">INACTIVO</option>												
						</select>
						<label for="txtestado_cliente"><b>Estado</b></label>
						</div>
						</div>
						
						
					</div>

					<br>
					<div class="row g-3">

						<div class="col-md-6">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtrazon_social_cliente" placeholder="Razón Social">
  							<label for="txtrazon_social_cliente"><b>Razón Social</b></label>
					  	</div>
						</div>

						<div class="col-md-6">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtnombre_comercial" placeholder="Nombre comercial">
  							<label for="txtnombre_comercial"><b>Nombre comercial</b></label>
					  	</div>
						</div>

						<div class="col-md-6">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtdomicilio_fiscal" placeholder="Domicilio Fiscal">
  							<label for="txtdomicilio_fiscal"><b>Domicilio Fiscal</b></label>
					  	</div>
						</div>				


						<div class="col-md-6">
					  	<div class="form-floating">
					    	
					    	<input type="text" class="form-control" id="txtdistrito_buscar" placeholder="Distrito">
  							<label for="txtdistrito_buscar"><b>Distrito Fiscal</b></label>
					  	</div>
					  	<div id="div_distritos"></div>
						</div>

						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtreferencia" placeholder="Referencia">
  							<label for="txtreferencia"><b>Referencia</b></label>
					  	</div>
						</div>

						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txttelefono" placeholder="Telefonos">
  							<label for="txttelefono"><b>Telefonos</b></label>
					  	</div>
						</div>

						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtemail_cliente" placeholder="Email">
  							<label for="txtemail_cliente"><b>Email</b></label>
					  	</div>
						</div>

					</div>
<br>	
							<div class="row g-3" id="div_domic_clientes">
							
							<div class="col-md-5">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtdomicilio_entrega" placeholder="Domicilio Entrega">
  							<label for="txtdomicilio_entrega"><b>Domicilio Entrega</b></label>
					  	</div>
							</div>

						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtdistrito_alter_1" placeholder="Distrito">
  							<label for="txtdistrito_alter_1"><b>Distrito entrega</b></label>
					  	</div>
					  	<div id='div_distritos_alter_1'></div>
						</div>

						<div class="col-md-3">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtreferencia_entrega" placeholder="Referencia">
  							<label for="txtreferencia_entrega"><b>Referencia entrega</b></label>
					  	</div>
					  	<div id='div_distritos_alter_1'></div>
						</div>

					</div>	
								
					<br>	
					<div class="row g-3" id="div_ctas_proveedor">
						
						<div class="col-md-4">
						  	<div class="form-floating">
						    	<input type="text" class="form-control" id="txtcta_pagos" placeholder="Num. Cuentas de pago">
	  							<label for="txtcta_pagos"><b>Num. Cuentas de pago</b></label>
						  	</div>
							</div>
						
						<div class="col-md-4">
						  	<div class="form-floating">
						    	<input type="text" class="form-control" id="txtbanco_pagos" placeholder="Nombre del banco">
	  							<label for="txtbanco_pagos"><b>Nombre del banco</b></label>
						  	</div>
							</div>	

							<div class="col-md-4">
						  	<div class="form-floating">
						    	<input type="text" class="form-control" id="txtcta_detraccion" placeholder="Num. Cuentas detracción">
	  							<label for="txtcta_detraccion"><b>Num. Cuentas detracción</b></label>
						  	</div>
							</div>			
					
						
					</div>
					
					
				</div>
		    <br>
		    <div class="modal-footer">
		    		<button type="button" class="btn btn-outline-dark btn-sm"  id="btn_sunat_buscar">Sunat</button>		    	
		    		<button type="button" class="btn btn-outline-dark btn-sm"  id="btn_reniec_buscar">Reniec</button>		    	
		    		<button type="button" class="btn btn-outline-success btn-sm"  id="btn_grabar_beneficiario" data-bs-dismiss="modal"><i class="fas fa-save"></i> Grabar</button>
					<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal" id="btn_cerrar_modal"><i class="fas fa-door-closed" ></i> Cerrar</button>	
		    </div>

    		</div>
  			</div>
		</div>

<!--------------------------------------------->

<div class="modal" id="exampleModal_1">
  	<div class="modal-dialog modal-xl">
    <div class="modal-content">
      			
    <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel"> Direcciones  <button type="button" id="btn_nueva_direccion"  class="btn btn-outline-danger btn-sm" ><i class="fa-solid fa-circle-plus"></i> Nuevo</button></h5>	
		<h5 id="nom_beneficiario"></h5>	    
		</div>
		
		<input type="hidden" class="form-control" id="txtid_direccion">
		<!--input type="text" class="form-control" id="cod_ubi_llegada"-->	
		<div class="modal-body">	
		
			<div class="row g-3" id='div_from_categorias' hidden>
				<div class="col-md-3">
			  	<div class="form-floating">
		    	<input type="text" class="form-control" id="txtcod_interno_traer" placeholder="Cód Interno" disabled>
  				<label for="txtcod_interno_traer"><b>Cód Interno</b></label>
			  	</div>
				</div>

				<div class="col-md-9">
				<div class="form-floating">
				<input type="text" class="form-control" id="txtdireccion_alter" placeholder="Dirección Alternativa">
  				<label for="txtdireccion_alter"><b>Dirección Alternativa</b></label>
				</div>
				</div>

					<div class="col-md-3">
				<div class="form-floating">
				<input type="text" class="form-control" id="cod_ubi_llegada" placeholder="Cod. Ubigeo" disabled>
  				<label for="cod_ubi_llegada"><b>Cod. Ubigeo</b></label>
				</div>
				</div>

				<div class="col-md-5">
				<div class="form-floating">

				<input type="text" class="form-control" id="txtdistrito_alter" placeholder="Dirección Alternativa">
  				<label for="txtdistrito_alter"><b>Distrito</b></label>
				</div>
				<div id='div_ubigeos'></div>
				</div>

				<div class="col-md-4">
				<div class="form-floating">
				<input type="text" class="form-control" id="txtreferencia_1" placeholder="Referencia">
  				<label for="txtreferencia_1"><b>Referencia</b></label>
				</div>
				</div>

				
				
				<div class="modal-footer">    		
				<button type="button" class="btn btn-outline-success btn-sm"   id="btn_grabar_direccion_alter"><i class="fas fa-save"></i> Grabar</button>
				<button type="button" class="btn btn-outline-danger btn-sm" id="btn_cerrar_modal_direccion_alter"><i class="fas fa-door-closed" ></i> Cancelar</button>	
				</div>
			</div>

		
			<br>
	    	<div id="lista_direcciones_alter"></div>	

		</div>
			
	    <div class="modal-footer" id="div_pie_direccion">    		
			<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal" id="btn_cerrar_modal_categoria"><i class="fas fa-door-closed" ></i> Cerrar</button>	
	    </div>
	</div>
	</div>
	</div>



<!--------------------------------------------->

</body>
</html>	

<script type="text/javascript">

$(document).ready(function() {	
	
	Verifica_permiso()
	listar_beneficiarios();

 	var axtipo_beneficiario = $("#txttipo_beneficiario").val();

 	if(axtipo_beneficiario=='CLIENTE'){

 		$("#divid_vendedor").prop('hidden',false);
 		$("#div_ctas_proveedor").prop('hidden',true);

 		$("#div_domic_clientes").prop('hidden',false)
		
 		

 	}else{

 		$("#divid_vendedor").prop('hidden',true);
 		$("#div_ctas_proveedor").prop('hidden',false);
 		
 		$("#div_domic_clientes").prop('hidden',true)
		

 	}
		
});
/****************************/

$(document).on("click","#btn_lista_ubi_1",function(){

//var axdistrito_buscar = $(this).text()
var axdistrito = $(this).data('distrito')
var axubigeo_alter = $(this).data('id')

//alert(axdistrito)

$("#txtubigeo_alternativo").val(axubigeo_alter)
$("#txtdistrito_alter_1").val(axdistrito)
$("#div_distritos_alter_1").fadeOut();

})



$('#txtdistrito_alter_1').keyup(function(){

	  var axbuscar_dato = $("#txtdistrito_alter_1").val();
	  
	  
	  if (axbuscar_dato != '') {

	    $.ajax({
	      url:"beneficiarios_funciones.php",
	      method: "POST",
	      data: {param:141,txtdistrito_alter_1:axbuscar_dato},

	      success : function(data){

	      	$('#div_distritos_alter_1').fadeIn();
	        $('#div_distritos_alter_1').html(data);
	      }
	    });

	  }else{
	  	$("#div_distritos_alter_1").fadeOut();
	  } 
	});



$(document).on("click","#btn_lista_grupo",function(){

var axdato = $(this).text()


//alert(axdistrito)

$("#txtgrupo").val(axdato)
$("#div_grupos").fadeOut();

})


$('#txtgrupo').keyup(function(){

	  var axbuscar_dato = $("#txtgrupo").val();
	  
	  
	  if (axbuscar_dato != '') {

	    $.ajax({
	      url:"beneficiarios_funciones.php",
	      method: "POST",
	      data: {param:108,txtgrupo:axbuscar_dato},

	      success : function(data){

	      	$('#div_grupos').fadeIn();
	        $('#div_grupos').html(data);
	      }
	    });

	  }else{
	  	$("#div_grupos").fadeOut();
	  } 
	});



$(document).on("click","#btn_lista_ubi",function(){

var axdistrito_buscar = $(this).text()
var axdistrito = $(this).data('distrito')
var axubigeo_fiscal = $(this).data('id')
//alert(axubigeo_fiscal)

//alert(axdistrito)

$("#txtdistrito").val(axdistrito)
$("#txtdistrito_buscar").val(axdistrito_buscar)
$("#txtubigeo_fiscal").val(axubigeo_fiscal)
$("#div_distritos").fadeOut();

})





$('#txtdistrito_buscar').keyup(function(){

	  var axbuscar_dato = $("#txtdistrito_buscar").val();
	  
	  
	  if (axbuscar_dato != '') {

	    $.ajax({
	      url:"beneficiarios_funciones.php",
	      method: "POST",
	      data: {param:107,txtdistrito_buscar:axbuscar_dato},

	      success : function(data){

	      	$('#div_distritos').fadeIn();
	        $('#div_distritos').html(data);
	      }
	    });

	  }else{
	  	$("#div_distritos").fadeOut();
	  } 
	});


$(document).on("click","#btn_lista_ubigeos",function(){

var axcod_ubigeo = $(this).data('id')
var axdistrito_alter = $(this).text()
//alert(axcod_ubigeo)

$("#txtdistrito_alter").val(axdistrito_alter)
$("#cod_ubi_llegada").val(axcod_ubigeo)

$("#div_ubigeos").fadeOut();

})




$('#txtdistrito_alter').keyup(function(){

	  var axbuscar_dato = $("#txtdistrito_alter").val();
	  
	  
	  if (axbuscar_dato != '') {

	    $.ajax({
	      url:"beneficiarios_funciones.php",
	      method: "POST",
	      data: {param:90,txtdistrito_alter:axbuscar_dato},

	      success : function(data){

	      	$('#div_ubigeos').fadeIn();
	        $('#div_ubigeos').html(data);
	      }
	    });

	  }else{
	  	$("#div_ubigeos").fadeOut();
	  } 
	});


$(document).on("change","#txtid_vendedor",function(){

listar_beneficiarios();

})

$(document).on("click","#btn_data",function(){

	$.ajax({

		url:"beneficiarios_funciones.php",
		method: "POST",
		data: {param:71,},
			success : function(data){
				

			}
		})


})


$(document).on("keyup","#txtbuscar",function(){
	listar_beneficiarios();
})


$(document).on("click","#bnNuevo",function(){
	$("#txtparametros").val(1);
	var axid_empresa = $("#txtid_empresa").val()	
	var axcodusuario= $("#txtcodusuario").val()
	var axid_vendedor= $("#txtid_vendedor").val()	

	var axtipo_beneficiario = $("#txttipo_beneficiario").val()

	if(axtipo_beneficiario=='CLIENTE'){

			if(axid_vendedor=='' || axid_vendedor=='Seleccionar'){
				Swal.fire('Aviso','Falta Seleccionar Vendedor','warning')			
				$("#exampleModal").modal("hide");		
			}else{
				$.ajax({
					url:"beneficiarios_funciones.php",
					method: "POST",
					data: {param:139,txtid_empresa:axid_empresa,txtcodusuario:axcodusuario},
						success : function(data){
							
							$("#txtdomicilio_entrega").prop('disabled',false)
							$("#txtdistrito_alter_1").prop('disabled',false)
							$("#txtreferencia_entrega").prop('disabled',false)				

							$("#txtcod_interno").val(data)
						}
					})
			}


	}else{

		$.ajax({
					url:"beneficiarios_funciones.php",
					method: "POST",
					data: {param:139,txtid_empresa:axid_empresa,txtcodusuario:axcodusuario},
						success : function(data){
							
							$("#txtdomicilio_entrega").prop('disabled',false)
							$("#txtdistrito_alter_1").prop('disabled',false)
							$("#txtreferencia_entrega").prop('disabled',false)				

							$("#txtcod_interno").val(data)
						}
					})

	}


			

	

})


/************************************/

$(document).on("click","#btn_predeterminada_direc",function(){

var axdireccion_alter_1 = $(this).data("dir_alter");
$("#txtdomicilio_entrega").val(axdireccion_alter_1)

var axid_direccion_1 = $(this).data("id");
$("#txtid_direccion").val(axid_direccion_1)


var axid_direccion = $("#txtid_direccion").val()
var axdireccion_alter = $("#txtdomicilio_entrega").val()
var axid_beneficiario =$("#txtid_beneficiario").val()
var axcod_ubi_llegada =$("#cod_ubi_llegada").val()

Swal.fire({
  title: 'Estas seguro?',
  text: "Se asignar esta direccion de entrega como PREDETERMINADA!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Asignar!'
}).then((result) => {
  if (result.isConfirmed) {
	  	$.ajax({

			url:"beneficiarios_funciones.php",
			method: "POST",
			data: {param:24,
					txtdomicilio_entrega:axdireccion_alter,
					txtid_beneficiario:axid_beneficiario,
					txtid_direccion:axid_direccion,
					cod_ubi_llegada:axcod_ubi_llegada
			},
				success : function(data){

					if(data==0){
						//Swal.fire('Aviso!','El registro a sido asignado','success')

						Swal.fire({
							  position: 'center',
							  icon: 'success',
							  title: 'El proceso se registro correctamente',
							  showConfirmButton: false,
							  timer: 1500
							})

						listar_beneficiarios();
					}else{
						Swal.fire('Aviso!','El registro No se asigno','error')
					}

				}
			})

	  }
	})


})



$(document).on("click","#btn_editar_beneficiarios_alter",function(){

var axid_direccion_1 = $(this).data("id");
$("#txtid_direccion").val(axid_direccion_1)
var axid_direccion = $("#txtid_direccion").val()

$.ajax({
	url:"beneficiarios_funciones.php",
	method: "POST",
	data: {param:100,txtid_direccion:axid_direccion},
	success : function(data){		
		
		var json = JSON.parse(data);

		$("#div_from_categorias").prop('hidden',false);
		$("#div_pie_direccion").prop('hidden',true);
		$("#btn_nueva_direccion").prop('hidden',true);
		$("#lista_direcciones_alter").prop('hidden',true);
		$("#txtparametros").val(2);

		$("#txtid_direccion").val(json.ID_DIRECCION)
		$("#txtcod_interno").val(json.COD_INTERNO)
		$("#txtdireccion_alter").val(json.DIRECCION_ALTER)
		$("#txtdistrito_alter").val(json.DISTRITO_ALTER)
		$("#txtreferencia_1").val(json.REFERENCIA_1)
		$("#cod_ubi_llegada").val(json.cod_ubi_llegada)


							
	}

	})

})

$(document).on("click","#btn_eliminar_beneficiarios_alter",function(){

var axid_direccion_1 = $(this).data("id");
$("#txtid_direccion").val(axid_direccion_1)
var axid_direccion = $("#txtid_direccion").val()

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

		url:"beneficiarios_funciones.php",
		method: "POST",
		data: {param:23,txtid_direccion:axid_direccion},
			success : function(data){

				if(data==0){
					//Swal.fire('Aviso!','El registro a sido eliminado','success')
					Swal.fire({
							  position: 'center',
							  icon: 'success',
							  title: 'El proceso se registro correctamente',
							  showConfirmButton: false,
							  timer: 1500
							})
					listar_direcciones_alter_asignadas()
				}else{
					Swal.fire('Aviso!','El registro No se elimino','error')
				}

			}
		})

  }
})


})

$(document).on("click","#btn_grabar_direccion_alter",function(){

	var axid_direccion = $("#txtid_direccion").val();
	var axcod_interno_traer = $("#txtcod_interno_traer").val();
	var axdireccion_alter = $("#txtdireccion_alter").val();
	var axdistrito_alter = $("#txtdistrito_alter").val();
	var axreferencia_1 = $("#txtreferencia_1").val();
	var axcod_ubi_llegada = $("#cod_ubi_llegada").val();
	var axparametros= $("#txtparametros").val();
	

	$.ajax({

		url:"beneficiarios_funciones.php",
		method: "POST",
		data: {param:22,
			txtid_direccion :axid_direccion,
			txtcod_interno_traer :axcod_interno_traer,
			txtdireccion_alter :axdireccion_alter,
			txtdistrito_alter :axdistrito_alter,
			txtreferencia_1 :axreferencia_1,
			cod_ubi_llegada:axcod_ubi_llegada,
			txtparametros:axparametros
		},
			success : function(data){
				
				if(data==0){
	           		listar_direcciones_alter_asignadas()
	           		Swal.fire('Aviso','El Registro de Grabo correctamente...','success')

	           		$("#div_from_categorias").prop('hidden',true);
					$("#div_pie_direccion").prop('hidden',false);
					$("#btn_nueva_direccion").prop('hidden',false);
					$("#lista_direcciones_alter").prop('hidden',false);


					$("#txtid_direccion").val('')
					$("#txtcod_interno").val('')
					$("#txtdireccion_alter").val('')
					$("#txtdistrito_alter").val('')
					$("#txtreferencia_1").val('')


		      	} else {
			
					Swal.fire('Aviso','No se grabo el registro...1','error')

				}
			}
		})	
})




function listar_direcciones_alter_asignadas() {

var axcod_interno_traer = $("#txtcod_interno_traer").val()
var axid_beneficiario = $("#txtid_beneficiario").val()

	$.ajax({

		url:"beneficiarios_funciones.php",
		method: "POST",
		data: {param:21,txtcod_interno_traer:axcod_interno_traer,txtid_beneficiario:axid_beneficiario},
			success : function(data){

				$("#lista_direcciones_alter").html(data)

			}
		})	

}

$(document).on("click","#btn_beneficiarios_dir",function(){

var axcod_interno_traer_1 = $(this).data("id");
var axnom_beneficiario = $(this).data('nomb_benef')
var axid_beneficiario = $(this).data('idb')

//alert(axid_beneficiario)

$("#txtid_beneficiario").val(axid_beneficiario)
$("#txtcod_interno_traer").val(axcod_interno_traer_1)
$("#nom_beneficiario").html(axnom_beneficiario)

var axcod_interno_traer = $("#txtcod_interno_traer").val()
listar_direcciones_alter_asignadas()

})





$(document).on("click","#btn_cerrar_modal_direccion_alter",function(){

$("#div_from_categorias").prop('hidden',true);
$("#div_pie_direccion").prop('hidden',false);
$("#btn_nueva_direccion").prop('hidden',false);
$("#lista_direcciones_alter").prop('hidden',false);


$("#txtid_direccion").val('')
$("#txtcod_interno").val('')
$("#txtdireccion_alter").val('')
$("#txtdistrito_alter").val('')
$("#txtreferencia_1").val('')


})

$(document).on("click","#btn_nueva_direccion",function(){

$("#div_from_categorias").prop('hidden',false);
$("#div_pie_direccion").prop('hidden',true);
$("#btn_nueva_direccion").prop('hidden',true);
$("#lista_direcciones_alter").prop('hidden',true);
$("#txtparametros").val(1);

$("#txtid_direccion").val('')
$("#txtcod_interno").val('')
$("#txtdireccion_alter").val('')
$("#txtdistrito_alter").val('')
$("#txtreferencia_1").val('')


})

$(document).on("click","#btn_eliminar_beneficiarios",function(){

var axid_beneficiario_1 = $(this).data("id");
$("#txtid_beneficiario").val(axid_beneficiario_1)

var axid_beneficiario = $("#txtid_beneficiario").val()

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

		url:"beneficiarios_funciones.php",
		method: "POST",
		data: {param:20,txtid_beneficiario:axid_beneficiario},
			success : function(data){

				if(data==0){
					//Swal.fire('Aviso!','El registro a sido eliminado','success')
					Swal.fire({
							  position: 'center',
							  icon: 'success',
							  title: 'El proceso se registro correctamente',
							  showConfirmButton: false,
							  timer: 1500
							})
					listar_beneficiarios();
				}else{
					Swal.fire('Aviso!','El registro No se elimino, primero debe eliminar los COMPLEMENTOS','error')
				}

			}
		})

  }
})


})




$(document).on("click","#btn_sunat_buscar",function(){

var  axruc = $("#txtruc_benef").val();

$.ajax({
	url:"beneficiarios_funciones.php",
	method: "POST",
	data: {param:4,txtruc_benef:axruc},
	success : function(data){		
		
		var json = JSON.parse(data);

		$("#txtnombre_comercial").val(json.nombre);	
		$("#txtrazon_social_cliente").val(json.nombre);	
		$("#txtdomicilio_fiscal").val(json.direccion);
		$("#txtid_doc").val(json.tipoDocumento);	

	}

	})

})


function listar_beneficiarios(){

	var axbuscaregistro = $("#txtbuscar").val();	
	var axtipo_beneficiario = $("#txttipo_beneficiario").val();	
	var txtid_empresa = $("#txtid_empresa").val();	
	var axid_vendedor = $("#txtid_vendedor").val();	


		$.ajax({

			url:"beneficiarios_funciones.php",
			method: "POST",
			data: {param:15,txtbuscar:axbuscaregistro,txtid_empresa:txtid_empresa,txttipo_beneficiario:axtipo_beneficiario,txtid_vendedor:axid_vendedor},
				
				success : function(data){

					$("#lista1").html(data);
			}
		})
	}

$(document).on("click","#btn_editar_beneficiarios",function(){

var axid_beneficiario_1 = $(this).data("id");
$("#txtid_beneficiario").val(axid_beneficiario_1)

var axid_beneficiario = $("#txtid_beneficiario").val()

$("#txtparametros").val(2);

$.ajax({

	url:"beneficiarios_funciones.php",
	method: "POST",
	data: {param:18,txtid_beneficiario:axid_beneficiario},	
	success : function(data){
		var json = JSON.parse(data);
		  	if (json.status == 200){

		  			//$("#txtdomicilio_entrega").prop('disabled',true)
					//$("#txtdistrito_alter_1").prop('disabled',true)
					//$("#txtreferencia_entrega").prop('disabled',true)
					console.log(json);
					$("#txtid_empresa").val(json.ID_EMPRESA);
					$("#txtid_beneficiario").val(json.ID_BENEFICIARIO);
					$("#txttipo_beneficiario").val(json.TIPO_PROV_CLIE);
					$("#txtid_doc").val(json.ID_DOC);
					$("#txtruc_benef").val(json.RUC_BENEF);
					$("#txtcod_interno").val(json.COD_INTERNO);
					$("#txtnombre_comercial").val(json.NOM_COMERCIAL);
					$("#txtrazon_social_cliente").val(json.RAZON_SOCIAL);
					$("#txtpaterno").val(json.PATERNO);
					$("#txtmaterno").val(json.MATERNO);
					$("#txtnombre").val(json.NOMBRES);
					$("#txtdomicilio_fiscal").val(json.DIRECCION_FISCAL);
					$("#txtdomicilio_entrega").val(json.DIRECCION_ENTREGA);
					console.log(json.DISTRITO_ENTREGA);
					
					$("#txtdistrito_alter_1").val(json.DISTRITO_ENTREGA);
					//$("#txtdistrito_alter_1").val("SDSASSSSSSS");
					$("#txtreferencia_entrega").val(json.REFERENCIA_ENTREGA);
					
					$("#txturb_emis").val(json.TXT_URB_EMIS);
					$("#txtdistrito").val(json.DISTRITO);
					$("#txtreferencia").val(json.REFERENCIA);
					$("#txttelefono").val(json.TELEFONO);
					$("#txtemail_cliente").val(json.EMAIL_PROVEEDOR);
					$("#txtgrupo").val(json.GRUPO);
					$("#txthorario_atencion").val(json.HORARIO_ATENCION);
					$("#txtdivision").val(json.DIVISION);
					$("#txtestado_cliente").val(json.ESTADO)
					$("#txtestado_revision").val(json.ESTADO_REVISION)		
					$("#txtmonto_cuota").val(json.MONTO_CUOTA)		
					$("#txtid_vendedor").val(json.ID_VENDEDOR)	
					$("#txtid_usuario_2").val(json.ID_USUARIO)	
					
					
					$("#txtdistrito_buscar").val(json.DISTRITO)					
					$("#txtubigeo_alternativo").val(json.cod_ubi_llegada);	
					//$("#txtdistrito_alter_1").val(json.DISTRITO_ALTER)
					//$("#txtreferencia_entrega").val(json.REFERENCIA_1)

					$("#txtcta_pagos").val(json.CUENTA_PAGOS)	
					$("#txtbanco_pagos").val(json.BANCO_PAGOS)	
					$("#txtcta_detraccion").val(json.CUENTA_DETRACCION)	
					
						

			}

	}
})

})

	$(document).on("click","#btn_grabar_beneficiario",function(){

	var axid_beneficiario =$("#txtid_beneficiario").val();
	var axtipo_beneficiario =$("#txttipo_beneficiario").val();
	var axid_doc =$("#txtid_doc").val();
	var axruc_benef =$("#txtruc_benef").val();
	var axcod_interno =$("#txtcod_interno").val();
	var axnombre_comercial =$("#txtnombre_comercial").val();
	var axrazon_social_cliente =$("#txtrazon_social_cliente").val();
	var axpaterno =$("#txtpaterno").val();
	var axmaterno =$("#txtmaterno").val();
	var axnombre =$("#txtnombre").val();
	var axdomicilio_fiscal =$("#txtdomicilio_fiscal").val();
	
	var axurb_emis =$("#txturb_emis").val();
	var axdistrito =$("#txtdistrito").val();
	var axubigeo_fiscal = $("#txtubigeo_fiscal").val()
	var axreferencia =$("#txtreferencia").val();
	var axtelefono =$("#txttelefono").val();
	var axemail_cliente =$("#txtemail_cliente").val();
	var axid_empresa = $("#txtid_empresa").val();
	var axparamentro = $("#txtparametros").val();
	var axestado_cliente = $("#txtestado_cliente").val()		

	var axid_usuario_2=$("#txtid_usuario_2").val()
	var axid_usuario = $("#txtid_usuario").val()		
	
	var axdomicilio_entrega =$("#txtdomicilio_entrega").val();
	var axubigeo_alternativo =$("#txtubigeo_alternativo").val();	
	var axdistrito_alter_1 =$("#txtdistrito_alter_1").val();
	var axreferencia_entrega =$("#txtreferencia_entrega").val();
	
	var axid_empresa = $("#txtid_empresa").val()	
	var axid_usuario = $("#txtid_usuario").val()

	var axid_vendedor = $("#txtid_vendedor").val()	


	var axcta_pagos = $("#txtcta_pagos").val()	
	var axbanco_pagos = $("#txtbanco_pagos").val()	
	var axcta_detraccion = $("#txtcta_detraccion").val()	
	
	if(axtipo_beneficiario=='CLIENTE'){

		if(axdomicilio_entrega=='' || axdistrito_alter_1 == '' ){
			
			$("#txtdomicilio_entrega").val(axdomicilio_fiscal);
			$("#txtubigeo_alternativo").val(axubigeo_fiscal);	
			$("#txtdistrito_alter_1").val(axdistrito);
			$("#txtreferencia_entrega").val(axreferencia);

			var axdomicilio_entrega =$("#txtdomicilio_entrega").val();
			var axubigeo_alternativo =$("#txtubigeo_alternativo").val();	
			var axdistrito_alter_1 =$("#txtdistrito_alter_1").val();
			var axreferencia_entrega =$("#txtreferencia_entrega").val();		
			
		
		}


			$.ajax({

				url:"beneficiarios_funciones.php",
				method: "POST",
				data: {param:17,
					
				txtid_empresa:axid_empresa,	
				txtid_beneficiario:axid_beneficiario,
				txttipo_beneficiario:axtipo_beneficiario,
				txtid_doc:axid_doc,
				txtruc_benef:axruc_benef,
				txtcod_interno:axcod_interno,
				txtnombre_comercial:axnombre_comercial,
				txtrazon_social_cliente:axrazon_social_cliente,
				txtpaterno:axpaterno,
				txtmaterno:axmaterno,
				txtnombre:axnombre,
				txtdomicilio_fiscal:axdomicilio_fiscal,
				
				txturb_emis:axurb_emis,
				txtdistrito:axdistrito,
				txtreferencia:axreferencia,
				txttelefono:axtelefono,
				txtemail_cliente:axemail_cliente,
				txtestado_cliente:axestado_cliente,
				txtid_empresa:axid_empresa,				
				txtparametros:axparamentro,
				txtid_usuario:axid_usuario,				
				txtid_usuario_2:axid_usuario_2,

				txtdomicilio_entrega:axdomicilio_entrega,
				txtubigeo_alternativo:axubigeo_alternativo,
				txtdistrito_alter_1:axdistrito_alter_1,
				txtid_usuario:axid_usuario,
				txtreferencia_entrega:axreferencia_entrega,
				txtid_vendedor:axid_vendedor,

				txtcta_pagos:axcta_pagos,
				txtbanco_pagos:axbanco_pagos,
				txtcta_detraccion:axcta_detraccion

				},
				
				success : function(grabrempresa){
					console.log("el registro es:"+grabrempresa);
					//ax=grabrempresa.toString();
					//console.log(ax);
					
					console.log("este es el primer caracter:"+grabrempresa.substr(0,1));
					console.log("este es el segundo caracter:"+grabrempresa.substr(1,1));
					//console.log("este es el segundo caracter:".grabrempresa.substring(1,1));
					if(grabrempresa.substr(0,1)=='0'){
			           	limpiar_modal()		
						listar_beneficiarios();
						Swal.fire('Aviso','El Registro de Grabo correctamente...','success')

			      	} else {
						if(grabrempresa.substr(1,1)=='1'){
							Swal.fire('Aviso','No eligió al vendedor','error');
							}
						else{
							Swal.fire('Aviso','No se grabo el regsitro...2','error');
						}

					}
				}
			})




}else if(axtipo_beneficiario=='PROVEEDOR'){

	$.ajax({

				url:"beneficiarios_funciones.php",
				method: "POST",
				data: {param:17,
					
				txtid_empresa:axid_empresa,	
				txtid_beneficiario:axid_beneficiario,
				txttipo_beneficiario:axtipo_beneficiario,
				txtid_doc:axid_doc,
				txtruc_benef:axruc_benef,
				txtcod_interno:axcod_interno,
				txtnombre_comercial:axnombre_comercial,
				txtrazon_social_cliente:axrazon_social_cliente,
				txtpaterno:axpaterno,
				txtmaterno:axmaterno,
				txtnombre:axnombre,
				txtdomicilio_fiscal:axdomicilio_fiscal,
				
				txturb_emis:axurb_emis,
				txtdistrito:axdistrito,
				txtreferencia:axreferencia,
				txttelefono:axtelefono,
				txtemail_cliente:axemail_cliente,
				txtestado_cliente:axestado_cliente,
				txtid_empresa:axid_empresa,				
				txtparametros:axparamentro,
				txtid_usuario:axid_usuario,				
				txtid_usuario_2:axid_usuario_2,

				txtdomicilio_entrega:axdomicilio_entrega,
				txtubigeo_alternativo:axubigeo_alternativo,
				txtdistrito_alter_1:axdistrito_alter_1,
				txtid_usuario:axid_usuario,
				txtreferencia_entrega:axreferencia_entrega,
				txtid_vendedor:axid_vendedor,

				txtcta_pagos:axcta_pagos,
				txtbanco_pagos:axbanco_pagos,
				txtcta_detraccion:axcta_detraccion

				},
				
				success : function(grabrempresa){
					console.log("el registro es:"+grabrempresa);


					if(grabrempresa.substr(0,1)=='0'){
			           	limpiar_modal()		
						listar_beneficiarios();
						Swal.fire('Aviso','El Registro de Grabo correctamente...','success')

			      	} else {
						if(grabrempresa.substr(1,1)=='1'){
							Swal.fire('Aviso','No eligió al vendedor','error');
							}
						else{
							Swal.fire('Aviso','No se grabo el regsitro...2','error');
						}

					}


				}
			})



}

	

})




function Verifica_permiso(){

var axiduser =$("#txtcodusuario").val();
var axtipo_beneficiario =$("#txttipo_beneficiario").val();

//alert(axtipo_beneficiario)

if(axtipo_beneficiario=='CLIENTE'){
	
	var axpermiso ="CLIENTE";
	$("#titulo_formulario").html("<i class='bi bi-person-vcard-fill'></i> Clientes <button type='button' id='bnNuevo'  class='btn btn-outline-danger btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fa-solid fa-circle-plus'></i> Nuevo</button>")
	
}else{
	var axpermiso ="PROVEEDOR";	
	$("#titulo_formulario").html("<i class='bi bi-person-square'></i> Proveedores <button type='button' id='bnNuevo'  class='btn btn-outline-danger btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fa-solid fa-circle-plus'></i> Nuevo</button>")
}

$.ajax({
	url:"beneficiarios_funciones.php",
	method: "POST",
	data: {param:0,txtcodusuario:axiduser,axpermiso:axpermiso},
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
		

		} 
	}
	})

}

function limpiar_modal() {

	$("#txtid_beneficiario").val('');	
	$("#txtid_doc").val('');
	$("#txtruc_benef").val('');
	$("#txtcod_interno").val('');
	$("#txtnombre_comercial").val('');
	$("#txtrazon_social_cliente").val('');
	$("#txtpaterno").val('');
	$("#txtmaterno").val('');
	$("#txtnombre").val('');
	$("#txtdomicilio_fiscal").val('');
	$("#txtdomicilio_entrega").val('');
	$("#txturb_emis").val('');
	$("#txtdistrito").val('');
	$("#txtreferencia").val('');
	$("#txttelefono").val('');
	$("#txtemail_cliente").val('');
	$("#txtgrupo").val('');
	$("#txthorario_atencion").val('');
	$("#txtdivision").val('');
	$("#txtestado_cliente").val('');
	$("#txtdistrito_buscar").val('');

	$("#txtcta_pagos").val('');
	$("#txtbanco_pagos").val('');
	$("#txtcta_detraccion").val('');

	
	
}

$(document).on("click","#btn_cerrar_modal",function(){
limpiar_modal()

})



$(document).on("click","#btn_reniec_buscar",function(){

var  axruc = $("#txtruc_benef").val();

$.ajax({
	url:"beneficiarios_funciones.php",
	method: "POST",
	data: {param:19,txtruc_benef:axruc},
	success : function(data){				
		var json = JSON.parse(data);
			
			$("#txtpaterno").val(json.apellidoPaterno);
			$("#txtmaterno").val(json.apellidoMaterno);
			$("#txtnombre").val(json.nombres);
			$("#txtnombre_comercial").val(json.nombre);
			$("#txtrazon_social_cliente").val(json.nombre);					
			$("#txtid_doc").val(json.tipoDocumento);	

								
	}

	})

})









</script>
