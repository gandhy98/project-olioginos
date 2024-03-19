<?php require_once '../includes/header.php'; 
$tipo = $_GET['id'];

?>

<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>

<input type="hidden" name="txtparametros" id="txtparametros">
<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axiduser";?>">
<input type="hidden" name="txtid_empresa" id="txtid_empresa" value="<?php echo "$axidempresa";?>">


<body >
<br>
<div class="col-12 border border-danger" style="padding: 10px; margin: 0;">	  	
<div class="card">
<div class="card-header"><h5 id="titulo_formulario"></h5></div>
<div class="card-body">

	<div class="row g-3" id="div_cabecera">
		
		<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4" >
		<div class="form-floating">		
		<select class="form-select" id="txtid_local" aria-label="Floating label select example">		
		<?php while($fila=odbc_fetch_array($rslocales)) {?>
		<option value="<?php echo $fila['ID_LOCAL'];?>"><?php echo $fila['RAZON_SOCIAL'];?></option><?php } ?>
		</select>
		<label for="txtid_local"><i class="bi bi-buildings-fill"></i> Almacenes</label>		
		</div>
		</div>

		<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4" >
		<div class="form-floating">
		<input type="text" class="form-control" id="txtbuscar" placeholder="Buscar ">
		<label for="txtbuscar"><b><i class="bi bi-search"></i> Buscar</b></label>
		</div>
		</div>
			

	</div>
	<br>

	<div class="row">
	  <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4" >
	    <div class="card">
	      <div class="card-body">
	        <div class="table-responsive" id="lista1"></div>
	      </div>
	    </div>
	  </div>
	  <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
	    <div class="card">
	      <div class="card-body">

	      	<input type="hidden" class="form-control" id="txtid_rendicion_dt">
	      	<input type="text" class="form-control" id="txtid_beneficiario">
	      	<input type="hidden" class="form-control" id="txtid_producto">
	        
				<div class="row g-3" id="div_cabecera_formulario" hidden>

					<div class="col-md-3">
					<div class="form-floating">
					<input type="date" class="form-control" id="txtfecha_gasto" placeholder="Fec. Emisión" value="<?php echo "$diaactual";?>" >
					<label  for="txtfecha_gasto"><b><i class="bi bi-calendar-date-fill"></i> Fec. Emisión</b></label>
					</div>					  
					</div>					

					<div class="col-md-3" >
						<div class="form-floating">						
						<select class="form-select" id="txtid_td" aria-label="Floating label select example">
						<option selected>Seleccionar</option>
						<?php while($fila=odbc_fetch_array($RStipo_doc_egresos)) {?>
						<option value="<?php echo $fila['ID_TD'];?>"><?php echo $fila['DETALLE_DOC'];?></option><?php } ?>
						</select>
						<label for="txtid_td"><b><i class="bi bi-file-earmark-text"></i> Tipo documento</b></label>						
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-floating">
						<input type="text" class="form-control" id="txtn_serie" placeholder="0000" >
						<label for="txtn_serie"><b><i class="bi bi-123"></i> Serie</b></label>
						</div>					  
					</div>
					<div class="col-md-3">
						<div class="form-floating">
						<input type="text" class="form-control" id="txtdocumento" placeholder="00000000" >
						<label for="txtdocumento"><b><i class="bi bi-123"></i> Número</b></label>
						</div>					  
					</div>

					<div class="col-md-5">
						<div class="form-floating">
						<input type="text" class="form-control" id="txtnom_proveedor" placeholder="Proveedor">
						<label  for="txtnom_proveedor"><b><i class="bi bi-calendar-date-fill"></i> Proveedor</b></label>
						</div>	
						<div id="listar_proveedores_servicios"></div>				  
					</div>

					

					<div class="col-md-5">
				    	<div class="form-floating">	
				        <input type="text" class="form-control" id="txtnom_producto" placeholder="Productos" oninput="convertirAMayusculas(this)">			  
						<label for="txtnom_producto"><b><i class="bi bi-box-seam"></i>  Productos</b></label>
						</div>
						<div id="listar_productos_servicios"></div>
				    </div>

				    <div class="col-md-2">
				   		<div class="form-floating">	
						<input type="text" class="form-control" id="txtmonto_gasto" placeholder="Monto" style="text-align: right;" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
						<label for="txtmonto_gasto"><b><i class="bi bi-hash"></i> Monto</b></label>
						</div>
				    </div>			
				
					<div class="modal-footer">
					   	<button type="button" class="btn btn-outline-success btn-sm"  data-bs-dismiss="modal" id="btn_agregar_nuevo_gasto"><i class="bi bi-plus-circle-fill"></i> Agregar</button>
					   	<button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal" id='btn_cerrar_formulario' ><i class="fas fa-door-closed" ></i> Cerrar</button>
					</div>

				</div>

				<div class="row g-3" id="div_cabecera_listado" hidden>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4" >
					<div class="input-group mb-3">
					  <input type="text" class="form-control" id="txtbuscar_gasto" placeholder="Buscar " aria-label="Recipient's username" aria-describedby="basic-addon2">
					  <button type="button" class="btn btn-outline-success btn-sm"  data-bs-dismiss="modal" id="btn_nuevo_gasto"><i class="bi bi-plus-circle-fill"></i> Nuevo gasto</button>
					</div>
					</div>

					
					<br>
					<div id="div_listar_detalle_rendicion"></div>


	      </div>
	    </div>
	  </div>
	</div>


	

	
