
<?php require_once '../includes/header.php'; 
$tipo = $_GET['id'];

?>

<!DOCTYPE html>
	<html>
	<head>
	</head>

<style type="text/css">
	.cabecera{
		
	margin-bottom: 5px;

    margin-left: 3px;
    margin-right: 3px;

    height: 25px;
    color: white;
    background: #0CB53B;

	}
	.cerrar{
		
		padding-left: 5px;
		padding-right: 5px;
		height: 25px;
		background: #b50c0c;
		font-weight: 900;
		color: white;
		border-color: white;


	}
	.ul{
    background-color: #000;
    cursor: pointer;;
    }

  .li{
    /*padding: 10px;*/
      display:block; 
      width:100%;
      padding: 3px 0px;
      color:#000;
      background-color:#DBEBF6;
      text-decoration:none;
  }

  .li:hover{
    /*padding: 10px;*/
      display:block; 
      width:100%;
      padding: 3px 0px;
      color:#000;
      background-color:#DBEBF6;
      text-decoration:none;
  }
		
		#ulproductos{
	    background-color: #000;
	    cursor: pointer;
	    }

		#liproductos{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#DBEBF6;
		  text-decoration:none;
		  }


		#liproductos:hover{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#356AA0;
		  text-decoration:none;
		  }


		#linuevoregistro{

		 
		  display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#DBEBF6;
		  text-decoration:none;
		  }

		#linuevoregistro:hover{
		 
		  display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#356AA0;
		  text-decoration:none;

		  }
			
		  #libeneficiarios{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#DBEBF6;
		  text-decoration:none;
		  }


		#libeneficiarios:hover{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#356AA0;
		  text-decoration:none;
		  }


		   #litransportista{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#DBEBF6;
		  text-decoration:none;
		  }


		#litransportista:hover{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#356AA0;
		  text-decoration:none;
		  }

.table-danger{
	--bs-table-bg: #F3F4E8;
}	  

</style>


<body onload="mueveReloj()">
<br>
<div class="container-fluid" id="divcontenedor1" >
      
      	<input type="hidden" name="txtidempresa" id="txtidempresa" value="<?php echo "$axidempresa";?>">
      	<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axiduser";?>">
      	<input type="hidden" name="txtrucempresa" id="txtrucempresa" value="<?php echo "$axrucempresa";?>">
      	<input type="hidden" name="txtid_usuario" id="txtid_usuario" value="<?php echo "$axcoduser";?>">  
      	<input type="hidden" name="txtobservado" id="txtobservado" value="NORMAL">  
      	<input type="hidden" name="txtcomprobante_electronico" id="txtcomprobante_electronico" value="<?php echo "$axcomprobante_electro";?>">

      	<input type="hidden" name="txtruta_ap" id="txtruta_ap" value="<?php echo "$axruta_api";?>">
      	<input type="hidden" name="txttoken" id="txttoken" value="<?php echo "$axtoken";?>">


      	
      	<input type="hidden" name="txtruta" id="txtruta" value="<?php echo "$axruta";?>">
      	<input type="hidden" name="txtruta_exc" id="txtruta_exc" value="<?php echo "$axruta_exc";?>">
      	<input type="hidden" name="txtruta_obs" id="txtruta_obs" value="<?php echo "$axruta_obs";?>">
      	<input type="hidden" name="txtruta_proc" id="txtruta_proc" value="<?php echo "$axruta_proc";?>">

      	<input type="hidden" name="txtruta_comprobantes_pdf" id="txtruta_comprobantes_pdf" value="<?php echo "$axruta_comprobantes";?>">

		
      	 
      	<input type="hidden" name="txttipocambio" id="txttipocambio">
		<input type="hidden" name="txthoraemision" id="txthoraemision">


		<input type="hidden" name="txtdestino_contable" id="txtdestino_contable" value="ABONO">
		<input type="hidden" name="txtestado_cierre" id="txtestado_cierre" value="ABIERTA">
		<input type="hidden" name="txtmotivo_devolucion" id="txtmotivo_devolucion" value="0">
		<input type="hidden" name="txtglosa" id="txtglosa" value="VENTA DE MERCADERIA Y PRODUCTOS">
		<input type="hidden" name="txtpermiso_nc" id="txtpermiso_nc" value="SI">

	
		
		<input type="hidden" name="txtcodmovcz" id="txtcodmovcz">
		
		<!--input type="hidden" name="txttipo_cotizacion" id="txttipo_cotizacion"  value="<?php echo "$tipo";?>"-->
		<input type="hidden" name="txttipo_cotizacion" id="txttipo_cotizacion"  value="PROVEEDOR">
		


		<input type="hidden" name="txtcod_contable" id="txtcod_contable" value="0">
		

		<input type="hidden" name="txttipomov" id="txttipomov" value="SALIDA">
		<input type="hidden" name="txtdetallemov" id="txtdetallemov" value="VENTA">
		
		
		<input type="hidden" name="txtparametros" id="txtparametros">
		<input type="hidden" class="form-control" id="txtdireccion">
		<input type="hidden" class="form-control" id="txtanoactual">
		
		<input type="hidden" name="txtporc_igv" id="txtporc_igv" value="<?php echo "$axigvgeneral";?>">

	
		<input type="hidden" class="form-control" id="txtprecio_venta">
		<input type="hidden" class="form-control" id="txtprecio_compra">
		<input type="hidden" class="form-control" id="txtdscto_Venta" value="0">
		<input type="hidden" class="form-control" id="txtvalor_venta">
		<input type="hidden" class="form-control" id="txtigv_venta">
		<input type="hidden" class="form-control" id="txtgravadas_venta" >
		<input type="hidden" class="form-control" id="txtinafectas_venta" >		
		<input type="hidden" class="form-control" id="txtexonerada_venta" >
		<input type="hidden" class="form-control" id="txttotal_venta">			
		
		
		<input type="hidden" class="form-control" id="txtnomsubcategoria">
		<input type="hidden" class="form-control" id="txtidinsumo">
		<input type="hidden" class="form-control" id="txttipocondicion">
		<input type="hidden" name="txtperiodotranf" id="txtperiodotranf">		
		<input type="hidden" name="txtfiltro_busca_fecha" id="txtfiltro_busca_fecha" >		


		<input type="hidden" name="txtid_cotizacion_cz" id="txtid_cotizacion_cz">		
				
<input type="hidden" id="txtcodmovprof">

	
		

		<div id="divcabecera" >
			<div class="row">
			<div class="col-12" >

			<!--div class="card-header"-->
			<div class="card-header text-white bg-danger">
		  	
		  		<ul class="nav nav-tabs card-header-tabs"style="background: #ABEBC6;">
					<li class="nav-item">
					<a class="nav-link active" id="pnlistado" href="#"><b>Listado</b></a>
					</li>

					<li class="nav-item" id="lstdocumentos" style="display: none;">
					<a class="nav-link" id="pndocumentos" href="#"><b>Documentos</b></a>
					</li>

				</ul>
			</div>
			</div>
			</div>
		</div><!--div id="divcabecera"-->

		<div id="divlistado">
			<div class="row">
	        <div class="col-12">
	            <div class="card">
	              <div class="card-header">
	               <h5 class="text-danger">
	               		<img src="../icon/pedidos_gestion.png" style="width: 50px; height: 50px;"> Cotizaciones 
	               		<button type="button" id="bnNuevo"  class="btn btn-outline-danger">Nuevo <i class="far fa-file"></i></button>	               		
	               	</h5>
	              <div class="row">

								<div class="form-group col-md-3">
						    <label for="txtidlocal"><b>Local</b></label>
								<select class="form-control form-control-sm custom-select mr-sm-2" id="txtidlocal">
								<!--option value="">Seleccionar </option-->
								<?php while($fila=odbc_fetch_array($rslocales)) {?>
		    				<option value="<?php echo $fila['ID_LOCAL'];?>"><?php echo $fila['RAZON_SOCIAL'];?></option><?php } ?>
		    				</select>
								</div>

								<div class="form-group col-md-3">								
								<label for="txtbuscar"><b>Buscar</b></label>
								<div class="input-group mb-3">
								<input type="text" class="form-control" id="txtbuscar" name="txtbuscar" aria-describedby="basic-addon3" placeholder="Nombre Cliente">	
								<div class="input-group-append">
								<span class="input-group-text" id="basic-addon2"><a href="#" id="btbuscar_comprobante"><i class="fas fa-search"></i></a></span>
								</div>
								</div>
								</div>
							
								<div class="form-group col-md-2">
								<label for="txtbuscar"><b>Fecha</b></label>
								<div class="input-group mb-3">								
								<input type="date" class="form-control" id="txtfecharegistro" style="text-align: center;" value="<?php echo "$diaactual";?>">
								<div class="input-group-append">
								<span class="input-group-text" id="basic-addon2"><a href="#" id="btbuscar_fechas"><i class="fas fa-search"></i></a></span>
								</div>
								</div>
								</div>

								<div class="form-group col-md-2">
								<label for="txtbuscar"><b>Hora</b></label>							
								<form name="form_reloj">
								<b><input type="text" style="text-align: center; color: red;" class="form-control" id="reloj" name="reloj" aria-describedby="basic-addon3"></b>
								<!--button class="btn btn-outline-success" onclick="exportTableToExcel('tblistagastos')">Excel</button-->
								</form>
								</div>						

								<div class="form-group col-md-2"hidden>
					    	<label for="txtperiodo"><b>Periodo</b></label>
					    	<input type="text" class="form-control" id="txtperiodocontable" style="text-align: center;" placeholder="mm-aaaa">	
					    	<!--input type="hidden" class="form-control" id="txtperiodo" value="COTIZACION"-->									
				    		</div>

				    		<div class="form-group col-md-2">
					    	<label for="txtperiodo"><b>Año</b></label>
					    	<input type="text" class="form-control" id="txtanoactual" style="text-align: center;" placeholder="mm-aaaa" value="<?php echo "$anoactual";?>">	
					    	
				    		</div>
								
								</div>

			

					</div>
	  		
	                <div class="card-body">

	                	<div class="text-center" id="ajaxgif_3" hidden>
										  <div class="spinner-border" role="status">
										    <span class="sr-only">Loading...</span>
										  </div>
										</div>

	                <div id="lista1" style="font-size:10pt;"></div>	  
	                <div id="lista2" style="font-size:10pt;"></div>	  
	                </div>
	                
	            </div>    
	          	
	          			
	        </div>
	       </div>
		</div><!--div id="divlistado"-->

