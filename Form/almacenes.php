<?php require_once '../includes/header.php'; ?>


<!DOCTYPE html>
	<html>
	<head>
		    
	</head>
	
	<!--img src="../img/empresa.PNG" style="opacity: 0.2;"-->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<input type="hidden" name="txtparametros" id="txtparametros">
	<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axiduser";?>">
	<input type="hidden" name="txtid_empresa" id="txtid_empresa" value="<?php echo "$axidempresa";?>">
	
	

	<body>

	<br>
	<div class="card">
  	<div class="card-header">
	    <h5><i class="bi bi-buildings-fill"></i> Empresas <button type="button" id="bnNuevo"  class="btn btn-outline-danger btn-sm" data-bs-toggle='modal' data-bs-target='#exampleModal'><i class="fa-solid fa-circle-plus"></i> Nuevo</button></h5>	
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
	</div>
	<!-------------------------------------->
		
	<div class="modal" id="exampleModal">
  	<div class="modal-dialog modal-xl">
    <div class="modal-content">
      			
      	<div class="modal-header">
		    <h5 class="modal-title" id="exampleModalLabel">Registrar Almacen</h5>		    
		    </div>

				<div class="modal-body">	

					<input type="hidden" class="form-control" id="txtid_local">	

					
				
					<div class="row g-3">
						<div class="col-md-3">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtruc_benef" placeholder="Num. Ruc">
  							<label for="txtruc_benef"><b>Num. Ruc</b></label>
					  	</div>
						</div>
					</div>
					<br>
					<div class="row g-3">

						<div class="col-md-5">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtrazonsocial" placeholder="Razón Social">
  							<label for="txtrazonsocial"><b>Razón Social</b></label>
					  	</div>
						</div>

						<div class="col-md-7">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtdireccion" placeholder="Domicilio fiscal">
  							<label for="txtdireccion"><b>Domicilio fiscal</b></label>
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
					    	<input type="text" class="form-control" id="txtrepresentante" placeholder="Contacto">
  							<label for="txtrepresentante"><b>Contacto</b></label>
					  	</div>
						</div>	


						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txttipo_negocio" placeholder="Tipo negocio">
  							<label for="txttipo_negocio"><b>Tipo negocio</b></label>
					  	</div>
						</div>					

						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtemail_cliente" placeholder="Correo electronico">
  							<label for="txtemail_cliente"><b>Correo electronico</b></label>
					  	</div>
						</div>

						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtclave_correo" placeholder="Correo electronico">
  							<label for="txtclave_correo"><b>Clave electronico</b></label>
					  	</div>
						</div>

						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtruta_json" placeholder="Ruta Json">
  							<label for="txtruta_json"><b>Ruta Json</b></label>
					  	</div>
						</div>

						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txturl_produccion" placeholder="Url producción">
  							<label for="txturl_produccion"><b>Url producción</b></label>
					  	</div>
						</div>

						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txturl_pruebas" placeholder="Url pruebas">
  							<label for="txturl_pruebas"><b>Url pruebas</b></label>
					  	</div>
						</div>

						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txttoken_empresa" placeholder="Clave Token">
  							<label for="txttoken_empresa"><b>Clave Token</b></label>
					  	</div>
						</div>
						

						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtcod_cliente_emis" placeholder="Cod. ITC">
  							<label for="txtcod_cliente_emis"><b>Cod. ITC</b></label>
					  	</div>
						</div>
						
						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtcod_ubi_emis" placeholder="Cod. UBIGEO">
  							<label for="txtcod_ubi_emis"><b>Cod. UBIGEO</b></label>
					  	</div>
						</div>

						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtprov_emis" placeholder="Provincia">
  							<label for="txtprov_emis"><b>Provincia</b></label>
					  	</div>
						</div>

						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtdpto_emis" placeholder="Departamento">
  							<label for="txtdpto_emis"><b>Departamento</b></label>
					  	</div>
						</div>

						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtdistr_emis" placeholder="Distrito">
  							<label for="txtdistr_emis"><b>Distrito</b></label>
					  	</div>
						</div>

						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtcod_operacion" placeholder="Cod. Operación">
  							<label for="txtcod_operacion"><b>Cod. Operación</b></label>
					  	</div>
						</div>



						
					</div>
					<br>
					
				</div>
		    
		    <div class="modal-footer">
		    		<button type="button" class="btn btn-outline-dark btn-sm"  id="btn_sunat_buscar"><i class="fa-solid fa-magnifying-glass"></i> Sunat</button>
		    		<button type="button" class="btn btn-outline-warning btn-sm"  id="btncrea_directorio"><i class="fa-solid fa-folder-plus"></i> Crear Directorio</button>
					<button type="button" class="btn btn-outline-success btn-sm"  id="btgrabarempresa" data-bs-dismiss="modal"><i class="fas fa-save"></i> Grabar</button>
					<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal" id="btn_cerrar_modal"><i class="fas fa-door-closed" ></i> Cerrar</button>	

		    </div>

    		</div>
  			</div>
				</div>


	<!-------------------------------------->


	