</div><!--div class="card-body"-->
</div><!--div class="card"-->
</div><!--div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"-->	  	



<!-- Modal -->
<div class="modal fade" id="mdl_registrar_gasto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Registrar Rendición</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        	
        <div class="row g-3">

        	<input type="hidden" class="form-control" id="txtid_rendicion_cz">
      			
        		<div class="col-md-4">
				 	<div class="form-floating">
				   	<input type="text" class="form-control" id="txtnum_rendicion" placeholder="Num. rendición">
  					<label for="txtnum_rendicion"><b>Num. rendición</b></label>
				 	</div>
				</div>

				<div class="col-md-4">
				 	<div class="form-floating">
				 	<input type="date" class="form-control" id="txtfecha_entrega" style="text-align: center;" value="<?php echo "$diaactual";?>">				   	
  					<label for="txtfecha_entrega"><b>Fecha entrega</b></label>
				 	</div>
				</div>

				<div class="col-md-4">
					<div class="form-floating">
					<select class="form-select" id="txtestado_rendicion" aria-label="Floating label select example">			        
						<option value="POR RENDIR">POR RENDIR</option>						
						<option value="RENDIDA">RENDIDA</option>																		
					</select>
					<label for="txtestado_rendicion"><b>Estado</b></label>
					</div>
				</div>

				<div class="col-md-6">
				 	<div class="form-floating">
				   	<input type="text" class="form-control" id="txtresponsable_recibe" placeholder="Responsable">
  					<label for="txtresponsable_recibe"><b>Responsable</b></label>
				 	</div>
				</div>

				<div class="col-md-3">
			    	<div class="form-floating">	
			    	<input type="text" class="form-control" id="txtmonto_entregado" placeholder="Monto Entregado" style="text-align: right;" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
					<label for="txtmonto_entregado"><b><i class="bi bi-hash"></i>  Monto Entregado </b></label>
					</div>
			    </div>

			    <div class="col-md-3">
			    	<div class="form-floating">	
			    	<input type="text" class="form-control" id="txtsaldo" placeholder="Saldo" style="text-align: right;" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00" disabled>
					<label for="txtsaldo"><b><i class="bi bi-hash"></i>  Saldo </b></label>
					</div>
			    </div>

				<div class="col-md-4">
					<div class="form-floating">
					<select class="form-select" id="txtid_cta" aria-label="Floating label select example">
					<option value="">Seleccionar</option>
					<?php while($fila=odbc_fetch_array($RSCtas)) {?>
					<option value="<?php echo $fila['ID_CTA'];?>"><?php echo $fila['NUM_CUENTA'];?></option><?php } ?>
					</select>
					<label for="txtid_cta"><b><i class="bi bi-hash"></i>Cta Bancaria</b></label>
					</div>
				</div>
			

				<div class="col-md-4">
					<div class="form-floating">
					<select class="form-select" id="txtmedio_pago" aria-label="Floating label select example">				        
						<option value="EFECTIVO">EFECTIVO</option>						
						<option value="TRANSFERENCIA">TRANSFERENCIA</option>											
						<option value="DEPOSITO">DEPOSITO</option>											
						<option value="OTROS">OTROS</option>											
					</select>
					<label for="txtmedio_pago"><b>Medio pago</b></label>
					</div>
				</div>
		
				<div class="col-md-4" >
		    		<div class="form-floating">	
		   		    <input type="text" class="form-control" id="txtnum_transf" placeholder="# Mov. Banco" value="0">
					<label for="txtnum_transf"><b><i class="bi bi-hash"></i>Mov. Banco </b></label>
					</div>
			    </div>
				
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-success"  id="btn_guardar_rendicion" data-bs-dismiss="modal"><i class="fas fa-save"></i> Guardar</button>
		<button type="button" class="btn btn-outline-danger " data-bs-dismiss="modal"><i class="fas fa-door-closed" ></i> Cerrar</button>
      </div>
    </div>
  </div>