</div><!--div class="container-fluid" id="divcontenedor1"-->

<div class="container-fluid" id="divcontenedor2" style="display: none;" >

<div class="card" id="divcontenedor3">
	<div class="row cabecera">
	
		<div class="col-sm">
			
			<b id="txtnum_proforma">xxxxx</b>

		</div>
		<div class="col-sm">
			<!--h5 class="card-header border bg-primary border-primary text-white"-->
			<p align="right"> <button  class="cerrar" onCLick="cerrarventananuevo()">X</button> </p>
			</h5>
		</div>
	
	</div>
		


<div class="card-body border border-primary">


<div class="card" id="divlistastock">
	<div class="card-body border border-primary">
   		<div class="form-row">
	      <div class="col-sm-12">
		    <div class="input-group">
			  <div class="input-group-prepend">
			  <span class="input-group-text" id="">Buscar</span>
			  </div>
			  <input type="text" class="form-control" placeholder="Descripción del producto" id="txtbuscararticulo">
			  <input type="text" class="form-control" placeholder="Código Barra" id="txtcod_barra">			 
			  <div class="input-group-prepend">
			  <span class="input-group-text" id="">Cantidad</span>
			  </div>
			  <input type="text" class="form-control" id="txtcant_venta" style="text-align: center;" value="1">			  
				</div>
			<br>


			</div>
		</div>
		<div id="divgrillaStock"></div>
	</div>
</div>
<br>
<div class="card" id="divlsitavender" style="display: none;">
	<div class="card-body border border-primary">

		<div class="row">

			 <div class="col-sm-7">
		    <div class="card">
		      <div class="card-body border border-danger" >
		        
		      <!--div id="div1"-->
		      <div class="table-responsive">
		      <table class='table table-sm table-hover'>
					<thead class='thead-dark'>	
					<tr>
						<th scope='col' style='text-align: center;'>Cant</th>
						<th scope='col' style='text-align: center;'>Descripción</th>
						<th scope='col' style='text-align: center;'>Presentación</th>
						<th scope='col' style='text-align: right;' >Precio</th>
						<th scope='col' style='text-align: right;' >Total</th>
						<th scope='col'style='text-align: center;'>Acción</th>
					</tr>
					</thead>
					<tbody id="divproforma"></tbody>
					<h3></h3>
				</table>
				</div>

		      </div>
		    </div>
		  </div>


		  <div class="col-sm-5">
		    <div class="card">
		      <div class="card-body border border-danger">	

		      	<input type="hidden" class="form-control" id="txtidcliente">
							<input type="hidden" class="form-control" id="txtruc" >
							

		      	<div class="row">
		
		      	<div class="col-md-7">
			      	<div class="form-floating">					    
							<input type="text" class="form-control" id="txtnom_cliente">
							<label for="txtnom_cliente"><b>Nombre Cliente</b></label>
							<div id="listarclientes"></div>
					    </div>	
				    </div>

				    <div class="col-md-5">
			      <div class="form-floating">				    
				    <input type="hidden" class="form-control" id="txtnom_cliente_pedido" >
						<input type="text" class="form-control" id="txtnum_proforma_mostrar" value='0'  placeholder="Número Cotización" style="text-align:center;">
						<input type="hidden" class="form-control" id="txtnum_proforma_1" value='0'  placeholder="Número Cotización" style="text-align:center;">
						<label for=""><b>Num. Cotización </b></label>
						</div>

						
						</div>

						</div>

						<br>

						<div class="row">

						<div class="col-md-4">
			      <div class="form-floating">						
						<select id="txtmoneda" class="form-control custom-select mr-sm-2">
						<option value="SOLES">SOLES</option>
						<option value="DOLARES">DOLARES</option>
						</select>				
						<label for=""><b>Moneda</b></label>
						</div>
						</div>
				    


				    <div class="col-md-3"hidden>
			      <div class="form-floating">					  
						<select class="form-control custom-select mr-sm-2"id="txttipodoc"></select>		
						<label for=""><b>Tipo</b></label>
				    </div>
				    </div>



				    <div class="col-md-4">
			      <div class="form-floating">						
						<select id="txtestadopago_compra" class="form-control custom-select mr-sm-2">
							<option value="PENDIENTE">PENDIENTE</option>
							<option value="CANCELADO">CANCELADO</option>							
						</select>
						<label for="txtestadopago_compra"><b>Estado</b></label>
					  </div>
					  </div>


					  <div class="col-md-4">
			      <div class="form-floating">						
						<input type="date" class="form-control" id="txtfecha_emision" style="text-align: center;" value="<?php echo "$diaactual";?>">
						<label for="txtfecha_emision"><b>Fecha Emsión</b></label>
					  </div>
					  </div>

					  </div>					  


				    <div class="form-group col-md-3" hidden>
					    <label for="txtmedipago_compra"><b>Medio pago</b></label>
						<select id="txtmedipago_compra" class="form-control custom-select mr-sm-2">
							<option value="EFECTIVO">EFECTIVO</option>
							<option value="DEPOSITO">DEPOSITO</option>					        
					    </select>
				    </div>

				    <div class="form-group col-md-3" hidden>
					  <label for="txtmedipago_compra"><b>Forma de Pago</b></label>
						<select id="txtformapago_compra" class="form-control custom-select mr-sm-2">
						<option value="CONTADO">CONTADO</option>
					    <option value="CREDITO">CREDITO</option>
					    </select>
				    </div>
				    

				<hr>
				<div class="row">
			 		<!--div class="form-group col-md-12" id="divbtnvender" style="display: none;"-->
			 		<div class="form-group col-md-12" id="divbtnvender">
					<button type="button" id="btvender"  class="btn btn-outline-dark"><img src='../icon/ventas.png'> Procesar</button>
					<a href="cotizaciones.php" class="btn btn-outline-dark" ><img src='../icon/cancelar2.png'> Cancelar</a>					
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
</div>
<!------------------------------------------------------------------------------------------------->




<!------------------------------------------------------------------------------------------------->
</body>
</html>	

<script type="text/javascript">
function cerrarventananuevo(){
	//alert("entra aqui");

	$("#divcontenedor1").css({'display':'block'});
	$("#divcontenedor2").css({'display':'none'});	
	$("#div_nota_credito").css({'display':'none'});	

	$("#txtnum_proforma_1").val("");
	$("#txtnum_proforma").html("");
	$("#txtidcliente").val("");
	//$("#txtfecharegistro").val("");
	$("#txtestadopago_compra").val("");
	
	

	$("#txtidcliente").val("");
	$("#txtnom_cliente").val("");
	$("#txtnom_cliente_pedido").val("");

	$("#txtruc").val("");					
	$("#txtmoneda").val("");					
	$("#txtformapago_compra").val("");					
	$("#txtmedipago_compra").val("");		
}
$(document).ready(function() {	
	//Verifica_permiso_NC();
	Verifica_permiso();
	
	
	listar();
	periodo();
	traertipocambio();
});


/***************************************************/


function Generar_CodPorforma(){

	var axtipo_cotizacion = $("#txttipo_cotizacion").val();
	var axidlocal= $("#txtidlocal").val();
	var axanoactual= $("#txtanoactual").val();
	

	$.ajax({
	url:"cotizaciones_funciones.php",
	method: "POST",
	data: {	param:35,
			txtidlocal:axidlocal,			
			txttipo_cotizacion:axtipo_cotizacion
			
		},
		success : function(data){
			var num = 'CT-'+data+'-'+axanoactual;
			$("#txtnum_proforma_1").val(data)
			$("#txtnum_proforma_mostrar").val(num)
			
			$("#txtnum_proforma").html('Detalle de Cotización | '+num)
		}
})


}



// Obtén una referencia al elemento de entrada
var input_nombre = document.getElementById("txtbuscar");

// Agrega un event listener para la tecla "Enter"
input_nombre.addEventListener("keydown", function(event) {
  if (event.key === "Enter") {
  	$("#ajaxgif_3").prop('hidden',false)
    // La tecla Enter ha sido presionada, ejecuta tu proceso aquí
    listar()
  }
});


$(document).on("click","#bt_reactivar_pedido",function(){

var axcodmovcz_1 = $(this).data("codprof");
	var axidlocal_1 = $("#txtidlocal").val();
	var axestadoelectro=$(this).data("estado");

	$("#txtcodmovprof").val(axcodmovcz_1);
	$("#txtidlocal").val(axidlocal_1);

  var axcodproformacz =  $("#txtcodmovprof").val();
	var axidlocal =  $("#txtidlocal").val();
	/************************/

		Swal.fire({

	 	title: 'Estas seguro?',
		  text: "¡Reactivar Cotización",
		  icon: 'question',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: '¡Sí, Reactivar!'

	}).then((result) => {
	  if (result.isConfirmed) {

	  		$.ajax({
				url:"cotizaciones_funciones.php",
				method: "POST",
				data: {param:34,txtcodmovprof:axcodproformacz,txtidlocal:axidlocal},

				success : function(data){

					if(data==0){
						Swal.fire("Aviso", "Cotización fue Reactivada", "success");
						listar()
					}else{
						Swal.fire("Aviso", "Cotización no puede ser Reactivada", "error");
					}

				}
		})



	  }
	})



	/****************************/


})

