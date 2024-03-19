<?php require_once '../includes/header.php'; ?>


<!DOCTYPE html>
	<html>
	<head>
		    
	</head>
	
	<!--img src="../img/empresa.PNG" style="opacity: 0.2;"-->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<input type="hidden" name="txtparametros" id="txtparametros">
	<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axiduser";?>">
	<input type="hidden" class="form-control" id="txtidempresa" value="<?php echo "$axidempresa";?>">

	<body style="margin: 3; padding: 3; background: url(../img/empresa.PNG) no-repeat center top;  background-size: cover;  font-family: sans-serif;  height: 100vh;">

	<br>
	<div class="card">
  	<div class="card-header">
	    <h5><img src="../icon/estructuras.png" style="width: 25px; height: 25px;"> Locales <button type="button" id="bnNuevo"  class="btn btn-outline-danger btn-sm" data-bs-toggle='modal' data-bs-target='#exampleModal'><i class="fa-solid fa-circle-plus"></i> Nuevo</button></h5>	
  	</div>

  	<div class="card-body">

  		<div class="row g-3">
			<div class="col-md-3">
			<div class="form-floating">
			<input type="text" class="form-control" id="txtbuscar" placeholder="Buscar locales">
			<label for="txtbuscar"><b>Buscar Locales</b></label>
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
		    <h5 class="modal-title" id="exampleModalLabel">Registrar Local</h5>		    
		    </div>

				<div class="modal-body">	

					
					<input type="hidden" class="form-control" id="txtid_local">
				
					<div class="row g-3">
						<div class="col-md-8">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtdescripcio_lc" placeholder="Descripción o Nombre">
  							<label for="txtdescripcio_lc"><b>Descripción o Nombre</b></label>
					  	</div>
						</div>
					
						<div class="col-md-4">
					  	<div class="form-floating">
					    	<input type="text" class="form-control" id="txtubicacion_lc" placeholder="Ubicación ó Dirección">
  							<label for="txtubicacion_lc"><b>Ubicación ó Dirección</b></label>
					  	</div>
						</div>

					</div>
					<br>
					
				</div>
		    
		    <div class="modal-footer">


					<button type="button" class="btn btn-outline-success btn-sm"  id="btn_agregar" data-bs-dismiss="modal"><i class="fas fa-save"></i> Grabar</button>
					<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"><i class="fas fa-door-closed"></i> Cerrar</button>	

		    </div>

    		</div>
  			</div>
				</div>


	<!-------------------------------------->


	

</body>
</html>	

<script type="text/javascript">

$(document).ready(function() {	
	listarlocales();
});

$(document).on("keyup","#txtbuscar",function(){
	listarlocales()
})


$(document).on("click","#bnNuevo",function(){
	$("#txtparametros").val(1);
})


$(document).on("click","#btn_editar",function(){

var axid_local_1 = $(this).data("id");
$("#txtid_local").val(axid_local_1)

var axid_local = $("#txtid_local").val();
$("#txtparametros").val(2);

$.ajax({

	url:"funciones.php",
	method: "POST",
	data: {param:5,txtid_local:axid_local},
	
	success : function(data){

		var json = JSON.parse(data);

		  	if (json.status == 200){
				$("#txtidempresa").val(json.ID_EMPRESA)
				$("#txtid_local").val(json.ID_LOCAL)
				$("#txtdescripcio_lc").val(json.DESCRICION_LC)
				$("#txtubicacion_lc").val(json.UBICACION_LC)
			}
		}
})

})


$(document).on("click","#btn_agregar",function(){

var axparamentro = $("#txtparametros").val();
var axidempresa = $("#txtidempresa").val();
var axid_local = $("#txtid_local").val();
var axdescripcio_lc = $("#txtdescripcio_lc").val();
var axubicacion_lc = $("#txtubicacion_lc").val();

$.ajax({

	url:"funciones.php",
	method: "POST",
	data: {param:4,		
		txtidempresa:axidempresa,
		txtid_local:axid_local,	
		txtdescripcio_lc:axdescripcio_lc,
		txtubicacion_lc:axubicacion_lc,		
		txtparametros:axparamentro
	},
	
	success : function(grabrempresa){

		if(grabrempresa==0){
           			
			listarlocales();
			Swal.fire('Aviso','El Registro de Grabo correctamente...','success')

      	} else {
			
			Swal.fire('Aviso','No se grabo el regsitro...','error')

		}
	}
})


})

	
$(document).on("change","#txtruc",function(){


	var ruc = $("#txtruc").val();
	//$('.ajaxgif').removeClass('hide');
	$("#ajaxgif").css({'display':'block'});

	 if (ruc != ''){

		    $.ajax({
		      url:"sunat.php",
		      method: "POST",
		      data: {txtruc:ruc},
		      success : function(datos_ruc){
		      	
		      	$("#ajaxgif").css({'display':'none'});
		      	//$('.ajaxgif').addClass('hide');

     			var datos = eval(datos_ruc);
     			var nda = 'nada';
     			if(datos[0]==nda) {

     				//alert("RUC NO EXISTE EN SUNAT");
     				swal("Aviso", "El Número de RUC NO EXISTE EN SUANT...", "warning");

     				$("#txtrazonsocial").val("");
     				$("#txtdireccion").val("");

     			}else{

     				$("#txtrazonsocial").val(datos[1]);
     				$("#txtdireccion").val(datos[2]);
     				//$("#txtcontacto").val(datos[4]);
     				$("#txtrepresentante").text(datos[4]);

     				
     			}
		      	
		     }
		  });
		    return false;
		} 

})

function listarlocales(){

		var axidempresa = $("#txtidempresa").val();	
		var axbuscaregistro = $("#txtbuscar").val();	
		$.ajax({

			url:"funciones.php",
			method: "POST",
			data: {param:3,txtbuscar:axbuscaregistro,txtidempresa:axidempresa},
				
				success : function(listaempresas){

					$("#lista1").html(listaempresas);
			}
		})
	}


</script>