</div>



</body>
</html>
<script type="text/javascript">

$(document).ready(function() {	
	
	
	
	Verifica_permiso()
	listar_egresos();

/*
		
	*/
});	
/**********************************************/



$(document).on("click","#btn_cerrar_formulario",function(event){

	$("#div_cabecera_formulario").prop('hidden',true)
	$("#div_cabecera_listado").prop('hidden',false)

})


$(document).on("click","#btn_ver_detalle_rendicion",function(event){


	$("#div_cabecera_listado").prop('hidden',false)
	traer_detalle_rendicion()


})


$(document).on("click","#btn_nuevo_gasto",function(event){

$("#div_cabecera_formulario").prop('hidden',false)
$("#div_cabecera_listado").prop('hidden',true)

})




$(document).on("click","#btn_listar_beneficiarios",function(event){

$("#txtnom_proveedor").val($(this).data('nom_pro'));
$("#txtid_beneficiario").val($(this).data('id'));
$("#listar_proveedores_servicios").fadeOut();

})


$('#txtnom_proveedor').keyup(function(){

	  var axbuscar_dato = $("#txtnom_proveedor").val();
	  
	  if (axbuscar_dato != '') {

	    $.ajax({
	      url:"egresos_rendicion_funciones.php",
	      method: "POST",
	      data: {param:6,txtnom_proveedor:axbuscar_dato},
	      success : function(data){
	      	$('#listar_proveedores_servicios').fadeIn();
	        $('#listar_proveedores_servicios').html(data);
	      }
	    });

	  }else{
	  	$("#listar_proveedores_servicios").fadeOut();
	  } 
	});


function traer_detalle_rendicion() {
	

 var axid_rendicion_cz =$("#txtid_rendicion_cz").val()					
 var axid_local =$("#txtid_local").val()	
 var axbuscar_gasto =$("#txtbuscar_gasto").val()	
				

	$.ajax({

		url:"egresos_rendicion_funciones.php",
		method: "POST",
		data: {param:5,
			
			txtid_rendicion_cz:axid_rendicion_cz,
			txtid_local:axid_local,
			txtbuscar_gasto:axbuscar_gasto
		},
		success : function(data){

			$("#div_listar_detalle_rendicion").html(data);

			
			
		}
	})


}


$(document).on("click","#btn_agregar_nuevo_gasto",function(event){


 var axid_rendicion_dt =$("#txtid_rendicion_dt").val()					
 var axid_rendicion_cz =$("#txtid_rendicion_cz").val()					
 var axid_local =$("#txtid_local").val()					
 var axfecha_gasto =$("#txtfecha_gasto").val()
 var axid_beneficiario =$("#txtid_beneficiario").val()
 var axid_td =$("#txtid_td").val()
 var axtxt_serie =$("#txttxt_serie").val()
 var axdocumento =$("#txtdocumento").val()
 var axid_producto =$("#txtid_producto").val()
 var axmonto_gasto =$("#txtmonto_gasto").val()

	$.ajax({

		url:"egresos_rendicion_funciones.php",
		method: "POST",
		data: {param:4,
			txtid_rendicion_dt:axid_rendicion_dt,
			txtid_rendicion_cz:axid_rendicion_cz,
			txtid_local:axid_local,
			txtfecha_gasto:axfecha_gasto,
			txtid_beneficiario:axid_beneficiario,
			txtid_td:axid_td,
			txttxt_serie:axtxt_serie,
			txtdocumento:axdocumento,
			txtid_producto:axid_producto,
			txtmonto_gasto:axmonto_gasto
		},
		success : function(data){

			if(data==0){

	      		Swal.fire({
				  position: 'center',
				  icon: 'success',
				  title: 'El registro se guardo satisfactoriamente',
				  showConfirmButton: false,
				  timer: 200
				})

				traer_detalle_rendicion()

	      	}else{

	      		Swal.fire('Aviso!','No se grabo el registro...','error')

	      	}

		}
	})

})