</body>
</html>	

<script type="text/javascript">

$(document).ready(function() {	
	
	Verifica_permiso()
	listar_almacenes();
});
/****************************/

function Verifica_permiso(){

var axiduser =$("#txtcodusuario").val();
var axpermiso ="ALMACENES";


$.ajax({
	url:"almacenes_funciones.php",
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


		$("#txtruc_benef").val('')
		$("#txtrazonsocial").val('')
		$("#txtdireccion").val('')
		$("#txttelefono").val('')
		$("#txtrepresentante").val('')
		$("#txttipo_negocio").val('')
		$("#txtemail_cliente").val('')
		$("#txtclave_correo").val('')
		$("#txtruta_json").val('')
		$("#txturl_produccion").val('')
		$("#txturl_pruebas").val('')
		$("#txttoken_empresa").val('')
		$("#txtcod_cliente_emis").val('')
		$("#txtcod_ubi_emis").val('')
		$("#txtprov_emis").val('')
		$("#txtdpto_emis").val('')
		$("#txtdistr_emis").val('')
		$("#txtcod_operacion").val('')
	
}

$(document).on("click","#btn_cerrar_modal",function(){
limpiar_modal()

})





$(document).on("click","#btn_sunat_buscar",function(){

var  axruc = $("#txtruc_benef").val();

$.ajax({
	url:"almacenes_funciones.php",
	method: "POST",
	data: {param:4,txtruc_benef:axruc},
	success : function(data){		
		
		var json = JSON.parse(data);

		$("#txtrazonsocial").val(json.nombre);	
		$("#txtdireccion").val(json.direccion);

	
							
	}

	})

})


$(document).on("click","#btncrea_directorio",function(){
	
var axruc_cliente = $("#txtruc_benef").val();	

	$.ajax({
		url:"almacenes_funciones.php",
		method: "POST",
		data: {param:5,txtruc_benef:axruc_cliente},
		success : function(data){
			if(data==1){
				Swal.fire({
				  position: 'center',
				  icon: 'warning',
				  title: 'Existe una carpeta ya creada',
				  showConfirmButton: false,
				  timer: 1500
				})

			}else{
				Swal.fire({
				  position: 'center',
				  icon: 'success',
				  title: 'Se ha creado la carpeta satisfactoriamente',
				  showConfirmButton: false,
				  timer: 1500
				})
			}
		}
	})
	

})


$(document).on("keyup","#txtbuscar",function(){
	listar_almacenes();
})


$(document).on("click","#bnNuevo",function(){
	$("#txtparametros").val(1);
})


$(document).on("click","#btn_editar_almacen",function(){

var axid_local_1 = $(this).data("idlocal");
$("#txtid_local").val(axid_local_1)

var axid_local = $("#txtid_local").val()

$("#txtparametros").val(2);

$.ajax({

	url:"almacenes_funciones.php",
	method: "POST",
	data: {param:2,
		txtid_local:axid_local,	
		
	},
	
	success : function(editarempresa){

		var json = JSON.parse(editarempresa);

		  			if (json.status == 200){

		  				$("#txtid_local").val(json.ID_LOCAL)
						$("#txtid_empresa").val(json.ID_EMPRESA)
						$("#txtruc_benef").val(json.RUC_EMPRESA)
						$("#txtrazonsocial").val(json.RAZON_SOCIAL)
						$("#txtdireccion").val(json.DIRECCION)
						$("#txttelefono").val(json.TELEFONO)
						$("#txtrepresentante").val(json.REP_LEGAL)
						$("#txttipo_negocio").val(json.TIPO_NEGOCIO)
						$("#txtemail_cliente").val(json.txt_correo_adquiriente)
						$("#txtclave_correo").val(json.CLAVE_PRINCIPAL)
						$("#txtruta_json").val(json.RUTA_JSON)
						$("#txturl_produccion").val(json.URL_PRODUCCION)
						$("#txturl_pruebas").val(json.URL_PRUEBAS)
						$("#txttoken_empresa").val(json.TOKEN_EMPRESA)
						$("#txtcod_cliente_emis").val(json.cod_cliente_emis)
						$("#txtcod_ubi_emis").val(json.cod_ubi_emis)
						$("#txtprov_emis").val(json.txt_prov_emis)
						$("#txtdpto_emis").val(json.txt_dpto_emis)
						$("#txtdistr_emis").val(json.txt_distr_emis)
						$("#txtcod_operacion").val(json.cod_operacion)



		  			}

	}
})

})


$(document).on("click","#btgrabarempresa",function(){

var axparamentro = $("#txtparametros").val();
var axid_local = $("#txtid_local").val();
var axid_empresa = $("#txtid_empresa").val();
var axruc = $("#txtruc_benef").val();
var axrazonsocial = $("#txtrazonsocial").val();
var axdireccion = $("#txtdireccion").val();
var axtelefono = $("#txttelefono").val();
var axrepresentante = $("#txtrepresentante").val();
var axtipo_negocio = $("#txttipo_negocio").val();
var axemail_cliente = $("#txtemail_cliente").val();
var axclave_correo = $("#txtclave_correo").val();
var axruta_json = $("#txtruta_json").val();
var axurl_produccion = $("#txturl_produccion").val();
var axurl_pruebas = $("#txturl_pruebas").val();
var axtoken_empresa = $("#txttoken_empresa").val();
var axcod_cliente_emis = $("#txtcod_cliente_emis").val();
var axcod_ubi_emis = $("#txtcod_ubi_emis").val();
var axprov_emis = $("#txtprov_emis").val();
var axdpto_emis = $("#txtdpto_emis").val();
var axdistr_emis = $("#txtdistr_emis").val();
var axcod_operacion = $("#txtcod_operacion").val();

$.ajax({

	url:"almacenes_funciones.php",
	method: "POST",
	data: {param:3,
		
		txtid_local:axid_local,
		txtid_empresa:axid_empresa,
		txtruc_benef:axruc,
		txtrazonsocial:axrazonsocial,
		txtdireccion:axdireccion,
		txttelefono:axtelefono,
		txtrepresentante:axrepresentante,
		txttipo_negocio:axtipo_negocio,
		txtemail_cliente:axemail_cliente,
		txtclave_correo:axclave_correo,
		txtruta_json:axruta_json,
		txturl_produccion:axurl_produccion,
		txturl_pruebas:axurl_pruebas,
		txttoken_empresa:axtoken_empresa,
		txtcod_cliente_emis:axcod_cliente_emis,
		txtcod_ubi_emis:axcod_ubi_emis,
		txtprov_emis:axprov_emis,
		txtdpto_emis:axdpto_emis,
		txtdistr_emis:axdistr_emis,
		txtcod_operacion:axcod_operacion,
		txtparametros:axparamentro
	},
	
	success : function(grabrempresa){

		if(grabrempresa==0){
           	
           	limpiar_modal()		
			listar_almacenes();
			Swal.fire('Aviso','El Registro de Grabo correctamente...','success')

      	} else {
			
			Swal.fire('Aviso','No se grabo el regsitro...','error')

		}
	}
})


})

	


function listar_almacenes(){

	var axbuscaregistro = $("#txtbuscar").val();	
	var txtid_empresa = $("#txtid_empresa").val();	

		$.ajax({

			url:"almacenes_funciones.php",
			method: "POST",
			data: {param:1,txtbuscar:axbuscaregistro,txtid_empresa:txtid_empresa},
				
				success : function(listaempresas){

					$("#lista1").html(listaempresas);
			}
		})
	}


</script>