function milliseconds(x) {
  if (isNaN(x)) {
    return 'Not a Number!';
  }
  return x * 1000;
}

$(document).on("change","#txtconceptos",function(){
	listar_reporte();
})




$(document).on("change","#txtreportes",function(){

var axtipo_reporte = $("#txtreportes").val();
var axidlocal= $("#txtidlocal").val();
var axdel = $("#txtfecha_del").val();
var axal = $("#txtfecha_al").val();

if(axtipo_reporte=='TODOS'){

	$("#divconceptos").css({'display':'none'});
	listar_reporte();

}else if(axtipo_reporte=="SEGUN CONCEPTO") {

	$("#divconceptos").css({'display':'block'});
	 $.ajax({
      url:"cotizaciones_funciones.php",
      method: "POST",
      data: {param:27,
      
      	txtidlocal:axidlocal,
      	txtfecha_del:axdel,
		txtfecha_al:axal

      },
      success : function(data){

    	$('#txtconceptos').html(data);    	

      }
   	});
} else{
	$("#divconceptos").css({'display':'none'});

}





})


$(document).on("blur","#axcant_modificar",function(){


var cod_mov_pf = $(this).data("id");
var id_insumo = $(this).data("idinsumo");

var cant_nueva=$(this).text();
var axidlocal = $("#txtidlocal").val();
var axporc_igv = $("#txtporc_igv").val();

if(isNaN(cant_nueva)){

	//alert("No es numero..");
	Swal.fire('Advertencia!','No es número el precio ingresado!','error')
}else{

$.ajax({
	url:"cotizaciones_funciones.php",
	method: "POST",
	data: {	param:24,
			cod_mov_pf:cod_mov_pf,
			id_insumo:id_insumo,
			cant_nueva:cant_nueva,
			txtidlocal:axidlocal,
			txtporc_igv:axporc_igv
		},
		success : function(data){
			$("#divproforma").html(data);
		}
})

}


})

function listar_reporte(){

		var axidempresa = $("#txtidempresa").val();	
		var axidlocal= $("#txtidlocal").val();	
		var axdel = $("#txtfecha_del").val();	
		var axal= $("#txtfecha_al").val();	
		var axtipo_reporte = $("#txtreportes").val();	
		//var axconcepto = $("#txtconceptos").val();	
		var axconcepto=($("#txtconceptos option:selected").text());

		$.ajax({

			url:"cotizaciones_funciones.php",
			method: "POST",
			data: {param:26,txtidempresa:axidempresa,txtfecha_del:axdel,txtidlocal:axidlocal,txtfecha_al:axal,txtreportes:axtipo_reporte,axconcepto:axconcepto},
				success : function(listar){
				$("#lista1").html(listar);
			}
		})
	}


function listar(){

		
		var axidlocal= $("#txtidlocal").val();	
		var axbuscar = $("#txtbuscar").val();			
		var axiduser= $("#txtid_usuario").val();	
		var axfecharegistro= $("#txtfecharegistro").val();	
		var axfiltro_busca_fecha= $("#txtfiltro_busca_fecha").val();	
		var axtipo_cotizacion= $("#txttipo_cotizacion").val();	
		var axanoactual = $("#txtanoactual").val()

		$("#ajaxgif_3").prop('hidden',false)

		$.ajax({

			url:"cotizaciones_funciones.php",
			method: "POST",
			data: {param:0,
				txtbuscar:axbuscar,
				txtidlocal:axidlocal,
				txtid_usuario:axiduser,
				txtfecharegistro:axfecharegistro,
				txtfiltro_busca_fecha:axfiltro_busca_fecha,
				txttipo_cotizacion:axtipo_cotizacion,
				txtanoactual:axanoactual
			},
				
				success : function(listar){

					$("#lista1").html(listar);
					$("#ajaxgif_3").prop('hidden',true)
			}
		})
	}


function Verifica_permiso_NC(){

var axiduser =$("#txtid_usuario").val();
var axpermiso ="NOTAS DE CREDITO";

$.ajax({
	url:"cotizaciones_funciones.php",
	method: "POST",
	data: {param:1,txtid_usuario:axiduser,axpermiso:axpermiso},
	success : function(permiso){
		if (permiso==1){

			$("#txtpermiso_nc").val("NO");
		} 
	}
	})

}