$(document).on("click","#btn_editar_rendicion",function(event){

	$("#txtid_rendicion_cz").val($(this).data('id'))
	$("#txtestado_rendicion").val($(this).data('estado'))

	var axid_rendicion_cz = $("#txtid_rendicion_cz").val()
	var axestado_rendicion = $("#txtestado_rendicion").val()

	$("#txtparametros").val(1) 

	if(axestado_rendicion=='RENDIDA'){
		Swal.fire('Aviso!','La rendición no puede ser modificada, puesto que tiene estado RENDIDA','warningr')
	}else{
		
		$.ajax({
	    url:"egresos_rendicion_funciones.php",
		method: "POST",
	    data: {param:3,txtid_rendicion_cz:axid_rendicion_cz},
	      success : function(data){	      	
	        var json = JSON.parse(data);
				if (json.status == 200){	
					
					$("#txtnum_rendicion").val(json.NUM_RENDICION)
					$("#txtfecha_entrega").val(json.FECHA_ENTREGA)
					$("#txtestado_rendicion").val(json.ESTADO_RENDICION)
					$("#txtresponsable_recibe").val(json.RESPONSABLE_RECIBE)
					$("#txtmonto_entregado").val(json.MONTO_ENTREGADO)
					$("#txtsaldo").val(json.SALDO)
					$("#txtid_cta").val(json.ID_CTA)
					$("#txtmedio_pago").val(json.MEDIO_PAGO)
					$("#txtnum_transf").val(json.NUM_TRANSF)

				}
	      }
	    });
	}


})



$(document).on("click","#btn_guardar_rendicion",function(event){


var axid_rendicion_cz = $("#txtid_rendicion_cz").val()
var axnum_rendicion = $("#txtnum_rendicion").val()
var axfecha_entrega = $("#txtfecha_entrega").val()
var axestado_rendicion = $("#txtestado_rendicion").val()
var axresponsable_recibe = $("#txtresponsable_recibe").val()
var axmonto_entregado = $("#txtmonto_entregado").val()
var axsaldo = $("#txtsaldo").val()
var axid_cta = $("#txtid_cta").val()
var axmedio_pago = $("#txtmedio_pago").val()
var axnum_transf = $("#txtnum_transf").val()
var axid_local = $("#txtid_local").val()
var axparametros = $("#txtparametros").val() 


$.ajax({
	      url:"egresos_rendicion_funciones.php",
	      method: "POST",
	      data: {param:2,

	      	txtid_rendicion_cz:axid_rendicion_cz,
			txtnum_rendicion:axnum_rendicion,
			txtfecha_entrega:axfecha_entrega,
			txtestado_rendicion:axestado_rendicion,
			txtresponsable_recibe:axresponsable_recibe,
			txtmonto_entregado:axmonto_entregado,
			txtsaldo:axsaldo,
			txtid_cta:axid_cta,
			txtmedio_pago:axmedio_pago,
			txtnum_transf:axnum_transf,
			txtid_local:axid_local,
			txtparametros:axparametros
	      },
	      success : function(data){
	      	
	      	if(data==0){

	      		Swal.fire({
				  position: 'center',
				  icon: 'success',
				  title: 'El registro se guardo satisfactoriamente',
				  showConfirmButton: false,
				  timer: 200
				})

				listar_egresos()

	      	}else{

	      		Swal.fire('Aviso!','No se grabo el registro...','error')

	      	}

	      }
	    });


})



$(document).on("click","#btn_nuevo",function(event){
$("#txtparametros").val(0) 

})


function listar_egresos(){

	var axbuscaregistro = $("#txtbuscar").val();		
	var axid_local = $("#txtid_local").val();	


		$.ajax({

			url:"egresos_rendicion_funciones.php",
			method: "POST",
			data: {param:1,
				txtbuscar:axbuscaregistro,
				txtid_local:axid_local				
				},
				
				success : function(data){

					$("#lista1").html(data);
			}
		})
	}



function Verifica_permiso(){

	var axiduser =$("#txtcodusuario").val();
	var axtipo_beneficiario =$("#txttipo_beneficiario").val();
	//alert(axtipo_beneficiario)
	var axpermiso = 'RENDICION DE GASTOS';

	$("#titulo_formulario").html("<i class='bi bi-piggy-bank-fill'></i>"+axpermiso +" <button type='button' id='btn_nuevo'  class='btn btn-outline-danger btn-sm' data-bs-toggle='modal' data-bs-target='#mdl_registrar_gasto'><i class='fa-solid fa-circle-plus'></i> Nuevo</button>")
	
	$.ajax({
		url:"egresos_rendicion_funciones.php",
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




/************************************/


function convertirAMayusculas(input) {
  input.value = input.value.toUpperCase();
}

$("input[type=text]").focus(function(){	   
  this.select();
});




</script>