function Verifica_permiso(){

var axiduser =$("#txtid_usuario").val();
var axpermiso ="COTIZACIONES";

$.ajax({
	url:"cotizaciones_funciones.php",
	method: "POST",
	data: {param:1,txtid_usuario:axiduser,axpermiso:axpermiso},
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




function listarStock(){

	var axidempresa = $("#txtidempresa").val();	
	var axidlocal= $("#txtidlocal").val();	
	var axbuscar = $("#txtbuscararticulo").val();	
	var axtipo_cotizacion = $("#txttipo_cotizacion").val();

	$.ajax({

		url:"cotizaciones_funciones.php",
		method: "POST",
		data: {param:2,txtidempresa:axidempresa,txtbuscararticulo:axbuscar,txtidlocal:axidlocal,txttipo_cotizacion:axtipo_cotizacion},
			success : function(listar){
				$("#divgrillaStock").html(listar);
			}
		})


}

function tipo_documento(){

	var axidlocal = $("#txtidlocal").val();
	//var axpermiso_nc = $("#txtpermiso_nc").val();

	//if(axpermiso_nc=="SI"){
	
		$.ajax({
			url:"cotizaciones_funciones.php",
			method: "POST",
			data: {param:3,txtidlocal:axidlocal},
			success : function(listar){
				$("#txttipodoc").html(listar);
				//nun_serie();
			}
		})
	

}


function nun_serie(){

	var axtipodoc = $("#txttipodoc").val();
	var axidlocal = $("#txtidlocal").val();

	$.ajax({

		url:"cotizaciones_funciones.php",
		method: "POST",
		data: {param:4,txttipodoc:axtipodoc,txtidlocal:axidlocal},
			success : function(listarseries){
				$("#txtnserie").html(listarseries);
				correlativos();
				
			}
		})

}

function correlativos(){

	var axnserie = $("#txtnserie").val();
	var axidlocal = $("#txtidlocal").val();
	var axdocumento_tipo = ($("#txttipodoc option:selected").text());

		$.ajax({
			url:"cotizaciones_funciones.php",
			method: "POST",
			data: {param:5,txtnserie:axnserie,txtidlocal:axidlocal},
			success : function(traecorrelativo){
			var json = JSON.parse(traecorrelativo);

				if (json.status == 200){
					var axparamentro = $("#txtparametros").val();
					if (axparamentro==1){
						var axcod = json.N_CORRELATIVO;
						var axcod1 = parseInt(axcod)+1;
						//$("#txtcorrelativo").val(axcod1);
						$("#txtcorrelativo").val(zeros(axcod1,8));
						$("#txtcorrelativo_mostrar").val(zeros(axcod1,8));
						
						var axnum_correlativo = $("#txtcorrelativo").val();

					} else {

						$("#txtcorrelativo").val(json.N_CORRELATIVO);
						var axnum_correlativo = $("#txtcorrelativo").val();

					}
				}	

				//alert(axnserie)

				if(axnserie != null){

					$.ajax({
			
					url:"cotizaciones_funciones.php",
					method: "POST",
					data: {param:28,txtnserie:axnserie,txtidlocal:axidlocal,txtcorrelativo:axnum_correlativo,axdocumento_tipo:axdocumento_tipo},
					success : function(data){
						if (data==0) {
							document.getElementById('txttipodoc').focus();
							$("#divbtnvender").css({'display':'none'});
							Swal.fire('Advertencia!','DOCUMENTO YA EXISTE...','info')
						}
														
					}
				})

				}

				

			}
		})

}

function traer_cta(){

var axidlocal = $("#txtidlocal").val();
var axmoneda = $("#txtmoneda").val();

	$.ajax({

		url:"cotizaciones_funciones.php",
		method: "POST",
		data: {param:6,txtidlocal:axidlocal,txtmoneda:axmoneda},
			success : function(listarctas){
				$("#txtnuncta_compra").html(listarctas);

				Num_Registro_Contable();
			}
		})


}

$('#txtnom_cliente').keyup(function(){

  var axbuscarcliente = $("#txtnom_cliente").val();
  var axidbeneficiario1 = $(this).data("idbenef");
  $("#txtidbeneficiario").val(axidbeneficiario1);
  var axtipo_cotizacion = $("#txttipo_cotizacion").val();


  if (axbuscarcliente != '') {

    $.ajax({
      url:"cotizaciones_funciones.php",
      method: "POST",
      data: {param:7,
      	txtnom_cliente:axbuscarcliente,
      	txttipo_cotizacion:axtipo_cotizacion
      },
      success : function(data){

        $('#listarclientes').fadeIn();
        $('#listarclientes').html(data);
        
      }
    });
  } 
});


$(document).on("click","#linuevoregistro",function(){

	var axnombenefi = $("#txtnom_cliente").val();
	$("#txtnom_cliente").val(axnombenefi);
	$("#linuevoregistro").fadeOut();
})



$(document).on("click","#libeneficiarios",function(){
 
  	$("#txtnom_cliente").val($(this).text());
  	var axidbeneficiario1 = $(this).data("idbenef");
  	$("#txtidcliente").val(axidbeneficiario1);
		$("#txtnom_cliente_pedido").val($(this).text());
  	

  	var axidcliente = $("#txtidcliente").val();
 	
 	 $.ajax({

      url:"cotizaciones_funciones.php",
      method: "POST",
      data: {param:8,txtidcliente:axidcliente},
      success : function(Traedatos){

      	var json = JSON.parse(Traedatos);
		console.log(json);
			if (json.status == 200){				
				$("#txtidcliente").val(json.ID_BENEFICIARIO);
				$("#txtnom_cliente").val(json.RAZON_SOCIAL);
				$("#txtruc").val(json.RUC_BENEF);
			//	$("#txtnum_proforma_1").val(json.CODIGO);				
				//$("#txttipocliente").val(json.CONDICION_B);
				//document.getElementById('btdetallar').focus();
			}
        
        }
    });
  	$("#listarclientes").fadeOut();

});


$(document).on("click","#btagregarproforma",function(){

	var axidinsumo1 = $(this).data("idinsumo");
	var axprecio = $(this).data("precio");

	tipo_documento();
	traer_cta();

	$("#divlsitavender").css({'display':'block'});

	var axtipo_cotizacion = $("#txttipo_cotizacion").val();

	
	$("#txtprecio_venta").val(axprecio);
	$("#txtidinsumo").val(axidinsumo1);
	$("#txtprecio_compra").val(axprecio);

	var axidinsumo = $("#txtidinsumo").val();

	var axobservacion = $("#txtobservacion").val();
	var axiduser = $("#txtid_usuario").val();
	var axfechaactual = $("#txtfecharegistro").val();
	var axidlocal = $("#txtidlocal").val();
	var axcantidad = $("#txtcant_venta").val();

	var axhoraemision = $("#txthoraemision").val();
	
	var axcodproformacz = $("#txtcodmovprof").val();					
	var axprecio_venta = $("#txtprecio_venta").val();
	var axprecio_compra = $("#txtprecio_compra").val();

	
	if(axtipo_cotizacion=='PROVEEDOR'){

		var axvalor_venta = ($("#txtcant_venta").val()*axprecio_compra)/1.18;
		var axigv_venta = (axvalor_venta*0.18);
		var axgravada = axvalor_venta;
		var axexonerada = 0;
		var axinafecta=0;
		var axtotalventa = axvalor_venta+axigv_venta;
		var axventas_grabadas =axvalor_venta+axigv_venta;

		//console.log(axvalor_venta+' '+axigv_venta)

	}else{

		var axvalor_venta = ($("#txtcant_venta").val()*axprecio_venta)/1.18;
		var axigv_venta = (axvalor_venta*0.18);
		var axgravada = axvalor_venta;
		var axexonerada = 0;
		var axinafecta=0;
		var axtotalventa = axvalor_venta+axigv_venta;
		var axventas_grabadas =axvalor_venta+axigv_venta;

	}

	$("#txtdscto_Venta").val(0);
	$("#txtvalor_venta").val(axvalor_venta);
	$("#txtigv_venta").val(axigv_venta);
	$("#txtgravadas_venta").val(axgravada);
	$("#txtinafectas_venta").val(axinafecta);
	$("#txtexonerada_venta").val(axexonerada);
	$("#txttotal_venta").val(axtotalventa);



var axdscto = $("#txtdscto_Venta").val();
	var axvalor_venta = $("#txtvalor_venta").val();
	var axigv_venta = $("#txtigv_venta").val();
	var axgravada = $("#txtgravadas_venta").val();
	var axinafecta = $("#txtinafectas_venta").val();
	var axexonerada = $("#txtexonerada_venta").val();
	var axtotalventa = $("#txttotal_venta").val();

	
	$.ajax({
			url:"cotizaciones_funciones.php",
			method: "POST",
			data: {param:10,
				txtcodmovprof:axcodproformacz,
				txtidinsumo:axidinsumo,
				txtcant_venta:axcantidad,
				txtprecio_venta:axprecio_venta,
				txtprecio_compra:customParseFloat(axprecio_compra),
				txtdscto_Venta:customParseFloat(axdscto),
				txtvalor_venta:customParseFloat(axvalor_venta),
				txtigv_venta:customParseFloat(axigv_venta),
				txtgravadas_venta:customParseFloat(axgravada),
				txtinafectas_venta:customParseFloat(axinafecta),
				txtexonerada_venta:customParseFloat(axexonerada),
				txttotal_venta:customParseFloat(axtotalventa),
				txtobservacion:axobservacion,
				txtidlocal:axidlocal,								
				txtid_usuario:axiduser,
				txtfecharegistro:axfechaactual,
				txthoraemision:axhoraemision,
				txttipo_cotizacion:axtipo_cotizacion
			},
					success : function(grabar_prof){
						//console.log(grabar_prof);
						$("#divproforma").html(grabar_prof);
						$("#txtcod_barra").val('');
						$("#txtbuscararticulo").val('');
						$("#txtcant_venta").val(1);
						listarStock()
					}

	})
	
})

function agregar_a_proforma() {
	
	tipo_documento();
	traer_cta();

	$("#divlsitavender").css({'display':'block'});

	var axidlocal= $("#txtidlocal").val();	

	var axidinsumo = $("#txtidinsumo").val();
	

	//alert(axidinsumo);
	
	$.ajax({

		url:"cotizaciones_funciones.php",
		method: "POST",
		data: {param:9,txtidlocal:axidlocal,txtidinsumo:axidinsumo},
			success : function(traer_insumos){
				//console.log(traer_insumos);
			var json = JSON.parse(traer_insumos);
				if (json.status == 200){
					
					$("#txttipocondicion").val(json.TIPO_CONDICION);
					//$("#txtprecio_venta").val(json.PRECIO_V);
					$("#txtprecio_compra").val(json.PRECIO_C);
					var axtipocondicion= $("#txttipocondicion").val();
					var axprecio_con_igv= $("#txtprecio_venta").val();
					var axporc_igv = $("#txtporc_igv").val();

					//var axstock_actual = json.STOCK;
					var axcantidad =$("#txtcant_venta").val();
					var axstock_actual = axcantidad;

					var axcodproformacz = $("#txtcodmovprof").val();					
					var axprecio_venta = $("#txtprecio_venta").val();
					var axprecio_compra = $("#txtprecio_compra").val();
					var axdscto = $("#txtdscto_Venta").val();
					var axvalor_venta = $("#txtvalor_venta").val();
					var axigv_venta = $("#txtigv_venta").val();
					var axgravada = $("#txtgravadas_venta").val();
					var axinafecta = $("#txtinafectas_venta").val();
					var axexonerada = $("#txtexonerada_venta").val();
					var axtotalventa = $("#txttotal_venta").val();

					
					
			
						
						axtipocondicion='GRAVADA';
						//alert(axtipocondicion);

						if (axtipocondicion=='GRAVADA') {

							var axprecio_sin_igv = (axprecio_con_igv/(1+axporc_igv));
							var axvalor_venta = $("#txtcant_venta").val()*axprecio_sin_igv;
							var axigv_venta = axvalor_venta*axporc_igv;
							var axgravada = axvalor_venta;
							var axexonerada = 0;
							var axinafecta=0;
							var axtotalventa = axvalor_venta+axigv_venta;
							var axventas_grabadas =axvalor_venta+axigv_venta;

						} else if (axtipocondicion=='EXONERADA') {

							var axprecio_sin_igv = (axprecio_con_igv/(1+axporc_igv));
							var axvalor_venta = $("#txtcant_venta").val()*axprecio_sin_igv;
							var axigv_venta = axvalor_venta*axporc_igv;
							var axgravada = 0;
							var axexonerada = axvalor_venta;
							var axinafecta=0;
							var axtotalventa = axvalor_venta+axigv_venta;
							var axventas_exonerada =axvalor_venta+axigv_venta;
						
						} else if (axtipocondicion=='INAFECTO') {

							var axprecio_sin_igv = axprecio_venta;
							var axvalor_venta = $("#txtcant_venta").val()*axprecio_sin_igv;
							var axigv_venta = 0;
							var axgravada = 0;
							var axexonerada = 0;
							var axinafecta= axvalor_venta;
							var axtotalventa = axvalor_venta+axigv_venta;
							var axventas_inafecta = axvalor_venta+axigv_venta;
							
						}

						
						$.ajax({

							url:"cotizaciones_funciones.php",
							method: "POST",
							data: {param:10,
								txtcodmovprof:axcodproformacz,
								txtidinsumo:axidinsumo,
								txtcant_venta:axcantidad,
								txtprecio_venta:axprecio_venta,
								txtprecio_compra:customParseFloat(axprecio_compra),
								txtdscto_Venta:customParseFloat(axdscto),
								txtvalor_venta:customParseFloat(axvalor_venta),
								txtigv_venta:customParseFloat(axigv_venta),
								txtgravadas_venta:customParseFloat(axgravada),
								txtinafectas_venta:customParseFloat(axinafecta),
								txtexonerada_venta:customParseFloat(axexonerada),
								txttotal_venta:customParseFloat(axtotalventa),
								axventas_grabadas:customParseFloat(axventas_grabadas),
								axventas_exonerada:customParseFloat(axventas_exonerada),
								axventas_inafecta:customParseFloat(axventas_inafecta),
								txtobservacion:axobservacion,
								txtidlocal:axidlocal,								
								txtid_usuario:axiduser,
								txtfecharegistro:axfechaactual,
								txthoraemision:axhoraemision,
								txttipo_cotizacion:axtipo_cotizacion

								},
								
								success : function(grabar_prof){
									//console.log(grabar_prof);
									$("#divproforma").html(grabar_prof);
									$("#txtcod_barra").val('');
									$("#txtbuscararticulo").val('');
									$("#txtcant_venta").val(1);
									//listarStock()

								}

						})

				

					
				}	
				
			}
		})

	
}






//$(document).on("change","#txtcod_barra",function(){
$('#txtcod_barra').change(function(){
	
	var ncaracteres = $("#txtcod_barra").val();
	var ncaracteres1 = ncaracteres.length; 

	if (ncaracteres1 < 15) {

		//alert(ncaracteres)

		var axcod_barra = $("#txtcod_barra").val()
		var axidlocal = $("#txtidlocal").val()

		$.ajax({

      	url:"cotizaciones_funciones.php",
      	method: "POST",
      	data: {param:30,txtidlocal:axidlocal,txtcod_barra:axcod_barra},

      		success : function(data){        
			var json = JSON.parse(data);

				if (json.status == 200){
					
					$("#txtidinsumo").val(json.ID_INSUMO);
					agregar_a_proforma()

				}

				else{

					Swal.fire(
					    'Advertencia!',
					    'Stock insufiente...!',
					    'info'
					)

				} 
			}
    	});		
		
	}
	
})



$(document).on("click","#btquitaritemproforma",function(){

	var axidinsumo = $(this).data("idinsumo");
	var axcodmov = $(this).data("codmov");
	//alert(axcodmov+ '|'+ axidinsumo);

	$.ajax({
      url:"cotizaciones_funciones.php",
      method: "POST",
      data: {param:11,axidinsumo:axidinsumo,axcodmov:axcodmov},
      success : function(borrar_item){

      	if (borrar_item==0){

      		listar_item_proforma();

      	} else {

      		Swal.fire(
			'Advertencia!',
			'No se elimino el registro',
			'error'
	)

      	}
        
        
      }
    });



})

function listar_item_proforma(){

	var axcodproformacz = $("#txtcodmovprof").val();

	$.ajax({
      url:"cotizaciones_funciones.php",
      method: "POST",
      data: {param:12,txtcodmovprof:axcodproformacz},

      success : function(listar){
      	$("#divproforma").html(listar);
      }

    });


}

$(document).on("change","#txtnum_serie_ref",function(){
	traer_serie_referencia();	
})

function customParseFloat(str) {
  // Verificar si la cadena está vacía
  if (str === '') {
    return 0;  // Devolver 0 en lugar de NaN
  }

  // Intentar convertir la cadena a un número de punto flotante
  var resultado = parseFloat(str);

  // Verificar si el resultado es NaN
  if (isNaN(resultado)) {
    return 0;  // Devolver 0 en lugar de NaN
  }

  // Devolver el resultado válido
  return resultado;
}

// Ejemplo de uso
var valor = customParseFloat('');  // Devuelve 0 en lugar de NaN
console.log(valor);


function traer_serie_referencia() {

var axserie_doc_ref= $("#txtnum_serie_ref").val();	
var axtipo = axserie_doc_ref.substring(0,1);		
		
if(axtipo =="F"){
	var axcod_cpe_ref ="01";
	
}else if(axtipo=="B") {
	var axcod_cpe_ref ="03";
}

$("#txtcod_cpe_ref").html(axcod_cpe_ref);


}






$(document).on("click","#btvender",function(){

	var axidcliente = $("#txtidcliente").val();
	var axidbeneficiario = $("#txtidcliente").val();
	var axcodusuario = $("#txtid_usuario").val();
	var axfechaemision = $("#txtfecha_emision").val();
	var axidlocal = $("#txtidlocal").val();
	var axmoneda = $("#txtmoneda").val();
	var axtipodoc = $("#txttipodoc").val();
	var axmediopago= $("#txtmedipago_compra").val();
	var axformapago = $("#txtformapago_compra").val();
	var axestadoformapago= $("#txtestadopago_compra").val();
	var axcodproformacz = $("#txtcodmovprof").val();
	var axnom_cliente_pedido= $("#txtnom_cliente_pedido").val()
	//var axnom_cliente_pedido= $("#txtnom_cliente_pedido").val()
	var axparamentro = $("#txtparametros").val()
	var axnum_proforma_1 = $("#txtnum_proforma_1").val()


if(axidcliente==""){

		Swal.fire('Advertencia!','Seleccionar nombre del cliente','info')

}else {
		
		$.ajax({
	      url:"cotizaciones_funciones.php",
	      method: "POST",
	      data: {param:13,

		  	txtidcliente:axidcliente,
				txtidcliente:axidbeneficiario,
				txtid_usuario:axcodusuario,
				txtfecha_emision:axfechaemision,
				txtidlocal:axidlocal,
				txtmoneda:axmoneda,
				txttipodoc:axtipodoc,
				txtmedipago_compra:axmediopago,
				txtformapago_compra:axformapago,
				txtestadopago_compra:axestadoformapago,
				txtcodmovprof:axcodproformacz,
				txtnom_cliente_pedido:axnom_cliente_pedido,
				txtparametros:axparamentro,
				txtnum_proforma_1:axnum_proforma_1

	      },

	      	success : function(grabar_Cabecera){

	      		if(grabar_Cabecera==0){
	      			
	      			reporte_cotizacion();
	      			window.open("cotizaciones.php",'_self');	
	      			/*
	      			$("#divcontenedor1").css({'display':'block'});
							$("#divcontenedor2").css({'display':'none'});	
							$("#div_nota_credito").css({'display':'block'});	
							$("#divlsitavender").css({'display':'block'});	
							*/

							listar()


	      		}else{
	      			
	      			Swal.fire({
								position: 'center',
								type: 'error',
								title: 'No se grabo el registro',
								showConfirmButton: false,
								timer: 1000
								})
	      			}
	      	}

	    })
	    
	   
	}

})


$(document).on("click","#btn_eliminar_cotizacion",function(){

var axid_cotizacion = $(this).data('id')
var axestado = $(this).data('estado')

if(axestado == "PENDIENTE" ){

		Swal.fire({

	 	title: 'Estas seguro?',
		  text: "¡No podrás revertir esto!",
		  icon: 'question',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: '¡Sí, Eliminar!'

	}).then((result) => {
	  if (result.isConfirmed) {

	  	$.ajax({
				url:"cotizaciones_funciones.php",
				method: "POST",
				data: {param:29,axid_cotizacion:axid_cotizacion},
					success : function(data){
						
						if(data==0){

								Swal.fire("Aviso", "Registro eliminado", "success");

								listar()
						}else{

							Swal.fire("Aviso", "No se elimino el registro", "warning");
						}

					}
			})


	  }
	})

	}else{

			Swal.fire("Aviso", "No puede eliminar este PEDIDO", "warning");


	}


})

$(document).on("click","#btn_editar_cotizacion",function(){
	//cargar campos
	
	asql="select * from cotizacion_reporte_cz where ID_COTIZACION_CZ="+$(this).data("id");
	regresamatrizjsonasync(asql,'acotizacion');
	console.log(acotizacion);
	asql="select * from lista_cotizacion_dt where cod_mov_prf='"+acotizacion[0].COD_MOV_PRF+"'";
	regresamatrizjsonasync(asql,'adetcotizacion');
	$("#txtcodmovprof").val(acotizacion[0].COD_MOV_PRF);
	axcodproformacz=acotizacion[0].COD_MOV_PRF;
	console.log(adetcotizacion);
	$("#divcontenedor1").css({'display':'none'});
	$("#divcontenedor2").css({'display':'block'});	
	$("#div_nota_credito").css({'display':'none'});
	
	tipo_documento();
	//document.getElementById('txtperiodocontable').focus();	

	//cargar datos cabecera


	listarStock();

	$.ajax({
      url:"cotizaciones_funciones.php",
      method: "POST",
      data: {param:12,txtcodmovprof:acotizacion[0].COD_MOV_PRF},

      success : function(listar){
      	$("#divproforma").html(listar);
		//$("#txtnum_proforma").html(acotizacion[0].);
		$("#txtnum_proforma").html('Detalle de Cotización | '+acotizacion[0].NUM_COTIZACION)
      }

    });
	$("#divlsitavender").css({'display':'block'});
	//carga datos de la cabecera
	var axparamentro = $("#txtparametros").val();
			$.ajax({
				url:"cotizaciones_funciones.php",
				method: "POST",
				data: {param:32,txtcodmovprof:axcodproformacz,txtparametros:axparamentro},
				success : function(data){
				var json = JSON.parse(data);
					console.log("este es el modificar: ");
					console.log(json);
					if (json.status == 200){

						//txtnom_cliente
						//txtnom_cliente_pedido

						$("#txtnum_proforma_1").val(json.NUM_COTIZACION);
						$("#txtnum_proforma").html(json.COD_MOV_PRF);
						$("#txtidcliente").val(json.ID_BENEFICIARIO);
						$("#txtfecharegistro").val(json.FECHA_PEDIDO);
						$("#txtestadopago_compra").val(json.ESTADO_COTIZACION);
						
						

						$("#txtidcliente").val(json.ID_BENEFICIARIO);
						$("#txtnom_cliente").val(json.RAZON_SOCIAL);
						$("#txtnom_cliente_pedido").val(json.NOM_CLIENTE_PROF);

						$("#txtruc").val(json.RUC_BENEF);					
						$("#txtmoneda").val(json.MONEDA);					
						$("#txtformapago_compra").val(json.FORMA_PAGO);					
						$("#txtmedipago_compra").val(json.MEDIO_PAGO);					
						console.log("el id dt es:"+json.ID_DT);
						$("#txttipodoc").val(json.ID_DT);					
						//$("#txtdiaspago_compra").val(json.DIAS_CREDITO);				
						$("#txtestadopago_compra").val(json.ESTADO_COTIZACION);
						
						$("#divbtnvender").css({'display':'block'});

					}
				
					

				}
		})
	



});


function traertipocambio(){

	var axfechapago = $("#txtfechaoperacion").val();

	$.ajax({
		url:"cotizaciones_funciones.php",
		method: "POST",
		data: {param:14,txtfechaoperacion:axfechapago},
		success : function(permiso){

			var json = JSON.parse(permiso);
			if (json.status == 200){
				
				$("#txttipocambio").val(json.TC_VENTA);

			} else {

				$("#txttipocambio").val(0);
				
			/*
				Swal.fire({
				  title: 'Advertencia',
				  text: "Falta tipo de cambio en esta fecha",
				  type: 'warning',
				  showCancelButton: false,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Ingresar Tipo Cambio'
				}).then((result) => {
				 	$("#txttipocambio").val(0);
				})
			*/

			}

		}
	})


}



function Num_Registro_Contable(){
/*
//var axnumcuenta=($("#txtnuncta_compra option:selected").text());
var axnumcuenta= $("#txtnuncta_compra").val();//var axnumcuenta=($("#txtnuncta_compra option:selected").text());
	
$.ajax({

	url:"cotizaciones_funciones.php",
	method: "POST",
	data: {param:15,txtnuncta_compra:axnumcuenta},	
	success : function(traerregistro){
	var json = JSON.parse(traerregistro);
		if (json.status == 200){			

			var axnumregistro = json.CORR_CONTABLE;
			var axnumregistro1 =parseInt(axnumregistro)+1;
			var axnumregistro2 =zeros(axnumregistro1,5);
			$("#txtnumregistroParamentro").val(axnumregistro1);
			$("#txtnumregistrocontable").val(axnumregistro2);	
			
						

			}
		}
	})
	*/
}



function procesar_comprobante(){

	var axcodmovcz = $("#txtcodmovcz").val();
	var axidlocal =$("#txtidlocal").val();
	var LblNombreArchivo ="";
	//alert(axcodmovcz+'|'+axestadocierre);
	$.ajax({
		url:"cotizaciones_funciones.php",
		method: "POST",
		data: {param:17,LblNombreArchivo:LblNombreArchivo,txtcodmovcz:axcodmovcz},
		success : function(procesarsunat){

			if(procesarsunat==0){

				Swal.fire({
				position: 'top-end',
				type: 'success',
				title: 'Comprobante procesado',
				showConfirmButton: false,
				timer: 1500
				})

				//Reporte_Comprobante();
				//window.open("ventas.php",'_self');

			} 
		}
	})

}


function procesar_comprobante_json(){

	//var axcodmovcz = $(this).data("codmovimprimir");
	var axcodmovcz = $("#txtcodmovcz").val();;
	var axidlocal = $("#txtidlocal").val();
	var axruc_empresa= $("#txtrucempresa").val();
	var axtipodoc= $("#txttipodoc").val();
	var axnserie= $("#txtnserie").val();
	var axcod= $("#txtcorrelativo").val();
	var axcorrelativo = zeros(axcod,8);
	var axruta = $("#txtruta").val();
	var axobservado = $("#txtobservado").val();
	var axdocumento_tipo = ($("#txttipodoc option:selected").text());
	var axruta_api_1 = $("#txtruta_ap").val();
	var axtoken = $("#txttoken").val();
	var axruta_proc= $("#txtruta_proc").val();

	
	$.ajax({
			url:"cotizaciones_funciones.php",
			method: "POST",
			data: {param:19,txtcodmovcz:axcodmovcz,txtidlocal:axidlocal,axdocumento_tipo:axdocumento_tipo,txtruta:axruta,txtobservado:axobservado,txtruta_ap:axruta_api_1,txttoken:axtoken,txtruta_proc:axruta_proc},
			success : function(archivoJson){

				Swal.fire({
				position: 'top-end',
				type: 'success',
				title: 'Comprobante procesado',
				showConfirmButton: false,
				timer: 1500
				})

				
				Reporte_Comprobante();
				window.open("ventas.php",'_self');
			

			}
	})


}

$(document).on("click","#btanular_comprobante",function(){

	var axcodmovcz= $("#txtcodmovcz").val();
	var axidlocal= $("#txtidlocal").val();
	var axfecha_anulado = $("#txtfecha_anulacion").val();
	var axestado_comprobante= $("#txtestado_comprobante").val();
	var axestado_comprobante_1= $("#txtestado_comprobante_1").val();
	var axmotivo_anulacion= $("#txtmotivo_baja").val();

	//alert(axestado_comprobante_1);

	if(axestado_comprobante_1=="ANULADA"){

		//window.open("ventas.php",'_self');


			Swal.fire({
			  title: 'Advertencia',
			  text: "El comprobante ya se encuentra anulado",
			  type: 'warning',
			  showCancelButton: false,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Retornar!'
			}).then((result) => {
			 	  window.location="ventas.php";
			 	  //listar();
			})


	} else {

		$.ajax({
			url:"cotizaciones_funciones.php",
			method: "POST",
			data: {param:20,
			
				txtcodmovcz:axcodmovcz,
				txtidlocal:axidlocal,
				txtfecha_anulacion:axfecha_anulado,
				txtestado_comprobante:axestado_comprobante,
				txtmotivo_baja:axmotivo_anulacion
			},
			success : function(jsonbaja){

				if(jsonbaja==0){

					Swal.fire({
					  title: 'Comprobante ANULADO',
					  text: "El comprobante se anulo correctamente",
					  type: 'success',
					  showCancelButton: false,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'Cerrar!'
					}).then((result) => {

						  json_baja();
						  //listar();
					 	  window.location="ventas.php";
					 	  
					})



				} else{

					Swal.fire({
					  title: 'Advertencia',
					  text: "Error en el proceso",
					  type: 'error',
					  showCancelButton: false,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'Cerrar!'
					}).then((result) => {
					 	  window.location="ventas.php";
					 	  //listar();
					})


				}

				
			

			}
	})


	}


})


function json_baja() {


	
	var axcodmovcz = $("#txtcodmovcz").val();;
	var axidlocal = $("#txtidlocal").val();
	var axruta = $("#txtruta").val();
	
	//Ruc-TipDoc-Serie-Correlativo-C.json
	//20565282965-01-F001-00000001-C.json

	//var LblNombreArchivo =axruc_empresa+'-'+axtipodoc+'-'+axnserie+'-'+axcorrelativo+'-C.json';
	//alert(LblNombreArchivo);
	
	$.ajax({
			url:"cotizaciones_funciones.php",
			method: "POST",
			data: {param:21,txtcodmovcz:axcodmovcz,txtidlocal:axidlocal,txtruta:axruta},
			success : function(archivoJson){

				
			}
	})
}


$(document).on("change","#txttipodoc_nc",function(){
	nun_serie_nc()	
})

$(document).on("click","#btanular",function(){
	
	var axcodmovcz = $(this).data("codmovcz");
	var axestado_comprobante= $(this).data("estadocierre");

	$("#txtcodmovcz").val(axcodmovcz);
	$("#txtestado_comprobante_1").val(axestado_comprobante);

	//alert(axcodmovcz+'|'+axestado_comprobante);

})

$(document).on("click","#btsunat",function(){	


	var axfechaactual = $("#txtfecharegistro").val();
	var axidlocal = $("#txtidlocal").val();
	var axruta= $("#txtruta").val();
	
	var axruta_exc= $("#txtruta_exc").val();
	var axruta_obs= $("#txtruta_obs").val();
	var axruta_proc= $("#txtruta_proc").val();


	
	$.ajax({
			url:"cotizaciones_funciones.php",
			method: "POST",
			data: {param:22,
					txtfecharegistro:axfechaactual,
					txtidlocal:axidlocal,
					txtruta:axruta,
					txtruta_exc:axruta_exc,
					txtruta_obs:axruta_obs,
					txtruta_proc:axruta_proc
					
				},
			success : function(estado_sunat){

				$("#divdetalle_sunat").html(estado_sunat);
				

			}
	})

})

$(document).on("click","#btgrabar",function(){

	var axidbeneficiario = $("#txtidbeneficiario").val();
	var axtipobenef = "CLIENTE";
	var axcalificacion = $("#txtcalificar").val();
	var axiddoc = $("#txttipodoc_cliente").val();
	var axruc = $("#txtruc_cliente").val();	
	var axnombenefi = $("#txtnombeneficiario").val();
	var axdirbenefi = $("#txtdireccion_cliente").val();
	var axurbaniz = $("#txturbanizacion").val();
	var axidubigeo = $("#txtidubigeo").val();
	var axtelefbenefi = $("#txttelefonos").val();
	var axemailbenefi = $("#txtemail").val();
	var axparamentro = $("#txtparametros").val();

$.ajax({

	url:"cotizaciones_funciones.php",
	method: "POST",
	data: {param:23,

		txtidbeneficiario:axidbeneficiario,
		txttipobeneficiario:axtipobenef,
		txtcalificar:axcalificacion,
		txttipodoc_cliente:axiddoc,
		txtruc_cliente:axruc,
		txtnombeneficiario:axnombenefi,
		txtdireccion_cliente:axdirbenefi,
		txtidubigeo:axidubigeo,
		txttelefonos:axtelefbenefi,
		txtemail:axemailbenefi,
		txtparametros:axparamentro,
		txturbanizacion:axurbaniz
	},
	
	success : function(grabar){
		if(grabar==0){
			//listar();
      	} else {
			swal("Aviso", "No se grabo el registro...", "warning");
		}
	}
})


})

$(document).on("change","#txtruc_cliente",function(){

	var ruc = $("#txtruc_cliente").val();
	var contar = ruc.length;
	//alert(contar);
	if(contar==8 || contar==11){	
		$("#ajaxgif_1").css({'display':'block'});
		    $.ajax({
		      //url:"sunat.php",
		      url:"cotizaciones_funciones.php",
		      method: "POST",
		      data: {param:25,txtruc_cliente:ruc},
		      success : function(datos_ruc){
		      	
		      	$("#ajaxgif_1").css({'display':'none'});
		      	//$('.ajaxgif').addClass('hide');

     			var datos = eval(datos_ruc);
     			var nda = 'nada';
     			if(datos[0]==nda) {

     				//alert("RUC NO EXISTE EN SUNAT");
     				Swal.fire("Aviso", "El Número de RUC NO EXISTE EN SUNAT...", "warning");

     				$("#txtnombeneficiario").val("");
     				$("#txtdireccion_cliente").val("");

     			}else{

     				$("#txtnombeneficiario").val(datos[1]);
     				$("#txtdireccion_cliente").val(datos[2]);
     			}
		      	
		     }
		  });
		    return false;

		}else{
			Swal.fire("Aviso", "Ingrese el número de documento..", "warning");

		}

})






	




$(document).on("change","#txtfechaoperacion",function(){
	
	periodo_tranferencia();
	//alert("entreee")

})

function periodo_tranferencia() {

	var axfechabono = $("#txtfechaoperacion").val();
    var axmes = axfechabono.substr(0,4);
    var axano = axfechabono.substr(5,2);
    var axperiodo = axano + "-" +axmes;
    
    $("#txtperiodotranf").val(axperiodo);

  //  alert(axperiodo);
}




function periodo(){

	var axfechabono = $("#txtfecharegistro").val();
    var axmes = axfechabono.substr(0,4);
    var axano = axfechabono.substr(5,2);
    var axperiodo = axano + "-" +axmes;
    $("#txtperiodo").val(axperiodo);
    $("#txtanoactual").val(axmes);	
    $("#txtperiodocontable").val(axperiodo);

}



$(document).on("click","#btenviar_itc",function(){

	var axcodmovcz = $(this).data("codmovimprimir");
	var axidlocal = $("#txtidlocal").val();
	var axestadoelectro=$(this).data("estado");
	var axnom_archivo =$(this).data('nomarchivo');

	$("#txtobservado").val('OBSERVADO');
	$("#txtcodmovcz").val(axcodmovcz);
	
	//alert(axestadoelectro+'|'+axcodmovcz);

	if(axestadoelectro == "PENDIENTE" || axnom_archivo=="" ){
			
			procesar_comprobante_json()

	}else{

		Swal.fire({
				position: 'center',
				type: 'warning',
				title: 'El comprobante no pude ser reenviado...',
				showConfirmButton: false,
				timer: 1500
			})

	}
})


$(document).on("click","#bt_activar_pedido",function(){

	var axcodmovcz_1 = $(this).data("codprof");
	var axidlocal_1 = $("#txtidlocal").val();
	var axestadoelectro=$(this).data("estado");

	$("#txtcodmovprof").val(axcodmovcz_1);
	$("#txtidlocal").val(axidlocal_1);

  var axcodproformacz =  $("#txtcodmovprof").val();
	var axidlocal =  $("#txtidlocal").val();
	/************************/

		Swal.fire({

	 	title: 'Estas seguro?',
		  text: "¡Convertir este Cotización a Pedido!",
		  icon: 'question',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: '¡Sí, Atender!'

	}).then((result) => {
	  if (result.isConfirmed) {

	  		$.ajax({
				url:"cotizaciones_funciones.php",
				method: "POST",
				data: {param:33,txtcodmovprof:axcodproformacz,txtidlocal:axidlocal},

				success : function(data){

					if(data==0){
						Swal.fire("Aviso", "Cotización puede ser Atendido", "success");
						listar()
					}else{
						Swal.fire("Aviso", "Cotización no puede ser Atendido", "error");
					}

				}
		})



	  }
	})



	/****************************/
})

function imprimir_cotizacion(id_cotizacion){
	asql="select * from cotizacion_reporte_cz where ID_COTIZACION_CZ="+id_cotizacion;
	regresamatrizjsonasync(asql,'acotizacion');
	console.log(acotizacion);
	window.open("cotizacion_reporte.php?local="+acotizacion[0].ID_LOCAL+"&id="+acotizacion[0].COD_MOV_PRF);
}
function reporte_cotizacion(){

	var axcodproformacz =  $("#txtcodmovprof").val();
	var axidlocal =  $("#txtidlocal").val();

	window.open("cotizacion_reporte.php?local="+axidlocal+"&id="+axcodproformacz);
}


$(document).on("click","#bt_imprimir_pedido",function(){

	var axcodmovcz_1 = $(this).data("codprof");
	var axidlocal_1 = $("#txtidlocal").val();
	
	$("#txtcodmovprof").val(axcodmovcz_1);
	$("#txtidlocal").val(axidlocal_1);

  var axcodproformacz =  $("#txtcodmovprof").val();
	var axidlocal =  $("#txtidlocal").val();

	window.open("cotizacion_reporte.php?local="+axidlocal+"&id="+axcodproformacz);


})



$(document).on("click","#bt_editar_pedido",function(){
	console.log("entra aqui: 2");
	var axcodmovcz_1 = $(this).data("codprof");
	var axidlocal_1 = $("#txtidlocal").val();
	var axestadoelectro=$(this).data("estado");

	var axfecharegistro = $("#txtfecharegistro").val();
	var axhoraemision1 = $("#reloj").val();
	$("#txthoraemision").val(axhoraemision1);

	$("#txtcodmovprof").val(axcodmovcz_1);
	$("#txtidlocal").val(axidlocal_1);

  var axcodproformacz =  $("#txtcodmovprof").val();
	var axidlocal =  $("#txtidlocal").val();
	$("#txtparametros").val(1);

	//if(axestadoelectro == "PENDIENTE" ){

	listarStock();	
		console.log("entra aqui: 1");
	$("#divcontenedor1").css({'display':'none'});
	$("#divcontenedor2").css({'display':'block'});	
	$("#div_nota_credito").css({'display':'none'});	
	$("#divlsitavender").css({'display':'block'});
	listar_item_proforma()
		console.log("entra aqui: 1");
	tipo_documento();
	traer_cta();

	var axparamentro = $("#txtparametros").val();
			$.ajax({
				url:"cotizaciones_funciones.php",
				method: "POST",
				data: {param:32,txtcodmovprof:axcodproformacz1,txtparametros:axparamentro},
				success : function(data){
				var json = JSON.parse(data);
					console.log("este es el modificar: ");
					console.log(json);
					if (json.status == 200){

						//txtnom_cliente
						//txtnom_cliente_pedido

						$("#txtnum_proforma_1").val(json.NUM_PROFORMA);
						$("#txtnum_proforma").html(json.COD_MOV_PRF);
						$("#txtidcliente").val(json.ID_BENEFICIARIO);
						$("#txtfecharegistro").val(json.FECHA_PEDIDO);

						$("#txtidcliente").val(json.ID_BENEFICIARIO);
						$("#txtnom_cliente").val(json.NOM_PROVEEDOR);
						$("#txtnom_cliente_pedido").val(json.NOM_CLIENTE_PROF);

						$("#txtruc").val(json.RUC_BENEF);					
						$("#txtmoneda").val(json.MONEDA);					
						$("#txtformapago_compra").val(json.FORMA_PAGO);					
						$("#txtmedipago_compra").val(json.MEDIO_PAGO);					

					//	$("#txttipodoc").val(json.ID_TD);					
						$("#txtdiaspago_compra").val(json.DIAS_CREDITO);				
						$("#txtestadopago_compra").val(json.ESTADO_FORMA_PAGO);
						
						$("#divbtnvender").css({'display':'block'});

					}
				
					

				}
		})
	



	//}else{

	//	Swal.fire("Aviso", "No puede editar este PEDIDO", "warning");
	//}


})
/*
$(document).on("click","#btelimanar",function(){
	
	var axcodmovcz_1 = $(this).data("codprof");
	var axidlocal_1 = $("#txtidlocal").val();
	var axestadoelectro=$(this).data("estado");

	$("#txtcodmovprof").val(axcodmovcz_1);
	$("#txtidlocal").val(axidlocal_1);

  var axcodmovprof =  $("#txtcodmovprof").val();
	var axidlocal =  $("#txtidlocal").val();


	if(axestadoelectro == "PENDIENTE" ){

		Swal.fire({

	 	title: 'Estas seguro?',
		  text: "¡No podrás revertir esto!",
		  icon: 'question',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: '¡Sí, bórralo!'

	}).then((result) => {
	  if (result.isConfirmed) {

	  	$.ajax({
				url:"cotizaciones_funciones.php",
				method: "POST",
				data: {param:29,txtcodmovprof:axcodmovprof,txtidlocal:axidlocal},
					success : function(data){
						
						if(data==0){

								Swal.fire("Aviso", "Registro eliminado", "success");

								listar()
						}else{

							Swal.fire("Aviso", "No se elimino el registro", "warning");
						}

					}
			})


	  }
	})

	}else{

			Swal.fire("Aviso", "No puede eliminar este PEDIDO", "warning");


	}

	

})

*/

$(document).on("click","#btimprimirecibo",function(){
	
	var axcodmovcz = $(this).data("codmovimprimir");
	var axidlocal = $("#txtidlocal").val();
	//var axtipodoc=($("#txttipodoc option:selected").text());
	var axtipodoc=$(this).data("tipo");
	var axruta_comprobantes_pdf= $("#txtruta_comprobantes_pdf").val();
	

	if(axtipodoc=="NOTA DE CREDITO"){

		window.open("comprobante_nota_credito.php?local="+axidlocal+"&id="+axcodmovcz+"&ruta="+axruta_comprobantes_pdf);

	} else {

		window.open("comprobante_pago.php?local="+axidlocal+"&id="+axcodmovcz+"&ruta="+axruta_comprobantes_pdf);
			
	}

})



function Reporte_Comprobante() {

	var axcodmovcz = $("#txtcodmovcz").val();
	var axidlocal = $("#txtidlocal").val();
	var axtipodoc=($("#txttipodoc option:selected").text());
	var axruta_comprobantes_pdf= $("#txtruta_comprobantes_pdf").val();
	//alert(axtipodoc);
	
	if(axtipodoc=="NOTA DE CREDITO"){
	
		window.open("comprobante_nota_credito.php?local="+axidlocal+"&id="+axcodmovcz+"&ruta="+axruta_comprobantes_pdf);

	} else {

		window.open("comprobante_pago.php?local="+axidlocal+"&id="+axcodmovcz+"&ruta="+axruta_comprobantes_pdf);
			
	}
	

}

$(document).on("click","#txtformapago_compra",function(){

var axformapago = $("#txtformapago_compra").val();

if (axformapago=="CONTADO") {
	$("#divformapago").css({'display':'none'});
	$("#txtestadopago_compra").val('CANCELADO')
} else {
	$("#divformapago").css({'display':'block'});
	$("#txtestadopago_compra").val('PENDIENTE')
}

})

$(document).on("click","#txtmedipago_compra",function(){

	var axmediopago = $("#txtmedipago_compra").val();

	if (axmediopago=="EFECTIVO"){

		$("#txtglosa").val("VENTA DE MERCADERIA Y PRODUCTOS");
		$("#divmediopago").css({'display':'none'});


	} else {

		var axcliente = $("#txtnom_cliente").val();
		$("#txtglosa").val(axcliente);
		periodo_tranferencia();
		$("#divmediopago").css({'display':'block'});

	}

	

})


$(document).on("change","#txttipodoc",function(){

	var axtipodoc=($("#txttipodoc option:selected").text());
 	var ruc = $("#txtruc").val();
	var contar = ruc.length;
	var axpermiso_nc = $("#txtpermiso_nc").val();
	
	//alert(contar+'|'+ruc);

/*
	if(axtipodoc == "FACTURA" ){

		if(contar==11){
			$("#divdocu_referencias").css({'display':'none'});
			$("#divbtnvender").css({'display':'block'});
			nun_serie();
		}else {
			Swal.fire("Advertencia", "Verificar el numero de RUC, no cumple con las caracteristicas", "error");		
			$("#divbtnvender").css({'display':'none'});
						
		}
		
	}if(axtipodoc == "BOLETA DE VENTA" ){

		if(contar ==8 || contar ==11){
			$("#divdocu_referencias").css({'display':'none'});
			$("#divbtnvender").css({'display':'block'});
			nun_serie();	
		}else{
			Swal.fire("Advertencia", "Verificar el numero de RUC ó DNI, no cumple con las caracteristicas", "error");
			$("#divbtnvender").css({'display':'none'});					
		}
	
	}if(axtipodoc == "NOTA DE CREDITO"){

		if(axpermiso_nc=="NO"){
			Swal.fire("Advertencia", "Usted no tiene los permisos para generar NOTAS DE CREDITO", "warning");
			$("#divbtnvender").css({'display':'none'});				
		}else{

			if(contar ==8 || contar ==11){
			$("#divdocu_referencias").css({'display':'block'});
			$("#divbtnvender").css({'display':'block'});
			nun_serie();	
		}else{
			Swal.fire("Advertencia", "Verificar el numero de RUC ó DNI, no cumple con las caracteristicas", "error");	
			$("#divbtnvender").css({'display':'none'});				
		}
			
		}

	}
	*/

})




$(document).on("change","#txtnserie",function(){
	correlativos();
})






function Generar_CodPorforma__(){

	var axhoraemision1 = $("#reloj").val();
	$("#txthoraemision").val(axhoraemision1);

	var axcodusuario = $("#txtcodusuario").val();
	var axidlocal= $("#txtidlocal").val();

		momentoActual = new Date() 
	   	hora = addZero(momentoActual.getHours());
	   	minuto = addZero(momentoActual.getMinutes()); 
	   	segundo = addZero(momentoActual.getSeconds()); 
	   	var aleatorio = Math.round(Math.random()*15)
	   	var axcodproformacz1  = hora.toString()+minuto.toString()+segundo.toString()+'-'+axcodusuario.substr(0,3)+aleatorio;

	   	$("#txtnum_proforma").html(axcodproformacz1);
		$("#txtcodmovprof").val(axcodproformacz1);
		asql="insert into COTIZACION_CZ(COD_MOV_PRF,ID_LOCAL) VALUES('"+axcodproformacz1+"',"+axidlocal+")";
		console.log(asql);
		regresamatrizjsonasync(asql,"acarga");
		//console.log(acarga);
		
		asql="select ID_COTIZACION_CZ from COTIZACION_CZ WHERE COD_MOV_PRF='"+axcodproformacz1+"'";
		regresamatrizjsonasync(asql,"acodcotizacion");
		console.log(acodcotizacion);
		num_cotizacion=("00000"+acodcotizacion[0].ID_COTIZACION_CZ+"-2024").right(12);
		$('#txtnum_proforma_1').val(num_cotizacion);
		

}


String.prototype.right = function(n) {
        return this.substr((this.length-n),this.length);
};
function regresamatrizjsonasync(sqljson,variable){//crea variables dinamicas en ejecucion
  //var variables;
  console.log("Entra aqui:");
  console.log(sqljson);
  var resultado;
  resultado=$.ajax({
      url: 'ejecutasqltabla.php',
      type: 'POST',
      data: {q: sqljson},
      async: false,

      beforeSend: function () {
                    //$("#mensajesis").html("Procesando, espere por favor...");
                    datosactualizado=0;
                    //$.ajaxblock();
                },
        success:function(response) {
			console.log(response);
          window[variable] = response.data.formulas;
          console.log("se procesa la variable: "+variable);
         
           
        }
    });
  
}

$(document).on("click","#btbuscar_fechas",function(){
	$("#txtfiltro_busca_fecha").val('FECHA');
	listar();
})

$(document).on("change","#txtmoneda",function(){
	traer_cta();
})

$(document).on("click","#btbuscar_comprobante",function(){
	listar();
})

$(document).on("keyup","#txtbuscararticulo",function(){
	listarStock();
})



$(document).on("click","#btcancealr",function(){

	$("#divcontenedor1").css({'display':'block'});
	$("#divcontenedor2").css({'display':'none'});	
		
	listarStock();
})

$(document).on("click","#bnNuevo",function(){

	Generar_CodPorforma();
	
			$.ajax({
				url:"cotizaciones_funciones.php",
				method: "POST",
				data: {	param:37},
					success : function(data){

						$("#txtcodmovprof").val(data)	
							var axcodmovprof= $("#txtcodmovprof").val();
							var axcodusuario = $("#txtcodusuario").val();
							var axidlocal= $("#txtidlocal").val();
							var axtipo_cotizacion= $("#txttipo_cotizacion").val();
							var axanoactual= $("#txtanoactual").val();
			

							$.ajax({
										url:"cotizaciones_funciones.php",
										method: "POST",
										data: {param:36,
												txtcodusuario:axcodusuario,
												txtidlocal:axidlocal,
												txttipo_cotizacion:axtipo_cotizacion,
												txtcodmovprof:axcodmovprof,
												txtanoactual:axanoactual

											},
										success : function(data){

													$("#divcontenedor1").css({'display':'none'});
														$("#divcontenedor2").css({'display':'block'});	
														$("#div_nota_credito").css({'display':'none'});	
														$("#divlsitavender").css({'display':'none'});		
														listarStock();

										}
								})


					}
			})

	


	
	
})


function zeros( number, width )
{
  width -= number.toString().length;
  if ( width > 0 )
  {
    return new Array( width + (/\./.test( number ) ? 2 : 1) ).join( '0' ) + number;
  }
  return number + ""; // siempre devuelve tipo cadena
}


function mueveReloj(){ 
   	momentoActual = new Date() 
   	hora = addZero(momentoActual.getHours());
   	minuto = addZero(momentoActual.getMinutes()); 
   	segundo = addZero(momentoActual.getSeconds()); 

   	horaImprimible = hora + ":" + minuto + ":" + segundo 
   	//horaImprimible = hora + ":" + minuto 

   	document.form_reloj.reloj.value = horaImprimible 
   	setTimeout("mueveReloj()",1000)
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

function guardarexcel_conceptos(){
        var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'

        , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }

        var table = 'tblconceptos';
        var name = 'ListaConceptosVendidos';

        if (!table.nodeType) table = document.getElementById(table)
         var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }
         window.location.href = uri + base64(format(template, ctx))
}


function exportTableToExcel(tblistagastos, filename = 'listadogastos'){

    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tblistagastos);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}


</script>




